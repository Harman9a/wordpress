<?php

/**
 * Template part for displaying post btn
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package harry
 */

$harry_search_btn = get_theme_mod( 'harry_blog_btn', 'Read More' );
$harry_search_btn_switch = get_theme_mod( 'harry_blog_btn_switch', true );

?>


<?php if ( !empty( $harry_search_btn_switch ) ): ?>
<div class="search__blog-btn">
    <a href="<?php the_permalink();?>" class="tp-btn-border">
        <?php print esc_html( $harry_search_btn );?>
        <span>
            <svg width="26" height="9" viewBox="0 0 26 9" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M21.6934 1L25 4.20003L21.6934 7.4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M0.999999 4.1991H25" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </span>
    </a>
</div>
<?php endif;?>