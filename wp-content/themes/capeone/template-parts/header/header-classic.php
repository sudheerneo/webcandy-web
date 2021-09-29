<header class="header-wrap">
<?php
	$sticky_header = capeone_option('sticky_header');
	$class = 'capeone-header capeone-classic-header';
	$sticky_class = 'capeone-header capeone-inline-header right shadow';
	
	$classic_header_logo_position = esc_attr(capeone_option('classic_header_logo_position'));
	$classic_header_menu_position = esc_attr(capeone_option('classic_header_menu_position'));
	$header_full_width = capeone_option('header_full_width');
	
	$class .= ' logo'.$classic_header_logo_position;
	$class .= ' '.$classic_header_menu_position;
	//$sticky_class .= ' '.$classic_header_menu_position;
	
	if($header_full_width == '1'){
		$class .= ' fullwidth';
		$sticky_class .= ' fullwidth';
	}
	
	$transparent_header = apply_filters('vela_transparent_header','');
	if( $transparent_header == '1' || $transparent_header == 'on' ){
		$class .= ' transparent';
	}

	$class = apply_filters('capeone_header_css_class', $class);
	$sticky_class = apply_filters('capeone_sticky_header_css_class', $sticky_class);
?>
<div class="<?php echo esc_attr($class); ?>">
            <?php get_template_part( 'template-parts/header/header', 'top-bar' ); ?>
            
            <div class="capeone-main-header">
                <div class="capeone-logo">
                   <?php get_template_part( 'template-parts/header/header', 'logo' ); ?>
                    <div class="capeone-f-microwidgets classic_header_logo_left_selective">
             <?php
				capeone_get_header_widgets('classic_header_logo_left');
			 ?>
                    </div>
                    <div class="capeone-f-microwidgets classic_header_logo_right_selective">
             <?php
				capeone_get_header_widgets('classic_header_logo_right');
			 ?>
                    </div>
                </div>
                    <?php get_template_part( 'template-parts/navigation/navigation', 'top' ); ?>
            </div>
          <?php get_template_part( 'template-parts/navigation/navigation', 'mobile' ); ?>
        </div>
        <?php if($sticky_header=='1' || is_customize_preview() ):
				$fixedheaderclass = 'capeone-fixed-header-wrap';
				if($sticky_header!='1' && is_customize_preview()){
					$fixedheaderclass .= ' hide';
				}
				
		?>
      <div class="<?php echo $fixedheaderclass; ?>" style="display: none;">
            <div class="<?php echo esc_attr($sticky_class); ?>">
                <div class="capeone-main-header">
                    <div class="capeone-logo">
               		<?php get_template_part( 'template-parts/header/header', 'stickylogo' ); ?>
                    </div>
                    
				<?php get_template_part( 'template-parts/navigation/navigation', 'top' ); ?>
                
                </div>
                 <?php get_template_part( 'template-parts/navigation/navigation', 'mobile' ); ?>
            </div>
        </div>
         <?php endif;?>  
    </header>