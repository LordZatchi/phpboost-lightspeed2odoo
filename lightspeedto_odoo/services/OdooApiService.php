<?php
/**
 * @copyright   &copy; 2024
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL-3.0
 * @author      LordZatchi <zatchbell68@gmail.com>
 * @version     PHPBoost 6.0 - last update: 2024 12 20
 * @since       PHPBoost 6.0 - 2024 12 20
*/

class OdooApiService
{
	private $config;
	private $base_url;
	private $database;
	private $username;
	private $password;
	private $api_key;
	private $uid;

	public function __construct()
	{
		$this->config = LightspeedtoOdooConfig::load();
		$this->base_url = rtrim($this->config->get_odoo_url(), '/');
		$this->database = $this->config->get_odoo_database();
		$this->username = $this->config->get_odoo_username();
		$this->password = $this->config->get_odoo_password();
		$this->api_key = $this->config->get_odoo_api_key();
	}

	/**
	 * Teste la connexion à Odoo
	 * @return array Résultat du test
	 */
	public function test_connection()
	{
		$result = array(
			'success' => false,
			'message' => '',
			'details' => array()
		);

		try {
			// Vérification des paramètres
			if (empty($this->base_url) || empty($this->database))
			{
				$result['message'] = 'URL et base de données Odoo requis';
				return $result;
			}

			// Test de connexion avec authentification
			$auth_result = $this->authenticate();
			if (!$auth_result['success'])
			{
				$result['message'] = $auth_result['message'];
				return $result;
			}

			// Test d'accès aux produits
			$products_test = $this->test_product_access();
			if (!$products_test['success'])
			{
				$result['message'] = $products_test['message'];
				return $result;
			}

			$result['success'] = true;
			$result['message'] = 'Connexion Odoo réussie';
			$result['details'] = array(
				'url' => $this->base_url,
				'database' => $this->database,
				'username' => $this->username,
				'user_id' => $this->uid,
				'product_access' => true
			);

		} catch (Exception $e) {
			$result['message'] = 'Erreur de connexion: ' . $e->getMessage();
		}

		return $result;
	}

	/**
	 * Authentification auprès d'Odoo
	 * @return array
	 */
	private function authenticate()
	{
		$result = array('success' => false, 'message' => '');

		try {
			// Utilisation de l'API key si disponible
			if (!empty($this->api_key))
			{
				$auth_result = $this->authenticate_with_api_key();
			}
			else
			{
				$auth_result = $this->authenticate_with_password();
			}

			if ($auth_result['success'])
			{
				$this->uid = $auth_result['uid'];
				$result['success'] = true;
			}
			else
			{
				$result['message'] = $auth_result['message'];
			}

		} catch (Exception $e) {
			$result['message'] = 'Erreur d\'authentification: ' . $e->getMessage();
		}

		return $result;
	}

	/**
	 * Authentification avec API key
	 * @return array
	 */
	private function authenticate_with_api_key()
	{
		$url = $this->base_url . '/jsonrpc';
		$data = array(
			'jsonrpc' => '2.0',
			'method' => 'call',
			'params' => array(
				'service' => 'common',
				'method' => 'authenticate',
				'args' => array($this->database, $this->username, $this->api_key, array())
			),
			'id' => 1
		);

		$response = $this->make_request($url, $data);
		
		if ($response && isset($response['result']) && $response['result'])
		{
			return array('success' => true, 'uid' => $response['result']);
		}
		
		return array('success' => false, 'message' => 'Authentification par API key échouée');
	}

	/**
	 * Authentification avec mot de passe
	 * @return array
	 */
	private function authenticate_with_password()
	{
		$url = $this->base_url . '/jsonrpc';
		$data = array(
			'jsonrpc' => '2.0',
			'method' => 'call',
			'params' => array(
				'service' => 'common',
				'method' => 'authenticate',
				'args' => array($this->database, $this->username, $this->password, array())
			),
			'id' => 1
		);

		$response = $this->make_request($url, $data);
		
		if ($response && isset($response['result']) && $response['result'])
		{
			return array('success' => true, 'uid' => $response['result']);
		}
		
		return array('success' => false, 'message' => 'Authentification par mot de passe échouée');
	}

