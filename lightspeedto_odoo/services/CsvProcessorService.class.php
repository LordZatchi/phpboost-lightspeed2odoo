<?php
/**
 * @copyright   &copy; 2024
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL-3.0
 * @author      LordZatchi <zatchbell68@gmail.com>
 * @version     PHPBoost 6.0 - last update: 2024 12 20
 * @since       PHPBoost 6.0 - 2024 12 20
*/

class CsvProcessorService
{
	private $odoo_api;
	private $upload_data;
	private $mapping_data;
	private $errors;

	public function __construct()
	{
		$this->odoo_api = new OdooApiService();
		$this->errors = array();
	}

	/**
	 * Traite un lot de données CSV
	 * @param int $upload_id
	 * @param int $batch_number
	 * @param int $batch_size
	 * @return array Résultat du traitement
	 */
	public function process_batch($upload_id, $batch_number, $batch_size = 10)
	{
		$result = array(
			'success' => false,
			'processed_rows' => 0,
			'errors' => 0,
			'completed' => false,
			'message' => '',
			'details' => array()
		);

		try {
			// Chargement des données d'upload
			$this->upload_data = LightspeedtoOdooService::get_upload($upload_id);
			if (!$this->upload_data)
			{
				throw new Exception('Upload introuvable');
			}

			// Chargement du mapping
			$this->mapping_data = json_decode($this->upload_data['mapping_data'], true);
			if (!is_array($this->mapping_data))
			{
				throw new Exception('Données de mapping invalides');
			}

			// Traitement du batch
			$batch_result = $this->process_csv_batch($batch_number, $batch_size);
			
			// Mise à jour des statistiques
			$this->update_upload_progress($upload_id, $batch_result);

			$result['success'] = true;
			$result['processed_rows'] = $batch_result['processed_rows'];
			$result['errors'] = $batch_result['errors'];
			$result['completed'] = $batch_result['completed'];
			$result['message'] = $batch_result['message'];
			$result['details'] = $batch_result['details'];

		} catch (Exception $e) {
			$result['message'] = $e->getMessage();
			
			// Marquer l'upload comme en erreur
			LightspeedtoOdooService::update_upload_status($upload_id, 'error', array(
				'errors_log' => json_encode(array(array(
					'batch' => $batch_number,
					'message' => $e->getMessage(),
					'timestamp' => time()
				)))
			));
		}

		return $result;
	}

	/**
	 * Traite un batch spécifique du fichier CSV
	 * @param int $batch_number
	 * @param int $batch_size
	 * @return array
	 */
	private function process_csv_batch($batch_number, $batch_size)
	{
		$result = array(
			'processed_rows' => 0,
			'errors' => 0,
			'completed' => false,
			'message' => '',
			'details' => array()
		);

		// Ouverture du fichier CSV
		$file_path = $this->upload_data['file_path'];
		if (!file_exists($file_path))
		{
			throw new Exception('Fichier CSV introuvable');
		}

		$handle = fopen($file_path, 'r');
		if (!$handle)
		{
			throw new Exception('Impossible d\'ouvrir le fichier CSV');
		}

		// Lecture des en-têtes
		$headers = fgetcsv($handle, 0, ',');
		if (!$headers)
		{
			fclose($handle);
			throw new Exception('En-têtes CSV invalides');
		}

		// Nettoyage des en-têtes
		$headers = array_map('trim', $headers);

		// Positionnement au début du batch
		$start_row = $batch_number * $batch_size;
		$current_row = 0;
		$batch_data = array();

		// Lecture jusqu'au début du batch
		while ($current_row < $start_row && fgetcsv($handle) !== false)
		{
			$current_row++;
		}

		// Lecture du batch
		$rows_in_batch = 0;
		while ($rows_in_batch < $batch_size && ($row_data = fgetcsv($handle)) !== false)
		{
			$batch_data[] = array_combine($headers, $row_data);
			$rows_in_batch++;
			$current_row++;
		}

		fclose($handle);

		// Vérification si c'est le dernier batch
		$result['completed'] = ($current_row >= $this->upload_data['total_rows']);

		// Traitement du batch avec Odoo
		if (!empty($batch_data))
		{
			$processing_result = $this->process_batch_data($batch_data, $start_row);
			$result['processed_rows'] = $processing_result['processed_rows'];
			$result['errors'] = $processing_result['errors'];
			$result['details'] = $processing_result['details'];
		}

		$result['message'] = sprintf(
			'Batch %d traité: %d lignes traitées, %d erreurs',
			$batch_number + 1,
			$result['processed_rows'],
			$result['errors']
		);

		return $result;
	}

