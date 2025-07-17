<?php
/**
 * @copyright   &copy; 2025 LordZatchi
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL-3.0
 * @author      LordZatchi <zatchbell68@gmail.com>
 * @version     PHPBoost 6.0 - last update: 2025 01 16
 * @since       PHPBoost 6.0 - 2025 01 16
*/

class LightspeedtoOdooHomeController extends ModuleController
{
	private $lang;
	private $view;

	public function execute(HTTPRequestCustom $request)
	{
		$this->check_authorizations();
		$this->init();
		$this->build_view();
		
		return $this->generate_response();
	}

	private function init()
	{
		$this->lang = LangLoader::get_all_langs('lightspeedto_odoo');
		$this->view = new FileTemplate('lightspeedto_odoo/lightspeedto_odoo_home.tpl');
		$this->view->add_lang($this->lang);
	}

	private function build_view()
	{
		$config = LightspeedtoOdooConfig::load();
		
		// Récupération des derniers uploads
		$recent_uploads = $this->get_recent_uploads();
		
		// Récupération des mappings disponibles
		$mappings = $this->get_available_mappings();
		
		// Statistiques
		$stats = $this->get_statistics();
		
		$this->view->put_all(array(
			'C_ODOO_CONFIGURED' => !empty($config->get_odoo_url()) && !empty($config->get_odoo_db()),
			'C_HAS_UPLOADS' => !empty($recent_uploads),
			'C_HAS_MAPPINGS' => !empty($mappings),
			
			'TOTAL_UPLOADS' => $stats['total_uploads'],
			'TOTAL_PROCESSED' => $stats['total_processed'],
			'TOTAL_ERRORS' => $stats['total_errors'],
			
			'U_UPLOAD' => LightspeedtoOdooUrlBuilder::upload()->rel(),
			'U_MAPPINGS' => LightspeedtoOdooUrlBuilder::mappings()->rel(),
			'U_CONFIG' => LightspeedtoOdooUrlBuilder::configuration()->rel(),
		));
		
		// Affichage des uploads récents
		foreach ($recent_uploads as $upload)
		{
			$this->view->assign_block_vars('recent_uploads', array(
				'ID' => $upload['id'],
				'FILENAME' => $upload['original_filename'],
				'STATUS' => $upload['status'],
				'UPLOAD_DATE' => $upload['upload_date'],
				'PROCESSED_ROWS' => $upload['processed_rows'],
				'TOTAL_ROWS' => $upload['total_rows'],
				'ERROR_COUNT' => $upload['error_count'],
			));
		}
		
		// Affichage des mappings
		foreach ($mappings as $mapping)
		{
			$this->view->assign_block_vars('mappings', array(
				'ID' => $mapping['id'],
				'NAME' => $mapping['name'],
				'DESCRIPTION' => $mapping['description'],
				'IS_DEFAULT' => $mapping['is_default'],
				'U_EDIT' => LightspeedtoOdooUrlBuilder::mapping_edit($mapping['id'])->rel(),
			));
		}
	}

	private function get_recent_uploads()
	{
		try {
			$result = PersistenceContext::get_querier()->select("
				SELECT * FROM " . LightspeedtoOdooSetup::$lightspeedto_odoo_uploads_table . "
				ORDER BY upload_date DESC
				LIMIT 5
			");
			
			$uploads = array();
			while ($row = $result->fetch())
			{
				$uploads[] = $row;
			}
			$result->dispose();
			
			return $uploads;
		} catch (Exception $e) {
			return array();
		}
	}

	private function get_available_mappings()
	{
		try {
			$result = PersistenceContext::get_querier()->select("
				SELECT * FROM " . LightspeedtoOdooSetup::$lightspeedto_odoo_mappings_table . "
				ORDER BY is_default DESC, name ASC
			");
			
			$mappings = array();
			while ($row = $result->fetch())
			{
				$mappings[] = $row;
			}
			$result->dispose();
			
			return $mappings;
		} catch (Exception $e) {
			return array();
		}
	}

	private function get_statistics()
	{
		try {
			$total_uploads = PersistenceContext::get_querier()->count(
				LightspeedtoOdooSetup::$lightspeedto_odoo_uploads_table
			);
			
			$total_processed = PersistenceContext::get_querier()->count(
				LightspeedtoOdooSetup::$lightspeedto_odoo_uploads_table,
				"WHERE status = 'completed' OR status = 'completed_with_errors'"
			);
			
			$total_errors = PersistenceContext::get_querier()->get_column_value(
				LightspeedtoOdooSetup::$lightspeedto_odoo_uploads_table,
				'SUM(error_count)',
				''
			);
			
			return array(
				'total_uploads' => $total_uploads,
				'total_processed' => $total_processed,
				'total_errors' => $total_errors ?: 0
			);
		} catch (Exception $e) {
			return array(
				'total_uploads' => 0,
				'total_processed' => 0,
				'total_errors' => 0
			);
		}
	}

	private function check_authorizations()
	{
		if (!LightspeedtoOdooAuthorizationsService::check_authorizations()->read())
		{
			$error_controller = PHPBoostErrors::user_not_authorized();
			DispatchManager::redirect($error_controller);
		}
	}

	private function generate_response()
	{
		$response = new SiteDisplayResponse($this->view);
		$graphical_environment = $response->get_graphical_environment();
		
		$graphical_environment->set_page_title($this->lang['lightspeedto_odoo.module.title']);
		$graphical_environment->get_seo_meta_data()->set_description($this->lang['lightspeedto_odoo.seo.description']);
		$graphical_environment->get_seo_meta_data()->set_canonical_url(LightspeedtoOdooUrlBuilder::home());

		$breadcrumb = $graphical_environment->get_breadcrumb();
		$breadcrumb->add($this->lang['lightspeedto_odoo.module.title'], LightspeedtoOdooUrlBuilder::home());

		return $response;
	}
}
?>