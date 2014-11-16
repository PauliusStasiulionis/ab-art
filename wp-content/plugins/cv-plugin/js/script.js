/**
 * Plugin Name: Plugin name
 * Plugin URI: Project 
 * Description: CV Plugin.
 * Version: 1.0
 * Author: Paulius Stasiulionis
 * Author URI: http://www.ab-art.lt/
 * License: GPL2
 */

jQuery(document).ready(function() {
   var options = {};
   jQuery('#cv-picture').slideDown(500, 
        function () {
            jQuery('#cv-description').slideDown(500);
        }
    );
});