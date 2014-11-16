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
    
     if (isset($_GET["task"]))
        $task = $_GET["task"]; 
    else
        $task = '';
    if (isset($_GET["id"]))
        $id = $_GET["id"];
    else
        $id = 0;
    
    
    switch ($task) {

        case 'add_cv':
            addCv();
            break;
        case 'edit_cv':
            if ($id)
                editCv($id);
            else {
                $id = $wpdb->get_var("SELECT MAX( pid ) FROM " . $wpdb->prefix . "cv_plugin");
                editCv($id);
            }
            break;

        case 'save':
            saveCv($id);
            showCv();
            break;
        case 'remove_cv':
            removeCv($id);
            showCv();
            break;
        default:
            showCv();
            break;
    }
}



/**
 * This function shows all cv
 * 
 * @global wpdb $wpdb
 */
function showCv() {
    
    /* @var $wpdb wpdb */
    global $wpdb;
    
    $results = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}cv_plugin");
    if (isset($results[0])){
        $result = $results[0];
    }
    ?>
 <div id="wrap">
        <h2><?php _e('CV manager');?> <a class="add-new-h2" href="admin.php?page=cv_plugin&task=add_cv">Add New</a></h2> 
        <table class="wp-list-table widefat fixed ">
            <thead>
                <tr>
                    <td style="width:15px">Id</td>
                    <td>Name</td>
                    <td>Delete</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach($results as $result) {?>
                <tr>
                    <td><?php echo $result->pid?></td>
                    <td><a class="row-title" title="Edit <?php echo $result->name?>" href="admin.php?page=cv_plugin&task=edit_cv&id=<?php echo $result->pid?>"><?php echo $result->name?></a></td>
                    <td><a title="Delete <?php echo $result->name?>" href="admin.php?page=cv_plugin&task=remove_cv&id=<?php echo $result->pid?>">DELETE</a></td>
                </tr>
                <?php } ?>
            </tbody>  
        </table>
    </div>
   <?php 
}
/**
 * 
 * This function add new cv
 * 
 * @global wpdb $wpdb
 */
