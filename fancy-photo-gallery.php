<?php
/*
Plugin Name: Kento Simple Fancy Gallery Free
Plugin URI: http://kentothemes.com
Description: Create Fancy Things The Simplest Way With Kento Simple Fancy Gallery. Add Animation Effects to Your Gallery.
Version: 1.0
Author: kentothemes
Author URI: http://kentothemes.com
License URI: http://kentothemes.com/copyright/

*/

	
define('LAZY_PHOTO_GALLERY_PLUGIN_PATH', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );


// lazy photo gallery script register 

function kt_lazy_photo_gallery_script()
	{
	wp_enqueue_script('jquery');
	wp_enqueue_script('plugin-lzpg-js', plugins_url( '/js/jquery.lazy_content.js', __FILE__ ), array('jquery'), '1.0', false);
	wp_enqueue_script('plugin-lzpg-light-js', plugins_url( '/js/jquery.fancybox-1.3.4.pack.js', __FILE__ ), array('jquery'), '1.0', false);		
	wp_enqueue_script('plugin-lzpg-smooth-js', plugins_url( '/js/smoothbox.js', __FILE__ ), array('jquery'), '1.0', false);		
	wp_enqueue_style('lazy-photo-lzpg-main', LAZY_PHOTO_GALLERY_PLUGIN_PATH.'css/style.css');
	wp_enqueue_style('lazy-photo-lzpg-responsive', LAZY_PHOTO_GALLERY_PLUGIN_PATH.'css/media-query.css');
	wp_enqueue_style('lazy-photo-lzpg-light-css', LAZY_PHOTO_GALLERY_PLUGIN_PATH.'css/jquery.fancybox-1.3.4.css');
	wp_enqueue_style('lazy-photo-lzpg-animate-css', LAZY_PHOTO_GALLERY_PLUGIN_PATH.'css/animate.css');	
	wp_enqueue_style('lazy-photo-lzpg-smooth-css', LAZY_PHOTO_GALLERY_PLUGIN_PATH.'css/smoothbox.css');	
	wp_enqueue_style('wp-color-picker');
	wp_enqueue_script('lazy-wp-color-picker', plugins_url(), array( 'wp-color-picker' ), false, true );	
	}
add_action('init', 'kt_lazy_photo_gallery_script');


// lazy photo gallery active script

function kt_lazy_photo_gallery_active_script () {?>
	<script type="text/javascript">
        jQuery(document).ready(function(jQuery){
		  jQuery("div").lazyContent({
			threshold: 0.5,
			load: function(element) {
			  element.find(".loading").hide();
			  element.find("img").each(function() {
				var $img = $(this);
				$img.attr("src", $img.data("src"));
				$img.load(function() { $img.addClass("loaded") });
			  });
	
			  element.find(".content").show();
			}
		  });
        });
    </script>
<?php	
}
add_action('wp_head', 'kt_lazy_photo_gallery_active_script');


// lazy photo gallery custom post-type register 

function kt_lazy_photo_gallery_register() {
 
        $labels = array(
                'name' => _x('Fancy Gallery', 'post type general name'),
                'singular_name' => _x('Lazy Photo', 'post type singular name'),
                'add_new' => _x('Add New Photo', 'light'),
                'add_new_item' => __('Add New Lazy Photo'),
                'edit_item' => __('Edit Lazy Photo'),
                'new_item' => __('New Lazy Photo'),
                'view_item' => __('View Lazy Photo'),
                'search_items' => __('Search Lazy Photo'),
                'not_found' =>  __('Nothing found'),
                'not_found_in_trash' => __('Nothing found in Trash'),
                'parent_item_colon' => ''
        );
 
        $args = array(
                'labels' => $labels,
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'query_var' => true,
                'menu_icon' => null,
                'rewrite' => true,
                'capability_type' => 'post',
                'hierarchical' => false,
                'menu_position' => null,
                'supports' => array('title','thumbnail'),
				'menu_icon' => LAZY_PHOTO_GALLERY_PLUGIN_PATH.'/css/menu-icons.png',
				
          );
 
        register_post_type( 'lazy_gallery' , $args );

}
add_action('init', 'kt_lazy_photo_gallery_register');



// lazy photo gallery option setting's register 

function kt_lazy_photo_gallery_option_init(){
	
	register_setting( 'kt_lazy_gallery_options_setting', 'kt_lazy_photo_gallery_width');
	register_setting( 'kt_lazy_gallery_options_setting', 'kt_lazy_photo_gallery_height');
	register_setting( 'kt_lazy_gallery_options_setting', 'kt_lazy_gallery_animation');	
    }
add_action('admin_init', 'kt_lazy_photo_gallery_option_init' );



// lazy photo gallery shortcode register
 
function kt_lazy_photo_gallery_shortcode_setting($atts, $content = null ) {
		$atts = shortcode_atts(
			array(
				'id' => "",
				), $atts);


			$postid = $atts['id'];
			
			$lazy_gallery="";
			
			
	$kt_lazy_photo_gallery_width = get_option( 'kt_lazy_photo_gallery_width' );			
	$kt_lazy_photo_gallery_height = get_option( 'kt_lazy_photo_gallery_height' );
	$kt_lazy_gallery_animation = get_option( 'kt_lazy_gallery_animation' );			

	$lazy_gallery.='<div class="lazy_container">';
		$lazy_gallery.='<div>';
			$lazy_gallery.='<div class="loading">'; $lazy_gallery.='<span></span>'; $lazy_gallery.='</div>';
   				$lazy_gallery.='<div class="content">';
				
				$args_lazy_photo = array(
				'post_type' => 'lazy_gallery',
				'posts_per_page' => 9
				);	
				$lazy_gallery_query = new WP_Query( $args_lazy_photo );
		

				if($lazy_gallery_query->have_posts()): while($lazy_gallery_query->have_posts()): $lazy_gallery_query->the_post();
		
				$thumb_url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );
					
					
					$lazy_gallery.='<a class="sb" href="'.$thumb_url.'">
						<img style="width:'.$kt_lazy_photo_gallery_width.'px;height:'.$kt_lazy_photo_gallery_height.'px;" class="loaded lazy animate '.$kt_lazy_gallery_animation.' animated" src="'.$thumb_url.'">
						</a>';
					
					endwhile; endif;
					wp_reset_query();
   			$lazy_gallery.='</div>';
		$lazy_gallery.='</div>';
	$lazy_gallery.='</div>';
	return $lazy_gallery;
}
add_shortcode('kt_fancy_gallery', 'kt_lazy_photo_gallery_shortcode_setting');




// lazy photo gallery active option page register

function kt_lazy_photo_gallery_option_settings(){
	include('fancy-gallery-admin.php');
}

// lazy photo gallery admin menu register

function kt_lazy_photo_gallery_menu_init() {

	add_submenu_page('edit.php?post_type=lazy_gallery', __('Fancy Gallery Option','lazygallery_op'), __('Fancy Gallery Option','lazygallery_op'), 'manage_options', 'kt_lazy_photo_gallery_option_settings', 'kt_lazy_photo_gallery_option_settings');
}
add_action('admin_menu', 'kt_lazy_photo_gallery_menu_init');

?>