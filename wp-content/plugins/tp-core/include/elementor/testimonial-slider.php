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
class TP_Testimonial_Slider extends Widget_Base {

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
		return 'tp-testimonial-slider';
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
		return __( 'Testimonial Slider', 'tpcore' );
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'tp_section_sec',
                [
                  'label' => esc_html__( 'Title & Description', 'tpcore' ),
                  'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
           );
           
           $this->add_control(
           'tp_section_subtitle',
            [
               'label'       => esc_html__( 'Sub Title', 'tpcore' ),
               'type'        => \Elementor\Controls_Manager::TEXT,
               'default'     => esc_html__( 'Happy clients', 'tpcore' ),
               'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
               'label_block' => true
            ]
           );
           
           $this->add_control(
           'tp_section_title',
            [
               'label'       => esc_html__( 'Title', 'tpcore' ),
               'type'        => \Elementor\Controls_Manager::TEXT,
               'default'     => esc_html__( '220+', 'tpcore' ),
               'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
               'label_block' => true
            ]
           );

           $this->add_control(
            'enable_title_bg',
            [
              'label'        => esc_html__( 'Enable BG', 'tpcore' ),
              'type'         => \Elementor\Controls_Manager::SWITCHER,
              'label_on'     => esc_html__( 'Show', 'tpcore' ),
              'label_off'    => esc_html__( 'Hide', 'tpcore' ),
              'return_value' => 'yes',
              'default'      => 'no',
              'condition' => [
                'tp_design_style' => 'layout-1'
              ]
            ]
           );

