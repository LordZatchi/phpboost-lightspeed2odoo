<?php
/**
 * @copyright   &copy; 2025 LordZatchi
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL-3.0
 * @author      LordZatchi <zatchbell68@gmail.com>
 * @version     PHPBoost 6.0 - last update: 2025 01 16
 * @since       PHPBoost 6.0 - 2025 01 16
*/

class LightspeedtoOdooAuthorizationsService
{
	const READ_AUTHORIZATIONS = 1;
	const WRITE_AUTHORIZATIONS = 2;
	const MODERATION_AUTHORIZATIONS = 4;
	const ADMIN_AUTHORIZATIONS = 8;

	public static function check_authorizations()
	{
		$config = LightspeedtoOdooConfig::load();
		$authorizations = $config->get_authorizations();
		
		return new LightspeedtoOdooAuthorizations($authorizations);
	}
}

class LightspeedtoOdooAuthorizations
{
	private $authorizations;

	public function __construct($authorizations)
	{
		$this->authorizations = $authorizations;
	}

	public function read()
	{
		return AppContext::get_current_user()->check_auth($this->authorizations, LightspeedtoOdooAuthorizationsService::READ_AUTHORIZATIONS);
	}

	public function write()
	{
		return AppContext::get_current_user()->check_auth($this->authorizations, LightspeedtoOdooAuthorizationsService::WRITE_AUTHORIZATIONS);
	}

	public function moderation()
	{
		return AppContext::get_current_user()->check_auth($this->authorizations, LightspeedtoOdooAuthorizationsService::MODERATION_AUTHORIZATIONS);
	}

	public function admin()
	{
		return AppContext::get_current_user()->check_auth($this->authorizations, LightspeedtoOdooAuthorizationsService::ADMIN_AUTHORIZATIONS);
	}
}
?>