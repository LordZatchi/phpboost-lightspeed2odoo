<?php
/**
 * @copyright   &copy; 2005-2024 PHPBoost
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL-3.0
 * @author      Julien BRISWALTER <j1.seth@phpboost.com>
 * @version     PHPBoost 6.0 - last update: 2021 06 18
 * @since       PHPBoost 4.1 - 2015 02 10
 * @contributor xela <xela@phpboost.com>
 * @contributor Sebastien LARTIGUE <babsolune@phpboost.com>
*/

class AdminGalleryDisplayResponse extends AdminMenuDisplayResponse
{
	public function __construct($view, $page_title)
	{
		parent::__construct($view);

		$lang = LangLoader::get_all_langs('gallery');

		$this->add_link($lang['gallery.management'], GalleryUrlBuilder::manage());
		$this->add_link($lang['gallery.actions.add'], GalleryUrlBuilder::admin_add());
		$this->add_link($lang['form.configuration'], $this->module->get_configuration()->get_admin_main_page());
		$this->add_link($lang['form.documentation'], $this->module->get_configuration()->get_documentation());

		$this->get_graphical_environment()->set_page_title($page_title);
	}
}
?>
