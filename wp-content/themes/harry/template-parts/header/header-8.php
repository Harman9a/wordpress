<?php 

	/**
	 * Template part for displaying header layout three
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
	 *
	 * @package harry
	*/


   $harry_sticky_switch = get_theme_mod( 'harry_sticky_switch', false );
   $enable_sticky = !empty($harry_sticky_switch) ? 'header__sticky' : '';

   // header actions
   $harry_header_hamburger = get_theme_mod( 'harry_header_hamburger', false );
   $harry_header_hamburger_text = get_theme_mod( 'harry_header_hamburger_text', __( 'Intro', 'harry' ) );


   // header right
   $harry_search = get_theme_mod( 'harry_search', false );
   $harry_header_right = get_theme_mod( 'harry_header_right', false );
   $harry_menu_col = $harry_header_right ? 'col-xxl-7 col-xl-7 col-lg-8 d-none d-lg-block' : 'col-xxl-9 col-xl-9 col-lg-10 col-md-8 col-sm-7 col-4 text-end';
   $harry_header_hamburger_right = $harry_header_right ? '' : 'float-end';

   // social switch
   $harry_social_switch = get_theme_mod( 'harry_social_switch', false );

?>

      <!-- header area start -->
      <header>
         <div class="header__area">
            <div class="header__bottom-9 <?php echo esc_attr($enable_sticky) ?>" id="header-sticky">
               <div class="container">
                  <div class="mega-menu-wrapper p-relative">
                     <div class="row align-items-center">
                        <div class="col-xxl-3 col-xl-3 col-lg-2 col-md-4 col-sm-5 col-8">
                           <div class="logo">
                              <?php harry_header_logo();?>
                           </div>
                        </div>
                        <div class="<?php echo esc_attr($harry_menu_col); ?>">
                           <div class="main-menu main-menu-9 main-menu-ff-space">
                              <nav id="mobile-menu">
                                 <?php harry_header_menu();?>
                              </nav>

                              <!-- for wp -->
                              <div class="header__hamburger ml-50 d-lg-none">
                                 <button type="button"  class="hamburger-btn-8 hamburger-btn-8-black offcanvas-open-btn"><?php echo esc_html($harry_header_hamburger_text); ?></button>
                              </div>
                           </div>
                        </div>
                        <?php if ( !empty( $harry_header_right ) ): ?>
                        <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-8 col-sm-7 col-4">
                           <div class="header__bottom-right-8 d-flex justify-content-end align-items-center">
                              <?php if ( !empty( $harry_header_hamburger ) ): ?>
                              <div class="header__hamburger ml-50">
                                 <button type="button"  class="hamburger-btn-8 hamburger-btn-8-black offcanvas-open-btn"><?php echo esc_html($harry_header_hamburger_text); ?></button>
                              </div>
                              <?php endif; ?>
                           </div>
                        </div>
                        <?php endif; ?>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </header>
      <!-- header area end -->