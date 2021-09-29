<?php

define('CAPEONE_VERSION','1.0.7');
define('CAPEONE_TEXTDOMAIN','capeone');

if( !function_exists('is_plugin_active') ) {
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

$template_directory = trailingslashit( get_template_directory() );

require_once($template_directory . '/inc/plugin-install/class-plugin-install-helper.php');
// Helper library for the theme customizer.
require_once($template_directory . '/inc/kirki-framework/kirki.php');
// Define options for the theme customizer.
require_once($template_directory . '/inc/kirki-customizer-options.php');

function capeone_setup() {

	load_theme_textdomain( 'capeone', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'title-tag' );

	add_theme_support( 'post-thumbnails' );

	add_image_size( 'capeone_featured_image', 960, 720, true );
	
	add_image_size( 'capeone_widget_post_image', 480, 360, true );

	// Set the default content width.
	$GLOBALS['content_width'] = 850;

	register_nav_menus( array(
		'top'    => esc_html__( 'Top Menu', 'capeone' ),
		'top-left' => esc_html__( 'Top Left Menu (Split Navigation Bar)', 'capeone' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'height'      => 100,
		'flex-width'  => true,
		'flex-height' => true,
	) );
	
	// Setup the WordPress core custom header feature.
	add_theme_support( 'custom-header', array(
		'default-image'          => '',
		'random-default'         => false,
		'width'                  => '1920',
		'height'                 => '70',
		'flex-height'            => true,
		'flex-width'             => true,
		'default-text-color'     => '#333333',
		'header-text'            => true,
		'uploads'                => true,
		'wp-head-callback'       => '',
		'admin-head-callback'    => '',
		'admin-preview-callback' => ''
	)); 

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background',  array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
	
	// Woocommerce Support
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
 	 */
	add_editor_style( array( 'assets/css/editor-style.css' ) );
	
}
add_action( 'after_setup_theme', 'capeone_setup' );

/**
 * After switch theme
 */
function capeone_after_switch_theme(){
	delete_option('capeone_welcome_notice');
}
add_action('after_switch_theme', 'capeone_after_switch_theme');

/**
 * Enqueue scripts and styles.
 */
function capeone_scripts() {
	
	global $capeone_options;
	
	$capeone_options = get_option( CAPEONE_TEXTDOMAIN );
	
	$page_preloader = absint( capeone_option( 'page_preloader' ) );
	
	
	wp_enqueue_style( 'bootstrap',  get_template_directory_uri() .'/assets/plugins/bootstrap/css/bootstrap.css', false, '', false );
	wp_enqueue_style( 'font-awesome',  get_template_directory_uri() .'/assets/plugins/font-awesome/css/font-awesome.min.css', false, '', false );
	
	// Theme stylesheet.
	wp_enqueue_style( 'capeone-style', get_stylesheet_uri() );

	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/plugins/bootstrap/js/bootstrap.min.js' , array( 'jquery' ), null, true);
	
	wp_enqueue_script( 'respond', get_template_directory_uri() . '/assets/plugins/respond.min.js' , array( 'jquery' ), null, true);
		
	if( $page_preloader == '1' ||  is_customize_preview() )
		wp_enqueue_script( 'jquery-loading-overlay', get_template_directory_uri() . '/assets/plugins/jquery-loading-overlay/loadingoverlay.js' , array( 'jquery' ), null, true);
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	$preloader_background = esc_attr(capeone_option('preloader_background'));
	$preloader_opacity = esc_attr(capeone_option('preloader_opacity'));
	$preloader_image = esc_attr(capeone_option('preloader_image'));
	
	if (is_numeric($preloader_image)) {
		$image_attributes = wp_get_attachment_image_src($preloader_image, 'full');
		$preloader_image   = $image_attributes[0];
	}
	
	$preloader_bg = "";
	if( $preloader_background != "" ){
		$rgb = capeone_hex2rgb( $preloader_background );
		$preloader_bg = "rgba(".$rgb[0].",".$rgb[1].",".$rgb[2].",".$preloader_opacity.")";
	}
	
	wp_enqueue_script( 'capeone-main', get_template_directory_uri() . '/assets/js/main.js' , array( 'jquery' ), CAPEONE_VERSION, true);
	wp_localize_script( 'capeone-main', 'capeone_params', array(
		'ajaxurl'  => admin_url('admin-ajax.php'),
		'themeurl' => get_template_directory_uri(),
		'page_preloader' => $page_preloader,
		'preloader_background' => $preloader_bg,
		'preloader_image' => $preloader_image,
	)  );
	
	$custom_css = '';
	$header_text_color = get_header_textcolor();

	if ( 'blank' != $header_text_color ) :
		$custom_css .= ".site-name, .site-tagline { color: ".sanitize_hex_color( $header_text_color )." ; }.site-tagline { display: none; }";
	else:
		$custom_css .= ".site-name,.site-tagline {display: none;}";
	endif;
	
	
	$primary_color = capeone_option('primary_color');
	if( $primary_color != '' ){
	
	 	$primary_color = sanitize_hex_color( $primary_color );
	
		$custom_css .= "a:hover,a:active {color: ".$primary_color.";}header a:hover {color: ".$primary_color.";}.site-nav  > div > ul > li.current > a {color: ".$primary_color.";}.blog-list-wrap .entry-category a {color: ".$primary_color.";}.entry-meta a:hover {color: ".$primary_color.";}.form-control:focus,select:focus,input:focus,textarea:focus,input[type=\"text\"]:focus,input[type=\"password\"]:focus,input[type=\"datetime\"]:focus,input[type=\"datetime-local\"]:focus,input[type=\"date\"]:focus,input[type=\"month\"]:focus,input[type=\"time\"]:focus,input[type=\"week\"]:focus,input[type=\"number\"]:focus,input[type=\"email\"]:focus,input[type=\"url\"]:focus,input[type=\"search\"]:focus,input[type=\"tel\"]:focus,input[type=\"color\"]:focus,.uneditable-input:focus {border-color: ".$primary_color.";}input[type=\"submit\"] {background-color: ".$primary_color.";}.entry-box.grid .img-box-caption .entry-category {background-color: ".$primary_color.";}.widget-title:before {background-color: ".$primary_color.";}.btn-normal,button,.cactus-btn-normal,.woocommerce #respond input#submit.alt,.woocommerce a.button.alt,.woocommerce button.button.alt,.woocommerce input.button.alt {background-color: ".$primary_color.";}.woocommerce #respond input#submit.alt:hover,.woocommerce a.button.alt:hover,.woocommerce button.button.alt:hover,.woocommerce input.button.alt:hover {background-color: ".$primary_color.";}.woocommerce nav.woocommerce-pagination ul li a:focus,.woocommerce nav.woocommerce-pagination ul li a:hover {color: ".$primary_color.";}.capeone-header .capeone-main-nav > li > a:hover,.capeone-header .capeone-main-nav > li.active > a {color: ".$primary_color.";}.capeone-header .capeone-main-nav > li > a:hover, .capeone-header .capeone-main-nav > li.active > a {color:".$primary_color.";}";
	}
	
	// Form styles
	$form_border_style = capeone_option('form_border_style');
	$form_border_width = capeone_option('form_border_width');
	$form_border_color = capeone_option('form_border_color');
	$form_background_color = capeone_option('form_background_color');
	$form_broder_radius = capeone_option('form_broder_radius');
	$custom_css .=  '.form-control, select, textarea, input[type="text"], input[type="password"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="email"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"], .uneditable-input{	border-style:'.esc_attr($form_border_style).';	border-width:'.absint($form_border_width).'px;border-color:'.sanitize_hex_color($form_border_color).';	background-color:'.sanitize_hex_color($form_background_color).';border-radius: '.esc_attr($form_broder_radius).'px;}';
	
	// Button styles
	$button_font_size = capeone_option('button_font_size');
	$button_color = capeone_option('button_color');
	$button_text_transform = capeone_option('button_text_transform');
	$button_broder_radius = capeone_option('button_broder_radius');
	$button_border_color = capeone_option('button_border_color');
	$button_background_color = capeone_option('button_background_color');
	$button_border_style = capeone_option('button_border_style');
	$button_border_width = capeone_option('button_border_width');
	$button_border_style = capeone_option('button_border_style');
	
	$custom_css .=  'button,input[type="submit"],.cactus-btn,btn-normal,.woocommerce #respond input#submit,.woocommerce a.button,.woocommerce button.button,.woocommerce input.button{'.((is_numeric($button_font_size) && $button_font_size > 0 )?'font-size: '.absint($button_font_size).'px;':'').'color: '.sanitize_hex_color($button_color).';text-transform: '.esc_attr($button_text_transform).';border-radius: '.esc_attr($button_broder_radius).'px;border-color:'.sanitize_hex_color($button_border_color).';background-color:'.sanitize_hex_color($button_background_color).';border-style:'.esc_attr($button_border_style).';border-width:'.absint($button_border_width).'px;}';
	
	$custom_css = apply_filters( 'capeone_additional_css', $custom_css );

	wp_add_inline_style( 'capeone-style', str_replace('&gt;', '>', stripslashes(wp_filter_nohtml_kses( $custom_css ) ) ) );

}
add_action( 'wp_enqueue_scripts', 'capeone_scripts' );

function capeone_admin_scripts(){
	global $pagenow;
	wp_enqueue_script( 'capeone-admin', get_template_directory_uri().'/assets/js/admin.js', array( 'jquery' ), '', true );
	//if( ($pagenow == "themes.php" && isset($_GET['page']) && $_GET['page'] == "capeone-welcome" ) || $pagenow == 'nav-menus.php' ):
	wp_enqueue_style( 'capeone-admin', get_template_directory_uri() . '/assets/css/admin.css', '', '', false );
	//endif;
	
	wp_localize_script( 'capeone-admin', 'capeone_admin', array(
			'ajaxurl' => admin_url('admin-ajax.php'),
		)  );
		
	}
add_action( 'admin_enqueue_scripts', 'capeone_admin_scripts' );

/*
*  restore default
*/
function capeone_otpions_restore(){
  	add_option(CAPEONE_TEXTDOMAIN.'_backup_'.time(),get_option(CAPEONE_TEXTDOMAIN));
  	delete_option(CAPEONE_TEXTDOMAIN);
	echo 'done';
	exit(0);
}
add_action( 'wp_ajax_capeone_otpions_restore', 'capeone_otpions_restore' );
add_action( 'wp_ajax_nopriv_capeone_otpions_restore', 'capeone_otpions_restore' );

/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function capeone_posted_on() {

	// Get the author name; wrap it in a link.
	$byline = sprintf(
		/* translators: %s: post author */
		__( 'by %s', 'capeone' ),
		'<span class="entry-author"> <a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . get_the_author() . '</a></span>'
	);
	
	// Finally, let's write all of this to the page.
	echo '<span class="entry-date">' . capeone_time_link() . '</span> | ' . $byline . '';
}
 
/**
 * Gets a nicely formatted string for the published date.
 */
function capeone_time_link() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	$time_string = sprintf( $time_string,
		get_the_date( DATE_W3C ),
		get_the_date(),
		get_the_modified_date( DATE_W3C ),
		get_the_modified_date()
	);

	// Wrap the time string in a link, and preface it with 'Posted on'.
	return sprintf(
		/* translators: %s: post date */
		__( '<span class="screen-reader-text">Posted on</span> %s ', 'capeone' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);
}

/**
 * Returns an accessibility-friendly link to edit a post or page.
 */
function capeone_edit_link() {

	$link = edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'capeone' ),
			get_the_title()
		),
		'<span class="edit-link">',
		'</span>'
	);

	return $link;
}

