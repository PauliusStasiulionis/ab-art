/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
jQuery("document").ready(function(){
    jQuery("li.menu-item").hover(
        function () { 
            if(jQuery(this).find("ul.sub-menu")){
                jQuery(this).find("ul.sub-menu").slideDown();
            }
            
        },
        function () { 
            if(jQuery(this).find("ul.sub-menu")){
                jQuery(this).find("ul.sub-menu").slideUp();
            }
            
        }

    );

});

