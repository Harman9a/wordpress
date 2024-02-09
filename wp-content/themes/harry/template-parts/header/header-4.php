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
   $harry_menu_col = $harry_header_right ? 'col-xl-6 col-lg-7 d-none d-lg-block' : 'col-xl-10 col-lg-9 col-md-6 col-6 text-end';
   $harry_header_hamburger_right = $harry_header_right ? '' : 'float-end';

?>

      <!-- header area start -->
      <header>
         <div class="header__area header-box-plr-5-245 header__padding-5 header__style-5 <?php echo esc_attr($enable_sticky) ?> header-sticky-blur" id="header-sticky">
            <div class="header__gradient-bg"></div>
            <div class="header__top-5">
               <div class="mega-menu-wrapper p-relative">
                  <div class="container-fluid">
                     <div class="row align-items-center">
                        <div class="col-xxl-2 col-xl-2 col-lg-3 col-md-6 col-6">
                           <div class="logo">
                                <?php harry_header_logo();?>
                           </div>
                        </div>
                        <div class="<?php echo esc_attr($harry_menu_col); ?>">
                           <div class="main-menu main-menu-5 main-menu-ff-space">
                              <nav id="mobile-menu">
                                <?php harry_header_menu();?>
                              </nav>
                              <!-- for wp -->
                              <div class="header__hamburger header__hamburger-5 ml-50 d-lg-none">
                                 <button type="button" class="hamburger-btn hamburger-btn-blue hamburger-btn-black offcanvas-open-btn">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                 </button>
                              </div>
                           </div>
                        </div>

                        <?php if ( !empty( $harry_header_right ) ): ?>
                        <div class="col-xl-4 col-lg-2 col-md-6 col-6">
                           <div class="header__right-5 d-flex align-items-center justify-content-end">

                            <?php if ( !empty( $harry_phone_num ) ): ?>
                              <div class="header__call d-none d-xl-flex align-items-center">
                                 <div class="header__call-icon">
                                    <span>
                                       <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <path d="M24.964 20.596C24.964 21.028 24.868 21.472 24.664 21.904C24.46 22.336 24.196 22.744 23.848 23.128C23.26 23.776 22.612 24.244 21.88 24.544C21.16 24.844 20.38 25 19.54 25C18.316 25 17.008 24.712 15.628 24.124C14.248 23.536 12.868 22.744 11.5 21.748C10.12 20.74 8.812 19.624 7.564 18.388C6.328 17.14 5.212 15.832 4.216 14.464C3.232 13.096 2.44 11.728 1.864 10.372C1.288 9.004 1 7.696 1 6.448C1 5.632 1.144 4.852 1.432 4.132C1.72 3.4 2.176 2.728 2.812 2.128C3.58 1.372 4.42 1 5.308 1C5.644 1 5.98 1.072 6.28 1.216C6.592 1.36 6.868 1.576 7.084 1.888L9.868 5.812C10.084 6.112 10.24 6.388 10.348 6.652C10.456 6.904 10.516 7.156 10.516 7.384C10.516 7.672 10.432 7.96 10.264 8.236C10.108 8.512 9.88 8.8 9.592 9.088L8.68 10.036C8.548 10.168 8.488 10.324 8.488 10.516C8.488 10.612 8.5 10.696 8.524 10.792C8.56 10.888 8.596 10.96 8.62 11.032C8.836 11.428 9.208 11.944 9.736 12.568C10.276 13.192 10.852 13.828 11.476 14.464C12.124 15.1 12.748 15.688 13.384 16.228C14.008 16.756 14.524 17.116 14.932 17.332C14.992 17.356 15.064 17.392 15.148 17.428C15.244 17.464 15.34 17.476 15.448 17.476C15.652 17.476 15.808 17.404 15.94 17.272L16.852 16.372C17.152 16.072 17.44 15.844 17.716 15.7C17.992 15.532 18.268 15.448 18.568 15.448C18.796 15.448 19.036 15.496 19.3 15.604C19.564 15.712 19.84 15.868 20.14 16.072L24.112 18.892C24.424 19.108 24.64 19.36 24.772 19.66C24.892 19.96 24.964 20.26 24.964 20.596Z" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10"/>
                                          <path d="M20.7996 9.4C20.7996 8.68 20.2356 7.576 19.3956 6.676C18.6276 5.848 17.6076 5.2 16.5996 5.2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                          <path d="M24.9996 9.4C24.9996 4.756 21.2436 1 16.5996 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                       </svg>                                       
                                    </span>
                                 </div>
                                 <div class="header__call-content">
                                    <p><?php echo esc_html($harry_phone_title); ?></p>
                                    <h4><a href="tel:<?php echo esc_attr($harry_phone_num); ?>"><?php echo esc_html($harry_phone_num); ?></a></h4>
                                 </div>
                              </div>
                              <?php endif; ?>

                              <?php if ( !empty( $harry_contact_button_text ) ): ?>
                              <div class="header__btn-5 d-none d-xl-block ml-30">
                                 <a href="<?php echo esc_url($harry_contact_button_link); ?>" class="tp-btn-orange"><?php echo esc_html($harry_contact_button_text); ?></a>
                              </div>
                              <?php endif; ?>

                              <div class="header__hamburger header__hamburger-5 ml-50 d-xl-none">
                                 <button type="button" class="hamburger-btn hamburger-btn-blue hamburger-btn-black offcanvas-open-btn">
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