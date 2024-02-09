<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package harry
 */

if ( is_single() ) : ?>
    <article id="post-<?php the_ID();?>" <?php post_class( 'postbox__item format-search mb-50' );?>>
        <?php if ( has_post_thumbnail() ): ?>
            <div class="postbox__thumb">
                <?php the_post_thumbnail( 'full', ['class' => 'img-responsive'] );?>
            </div>
        <?php endif;?>

        <div class="postbox__content">
            <!-- blog meta -->
            <?php get_template_part( 'template-parts/blog/blog-meta' ); ?>
            <h3 class="postbox__title">
                <?php the_title();?>
            </h3>
            <div class="postbox__text">
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
            <?php print harry_get_tag();?>
        </div>
    </article>
<?php else: ?>

    <article id="post-<?php the_ID();?>" <?php post_class( 'search__blog-item mb-30' );?>>
        <div class="search__blog-content">

            <?php get_template_part( 'template-parts/blog/search-result-top-meta' ); ?>

            <h3 class="search__blog-title">
                <a href="<?php the_permalink();?>"><?php the_title();?></a>
            </h3>

            <?php the_excerpt();?>

            <?php get_template_part( 'template-parts/blog/search-result-meta' ); ?>
            
            <?php get_template_part( 'template-parts/blog/blog-search-btn' ); ?>
            
        </div>
    </article>    
<?php endif;?>