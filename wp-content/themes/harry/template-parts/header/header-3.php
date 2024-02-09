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
   $harry_menu_col = $harry_header_right ? 'col-xxl-7 col-xl-8 col-lg-8 d-none d-lg-block' : 'col-xxl-10 col-xl-10 col-lg-10 col-md-8 col-sm-7 col-4';
   $harry_header_hamburger_right = $harry_header_right ? '' : 'float-end';

?>

      <!-- header area start -->
      <header>
         <div class="header__area">
            <div class="header__bottom header__padding-2 header-box-plr-55 <?php echo esc_attr($enable_sticky) ?>" id="header-sticky">
               <div class="container-fluid">
                  <div class="row align-items-center">
                     <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-4 col-sm-5 col-8">
                        <div class="logo logo-2">
                           <?php harry_header_logo();?>
                        </div>
                     </div>
                     <div class="<?php echo esc_attr($harry_menu_col); ?>">
                        <div class="main-menu pl-55 main-menu-ff-space">
                           <nav id="mobile-menu-2">
                              <?php harry_header_menu();?>
                           </nav>
                           <!-- for wp -->
                           <div class="header__hamburger ml-20 d-lg-none <?php echo esc_attr($harry_header_hamburger_right); ?>">
                              <button type="button" class="hamburger-btn hamburger-btn-black offcanvas-open-btn">
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
                        <?php if ( !empty( $harry_header_hamburger ) ): ?>
                           <div class="header__intro">
                              <p><?php echo esc_html($harry_header_hamburger_text); ?></p>
                           </div>
                           <div class="header__hamburger header__hamburger-2">
                              <button type="button" class="hamburger-btn hamburger-btn-black offcanvas-open-btn">
                                 <span></span>
                                 <span></span>
                                 <span></span>
                              </button>
                           </div>
                           <?php endif; ?>
                        </div>
                     </div>
                     <?php endif; ?>
                  </div>
               </div>
            </div>
         </div>
      </header>
      <!-- header area end -->