/**
 * Register widget area.
 *
 */
function capeone_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'capeone' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'capeone' ),
		'before_widget' => '<section id="%1$s" class="widget-box %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Page Sidebar', 'capeone' ),
		'id'            => 'sidebar-page',
		'description'   => __( 'Add widgets here to appear in your pages sidebar.', 'capeone' ),
		'before_widget' => '<section id="%1$s" class="widget-box %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Blog Sidebar', 'capeone' ),
		'id'            => 'sidebar-blog',
		'description'   => esc_html__( 'Add widgets here to appear in your posts sidebar.', 'capeone' ),
		'before_widget' => '<section id="%1$s" class="widget-box %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Archives', 'capeone' ),
		'id'            => 'sidebar-archives',
		'description'   => esc_html__( 'Add widgets here to appear in your posts list sidebar.', 'capeone' ),
		'before_widget' => '<section id="%1$s" class="widget-box %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'WooCommerce Single Product', 'capeone' ),
		'id'            => 'sidebar-woo-single',
		'description'   => esc_html__( 'Add widgets here to appear in your products sidebar.', 'capeone' ),
		'before_widget' => '<section id="%1$s" class="widget-box %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'WooCommerce Archives', 'capeone' ),
		'id'            => 'sidebar-woo-archives',
		'description'   => esc_html__( 'Add widgets here to appear in your products list sidebar.', 'capeone' ),
		'before_widget' => '<section id="%1$s" class="widget-box %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 1', 'capeone' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'capeone' ),
		'before_widget' => '<section id="%1$s" class="widget-box %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 2', 'capeone' ),
		'id'            => 'footer-2',
		'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'capeone' ),
		'before_widget' => '<section id="%1$s" class="widget-box %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 3', 'capeone' ),
		'id'            => 'footer-3',
		'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'capeone' ),
		'before_widget' => '<section id="%1$s" class="widget-box %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 4', 'capeone' ),
		'id'            => 'footer-4',
		'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'capeone' ),
		'before_widget' => '<section id="%1$s" class="widget-box %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'capeone_widgets_init' );

