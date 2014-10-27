<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<?php if (!defined ('ABSPATH')) die ('No direct access allowed'); ?><?php if (!empty ($image)) : ?>
<div>
    <div class="picform-image">
    <?php echo $image->thumbHTML; ?>
    </div>
    <div class="picform-explonation">
        <p>Domina šitas mano darbas? Norėtumėte panašaus? Užpildykite apačioje esančią formą ir išsiųskite. 
            Aš gavusi Jūsų laišką kuo skubiau patikrinisiu ar turiu medžiagų šiam darbui ir jums atrašysiu. 
            Taip pat rašykite savo pageidavimus ir įdėjas, kurias galėčiau Jums padėti įgyvendinti.</p>
        
    </div>
    <div class="picform-form">
        <?php echo do_shortcode('[contact-form-7 id="244" title="Užsąkymo formą"]');?>
    </div>
</div>


<?php endif; ?>
