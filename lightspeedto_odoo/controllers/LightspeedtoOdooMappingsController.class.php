<?php
/**
 * @copyright   &copy; 2024
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL-3.0
 * @author      LordZatchi <zatchbell68@gmail.com>
 * @version     PHPBoost 6.0 - last update: 2024 12 20
 * @since       PHPBoost 6.0 - 2024 12 20
*/

class LightspeedtoOdooMappingsController extends ModuleController
{
	private $lang;
	private $view;

	public function __construct()
	{
		$this->lang = LangLoader::get_all_langs('lightspeedto_odoo');
	}

	public function execute(HTTPRequestCustom $request)
	{
		$this->check_authorizations();
		$this->init();
		$this->build_view($request);
		return $this->generate_response();
	}

	private function init()
	{
		$this->view = new FileTemplate('lightspeedto_odoo/lightspeedto_odoo_mappings.tpl');
		$this->view->add_lang($this->lang);
	}

	private function check_authorizations()
	{
		if (!LightspeedtoOdooAuthorizationsService::check_authorizations()->read())
		{
			$error_controller = PHPBoostErrors::user_not_authorized();
			DispatchManager::redirect($error_controller);
		}
	}

	private function build_view(HTTPRequestCustom $request)
	{
		$page = $request->get_getint('page', 1);
		$per_page = 20;

		// Récupération du nombre total de mappings
		$total_mappings = PersistenceContext::get_querier()->count(
			LightspeedtoOdooSetup::$lightspeedto_odoo_mappings_table,
			'WHERE 1=1'
		);

		// Pagination
		$pagination = new ModulePagination($page, $total_mappings, $per_page);
		$pagination->set_url(LightspeedtoOdooUrlBuilder::mappings('%d'));

		if ($pagination->current_page_is_empty() && $page > 1)
		{
			$error_controller = PHPBoostErrors::unexisting_page();
			DispatchManager::redirect($error_controller);
		}

		// Récupération des mappings avec pagination
		$result = PersistenceContext::get_querier()->select(
			"SELECT m.*, u.display_name, u.user_groups, u.level
			FROM " . LightspeedtoOdooSetup::$lightspeedto_odoo_mappings_table . " m
			LEFT JOIN " . DB_TABLE_MEMBER . " u ON u.user_id = m.user_id
			ORDER BY m.is_default DESC, m.name ASC
			LIMIT :number_items_per_page OFFSET :display_from",
			array(
				'number_items_per_page' => $pagination->get_number_items_per_page(),
				'display_from' => $pagination->get_display_from()
			)
		);

		$this->view->put_all(array(
			'C_MAPPINGS' => $result->get_rows_count() > 0,
			'C_PAGINATION' => $pagination->has_several_pages(),
			'C_CAN_ADD' => LightspeedtoOdooAuthorizationsService::check_authorizations()->write(),
			'C_CAN_MANAGE' => LightspeedtoOdooAuthorizationsService::check_authorizations()->manage(),

			'PAGINATION' => $pagination->display(),
			'TOTAL_MAPPINGS' => $total_mappings,

			'U_ADD_MAPPING' => LightspeedtoOdooUrlBuilder::mapping_form()->rel()
		));

		while ($row = $result->fetch())
		{
			$mapping_data = !empty($row['mapping_data']) ? json_decode($row['mapping_data'], true) : array();
			$fields_count = is_array($mapping_data) ? count($mapping_data) : 0;

			$user_group_color = User::get_group_color($row['user_groups'], $row['level']);
			$created_date = new Date($row['created_date'], Timezone::SERVER_TIMEZONE);
			$updated_date = new Date($row['updated_date'], Timezone::SERVER_TIMEZONE);

			$this->view->assign_block_vars('mappings', array(
				'C_IS_DEFAULT' => $row['is_default'],
				'C_HAS_DESCRIPTION' => !empty($row['description']),
				'C_CAN_EDIT' => LightspeedtoOdooAuthorizationsService::check_authorizations()->write() || 
							   (LightspeedtoOdooAuthorizationsService::check_authorizations()->contribution() && $row['user_id'] == AppContext::get_current_user()->get_id()),
				'C_CAN_DELETE' => LightspeedtoOdooAuthorizationsService::check_authorizations()->manage() || 
								  (LightspeedtoOdooAuthorizationsService::check_authorizations()->write() && $row['user_id'] == AppContext::get_current_user()->get_id()),
				'C_AUTHOR_EXISTS' => !empty($row['display_name']),
				'C_AUTHOR_GROUP_COLOR' => !empty($user_group_color),

				'ID' => $row['id'],
				'NAME' => $row['name'],
				'DESCRIPTION' => $row['description'],
				'FIELDS_COUNT' => $fields_count,
				'AUTHOR_DISPLAY_NAME' => $row['display_name'],
				'AUTHOR_LEVEL_CLASS' => UserService::get_level_class($row['level']),
				'AUTHOR_GROUP_COLOR' => $user_group_color,
				'CREATED_DATE' => $created_date->format(Date::FORMAT_DAY_MONTH_YEAR_HOUR_MINUTE),
				'UPDATED_DATE' => $updated_date->format(Date::FORMAT_DAY_MONTH_YEAR_HOUR_MINUTE),

				'U_EDIT' => LightspeedtoOdooUrlBuilder::mapping_form($row['id'])->rel(),
				'U_DELETE' => LightspeedtoOdooUrlBuilder::mapping_delete($row['id'])->rel(),
				'U_AUTHOR_PROFILE' => UserUrlBuilder::profile($row['user_id'])->rel(),
			));
		}
		$result->dispose();
	}

	private function generate_response()
	{
		$response = new SiteDisplayResponse($this->view);
		$graphical_environment = $response->get_graphical_environment();

		$graphical_environment->set_page_title($this->lang['lightspeedto_odoo.mappings.management'], $this->lang['lightspeedto_odoo.module.title']);
		$graphical_environment->get_seo_meta_data()->set_description($this->lang['lightspeedto_odoo.seo.description.mappings']);
		$graphical_environment->get_seo_meta_data()->set_canonical_url(LightspeedtoOdooUrlBuilder::mappings());

		$breadcrumb = $graphical_environment->get_breadcrumb();
		$breadcrumb->add($this->lang['lightspeedto_odoo.module.title'], LightspeedtoOdooUrlBuilder::home());
		$breadcrumb->add($this->lang['lightspeedto_odoo.mappings.management'], LightspeedtoOdooUrlBuilder::mappings());

		return $response;
	}
}
?>