/**
 *  Custom comments list
 */	
function capeone_comment($comment, $args, $depth) {

?>
   
<li <?php comment_class("comment media-comment"); ?> id="comment-<?php comment_ID() ;?>">
	<div class="media-avatar media-left">
	<?php echo get_avatar($comment,'70','' ); ?>
  </div>
  <div class="media-body">
      <div class="media-inner">
          <h4 class="media-heading clearfix">
             <?php echo get_comment_author_link();?> - <?php comment_date(); ?> <?php edit_comment_link(__('(Edit)','capeone'),'  ','') ;?>
             <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ;?>
          </h4>
          
          <?php if ($comment->comment_approved == '0') : ?>
                   <em><?php esc_html_e('Your comment is awaiting moderation.','capeone') ;?></em>
                   <br />
                <?php endif; ?>
                
          <div class="comment-content"><?php comment_text() ;?></div>
      </div>
  </div>
</li>
                                            
<?php
	}
	
/**
 * Returns breadcrumbs.
 */
function capeone_breadcrumbs() {
	$delimiter = '/'; 
	$before = '<span class="current">';
	$after = '</span>';
	if ( !is_home() && !is_front_page() || is_paged() ) {
		echo '<div itemscope itemtype="http://schema.org/WebPage" id="crumbs"><i class="fa fa-home"></i>';
		global $post;
		$homeLink = esc_url(home_url());
		echo ' <a itemprop="breadcrumb" href="' . $homeLink . '">' . esc_html__( 'Home' , 'capeone' ) . '</a> ' . $delimiter . ' ';
		if ( is_category() ) {
			global $wp_query;
			$cat_obj = $wp_query->get_queried_object();
			$thisCat = $cat_obj->term_id;
			$thisCat = get_category($thisCat);
			$parentCat = get_category($thisCat->parent);
			if ($thisCat->parent != 0){
				$cat_code = get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' ');
				echo $cat_code = str_replace ('<a','<a itemprop="breadcrumb"', $cat_code );
			}
			echo $before . '' . single_cat_title('', false) . '' . $after;
		} elseif ( is_day() ) {
			echo '<a itemprop="breadcrumb" href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
			echo '<a itemprop="breadcrumb"  href="' . esc_url(get_month_link(get_the_time('Y'),get_the_time('m'))) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
			echo $before . get_the_time('d') . $after;
		} elseif ( is_month() ) {
			echo '<a itemprop="breadcrumb" href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
			echo $before . get_the_time('F') . $after;
		} elseif ( is_year() ) {
			echo $before . get_the_time('Y') . $after;
		} elseif ( is_single() && !is_attachment() ) {
			if ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				echo '<a itemprop="breadcrumb" href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
				echo $before . get_the_title() . $after;
			} else {
				$cat = get_the_category(); $cat = $cat[0];
				$cat_code = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
				echo $cat_code = str_replace ('<a','<a itemprop="breadcrumb"', $cat_code );
				echo $before . get_the_title() . $after;
			}
		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' ) {
			$post_type = get_post_type_object(get_post_type());
			if ($post_type)
			echo $before . $post_type->labels->singular_name . $after;
		} elseif ( is_attachment() ) {
			$parent = get_post($post->post_parent);
			$cat = get_the_category($parent->ID); $cat = isset($cat[0])?$cat[0]:'';
			echo '<a itemprop="breadcrumb" href="' . esc_url(get_permalink($parent)) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
			echo $before . get_the_title() . $after;
		} elseif ( is_page() && !$post->post_parent ) {
			echo $before . get_the_title() . $after;
		} elseif ( is_page() && $post->post_parent ) {
			$parent_id  = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
				$page = get_page($parent_id);
				$breadcrumbs[] = '<a itemprop="breadcrumb" href="' .esc_url( get_permalink($page->ID)) . '">' . get_the_title($page->ID) . '</a>';
				$parent_id  = $page->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
			echo $before . get_the_title() . $after;
		} elseif ( is_search() ) {
			echo $before ;
			printf( __( 'Search Results for: %s', 'capeone' ),  get_search_query() );
			echo  $after;
		} elseif ( is_tag() ) {
			echo $before ;
			printf( __( 'Tag Archives: %s', 'capeone' ), single_tag_title( '', false ) );
			echo  $after;
		} elseif ( is_author() ) {
			global $author;
			$userdata = get_userdata($author);
			echo $before ;
			printf( __( 'Author Archives: %s', 'capeone' ),  $userdata->display_name );
			echo  $after;
		} elseif ( is_404() ) {
			echo $before;
			_e( 'Not Found', 'capeone' );
			echo  $after;
		}
		if ( get_query_var('paged') ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() )
				echo sprintf( __( '( Page %s )', 'capeone' ), get_query_var('paged') );
		}
		echo '</div>';
	}
}

