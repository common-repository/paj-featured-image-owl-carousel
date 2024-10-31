    <?php
    //check if siteorigin post selector has been initialised.  ie user has selected a post group
    if (strpos($instance['slide_section'] ['paj_carousel_posts'], '"from":[]') !== false) {
    //has Not been initialised so set to default value
    $post_type_set ='';
    } else {
        //has been initialised
        $post_type_set = $instance['slide_section'] ['paj_carousel_posts'];
    }


    echo do_shortcode("[paj-owl-slider

        carousel_post_query= ' $post_type_set '

        title= '".$instance['slide_section']['paj_carousel_title']."'
        slide_boxed_layout= '".$instance['slide_section']['boxed_layout']."'
        display_heading= '".$instance['slide_section'] ['paj_post_heading']."'
        display_excerpt= '".$instance['slide_section'] ['paj_post_excerpt']."'

        paj_word_count= '".$instance['slide_section'] ['paj_summary_words']."'

        display_category= '".$instance['slide_section'] ['paj_post_category']."'
        display_meta= '".$instance['slide_section'] ['paj_post_date']."'
        display_author= '".$instance['slide_section'] ['paj_post_author']."'

        touch_drag= '".$instance['carousel_section'] ['paj_carousel_touch_drag']."'
        mouse_drag= '".$instance['carousel_section'] ['paj_carousel_mouse_drag']."'

        force_image_resize= '".$instance['carousel_section'] ['paj_img_resize']."'
        autoplay= '".$instance['carousel_section'] ['paj_carousel_autoplay']."'
        loop= '".$instance['carousel_section'] ['paj_carousel_loop']."'
        pause= '".$instance['carousel_section'] ['paj_carousel_pause']."'
        display_dots= '".$instance['carousel_section'] ['paj_carousel_dots']."'
        display_nav= '".$instance['carousel_section'] ['paj_carousel_nav']."'

        carousel_layout= '".$instance['carousel_section'] ['paj_carousel_layout']."'
        
        
        slide_image_height= '".$instance['carousel_section'] ['paj_image_height']."'
        
        

        smart_speed= '".$instance['carousel_section'] ['paj_carousel_speed']."'
        pause_time= '".$instance['carousel_section'] ['paj_pause_time']."'
        slide_gap= '".$instance['carousel_section'] ['paj_slide_gap']."'
        slides_desktop= '".$instance['carousel_section'] ['paj_noof_desktop_slides']."'
        slides_tablet= '".$instance['carousel_section'] ['paj_noof_tablet_slides']."'

        slides_mobile= '".$instance['carousel_section'] ['paj_noof_phone_slides']."'
        column_number= '".$instance['carousel_section'] ['paj_column_number']."'
        
        
        heading_font_size= '".$instance['paj_style_section'] ['paj_heading_size']."'
        heading_color= '".$instance['paj_style_section'] ['paj_heading_color']."'
        heading_weight= '".$instance['paj_style_section'] ['paj_heading_weight']."'
        heading_case= '".$instance['paj_style_section'] ['paj_heading_case']."'
        
        excerpt_font_size= '".$instance['paj_style_section'] ['paj_excerpt_size']."'
        excerpt_color= '".$instance['paj_style_section'] ['paj_excerpt_color']."'
        excerpt_weight= '".$instance['paj_style_section'] ['paj_excerpt_weight']."'
        excerpt_case= '".$instance['paj_style_section'] ['paj_excerpt_case']."'
        
        meta_font_size= '".$instance['paj_style_section'] ['paj_meta_size']."'
        meta_color= '".$instance['paj_style_section'] ['paj_meta_color']."'
        meta_weight= '".$instance['paj_style_section'] ['paj_meta_weight']."'
        meta_case= '".$instance['paj_style_section'] ['paj_meta_case']."'
        
        slide_background_color= '".$instance['paj_slide_section'] ['paj_background_slide_color']."'
        slide_border_width= '".$instance['paj_slide_section'] ['paj_border_width']."'
        slide_border_style= '".$instance['paj_slide_section'] ['paj_border_style']."'
        slide_border_color= '".$instance['paj_slide_section'] ['paj_border_color']."'
        
        
    ]"); ?>