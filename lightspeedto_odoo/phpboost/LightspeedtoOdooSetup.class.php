<?php
/**
 * @copyright   &copy; 2024 LordZatchi
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL-3.0
 * @author      LordZatchi <zatchbell68@gmail.com>
 * @version     PHPBoost 6.0 - last update: 2024 01 01
 * @since       PHPBoost 6.0 - 2024 01 01
 */

class LightspeedtoOdooSetup extends DefaultModuleSetup
{
    private $messages;
    public static $lightspeedto_odoo_mappings_table;
    public static $lightspeedto_odoo_uploads_table;

    public static function __static()
    {
        self::$lightspeedto_odoo_mappings_table = PREFIX . 'lightspeedto_odoo_mappings';
        self::$lightspeedto_odoo_uploads_table = PREFIX . 'lightspeedto_odoo_uploads';
    }

    public function install()
    {
        $this->drop_tables();
        $this->create_tables();
        $this->insert_data();
    }

    public function uninstall()
    {
        $this->drop_tables();
        ConfigManager::delete('lightspeedto_odoo', 'config');
    }

    private function drop_tables()
    {
        PersistenceContext::get_dbms_utils()->drop(array(self::$lightspeedto_odoo_mappings_table, self::$lightspeedto_odoo_uploads_table));
    }

    private function create_tables()
    {
        $this->create_mappings_table();
        $this->create_uploads_table();
    }

    private function create_mappings_table()
    {
        $fields = array(
            'id' => array('type' => 'integer', 'length' => 11, 'autoincrement' => true, 'notnull' => 1),
            'name' => array('type' => 'string', 'length' => 255, 'notnull' => 1),
            'description' => array('type' => 'string', 'length' => 500, 'default' => "''"),
            'mapping_data' => array('type' => 'text', 'notnull' => 1),
            'is_default' => array('type' => 'boolean', 'notnull' => 1, 'default' => 0),
            'created_date' => array('type' => 'integer', 'length' => 11, 'notnull' => 1, 'default' => 0),
            'updated_date' => array('type' => 'integer', 'length' => 11, 'notnull' => 1, 'default' => 0),
            'user_id' => array('type' => 'integer', 'length' => 11, 'notnull' => 1, 'default' => 0)
        );
        $options = array(
            'primary' => array('id'),
            'indexes' => array(
                'user_id' => array('type' => 'key', 'fields' => 'user_id'),
                'is_default' => array('type' => 'key', 'fields' => 'is_default')
            )
        );
        PersistenceContext::get_dbms_utils()->create_table(self::$lightspeedto_odoo_mappings_table, $fields, $options);
    }

    private function create_uploads_table()
    {
        $fields = array(
            'id' => array('type' => 'integer', 'length' => 11, 'autoincrement' => true, 'notnull' => 1),
            'filename' => array('type' => 'string', 'length' => 255, 'notnull' => 1),
            'original_filename' => array('type' => 'string', 'length' => 255, 'notnull' => 1),
            'file_path' => array('type' => 'string', 'length' => 500, 'notnull' => 1),
            'file_size' => array('type' => 'integer', 'length' => 11, 'notnull' => 1, 'default' => 0),
            'mapping_id' => array('type' => 'integer', 'length' => 11, 'notnull' => 1, 'default' => 0),
            'status' => array('type' => 'string', 'length' => 50, 'default' => "'pending'"),
            'processed_rows' => array('type' => 'integer', 'length' => 11, 'notnull' => 1, 'default' => 0),
            'total_rows' => array('type' => 'integer', 'length' => 11, 'notnull' => 1, 'default' => 0),
            'error_count' => array('type' => 'integer', 'length' => 11, 'notnull' => 1, 'default' => 0),
            'errors_log' => array('type' => 'text', 'default' => "''"),
            'upload_date' => array('type' => 'integer', 'length' => 11, 'notnull' => 1, 'default' => 0),
            'processed_date' => array('type' => 'integer', 'length' => 11, 'default' => 0),
            'user_id' => array('type' => 'integer', 'length' => 11, 'notnull' => 1, 'default' => 0)
        );
        $options = array(
            'primary' => array('id'),
            'indexes' => array(
                'user_id' => array('type' => 'key', 'fields' => 'user_id'),
                'mapping_id' => array('type' => 'key', 'fields' => 'mapping_id'),
                'status' => array('type' => 'key', 'fields' => 'status')
            )
        );
        PersistenceContext::get_dbms_utils()->create_table(self::$lightspeedto_odoo_uploads_table, $fields, $options);
    }

    private function insert_data()
    {
        $this->messages = LangLoader::get('install', 'lightspeedto_odoo');
        $this->insert_mappings_data();
    }

    private function insert_mappings_data()
    {
        PersistenceContext::get_querier()->insert(self::$lightspeedto_odoo_mappings_table, array(
            'name' => 'Mapping Lightspeed par défaut',
            'description' => 'Mapping par défaut pour les exports Lightspeed Série K',
            'mapping_data' => '{"ItemID":"default_code","Description":"name","Price":"list_price","Cost":"standard_price","UPC":"barcode","Category":"categ_id"}',
            'is_default' => 1,
            'created_date' => time(),
            'updated_date' => time(),
            'user_id' => 1
        ));
    }
}
?>
