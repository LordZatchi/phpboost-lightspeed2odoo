<?php
/**
 * @copyright   &copy; 2024
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL-3.0
 * @author      LordZatchi <zatchbell68@gmail.com>
 * @version     PHPBoost 6.0 - last update: 2024 12 20
 * @since       PHPBoost 6.0 - 2024 12 20
*/

class LightspeedtoOdooProcessController extends ModuleController
{
	private $lang;
	private $view;
	private $upload_id;
	private $upload_data;

	public function __construct()
	{
		$this->lang = LangLoader::get_all_langs('lightspeedto_odoo');
	}

	public function execute(HTTPRequestCustom $request)
	{
		$this->check_authorizations();
		
		$this->upload_id = $request->get_getint('id', 0);
		
		if ($this->upload_id)
		{
			$this->init_upload();
			
			$action = $request->get_getstring('action', '');
			switch ($action)
			{
				case 'start':
					return $this->start_processing($request);
				case 'ajax':
					return $this->ajax_processing($request);
				default:
					return $this->display_upload_details();
			}
		}
		else
		{
			return $this->display_uploads_list($request);
		}
	}

	private function check_authorizations()
	{
		if (!LightspeedtoOdooAuthorizationsService::check_authorizations()->write())
		{
			$error_controller = PHPBoostErrors::user_not_authorized();
			DispatchManager::redirect($error_controller);
		}
	}

	private function init_upload()
	{
		try {
			$this->upload_data = PersistenceContext::get_querier()->select_single_row(
				LightspeedtoOdooSetup::$lightspeedto_odoo_uploads_table . " u
				LEFT JOIN " . LightspeedtoOdooSetup::$lightspeedto_odoo_mappings_table . " m ON m.id = u.mapping_id
				LEFT JOIN " . DB_TABLE_MEMBER . " mb ON mb.user_id = u.user_id",
				array('u.*', 'm.name as mapping_name', 'm.mapping_data', 'mb.display_name'),
				'WHERE u.id = :id',
				array('id' => $this->upload_id)
			);
		} catch (RowNotFoundException $e) {
			$error_controller = PHPBoostErrors::unexisting_element();
			DispatchManager::redirect($error_controller);
		}
	}

	private function display_uploads_list(HTTPRequestCustom $request)
	{
		$page = $request->get_getint('page', 1);
		$per_page = 20;

		// Récupération du nombre total d'uploads
		$total_uploads = PersistenceContext::get_querier()->count(
			LightspeedtoOdooSetup::$lightspeedto_odoo_uploads_table,
			'WHERE 1=1'
		);

		// Pagination
		$pagination = new ModulePagination($page, $total_uploads, $per_page);
		$pagination->set_url(LightspeedtoOdooUrlBuilder::process('%d'));

		if ($pagination->current_page_is_empty() && $page > 1)
		{
			$error_controller = PHPBoostErrors::unexisting_page();
			DispatchManager::redirect($error_controller);
		}

		// Récupération des uploads avec pagination
		$result = PersistenceContext::get_querier()->select(
			"SELECT u.*, m.name as mapping_name, mb.display_name, mb.user_groups, mb.level
			FROM " . LightspeedtoOdooSetup::$lightspeedto_odoo_uploads_table . " u
			LEFT JOIN " . LightspeedtoOdooSetup::$lightspeedto_odoo_mappings_table . " m ON m.id = u.mapping_id
			LEFT JOIN " . DB_TABLE_MEMBER . " mb ON mb.user_id = u.user_id
			ORDER BY u.upload_date DESC
			LIMIT :number_items_per_page OFFSET :display_from",
			array(
				'number_items_per_page' => $pagination->get_number_items_per_page(),
				'display_from' => $pagination->get_display_from()
			)
		);

		$this->view = new FileTemplate('lightspeedto_odoo/lightspeedto_odoo_process.tpl');
		$this->view->add_lang($this->lang);

		$this->view->put_all(array(
			'C_UPLOADS' => $result->get_rows_count() > 0,
			'C_PAGINATION' => $pagination->has_several_pages(),
			'C_LIST_MODE' => true,

			'PAGINATION' => $pagination->display(),
			'TOTAL_UPLOADS' => $total_uploads,

			'U_UPLOAD' => LightspeedtoOdooUrlBuilder::upload()->rel()
		));

		while ($row = $result->fetch())
		{
			$upload_date = new Date($row['upload_date'], Timezone::SERVER_TIMEZONE);
			$processed_date = $row['processed_date'] ? new Date($row['processed_date'], Timezone::SERVER_TIMEZONE) : null;
			$user_group_color = User::get_group_color($row['user_groups'], $row['level']);

			// Calcul du pourcentage de progression
			$progress_percent = 0;
			if ($row['total_rows'] > 0)
			{
				$progress_percent = round(($row['processed_rows'] / $row['total_rows']) * 100, 1);
			}

			$this->view->assign_block_vars('uploads', array(
				'C_CAN_PROCESS' => $row['status'] == 'pending' || $row['status'] == 'paused',
				'C_IS_PROCESSING' => $row['status'] == 'processing',
				'C_IS_COMPLETED' => $row['status'] == 'completed',
				'C_HAS_ERRORS' => $row['status'] == 'error' || $row['error_count'] > 0,
				'C_HAS_MAPPING' => !empty($row['mapping_name']),
				'C_PROCESSED_DATE' => $processed_date !== null,
				'C_AUTHOR_EXISTS' => !empty($row['display_name']),
				'C_AUTHOR_GROUP_COLOR' => !empty($user_group_color),

				'ID' => $row['id'],
				'FILENAME' => $row['original_filename'],
				'FILE_SIZE' => NumberHelper::round($row['file_size'] / 1024, 1),
				'MAPPING_NAME' => $row['mapping_name'],
				'STATUS' => $row['status'],
				'STATUS_LABEL' => $this->get_status_label($row['status']),
				'PROCESSED_ROWS' => $row['processed_rows'],
				'TOTAL_ROWS' => $row['total_rows'],
				'ERROR_COUNT' => $row['error_count'],
				'PROGRESS_PERCENT' => $progress_percent,
				'UPLOAD_DATE' => $upload_date->format(Date::FORMAT_DAY_MONTH_YEAR_HOUR_MINUTE),
				'PROCESSED_DATE' => $processed_date ? $processed_date->format(Date::FORMAT_DAY_MONTH_YEAR_HOUR_MINUTE) : '',
				'AUTHOR_DISPLAY_NAME' => $row['display_name'],
				'AUTHOR_LEVEL_CLASS' => UserService::get_level_class($row['level']),
				'AUTHOR_GROUP_COLOR' => $user_group_color,

				'U_DETAILS' => LightspeedtoOdooUrlBuilder::process_upload($row['id'])->rel(),
				'U_PROCESS' => LightspeedtoOdooUrlBuilder::process_upload($row['id'], 'start')->rel(),
				'U_AUTHOR_PROFILE' => UserUrlBuilder::profile($row['user_id'])->rel(),
			));
		}
		$result->dispose();

		return $this->generate_response($this->lang['lightspeedto_odoo.process.title']);
	}

