<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package harry
 */
?>

<!doctype html>
<html <?php language_attributes();?>>
<head>
	<meta charset="<?php bloginfo( 'charset' );?>">
    <?php if ( is_singular() && pings_open( get_queried_object() ) ): ?>
    <?php endif;?>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head();?>
</head>

<body <?php body_class();?>>

    <?php wp_body_open();?>


    <?php
         $harry_preloader = get_theme_mod( 'harry_preloader_switch', false );
         $harry_preloader_bar = get_theme_mod( 'harry_preloader_bar', false );
         $harry_preloader_text = get_theme_mod( 'harry_preloader_text', __( 'Harry', 'harry' ) );
         $harry_preloader_loading_text = get_theme_mod( 'harry_preloader_loading_text', __( 'Loading', 'harry' ) );
         $harry_preloader_logo = get_theme_mod( 'harry_preloader_logo', get_template_directory_uri() . '/assets/img/logo/logo-black.svg' );

         // search logo
         $harry_search_logo = get_theme_mod( 'harry_search_logo', get_template_directory_uri() . '/assets/img/logo/logo.svg' );
         $harry_backtotop = get_theme_mod( 'harry_backtotop', false );

    ?>

    <?php if ( !empty( $harry_preloader ) ): ?>
      <!-- pre loader area start -->
      <div id="loading">
         <div id="loading-center">
            <div id="loading-center-absolute">
               <!-- loading content here -->
               <div class="preloader__content text-center">
                  <div class="preloader__logo">
                     <img src="<?php print esc_url($harry_preloader_logo); ?>" alt="<?php echo esc_attr__('logo','harry'); ?>">
                  </div>

                  <?php if ( !empty( $harry_preloader_bar ) ): ?>
                  <div id="tp-loading-bar" class="preloader__bar">
                     <div id="tp-loading-line" class="preloader__bar-inner"></div>
                  </div>
                  <?php endif;?>

                  <?php if ( !empty( $harry_preloader_text ) ): ?>
                  <h3 class="preloader__title"><?php echo esc_html($harry_preloader_text); ?></h3>
                  <?php endif;?>

                  <?php if ( !empty( $harry_preloader_text ) ): ?>
                  <p class="preloader__loading"><?php echo esc_html($harry_preloader_loading_text); ?></p>
                  <?php endif;?>
               </div>
            </div>
         </div>  
      </div>
      <!-- pre loader area end -->
    <?php endif;?>

    <?php if ( !empty( $harry_backtotop ) ): ?>
      <!-- back to top start -->
      <div class="back-to-top-wrapper">
         <button id="back_to_top" type="button" class="back-to-top-btn">
            <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
               <path d="M11 6L6 1L1 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>               
         </button>
      </div>
      <!-- back to top end -->
    <?php endif;?>

   <!-- search popup start -->
   <div class="search__popup">
      <div class="container">
         <div class="row">
            <div class="col-xxl-12">
               <div class="search__wrapper">
                  <div class="search__top d-flex justify-content-between align-items-center">
                     <div class="search__logo">
                        <a href="<?php print esc_url( home_url( '/' ) );?>">
                           <img src="<?php print esc_url($harry_search_logo); ?>" alt="<?php echo esc_attr__('logo','harry'); ?>">
                        </a>
                     </div>
                     <div class="search__close">
                        <button type="button" class="search__close-btn search-close-btn">
                           <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M17 1L1 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M1 1L17 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                           </svg>                                 
                        </button>
                     </div>
                  </div>
                  <div class="search__form">
                     <form action="<?php print esc_url( home_url( '/' ) );?>">
                        <div class="search__input">
                           <input class="search-input-field" type="text" placeholder="<?php print esc_attr__( 'Search...', 'harry' );?>" name="s" value="<?php print esc_attr( get_search_query() )?>">
                           <span class="search-focus-border"></span>
                           <button type="submit">
                              <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path d="M9.55 18.1C14.272 18.1 18.1 14.272 18.1 9.55C18.1 4.82797 14.272 1 9.55 1C4.82797 1 1 4.82797 1 9.55C1 14.272 4.82797 18.1 9.55 18.1Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M19.0002 19.0002L17.2002 17.2002" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                              </svg> 
                           </button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- search popup end -->

   <?php do_action( 'harry_newsletter_style' );?>

   <?php do_action( 'harry_offcanvas_style' );?>

    <!-- header start -->
    <?php do_action( 'harry_header_style' );?>
    <!-- header end -->
    
    <!-- wrapper-box start -->
    <?php do_action( 'harry_before_main_content' );?>