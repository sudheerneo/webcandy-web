<div class="capeone-logo">
<?php
if ( get_theme_mod( 'custom_logo' ) ) {
			$logo = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );
			$logo = '<a href="'.esc_url( home_url( '/' ) ).'"><img src="' . esc_url( $logo[0] ) . '"></a>';
			echo $logo;
		}

$header_text_color = get_header_textcolor();
 if ( 'blank' != $header_text_color ) :?>
                    <div class="capeone-name-box">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><h2 class="site-name"><?php bloginfo( 'name' ); ?></h2></a>
                        <span class="site-tagline"><?php bloginfo( 'description' ); ?></span>
                    </div>
                    <?php endif;?>

</div>
