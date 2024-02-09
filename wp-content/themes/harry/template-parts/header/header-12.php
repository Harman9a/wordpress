<?php 

	/**
	 * Template part for displaying header layout three
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
	 *
	 * @package harry
	*/

   // header styles
   $harry_topbar_switch = get_theme_mod( 'harry_topbar_switch', false );


   $harry_sticky_switch = get_theme_mod( 'harry_sticky_switch', false );
   $enable_sticky = !empty($harry_sticky_switch) ? 'header__sticky' : '';

    // header actions
    $harry_header_search = get_theme_mod( 'harry_header_search', false );
    $harry_header_login = get_theme_mod( 'harry_header_login', false );
    $harry_header_wishlist = get_theme_mod( 'harry_header_wishlist', false );
    $harry_header_cart = get_theme_mod( 'harry_header_cart', false );

	// header info
   $harry_mail_id = get_theme_mod( 'harry_mail_id', __( 'info@harry.com', 'harry' ) );
   $harry_phone_num = get_theme_mod( 'harry_phone_num', __( '+964 742 44 763', 'harry' ) );

   // contact button
	$harry_contact_button_text = get_theme_mod( 'harry_contact_button_text', __( 'Free Consultation', 'harry' ) );
   $harry_contact_button_link = get_theme_mod( 'harry_contact_button_link', __( '#', 'harry' ) );


   // header right
   $harry_search = get_theme_mod( 'harry_search', false );
   $harry_header_right = get_theme_mod( 'harry_header_right', false );
   $harry_header_hamburger = get_theme_mod( 'harry_header_hamburger', false );
   $harry_menu_col = $harry_header_right ? 'col-xxl-6 col-xl-7 d-none d-xl-block' : 'col-xxl-11 col-xl-10 col-lg-8 col-md-8 col-sm-7 col-4 text-end';
   $harry_header_hamburger_right = $harry_header_right ? '' : 'float-end';

   $is_it_transparent_header = function_exists('get_field') ? get_field('is_it_transparent_header') : '';

   if($is_it_transparent_header){
      $header_transparent = 'header__transparent';
      $header_bg_color = 'grey-bg-17';
   }else{
      $header_transparent = '';
      $header_bg_color = 'header__bottom-13-white';
   }

    

