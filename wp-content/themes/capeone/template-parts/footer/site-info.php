<?php

	$footer_icons = capeone_option('footer_icons');
	$display_footer_icons = capeone_option('display_footer_icons');
	$copyright = capeone_option('copyright');
	$footer_fullwidth = capeone_option('footer_info_fullwidth');
	$footer_layout = capeone_option('footer_layout');
	
	$container = 'container';
	if($footer_fullwidth == '1'){
		$container = 'container-fullwidth';
	}
	
	$wrap = 'footer-info-area';
	if( $footer_layout != ''){
		$wrap .= ' footer-'.esc_attr($footer_layout);
	}
	
?>
<div class="<?php echo $wrap; ?>">
     <div class="<?php echo $container; ?>">
      <?php 
	if (  $display_footer_icons == '1' || is_customize_preview()):
		$css_class = 'footer-sns capeone-footer-sns footer_icons_selective';
		if( $display_footer_icons !=1 && is_customize_preview() )
			$css_class  .= ' hide';
	
	?>
      <ul class="<?php echo $css_class; ?>">
       <?php if( is_customize_preview() ):?>
      <span class="customize-partial-edit-shortcut customize-partial-edit-shortcut-footer-info-area"><button aria-label="<?php echo esc_html__( 'Click to edit this element.', 'capeone' );?>" title="<?php echo esc_html__( 'Click to edit this element.', 'capeone' );?>" class="customize-partial-edit-shortcut-button"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13.89 3.39l2.71 2.72c.46.46.42 1.24.03 1.64l-8.01 8.02-5.56 1.16 1.16-5.58s7.6-7.63 7.99-8.03c.39-.39 1.22-.39 1.68.07zm-2.73 2.79l-5.59 5.61 1.11 1.11 5.54-5.65zm-2.97 8.23l5.58-5.6-1.07-1.08-5.59 5.6z"></path></svg></button></span>
      <?php endif;?>
      
      <?php 
	  if($footer_icons){
	  foreach ($footer_icons as $item ){
		  $item['icon'] = str_replace('fa-','',$item['icon']);
		  $item['icon'] = str_replace('fa ','',$item['icon']);
	  ?>
      <li><a href="<?php echo esc_url($item['link']);?>" title="<?php echo esc_attr($item['title']);?>" target="_blank"><i class="fa fa-<?php echo esc_attr($item['icon']);?>"></i></a></li>
      <?php 
	  }
	  }
	  ?>
      </ul>
      <?php endif;	?>
                   <div class="site-info"><span class="copyright_selective"><?php echo do_shortcode(wp_kses_post($copyright));?></span>

      </div>
                </div>
            </div>
          
          