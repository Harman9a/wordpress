<?php
/**
 * Breadcrumbs for Eduker theme.
 *
 * @package     Eduker
 * @author      Theme_Pure
 * @copyright   Copyright (c) 2022, Theme_Pure
 * @link        https://www.themepure.net
 * @since       Eduker 1.0.0
 */


function my(){
    
}

function harry_breadcrumb_func() {
    global $post, $title;  
    $breadcrumb_class = '';
    $breadcrumb_show = 1;


    if ( is_front_page() && is_home() ) {
        $title = get_theme_mod('breadcrumb_blog_title', __('Blog','harry'));
        $breadcrumb_class = 'home_front_page';
    }
    elseif ( is_front_page() ) {
        $title = get_theme_mod('breadcrumb_blog_title', __('Blog','harry'));
        $breadcrumb_show = 0;
    }
    elseif ( is_home() ) {
        if ( get_option( 'page_for_posts' ) ) {
            $title = get_the_title( get_option( 'page_for_posts') );
        }
    }

    elseif ( is_single() && 'post' == get_post_type() ) {
      $title = get_the_title();
    } 
    elseif ( is_single() && 'product' == get_post_type() ) {
        $title = get_theme_mod( 'breadcrumb_product_details', __( 'Shop', 'harry' ) );
    } 
    elseif ( is_single() && 'courses' == get_post_type() ) {
      $title = esc_html__( 'Course Details', 'harry' );
    } 
    elseif ( 'courses' == get_post_type() ) {
      $title = esc_html__( 'Courses', 'harry' );
    } 
    elseif ( is_search() ) {
        $title = esc_html__( 'Search Results for : ', 'harry' ) . get_search_query();
    } 
    elseif ( is_404() ) {
        $title = esc_html__( 'Page not Found', 'harry' );
    } 
    elseif ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) {
        $title = get_theme_mod( 'breadcrumb_shop', __( 'Shop', 'harry' ) );
    } 
    elseif ( is_archive() ) {
        $title = get_the_archive_title();
    } 
    else {
        $title = get_the_title();
    }
 
    $_id = get_the_ID();

    if ( is_single() && 'product' == get_post_type() ) { 
        $_id = $post->ID;
    } 
    elseif ( function_exists("is_shop") AND is_shop()  ) { 
        $_id = wc_get_page_id('shop');
    } 
    elseif ( is_home() && get_option( 'page_for_posts' ) ) {
        $_id = get_option( 'page_for_posts' );
    }

    $is_breadcrumb = function_exists( 'get_field' ) ? get_field( 'is_it_invisible_breadcrumb', $_id ) : '';
    if( !empty($_GET['s']) ) {
      $is_breadcrumb = null;
    }


    // breadcrumb code
    $bg_img_from_page = function_exists('get_field') ? get_field('breadcrumb_background_image',$_id) : '';
    $hide_bg_img = function_exists('get_field') ? get_field('hide_breadcrumb_background_image',$_id) : '';

    // get_theme_mod
    $bg_img = get_theme_mod( 'breadcrumb_bg_img');
    $bg_img_color = get_theme_mod( 'harry_breadcrumb_bg_color', '#e1e1e1');
    $harry_breadcrumb_shape_switch = get_theme_mod( 'harry_breadcrumb_shape_switch', true );
    $breadcrumb_info_switch = get_theme_mod( 'breadcrumb_info_switch', true );

    if ( $hide_bg_img && empty($_GET['s']) ) {
        $bg_img = '';
    } else {
        $bg_img = !empty( $bg_img_from_page ) ? $bg_img_from_page['url'] : $bg_img;
    }

    if ( empty( $is_breadcrumb ) && $breadcrumb_show == 1 ) {

    // breadcrumb get field
    $harry_breadcrumb_style = function_exists( 'get_field' ) ? get_field( 'breadcrumb_style' ) : NULL;
    $harry_default_breadcrumb_style = get_theme_mod( 'choose_default_breadcrumb', 'breadcrumb-style-1' );

    $padding_top = get_theme_mod( 'harry_breadcrumb_pt', '115');
    $padding_bottom = get_theme_mod( 'harry_breadcrumb_pb', '130');


    if ( $harry_breadcrumb_style == 'breadcrumb-style-1' && empty($_GET['s']) ) : ?>

            <!-- breadcrumb style 1 -->
            <section class="breadcrumb__area pt-130 pb-115 breadcrumb__style-10 p-relative z-index-1 <?php print esc_attr( $breadcrumb_class );?>" data-padding-top="<?php echo esc_attr($padding_top) ?>px" data-padding-bottom="<?php echo esc_attr($padding_bottom) ?>px" data-bg-color="<?php echo esc_attr($bg_img_color); ?>">
                <div class="breadcrumb__bg-4 breadcrumb__bg-overlay m-img include-bg" data-background="<?php print esc_attr($bg_img);?>"></div>
                <div class="container">
                    <div class="row justify-content-center">
                    <?php if (!empty($breadcrumb_info_switch)) : ?>
                        <div class="col-xl-10">
                            <div class="breadcrumb__content text-center">
                                <h3 class="breadcrumb__title" ><?php echo wp_kses_post( $title ); ?></h3>
                                <div class="breadcrumb__list">
                                        <?php if(function_exists('bcn_display')) {
                                            bcn_display();
                                        } ?>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>

    <?php elseif ( $harry_breadcrumb_style == 'breadcrumb-style-2' && empty($_GET['s']) ) : ?>

        <!-- breadcrumb style 2 -->
        <section class="breadcrumb__area breadcrumb__style-8 p-relative include-bg pt-110 pb-50 <?php print esc_attr( $breadcrumb_class );?>" data-padding-top="<?php echo esc_attr($padding_top) ?>px" data-padding-bottom="<?php echo esc_attr($padding_bottom) ?>px" data-bg-color="<?php echo esc_attr($bg_img_color); ?>" data-background="<?php print esc_attr($bg_img);?>">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-8 col-xl-8 col-lg-10">
                        <div class="breadcrumb__content text-center p-relative z-index-1">
                        <h3 class="breadcrumb__title"><?php echo wp_kses_post( $title ); ?></h3>
                            <div class="breadcrumb__list">
                                <?php if(function_exists('bcn_display')) {
                                    bcn_display();
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <?php elseif ( $harry_breadcrumb_style == 'breadcrumb-style-3' && empty($_GET['s']) ) : ?>

        <!-- breadcrumb style 3 -->
        <section class="breadcrumb__area breadcrumb__style-3 breadcrumb__spacing-2 include-bg pt-200 pb-235 <?php print esc_attr( $breadcrumb_class );?>" data-padding-top="<?php echo esc_attr($padding_top) ?>px" data-padding-bottom="<?php echo esc_attr($padding_bottom) ?>px" data-background="<?php print esc_attr($bg_img);?>" data-bg-color="<?php echo esc_attr($bg_img_color); ?>">
            <div class="container">
               <div class="row">
                  <div class="col-xxl-7">
                     <div class="breadcrumb__content p-relative z-index-1">
                        <div class="breadcrumb__list">
                            <?php if(function_exists('bcn_display')) {
                                bcn_display();
                            } ?>
                        </div>
                        <h3 class="breadcrumb__title"><?php echo wp_kses_post( $title ); ?></h3>
                     </div>
                  </div>
               </div>
            </div>
         </section>

        <?php elseif ( $harry_breadcrumb_style == 'breadcrumb-style-4' && empty($_GET['s']) ) : ?>
        <!-- breadcrumb area start -->
        <section class="breadcrumb__area breadcrumb__style-6 p-relative include-bg pt-200 pb-120 <?php print esc_attr( $breadcrumb_class );?>" data-padding-top="<?php echo esc_attr($padding_top) ?>px" data-padding-bottom="<?php echo esc_attr($padding_bottom) ?>px">
            <div class="breadcrumb__bg-2 breadcrumb__overlay include-bg" data-background="<?php print esc_attr($bg_img);?>"></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-8 col-xl-8 col-lg-10">
                        <div class="breadcrumb__content text-center p-relative z-index-1">
                            <h3 class="breadcrumb__title"><?php echo wp_kses_post( $title ); ?></h3>
                            <div class="breadcrumb__list">
                                <?php if(function_exists('bcn_display')) {
                                    bcn_display();
                                } ?>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- breadcrumb area end -->

        <?php elseif ( $harry_breadcrumb_style == 'breadcrumb-style-5' && empty($_GET['s']) ) : ?>

            <!-- breadcrumb area start -->
            <section class="breadcrumb__area breadcrumb__style-5 has-breadcrumb-list p-relative include-bg pt-170 pb-110 blue-bg <?php print esc_attr( $breadcrumb_class );?>" data-padding-top="<?php echo esc_attr($padding_top) ?>px" data-padding-bottom="<?php echo esc_attr($padding_bottom) ?>px">
                <div class="breadcrumb__bg bg-luminosity include-bg" data-background="<?php print esc_attr($bg_img);?>"></div>
                <div class="container">
                    <div class="row align-items-end">
                        <div class="col-xxl-9 col-lg-9">
                            <div class="breadcrumb__content breadcrumb__content-2 p-relative z-index-1">
                                    <div class="breadcrumb__list">
                                    <?php if(function_exists('bcn_display')) {
                                            bcn_display();
                                        } ?>
                                    </div>
                                <h3 class="breadcrumb__title"><?php echo wp_kses_post( $title ); ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- breadcrumb area end -->

    <?php else : ?>
        <!--  from customizer -->
        <?php if ( $harry_default_breadcrumb_style == 'breadcrumb-style-2' ) : ?>
        
        <!-- breadcrumb style 2 -->
        <section class="breadcrumb__area breadcrumb__style-8 p-relative include-bg pt-110 pb-50 <?php print esc_attr( $breadcrumb_class );?>" data-bg-color="<?php echo esc_attr($bg_img_color); ?>" data-background="<?php print esc_attr($bg_img);?>" data-padding-top="<?php echo esc_attr($padding_top) ?>px" data-padding-bottom="<?php echo esc_attr($padding_bottom) ?>px">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-8 col-xl-8 col-lg-10">
                        <div class="breadcrumb__content text-center p-relative z-index-1">
                        <h3 class="breadcrumb__title"><?php echo wp_kses_post( $title ); ?></h3>
                            <div class="breadcrumb__list">
                                <?php if(function_exists('bcn_display')) {
                                    bcn_display();
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    
        <?php elseif ( $harry_default_breadcrumb_style == 'breadcrumb-style-3' ) : ?>

        <!-- breadcrumb style 3 -->
        <section class="breadcrumb__area breadcrumb__style-3 breadcrumb__spacing-2 include-bg pt-200 pb-235 <?php print esc_attr( $breadcrumb_class );?>" data-background="<?php print esc_attr($bg_img);?>" data-bg-color="<?php echo esc_attr($bg_img_color); ?>" data-padding-top="<?php echo esc_attr($padding_top) ?>px" data-padding-bottom="<?php echo esc_attr($padding_bottom) ?>px">
            <div class="container">
               <div class="row">
                  <div class="col-xxl-7">
                     <div class="breadcrumb__content p-relative z-index-1">
                        <div class="breadcrumb__list">
                            <?php if(function_exists('bcn_display')) {
                                bcn_display();
                            } ?>
                        </div>
                        <h3 class="breadcrumb__title"><?php echo wp_kses_post( $title ); ?></h3>
                     </div>
                  </div>
               </div>
            </div>
         </section>

         <?php elseif ( $harry_default_breadcrumb_style == 'breadcrumb-style-4' ) : ?>

        <!-- breadcrumb area start -->
        <section class="breadcrumb__area breadcrumb__style-6 p-relative include-bg pt-200 pb-120 <?php print esc_attr( $breadcrumb_class );?>" data-padding-top="<?php echo esc_attr($padding_top) ?>px" data-padding-bottom="<?php echo esc_attr($padding_bottom) ?>px">
            <div class="breadcrumb__bg-2 breadcrumb__overlay include-bg" data-background="<?php print esc_attr($bg_img);?>"></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-8 col-xl-8 col-lg-10">
                        <div class="breadcrumb__content text-center p-relative z-index-1">
                            <h3 class="breadcrumb__title"><?php echo wp_kses_post( $title ); ?></h3>
                            <div class="breadcrumb__list">
                                <?php if(function_exists('bcn_display')) {
                                    bcn_display();
                                } ?>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- breadcrumb area end -->

        <?php elseif ( $harry_default_breadcrumb_style == 'breadcrumb-style-5' ) : ?>

        <!-- breadcrumb area start -->
        <section class="breadcrumb__area breadcrumb__style-5 has-breadcrumb-list p-relative include-bg pt-170 pb-110 blue-bg <?php print esc_attr( $breadcrumb_class );?>" data-padding-top="<?php echo esc_attr($padding_top) ?>px" data-padding-bottom="<?php echo esc_attr($padding_bottom) ?>px">
            <div class="breadcrumb__bg bg-luminosity include-bg" data-background="<?php print esc_attr($bg_img);?>"></div>
            <div class="container">
               <div class="row align-items-end">
                  <div class="col-xxl-9 col-lg-9">
                     <div class="breadcrumb__content breadcrumb__content-2 p-relative z-index-1">
                            <div class="breadcrumb__list">
                            <?php if(function_exists('bcn_display')) {
                                    bcn_display();
                                } ?>
                            </div>
                        <h3 class="breadcrumb__title"><?php echo wp_kses_post( $title ); ?></h3>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- breadcrumb area end -->

        <?php else : ?>
                   
        <!-- default breadcrumb style -->
        <section class="breadcrumb__area pt-130 pb-115 breadcrumb__style-10 p-relative z-index-1 <?php print esc_attr( $breadcrumb_class );?>" data-bg-color="<?php echo esc_attr($bg_img_color); ?>" data-padding-top="<?php echo esc_attr($padding_top) ?>px" data-padding-bottom="<?php echo esc_attr($padding_bottom) ?>px">
            <div class="breadcrumb__bg-4 breadcrumb__bg-overlay m-img include-bg" data-background="<?php print esc_attr($bg_img);?>"></div>
            <div class="container">
                <div class="row justify-content-center">
                <?php if (!empty($breadcrumb_info_switch)) : ?>
                    <div class="col-xl-10">
                        <div class="breadcrumb__content text-center">
                        <h3 class="breadcrumb__title"><?php echo wp_kses_post( $title ); ?></h3>
                        <div class="breadcrumb__list">
                                <?php if(function_exists('bcn_display')) {
                                    bcn_display();
                                } ?>
                        </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
            
        <?php endif; ?> 
        <?php endif; ?> 
    <?php
    }
} // function close


add_action( 'harry_header_style', 'harry_breadcrumb_func', 10 );

// harry_search_form
function harry_search_form() {
    ?>
     <div class="search-wrapper p-relative transition-3 d-none">
         <div class="search-form transition-3">
             <form method="get" action="<?php print esc_url( home_url( '/' ) );?>" >
                 <input type="search" name="s" value="<?php print esc_attr( get_search_query() )?>" placeholder="<?php print esc_attr__( 'Enter Your Keyword', 'harry' );?>" >
                 <button type="submit" class="search-btn"><i class="far fa-search"></i></button>
             </form>
             <a href="javascript:void(0);" class="search-close"><i class="far fa-times"></i></a>
         </div>
     </div>
   <?php
}

add_action( 'harry_before_main_content', 'harry_search_form' );