	/**
	 * Test d'accès aux produits
	 * @return array
	 */
	private function test_product_access()
	{
		try {
			$products = $this->search_products(array(), 0, 1);
			return array('success' => true, 'products_found' => count($products));
		} catch (Exception $e) {
			return array('success' => false, 'message' => 'Accès aux produits refusé: ' . $e->getMessage());
		}
	}

	/**
	 * Recherche des produits dans Odoo
	 * @param array $domain Critères de recherche
	 * @param int $offset
	 * @param int $limit
	 * @return array
	 */
	public function search_products($domain = array(), $offset = 0, $limit = 100)
	{
		if (!$this->uid)
		{
			$auth_result = $this->authenticate();
			if (!$auth_result['success'])
			{
				throw new Exception('Authentification échouée');
			}
		}

		$url = $this->base_url . '/jsonrpc';
		$data = array(
			'jsonrpc' => '2.0',
			'method' => 'call',
			'params' => array(
				'service' => 'object',
				'method' => 'execute_kw',
				'args' => array(
					$this->database,
					$this->uid,
					$this->get_auth_token(),
					'product.template',
					'search_read',
					array($domain),
					array(
						'offset' => $offset,
						'limit' => $limit,
						'fields' => array('id', 'name', 'default_code', 'barcode', 'list_price')
					)
				)
			),
			'id' => 1
		);

		$response = $this->make_request($url, $data);
		
		if ($response && isset($response['result']))
		{
			return $response['result'];
		}
		
		throw new Exception('Erreur lors de la recherche de produits');
	}

	/**
	 * Crée un nouveau produit dans Odoo
	 * @param array $product_data
	 * @return int ID du produit créé
	 */
	public function create_product($product_data)
	{
		if (!$this->uid)
		{
			$auth_result = $this->authenticate();
			if (!$auth_result['success'])
			{
				throw new Exception('Authentification échouée');
			}
		}

		// Validation des données obligatoires
		if (empty($product_data['name']))
		{
			throw new Exception('Le nom du produit est obligatoire');
		}

		$url = $this->base_url . '/jsonrpc';
		$data = array(
			'jsonrpc' => '2.0',
			'method' => 'call',
			'params' => array(
				'service' => 'object',
				'method' => 'execute_kw',
				'args' => array(
					$this->database,
					$this->uid,
					$this->get_auth_token(),
					'product.template',
					'create',
					array($product_data)
				)
			),
			'id' => 1
		);

		$response = $this->make_request($url, $data);
		
		if ($response && isset($response['result']))
		{
			return $response['result'];
		}
		
		throw new Exception('Erreur lors de la création du produit');
	}

	/**
	 * Met à jour un produit existant dans Odoo
	 * @param int $product_id
	 * @param array $product_data
	 * @return bool
	 */
	public function update_product($product_id, $product_data)
	{
		if (!$this->uid)
		{
			$auth_result = $this->authenticate();
			if (!$auth_result['success'])
			{
				throw new Exception('Authentification échouée');
			}
		}

		$url = $this->base_url . '/jsonrpc';
		$data = array(
			'jsonrpc' => '2.0',
			'method' => 'call',
			'params' => array(
				'service' => 'object',
				'method' => 'execute_kw',
				'args' => array(
					$this->database,
					$this->uid,
					$this->get_auth_token(),
					'product.template',
					'write',
					array(array($product_id), $product_data)
				)
			),
			'id' => 1
		);

		$response = $this->make_request($url, $data);
		
		if ($response && isset($response['result']))
		{
			return (bool)$response['result'];
		}
		
		throw new Exception('Erreur lors de la mise à jour du produit');
	}

	/**
	 * Recherche un produit par code ou code-barres
	 * @param string $code Code produit ou code-barres
	 * @return array|null
	 */
	public function find_product_by_code($code)
	{
		$domain = array(
			'|',
			array('default_code', '=', $code),
			array('barcode', '=', $code)
		);

		$products = $this->search_products($domain, 0, 1);
		return !empty($products) ? $products[0] : null;
	}

