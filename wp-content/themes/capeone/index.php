<?php
	get_header();
	$blog_style = absint(capeone_option( 'blog_list_style'));
	$page_sidebar_layout = apply_filters('vela_page_sidebar_layout',capeone_option('blog_archives_sidebar_layout'));
	switch($page_sidebar_layout){
		case 'left':
			$aside_class = 'page-inner row left-aside';
		break;
		case 'right':
			$aside_class = 'page-inner row right-aside';
		break;
		default:
			$aside_class = 'page-inner row no-aside';
		break;
		
		};
	switch($blog_style){
		case '1':
			$wrap_class = 'blog-list-wrap';
		break;
		case '2':
			$wrap_class = 'blog-list-wrap blog-aside-image';
		break;
		case '3':
			$wrap_class = 'blog-list-wrap blog-grid';
		break;
		default:
			$wrap_class = 'blog-list-wrap';
		break;
		
		};
		
?>
 <!--Main Area-->
<?php echo apply_filters('capeone_page_title_bar','','category');?> 
        <div class="page-wrap">
        <?php do_action('vela_before_page_wrap');?>
            <div class="container">
                <div class="<?php echo $aside_class; ?>">
                    <div class="col-main">
                        <section class="page-main" role="main" id="content">
                            <div class="page-content">
                                <!--blog list begin-->
                                <div class="<?php echo $wrap_class; ?>">
                                
           <?php
			if ( have_posts() ) :

				while ( have_posts() ) : the_post();
				
					get_template_part( 'template-parts/post/content', get_post_format() );

				endwhile;

			else :

				get_template_part( 'template-parts/post/content', 'none' );

			endif;
			?>         
                                    
                                    
                                </div>
                                              
                            </div>
                 <div class="post-attributes">
							<?php the_posts_pagination( array(
					'prev_text' => '<i class="fa fa-arrow-left"></i><span class="screen-reader-text">' . __( 'Previous Page', 'capeone' ) . '</span>',
					'next_text' => '<span class="screen-reader-text">' . __( 'Next Page', 'capeone' ) . '</span><i class="fa fa-arrow-right"></i>' ,
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'capeone' ) . ' </span>',
				) );?>
                </div>
                        </section>
                    </div>
                    <?php capeone_get_sidebar($page_sidebar_layout,'archives');?>
                    
                </div>
            </div>
            <?php do_action('vela_after_page_wrap');?>
        </div>

<?php get_footer();
