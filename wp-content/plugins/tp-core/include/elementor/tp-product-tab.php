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
class TP_Product_Tab extends Widget_Base {

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
		return 'tp-product-tab';
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
		return __( 'Product Tab', 'tpcore' );
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
        
		$this->start_controls_section(
		 'tp_section_sec',
			 [
			   'label' => esc_html__( 'Title', 'tpcore' ),
			   'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			 ]
		);
		
		$this->add_control(
		'tp_section_title',
		 [
			'label'       => esc_html__( 'Title', 'tpcore' ),
			'type'        => \Elementor\Controls_Manager::TEXT,
			'default'     => esc_html__( 'Your Title', 'tpcore' ),
			'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
			'label_block' => true
		 ]
		);
		
		
		$this->end_controls_section();

        // Product Query
        $this->tp_query_controls('product', 'Product', '6', '10', 'product', 'product_cat');

        // layout Panel
        $this->tp_post_layout('post', 'Product Layout');

        // column controls
        $this->tp_columns('col');

	}

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('blog_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('blog_title', 'Title', '.tp-el-title');

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

        $filter_list = $settings['category'];
        ?>

        <?php if ( $settings['tp_design_style']  == 'layout-2' ): 
            $this->add_render_attribute('title_args', 'class', 'section__title-4 tp-el-title');
        ?>

        <?php else: ?>
        <!-- blog area start -->

         <section class="product__popular-area pb-20">
            <div class="container">
               <div class="row align-items-end">
				<?php if(!empty($settings['tp_section_title'])) : ?>
                  <div class="col-xl-6 col-lg-6 col-md-6">
                     <div class="section__title-wrapper-13 mb-35">
                        <h3 class="section__title-13 tp-el-title"><?php echo esc_html($settings['tp_section_title']); ?></h3>
                     </div>
                  </div>
				  <?php endif; ?>
				  <?php if(!empty($filter_list) ) : ?>
                  <div class="col-xl-6 col-lg-6 col-md-6">
                     <div class="product__tab tp-tab  mb-35">
                        <ul class="nav nav-tabs justify-content-md-end" id="productTab" role="tablist">
                            <?php 
                            $count = 0;
                            foreach ( $filter_list as $key => $list ): 
                                $active = ($count == 0) ? 'active' : '';
                            ?>
                           <li class="nav-item" role="presentation">
                             <button class="nav-link <?php echo esc_attr($active); ?>" id="top-tab-<?php echo esc_attr( $key ); ?>" data-bs-toggle="tab" data-bs-target="#top-<?php echo esc_attr( $key ); ?>" type="button" role="tab" aria-controls="top-<?php echo esc_attr( $key ); ?>" aria-selected="true"><?php echo esc_html( $list ); ?></button>
                           </li>
                           <?php $count++; endforeach; ?>
                         </ul>
                     </div>
                  </div>
				  <?php endif; ?>
               </div>
               <div class="product__tab-wrapper">
			   <?php if(!empty($filter_list) ) : ?>
                  <div class="tab-content" id="myTabContent">
	                <?php
	                	$posts_per_page = (!empty($settings['posts_per_page'])) ? $settings['posts_per_page'] : '-1';
	                    foreach ($filter_list as $key => $list):
	                    $active_tab = ($key == 0) ? 'active show' : '';
	                ?>
                     <div class="tab-pane fade <?php echo esc_attr($active_tab); ?>" id="top-<?php echo esc_attr( $key ); ?>" role="tabpanel" aria-labelledby="top-tab-<?php echo esc_attr( $key ); ?>">
                        <div class="row">
                            <?php
								$post_args = [
		                            'post_status' => 'publish',
		                            'post_type' => 'product',
		                            'posts_per_page' => $posts_per_page,
		                            'tax_query' => array(
		                                array(
		                                    'taxonomy' => 'product_cat',
		                                    'field' => 'slug',
		                                    'terms' => $list,
		                                ),
		                            ),
		                        ];
		                        $pro_query = new \WP_Query($post_args);
								while ($pro_query->have_posts()) : 
		                        $pro_query->the_post();
		                        global $product;
		                        global $post;
		                        global $woocommerce;
		                        $rating = wc_get_rating_html($product->get_average_rating());
		                        $ratingcount = $product->get_review_count();
		                    ?>
                            <div class="col-xl-<?php echo esc_attr($settings['tp_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['tp_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['tp_col_for_tablet']); ?> col-<?php echo esc_attr($settings['tp_col_for_mobile']); ?>">
		                       <div class="product__item p-relative transition-3 mb-50">
		                        <?php if( has_post_thumbnail() ) : ?>
		                          <div class="product__thumb w-img p-relative fix">
		                             <a href="<?php the_permalink(); ?>">
		                                <?php the_post_thumbnail(); ?>
		                             </a>

		                             <?php if( $product->is_on_sale()) : ?>
		                             <div class="product__badge d-flex flex-column flex-wrap">
		                                <?php woocommerce_show_product_loop_sale_flash($post->ID); ?>
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
                            <?php endwhile; 
                                wp_reset_query(); 
                            ?>
                        </div>
                     </div>
                     <?php endforeach; ?>
                <?php else : ?>
	                <div class="row">
	                    <?php
							while ($query->have_posts()) : 
	                        $query->the_post();
	                        global $product;
	                        global $post;
	                        global $woocommerce;
	                        $rating = wc_get_rating_html($product->get_average_rating());
	                        $ratingcount = $product->get_review_count();
	                    ?>
	                    <div class="col-xl-<?php echo esc_attr($settings['tp_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['tp_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['tp_col_for_tablet']); ?> col-<?php echo esc_attr($settings['tp_col_for_mobile']); ?>">
	                       <div class="product__item p-relative transition-3 mb-50">
	                        <?php if( has_post_thumbnail() ) : ?>
	                          <div class="product__thumb w-img p-relative fix">
	                             <a href="<?php the_permalink(); ?>">
	                                <?php the_post_thumbnail(); ?>
	                             </a>

	                             <?php if( $product->is_on_sale()) : ?>
	                             <div class="product__badge d-flex flex-column flex-wrap">
	                                <?php woocommerce_show_product_loop_sale_flash($post->ID); ?>
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
	                                <?php //echo harry_kses($rating); ?> 
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
	                    <?php endwhile; 
	                        wp_reset_query(); 
	                    ?>
	                </div>
                <?php endif; ?>
                   </div>
               </div>
            </div>
         </section>

         <!-- blog area end -->
         

    	<?php endif; ?>

       <?php
	}

}

$widgets_manager->register( new TP_Product_Tab() );