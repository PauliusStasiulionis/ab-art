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
         * @global wpdb $wpdb
         * @param array $atts
         * @return string
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
            return $this->render($atts['id']);
        }
        
        /**
         * 
         * @global wpdb $wpdb
         * @param string $id
         * @return string
         */
        function render($id) 
        {
            
            global $wpdb;
            $result = $wpdb->get_row(
                    $wpdb->prepare(
                            "SELECT * FROM {$wpdb->prefix}{$this->tableName} "
                            . "WHERE pid = %d",
                            $id ),
                    ARRAY_A
                    );
            $out = '<link href="'.plugins_url('/style/style.css', __FILE__).'" rel="stylesheet" type="text/css" />'; 
            $out .= '<script src="'.plugins_url('/js/script.js', __FILE__).'"></script>';
            $out .= '<div id="cv-picture">';
            $out .= '<img src="/wp-content/uploads'
                    .trailingslashit($result['images_file_subdir'])
                    .$result['sml_img_file_name']
                    .'" alt="CV picture">';
            $out .= '</div>'."\n";
            $out .= '<div id="cv-description">'."\n";
            $out .= apply_filters('the_content', $result["description"])."\n";
            $out .= '</div>'."\n";
            
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