/**
 * Get option
 */
function capeone_option($name){
	
	global $capeone_options, $capeone_default_options;
		
	if(function_exists('is_customize_preview') && is_customize_preview()){
		$options = get_option(CAPEONE_TEXTDOMAIN);

		if( isset($options[$name]) )
			return $options[$name];
	}
	if( isset($capeone_options[$name]) )
		return $capeone_options[$name];
	elseif(isset($capeone_default_options[$name]))
		return $capeone_default_options[$name];
	else
		return '';
	}

function capeone_option_saved($name){
	
	$capeone_options = get_option(CAPEONE_TEXTDOMAIN);
	
	if( isset($capeone_options[$name]) )
		return $capeone_options[$name];
	else
		return '';
	}

/**
 * Get sidebar
 */
function capeone_get_sidebar($layout,$type){
	if($layout=='' || $layout == 'none' || $layout == 'no' )
		return '';
	?>
	<div class="col-aside-<?php echo $layout; ?>">
    <?php do_action('vela_before_sidebar');?>
      <aside class="blog-side left text-left">
          <div class="widget-area">
             <?php get_sidebar($type);?>
          </div>
        </aside>
        <?php do_action('vela_after_sidebar');?>
      </div>
<?php
	}

/**
 * Selective Refresh
 */
