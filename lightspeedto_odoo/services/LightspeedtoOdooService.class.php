<?php
/**
 * @copyright   &copy; 2024
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL-3.0
 * @author      LordZatchi <zatchbell68@gmail.com>
 * @version     PHPBoost 6.0 - last update: 2024 12 20
 * @since       PHPBoost 6.0 - 2024 12 20
*/

class LightspeedtoOdooService
{
	private static $db_querier;

	public static function __static()
	{
		self::$db_querier = PersistenceContext::get_querier();
	}

	/**
	 * Détecte automatiquement le mapping approprié basé sur les en-têtes du CSV
	 * @param array $csv_headers Les en-têtes du fichier CSV
	 * @return int|null L'ID du mapping détecté ou null
	 */
	public static function detect_mapping_from_headers($csv_headers)
	{
		// Récupération de tous les mappings
		$result = self::$db_querier->select(
			"SELECT id, name, mapping_data, is_default
			FROM " . LightspeedtoOdooSetup::$lightspeedto_odoo_mappings_table . "
			ORDER BY is_default DESC, name ASC"
		);

		$best_match = null;
		$best_score = 0;

		while ($row = $result->fetch())
		{
			$mapping_data = json_decode($row['mapping_data'], true);
			if (!is_array($mapping_data)) continue;

			// Calcul du score de correspondance
			$score = self::calculate_mapping_score($csv_headers, $mapping_data);
			
			// Si le mapping est par défaut, on lui donne un bonus
			if ($row['is_default']) {
				$score += 0.1;
			}

			if ($score > $best_score)
			{
				$best_score = $score;
				$best_match = $row['id'];
			}
		}
		$result->dispose();

		// Retourner le mapping seulement si le score est suffisant (au moins 50% de correspondance)
		return ($best_score >= 0.5) ? $best_match : null;
	}

	/**
	 * Calcule le score de correspondance entre les en-têtes CSV et un mapping
	 * @param array $csv_headers
	 * @param array $mapping_data
	 * @return float Score entre 0 et 1
	 */
	private static function calculate_mapping_score($csv_headers, $mapping_data)
	{
		if (empty($mapping_data) || empty($csv_headers)) return 0;

		$csv_headers_lower = array_map('strtolower', $csv_headers);
		$matches = 0;
		$total_mappings = count($mapping_data);

		foreach ($mapping_data as $mapping)
		{
			if (isset($mapping['lightspeed_field']))
			{
				$lightspeed_field_lower = strtolower($mapping['lightspeed_field']);
				if (in_array($lightspeed_field_lower, $csv_headers_lower))
				{
					$matches++;
				}
			}
		}

		return $total_mappings > 0 ? ($matches / $total_mappings) : 0;
	}

	/**
	 * Crée un nouveau mapping basé sur les en-têtes CSV
	 * @param array $csv_headers
	 * @param string $name
	 * @param int $user_id
	 * @return int L'ID du mapping créé
	 */
	public static function create_auto_mapping($csv_headers, $name, $user_id)
	{
		// Mapping automatique des champs les plus courants
		$auto_mappings = array(
			'sku' => 'default_code',
			'barcode' => 'barcode',
			'title' => 'name',
			'name' => 'name',
			'price' => 'list_price',
			'cost_per_item' => 'standard_price',
			'weight' => 'weight',
			'vendor' => 'vendor_id',
			'type' => 'categ_id',
			'inventory_quantity' => 'qty_available'
		);

		$mapping_data = array();
		$csv_headers_lower = array_map('strtolower', $csv_headers);

		foreach ($csv_headers as $header)
		{
			$header_lower = strtolower($header);
			if (isset($auto_mappings[$header_lower]))
			{
				$mapping_data[] = array(
					'lightspeed_field' => $header,
					'odoo_field' => $auto_mappings[$header_lower],
					'transformation' => ''
				);
			}
		}

		// Création du mapping
		$now = time();
		$result = self::$db_querier->insert(LightspeedtoOdooSetup::$lightspeedto_odoo_mappings_table, array(
			'name' => $name,
			'description' => 'Mapping généré automatiquement',
			'mapping_data' => json_encode($mapping_data),
			'is_default' => 0,
			'created_date' => $now,
			'updated_date' => $now,
			'user_id' => $user_id
		));

		return $result->get_last_inserted_id();
	}

