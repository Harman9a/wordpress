<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package harry
 */

get_header();

$blog_column = is_active_sidebar( 'blog-sidebar' ) ? 8 : 12;
$categories = get_the_terms( $post->ID, 'category' );
$harry_audio_url = function_exists( 'get_field' ) ? get_field( 'fromate_style' ) : NULL;
$gallery_images = function_exists('get_field') ? get_field('gallery_images') : '';
$harry_video_url = function_exists( 'get_field' ) ? get_field( 'fromate_style' ) : NULL;

$enable_post_details_style_2 = function_exists( 'get_field' ) ? get_field( 'enable_post_details_style_2' ) : NULL;

if(function_exists('setPostViews')){
	setPostViews(get_the_ID());
}
?>


	<?php if(!empty($enable_post_details_style_2)) : ?>

         <!-- postbox details area start -->
         <section class="postbox__area">
            <div class="postbox__wrapper postbox__style-2">
				<?php
					while ( have_posts() ):
					the_post();

					global $post;
                    $categories = get_the_category($post->ID);

					$author_data = get_the_author_meta( 'description', get_query_var( 'author' ) );
					$author_name = get_the_author_meta( 'harry_write_by');
					$facebook_url = get_the_author_meta( 'harry_facebook' );
					$twitter_url = get_the_author_meta( 'harry_twitter' );
					$linkedin_url = get_the_author_meta( 'harry_linkedin' );
					$instagram_url = get_the_author_meta( 'harry_instagram' );
					$harry_url = get_the_author_meta( 'harry_youtube' );
					$harry_write_by = get_the_author_meta( 'harry_write_by' );
					$author_bio_avatar_size = 180;
				
				
					$categories = get_the_terms( $post->ID, 'category' );
					$harry_blog_date = get_theme_mod( 'harry_blog_date', true );
					$harry_blog_comments = get_theme_mod( 'harry_blog_comments', true );
					$harry_blog_author = get_theme_mod( 'harry_blog_author', true );
					$harry_blog_cat = get_theme_mod( 'harry_blog_cat', false );
					$harry_blog_view = get_theme_mod( 'harry_blog_view', false );
				
					if(function_exists('setPostViews')){
						setPostViews(get_the_ID());
					}
					
				?>
               <div class="postbox__top">
                  <div class="container">
                     <div class="row justify-content-center">
                        <div class="col-xl-10">

                           <div class="postbox__category">
						   <a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>"><?php echo esc_html($categories[0]->name); ?></a>
                           </div>

                           	<h3 class="postbox__title">
								<?php the_title();?>
							</h3>

                           <div class="postbox__thumb postbox__thumb-overlay black-bg m-img mb-55" data-background="<?php echo get_the_post_thumbnail_url( $post->ID);?>"></div>
							<div class="postbox__meta-wrapper d-flex align-items-center justify-content-center flex-wrap">

								<?php if(!empty(get_author_posts_url( get_the_author_meta( 'ID' ) )) && !empty($harry_blog_author)) : ?>
								<div class="postbox__meta-item mb-30">
									<div class="postbox__meta-author d-flex align-items-center">
									<?php if(!empty(get_avatar(get_the_author_meta( 'user_email' ), $author_bio_avatar_size, '', '', [ 'class' => 'media-object img-circle' ]))) : ?>
										<div class="postbox__meta-author-thumb">
											<a href="<?php print esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );?>">
												<?php print get_avatar(get_avatar(get_the_author_meta( 'user_email' ), $author_bio_avatar_size, '', '', [ 'class' => 'media-object img-circle' ]) );?>
											</a>
										</div>
										<?php endif; ?>

										<div class="postbox__meta-content">
											<span class="postbox__meta-type"><?php echo esc_html__( 'Author', 'harry' ); ?></span>
											<p class="postbox__meta-name">
												<a href="<?php print esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );?>">
													<?php print get_the_author();?>
												</a>
											</p>
										</div>
									</div>
								</div>
								<?php endif; ?>

								<?php if ( !empty($harry_blog_date) ): ?>
								<div class="postbox__meta-item mb-30">
									<div class="postbox__meta-content">
										<span class="postbox__meta-type"><?php echo esc_html__( 'Published', 'harry' ); ?></span>
										<p class="postbox__meta-name"><?php the_time( get_option('date_format') ); ?></p>
									</div>
								</div>
								<?php endif; ?>

								<?php if ( !empty($harry_blog_comments) ): ?>
								<div class="postbox__meta-item mb-30">
									<div class="postbox__meta-content">
										<span class="postbox__meta-type"><?php comments_number();?></span>
										<!-- for wp comment, this link will redirected to its coment section -->
										<p class="postbox__meta-name"><a href="<?php comments_link();?>"><?php echo esc_html__( 'Join the Conversation', 'harry' ); ?></a></p>
									</div>
								</div>
								<?php endif; ?>

								<?php if(function_exists('getPostViews') && !empty($harry_blog_view)) : ?>
								<div class="postbox__meta-item mb-30">
									<div class="postbox__meta-content">
										<span class="postbox__meta-type"><?php echo esc_html__( 'View', 'harry' ); ?></span>
										<p class="postbox__meta-name"><?php echo getPostViews(get_the_ID()); ?> <?php echo esc_html__( 'views', 'harry' ); ?></p>
									</div>
								</div>
								<?php endif; ?>

							</div>

                        </div>
                     </div>
                  </div>
               </div>
			   <?php endwhile;  // End of the loop. ?>		
               <div class="postbox__main-wrapper pt-75">
                  <div class="container">
				  		<?php the_content(); ?>
                  </div>
               </div>

			   <div class="postbox__comment-wrapper postbox__comment-style-2 pt-90 pb-65">
                  <div class="container">
                     <div class="row justify-content-center">
                        <div class="col-xl-8 col-lg-10">
							<?php
				
								// If comments are open or we have at least one comment, load up the comment template.
								if ( comments_open() || get_comments_number() ):
									comments_template();
								endif;

							?>

							</div>
                     	</div>
                  	</div>
               </div>

			   <?php if ( get_previous_post_link() AND get_next_post_link() ): 
					$prev_post = get_adjacent_post(false, '', true);
					$next_post = get_adjacent_post(false, '', false);
				?>
			   <div class="postbox__more-navigation postbox__more-navigation-2 grey-bg-7 d-none d-sm-block">
                  <div class="container">
                     <div class="row">
					 <?php if ( get_previous_post_link() ): ?>
                        <div class="col-md-5">
                           <div class="postbox__more-left d-flex align-items-center">
                              <div class="postbox__more-icon">
                                 <a href="<?php echo get_permalink($prev_post->ID) ?>">
                                    <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path d="M7 12.9718L2.06061 8.04401C1.47727 7.46205 1.47727 6.50975 2.06061 5.92778L7 1" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                 </a>
                              </div>
                              <div class="postbox__more-content">
								 <p><?php print esc_html__( 'Previous Article', 'harry' );?></p>
								<h4><?php print get_previous_post_link( '%link ', '%title' );?></h4>
                              </div>
                           </div>
                        </div>
						<?php endif;?>
                        <div class="col-md-2">
                           <div class="postbox__more-menu text-center">
							   <span>
								 <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M11.6673 4.66662C12.9559 4.66662 14.0006 3.62196 14.0006 2.33331C14.0006 1.04466 12.9559 0 11.6673 0C10.3786 0 9.33398 1.04466 9.33398 2.33331C9.33398 3.62196 10.3786 4.66662 11.6673 4.66662Z" fill="currentColor"/>
									<path d="M2.33331 4.66662C3.62196 4.66662 4.66662 3.62196 4.66662 2.33331C4.66662 1.04466 3.62196 0 2.33331 0C1.04466 0 0 1.04466 0 2.33331C0 3.62196 1.04466 4.66662 2.33331 4.66662Z" fill="currentColor"/>
									<path d="M11.6673 13.9996C12.9559 13.9996 14.0006 12.955 14.0006 11.6663C14.0006 10.3777 12.9559 9.33301 11.6673 9.33301C10.3786 9.33301 9.33398 10.3777 9.33398 11.6663C9.33398 12.955 10.3786 13.9996 11.6673 13.9996Z" fill="currentColor"/>
									<path d="M2.33331 13.9996C3.62196 13.9996 4.66662 12.955 4.66662 11.6663C4.66662 10.3777 3.62196 9.33301 2.33331 9.33301C1.04466 9.33301 0 10.3777 0 11.6663C0 12.955 1.04466 13.9996 2.33331 13.9996Z" fill="currentColor"/>
								 </svg> 
							  </span>                               
                           </div>
                        </div>
						<?php if ( get_next_post_link() ): ?>
                        <div class="col-md-5">
                           <div class="postbox__more-right d-flex align-items-center justify-content-end">
                              <div class="postbox__more-content">
								<p> <?php print esc_html__( 'Next Article', 'harry' );?></p>
								<h4><?php print get_next_post_link( '%link ', '%title' );?></h4>
                              </div>
                              <div class="postbox__more-icon">
                                 <a href="<?php echo get_permalink($next_post->ID) ?>">
                                    <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path d="M1 12.9718L5.93939 8.04401C6.52273 7.46205 6.52273 6.50975 5.93939 5.92778L1 1" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>                                                      
                                 </a>
                              </div>
                           </div>
                        </div>
						<?php endif;?>
                     </div>
                  </div>
               </div>
			   <?php endif;?>
            </div>
         </section>
         <!-- postbox details area end -->



	<!-- default style -->
	<?php else: ?>
		<!-- breadcrumb area start -->
		<section class="breadcrumb__area tp-postbox-breadcrumb include-bg pb-70 pt-120 grey-bg-4">
			<div class="container">
				<div class="row">
					<div class="col-xxl-9">
						<?php
							while ( have_posts() ):
							the_post();
						?>
						<div class="breadcrumb__content p-relative z-index-1">
							<div class="postbox__category">
								<a href="<?php print esc_url(get_category_link($categories[0]->term_id)); ?>"><?php echo esc_html($categories[0]->name); ?></a>
							</div>
							<h3 class="breadcrumb__title"><?php the_title();?></h3>
	
							<div class="breadcrumb__list">
								<?php if(function_exists('bcn_display')) {
									bcn_display();
								} ?>
							</div>
						</div>
						<?php endwhile;  // End of the loop. ?>	
					</div>
				</div>
			</div>
		</section>
		<!-- breadcrumb area end -->
	
		<section class="tp-blog-area postbox__area grey-bg-4 pb-120">
			<div class="container">
			   <div class="row">
				  <div class="col-xxl-12">
					 <div class="postbox__wrapper">
						 <?php
							while ( have_posts() ):
							the_post();
						?>
						<div class="postbox__top">
							<!-- if post has image -->
							<?php if ( has_post_format('image') ): ?>
								<?php if ( has_post_thumbnail() ): ?>
									<div class="postbox__thumb mb-55">
										<?php the_post_thumbnail( 'full', ['class' => 'img-responsive'] );?>
									</div>
								<?php endif;?>
	
							<!-- if post has video -->
							<?php elseif ( has_post_format('video') ): ?>
								<?php if ( has_post_thumbnail() ): ?> 
									<div class="postbox__thumb postbox__video m-img p-relative mb-55">
	
									<?php the_post_thumbnail( 'full', ['class' => 'img-responsive'] );?>
										
										<?php if(!empty($harry_video_url)) : ?>
											<a href="<?php print esc_url( $harry_video_url );?>" class="play-btn pulse-btn popup-video"><i class="fas fa-play"></i></a>
										<?php endif; ?>
									</div>
								<?php endif; ?>
							
							<!-- if post has audio -->
							<?php elseif ( has_post_format('audio') ): ?>
								<?php if ( !empty( $harry_audio_url ) ): ?>
									<div class="postbox__thumb postbox__audio m-img p-relative mb-55">
										<?php echo wp_oembed_get( $harry_audio_url ); ?>
									</div>
								<?php endif; ?>
							
							<!-- if post has gallery -->
							<?php elseif ( has_post_format('gallery') ): ?>
								<?php if ( !empty( $gallery_images ) ): ?>
									<div class="postbox__thumb postbox__slider swiper-container m-img p-relative mb-55">
										<div class="swiper-wrapper">
											<?php foreach ( $gallery_images as $key => $image ): ?>
											<div class="postbox__slider-item swiper-slide">
												<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
											</div>
											<?php endforeach;?>
										</div>
										<div class="postbox__nav">
											<button class="postbox-slider-button-next"><i class="fa-regular fa-angle-right"></i></button>
											<button class="postbox-slider-button-prev"><i class="fa-regular fa-angle-left"></i></button>
										</div>
									</div>
									<?php endif; ?>
	
							<!-- defalut image format -->
							<?php else: ?>
								<?php if ( has_post_thumbnail() ): ?> 
								<div class="postbox__thumb m-img mb-55">
								<?php the_post_thumbnail( 'full', ['class' => 'img-responsive'] );?>
								</div>
								<?php endif; ?>
	
							<?php endif; // end of inner if ?>
						</div>
						<?php endwhile;  // End of the loop. ?>		
						<div class="postbox__main postbox__details-content-wrapper">
						   <div class="row">
	
							  <div class="col-lg-<?php echo esc_attr($blog_column); ?>">
								<?php
								while ( have_posts() ):
								the_post();
	
								get_template_part( 'template-parts/content', get_post_format() );
	
								?>
									 <?php if ( get_previous_post_link() AND get_next_post_link() ): 
										$prev_post = get_adjacent_post(false, '', true);
										$next_post = get_adjacent_post(false, '', false);
									?>
	
									<div class="postbox__more-navigation white-bg d-flex justify-content-between flex-wrap mb-40 ">
										<?php if ( get_previous_post_link() ): ?>
											<div class="postbox__more-left d-flex align-items-center">
												<div class="postbox__more-icon">
													<a href="<?php echo get_permalink($prev_post->ID) ?>">
														<svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M7 12.9718L2.06061 8.04401C1.47727 7.46205 1.47727 6.50975 2.06061 5.92778L7 1" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
														</svg>
													</a>
												</div>
												<div class="postbox__more-content">
													<p><?php print esc_html__( 'Previous Article', 'harry' );?></p>
													<h4><?php print get_previous_post_link( '%link ', '%title' );?></h4>
												</div>
											</div>
										<?php endif;?>

										<?php if ( get_next_post_link() ): ?>
										<div class="postbox__more-right d-flex align-items-center justify-content-end">
											<div class="postbox__more-content">
												<p> <?php print esc_html__( 'Next Article', 'harry' );?></p>
												<h4><?php print get_next_post_link( '%link ', '%title' );?></h4>
											</div>
											<div class="postbox__more-icon">
											<a href="<?php echo get_permalink($next_post->ID) ?>">
												<svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path d="M1 12.9718L5.93939 8.04401C6.52273 7.46205 6.52273 6.50975 5.93939 5.92778L1 1" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
												</svg>
											</a>
											</div>
										</div>
										<?php endif;?>
									</div>
	
									<?php endif;?> <!-- navigation end -->
	
									<?php
									get_template_part( 'template-parts/biography', get_post_format() );
	
									// If comments are open or we have at least one comment, load up the comment template.
									if ( comments_open() || get_comments_number() ):
										comments_template();
									endif;
	
									endwhile; // End of the loop.
									?>
							  </div> <!-- end col 8 -->
	
							  <?php if ( is_active_sidebar( 'blog-sidebar' ) ): ?>
								<div class="col-lg-4">
									<div class="sidebar__wrapper pl-40">
										<?php get_sidebar();?>
									</div>
								</div> <!-- end col 4 -->
							<?php endif;?>
						   </div>
						</div> <!-- end main wrapper -->
					 </div>
				  </div>
			   </div>
			</div>
		 </section>

	<?php endif; ?>

<?php
get_footer();
