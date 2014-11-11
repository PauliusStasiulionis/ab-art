<?php

/**
 * Plugin Name: CV-plugin
 * Plugin URI: http://www.ab-art.lt/
 * Description: CV Plugin.
 * Version: 1.0
 * Author: Paulius Stasiulionis
 * Author URI: http://www.ab-art.lt/
 * License: GPL2
 */

/**
 * @author Paulius Stasiulionis
 * @since 2014-11-10
 * @version 2014-11-10
 */

if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])){ 
    die('You are not allowed to call this page directly.'); 
    
}

/**
 * 
 * @global wpdb $wpdb
 */
function install_cv_plugin()
{
    /* @var $wpdb wpdb */
    global $wpdb;
    // upgrade function changed in WordPress 2.3
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    
    if ( version_compare(mysql_get_server_info(), '4.1.0', '>=') ) {
        if ( ! empty($wpdb->charset) ) {
            $charset_collate = "DEFAULT CHARACTER SET $wpdb->charset";
        }   
        if ( ! empty($wpdb->collate) ){
            $charset_collate .= " COLLATE $wpdb->collate";
        }         
    }
        
    $sql = "CREATE TABLE `{$wpdb->prefix}cv_plugin`( ".  
    "`pid` INT NOT NULL AUTO_INCREMENT, ".
    "`image_file_name` VARCHAR(512) NOT NULL DEFAULT '', ".
    "`image_file_subdir` VARCHAR(512) NOT NULL DEFAULT '', ".
    "`description` TEXT, ".
    "PRIMARY KEY (`pid`) ".
    ") $charset_collate;";
    
    dbDelta($sql);
}
/**
 * 
 * @global wpdb $wpdb
 */
function uninstall_cv_plugin()
{
    global $wpdb;
    
    $wpdb->query("DROP TABLE IF EXISTS `{$wpdb->prefix}cv_plugin`");
}