	/**
	 * Récupère les catégories de produits
	 * @return array
	 */
	public function get_product_categories()
	{
		if (!$this->uid)
		{
			$auth_result = $this->authenticate();
			if (!$auth_result['success'])
			{
				throw new Exception('Authentification échouée');
			}
		}

		$url = $this->base_url . '/jsonrpc';
		$data = array(
			'jsonrpc' => '2.0',
			'method' => 'call',
			'params' => array(
				'service' => 'object',
				'method' => 'execute_kw',
				'args' => array(
					$this->database,
					$this->uid,
					$this->get_auth_token(),
					'product.category',
					'search_read',
					array(array()),
					array('fields' => array('id', 'name', 'parent_id'))
				)
			),
			'id' => 1
		);

		$response = $this->make_request($url, $data);
		
		if ($response && isset($response['result']))
		{
			return $response['result'];
		}
		
		return array();
	}

	/**
	 * Traite un lot de produits
	 * @param array $products_data
	 * @return array Résultats du traitement
	 */
	public function batch_process_products($products_data)
	{
		$results = array(
			'created' => 0,
			'updated' => 0,
			'errors' => 0,
			'details' => array()
		);

		foreach ($products_data as $index => $product_data)
		{
			try {
				// Recherche d'un produit existant
				$existing_product = null;
				if (!empty($product_data['default_code']))
				{
					$existing_product = $this->find_product_by_code($product_data['default_code']);
				}
				elseif (!empty($product_data['barcode']))
				{
					$existing_product = $this->find_product_by_code($product_data['barcode']);
				}

				if ($existing_product)
				{
					// Mise à jour du produit existant
					$this->update_product($existing_product['id'], $product_data);
					$results['updated']++;
					$results['details'][] = array(
						'row' => $index + 1,
						'action' => 'updated',
						'product_id' => $existing_product['id'],
						'message' => 'Produit mis à jour: ' . $product_data['name']
					);
				}
				else
				{
					// Création d'un nouveau produit
					$product_id = $this->create_product($product_data);
					$results['created']++;
					$results['details'][] = array(
						'row' => $index + 1,
						'action' => 'created',
						'product_id' => $product_id,
						'message' => 'Produit créé: ' . $product_data['name']
					);
				}

			} catch (Exception $e) {
				$results['errors']++;
				$results['details'][] = array(
					'row' => $index + 1,
					'action' => 'error',
					'product_id' => null,
					'message' => 'Erreur: ' . $e->getMessage()
				);
			}
		}

		return $results;
	}

	/**
	 * Effectue une requête HTTP vers l'API Odoo
	 * @param string $url
	 * @param array $data
	 * @return array|null
	 */
	private function make_request($url, $data)
	{
		$json_data = json_encode($data);
		
		$options = array(
			'http' => array(
				'header' => "Content-Type: application/json\r\n",
				'method' => 'POST',
				'content' => $json_data,
				'timeout' => 30
			)
		);

		$context = stream_context_create($options);
		$response = @file_get_contents($url, false, $context);
		
		if ($response === false)
		{
			throw new Exception('Impossible de contacter le serveur Odoo');
		}

		$decoded_response = json_decode($response, true);
		
		if (json_last_error() !== JSON_ERROR_NONE)
		{
			throw new Exception('Réponse Odoo invalide');
		}

		// Vérification des erreurs Odoo
		if (isset($decoded_response['error']))
		{
			$error_message = 'Erreur Odoo: ';
			if (isset($decoded_response['error']['data']['message']))
			{
				$error_message .= $decoded_response['error']['data']['message'];
			}
			elseif (isset($decoded_response['error']['message']))
			{
				$error_message .= $decoded_response['error']['message'];
			}
			else
			{
				$error_message .= 'Erreur inconnue';
			}
			throw new Exception($error_message);
		}

		return $decoded_response;
	}

	/**
	 * Récupère le token d'authentification
	 * @return string
	 */
	private function get_auth_token()
	{
		// Utilisation de l'API key si disponible, sinon mot de passe
		return !empty($this->api_key) ? $this->api_key : $this->password;
	}

	/**
	 * Vérifie si la configuration Odoo est valide
	 * @return bool
	 */
	public function is_configured()
	{
		return !empty($this->base_url) && 
			   !empty($this->database) && 
			   !empty($this->username) && 
			   (!empty($this->password) || !empty($this->api_key));
	}
}
?>