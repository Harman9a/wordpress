<?php 

/**
 * Template part for displaying footer layout one
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package harry
*/

$footer_bg_img = get_theme_mod( 'harry_footer_bg' );
$harry_footer_logo = get_theme_mod( 'harry_footer_logo' );
$harry_footer_top_space = function_exists('get_field') ? get_field('harry_footer_top_space') : '0';

$harry_footer_bottom_menu = get_theme_mod( 'harry_footer_bottom_menu' );


$harry_footer_bg_url_from_page = function_exists( 'get_field' ) ? get_field( 'harry_footer_bg' ) : '';
$harry_footer_bg_color_from_page = function_exists( 'get_field' ) ? get_field( 'harry_footer_bg_color' ) : '';
$footer_bg_color = get_theme_mod( 'harry_footer_bg_color', '#1D1D4D' );
$footer_gradient_color = get_theme_mod( 'harry_color_footer_gradient', '' );

// social switch
$harry_footer_social_switch = get_theme_mod( 'harry_footer_social_switch', false );
$harry_copyright_center = $harry_footer_social_switch ? 'col-sm-6' : 'col-sm-12 text-center';

// bg image
$bg_img = !empty( $harry_footer_bg_url_from_page['url'] ) ? $harry_footer_bg_url_from_page['url'] : $footer_bg_img;

// bg color
$bg_color = !empty( $harry_footer_bg_color_from_page ) ? $harry_footer_bg_color_from_page : $footer_bg_color;

// footer_columns
$footer_columns = 0;
$footer_widgets = get_theme_mod( 'footer_widget_number', 4 );

for ( $num = 1; $num <= $footer_widgets; $num++ ) {
    if ( is_active_sidebar( 'footer-' . $num ) ) {
        $footer_columns++;
    }
}

switch ( $footer_columns ) {
case '1':
    $footer_class[1] = 'col-lg-12';
    break;
case '2':
    $footer_class[1] = 'col-lg-6 col-md-6';
    $footer_class[2] = 'col-lg-6 col-md-6';
    break;
case '3':
    $footer_class[1] = 'col-xl-4 col-lg-6 col-md-5';
    $footer_class[2] = 'col-xl-4 col-lg-6 col-md-7';
    $footer_class[3] = 'col-xl-4 col-lg-6';
    break;
case '4':
    $footer_class[1] = 'col-lg-3 col-md-6 col-sm-7';
    $footer_class[2] = 'col-lg-3 col-md-3 col-sm-5';
    $footer_class[3] = 'col-lg-3 col-md-3 col-sm-5';
    $footer_class[4] = 'col-lg-3 col-md-6 col-sm-7';
    break;
default:
    $footer_class = 'col-xl-3 col-lg-3 col-md-6';
    break;
}

?>
      <!-- footer area start -->
      <footer>
         <div class="footer__area" data-bg-color="<?php print esc_attr( $bg_color );?>" data-background="<?php print esc_url( $bg_img );?>">
         
            <div class="footer__top footer__top-9">
               <div class="container">
                  <div class="footer__top-9-inner">
                     <div class="row align-items-center">
                        <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-4">
                           <div class="footer__widget footer__widget-9">
                              <div class="footer__logo">
                                <?php harry_footer_logo();?>
                              </div>
                           </div>
                        </div>
                        <div class="col-xxl-9 col-xl-9 col-lg-6 col-md-8">
                           <div class="footer__widget footer__widget-9">
                              <div class="footer__widget-content">
                                 <?php harry_footer_menu(); ?>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="footer__bottom-9">
               <span data-bg="<?php print esc_attr( $footer_gradient_color );?>" class="tp-footer-gradient-line"></span>
               <div class="container">
                  <div class="row align-items-center">
                     <div class="<?php echo esc_attr($harry_copyright_center); ?>">
                        <div class="footer__copyright-9">
                           <p> <?php print harry_copyright_text(); ?></p>
                        </div>
                     </div>
                     <?php if ( !empty( $harry_footer_social_switch ) ): ?>
                     <div class="col-sm-6">
                        <div class="footer__social-9 text-sm-end">
                            <?php harry_footer_social_profiles(); ?>
                        </div>
                     </div>
                     <?php endif; ?>
                  </div>
               </div>
            </div>
         </div>
      </footer>
      <!-- footer area end -->