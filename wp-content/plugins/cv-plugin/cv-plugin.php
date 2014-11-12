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
        
        /**
         *
         * @var array 
         */
        var $allowImageFormats = array('jpg','jpeg','png','gif');
        
        /**
         *
         * @var string 
         */
        var $tableName = 'cv_plugin';
        
        function __construct()
        {
            $this->plugin_name = basename(dirname(__FILE__)).'/'.basename(__FILE__);
            register_activation_hook( $this->plugin_name, array(&$this, 'activate') );
            register_deactivation_hook( $this->plugin_name, array(&$this, 'deactivate') );
            add_shortcode('cv', array(&$this, 'showCv' ));
            require_once( dirname( __FILE__ ) .'/admin/cv-admin.php');
        }
        
        /**
         * 
         * @param type $atts
         */
        function showCv( $atts ) 
        {
            extract(
                    shortcode_atts(
                            array(
                                'id' => 0
                                ), 
                            $atts 
                            )
                    );
            $out = 'susudasd';
            return $out;
        }


        /**
         * Activate plugin
         */
        function activate()
        {
            include_once (dirname (__FILE__) . '/admin/install.php');
            install_cv_plugin();
        }
        
        /**
         * Deactivate plugin
         */
        function deactivate()
        {
            include_once (dirname (__FILE__) . '/admin/install.php');
            uninstall_cv_plugin();
        }
    }
    global $cv;
    $cv = new cvBase();
}
