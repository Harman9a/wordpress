<?php 

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function harry_widgets_init() {

    $footer_style_2_switch = get_theme_mod( 'footer_style_2_switch', true );
    $footer_style_3_switch = get_theme_mod( 'footer_style_3_switch', true );
    $footer_style_4_switch = get_theme_mod( 'footer_style_4_switch', true );
    $footer_style_5_switch = get_theme_mod( 'footer_style_5_switch', true );
    $footer_style_6_switch = get_theme_mod( 'footer_style_6_switch', true );
    $footer_style_7_switch = get_theme_mod( 'footer_style_7_switch', true );
    $footer_style_8_switch = get_theme_mod( 'footer_style_8_switch', true );
    $footer_style_9_switch = get_theme_mod( 'footer_style_9_switch', true );
    $footer_style_12_switch = get_theme_mod( 'footer_style_12_switch', true );

    /**
     * blog sidebar
     */
    register_sidebar( [
        'name'          => esc_html__( 'Blog Sidebar', 'harry' ),
        'id'            => 'blog-sidebar',
        'description'          => esc_html__( 'Set Your Blog Widget', 'harry' ),
        'before_widget' => '<div id="%1$s" class="sidebar__widget mb-45 %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="sidebar__widget-title">',
        'after_title'   => '</h3>',
    ] );

    /**
     * service sidebar
     */
    register_sidebar( [
        'name'          => esc_html__( 'Services Sidebar', 'harry' ),
        'id'            => 'services-sidebar',
        'description'          => esc_html__( 'Set Your Service Widget', 'harry' ),
        'before_widget' => '<div id="%1$s" class="services__widget-item-2 mb-30 %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="sidebar__widget-title">',
        'after_title'   => '</h3>',
    ] );


    /**
     * product sidebar
     */
    register_sidebar( [
        'name'          => esc_html__( 'Product Sidebar', 'harry' ),
        'id'            => 'product-sidebar',
        'description'          => esc_html__( 'Set Your Product Widget', 'harry' ),
        'before_widget' => '<div id="%1$s" class="product__widget pb-25 %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="product__widget-title">',
        'after_title'   => '</h3>',
    ] );


    $footer_widgets = get_theme_mod( 'footer_widget_number', 4 );

    // footer default
    for ( $num = 1; $num <= $footer_widgets; $num++ ) {
        register_sidebar( [
            'name'          => sprintf( esc_html__( 'Footer %1$s', 'harry' ), $num ),
            'id'            => 'footer-' . $num,
            'description'   => sprintf( esc_html__( 'Footer column %1$s', 'harry' ), $num ),
            'before_widget' => '<div id="%1$s" class="footer__widget mb-50 footer-col-'.$num.' %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="footer__widget-title">',
            'after_title'   => '</h3>',
        ] );
    }

    // footer 2
    if ( $footer_style_2_switch ) {
        for ( $num = 1; $num <= $footer_widgets; $num++ ) {

            register_sidebar( [
                'name'          => sprintf( esc_html__( 'Footer Style 2 : %1$s', 'harry' ), $num ),
                'id'            => 'footer-2-' . $num,
                'description'   => sprintf( esc_html__( 'Footer Style 2 : %1$s', 'harry' ), $num ),
                'before_widget' => '<div id="%1$s" class="footer__widget footer__widget-4 mb-50 footer-col-4-'.$num.' %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="footer__widget-title">',
                'after_title'   => '</h3>',
            ] );
        }
    }    

    // footer 3
    if ( $footer_style_3_switch ) {
        for ( $num = 1; $num <= $footer_widgets; $num++ ) {
            register_sidebar( [
                'name'          => sprintf( esc_html__( 'Footer Style 3 : %1$s', 'harry' ), $num ),
                'id'            => 'footer-3-' . $num,
                'description'   => sprintf( esc_html__( 'Footer Style 3 : %1$s', 'harry' ), $num ),
                'before_widget' => '<div id="%1$s" class="footer__widget footer__widget-3 mb-50 footer-col-3-'.$num.' %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="footer__widget-title">',
                'after_title'   => '</h3>',
            ] );
        }
    }    

    // footer 4
    if ( $footer_style_4_switch ) {
        for ( $num = 1; $num <= $footer_widgets; $num++ ) {
            register_sidebar( [
                'name'          => sprintf( esc_html__( 'Footer Style 4 : %1$s', 'harry' ), $num ),
                'id'            => 'footer-4-' . $num,
                'description'   => sprintf( esc_html__( 'Footer Style 4 : %1$s', 'harry' ), $num ),
                'before_widget' => '<div id="%1$s" class="footer__widget footer__widget-5 mb-50 footer-col-5-'.$num.' %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="footer__widget-title">',
                'after_title'   => '</h3>',
            ] );
        }
    }

    // footer 5
    if ( $footer_style_5_switch ) {
        for ( $num = 1; $num <= $footer_widgets; $num++ ) {
            register_sidebar( [
                'name'          => sprintf( esc_html__( 'Footer Style 5 : %1$s', 'harry' ), $num ),
                'id'            => 'footer-5-' . $num,
                'description'   => sprintf( esc_html__( 'Footer Style 5 : %1$s', 'harry' ), $num ),
                'before_widget' => '<div id="%1$s" class="footer__widget-6 mb-50 footer-col-6-'.$num.' %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="footer__widget-title-6">',
                'after_title'   => '</h3>',
            ] );
        }
    }

    // footer 6
    if ( $footer_style_6_switch ) {
        for ( $num = 1; $num <= $footer_widgets; $num++ ) {
            register_sidebar( [
                'name'          => sprintf( esc_html__( 'Footer Style 6 : %1$s', 'harry' ), $num ),
                'id'            => 'footer-6-' . $num,
                'description'   => sprintf( esc_html__( 'Footer Style 6 : %1$s', 'harry' ), $num ),
                'before_widget' => '<div id="%1$s" class="footer__widget footer__widget-7 mb-50 footer-col-7-'.$num.' %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="footer__widget-title-7">',
                'after_title'   => '</h3>',
            ] );
        }
    }

    // footer 7
    if ( $footer_style_7_switch ) {
        for ( $num = 1; $num <= $footer_widgets; $num++ ) {
            register_sidebar( [
                'name'          => sprintf( esc_html__( 'Footer Style 7 : %1$s', 'harry' ), $num ),
                'id'            => 'footer-7-' . $num,
                'description'   => sprintf( esc_html__( 'Footer Style 7 : %1$s', 'harry' ), $num ),
                'before_widget' => '<div id="%1$s" class="footer__widget footer__widget-8 mb-50 footer-col-8-'.$num.' %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="footer__widget-title-8">',
                'after_title'   => '</h3>',
            ] );
        }
    }

    // footer 8
    if ( $footer_style_8_switch ) {
        for ( $num = 1; $num <= $footer_widgets; $num++ ) {
            register_sidebar( [
                'name'          => sprintf( esc_html__( 'Footer Style 8 : %1$s', 'harry' ), $num ),
                'id'            => 'footer-8-' . $num,
                'description'   => sprintf( esc_html__( 'Footer Style 8 : %1$s', 'harry' ), $num ),
                'before_widget' => '<div id="%1$s" class="footer__widget footer__widget-10 mb-50 footer-col-10-'.$num.' %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="footer__widget-title">',
                'after_title'   => '</h3>',
            ] );
        }
    }

    // footer 9
    if ( $footer_style_9_switch ) {
        for ( $num = 1; $num <= $footer_widgets +1; $num++ ) {
            register_sidebar( [
                'name'          => sprintf( esc_html__( 'Footer Style 9 : %1$s', 'harry' ), $num ),
                'id'            => 'footer-9-' . $num,
                'description'   => sprintf( esc_html__( 'Footer Style 9 : %1$s', 'harry' ), $num ),
                'before_widget' => '<div id="%1$s" class="footer__widget footer__widget-11 mb-50 footer-col-11-'.$num.' %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="footer__widget-title">',
                'after_title'   => '</h3>',
            ] );
        }
    }

    // footer 12
    if ( $footer_style_12_switch ) {
        for ( $num = 1; $num <= $footer_widgets; $num++ ) {
            register_sidebar( [
                'name'          => sprintf( esc_html__( 'Footer Style 12 : %1$s', 'harry' ), $num ),
                'id'            => 'footer-12-' . $num,
                'description'   => sprintf( esc_html__( 'Footer Style 12 : %1$s', 'harry' ), $num ),
                'before_widget' => '<div id="%1$s" class="footer__widget footer__widget-3 mb-50 footer-col-12-'.$num.' %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="footer__widget-title">',
                'after_title'   => '</h3>',
            ] );
        }
    }
}
add_action( 'widgets_init', 'harry_widgets_init' );