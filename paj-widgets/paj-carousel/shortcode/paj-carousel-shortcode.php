<?php
/*
main plugin file. Includes shortcode
*/

defined( 'ABSPATH' ) or die( 'No No No!' );

////////////////////////Load Scripts and Styles for Owl 2/////////////////////////////////////////////
function load_owlslider_scriptsandstyles() {
   wp_enqueue_script( 'pajtouchscript', plugin_dir_url (__FILE__ ). 'js/modernizr-custom.js', array( 'jquery' ), '3.3.1', true );

   wp_enqueue_script( 'paj-owl-sliderscript', plugin_dir_url (__FILE__ ). 'js/owl.carousel.js', array( 'jquery' ), '2.2.1', true );

   wp_register_script ( 'paj-owl-slider-settings', plugins_url ( 'js/owl-settings.js', __FILE__ ), array( 'paj-owl-sliderscript' ), '2.2.1', true );

   wp_register_style ( 'paj_owl_carousel', plugins_url ( 'css/owl.carousel.css', __FILE__ ));
   wp_enqueue_style('paj_owl_carousel');

   wp_register_style ( 'paj_owl_slide', plugins_url ( 'css/owl-carousel-style.css', __FILE__ ));
   wp_enqueue_style('paj_owl_slide');
};
add_action( 'wp_enqueue_scripts', 'load_owlslider_scriptsandstyles' );



//make string input a boolean value//////

function pajboolean($boolcheck) {
    $check_boolean = strtolower(str_replace(" ", "", $boolcheck));
    if (($check_boolean == 1) || ($check_boolean == 'true') || ($check_boolean == 'yes')) {
        return 1;
    } else {
        return 0;
    }
}

//check number is within a certain value
function number_range($int,$min,$max){
    if ($min<$int && $int<$max) {
        return (int)$int;
    } elseif ($int <= $min) {
        return (int)$min;
    } elseif ($int >= $max) {
        return (int)$max;
        }
}

 
// validate heading_weight
    function validateWeight ($weight) {
        $weight = strtolower(trim($weight));
        if (($weight == 'inherit') || ($weight == 'lighter') || ($weight == 'bold') || ($weight == 'bolder')) {
             return $weight;
         } else {
             return 'inherit';
         }
     } 
    
//validate heading case
    function validateCase ($headingcase){
        $headingcase = strtolower(trim($headingcase));
        if (($headingcase == 'inherit') || ($headingcase == 'uppercase') || ($headingcase == 'lowercase')) {
             return $headingcase;
        } else {
             return 'inherit';
        }
    }
      
    //Validate hex color 
    function validateColor($color){
      if(preg_match('/^#[a-f0-9]{6}$/i', $color)) //hex color is valid
        {
          return $color;
        } else {
          return '';
      }
    }

//validate border style    
    function validateBorderStyle($borderStyle){
        $borderStyle = strtolower(trim($borderStyle));
        if (preg_match('/^[a-z_]+$/', $borderStyle)) {
             return $borderStyle;
        } else {
             return 'solid';
        }
    }//end of validate border style function



