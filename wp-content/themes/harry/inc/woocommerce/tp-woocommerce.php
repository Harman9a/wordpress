<?php

// shop page hooks
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

// content-product hooks--
// action remove
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

remove_action('woocommerce_single_product_summary','woocommerce_template_single_price',10);
remove_action('woocommerce_single_product_summary','woocommerce_template_single_excerpt',20);
add_action('woocommerce_single_product_summary','woocommerce_template_single_excerpt',10);
add_action('woocommerce_single_product_summary','woocommerce_template_single_price',20);

// compare_false
add_filter( 'woosc_button_position_archive', '__return_false' );
add_filter( 'woosc_button_position_single', '__return_false' );

// wishlist false
add_filter( 'woosw_button_position_archive', '__return_false' );
add_filter( 'woosw_button_position_single', '__return_false' );



/*************************************************
## Free shipping progress bar.
*************************************************/
function harry_shipping_progress_bar() {
        
        $total           = WC()->cart->get_displayed_subtotal();
        $limit           = get_theme_mod( 'shipping_progress_bar_amount' );
        $percent         = 100;


        if ( $total < $limit ) {
            $percent = floor( ( $total / $limit ) * 100 );
            $message = str_replace( '[remainder]', wc_price( $limit - $total ), get_theme_mod( 'shipping_progress_bar_message_initial') );
        } else {
            $message = get_theme_mod( 'shipping_progress_bar_message_success' );
        }
        
    ?>
    
    <div class="tp-free-progress-bar">
        <div class="free-shipping-notice">
            <?php echo wp_kses( $message, 'post' ); ?>
        </div>
        <div class="tp-progress-bar">
            <span class="progress progress-bar progress-bar-striped progress-bar-animated" data-width="<?php echo esc_attr( $percent ); ?>%"></span>
        </div>
    </div>
            
    <?php
}
    
if(get_theme_mod( 'shipping_progress_bar_location_card_page',0) == '1'){
    add_action( 'woocommerce_before_cart_table',  'harry_shipping_progress_bar' );
}

if(get_theme_mod( 'shipping_progress_bar_location_mini_cart',0) == '1'){
    add_action( 'woocommerce_before_mini_cart_contents', 'harry_shipping_progress_bar' );
}

if(get_theme_mod( 'shipping_progress_bar_location_checkout',0) == '1'){
    add_action( 'woocommerce_checkout_before_customer_details', 'harry_shipping_progress_bar' );
}


/*************************************************
## sale percentage
*************************************************/

function harry_sale_percentage(){
   global $product;
   $output = '';

   if ( $product->is_on_sale() && $product->is_type( 'variable' ) ) {
      $percentage = ceil(100 - ($product->get_variation_sale_price() / $product->get_variation_regular_price( 'min' )) * 100);
      $output .= '<div class="product-percentage-badges"><span class="product__details-offer">'.$percentage.'%</span></div>';
   } elseif( $product->is_on_sale() && $product->get_regular_price()  && !$product->is_type( 'grouped' )) {
      $percentage = ceil(100 - ($product->get_sale_price() / $product->get_regular_price()) * 100);
      $output .= '<div class="product-percentage-badges">';
      $output .= '<span class="product__details-offer">'.$percentage.'%</span>';
      $output .= '</div>';
   }
   return $output;
}


// woocommerce mini cart content
add_filter('woocommerce_add_to_cart_fragments', function ($fragments) {
    ob_start();
    ?>
    <div class="mini_shopping_cart_box">
        <?php woocommerce_mini_cart(); ?>
    </div>
    <?php $fragments['.mini_shopping_cart_box'] = ob_get_clean();
    return $fragments;
});

// woocommerce mini cart count icon
if ( ! function_exists( 'harry_header_add_to_cart_fragment' ) ) {
    function harry_header_add_to_cart_fragment( $fragments ) {
        ob_start();
        ?>
        <span class="cart__count" id="tp-cart-item">
            <?php echo esc_html( WC()->cart->cart_contents_count ); ?>
        </span>
        <?php
        $fragments['#tp-cart-item'] = ob_get_clean();

        return $fragments;
    }
}
add_filter( 'woocommerce_add_to_cart_fragments', 'harry_header_add_to_cart_fragment' );

