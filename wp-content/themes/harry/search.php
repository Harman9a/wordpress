<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package harry
 */

get_header();

$blog_column = is_active_sidebar( 'blog-sidebar' ) ? 8 : 12;

$result = $wp_query->found_posts;


?>

	<!-- search area start -->
	<?php if ( have_posts() ): ?>
	<section class="search__result-area grey-bg-4 pt-120 pb-80">
		<div class="container">
			<div class="row">
				<div class="col-xl-12">
					<div class="search__result-wrapper">
						<div class="search__result-content text-center mb-40">
							<h3 class="search__result-title"><?php esc_html_e( 'Search results for:', 'harry' );?> <span><?php esc_html_e( '“', 'harry' );?><?php print get_search_query();?><?php esc_html_e( '”', 'harry' );?></span></h3>
							<p><?php echo esc_html__( 'Harry found', 'harry' ); ?> <?php echo esc_html($result); ?> <?php echo esc_html__( 'results for your search query.', 'harry' ); ?></p>

						</div>
						<div class="search__result-form">
							<form action="<?php print esc_url( home_url( '/' ) );?>">
								<div class="search__result-input-box">
									<div class="search__result-input">
										<span>
											<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M9.55 18.1C14.272 18.1 18.1 14.272 18.1 9.55C18.1 4.82797 14.272 1 9.55 1C4.82797 1 1 4.82797 1 9.55C1 14.272 4.82797 18.1 9.55 18.1Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
												<path d="M19.0031 19.0002L17.2031 17.2002" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
											</svg>                                       
										</span>
										<input type="text" placeholder="<?php echo esc_html__( 'Search for articles...', 'harry' ); ?>" name="s" value="<?php print esc_attr( get_search_query() )?>">
									</div>
									<button type="submit" class="tp-btn"><?php echo esc_html__( 'Search', 'harry' ); ?></button>

								</div>
								<div class="search__result-tags">
									<?php wp_tag_cloud(); ?>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php endif; ?>
	<!-- search area end -->
         <!-- search result item area start -->
         <section class="tp-blog-area search__result-item-area pt-120 pb-100">
            <div class="container">
				<?php if ( have_posts() ): ?>
               <div class="row grid">
					<?php while ( have_posts() ): the_post(); ?>
					<div class="col-md-6 grid-item">
						<?php get_template_part( 'template-parts/content', 'search' ); ?>
					</div>
				  <?php endwhile; ?>
               </div>
               <div class="row">
                  <div class="col-xxl-12">
                     <div class="tp-pagination tp-pagination-style-2 mt-20">
					 	<?php harry_pagination( '<svg width="16" height="11" viewBox="0 0 16 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.17749 10.105L1.62499 5.55248L6.17749 0.999981" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/><path d="M14.3767 5.55249L1.75421 5.55249" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/></svg>', '<svg width="16" height="11" viewBox="0 0 16 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.82422 1L14.3767 5.5525L9.82422 10.105" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/><path d="M1.625 5.55249H14.2475" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/></svg>', '', [ 'class' => '' ] );?>
                     </div>
                  </div>
               </div>
			   
			   <?php else:
						get_template_part( 'template-parts/content', 'none' );
					endif;
				?>
            </div>
         </section>
         <!-- search result item area end -->
<?php
get_footer();
