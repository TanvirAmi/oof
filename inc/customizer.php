<?php
/**
* Theme Customizer
* @package OOF Theme
*/

function oof_customizer_register(){

	// function oof_customize_register($wp_customize){
	// 	$wp_customize->add_section("general_section",
	// 		array(
	// 			'title' => __('General Section', 'site_name_control'),
	// 			'priority' => 30,
	// 		)
	// 	);
	//
	// 	$wp_customize->add_setting('logo_uploader', array(
	// 		'default' => '',
	// 		'transport' => 'refresh'
	// 	));
	//
	// 	$wp_customize->add_setting('footer_text', array(
	// 		'default' => '',
	// 		'transport' => 'postMessage',
	// 	));
	//
	// 	$wp_customize->add_control('footer_text', array(
	// 		'section' => 'general_section',
	// 		'label' => 'Change your footer text',
	// 		'type' => 'text',
	// 	));
	//
	// 	$wp_customize->add_control(
	// 		new WP_Customize_Image_Control($wp_customize, 'logo_uploader', array(
	// 			'section' => 'general_section',
	// 			'label' => 'Upload your logo',
	// 			'settings' => 'logo_uploader',
	// 		))
	// 	);
	//
	// }
	// add_action( 'customize_register', 'oof_customize_register' );

	// Stores all the controls that will be added
	$options = array();

	// Stores all the sections to be added
	$sections = array();

	// Stores all the panels to be added
	$panels = array();

	// Adds the sections to the $options array
	$options['sections'] = $sections;

	// ======= Start Customizer Panels/Sections/Settings ======= //

	// General Panels and Sections
	$general_panel = 'general';
	$panels[] = array(
			'id'          => $general_panel,
			'title'       => esc_html__( 'General', 'oof' ),
			'description' => esc_html__( 'This panel is used for managing general section of your site.', 'oof' ),
			'priority'    => 10
		);
						// Logo
						$section = 'logo-section';

						$sections[] = array(
							'id'          => $section,
							'title'       => esc_html__( 'Logo', 'oof' ),
							'priority'    => 30,
							'panel'       => $general_panel
						);
						$options['logo'] = array(
							'id'      => 'logo',
							'label'   => esc_html__( 'Regular Logo', 'oof' ),
							'section' => $section,
							'type'    => 'media',
							'default' => ''
						);
						// Footer Text
						$section = 'footer-text-section';

						$sections[] = array(
							'id'          => $section,
							'title'       => esc_html__( 'Footer Text', 'oof' ),
							'priority'    => 120,
							'panel'       => $general_panel,
						);
						$options['footer-text'] = array(
							'id'           =>'footer-text',
							'label'        => '',
							'description'  => esc_html__( 'Customize the footer text.', 'oof' ),
							'section'      => $section,
							'type'         => 'textarea',
							'default'      => '&copy; Copyright ' . date( 'Y' ) . ' <a href="' . esc_url( home_url() ) . '">' . esc_attr( get_bloginfo( 'name' ) ) . '</a> &middot; Designed by <a href="http://www.theme-junkie.com/">Theme Junkie</a>'
						);


	// Content Panel and Sections
  $content_panel = 'content';
	$panels[] = array(
		'id'          => $content_panel,
		'title'       => esc_html__( 'Contents', 'oof' ),
		'description' => esc_html__( 'This panel is used for managing several custom content of your site.', 'oof' ),
		'priority'    => 35
	);
				    // Featured posts
						$section = 'featured-section';
						$sections[] = array(
							'id'          => $section,
							'title'       => esc_html__( 'Featured Posts', 'oof' ),
							'priority'    => 5,
							'panel'       => $content_panel
						);
						$options['featured-num'] = array(
							'id'          => 'featured-num',
							'label'       => esc_html__( 'Number of posts', 'oof' ),
							'section'     => $section,
							'type'        => 'text',
							'default'     => 3
						);
						$options['featured-enable'] = array(
							'id'          => 'featured-enable',
							'label'       => esc_html__( 'Show featured slider', 'oof' ),
							'section'     => $section,
							'type'        => 'switch',
							'default'     => 1
						);
						$options['featured-tag'] = array(
							'id'          => 'featured-tag',
							'label'       => esc_html__( 'Select a tag', 'oof' ),
							'description' => esc_html__( 'If you are not selecting any tag, the featured posts will display the most recent posts.', 'reviewpro' ),
							'section'     => $section,
							'type'        => 'select2',
							'choices'     => oof_tags_list()
						);


	// Adds the sections to the $options array
	$options['sections'] = $sections;

	// Adds the panels to the $options array
	$options['panels'] = $panels;

	$customizer_library = Customizer_Library::Instance();
	$customizer_library->add_options( $options );
}
add_action('init', 'oof_customizer_register');
?>