// harry_shopping_cart
function harry_shopping_cart(){
    ob_start();
    ?>
    <div class="cartmini__area">
        <div class="cartmini__wrapper">
            <div class="cartmini__top-wrapper">
               <div class="cartmini__top p-relative">
                  <div class="cartmini__title">
                     <h4>S<?php print esc_html__('Shopping cart','harry'); ?></h4>
                  </div>
                  <div class="cartmini__close">
                     <button type="button" class="cartmini__close-btn cartmini-close-btn"><i class="fal fa-times"></i></button>
                  </div>
               </div>
               <div class="cartmini__widget">
                    <div class="mini_shopping_cart_box"><?php woocommerce_mini_cart(); ?></div>
               </div>
               <!-- for wp -->
            </div>
        </div>

        <div class="header-mini-cart"></div>
    </div>
    <?php
    return ob_get_clean();
}


// product-content archive
if( !function_exists('harry_content_product_grid') ) {
    function harry_content_product_grid( ) {
        global $product;
        global $post;
        global $woocommerce;
        $rating = wc_get_rating_html($product->get_average_rating());
        $ratingcount = $product->get_review_count();
        ?>

        <div class="product__item p-relative transition-3 mb-50">
            <?php if( has_post_thumbnail() ) : ?>
              <div class="product__thumb w-img p-relative fix">

                 <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail(); ?>
                 </a>

                 <?php if( $product->is_on_sale()) : ?>
                 <div class="product__badge d-flex flex-column flex-wrap">
                    <?php woocommerce_show_product_loop_sale_flash(); ?>
                 </div>
                 <?php endif; ?>

                 <div class="product__action d-flex flex-column flex-wrap">
                 <?php if( function_exists( 'woosw_init' )) : ?>
                    <div class="product-action-btn product-add-wishlist-btn">
                         <?php echo do_shortcode('[woosw]'); ?>
                         <span class="product-action-tooltip"><?php echo esc_html__('Add To Wishlist','harry'); ?></span>
                    </div>
                    <?php endif; ?>

                    <?php if( class_exists( 'WPCleverWoosq' )) : ?>
                    <div class="product-action-btn">
                        <?php echo do_shortcode('[woosq]'); ?> 
                       <span class="product-action-tooltip"><?php echo esc_html__('Quick view','harry'); ?></span>
                    </div>
                    <?php endif; ?>
                     <?php if( function_exists( 'woosc_init' )) : ?>
                    <div class="product-action-btn">
                       <?php echo do_shortcode('[woosc]');?>                                       
                       <span class="product-action-tooltip"> <?php echo esc_html__('Add To Compare','harry'); ?></span>
                    </div>
                    <?php endif; ?>
                 </div>
                 <div class="product__add transition-3">
                    <div class="product-add-cart-btn w-100">
                       <?php  woocommerce_template_loop_add_to_cart();?>
                    </div>
                 </div>

              </div>
              <?php endif; ?>
              <div class="product__content">
                  <?php if( !empty($rating)) : ?>
                 <div class="product__rating d-flex mb-10">
                    <?php echo harry_kses($rating); ?> 
                 </div>
                 <?php endif; ?>

                 <h3 class="product__title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                 </h3>
                 <div class="product__price">
                    <?php echo woocommerce_template_loop_price();?>
                 </div>
              </div>
        </div>
        <?php
    }
}
add_action( 'woocommerce_before_shop_loop_item', 'harry_content_product_grid', 10 );


