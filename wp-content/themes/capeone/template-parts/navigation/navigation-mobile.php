 <div class="capeone-mobile-main-header">
                <div class="capeone-logo">
                     <?php get_template_part( 'template-parts/header/header', 'logo' ); ?>
                </div>

                <div class="capeone-menu-toggle">
                    <div class="capeone-toggle-icon">
                        <span class="capeone-line"></span>
                    </div>
                </div>
            </div>
<div class="capeone-mobile-drawer-header" style="display: none;">
<?php
			
	$custom_menu = apply_filters('vela_custom_menu', '');
	$args = array(
			'theme_location' => 'top',
			'menu_id'        => 'top-menu',
			'menu_class' => 'capeone-mobile-main-nav',
			'fallback_cb'    => false,
			'container' =>'',
			'link_before' => '<span>',
   			'link_after' => '</span>',
		);
		
	if( $custom_menu ){
		$args['menu'] = $custom_menu;
		$args['theme_location'] = '';
		}
		
	wp_nav_menu( $args );

	?>
             
</div>