           $this->add_control(
            'tp_title_image',
            [
              'label'   => esc_html__( 'Upload Image', 'tpcore' ),
              'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                  'url' => \Elementor\Utils::get_placeholder_image_src(),
              ],
              'condition' => [
                'tp_design_style' => 'layout-1',
                'enable_title_bg' => 'yes'
              ]
            ]
           );
           
           $this->add_control(
            'tp_section_desc',
            [
              'label'       => esc_html__( 'Description', 'tpcore' ),
              'type'        => \Elementor\Controls_Manager::TEXTAREA,
              'rows'        => 10,
              'default'     => esc_html__( 'Im a UX designer, prototyper, and a part-time 3D artist', 'tpcore' ),
              'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
            ]
           );
           
           $this->end_controls_section();
   
           $this->start_controls_section(
            'tp_testimonial_shape_sec',
                [
                  'label' => esc_html__( 'Shape Controls', 'tpcore' ),
                  'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                  'condition' => [
                    'tp_design_style' => 'layout-2'
                  ]
                ]
           );
           
           $this->add_control(
            'tp_testimonial_shape_switch',
            [
              'label'        => esc_html__( 'Enable Shape', 'tpcore' ),
              'type'         => \Elementor\Controls_Manager::SWITCHER,
              'label_on'     => esc_html__( 'Show', 'tpcore' ),
              'label_off'    => esc_html__( 'Hide', 'tpcore' ),
              'return_value' => 'yes',
              'default'      => 'yes',
            ]
           );
           
           
           $this->end_controls_section();

        // Review group
        $this->start_controls_section(
            'review_list',
            [
                'label' => esc_html__( 'Review List', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

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
            'reviewer_image',
            [
                'label' => esc_html__( 'Reviewer Image', 'tpcore' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );
        $repeater->add_control(
            'reviewer_name', [
                'label' => esc_html__( 'Reviewer Name', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Rasalina William' , 'tpcore' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'reviewer_title', [
                'label' => esc_html__( 'Reviewer Title', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( '- CEO at YES Germany' , 'tpcore' ),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'review_content',
            [
                'label' => esc_html__( 'Review Content', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => 'Aklima The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections Bonorum et Malorum original.',
                'placeholder' => esc_html__( 'Type your review content here', 'tpcore' ),
            ]
        );

        $repeater->add_control(
            'review_rating',
            [
                'label' => esc_html__('Select Rating', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '5',
                'options' => [
                    '5' => esc_html__('Rating 5', 'tpcore'),
                    '4' => esc_html__('Rating 4', 'tpcore'),
                    '3' => esc_html__('Rating 3', 'tpcore'),
                    '2' => esc_html__('Rating 2', 'tpcore'),
                    '1' => esc_html__('Rating 1', 'tpcore'),
                ],   
                'condition' => [
                    'repeater_condition' => ['style_1']
                ]             
            ]
        );

        $this->add_control(
            'reviews_list',
            [
                'label' => esc_html__( 'Review List', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' =>  $repeater->get_controls(),
                'default' => [
                    [
                        'reviewer_name' => esc_html__( 'Rasalina William', 'tpcore' ),
                        'reviewer_title' => esc_html__( 'CEO at YES Germany', 'tpcore' ),
                        'review_content' => esc_html__( 'Construction can be defined as the art of building something. These construction quotes will put into perspective the fact that construction can be', 'tpcore' ),
                    ],
                    [
                        'reviewer_name' => esc_html__( 'Rasalina William', 'tpcore' ),
                        'reviewer_title' => esc_html__( 'CEO at YES Germany', 'tpcore' ),
                        'review_content' => esc_html__( 'Construction can be defined as the art of building something. These construction quotes will put into perspective the fact that construction can be', 'tpcore' ),
                    ],
                    [
                        'reviewer_name' => esc_html__( 'Rasalina William', 'tpcore' ),
                        'reviewer_title' => esc_html__( 'CEO at YES Germany', 'tpcore' ),
                        'review_content' => esc_html__( 'Construction can be defined as the art of building something. These construction quotes will put into perspective the fact that construction can be', 'tpcore' ),
                    ],

                ],
                'title_field' => '{{{ reviewer_name }}}',
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail_size',
                'default' => 'thumbnail',
                'exclude' => ['custom'],
                'separator' => 'none',
            ]
        );

        $this->end_controls_section();

        // brand section controls
        $this->start_controls_section(
            'brand_list_section',
            [
                'label' => esc_html__( 'Brand List', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'tp_design_style' => 'layout-3'
                ]
            ]
        );
        $this->add_control(
         'brand_switch',
            [
                'label'        => esc_html__( 'Brand Section On/Off', 'tpcore' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'tpcore' ),
                'label_off'    => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );
        $this->add_control(
         'brand_list_switch',
         [
           'label'        => esc_html__( 'Brand Title On/Off', 'tpcore' ),
           'type'         => \Elementor\Controls_Manager::SWITCHER,
           'label_on'     => esc_html__( 'Show', 'tpcore' ),
           'label_off'    => esc_html__( 'Hide', 'tpcore' ),
           'return_value' => 'yes',
           'default'      => 'yes',
         ]
        );

        $this->add_control(
        'brand_list_title',
         [
            'label'       => esc_html__( 'Brand Title', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( 'TRUSTED BY GLOBAL BRANDS:', 'tpcore' ),
            'placeholder' => esc_html__( 'Your title here', 'tpcore' ),
            'condition' => [
                'brand_list_switch' => 'yes'
            ]
         ]
        );

        $repeater = new \Elementor\Repeater();


        $repeater->add_control(
            'brand_image',
            [
                'label' => esc_html__( 'Brand Image', 'tpcore' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'brand_url',
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
            'brand_list',
            [
                'label' => esc_html__( 'Brand List', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' =>  $repeater->get_controls(),
                'default' => [
                    [
                        'brand_image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'brand_image' => [
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


        $this->tp_button_render('testimonial', 'Button', ['layout-1'] );
	}

    // style_tab_content
    protected function style_tab_content(){
  
        $this->tp_section_style_controls('team_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('team_subtitle', 'Section - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('team_title', 'Section - Title', '.tp-el-title');
        $this->tp_basic_style_controls('team_description', 'Section - Description', '.tp-el-content p');
        $this->tp_link_controls_style('coming_time_social', 'Section - Button', '.tp-el-btn');

        $this->tp_section_style_controls('team_section_box', 'Box - Style', '.tp-el-box');
        $this->tp_basic_style_controls('testimonial_box_title', 'Testimonial - Name', '.tp-el-box-title');
        $this->tp_basic_style_controls('testimonial_box_subtitle', 'Testimonial - Designation', '.tp-el-box-subtitle');
        $this->tp_basic_style_controls('testimonial_box_desc', 'Testimonial - Description', '.tp-el-box-desc');
        $this->tp_basic_style_controls('testimonial_box_rat', 'Testimonial - Rating', '.tp-el-box-rating i');

        $this->tp_basic_style_controls('testimonial_brand_title', 'Brand - Title', '.tp-el-brand-title');

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

		<!--	testimonial style 2 -->
		<?php if ( $settings['tp_design_style']  == 'layout-2' ):

            // Link
            if ('2' == $settings['tp_testimonial_btn_link_type']) {
                $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_testimonial_btn_page_link']));
                $this->add_render_attribute('tp-button-arg', 'target', '_self');
                $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn tp-link-btn-3');
            } else {
                if ( ! empty( $settings['tp_testimonial_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'tp-button-arg', $settings['tp_testimonial_btn_link'] );
                    $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn tp-link-btn-3');
                }
            }

			$this->add_render_attribute('title_args', 'class', 'section__title-4 section__title-4-white tp-el-title');
            $bloginfo = get_bloginfo( 'name' );
		?>

        <!-- testimonial area start -->
        <section class="testimonial__area p-relative z-index-1 pt-120 fix pb-125 tp-el-section">
        <?php if(!empty($settings['tp_testimonial_shape_switch'])) :?>
            <div class="testimonial__shape">
               <img class="testimonial__shape-4" src="<?php echo get_template_directory_uri() . '/assets/img/testimonial/5/shape/testimonial-shape-2.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="testimonial__shape-5" src="<?php echo get_template_directory_uri() . '/assets/img/testimonial/5/shape/testimonial-shape-3.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="testimonial__shape-6" src="<?php echo get_template_directory_uri() . '/assets/img/testimonial/5/shape/testimonial-shape-4.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="testimonial__shape-7" src="<?php echo get_template_directory_uri() . '/assets/img/testimonial/5/shape/testimonial-shape-5.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
            </div>
            <?php endif; ?>
            <div class="container">
               <div class="row justify-content-center">
                  <div class="col-xxl-6">
                     <div class="tp-section-wrapper-3 mb-50 text-center">
                        <?php if(!empty($settings['tp_section_subtitle'])) :?>
                        <span class="tp-section-subtitle-3 tp-el-subtitle"><?php echo tp_kses($settings['tp_section_subtitle']); ?></span>
                        <?php endif; ?>

                        <?php if(!empty($settings['tp_section_title'])) :?>
                        <h3 class="tp-section-title-3 tp-el-title"><?php echo tp_kses($settings['tp_section_title']); ?></h3>
                        <?php endif; ?>
                           
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-xxl-12">
                     <div class="testimonial__slider-5 testimonial__style-2 p-relative wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s">
                        <?php if(!empty($settings['tp_testimonial_shape_switch'])) :?>
                        <div class="testimonial__gradient-bg-2 fix">
                           <img class="testimonial__shape-11" src="<?php echo get_template_directory_uri() . '/assets/img/testimonial/testimonial-shape.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                        </div>
                        <?php endif; ?>
                        <div class="testimonial__slider-active-5 pt-50 pb-50">
                            <?php foreach ($settings['reviews_list'] as $index => $item) :
                                if ( !empty($item['reviewer_image']['url']) ) {
                                $tp_reviewer_image = !empty($item['reviewer_image']['id']) ? wp_get_attachment_image_url( $item['reviewer_image']['id'], $settings['thumbnail_size_size']) : $item['reviewer_image']['url'];
                                $tp_reviewer_image_alt = get_post_meta($item["reviewer_image"]["id"], "_wp_attachment_image_alt", true);
                                }
                            ?>
                           <div class="testimonial__item-5 tp-el-box">
                              
                            <img class="testimonial__shape-2" src="<?php echo get_template_directory_uri() . '/assets/img/testimonial/5/testimonial-quote.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                                <?php if ( !empty($tp_reviewer_image) ) : ?>
                                    <div class="testimonial__avater-thumb-5">
                                        <img src="<?php echo esc_url($tp_reviewer_image); ?>" alt="<?php echo esc_url($tp_reviewer_image_alt); ?>">
                                    </div>
                                    <?php endif; ?>

                                <?php if ( !empty($item['review_content']) ) : ?>
                                <div class="testimonial__content-5">
                                    <p class="tp-el-box-desc"><?php echo tp_kses($item['review_content']); ?></p>
                                </div>
                                <?php endif; ?>

                                <div class="testimonial__avater-info-5">
                                    <?php if ( !empty($item['reviewer_name']) ) : ?>
                                    <h4 class="testimonial__avater-title-5 tp-el-box-title"><?php echo tp_kses($item['reviewer_name']); ?></h4>
                                    <?php endif; ?>
                                    <?php if ( !empty($item['reviewer_title']) ) : ?>
                                    <span class="testimonial__avater-designation-5 tp-el-box-subtitle"><?php echo tp_kses($item['reviewer_title']); ?></span>
                                    <?php endif; ?>
                                </div>
                           </div>
                           <?php endforeach; ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
      <!-- testimonial area end -->


		<!--	testimonial style 3 -->
		<?php elseif ( $settings['tp_design_style']  == 'layout-3' ):

            // Link
            if ('2' == $settings['tp_testimonial_btn_link_type']) {
                $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_testimonial_btn_page_link']));
                $this->add_render_attribute('tp-button-arg', 'target', '_self');
                $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn tp-link-btn-3');
            } else {
                if ( ! empty( $settings['tp_testimonial_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'tp-button-arg', $settings['tp_testimonial_btn_link'] );
                    $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn tp-link-btn-3');
                }
            }

            $this->add_render_attribute('title_args', 'class', 'section__title-4 section__title-4-white tp-el-title');
            $bloginfo = get_bloginfo( 'name' );
        ?>

        <!-- testimonial area start -->
        <section class="testimonial__area pt-110 pb-115 grey-bg-15 fix tp-el-section">
            <div class="container">
               <div class="row align-items-end">
                  <div class="col-xxl-7 col-xl-9 col-lg-9 col-md-9">
                     <div class="tp-section-wrapper-2 mb-55">

                        <?php if(!empty($settings['tp_section_subtitle'])) :?>
                        <span class="tp-section-subtitle-2 tp-el-subtitle"><?php echo tp_kses($settings['tp_section_subtitle']); ?></span>
                        <?php endif; ?>

                        <?php if(!empty($settings['tp_section_title'])) :?>
                        <h3 class="tp-section-title-2 tp-el-title"><?php echo tp_kses($settings['tp_section_title']); ?></h3>
                        <?php endif; ?>

                     </div>
                  </div>
                  <div class="col-xxl-5 col-xl-3 col-lg-3 col-md-3">
                     <div class="testimonial__slider-arrow-15 text-md-end  mb-65">
                        <button class="testimonial-15-button-prev"><i class="fa-regular fa-chevron-left"></i></button>
                        <button class="testimonial-15-button-next"><i class="fa-regular fa-chevron-right"></i></button>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-xxl-12">
                     <div class="testimonial__slider-15 testimonial__style-3 wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s">
                        <div class="testimonial__slider-active-15 swiper-container">
                           <div class="swiper-wrapper">
                                <?php foreach ($settings['reviews_list'] as $index => $item) :
                                    if ( !empty($item['reviewer_image']['url']) ) {
                                    $tp_reviewer_image = !empty($item['reviewer_image']['id']) ? wp_get_attachment_image_url( $item['reviewer_image']['id'], $settings['thumbnail_size_size']) : $item['reviewer_image']['url'];
                                    $tp_reviewer_image_alt = get_post_meta($item["reviewer_image"]["id"], "_wp_attachment_image_alt", true);
                                    }
                                ?>
                              <div class="testimonial__item-6 transition-3 mb-60 swiper-slide tp-el-box">
                                 <div class="testimonial__rating testimonial__rating-6 tp-el-box-rating">
                                        <?php if($item['review_rating'] == '1'): ?>
                                            <i class="fa-solid fa-star"></i>
                                        <?php elseif($item['review_rating'] == '2'): ?>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>

                                        <?php elseif($item['review_rating'] == '3'): ?>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>

                                        <?php elseif($item['review_rating'] == '4'): ?>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        
                                        <?php else: ?>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        <?php endif; ?>
                                 </div>

                                <?php if ( !empty($item['review_content']) ) : ?>
                                <div class="testimonial__content-6">
                                    <p class="tp-el-box-desc"><?php echo tp_kses($item['review_content']); ?></p>
                                </div>
                                <?php endif; ?>

                                 <div class="testimonial__avater-6 d-flex align-items-center">
                                 <?php if ( !empty($tp_reviewer_image) ) : ?>
                                    <div class="testimonial__avater-thumb-6">
                                        <img src="<?php echo esc_url($tp_reviewer_image); ?>" alt="<?php echo esc_url($tp_reviewer_image_alt); ?>">
                                    </div>

                                    <?php endif; ?>
                                    <div class="testimonial__avater-info-6">
                                       <?php if ( !empty($item['reviewer_name']) ) : ?>
                                        <h3 class="testimonial__avater-title-6 tp-el-box-title"><?php echo tp_kses($item['reviewer_name']); ?></h3>
                                        <?php endif; ?>
                                        <?php if ( !empty($item['reviewer_title']) ) : ?>
                                        <span class="testimonial__avater-designation-6 tp-el-box-subtitle"><?php echo tp_kses($item['reviewer_title']); ?></span>
                                        <?php endif; ?>
                                    </div>
                                 </div>
                              </div>
                              <?php endforeach; ?>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <?php if(!empty($settings['brand_switch'])) :?>
               <div class="row align-items-center">
                  <div class="col-xl-4 col-lg-4">
                    <?php if(!empty($settings['brand_list_title'])) : ?>
                        <div class="brand__slider-7">
                            <span class="tp-el-brand-title"><?php echo esc_html($settings['brand_list_title']); ?></span>
                        </div>
                    <?php endif; ?>
                  </div>
                  <div class="col-xl-8 col-lg-8">
                     <div class="brand__slider-7">
                        <div class="brand__slider-active-7 swiper-container">
                           <div class="swiper-wrapper">
                           <?php foreach ($settings['brand_list'] as $item) :
                                        if ( !empty($item['brand_image']['url']) ) {
                                            $tp_brand_image_url = !empty($item['brand_image']['id']) ? wp_get_attachment_image_url( $item['brand_image']['id'], $settings['thumbnail_size']) : $item['brand_image']['url'];
                                            $tp_brand_image_alt = get_post_meta($item["brand_image"]["id"], "_wp_attachment_image_alt", true);
                                        }
                                    ?>
                              <div class="brand__item-7 text-center swiper-slide">
                                    <?php if (!empty($item['brand_url'])) : ?>
                                    <a href="<?php echo esc_url($item['brand_url']); ?>"><img src="<?php echo esc_url($tp_brand_image_url); ?>" alt="<?php echo esc_url($tp_brand_image_alt); ?>"></a>
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
               <?php endif; ?>
            </div>
         </section>
         <!-- testimonial area end -->

		<!-- default style -->
		<?php else:
            $this->add_render_attribute('title_args', 'class', 'section__title section__title-1-2 tp-el-title');
            $bloginfo = get_bloginfo( 'name' );
            
            if ( !empty($settings['tp_title_image']['url']) ) {
                $tp_title_image_url = !empty($settings['tp_title_image']['id']) ? wp_get_attachment_image_url( $settings['tp_title_image']['id'], $settings['thumbnail_size']) : $settings['tp_title_image']['url'];
                $tp_title_image_alt = get_post_meta($settings["tp_title_image"]["id"], "_wp_attachment_image_alt", true);
            } 

            if ('2' == $settings['tp_testimonial_btn_link_type']) {
                $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_testimonial_btn_page_link']));
                $this->add_render_attribute('tp-button-arg', 'target', '_self');
                $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn tp-link-btn-3 tp-el-btn');
            } else {
                if ( ! empty( $settings['tp_testimonial_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'tp-button-arg', $settings['tp_testimonial_btn_link'] );
                    $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn tp-link-btn-3 tp-el-btn');
                }
            }

            $enbale_bg = $settings['enable_title_bg'] == 'yes' ? 'enable-background' : '';
        ?>


         <!-- testimonial area start -->
         <section class="testimonial__area pb-120 tp-el-section">
            <div class="container">
               <div class="row">
                  <div class="col-xl-5 col-lg-5">
                     <div class="testimonial__wrapper-14 wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s">
                        <div class="testimonial__info tp-el-content">
                            <?php if(!empty($settings['tp_section_subtitle'])) :?>
                            <div class="section__title-wrapper-9 mb-10">
                                <span class="section__title-pre section__title-pre-1-3 tp-el-subtitle"><?php echo tp_kses($settings['tp_section_subtitle']); ?></span>
                            </div>
                            <?php endif; ?>

                            <?php if(!empty($settings['tp_section_title'])) :?>
                           <h3 class="testimonial__info-title tp-el-title <?php echo esc_attr($enbale_bg); ?>" data-background="<?php echo esc_url($tp_title_image_url); ?>"><?php echo tp_kses($settings['tp_section_title']); ?></h3>
                           <?php endif; ?>

                           <?php if ( !empty($settings['tp_section_desc']) ) : ?>
                                <p><?php echo tp_kses( $settings['tp_section_desc'] ); ?></p>
                            <?php endif; ?>

                            <?php if (!empty($settings['tp_testimonial_btn_text'])) : ?>
                           <div class="testimonial__info-btn">
                              <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>>
                              <?php echo $settings['tp_testimonial_btn_text']; ?> 
                                 <span>
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path d="M1 7H13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                       <path d="M7 1L13 7L7 13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                 </span>
                              </a>
                           </div>
                           <?php endif; ?>                    
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-7 col-lg-7">
                     <div class="testimonial__slider-14 testimonial__style-black p-relative wow fadeInUp white-bg tp-el-box" data-wow-delay=".6s" data-wow-duration="1s">
                        <div class="testimonial__slider-active-14 swiper-container">
                           <div class="swiper-wrapper">
                                <?php foreach ($settings['reviews_list'] as $index => $item) :
                                    if ( !empty($item['reviewer_image']['url']) ) {
                                    $tp_reviewer_image = !empty($item['reviewer_image']['id']) ? wp_get_attachment_image_url( $item['reviewer_image']['id'], $settings['thumbnail_size_size']) : $item['reviewer_image']['url'];
                                    $tp_reviewer_image_alt = get_post_meta($item["reviewer_image"]["id"], "_wp_attachment_image_alt", true);
                                    }
                                ?>
                              <div class="testimonial__item-4 swiper-slide d-sm-flex align-items-center tp-el-box">
                                 <?php if ( !empty($tp_reviewer_image) ) : ?>
                                    <div class="testimonial__avater-thumb-4">
                                        <img src="<?php echo esc_url($tp_reviewer_image); ?>" alt="<?php echo esc_url($tp_reviewer_image_alt); ?>">
                                    </div>
                                    <?php endif; ?>
                                 <div class="testimonial__content-4">
                                    <div class="testimonial__icon">
                                       <span>
                                          <svg width="44" height="38" viewBox="0 0 44 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                                             <path d="M18.5409 19.2088V38H0V33.1282C0 25.5189 0.553459 19.8584 1.66038 16.1465C2.85954 12.3419 5.94968 6.95971 10.9308 0L18.8176 4.45421C14.6667 11.5995 12.2683 16.5177 11.6226 19.2088H18.5409ZM43.7233 19.2088V38H25.1824V33.1282C25.1824 25.5189 25.7358 19.8584 26.8428 16.1465C28.0419 12.3419 31.1321 6.95971 36.1132 0L44 4.45421C39.8491 11.5995 37.4507 16.5177 36.805 19.2088H43.7233Z" fill="currentColor"/>
                                          </svg>                                          
                                       </span>
                                    </div>
                                    <div class="testimonial__rating tp-el-box-rating">
                                        <?php if($item['review_rating'] == '1'): ?>
                                            <i class="fa-solid fa-star"></i>
                                        <?php elseif($item['review_rating'] == '2'): ?>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>

                                        <?php elseif($item['review_rating'] == '3'): ?>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>

                                        <?php elseif($item['review_rating'] == '4'): ?>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        
                                        <?php else: ?>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        <?php endif; ?>
                                    </div>
                                    <?php if ( !empty($item['review_content']) ) : ?>
                                    <p class="tp-el-box-desc"><?php echo tp_kses($item['review_content']); ?></p>
                                    <?php endif; ?>

                                          
                                    <div class="testimonial__avater-info-4">
                                        <?php if ( !empty($item['reviewer_name']) ) : ?>
                                        <h4 class="testimonial__avater-title-4 tp-el-box-title"><?php echo tp_kses($item['reviewer_name']); ?></h4>
                                        <?php endif; ?>
                                        <?php if ( !empty($item['reviewer_title']) ) : ?>
                                        <span class="testimonial__avater-designation-4 tp-el-box-desc"><?php echo tp_kses($item['reviewer_title']); ?></span>
                                        <?php endif; ?>
                                    </div>                                                   
                                 </div>
                              </div>
                              <?php endforeach; ?>
                           </div>
                        </div>
                        <div class="testimonial-slider-dot-14 tp-swiper-dot"></div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- testimonial area end -->

        <?php endif; ?>

        <?php
	}
}

$widgets_manager->register( new TP_Testimonial_Slider() );