// product-content
if( !function_exists('harry_content_product_list') ) {
    function harry_content_product_list( ) {
        global $product;
        global $post;
        global $woocommerce;
        $rating = wc_get_rating_html($product->get_average_rating());
        $ratingcount = $product->get_review_count();
        ?>


          <div class="product__list-item mb-30">
             <div class="row">
                <?php if( has_post_thumbnail() ) : ?>
                <div class="col-xl-5 col-lg-5">
                   <div class="product__thumb product__list-thumb p-relative fix m-img">
                     <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail(); ?>
                     </a>
                     <?php if( $product->is_on_sale()) : ?>
                     <div class="product__badge d-flex flex-column flex-wrap">
                        <?php woocommerce_show_product_loop_sale_flash(); ?>
                     </div>
                     <?php endif; ?>
                   </div>
                </div>
                <?php endif; ?>
                <div class="col-xl-7 col-lg-7">
                   <div class="product__list-content">
                      <div class="product__rating product__rating-2 d-flex">
                         <?php echo harry_kses($rating); ?>
                      </div>

                      <h3 class="product__list-title">
                         <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                      </h3>
                      <div class="product__list-price">
                         <?php echo woocommerce_template_loop_price();?>
                      </div>
                      <div class="product__list-desc">
                        <?php the_excerpt(); ?>
                      </div>

                      <div class="product__list-action d-flex flex-wrap align-items-center">
                         <div class="product-add-cart-btn product-add-cart-btn-2">
                            <?php  woocommerce_template_loop_add_to_cart();?>
                         </div>

                         <?php if( function_exists( 'woosw_init' )) : ?>
                         <div class="product-action-btn product-action-btn-2 product-add-wishlist-btn">
                            <?php echo do_shortcode('[woosw]'); ?>                                  
                            <span class="product-action-tooltip"><?php echo esc_html__('Add To Wishlist','harry'); ?></span>
                         </div>
                         <?php endif; ?>

                         <?php if( class_exists( 'WPCleverWoosq' )) : ?>
                         <div class="product-action-btn">
                            <?php echo do_shortcode('[woosq]'); ?>
                            <span class="product-action-tooltip"><?php echo esc_html__('Quick view','harry'); ?></span>
                         </div>
                         <?php endif; ?>

                         <?php if( function_exists( 'woosc_init' )) : ?>
                        <div class="product-action-btn product-action-btn-2">
                        <?php echo do_shortcode('[woosc]');?>                                       
                            <span class="product-action-tooltip"> <?php echo esc_html__('Add To Compare','harry'); ?></span>
                        </div>
                        <?php endif; ?>                         
                      </div>
                   </div>
                </div>
             </div>
          </div>

        <?php
    }
}
add_action( 'woocommerce_before_shop_loop_item_list', 'harry_content_product_list', 10 );

// smart quickview
add_filter( 'woosq_button_html', 'gharry_woosq_button_html', 10, 2 );
function gharry_woosq_button_html( $output , $prodid ) {
    return $output = '<a href="#" class="icon-btn woosq-btn woosq-btn-' . esc_attr( $prodid ) . ' ' . get_option( 'woosq_button_class' ) . '" data-id="' . esc_attr( $prodid ) . '" data-effect="mfp-3d-unfold"><svg width="19" height="16" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg">
   <path d="M9.49943 5.34978C8.23592 5.34978 7.20896 6.37595 7.20896 7.63732C7.20896 8.89774 8.23592 9.92296 9.49943 9.92296C10.7629 9.92296 11.7908 8.89774 11.7908 7.63732C11.7908 6.37595 10.7629 5.34978 9.49943 5.34978M9.49941 11.3456C7.45025 11.3456 5.78394 9.68213 5.78394 7.63738C5.78394 5.59169 7.45025 3.92725 9.49941 3.92725C11.5486 3.92725 13.2158 5.59169 13.2158 7.63738C13.2158 9.68213 11.5486 11.3456 9.49941 11.3456" fill="currentColor"/>
   
   <path d="M1.49145 7.63683C3.25846 11.5338 6.23484 13.8507 9.50001 13.8517C12.7652 13.8507 15.7416 11.5338 17.5086 7.63683C15.7416 3.7408 12.7652 1.42386 9.50001 1.42291C6.23579 1.42386 3.25846 3.7408 1.49145 7.63683V7.63683ZM9.50173 15.2742H9.49793H9.49698C5.56775 15.2714 2.03943 12.5219 0.0577129 7.91746C-0.0192376 7.73822 -0.0192376 7.53526 0.0577129 7.35601C2.03943 2.75248 5.5687 0.00306822 9.49698 0.000223018C9.49888 -0.000725381 9.49888 -0.000725381 9.49983 0.000223018C9.50173 -0.000725381 9.50173 -0.000725381 9.50268 0.000223018C13.4319 0.00306822 16.9602 2.75248 18.942 7.35601C19.0199 7.53526 19.0199 7.73822 18.942 7.91746C16.9612 12.5219 13.4319 15.2714 9.50268 15.2742H9.50173Z" fill="currentColor"/>

   </svg></a>';
}



