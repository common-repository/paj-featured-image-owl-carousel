<?php
/*
Widget Name: PAJ Owl Carousel
Description: Responsive featured image Carousel for posts and pages.
Author: Phillip Johnson
*/

defined( 'ABSPATH' ) or die( 'No No No!' );

class paj_carousel_Widget extends SiteOrigin_Widget {
	function __construct() {
		parent::__construct(
			'paj-carousel-widget',
			__('PAJ Owl Carousel', 'paj-carousel-display-widget'),
		   	array(
				'description' => __( 'Responsive featured image Carousel for posts and pages.', 'paj-carousel-display-widget'),
                'panels_icon' => 'dashicons dashicons-admin-generic paj-icon-color',    
                'has_preview' => false,
			),

		plugin_dir_path(__FILE__)
		);
	}

    	function get_widget_form(){
		return array(
        'slide_section' => array(
            'type' => 'section',
            'label' => __( 'Carousel Slide Content.' , 'paj-carousel-display-widget' ),
            'hide' => true,
            'fields' => array(
            
            'paj_carousel_title' => array(
                    'type' => 'text',
                    'label' => __('Carousel Title', 'paj-carousel-display-widget'),
                    'description' => __('This option displays a title for the carousel', 'paj-carousel-display-widget'),
                    'default' => ''
            ),

            'paj_carousel_posts' => array(
				'type' => 'posts',
				'label' => __('Carousel Posts query', 'so-widgets-bundle'),
			),

            'boxed_layout' => array(
                'type' => 'radio',
                    'label' => __( 'Choose Slide Layout', 'paj-carousel-display-widget' ),
                    'default' => 'true',
                    'options' => array(
                        'true' => __( 'Heading, Summary and meta data below image', 'paj-carousel-display-widget' ),
                        'false' => __( 'Heading, Summary and meta data appear on top of image on Hover', 'paj-carousel-display-widget' )
                    )
            ),

           'paj_post_heading' => array(
                'type' => 'checkbox',
                'label' => __( 'Display Post heading', 'widget-form-fields-text-domain' ),
                'default' => true
            ),

            'paj_post_excerpt' => array(
                'type' => 'checkbox',
                'label' => __( 'Display Post Summary', 'paj-carousel-display-widget' ),
                'default' => false
            ),

            'paj_post_category' => array(
                'type' => 'checkbox',
                'label' => __( 'Display Post Category', 'paj-carousel-display-widget' ),
                'default' => false
            ),

            'paj_post_date' => array(
                'type' => 'checkbox',
                'label' => __( 'Display Post Date', 'paj-carousel-display-widget' ),
                'default' => false
            ),

            'paj_post_author' => array(
                'type' => 'checkbox',
                'label' => __( 'Display author', 'paj-carousel-display-widget' ),
                'default' => false
            ),

            'paj_summary_words' => array(
                'type' => 'slider',
                'label' => __( 'Numbr of words in post summary', 'paj-carousel-display-widget' ),
                'default' => 10,
                'min' => 0,
                'max' => 50,
                'integer' => true
            ),


            )

        ),    //End of section

     
        'carousel_section' => array(
            'type' => 'section',
            'label' => __( 'Carousel General Settings' , 'widget-form-fields-text-domain' ),
            'hide' => true,
            'fields' => array(

                'paj_carousel_layout' => array(
                    'type' => 'radio',
                    'label' => __( 'Choose Slide Layout', 'paj-carousel-display-widget' ),
                    'default' => 'layout_1',
                    'options' => array(
                        'original' => __( 'Original Layout', 'paj-carousel-display-widget' ),
                        'layout_1' => __( 'Navigation Arrows Top Right', 'paj-carousel-display-widget' )
                    )
            ),

                'paj_img_resize' => array(
                    'type' => 'checkbox',
                    'label' => __( 'Force Image Equal Heights', 'paj-carousel-display-widget' ),
                    'default' => false
                ),
                
                'paj_image_height' => array(
                    'type' => 'text',
                    'label' => __('Shorten Image height', 'paj-carousel-display-widget'),
                    'description' => __('This option only works when Force Image Equal Heights has been selected. Default Value is blank', 'paj-carousel-display-widget'),
                    'default' => ''
                ),

                'paj_carousel_autoplay' => array(
                    'type' => 'checkbox',
                    'label' => __( 'Autoplay', 'paj-carousel-display-widget' ),
                    'default' => false
                ),

                'paj_carousel_loop' => array(
                    'type' => 'checkbox',
                    'label' => __( 'Loop', 'paj-carousel-display-widget' ),
                    'default' => false
                ),

                'paj_carousel_pause' => array(
                    'type' => 'checkbox',
                    'label' => __( 'Pause on Hover', 'paj-carousel-display-widget' ),
                    'default' => false
                ),

                'paj_carousel_dots' => array(
                    'type' => 'checkbox',
                    'label' => __( 'Display Navigation Dots', 'paj-carousel-display-widget' ),
                    'default' => false
                ),

                'paj_carousel_nav' => array(
                    'type' => 'checkbox',
                    'label' => __( 'Display Navigation', 'paj-carousel-display-widget' ),
                    'default' => false
                ),

                 'paj_carousel_touch_drag' => array(
                    'type' => 'checkbox',
                    'label' => __( 'Tablet Slide Drag', 'paj-carousel-display-widget' ),
                    'default' => false
                ),

                 'paj_carousel_mouse_drag' => array(
                    'type' => 'checkbox',
                    'label' => __( 'Mouse Slide Drag', 'paj-carousel-display-widget' ),
                    'default' => false
                ),

                'paj_carousel_speed' => array(
                    'type' => 'slider',
                    'label' => __( 'Carousel Speed', 'paj-carousel-display-widget' ),
                    'default' => 700,
                    'min' => 100,
                    'max' => 3000,
                    'integer' => true
                ),

                'paj_pause_time' => array(
                    'type' => 'slider',
                    'label' => __( 'Carousel Pause Time', 'paj-carousel-display-widget' ),
                    'default' => 200,
                    'min' => 0,
                    'max' => 2000,
                    'integer' => true
                ),

                'paj_slide_gap' => array(
                    'type' => 'slider',
                    'label' => __( 'Gap Between Slides', 'paj-carousel-display-widget' ),
                    'default' => 10,
                    'min' => 0,
                    'max' => 90,
                    'integer' => true
                ),

             'paj_noof_desktop_slides' => array(
                'type' => 'slider',
                'label' => __( 'Number of Slides displayed on Desktop', 'paj-carousel-display-widget' ),
                'default' => 3,
                'min' => 1,
                'max' => 20,
                'integer' => true
            ),
             'paj_noof_tablet_slides' => array(
                'type' => 'slider',
                'label' => __( 'Number of Slides displayed on tablet', 'paj-carousel-display-widget' ),
               'default' => 2,
                'min' => 1,
                'max' => 10,
                'integer' => true
            ),
             'paj_noof_phone_slides' => array(
                'type' => 'slider',
                'label' => __( 'Number of Slides displayed on phone', 'paj-carousel-display-widget' ),
                'default' => 1,
                'min' => 1,
                'max' => 5,
                'integer' => true
            ),

             'paj_column_number' => array(
                    'type' => 'slider',
                    'label' => __( 'Number of Columns on page (Use to improve Google page speed Optimize images)', 'paj-carousel-display-widget' ),
                    'default' => 1,
                    'min' => 1,
                    'max' => 10,
                    'integer' => true
                ),




            )
        ), // end of section

      
        'paj_style_section' => array(
            'type' => 'section',
            'label' => __( 'Carousel Style Settings' , 'paj-carousel-display-widget' ),
            'hide' => true,
            'fields' => array(
                'paj_heading_size' => array(
                'type' => 'slider',
                'label' => __( 'Font Size', 'paj-carousel-display-widget' ),
                'default' => 'inherit',
                'min' => 0,
                'max' => 50,
                'integer' => true
            ),
                
            'paj_heading_case' => array(
                 'type' => 'radio',
			     'label' => __( 'Font Case', 'paj-carousel-display-widget' ),
                'default'     => '20',
			     'options' => array(
                    'inherit' => 'Inherit',
				    'uppercase' => 'Uppercase',
				    'lowercase' => 'Lowercase',
                )
			),
            
            'paj_heading_weight' => array(
                 'type' => 'radio',
			     'label' => __( 'Font Weight', 'paj-carousel-display-widget' ),
                'default'     => 'inherit',
			     'options' => array(
				    'inherit' => 'Inherit',
				    'lighter' => 'Light',
				    'bold' => 'Bold',
                    'bolder' => 'Bolder',
                )
			),
            
             'paj_heading_color' => array(
				'type' => 'color',
				'label' => __('Heading Colour', 'paj-carousel-display-widget'),
                 'default' => ''
            ),

            'paj_excerpt_size' => array(
                'type' => 'slider',
                'label' => __( 'Font Size', 'paj-carousel-display-widget' ),
                'default' => 14,
                'min' => 0,
                'max' => 30,
                'integer' => true
            ),
            
            'paj_excerpt_case' => array(
                 'type' => 'radio',
			     'label' => __( 'Font Case', 'paj-carousel-display-widget' ),
                'default'     => 'inherit',
			     'options' => array(
                    'inherit' => 'Inherit',
				    'uppercase' => 'Uppercase',
				    'lowercase' => 'Lowercase',
                )
			),
            
            'paj_excerpt_weight' => array(
                 'type' => 'radio',
			     'label' => __( 'Font Weight', 'paj-carousel-display-widget' ),
                'default'     => 'inherit',
			     'options' => array(
				    'inherit' => 'Inherit',
				    'lighter' => 'Light',
				    'bold' => 'Bold',
                    'bolder' => 'Bolder',
                )
			),
            
             'paj_excerpt_color' => array(
				'type' => 'color',
				'label' => __('Excerpt Text Colour', 'paj-carousel-display-widget'),
                 'default' => ''
            ),

            'paj_meta_size' => array(
                'type' => 'slider',
                'label' => __( 'Font Size', 'paj-carousel-display-widget' ),
                'default' => 12,
                'min' => 0,
                'max' => 20,
                'integer' => true
            ),
                
             'paj_meta_case' => array(
                 'type' => 'radio',
			     'label' => __( 'Font Case', 'paj-carousel-display-widget' ),
                'default'     => 'inherit',
			     'options' => array(
                    'inherit' => 'Inherit',
				    'uppercase' => 'Uppercase',
				    'lowercase' => 'Lowercase',
                )
			),
            
            'paj_meta_weight' => array(
                 'type' => 'radio',
			     'label' => __( 'Font Weight', 'paj-carousel-display-widget' ),
                'default'     => 'inherit',
			     'options' => array(
				    'inherit' => 'Inherit',
				    'lighter' => 'Light',
				    'bold' => 'Bold',
                    'bolder' => 'Bolder',
                )
			),
                              
            'paj_meta_color' => array(
				'type' => 'color',
				'label' => __('Post Category, author and Date Text Colour', 'paj-carousel-display-widget'),
                 'default' => ''
            ),
                
            )
        ),   //End of Style Section   
            
        'paj_slide_section' => array(
            'type' => 'section',
            'label' => __( 'Carousel Slide Style' , 'paj-carousel-display-widget' ),
            'hide' => true,
            'fields' => array(
                'paj_background_slide_color' => array(
				'type' => 'color',
				'label' => __('Slide Text Background Colour', 'paj-carousel-display-widget'),
                'description' => __('This colour will also be used for the image overlay if chosen in "Slide Layout"', 'paj-carousel-display-widget'),
                 'default' => ''
            ),
                
                
          'paj_border_color' => array(
				'type' => 'color',
				'label' => __('Slide Border Color', 'paj-carousel-display-widget'),
                 'default' => ''
            ),       
                
                
           'paj_border_width' => array(
                 'type' => 'select',
			     'label' => __( 'Border Width', 'paj-carousel-display-widget' ),
                'default'     => '2',
			     'options' => array(
				    '0' => '0',
				    '1' => '1',
				    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                    '7' => '7',
                    '8' => '8',
                    '9' => '9',
                    '10' => '10',
                )
			),
                
           'paj_border_style' => array(
                 'type' => 'select',
			     'label' => __( 'Border Style', 'paj-carousel-display-widget' ),
                'default'     => 'solid',
			     'options' => array(
				    'none' => 'none',
				    'solid' => 'solid',
                    'double' => 'double',
                    'groove' => 'groove',
                    'ridge' => 'ridge',
                    'inset' => 'inset',
                    'outset' => 'outset',
                    'dotted' => 'dotted',
                    'dashed' => 'dashed',
                )
			),     
                
                
                
        ),
            
            
            
            
            
            
            
    
 )//End of Style Section   


		);

	}



	function get_template_name($instance) {
  		return 'paj-carousel-template';
  	}

	function get_style_name($instance) {
		return '';
	}

}

siteorigin_widget_register('paj-carousel-widget', __FILE__, 'paj_carousel_Widget');