<?php
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
add_action( 'customize_preview_init', 'bosa_plumber_customize_preview_js', 999, 1 );

function bosa_plumber_customize_preview_js() {
	wp_enqueue_script( 'bosa-plumber-customizer', get_stylesheet_directory_uri() . '/inc/customizer/customizer.js', array( 'customize-preview' ) );
}

function bosa_plumber_customize_getting_js() {
	wp_dequeue_script( 'bosa-customizer-getting-started' );
	wp_enqueue_script( 'bosa-plumber-customizer-getting-started', get_stylesheet_directory_uri() . '/inc/getting-started/getting-started.js', array( 'customize-controls', 'jquery' ), true );

	wp_enqueue_style( 'bosa-plumber-customize-controls', get_stylesheet_directory_uri() . '/inc/customizer/customizer.css' );
}
add_action( 'customize_controls_enqueue_scripts', 'bosa_plumber_customize_getting_js', 99 );

/**
 * Sanitize checkboxes
 */

function bosa_plumber_sanitize_checkbox( $input ){
	if ( $input === true ) {
        return true;
    } else {
        return false;
    }
}

/**
 * Sanitize Selects
 */
function bosa_plumber_sanitize_select( $input, $setting ){
          
    $input = sanitize_key($input);

    $choices = $setting->manager->get_control( $setting->id )->choices;
                      
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );                
      
}

/**
 * Services section callback
 */
function bosa_plumber_is_enable_services_section(){
	$value = get_theme_mod( 'disable_services_section', true );

	if ( $value ) {
		return false;
	} else {
		return true;
	} 
}

/**
 * Catalogues section callback
 */
function bosa_plumber_is_enable_catalogues_section(){
	$value = get_theme_mod( 'disable_catalogues_section', true );

	if ( $value ) {
		return false;
	} else {
		return true;
	} 
}

/**
 * Renowned brands section callback
 */
function bosa_plumber_is_enable_renowned_brands_section(){
	$value = get_theme_mod( 'disable_renowned_brands_section', true );

	if ( $value ) {
		return false;
	} else {
		return true;
	} 
}

/**
 * Grand events section callback
 */
function bosa_plumber_is_enable_grand_events_section(){
	$value = get_theme_mod( 'disable_grand_events_section', true );

	if ( $value ) {
		return false;
	} else {
		return true;
	} 
}

/**
 * Advertisement section callback
 */
function bosa_plumber_is_enable_blog_advertisement(){
	$value = get_theme_mod( 'blog_advertisement_banner', '' );

	if ( $value ) {
		return true;
	} else {
		return false;
	} 
}

/**
 * Feature post two section callback
 */
function bosa_plumber_is_enable_feature_post_two(){
	$value = get_theme_mod( 'disable_feature_posts_two_section', false );

	if ( $value) {
		return false;
	} else {
		return true;
	} 
}

/**
 * Feature post section callback
 */
function bosa_plumber_is_enable_feature_pages(){
	$value = get_theme_mod( 'disable_featured_pages_section', false );

	if ( $value ) {
		return false;
	} else {
		return true;
	} 
}