function addCv()
{   
    $_wp_editor_expand = false;
    ?>
<div id="wrap">
    <h2><?php _e('Add new CV');?></h2> 
    <form action="admin.php?page=cv_plugin&task=save" method='post' enctype="multipart/form-data" id="cv-plugin" name="cv-plugin-form">
        <table class="form-table">
            <tr>
                <td>
                    <?php _e( 'Choose image files to upload' ); ?><input type="file" name="CVImage" id="CVImage" size="35" class="uploadform"/>  
                </td>
            </tr>
            <tr>
                <td><label for="name"><?php _e( 'Name' ); ?>: </label><input type="text" name="CVName"/></td>
            </tr>
            <tr>
                <td>
                    <div id="cvdivrich" class="cvarea 
                        <?php if ($_wp_editor_expand) {
                            echo ' wp-editor-expand';
                            } ?>"></div>
                    <?php
                    wp_editor('', 'cvDescription', array(
                        'dfw' => true,
                        'drag_drop_upload' => false,
                        'wpautop' => true,
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

function editCv($id) {
    global $wpdb;
    $_wp_editor_expand = false;
    $row = $wpdb->get_row(
        sprintf(
            "SELECT * FROM " . $wpdb->prefix . "cv_plugin WHERE pid = %d",
            $id
        )
    );
    //$row->description = format_to_edit($row->description);
    ?>
<div id="wrap">
    <h2><?php _e('Edit CV');?></h2> 
    <form action="admin.php?page=cv_plugin&task=save&id=<?php echo $row->pid?>" method='post' enctype="multipart/form-data" id="cv-plugin" name="cv-plugin-form">
        <table class="form-table">
            <tr>
                <td>
                    <img src="/wp-content/uploads<?php echo trailingslashit($row->images_file_subdir).$row->sml_img_file_name;?>" alt="CV picture" >
                    <input type="hidden" value="<?php echo $row->org_img_file_name?>" name="org_img_file_name">
                    <input type="hidden" value="<?php echo $row->sml_img_file_name?>" name="sml_img_file_name">
                    <input type="hidden" value="<?php echo $row->images_file_subdir?>" name="images_file_subdir">
                </td>
            </tr>
            <tr>
                <td>
                    <?php _e( 'Choose image files to upload' ); ?><input type="file" name="CVImage" id="CVImage" size="35" class="uploadform">  
                </td>
            </tr>
            <tr>
                <td><label for="name"><?php _e( 'Name' ); ?>: </label><input type="text" name="CVName" value="<?php echo $row->name ?>"></td>
            </tr>
            <tr>
                <td>
                    <div id="cvdivrich" class="cvarea 
                        <?php if ($_wp_editor_expand) {
                            echo ' wp-editor-expand';
                            } ?>"></div>
                    <?php
                    wp_editor($row->description, 'cvDescription', array(
                        'dfw' => true,
                        'wpautop' => true,
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
            <input name="save" type="submit" class="button-primary" value="<?php _e('Save Changes', 'cv_plugin'); ?>">
        </p>
    </form>
</div>
<?php
}

/**
 * 
 * @global wpdb $wpdb
 * @global cvBase $cv
 */
function removeCv($id)
{
    global $wpdb;
    global $cv;
    $wpdb->delete($wpdb->prefix.$cv->tableName, array('pid' => $id));
}

/**
 * 
 * @global WP_Filesystem_Base $wp_filesystem
 * @global cvBase $cv
 * @global wpdb $wpdb
 * @return boolean
 */
function saveCv($id) {
    if (empty($_POST)){
        return;
    }
    global $wp_filesystem;
    global $cv;
    global $wpdb;
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
        $fileData = saveImageFile($_POST);
        if(!$id){
            $wpdb->insert(
                   $wpdb->prefix.$cv->tableName,
                   array(
                       'org_img_file_name' => $fileData['fileName'],
                       'sml_img_file_name' => $fileData['smallFileName'],
                       'images_file_subdir' => $fileData['subdir'],
                       'name' => $_POST['CVName'],
                       'description' => $_POST['cvDescription']
                           )
                   );    
        } else {
            $wpdb->update($wpdb->prefix.$cv->tableName, 
                    array(
                       'org_img_file_name' => $fileData['fileName'],
                       'sml_img_file_name' => $fileData['smallFileName'],
                       'images_file_subdir' => $fileData['subdir'],
                       'name' => $_POST['CVName'],
                       'description' => $_POST['cvDescription']
                           ), 
                    array('pid' => (int)$id)
                    );
        }
       
    }
    
}
/**
     * 
     * @global WP_Filesystem_Base $wp_filesystem
     * @param array $post_data
     * @return array
     */
function saveImageFile($post_data) 
{
    global $wp_filesystem;
    
    $cvImageWidth = 485; 
    $cvImageHeigh = 550;
      
    
    $return = array();
    if ($_FILES['CVImage']["tmp_name"]){
       $tmpFile = $_FILES['CVImage']['tmp_name'];
       switch($_FILES['CVImage']['type']){
           case 'image/jpeg':
               $image = imagecreatefromjpeg($tmpFile);
               break;
           case 'image/png':
               $image = imagecreatefrompng($tmpFile);
               break;
           case 'image/gif':
               $image = imagecreatefromgif($tmpFile);
               break;	
           default:
               echo 'Image file format should be jpg, png or gif';
               return;
           }

       $uploadDir = wp_upload_dir();
       $fileName = $_FILES['CVImage']['name'];
       if ( ! $wp_filesystem->put_contents( 
               trailingslashit($uploadDir['path']).$fileName, 
               $wp_filesystem->get_contents($tmpFile), 
               FS_CHMOD_FILE) 
               ) {
           wp_die('error saving file!', 'error saving file!');
       } else {
           list($width, $height) = getimagesize(
                   $tmpFile
                   );
            if ($width > $height) {
                $newWidth = $cvImageWidth;
                $divisor = $width / $cvImageWidth;
                $newHeight = floor( $height / $divisor);
            }
            else {
                $newHeight = $cvImageHeigh;
                $divisor = $height / $cvImageHeigh;
                $newWidth = floor( $width / $divisor );
            }
            if ($width == $height) {
                $newWidth = $cvImageWidth;
                $newHeight = $cvImageWidth;
            }
            
           $cvimagesmall = imagecreatetruecolor($newWidth, $newHeight);
           imagecopyresized(
                   $cvimagesmall,
                   $image,
                   0, 0, 0, 0,
                   $newWidth,
                   $newHeight,
                   $width,
                   $height
                   );
           $parsedFileName = \pathinfo($fileName);
           $smallFileName = $parsedFileName['filename']."_small.jpg";
           imagejpeg($cvimagesmall,
                   trailingslashit(
                           $uploadDir['path']
                           )
                   .$smallFileName, 100

                   );
           $return['fileName'] = $fileName;
           $return['smallFileName'] = $smallFileName;
           $return['subdir'] = $uploadDir['subdir'];
           return $return;
       }    
    }
    
    $return['fileName'] = $post_data['org_img_file_name'];
    $return['smallFileName'] = $post_data['sml_img_file_name'];
    $return['subdir'] = $post_data['images_file_subdir'];
    return $return;        
}
