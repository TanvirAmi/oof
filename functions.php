<?php

function oof_script_enqueue() {
	//css
	wp_enqueue_style('customstyle', get_template_directory_uri() . '/css/oof.css', array(), '1.0.0', 'all');
	wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '4.0.0', 'all');
	wp_enqueue_style('slicknav-css', get_template_directory_uri() . '/css/slicknav.css');
	//js
	wp_enqueue_script('customjs', get_template_directory_uri() . '/js/oof.js', array(), '1.0.0', true);
	wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '4.0.0', true);
	wp_enqueue_script('jquery');

	//superfish
	wp_enqueue_script('super-fish', get_template_directory_uri() . '/js/superfish.js');
	wp_enqueue_script('super-sub', get_template_directory_uri() . '/js/supersubs.js');

	//slicknav for samall screen
	wp_enqueue_script('mobile-nav', get_template_directory_uri() . '/js/jquery.slicknav.js');



}

add_action( 'wp_enqueue_scripts', 'oof_script_enqueue');

function oof_theme_setup(){
	add_theme_support( 'menus' );
	register_nav_menu( 'primary','Header primary location' );
	register_nav_menu( 'secondary','Footer secondary location' );
}
add_action( 'init', 'oof_theme_setup');
//theme suuport
add_theme_support( 'custom-background' );
add_theme_support( 'custom-header' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'post-formats', array('aside','video','image') );
// Enable support for HTML5 markup.
add_theme_support(
	'html5',
	array( 'comment-list', 'search-form', 'comment-form', 'gallery', 'caption' )
);

/*
 * Switch default core markup for search form, comment form, and comments
 * to output valid HTML5.
 */
add_theme_support( 'html5', array(
	'comment-list', 'search-form', 'comment-form', 'gallery', 'caption'
) );

//sidebar function
function oof_widget_setup(){
	register_sidebar(
		array(
			'name' 			=> 'Sidebar',
			'id'   			=> 'sidebar-1',
			'description' 	=> 'Standard sidebar',
			'class'			=>'custom',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h1 class="widget-title">',
			'after_title'   => '</h1>'
		)
	 );
}
add_action('widgets_init','oof_widget_setup');

//require template-tags.php
require trailingslashit( get_template_directory() ) . 'inc/template-tags.php';

//require theme customizer
require trailingslashit( get_template_directory() ) . 'inc/customizer.php';

//Include customizer library
require trailingslashit( get_template_directory() ) . 'admin/customizer-library.php';


function oof_remove_version(){
	return '';
}
add_filter('the_generator', 'oof_remove_version');


/*
 * Custom post type
 */
function oof_custom_post_type(){

	$labels = array(
		'name'	=> 'Portfolio',
		'singular_name' => 'Portfolio',
		'add_new' => 'Add Item',
		'all_items' => 'All items',
		'add_new_item' => 'Add Item',
		'edit_item' => 'Edit Item',
		'new_item' => 'New Item',
		'view_item' => 'View Item',
		'search_item' => 'Search Portfolio',
		'not_found' => 'No items found',
		'not_found_in_trash' => 'No item found in trash',
		'parent_item_colon' => "parent Item"
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'has_archive' => true,
		'publicly_queryable' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'revisions'),
		//'taxonomies' => array('category', 'post_tag'),
		'menu_position' => 5,
		'exclude_from_search' => false
	);

	register_post_type('portfolio', $args);
}
add_action('init','oof_custom_post_type');


/*
 * Custom taxonomy
 */

function oof_custom_taxonomy(){

	//add new taxonomy hierarchical
	$labels = array(
		'name' => 'Fields',
		'singular_name' => 'Field',
		'search_items'	=> 'Search Fields',
		'all_items' => 'All Fields',
		'parent_item' => 'Parent Field',
		'parent_item_colon' => 'Parent Field: ',
		'edit_item' => 'Edit Field',
		'update_item' => 'Update Field',
		'add_new_item' => 'Add New Work Field',
		'new_item_name' => 'New Field Name',
		'menu_name' => 'Fields'
	);

	$args = array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'field')
	);

	register_taxonomy( 'field', array('portfolio'), $args);

	//Add new Non Hierarchical taxonomy
	register_taxonomy( 'place', 'portfolio', array(
		'label' => 'Place',
		'rewrite' => array( 'slug' => 'place'),
		'hierarchical' => false
	) );
}

add_action('init', 'oof_custom_taxonomy');

/*
 * Custom Term function to fetch taxonomy
 */

function oof_get_terms($postID, $term){

	$term_list = wp_get_post_terms($postID, $term);
	$output = '';
	$i = 0;
	foreach ($term_list as $term) {
		# code...
		$i++;
		if( $i > 1 ){ $output .= ', '; }
		//echo $term->name. ' ';
		$output .= '<a href=" '.get_term_link( $term ). ' ">' .$term->name.'</a>';
	}
	return $output;
}

add_action('customize_register', 'themename_customize_register');
function themename_customize_register($wp_customize) {
    $wp_customize->remove_section( 'title_tagline' );
    $wp_customize->remove_section( 'nav' );
}

//Activate superfish menu for dropdown level
function oof_start_superfish() { ?>

	<script type="text/javascript">
		jQuery( function( $ ) {
			$( document ).ready( function() {
				$('ul.sf-menu').supersubs( {
					minWidth   : 16, // minimum width of sub-menus in em units
					maxWidth   : 40, // maximum width of sub-menus in em units
					extraWidth : 1   // extra width can ensure lines don't sometimes turn over
				} ).superfish();
			} );
		} );
	</script>

<?php }
add_action( 'wp_footer', 'oof_start_superfish' );

/**
 * Custom comment form fields.
 *
 * @since  1.0.0
 * @param  array $fields
 * @return array
 */
function oof_comment_form_fields( $fields ) {

	$commenter = wp_get_current_commenter();
	$req       = get_option( 'require_name_email' );
	$aria_req  = ( $req ? " aria-required='true'" : '' );

	$fields['author'] = '<div class="row"><div class="form-group col-md-4 comment-form-author"><label for="author">' . __( 'Name (required)', 'gomedia' ) . '</label><input class="form-control" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div>';

	$fields['email'] = '<div class="form-group col-md-4 comment-form-email"><label for="email">' . __( 'Email (required)', 'gomedia' ) . '</label><input class="form-control" id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div>';

	$fields['url'] = '<div class="form-group col-md-4 comment-form-url"><label for="url">' . __( 'Website (optional)', 'gomedia' ) . '</label><input class="form-control" id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div></div><!-- .row -->';


	return $fields;

}
// Custom comment form fields.
add_filter( 'comment_form_default_fields', 'oof_comment_form_fields' );