function bosa_plumber_customizer_structure( $wp_customize ) {

	// Blog Homepage Options
	$wp_customize->add_panel( 'blog_homepage_options', array(
	    'title' 	 => __( 'Blog Homepage', 'bosa-plumber' ),
	    'priority'	 => 120,
	    'capability' => 'edit_theme_options',
	) );

	// Responsive
	$wp_customize->add_section( 'blog_page_responsive', array(
	    'title'		 => __( 'Responsive', 'bosa-plumber' ),
	    'description'    => esc_html__( 'These options will only apply to Tablet and Mobile devices. Please
	    	click on below Tablet or Mobile Icons to see changes.', 'bosa-plumber' ),
	    'panel' 	 => 'blog_homepage_options',
	    'priority'	 => 50,
	    'capability' => 'edit_theme_options',
	) );

	// featured pages
	$wp_customize->add_section( 'feature_pages_options', array(
	    'title'		 => __( 'Featured Pages', 'bosa-plumber' ),
	    'panel' 	 => 'blog_homepage_options',
	    'priority'	 => 15,
	    'capability' => 'edit_theme_options',
	) );

	$wp_customize->add_setting( 'disable_featured_pages_section', array(
	    'default' 			=> false,
	    'sanitize_callback' => 'bosa_plumber_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'disable_featured_pages_section', array(
	    'label' 	=> __( 'Disable Featured Pages Section', 'bosa-plumber' ),
	    'type' 		=> 'checkbox',
	    'priority'	=> 10,
	    'section' 	=> 'feature_pages_options', 
	) );

	$wp_customize->add_setting( 'disable_featured_pages_section_title', array(
	    'default' 			=> true,
	    'sanitize_callback' => 'bosa_plumber_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'disable_featured_pages_section_title', array(
	    'label' 	=> __( 'Disable Section Title', 'bosa-plumber' ),
	    'type' 		=> 'checkbox',
	    'priority' 	=> 20,
	    'section' 	=> 'feature_pages_options', 
	) );

	$wp_customize->add_setting( 'featured_pages_section_title', array(
		'default' 			=> '',
	    'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'featured_pages_section_title', array(
	    'label' 	=> __( 'Section Title', 'bosa-plumber' ),
	    'type' 		=> 'text',
	    'priority'  => 30,
	    'section' 	=> 'feature_pages_options',
	) );

	$wp_customize->add_setting( 'disable_featured_pages_section_description', array(
	    'default' 			=> true,
	    'sanitize_callback' => 'bosa_plumber_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'disable_featured_pages_section_description', array(
	    'label' 	=> __( 'Disable Section Description', 'bosa-plumber' ),
	    'type' 		=> 'checkbox',
	    'priority'  => 40,
	    'section' 	=> 'feature_pages_options', 
	) );

	$wp_customize->add_setting( 'featured_pages_section_description', array(
		'default' 			=> '',
	    'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'featured_pages_section_description', array(
	    'label' 	=> __( 'Section Description', 'bosa-plumber' ),
	    'type' 		=> 'text',
	    'priority'	=> 50,
	    'section' 	=> 'feature_pages_options',
	) );

	$wp_customize->add_setting( 'featured_pages_section_title_desc_alignment', array(
		'sanitize_callback' => 'bosa_plumber_sanitize_select',
		'default' 			=> 'text-left',
	) );

	$wp_customize->add_control( 'featured_pages_section_title_desc_alignment', array(
		'type' 			=> 'select',
		'section' 		=> 'feature_pages_options',
		'label' 		=> esc_html__( 'Section Title and Description Alignment', 'bosa-plumber' ),
		'choices' 		=> array(
			'text-left'	 	=> esc_html__( 'Left', 'bosa-plumber' ),
			'text-center'  	=> esc_html__( 'Center', 'bosa-plumber' ),   
			'text-right'	=> esc_html__( 'Right', 'bosa-plumber' ),
		),
		'priority'		=> 60,
	) );

	$wp_customize->add_setting( 'featured_pages_columns', array(
		'sanitize_callback' => 'bosa_plumber_sanitize_select',
		'default' 			=> 'four_columns',
	) );

	$wp_customize->add_control( 'featured_pages_columns', array(
		'type' 			=> 'select',
		'section' 		=> 'feature_pages_options',
		'label' 		=> esc_html__( 'Columns', 'bosa-plumber' ),
		'choices'  => array(
			'one_column'    => esc_html__( '1 Column', 'bosa-plumber' ),
			'two_columns'   => esc_html__( '2 Columns', 'bosa-plumber' ),
			'three_columns' => esc_html__( '3 Columns', 'bosa-plumber' ),
			'four_columns'  => esc_html__( '4 Columns', 'bosa-plumber' ),
		),
		'priority'		=> 70,
	) );

	$wp_customize->add_setting( 'featured_pages_one', array(
		'sanitize_callback' => 'bosa_plumber_sanitize_select',
		'default' 			=> '',
	) );

	$wp_customize->add_control( 'featured_pages_one', array(
		'type' 			=> 'select',
		'section' 		=> 'feature_pages_options',
		'label' 		=> esc_html__( 'Page 1', 'bosa-plumber' ),
		'choices'  		=> bosa_plumber_get_pages(),
		'priority'		=> 80,
	) );

	$wp_customize->add_setting( 'featured_pages_two', array(
		'sanitize_callback' => 'bosa_plumber_sanitize_select',
		'default' 			=> '',
	) );

	$wp_customize->add_control( 'featured_pages_two', array(
		'type' 			=> 'select',
		'section' 		=> 'feature_pages_options',
		'label' 		=> esc_html__( 'Page 2', 'bosa-plumber' ),
		'choices'  		=> bosa_plumber_get_pages(),
		'priority'		=> 90,
	) );

	$wp_customize->add_setting( 'featured_pages_three', array(
		'sanitize_callback' => 'bosa_plumber_sanitize_select',
		'default' 			=> '',
	) );

	$wp_customize->add_control( 'featured_pages_three', array(
		'type' 			=> 'select',
		'section' 		=> 'feature_pages_options',
		'label' 		=> esc_html__( 'Page 3', 'bosa-plumber' ),
		'choices'  		=> bosa_plumber_get_pages(),
		'priority'		=> 100,
	) );

	$wp_customize->add_setting( 'featured_pages_four', array(
		'sanitize_callback' => 'bosa_plumber_sanitize_select',
		'default' 			=> '',
	) );

	$wp_customize->add_control( 'featured_pages_four', array(
		'type' 			=> 'select',
		'section' 		=> 'feature_pages_options',
		'label' 		=> esc_html__( 'Page 4', 'bosa-plumber' ),
		'choices'  		=> bosa_plumber_get_pages(),
		'priority'		=> 110,
	) );

	$wp_customize->add_setting( 'featured_pages_title_color', array(
        'default' 			=> '#1a1a1a',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control(
	    new WP_Customize_Color_Control(
	        $wp_customize,
	        'featured_pages_title_color',
	        array(
	            'label' 	=> esc_html__( 'Page Title Color', 'bosa-plumber' ),
	            'section' 	=> 'feature_pages_options',
	            'settings' 	=> 'featured_pages_title_color',
	            'priority'	=> 120,
	        )
	    )
	);

	$wp_customize->add_setting( 'featured_pages_hover_color', array(
        'default' 			=> '#086abd',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control(
	    new WP_Customize_Color_Control(
	        $wp_customize,
	        'featured_pages_hover_color',
	        array(
	            'label' 	=> esc_html__( 'Page Hover Color', 'bosa-plumber' ),
	            'section' 	=> 'feature_pages_options',
	            'settings' 	=> 'featured_pages_hover_color',
	            'priority'	=> 130,
	        )
	    )
	);

	$wp_customize->add_setting( 'featured_pages_overlay_opacity', array(
		'sanitize_callback' => 'absint',
		'default' 			=> 2,
	) );

	$wp_customize->add_control( 'featured_pages_overlay_opacity', array(
		'type' 			=> 'number',
		'section' 		=> 'feature_pages_options',
		'label' 		=> esc_html__( 'Featured Page Overlay Opacity', 'bosa-plumber' ),
		'input_attrs'   => array(
		    'min' => 1,
		    'max' => 9
		),
		'priority'		=> 140,
	) );

	$wp_customize->add_setting( 'render_feature_pages_image_size', array(
		'sanitize_callback' => 'bosa_plumber_sanitize_select',
		'default' 			=> 'bosa-420-300',
	) );

	$wp_customize->add_control( 'render_feature_pages_image_size', array(
		'type' 			=> 'select',
		'section' 		=> 'feature_pages_options',
		'label' 		=> esc_html__( 'Choose Image Size', 'bosa-plumber' ),
		'choices'  		=> bosa_get_intermediate_image_sizes(),
		'priority'		=> 150,
	) );

	$wp_customize->add_setting( 'featured_pages_image_size', array(
		'sanitize_callback' => 'bosa_plumber_sanitize_select',
	    'default' 			=> 'cover',
	) );
	 
	$wp_customize->add_control( 'featured_pages_image_size', array(
        'type' 		=> 'radio',
        'label' 	=> esc_html__( 'Background Image Size', 'bosa-plumber' ),
        'section' 	=> 'feature_pages_options',
        'choices'      => array(
			'cover'    => esc_html__( 'Cover', 'bosa-plumber' ),
			'pattern'  => esc_html__( 'Pattern / Repeat', 'bosa-plumber' ),
			'norepeat' => esc_html__( 'No Repeat', 'bosa-plumber' ),
		),
		'priority'	=> 160,
    ) );

	$wp_customize->add_setting( 'featured_pages_text_alignment', array(
		'sanitize_callback' => 'bosa_plumber_sanitize_select',
		'default' 			=> 'text-center',
	) );

	$wp_customize->add_control( 'featured_pages_text_alignment', array(
		'type' 			=> 'select',
		'section' 		=> 'feature_pages_options',
		'label' 		=> esc_html__( 'Page Title Horizontal Alignment', 'bosa-plumber' ),
		'choices'     => array(
			'text-left'	 	=> esc_html__( 'Left', 'bosa-plumber' ),
			'text-center'  	=> esc_html__( 'Center', 'bosa-plumber' ),   
			'text-right'	=> esc_html__( 'Right', 'bosa-plumber' ),
		),
		'priority'		=> 180,
	) );

	$wp_customize->add_setting( 'featured_pages_title_alignment', array(
		'sanitize_callback' => 'bosa_plumber_sanitize_select',
		'default' 			=> 'align-center',
	) );

	$wp_customize->add_control( 'featured_pages_title_alignment', array(
		'type' 			=> 'select',
		'section' 		=> 'feature_pages_options',
		'label' 		=> esc_html__( 'Page Title Vertical Alignment', 'bosa-plumber' ),
		'choices'     => array(
			'align-top'	 	=> esc_html__( 'Top', 'bosa-plumber' ),
			'align-center'  => esc_html__( 'Center', 'bosa-plumber' ),   
			'align-bottom'  => esc_html__( 'Bottom', 'bosa-plumber' ),
		),
		'priority'		=> 190,
	) );

	$wp_customize->add_setting( 'disable_featured_pages_title', array(
	    'default' 			=> false,
	    'sanitize_callback' => 'bosa_plumber_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'disable_featured_pages_title', array(
	    'label' 	=> __( 'Disable Page Title', 'bosa-plumber' ),
	    'type' 		=> 'checkbox',
	    'priority'	=> 200,
	    'section' 	=> 'feature_pages_options', 
	) );

	$wp_customize->add_setting( 'disable_mobile_feature_pages', array(
	    'default' => false,
	    'sanitize_callback' => 'bosa_plumber_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'disable_mobile_feature_pages', array(
	    'label' => __( 'Disable Featured Pages', 'bosa-plumber' ),
	    'type' => 'checkbox',
	    'priority' => 15,
	    'section' => 'blog_page_responsive', 
	    'active_callback' => 'bosa_plumber_is_enable_feature_pages',
	) );

	// Featured Posts Two
	$wp_customize->add_section( 'feature_posts_two_options', array(
	    'title' 		=> __( 'Featured Posts Two', 'bosa-plumber' ),
	    'panel' 		=> 'blog_homepage_options',
	    'priority' 		=> 25,
	    'capability' 	=> 'edit_theme_options',
	) );

	$wp_customize->add_setting( 'disable_feature_posts_two_section', array(
	    'default' 			=> false,
	    'sanitize_callback' => 'bosa_plumber_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'disable_feature_posts_two_section', array(
	    'label' 	=> __( 'Disable Featured Posts Two Section', 'bosa-plumber' ),
	    'type' 		=> 'checkbox',
	    'priority' 	=> 10,
	    'section' 	=> 'feature_posts_two_options', 
	) );

	$wp_customize->add_setting( 'disable_feature_posts_two_section_title', array(
	    'default' 			=> true,
	    'sanitize_callback' => 'bosa_plumber_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'disable_feature_posts_two_section_title', array(
	    'label' 	=> __( 'Disable Section Title', 'bosa-plumber' ),
	    'type' 		=> 'checkbox',
	    'priority' 	=> 20,
	    'section' 	=> 'feature_posts_two_options', 
	) );

	$wp_customize->add_setting( 'feature_posts_two_section_title', array(
		'default' 			=> '',
	    'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'feature_posts_two_section_title', array(
	    'label'	 	=> __( 'Section Title', 'bosa-plumber' ),
	    'type' 		=> 'text',
	    'priority' 	=> 30,
	    'section' 	=> 'feature_posts_two_options',
	) );

	$wp_customize->add_setting( 'disable_feature_posts_two_section_description', array(
	    'default' 			=> true,
	    'sanitize_callback' => 'bosa_plumber_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'disable_feature_posts_two_section_description', array(
	    'label' 	=> __( 'Disable Section Description', 'bosa-plumber' ),
	    'type' 		=> 'checkbox',
	    'priority' 	=> 50,
	    'section' 	=> 'feature_posts_two_options', 
	) );

	$wp_customize->add_setting( 'feature_posts_two_section_description', array(
		'default' 			=> '',
	    'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'feature_posts_two_section_description', array(
	    'label' 	=> __( 'Section Description', 'bosa-plumber' ),
	    'type' 		=> 'text',
	    'priority' 	=> 60,
	    'section' 	=> 'feature_posts_two_options',
	) );

	$wp_customize->add_setting( 'feature_posts_two_section_title_desc_alignment', array(
		'sanitize_callback' => 'bosa_plumber_sanitize_select',
		'default' 			=> 'text-left',
	) );

	$wp_customize->add_control( 'feature_posts_two_section_title_desc_alignment', array(
		'type' 			=> 'select',
		'section' 		=> 'feature_posts_two_options',
		'label' 		=> esc_html__( 'Section Title and Description Alignment', 'bosa-plumber' ),
		'choices' 		=> array(
			'text-left'	 	=> esc_html__( 'Left', 'bosa-plumber' ),
			'text-center'  	=> esc_html__( 'Center', 'bosa-plumber' ),   
			'text-right'	=> esc_html__( 'Right', 'bosa-plumber' ),
		),		
		'priority'		=> 80,
	) );

	$wp_customize->add_setting( 'feature_posts_two_category', array(
		'sanitize_callback' => 'bosa_plumber_sanitize_select',
		'default' 			=> '',
	) );

	$wp_customize->add_control( 'feature_posts_two_category', array(
		'type' 			=> 'select',
		'section' 		=> 'feature_posts_two_options',
		'label' 		=> esc_html__( 'Choose Category', 'bosa-plumber' ),
		'description' 	=> esc_html__( 'Recent posts will show if any category is not chosen.', 'bosa-plumber' ),
		'choices' 		=> bosa_get_post_categories(),		
		'priority'		=> 90,
	) );

	$wp_customize->add_setting( 'feature_posts_two_title_color', array(
        'default' 			=> '#FFFFFF',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control(
	    new WP_Customize_Color_Control(
	        $wp_customize,
	        'feature_posts_two_title_color',
	        array(
	            'label' 	=> esc_html__( 'Post Title Color', 'bosa-plumber' ),
	            'section' 	=> 'feature_posts_two_options',
	            'settings' 	=> 'feature_posts_two_title_color',
	            'priority'	=> 100,
	        )
	    )
	);

	$wp_customize->add_setting( 'feature_posts_two_category_bgcolor', array(
        'default' 			=> '#EB5A3E',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control(
	    new WP_Customize_Color_Control(
	        $wp_customize,
	        'feature_posts_two_category_bgcolor',
	        array(
	            'label' 	=> esc_html__( 'Post Category Background Color', 'bosa-plumber' ),
	            'section' 	=> 'feature_posts_two_options',
	            'settings' 	=> 'feature_posts_two_category_bgcolor',
	            'priority'	=> 110,
	        )
	    )
	);

	$wp_customize->add_setting( 'feature_posts_two_category_color', array(
        'default' 			=> '#FFFFFF',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control(
	    new WP_Customize_Color_Control(
	        $wp_customize,
	        'feature_posts_two_category_color',
	        array(
	            'label' 	=> esc_html__( 'Post Category Color', 'bosa-plumber' ),
	            'section' 	=> 'feature_posts_two_options',
	            'settings' 	=> 'feature_posts_two_category_color',
	            'priority'	=> 120,
	        )
	    )
	);

	$wp_customize->add_setting( 'feature_posts_two_meta_color', array(
        'default' 			=> '#FFFFFF',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control(
	    new WP_Customize_Color_Control(
	        $wp_customize,
	        'feature_posts_two_meta_color',
	        array(
	            'label' 	=> esc_html__( 'Post Meta Text Color', 'bosa-plumber' ),
	            'section' 	=> 'feature_posts_two_options',
	            'settings' 	=> 'feature_posts_two_meta_color',
	            'priority'	=> 130,
	        )
	    )
	);

	$wp_customize->add_setting( 'feature_posts_two_meta_icon_color', array(
        'default' 			=> '#FFFFFF',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control(
	    new WP_Customize_Color_Control(
	        $wp_customize,
	        'feature_posts_two_meta_icon_color',
	        array(
	            'label' 	=> esc_html__( 'Post Meta Icon Color', 'bosa-plumber' ),
	            'section' 	=> 'feature_posts_two_options',
	            'settings' 	=> 'feature_posts_two_meta_icon_color',
	            'priority'	=> 140,
	        )
	    )
	);

	$wp_customize->add_setting( 'feature_posts_two_hover_color', array(
        'default' 			=> '#a8d8ff',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control(
	    new WP_Customize_Color_Control(
	        $wp_customize,
	        'feature_posts_two_hover_color',
	        array(
	            'label' 	=> esc_html__( 'Post Hover Color', 'bosa-plumber' ),
	            'section' 	=> 'feature_posts_two_options',
	            'settings' 	=> 'feature_posts_two_hover_color',
	            'priority'	=> 150,
	        )
	    )
	);

	$wp_customize->add_setting( 'feature_posts_two_overlay_opacity', array(
		'sanitize_callback' => 'absint',
		'default' 			=> 4,
	) );

	$wp_customize->add_control( 'feature_posts_two_overlay_opacity', array(
		'type' 			=> 'number',
		'section' 		=> 'feature_posts_two_options',
		'label' 		=> esc_html__( 'Posts Overlay Opacity', 'bosa-plumber' ),
		'input_attrs'   => array(
		    'min' => 1,
		    'max' => 9
		),
		'priority'		=> 160,
	) );

	$wp_customize->add_setting( 'render_feature_posts_two_image_size', array(
		'sanitize_callback' => 'bosa_plumber_sanitize_select',
		'default' 			=> 'bosa-420-300',
	) );

	$wp_customize->add_control( 'render_feature_posts_two_image_size', array(
		'type' 			=> 'select',
		'section' 		=> 'feature_posts_two_options',
		'label' 		=> esc_html__( 'Choose Image Size', 'bosa-plumber' ),
		'choices' 		=> bosa_get_intermediate_image_sizes(),		
		'priority'		=> 170,
	) );

	$wp_customize->add_setting( 'feature_posts_two_image_size', array(
		'sanitize_callback' => 'bosa_plumber_sanitize_select',
	    'default' 			=> 'cover',
	) );
	 
	$wp_customize->add_control( 'feature_posts_two_image_size', array(
        'type' 		=> 'radio',
        'label' 	=> esc_html__( 'Background Image Size', 'bosa-plumber' ),
        'section' 	=> 'feature_posts_two_options',
        'choices'      => array(
			'cover'    => esc_html__( 'Cover', 'bosa-plumber' ),
			'pattern'  => esc_html__( 'Pattern / Repeat', 'bosa-plumber' ),
			'norepeat' => esc_html__( 'No Repeat', 'bosa-plumber' ),
		),
		'priority'	=> 180,
    ) );

	$wp_customize->add_setting( 'feature_posts_two_horizontal_alignment', array(
		'sanitize_callback' => 'bosa_plumber_sanitize_select',
		'default' 			=> 'text-left',
	) );

	$wp_customize->add_control( 'feature_posts_two_horizontal_alignment', array(
		'type' 			=> 'select',
		'section' 		=> 'feature_posts_two_options',
		'label' 		=> esc_html__( 'Post Content Horizontal Alignment', 'bosa-plumber' ),
		'choices' 		=> array(
			'text-left'	 	=> esc_html__( 'Left', 'bosa-plumber' ),
			'text-center'  	=> esc_html__( 'Center', 'bosa-plumber' ),   
			'text-right'	=> esc_html__( 'Right', 'bosa-plumber' ),
		),		
		'priority'		=> 200,
	) );

	$wp_customize->add_setting( 'feature_posts_two_vertical_title_alignment', array(
		'sanitize_callback' => 'bosa_plumber_sanitize_select',
		'default' 			=> 'align-bottom',
	) );

	$wp_customize->add_control( 'feature_posts_two_vertical_title_alignment', array(
		'type' 			=> 'select',
		'section' 		=> 'feature_posts_two_options',
		'label' 		=> esc_html__( 'Post Content Vertical Alignment', 'bosa-plumber' ),
		'choices' 		=> array(
			'align-top'	 	=> esc_html__( 'Top', 'bosa-plumber' ),
			'align-center'  => esc_html__( 'Center', 'bosa-plumber' ),   
			'align-bottom'  => esc_html__( 'Bottom', 'bosa-plumber' ),
		),		
		'priority'		=> 210,
	) );

	$wp_customize->add_setting( 'disable_feature_posts_two_title', array(
	    'default' => false,
	    'sanitize_callback' => 'bosa_plumber_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'disable_feature_posts_two_title', array(
	    'label' 	=> __( 'Disable Post Title', 'bosa-plumber' ),
	    'type' 		=> 'checkbox',
	    'priority' 	=> 220,
	    'section' 	=> 'feature_posts_two_options', 
	) );

	$wp_customize->add_setting( 'hide_feature_posts_two_category', array(
	    'default' 			=> false,
	    'sanitize_callback' => 'bosa_plumber_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'hide_feature_posts_two_category', array(
	    'label' 	=> __( 'Disable Posts category', 'bosa-plumber' ),
	    'type' 		=> 'checkbox',
	    'priority' 	=> 250,
	    'section' 	=> 'feature_posts_two_options', 
	) );

	$wp_customize->add_setting( 'hide_feature_posts_two_date', array(
	    'default' 			=> false,
	    'sanitize_callback' => 'bosa_plumber_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'hide_feature_posts_two_date', array(
	    'label' 	=> __( 'Disable Post Date', 'bosa-plumber' ),
	    'type' 		=> 'checkbox',
	    'priority' 	=> 270,
	    'section' 	=> 'feature_posts_two_options', 
	) );

	$wp_customize->add_setting( 'hide_feature_posts_two_author', array(
	    'default' 			=> false,
	    'sanitize_callback' => 'bosa_plumber_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'hide_feature_posts_two_author', array(
	    'label' 	=> __( 'Disable Post Author', 'bosa-plumber' ),
	    'type' 		=> 'checkbox',
	    'priority' 	=> 280,
	    'section' 	=> 'feature_posts_two_options', 
	) );

	$wp_customize->add_setting( 'hide_feature_posts_two_comment', array(
	    'default' 			=> false,
	    'sanitize_callback' => 'bosa_plumber_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'hide_feature_posts_two_comment', array(
	    'label' 	=> __( 'Disable Post Comment', 'bosa-plumber' ),
	    'type' 		=> 'checkbox',
	    'priority' 	=> 290,
	    'section' 	=> 'feature_posts_two_options', 
	) );

	$wp_customize->add_setting( 'disable_mobile_feature_posts_two', array(
	    'default' 			=> false,
	    'sanitize_callback' => 'bosa_plumber_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'disable_mobile_feature_posts_two', array(
	    'label' 			=> __( 'Disable Featured Posts Two', 'bosa-plumber' ),
	    'type' 				=> 'checkbox',
	    'priority' 			=> 25,
	    'section' 			=> 'blog_page_responsive', 
	    'active_callback' 	=> 'bosa_plumber_is_enable_feature_post_two',
	) );

	// Blog advertisement banner

	$wp_customize->add_section( 'blog_advert_banner_options', array(
	    'title' => __( 'Blog Advertisement Banner', 'bosa-plumber' ),
	    'panel' => 'blog_homepage_options',
	    'priority' => 24,
	    'capability' => 'edit_theme_options',
	) );

	$wp_customize->add_setting( 'blog_advertisement_banner', array(
		'default'           => '',
		'sanitize_callback' => 'absint',
	) );
	
	$wp_customize->add_control( 
		new WP_Customize_Media_Control( 
			$wp_customize, 
			'blog_advertisement_banner',
			array(
				'label'           => __( 'Advertisement Banner', 'bosa-plumber' ),
				'description'  	  => esc_html__( 'Image dimensions 1230 by 100 pixels is recommended.', 'bosa-plumber' ),
				'section'         => 'blog_advert_banner_options',
				'mime_type'       => 'image',
				'priority'	      => 10
			)
		)
	);

	$wp_customize->add_setting( 'render_blog_ad_image_size', array(
		'sanitize_callback' => 'bosa_plumber_sanitize_select',
		'default' 			=> '',
	) );

	$wp_customize->add_control( 'render_blog_ad_image_size', array(
		'type' 			=> 'select',
		'section' 		=> 'blog_advert_banner_options',
		'label' 		=> esc_html__( 'Choose Image Size', 'bosa-plumber' ),
		'choices' 		=> bosa_get_intermediate_image_sizes(),
		'priority'		=> 15,
	) );

	$wp_customize->add_setting( 'blog_advertisement_banner_link', array(
		'default' => '#',
	    'sanitize_callback' => 'sanitize_url',
	) );

	$wp_customize->add_control( 'blog_advertisement_banner_link', array(
	    'label' => __( 'Advertisement Banner Link', 'bosa-plumber' ),
	    'type' => 'link',
	    'priority' => 20,
	    'section' => 'blog_advert_banner_options',
	) );

	$wp_customize->add_setting( 'blog_advertisement_banner_target', array(
	    'default' 			=> true,
	    'sanitize_callback' => 'bosa_plumber_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'blog_advertisement_banner_target', array(
	    'label' 		=> __( 'Advertisement Banner Target', 'bosa-plumber' ),
	    'description' 	=> esc_html__( 'If enabled, the page will be open in an another browser tab.', 'bosa-plumber' ),
	    'type' 			=> 'checkbox',
	    'priority' 		=> 30,
	    'section' 		=> 'blog_advert_banner_options', 
	) );

	$wp_customize->add_setting( 'disable_mobile_blog_advertisement_banner', array(
	    'default' => false,
	    'sanitize_callback' => 'bosa_plumber_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'disable_mobile_blog_advertisement_banner', array(
	    'label' => __( 'Disable Advertisement Banner', 'bosa-plumber' ),
	    'type' => 'checkbox',
	    'priority' => 24,
	    'section' => 'blog_page_responsive', 
	    'active_callback' => 'bosa_plumber_is_enable_blog_advertisement',
	) );

	//Services
	$wp_customize->add_section( 'blog_services', array(
	    'title' => __( 'Services', 'bosa-plumber' ),
	    'panel' => 'blog_homepage_options',
	    'priority' => 26,
	    'capability' => 'edit_theme_options',
	) );

	$wp_customize->add_setting( 'disable_services_section', array(
	    'default' => true,
	    'sanitize_callback' => 'bosa_plumber_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'disable_services_section', array(
	    'label' => __( 'Disable Services Section', 'bosa-plumber' ),
	    'type' => 'checkbox',
	    'priority' => 10,
	    'section' => 'blog_services', 
	) );

	$wp_customize->add_setting( 'blog_services_page_one', array(
		'sanitize_callback' => 'bosa_plumber_sanitize_select',
		'default' 			=> '',
	) );

	$wp_customize->add_control( 'blog_services_page_one', array(
		'type' 			=> 'select',
		'section' 		=> 'blog_services',
		'label' 		=> esc_html__( 'Page 1', 'bosa-plumber' ),
		'choices' 		=> bosa_plumber_get_pages(),
		'priority'		=> 20,
	) );

	$wp_customize->add_setting( 'blog_services_page_two', array(
		'sanitize_callback' => 'bosa_plumber_sanitize_select',
		'default' 			=> '',
	) );

	$wp_customize->add_control( 'blog_services_page_two', array(
		'type' 			=> 'select',
		'section' 		=> 'blog_services',
		'label' 		=> esc_html__( 'Page 2', 'bosa-plumber' ),
		'choices' 		=> bosa_plumber_get_pages(),
		'priority'		=> 30,
	) );

	$wp_customize->add_setting( 'blog_services_page_three', array(
		'sanitize_callback' => 'bosa_plumber_sanitize_select',
		'default' 			=> '',
	) );

	$wp_customize->add_control( 'blog_services_page_three', array(
		'type' 			=> 'select',
		'section' 		=> 'blog_services',
		'label' 		=> esc_html__( 'Page 3', 'bosa-plumber' ),
		'choices' 		=> bosa_plumber_get_pages(),
		'priority'		=> 40,
	) );

	$wp_customize->add_setting( 'blog_services_page_four', array(
		'sanitize_callback' => 'bosa_plumber_sanitize_select',
		'default' 			=> '',
	) );

	$wp_customize->add_control( 'blog_services_page_four', array(
		'type' 			=> 'select',
		'section' 		=> 'blog_services',
		'label' 		=> esc_html__( 'Page 4', 'bosa-plumber' ),
		'choices' 		=> bosa_plumber_get_pages(),
		'priority'		=> 50,
	) );

	$wp_customize->add_setting( 'disable_mobile_services', array(
	    'default' => false,
	    'sanitize_callback' => 'bosa_plumber_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'disable_mobile_services', array(
	    'label' => __( 'Disable Services', 'bosa-plumber' ),
	    'type' => 'checkbox',
	    'priority' => 26,
	    'section' => 'blog_page_responsive',
	    'active_callback' => 'bosa_plumber_is_enable_services_section',
	) );

	// Catalogues
	$wp_customize->add_section( 'blog_catalogues', array(
	    'title' => __( 'Catalogues', 'bosa-plumber' ),
	    'description'  	 => esc_html__( 'WooCommerce plugin is required for this section.', 'bosa-plumber' ),
	    'panel' => 'blog_homepage_options',
	    'priority' => 27,
	    'capability' => 'edit_theme_options',
	) );

	$wp_customize->add_setting( 'disable_catalogues_section', array(
	    'default' => true,
	    'sanitize_callback' => 'bosa_plumber_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'disable_catalogues_section', array(
	    'label' => __( 'Disable Catalogues Section', 'bosa-plumber' ),
	    'type' => 'checkbox',
	    'priority' => 10,
	    'section' => 'blog_catalogues', 
	) );

	$wp_customize->add_setting( 'catalog_list_title_one', array(
		'default' => '',
	    'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'catalog_list_title_one', array(
	    'label' => __( 'Catalogue One Title', 'bosa-plumber' ),
	    'type' => 'text',
	    'priority' => 20,
	    'section' => 'blog_catalogues',
	) );
	
	$wp_customize->add_setting( 'catalog_image_one', array(
		'default'           => '',
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 
		new WP_Customize_Media_Control( 
			$wp_customize, 
			'catalog_image_one',
			array(
				'label'           => __( 'Image One', 'bosa-plumber' ),
				'section'         => 'blog_catalogues',
				'mime_type'       => 'image',
				'priority'	      => 30
			)
		)
	);

	$wp_customize->add_setting( 'catalog_list_one', array(
		'sanitize_callback' => 'bosa_plumber_sanitize_select',
		'default' 			=> '',
	) );

	$wp_customize->add_control( 'catalog_list_one', array(
		'type' 			=> 'select',
		'section' 		=> 'blog_catalogues',
		'label' 		=> esc_html__( 'Image One Category', 'bosa-plumber' ),
		'choices' 		=> bosa_plumber_get_product_categories(),
		'priority'		=> 40,
	) );

	$wp_customize->add_setting( 'catalog_image_two', array(
		'default'           => '',
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 
		new WP_Customize_Media_Control( 
			$wp_customize, 
			'catalog_image_two',
			array(
				'label'           => __( 'Image Two', 'bosa-plumber' ),
				'section'         => 'blog_catalogues',
				'mime_type'       => 'image',
				'priority'	      => 50
			)
		)
	);

	$wp_customize->add_setting( 'catalog_list_two', array(
		'sanitize_callback' => 'bosa_plumber_sanitize_select',
		'default' 			=> '',
	) );

	$wp_customize->add_control( 'catalog_list_two', array(
		'type' 			=> 'select',
		'section' 		=> 'blog_catalogues',
		'label' 		=> esc_html__( 'Image Two Category', 'bosa-plumber' ),
		'choices' 		=> bosa_plumber_get_product_categories(),
		'priority'		=> 60,
	) );

	$wp_customize->add_setting( 'catalog_image_three', array(
		'default'           => '',
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 
		new WP_Customize_Media_Control( 
			$wp_customize, 
			'catalog_image_three',
			array(
				'label'           => __( 'Image Three', 'bosa-plumber' ),
				'section'         => 'blog_catalogues',
				'mime_type'       => 'image',
				'priority'	      => 70
			)
		)
	);

	$wp_customize->add_setting( 'catalog_list_three', array(
		'sanitize_callback' => 'bosa_plumber_sanitize_select',
		'default' 			=> '',
	) );

	$wp_customize->add_control( 'catalog_list_three', array(
		'type' 			=> 'select',
		'section' 		=> 'blog_catalogues',
		'label' 		=> esc_html__( 'Image Three Category', 'bosa-plumber' ),
		'choices' 		=> bosa_plumber_get_product_categories(),
		'priority'		=> 80,
	) );

	$wp_customize->add_setting( 'catalog_image_four', array(
		'default'           => '',
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 
		new WP_Customize_Media_Control( 
			$wp_customize, 
			'catalog_image_four',
			array(
				'label'           => __( 'Image Four', 'bosa-plumber' ),
				'section'         => 'blog_catalogues',
				'mime_type'       => 'image',
				'priority'	      => 90
			)
		)
	);

	$wp_customize->add_setting( 'catalog_list_four', array(
		'sanitize_callback' => 'bosa_plumber_sanitize_select',
		'default' 			=> '',
	) );

	$wp_customize->add_control( 'catalog_list_four', array(
		'type' 			=> 'select',
		'section' 		=> 'blog_catalogues',
		'label' 		=> esc_html__( 'Image Four Category', 'bosa-plumber' ),
		'choices' 		=> bosa_plumber_get_product_categories(),
		'priority'		=> 100,
	) );

	$wp_customize->add_setting( 'catalog_list_title_two', array(
		'default' => '',
	    'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'catalog_list_title_two', array(
	    'label' => __( 'Catalogue Two Title', 'bosa-plumber' ),
	    'type' => 'text',
	    'priority' => 110,
	    'section' => 'blog_catalogues',
	) );
	
	$wp_customize->add_setting( 'catalog_image_five', array(
		'default'           => '',
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 
		new WP_Customize_Media_Control( 
			$wp_customize, 
			'catalog_image_five',
			array(
				'label'           => __( 'Image Five', 'bosa-plumber' ),
				'section'         => 'blog_catalogues',
				'mime_type'       => 'image',
				'priority'	      => 120
			)
		)
	);

	$wp_customize->add_setting( 'catalog_list_five', array(
		'sanitize_callback' => 'bosa_plumber_sanitize_select',
		'default' 			=> '',
	) );

	$wp_customize->add_control( 'catalog_list_five', array(
		'type' 			=> 'select',
		'section' 		=> 'blog_catalogues',
		'label' 		=> esc_html__( 'Image Five Category', 'bosa-plumber' ),
		'choices' 		=> bosa_plumber_get_product_categories(),
		'priority'		=> 130,
	) );

	$wp_customize->add_setting( 'catalog_image_six', array(
		'default'           => '',
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 
		new WP_Customize_Media_Control( 
			$wp_customize, 
			'catalog_image_six',
			array(
				'label'           => __( 'Image Six', 'bosa-plumber' ),
				'section'         => 'blog_catalogues',
				'mime_type'       => 'image',
				'priority'	      => 140
			)
		)
	);

	$wp_customize->add_setting( 'catalog_list_six', array(
		'sanitize_callback' => 'bosa_plumber_sanitize_select',
		'default' 			=> '',
	) );

	$wp_customize->add_control( 'catalog_list_six', array(
		'type' 			=> 'select',
		'section' 		=> 'blog_catalogues',
		'label' 		=> esc_html__( 'Image Six Category', 'bosa-plumber' ),
		'choices' 		=> bosa_plumber_get_product_categories(),
		'priority'		=> 160,
	) );

	$wp_customize->add_setting( 'catalog_image_seven', array(
		'default'           => '',
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 
		new WP_Customize_Media_Control( 
			$wp_customize, 
			'catalog_image_seven',
			array(
				'label'           => __( 'Image Seven', 'bosa-plumber' ),
				'section'         => 'blog_catalogues',
				'mime_type'       => 'image',
				'priority'	      => 170
			)
		)
	);

	$wp_customize->add_setting( 'catalog_list_seven', array(
		'sanitize_callback' => 'bosa_plumber_sanitize_select',
		'default' 			=> '',
	) );

	$wp_customize->add_control( 'catalog_list_seven', array(
		'type' 			=> 'select',
		'section' 		=> 'blog_catalogues',
		'label' 		=> esc_html__( 'Image Seven Category', 'bosa-plumber' ),
		'choices' 		=> bosa_plumber_get_product_categories(),
		'priority'		=> 180,
	) );

	$wp_customize->add_setting( 'catalog_image_eight', array(
		'default'           => '',
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 
		new WP_Customize_Media_Control( 
			$wp_customize, 
			'catalog_image_eight',
			array(
				'label'           => __( 'Image Eight', 'bosa-plumber' ),
				'section'         => 'blog_catalogues',
				'mime_type'       => 'image',
				'priority'	      => 190
			)
		)
	);

	$wp_customize->add_setting( 'catalog_list_eight', array(
		'sanitize_callback' => 'bosa_plumber_sanitize_select',
		'default' 			=> '',
	) );

	$wp_customize->add_control( 'catalog_list_eight', array(
		'type' 			=> 'select',
		'section' 		=> 'blog_catalogues',
		'label' 		=> esc_html__( 'Image Eight Category', 'bosa-plumber' ),
		'choices' 		=> bosa_plumber_get_product_categories(),
		'priority'		=> 200,
	) );

	$wp_customize->add_setting( 'disable_mobile_catalogues', array(
	    'default' => false,
	    'sanitize_callback' => 'bosa_plumber_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'disable_mobile_catalogues', array(
	    'label' => __( 'Disable Catalogues Section', 'bosa-plumber' ),
	    'type' => 'checkbox',
	    'priority' => 27,
	    'section' => 'blog_page_responsive', 
	    'active_callback' => 'bosa_plumber_is_enable_catalogues_section',
	) );

	// Renowned Brands
	$wp_customize->add_section( 'blog_renowned_brands', array(
	    'title' => __( 'Renowned Brands', 'bosa-plumber' ),
	    'description'  	 => esc_html__( 'WooCommerce plugin is required for this section.', 'bosa-plumber' ),
	    'panel' => 'blog_homepage_options',
	    'priority' => 27,
	    'capability' => 'edit_theme_options',
	) );

	$wp_customize->add_setting( 'disable_renowned_brands_section', array(
	    'default' => true,
	    'sanitize_callback' => 'bosa_plumber_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'disable_renowned_brands_section', array(
	    'label' => __( 'Disable Renowned Brands Section', 'bosa-plumber' ),
	    'type' => 'checkbox',
	    'priority' => 10,
	    'section' => 'blog_renowned_brands', 
	) );

	$wp_customize->add_setting( 'renowned_brands_title', array(
		'default' => '',
	    'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'renowned_brands_title', array(
	    'label' => __( 'Title', 'bosa-plumber' ),
	    'type' => 'text',
	    'priority' => 20,
	    'section' => 'blog_renowned_brands',
	) );

	$wp_customize->add_setting( 'renowned_brands_sub_title', array(
		'default' => '',
	    'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'renowned_brands_sub_title', array(
	    'label' => __( 'Sub Title', 'bosa-plumber' ),
	    'type' => 'text',
	    'priority' => 30,
	    'section' => 'blog_renowned_brands',
	) );


	$wp_customize->add_setting( 'brands_image_one', array(
		'default'           => '',
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 
		new WP_Customize_Media_Control( 
			$wp_customize, 
			'brands_image_one',
			array(
				'label'           => __( 'Image One', 'bosa-plumber' ),
				'section'         => 'blog_renowned_brands',
				'mime_type'       => 'image',
				'priority'	      => 50
			)
		)
	);

	$wp_customize->add_setting( 'brand_category_one', array(
		'sanitize_callback' => 'bosa_plumber_sanitize_select',
		'default' 			=> '',
	) );

	$wp_customize->add_control( 'brand_category_one', array(
		'type' 			=> 'select',
		'section' 		=> 'blog_renowned_brands',
		'label' 		=> esc_html__( 'Image One Category', 'bosa-plumber' ),
		'choices' 		=> bosa_plumber_get_product_categories(),
		'priority'		=> 60,
	) );

	$wp_customize->add_setting( 'brands_image_two', array(
		'default'           => '',
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 
		new WP_Customize_Media_Control( 
			$wp_customize, 
			'brands_image_two',
			array(
				'label'           => __( 'Image Two', 'bosa-plumber' ),
				'section'         => 'blog_renowned_brands',
				'mime_type'       => 'image',
				'priority'	      => 70
			)
		)
	);

	$wp_customize->add_setting( 'brand_category_two', array(
		'sanitize_callback' => 'bosa_plumber_sanitize_select',
		'default' 			=> '',
	) );

	$wp_customize->add_control( 'brand_category_two', array(
		'type' 			=> 'select',
		'section' 		=> 'blog_renowned_brands',
		'label' 		=> esc_html__( 'Image Two Category', 'bosa-plumber' ),
		'choices' 		=> bosa_plumber_get_product_categories(),
		'priority'		=> 80,
	) );

	$wp_customize->add_setting( 'brands_image_three', array(
		'default'           => '',
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 
		new WP_Customize_Media_Control( 
			$wp_customize, 
			'brands_image_three',
			array(
				'label'           => __( 'Image Three', 'bosa-plumber' ),
				'section'         => 'blog_renowned_brands',
				'mime_type'       => 'image',
				'priority'	      => 90
			)
		)
	);

	$wp_customize->add_setting( 'brand_category_three', array(
		'sanitize_callback' => 'bosa_plumber_sanitize_select',
		'default' 			=> '',
	) );

	$wp_customize->add_control( 'brand_category_three', array(
		'type' 			=> 'select',
		'section' 		=> 'blog_renowned_brands',
		'label' 		=> esc_html__( 'Image Three Category', 'bosa-plumber' ),
		'choices' 		=> bosa_plumber_get_product_categories(),
		'priority'		=> 100,
	) );

	$wp_customize->add_setting( 'brands_image_four', array(
		'default'           => '',
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 
		new WP_Customize_Media_Control( 
			$wp_customize, 
			'brands_image_four',
			array(
				'label'           => __( 'Image Four', 'bosa-plumber' ),
				'section'         => 'blog_renowned_brands',
				'mime_type'       => 'image',
				'priority'	      => 110
			)
		)
	);

	$wp_customize->add_setting( 'brand_category_four', array(
		'sanitize_callback' => 'bosa_plumber_sanitize_select',
		'default' 			=> '',
	) );

	$wp_customize->add_control( 'brand_category_four', array(
		'type' 			=> 'select',
		'section' 		=> 'blog_renowned_brands',
		'label' 		=> esc_html__( 'Image Four Category', 'bosa-plumber' ),
		'choices' 		=> bosa_plumber_get_product_categories(),
		'priority'		=> 120,
	) );

	$wp_customize->add_setting( 'brands_image_five', array(
		'default'           => '',
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 
		new WP_Customize_Media_Control( 
			$wp_customize, 
			'brands_image_five',
			array(
				'label'           => __( 'Image Five', 'bosa-plumber' ),
				'section'         => 'blog_renowned_brands',
				'mime_type'       => 'image',
				'priority'	      => 130
			)
		)
	);

	$wp_customize->add_setting( 'brand_category_five', array(
		'sanitize_callback' => 'bosa_plumber_sanitize_select',
		'default' 			=> '',
	) );

	$wp_customize->add_control( 'brand_category_five', array(
		'type' 			=> 'select',
		'section' 		=> 'blog_renowned_brands',
		'label' 		=> esc_html__( 'Image Five Category', 'bosa-plumber' ),
		'choices' 		=> bosa_plumber_get_product_categories(),
		'priority'		=> 140,
	) );

	$wp_customize->add_setting( 'brands_image_six', array(
		'default'           => '',
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 
		new WP_Customize_Media_Control( 
			$wp_customize, 
			'brands_image_six',
			array(
				'label'           => __( 'Image Six', 'bosa-plumber' ),
				'section'         => 'blog_renowned_brands',
				'mime_type'       => 'image',
				'priority'	      => 150
			)
		)
	);

	$wp_customize->add_setting( 'brand_category_six', array(
		'sanitize_callback' => 'bosa_plumber_sanitize_select',
		'default' 			=> '',
	) );

	$wp_customize->add_control( 'brand_category_six', array(
		'type' 			=> 'select',
		'section' 		=> 'blog_renowned_brands',
		'label' 		=> esc_html__( 'Image Six Category', 'bosa-plumber' ),
		'choices' 		=> bosa_plumber_get_product_categories(),
		'priority'		=> 160,
	) );

	$wp_customize->add_setting( 'disable_mobile_renowned_brands', array(
	    'default' => false,
	    'sanitize_callback' => 'bosa_plumber_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'disable_mobile_renowned_brands', array(
	    'label' => __( 'Disable Renowned Brands Section', 'bosa-plumber' ),
	    'type' => 'checkbox',
	    'priority' => 28,
	    'section' => 'blog_page_responsive',
	    'active_callback' => 'bosa_plumber_is_enable_renowned_brands_section',
	) );

	// Grand events
	$wp_customize->add_section( 'blog_grand_event', array(
	    'title' => __( 'Grand Events', 'bosa-plumber' ),
	    'panel' => 'blog_homepage_options',
	    'priority' => 29,
	    'capability' => 'edit_theme_options',
	) );

	$wp_customize->add_setting( 'disable_grand_events_section', array(
	    'default' => true,
	    'sanitize_callback' => 'bosa_plumber_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'disable_grand_events_section', array(
	    'label' => __( 'Disable Grand Events Section', 'bosa-plumber' ),
	    'type' => 'checkbox',
	    'priority' => 10,
	    'section' => 'blog_grand_event', 
	) );

	$wp_customize->add_setting( 'blog_grand_event_page_one', array(
		'sanitize_callback' => 'bosa_plumber_sanitize_select',
		'default' 			=> '',
	) );

	$wp_customize->add_control( 'blog_grand_event_page_one', array(
		'type' 			=> 'select',
		'section' 		=> 'blog_grand_event',
		'label' 		=> esc_html__( 'Page 1', 'bosa-plumber' ),
		'choices' 		=> bosa_plumber_get_pages(),
		'priority'		=> 20,
	) );

	$wp_customize->add_setting( 'blog_grand_event_page_two', array(
		'sanitize_callback' => 'bosa_plumber_sanitize_select',
		'default' 			=> '',
	) );

	$wp_customize->add_control( 'blog_grand_event_page_two', array(
		'type' 			=> 'select',
		'section' 		=> 'blog_grand_event',
		'label' 		=> esc_html__( 'Page 2', 'bosa-plumber' ),
		'choices' 		=> bosa_plumber_get_pages(),
		'priority'		=> 30,
	) );

	$wp_customize->add_setting( 'blog_grand_event_page_three', array(
		'sanitize_callback' => 'bosa_plumber_sanitize_select',
		'default' 			=> '',
	) );

	$wp_customize->add_control( 'blog_grand_event_page_three', array(
		'type' 			=> 'select',
		'section' 		=> 'blog_grand_event',
		'label' 		=> esc_html__( 'Page 3', 'bosa-plumber' ),
		'choices' 		=> bosa_plumber_get_pages(),
		'priority'		=> 40,
	) );

	$wp_customize->add_setting( 'blog_grand_event_page_four', array(
		'sanitize_callback' => 'bosa_plumber_sanitize_select',
		'default' 			=> '',
	) );

	$wp_customize->add_control( 'blog_grand_event_page_four', array(
		'type' 			=> 'select',
		'section' 		=> 'blog_grand_event',
		'label' 		=> esc_html__( 'Page 4', 'bosa-plumber' ),
		'choices' 		=> bosa_plumber_get_pages(),
		'priority'		=> 50,
	) );

	$wp_customize->add_setting( 'blog_grand_event_page_five', array(
		'sanitize_callback' => 'bosa_plumber_sanitize_select',
		'default' 			=> '',
	) );

	$wp_customize->add_control( 'blog_grand_event_page_five', array(
		'type' 			=> 'select',
		'section' 		=> 'blog_grand_event',
		'label' 		=> esc_html__( 'Page 5', 'bosa-plumber' ),
		'choices' 		=> bosa_plumber_get_pages(),
		'priority'		=> 60,
	) );


	$wp_customize->add_setting( 'disable_mobile_grand_events', array(
	    'default' => false,
	    'sanitize_callback' => 'bosa_plumber_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'disable_mobile_grand_events', array(
	    'label' => __( 'Disable Grand Events Section', 'bosa-plumber' ),
	    'type' => 'checkbox',
	    'priority' => 29,
	    'section' => 'blog_page_responsive',
	    'active_callback' => 'bosa_plumber_is_enable_grand_events_section',
	) );
}
add_action( 'customize_register', 'bosa_plumber_customizer_structure', 15 );

/**
 * Kirki Customizer
 *
 * @return void
 */
add_action( 'init' , 'bosa_plumber_kirki_fields', 999, 1 );

function bosa_plumber_kirki_fields(){

	/**
	* If kirki is not installed do not run the kirki fields
	*/

	if ( !class_exists( 'Kirki' ) ) {
		return;
	}

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Site Title', 'bosa-plumber' ),
		'type'         => 'typography',
		'settings'     => 'site_title_font_control',
		'section'      => 'typography',
		'default'  => array(
			'font-family'    => 'Jost',
			'variant'        => '500',
			'font-size'      => '25px',
			'text-transform' => 'uppercase',
			'line-height'    => '1.2',
		),
		'priority'	  =>  10,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.site-header .site-branding .site-title',
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Site Description', 'bosa-plumber' ),
		'type'         => 'typography',
		'settings'     => 'site_description_font_control',
		'section'      => 'typography',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => 'regular',
			'font-size'      => '14px',
			'text-transform' => 'none',
		),
		'priority'	  =>  20,
		'transport'   => 'auto',
		'output'   => array(
			array(
				'element' => '.site-header .site-branding .site-description',
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Main Menu', 'bosa-plumber' ),
		'type'         => 'typography',
		'settings'     => 'main_menu_font_control',
		'section'      => 'typography',
		'default'  => array(
			'font-family'    => 'Jost',
			'font-size'      => '16px',
			'text-transform' => 'none',
			'variant'        => '500',
			'line-height'    => '1.5',
		),
		'priority'	  =>  30,
		'transport'   => 'auto',
		'output'   => array(
			array(
				'element' => array( '.main-navigation ul.menu li a', '.slicknav_menu .slicknav_nav li a' )
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Main Menu Description', 'bosa-plumber' ),
		'type'         => 'typography',
		'settings'     => 'main_menu_description_font_control',
		'section'      => 'typography',
		'default'  => array(
			'font-family'    => 'Poppins',
			'font-size'      => '11px',
			'text-transform' => 'none',
			'variant'        => 'regular',
			'line-height'    => '1.3',
		),
		'priority'	  =>  50,
		'transport'   => 'auto',
		'output'   => array(
			array(
				'element' => array( '.main-navigation .menu-description, .slicknav_menu .menu-description' ),
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Body', 'bosa-plumber' ),
		'type'         => 'typography',
		'settings'     => 'body_font_control',
		'section'      => 'typography',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => 'regular',
			'font-size'      => '14px',
		),
		'priority'	  =>  60,
		'transport'   => 'auto',
		'output' => array( 
			array(
				'element' => 'body',
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'General Title (H1 - H6)', 'bosa-plumber' ),
		'type'         => 'typography',
		'settings'     => 'general_title_font_control',
		'section'      => 'typography',
		'default'  => array(
			'font-family'    => 'Jost',
			'variant'        => '500',
			'text-transform' => 'none',
		),
		'priority'	  =>  70,
		'transport'   => 'auto',
		'output'   => array(
			array(
				'element' => array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'span.woocommerce-Price-amount.amount', '.button-primary', '.button-outline', '.button-text', 'button', '.woocommerce a.added_to_cart', 'body.woocommerce a.button', 'input[type="submit"]', '.product-title' ),
			),
		),	
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Page & Single Post Title', 'bosa-plumber' ),
		'type'         => 'typography',
		'settings'     => 'page_title_font_control',
		'section'      => 'typography',
		'default'  => array(
			'font-family'    => 'Jost',
			'variant'        => '500',
			'font-size'      => '42px',
			'text-transform' => 'none',
		),
		'priority'	  =>  80,
		'transport'   => 'auto',
		'output'   => array(
			array(
				'element' => array( '.page-title' ),
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Title Typography', 'bosa-plumber' ),
		'type'         => 'typography',
		'settings'     => 'main_slider_title_font_control',
		'section'      => 'main_slider_options',
		'default'  => array(
			'font-family'    => 'Jost',
			'variant'        => '500',
			'font-size'      => '52px',
			'text-transform' => 'uppercase',
			'line-height'    => '1.2',
		),
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.section-banner .banner-content .entry-title',
			),
		),
		'priority'	  =>  260,
		'active_callback' => array(
			array(
			'setting'  => 'hide_slider_title',
			'operator' => '==',
			'value'    => false,
			),
			array(
			'setting'  => 'main_slider_controls',
			'operator' => '==',
			'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Category Typography', 'bosa-plumber' ),
		'type'         => 'typography',
		'settings'     => 'main_slider_cat_font_control',
		'section'      => 'main_slider_options',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => '400',
			'font-size'      => '15px',
			'text-transform' => 'uppercase',
			'line-height'    => '1.6',
		),
		'priority'	  =>  280,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.section-banner .banner-content .entry-header .cat-links a',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'hide_slider_category',
				'operator' => '==',
				'value'    => false,
				),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Meta Typography', 'bosa-plumber' ),
		'type'         => 'typography',
		'settings'     => 'main_slider_meta_font_control',
		'section'      => 'main_slider_options',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => '400',
			'font-size'      => '13px',
			'text-transform' => 'capitalize',
			'line-height'    => '1.6',
		),
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.section-banner .banner-content .entry-meta a',
			),
		),
		'priority'	  =>  320,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				array(
				'setting'  => 'hide_slider_date',
				'operator' => '==',
				'value'    => false,
				),
				array(
				'setting'  => 'hide_slider_author',
				'operator' => '==',
				'value'    => false,
				),
				array(
				'setting'  => 'hide_slider_comment',
				'operator' => '==',
				'value'    => false,
				),
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Excerpt Typography', 'bosa-plumber' ),
		'type'         => 'typography',
		'settings'     => 'main_slider_excerpt_font_control',
		'section'      => 'main_slider_options',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => 'regular',
			'font-size'      => '15px',
			'text-transform' => 'initial',
			'line-height'    => '1.8',
		),
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.section-banner .banner-content .entry-text p',
			),
		),
		'priority'	  =>  340,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'hide_slider_excerpt',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Slider Button Typography', 'bosa-plumber' ),
		'type'         => 'typography',
		'settings'     => 'main_slider_button_font_control',
		'section'      => 'main_slider_options',
		'default'  => array(
			'font-family'    => 'Jost',
			'variant'        => '400',
			'font-size'      => '14px',
			'text-transform' => 'uppercase',
			'line-height'    => '1.4',
		),
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.section-banner .slide-inner .banner-content .button-container a',
			),
		),
		'priority'	  =>  380,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'hide_slider_button',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'       => esc_html__( 'Content Alignment', 'bosa-plumber' ),
		'type'        => 'select',
		'settings'    => 'main_slider_content_alignment',
		'section'     => 'main_slider_options',
		'default'     => 'left',
		'choices'  => array(
			'center' => esc_html__( 'Center', 'bosa-plumber' ),
			'left'   => esc_html__( 'Left', 'bosa-plumber' ),
			'right'  => esc_html__( 'Right', 'bosa-plumber' ),
		),
		'priority'	  =>  180,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Section Title Typography', 'bosa-plumber' ),
		'type'         => 'typography',
		'settings'     => 'latest_posts_section_title_font_control',
		'section'      => 'latest_posts_options',
		'default'  => array(
			'font-family'    => 'Jost',
			'variant'        => '500',
			'font-size'      => '36px',
			'text-transform' => 'none',
			'line-height'    => '1.2',
		),
		'priority'	  =>  40,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.section-post-area .section-title-wrap .section-title',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'disable_latest_posts_section_title',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Section Description Typography', 'bosa-plumber' ),
		'type'         => 'typography',
		'settings'     => 'latest_posts_section_description_font_control',
		'section'      => 'latest_posts_options',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => 'regular',
			'font-size'      => '15px',
			'text-transform' => 'none',
			'line-height'    => '1.8',
		),
		'priority'	  =>  70,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.section-post-area .section-title-wrap p',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'disable_latest_posts_section_description',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Post Title Typography', 'bosa-plumber' ),
		'type'         => 'typography',
		'settings'     => 'blog_post_title_font_control',
		'section'      => 'blog_page_style_options',
		'default'  => array(
			'font-family'    => 'Jost',
			'variant'        => '500',
			'font-size'      => '22px',
			'text-transform' => 'capitalize',
			'line-height'    => '1.4',
		),
		'priority'    => 120,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '#primary article .entry-title',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'hide_post_title',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Post Category Typography', 'bosa-plumber' ),
		'type'         => 'typography',
		'settings'     => 'blog_post_cat_font_control',
		'section'      => 'blog_page_style_options',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => '400',
			'font-size'      => '13px',
			'text-transform' => 'uppercase',
			'line-height'    => '1',
		),
		'priority'    => 140,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '#primary .post .entry-content .entry-header .cat-links a',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'hide_category',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Post Meta Typography', 'bosa-plumber' ),
		'type'         => 'typography',
		'settings'     => 'blog_post_meta_font_control',
		'section'      => 'blog_page_style_options',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => '400',
			'font-size'      => '13px',
			'text-transform' => 'capitalize',
			'line-height'    => '1.6',
		),
		'priority'    => 180,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '#primary .entry-meta',
			),
		),
		'active_callback' => array(
			array(
				array(
				'setting'  => 'hide_date',
				'operator' => '==',
				'value'    => false,
				),
				array(
				'setting'  => 'hide_author',
				'operator' => '==',
				'value'    => false,
				),
				array(
				'setting'  => 'hide_comment',
				'operator' => '==',
				'value'    => false,
				),
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Post Excerpt Typography', 'bosa-plumber' ),
		'type'         => 'typography',
		'settings'     => 'blog_post_excerpt_font_control',
		'section'      => 'blog_page_style_options',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => '400',
			'font-size'      => '15px',
			'text-transform' => 'initial',
			'line-height'    => '1.8',
		),
		'priority'    => 200,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '#primary .entry-text p',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'hide_blog_page_excerpt',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Section Title Typography', 'bosa-plumber' ),
		'type'         => 'typography',
		'settings'     => 'highlight_posts_section_title_font_control',
		'section'      => 'highlight_posts_options',
		'default'  => array(
			'font-family'    => 'Jost',
			'variant'        => '500',
			'font-size'      => '36px',
			'text-transform' => 'none',
			'line-height'    => '1.2',
		),
		'priority'	  =>  40,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.section-highlight-post .section-title',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'disable_highlight_posts_section_title',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Section Description Typography', 'bosa-plumber' ),
		'type'         => 'typography',
		'settings'     => 'highlight_posts_section_description_font_control',
		'section'      => 'highlight_posts_options',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => 'regular',
			'font-size'      => '15px',
			'text-transform' => 'none',
			'line-height'    => '1.8',
		),
		'priority'	  =>  70,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.section-highlight-post .section-title-wrap p',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'disable_highlight_posts_section_description',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Post Title Typography', 'bosa-plumber' ),
		'type'         => 'typography',
		'settings'     => 'highlight_posts_title_font_control',
		'section'      => 'highlight_posts_options',
		'default'  => array(
			'font-family'    => 'Jost',
			'variant'        => '500',
			'font-size'      => '20px',
			'text-transform' => 'none',
			'line-height'    => '1.4',
		),
		'priority'	  => 280,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.highlight-post-slider .post .entry-content .entry-title',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'hide_highlight_posts_title',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Post Category Typography', 'bosa-plumber' ),
		'type'         => 'typography',
		'settings'     => 'highlight_posts_cat_font_control',
		'section'      => 'highlight_posts_options',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => '400',
			'font-size'      => '13px',
			'text-transform' => 'capitalize',
			'line-height'    => '1',
		),
		'priority'	  => 260,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.highlight-post-slider .post .cat-links a',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'hide_highlight_posts_category',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Post Meta Typography', 'bosa-plumber' ),
		'type'         => 'typography',
		'settings'     => 'highlight_posts_meta_font_control',
		'section'      => 'highlight_posts_options',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => '400',
			'font-size'      => '13px',
			'text-transform' => 'capitalize',
			'line-height'    => '1.6',
		),
		'priority'	  => 320,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.highlight-post-slider .post .entry-meta a',
			),
		),
		'active_callback' => array(
			array(
				array(
				'setting'  => 'hide_highlight_posts_date',
				'operator' => '==',
				'value'    => false,
				),
				array(
				'setting'  => 'hide_highlight_posts_author',
				'operator' => '==',
				'value'    => false,
				),
				array(
				'setting'  => 'hide_highlight_posts_comment',
				'operator' => '==',
				'value'    => false,
				),
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Widget Title Typography', 'bosa-plumber' ),
		'type'         => 'typography',
		'settings'     => 'sidebar_widget_title_font_control',
		'section'      => 'sidebar_options',
		'default'  => array(
			'font-family'    => 'Jost',
			'variant'        => '500',
			'font-size'      => '18px',
			'text-transform' => 'uppercase',
			'line-height'    => '1.4',
		),
		'priority'	  =>  20,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.sidebar .widget .widget-title',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'sidebar_settings',
				'operator' => 'contains',
				'value'    => array( 'right', 'left', 'right-left' ),
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Widget Title Typography', 'bosa-plumber' ),
		'type'         => 'typography',
		'settings'     => 'footer_widget_title_font_control',
		'section'      => 'footer_widgets_options',
		'default'  => array(
			'font-family'    => 'Jost',
			'variant'        => '500',
			'font-size'      => '20px',
			'text-transform' => 'none',
			'line-height'    => '1.4',
		),
		'priority'	  =>  120,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.site-footer .widget .widget-title',
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'       => esc_html__( 'Header Layouts', 'bosa-plumber' ),
		'description' => esc_html__( 'Select layout & scroll below to change its options', 'bosa-plumber' ),
		'type'        => 'radio-image',
		'settings'    => 'header_layout',
		'section'     => 'header_style_options',
		'default'     => 'header_thirteen',
		'priority'	  => '40',
		'choices'     => apply_filters( 'bosa_header_layout_filter', array(
			'header_one'    => get_template_directory_uri() . '/assets/images/header-layout-1.png',
			'header_two'    => get_template_directory_uri() . '/assets/images/header-layout-2.png',
			'header_three'  => get_template_directory_uri() . '/assets/images/header-layout-3.png',
		) ),
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Disable Top Header Section', 'bosa-plumber' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_top_header_section',
		'section'      => 'header_style_options',
		'default'      => false,
		'priority'	   => '50',
	) );

	Kirki::add_field( 'bosa', array(
		'label'       => esc_html__( 'Header Height (in px)', 'bosa-plumber' ),
		'description' => esc_html__( 'This option will only apply to Desktop. Please click on below Desktop Icon to see changes. Automatically adjust by theme default in the responsive devices.
		', 'bosa-plumber' ),
		'type'        => 'slider',
		'settings'    => 'header_image_height',
		'section'     => 'header_style_options',
		'transport'   => 'postMessage',
		'default'     => 120,
		'priority'	  => '300',
		'choices'     => array(
			'min'  => 50,
			'max'  => 1200,
			'step' => 10,
		),
	) );

	// Contact Detail Options
	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Disable Contact Details', 'bosa-plumber' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_contact_detail',
		'section'      => 'header_style_options',
		'default'      => false,
		'priority'	   => 445,
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one', 'header_two', 'header_thirteen' ),
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Contact Detail Icon color', 'bosa-plumber' ),
		'type'         => 'color',
		'settings'     => 'header_icon_color',
		'section'      => 'header_style_options',
		'default'      => '#B7B7B7',
		'priority'	   => 448,
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_thirteen' ),
			),
			array(
				'setting'  => 'disable_contact_detail',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Phone Label', 'bosa-plumber' ),
		'type'         => 'text',
		'settings'     => 'header_phone_label',
		'section'      => 'header_style_options',
		'default'      => "",
		'priority'	   => 449,
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_thirteen' ),
			),
			array(
				'setting'  => 'disable_contact_detail',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Phone Number', 'bosa-plumber' ),
		'type'         => 'text',
		'settings'     => 'contact_phone',
		'section'      => 'header_style_options',
		'default'      => '',
		'priority'	   => 450,
		'active_callback' => array(
			array(
				'setting'  => 'disable_contact_detail',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one', 'header_two', 'header_thirteen' ),
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Email Label', 'bosa-plumber' ),
		'type'         => 'text',
		'settings'     => 'header_email_label',
		'section'      => 'header_style_options',
		'priority'	   => 455,
		'default'      => '',
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_thirteen' ),
			),
			array(
				'setting'  => 'disable_contact_detail',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Email', 'bosa-plumber' ),
		'type'         => 'text',
		'settings'     => 'contact_email',
		'section'      => 'header_style_options',
		'default'      => '',
		'priority'	   => 460,
		'active_callback' => array(
			array(
				'setting'  => 'disable_contact_detail',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one', 'header_two', 'header_thirteen' ),
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Address Label', 'bosa-plumber' ),
		'type'         => 'text',
		'settings'     => 'header_address_label',
		'section'      => 'header_style_options',
		'priority'	   => 465,
		'default'      => '',
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_thirteen' ),
			),
			array(
				'setting'  => 'disable_contact_detail',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Address', 'bosa-plumber' ),
		'type'         => 'text',
		'settings'     => 'contact_address',
		'section'      => 'header_style_options',
		'default'      => '',
		'priority'	   => 470,
		'active_callback' => array(
			array(
				'setting'  => 'disable_contact_detail',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one', 'header_two', 'header_thirteen' ),
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
	    'type'        => 'custom',
	    'settings'    => 'header_button_separator',
	    'section'     => 'header_style_options',
	    'default'     => esc_html__( 'Header Button Options', 'bosa-plumber' ),
	    'priority'	  => 550,
	    'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one', 'header_two', 'header_thirteen' ),
			),
		),
	) );

	// Header button
	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Disable Header Buttons', 'bosa-plumber' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_header_button',
		'section'      => 'header_style_options',
		'default'      => false,
		'priority'	   => 560,
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one', 'header_two', 'header_thirteen' ),
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Header Buttons', 'bosa-plumber' ),
		'type'         => 'repeater',
		'settings'     => 'header_button_repeater',
		'section'      => 'header_style_options',
		'row_label' => array(
			'type'  => 'text',
			'value' => esc_html__( 'Button', 'bosa-plumber' ),
		),
		'default' => array(
			array(
				'header_btn_type' 			=> 'button-outline',
				'header_btn_bg_color'		=> '#EB5A3E',
				'header_btn_border_color'	=> '#1a1a1a',
				'header_btn_text_color'		=> '#1a1a1a',
				'header_btn_hover_color'	=> '#086abd',
				'header_btn_text' 			=> '',
				'header_btn_link' 			=> '#',
				'header_btn_target'			=> true,
				'header_btn_radius'			=> 0,
			),		
		),
		'priority'	   => 570,
		'fields' => array(
			'header_btn_type' => array(
				'label'       => esc_html__( 'Button Type', 'bosa-plumber' ),
				'type'        => 'select',
				'default'     => 'button-outline',
				'choices'  	  => array(
					'button-primary' => esc_html__( 'Background Button', 'bosa-plumber' ),
					'button-outline' => esc_html__( 'Border Button', 'bosa-plumber' ),
					'button-text'    => esc_html__( 'Text Only Button', 'bosa-plumber' ),
				),
			),
			'header_btn_bg_color' 	=> array(
				'label'       		=> esc_html__( 'Non Transparent Header Button Background Color', 'bosa-plumber' ),
				'description' 		=> esc_html__( 'For background button type only.', 'bosa-plumber' ),
				'type'        		=> 'color',
				'default'     		=> '#EB5A3E',
			),
			'header_btn_border_color' 	=> array(
				'label'      	 		=> esc_html__( 'Non Transparent Header Button Border Color', 'bosa-plumber' ),
				'description' 			=> esc_html__( 'For border button type only.', 'bosa-plumber' ),
				'type'       		 	=> 'color',
				'default'     			=> '#1a1a1a',
			),
			'header_btn_text_color' => array(
				'label'       		=> esc_html__( 'Non Transparent Header Button Text Color', 'bosa-plumber' ),
				'type'        		=> 'color',
				'default'     		=> '#1a1a1a',
			),
			'header_btn_hover_color' => array(
				'label'       		=> esc_html__( 'Non Transparent Header Button Hover Color', 'bosa-plumber' ),
				'type'        		=> 'color',
				'default'     		=> '#086abd',
			),
			'header_btn_text' => array(
				'label'       => esc_html__( 'Button Text', 'bosa-plumber' ),
				'type'        => 'text',
				'default' 	  => '',
			),
			'header_btn_link' => array(
				'label'       => esc_html__( 'Button Link', 'bosa-plumber' ),
				'type'        => 'text',
				'default' 	  => '#',
			),
			'header_btn_target' => array(
				'label'       	=> esc_html__( 'Open Link in New Window', 'bosa-plumber' ),	
				'type'        	=> 'checkbox',
				'default'	  	=> true,
			),
			'header_btn_radius' => array(
				'label'       	=> esc_html__( 'Button Radius (px)', 'bosa-plumber' ),
				'type'        	=> 'number',
				'default'	  	=> 0,
				'choices'     	=> array(
					'min'  => 0,
					'max'  => 50,
					'step' => 1,
				),
			),	
		),
		'choices' => array(
			'limit' => 2,
		),
		'active_callback' => array(
			array(
				'setting'  => 'disable_header_button',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one', 'header_thirteen' ),
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Header Buttons Typography', 'bosa-plumber' ),
		'type'         => 'typography',
		'settings'     => 'header_buttons_font_control',
		'section'      => 'header_style_options',
		'default'  => array(
			'font-family'    => 'Jost',
			'variant'        => '600',
			'font-size'      => '14px',
			'text-transform' => 'none',
			'line-height'    => '1',
		),
		'priority'	  => 590,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.site-header .header-btn a',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'disable_header_button',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one', 'header_two', 'header_thirteen' ),
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Header Hamburger Icon Background Color', 'bosa-plumber' ),
		'type'         => 'color',
		'settings'     => 'header_hamburger_bg_color',
		'section'      => 'header_style_options',
		'default'      => '#EB5A3E',
		'priority'	   => 435,
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_thirteen' ),
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Header Hamburger Icon Color', 'bosa-plumber' ),
		'type'         => 'color',
		'settings'     => 'header_hamburger_icon_color',
		'section'      => 'header_style_options',
		'default'      => '#FFFFFF',
		'priority'	   => 436,
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_thirteen' ),
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
	    'type'        => 'custom',
	    'settings'    => 'contact_details_separator',
	    'section'     => 'header_style_options',
	    'default'     => esc_html__( 'Contact Details Options', 'bosa-plumber' ),
	    'priority'	   => 440,
	    'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one', 'header_two', 'header_four', 'header_thirteen' ),
			),
		),
	) );

	

	// Header contact labels for header 4

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Contact Label Typography', 'bosa-plumber' ),
		'type'         => 'typography',
		'settings'     => 'contact_label_font_control',
		'section'      => 'header_style_options',
		'default'  => array(
			'font-family'    => 'Jost',
			'variant'        => 'regular',
			'font-size'      => '13px',
			'text-transform' => 'none',
			'line-height'    => '1.6',
		),
		'priority'	  => 500,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => array( '.header-thirteen .header-contact ul li span' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'disable_contact_detail',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_thirteen' ),
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Contact Content Typography', 'bosa-plumber' ),
		'type'         => 'typography',
		'settings'     => 'contact_content_font_control',
		'section'      => 'header_style_options',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => '600',
			'font-size'      => '16px',
			'text-transform' => 'none',
			'line-height'    => '1.6',
		),
		'priority'	  => 510,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => array( '.header-thirteen .header-contact ul li' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'disable_contact_detail',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_thirteen' ),
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Disable Mid Header Section Border', 'bosa-plumber' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_mobile_mid_header_border',
		'section'      => 'header_responsive',
		'default'      => false,
		'priority'	   =>  50,
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one', 'header_three', 'header_thirteen' ),
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'       => esc_html__( 'Disable Header Contact Details', 'bosa-plumber' ),
		'type'        => 'checkbox',
		'settings'    => 'disable_mobile_contact_details',
		'section'     => 'header_responsive',
		'default'     => false,
		'priority'	  => 120,
		'active_callback' => array(
			array(
				'setting'  => 'disable_contact_detail',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one', 'header_two', 'header_thirteen' ),
			),
			array(
				'setting'  => 'disable_mobile_top_header',
				'operator' => '=',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'       => esc_html__( 'Disable Header Buttons', 'bosa-plumber' ),
		'type'        => 'checkbox',
		'settings'    => 'disable_mobile_header_buttons',
		'section'     => 'header_responsive',
		'default'     => false,
		'priority'	  => 140,
		'active_callback' => array(
			array(
				'setting'  => 'disable_header_button',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one','header_two', 'header_thirteen' ),
			),
			array(
				'setting'  => 'disable_mobile_top_header',
				'operator' => '=',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'       => esc_html__( 'Footer Layouts', 'bosa-plumber' ),
		'type'        => 'radio-image',
		'settings'    => 'footer_layout',
		'section'     => 'footer_style_options',
		'default'     => 'footer_eight',
		'choices'  => apply_filters( 'bosa_footer_layout_filter', array(
			'footer_one'   => get_template_directory_uri() . '/assets/images/footer-layout-1.png',
			'footer_two'   => get_template_directory_uri() . '/assets/images/footer-layout-2.png',
			'footer_three' => get_template_directory_uri() . '/assets/images/footer-layout-3.png',
		) ),
		'priority'	   => 20,
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Bottom Footer Typography', 'bosa-plumber' ),
		'type'         => 'typography',
		'settings'     => 'footer_style_font_control',
		'section'      => 'footer_style_options',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => '500',
			'font-size'      => '15px',
			'text-transform' => 'none',
			'line-height'    => '1.6',
		),
		'priority'	   => 90,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => array( '.site-footer .site-info', '.site-footer .footer-menu ul li a' ),
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'       => esc_html__( 'Select Image', 'bosa-plumber' ),
		'type'         => 'image',
		'settings'     => 'bottom_footer_image',
		'section'      => 'footer_style_options',
		'default'      => '',
		'choices'     => array(
			'save_as' => 'id',
		),
		'priority'	   => 100,
		'active_callback' => array(
			array(
				'setting'  => 'footer_layout',
				'operator' => 'contains',
				'value'    => array( 'footer_one', 'footer_two', 'footer_eight' ),
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'    => esc_html__( 'Image Link', 'bosa-plumber' ),
		'type'     => 'link',
		'settings' => 'bottom_footer_image_link',
		'section'  => 'footer_style_options',
		'default'  => '',
		'priority'	   => 110,
		'active_callback' => array(
			array(
				'setting'  => 'footer_layout',
				'operator' => 'contains',
				'value'    => array( 'footer_one', 'footer_two', 'footer_eight' ),
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'    => esc_html__( 'Image Target', 'bosa-plumber' ),
		'description' => esc_html__( 'If enabled, the page will be open in an another browser tab.', 'bosa-plumber' ),
		'type'     => 'checkbox',
		'settings' => 'bottom_footer_image_target',
		'section'  => 'footer_style_options',
		'default'  => true,
		'priority'	   => 120,
		'active_callback' => array(
			array(
				'setting'  => 'footer_layout',
				'operator' => 'contains',
				'value'    => array( 'footer_one', 'footer_two', 'footer_eight' ),
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Image Width', 'bosa-plumber' ),
		'type'         => 'slider',
		'settings'     => 'bottom_footer_image_width',
		'section'      => 'footer_style_options',
		'transport'    => 'postMessage',
		'default'      => 270,
		'choices'      => array(
			'min'  => 10,
			'max'  => 1140,
			'step' => 5,
		),
		'priority'	   => 130,
		'active_callback' => array(
			array(
				'setting'  => 'footer_layout',
				'operator' => 'contains',
				'value'    => array( 'footer_one', 'footer_two', 'footer_eight' ),
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Disable Section Border', 'bosa-plumber' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_footer_border',
		'section'      => 'footer_style_options',
		'default'      => false,
		'priority'	   => 145,
		'active_callback' => array(
			array(
				'setting'  => 'footer_layout',
				'operator' => 'contains',
				'value'    => array( 'footer_eight' ),
			),
		),
	) );

	// Featured Posts
	Kirki::add_section( 'feature_posts_options', array(
	    'title'          => esc_html__( 'Featured Posts', 'bosa-plumber' ),
	    'panel'          => 'blog_homepage_options',
	    'capability'     => 'edit_theme_options',
	    'priority'       => '20',
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Disable Featured Posts Section', 'bosa-plumber' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_feature_posts_section',
		'section'      => 'feature_posts_options',
		'default'      => false,
		'priority'	   =>  10,
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Disable Section Title', 'bosa-plumber' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_feature_posts_section_title',
		'section'      => 'feature_posts_options',
		'default'      => true,
		'priority'	   =>  20,
	) );

	Kirki::add_field( 'bosa', array(
		'label'       => esc_html__( 'Section Title', 'bosa-plumber' ),
		'type'        => 'text',
		'settings'    => 'feature_posts_section_title',
		'section'     => 'feature_posts_options',
		'default'     => '',
		'priority'	  =>  30,
		'active_callback' => array(
			array(
				'setting'  => 'disable_feature_posts_section_title',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Section Title Typography', 'bosa-plumber' ),
		'type'         => 'typography',
		'settings'     => 'feature_posts_section_title_font_control',
		'section'      => 'feature_posts_options',
		'default'  => array(
			'font-family'    => 'Jost',
			'variant'        => '500',
			'font-size'      => '36px',
			'text-transform' => 'capitalize',
			'line-height'    => '1.2',
		),
		'priority'	  =>  40,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.section-feature-posts-area .section-title',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'disable_feature_posts_section_title',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Disable Section Description', 'bosa-plumber' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_feature_posts_section_description',
		'section'      => 'feature_posts_options',
		'default'      => true,
		'priority'	  =>  50,
	) );

	Kirki::add_field( 'bosa', array(
		'label'       => esc_html__( 'Section Description', 'bosa-plumber' ),
		'type'        => 'text',
		'settings'    => 'feature_posts_section_description',
		'section'     => 'feature_posts_options',
		'default'     => '',
		'priority'	  =>  60,
		'active_callback' => array(
			array(
				'setting'  => 'disable_feature_posts_section_description',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Section Description Typography', 'bosa-plumber' ),
		'type'         => 'typography',
		'settings'     => 'feature_posts_section_description_font_control',
		'section'      => 'feature_posts_options',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => 'regular',
			'font-size'      => '15px',
			'text-transform' => 'none',
			'line-height'    => '1.8',
		),
		'priority'	  =>  70,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.section-feature-posts-area .section-title-wrap p',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'disable_feature_posts_section_description',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'       => esc_html__( 'Section Title and Description Alignment', 'bosa-plumber' ),
		'type'        => 'select',
		'settings'    => 'feature_posts_section_title_desc_alignment',
		'section'     => 'feature_posts_options',
		'default'     => 'left',
		'choices'     => array(
			'left'	 	=> esc_html__( 'Left', 'bosa-plumber' ),
			'center'  	=> esc_html__( 'Center', 'bosa-plumber' ),   
			'right'		=> esc_html__( 'Right', 'bosa-plumber' ),
		),
		'priority'	  =>  80,
		'active_callback' => array(
			array(
				array(
					'setting'  => 'disable_feature_posts_section_title',
					'operator' => '==',
					'value'    => false,
				),
				array(
					'setting'  => 'disable_feature_posts_section_description',
					'operator' => '==',
					'value'    => false,
				),
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'       => esc_html__( 'Section Layout', 'bosa-plumber' ),
		'description' => esc_html__( 'Select layout & scroll below to change its options', 'bosa-plumber' ),
		'type'        => 'radio-image',
		'settings'    => 'feature_posts_section_layouts',
		'section'     => 'feature_posts_options',
		'default'     => 'feature_one',
		'choices'     => apply_filters( 'bosa_feature_posts_section_layouts_filter', array(
			'feature_one'    => get_template_directory_uri() . '/assets/images/feature-post-layout-1.png',
		) ),
		'priority'	  =>  90,
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Post Title Color', 'bosa-plumber' ),
		'type'         => 'color',
		'settings'     => 'featured_post_title_color',
		'section'      => 'feature_posts_options',
		'default'      => '#FFFFFF',
		'priority'	   =>  100,
		'active_callback' => array(
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
			array(
				'setting'  => 'disable_feature_posts_title',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Post Category Background Color', 'bosa-plumber' ),
		'type'         => 'color',
		'settings'     => 'featured_post_category_bgcolor',
		'section'      => 'feature_posts_options',
		'default'      => '#EB5A3E',
		'priority'	   =>  110,
		'active_callback' => array(
			array(
				'setting'  => 'feature_posts_section_layouts',
				'operator' => '==',
				'value'    => 'feature_one',
			),
			array(
				'setting'  => 'hide_featured_posts_category',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Post Category Color', 'bosa-plumber' ),
		'type'         => 'color',
		'settings'     => 'featured_post_category_color',
		'section'      => 'feature_posts_options',
		'default'      => '#FFFFFF',
		'priority'	   =>  120,
		'active_callback' => array(
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
			array(
				'setting'  => 'hide_featured_posts_category',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Post Meta Text Color', 'bosa-plumber' ),
		'type'         => 'color',
		'settings'     => 'featured_post_meta_color',
		'section'      => 'feature_posts_options',
		'default'      => '#FFFFFF',
		'priority'	   =>  130,
		'active_callback' => array(
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
			array(
				array(
					'setting'  => 'hide_featured_posts_date',
					'operator' => '==',
					'value'    => false,
				),
				array(
					'setting'  => 'hide_featured_posts_author',
					'operator' => '==',
					'value'    => false,
				),
				array(
					'setting'  => 'hide_featured_posts_comment',
					'operator' => '==',
					'value'    => false,
				),
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Post Meta Icon Color', 'bosa-plumber' ),
		'type'         => 'color',
		'settings'     => 'featured_post_meta_icon_color',
		'section'      => 'feature_posts_options',
		'default'      => '#FFFFFF',
		'priority'	   =>  140,
		'active_callback' => array(
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
			array(
				array(
					'setting'  => 'hide_featured_posts_date',
					'operator' => '==',
					'value'    => false,
				),
				array(
					'setting'  => 'hide_featured_posts_author',
					'operator' => '==',
					'value'    => false,
				),
				array(
					'setting'  => 'hide_featured_posts_comment',
					'operator' => '==',
					'value'    => false,
				),
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Post Hover Color', 'bosa-plumber' ),
		'type'         => 'color',
		'settings'     => 'featured_post_hover_color',
		'section'      => 'feature_posts_options',
		'default'      => '#a8d8ff',
		'priority'	   =>  150,
	) );


	Kirki::add_field( 'bosa', array(
		'label'       => esc_html__( 'Columns', 'bosa-plumber' ),
		'type'        => 'select',
		'settings'    => 'feature_posts_columns',
		'section'     => 'feature_posts_options',
		'default'     => 'three_columns',
		'placeholder' => esc_attr__( 'Select category', 'bosa-plumber' ),
		'choices'  => array(
			'one_column'    => esc_html__( '1 Column', 'bosa-plumber' ),
			'two_columns'   => esc_html__( '2 Columns', 'bosa-plumber' ),
			'three_columns' => esc_html__( '3 Columns', 'bosa-plumber' ),
			'four_columns'  => esc_html__( '4 Columns', 'bosa-plumber' ),
		),
		'priority'	  =>  160,
	) );

	Kirki::add_field( 'bosa', array(
		'label'       => esc_html__( 'Choose Category', 'bosa-plumber' ),
		'description' => esc_html__( 'Recent posts will show if any category is not chosen.', 'bosa-plumber' ),
		'type'        => 'select',
		'settings'    => 'feature_posts_category',
		'section'     => 'feature_posts_options',
		'default'     => '',
		'placeholder' => esc_html__( 'Select category', 'bosa-plumber' ), 
		'choices'     => bosa_get_post_categories(),
		'priority'	  =>  170,
	) );

	Kirki::add_field( 'bosa', array(
		'label'       => esc_html__( 'Featured Posts Overlay Opacity', 'bosa-plumber' ),
		'type'        => 'number',
		'settings'    => 'feature_posts_overlay_opacity',
		'section'     => 'feature_posts_options',
		'default'     => 4,
		'choices' => array(
			'min' => '0',
			'max' => '9',
			'step' => '1',
		),
		'priority'	  =>  180,
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Post View Number', 'bosa-plumber' ),
		'description'  => esc_html__( 'Number of posts to show.', 'bosa-plumber' ),
		'type'         => 'number',
		'settings'     => 'feature_posts_posts_number',
		'section'      => 'feature_posts_options',
		'default'      => 6,
		'choices' => array(
			'min' => '1',
			'max' => '48',
			'step' => '1',
		),
		'priority'	  =>  190,
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Height (in px)', 'bosa-plumber' ),
		'description'  => esc_html__( 'This option will only apply to Desktop. Please click on below Desktop Icon to see changes. Automatically adjust by theme default in the responsive devices.
		', 'bosa-plumber' ),
		'type'         => 'slider',
		'settings'     => 'feature_posts_height',
		'section'      => 'feature_posts_options',
		'transport'    => 'postMessage',
		'default'      => 350,
		'choices' => array(
			'min' => '100',
			'max' => '1200',
			'step' => '10',
		),
		'priority'	  =>  200,
		'active_callback' => array(
			array(
				'setting'  => 'feature_posts_section_layouts',
				'operator' => 'contains',
				'value'    => array( 'feature_one' ),
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'       => esc_html__( 'Choose Image Size', 'bosa-plumber' ),
		'type'        => 'select',
		'settings'    => 'render_feature_post_image_size',
		'section'     => 'feature_posts_options',
		'default'     => 'bosa-420-300',
		'placeholder' => esc_html__( 'Select Image Size', 'bosa-plumber' ),
		'choices'     => bosa_get_intermediate_image_sizes(),
		'priority'	  =>  210,
		'active_callback' => array(
			array(
				'setting'  => 'feature_posts_section_layouts',
				'operator' => 'contains',
				'value'    => array( 'feature_one' ),
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Background Image Size', 'bosa-plumber' ),
		'type'         => 'radio',
		'settings'     => 'feature_posts_image_size',
		'section'      => 'feature_posts_options',
		'default'      => 'cover',
		'choices'      => array(
			'cover'    => esc_html__( 'Cover', 'bosa-plumber' ),
			'pattern'  => esc_html__( 'Pattern / Repeat', 'bosa-plumber' ),
			'norepeat' => esc_html__( 'No Repeat', 'bosa-plumber' ),
		),
		'priority'	   =>  220,
		'active_callback' => array(
			array(
				'setting'  => 'feature_posts_section_layouts',
				'operator' => 'contains',
				'value'    => array( 'feature_one' ),
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'       => esc_html__( 'Posts Border Radius (px)', 'bosa-plumber' ),
		'type'        => 'slider',
		'settings'    => 'feature_posts_radius',
		'section'     => 'feature_posts_options',
		'transport'	  => 'postMessage', 
		'default'     =>  0,
		'choices'     => array(
			'min'  => 0,
			'max'  => 50,
			'step' => 1,
		),
		'priority'	  =>  230,
	) );

	Kirki::add_field( 'bosa', array(
		'label'       => esc_html__( 'Post Text Alignment', 'bosa-plumber' ),
		'type'        => 'select',
		'settings'    => 'feature_posts_text_alignment',
		'section'     => 'feature_posts_options',
		'default'     => 'text-left',
		'choices'     => array(
			'text-left'	 	=> esc_html__( 'Left', 'bosa-plumber' ),
			'text-center'  	=> esc_html__( 'Center', 'bosa-plumber' ),   
			'text-right'	=> esc_html__( 'Right', 'bosa-plumber' ),
		),
		'priority'	  =>  240,
		'active_callback' => array(
			array(
				'setting'  => 'feature_posts_section_layouts',
				'operator' => 'contains',
				'value'    => array( 'feature_one' ),
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'       => esc_html__( 'Post Content Alignment', 'bosa-plumber' ),
		'type'        => 'select',
		'settings'    => 'feature_posts_title_alignment',
		'section'     => 'feature_posts_options',
		'default'     => 'align-bottom',
		'choices'     => array(
			'align-top'	 	=> esc_html__( 'Top', 'bosa-plumber' ),
			'align-center'  => esc_html__( 'Center', 'bosa-plumber' ),   
			'align-bottom'  => esc_html__( 'Bottom', 'bosa-plumber' ),
		),
		'priority'	  =>  250,
		'active_callback' => array(
			array(
				'setting'  => 'feature_posts_section_layouts',
				'operator' => 'contains',
				'value'    => array( 'feature_one' ),
			),
		),
	) ); 

	Kirki::add_field( 'bosa', array(
		'label'       => esc_html__( 'Disable Post Title', 'bosa-plumber' ),
		'type'        => 'checkbox',
		'settings'    => 'disable_feature_posts_title',
		'section'     => 'feature_posts_options',
		'default'     => false,
		'priority'	  =>  260,
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Post Title Typography', 'bosa-plumber' ),
		'type'         => 'typography',
		'settings'     => 'feature_posts_font_control',
		'section'      => 'feature_posts_options',
		'default'  => array(
			'font-family'    => 'Jost',
			'variant'        => '500',
			'font-size'      => '18px',
			'text-transform' => 'capitalize',
			'line-height'    => '1.4',
		),
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.feature-posts-content-wrap .feature-posts-content .feature-posts-title',
			),
		),
		'priority'	  =>  270,
		'active_callback' => array(
			array(
				'setting'  => 'disable_feature_posts_title',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'feature_posts_section_layouts',
				'operator' => 'contains',
				'value'    => array( 'feature_one' ),
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'       => esc_html__( 'Disable Post Title Divider', 'bosa-plumber' ),
		'type'        => 'checkbox',
		'settings'    => 'disable_feature_title_divider',
		'section'     => 'feature_posts_options',
		'default'     => false,
		'priority'	  =>  280,
		'active_callback' => array(
			array(
				'setting'  => 'disable_feature_posts_title',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'disable_feature_posts_title',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'       => esc_html__( 'Disable Posts category', 'bosa-plumber' ),
		'type'        => 'checkbox',
		'settings'    => 'hide_featured_posts_category',
		'section'     => 'feature_posts_options',
		'default'     => false,
		'priority'	  =>  290,
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Post Category Typography', 'bosa-plumber' ),
		'type'         => 'typography',
		'settings'     => 'featured_posts_cat_font_control',
		'section'      => 'feature_posts_options',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => '400',
			'font-size'      => '13px',
			'text-transform' => 'uppercase',
			'line-height'    => '1',
		),
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.post .feature-posts-content .cat-links a',
			),
		),
		'priority'	  =>  300,
		'active_callback' => array(
			array(
				'setting'  => 'hide_featured_posts_category',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'       => esc_html__( 'Disable Post Date', 'bosa-plumber' ),
		'type'        => 'checkbox',
		'settings'    => 'hide_featured_posts_date',
		'section'     => 'feature_posts_options',
		'default'     => false,
		'priority'	  =>  310,
	) );

	Kirki::add_field( 'bosa', array(
		'label'       => esc_html__( 'Disable Post Author', 'bosa-plumber' ),
		'type'        => 'checkbox',
		'settings'    => 'hide_featured_posts_author',
		'section'     => 'feature_posts_options',
		'default'     => false,
		'priority'	  =>  320,
	) );

	Kirki::add_field( 'bosa', array(
		'label'       => esc_html__( 'Disable Post Comment', 'bosa-plumber' ),
		'type'        => 'checkbox',
		'settings'    => 'hide_featured_posts_comment',
		'section'     => 'feature_posts_options',
		'default'     => false,
		'priority'	  =>  330,
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Post Meta Typography', 'bosa-plumber' ),
		'type'         => 'typography',
		'settings'     => 'featured_posts_meta_font_control',
		'section'      => 'feature_posts_options',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => '400',
			'font-size'      => '13px',
			'text-transform' => 'capitalize',
			'line-height'    => '1.6',
		),
		'priority'	  =>  340,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.post .feature-posts-content .entry-meta a',
			),
		),
		'active_callback' => array(
			array(
				array(
				'setting'  => 'hide_featured_posts_date',
				'operator' => '==',
				'value'    => false,
				),
				array(
				'setting'  => 'hide_featured_posts_author',
				'operator' => '==',
				'value'    => false,
				),
				array(
				'setting'  => 'hide_featured_posts_comment',
				'operator' => '==',
				'value'    => false,
				),
			),
		),
	) );

	// features pages options
	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Section Title Typography', 'bosa-plumber' ),
		'type'         => 'typography',
		'settings'     => 'featured_pages_section_title_font_control',
		'section'      => 'feature_pages_options',
		'default'  => array(
			'font-family'    => 'Jost',
			'variant'        => '500',
			'font-size'      => '36px',
			'text-transform' => 'capitalize',
			'line-height'    => '1.2',
		),
		'priority'	  =>  35,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.section-feature-pages-area .section-title',
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Section Description Typography', 'bosa-plumber' ),
		'type'         => 'typography',
		'settings'     => 'featured_pages_section_description_font_control',
		'section'      => 'feature_pages_options',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => 'regular',
			'font-size'      => '15px',
			'text-transform' => 'none',
			'line-height'    => '1.8',
		),
		'priority'	  =>  55,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.section-feature-pages-area .section-title-wrap p',
			),
		),
	) );
	
	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Height (in px)', 'bosa-plumber' ),
		'description'  => esc_html__( 'This option will only apply to Desktop. Please click on below Desktop Icon to see changes. Automatically adjust by theme default in the responsive devices.
		', 'bosa-plumber' ),
		'type'         => 'slider',
		'settings'     => 'featured_pages_height',
		'section'      => 'feature_pages_options',
		'transport'    => 'postMessage',
		'default'      => 250,
		'choices' => array(
			'min' => '100',
			'max' => '1200',
			'step' => '10',
		),
		'priority'	   => 142,
	) );

	

	Kirki::add_field( 'bosa', array(
		'label'       => esc_html__( 'Page Border Radius (px)', 'bosa-plumber' ),
		'type'        => 'slider',
		'settings'    => 'featured_pages_radius',
		'section'     => 'feature_pages_options',
		'transport'	  => 'postMessage', 
		'default'     =>  0,
		'choices'     => array(
			'min'  => 0,
			'max'  => 50,
			'step' => 1,
		),
		'priority'	   => 144,
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Page Title Typography', 'bosa-plumber' ),
		'type'         => 'typography',
		'settings'     => 'featured_pages_font_control',
		'section'      => 'feature_pages_options',
		'default'  => array(
			'font-family'    => 'Jost',
			'variant'        => '500',
			'font-size'      => '18px',
			'text-transform' => 'uppercase',
			'line-height'    => '1.4',
		),
		'priority'	   => 210,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.feature-pages-content-wrap .feature-pages-content .feature-pages-title',
			),
		),
	) );

	// featured posts two

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Section Title Typography', 'bosa-plumber' ),
		'type'         => 'typography',
		'settings'     => 'feature_posts_two_section_title_font_control',
		'section'      => 'feature_posts_two_options',
		'default'  => array(
			'font-family'    => 'Jost',
			'variant'        => '600',
			'font-size'      => '36px',
			'text-transform' => 'none',
			'line-height'    => '1.2',
		),
		'priority'	   => 40,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.section-feature-posts-two-area .section-title',
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Section Description Typography', 'bosa-plumber' ),
		'type'         => 'typography',
		'settings'     => 'feature_posts_two_section_description_font_control',
		'section'      => 'feature_posts_two_options',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => 'regular',
			'font-size'      => '15px',
			'text-transform' => 'none',
			'line-height'    => '1.8',
		),
		'priority'	   => 70,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.section-feature-posts-two-area .section-title-wrap p',
			),
		),	
	) );

	Kirki::add_field( 'bosa', array(
		'label'       => esc_html__( 'Posts Border Radius (px)', 'bosa-plumber' ),
		'type'        => 'slider',
		'settings'    => 'feature_posts_two_radius',
		'section'     => 'feature_posts_two_options',
		'transport'	  => 'postMessage', 
		'default'     =>  0,
		'choices'     => array(
			'min'  => 0,
			'max'  => 50,
			'step' => 1,
		),
		'priority'	  =>  190,
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Post Title Typography', 'bosa-plumber' ),
		'type'         => 'typography',
		'settings'     => 'feature_posts_two_font_control',
		'section'      => 'feature_posts_two_options',
		'default'  => array(
			'font-family'    => 'Jost',
			'variant'        => '500',
			'font-size'      => '22px',
			'text-transform' => 'capitalize',
			'line-height'    => '1.4',
		),
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.section-feature-posts-two-area .feature-posts-content .feature-posts-title',
			),
		),
		'priority'	  =>  230,
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Post Category Typography', 'bosa-plumber' ),
		'type'         => 'typography',
		'settings'     => 'feature_posts_two_cat_font_control',
		'section'      => 'feature_posts_two_options',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => '400',
			'font-size'      => '13px',
			'text-transform' => 'uppercase',
			'line-height'    => '1',
		),
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.section-feature-posts-two-area .feature-posts-content .cat-links a',
			),
		),
		'priority'	  =>  260,
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Post Meta Typography', 'bosa-plumber' ),
		'type'         => 'typography',
		'settings'     => 'feature_posts_two_meta_font_control',
		'section'      => 'feature_posts_two_options',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => '400',
			'font-size'      => '13px',
			'text-transform' => 'capitalize',
			'line-height'    => '1.6',
		),
		'priority'	  =>  300,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.section-feature-posts-two-area .feature-posts-content .entry-meta a',
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'       => esc_html__( 'Post Layouts', 'bosa-plumber' ),
		'description' => esc_html__( 'Grid / List / Single/ Grid Thumbnail', 'bosa-plumber' ),
		'type'        => 'radio-image',
		'settings'    => 'archive_post_layout',
		'section'     => 'blog_page_style_options',
		'default'     => 'grid-thumbnail',
		'priority'	  => '5',
		'choices'  	  => apply_filters( 'bosa_archive_post_layout_filter', array(
			'grid'           => get_template_directory_uri() . '/assets/images/grid-layout.png',
			'list'           => get_template_directory_uri() . '/assets/images/list-layout.png',
			'single'         => get_template_directory_uri() . '/assets/images/single-layout.png',
		) ),
	) );

	Kirki::add_field( 'bosa', array(
		'label'       => esc_html__( 'Post View Number', 'bosa-plumber' ),
		'description' => esc_html__( 'Number of posts to show.', 'bosa-plumber' ),
		'type'        => 'number',
		'settings'    => 'archive_post_per_page',
		'section'     => 'blog_page_style_options',
		'default'     => 10,
		'priority'	  => '6',
		'choices'  => array(
			'min' => '0',
			'max' => '20',
			'step' => '1',
		),
	) );

	Kirki::add_field( 'bosa', array(
	    'type'        => 'custom',
	    'settings'    => 'grid_thumbnail_separator',
	    'section'     => 'blog_page_style_options',
	    'default'     => esc_html__( 'Thumbnail Post Options', 'bosa-plumber' ),
	    'priority'	  => 300,
	    'active_callback' => array(
			array(
				'setting'  => 'archive_post_layout',
				'operator' => '==',
				'value'    => 'grid-thumbnail',
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'       => esc_html__( 'Choose Image Size', 'bosa-plumber' ),
		'description' => esc_html__( 'Image Size for thumbnail post only.', 'bosa-plumber' ),
		'type'        => 'select',
		'settings'    => 'render_grid_thumbnail_image_size',
		'section'     => 'blog_page_style_options',
		'default'     => 'thumbnail',
		'placeholder' => esc_html__( 'Select Image Size', 'bosa-plumber' ),
		'choices'     => bosa_get_intermediate_image_sizes(),
		'priority'	  => 310,
		'active_callback' => array(
			array(
				'setting'  => 'archive_post_layout',
				'operator' => '==',
				'value'    => 'grid-thumbnail',
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'       => esc_html__( 'Post Border Radius (px)', 'bosa-plumber' ),
		'description' => esc_html__( 'Post Border Radius for thumbnail post only.', 'bosa-plumber' ),
		'type'        => 'slider',
		'settings'    => 'posts_border_radius_thumbnail',
		'section'     => 'blog_page_style_options',
		'transport'	  => 'postMessage', 
		'default'     =>  0,
		'choices'     => array(
			'min'  => 0,
			'max'  => 50,
			'step' => 1,
		),
		'priority'	  => 320,
		'active_callback' => array(
			array(
				'setting'  => 'archive_post_layout',
				'operator' => '==',
				'value'    => 'grid-thumbnail',
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Disable Date', 'bosa-plumber' ),
		'description'  => esc_html__( 'Disables date for thumbnail post only.', 'bosa-plumber' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_date_thumbnail',
		'section'      => 'blog_page_style_options',
		'default'      => false,
		'priority'	   => 330,
		'active_callback' => array(
			array(
				'setting'  => 'archive_post_layout',
				'operator' => '==',
				'value'    => 'grid-thumbnail',
			),
			array(
				'setting'  => 'hide_date',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Disable Author', 'bosa-plumber' ),
		'description'  => esc_html__( 'Disables author for thumbnail post only.', 'bosa-plumber' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_author_thumbnail',
		'section'      => 'blog_page_style_options',
		'default'      => true,
		'priority'	   => 340,
		'active_callback' => array(
			array(
				'setting'  => 'archive_post_layout',
				'operator' => '==',
				'value'    => 'grid-thumbnail',
			),
			array(
				'setting'  => 'hide_author',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Disable Comment Link', 'bosa-plumber' ),
		'description'  => esc_html__( 'Disables comment link for thumbnail post only.', 'bosa-plumber' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_comment_thumbnail',
		'section'      => 'blog_page_style_options',
		'default'      => true,
		'priority'	   => 350,
		'active_callback' => array(
			array(
				'setting'  => 'archive_post_layout',
				'operator' => '==',
				'value'    => 'grid-thumbnail',
			),
			array(
				'setting'  => 'hide_comment',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Disable Excerpt', 'bosa-plumber' ),
		'description'  => esc_html__( 'Disables excerpt for thumbnail post only.', 'bosa-plumber' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_excerpt_thumbnail',
		'section'      => 'blog_page_style_options',
		'default'      => true,
		'priority'	   => 360,
		'active_callback' => array(
			array(
				'setting'  => 'archive_post_layout',
				'operator' => '==',
				'value'    => 'grid-thumbnail',
			),
			array(
				'setting'  => 'hide_blog_page_excerpt',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Disable Post Button', 'bosa-plumber' ),
		'description'  => esc_html__( 'Disables button for thumbnail post only.', 'bosa-plumber' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_button_thumbnail',
		'section'      => 'blog_page_style_options',
		'default'      => true,
		'priority'	   => 370,
		'active_callback' => array(
			array(
				'setting'  => 'archive_post_layout',
				'operator' => '==',
				'value'    => 'grid-thumbnail',
			),
			array(
				'setting'  => 'hide_post_button',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	// Typography
	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Product Title Typography', 'bosa-plumber' ),
		'type'         => 'typography',
		'settings'     => 'shop_product_title_font_control',
		'section'      => 'woocommerce_product_catalog',
		'default'  => array(
			'font-family'     => 'Jost',
			'variant'         => '500',
			'font-style'      => 'normal',
			'font-size'       => '17px',
			'text-transform'  => 'none',
			'line-height'     => '1.4',
			'letter-spacing'  => '0',
			'text-decoration' => 'none',
			'color'			  => '#030303',
		),
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => 'body[class*=woocommerce] ul.products li.product .woocommerce-loop-product__title',
			),
		),
		'priority'    => 380,
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Product Price Typography', 'bosa-plumber' ),
		'type'         => 'typography',
		'settings'     => 'shop_product_price_font_control',
		'section'      => 'woocommerce_product_catalog',
		'default'  => array(
			'font-family'     => 'Jost',
			'variant'         => '600',
			'font-style'      => 'normal',
			'font-size'       => '16px',
			'text-transform'  => 'none',
			'line-height'     => '1.3',
			'letter-spacing'  => '0',
			'text-decoration' => 'none',
			'color'			  => '#414141',
		),
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => 'body[class*=woocommerce] ul.products li.product .price',
			),
		),
		'priority'    => 390,
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
		),
	) );

	Kirki::add_field( 'bosa', array(
		'label'        => esc_html__( 'Add to Cart Button Typography', 'bosa-plumber' ),
		'type'         => 'typography',
		'settings'     => 'shop_cart_button_font_control',
		'section'      => 'woocommerce_product_catalog',
		'default'  => array(
			'font-family'     => 'Jost',
			'variant'         => 'regular',
			'font-style'      => 'normal',
			'font-size'       => '13px',
			'text-transform'  => 'uppercase',
			'line-height'     => '1.5',
			'letter-spacing'  => '0',
		),
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => 'body[class*=woocommerce] .product-inner .button, body[class*=woocommerce] .product-inner .added_to_cart',
			),
		),
		'priority'    => 400,
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
			array(
				'setting'  => 'woocommerce_add_to_cart_button',
				'operator' => '!=',
				'value'    => array( 'cart_button_four' ),
			),
		),
	) );

}