// product add to cart button
function woocommerce_template_loop_add_to_cart( $args = array() ) {
    global $product;

        if ( $product ) {
            $defaults = array(
                'quantity'   => 1,
                'class'      => implode(
                    ' ',
                    array_filter(
                        array(
                            'cart-button icon-btn button',
                            'product_type_' . $product->get_type(),
                            $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                            $product->supports( 'ajax_add_to_cart' ) && $product->is_purchasable() && $product->is_in_stock() ? 'ajax_add_to_cart' : '',
                        )
                    )
                ),
                'attributes' => array(
                    'data-product_id'  => $product->get_id(),
                    'data-product_sku' => $product->get_sku(),
                    'aria-label'       => $product->add_to_cart_description(),
                    'rel'              => 'nofollow',
                ),
            );

            $args = wp_parse_args( $args, $defaults );

            if ( isset( $args['attributes']['aria-label'] ) ) {
                $args['attributes']['aria-label'] = wp_strip_all_tags( $args['attributes']['aria-label'] );
            }
        }


         // check product type 
         if( $product->is_type( 'simple' ) ){
            $btntext = esc_html__("Add to Cart",'harry');
         } elseif( $product->is_type( 'variable' ) ){
            $btntext = esc_html__("Select Options",'harry');
         } elseif( $product->is_type( 'external' ) ){
            $btntext = esc_html__("Buy Now",'harry');
         } elseif( $product->is_type( 'grouped' ) ){
            $btntext = esc_html__("View Products",'harry');
         }
         else{
            $btntext = esc_html__("Add to Cart",'harry');
         } 

        echo sprintf( '<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
            esc_url( $product->add_to_cart_url() ),
            esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
            esc_attr( isset( $args['class'] ) ? $args['class'] : 'cart-button icon-btn button' ),
            isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
            '<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M3.54431 4.80484L4.08701 11.2487C4.12661 11.7447 4.53251 12.1167 5.02841 12.1167H5.03201H14.8519H14.8537C15.3227 12.1167 15.7232 11.7681 15.7898 11.3053L16.6448 5.41221C16.6646 5.27205 16.6295 5.13189 16.544 5.01868C16.4594 4.90457 16.3352 4.8309 16.1948 4.81113C16.0067 4.81832 8.20092 4.80754 3.54431 4.80484ZM5.02647 13.4642C3.84117 13.4642 2.83766 12.5405 2.74136 11.359L1.91696 1.57098L0.560653 1.33738C0.192551 1.27269 -0.0531497 0.924974 0.00985058 0.557495C0.0746508 0.190017 0.430152 -0.0489788 0.790154 0.00852392L2.66216 0.331977C2.96366 0.384987 3.19316 0.634765 3.21926 0.940248L3.43076 3.45689C16.2792 3.46228 16.3206 3.46857 16.3827 3.47576C16.884 3.54854 17.325 3.80999 17.6256 4.21251C17.9262 4.61413 18.0522 5.1092 17.9802 5.60516L17.1261 11.4974C16.965 12.6187 15.9894 13.4642 14.8554 13.4642H14.8509H5.03367H5.02647Z" fill="currentColor"/>
            <path fill-rule="evenodd" clip-rule="evenodd" d="M13.4079 8.12567H10.9131C10.5396 8.12567 10.2381 7.82379 10.2381 7.45181C10.2381 7.07984 10.5396 6.77795 10.9131 6.77795H13.4079C13.7805 6.77795 14.0829 7.07984 14.0829 7.45181C14.0829 7.82379 13.7805 8.12567 13.4079 8.12567Z" fill="currentColor"/>
            <path fill-rule="evenodd" clip-rule="evenodd" d="M4.63943 15.9048C4.91033 15.9048 5.12903 16.1235 5.12903 16.3944C5.12903 16.6653 4.91033 16.8849 4.63943 16.8849C4.36763 16.8849 4.14893 16.6653 4.14893 16.3944C4.14893 16.1235 4.36763 15.9048 4.63943 15.9048Z" fill="currentColor"/>
            <path fill-rule="evenodd" clip-rule="evenodd" d="M4.63859 16.2097C4.53689 16.2097 4.45409 16.2925 4.45409 16.3942C4.45409 16.5985 4.82399 16.5985 4.82399 16.3942C4.82399 16.2925 4.74029 16.2097 4.63859 16.2097ZM4.6386 17.5569C3.996 17.5569 3.474 17.0349 3.474 16.3933C3.474 15.7518 3.996 15.2307 4.6386 15.2307C5.28121 15.2307 5.80411 15.7518 5.80411 16.3933C5.80411 17.0349 5.28121 17.5569 4.6386 17.5569Z" fill="currentColor"/>
            <path fill-rule="evenodd" clip-rule="evenodd" d="M14.7918 15.9048C15.0627 15.9048 15.2823 16.1235 15.2823 16.3944C15.2823 16.6653 15.0627 16.8849 14.7918 16.8849C14.52 16.8849 14.3013 16.6653 14.3013 16.3944C14.3013 16.1235 14.52 15.9048 14.7918 15.9048Z" fill="currentColor"/>
            <path fill-rule="evenodd" clip-rule="evenodd" d="M14.7906 16.2098C14.6898 16.2098 14.607 16.2926 14.607 16.3943C14.6079 16.6004 14.9769 16.5986 14.976 16.3943C14.976 16.2926 14.8923 16.2098 14.7906 16.2098ZM14.7909 17.5569C14.1483 17.5569 13.6263 17.0349 13.6263 16.3933C13.6263 15.7518 14.1483 15.2307 14.7909 15.2307C15.4344 15.2307 15.9573 15.7518 15.9573 16.3933C15.9573 17.0349 15.4344 17.5569 14.7909 17.5569Z" fill="currentColor"/>
            </svg>'.$btntext.' '
        );
}



