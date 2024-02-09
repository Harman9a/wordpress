<?php

/**
 * harry_scripts description
 * @return [type] [description]
 */
function harry_scripts() {

    /**
     * all css files
    */

    wp_enqueue_style( 'harry-fonts', harry_fonts_url(), array(), time() );
    if( is_rtl() ){
        wp_enqueue_style( 'bootstrap-rtl', HARRY_THEME_CSS_DIR.'bootstrap-rtl.css', array() );
    }else{
        wp_enqueue_style( 'bootstrap', HARRY_THEME_CSS_DIR.'bootstrap.css', array() );
    }
    wp_enqueue_style( 'meanmenu', HARRY_THEME_CSS_DIR . 'meanmenu.css', [] );
    wp_enqueue_style( 'animate', HARRY_THEME_CSS_DIR . 'animate.css', [] );
    wp_enqueue_style( 'slick', HARRY_THEME_CSS_DIR . 'slick.css', [] );
    wp_enqueue_style( 'swiper-bundle', HARRY_THEME_CSS_DIR . 'swiper-bundle.css', [] );
    wp_enqueue_style( 'magnific-popup', HARRY_THEME_CSS_DIR . 'magnific-popup.css', [] );
    wp_enqueue_style( 'nice-select', HARRY_THEME_CSS_DIR . 'nice-select.css', [] );
    wp_enqueue_style( 'font-awesome-pro', HARRY_THEME_CSS_DIR . 'font-awesome-pro.css', [] );
    wp_enqueue_style( 'elegant-icon', HARRY_THEME_CSS_DIR . 'elegant-icon.css', [] );
    wp_enqueue_style( 'hover-reveal', HARRY_THEME_CSS_DIR . 'hover-reveal.css', [] );
    wp_enqueue_style( 'nouislider', HARRY_THEME_CSS_DIR . 'nouislider.css', [] );
    wp_enqueue_style( 'spacing', HARRY_THEME_CSS_DIR . 'spacing.css', [] );
    wp_enqueue_style( 'harry-core', HARRY_THEME_CSS_DIR . 'harry-core.css', [], time() );
    wp_enqueue_style( 'harry-unit', HARRY_THEME_CSS_DIR . 'harry-unit.css', [], time() );
    wp_enqueue_style( 'harry-custom', HARRY_THEME_CSS_DIR . 'harry-custom.css', [] );
    wp_enqueue_style( 'harry-style', get_stylesheet_uri() );

    // all js
    wp_enqueue_script( 'bootstrap-bundle', HARRY_THEME_JS_DIR . 'bootstrap-bundle.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'waypoints', HARRY_THEME_JS_DIR . 'waypoints.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'meanmenu', HARRY_THEME_JS_DIR . 'meanmenu.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'purecounter', HARRY_THEME_JS_DIR . 'purecounter.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'swiper-bundle', HARRY_THEME_JS_DIR . 'swiper-bundle.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'slick', HARRY_THEME_JS_DIR . 'slick.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'magnific-popup', HARRY_THEME_JS_DIR . 'magnific-popup.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'parallax', HARRY_THEME_JS_DIR . 'parallax.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'parallax-scroll', HARRY_THEME_JS_DIR . 'parallax-scroll.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'jarallax', HARRY_THEME_JS_DIR . 'jarallax.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'tween-max', HARRY_THEME_JS_DIR . 'tween-max.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'nice-select', HARRY_THEME_JS_DIR . 'nice-select.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'nouislider', HARRY_THEME_JS_DIR . 'nouislider.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'hover-reveal', HARRY_THEME_JS_DIR . 'hover-reveal.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'easing', HARRY_THEME_JS_DIR . 'easing.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'charming', HARRY_THEME_JS_DIR . 'charming.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'countdown', HARRY_THEME_JS_DIR . 'countdown.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'wow', HARRY_THEME_JS_DIR . 'wow.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'isotope-pkgd', HARRY_THEME_JS_DIR . 'isotope-pkgd.js', [ 'imagesloaded' ], false, true );
    wp_enqueue_script( 'harry-main', HARRY_THEME_JS_DIR . 'main.js', [ 'jquery' ], time(), true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'harry_scripts' );

/*
Register Fonts
 */
function harry_fonts_url() {
    $font_url = '';

    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
    if ( 'off' !== _x( 'on', 'Google font: on or off', 'harry' ) ) {
        $font_url = 'https://fonts.googleapis.com/css2?'. urlencode('family=Inter:wght@300;400;500;600;700;800&family=Oswald:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700;800&family=Rajdhani:wght@300;400;500;600;700&family=Roboto:wght@300;400;500;700;900&family=Space+Grotesk:wght@300;400;500;600;700&family=Syne:wght@400;500;600;700;800&display=swap');
    }
    return $font_url;
}