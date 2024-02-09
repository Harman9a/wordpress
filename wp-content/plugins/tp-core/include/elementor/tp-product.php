<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Product_Post extends Widget_Base {

    use \TPCore\Widgets\TPCoreElementFunctions;

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'tp-product';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Product Post', 'tpcore' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'tp-icon';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'tpcore' ];
	}

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'tpcore' ];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
    protected function register_controls(){
        $this->register_controls_section();
        $this->style_tab_content();
    }   

	protected function register_controls_section() {


        // Product Query
        $this->tp_query_controls('product', 'Product', '6', '10', 'product', 'product_cat');

        // layout Panel
        $this->tp_post_layout('post', 'Product');

        // tp_post__columns_section
        $this->tp_columns('blog', 'Blog Column');

	}

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('blog_section', 'Section - Style', '.tp-el-section');

        $this->tp_basic_style_controls('blog_box_title', 'Box - Title', '.tp-el-box-title');
    }



	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

        /**
         * Setup the post arguments.
        */
        $query_args = TP_Helper::get_query_args('product', 'product_cat', $this->get_settings());

        // The Query
        $query = new \WP_Query($query_args);


        ?>

        <?php if ( $settings['tp_design_style']  == 'layout-2' ): 
            $this->add_render_attribute('title_args', 'class', 'section__title-4 tp-el-title');
        ?>

        <?php else: ?>
        <!-- blog area start -->

            <div class="container">
                <div class="row">

                    <?php while ($query->have_posts()) : 
                        $query->the_post();
                        global $product;
                        global $post;
                        global $woocommerce;
                        $rating = wc_get_rating_html($product->get_average_rating());
                        $ratingcount = $product->get_review_count();
                    ?>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
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
                                <button type="button" class="product-add-cart-btn w-100">
                                    <?php echo \TPCore\TP_El_Woocommerce::tp_woo_add_to_cart(); ?>
                                </button>
                             </div>
                          </div>
                          <?php endif; ?>
                          <div class="product__content">
                              <?php if( !empty($rating)) : ?>
                             <div class="product__rating d-flex mb-10">
                                <?php echo harry_kses($rating); ?> 
                             </div>
                             <?php endif; ?>

                             <h3 class="product__title tp-el-box-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                             </h3>
                             <div class="product__price">
                                <?php echo woocommerce_template_loop_price();?>
                             </div>
                          </div>
                       </div>
                    </div>
                    <?php endwhile; wp_reset_query(); ?>
                </div>
            </div>

         <!-- blog area end -->
         

    	<?php endif; ?>

       <?php
	}

}

$widgets_manager->register( new TP_Product_Post() );