	/**
	 * Traite les données d'un batch avec l'API Odoo
	 * @param array $batch_data
	 * @param int $start_row
	 * @return array
	 */
	private function process_batch_data($batch_data, $start_row)
	{
		$result = array(
			'processed_rows' => 0,
			'errors' => 0,
			'details' => array()
		);

		$products_to_process = array();

		// Préparation des données pour Odoo
		foreach ($batch_data as $index => $row_data)
		{
			$row_number = $start_row + $index + 1;
			
			try {
				// Validation et mapping des données
				$validation_result = LightspeedtoOdooService::validate_product_data($row_data, $this->mapping_data);
				
				if ($validation_result['valid'])
				{
					$products_to_process[] = array(
						'row_number' => $row_number,
						'data' => $validation_result['mapped_data']
					);
					
					if (!empty($validation_result['warnings']))
					{
						foreach ($validation_result['warnings'] as $warning)
						{
							$result['details'][] = array(
								'row' => $row_number,
								'type' => 'warning',
								'message' => $warning
							);
						}
					}
				}
				else
				{
					$result['errors']++;
					foreach ($validation_result['errors'] as $error)
					{
						$result['details'][] = array(
							'row' => $row_number,
							'type' => 'error',
							'message' => $error,
							'data' => $row_data
						);
					}
				}

			} catch (Exception $e) {
				$result['errors']++;
				$result['details'][] = array(
					'row' => $row_number,
					'type' => 'error',
					'message' => 'Erreur de validation: ' . $e->getMessage(),
					'data' => $row_data
				);
			}
		}

		// Traitement avec Odoo
		if (!empty($products_to_process))
		{
			try {
				$odoo_result = $this->process_products_with_odoo($products_to_process);
				$result['processed_rows'] += $odoo_result['processed_rows'];
				$result['errors'] += $odoo_result['errors'];
				$result['details'] = array_merge($result['details'], $odoo_result['details']);

			} catch (Exception $e) {
				$result['errors'] += count($products_to_process);
				$result['details'][] = array(
					'row' => 'batch',
					'type' => 'error',
					'message' => 'Erreur Odoo: ' . $e->getMessage()
				);
			}
		}

		return $result;
	}

	/**
	 * Traite les produits avec l'API Odoo
	 * @param array $products_to_process
	 * @return array
	 */
	private function process_products_with_odoo($products_to_process)
	{
		$result = array(
			'processed_rows' => 0,
			'errors' => 0,
			'details' => array()
		);

		// Préparation des données pour le traitement en lot
		$products_data = array();
		foreach ($products_to_process as $product_info)
		{
			$products_data[] = $product_info['data'];
		}

		// Traitement en lot avec Odoo
		$odoo_result = $this->odoo_api->batch_process_products($products_data);

		// Analyse des résultats
		foreach ($odoo_result['details'] as $detail)
		{
			$product_info = $products_to_process[$detail['row'] - 1];
			$row_number = $product_info['row_number'];

			if ($detail['action'] === 'error')
			{
				$result['errors']++;
				$result['details'][] = array(
					'row' => $row_number,
					'type' => 'error',
					'message' => $detail['message']
				);
			}
			else
			{
				$result['processed_rows']++;
				$result['details'][] = array(
					'row' => $row_number,
					'type' => 'success',
					'message' => $detail['message'],
					'product_id' => $detail['product_id']
				);
			}
		}

		return $result;
	}

	/**
	 * Met à jour la progression de l'upload
	 * @param int $upload_id
	 * @param array $batch_result
	 */
	private function update_upload_progress($upload_id, $batch_result)
	{
		// Récupération des données actuelles
		$current_data = LightspeedtoOdooService::get_upload($upload_id);
		
		$new_processed_rows = $current_data['processed_rows'] + $batch_result['processed_rows'];
		$new_error_count = $current_data['error_count'] + $batch_result['errors'];

		// Mise à jour des logs d'erreur
		$current_errors = !empty($current_data['errors_log']) ? json_decode($current_data['errors_log'], true) : array();
		if (!is_array($current_errors)) $current_errors = array();
		
		foreach ($batch_result['details'] as $detail)
		{
			if ($detail['type'] === 'error')
			{
				$current_errors[] = $detail;
			}
		}

		// Détermination du nouveau statut
		$new_status = 'processing';
		if ($batch_result['completed'])
		{
			$new_status = ($new_error_count > 0) ? 'completed' : 'completed';
		}

		// Mise à jour en base
		LightspeedtoOdooService::update_upload_status($upload_id, $new_status, array(
			'processed_rows' => $new_processed_rows,
			'error_count' => $new_error_count,
			'errors_log' => json_encode($current_errors)
		));
	}