function capeone_register_partials( WP_Customize_Manager $wp_customize ) {
	
	  global $capeone_customizer_options;

	// Abort if selective refresh is not available.
		if ( ! isset( $wp_customize->selective_refresh ) ) {
			return;
		}

		// Bail early if we don't have any options.
		if ( empty( $capeone_customizer_options ) ) {
			return;
		}
	
	$wp_customize->selective_refresh->add_partial( 'copyright_selective', array(
		'selector' => '.copyright_selective',
		'settings' => array( 'capeone[copyright]' ),
		'render_callback' => 'capeone_copyright',
	) );
	
	$wp_customize->selective_refresh->add_partial( 'header_site_title', array(
		'selector' => '.site-name',
		'settings' => array( 'blogname' ),
		'render_callback' => 'capeone_header_site_title',
		
	) );
	
	$wp_customize->selective_refresh->add_partial( 'header_site_description', array(
		'selector' => '.site-tagline',
		'settings' => array( 'blogdescription' ),
		'render_callback' => 'capeone_header_site_descriptione',
		
	) );
	
	$wp_customize->get_section ('title_tagline')->panel = 'panel-header';
	//$wp_customize->get_section ('colors')->panel = 'panel-header';
	$wp_customize->get_section ('header_image')->panel = 'panel-header';
	
}
add_action( 'customize_register', 'capeone_register_partials' );

/* Footer copyright information */
function capeone_copyright(){
	
	$capeone_options = get_option(CAPEONE_TEXTDOMAIN);
	if( isset($capeone_options['copyright']) )
		return $capeone_options['copyright'];
		
	}

function capeone_header_site_title(){
	return get_bloginfo( 'name' );
	}

function capeone_header_site_descriptione(){
	return get_bloginfo( 'description' );
	}

function capeone_ajax_get_image_url(){
	
	$id = $_POST['id'];
	$image = $id;
	if (is_numeric($id)) {
			$image_attributes = wp_get_attachment_image_src($id, 'full');
			$image   = $image_attributes[0];
		  }
	echo $image;
	exit(0);
	
	}
	
add_action('wp_ajax_capeone_ajax_get_image_url', 'capeone_ajax_get_image_url');
add_action('wp_ajax_nopriv_capeone_ajax_get_image_url', 'capeone_ajax_get_image_url');

/**
 * Include the TGM_Plugin_Activation class.
 */
if ( !class_exists( 'TGM_Plugin_Activation' ) ) 
	load_template( trailingslashit( get_template_directory() ) . 'inc/class-tgm-plugin-activation.php' );

