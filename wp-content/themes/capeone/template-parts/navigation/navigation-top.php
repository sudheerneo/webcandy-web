<?php

	$header_style = capeone_option('header_style');
	$display_shopping_cart_icon = capeone_option('display_shopping_cart_icon');
	$display_search_icon = capeone_option('display_search_icon');
	if($header_style=='')
		$header_style = 'default';
	$class = 'capeone-navigation';
	
	if($header_style=='classic')
		$class .= ' capeone-style-top-line-full';
	
	$header_menu_hover_style = ' capeone-main-nav capeone-nav-main';
	$addClass = '';
	
?>

<?php
	$icons_by_menu = '<div class="capeone-f-microwidgets">';

	if ($display_shopping_cart_icon == '1' && $header_style !== 'split')
        $icons_by_menu .= '<div class="capeone-microwidget capeone-search" style="z-index:9999;">
                        <div class="capeone-search-label"></div>
                        <div class="capeone-search-wrap right-overflow" style="display:none;">
                            <form action="" class="search-form">
                                <div>
                                        <span class="screen-reader-text">'.esc_html__( 'Search for', 'capeone' ).':</span>
                                        <input type="text" class="search-field" placeholder="'.esc_html__( 'Search', 'capeone' ).' &hellip;" value="" name="s">
                                        <input type="submit" class="search-submit" value="'.esc_html__( 'Search', 'capeone' ).'">
                                </div>                                    
                            </form>
                        </div>
                    </div>';
	  
	  if ($display_search_icon == '1' )
        $icons_by_menu .= '<div class="cactus-microwidget cactus-search" style="z-index:9999;">
                        <div class="cactus-search-label"></div>
                        <div class="cactus-search-wrap right-overflow" style="display:none;">
                            <form action="" class="search-form">
                                <div>
                                        <span class="screen-reader-text">'.esc_html__( 'Search for', 'capeone' ).':</span>
                                        <input type="text" class="search-field" placeholder="'.esc_html__( 'Search', 'capeone' ).' …" value="" name="s">
                                        <input type="submit" class="search-submit" value="'.esc_html__( 'Search', 'capeone' ).'">
                                </div>                                    
                            </form>
                        </div>
                    </div>';
					
      $icons_by_menu .= '</div>';



	  $addClass = ' capeone-wp-menu';

	  ?>
<nav class="<?php echo $class.$addClass;?>" role="navigation">
  <?php
	
	$custom_menu = apply_filters('vela_custom_menu', '');
	$args = array(
			'theme_location' => 'top',
			'menu_id'        => 'top-menu',
			'menu_class' => $header_menu_hover_style,
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
<?php
	echo $icons_by_menu;
?>

</nav>