	/**
	 * Valide un fichier CSV uploadé
	 * @param string $file_path
	 * @return array Résultat de la validation
	 */
	public static function validate_csv_file($file_path)
	{
		$result = array(
			'valid' => false,
			'headers' => array(),
			'total_rows' => 0,
			'errors' => array()
		);

		if (!file_exists($file_path))
		{
			$result['errors'][] = 'Fichier non trouvé';
			return $result;
		}

		// Ouverture du fichier CSV
		$handle = fopen($file_path, 'r');
		if (!$handle)
		{
			$result['errors'][] = 'Impossible d\'ouvrir le fichier';
			return $result;
		}

		// Lecture des en-têtes
		$headers = fgetcsv($handle, 0, ',');
		if (!$headers || empty($headers))
		{
			$result['errors'][] = 'En-têtes CSV non trouvés';
			fclose($handle);
			return $result;
		}

		// Nettoyage des en-têtes
		$headers = array_map('trim', $headers);
		$result['headers'] = $headers;

		// Comptage des lignes
		$line_count = 0;
		while (fgetcsv($handle) !== false)
		{
			$line_count++;
		}
		fclose($handle);

		$result['total_rows'] = $line_count;
		$result['valid'] = true;

		return $result;
	}

	/**
	 * Sauvegarde les informations d'un upload
	 * @param string $filename
	 * @param string $original_filename
	 * @param string $file_path
	 * @param int $file_size
	 * @param int $mapping_id
	 * @param array $csv_info
	 * @param int $user_id
	 * @return int L'ID de l'upload créé
	 */
	public static function save_upload($filename, $original_filename, $file_path, $file_size, $mapping_id, $csv_info, $user_id)
	{
		$result = self::$db_querier->insert(LightspeedtoOdooSetup::$lightspeedto_odoo_uploads_table, array(
			'filename' => $filename,
			'original_filename' => $original_filename,
			'file_path' => $file_path,
			'file_size' => $file_size,
			'mapping_id' => $mapping_id,
			'status' => 'pending',
			'processed_rows' => 0,
			'total_rows' => $csv_info['total_rows'],
			'error_count' => 0,
			'errors_log' => '',
			'upload_date' => time(),
			'processed_date' => null,
			'user_id' => $user_id
		));

		return $result->get_last_inserted_id();
	}

	/**
	 * Met à jour le statut d'un upload
	 * @param int $upload_id
	 * @param string $status
	 * @param array $additional_data
	 */
	public static function update_upload_status($upload_id, $status, $additional_data = array())
	{
		$update_data = array('status' => $status);
		
		if (isset($additional_data['processed_rows']))
		{
			$update_data['processed_rows'] = $additional_data['processed_rows'];
		}
		
		if (isset($additional_data['error_count']))
		{
			$update_data['error_count'] = $additional_data['error_count'];
		}
		
		if (isset($additional_data['errors_log']))
		{
			$update_data['errors_log'] = $additional_data['errors_log'];
		}
		
		if ($status === 'completed' || $status === 'error')
		{
			$update_data['processed_date'] = time();
		}

		self::$db_querier->update(
			LightspeedtoOdooSetup::$lightspeedto_odoo_uploads_table,
			$update_data,
			'WHERE id = :id',
			array('id' => $upload_id)
		);
	}

	/**
	 * Récupère les informations d'un upload
	 * @param int $upload_id
	 * @return array|null
	 */
	public static function get_upload($upload_id)
	{
		try {
			return self::$db_querier->select_single_row(
				LightspeedtoOdooSetup::$lightspeedto_odoo_uploads_table . " u
				LEFT JOIN " . LightspeedtoOdooSetup::$lightspeedto_odoo_mappings_table . " m ON m.id = u.mapping_id",
				array('u.*', 'm.name as mapping_name', 'm.mapping_data'),
				'WHERE u.id = :id',
				array('id' => $upload_id)
			);
		} catch (RowNotFoundException $e) {
			return null;
		}
	}

