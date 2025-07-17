<?php
/**
 * @copyright   &copy; 2025 LordZatchi
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL-3.0
 * @author      LordZatchi <zatchbell68@gmail.com>
 * @version     PHPBoost 6.0 - last update: 2025 01 16
 * @since       PHPBoost 6.0 - 2025 01 16
*/

class LightspeedtoOdooConfig extends AbstractConfigData
{
	const ODOO_URL = 'odoo_url';
	const ODOO_DB = 'odoo_db';
	const ODOO_USERNAME = 'odoo_username';
	const ODOO_PASSWORD = 'odoo_password';
	const ODOO_API_KEY = 'odoo_api_key';
	const DEFAULT_MAPPING_ID = 'default_mapping_id';
	const AUTO_DETECT_MAPPING = 'auto_detect_mapping';
	const AUTHORIZATIONS = 'authorizations';

	public function get_odoo_url()
	{
		return $this->get_property(self::ODOO_URL);
	}

	public function set_odoo_url($value)
	{
		$this->set_property(self::ODOO_URL, $value);
	}

	public function get_odoo_db()
	{
		return $this->get_property(self::ODOO_DB);
	}

	public function set_odoo_db($value)
	{
		$this->set_property(self::ODOO_DB, $value);
	}

	public function get_odoo_username()
	{
		return $this->get_property(self::ODOO_USERNAME);
	}

	public function set_odoo_username($value)
	{
		$this->set_property(self::ODOO_USERNAME, $value);
	}

	public function get_odoo_password()
	{
		return $this->get_property(self::ODOO_PASSWORD);
	}

	public function set_odoo_password($value)
	{
		$this->set_property(self::ODOO_PASSWORD, $value);
	}

	public function get_odoo_api_key()
	{
		return $this->get_property(self::ODOO_API_KEY);
	}

	public function set_odoo_api_key($value)
	{
		$this->set_property(self::ODOO_API_KEY, $value);
	}

	public function get_default_mapping_id()
	{
		return $this->get_property(self::DEFAULT_MAPPING_ID);
	}

	public function set_default_mapping_id($value)
	{
		$this->set_property(self::DEFAULT_MAPPING_ID, $value);
	}

	public function is_auto_detect_mapping_enabled()
	{
		return $this->get_property(self::AUTO_DETECT_MAPPING);
	}

	public function enable_auto_detect_mapping()
	{
		$this->set_property(self::AUTO_DETECT_MAPPING, true);
	}

	public function disable_auto_detect_mapping()
	{
		$this->set_property(self::AUTO_DETECT_MAPPING, false);
	}

	public function get_authorizations()
	{
		return $this->get_property(self::AUTHORIZATIONS);
	}

	public function set_authorizations(Array $array)
	{
		$this->set_property(self::AUTHORIZATIONS, $array);
	}

	public function get_default_values()
	{
		return array(
			self::ODOO_URL => '',
			self::ODOO_DB => '',
			self::ODOO_USERNAME => '',
			self::ODOO_PASSWORD => '',
			self::ODOO_API_KEY => '',
			self::DEFAULT_MAPPING_ID => 0,
			self::AUTO_DETECT_MAPPING => true,
			self::AUTHORIZATIONS => array('r-1' => 1, 'r0' => 3, 'r1' => 11)
		);
	}

	/**
	 * Returns the configuration.
	 * @return LightspeedtoOdooConfig
	 */
	public static function load()
	{
		return ConfigManager::load(__CLASS__, 'lightspeedto_odoo', 'config');
	}

	/**
	 * Saves the configuration in the database. Has it become persistent.
	 */
	public static function save()
	{
		ConfigManager::save('lightspeedto_odoo', self::load(), 'config');
	}
}
?>