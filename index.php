<?php 
/*
Plugin Name: DLINQ calendar filter
Plugin URI:  https://github.com/
Description: For stuff that's practical
Version:     1.0
Author:      DLINQ
Author URI:  https://dlinq.middcreate.net
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /languages
Text Domain: my-toolset

*/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


// add_action('wp_enqueue_scripts', 'prefix_load_scripts');

// function prefix_load_scripts() {                           
//     $deps = array('jquery');
//     $version= '1.0'; 
//     $in_footer = true;    
//     wp_enqueue_script('prefix-main-js', plugin_dir_url( __FILE__) . 'js/prefix-main.js', $deps, $version, $in_footer); 
//     wp_enqueue_style( 'prefix-main-css', plugin_dir_url( __FILE__) . 'css/prefix-main.css');
// }




//LOGGER -- like frogger but more useful

if ( ! function_exists('write_log')) {
   function write_log ( $log )  {
      if ( is_array( $log ) || is_object( $log ) ) {
         error_log( print_r( $log, true ) );
      } else {
         error_log( $log );
      }
   }
}

  //print("<pre>".print_r($a,true)."</pre>");
//from https://theeventscalendar.com/knowledgebase/k/hide-events-of-a-category-on-the-calendar/
add_filter( 'tribe_events_views_v2_view_repository_args', 'tec_exclude_events_category', 10, 3 );
 
function tec_exclude_events_category( $repository_args, $context, $view ) {
  // List of views where the category should be hidden
  $hide_in_views = [
    'month',
    'list',
  ];
 
  if ( in_array( $view->get_slug(), $hide_in_views, true ) ) {
    // List of category slugs to be excluded
    $excluded_categories = [
      'ls-bookings',
      'my-other-category-slug',
    ];
    $repository_args['category_not_in'] = $excluded_categories;
  }
 
  return $repository_args;
}