<?php

/**
 * @copyright   &copy; 2024 LordZatchi
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL-3.0
 * @author      LordZatchi <zatchbell68@gmail.com>
 * @version     PHPBoost 6.0 - last update: 2024 01 01
 * @since       PHPBoost 6.0 - 2024 01 01
 */

define('PATH_TO_ROOT', '..');

require_once PATH_TO_ROOT . '/kernel/init.php';

$url_controller_mappers = array(
    // Admin
    new UrlControllerMapper('LightspeedtoOdooAdminConfigController', '`^/admin/config/?$`'),

    // Upload
    new UrlControllerMapper('LightspeedtoOdooUploadController', '`^/upload/?$`'),

    // Mappings
    new UrlControllerMapper('LightspeedtoOdooMappingsController', '`^/mappings/?$`'),
    new UrlControllerMapper('LightspeedtoOdooMappingFormController', '`^/mappings/add/?$`'),
    new UrlControllerMapper('LightspeedtoOdooMappingFormController', '`^/mappings/([0-9]+)/edit/?$`', array('id')),
    new UrlControllerMapper('LightspeedtoOdooMappingDeleteController', '`^/mappings/([0-9]+)/delete/?$`', array('id')),

    // Process
    new UrlControllerMapper('LightspeedtoOdooProcessController', '`^/process/?$`'),
    new UrlControllerMapper('LightspeedtoOdooProcessController', '`^/process/([0-9]+)/?$`', array('id')),

    // Home
    new UrlControllerMapper('LightspeedtoOdooHomeController', '`^/?$`')
);

DispatchManager::dispatch($url_controller_mappers);
