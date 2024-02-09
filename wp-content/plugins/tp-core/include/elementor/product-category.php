<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Product_Category extends Widget_Base {

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
		return 'product-category-slider';
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
		return __( 'Product Category Slider', 'tpcore' );
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

        // layout Panel
        $this->start_controls_section(
            'tp_layout',
            [
                'label' => esc_html__('Design Layout', 'tpcore'),
            ]
        );
        $this->add_control(
            'tp_design_style',
            [
                'label' => esc_html__('Select Layout', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'tpcore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();


        // Service group
        $this->start_controls_section(
            'tp_support',
            [
                'label' => esc_html__('Category List', 'tpcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );


        $repeater = new \Elementor\Repeater();


        $repeater->add_control(
         'tp_category_box_image',
         [
           'label'   => esc_html__( 'Upload Thumbnail', 'tpcore' ),
           'type'    => \Elementor\Controls_Manager::MEDIA,
             'default' => [
               'url' => \Elementor\Utils::get_placeholder_image_src(),
           ],
         ]
        );


        $repeater->add_control(
            'tp_category_box_title', [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Service Title', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_category_link_switcher',
            [
                'label' => esc_html__( 'Add Services link', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'tpcore' ),
                'label_off' => esc_html__( 'No', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );
        $repeater->add_control(
            'tp_category_btn_text',
            [
                'label' => esc_html__('Button Text', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'tpcore'),
                'title' => esc_html__('Enter button text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_category_link_switcher' => 'yes',
                    'repeater_condition' => ['style_1'],
                ],
            ]
        );
        $repeater->add_control(
            'tp_category_link_type',
            [
                'label' => esc_html__( 'Service Link Type', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'tp_category_link_switcher' => 'yes'
                ]
            ]
        );
        $repeater->add_control(
            'tp_category_link',
            [
                'label' => esc_html__( 'Service Link link', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__( 'https://your-link.com', 'tpcore' ),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'condition' => [
                    'tp_category_link_type' => '1',
                    'tp_category_link_switcher' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'tp_category_page_link',
            [
                'label' => esc_html__( 'Select Service Link Page', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_category_link_type' => '2',
                    'tp_category_link_switcher' => 'yes',
                ]
            ]
        );

        $repeater->add_control(
            'tp_category_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered.',
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_1'],
                ]
            ]
        );


        $this->add_control(
            'tp_category_list',
            [
                'label' => esc_html__('Features - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_category_box_title' => esc_html__('Business Stratagy', 'tpcore'),
                    ],
                    [
                        'tp_category_box_title' => esc_html__('Website Development', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_category_box_title }}}',
            ]
        );


        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                // 'default' => 'tp-post-thumb',
            ]
        );
        $this->end_controls_section();

	}

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('services_section', 'Section - Style', '.tp-el-section');
        
        $this->tp_basic_style_controls('services_section_box', 'Box - Title', '.tp-el-box-title');

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
		?>

		<?php if ( $settings['tp_design_style']  == 'layout-2' ) : 
            $this->add_render_attribute('title_args', 'class', 'tp-section-title-2 tp-el-title');        
        ?>



		<?php else: 
            $bloginfo = get_bloginfo( 'name' );
            $this->add_render_attribute('title_args', 'class', 'section__title-7 tp-el-title');    

        ?>

         <!-- product category area start -->
         <section class="product__category pt-100 pb-100 tp-el-section">
            <div class="container">
               <div class="row">
                  <div class="col-xxl-12">
                     <div class="product__category-slider">
                        <div class="product__category-slider-active swiper-container">
                           <div class="swiper-wrapper">
                           <?php foreach ($settings['tp_category_list'] as $key => $item) : 

                                    if ( !empty($item['tp_category_box_image']['url']) ) {
                                        $tp_category_box_image_url = !empty($item['tp_category_box_image']['id']) ? wp_get_attachment_image_url( $item['tp_category_box_image']['id'], $settings['thumbnail_size']) : $item['tp_category_box_image']['url'];
                                        $tp_category_box_image_alt = get_post_meta($item["tp_category_box_image"]["id"], "_wp_attachment_image_alt", true);
                                    }
                                     // Link
                                    if ('2' == $item['tp_category_link_type']) {
                                        $link = get_permalink($item['tp_category_page_link']);
                                        $target = '_self';
                                        $rel = 'nofollow';
                                    } else {
                                        $link = !empty($item['tp_category_link']['url']) ? $item['tp_category_link']['url'] : '';
                                        $target = !empty($item['tp_category_link']['is_external']) ? '_blank' : '';
                                        $rel = !empty($item['tp_category_link']['nofollow']) ? 'nofollow' : '';
                                    }    
                                ?>
                              <div class="product__category-item mb-20 text-center swiper-slide tp-el-box">
                                 <div class="product__category-thumb w-img">

                                    <?php if ($item['tp_category_link_switcher'] == 'yes') : ?>
                                        <a href="<?php echo esc_url($link); ?>">
                                            <img src="<?php echo esc_url($tp_category_box_image_url); ?>" alt="<?php echo esc_attr($tp_category_box_image_alt) ?>">
                                        </a>
                                    <?php else : ?>
                                        <img src="<?php echo esc_url($tp_category_box_image_url); ?>" alt="<?php echo esc_attr($tp_category_box_image_alt) ?>">
                                    <?php endif; ?>
                                 </div>
                                 <div class="product__category-content">

                                    <?php if (!empty($item['tp_category_box_title' ])): ?>
                                    <h3 class="product__category-title tp-el-box-title">
                                        <?php if ($item['tp_category_link_switcher'] == 'yes') : ?>
                                        <a href="<?php echo esc_url($link); ?>"><?php echo tp_kses($item['tp_category_box_title' ]); ?></a>
                                        <?php else : ?>
                                            <?php echo tp_kses($item['tp_category_box_title' ]); ?>
                                        <?php endif; ?>
                                    </h3>
                                    <?php endif; ?>
                                 </div>
                              </div>
                              <?php endforeach; ?>
                           </div>
                        </div>
                        <div class="tp-scrollbar"></div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- product category area end -->

        <?php endif; ?>

        <?php
	}
}

$widgets_manager->register( new TP_Product_Category() );
