<?php
	$class = 'capeone-navigation';

	$display_shopping_cart_icon = capeone_option('display_shopping_cart_icon');
	$header_menu_hover_style = ' capeone-main-nav capeone-nav-left';
	$addClass = '';
?>
<?php
	$icons_by_menu = '<div class="capeone-f-microwidgets">';

	if ($display_shopping_cart_icon == '1')
    	$icons_by_menu .= '<div class="capeone-microwidget capeone-shopping-cart" style="z-index:9999;">
						<a href="#" class="capeone-shopping-cart-label"></a>
                        <div class="capeone-shopping-cart-wrap left-overflow">
                            <div class="capeone-shopping-cart-inner">
                                <ul class="cart_list product_list_widget empty">
                                    <li>'.apply_filters('capeone_shopping_cart',esc_html__( 'No products in the cart.', 'capeone' )).'</li>
                                </ul>
                            </div>
                        </div>
                    </div>';
      $icons_by_menu .= '</div>';

?>
<?php if( (is_page_template('template-sections.php') && $display_custom_main_menu == '1') /*|| is_customize_preview()*/ ){
	$addClass .= ' frontpage_menu_left_selective split_header_left_menu_selective';
	//if(!is_page_template('template-sections.php') || $display_custom_main_menu != '1')
		//$addClass .= ' hide';
	?>

<nav class="<?php echo $class.$addClass;?>" role="navigation">
  <?php
	
			$frontpage_menu = capeone_option('split_header_left_menu');
			echo '<ul id="top-menu-left" class="'.$header_menu_hover_style.'">';
			if(is_array($frontpage_menu) && !empty($frontpage_menu)):
  				foreach($frontpage_menu as $item):
					$icon = '';
					if( isset($item['icon']) && trim( $item['icon'] )!='' )
						$icon = '<i class="fa '.esc_attr($item['icon']).'"></i>';
					if(trim($item['title'] )!='')
					echo '<li><a href="' . esc_url( trim($item['link']) ) . '"><span>' . $icon.' '  . esc_attr( $item['title'] ) . '</span></a></li>';
				endforeach;
			endif;
			echo '</ul>';

	?>
    <?php
echo $icons_by_menu;
?>

</nav>
<?php }	?>

  <?php if( !is_page_template('template-sections.php') || $display_custom_main_menu != '1' /*|| is_customize_preview()*/ ){
	  $addClass = ' capeone-wp-menu';
	  //if( is_page_template('template-sections.php') && $display_custom_main_menu == '1')
	  //	$addClass .= ' hide';
	  ?>
<nav class="<?php echo $class.$addClass;?>" role="navigation">
  <?php

		   wp_nav_menu( array(
			'theme_location' => 'top-left',
			'menu_id'        => 'top-menu-left',
			'menu_class' => $header_menu_hover_style,
			'fallback_cb'    => false,
			'container' =>'',
			'link_before' => '<span>',
   			'link_after' => '</span>',
		) );
	?>
    <?php
echo $icons_by_menu;
?>

</nav>

<?php }	?>
