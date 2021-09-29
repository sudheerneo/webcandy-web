<?php
	$display_footer_widgets = capeone_option('display_footer_widgets');
	$footer_fullwidth = capeone_option('footer_widgets_fullwidth');
	$footer_columns = absint(capeone_option('footer_columns'));
	
	if( $footer_columns == 0 )
		$footer_columns = 4;

	if( $display_footer_widgets == '1'  || is_customize_preview() ):
		$css_class = 'footer-widget-area';
		if( $display_footer_widgets !=1 && is_customize_preview() )
			$css_class  .= ' hide';
	
	$container = 'container';
	if($footer_fullwidth == '1'){
		$container = 'container-fullwidth';
		
	}
?>
<div class="<?php echo $css_class; ?>">
<div class="<?php echo $container; ?>">
      <div class="row">
      <?php for ($i = 1; $i <= 4; $i++) : ?>
      <?php if (is_active_sidebar("footer-".$i)) : ?>
		<div class="col-md-<?php echo 12/$footer_columns; ?>">
        <?php dynamic_sidebar("footer-".$i); ?>
        </div>
        <?php endif; ?>
        <?php endfor; ?>
      </div>
    </div>
    </div>
     <?php endif; ?>