<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package harry
 */

$harry_audio_url = function_exists( 'get_field' ) ? get_field( 'fromate_style' ) : NULL;
$gallery_images = function_exists('get_field') ? get_field('gallery_images') : '';
$harry_video_url = function_exists( 'get_field' ) ? get_field( 'fromate_style' ) : NULL;

$harry_blog_single_social = get_theme_mod( 'harry_blog_single_social', false );
$blog_tag_col = $harry_blog_single_social ? 'col-xl-7' : 'col-xl-12';


if ( is_single() ) : ?>
    <!-- details start -->
    <article id="post-<?php the_ID();?>" <?php post_class( 'postbox__item format-image mb-50' );?>>

        <!-- content start -->
        <div class="postbox__main-wrapper">
            <?php get_template_part( 'template-parts/blog/blog-details-meta' ); ?>
            
            <div class="postbox__details-content-wrapper postbox__text mb-40 fix">
            <?php the_content();?>
                <?php
                    wp_link_pages( [
                        'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'harry' ),
                        'after'       => '</div>',
                        'link_before' => '<span class="page-number">',
                        'link_after'  => '</span>',
                    ] );
                ?>

            </div> 
            
            
            <?php if(has_tag() OR $harry_blog_single_social) :?>
            <div class="postbox__share-wrapper mb-60">
                <div class="row align-items-center">

                    <div class="<?php echo esc_attr($blog_tag_col); ?>">
                        <?php print harry_get_tag(); ?> 
                    </div>

                    <?php if(!empty($harry_blog_single_social)) :?>
                    <div class="col-xl-5">
                        <?php if(function_exists('harry_blog_single_social')): ?>
                            <?php print harry_blog_single_social(); ?> 
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>

                </div>
            </div>
            <?php endif ?>
                               
        </div>
    </article>
    <!-- details end -->
<?php else: ?>

    <article id="post-<?php the_ID();?>" <?php post_class( 'postbox__item white-bg mb-50' );?> >
        
        <!-- if post has thumbnail -->
        <?php if ( has_post_format('image') ): ?>    
        <div class="postbox__thumb m-img">
            <a href="<?php the_permalink();?>">
                <?php the_post_thumbnail( 'full', ['class' => 'img-responsive'] );?>
            </a>
        </div>
        <!-- if post has video -->
        <?php elseif ( has_post_format('video') ): ?> 
            <?php if ( has_post_thumbnail() ): ?> 
            <div class="postbox__thumb postbox__video m-img p-relative">

                <a href="<?php the_permalink();?>">
                    <?php the_post_thumbnail( 'full', ['class' => 'img-responsive'] );?>
                </a>
                
                <?php if(!empty($harry_video_url)) : ?>
                    <a href="<?php print esc_url( $harry_video_url );?>" class="play-btn pulse-btn popup-video"><i class="fas fa-play"></i></a>
                <?php endif; ?>

            </div>
            <?php endif; ?>

        <!-- if post has audio -->
        <?php elseif ( has_post_format('audio') ): ?> 

            <?php if ( !empty( $harry_audio_url ) ): ?>
            <div class="postbox__thumb postbox__audio m-img p-relative">
                <?php echo wp_oembed_get( $harry_audio_url ); ?>
            </div>
            <?php endif; ?>
        
            <!-- if post has gallery -->
            <?php elseif ( has_post_format('gallery') ): ?> 
                <?php if ( !empty( $gallery_images ) ): ?>
                <div class="postbox__thumb postbox__slider swiper-container m-img p-relative">
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

        <?php else: ?>
            <div class="postbox__thumb m-img">
                <a href="<?php the_permalink();?>">
                    <?php the_post_thumbnail( 'full', ['class' => 'img-responsive'] );?>
                </a>
            </div>
        <?php endif; ?>
        <div class="postbox__content">
            <!-- blog meta -->
            <?php get_template_part( 'template-parts/blog/blog-meta' ); ?>

            <h3 class="postbox__title">
                <a href="<?php the_permalink();?>"><?php the_title();?></a>
            </h3>
            <div class="postbox__text">
                <?php the_excerpt();?>
            </div>

            <!-- blog btn -->
            <?php get_template_part( 'template-parts/blog/blog-btn' ); ?>
        </div>
    </article>
<?php endif;?>