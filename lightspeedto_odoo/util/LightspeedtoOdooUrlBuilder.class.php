<?php
/**
 * @copyright   &copy; 2024 LordZatchi
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL-3.0
 * @author      LordZatchi <zatchbell68@gmail.com>
 * @version     PHPBoost 6.0 - last update: 2024 01 01
 * @since       PHPBoost 6.0 - 2024 01 01
 */

class LightspeedtoOdooUrlBuilder
{
    private static $dispatcher = '/lightspeedto_odoo';

    /**
     * @return Url
     */
    public static function home()
    {
        return DispatchManager::get_url(self::$dispatcher, '/');
    }

    /**
     * @return Url
     */
    public static function admin_config()
    {
        return DispatchManager::get_url(self::$dispatcher, '/admin/config/');
    }

    /**
     * @return Url
     */
    public static function upload()
    {
        return DispatchManager::get_url(self::$dispatcher, '/upload/');
    }

    /**
     * @return Url
     */
    public static function mappings()
    {
        return DispatchManager::get_url(self::$dispatcher, '/mappings/');
    }

    /**
     * @return Url
     */
    public static function add_mapping()
    {
        return DispatchManager::get_url(self::$dispatcher, '/mappings/add/');
    }

    /**
     * @return Url
     */
    public static function edit_mapping($id)
    {
        return DispatchManager::get_url(self::$dispatcher, '/mappings/' . $id . '/edit/');
    }

    /**
     * @return Url
     */
    public static function delete_mapping($id)
    {
        return DispatchManager::get_url(self::$dispatcher, '/mappings/' . $id . '/delete/');
    }

    /**
     * @return Url
     */
    public static function process()
    {
        return DispatchManager::get_url(self::$dispatcher, '/process/');
    }

    /**
     * @return Url
     */
    public static function process_details($id)
    {
        return DispatchManager::get_url(self::$dispatcher, '/process/' . $id . '/');
    }

    /**
     * @return Url
     */
    public static function configuration()
    {
        return DispatchManager::get_url(self::$dispatcher, '/admin/config/');
    }
}
?>
