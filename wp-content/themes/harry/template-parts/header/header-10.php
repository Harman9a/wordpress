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
   $harry_header_search = get_theme_mod( 'harry_header_search', false );


   // header info
   $harry_mail_id = get_theme_mod( 'harry_mail_id', __( 'info@harry.com', 'harry' ) );

   // header right
   $harry_search = get_theme_mod( 'harry_search', false );
   $harry_header_right = get_theme_mod( 'harry_header_right', false );
   $harry_menu_col = $harry_header_right ? 'col-xxl-6 col-xl-8 col-lg-8 d-none d-lg-block' : 'col-xxl-10 col-xl-10 col-lg-10 col-md-8 col-sm-7 col-4 text-end';
   $harry_header_hamburger_right = $harry_header_right ? '' : 'float-end';

    

?>

      <!-- header area start -->
      <header>
         <div class="header__area header__transparent">
            <div class="header__bottom-11 header__white">
               <div class="mega-menu-wrapper p-relative">
                  <div class="container-fluid">
                     <div class="row align-items-center">
                        <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-4 col-sm-5 col-8">
                           <div class="logo">
                              <?php harry_header_logo();?>
                           </div>
                        </div>
                        <div class="<?php echo esc_attr($harry_menu_col); ?>">
                           <div class="main-menu main-menu-11 main-menu-ff-syne">
                              <nav id="mobile-menu">
                                 <?php harry_header_menu();?>
                              </nav>
                              <!-- for wp -->
                              <div class="header__hamburger ml-50 d-lg-none">
                                 <button type="button" class="hamburger-btn hamburger-btn-black offcanvas-open-btn">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                 </button>
                              </div>
                           </div>
                        </div>

                        <?php if ( !empty( $harry_header_right ) ): ?>
                        <div class="col-xxl-4 col-xl-2 col-lg-2 col-md-8 col-sm-7 col-4">
                           <div class="header__bottom-right-8 d-flex justify-content-end align-items-center">
                              <div class="header__info-8 header__info-11 mr-90 d-none d-xxl-block">
                                 <ul>
                                    <?php if ( !empty( $harry_mail_id ) ): ?>	
                                    <li>
                                       <span>
                                          <a href="mailto:<?php echo esc_attr($harry_mail_id); ?>">
                                             <span>
                                                <svg width="16" height="14" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                   <path d="M11.5 12.9H4.5C2.4 12.9 1 11.85 1 9.4V4.5C1 2.05 2.4 1 4.5 1H11.5C13.6 1 15 2.05 15 4.5V9.4C15 11.85 13.6 12.9 11.5 12.9Z" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                                   <path d="M11.5 4.85059L9.309 6.60059C8.588 7.17459 7.405 7.17459 6.684 6.60059L4.5 4.85059" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                             </span>
                                             <?php echo esc_html($harry_mail_id); ?>
                                          </a>
                                       </span>
                                    </li>
                                    <?php endif; ?>
                                 </ul>
                              </div>
                              <div class="header__action-8 header__action-11 d-none d-xl-block">
                                 <ul>

                                    <?php if ( !empty( $harry_header_search ) ): ?>	
                                    <li>
                                       <a href="javascript:void(0);" class="search-open-btn">
                                          <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                             <path d="M8.6 16.2C12.7974 16.2 16.2 12.7974 16.2 8.6C16.2 4.40264 12.7974 1 8.6 1C4.40264 1 1 4.40264 1 8.6C1 12.7974 4.40264 16.2 8.6 16.2Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                             <path d="M17.0004 17L15.4004 15.4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                          </svg>                                                                                   
                                       </a>
                                    </li>
                                    <?php endif; ?>

                                    <?php if ( !empty( $harry_header_hamburger) ): ?>
                                    <li>
                                       <button type="button"  class="hamburger-btn hamburger-btn-text  offcanvas-open-btn" data-menu-text="<?php echo esc_attr($harry_header_hamburger_text); ?>">
                                          <span></span>
                                          <span></span>
                                          <span></span>
                                       </button>
                                    </li>
                                    <?php endif; ?>

                                 </ul>
                              </div>
                              <div class="header__hamburger ml-50 d-xl-none">
                                 <button type="button"  class="hamburger-btn hamburger-btn-text  offcanvas-open-btn" data-menu-text="menu">
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