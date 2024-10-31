<?php
/*
Plugin Name: PAJ Featured Image Owl Carousel.
Plugin URI: https://greenorbwebdesign.co.uk/paj-carousel-plugin/
Description: Responsive feature image Carousel slider for posts and pages, use with shortcode or SiteOrigin Widgets Bundle.
Version: 1.2.1
Author: Phillip Johnson
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

defined( 'ABSPATH' ) or die( 'No No No!' );     

//get carousel shortcode file
$shortcode_filename = plugin_dir_path(__FILE__).'paj-widgets/paj-carousel/shortcode/paj-carousel-shortcode.php';

if (file_exists($shortcode_filename)) {
   	require_once( $shortcode_filename);
} else {
    echo "The file $shortcode_filename does not exist";
}


//register paj custom widgets folder 
function add_paj_carousel_custom_widget($folders){
	$folders[] = plugin_dir_path(__FILE__).'paj-widgets/';
	return $folders;
}
add_filter('siteorigin_widgets_widget_folders', 'add_paj_carousel_custom_widget');


// add color to icon widget
add_action('admin_head', 'color_my_icon');

function color_my_icon() {
    echo '<style>
        .paj-icon-color:before {color:#18ce18;}
    </style>';
}

// Add formatting to siteorigin form
add_action('admin_head', 'paj_dashboard_template');

function paj_dashboard_template() {
  echo '<style>
  .siteorigin-widget-field-paj_heading_size::before {  content: "Heading Style:";font-weight:bold; font-size:1.2em;line-height:1.4em;} 
  .siteorigin-widget-field-paj_excerpt_size::before {  content: "Summary Style:";font-size:1.2em;font-weight:bold;line-height:1.4em;} 
  .siteorigin-widget-field-paj_meta_size::before {  content: "Post Category, Author and Date Style:";font-size:1.2em;font-weight:bold;line-height:1.4em;} 
    .siteorigin-widget-field-paj_heading_case,
    .siteorigin-widget-field-paj_heading_weight,
    .siteorigin-widget-field-paj_excerpt_case,
    .siteorigin-widget-field-paj_excerpt_weight,
    .siteorigin-widget-field-paj_meta_case,
    .siteorigin-widget-field-paj_meta_weight,
    .siteorigin-widget-field-paj_heading_color,
    .siteorigin-widget-field-paj_excerpt_color,
    .siteorigin-widget-field-paj_meta_color{
      display:inline-block;
      vertical-align:top;
      min-width:150px;
      margin-right:3%;
    } 
  </style>';
}