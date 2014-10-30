<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php if (!defined ('ABSPATH')) die ('No direct access allowed'); ?><?php if (!empty ($image)) : ?>
<div id="ngg-image-<?php echo $image->pid; ?>" class="nggabout-image">
    <?php echo $image->imageHTML ?>
</div>
<div id="ngg-image-description-<?php echo $image->pid; ?>" class="nggabout-description">
    <h3><?php echo $image->alttext; ?></h3>
    Apie darbą:
    <div id="ngg-image-long-description-<?php echo $image->pid; ?>" class="nggabout-long-description">
        <?php echo $image->description_long; ?>
    </div>
    <div>
        <a href="<?php echo $image->picture_form_link ;?>" title="<?php echo $image->alttext ?>">Užsakyti darbą</a>
        <?php //echo do_shortcode('[contact-form-7 id="197" title="Contact form 1" image="'.$image->pid.'"]');?>
    </div>
</div>

<?php endif; ?>

