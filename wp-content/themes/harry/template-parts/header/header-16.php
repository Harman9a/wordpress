<?php 

	/**
	 * Template part for displaying header layout one
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
	 *
	 * @package harry
	*/

   // header styles
   $harry_transparent_header = get_theme_mod( 'harry_transparent_header', false );
   $is_it_transparent_header = function_exists('get_field') ? get_field('is_it_transparent_header') : '';


   // if transparent set from acf
   if($is_it_transparent_header && !$harry_transparent_header) :
      $harry_transparent_enable = 'header__transparent'; 
      $harry_transparent_logo = true;

   
   // if transparent set from acf
   elseif($is_it_transparent_header && $harry_transparent_header) :
      $harry_transparent_enable = '';
      $harry_transparent_logo = false;

   // style from customizer
   else :
      $harry_transparent_enable = $harry_transparent_header ? 'header__transparent' : '';
      $harry_transparent_logo = $harry_transparent_header ? true : false;
      
   endif;

    // contact button
	$harry_contact_button_text = get_theme_mod( 'harry_contact_button_text', __( 'Lets Talk', 'harry' ) );
    $harry_contact_button_link = get_theme_mod( 'harry_contact_button_link', __( '#', 'harry' ) );
    
    // header actions
    $harry_header_lang = get_theme_mod( 'harry_header_lang', false );
    $harry_header_search = get_theme_mod( 'harry_header_search', false );
    $harry_header_hamburger = get_theme_mod( 'harry_header_hamburger', false );

    // header right
    $harry_header_right = get_theme_mod( 'harry_header_right', false );
    $harry_menu_col = $harry_header_right ? 'col-xxl-8 col-xl-8 col-lg-9 d-none d-lg-block' : 'col-xxl-10 col-xl-10 col-lg-10 col-md-8 col-sm-7 col-4 text-end';

    $harry_sticky_switch = get_theme_mod( 'harry_sticky_switch', false );
    $enable_sticky = !empty($harry_sticky_switch) ? 'header__sticky' : '';
?>


      <!-- header area start -->
      <header>
         <div class="header__area header__simple <?php echo esc_attr($harry_transparent_enable); ?>">
            <div class="header__bottom <?php echo esc_attr($enable_sticky) ?>">
               <div class="container">
                  <div class="mega-menu-wrapper p-relative">
                     <div class="row align-items-center">
                        <div class="col-7">
                           <div class="logo">
                                <?php harry_header_logo();?>
                           </div>
                        </div>
                        <div class="col-5">
                           <div class="header__bottom-right d-flex justify-content-end align-items-center pl-30">
                              <div class="main-menu pl-55 main-menu-ff-space d-none">
                                 <nav id="mobile-menu">
                                    <?php harry_header_menu();?>
                                 </nav>

                                 <!-- for wp -->
                                 <div class="header__hamburger ml-50 d-none">
                                    <button type="button" class="hamburger-btn offcanvas-open-btn">
                                       <span></span>
                                       <span></span>
                                       <span></span>
                                    </button>
                                 </div>
                              </div>
                              <?php if ( !empty( $harry_header_right ) ): ?>
                              <div class="header__btn d-none d-md-block">

                                <a href="<?php echo esc_url($harry_contact_button_link); ?>" class="tp-btn tp-btn-black">
                                 <?php echo esc_html($harry_contact_button_text); ?>
                                 <span>
                                       <svg width="15" height="12" viewBox="0 0 15 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <path d="M13.4492 6.00007L1 6.00007" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                          <path d="M8.42969 1L13.4509 5.99958L8.42969 11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                       </svg>                                          
                                    </span>
                                </a>

                              </div>
                                <?php if ( !empty( $harry_header_hamburger ) ): ?>
                                <div class="header__hamburger ml-50 d-xl-none">
                                    <button type="button" class="hamburger-btn hamburger-btn-black offcanvas-open-btn">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </button>
                                </div>
                                <?php endif; ?>
                              <?php endif; ?>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </header>
      <!-- header area end -->