	/**
	 * Récupère un mapping par son ID
	 * @param int $mapping_id
	 * @return array|null
	 */
	public static function get_mapping($mapping_id)
	{
		try {
			return self::$db_querier->select_single_row(
				LightspeedtoOdooSetup::$lightspeedto_odoo_mappings_table,
				array('*'),
				'WHERE id = :id',
				array('id' => $mapping_id)
			);
		} catch (RowNotFoundException $e) {
			return null;
		}
	}

	/**
	 * Récupère le mapping par défaut
	 * @return array|null
	 */
	public static function get_default_mapping()
	{
		try {
			return self::$db_querier->select_single_row(
				LightspeedtoOdooSetup::$lightspeedto_odoo_mappings_table,
				array('*'),
				'WHERE is_default = 1'
			);
		} catch (RowNotFoundException $e) {
			return null;
		}
	}

	/**
	 * Récupère tous les mappings disponibles
	 * @return array
	 */
	public static function get_all_mappings()
	{
		$mappings = array();
		$result = self::$db_querier->select(
			"SELECT *
			FROM " . LightspeedtoOdooSetup::$lightspeedto_odoo_mappings_table . "
			ORDER BY is_default DESC, name ASC"
		);

		while ($row = $result->fetch())
		{
			$mappings[] = $row;
		}
		$result->dispose();

		return $mappings;
	}

	/**
	 * Supprime les fichiers d'upload anciens
	 * @param int $days_old Nombre de jours après lesquels supprimer les fichiers
	 */
	public static function cleanup_old_uploads($days_old = 30)
	{
		$cutoff_date = time() - ($days_old * 24 * 3600);
		
		// Récupération des anciens uploads
		$result = self::$db_querier->select(
			"SELECT id, file_path
			FROM " . LightspeedtoOdooSetup::$lightspeedto_odoo_uploads_table . "
			WHERE upload_date < :cutoff_date AND status IN ('completed', 'error')",
			array('cutoff_date' => $cutoff_date)
		);

		while ($row = $result->fetch())
		{
			// Suppression du fichier physique
			if (file_exists($row['file_path']))
			{
				@unlink($row['file_path']);
			}

			// Suppression de l'enregistrement
			self::$db_querier->delete(
				LightspeedtoOdooSetup::$lightspeedto_odoo_uploads_table,
				'WHERE id = :id',
				array('id' => $row['id'])
			);
		}
		$result->dispose();
	}

	/**
	 * Valide les données d'un produit selon le mapping
	 * @param array $product_data
	 * @param array $mapping_data
	 * @return array Résultat de la validation
	 */
	public static function validate_product_data($product_data, $mapping_data)
	{
		$result = array(
			'valid' => true,
			'errors' => array(),
			'warnings' => array(),
			'mapped_data' => array()
		);

		if (!is_array($mapping_data))
		{
			$result['valid'] = false;
			$result['errors'][] = 'Données de mapping invalides';
			return $result;
		}

		foreach ($mapping_data as $mapping)
		{
			if (!isset($mapping['lightspeed_field']) || !isset($mapping['odoo_field']))
			{
				continue;
			}

			$lightspeed_field = $mapping['lightspeed_field'];
			$odoo_field = $mapping['odoo_field'];
			$transformation = isset($mapping['transformation']) ? $mapping['transformation'] : '';

			// Récupération de la valeur
			$value = isset($product_data[$lightspeed_field]) ? $product_data[$lightspeed_field] : '';

			// Application des transformations si définies
			if (!empty($transformation))
			{
				$value = self::apply_transformation($value, $transformation);
			}

			// Validation selon le type de champ Odoo
			$validation_result = self::validate_odoo_field($odoo_field, $value);
			if (!$validation_result['valid'])
			{
				$result['errors'][] = "Champ {$odoo_field}: " . $validation_result['error'];
				$result['valid'] = false;
			}
			else
			{
				$result['mapped_data'][$odoo_field] = $validation_result['value'];
				if (isset($validation_result['warning']))
				{
					$result['warnings'][] = "Champ {$odoo_field}: " . $validation_result['warning'];
				}
			}
		}

		return $result;
	}