?>
   <!-- header area start -->
   <header>
      <div class="header__area <?php echo esc_attr($header_transparent); ?>">
         <div class="header__bottom-13 <?php echo esc_attr($header_bg_color); ?> header__padding-7  header__black-3 header__bottom-border-4 <?php echo esc_attr($enable_sticky) ?>" id="header-sticky">
            <div class="container-fluid">
               <div class="mega-menu-wrapper p-relative">
                  <div class="row align-items-center">
                     <div class="col-xxl-1 col-xl-2 col-lg-4 col-md-4 col-sm-5 col-8">
                        <div class="logo">
                           <?php harry_header_logo();?>
                        </div>
                     </div>
                     <div class="<?php echo esc_attr( $harry_menu_col); ?>">
                        <div class="main-menu main-menu-13 pl-45 main-menu-ff-space">
                           <nav id="mobile-menu-3">
                              <?php harry_header_menu();?>
                           </nav>
                           <!-- for wp -->
                           <div class="header__hamburger ml-50 d-xl-none">
                              <button type="button" class="hamburger-btn hamburger-btn-black offcanvas-open-btn">
                                 <span></span>
                                 <span></span>
                                 <span></span>
                              </button>
                           </div>
                        </div>
                     </div>

                     <?php if ( !empty( $harry_header_right ) ): ?>
                     <div class="col-xxl-5 col-xl-3 col-lg-8 col-md-8 col-sm-7 col-4">
                        <div class="header__bottom-right-13 d-flex justify-content-end align-items-center pl-30">

                        <?php if ( !empty( $harry_header_search ) ): ?>
                           <div class="header__search-13">
                              <form action="<?php print esc_url( home_url( '/' ) );?>">
                                 <div class="header__search-input-13 d-none d-xxl-block">
                                    <input type="text" placeholder="<?php print esc_attr__( 'Search for products...', 'harry' );?>" name="s" value="<?php print esc_attr( get_search_query() )?>">
                                    <button type="submit">
                                       <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <path d="M8.12492 15.2498C12.0599 15.2498 15.2498 12.0599 15.2498 8.12492C15.2498 4.18994 12.0599 1 8.12492 1C4.18994 1 1 4.18994 1 8.12492C1 12.0599 4.18994 15.2498 8.12492 15.2498Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                          <path d="M15.9999 16L14.4999 14.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                       </svg>                                             
                                    </button>
                                 </div>
                              </form>
                           </div>
                           <?php endif; ?>

                           <div class="header__action-13 d-none d-md-block">
                              <ul>

                                 <?php if ( !empty( $harry_header_search ) ): ?>
                                 <li class="d-xxl-none">
                                    <a href="javascript:void(0);" class="search-open-btn">
                                       <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <path d="M8.12492 15.2498C12.0599 15.2498 15.2498 12.0599 15.2498 8.12492C15.2498 4.18994 12.0599 1 8.12492 1C4.18994 1 1 4.18994 1 8.12492C1 12.0599 4.18994 15.2498 8.12492 15.2498Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                          <path d="M15.9999 16L14.4999 14.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                       </svg>                                           
                                    </a>
                                 </li>
                                 <?php endif; ?>


                                 <?php if ( !empty( $harry_header_login ) && class_exists( 'WooCommerce' )): ?>
                                 <li>
                                    <?php if (is_user_logged_in()): ?>
                                       <a href="<?php echo get_permalink(wc_get_page_id('myaccount')); ?>">
                                          <svg width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                             <path d="M17.0001 19V17C17.0001 15.9391 16.5787 14.9217 15.8285 14.1716C15.0784 13.4214 14.061 13 13.0001 13H5.00012C3.93926 13 2.92184 13.4214 2.17169 14.1716C1.42155 14.9217 1.00012 15.9391 1.00012 17V19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                             <path d="M9.00012 9C11.2093 9 13.0001 7.20914 13.0001 5C13.0001 2.79086 11.2093 1 9.00012 1C6.79098 1 5.00012 2.79086 5.00012 5C5.00012 7.20914 6.79098 9 9.00012 9Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                          </svg>                                           
                                       </a>
                                       <?php else : ?>
                                          <a href="<?php echo wp_logout_url(get_permalink(wc_get_page_id('myaccount'))) ?>">
                                       <i class="fas fa-user"></i>
                                    </a>
                                    <?php endif; ?>
                                 </li>
                                 <?php endif; ?>

                                 <?php 
                                 
                                 if(class_exists( 'WPCleverWoosw' ) && !empty($harry_header_wishlist)) :
                                    $wishlist_data = new WPCleverWoosw();
   
                                    $key = $wishlist_data::get_key();
                                    $products = $wishlist_data::get_ids( $key );
                                    $count    = count( $products );
                                 if ( !empty( $harry_header_wishlist ) ): 
                                 
                                 ?>
                                 <li>
                                    <a href="<?php echo esc_url( $wishlist_data::get_url( $key, true ) ); ?>">
                                       <svg width="23" height="20" viewBox="0 0 23 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <path d="M20.0461 2.59133C19.5419 2.08683 18.9431 1.68663 18.2842 1.41358C17.6252 1.14054 16.9189 1 16.2056 1C15.4923 1 14.786 1.14054 14.127 1.41358C13.468 1.68663 12.8693 2.08683 12.365 2.59133L11.3185 3.63785L10.272 2.59133C9.25342 1.57276 7.87194 1.00053 6.43146 1.00053C4.99098 1.00053 3.6095 1.57276 2.59092 2.59133C1.57235 3.6099 1.00012 4.99139 1.00012 6.43187C1.00012 7.87235 1.57235 9.25383 2.59092 10.2724L3.63745 11.3189L11.3185 19L18.9996 11.3189L20.0461 10.2724C20.5506 9.76814 20.9508 9.16942 21.2239 8.51045C21.4969 7.85148 21.6374 7.14517 21.6374 6.43187C21.6374 5.71857 21.4969 5.01225 21.2239 4.35328C20.9508 3.69431 20.5506 3.09559 20.0461 2.59133V2.59133Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                       </svg> 
                                       <span class="tp-item-count"><?php echo esc_html($count); ?></span>                                            
                                    </a>
                                 </li>
                                 <?php 
                                    endif; 
                                    endif;
                                 ?>

                                 <?php if ( !empty( $harry_header_cart ) && class_exists( 'WooCommerce' ) ): ?>
                                 <li>
                                    <button class="cartmini-open-btn">
                                       <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <path d="M7.85739 19C8.33077 19 8.71453 18.6163 8.71453 18.1429C8.71453 17.6695 8.33077 17.2857 7.85739 17.2857C7.384 17.2857 7.00024 17.6695 7.00024 18.1429C7.00024 18.6163 7.384 19 7.85739 19Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                          <path d="M17.286 19C17.7594 19 18.1431 18.6163 18.1431 18.1429C18.1431 17.6695 17.7594 17.2857 17.286 17.2857C16.8126 17.2857 16.4288 17.6695 16.4288 18.1429C16.4288 18.6163 16.8126 19 17.286 19Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                          <path d="M1.00012 1H4.42869L6.72584 12.4771C6.80422 12.8718 7.0189 13.2263 7.3323 13.4785C7.64571 13.7308 8.03786 13.8649 8.44012 13.8571H16.7716C17.1738 13.8649 17.566 13.7308 17.8794 13.4785C18.1928 13.2263 18.4075 12.8718 18.4858 12.4771L19.8573 5.28571H5.28584" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                       </svg>                                             
                                       <span id="tp-cart-item" class="tp-item-count cart__count"><?php echo esc_html(WC()->cart->cart_contents_count); ?></span>                                            
                                    </button>
                                 </li>
                                 <?php endif; ?>

                                 
                              </ul>
                           </div>

                           <?php if ( !empty( $harry_header_hamburger ) ): ?>
                           <div class="header__hamburger ml-30 d-xl-none">
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
      </div>
   </header>
   <!-- header area end -->

<?php if (class_exists( 'WooCommerce' ) ): ?>  
<?php print harry_shopping_cart(); ?>
<?php endif; ?>