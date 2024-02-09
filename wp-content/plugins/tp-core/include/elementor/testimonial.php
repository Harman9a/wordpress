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
class TP_Testimonial extends Widget_Base {

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
		return 'tp-testimonial';
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
		return __( 'Testimonial', 'tpcore' );
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
                    'layout-7' => esc_html__('Layout 7', 'tpcore'),
                    'layout-8' => esc_html__('Layout 8', 'tpcore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->tp_section_title_render_controls('testimonial', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.');
   
        $this->start_controls_section(
            'tp_section_subtitle_line_sec',
                [
                  'label' => esc_html__( 'Subtitle Line Color', 'tpcore' ),
                  'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                  'condition' =>[
                    'tp_design_style' => ['layout-7'],
                    ]
                ]
           );
           
           $this->add_control(
               'tp_subtitle_line',
               [
                   'label' => esc_html__( 'Line BG Color', 'tpcore' ),
                   'type' => Controls_Manager::TEXT,
                   'selectors' => [
                       '{{WRAPPER}} .section__title-pre-9::after' => 'background: {{VALUE}};',
                   ],
                   'placeholder' => esc_html__( 'red', 'tpcore' ),
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
                    'repeater_condition' => 'style_2'
                ],
                
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

        $this->add_control(
         'testimonial_bg_switch',
         [
           'label'        => esc_html__( 'Enable Bg', 'tpcore' ),
           'type'         => \Elementor\Controls_Manager::SWITCHER,
           'label_on'     => esc_html__( 'Show', 'tpcore' ),
           'label_off'    => esc_html__( 'Hide', 'tpcore' ),
           'return_value' => 'yes',
           'default'      => 'yes',
           'condition' =>[
            'tp_design_style' => 'layout-3'
           ]
         ]
        );

        $this->add_group_control(
           \Elementor\Group_Control_Background::get_type(),
           [
              'name'     => 'testimonial_bg',
              'label'   => esc_html__( 'Background Color', 'tpcore' ),
              'types'    => [ 'classic', 'gradient', 'video' ],
              'selector' => '{{WRAPPER}} .testimonial__bg',
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


        $this->start_controls_section(
         'tp_testimonial_rating_logo_sec',
            [
                'label' => esc_html__( 'Brand Rating', 'tpcore' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                'tp_design_style' => 'layout-4'
                ]
            ]
        );
        
        $this->add_control(
         'tp_testimonial_brand_rating_logo',
            [
            'label'   => esc_html__( 'Section Label', 'tpcore' ),
            'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
            ]
        );

        $this->add_control(
            'tp_testimonial_brand_rating',
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
            ]
        );

        $this->add_control(
        'tp_testimonial_brand_rating_text',
            [
                'label'       => esc_html__( 'Brand Rating Text', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( '4.8 Rating on Google', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tp_testimonial_brand_rating_logo_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );
        
        
        $this->end_controls_section();

        // _tp_image
		$this->start_controls_section(
            '_tp_image',
            [
                'label' => esc_html__('Background Image', 'tp-core'),
                'condition' => [
                    'tp_design_style' => 'layout-2'
                ]
            ]
        );
        $this->add_control(
            'tp_image',
            [
                'label' => esc_html__( 'Choose Image', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_design_style' => ['layout-1', 'layout-2', 'layout-3']
                ]
            ]
        );


        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tp_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'tp_testimonial_shape_sec',
            [
                'label' => esc_html__( 'Shape Switch', 'tpcore' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'tp_design_style' => ['layout-4', 'layout-8']
                ]
            ]
        );

        $this->add_control(
         'tp_testimonial_shape_switch',
            [
            'label'        => esc_html__( 'Shape On/Off', 'tpcore' ),
            'type'         => \Elementor\Controls_Manager::SWITCHER,
            'label_on'     => esc_html__( 'Show', 'tpcore' ),
            'label_off'    => esc_html__( 'Hide', 'tpcore' ),
            'return_value' => 'yes',
            'default'      => 'yes',
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
                    'tp_design_style' => 'layout-1'
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
            'default'     => esc_html__( 'Global', 'tpcore' ),
            'placeholder' => esc_html__( 'your title here', 'tpcore' ),
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

	}

    // style_tab_content
    protected function style_tab_content(){
  
        $this->tp_section_style_controls('section_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('section_subtitle', 'Section - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('section_title', 'Section - Title', '.tp-el-title');
        $this->tp_basic_style_controls('section_description', 'Section - Description', '.tp-el-content p');

        $this->tp_basic_style_controls('testimonial_box_title', 'Testimonial - Name', '.tp-el-box-title');
        $this->tp_basic_style_controls('testimonial_box_subtitle', 'Testimonial - Designation', '.tp-el-box-subtitle');
        $this->tp_basic_style_controls('testimonial_box_desc', 'Testimonial - Description', '.tp-el-box-desc');
        $this->tp_basic_style_controls('testimonial_box_desc_2', 'Testimonial - Rating - Text', '.tp-el-box-desc-2');
        $this->tp_basic_style_controls('testimonial_box_rating', 'Testimonial - Brand', '.tp-el-box-brand');
        $this->tp_basic_style_controls('testimonial_box_rating_2', 'Testimonial - Brand', '.tp-el-box-rating i');
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

			if ( !empty($settings['tp_image']['url']) ) {
					$tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
					$tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
			}

			$this->add_render_attribute('title_args', 'class', 'section__title-4 section__title-4-white tp-el-title');

		?>

         <!-- testimonial area start -->
         <section class="testimonial__area pt-110 pb-120 black-bg include-bg p-relative z-index-1 jarallax tp-el-section" data-overlay="dark" data-overlay-opacity="6" data-background="<?php echo esc_url($tp_image); ?>">
            <div class="container">
                <?php if ( !empty($settings['tp_testimonial_section_title_show']) ) : ?>
                <div class="row">
                    <div class="col-xxl-5 col-xl-5 col-lg-5">
                        <div class="section__title-wrapper-4 mb-50">

                            <?php if ( !empty($settings['tp_testimonial_sub_title']) ) : ?>
                            <span class="section__title-pre-4 section__title-pre-4-white tp-el-subtitle">
                                <?php echo tp_kses( $settings['tp_testimonial_sub_title'] ); ?>
                            </span>
                            <?php endif; ?>

                            <?php
                                if ( !empty($settings['tp_testimonial_title' ]) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['tp_testimonial_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        tp_kses( $settings['tp_testimonial_title' ] )
                                        );
                                endif;
                            ?>
                        </div>
                  </div>
               </div>
               <?php endif; ?>
               <div class="row">
                  <div class="col-xxl-8 col-xl-8 col-lg-10">
                     <div class="testimonial__slider-4">
                        <div class="testimonial__slider-active-4 swiper-container">
                           <div class="swiper-wrapper">
                                <?php foreach ($settings['reviews_list'] as $index => $item) :
                                    if ( !empty($item['reviewer_image']['url']) ) {
                                    $tp_reviewer_image = !empty($item['reviewer_image']['id']) ? wp_get_attachment_image_url( $item['reviewer_image']['id'], $settings['thumbnail_size_size']) : $item['reviewer_image']['url'];
                                    $tp_reviewer_image_alt = get_post_meta($item["reviewer_image"]["id"], "_wp_attachment_image_alt", true);
                                    }
                                ?>
                              <div class="testimonial__item-4 swiper-slide d-sm-flex align-items-center">
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
                                        <span class="testimonial__avater-designation-4 tp-el-box-subtitle"><?php echo tp_kses($item['reviewer_title']); ?></span>
                                        <?php endif; ?>
                                    </div>
                                 </div>
                              </div>
                              <?php endforeach; ?>

                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xxl-2 col-xl-2 col-lg-2">
                     <div class="testimonial__slider-nav-4 d-flex flex-lg-column">
                        <button type="button" class="testimonial-4-button-prev"><i class="fa-regular fa-angle-left"></i></button>
                        <button type="button" class="testimonial-4-button-next"><i class="fa-regular fa-angle-right"></i></button>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- testimonial area end -->

        <!--    testimonial style 3 -->
        <?php elseif ( $settings['tp_design_style']  == 'layout-3' ):

            if ( !empty($settings['tp_image']['url']) ) {
                    $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                    $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }

            $this->add_render_attribute('title_args', 'class', 'section__title-2 tp-el-title');

        ?>

         <!-- testimonial area start -->
         <section class="testimonial__area p-relative z-index-1">
            <?php if(!empty($settings['testimonial_bg_switch']))  :?>
            <div class="testimonial__bg"></div>
            <?php endif; ?>
            <div class="container">
            <?php if ( !empty($settings['tp_testimonial_section_title_show']) ) : ?>
               <div class="row">
                  <div class="col-xxl-12">
                     <div class="section__title-wrapper-2 text-center mb-60">
                        <?php if ( !empty($settings['tp_testimonial_sub_title']) ) : ?>
                            <span class="section__title-pre-2 tp-el-subtitle">
                                <?php echo tp_kses( $settings['tp_testimonial_sub_title'] ); ?>
                            </span>
                            <?php endif; ?>

                            <?php
                                if ( !empty($settings['tp_testimonial_title' ]) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['tp_testimonial_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        tp_kses( $settings['tp_testimonial_title' ] )
                                        );
                                endif;
                            ?>
                     </div>
                  </div>
               </div>
                <?php endif; ?>

               <div class="testimonial__inner-2 z-index-1 p-relative wow fadeInUp" data-wow-delay=".5s" data-wow-duration="1s" data-bg-color="theme-2" data-background="assets/img/testimonial/2/testimonial-shape-1.png">
                  <div class="row justify-content-center">
                     <div class="col-xxl-8 col-xl-8 col-lg-10 col-md-11">
                        <div class="testimonial__slider-2">
                           <div class="row justify-content-center">
                              <div class="col-xxl-5 col-xl-5 col-lg-7 col-md-8 col-sm-8 col-8">
                                 <div class="testimonial__slider-nav">
                                 <?php foreach ($settings['reviews_list'] as $index => $item) :
                                    if ( !empty($item['reviewer_image']['url']) ) {
                                        $tp_reviewer_image = !empty($item['reviewer_image']['id']) ? wp_get_attachment_image_url( $item['reviewer_image']['id'], $settings['thumbnail_size_size']) : $item['reviewer_image']['url'];
                                        $tp_reviewer_image_alt = get_post_meta($item["reviewer_image"]["id"], "_wp_attachment_image_alt", true);
                                        }
                                    ?>
                                    <div class="testimonial__slider-thumb-nav">
                                       <div class="tp-border-loader">
                                          <svg width="116" height="116" viewBox="0 0 116 116" fill="none" xmlns="http://www.w3.org/2000/svg">
                                             <circle cx="58" cy="58" r="56.5" stroke-width="1"></circle> 
                                             <circle cx="58" cy="58" r="56.5" stroke-width="3" stroke-linecap="round" style="stroke-dashoffset: -356px; stroke-dasharray: 0px, 366px;"></circle>
                                         </svg>
                                       </div>
                                       <?php if ( !empty($tp_reviewer_image) ) : ?>
                                       <img src="<?php echo esc_url($tp_reviewer_image); ?>" alt="<?php echo esc_url($tp_reviewer_image_alt); ?>">
                                        <?php endif; ?>

                                    </div>
                                    <?php endforeach; ?>
                                 </div>
                              </div>
                           </div>
                           <div class="testimonial__slider-active-2">
                            <?php foreach ($settings['reviews_list'] as $index => $item) :
                                    if ( !empty($item['reviewer_image']['url']) ) {
                                    $tp_reviewer_image = !empty($item['reviewer_image']['id']) ? wp_get_attachment_image_url( $item['reviewer_image']['id'], $settings['thumbnail_size_size']) : $item['reviewer_image']['url'];
                                    $tp_reviewer_image_alt = get_post_meta($item["reviewer_image"]["id"], "_wp_attachment_image_alt", true);
                                    }
                                ?>
                              <div class="testimonial__item-2">
                                 <div class="testimonial__content-2">
                                    <?php if ( !empty($item['review_content']) ) : ?>
                                    <p><?php echo tp_kses($item['review_content']); ?></p>
                                    <?php endif; ?>

                                    <div class="testimonial__avater-info-2">
                                    <?php if ( !empty($item['reviewer_name']) ) : ?>
                                       <h3 class="testimonial__avater-title-2"><?php echo tp_kses($item['reviewer_name']); ?></h3>
                                       <?php endif; ?>

                                       <?php if ( !empty($item['reviewer_title']) ) : ?>
                                       <span class="testimonial__avater-designation-2"><?php echo tp_kses($item['reviewer_title']); ?></span>
                                       <?php endif; ?>
                                    </div>
                                 </div>
                              </div>
                              <?php endforeach; ?>
                           </div>
                           
                        </div>
                     </div>
                  </div>
                  <div class="testimonial__slider-arrow-2"></div>
               </div>
            </div>
         </section>
         <!-- testimonial area end -->

        <?php elseif ( $settings['tp_design_style']  == 'layout-4' ):

            if ( !empty($settings['tp_testimonial_brand_rating_logo']['url']) ) {
                $tp_testimonial_brand_rating_logo = !empty($settings['tp_testimonial_brand_rating_logo']['id']) ? wp_get_attachment_image_url( $settings['tp_testimonial_brand_rating_logo']['id'], $settings['tp_image_size_size']) : $settings['tp_testimonial_brand_rating_logo']['url'];
                $tp_testimonial_brand_rating_logo_alt = get_post_meta($settings["tp_testimonial_brand_rating_logo"]["id"], "_wp_attachment_image_alt", true);
            }

            $this->add_render_attribute('title_args', 'class', 'section__title-5 tp-el-title');
            $bloginfo = get_bloginfo( 'name' ); 
        ?>


         <!-- testimonial area start -->
         <section class="testimonial__area p-relative z-index-1 pt-120 testimonial__gradient-bg fix pb-125 tp-el-section">

            <?php if(!empty($settings['tp_testimonial_shape_switch'])): ?>
            <div class="testimonial__shape">
               <img class="testimonial__shape-3" src="<?php echo get_template_directory_uri() . '/assets/img/testimonial/5/shape/testimonial-shape-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="testimonial__shape-4" src="<?php echo get_template_directory_uri() . '/assets/img/testimonial/5/shape/testimonial-shape-2.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="testimonial__shape-5" src="<?php echo get_template_directory_uri() . '/assets/img/testimonial/5/shape/testimonial-shape-3.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="testimonial__shape-6" src="<?php echo get_template_directory_uri() . '/assets/img/testimonial/5/shape/testimonial-shape-4.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="testimonial__shape-7" src="<?php echo get_template_directory_uri() . '/assets/img/testimonial/5/shape/testimonial-shape-5.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
            </div>
            <?php endif; ?>

            <div class="container">
               <div class="row">
                  <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-10">
                    <?php if ( !empty($settings['tp_testimonial_section_title_show']) ) : ?>
                        <div class="section__title-wrapper-5 mb-10">
                            <?php if ( !empty($settings['tp_testimonial_sub_title']) ) : ?>
                            <span class="section__title-pre-5 tp-el-subtitle">
                                <?php echo tp_kses( $settings['tp_testimonial_sub_title'] ); ?>
                            </span>
                            <?php endif; ?>

                            <?php
                            if ( !empty($settings['tp_testimonial_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['tp_testimonial_title_tag'] ),
                                    $this->get_render_attribute_string( 'title_args' ),
                                    tp_kses( $settings['tp_testimonial_title' ] )
                                    );
                            endif;
                        ?>
                        </div>
                    <?php endif; ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col-xxl-12">
                     <div class="testimonial__slider-5 wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s">
                        <div class="testimonial__slider-active-5 pt-50 pb-50">
                            <?php foreach ($settings['reviews_list'] as $index => $item) :
                                if ( !empty($item['reviewer_image']['url']) ) {
                                $tp_reviewer_image = !empty($item['reviewer_image']['id']) ? wp_get_attachment_image_url( $item['reviewer_image']['id'], $settings['thumbnail_size_size']) : $item['reviewer_image']['url'];
                                $tp_reviewer_image_alt = get_post_meta($item["reviewer_image"]["id"], "_wp_attachment_image_alt", true);
                                }
                            ?>
                           <div class="testimonial__item-5">

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
                                    <h3 class="testimonial__avater-title-5 tp-el-box-title"><?php echo tp_kses($item['reviewer_name']); ?></h3>
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
               <div class="testimonial__nav-wrapper">
                  <div class="row align-items-center">
                     <div class="col-sm-6">
                        <div class="testimonial__rating-5 d-flex align-items-center">

                            <?php if(!empty($tp_testimonial_brand_rating_logo)) : ?>
                           <div class="testimonial__rating-logo mr-15">
                              <img src="<?php echo esc_url($tp_testimonial_brand_rating_logo); ?>" alt="<?php echo esc_url($tp_testimonial_brand_rating_logo_alt); ?>">
                           </div>
                           <?php endif; ?>

                           <div class="testimonial__rating-content">
                              <div class="testimonial__rating testimonial__rating-5 tp-el-box-rating">
                                <?php if($settings['tp_testimonial_brand_rating'] == '1'): ?>
                                    <i class="fa-solid fa-star"></i>
                                <?php elseif($settings['tp_testimonial_brand_rating'] == '2'): ?>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>

                                <?php elseif($settings['tp_testimonial_brand_rating'] == '3'): ?>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>

                                <?php elseif($settings['tp_testimonial_brand_rating'] == '4'): ?>
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
                              <p class="tp-el-box-desc-2"><?php echo esc_html($settings['tp_testimonial_brand_rating_text']); ?></p>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="testimonial__nav-5 testimonial-slider-5-arrow text-sm-end"></div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- testimonial area end -->

        <?php elseif ( $settings['tp_design_style']  == 'layout-5' ):

            $this->add_render_attribute('title_args', 'class', 'section__title-7 tp-el-title');
            $bloginfo = get_bloginfo( 'name' ); 
        ?>

         <!-- testimonial area start -->
         <section class="testimonial__area green-light-bg-4 pt-110 pb-95 fix">
            <div class="container">
            <?php if ( !empty($settings['tp_testimonial_section_title_show']) ) : ?>
               <div class="row justify-content-center">
                  <div class="col-xxl-9">
                     <div class="section__title-wrapper-7 text-center mb-60">
                                <?php if ( !empty($settings['tp_testimonial_sub_title']) ) : ?>
                                <span class="section__title-pre-7 tp-el-subtitle">
                                    <?php echo tp_kses( $settings['tp_testimonial_sub_title'] ); ?>
                                </span>
                                <?php endif; ?>

                              <?php
                                if ( !empty($settings['tp_testimonial_title' ]) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['tp_testimonial_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        tp_kses( $settings['tp_testimonial_title' ] )
                                        );
                                endif;
                            ?>

                        <?php if ( !empty($settings['tp_testimonial_description']) ) : ?>
                            <p><?php echo tp_kses( $settings['tp_testimonial_description'] ); ?></p>
                        <?php endif; ?>

                     </div>
                  </div>
               </div>
               <?php endif; ?>
               <div class="row">
                  <div class="col-xxl-12">
                     <div class="testimonial__slider-7">
                        <div class="testimonial__active-7 swiper-container">
                           <div class="swiper-wrapper">

                            <?php foreach ($settings['reviews_list'] as $index => $item) :
                                if ( !empty($item['reviewer_image']['url']) ) {
                                $tp_reviewer_image = !empty($item['reviewer_image']['id']) ? wp_get_attachment_image_url( $item['reviewer_image']['id'], $settings['thumbnail_size_size']) : $item['reviewer_image']['url'];
                                $tp_reviewer_image_alt = get_post_meta($item["reviewer_image"]["id"], "_wp_attachment_image_alt", true);
                                }
                            ?>
                              <div class="testimonial__item-7 mb-80 transition-3 white-bg swiper-slide">
                                 <div class="testimonial__rating testimonial__rating-7 tp-el-box-rating">
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
                                 <div class="testimonial__content-7">
                                    <?php echo tp_kses($item['review_content']); ?>
                                 </div>
                                 <?php endif; ?>
                                 <div class="testimonial__avater-6 d-flex align-items-center">
                                 <?php if ( !empty($tp_reviewer_image) ) : ?>
                                    <div class="testimonial__avater-thumb-7">
                                    <img src="<?php echo esc_url($tp_reviewer_image); ?>" alt="<?php echo esc_url($tp_reviewer_image_alt); ?>">
                                    </div>
                                    <?php endif; ?>
                                                
                                    <div class="testimonial__avater-info-7">
                                        <?php if ( !empty($item['reviewer_name']) ) : ?>
                                            <h3 class="testimonial__avater-title-7 tp-el-box-title"><?php echo tp_kses($item['reviewer_name']); ?></h3>
                                        <?php endif; ?>

                                       <?php if ( !empty($item['reviewer_title']) ) : ?>
                                            <span class="testimonial__avater-designation-7"><?php echo tp_kses($item['reviewer_title']); ?></span>
                                       <?php endif; ?>
                                    </div>
                                 </div>
                              </div>
                              <?php endforeach; ?>
                           </div>
                        </div>
                        <div class="testimonial-slider-dot-7 tp-swiper-dot text-center mt--30 p-relative z-index-1"></div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- testimonial area end -->

         <?php elseif ( $settings['tp_design_style']  == 'layout-6' ):
            $this->add_render_attribute('title_args', 'class', 'section__title-6 tp-el-title');
            $bloginfo = get_bloginfo( 'name' ); 
        ?>

         <!-- testimonial area start -->
         <section class="testimonial__area pt-110 grey-bg-7 fix">
            <div class="container">
            <?php if ( !empty($settings['tp_testimonial_section_title_show']) ) : ?>
               <div class="row align-items-end">
                  <div class="col-xxl-6 col-xl-9 col-lg-9 col-md-9">
                     <div class="section__title-wrapper-6 mb-60">
                        <?php
                            if ( !empty($settings['tp_testimonial_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['tp_testimonial_title_tag'] ),
                                    $this->get_render_attribute_string( 'title_args' ),
                                    tp_kses( $settings['tp_testimonial_title' ] )
                                    );
                            endif;
                        ?>
                     </div>
                  </div>
                  <div class="col-xxl-6 col-xl-3 col-lg-3 col-md-3">
                     <div class="testimonial__slider-arrow-6 text-md-end  mb-65">
                        <button class="testimonial-6-button-prev"><i class="fa-regular fa-chevron-left"></i></button>
                        <button class="testimonial-6-button-next"><i class="fa-regular fa-chevron-right"></i></button>
                     </div>
                  </div>
               </div>
               <?php endif; ?>
               <div class="row">
                  <div class="col-xxl-12">
                     <div class="testimonial__slider-6 wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s">
                        <div class="testimonial__slider-active-6 swiper-container">
                           <div class="swiper-wrapper">
                                <?php foreach ($settings['reviews_list'] as $index => $item) :
                                    if ( !empty($item['reviewer_image']['url']) ) {
                                    $tp_reviewer_image = !empty($item['reviewer_image']['id']) ? wp_get_attachment_image_url( $item['reviewer_image']['id'], $settings['thumbnail_size_size']) : $item['reviewer_image']['url'];
                                    $tp_reviewer_image_alt = get_post_meta($item["reviewer_image"]["id"], "_wp_attachment_image_alt", true);
                                }
                                ?>
                              <div class="testimonial__item-6 transition-3 mb-75 swiper-slide">
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
                                    <p><?php echo tp_kses($item['review_content']); ?></p>
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
                                            <span class="testimonial__avater-designation-6"><?php echo tp_kses($item['reviewer_title']); ?></span>
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
            </div>
         </section>
         <!-- testimonial area end -->

        <?php elseif ( $settings['tp_design_style']  == 'layout-7' ):
            $this->add_render_attribute('title_args', 'class', 'section__title-9 tp-el-title');
            $bloginfo = get_bloginfo( 'name' ); 
        ?>
         <!-- testimonial area start -->
         <section class="testimonial__area pt-130 pb-135">
            <div class="container">
            <?php if ( !empty($settings['tp_testimonial_section_title_show']) ) : ?>
               <div class="row">
                  <div class="col-xxl-12">
                        <div class="section__title-wrapper-9 is-center mb-60">
                            <?php if ( !empty($settings['tp_testimonial_sub_title']) ) : ?>
                            <span class="section__title-pre-9 tp-el-subtitle">
                                <?php echo tp_kses( $settings['tp_testimonial_sub_title'] ); ?>
                            </span>
                            <?php endif; ?>
                            <?php
                                if ( !empty($settings['tp_testimonial_title' ]) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['tp_testimonial_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        tp_kses( $settings['tp_testimonial_title' ] )
                                        );
                                endif;
                            ?>
                        </div>                           
                  </div>
               </div>
               <?php endif; ?>
               <div class="row justify-content-center">
                  <div class="col-xxl-12">
                     <div class="testimonial__slider-9 p-relative">
                        <div class="testimonial__slider-active-9">
                                                      
                            <?php foreach ($settings['reviews_list'] as $index => $item) : ?>
                           <div class="testimonial__item-9">
                              <div class="testimonial__content-9 text-center">
                                 <div class="testimonial__shape-quote-9">
                                    <img src="<?php echo get_template_directory_uri() . '/assets/img/testimonial/9/testimonial-quote-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                                 </div>
                                 
                                <?php if ( !empty($item['review_content']) ) : ?>
                                <?php echo tp_kses($item['review_content']); ?>
                                <?php endif; ?>
                          
                                 <div class="testimonial__avater-info-9">
                                    <?php if ( !empty($item['reviewer_name']) ) : ?>
                                    <h3 class="testimonial__avater-title-9"><?php echo tp_kses($item['reviewer_name']); ?></h3>
                                    <?php endif; ?>
                                 </div>
                              </div>
                           </div>
                           <?php endforeach; ?>
                        </div>
                        <div class="row justify-content-center">
                           <div class="col-xxl-6 col-xl-6 col-lg-7 col-md-10 col-sm-8">
                              <div class="testimonial__slider-nav-9 mt-35 mb-15 ml-25 mr-25">
                              <?php foreach ($settings['reviews_list'] as $index => $item) :
                                    if ( !empty($item['reviewer_image']['url']) ) {
                                        $tp_reviewer_image = !empty($item['reviewer_image']['id']) ? wp_get_attachment_image_url( $item['reviewer_image']['id'], $settings['thumbnail_size_size']) : $item['reviewer_image']['url'];
                                        $tp_reviewer_image_alt = get_post_meta($item["reviewer_image"]["id"], "_wp_attachment_image_alt", true);
                                        }
                                    ?>
                                 <div class="testimonial__slider-9-thumb-nav">
                                    <?php if ( !empty($tp_reviewer_image) ) : ?>
                                    <div class="tp-border-loader">
                                       <svg width="116" height="116" viewBox="0 0 116 116" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <circle cx="58" cy="58" r="56.5" stroke-width="0"></circle> 
                                          <circle cx="58" cy="58" r="56.5" stroke-width="3" stroke-linecap="round" style="stroke-dashoffset: -356px; stroke-dasharray: 0px, 366px;"></circle>
                                      </svg>
                                    </div>
                                    <img src="<?php echo esc_url($tp_reviewer_image); ?>" alt="<?php echo esc_url($tp_reviewer_image_alt); ?>">
                                    <?php endif; ?>
                                 </div>
                                 <?php endforeach; ?>
                                    
                              </div>
                           </div>
                        </div>
                        <div class="testimonial__slider-arrow-9 d-none d-md-block"></div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- testimonial area end -->

        <?php elseif ( $settings['tp_design_style']  == 'layout-8' ):
            $this->add_render_attribute('title_args', 'class', 'section__title-8 tp-el-title');
            $bloginfo = get_bloginfo( 'name' ); 
        ?>

         <!-- testimonial area start -->
         <section class="testimonial__area black-bg-12 pt-145 pb-100">
            <div class="container">
               <div class="row justify-content-center">
                  <div class="col-xxl-12">
                     <div class="testimonial__wrapper-8 z-index-1 p-relative pl-200 pr-200">
                     <?php if(!empty($settings['tp_testimonial_shape_switch'])): ?>
                        <div class="testimonial__shape">
                           <img class="testimonial__shape-8" src="<?php echo get_template_directory_uri() . '/assets/img/testimonial/8/testimonial-bg-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                        </div>
                        <?php endif; ?> 
                        <div class="testimonial__slider p-relative wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s">
                           <div class="testimonial__slider-active-8 swiper-container">
                              <div class="swiper-wrapper">
                                <?php foreach ($settings['reviews_list'] as $index => $item) : 
                                ?>
                                <div class="testimonial__item-8 swiper-slide">
                                    <div class="testimonial__content-8 text-center">
                                        <div class="testimonial__shape-quote-8">
                                            <img src="<?php echo get_template_directory_uri() . '/assets/img/testimonial/8/testimonial-quote-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                                        </div>
                                        <?php if ( !empty($item['review_content']) ) : ?>
                                        <p><?php echo tp_kses($item['review_content']); ?></p>
                                        <?php endif; ?>

                                        <div class="testimonial__avater-info-8">
                                            <?php if ( !empty($item['reviewer_name']) ) : ?>
                                            <h3 class="testimonial__avater-title-8 tp-el-box-title"><?php echo tp_kses($item['reviewer_name']); ?></h3>
                                            <?php endif; ?>                                                                                   

                                            <?php if ( !empty($item['reviewer_title']) ) : ?>
                                                    <span class="testimonial__avater-designation-8"><?php echo tp_kses($item['reviewer_title']); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                              </div>
                           </div>
                           <div class="testimonial__slider-8-thumb swiper-container">
                              <div class="swiper-wrapper">
                              <?php foreach ($settings['reviews_list'] as $index => $item) :
                                    if ( !empty($item['reviewer_image']['url']) ) {
                                    $tp_reviewer_image = !empty($item['reviewer_image']['id']) ? wp_get_attachment_image_url( $item['reviewer_image']['id'], $settings['thumbnail_size_size']) : $item['reviewer_image']['url'];
                                    $tp_reviewer_image_alt = get_post_meta($item["reviewer_image"]["id"], "_wp_attachment_image_alt", true);
                                }
                                ?>
                                 <div class="testimonial__avater-8 text-center swiper-slide">
                                    <?php if ( !empty($tp_reviewer_image) ) : ?>
                                    <div class="testimonial__avater-thumb-8">
                                       <img src="<?php echo esc_url($tp_reviewer_image); ?>" alt="<?php echo esc_url($tp_reviewer_image_alt); ?>">
                                    </div>
                                    <?php endif; ?>
                                 </div>
                                 <?php endforeach; ?>
                              </div>
                           </div>
                           <div class="testimonial-slider-dot-8 tp-swiper-dot tp-swiper-dot-2 text-center d-md-none"></div>
                        </div>
                        <div class="testimonial__slider-arrow-8 d-none d-md-block">
                           <button class="testimonial-8-button-prev"><i class="fa-regular fa-chevron-left"></i></button>
                           <button class="testimonial-8-button-next"><i class="fa-regular fa-chevron-right"></i></button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- testimonial area end -->
		<!-- default style -->
		<?php else:
            $this->add_render_attribute('title_args', 'class', 'section__title section__title-1-2 tp-el-title');
            $bloginfo = get_bloginfo( 'name' ); 
        ?>

        <!-- testimonial area start -->
        <section class="testimonial__area pt-120 pb-60 wow fadeInUp tp-el-section" data-wow-delay=".3s" data-wow-duration="1s">
            <div class="container">
               <div class="testimonial__inner p-relative pt-70 purple-bg">
                  <div class="testimonial__shape">
                     <img class="testimonial__shape-quote" src="<?php echo get_template_directory_uri() . '/assets/img/testimonial/testimonial-quote-icon.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                  </div>
                  <div class="row justify-content-center">
                     <div class="col-xxl-10 col-xl-9 col-lg-10 col-11">
                        <div class="testimonial__wrapper">
                         <?php if ( !empty($settings['tp_testimonial_section_title_show']) ) : ?>
                           <div class="section__title-wrapper text-center">
                                <?php if ( !empty($settings['tp_testimonial_sub_title']) ) : ?>
                                <span class="section__title-pre section__title-pre-1-2 tp-el-subtitle">
                                    <?php echo tp_kses( $settings['tp_testimonial_sub_title'] ); ?>
                                </span>
                                <?php endif; ?>

                              <?php
                                if ( !empty($settings['tp_testimonial_title' ]) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['tp_testimonial_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        tp_kses( $settings['tp_testimonial_title' ] )
                                        );
                                endif;
                            ?>
                           </div>
                           <?php endif; ?>

                           <div class="testimonial__slider pb-50">
                              <div class="testimonial__slider-active pt-45 pb-40 swiper-container">
                                 <div class="swiper-wrapper">
                                    <?php foreach ($settings['reviews_list'] as $index => $item) :
                                        if ( !empty($item['reviewer_image']['url']) ) {
                                        $tp_reviewer_image = !empty($item['reviewer_image']['id']) ? wp_get_attachment_image_url( $item['reviewer_image']['id'], $settings['thumbnail_size_size']) : $item['reviewer_image']['url'];
                                        $tp_reviewer_image_alt = get_post_meta($item["reviewer_image"]["id"], "_wp_attachment_image_alt", true);
                                        }
                                    ?>
                                    <div class="testimonial__item swiper-slide">
                                       <div class="row align-items-center">
                                          <div class="col-xxl-4 col-xl-4 col-lg-4">
                                             <div class="testimonial__avater d-flex align-items-center">
                                                <?php if ( !empty($tp_reviewer_image) ) : ?>
                                                <div class="testimonial__avater-thumb mr-15">
                                                   <img src="<?php echo esc_url($tp_reviewer_image); ?>" alt="<?php echo esc_url($tp_reviewer_image_alt); ?>">
                                                </div>
                                                <?php endif; ?>
                                                <div class="testimonial__avater-info">
                                                    <?php if ( !empty($item['reviewer_name']) ) : ?>
                                                   <h3 class="testimonial__avater-title tp-el-box-title"><?php echo tp_kses($item['reviewer_name']); ?></h3>
                                                   <?php endif; ?>

                                                   <?php if ( !empty($item['reviewer_title']) ) : ?>
                                                   <span class="testimonial__avater-designation tp-el-box-subtitle"><?php echo tp_kses($item['reviewer_title']); ?></span>
                                                   <?php endif; ?>
                                                </div>
                                             </div>
                                          </div>
                                          <?php if ( !empty($item['review_content']) ) : ?>
                                          <div class="col-xxl-8 col-xl-8 col-lg-8">
                                             <div class="testimonial__content">
                                                <p class="tp-el-box-desc"><?php echo tp_kses($item['review_content']); ?></p>
                                             </div>
                                          </div>
                                          <?php endif; ?>
                                       </div>
                                    </div>
                                    <?php endforeach; ?>
                                 </div>
                              </div>
                              <div class="testimonial-slider-dot tp-swiper-dot"></div>
                           </div>
                           
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <?php if(!empty($settings['brand_switch'])) :?>
            <div class="container">
               <div class="brand__inner purple-bg">
                  <div class="row justify-content-center">
                     <div class="col-xxl-10 col-xl-9 col-xl-10 col-11">
                        <div class="brand__area">
                           <div class="brand__thumb-wrapper d-sm-flex align-items-center text-center text-sm-start">
                            
                            <?php if(!empty($settings['brand_list_title'])) : ?>
                              <h3 class="brand__title tp-el-box-brand"><?php echo esc_html($settings['brand_list_title']); ?></h3>
                            <?php endif; ?>

                              <div class="brand__slider-active swiper-container">
                                 <div class="swiper-wrapper d-flex align-items-center justify-content-between">
                                    <?php foreach ($settings['brand_list'] as $item) :
                                        if ( !empty($item['brand_image']['url']) ) {
                                            $tp_brand_image_url = !empty($item['brand_image']['id']) ? wp_get_attachment_image_url( $item['brand_image']['id'], $settings['thumbnail_size']) : $item['brand_image']['url'];
                                            $tp_brand_image_alt = get_post_meta($item["brand_image"]["id"], "_wp_attachment_image_alt", true);
                                        }
                                    ?>
                                    <div class="brand__thumb swiper-slide">
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
                  </div>
               </div>
            </div>
            <?php endif; ?>
         </section>
         <!-- testimonial area end -->

        <?php endif; ?>

        <?php
	}
}

$widgets_manager->register( new TP_Testimonial() );
