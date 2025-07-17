<?php
/**
 * @copyright   &copy; 2024 LordZatchi
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL-3.0
 * @author      LordZatchi <zatchbell68@gmail.com>
 * @version     PHPBoost 6.0 - last update: 2024 01 01
 * @since       PHPBoost 6.0 - 2024 01 01
 */

class LightspeedtoOdooExtensionPointProvider extends ExtensionPointProvider
{
    public function __construct()
    {
        parent::__construct('lightspeedto_odoo');
    }

    public function css_files()
    {
        $module_css_files = new ModuleCssFiles();
        $module_css_files->adding_running_module_displayed_file('lightspeedto_odoo.css');
        return $module_css_files;
    }

    public function home_page()
    {
        return new DefaultHomePageDisplay($this->get_id(), LightspeedtoOdooHomeController::get_view());
    }

    public function tree_links()
    {
        return new LightspeedtoOdooTreeLinks();
    }

    public function url_mappings()
    {
        return new UrlMappings(array(new DispatcherUrlMapping('/lightspeedto_odoo/index.php')));
    }
}

/**
 * Liens dans l'arbre d'administration
 */
class LightspeedtoOdooTreeLinks implements ModuleTreeLinksExtensionPoint
{
    public function get_actions_tree_links()
    {
        $lang = LangLoader::get_all_langs('lightspeedto_odoo');
        $tree = new ModuleTreeLinks();

        // Liens utilisateur
        $tree->add_link(new ModuleLink(
            $lang['lightspeedto_odoo.upload'], 
            LightspeedtoOdooUrlBuilder::upload(), 
            LightspeedtoOdooAuthorizationsService::check_authorizations()->write()
        ));

        $tree->add_link(new ModuleLink(
            $lang['lightspeedto_odoo.mappings'], 
            LightspeedtoOdooUrlBuilder::mappings(), 
            LightspeedtoOdooAuthorizationsService::check_authorizations()->read()
        ));

        $tree->add_link(new ModuleLink(
            $lang['lightspeedto_odoo.process'], 
            LightspeedtoOdooUrlBuilder::process(), 
            LightspeedtoOdooAuthorizationsService::check_authorizations()->write()
        ));

        // Liens administration
        $tree->add_link(new AdminModuleLink(
            $lang['lightspeedto_odoo.admin.config'], 
            LightspeedtoOdooUrlBuilder::admin_config()
        ));

        return $tree;
    }
}
?>