	private function display_upload_details()
	{
		$this->view = new FileTemplate('lightspeedto_odoo/lightspeedto_odoo_process_details.tpl');
		$this->view->add_lang($this->lang);

		$upload_date = new Date($this->upload_data['upload_date'], Timezone::SERVER_TIMEZONE);
		$processed_date = $this->upload_data['processed_date'] ? new Date($this->upload_data['processed_date'], Timezone::SERVER_TIMEZONE) : null;

		// Calcul du pourcentage de progression
		$progress_percent = 0;
		if ($this->upload_data['total_rows'] > 0)
		{
			$progress_percent = round(($this->upload_data['processed_rows'] / $this->upload_data['total_rows']) * 100, 1);
		}

		// Analyse des erreurs
		$errors = array();
		if (!empty($this->upload_data['errors_log']))
		{
			$errors = json_decode($this->upload_data['errors_log'], true);
			if (!is_array($errors)) $errors = array();
		}

		$this->view->put_all(array(
			'C_CAN_PROCESS' => $this->upload_data['status'] == 'pending' || $this->upload_data['status'] == 'paused',
			'C_IS_PROCESSING' => $this->upload_data['status'] == 'processing',
			'C_IS_COMPLETED' => $this->upload_data['status'] == 'completed',
			'C_HAS_ERRORS' => $this->upload_data['status'] == 'error' || $this->upload_data['error_count'] > 0,
			'C_HAS_MAPPING' => !empty($this->upload_data['mapping_name']),
			'C_PROCESSED_DATE' => $processed_date !== null,
			'C_HAS_ERROR_LOG' => !empty($errors),

			'ID' => $this->upload_data['id'],
			'FILENAME' => $this->upload_data['original_filename'],
			'FILE_SIZE' => NumberHelper::round($this->upload_data['file_size'] / 1024, 1),
			'MAPPING_NAME' => $this->upload_data['mapping_name'],
			'STATUS' => $this->upload_data['status'],
			'STATUS_LABEL' => $this->get_status_label($this->upload_data['status']),
			'PROCESSED_ROWS' => $this->upload_data['processed_rows'],
			'TOTAL_ROWS' => $this->upload_data['total_rows'],
			'ERROR_COUNT' => $this->upload_data['error_count'],
			'PROGRESS_PERCENT' => $progress_percent,
			'UPLOAD_DATE' => $upload_date->format(Date::FORMAT_DAY_MONTH_YEAR_HOUR_MINUTE),
			'PROCESSED_DATE' => $processed_date ? $processed_date->format(Date::FORMAT_DAY_MONTH_YEAR_HOUR_MINUTE) : '',
			'AUTHOR_DISPLAY_NAME' => $this->upload_data['display_name'],

			'U_PROCESS' => LightspeedtoOdooUrlBuilder::process_upload($this->upload_data['id'], 'start')->rel(),
			'U_BACK' => LightspeedtoOdooUrlBuilder::process()->rel(),
		));

		// Affichage des erreurs
		foreach ($errors as $error)
		{
			$this->view->assign_block_vars('errors', array(
				'ROW' => isset($error['row']) ? $error['row'] : '',
				'MESSAGE' => isset($error['message']) ? $error['message'] : '',
				'DATA' => isset($error['data']) ? json_encode($error['data']) : ''
			));
		}

		return $this->generate_response($this->lang['lightspeedto_odoo.process.details'] . ' - ' . $this->upload_data['original_filename']);
	}