/////////////////////////////////////////////////////////SHORTCODE/////////////////////////////
// Function to add subscribe text to posts and pages

  function paj_carousel_slider_shortcode( $atts ) {
    extract( shortcode_atts( array(
        'title' => '',
        'autoplay' => 'true',
        'loop' => 'true',
        'pause' => 'true',
        'display_dots' => 'false',
        'display_nav' => 'true',
        'slide_boxed_layout' => 'true',
        'touch_drag' => 'true',
        'mouse_drag' => 'true',

        'display_heading' => 'true',
        'display_excerpt' => 'true',
        'display_category' => 'false',
        'display_meta' => 'false',
        'display_author' => 'false',
        'force_image_resize' => 'true',

        'slide_image_height' =>'',
         
        'heading_font_size' => '20',
        'heading_color' => '',
        'heading_weight' => 'inherit',
        'heading_case' => 'inherit',
        
        'excerpt_font_size' => '14',
        'excerpt_color' => '',
        'excerpt_weight' => 'inherit',
        'excerpt_case' => 'inherit',
        
        'meta_font_size' => '11',
        'meta_color' => '',
        'meta_weight' => 'inherit',
        'meta_case' => 'inherit',
         
        'slide_background_color' => '',
        'slide_border_width' => '2',
        'slide_border_style' => 'solid',
        'slide_border_color' => '',

        'paj_word_count' => '10',

        'slides_desktop' => '4',
        'slides_tablet' => '2',
        'slides_mobile' => '1',
        'column_number' => '1',

        'slide_gap' => '10',
        'smart_speed' => '700',
        'pause_time' => '0',

        'carousel_layout' => 'original',

        'carousel_post_query' => '',
        'paj_post_type' => 'post',
        'post_category' => '',
        'post_order' => 'DESC',

    ), $atts) );

    if ($carousel_layout == 'original') {
        $nav_container = 'owl-nav';
        $nav_forward  =  'owl-next';
        $nav_backward =  'owl-prev';
        $nav_text_forward = 'next';
        $nav_text_backward = 'prev';
    }

    if ($carousel_layout == 'layout_1') {
        $nav_container = 'pajowl-nav';
        $nav_forward  =  'pajowl-next';
        $nav_backward =  'pajowl-prev';
        $nav_text_forward = '&#9658;';
        $nav_text_backward = '&#9668;';
    }

      
    $title = strval($title);
    //Validate post order
    $post_order = strtolower(str_replace(" ", "", $post_order));
    if (!($post_order == 'asc') || ($post_order == 'desc') )  {$post_order = 'asda';}

    //Validate boolean input. Anything that does not evaluate to true is false.
    $autoplay=(pajboolean($autoplay));
    $loop=(pajboolean($loop));
    $pause=(pajboolean($pause));
    $display_dots=(pajboolean($display_dots));
    $display_nav=(pajboolean($display_nav));
    $slide_boxed_layout=(pajboolean($slide_boxed_layout));

    $touch_drag=(pajboolean($touch_drag));
    $mouse_drag=(pajboolean($mouse_drag));

    $display_heading=(pajboolean($display_heading));
    $display_excerpt=(pajboolean($display_excerpt));
    $display_category=(pajboolean($display_category));
    $display_meta=(pajboolean($display_meta));
    $display_author=(pajboolean($display_author));
    $force_image_resize=(pajboolean($force_image_resize));

    //Validate smart_speed and pause_time
    $smart_speed = absint($smart_speed);
    $pause_time = absint($pause_time);

    //pause_time must always be four times greater than smart_speed for carousel autoplay to work.
    if ($pause_time <= (($smart_speed*4)+10)) {
        $pause_time = ($smart_speed *4) + 10;
    }

    //set up owl settings array for javascript file
    static $paj_owl_settings = array();

    //set owl shortcode counter
    static  $paj_owl_count = 0;



  //  $paj_owl_settings[$paj_owl_count]['noof_owls'] = $paj_owl_count;


    $paj_owl_settings[$paj_owl_count]['noof_desk_items'] = number_range($slides_desktop,1,20);
    $paj_owl_settings[$paj_owl_count]['noof_tablet_items'] = number_range($slides_tablet,1,10);
    $paj_owl_settings[$paj_owl_count]['noof_mobile_items'] = number_range($slides_mobile,1,10);
    $paj_owl_settings[$paj_owl_count]['gap_between_slides'] = number_range($slide_gap,-1,100);
    $paj_owl_settings[$paj_owl_count]['autoplay_carousel'] = $autoplay;
    $paj_owl_settings[$paj_owl_count]['carousel_loop'] = $loop;
    $paj_owl_settings[$paj_owl_count]['pause_carousel'] = $pause;
    $paj_owl_settings[$paj_owl_count]['carousel_speed'] = $smart_speed;
    $paj_owl_settings[$paj_owl_count]['carousel_pause_time'] = $pause_time;
    $paj_owl_settings[$paj_owl_count]['carousel_container_class'] = $nav_container;
    $paj_owl_settings[$paj_owl_count]['carousel_forward'] = $nav_forward;
    $paj_owl_settings[$paj_owl_count]['carousel_backward'] = $nav_backward;
    $paj_owl_settings[$paj_owl_count]['carousel_text_forward'] = $nav_text_forward;
    $paj_owl_settings[$paj_owl_count]['carousel_text_backward'] = $nav_text_backward;
    $paj_owl_settings[$paj_owl_count]['dot_navigation'] = $display_dots;
    $paj_owl_settings[$paj_owl_count]['button_nav'] = $display_nav;

    $paj_owl_settings[$paj_owl_count]['tablet_touch'] = $touch_drag;
    $paj_owl_settings[$paj_owl_count]['mouse_drag_touch'] = $mouse_drag;

    
    $paj_owl_settings[$paj_owl_count]['post_image_height'] = number_range($slide_image_height,0,2000);
        
    $paj_owl_settings[$paj_owl_count]['font_heading_size'] = number_range($heading_font_size,0,50);
    $paj_owl_settings[$paj_owl_count]['post_heading_weight'] = validateWeight($heading_weight);
    $paj_owl_settings[$paj_owl_count]['post_heading_color'] = validateColor($heading_color);
    $paj_owl_settings[$paj_owl_count]['post_heading_case'] = validateCase($heading_case);
      
    $paj_owl_settings[$paj_owl_count]['font_excerpt_size'] = number_range($excerpt_font_size,0,20); 
    $paj_owl_settings[$paj_owl_count]['post_excerpt_weight'] = validateWeight($excerpt_weight);
    $paj_owl_settings[$paj_owl_count]['post_excerpt_color'] = validateColor($excerpt_color);
    $paj_owl_settings[$paj_owl_count]['post_excerpt_case'] = validateCase($excerpt_case);  
      
    $paj_owl_settings[$paj_owl_count]['font_meta_size'] = number_range($meta_font_size,0,20);
    $paj_owl_settings[$paj_owl_count]['post_meta_weight'] = validateWeight($meta_weight);
    $paj_owl_settings[$paj_owl_count]['post_meta_color'] = validateColor($meta_color);
    $paj_owl_settings[$paj_owl_count]['post_meta_case'] = validateCase($meta_case);  
      
    $paj_owl_settings[$paj_owl_count]['post_slide_background_color'] = validateColor($slide_background_color);    
    $paj_owl_settings[$paj_owl_count]['post_slide_border_width'] = number_range($slide_border_width, 0,7);  
    $paj_owl_settings[$paj_owl_count]['post_slide_border_style'] = validateBorderStyle($slide_border_style);  
    $paj_owl_settings[$paj_owl_count]['post_slide_border_color'] = validateColor($slide_border_color);    
      
    $paj_owl_count++ ;



    //Get Post ID This comes from wgere the shortcode was called
    $postnumber = (int)(get_the_ID()); //get the post id that the shortcode is placed in.

    $my_owlsettings_str = json_encode($paj_owl_settings);
    $params = array('paj_owl_settings' => $my_owlsettings_str,);

    if ($paj_owl_count > 0) {        //Prevents  paj-owl-slider-settings being loaded if there is no shortcode being used on page
        wp_localize_script( 'paj-owl-slider-settings', 'owl_php_data', $params);
        // Enqueued script with localized data.
        wp_enqueue_script('paj-owl-slider-settings');
    }


    //sort correct image sizes
    $desktop_image_size = (int)(100 / $slides_desktop);
    $tablet_image_size = (int)(100 / $slides_tablet);
    $phone_image_size = (int)(100 / $slides_mobile);

      //used to improve srcset optimization
    $column_number = number_range($column_number,1,10);

    $desktop_image_size = (int)($desktop_image_size / $column_number);
    $tablet_image_size = (int)($tablet_image_size / $column_number);
    $phone_image_size = (int)($phone_image_size / $column_number);


    // validate string containing categories and post types
    $paj_category = strtolower(preg_replace('/[^a-zA-Z0-9-_\.,]/','', $post_category));
    $paj_post_type = strtolower(preg_replace('/[^a-zA-Z0-9-_\.,]/','', $paj_post_type));


if ((function_exists('siteorigin_widget_post_selector_process_query')) and (strlen($carousel_post_query) > 0)) {
   $processed_query = siteorigin_widget_post_selector_process_query( $carousel_post_query );
} else {
    $processed_query = array(
        'post_type' => $paj_post_type,
        'posts_per_page' => 20,
        'order' => $post_order,
        'category_name' => $paj_category,
    );
}

$post_id = '';
$completeslide = '';

$carousel_title = '';     
if ($title != '') {$carousel_title = '<h2 class="paj-carousel-title">'. esc_html($title).'</h2>';}  
    
   //create featured image owl slider
    $post_query = new WP_Query($processed_query);

        if($post_query->have_posts() ) {
            $pajoutput = '<div class="owl-carousel owl-theme pajowl" current-owl= '.$paj_owl_count.' >';
            while($post_query->have_posts() ) {
                $post_query->the_post();

            if ($postnumber != get_the_ID()) {
                if ( has_post_thumbnail() ) {

                    /***********Get Image attachments***************/
                    $thumb_image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail' );
                    $medium_image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium' );
                    $medlarge_image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium_large' );
                    $large_image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
                    $full_image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );


                    /*******************Add image to slide*************************/
                    $imagestring = '
                        <img sizes="(min-width: 1000px) '.$desktop_image_size.'vw,
                                    (min-width: 600px) '.$tablet_image_size.'vw,
                                    (min-width: 100px) '.$phone_image_size.'vw, 100vw"
                        srcset="'.esc_url($full_image_attributes[0]). ' 1600w,
                                '.esc_url($large_image_attributes[0]).' 1024w,
                                '.esc_url($medlarge_image_attributes[0]).' 768w,
                                '.esc_url($medium_image_attributes[0]).' 300w,
                                '.esc_url($thumb_image_attributes[0]).' 150w"
                        src="'.esc_url($medlarge_image_attributes[0]).'"
                        alt="'.esc_html(get_the_title()).'" height="'.absint($medlarge_image_attributes[1]).'" width="'. absint($medlarge_image_attributes[2]).'"/>
                    ';

                    if ($slide_boxed_layout) {     //text and meta below image
                        $displaytype = "paj-carousel-item-box";
                        $captiontype = "paj-owl-caption-under";

                        if ($force_image_resize) {
                            $slide = '<a href=" '.esc_url(get_the_permalink()).' "><div class='.$displaytype.'><div class="pajimageframe" ><div class="imgcontainer">'.$imagestring.'</div></div>';
                        } else {
                            $slide = '<a href=" '.esc_url(get_the_permalink()).' "><div class='.$displaytype.'>'.$imagestring;
                        }

                        $slide .= ' <div class=' .$captiontype. '>';
                        if ($display_heading) {$slide .= '<div class="paj-owl-heading"><h3>'.esc_html(get_the_title()).'</h3></div>';}
                        if ($display_excerpt) {$slide .= '<div class="paj-owl-text">'.sanitize_text_field (strip_shortcodes(wp_trim_words( get_the_excerpt(), number_range($paj_word_count,0,50), '...' ))).'</div>';}
                        if ($display_category) {$slide .= '<div class="paj-owl-category">'.strip_tags( get_the_category_list( ', ', $post_id )).'</div>';}
                        if ($display_meta) {$slide .= '<div class="paj-owl-meta">'.esc_attr(get_the_date($post_id )).'</div>';}
                        if ($display_author) {$slide .= '<div class="paj-owl-meta">'. __('Author ','paj-carousel-so-widget') .esc_attr(get_the_author($post_id)).'</div>';}
                        $slide .= '</div></div></a>';
                        $completeslide .= $slide;
                    } else {   // text and meta overlay image
                        $displaytype = "paj-carousel-item-over";
                        $captiontype= "paj-owl-caption-over";
                        if ($force_image_resize) {
                            $slide = '<div class='.$displaytype.'><div class="pajimageframe" ><div class="imgcontainer">'.$imagestring.'</div></div>';
                        } else {
                            $slide = '<div class='.$displaytype.'>'.$imagestring;
                        }
                        $slide .= '<a href=" '.esc_url(get_the_permalink()).' "> <div class=' .$captiontype. '>';
                        if ($display_heading) {$slide .= '<div class="paj-owl-heading"><h3>'.esc_html(get_the_title()).'</h3></div>';}
                        if ($display_excerpt) {$slide .= '<div class="paj-owl-text">'.sanitize_text_field (strip_shortcodes(wp_trim_words( get_the_excerpt(), number_range($paj_word_count,0,50), '...' ))).'</div>';}
                        if ($display_category) {$slide .= '<div class="paj-owl-category">'.strip_tags( get_the_category_list( ', ', $post_id )).'</div>';}
                        if ($display_meta) {$slide .= '<div class="paj-owl-meta">'.esc_attr(get_the_date($post_id )).'</div>';}
                        if ($display_author) {$slide .= '<div class="paj-owl-meta">'. __('Author ','paj-carousel-so-widget') .esc_attr(get_the_author($post_id)).'</div>';}
                        $slide .= '</div></a></div>';
                        $completeslide .= $slide;
                    } // end if slide_boxed_layout
                } // if post has thumbnail
            } // end of if postnumber
        } // end while loop

        wp_reset_postdata();
        $pajoutput = $carousel_title . $pajoutput . $completeslide.'</div>'; 
        return $pajoutput;
        } // if $post_query
    }
add_shortcode('paj-owl-slider', 'paj_carousel_slider_shortcode');
////////////////////////////////////////////////////////END OF SHORTCODE/////////////////////////////
?>