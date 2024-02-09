<?php 

	/**
	 * Template part for displaying header layout one
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
	 *
	 * @package harry
	*/

    // breadcrumb code
    $bg_img_from_page = function_exists('get_field') ? get_field('breadcrumb_background_image',$_id) : '';
    $hide_bg_img = function_exists('get_field') ? get_field('hide_breadcrumb_background_image',$_id) : '';

    // get_theme_mod
    $bg_img = get_theme_mod( 'breadcrumb_bg_img');
    $bg_img_color = get_theme_mod( 'harry_breadcrumb_bg_color');
    $harry_breadcrumb_shape_switch = get_theme_mod( 'harry_breadcrumb_shape_switch', true );
    $breadcrumb_info_switch = get_theme_mod( 'breadcrumb_info_switch', true );

    if ( $hide_bg_img && empty($_GET['s']) ) {
        $bg_img = '';
    } else {
        $bg_img = !empty( $bg_img_from_page ) ? $bg_img_from_page['url'] : $bg_img;
    }?>

    <!-- breadcrumb area start -->
    <section class="breadcrumb__area pt-130 pb-115 breadcrumb__style-10 p-relative z-index-1 <?php print esc_attr( $breadcrumb_class );?>" data-bg-color="<?php echo esc_attr($bg_img_color); ?>">
        <div class="breadcrumb__bg-4 breadcrumb__bg-overlay m-img include-bg" data-background="<?php print esc_attr($bg_img);?>"></div>
        <div class="container">
            <div class="row justify-content-center">
            <?php if (!empty($breadcrumb_info_switch)) : ?>
                <div class="col-xl-10">
                    <div class="breadcrumb__content text-center">
                    <h3 class="breadcrumb__title"><?php echo wp_kses_post( $title ); ?></h3>
                    <div class="breadcrumb__list">
                            <?php if(function_exists('bcn_display')) {
                                bcn_display();
                            } ?>
                    </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <!-- breadcrumb area end -->

