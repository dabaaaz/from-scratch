<?php if ( !defined('ABSPATH') ) die();
/**
 * The main template file.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage From_Scratch
 * @since 1.0
 * @version 1.0
 */ 
	 if ( is_search() || is_post_type_archive('project') ) {
		$sidebar = false;
	} else if ( get_theme_mod('blog_sidebar') == false ) {
		$sidebar = false;
	} else if ( get_theme_mod('blog_sidebar') != false || get_theme_mod('blog_sidebar') == null ) {
		$sidebar = true;
	} else {
		$sidebar = false;
	}
	
	$cats = get_theme_mod('cat_dropdown');
	
get_header(); ?>

				<?php get_template_part( 'template-parts/page', 'banner' ); ?>
				
				<div class="page-wrap<?php if ($sidebar) { echo ' has-sidebar'; } ?>">
					
					<?php if ($sidebar) { 					
							get_template_part( 'template-parts/sidebar', 'burger' );
							get_sidebar(); 
					} ?>
					
					<div class="page-content">
							
						<?php if ( have_posts() ) : // The Loop ?>
						
						<?php if ( $cats && ( is_home() || is_category() ) ) { ?>
						<div class="page-filters">
							<label for="cat">
								<?php _e('Categories', 'from-scratch'); ?>
							</label>
							<div class="formfield-select--container">
								<?php
									$args = array(
										'show_option_all' => __( 'All categories', 'from-scratch' ),
									);
									wp_dropdown_categories( $args ); 
								?>
							</div>
							<script>
								var siteUrl = '<?php esc_url(bloginfo('url')); ?>';
								document.getElementById('cat').onchange = function(){
									if( this.value !== '-1' ){
										window.location=siteUrl +'/?cat='+this.value
									}
								}
							</script>
						</div>	
						<?php } ?>
							
						<div id="posts_list" class="the-posts" >
							<?php 
								while ( have_posts() ) : the_post();
									get_template_part( 'template-parts/post', 'block' ); 
								endwhile;
							?>
						</div>
						
						<?php get_template_part( 'template-parts/post', 'pagination' ); ?>
						
						<?php
						else:
							get_template_part( 'template-parts/nothing' );
						endif; 
						?>
					</div>
					
				</div>

<?php get_footer(); ?>