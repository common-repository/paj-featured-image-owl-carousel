/**
 *Owl Carousel Settings for each carousel.
 */
/* global jQuery */
/* global owl_php_data */
/* eslint-env browser */
/*jslint browser: true*/
/*global $, jQuery, owl_php_data, Modernizr, alert*/

jQuery(document).ready(function() {
    "use strict";
    var my_json_str = owl_php_data.paj_owl_settings.replace(/&quot;/g, '"');
    var my_php_arr = jQuery.parseJSON(my_json_str);

     var xowls = 0;

        jQuery(".owl-carousel").each(function() {
            var $pajowl = jQuery(this);

            var position = jQuery(this).attr('current-owl');

            position = position - 1;

            $pajowl.pajOwlCarousel({
            loop: my_php_arr[position]['carousel_loop'],
            margin: my_php_arr[position]['gap_between_slides'],

            autoplay: my_php_arr[position]['autoplay_carousel'],
            autoplaySpeed: my_php_arr[position]['carousel_speed'],
            autoplayHoverPause: my_php_arr[position]['pause_carousel'],
            autoplayTimeout: my_php_arr[position]['carousel_pause_time'],

            nav: my_php_arr[position]['button_nav'],
            navContainerClass: my_php_arr[position]['carousel_container_class'],
            navClass: [my_php_arr[position]['carousel_backward'], my_php_arr[position]['carousel_forward']],
            navText: [ my_php_arr[position]['carousel_text_backward'], my_php_arr[position]['carousel_text_forward'] ],
            mouseDrag: my_php_arr[position]['mouse_drag_touch'],
            touchDrag: my_php_arr[position]['tablet_touch'],
            dots: my_php_arr[position]['dot_navigation'],

            dotsEach: 2,
            lazyLoad: false,
            slideBy: 1,

            responsiveClass: true,
            responsive: {
                0: {
                    items : my_php_arr[position]['noof_mobile_items']
                 },
                 600: {
                     items : my_php_arr[position]['noof_tablet_items']
                },
                1000: {
                    items : my_php_arr[position]['noof_desk_items']
                }
            }

        });

        var pajnavspeed = my_php_arr[position]['carousel_speed'];
        var pajnavpausetime = my_php_arr[position]['carousel_pause_time'];


       //Fix for changing browser tabs  and mouse hover restart
        if (my_php_arr[position]['autoplay_carousel']) {

        //add half second delay after mouse leaves carousel image before restart
            $pajowl.mouseleave(function(e) {
                setTimeout(function () {
                    $pajowl.trigger('next.owl.carousel',[pajnavspeed]);
                }, 500);
          });
        // restart carousel when browser tab regains focus
            jQuery(window).focus(function(e) {$pajowl.trigger('next.owl.carousel',[pajnavspeed]);   });
            }

        //Add class to header which styles carousel output
        var colorchoice = my_php_arr[position]['carouselcolour'];
        var pajheading_font_size = my_php_arr[position]['font_heading_size'];
        var pajexcerpt_font_size = my_php_arr[position]['font_excerpt_size'];
        var pajmeta_font_size = my_php_arr[position]['font_meta_size'];
            
            
            
        var pajheading_color = my_php_arr[position]['post_heading_color'];  
        var pajheading_weight = my_php_arr[position]['post_heading_weight'];  
        var pajheading_case = my_php_arr[position]['post_heading_case'];  
            
            
        var pajexcerpt_color = my_php_arr[position]['post_excerpt_color'];    
        var pajexcerpt_weight = my_php_arr[position]['post_excerpt_weight'];    
        var pajexcerpt_case = my_php_arr[position]['post_excerpt_case'];    
            
            
        var pajmeta_color = my_php_arr[position]['post_meta_color'];    
        var pajmeta_weight = my_php_arr[position]['post_meta_weight'];    
        var pajmeta_case = my_php_arr[position]['post_meta_case'];    
            
        
        var pajslidebackground_color = my_php_arr[position]['post_slide_background_color'];   
        var pajslideborder_width = my_php_arr[position]['post_slide_border_width']; 
        var pajslideborder_color = my_php_arr[position]['post_slide_border_color']; 
        var pajslideborder_style = my_php_arr[position]['post_slide_border_style']; 
         
            //set image height
        var pajpostimage_height = my_php_arr[position]['post_image_height']; 
            
        var paj_image_height = 0;
        var paj_caption_position = 0;
        if (pajpostimage_height <= 0) {
            paj_image_height = 'auto';
            paj_caption_position = '20%';
        } else {
            paj_caption_position = (pajpostimage_height/4)+'px'; 
            paj_image_height = pajpostimage_height+'px'; 
        }    

        //set font sizes
        if (pajheading_font_size <= 0) {pajheading_font_size = 'inherit';} else {pajheading_font_size = pajheading_font_size+'px';}
        if (pajexcerpt_font_size <= 0) {pajexcerpt_font_size = 'inherit';} else {pajexcerpt_font_size = pajexcerpt_font_size+'px';}
        if (pajmeta_font_size <= 0) {pajmeta_font_size = 'inherit';} else {pajmeta_font_size = pajmeta_font_size+'px';}


        var pajsettings = '.paj-carousel-style-'+position;
        var style_class = 'paj-carousel-style-'+position;

        //add class paj-carousel-style to slider
        $pajowl.addClass(style_class);

        //add styles to header
        jQuery('head').append('<style type="text/css">'
        +pajsettings+' .pajimageframe {max-height:'+paj_image_height+';}'
        +pajsettings+' .paj-owl-caption-over {padding-top:'+paj_caption_position+';}'
        +pajsettings+' .paj-owl-caption-under, '+pajsettings+' .paj-owl-caption-over{background-color:'+pajslidebackground_color+';}'
        +pajsettings+' .paj-carousel-item-box{border:'+pajslideborder_width+'px '+pajslideborder_style+' '+pajslideborder_color+';}'
        +pajsettings+' .paj-owl-heading h3{font-weight:'+pajheading_weight+';text-transform:'+pajheading_case+';color:'+pajheading_color+';font-size:'+pajheading_font_size+'!important;}'
        +pajsettings+' .paj-owl-text {font-weight:'+pajexcerpt_weight+';text-transform:'+pajexcerpt_case+';color:'+pajexcerpt_color+';font-size:'+pajexcerpt_font_size+'!important;}'
        +pajsettings+' .paj-owl-category, '
        +pajsettings+' .paj-owl-meta {font-weight:'+pajmeta_weight+';text-transform:'+pajmeta_case+';color:'+pajmeta_color+';font-size:'+pajmeta_font_size+';}</style>');

        //add class paj-touch if it is a touch screen device
        if (Modernizr.touchevents) {$pajowl.addClass( "paj-touch" );}
      
    });

})