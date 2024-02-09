<?php
/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
?>
<div class="product_meta">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>
    <div class="product__details-sku product__details-more">
        <p><?php esc_html_e( 'SKU:', 'harry' ); ?></p>
        <span><?php echo wp_kses_post( $sku = $product->get_sku() ) ? esc_html($sku) : esc_html__( 'N/A', 'harry' ); ?></span>
    </div>    
	<?php endif; ?>

    <div class="product__details-categories product__details-more">
       <?php echo wc_get_product_category_list( $product->get_id(), ', ', '<p class="posted_in">' . _n( 'Category: ', 'Categories: ', count( $product->get_category_ids() ), 'harry' )  . '</p> '); ?> 
    </div>
    <div class="product__details-tags">
	<?php echo wc_get_product_tag_list( $product->get_id(), ' ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'harry' ) . '</span> '); ?>
    </div>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>
    <?php if(function_exists('harry_product_single_social')) : ?>
    <?php echo harry_product_single_social(); ?>
    <?php endif; ?>

</div>