	/**
	 * Traite un fichier CSV complet en une fois (pour les petits fichiers)
	 * @param int $upload_id
	 * @return array
	 */
	public function process_full_file($upload_id)
	{
		$result = array(
			'success' => false,
			'processed_rows' => 0,
			'errors' => 0,
			'message' => '',
			'details' => array()
		);

		try {
			// Chargement des données
			$this->upload_data = LightspeedtoOdooService::get_upload($upload_id);
			if (!$this->upload_data)
			{
				throw new Exception('Upload introuvable');
			}

			$this->mapping_data = json_decode($this->upload_data['mapping_data'], true);
			if (!is_array($this->mapping_data))
			{
				throw new Exception('Données de mapping invalides');
			}

			// Traitement complet
			$csv_data = $this->read_full_csv();
			$processing_result = $this->process_batch_data($csv_data, 0);

			$result['success'] = true;
			$result['processed_rows'] = $processing_result['processed_rows'];
			$result['errors'] = $processing_result['errors'];
			$result['details'] = $processing_result['details'];
			$result['message'] = sprintf(
				'Traitement terminé: %d lignes traitées, %d erreurs',
				$result['processed_rows'],
				$result['errors']
			);

			// Mise à jour finale
			$final_status = ($result['errors'] > 0) ? 'completed' : 'completed';
			LightspeedtoOdooService::update_upload_status($upload_id, $final_status, array(
				'processed_rows' => $result['processed_rows'],
				'error_count' => $result['errors'],
				'errors_log' => json_encode($processing_result['details'])
			));

		} catch (Exception $e) {
			$result['message'] = $e->getMessage();
			
			LightspeedtoOdooService::update_upload_status($upload_id, 'error', array(
				'errors_log' => json_encode(array(array(
					'message' => $e->getMessage(),
					'timestamp' => time()
				)))
			));
		}

		return $result;
	}

	/**
	 * Lit l'intégralité du fichier CSV
	 * @return array
	 */
	private function read_full_csv()
	{
		$file_path = $this->upload_data['file_path'];
		$handle = fopen($file_path, 'r');
		
		if (!$handle)
		{
			throw new Exception('Impossible d\'ouvrir le fichier CSV');
		}

		// Lecture des en-têtes
		$headers = fgetcsv($handle, 0, ',');
		if (!$headers)
		{
			fclose($handle);
			throw new Exception('En-têtes CSV invalides');
		}

		$headers = array_map('trim', $headers);
		$data = array();

		// Lecture de toutes les lignes
		while (($row_data = fgetcsv($handle)) !== false)
		{
			$data[] = array_combine($headers, $row_data);
		}

		fclose($handle);
		return $data;
	}

	/**
	 * Valide un fichier CSV avant traitement
	 * @param string $file_path
	 * @param array $mapping_data
	 * @return array
	 */
	public function validate_csv_for_processing($file_path, $mapping_data)
	{
		$result = array(
			'valid' => true,
			'errors' => array(),
			'warnings' => array(),
			'sample_data' => array()
		);

		try {
			$handle = fopen($file_path, 'r');
			if (!$handle)
			{
				$result['valid'] = false;
				$result['errors'][] = 'Impossible d\'ouvrir le fichier CSV';
				return $result;
			}

			// Lecture des en-têtes
			$headers = fgetcsv($handle, 0, ',');
			if (!$headers)
			{
				$result['valid'] = false;
				$result['errors'][] = 'En-têtes CSV invalides';
				fclose($handle);
				return $result;
			}

			$headers = array_map('trim', $headers);

			// Vérification de la correspondance avec le mapping
			$mapped_fields = array();
			foreach ($mapping_data as $mapping)
			{
				if (isset($mapping['lightspeed_field']))
				{
					$mapped_fields[] = $mapping['lightspeed_field'];
				}
			}

			$missing_fields = array_diff($mapped_fields, $headers);
			if (!empty($missing_fields))
			{
				$result['warnings'][] = 'Champs manquants dans le CSV: ' . implode(', ', $missing_fields);
			}

			// Lecture d'un échantillon pour validation
			$sample_count = 0;
			while ($sample_count < 5 && ($row_data = fgetcsv($handle)) !== false)
			{
				$row_array = array_combine($headers, $row_data);
				$validation_result = LightspeedtoOdooService::validate_product_data($row_array, $mapping_data);
				
				$result['sample_data'][] = array(
					'row' => $sample_count + 1,
					'valid' => $validation_result['valid'],
					'data' => $row_array,
					'mapped_data' => $validation_result['mapped_data'],
					'errors' => $validation_result['errors'],
					'warnings' => $validation_result['warnings']
				);

				$sample_count++;
			}

			fclose($handle);

		} catch (Exception $e) {
			$result['valid'] = false;
			$result['errors'][] = 'Erreur lors de la validation: ' . $e->getMessage();
		}

		return $result;
	}
}
?>0.html GNU/GPL-3.