<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>
<body <?php body_class( 'page blog' ); ?>>

  <div class="wrapper">
        <!--Header-->
        <?php get_template_part( 'template-parts/header/header', 'image' ); ?>
        <?php 
		
		do_action('vela_before_header');
		
		$header_style = capeone_option('header_style');
		if($header_style=='' || $header_style=='default' )
			$header_style = 'inline';
		
		$hide_header = apply_filters('capeone_hide_header',0);
		if( $hide_header != '1' )
			get_template_part( 'template-parts/header/header', esc_attr($header_style) );
		
		do_action('vela_after_header');
		
?>