add_action( 'tgmpa_register', 'capeone_theme_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 *
 */
function capeone_theme_register_required_plugins() {

    $plugins = array(
		array(
			'name'     				=> __('Vela Companion','capeone'), 
			'slug'     				=> 'vela-companion',
			'source'   				=> '', 
			'required' 				=> false, 
			'version' 				=> '1.0.0', 
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> '', 
		),

		array(
			'name'     				=> __('Elementor','capeone'),
			'slug'     				=> 'elementor',
			'source'   				=> '',
			'required' 				=> false,
			'version' 				=> '1.0.0',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> '',
		),
		
		array(
			'name'     				=> __('Contact Form 7','capeone'),
			'slug'     				=> 'contact-form-7',
			'source'   				=> '',
			'required' 				=> false,
			'version' 				=> '1.0.0',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> '',
		),
		

	);

    /**
     * Array of configuration settings. Amend each line as needed.
     */
    $config = array(
        'id'           => 'vela-companion',
        'default_path' => '', 
        'menu'         => 'tgmpa-install-plugins', 
        'has_notices'  => true,
        'dismissable'  => true,
        'dismiss_msg'  => '',
        'is_automatic' => false,
        'message'      => '',
    );

    tgmpa( $plugins, $config );

}

/**
 * Add script to the footer
 *
 */
function capeone_footer_script(){ 
	$display_scroll_to_top = capeone_option('display_scroll_to_top');
	if($display_scroll_to_top=='1' ){
		$css_class = 'back-to-top';
		echo '<div class="'.$css_class.'"></div>';
		}

 } 
add_action('wp_footer','capeone_footer_script');

/**
 * Add title bar
 *
 */
function capeone_page_title_bar( $content, $type='page' ){
	
	$display_titlebar_default   = capeone_option('display_titlebar');
	$display_breadcrumb_default = capeone_option('display_breadcrumb');
	
	$display_titlebar = apply_filters( 'vela_display_titlebar', $display_titlebar_default );
	$display_breadcrumb = apply_filters( 'vela_display_breadcrumb', $display_breadcrumb_default );
	
	if( $display_titlebar == 'default' )
		$display_titlebar   = $display_titlebar_default;
	
	if( $display_breadcrumb == 'default' )
		$display_breadcrumb   = $display_breadcrumb_default;
		
	if( $display_titlebar != '1' )
		return '';
	
    $title_bar_layout_default = capeone_option('title_bar_layout');
	$title_bar_layout = apply_filters('vela_title_bar_layout',$title_bar_layout_default);
	
	if( $title_bar_layout == 'default' )
		$title_bar_layout   = $title_bar_layout_default;
	
	$title_bar_css = apply_filters('vela_title_bar_css', '' );
	
	$class = 'page-title-bar '.$title_bar_layout;
	$html = '<section class="'.$class.'" style="'.$title_bar_css.'">';
	$html .= '<div class="container">';
	$html .= '<div class="page-title-bar-inner">';
	
	if($type=='page'){
   		$html .= ' <hgroup class="page-title">';
   		$html .= '<h1>'.get_the_title().'</h1>';
    	$html .= '</hgroup>';
     }
	 
	 if( $display_breadcrumb == '1' ){
		$html .= '<div class="breadcrumb-nav">';
		ob_start();
		capeone_breadcrumbs();
		$html .= ob_get_contents();
		ob_end_clean();
		$html .= '</div>';
	 }
	
	$html .= '<div class="clearfix"></div>';
	$html .= '</div>';
	$html .= '</div>';
	$html .= '</section>';

	return $html;
	
	}

add_filter( 'capeone_page_title_bar', 'capeone_page_title_bar', 10, 2 );

/**
 * Convert Hex Code to RGB
 * @param  string $hex Color Hex Code
 * @return array       RGB values
 */
 
function capeone_hex2rgb( $hex ) {
	if ( strpos( $hex,'rgb' ) !== FALSE ) {

		$rgb_part = strstr( $hex, '(' );
		$rgb_part = trim($rgb_part, '(' );
		$rgb_part = rtrim($rgb_part, ')' );
		$rgb_part = explode( ',', $rgb_part );

		$rgb = array($rgb_part[0], $rgb_part[1], $rgb_part[2], $rgb_part[3]);

	} elseif( $hex == 'transparent' ) {
		$rgb = array( '255', '255', '255', '0' );
	} else {

		$hex = str_replace( '#', '', $hex );
		
		
		if( strlen( $hex ) == 3 ) {
			$r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
			$g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
			$b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
		} else {
			$r = hexdec( substr( $hex, 0, 2 ) );
			$g = hexdec( substr( $hex, 2, 2 ) );
			$b = hexdec( substr( $hex, 4, 2 ) );
		}
		$rgb = array( $r, $g, $b );
	}

	return $rgb;
}


/**
 * Hide header & footer
 */
function capeone_hide_header(){
	if(isset($_GET['hide-header'])){
		return 1;
		}
	}

function capeone_hide_footer(){
	if(isset($_GET['hide-footer'])){
		return 1;
		}
	}
add_filter('capeone_hide_header','capeone_hide_header');
add_filter('capeone_hide_footer','capeone_hide_header');

/*
 * Get header widgets
 */
function capeone_get_header_widgets( $key, $output = true ){
	
	$widgets = capeone_option($key);
	$html = '';
	if(is_array($widgets) && !empty($widgets)):
		$html = "";
		foreach($widgets as $item):
			$html .= '<span class="capeone-microwidget">';
			if($item['link']!=''){
				$html .= '<a href="'.esc_url($item['link']).'" target="'.esc_attr($item['target']).'">';
			}
			if($item['icon']!=''){
				
				$item['icon'] = str_replace('fa-','',$item['icon']);
				$item['icon'] = str_replace('fa','',$item['icon']);
				$item['icon'] = 'fa fa-'.$item['icon'];
				
				$html .= '<i class="'.esc_attr($item['icon']).'"></i>&nbsp;&nbsp;';
			}
			$html .= esc_attr($item['text']);
			if($item['link']!=''){
				$html .= '</a>';
			}
			$html .= '</span>';
		endforeach;
	endif;
	if( $output == true)
		echo $html;
	else
		return $html;
	
	}
	
/*
 * Add admin about page
 */
function capeone_admin_menu(){
	
	add_theme_page( __( 'About CapeOne', 'capeone' ), __( 'About CapeOne', 'capeone' ), 'manage_options', 'about-capeone','capeone_about_capeone');
	
	}
add_action( 'admin_menu', 'capeone_admin_menu' );

function capeone_about_capeone(){
	
	?>

    <div class="capeone-info-wrap">
  <h1><?php  _e( 'Welcome to CapeOne WordPress Theme', 'capeone' ) ?></h1>
  <p>
  <?php  _e( 'CapeOne is the perfect theme which could be used to build one page sites for design agency, corporate, restaurant, personal, showcase, magazine, portfolio, ecommerce, etc. The theme is compatible with Elementor, the most popular drag &amp; drop page builder, which you could use to create elegant sites with no code knowledge. We have designed various specific elements and elegant frontpage template for the plugin which can help you create a site like the demo with just several steps. CapeOne also offers various options for header, footer, pages &amp; posts, etc. And it is compatible with WooCommerce, Polylang, WPML, Contact Form 7, etc.', 'capeone' ) ?>
  </p>
  <div class="capeone-column-left">
    <div class="capeone-message">
      <h2><?php _e( 'Import demo sites', 'capeone' ); ?></h2>
      
      <?php
	   if ( function_exists( 'is_plugin_active' ) && is_plugin_active('vela-companion/vela-companion.php') ) {
    			
			?>
      <p><?php  printf(__( 'CapeOne offers a free library of <a href="%s" target="_blank">demo sites</a>. Import your favorite one by just one click.', 'capeone' ),admin_url('themes.php?page=vela-sites')); ?></p>
      <?php }else{?>
      		 <p><?php  _e( 'CapeOne offers a free library of demo sites. Import your favorite one by just one click.', 'capeone' ); ?></p>
      <?php }?>
      <?php
	   if ( function_exists( 'is_plugin_active' ) && !is_plugin_active('vela-companion/vela-companion.php') ) {
    			
			?>
      <p><a href="<?php echo esc_url(admin_url('themes.php?page=tgmpa-install-plugins&plugin_status=install'));?>" class="button"><?php _e( 'Install the plugins', 'capeone' ); ?></a></p>
      <?php }?>
    </div>
    <div class="capeone-message">
  <h2><?php _e( 'Start to customize your site', 'capeone' ); ?></h2>
  <ul class="capeone-customize-list">
    
<li>
      <div class="capeone-customize-box">
        <h4><?php _e( 'Upload Your Logo', 'capeone' ); ?></h4>
        <p class="capeone-customize-desc"><?php _e( 'Add your own logo for the header.', 'capeone' ); ?></p>
        <p class="capeone-customize-link"><a target="_blank" href="<?php echo esc_url(admin_url('customize.php?autofocus%5Bcontrol%5D=custom_logo'));?>"><?php _e( 'Navigate to the option', 'capeone' ); ?></a></p>
      </div>
    </li>
<li>
      <div class="capeone-customize-box">
        <h4><?php _e( 'Upload Favicon', 'capeone' ); ?></h4>
        <p class="capeone-customize-desc"><?php _e( 'Set the icon that would display as browser and app icon.', 'capeone' ); ?></p>
        <p class="capeone-customize-link"><a target="_blank" href="<?php echo esc_url(admin_url('customize.php?autofocus%5Bcontrol%5D=site_icon'));?>"><?php _e( 'Navigate to the option', 'capeone' ); ?></a></p>
      </div>
    </li>
<li>
      <div class="capeone-customize-box">
        <h4><?php _e( 'Sidebar Settings', 'capeone' ); ?></h4>
        <p class="capeone-customize-desc"><?php _e( 'Set sidebar for pages & posts.', 'capeone' ); ?></p>
        <p class="capeone-customize-link"><a target="_blank" href="<?php echo esc_url(admin_url('customize.php?autofocus%5Bcontrol%5D=capeone[page_sidebar_layout]'));?>"><?php _e( 'Navigate to the option', 'capeone' ); ?></a></p>
      </div>
    </li>
<li>
      <div class="capeone-customize-box">
        <h4><?php _e( 'Blog Settings', 'capeone' ); ?></h4>
        <p class="capeone-customize-desc"><?php _e( 'Set contents display in archive pages & posts.', 'capeone' ); ?></p>
        <p class="capeone-customize-link"><a target="_blank" href="<?php echo esc_url(admin_url('customize.php?autofocus%5Bcontrol%5D=capeone[display_feature_image]'));?>"><?php _e( 'Navigate to the option', 'capeone' ); ?></a></p>
      </div>
    </li><li>
      <div class="capeone-customize-box">
        <h4><?php _e( 'Typography Settings', 'capeone' ); ?></h4>
        <p class="capeone-customize-desc"><?php _e( 'Choose your own typography for any parts of your website.', 'capeone' ); ?></p>
        <p class="capeone-customize-link"><a target="_blank" href="<?php echo esc_url(admin_url('customize.php'));?>"><?php _e( 'Navigate to the option', 'capeone' ); ?></a></p>
      </div>
    </li>
    
    <li>
      <div class="capeone-customize-box">
        <h4><?php _e( 'Top Bar Options', 'capeone' ); ?></h4>
        <p class="capeone-customize-desc"><?php _e( 'Set info for the top bar above header.', 'capeone' ); ?></p>
        <p class="capeone-customize-link"><a target="_blank" href="<?php echo esc_url(admin_url('customize.php?autofocus%5Bcontrol%5D=capeone[display_topbar]'));?>"><?php _e( 'Navigate to the option', 'capeone' ); ?></a></p>
      </div>
    </li>
    
    <li>
      <div class="capeone-customize-box">
        <h4><?php _e( 'Header Options', 'capeone' ); ?></h4>
        <p class="capeone-customize-desc"><?php _e( 'Set layout for the default header.', 'capeone' ); ?></p>
        <p class="capeone-customize-link"><a target="_blank" href="<?php echo esc_url(admin_url('customize.php?autofocus%5Bcontrol%5D=capeone[header_style]'));?>"><?php _e( 'Navigate to the option', 'capeone' ); ?></a></p>
      </div>
    </li>
    
    <li>
      <div class="capeone-customize-box">
        <h4><?php _e( 'Footer Widgets Options', 'capeone' ); ?></h4>
        <p class="capeone-customize-desc"><?php _e( 'Choose to display & customize the widget areas in the footer.', 'capeone' ); ?></p>
        <p class="capeone-customize-link"><a target="_blank" href="<?php echo esc_url(admin_url('customize.php?autofocus%5Bcontrol%5D=capeone[display_footer_widgets]'));?>"><?php _e( 'Navigate to the option', 'capeone' ); ?></a></p>
      </div>
    </li>
    
     <li>
      <div class="capeone-customize-box">
        <h4><?php _e( 'Footer Info Options', 'capeone' ); ?></h4>
        <p class="capeone-customize-desc"><?php _e( 'Insert copyright info and social icons in the footer.', 'capeone' ); ?></p>
        <p class="capeone-customize-link"><a target="_blank" href="<?php echo esc_url(admin_url('customize.php?autofocus%5Bcontrol%5D=capeone[display_footer_icons]'));?>"><?php _e( 'Navigate to the option', 'capeone' ); ?></a></p>
      </div>
    </li>

    
  </ul>
</div>
  </div>
  <div class="capeone-column-right">
    <div class="capeone-message"><h4><?php _e( 'Review CapeOne on WordPress', 'capeone' ); ?></h4><p><?php _e( 'We are grateful that you have chose our theme. If you like CapeOne, please take 1 minitue to post your review on Wordpress. Few words of ppreciation also motivates the development team.', 'capeone' ); ?></p><p><a class="button" target="_blank" href="https://wordpress.org/support/theme/capeone/reviews/#new-post"> <?php _e( 'Post Your Review', 'capeone' ); ?> </a></p></div>
    <div class="capeone-message"><p><?php _e( 'More info could be found at the manual.', 'capeone' ); ?></p><p><a class="button" target="_blank" href="https://velathemes.com/capeone-documentation/"><?php _e( 'Step-by-step Manual', 'capeone' ); ?></a></p></div>
    <div class="capeone-message"><p><?php _e( 'If you have checked the documentation and still having an issue, please post in the support thread.', 'capeone' ); ?></p><p><a class="button" target="_blank" href="https://wordpress.org/support/theme/capeone"><?php _e( 'Support Thread', 'capeone' ); ?></a></p></div>
    <div class="capeone-message">
      <h4><?php _e( 'FAQ', 'capeone' ); ?></h4>
      <p><a class="" target="_blank" href="https://velathemes.com/faq/#1"><?php _e( 'How to Create Child Theme?', 'capeone' ); ?></a></p>
      <p><a class="" target="_blank" href="https://velathemes.com/faq/#2"><?php _e( 'How to Add Custom CSS to Your Website?', 'capeone' ); ?></a></p>
      <p><a class="" target="_blank" href="https://velathemes.com/faq/#3"><?php _e( 'How to Translate the Theme?', 'capeone' ); ?></a></p>
      <p><a class="" target="_blank" href="https://velathemes.com/faq/#4"><?php _e( 'How to Make Your Site Multilingual?', 'capeone' ); ?></a></p>
      <p><a class="" target="_blank" href="https://velathemes.com/faq/#5"><?php _e( 'How to Make Your Site Multilingual?', 'capeone' ); ?>x</a></p>
    </div>
  </div>
</div>
    <?php	
}