	private function start_processing(HTTPRequestCustom $request)
	{
		// Vérification des prérequis
		if (empty($this->upload_data['mapping_id']))
		{
			AppContext::get_response()->redirect(LightspeedtoOdooUrlBuilder::process_upload($this->upload_id),
				$this->lang['lightspeedto_odoo.process.error.no_mapping']);
		}

		// Vérification de la configuration Odoo
		$config = LightspeedtoOdooConfig::load();
		if (!$config->is_odoo_configured())
		{
			AppContext::get_response()->redirect(LightspeedtoOdooUrlBuilder::process_upload($this->upload_id),
				$this->lang['lightspeedto_odoo.process.error.odoo_not_configured']);
		}

		// Mise à jour du statut en "processing"
		PersistenceContext::get_querier()->update(
			LightspeedtoOdooSetup::$lightspeedto_odoo_uploads_table,
			array(
				'status' => 'processing',
				'processed_date' => time()
			),
			'WHERE id = :id',
			array('id' => $this->upload_id)
		);

		// Page de traitement avec Ajax
		$this->view = new FileTemplate('lightspeedto_odoo/lightspeedto_odoo_process_ajax.tpl');
		$this->view->add_lang($this->lang);

		$this->view->put_all(array(
			'UPLOAD_ID' => $this->upload_id,
			'FILENAME' => $this->upload_data['original_filename'],
			'TOTAL_ROWS' => $this->upload_data['total_rows'],
			'U_AJAX_PROCESS' => LightspeedtoOdooUrlBuilder::process_upload($this->upload_id, 'ajax')->rel(),
			'U_DETAILS' => LightspeedtoOdooUrlBuilder::process_upload($this->upload_id)->rel()
		));

		return $this->generate_response($this->lang['lightspeedto_odoo.process.processing'] . ' - ' . $this->upload_data['original_filename']);
	}

	private function ajax_processing(HTTPRequestCustom $request)
	{
		// Retour AJAX pour le traitement par batch
		header('Content-Type: application/json');
		
		$batch_size = 10; // Traitement par batch de 10 éléments
		$current_batch = $request->get_getint('batch', 0);
		
		try {
			$processor = new CsvProcessorService();
			$result = $processor->process_batch($this->upload_id, $current_batch, $batch_size);
			
			echo json_encode($result);
		} catch (Exception $e) {
			echo json_encode(array(
				'success' => false,
				'error' => $e->getMessage(),
				'completed' => false
			));
		}
		
		// Sortie directe pour AJAX
		exit;
	}

	private function get_status_label($status)
	{
		$labels = array(
			'pending' => $this->lang['lightspeedto_odoo.status.pending'],
			'processing' => $this->lang['lightspeedto_odoo.status.processing'],
			'completed' => $this->lang['lightspeedto_odoo.status.completed'],
			'error' => $this->lang['lightspeedto_odoo.status.error'],
			'paused' => $this->lang['lightspeedto_odoo.status.paused']
		);

		return isset($labels[$status]) ? $labels[$status] : $status;
	}

	private function generate_response($page_title)
	{
		$response = new SiteDisplayResponse($this->view);
		$graphical_environment = $response->get_graphical_environment();

		$graphical_environment->set_page_title($page_title, $this->lang['lightspeedto_odoo.module.title']);
		$graphical_environment->get_seo_meta_data()->set_description($this->lang['lightspeedto_odoo.seo.description.process']);
		$graphical_environment->get_seo_meta_data()->set_canonical_url(
			$this->upload_id ? 
			LightspeedtoOdooUrlBuilder::process_upload($this->upload_id) : 
			LightspeedtoOdooUrlBuilder::process()
		);

		$breadcrumb = $graphical_environment->get_breadcrumb();
		$breadcrumb->add($this->lang['lightspeedto_odoo.module.title'], LightspeedtoOdooUrlBuilder::home());
		$breadcrumb->add($this->lang['lightspeedto_odoo.process.title'], LightspeedtoOdooUrlBuilder::process());
		
		if ($this->upload_id)
		{
			$breadcrumb->add($this->upload_data['original_filename'], '');
		}

		return $response;
	}
}
?>