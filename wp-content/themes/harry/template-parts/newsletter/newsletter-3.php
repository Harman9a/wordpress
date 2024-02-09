<?php 

	/**
	 * Template part for displaying header layout one
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
	 *
	 * @package harry
	*/

    // breadcrumb code
    $bg_img_from_page = function_exists('get_field') ? get_field('newsletter_background_image') : '';
    $newsletter_shortcode_from_page = function_exists('get_field') ? get_field('newsletter_shortcode') : '';

    $mailchimp_shortcode_customizer = get_theme_mod( 'harry_newsletter_mailchimp_shortcode', __( 'Your Shortcode here', 'harry' ) );

    $mailchimp_shortcode = !empty( $newsletter_shortcode_from_page ) ? $newsletter_shortcode_from_page : $mailchimp_shortcode_customizer;
    // get_theme_mod
    $bg_img = get_theme_mod( 'newsletter_bg_img');

	// header info
    $harry_newsletter_subtitle = get_theme_mod( 'harry_newsletter_subtitle', __( 'Harry Discount', 'harry' ) );
    $harry_newsletter_title = get_theme_mod( 'harry_newsletter_title', __( 'Keep up with our daily and weekly newsletters', 'harry' ) );
    $harry_newsletter_desc = get_theme_mod( 'harry_newsletter_desc', __( 'Subscribe now and receive a discount on', 'harry' ) );
    $mailchimp_shortcode = get_theme_mod( 'harry_newsletter_mailchimp_shortcode', __( 'Your Shortcode here', 'harry' ) );
    $harry_login_url = get_theme_mod( 'harry_login_url', __( '#', 'harry' ) );

    $harry_newsletter_switch = get_theme_mod( 'harry_newsletter_switch', false );
    // social switch
   $harry_newsletter_social_switch = get_theme_mod( 'harry_newsletter_social_switch', false );


    $bg_img = !empty( $bg_img_from_page ) ? $bg_img_from_page['url'] : $bg_img;

?>

    <?php if(!empty($harry_newsletter_switch)) : ?>
      <!-- newsletter popup area start -->
      <div class="newsletter__area newsletter__area-3 newsletter-popup">
         <div class="newsletter__wrapper newsletter__wrapper-3">
            <div class="newsletter__close newsletter__close-3">
               <button type="button" class="newsletter__close-btn newsletter__close-btn-3 newsletter-close-btn">
                  <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                     <path d="M17 1L1 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                     <path d="M1 1L17 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>                     
               </button>
            </div>
            <div class="newsletter__thumb newsletter__thumb-3 include-bg" data-background="<?php echo esc_url($bg_img); ?>"></div>

            <?php if(!empty($harry_newsletter_subtitle)) : ?>
            <span class="newsletter__title-pre"><?php echo esc_html($harry_newsletter_subtitle); ?></span>
            <?php endif; ?>

            <?php if(!empty($harry_newsletter_title)) : ?>
            <h3 class="newsletter__title-3"><?php echo harry_kses($harry_newsletter_title); ?></h3>
            <?php endif; ?>

            <?php if(!empty($harry_newsletter_desc)) : ?>
            <p><?php echo harry_kses($harry_newsletter_desc); ?></p>
            <?php endif; ?>

            <?php if( !empty($mailchimp_shortcode) ): ?>
                <?php print do_shortcode($mailchimp_shortcode); ?>
			<?php endif; ?>

            <?php if( !empty($harry_login_url) ): ?>
            <div class="newsletter__proposal">
               <p><a href="<?php echo esc_url($harry_login_url) ?>"><?php echo esc_html__('Signup', 'harry'); ?></a> <?php echo esc_html__('for Exclusive Updates', 'harry'); ?></p>
            </div>
            <?php endif; ?>

            <?php if ( !empty( $harry_newsletter_social_switch ) ): ?>
            <div class="newsletter__social">
                <?php harry_newsletter_social_profiles(); ?>
            </div>
            <?php endif; ?>
         </div>
      </div>
      <div class="newsletter-overlay"></div>
      <!-- newsletter popup area end -->
      <?php endif; ?>