<?php
	get_header();
		
?>
<?php echo apply_filters('capeone_page_title_bar','','');?>  
<div class="page-wrap">
<?php do_action('vela_before_page_wrap');?>  
  <div class="container">
    <div class="page-inner row no-aside">
      <div class="col-main">
        <section class="post-main" role="main" id="content">
          <article class="post-entry text-left">
            <?php do_action('vela_before_page_content');?>
            
            <?php
			
				$page_404 = capeone_option('page_404');
				if( $page_404 > 0 ){
					
					$post   = get_post( $page_404 );
					
					echo '<div id="page-'.$post->ID.'">
							  <article class="entry-box">
								<div class="entry-main">
								  <div class="entry-summary">
								   <h1>'.$post->post_title.'</h1>
								'.$post->post_content.'
								  </div>
								</div>
							  </article>
							</div>';
					
					}else{
			
			?>
           <h1><?php esc_html_e('404 Nothing Found', 'capeone');?></h1>
<p><?php esc_html_e('Sorry, the page could not be found.', 'capeone');?></p>
<a href="javascript:;" onClick="javascript :history.back(-1);"><span class="capeone-btn capeone-primary"><?php esc_html_e('Go Back', 'capeone');?></span></a>
			
            <?php }?>

           <?php do_action('vela_after_page_content');?>         
          </article>
          
        </section>
      </div>
    </div>
  </div>
</div>

<?php get_footer();