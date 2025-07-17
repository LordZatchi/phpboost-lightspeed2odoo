<?php
/**
 * @copyright   &copy; 2025 LordZatchi
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL-3.0
 * @author      LordZatchi <zatchbell68@gmail.com>
 * @version     PHPBoost 6.0 - last update: 2025 01 16
 * @since       PHPBoost 6.0 - 2025 01 16
*/

class LightspeedtoOdooAdminConfigController extends AdminModuleController
{
	private $lang;
	private $form;
	private $submit_button;

	public function execute(HTTPRequestCustom $request)
	{
		$this->init();
		$this->build_form();
		
		if ($this->submit_button->has_been_submited() && $this->form->validate())
		{
			$this->save_config();
			$this->form->get_field_by_id('odoo_password')->set_hidden();
			AppContext::get_response()->redirect(LightspeedtoOdooUrlBuilder::configuration(), LangLoader::get_message('warning.success.config', 'warning-lang'));
		}

		$this->view->put('CONTENT', $this->form->display());

		return new AdminLightspeedtoOdooDisplayResponse($this->view, $this->lang['lightspeedto_odoo.config.module.title']);
	}

	private function init()
	{
		$this->lang = LangLoader::get_all_langs('lightspeedto_odoo');
	}

	private function build_form()
	{
		$form = new HTMLForm(__CLASS__);
		$form->set_layout_title($this->lang['lightspeedto_odoo.config.module.title']);

		$config = LightspeedtoOdooConfig::load();

		// Configuration Odoo
		$fieldset = new FormFieldsetHTML('odoo_config', $this->lang['lightspeedto_odoo.config.odoo.settings']);
		$form->add_fieldset($fieldset);

		$fieldset->add_field(new FormFieldTextEditor('odoo_url', $this->lang['lightspeedto_odoo.config.odoo.url'], $config->get_odoo_url(),
			array('description' => $this->lang['lightspeedto_odoo.config.odoo.url.clue'], 'required' => true)
		));

		$fieldset->add_field(new FormFieldTextEditor('odoo_db', $this->lang['lightspeedto_odoo.config.odoo.db'], $config->get_odoo_db(),
			array('description' => $this->lang['lightspeedto_odoo.config.odoo.db.clue'], 'required' => true)
		));

		$fieldset->add_field(new FormFieldTextEditor('odoo_username', $this->lang['lightspeedto_odoo.config.odoo.username'], $config->get_odoo_username(),
			array('description' => $this->lang['lightspeedto_odoo.config.odoo.username.clue'], 'required' => true)
		));

		$fieldset->add_field(new FormFieldPasswordEditor('odoo_password', $this->lang['lightspeedto_odoo.config.odoo.password'], $config->get_odoo_password(),
			array('description' => $this->lang['lightspeedto_odoo.config.odoo.password.clue'], 'required' => true)
		));

		$fieldset->add_field(new FormFieldTextEditor('odoo_api_key', $this->lang['lightspeedto_odoo.config.odoo.api_key'], $config->get_odoo_api_key(),
			array('description' => $this->lang['lightspeedto_odoo.config.odoo.api_key.clue'])
		));

		// Configuration du mapping
		$fieldset = new FormFieldsetHTML('mapping_config', $this->lang['lightspeedto_odoo.config.mapping.settings']);
		$form->add_fieldset($fieldset);

		$fieldset->add_field(new FormFieldNumberEditor('default_mapping_id', $this->lang['lightspeedto_odoo.config.default_mapping'], $config->get_default_mapping_id(),
			array('description' => $this->lang['lightspeedto_odoo.config.default_mapping.clue'], 'min' => 0)
		));

		$fieldset->add_field(new FormFieldCheckbox('auto_detect_mapping', $this->lang['lightspeedto_odoo.config.auto_detect_mapping'], $config->is_auto_detect_mapping_enabled(),
			array('description' => $this->lang['lightspeedto_odoo.config.auto_detect_mapping.clue'])
		));

		// Autorisations
		$fieldset = new FormFieldsetHTML('authorizations', $this->lang['form.authorizations']);
		$form->add_fieldset($fieldset);

		$auth_settings = new AuthorizationsSettings(array(
			new ActionAuthorization($this->lang['lightspeedto_odoo.authorizations.read'], LightspeedtoOdooAuthorizationsService::READ_AUTHORIZATIONS),
			new ActionAuthorization($this->lang['lightspeedto_odoo.authorizations.write'], LightspeedtoOdooAuthorizationsService::WRITE_AUTHORIZATIONS),
			new ActionAuthorization($this->lang['lightspeedto_odoo.authorizations.moderation'], LightspeedtoOdooAuthorizationsService::MODERATION_AUTHORIZATIONS),
			new ActionAuthorization($this->lang['lightspeedto_odoo.authorizations.admin'], LightspeedtoOdooAuthorizationsService::ADMIN_AUTHORIZATIONS),
		));

		$fieldset->add_field(new FormFieldAuthorizationsUser('authorizations', $this->lang['form.authorizations'], $auth_settings, $config->get_authorizations()));

		// Test de connexion
		$fieldset = new FormFieldsetHTML('test_connection', $this->lang['lightspeedto_odoo.config.test.connection']);
		$form->add_fieldset($fieldset);

		$fieldset->add_field(new FormFieldFree('test_button', $this->lang['lightspeedto_odoo.config.test.button'], 
			'<button type="button" class="button submit" onclick="testOdooConnection()">' . $this->lang['lightspeedto_odoo.config.test.button'] . '</button>
			<div id="test-result" style="margin-top: 10px;"></div>'
		));

		$this->submit_button = new FormButtonDefaultSubmit();
		$form->add_button($this->submit_button);
		$form->add_button(new FormButtonReset());

		$this->form = $form;
	}

	private function save_config()
	{
		$config = LightspeedtoOdooConfig::load();

		$config->set_odoo_url($this->form->get_value('odoo_url'));
		$config->set_odoo_db($this->form->get_value('odoo_db'));
		$config->set_odoo_username($this->form->get_value('odoo_username'));
		$config->set_odoo_password($this->form->get_value('odoo_password'));
		$config->set_odoo_api_key($this->form->get_value('odoo_api_key'));
		$config->set_default_mapping_id($this->form->get_value('default_mapping_id'));
		
		if ($this->form->get_value('auto_detect_mapping'))
			$config->enable_auto_detect_mapping();
		else
			$config->disable_auto_detect_mapping();

		$config->set_authorizations($this->form->get_value('authorizations')->build_auth_array());

		LightspeedtoOdooConfig::save();

		HooksService::execute_hook_action('edit_config', 'lightspeedto_odoo', array(
			'title' => StringVars::replace_vars($this->lang['form.module.title'], 
				array('module_name' => $this->lang['lightspeedto_odoo.module.title'])), 
			'url' => LightspeedtoOdooUrlBuilder::configuration()->rel()
		));
	}
}

class AdminLightspeedtoOdooDisplayResponse extends AdminMenuDisplayResponse
{
	public function __construct($view, $page_title)
	{
		parent::__construct($view);

		$lang = LangLoader::get_all_langs('lightspeedto_odoo');

		$this->add_link($lang['lightspeedto_odoo.module.title'], LightspeedtoOdooUrlBuilder::home());
		$this->add_link($lang['lightspeedto_odoo.config.title'], LightspeedtoOdooUrlBuilder::configuration());
		$this->add_link($lang['lightspeedto_odoo.mappings.title'], LightspeedtoOdooUrlBuilder::mappings());

		$this->get_graphical_environment()->set_page_title($page_title);
	}
}
?>