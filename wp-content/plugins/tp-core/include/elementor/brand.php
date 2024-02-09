<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use TPCore\Elementor\Controls\Group_Control_TPBGGradient;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Brand extends Widget_Base {

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
		return 'tp-brand';
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
		return __( 'Brand', 'tpcore' );
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
                    'layout-2' => esc_html__('Layout 2', 'tpcore'),
                    'layout-3' => esc_html__('Layout 3', 'tpcore'),
                    'layout-4' => esc_html__('Layout 4', 'tpcore'),
                    'layout-5' => esc_html__('Layout 5', 'tpcore'),
                    'layout-6' => esc_html__('Layout 6', 'tpcore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->add_control(
         'enable_square_style',
         [
           'label'        => esc_html__( 'Enable Square Style', 'Text-domain' ),
           'type'         => \Elementor\Controls_Manager::SWITCHER,
           'label_on'     => esc_html__( 'Show', 'Text-domain' ),
           'label_off'    => esc_html__( 'Hide', 'Text-domain' ),
           'return_value' => 'yes',
           'default'      => 'no',
           'condition' => [
            'tp_design_style' => ['layout-3', 'layout-4']
           ]
         ]
        );

        $this->end_controls_section();

		// tp_section_title
        $this->tp_section_title_render_controls('brand', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.');


		$this->start_controls_section(
            'tp_brand_section',
            [
                'label' => __( 'Brand Item', 'tpcore' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'repeater_condition',
            [
                'label' => __( 'Field condition', 'tpcore' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __( 'Style 1', 'tpcore' ),
                    'style_2' => __( 'Style 2', 'tpcore' ),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );


        $repeater->add_control(
            'tp_brand_image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __( 'Image', 'tpcore' ),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'tp_brand_tooltip',
            [
                'label'       => esc_html__( 'Brand Tooltip', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Your Text', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
                'condition' =>[
                    'repeater_condition' => 'style_2'
                ]
            ]
        );

        $repeater->add_control(
            'tp_brand_url',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'URL', 'tpcore' ),
                'default' => __( '#', 'tpcore' ),
                'placeholder' => __( 'Type url here', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'tp_brand_slides',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => esc_html__( 'Brand Item', 'tpcore' ),
                'default' => [
                    [
                        'tp_brand_image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'tp_brand_image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'medium_large',
                'separator' => 'before',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $this->end_controls_section();
	}


    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('section_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('section_title', 'Section - Title', '.tp-el-title');
        $this->tp_link_controls_style('section_tooltip', 'Brand - Tooltip', '.tp-el-tooltip');
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
            $this->add_render_attribute('title_args', 'class', 'tp-title tp-el-title');
        ?>

         <!-- brand area start -->
         <div class="brand__area grey-bg-7 pt-70 pb-70 tp-el-section">
            <div class="container">
               <div class="row">
                  <div class="col-xxl-12">
                     <div class="brand__slider">
                        <div class="brand__slider-active-2 swiper-container">
                           <div class="swiper-wrapper">
                                <?php foreach ($settings['tp_brand_slides'] as $item) :
					                if ( !empty($item['tp_brand_image']['url']) ) {
					                    $tp_brand_image_url = !empty($item['tp_brand_image']['id']) ? wp_get_attachment_image_url( $item['tp_brand_image']['id'], $settings['thumbnail_size']) : $item['tp_brand_image']['url'];
					                    $tp_brand_image_alt = get_post_meta($item["tp_brand_image"]["id"], "_wp_attachment_image_alt", true);
					                }
					            ?>
                                <div class="brand__item-2 swiper-slide">
                                    <?php if (!empty($item['tp_brand_url'])) : ?>
                                    <a href="<?php echo esc_url($item['tp_brand_url']); ?>"><img src="<?php echo esc_url($tp_brand_image_url); ?>" alt="<?php echo esc_url($tp_brand_image_alt); ?>"></a>
                                    <?php else : ?>
                                    <img src="<?php echo esc_url($tp_brand_image_url); ?>" alt="<?php echo esc_url($tp_brand_image_alt); ?>">
                                    <?php endif; ?>
                                </div>
                              <?php endforeach; ?>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- brand area end -->

     	<?php elseif ( $settings['tp_design_style']  == 'layout-3' ): 
            $this->add_render_attribute('title_args', 'class', 'tp-title tp-el-title');

            $enable_square_style = $settings['enable_square_style'] == 'yes' ? 'brand__style-square' : '' ;
        ?>

         <!-- brand area start -->
         <section class="brand__area tp-el-section">
            <div class="container-fluid g-0">
               <div class="row gx-0 gy-2">
                  <div class="col-xxl-12">
                     <div class="brand__slider-5 <?php echo esc_attr($enable_square_style); ?>">
                        <div class="brand__slider-5">
                           <div class="brand__slider-active-5">
                                <?php foreach ($settings['tp_brand_slides'] as $item) :
                                    if ( !empty($item['tp_brand_image']['url']) ) {
                                        $tp_brand_image_url = !empty($item['tp_brand_image']['id']) ? wp_get_attachment_image_url( $item['tp_brand_image']['id'], $settings['thumbnail_size']) : $item['tp_brand_image']['url'];
                                        $tp_brand_image_alt = get_post_meta($item["tp_brand_image"]["id"], "_wp_attachment_image_alt", true);
                                    }
                                ?>
                              <div class="brand__item-5">
                                <?php if (!empty($item['tp_brand_url'])) : ?>
                                    <a href="<?php echo esc_url($item['tp_brand_url']); ?>">
                                        <img src="<?php echo esc_url($tp_brand_image_url); ?>" alt="<?php echo esc_url($tp_brand_image_alt); ?>">
                                    </a>

                                <?php else : ?>
                                    <img src="<?php echo esc_url($tp_brand_image_url); ?>" alt="<?php echo esc_url($tp_brand_image_alt); ?>">
                                <?php endif; ?>
                              </div>
                              <?php endforeach; ?>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- brand area end -->

         <?php elseif ( $settings['tp_design_style']  == 'layout-4' ): 
            $this->add_render_attribute('title_args', 'class', 'tp-title tp-el-title');
            $enable_square_style = $settings['enable_square_style'] == 'yes' ? 'brand__style-square' : '' ;
        ?>
         <!-- brand area start -->
         <section class="brand__area tp-el-section">
            <div class="container-fluid g-0">
               <div class="row gx-0 gy-2">
                  <div class="col-xxl-12">
                     <div class="brand__slider-5-1 <?php echo esc_attr($enable_square_style); ?>">
                        <div class="brand__slider-5">
                           <div class="brand__slider-active-5-1" >
                           <?php foreach ($settings['tp_brand_slides'] as $item) :
                                    if ( !empty($item['tp_brand_image']['url']) ) {
                                        $tp_brand_image_url = !empty($item['tp_brand_image']['id']) ? wp_get_attachment_image_url( $item['tp_brand_image']['id'], $settings['thumbnail_size']) : $item['tp_brand_image']['url'];
                                        $tp_brand_image_alt = get_post_meta($item["tp_brand_image"]["id"], "_wp_attachment_image_alt", true);
                                    }
                                ?>
                              <div class="brand__item-5">
                                <?php if (!empty($item['tp_brand_url'])) : ?>
                                        <a href="<?php echo esc_url($item['tp_brand_url']); ?>">
                                            <img src="<?php echo esc_url($tp_brand_image_url); ?>" alt="<?php echo esc_url($tp_brand_image_alt); ?>">
                                        </a>

                                    <?php else : ?>
                                        <img src="<?php echo esc_url($tp_brand_image_url); ?>" alt="<?php echo esc_url($tp_brand_image_alt); ?>">
                                    <?php endif; ?>
                              </div>
                              <?php endforeach; ?>
                           </div>
                        </div>
                     </div>
               </div>
               </div>
            </div>
         </section>
         <!-- brand area end -->

         <?php elseif ( $settings['tp_design_style']  == 'layout-5' ): 
            $this->add_render_attribute('title_args', 'class', 'tp-title tp-el-title');
        ?>

         <!-- brand area start -->
         <section class="brand__area black-bg-5 pt-70 pb-140 tp-el-section">
            <div class="container">
               <div class="row gx-0">
                    <?php foreach ($settings['tp_brand_slides'] as $item) :
                        if ( !empty($item['tp_brand_image']['url']) ) {
                            $tp_brand_image_url = !empty($item['tp_brand_image']['id']) ? wp_get_attachment_image_url( $item['tp_brand_image']['id'], $settings['thumbnail_size']) : $item['tp_brand_image']['url'];
                            $tp_brand_image_alt = get_post_meta($item["tp_brand_image"]["id"], "_wp_attachment_image_alt", true);
                        }
                    ?>
                  <div class="col-lg-3 col-md-4 col-sm-6">
                     <div class="brand__item-3 text-center">

                        <?php if (!empty($item['tp_brand_tooltip'])) : ?>
                        <span class="brand__tooltip tp-el-tooltip"><?php echo esc_html($item['tp_brand_tooltip']); ?></span>
                        <?php endif; ?>

                        <?php if (!empty($item['tp_brand_url'])) : ?>
                            <a href="<?php echo esc_url($item['tp_brand_url']); ?>">
                                <img src="<?php echo esc_url($tp_brand_image_url); ?>" alt="<?php echo esc_url($tp_brand_image_alt); ?>">
                            </a>

                        <?php else : ?>
                            <img src="<?php echo esc_url($tp_brand_image_url); ?>" alt="<?php echo esc_url($tp_brand_image_alt); ?>">
                        <?php endif; ?>
                     </div>
                  </div>
                  <?php endforeach; ?>
               </div>
            </div>
         </section>
         <!-- brand area end -->

        <?php elseif ( $settings['tp_design_style']  == 'layout-6' ): 
            $this->add_render_attribute('title_args', 'class', 'tp-brand-sponsor-title tp-el-title');
        ?>

         <!-- brand area start -->
         <section class="brand__area grey-bg-7">
            <div class="container">
            <?php if ( !empty($settings['tp_brand_section_title_show']) ) : ?>
               <div class="row">
                  <div class="col-xxl-3 col-xl-4 col-lg-5 col-md-6 col-sm-7">
                     <div class="brand__info-2 mb-45">
                        <?php
                            if ( !empty($settings['tp_brand_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['tp_brand_title_tag'] ),
                                    $this->get_render_attribute_string( 'title_args' ),
                                    tp_kses( $settings['tp_brand_title' ] )
                                    );
                            endif;
                        ?>
                     </div>
                  </div>
               </div>
               <?php endif; ?>

               <div class="brand__item-wrapper-6 d-flex flex-wrap justify-content-between">
                    <?php foreach ($settings['tp_brand_slides'] as $item) :
                        if ( !empty($item['tp_brand_image']['url']) ) {
                            $tp_brand_image_url = !empty($item['tp_brand_image']['id']) ? wp_get_attachment_image_url( $item['tp_brand_image']['id'], $settings['thumbnail_size']) : $item['tp_brand_image']['url'];
                            $tp_brand_image_alt = get_post_meta($item["tp_brand_image"]["id"], "_wp_attachment_image_alt", true);
                        }
                    ?>

                  <div class="brand__item-6 mr-10">
                    <?php if (!empty($item['tp_brand_url'])) : ?>
                        <a href="<?php echo esc_url($item['tp_brand_url']); ?>">
                            <img src="<?php echo esc_url($tp_brand_image_url); ?>" alt="<?php echo esc_url($tp_brand_image_alt); ?>">
                        </a>

                    <?php else : ?>
                        <img src="<?php echo esc_url($tp_brand_image_url); ?>" alt="<?php echo esc_url($tp_brand_image_alt); ?>">
                    <?php endif; ?>
                  </div>
                  <?php endforeach; ?>

               </div>
            </div>
         </section>
         <!-- brand area end -->

        <?php else : 
            $this->add_render_attribute('title_args', 'class', 'award__title-4 tp-el-title');
        ?>

        <!-- award area start -->
        <section class="award__area pt-30 pb-30 tp-el-section">
            <div class="container">
                <div class="row">
                <?php if ( !empty($settings['tp_brand_section_title_show']) ) : ?>
                  <div class="col-xl-2 col-xl-2 col-lg-10 col-md-3">
                     <div class="award__wrapper-4">

                        <?php
                            if ( !empty($settings['tp_brand_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['tp_brand_title_tag'] ),
                                    $this->get_render_attribute_string( 'title_args' ),
                                    tp_kses( $settings['tp_brand_title' ] )
                                    );
                            endif;
                        ?>

                     </div>
                  </div>
                  <?php endif; ?>
                  <div class="col-xxl-4 col-xl-4 col-lg-5 col-md-9">
                     <div class="award__slider">
                        <div class="award__slider-active swiper-container">
                           <div class="award__item-wrapper swiper-wrapper">

                                <?php foreach ($settings['tp_brand_slides'] as $item) :
                                    if ( !empty($item['tp_brand_image']['url']) ) {
                                        $tp_brand_image_url = !empty($item['tp_brand_image']['id']) ? wp_get_attachment_image_url( $item['tp_brand_image']['id'], $settings['thumbnail_size']) : $item['tp_brand_image']['url'];
                                        $tp_brand_image_alt = get_post_meta($item["tp_brand_image"]["id"], "_wp_attachment_image_alt", true);
                                    }
                                ?>
                              <div class="award__item-4 mr-30 swiper-slide">
                                <?php if (!empty($item['tp_brand_url'])) : ?>
                                    <a href="<?php echo esc_url($item['tp_brand_url']); ?>">
                                        <img src="<?php echo esc_url($tp_brand_image_url); ?>" alt="<?php echo esc_url($tp_brand_image_alt); ?>">
                                    </a>

                                <?php else : ?>
                                    <img src="<?php echo esc_url($tp_brand_image_url); ?>" alt="<?php echo esc_url($tp_brand_image_alt); ?>">
                                <?php endif; ?>

                                </div>
                                <?php endforeach; ?>

                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- award area end -->
	   <?php endif; ?>

		<?php
	}


}

$widgets_manager->register( new TP_Brand() );
