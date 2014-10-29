<?php

/**
 * @author Paulius Stasiulionis
 * @since 2014-10-27
 * @version 2014-10-27
 */
?>
<div id="content">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div id="post-<?php the_ID()?>" class="post">
        <?php the_content(); ?>    
    </div>
<?php endwhile; endif;// end of the loop. ?>   
</div><!-- content -->