add_action( 'wp_footer' , 'custom_quantity_fields_script' );

// custom_quantity_fields_script
function custom_quantity_fields_script(){
    ?>
    <script type='text/javascript'>
    jQuery( function( $ ) {
        if ( ! String.prototype.getDecimals ) {
            String.prototype.getDecimals = function() {
                var num = this,
                    match = ('' + num).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
                if ( ! match ) {
                    return 0;
                }
                return Math.max( 0, ( match[1] ? match[1].length : 0 ) - ( match[2] ? +match[2] : 0 ) );
            }
        }
        // Quantity "plus" and "minus" buttons
        $( document.body ).on( 'click', '.plus, .minus', function() {
            var $qty        = $( this ).closest( '.quantity' ).find( '.qty'),
                currentVal  = parseFloat( $qty.val() ),
                max         = parseFloat( $qty.attr( 'max' ) ),
                min         = parseFloat( $qty.attr( 'min' ) ),
                step        = $qty.attr( 'step' );

            // Format values
            if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) currentVal = 0;
            if ( max === '' || max === 'NaN' ) max = '';
            if ( min === '' || min === 'NaN' ) min = 0;
            if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) step = 1;

            // Change the value
            if ( $( this ).is( '.plus' ) ) {
                if ( max && ( currentVal >= max ) ) {
                    $qty.val( max );
                } else {
                    $qty.val( ( currentVal + parseFloat( step )).toFixed( step.getDecimals() ) );
                }
            } else {
                if ( min && ( currentVal <= min ) ) {
                    $qty.val( min );
                } else if ( currentVal > 0 ) {
                    $qty.val( ( currentVal - parseFloat( step )).toFixed( step.getDecimals() ) );
                }
            }

            // Trigger change event
            $qty.trigger( 'change' );
        });
    });
    </script>
    <?php
}


// woocommerce_breadcrumb modilfy
if ( ! function_exists( 'woocommerce_breadcrumb' ) ) {

    /**
     * Output the WooCommerce Breadcrumb.
     *
     * @param array $args Arguments.
     */
    function woocommerce_breadcrumb( $args = array() ) {
        $args = wp_parse_args(
            $args,
            apply_filters(
                'woocommerce_breadcrumb_defaults',
                array(
                    'delimiter'   => '<span class="dvdr"><i class="fa-regular fa-angle-right"></i></span>',
                    'wrap_before' => '<nav class="woocommerce-breadcrumb tp-woo-breadcrumb__list">',
                    'wrap_after'  => '</nav>',
                    'before'      => '',
                    'after'       => '',
                    'home'        => _x( 'Home', 'breadcrumb', 'harry' ),
                )
            )
        );

        $breadcrumbs = new WC_Breadcrumb();

        if ( ! empty( $args['home'] ) ) {
            $breadcrumbs->add_crumb( $args['home'], apply_filters( 'woocommerce_breadcrumb_home_url', home_url() ) );
        }

        $args['breadcrumb'] = $breadcrumbs->generate();

        /**
         * WooCommerce Breadcrumb hook
         *
         * @hooked WC_Structured_Data::generate_breadcrumblist_data() - 10
         */
        do_action( 'woocommerce_breadcrumb', $breadcrumbs, $args );

        wc_get_template( 'global/breadcrumb.php', $args );
    }
}


