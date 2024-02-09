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
    $harry_newsletter_title = get_theme_mod( 'harry_newsletter_title', __( 'Keep up with our daily and weekly newsletters', 'harry' ) );
    
    

    $harry_newsletter_switch = get_theme_mod( 'harry_newsletter_switch', false );

    $bg_img = !empty( $bg_img_from_page ) ? $bg_img_from_page['url'] : $bg_img;


    
  

?>


    <?php if(!empty($harry_newsletter_switch)) : ?>
      <!-- newsletter popup area start -->
      <div class="newsletter__area newsletter-popup">
         <div class="newsletter__wrapper">
            <div class="newsletter__close">
               <button type="button" class="newsletter__close-btn newsletter-close-btn">
                  <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                     <path d="M17 1L1 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                     <path d="M1 1L17 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>                     
               </button>
            </div>

            <div class="newsletter__thumb include-bg" data-background="<?php echo esc_url($bg_img); ?>"></div>

            <?php if(!empty($harry_newsletter_title)) : ?>
            <h3 class="newsletter__title"><?php echo harry_kses($harry_newsletter_title); ?></h3>
            <?php endif; ?>

            <?php if( !empty($mailchimp_shortcode) ): ?>
                <?php print do_shortcode($mailchimp_shortcode); ?>
			<?php endif; ?>
         </div>
      </div>
      <div class="newsletter-overlay"></div>
      <!-- newsletter popup area end -->
      <?php endif; ?>