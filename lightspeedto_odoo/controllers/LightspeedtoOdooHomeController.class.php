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
		$this->lang = LangLoader::get('lightspeedto_odoo');
		$this->view = new FileTemplate('lightspeedto_odoo/lightspeedto_odoo_home.tpl');
		$this->view->add_lang($this->lang);
	}

	private function build_view()
	{
		// Chargement de la configuration (avec gestion des erreurs)
		try {
			$config = LightspeedtoOdooConfig::load();
		} catch (Exception $e) {
			$config = null;
		}
		
		// Récupération des derniers uploads
		$recent_uploads = $this->get_recent_uploads();
		
		// Récupération des mappings disponibles
		$mappings = $this->get_available_mappings();
		
		// Statistiques
		$stats = $this->get_statistics();
		
		$this->view->put_all(array(
			'C_ODOO_CONFIGURED' => $config && !empty($config->get_odoo_url()) && !empty($config->get_odoo_db()),
			'C_HAS_UPLOADS' => !empty($recent_uploads),
			'C_HAS_MAPPINGS' => !empty($mappings),
			'C_RECENT_UPLOADS' => !empty($recent_uploads),
			'C_CAN_UPLOAD' => LightspeedtoOdooAuthorizationsService::check_authorizations()->write(),
			'C_CAN_ADD_MAPPING' => LightspeedtoOdooAuthorizationsService::check_authorizations()->write(),
			'C_CAN_ADMIN' => LightspeedtoOdooAuthorizationsService::check_authorizations()->admin(),
			
			'TOTAL_UPLOADS' => $stats['total_uploads'],
			'TOTAL_PROCESSED_ROWS' => $stats['total_processed_rows'],
			'TOTAL_MAPPINGS' => $stats['total_mappings'],
			'PENDING_UPLOADS' => $stats['pending_uploads'],
			
			'U_UPLOAD' => LightspeedtoOdooUrlBuilder::upload()->rel(),
			'U_MAPPINGS' => LightspeedtoOdooUrlBuilder::mappings()->rel(),
			'U_ADD_MAPPING' => LightspeedtoOdooUrlBuilder::mapping_form()->rel(),
			'U_ALL_UPLOADS' => LightspeedtoOdooUrlBuilder::process()->rel(),
			'U_ADMIN_CONFIG' => LightspeedtoOdooAuthorizationsService::check_authorizations()->admin() ? 
				LightspeedtoOdooUrlBuilder::admin_config()->rel() : '',
		));
		
		// Affichage des uploads récents
		foreach ($recent_uploads as $upload)
		{
			$this->view->assign_block_vars('recent_uploads', array(
				'ID' => $upload['id'],
				'FILENAME' => $upload['original_filename'],
				'STATUS_CLASS' => $this->get_status_css_class($upload['status']),
				'STATUS_LABEL' => $this->get_status_label($upload['status']),
				'UPLOAD_DATE' => $this->format_date($upload['upload_date']),
				'PROCESSED_ROWS' => $upload['processed_rows'] ?: 0,
				'TOTAL_ROWS' => $upload['total_rows'] ?: 0,
				'PROGRESS_PERCENT' => $upload['total_rows'] > 0 ? 
					round(($upload['processed_rows'] / $upload['total_rows']) * 100, 1) : 0,
				'ERROR_COUNT' => $upload['error_count'] ?: 0,
				'C_HAS_MAPPING' => !empty($upload['mapping_id']),
				'MAPPING_NAME' => $upload['mapping_name'] ?: '',
				'C_CAN_PROCESS' => $upload['status'] == 'pending',
				'U_DETAILS' => LightspeedtoOdooUrlBuilder::process_upload($upload['id'])->rel(),
				'U_PROCESS' => LightspeedtoOdooUrlBuilder::process_upload($upload['id'], 'start')->rel(),
			));
		}
	}

	private function get_recent_uploads()
	{
		try {
			$result = PersistenceContext::get_querier()->select("
				SELECT u.*, m.name as mapping_name
				FROM " . LightspeedtoOdooSetup::$lightspeedto_odoo_uploads_table . " u
				LEFT JOIN " . LightspeedtoOdooSetup::$lightspeedto_odoo_mappings_table . " m ON m.id = u.mapping_id
				ORDER BY u.upload_date DESC
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
				LIMIT 5
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
			
			$pending_uploads = PersistenceContext::get_querier()->count(
				LightspeedtoOdooSetup::$lightspeedto_odoo_uploads_table,
				"WHERE status = 'pending'"
			);
			
			$total_mappings = PersistenceContext::get_querier()->count(
				LightspeedtoOdooSetup::$lightspeedto_odoo_mappings_table
			);
			
			$total_processed_rows = PersistenceContext::get_querier()->get_column_value(
				LightspeedtoOdooSetup::$lightspeedto_odoo_uploads_table,
				'SUM(processed_rows)',
				''
			);
			
			return array(
				'total_uploads' => $total_uploads,
				'pending_uploads' => $pending_uploads,
				'total_mappings' => $total_mappings,
				'total_processed_rows' => $total_processed_rows ?: 0
			);
		} catch (Exception $e) {
			return array(
				'total_uploads' => 0,
				'pending_uploads' => 0,
				'total_mappings' => 0,
				'total_processed_rows' => 0
			);
		}
	}

	private function get_status_label($status)
	{
		$labels = array(
			'pending' => $this->lang['lightspeedto_odoo.status.pending'],
			'processing' => $this->lang['lightspeedto_odoo.status.processing'],
			'completed' => $this->lang['lightspeedto_odoo.status.completed'],
			'failed' => $this->lang['lightspeedto_odoo.status.failed'],
			'error' => $this->lang['lightspeedto_odoo.status.error'],
			'cancelled' => $this->lang['lightspeedto_odoo.status.cancelled'],
			'paused' => $this->lang['lightspeedto_odoo.status.paused']
		);

		return isset($labels[$status]) ? $labels[$status] : $status;
	}

	private function get_status_css_class($status)
	{
		$classes = array(
			'pending' => 'notice',
			'processing' => 'notice',
			'completed' => 'success',
			'failed' => 'error',
			'error' => 'error',
			'cancelled' => 'warning',
			'paused' => 'warning'
		);

		return isset($classes[$status]) ? $classes[$status] : '';
	}

	private function format_date($timestamp)
	{
		if (empty($timestamp)) return '';
		
		$date = new Date($timestamp, Timezone::SERVER_TIMEZONE);
		return $date->format(Date::FORMAT_DAY_MONTH_YEAR_HOUR_MINUTE);
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