<?php
/**
 * Plugin Name: CV plugin
 * Plugin URI: http://www.ab-art.lt/
 * Description: CV Plugin.
 * Version: 1.0
 * Author: Paulius Stasiulionis
 * Author URI: http://www.ab-art.lt/
 * License: GPL2
 */
/**
 * @author Paulius Stasiulionis
 * @since 2014-11-05
 * @version 2014-11-05
 */
add_action('admin_init', 'cvSettings');
add_action('admin_menu', 'cvPluginMenu');



/**
 * Constructor
 */
function cvSettings() {
    global $cv;
}

/**
 * 
 */
function cvPluginMenu() {
    add_menu_page('CV plugin options', 'CV plugin', 'manage_options', 'cv_plugin', 'cv_plugin_options_page');
}

/**
 * 
 * @global wpdb $wpdb
 * @global cvBase $cv
 * @global WP_Filesystem_Base $wp_filesystem
 */
function cv_plugin_options_page() {
    
    /* @var $wpdb wpdb */
    global $wpdb;
    
    global $cv;
    
    global $wp_filesystem;
    
    if (!current_user_can('manage_options')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }
    $results = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}cv_plugin");
    if (isset($results[0])){
        $result = $results[0];
    }
    if (saveCv()){
        wp_die('There is problems on cv saving', 'Saving problems');
    }

    
    ?>

    
    
    <div id="wrap">
        
        <form action="admin.php?page=cv_plugin" method='post' enctype="multipart/form-data" id="cv-plugin" name="cv-plugin-form">
            <table class="form-table">
                <tr>
                    <th>
                        <h2><?php _e('Edit your CV');?></h2>
                    </th>
                </tr>
                <tr>
                    <td>
                        <?php _e( 'Choose image files to upload' ); ?>
                            <input type="file" name="CVimage" id="CVimage" size="35" class="uploadform"/>  
                    </td>
                </tr>
                <tr>
                    <td>
                        <div id="cvdivrich" class="cvarea 
                            <?php if ($_wp_editor_expand) {
                                echo ' wp-editor-expand';
                                } ?>"></div>
                        <?php
                        wp_editor($post->post_content, 'cv_content', array(
                            'dfw' => true,
                            'drag_drop_upload' => false,
                            'tabfocus_elements' => 'save-post',
                            'editor_height' => 300,
                            'tinymce' => array(
                                'resize' => false,
                                'wp_autoresize_on' => $_wp_editor_expand,
                                'add_unload_trigger' => false,
                            ),
                        ));
                        ?>    
                    </td>
                </tr>
            </table>
            
       
            <?php wp_nonce_field('cd-plugin-option'); ?>
            <p class="submit">
                <input name="save" type="submit" class="button-primary" value="<?php _e('Save Changes', 'cv_plugin'); ?>" />
            </p>
        </form>
    </div>
    <?php
}

/**
 * 
 * @global WP_Filesystem_Base $wp_filesystem
 * @return boolean
 */
function saveCv() {
    if (empty($_POST)) return false;
 
    check_admin_referer('cd-plugin-option');
    $form_fields = array ('save');
    $method = ''; 
 
    // check to see if we are trying to save a file
    if (isset($_POST['save'])) {
        $url = wp_nonce_url('admin.php?page=cv_plugin','cd-plugin-option');
        if (false === ($creds = request_filesystem_credentials($url, $method, false, false, $form_fields) ) ) {
            // if we get here, then we don't have credentials yet,
            // but have just produced a form for the user to fill in,
            // so stop processing for now
            return false; // stop the normal page form from displaying
        }
        
        if ( ! WP_Filesystem($creds) ) {
            // our credentials were no good, ask the user for them again
            request_filesystem_credentials($url, $method, true, false, $form_fields);
            return false;
        }
        $uploadDir = wp_upload_dir();

        global $wp_filesystem;
        if ( ! $wp_filesystem->put_contents( 
                trailingslashit($uploadDir['path']).$_FILES["CVimage"]['name'], 
                $wp_filesystem->get_contents($_FILES["CVimage"]['tmp_name']), 
                FS_CHMOD_FILE) 
                ) {
            wp_die('error saving file!', 'error saving file!');
        } 
    }
}
