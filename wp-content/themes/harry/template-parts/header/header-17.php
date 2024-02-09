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
      <div class="header__area header__black <?php echo esc_attr($harry_transparent_enable); ?>">
         <div class="header__bottom header__bottom-border <?php echo esc_attr($enable_sticky) ?>" id="header-sticky">
            <div class="container">
               <div class="mega-menu-wrapper p-relative">
                  <div class="row align-items-center">
                     <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-4 col-sm-5 col-8">
                        <div class="logo logo-border">
                           <?php if($harry_transparent_logo == true) :?>
                              <?php harry_header_sticky_logo();?>
                           <?php else :?>
                              <?php harry_header_logo();?>
                           <?php endif; ?>
                        </div>
                     </div>
                     <div class="<?php echo esc_attr($harry_menu_col);?>">
                        <div class="main-menu pl-15 main-menu-ff-space d-flex d-lg-block align-item-center justify-content-end">
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
                     <div class="col-xxl-2 col-xl-2 col-lg-1 col-md-8 col-sm-7 col-4">
                        <div class="header__bottom-right d-flex justify-content-end align-items-center pl-30">
                           <div class="header__action d-none d-xl-block">
                              <ul>
                              <?php if ( !empty( $harry_header_search ) ): ?>
                                 <li>
                                    <button type="submit" class="search-open-btn">
                                       <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <path d="M9.55 18.1C14.272 18.1 18.1 14.272 18.1 9.55C18.1 4.82797 14.272 1 9.55 1C4.82797 1 1 4.82797 1 9.55C1 14.272 4.82797 18.1 9.55 18.1Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                          <path d="M19.0002 19.0002L17.2002 17.2002" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                       </svg>                                          
                                    </button>
                                 </li>
                                 <?php endif; ?>

                                 <?php if ( !empty( $harry_header_hamburger ) ): ?>
                                 <li>
                                    <button type="button"  class="hamburger-btn hamburger-btn-black offcanvas-open-btn">
                                       <span></span>
                                       <span></span>
                                       <span></span>
                                    </button>
                                 </li>
                                 <?php endif; ?>
                              </ul>
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
