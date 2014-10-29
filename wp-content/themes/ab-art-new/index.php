<?php

/**
 * @author Paulius Stasiulionis
 * @since 2014-10-26
 * @version 2014-10-26
 */
?>
<?php get_header(); ?>
<?php get_sidebar(); ?>

<div id="content">
    <?php
			/* Run the loop to output the posts.
			 * If you want to overload this in a child theme then include a file
			 * called loop-index.php and that will be used instead.
			 */
			 get_template_part( 'content' );
			?>
</div>
<?php get_footer();?>