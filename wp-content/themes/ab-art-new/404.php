<?php

/**
 * Plugin Name: Plugin name
 * Plugin URI: Project 
 * Description: CV Plugin.
 * Version: 1.0
 * Author: Paulius Stasiulionis
 * Author URI: http://www.ab-art.lt/
 * License: GPL2
 */
/**
 * @author Paulius Stasiulionis
 * @since 2014-11-16
 * @version 2014-11-16
 */
get_header(); ?>
<div id="content">
    <h1 class="entry-title"><?php _e( 'Not Found', 'ab-art-new' ); ?></h1>
        <div class="entry-content">
                <p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'coraline' ); ?></p>
                <a href="/index.php">Back to page</a>
        </div><!-- .entry-content -->
</div>
<?php get_footer();?>