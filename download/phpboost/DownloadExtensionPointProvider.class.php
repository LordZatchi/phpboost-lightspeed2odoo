<?php
/**
 * @copyright   &copy; 2005-2024 PHPBoost
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL-3.0
 * @author      Julien BRISWALTER <j1.seth@phpboost.com>
 * @version     PHPBoost 6.0 - last update: 2023 01 16
 * @since       PHPBoost 4.0 - 2014 08 24
 * @contributor Kevin MASSY <reidlos@phpboost.com>
 * @contributor Arnaud GENET <elenwii@phpboost.com>
 * @contributor xela <xela@phpboost.com>
 * @contributor Sebastien LARTIGUE <babsolune@phpboost.com>
*/

class DownloadExtensionPointProvider extends ItemsModuleExtensionPointProvider
{
	public function comments()
	{
		return new CommentsTopics(array(new DownloadCommentsTopic()));
	}
	
	public function home_page()
	{
		return new DefaultHomePageDisplay($this->get_id(), DownloadCategoryController::get_view());
	}
}
?>
