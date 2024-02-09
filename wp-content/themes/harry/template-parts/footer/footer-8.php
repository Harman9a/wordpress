<?php 

/**
 * Template part for displaying footer layout four
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package harry
*/

$footer_bg_img = get_theme_mod( 'harry_footer_bg' );
$harry_footer_logo = get_theme_mod( 'harry_footer_logo' );
$harry_footer_top_space = function_exists('get_field') ? get_field('harry_footer_top_space') : '0';

$harry_footer_bg_url_from_page = function_exists( 'get_field' ) ? get_field( 'harry_footer_bg' ) : '';
$harry_footer_bg_color_from_page = function_exists( 'get_field' ) ? get_field( 'harry_footer_bg_color' ) : '';
$footer_bg_color = get_theme_mod( 'harry_footer_bg_color', '#050616' );


$harry_footer_bottom_menu = get_theme_mod( 'harry_footer_bottom_menu' );
$harry_copyright_center = $harry_footer_bottom_menu ? 'col-md-6' : 'col-md-12 text-center';

// bg image
$bg_img = !empty( $harry_footer_bg_url_from_page['url'] ) ? $harry_footer_bg_url_from_page['url'] : $footer_bg_img;

// bg color
$bg_color = !empty( $harry_footer_bg_color_from_page ) ? $harry_footer_bg_color_from_page : $footer_bg_color;


// footer_columns
$footer_columns = 0;
$footer_widgets = get_theme_mod( 'footer_widget_number', 4 );

for ( $num = 1; $num <= $footer_widgets; $num++ ) {
    if ( is_active_sidebar( 'footer-8-' . $num ) ) {
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
    $footer_class[1] = 'col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-7';
    $footer_class[2] = 'col-xxl-2 col-xl-2 col-lg-2 col-md-3 col-sm-5';
    $footer_class[3] = 'col-xxl-2 col-xl-2 col-lg-2 col-md-3 col-sm-5';
    $footer_class[4] = 'col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-7';
    break;
default:
    $footer_class = 'col-xl-3 col-lg-3 col-md-6';
    break;
}

?>



      <!-- footer area start -->
      <footer>
        <div class="footer__area include-bg" data-bg-color="<?php print esc_attr( $bg_color );?>" data-background="<?php print esc_url( $bg_img );?>">
            <?php if ( is_active_sidebar('footer-8-1') OR is_active_sidebar('footer-8-2') OR is_active_sidebar('footer-8-3') OR is_active_sidebar('footer-8-4') ): ?>
            <div class="footer__top">
               <div class="container">
                  <div class="row">
                        <?php
                            if ( $footer_columns < 5 ) {
                            print '<div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6">';
                            dynamic_sidebar( 'footer-8-1' );
                            print '</div>';

                            print '<div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6">';
                            dynamic_sidebar( 'footer-8-2' );
                            print '</div>';

                            print '<div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6">';
                            dynamic_sidebar( 'footer-8-3' );
                            print '</div>';

                            print '<div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6">';
                            dynamic_sidebar( 'footer-8-4' );
                            print '</div>';
                            } else {
                                for ( $num = 1; $num <= $footer_columns; $num++ ) {
                                    if ( !is_active_sidebar( 'footer-8-' . $num ) ) {
                                        continue;
                                    }
                                    print '<div class="' . esc_attr( $footer_class[$num] ) . '">';
                                    dynamic_sidebar( 'footer-8-' . $num );
                                    print '</div>';
                                }
                            }
                        ?>
                  </div>
               </div>
            </div>
            <?php endif; ?>
            <div class="footer__bottom-10 footer__bottom-line">
               <div class="container">
                  <div class="footer__bottom-inner-10">
                     <div class="row">
                        <div class="<?php echo esc_attr($harry_copyright_center); ?>">
                           <div class="footer__copyright-10">
                              <p><?php print harry_copyright_text(); ?></p>
                           </div>
                        </div>
                        <?php if ( !empty( $harry_footer_bottom_menu ) ): ?>
                        <div class="col-md-6">
                           <div class="footer__link-10 text-md-end">
                                <?php echo harry_kses($harry_footer_bottom_menu); ?>
                           </div>
                        </div>
                        <?php endif; ?>
                     </div>
                  </div>
               </div>
            </div>
        </div>
      </footer>
      <!-- footer area end -->