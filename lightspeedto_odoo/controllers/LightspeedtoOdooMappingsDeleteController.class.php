<?php
/**
 * @copyright   &copy; 2024
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL-3.0
 * @author      LordZatchi <zatchbell68@gmail.com>
 * @version     PHPBoost 6.0 - last update: 2024 12 20
 * @since       PHPBoost 6.0 - 2024 12 20
*/

class LightspeedtoOdooMappingDeleteController extends ModuleController
{
	private $lang;
	private $mapping;

	public function __construct()
	{
		$this->lang = LangLoader::get_all_langs('lightspeedto_odoo');
	}

	public function execute(HTTPRequestCustom $request)
	{
		$id = $request->get_getint('id', 0);
		
		$this->check_authorizations($id);
		$this->init($id);
		
		if ($request->get_string('token', '') === AppContext::get_session()->get_token())
		{
			$this->delete_mapping($id);
			$this->redirect_response();
		}
		else
		{
			return $this->build_delete_confirmation($request);
		}
	}

	private function init($id)
	{
		if (empty($id))
		{
			$error_controller = PHPBoostErrors::unexisting_element();
			DispatchManager::redirect($error_controller);
		}

		try {
			$this->mapping = PersistenceContext::get_querier()->select_single_row(
				LightspeedtoOdooSetup::$lightspeedto_odoo_mappings_table,
				array('*'),
				'WHERE id = :id',
				array('id' => $id)
			);
		} catch (RowNotFoundException $e) {
			$error_controller = PHPBoostErrors::unexisting_element();
			DispatchManager::redirect($error_controller);
		}
	}

	private function check_authorizations($id)
	{
		if (!LightspeedtoOdooAuthorizationsService::check_authorizations()->manage())
		{
			// Vérification si l'utilisateur peut supprimer ses propres mappings
			if (!LightspeedtoOdooAuthorizationsService::check_authorizations()->write())
			{
				$error_controller = PHPBoostErrors::user_not_authorized();
				DispatchManager::redirect($error_controller);
			}

			// Vérification que c'est bien son mapping
			try {
				$mapping_user_id = PersistenceContext::get_querier()->get_column_value(
					LightspeedtoOdooSetup::$lightspeedto_odoo_mappings_table,
					'user_id',
					'WHERE id = :id',
					array('id' => $id)
				);
				
				if ($mapping_user_id != AppContext::get_current_user()->get_id())
				{
					$error_controller = PHPBoostErrors::user_not_authorized();
					DispatchManager::redirect($error_controller);
				}
			} catch (RowNotFoundException $e) {
				$error_controller = PHPBoostErrors::unexisting_element();
				DispatchManager::redirect($error_controller);
			}
		}
	}

	private function build_delete_confirmation(HTTPRequestCustom $request)
	{
		$view = new FileTemplate('framework/content/deletion/delete_confirmation.tpl');
		$view->add_lang(LangLoader::get_all_langs());

		// Vérification si le mapping est utilisé dans des uploads
		$uploads_using_mapping = PersistenceContext::get_querier()->count(
			LightspeedtoOdooSetup::$lightspeedto_odoo_uploads_table,
			'WHERE mapping_id = :mapping_id',
			array('mapping_id' => $this->mapping['id'])
		);

		$additional_warning = '';
		if ($uploads_using_mapping > 0)
		{
			$additional_warning = '<div class="message-helper bgc warning">' . 
				StringVars::replace_vars($this->lang['lightspeedto_odoo.mapping.delete.warning.uploads'], 
				array('count' => $uploads_using_mapping)) . '</div>';
		}

		if ($this->mapping['is_default'])
		{
			$additional_warning .= '<div class="message-helper bgc notice">' . 
				$this->lang['lightspeedto_odoo.mapping.delete.warning.default'] . '</div>';
		}

		$view->put_all(array(
			'C_DELETION_CONFIRMATION_MESSAGE' => true,
			'DELETION_CONFIRMATION_MESSAGE' => StringVars::replace_vars($this->lang['lightspeedto_odoo.mapping.delete.confirmation'], 
				array('name' => $this->mapping['name'])),
			'ADDITIONAL_WARNING' => $additional_warning,
			'U_DELETE' => LightspeedtoOdooUrlBuilder::mapping_delete($this->mapping['id'], true)->rel(),
			'U_CANCEL' => LightspeedtoOdooUrlBuilder::mappings()->rel()
		));

		$response = new SiteDisplayResponse($view);
		$graphical_environment = $response->get_graphical_environment();

		$graphical_environment->set_page_title($this->lang['lightspeedto_odoo.mapping.delete'], $this->lang['lightspeedto_odoo.module.title']);
		$graphical_environment->get_seo_meta_data()->set_canonical_url(LightspeedtoOdooUrlBuilder::mapping_delete($this->mapping['id']));

		$breadcrumb = $graphical_environment->get_breadcrumb();
		$breadcrumb->add($this->lang['lightspeedto_odoo.module.title'], LightspeedtoOdooUrlBuilder::home());
		$breadcrumb->add($this->lang['lightspeedto_odoo.mappings.management'], LightspeedtoOdooUrlBuilder::mappings());
		$breadcrumb->add($this->lang['lightspeedto_odoo.mapping.delete'], '');

		return $response;
	}

	private function delete_mapping($id)
	{
		// Vérification finale des autorisations
		$this->check_authorizations($id);

		// Suppression du mapping
		PersistenceContext::get_querier()->delete(
			LightspeedtoOdooSetup::$lightspeedto_odoo_mappings_table,
			'WHERE id = :id',
			array('id' => $id)
		);

		// Mise à jour des uploads qui utilisaient ce mapping (les mettre à NULL)
		PersistenceContext::get_querier()->update(
			LightspeedtoOdooSetup::$lightspeedto_odoo_uploads_table,
			array('mapping_id' => null),
			'WHERE mapping_id = :mapping_id',
			array('mapping_id' => $id)
		);

		// Hook de suppression
		HooksService::execute_hook_action('delete', 'lightspeedto_odoo', array(
			'id' => $id,
			'title' => $this->mapping['name']
		));
	}

	private function redirect_response()
	{
		AppContext::get_response()->redirect(LightspeedtoOdooUrlBuilder::mappings(), 
			LangLoader::get_message('warning.process.success', 'warning-lang'));
	}
}
?>