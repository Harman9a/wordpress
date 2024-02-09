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

	// header info 
    $harry_phone_title = get_theme_mod( 'harry_phone_title', __( 'Call us:', 'harry' ) );
    $harry_phone_num = get_theme_mod( 'harry_phone_num', __( '+964 742 44 763', 'harry' ) );

    // contact button
   $harry_contact_button_text = get_theme_mod( 'harry_contact_button_text', __( 'Start a project', 'harry' ) );
   $harry_contact_button_link = get_theme_mod( 'harry_contact_button_link', __( '#', 'harry' ) );

   // header actions
   $harry_header_hamburger = get_theme_mod( 'harry_header_hamburger', false );
   $harry_header_hamburger_text = get_theme_mod( 'harry_header_hamburger_text', __( 'Intro', 'harry' ) );

   // header right
   $harry_search = get_theme_mod( 'harry_search', false );
   $harry_header_right = get_theme_mod( 'harry_header_right', false );
   $harry_menu_col = $harry_header_right ? 'col-xxl-6 col-xl-8 col-lg-8 d-none d-lg-block text-center' : 'col-xxl-9 col-xl-10 col-lg-10 col-md-8 col-sm-7 col-4 text-end';
   $harry_header_hamburger_right = $harry_header_right ? '' : 'float-end';

   // social switch
   $harry_social_switch = get_theme_mod( 'harry_social_switch', false );

?>

      <!-- header area start -->
      <header>
         <div class="header__area">
            <div class="header__bottom header__bottom-3 header__border-3 header-box-plr-245 <?php echo esc_attr($enable_sticky) ?> header__sticky-black" id="header-sticky">
               <div class="container-fluid">
                  <div class="mega-menu-wrapper p-relative">
                     <div class="row align-items-center">
                        <div class="col-xxl-3 col-xl-2 col-lg-2 col-md-4 col-sm-5 col-8">
                           <div class="logo">
                              <?php harry_header_logo();?>
                           </div>
                        </div>
                        <div class="<?php echo esc_attr($harry_menu_col); ?>">
                           <div class="main-menu main-menu-2 main-menu-3 main-menu-ff-space">
                              <nav id="mobile-menu">
                                 <?php harry_header_menu();?>
                              </nav>
                              <!-- for wp -->
                              <div class="header__hamburger ml-50 d-lg-none">
                                 <button type="button" class="hamburger-btn offcanvas-open-btn">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                 </button>
                              </div>
                           </div>
                        </div>

                        <?php if ( !empty( $harry_header_right ) ): ?>
                        <div class="col-xxl-3 col-xl-2 col-lg-2 col-md-8 col-sm-7 col-4">
                           <div class="header__bottom-right d-flex justify-content-end align-items-center pl-30">

                              <?php if ( !empty( $harry_social_switch ) ): ?>
                              <div class="header__social d-none d-xl-block">
                                 <?php harry_header_social_profiles(); ?>
                              </div>
                              <?php endif; ?>

                              <?php if ( !empty( $harry_contact_button_text ) ): ?>
                              <div class="header__btn d-none d-lg-block">
                                 <a href="<?php echo esc_url($harry_contact_button_link); ?>" class="tp-header-btn"><?php echo esc_html($harry_contact_button_text); ?></a>
                              </div>
                              <?php endif; ?>

                              <div class="header__hamburger ml-50 d-lg-none">
                                 <button type="button" class="hamburger-btn offcanvas-open-btn">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                 </button>
                              </div>
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