	/**
	 * Applique une transformation sur une valeur
	 * @param mixed $value
	 * @param string $transformation
	 * @return mixed
	 */
	private static function apply_transformation($value, $transformation)
	{
		// Transformations supportées (exemples)
		switch (strtolower(trim($transformation)))
		{
			case 'uppercase':
				return strtoupper($value);
			case 'lowercase':
				return strtolower($value);
			case 'trim':
				return trim($value);
			case 'float':
				return (float)$value;
			case 'int':
				return (int)$value;
			case 'bool':
				return filter_var($value, FILTER_VALIDATE_BOOLEAN);
			default:
				// Transformation personnalisée (formule simple)
				if (strpos($transformation, '{value}') !== false)
				{
					return str_replace('{value}', $value, $transformation);
				}
				return $value;
		}
	}

	/**
	 * Valide une valeur pour un champ Odoo spécifique
	 * @param string $field_name
	 * @param mixed $value
	 * @return array
	 */
	private static function validate_odoo_field($field_name, $value)
	{
		$result = array(
			'valid' => true,
			'value' => $value,
			'error' => '',
			'warning' => ''
		);

		// Validations spécifiques selon le champ
		switch ($field_name)
		{
			case 'list_price':
			case 'standard_price':
				if (!is_numeric($value) || $value < 0)
				{
					$result['valid'] = false;
					$result['error'] = 'Le prix doit être un nombre positif';
				}
				else
				{
					$result['value'] = (float)$value;
				}
				break;

			case 'weight':
				if (!empty($value) && !is_numeric($value))
				{
					$result['valid'] = false;
					$result['error'] = 'Le poids doit être un nombre';
				}
				else
				{
					$result['value'] = (float)$value;
				}
				break;

			case 'active':
			case 'available_in_pos':
			case 'to_weight':
				$result['value'] = filter_var($value, FILTER_VALIDATE_BOOLEAN);
				break;

			case 'name':
			case 'default_code':
				if (empty($value))
				{
					$result['valid'] = false;
					$result['error'] = 'Ce champ est obligatoire';
				}
				else
				{
					$result['value'] = trim($value);
				}
				break;

			case 'barcode':
				if (!empty($value) && !preg_match('/^[0-9]+$/', $value))
				{
					$result['warning'] = 'Le code-barres doit contenir uniquement des chiffres';
				}
				break;

			default:
				// Validation générique
				$result['value'] = trim($value);
				break;
		}

		return $result;
	}

	/**
	 * Génère des statistiques sur les uploads
	 * @return array
	 */
	public static function get_upload_statistics()
	{
		$stats = array(
			'total_uploads' => 0,
			'pending_uploads' => 0,
			'processing_uploads' => 0,
			'completed_uploads' => 0,
			'error_uploads' => 0,
			'total_processed_rows' => 0,
			'total_errors' => 0
		);

		// Comptage par statut
		$result = self::$db_querier->select(
			"SELECT status, COUNT(*) as count, SUM(processed_rows) as processed_rows, SUM(error_count) as error_count
			FROM " . LightspeedtoOdooSetup::$lightspeedto_odoo_uploads_table . "
			GROUP BY status"
		);

		while ($row = $result->fetch())
		{
			$stats['total_uploads'] += $row['count'];
			$stats['total_processed_rows'] += $row['processed_rows'];
			$stats['total_errors'] += $row['error_count'];

			switch ($row['status'])
			{
				case 'pending':
					$stats['pending_uploads'] = $row['count'];
					break;
				case 'processing':
					$stats['processing_uploads'] = $row['count'];
					break;
				case 'completed':
					$stats['completed_uploads'] = $row['count'];
					break;
				case 'error':
					$stats['error_uploads'] = $row['count'];
					break;
			}
		}
		$result->dispose();

		return $stats;
	}
}