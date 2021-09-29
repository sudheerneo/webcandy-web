<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
// Do not proceed if Kirki does not exist.
if ( ! class_exists( 'Kirki' ) ) {
	return;
}

/**
 * Defines customizer options
 */

function capeone_customizer_library_options() {
	
	global $capeone_default_options, $capeone_customizer_options, $wp_version;

	// Stores all the controls that will be added
	$options = array();

	// Stores all the sections to be added
	$sections = array();

	// Stores all the panels to be added
	$panels = array();

	// Adds the sections to the $options array
	$options['sections'] = $sections;
	
	$imagepath = get_template_directory_uri().'/assets/images/';
	
	$target = array(
		'_blank' => __( 'Blank', 'capeone' ),
		'_self'  => __( 'Self', 'capeone' )
	);
	
	$transport = 'refresh';
	
	// General Options
	$panel = 'capeone-general-options';
	
	$panels[] = array(
		'settings' => $panel,
		'title' => __( 'CapeOne: General Options', 'capeone' ),
		'priority' => '1'
	);
	
	
	$section = 'section-title-bar';
	$sections[] = array(
		'settings' => $section,
		'title' => __( 'Page Title Bar', 'capeone' ),
		'priority' => '9',
		'panel' => $panel
	);
	
	$options['display_titlebar'] = array(
			'settings' => 'display_titlebar',
			'label'   => __( 'Display Title Bar', 'capeone' ),
			'section' => $section,
			'type'    => 'checkbox',
			'default' => '1',
			'transport' => $transport,
		);
	
	$options['display_breadcrumb'] = array(
			'settings' => 'display_breadcrumb',
			'label'   => __( 'Display Breadcrumb', 'capeone' ),
			'section' => $section,
			'type'    => 'checkbox',
			'default' => '1',
			'transport' => $transport,
		);
		
	$options['title_bar_layout'] = array(
			'settings' => 'title_bar_layout',
			'label'   => __( 'Title Bar Layout', 'capeone' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => array(
				'title-left'=> __( 'Left Title, right breadcrumbs', 'capeone' ),
				'title-right'=> __( 'Right Title, left breadcrumbs', 'capeone' ),
				'title-center'=> __( 'Center', 'capeone' ),
				'title-left2'=> __( 'Left', 'capeone' ),
				'title-right2'=> __( 'Right', 'capeone' )
				),
			'transport' => $transport,
			'default' => 'title-left',
			'description'   => __( 'Title only works on pages.', 'capeone' ),
			
		);
	
	$options['title_bar_padding'] = array(
		'type'        => 'dimensions',
		'settings'    => 'title_bar_padding',
		'label'       => esc_attr__( 'Title Bar Padding', 'capeone' ),
		'description' => '',
		'section'     => $section,
		'default'     => array(
			'padding-top'    => '30px',
			'padding-bottom' => '30px',
			'padding-left'   => '0',
			'padding-right'  => '0',
		),
		'output'      => array(
			array(
				'element' => '.page-title-bar',
			),
		),
	);
	
	$section = 'section-sidebar-options';
	$sections[] = array(
		'settings' => $section,
		'title' => __( 'Sidebar', 'capeone' ),
		'priority' => '11',
		'panel' => $panel
	);
	// Sidebar
	
	$options['page_sidebar_layout'] = array(
		'settings' => 'page_sidebar_layout',
		'label'   => __( 'Sidebar: Pages', 'capeone' ),
		'section' => $section,
		'type'    => 'radio-image',
		'default' => 'right',

		'choices' => array(
				'no'=> $imagepath.'customize/sidebar-none.png',
				'left'=> $imagepath.'customize/sidebar-left.png',
				'right'=> $imagepath.'customize/sidebar-right.png',
				),
		);
	
	$options['blog_sidebar_layout'] = array(
		'settings' => 'blog_sidebar_layout',
		'label'   => __( 'Sidebar: Single Post', 'capeone' ),
		'section' => $section,
		'type'    => 'radio-image',
		'default' => 'right',

		'choices' => array(
				'no'=>  $imagepath.'customize/sidebar-none.png',
				'left'=> $imagepath.'customize/sidebar-left.png',
				'right'=> $imagepath.'customize/sidebar-right.png',
				),
		);
	
	$options['blog_archives_sidebar_layout'] = array(
		'settings' => 'blog_archives_sidebar_layout',
		'label'   => __( 'Sidebar: Posts Archive', 'capeone' ),
		'section' => $section,
		'type'    => 'radio-image',
		'default' => 'right',
		'choices' => array( 'no' =>__( 'No Sidebar', 'capeone' ),'left'=>__( 'Left Sidebar', 'capeone' ),'right'=>__( 'Right Sidebar', 'capeone' ) ),
		'choices' => array(
				'no'=> $imagepath.'customize/sidebar-none.png',
				'left'=> $imagepath.'customize/sidebar-left.png',
				'right'=> $imagepath.'customize/sidebar-right.png',
				),
		);
		
	$options['woo_single_sidebar_layout'] = array(
		'settings' => 'woo_single_sidebar_layout',
		'label'   => __( 'Sidebar: WooCommerce Single Product', 'capeone' ),
		'section' => $section,
		'type'    => 'radio-image',
		'default' => 'no',
		'choices' => array('no' =>__( 'No Sidebar', 'capeone' ),'left'=>__( 'Left Sidebar', 'capeone' ),'right'=>__( 'Right Sidebar', 'capeone' )),
		'choices' => array(
				'no'=> $imagepath.'customize/sidebar-none.png',
				'left'=> $imagepath.'customize/sidebar-left.png',
				'right'=> $imagepath.'customize/sidebar-right.png',
				),
		);
		
	$options['woo_archives_sidebar_layout'] = array(
		'settings' => 'woo_archives_sidebar_layout',
		'label'   => __( 'Sidebar: WooCommerce Archive', 'capeone' ),
		'section' => $section,
		'type'    => 'radio-image',
		'default' => 'no',
		'choices' => array('no' =>__( 'No Sidebar', 'capeone' ),'left'=>__( 'Left Sidebar', 'capeone' ),'right'=>__( 'Right Sidebar', 'capeone' )),
		'choices' => array(
				'no'=> $imagepath.'customize/sidebar-none.png',
				'left'=> $imagepath.'customize/sidebar-left.png',
				'right'=> $imagepath.'customize/sidebar-right.png',
				),
		);
		
		$section = 'section-back-to-top-options';
		$sections[] = array(
			'settings' => $section,
			'title' => __( 'Back to Top', 'capeone' ),
			'priority' => '11',
			'panel' => $panel
		);
	
		$options['display_scroll_to_top'] = array(
			'settings' => 'display_scroll_to_top',
			'label'   => __( 'Enable Scroll to Top Button', 'capeone' ),
			'section' => $section,
			'priority' => '10',
			'type'    => 'checkbox',
			'transport' => $transport, 
			'default' => '1',
		);
	
	$section = 'section-forms-options';
	$sections[] = array(
		'settings' => $section,
		'title' => __( 'Forms', 'capeone' ),
		'priority' => '11',
		'panel' => $panel
	);
	
	$options['form_border_style'] = array(
			'settings' => 'form_border_style',
			'label'   => __( 'Form Border Style', 'capeone' ),
			'section' => $section,
			'priority' => '2',
			'type'    => 'select',
			'transport' => $transport,
			'default' => 'solid',
			'choices' => array(
				'none'    => __( 'None', 'capeone' ),
				'hidden'    => __( 'Hidden', 'capeone' ),
				'dotted'    => __( 'Dotted', 'capeone' ),
				'dashed'    => __( 'Dashed', 'capeone' ),
				'solid'    => __( 'Solid', 'capeone' ),
				'double'    => __( 'Double', 'capeone' ),
				'groove'    => __( 'Groove', 'capeone' ),
				'ridge'    => __( 'Ridge', 'capeone' ),
				'inset'    => __( 'Inset', 'capeone' ),
				'outset'    => __( 'Outset', 'capeone' ),
  			),
		);
		
	$options['form_border_width'] = array(
			'settings' => 'form_border_width',
			'label'   => __( 'Form Border Width', 'capeone' ),
			'priority' => '3',
			'section' => $section,
			'type' => 'slider',
			'transport' => $transport,
			'default' => '1',
			'input_attrs' => array(
				'min'    => 0,
				'max'    => 10,
				'step'   => 1,
				'suffix' => 'px',
  			),
		);
		
		$options['form_border_color'] = array(
			'settings' => 'form_border_color',
			'label'   => __( 'Form Border Color', 'capeone' ),
			'priority' => '4',
			'section' => $section,
			'type'    => 'color',
			'transport' => $transport,
			'default' => '#dddddd',
		);
		
		$options['form_background_color'] = array(
			'settings' => 'form_background_color',
			'label'   => __( 'Form Background Color', 'capeone' ),
			'priority' => '4',
			'section' => $section,
			'type'    => 'color',
			'transport' => $transport,
			'default' => '#ffffff',
			'output'      => array(
			array(
				'element' => '.form-control, select, textarea, input[type="text"], input[type="password"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="email"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"], .uneditable-input',
			),
		),
			
		);
		
		$options['form_broder_radius'] = array(
			'settings' => 'form_broder_radius',
			'label'   => __( 'Form Broder Radius', 'capeone' ),
			'priority' => '5',
			'section' => $section,
			'type' => 'slider',
			'transport' => $transport,
			'default' => '0',
			'input_attrs' => array(
				'min'    => 0,
				'max'    => 20,
				'step'   => 1,
				'suffix' => 'px',
  			),
			
		);
		
		$options['form_padding'] = array(
		'type'        => 'dimensions',
		'settings'    => 'form_padding',
		'label'       => esc_attr__( 'Form Padding', 'capeone' ),
		'description' => '',
		'section'     => $section,
		'priority' => '5',
		'default'     => array(
			'padding-top'    => '10px',
			'padding-bottom' => '10px',
			'padding-left'   => '20px',
			'padding-right'  => '20px',
		),
		'output'      => array(
			array(
				'element' => '.form-control, select, textarea, input[type="text"], input[type="password"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="email"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"], .uneditable-input',
			),
		),
	);
	
	$section = 'section-buttons-options';
	$sections[] = array(
		'settings' => $section,
		'title' => __( 'Buttons', 'capeone' ),
		'priority' => '11',
		'panel' => $panel
	);	
	
	$options['button_font_size'] = array(
			'settings' => 'button_font_size',
			'label'   => __( 'Form Font Size', 'capeone' ),
			'priority' => '5',
			'section' => $section,
			'default' => '12',
			'input_attrs' => array(
				'min'    => 9,
				'max'    => 30,
				'step'   => 1,
				'suffix' => 'px',
  			),
		);
		
		$options['button_color'] = array(
			'settings' => 'button_color',
			'label'   => __( 'Button Color', 'capeone' ),
			'priority' => '5',
			'section' => $section,
			'type'    => 'color',
			'transport' => $transport,
			'default' => '#ffffff',
		);
		
		$options['button_text_transform'] = array(
			'settings' => 'button_text_transform',
			'label'   => __( 'Button Text-transform', 'capeone' ),
			'section' => $section,
			'priority' => '5',
			'type'    => 'select',
			'transport' => $transport,
			'default' => 'uppercase',
			'choices' => array(
				'none'    => __( 'None', 'capeone' ),
				'capitalize'    => __( 'Capitalize', 'capeone' ),
				'uppercase'    => __( 'Uppercase', 'capeone' ),
				'lowercase'    => __( 'lowercase', 'capeone' ),

  			),
		);
		
		$options['button_broder_radius'] = array(
			'settings' => 'button_broder_radius',
			'label'   => __( 'Button Broder Radius', 'capeone' ),
			'priority' => '5',
			'section' => $section,
			'type' => 'slider',
			'transport' => $transport,
			'default' => '0',
			'input_attrs' => array(
				'min'    => 0,
				'max'    => 20,
				'step'   => 1,
				'suffix' => 'px',
  			),
			
		);
		
		$options['button_border_color'] = array(
			'settings' => 'button_border_color',
			'label'   => __( 'Button Border Color', 'capeone' ),
			'priority' => '5',
			'section' => $section,
			'type'    => 'color',
			'transport' => $transport,
			'default' => '#00dfb8',
		);

		$options['button_background_color'] = array(
			'settings' => 'button_background_color',
			'label'   => __( 'Button Background Color', 'capeone' ),
			'priority' => '5',
			'section' => $section,
			'type'    => 'color',
			'transport' => $transport,
			'default' => '#00dfb8',
		);
		
		$options['button_border_style'] = array(
			'settings' => 'button_border_style',
			'label'   => __( 'Button Border Style', 'capeone' ),
			'section' => $section,
			'priority' => '5',
			'type'    => 'select',
			'transport' => $transport,
			'default' => 'solid',
			'choices' => array(
				'none'    => __( 'None', 'capeone' ),
				'hidden'    => __( 'Hidden', 'capeone' ),
				'dotted'    => __( 'Dotted', 'capeone' ),
				'dashed'    => __( 'Dashed', 'capeone' ),
				'solid'    => __( 'Solid', 'capeone' ),
				'double'    => __( 'Double', 'capeone' ),
				'groove'    => __( 'Groove', 'capeone' ),
				'ridge'    => __( 'Ridge', 'capeone' ),
				'inset'    => __( 'Inset', 'capeone' ),
				'outset'    => __( 'Outset', 'capeone' ),
  			),
		);
		
		$options['button_border_width'] = array(
			'settings' => 'button_border_width',
			'label'   => __( 'Button Border Width', 'capeone' ),
			'priority' => '5',
			'section' => $section,
			'default' => '0',
			'type' => 'slider',
			'input_attrs' => array(
				'min'    => 0,
				'max'    => 5,
				'step'   => 1,
				'suffix' => 'px',
  			),
		);
		
	$options['button_padding'] = array(
		'type'        => 'dimensions',
		'settings'    => 'button_padding',
		'label'       => esc_attr__( 'Button Padding', 'capeone' ),
		'description' => '',
		'section'     => $section,
		'priority' => '5',
		'default'     => array(
			'padding-top'    => '10px',
			'padding-bottom' => '10px',
			'padding-left'   => '20px',
			'padding-right'  => '20px',
		),
		'output'      => array(
			array(
				'element' => 'button,input[type="submit"],.capeone-btn,btn-normal,.woocommerce #respond input#submit,.woocommerce a.button,.woocommerce button.button,.woocommerce input.button',
			),
		),
	);
	
	$section = 'section-404-Page-options';
	$sections[] = array(
		'settings' => $section,
		'title' => __( '404 Page', 'capeone' ),
		'priority' => '11',
		'panel' => $panel
	);
	
	
	$options['page_404'] = array(
		'type'        => 'dropdown-pages',
		'settings'    => 'page_404',
		'label'       => esc_attr__( '404 Page content', 'capeone' ),
		'section'     => $section,
		'default'     => '0',
		'priority'    => 10,
     );
	 
	$section = 'section-additional-options';
	$sections[] = array(
		'settings' => $section,
		'title' => __( 'Page Pre-loader', 'capeone' ),
		'priority' => '11',
		'panel' => $panel
	);
	
	$options['page_preloader'] = array(
			'settings' => 'page_preloader',
			'label'   => __( 'Display Page Pre-loader', 'capeone' ),
			'priority' => '6',
			'section' => $section,
			'type'    => 'checkbox',
			'transport' => $transport,
			'default' => '',
		);
		
	$options['preloader_background'] = array(
			'settings' => 'preloader_background',
			'label'   => __( 'Pre-loader Background Color', 'capeone' ),
			'section' => $section,
			'priority' => '7',
			'type'    => 'color',
			'transport' => $transport,
			'default' => '#999999',
		);
	
	$options['preloader_opacity'] = array(
		'settings' => 'preloader_opacity',
		'label'   => __( 'Pre-loader Background Opacity', 'capeone' ),
		'section' => $section,
		'priority' => '8',
		'type'    => 'slider',
		'default' => '0.8',
		'input_attrs' => array(
			'min'    => 0,
			'max'    => 1,
			'step'   => 0.1,
			'suffix' => '',
  	),
	);
	
	$options['preloader_image'] = array(
			'settings' => 'preloader_image',
			'label'   => __( 'Pre-loader Image', 'capeone' ),
			'section' => $section,
			'priority' => '9',
			'type'    => 'image',
			'transport' => $transport, 
			'default' =>  $imagepath.'preloader.gif',
		);
	
	// Panel Pages & Posts Options
	$panel = 'panel-pages-posts-options';
	
	$panels[] = array(
		'settings' => $panel,
		'title' => __( 'CapeOne: Blog', 'capeone' ),
		'priority' => '2'
	);
		
	$section = 'section-posts-archive';
	$sections[] = array(
		'settings' => $section,
		'title' => __( 'Posts archive', 'capeone' ),
		'priority' => '10',
		'panel' => $panel
	);
	
	//Display: Full Post/Excerpt
	//Display Feature Image/Display Category/Display Author/Dispaly Date
	$options['excerpt_style'] = array(
		'settings' => 'excerpt_style',
		'label'   => __( 'Excerpt', 'capeone' ),
		'section' => $section,
		'type'    => 'radio',
		'choices' => array(
				'0'=> __( 'Excerpt', 'capeone' ),
				'1'=> __( 'Full Post', 'capeone' ),
				),
		'default' => '0'
	);
	
	$options['excerpt_display_feature_image'] = array(
			'settings' => 'excerpt_display_feature_image',
			'label'   => __( 'Display Feature Image', 'capeone' ),
			'section' => $section,
			'type'    => 'checkbox',
			'transport' => $transport,
			'default' => '1',
		);
		
	$options['excerpt_display_category'] = array(
			'settings' => 'excerpt_display_category',
			'label'   => __( 'Display Category', 'capeone' ),
			'section' => $section,
			'type'    => 'checkbox',
			'transport' => $transport,
			'default' => '1',
		);
		
	$options['excerpt_display_author'] = array(
			'settings' => 'excerpt_display_author',
			'label'   => __( 'Display Author', 'capeone' ),
			'section' => $section,
			'type'    => 'checkbox',
			'transport' => $transport,
			'default' => '1',
		);
	$options['excerpt_display_date'] = array(
			'settings' => 'excerpt_display_date',
			'label'   => __( 'Display Date', 'capeone' ),
			'section' => $section,
			'type'    => 'checkbox',
			'transport' => $transport,
			'default' => '1',
		);
	
	$section = 'section-posts-single';
	$sections[] = array(
		'settings' => $section,
		'title' => __( 'Single Post', 'capeone' ),
		'priority' => '10',
		'panel' => $panel
	);
	
	//Display Feature Image/Display Category/Display Author/Dispaly Date
	
	$options['display_feature_image'] = array(
			'settings' => 'display_feature_image',
			'label'   => __( 'Display Feature Image', 'capeone' ),
			'section' => $section,
			'type'    => 'checkbox',
			'transport' => $transport,
			'default' => '1',
		);
		
	$options['display_category'] = array(
			'settings' => 'display_category',
			'label'   => __( 'Display Category', 'capeone' ),
			'section' => $section,
			'type'    => 'checkbox',
			'transport' => $transport,
			'default' => '1',
		);
	$options['display_author'] = array(
			'settings' => 'display_author',
			'label'   => __( 'Display Author', 'capeone' ),
			'section' => $section,
			'type'    => 'checkbox',
			'transport' => $transport,
			'default' => '1',
		);
	$options['display_date'] = array(
			'settings' => 'display_date',
			'label'   => __( 'Display Date', 'capeone' ),
			'section' => $section,
			'type'    => 'checkbox',
			'transport' => $transport,
			'default' => '1',
		);
	// Panel Header
	
	$panel = 'panel-header';
	
	$panels[] = array(
		'settings' => $panel,
		'title' => __( 'CapeOne: Header Options', 'capeone' ),
		'priority' => '3'
	);
	
	$section = 'section-header-general-options';

	$sections[] = array(
		'settings' => $section,
		'title' => __( 'General Options', 'capeone' ),
		'priority' => '1',
		'panel' => $panel
	);
	
	$options['header_style'] = array(
			'settings' => 'header_style',
			'label'   => __( 'Navigation Bar Style', 'capeone' ),
			'section' => $section,
			'type'    => 'radio-image',
			'choices' => array(
				'inline'=> $imagepath.'customize/header-inline.png',
				'classic'=> $imagepath.'customize/header-classic.png',
				'split'=> $imagepath.'customize/header-split.png',
				),
			'default' => 'inline',
			
		);
	
	$options['header_full_width'] = array(
			'settings' => 'header_full_width',
			'label'   => __( 'Full-width Header', 'capeone' ),
			'section' => $section,
			'type'    => 'checkbox',
			'transport' => $transport,
			'default' => '',
		);
	
	$options['header_background_color'] = array(
			'settings' => 'header_background_color',
			'label'   => __( 'Header background Color', 'capeone' ),
			'section' => $section,
			'type'    => 'color',
			'default' => 'rgba(255,255,255,1)',
			'transport' => $transport,
			'output' => array(
				array( 
				'element' => '.header-wrap,.capeone-header',
				'function' => 'css',
				'property' => 'background-color',
				)
			),
			'choices'     => array(
				'alpha' => true,
			),
			'js_vars' => array(
				array( 
				'element' => '.header-wrap,.capeone-header',
				'function' => 'css',
				'property' => 'background-color'
				)
			)
		);
	
	$options['sticky_logo'] = array(
				'settings' => 'sticky_logo',
				'label'   => __( 'Sticky Header Logo', 'capeone' ),
				'section' => 'title_tagline',
				'type'    => 'image',
				'default' => '',
				'transport' => $transport,
			);
	
	$section = 'section-header-topbar';

	$sections[] = array(
		'settings' => $section,
		'title' => __( 'Top Bar', 'capeone' ),
		'priority' => '2',
		'panel' => $panel
	);
	
	$options['display_topbar'] = array(
			'settings' => 'display_topbar',
			'label'   => __( 'Display Top Bar', 'capeone' ),
			'section' => $section,
			'type'    => 'checkbox',
			'transport' => $transport,
			'default' => '',
		);
	
	$options['topbar_left'] = array(
			'settings' => 'topbar_left',
			'label'   => __( 'Top Bar Left', 'capeone' ),
			'section' => $section,
			'type'    => 'repeater',
			'choices' => array('limit' => '6'),
			'transport' => $transport,
			'row_label' => array(
						'type' => 'field',
						'value' => esc_attr__('Item', 'capeone' ),
						'field' => 'text',),
			'fields' => array(
				'icon'=>array('type'=>'text','default'=>'','label'=> sprintf(__( 'Font-awesome Icon. <a href="%s" target="_blank">Get Icon String</a>', 'capeone' ),esc_url('https://fontawesome.com/v4.7.0/icons/') )),
				'text'=>array('type'=>'text','default'=>'','label'=> __( 'Text', 'capeone' )),
				'link'=>array('type'=>'link','default'=>'','label'=> __( 'Link', 'capeone' )),
				'target'=>array('type'=>'select','default'=>'', 'choices'=> $target, 'label'=> __( 'Target', 'capeone' )),
			),
			'default' =>  array(
				
				)
			);
		
		$options['topbar_icons'] = array(
				'settings' => 'topbar_icons',
				'label'   => __( 'Top Bar Icons', 'capeone' ),
				'section' => $section,
				'type'    => 'repeater',
				'choices' => array('limit' => '6'),
				'transport' => $transport,
				'row_label' => array(
							'type' => 'field',
							'value' => esc_attr__('Icon', 'capeone' ),
							'field' => 'icon',),
				'fields' => array(
					'icon'=>array('type'=>'text','default'=>'','label'=> sprintf(__( 'Font-awesome Icon. <a href="%s" target="_blank">Get Icon String</a>', 'capeone' ),esc_url('https://fontawesome.com/v4.7.0/icons/') )),
					'link'=>array('type'=>'link','default'=>'','label'=> __( 'Link', 'capeone' )),
					'target'=>array('type'=>'select','default'=>'', 'choices'=> $target, 'label'=> __( 'Target', 'capeone' )),
				),
				'default' =>  array(
					
					)
				);
	
		
	$options['topbar_right'] = array(
				'settings' => 'topbar_right',
				'label'   => __( 'Top Bar Right', 'capeone' ),
				'section' => $section,
				'type'    => 'repeater',
				'choices' => array('limit' => '6'),
				'transport' => $transport,
				'row_label' => array(
							'type' => 'field',
							'value' => esc_attr__('Item', 'capeone' ),
							'field' => 'text',),
				'fields' => array(
					'icon'=>array('type'=>'text','default'=>'','label'=> sprintf(__( 'Font-awesome Icon. <a href="%s" target="_blank">Get Icon String</a>', 'capeone' ),esc_url('https://fontawesome.com/v4.7.0/icons/') )),
					'text'=>array('type'=>'text','default'=>'','label'=> __( 'Text', 'capeone' )),
					'link'=>array('type'=>'link','default'=>'','label'=> __( 'Link', 'capeone' )),
					'target'=>array('type'=>'select','default'=>'', 'choices'=> $target, 'label'=> __( 'Target', 'capeone' )),
				),
				'default' =>  array(
					
					)
				);
				
	$section = 'section-navigation-bar';

	$sections[] = array(
		'settings' => $section,
		'title' => __( 'Navigation Bar', 'capeone' ),
		'priority' => '2',
		'panel' => $panel
	);
		
	$options['display_shopping_cart_icon'] = array(
			'settings' => 'display_shopping_cart_icon',
			'label'   => __( 'Display Shopping Cart Icon', 'capeone' ),
			'section' => $section,
			'type'    => 'checkbox',
			'default' => '',
			'transport' => $transport,
		);

	$options['display_search_icon'] = array(
			'settings' => 'display_search_icon',
			'label'   => __( 'Display Search Icon', 'capeone' ),
			'section' => $section,
			'type'    => 'checkbox',
			'default' => '1',
			'transport' => $transport,
		);
	
	$options['sticky_header'] = array(
			'settings' => 'sticky_header',
			'label'   => __( 'Sticky Navigation Bar', 'capeone' ),
			'section' => $section,
			'type'    => 'checkbox',
			'default' => '1',
			'transport' => $transport,
		);
	
	
	$section = 'section-header-inline';

	$sections[] = array(
		'settings' => $section,
		'title' => __( 'Inline Header', 'capeone' ),
		'priority' => '3',
		'panel' => $panel
	);
	/* Inline Header Options */
	$options['inline_header_menu_position'] = array(
			'settings' => 'inline_header_menu_position',
			'label'   => __( 'Menu Position', 'capeone' ),
			'section' => $section,
			'type'    => 'radio-image',
			'transport' => $transport,
			'choices' => array(
				'left'=> $imagepath.'customize/header-inline-menuleft.png',
				'right'=> $imagepath.'customize/header-inline-menuright.png',
				'center'=> $imagepath.'customize/header-inline-menucenter.png',
				'justify'=> $imagepath.'customize/header-inline-menujustify.png',
				),
			'default' => 'right',
		);
	
	$section = 'section-header-classic';

	$sections[] = array(
		'settings' => $section,
		'title' => __( 'Classic Header', 'capeone' ),
		'priority' => '4',
		'panel' => $panel
	);
	/* Classic Header Options */
	$options['classic_header_logo_left'] = array(
				'settings' => 'classic_header_logo_left',
				'label'   => __( 'Widgets: Logo Row(Left)', 'capeone' ),
				'section' => $section,
				'type'    => 'repeater',
				'transport' => $transport,
				'row_label' => array(
							'type' => 'field',
							'value' => esc_attr__('Item', 'capeone' ),
							'field' => 'text',),
				'fields' => array(
					'icon'=>array('type'=>'text','default'=>'','label'=> sprintf(__( 'Font-awesome Icon. <a href="%s" target="_blank">Get Icon String</a>', 'capeone' ),esc_url('https://fontawesome.com/v4.7.0/icons/') )),
					'text'=>array('type'=>'text','default'=>'','label'=> __( 'Text', 'capeone' )),
					'link'=>array('type'=>'link','default'=>'','label'=> __( 'Link', 'capeone' )),
					'target'=>array('type'=>'select','default'=>'', 'choices'=> $target, 'label'=> __( 'Target', 'capeone' )),
				),
				'default' =>  array(
					
						)
				);
		
	$options['classic_header_logo_right'] = array(
				'settings' => 'classic_header_logo_right',
				'label'   => __( 'Widgets: Logo Row(Right)', 'capeone' ),
				'section' => $section,
				'type'    => 'repeater',
				'transport' => $transport,
				'row_label' => array(
							'type' => 'field',
							'value' => esc_attr__('Item', 'capeone' ),
							'field' => 'text',),
				'fields' => array(
					'icon'=>array('type'=>'text','default'=>'','label'=> sprintf(__( 'Font-awesome Icon. <a href="%s" target="_blank">Get Icon String</a>', 'capeone' ),esc_url('https://fontawesome.com/v4.7.0/icons/') )),
					'text'=>array('type'=>'text','default'=>'','label'=> __( 'Text', 'capeone' )),
					'link'=>array('type'=>'link','default'=>'','label'=> __( 'Link', 'capeone' )),
					'target'=>array('type'=>'select','default'=>'', 'choices'=> $target, 'label'=> __( 'Target', 'capeone' )),
				),
				'default' =>  array(
					
					)
				);
	
	$options['classic_header_logo_position'] = array(
			'settings' => 'classic_header_logo_position',
			'label'   => __( 'Logo Position', 'capeone' ),
			'section' => $section,
			'type'    => 'radio-image',
			'transport' => $transport,
			'choices' => array(
				'left'=> $imagepath.'customize/header-classic-logoleft.png',
				'center'=> $imagepath.'customize/header-classic-logocenter.png',
				),
			'default' => 'left',
		);
	
	$options['classic_header_menu_position'] = array(
			'settings' => 'classic_header_menu_position',
			'label'   => __( 'Menu Position', 'capeone' ),
			'section' => $section,
			'type'    => 'radio-image',
			'transport' => $transport,
			'choices' => array(
				'left'=> $imagepath.'customize/header-classic-menuleft.png',
				'center'=> $imagepath.'customize/header-classic-menucenter.png',
				),
			'default' => 'left',
		);
	
	$section = 'section-header-split';

	$sections[] = array(
		'settings' => $section,
		'title' => __( 'Split Header', 'capeone' ),
		'priority' => '5',
		'panel' => $panel
	);
	
	$default_menu_items = array(
			array('title'=> 'Menu Item 1','link'=>'#','icon'=>''),
			array('title'=> 'Menu Item 2','link'=>'#','icon'=>''),
			array('title'=> 'Menu Item 3','link'=>'#','icon'=>''),
			array('title'=> 'Menu Item 4','link'=>'#','icon'=>''),
			);
	
	$options['split_header_left_menu'] = array(
			'settings' => 'split_header_left_menu',
			'label'   => __( 'Left Menu Items', 'capeone' ),
			'section' => $section,
			'type'    => 'repeater',
			'transport' => $transport,
			'row_label' => array(
					'type' => 'field',
					'value' => esc_attr__('Menu Item', 'capeone' ),
					'field' => 'title',),
			'fields' => array(
					'icon'=>array('type'=>'text','default'=>'','label'=> sprintf(__( 'Font-awesome Icon. <a href="%s" target="_blank">Get Icon String</a>', 'capeone' ),esc_url('https://fontawesome.com/v4.7.0/icons/') )),
					'title'=>array('type'=>'text','default'=>'','label'=> __( 'Title', 'capeone' )),
					'link'=>array('type'=>'link','default'=> '','label'=> __( 'Link', 'capeone' )),
				
				),
			'default' =>  $default_menu_items
		);
			
	$options['split_header_menu_position'] = array(
			'settings' => 'split_header_menu_position',
			'label'   => __( 'Menu Position', 'capeone' ),
			'section' => $section,
			'type'    => 'radio-image',
			'transport' => $transport,
			'choices' => array(
				'justify'=> $imagepath.'customize/header-split-justify.png',
				'inside'=> $imagepath.'customize/header-split-inside.png',
				'outside'=> $imagepath.'customize/header-split-outside.png',
				),
			'default' => 'outside',
		);
	// Panel Footer
	
	$panel = 'panel-footer';
	
	$panels[] = array(
		'settings' => $panel,
		'title' => __( 'CapeOne: Footer Options', 'capeone' ),
		'priority' => '4'
	);
	
	$section = 'section-footer-widgets';

	$sections[] = array(
		'settings' => $section,
		'title' => __( 'CapeOne:  Footer Widgets Area', 'capeone' ),
		'priority' => '1',
		'panel' => $panel
	);
	
	$options['display_footer_widgets'] = array(
		'settings' => 'display_footer_widgets',
		'label'   => __( 'Display Footer Widgets', 'capeone' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => '',
	);
	
	$options['footer_widgets_fullwidth'] = array(
		'settings' => 'footer_widgets_fullwidth',
		'label'   => __( 'Fullwidth', 'capeone' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => '',
	);
	
	$options['footer_columns'] = array(
		'settings' => 'footer_columns',
		'label'   => __( 'Footer Columns', 'capeone' ),
		'section' => $section,
		'type'    => 'radio',
		'default' => '4',
		'choices' => array( '1' => __( '1 Column', 'capeone' ), '2' => __( '2 Columns', 'capeone' ), '3' => __( '3 Columns', 'capeone' ), '4' => __( '4 Columns', 'capeone' ), )
	);
	
	$options['footer_widgets_padding'] = array(
		'type'        => 'dimensions',
		'settings'    => 'footer_widgets_padding',
		'label'       => esc_attr__( 'Footer Widgets Area Padding', 'capeone' ),
		'description' => '',
		'section'     => $section,
		'default'     => array(
			'padding-top'    => '60px',
			'padding-bottom' => '40px',
			'padding-left'   => '0',
			'padding-right'  => '0',
		),
		'output'      => array(
			array(
				'element' => '.footer-widget-area',
			),
		),
	);
	
	$section = 'section-footer-info';
	$sections[] = array(
		'settings' => $section,
		'title' => __( 'CapeOne:  Footer Info Area', 'capeone' ),
		'priority' => '1',
		'panel' => $panel
	);
	
	$options['footer_layout'] = array(
		'settings' => 'footer_layout',
		'label'   => __( 'Layout', 'capeone' ),
		'section' => $section,
		'type'    => 'radio',
		'default' => 'inline',
		'choices' => array( 'inline' => __( 'Inline', 'capeone' ), 'center' => __( 'Center', 'capeone' ) )
	);
	
	$options['footer_info_padding'] = array(
		'type'        => 'dimensions',
		'settings'    => 'footer_info_padding',
		'label'       => esc_attr__( 'Footer Info Area Padding', 'capeone' ),
		'description' => '',
		'section'     => $section,
		'default'     => array(
			'padding-top'    => '20px',
			'padding-bottom' => '20px',
			'padding-left'   => '0',
			'padding-right'  => '0',
		),
		'output'      => array(
			array(
				'element' => '.footer-info-area',
			),
		),
	);
	
	$options['footer_info_fullwidth'] = array(
		'settings' => 'footer_info_fullwidth',
		'label'   => __( 'Fullwidth', 'capeone' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => '',
	);

	$options['display_footer_icons'] = array(
		'settings' => 'display_footer_icons',
		'label'   => __( 'Display Footer Icons', 'capeone' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => '1',
	);
	
	$options['footer_icons'] = array(
		'settings' => 'footer_icons',
		'label'   => __( 'Footer Icons', 'capeone' ),
		'section' => $section,
		'type'    => 'repeater',
		'choices' => array('limit' => '6'),
		'transport' => $transport,
		'row_label' => array(
					'type' => 'field',
					'value' => esc_attr__('Icon', 'capeone' ),
					'field' => 'title',),
		'fields' => array(
			'icon'=>array('type'=>'text','default'=>'','label'=> sprintf(__( 'Font-awesome Icon. <a href="%s" target="_blank">Get Icon String</a>', 'capeone' ),esc_url('https://fontawesome.com/v4.7.0/icons/') )),
			'title'=>array('type'=>'text','default'=>'','label'=> __( 'Title', 'capeone' )),
			'link'=>array('type'=>'link','default'=> '','label'=> __( 'Link', 'capeone' )),
		
		),
		'default' =>  array(
			
			)
		);
	
	$options['copyright'] = array(
		'settings' => 'copyright',
		'label'   => __( 'Copyright', 'capeone' ),
		'section' => $section,
		'type'    => 'editor',
		'default' => 'Designed by <a href="'.esc_url('https://velathemes.com/').'" target="_blank">VelaThemes</a>. All Rights Reserved.'
		);
		
	// Colors & Background
	
	$panel = 'panel-colors-background';
	
	$panels[] = array(
		'settings' => $panel,
		'title' => __( 'CapeOne: Colors & Background', 'capeone' ),
		'priority' => '5'
	);
	
	$section = 'section-base-colors';
	$sections[] = array(
		'settings' => $section,
		'title' => __( 'Base Colors', 'capeone' ),
		'priority' => '1',
		'panel' => $panel
	);
	
	$options['primary_color'] = array(
		'settings' => 'primary_color',
		'label'   => __( 'Primary Color', 'capeone' ),
		'priority' => '1',
		'section' => $section,
		'type'    => 'color',
		'transport' => $transport,
		'default' => '#00dfb8',
	);
	
	
	$section = 'section-top-bar-background';
	$sections[] = array(
		'settings' => $section,
		'title' => __( 'Top Bar', 'capeone' ),
		'priority' => '2',
		'panel' => $panel
	);
	
	$options['topbar_background_color'] = array(
		'settings' => 'topbar_background_color',
		'label'   => __( 'Top Bar Background Color', 'capeone' ),
		'priority' => '1',
		'section' => $section,
		'type'    => 'color',
		'transport' => $transport,
		'default' => '#ffffff',
		'output'      => array(
			array(
				'element' => '.capeone-top-bar-wrap',
				'property' => 'background-color',
			),
		),
		'choices'     => array(
			'alpha' => true,
		),
	);
	
	$section = 'section-navigation-bar-background';
	$sections[] = array(
		'settings' => $section,
		'title' => __( 'Navigation Bar', 'capeone' ),
		'priority' => '3',
		'panel' => $panel
	);
	
	$options['navigation_background'] = array(
		'settings' => 'navigation_background',
		'label'   => __( 'Navigation Bar Background', 'capeone' ),
		'priority' => '1',
		'section' => $section,
		'type'    => 'background',
		'transport' => $transport,
		'default' => array( 'background-color' => '#ffffff' ),
		'output'      => array(
			array(
				'element' => '.capeone-main-header-wrap',
			),
		),
		'choices'     => array(
			'alpha' => true,
		),
	);
	
	$section = 'section-footer-widget-area-background';
	$sections[] = array(
		'settings' => $section,
		'title' => __( 'Footer Widget Area', 'capeone' ),
		'priority' => '4',
		'panel' => $panel
	);
	
	$options['footer_widget_area_background'] = array(
		'settings' => 'footer_widget_area_background',
		'label'   => __( 'Footer Widget Area Background', 'capeone' ),
		'priority' => '1',
		'section' => $section,
		'type'    => 'background',
		'transport' => $transport,
		'default' => array('background-color' => '#f7f7f7'),
		'output'      => array(
			array(
				'element' => '.footer-widget-area',
			),
		),
		'choices'     => array(
			'alpha' => true,
		),
	);
	
	$section = 'section-footer-info-area-background';
	$sections[] = array(
		'settings' => $section,
		'title' => __( 'Footer Info Area', 'capeone' ),
		'priority' => '4',
		'panel' => $panel
	);
	
	$options['footer_info_area_background'] = array(
		'settings' => 'footer_info_area_background',
		'label'   => __( 'Footer Info Area Background', 'capeone' ),
		'priority' => '1',
		'section' => $section,
		'type'    => 'background',
		'transport' => $transport,
		'default' => array('background-color' => '#e8e8e8'),
		'output'      => array(
			array(
				'element' => '.footer-info-area',
			),
		),
		'choices'     => array(
			'alpha' => true,
		),
	);
	
	$section = 'section-page-title-bar-background';
	$sections[] = array(
		'settings' => $section,
		'title' => __( 'Page Title Bar', 'capeone' ),
		'priority' => '5',
		'panel' => $panel
	);
	
	$options['page_title_bar_background'] = array(
		'settings' => 'page_title_bar_background',
		'label'   => __( 'Page Title Bar', 'capeone' ),
		'priority' => '1',
		'section' => $section,
		'type'    => 'background',
		'transport' => $transport,
		'default' => array('background-color' => '#f5f5f5'),
		'output'      => array(
			array(
				'element' => '.page-title-bar',
			),
		),
		'choices'     => array(
			'alpha' => true,
		),
	);
	

	// Panel Typography
	$panel = 'panel-typography';
	
	$panels[] = array(
		'settings' => $panel,
		'title' => __( 'CapeOne: Typography', 'capeone' ),
		'priority' => '10'
	);
	
	$section = 'base-typorgraphy';
	$sections[] = array(
		'settings' => $section,
		'title' => __( 'Base Typorgraphy', 'capeone' ),
		'priority' => '10',
		'panel' => $panel
	);
	
	$options['body_typography'] = array(
		'type'        => 'typography',
		'settings'    => 'body_typography',
		'label'       => esc_attr__( 'Body Typography', 'capeone' ),
		'section'     => $section,
		'default'     => array(
			'font-family'    => 'Lato',
			'variant'        => 'regular',
			'font-size'      => '14px',
			'line-height'    => '1.8',
			'letter-spacing' => '0',
			'color'          => '#333',
			'text-transform' => 'none',
		),
		'priority'    => 10,
		'output'      => array(
			array(
				'element' => 'html, body',
			),
	));
	
	$options['h1_typography'] = array(
		'type'        => 'typography',
		'settings'    => 'h1_typography',
		'label'       => esc_attr__( 'H1', 'capeone' ),
		'section'     => $section,
		'transport' => $transport,
		'default'     => array(
			'font-family'    => 'Lato',
			'variant'        => 'regular',
			'font-size'      => '36px',
			'line-height'    => '1.1',
			'letter-spacing' => '0',
			'color'          => '#333',
			'text-transform' => 'none',
		),
		'priority'    => 10,
		'output'      => array(
			array(
				'element' => 'h1',
			),
			
	),
	 'js_vars' => array(
        array(
            'element' => 'h1',
        ))
		);
	
	$options['h2_typography'] = array(
		'type'        => 'typography',
		'settings'    => 'h2_typography',
		'label'       => esc_attr__( 'H2', 'capeone' ),
		'section'     => $section,
		'default'     => array(
			'font-family'    => 'Lato',
			'variant'        => 'regular',
			'font-size'      => '30px',
			'line-height'    => '1.1',
			'letter-spacing' => '0',
			'color'          => '#333',
			'text-transform' => 'none',
		),
		'priority'    => 10,
		'output'      => array(
			array(
				'element' => 'h2',
			),
	));
	
	
	$options['h3_typography'] = array(
		'type'        => 'typography',
		'settings'    => 'h3_typography',
		'label'       => esc_attr__( 'H3', 'capeone' ),
		'section'     => $section,
		'default'     => array(
			'font-family'    => 'Lato',
			'variant'        => 'regular',
			'font-size'      => '24px',
			'line-height'    => '1.1',
			'letter-spacing' => '0',
			'color'          => '#333',
			'text-transform' => 'none',
		),
		'priority'    => 10,
		'output'      => array(
			array(
				'element' => 'h3',
			),
	));

		
	$options['h4_typography'] = array(
			'type'        => 'typography',
			'settings'    => 'h4_typography',
			'label'       => esc_attr__( 'H4', 'capeone' ),
			'section'     => $section,
			'default'     => array(
				'font-family'    => 'Lato',
				'variant'        => 'regular',
				'font-size'      => '20px',
				'line-height'    => '1.1',
				'letter-spacing' => '0',
				'color'          => '#333',
				'text-transform' => 'none',
			),
			'priority'    => 10,
			'output'      => array(
				array(
					'element' => 'h4',
				),
		));
	
	$options['h5_typography'] = array(
			'type'        => 'typography',
			'settings'    => 'h5_typography',
			'label'       => esc_attr__( 'H5', 'capeone' ),
			'section'     => $section,
			'default'     => array(
				'font-family'    => 'Lato',
				'variant'        => 'regular',
				'font-size'      => '18px',
				'line-height'    => '1.1',
				'letter-spacing' => '0',
				'color'          => '#333',
				'text-transform' => 'none',
			),
			'choices'     => array(
				'alpha' => true,
			),
			'priority'    => 10,
			'output'      => array(
				array(
					'element' => 'h5',
				),
		));
		
	$options['h6_typography'] = array(
			'type'        => 'typography',
			'settings'    => 'h6_typography',
			'label'       => esc_attr__( 'H6', 'capeone' ),
			'section'     => $section,
			'default'     => array(
				'font-family'    => 'Lato',
				'variant'        => 'regular',
				'font-size'      => '16px',
				'line-height'    => '1.1',
				'letter-spacing' => '0',
				'color'          => '#333',
				'text-transform' => 'none',
			),
			'priority'    => 10,
			'output'      => array(
				array(
					'element' => 'h6',
				),
		));
	
	$section = 'top-bar-typorgraphy';
	$sections[] = array(
		'settings' => $section,
		'title' => __( 'Top Bar', 'capeone' ),
		'priority' => '10',
		'panel' => $panel
	);
	
	$options['topbar_typography'] = array(
			'type'        => 'typography',
			'settings'    => 'topbar_typography',
			'label'       => esc_attr__( 'Content', 'capeone' ),
			'section'     => $section,
			'default'     => array(
				'font-family'    => 'Open Sans',
				'variant'        => 'regular',
				'font-size'      => '12px',
				'line-height'    => '18px',
				'letter-spacing' => '0.5px',
				'color'          => '#666',
				'text-transform' => 'none',
			),
			'priority'    => 10,
			'output'      => array(
				array(
					'element' => '.capeone-top-bar .capeone-microwidget, .capeone-top-bar .capeone-microwidget a',
				),
		));
		
	$section = 'navigation-typography';
	$sections[] = array(
		'settings' => $section,
		'title' => __( 'Navigation Bar', 'capeone' ),
		'priority' => '10',
		'panel' => $panel
	);	
		
	$options['site_title_typography'] = array(
			'type'        => 'typography',
			'settings'    => 'site_title_typography',
			'label'       => esc_attr__( 'Site Title', 'capeone' ),
			'section'     => $section,
			'default'     => array(
				'font-family'    => 'Lato',
				'variant'        => 'regular',
				'font-size'      => '20px',
				'line-height'    => '1',
				'letter-spacing' => '0',
				'color'          => '#333',
				'text-transform' => 'none',
			),
			'priority'    => 10,
			'output'      => array(
				array(
					'element' => '.site-name',
				),
		));
	
	$options['main_menu_typography'] = array(
			'type'        => 'typography',
			'settings'    => 'main_menu_typography',
			'label'       => esc_attr__( 'Main Menu', 'capeone' ),
			'section'     => $section,
			'default'     => array(
				'font-family'    => 'Lato',
				'variant'        => '400',
				'font-size'      => '12px',
				'line-height'    => '1',
				'letter-spacing' => '0.3px',
				'color'          => '#333',
				'text-transform' => 'uppercase',
			),
			'priority'    => 10,
			'output'      => array(
				array(
					'element' => '.capeone-header .capeone-main-nav > li > a',
				),
		));
	
	$options['sub_menu_typography'] = array(
			'type'        => 'typography',
			'settings'    => 'sub_menu_typography',
			'label'       => esc_attr__( 'Sub Menu', 'capeone' ),
			'section'     => $section,
			'default'     => array(
				'font-family'    => 'Lato',
				'variant'        => 'regular',
				'font-size'      => '12px',
				'line-height'    => '1.8',
				'letter-spacing' => '0',
				'color'          => '#333',
				'text-transform' => 'none',
			),
			'priority'    => 10,
			'output'      => array(
				array(
					'element' => '.sub-menu li a',
				),
		));
		
	$section = 'widget-typography';
	$sections[] = array(
		'settings' => $section,
		'title' => __( 'Widget', 'capeone' ),
		'priority' => '10',
		'panel' => $panel
	);
	
	$options['widget_title_typography'] = array(
			'type'        => 'typography',
			'settings'    => 'widget_title_typography',
			'label'       => esc_attr__( 'Widget Title', 'capeone' ),
			'section'     => $section,
			'default'     => array(
				'font-family'    => 'Lato',
				'variant'        => '400',
				'font-size'      => '16px',
				'line-height'    => '1.1',
				'letter-spacing' => '0',
				'color'          => '#333',
				'text-transform' => 'uppercase',
			),
			'priority'    => 10,
			'output'      => array(
				array(
					'element' => '.widget-title',
				),
		));
		
	$options['widget_content_typography'] = array(
			'type'        => 'typography',
			'settings'    => 'widget_content_typography',
			'label'       => esc_attr__( 'Widget Content', 'capeone' ),
			'section'     => $section,
			'default'     => array(
				'font-family'    => 'Lato',
				'variant'        => '400',
				'font-size'      => '14px',
				'line-height'    => '1.8',
				'letter-spacing' => '0',
				'color'          => '#a0a0a0',
				'text-transform' => 'none',
			),
			'priority'    => 10,
			'output'      => array(
				array(
					'element' => '.widget-box, .widget-box a',
				),
		));
		
	$section = 'footer-typography';
	$sections[] = array(
		'settings' => $section,
		'title' => __( 'Footer Info', 'capeone' ),
		'priority' => '10',
		'panel' => $panel
	);
		
	$options['footer_typography'] = array(
			'type'        => 'typography',
			'settings'    => 'footer_typography',
			'label'       => esc_attr__( 'Footer Content', 'capeone' ),
			'section'     => $section,
			'default'     => array(
				'font-family'    => 'Lato',
				'variant'        => '400',
				'font-size'      => '14px',
				'line-height'    => '1.8',
				'letter-spacing' => '0',
				'color'          => '#333',
				'text-transform' => 'none',
			),
			'transport'   => $transport,
			'priority'    => 10,
			'output'      => array(
				array(
					'element' => '.footer-info-area',
				),

		));
		
	$section = 'page-title-bar-typography';
	$sections[] = array(
		'settings' => $section,
		'title' => __( 'Page Title Bar', 'capeone' ),
		'priority' => '10',
		'panel' => $panel
	);
	
	$options['page_title_typography'] = array(
			'type'        => 'typography',
			'settings'    => 'page_title_typography',
			'label'       => esc_attr__( 'Page Title', 'capeone' ),
			'section'     => $section,
			'default'     => array(
				'font-family'    => 'Lato',
				'variant'        => '400',
				'font-size'      => '36px',
				'line-height'    => '1.1',
				'letter-spacing' => '0',
				'color'          => '#333',
				'text-transform' => 'none',
			),
			'priority'    => 10,
			'output'      => array(
				array(
					'element' => '.page-title, .page-title h1',
				),
		));
	
	$options['breadcrumb_typography'] = array(
			'type'        => 'typography',
			'settings'    => 'breadcrumb_typography',
			'label'       => esc_attr__( 'Breadcrumb', 'capeone' ),
			'section'     => $section,
			'default'     => array(
				'font-family'    => 'Lato',
				'variant'        => '400',
				'font-size'      => '14px',
				'line-height'    => '1.1',
				'letter-spacing' => '0',
				'color'          => '#333',
				'text-transform' => 'none',
			),
			'priority'    => 10,
			'output'      => array(
				array(
					'element' => '.breadcrumb-nav, .breadcrumb-nav a',
				),
		));
	
	$section = 'blog-typography';
	$sections[] = array(
		'settings' => $section,
		'title' => __( 'Blog', 'capeone' ),
		'priority' => '10',
		'panel' => $panel
	);
	
	$options['post_title_typography'] = array(
			'type'        => 'typography',
			'settings'    => 'post_title_typography',
			'label'       => esc_attr__( 'Post Title', 'capeone' ),
			'section'     => $section,
			'default'     => array(
				'font-family'    => 'Lato',
				'variant'        => '700',
				'font-size'      => '22px',
				'line-height'    => '1.1',
				'letter-spacing' => '0',
				'color'          => '#333',
				'text-transform' => 'none',
			),
			'priority'    => 10,
			'output'      => array(
				array(
					'element' => 'h1.entry-title',
				),
		));
	
	return array( 'options' => $options, 'panels' => $panels, 'sections' => $sections );

}

global $capeone_default_options;

$options = capeone_customizer_library_options();

Kirki::add_config(
	CAPEONE_TEXTDOMAIN, array(
		'capability'  => 'edit_theme_options',
		'option_type' => 'option',
		'option_name' => CAPEONE_TEXTDOMAIN,
	)
);

// add panels
if( is_array( $options['panels'] ) ){
	
	$p = 1;
	foreach(  $options['panels'] as $panel ){
		
		Kirki::add_panel( $panel['settings'], array(
		  'priority'    => $p,
		  'title'       => $panel['title'],
		  'description' => '',
		  ) );
		
		$p++;
		
		}
	
	}

// add sections
if( is_array( $options['sections'] ) ){
	
	$s = 1;
	foreach(  $options['sections'] as $section ){
		
		Kirki::add_section( $section['settings'], array(
		  'title'          => $section['title'],
		  'description'    => '',
		  'panel'          => $section['panel'], 
		  'priority'       => $s,
		  'capability'     => 'edit_theme_options',
		  'theme_supports' => '',
	  ) );
		
		$s++;
		
		}
	
	}

// add options
if( is_array( $options['options'] ) ){
	
	foreach(  $options['options'] as $key=>$option ){
		
		$default = array(
			'settings'         => '',
			'choices'         => '',
			'row_label'       => '',
			'fields'          => '',
			'active_callback' => '',
			'transport'       => 'refresh',
			'output'          => '',
			'js_vars'         => '',
			'partial_refresh' => '',
			'description'     => '',
			'priority'    => '',
		
		);
	
	if( isset( $option['default']) )
		$capeone_default_options[$key] = $option['default'];
	//$option = array_merge($default, $option);
		
	if(isset($option['settings']))			
		Kirki::add_field( CAPEONE_TEXTDOMAIN, $option );
		
		}
	
	}

