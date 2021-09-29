<header class="header-wrap">
<?php
	$sticky_header  = capeone_option('sticky_header');
	$class = 'capeone-header capeone-inline-header right';
	$sticky_class = 'capeone-header capeone-inline-header right shadow';
	
	$inline_header_menu_position = esc_attr( capeone_option('inline_header_menu_position') );
	$header_full_width = capeone_option('header_full_width');
	
	$class .= ' '.$inline_header_menu_position;
	$sticky_class .= ' '.$inline_header_menu_position;
	
	if($header_full_width == '1'){
		$class .= ' fullwidth';
		$sticky_class .= ' fullwidth';
		
	}
	
	$transparent_header = apply_filters('vela_transparent_header','');
	if( $transparent_header == '1'){
		$class .= ' transparent';
	}
	
	$class = apply_filters('capeone_header_css_class', $class);
	$sticky_class = apply_filters('capeone_sticky_header_css_class', $sticky_class);
?>
<div class="<?php echo esc_attr( $class ); ?>">
	<?php get_template_part( 'template-parts/header/header', 'top-bar' ); ?>
    <div class="capeone-main-header-wrap">
            <div class="capeone-main-header">
             <div class="capeone-logo">
			  <?php get_template_part( 'template-parts/header/header', 'logo' ); ?>
            </div>
                
               <?php get_template_part( 'template-parts/navigation/navigation', 'top' ); ?>
            </div></div>
             <?php get_template_part( 'template-parts/navigation/navigation', 'mobile' ); ?>
        </div>
         <?php if($sticky_header=='1' || is_customize_preview() ):
				$fixedheaderclass = 'capeone-fixed-header-wrap';
				if($sticky_header!='1' && is_customize_preview()){
					$fixedheaderclass .= ' hide';
				}
		?>
        <div class="<?php echo $fixedheaderclass; ?>" style="display: none;">
            <div class="<?php echo esc_attr( $sticky_class ); ?>">
             <div class="capeone-main-header-wrap">
                <div class="capeone-main-header">
                     <div class="capeone-logo">
					  <?php get_template_part( 'template-parts/header/header', 'stickylogo' ); ?>
                      </div>
                
                    <?php get_template_part( 'template-parts/navigation/navigation', 'top' ); ?>
                    </div>
                </div>
                 <?php get_template_part( 'template-parts/navigation/navigation', 'mobile' ); ?>
            </div>
        </div>
        
     <?php endif;?>
 </header>