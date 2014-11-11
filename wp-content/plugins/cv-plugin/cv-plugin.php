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
 * Description of cv-plugin
 *
 * @author Paulius Stasiulionis
 * @since 2014-11-04
 * @version 2014-11-04
 */

if (!class_exists('cvBase')) {
    class cvBase {
        
        /**
         *
         * @var string
         */
        var $plugin_name;
        
        var $allowImageFormats = array('jpg','jpeg','png','gif');
        
        function __construct() {
            $this->plugin_name = basename(dirname(__FILE__)).'/'.basename(__FILE__);
            register_activation_hook( $this->plugin_name, array(&$this, 'activate') );
            register_deactivation_hook( $this->plugin_name, array(&$this, 'deactivate') );
            add_filter('the_content', array(&$this, 'convert_shortcode'));
            require_once( dirname( __FILE__ ) .'/admin/cv-admin.php');
        }
        
        /**
         * 
         */
        function convert_shortcode($content)
        {
            if ( stristr( $content, '[cv]' )) {
                return $content."\n shudas";
            }
            return $content;
        } 
        /**
         * 
         */
        function activate()
        {
            include_once (dirname (__FILE__) . '/admin/install.php');
            install_cv_plugin();
        }
        
        /**
         * 
         */
        function deactivate()
        {
             
        }
    }
    global $cv;
    $cv = new cvBase();
}
