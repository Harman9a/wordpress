<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Social_Slider extends Widget_Base {

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
		return 'tp-slider-social';
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
		return __( 'Social Slider', 'tpcore' );
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

    protected static function get_profile_names(){
        return [
            '500px' => esc_html__('500px', 'tpcore'),
            'apple' => esc_html__('Apple', 'tpcore'),
            'behance' => esc_html__('Behance', 'tpcore'),
            'bitbucket' => esc_html__('BitBucket', 'tpcore'),
            'codepen' => esc_html__('CodePen', 'tpcore'),
            'delicious' => esc_html__('Delicious', 'tpcore'),
            'deviantart' => esc_html__('DeviantArt', 'tpcore'),
            'digg' => esc_html__('Digg', 'tpcore'),
            'dribbble' => esc_html__('Dribbble', 'tpcore'),
            'email' => esc_html__('Email', 'tpcore'),
            'facebook' => esc_html__('Facebook', 'tpcore'),
            'flickr' => esc_html__('Flicker', 'tpcore'),
            'foursquare' => esc_html__('FourSquare', 'tpcore'),
            'github' => esc_html__('Github', 'tpcore'),
            'houzz' => esc_html__('Houzz', 'tpcore'),
            'instagram' => esc_html__('Instagram', 'tpcore'),
            'jsfiddle' => esc_html__('JS Fiddle', 'tpcore'),
            'linkedin' => esc_html__('LinkedIn', 'tpcore'),
            'medium' => esc_html__('Medium', 'tpcore'),
            'pinterest' => esc_html__('Pinterest', 'tpcore'),
            'product-hunt' => esc_html__('Product Hunt', 'tpcore'),
            'reddit' => esc_html__('Reddit', 'tpcore'),
            'slideshare' => esc_html__('Slide Share', 'tpcore'),
            'snapchat' => esc_html__('Snapchat', 'tpcore'),
            'soundcloud' => esc_html__('SoundCloud', 'tpcore'),
            'spotify' => esc_html__('Spotify', 'tpcore'),
            'stack-overflow' => esc_html__('StackOverflow', 'tpcore'),
            'tripadvisor' => esc_html__('TripAdvisor', 'tpcore'),
            'tumblr' => esc_html__('Tumblr', 'tpcore'),
            'twitch' => esc_html__('Twitch', 'tpcore'),
            'twitter' => esc_html__('Twitter', 'tpcore'),
            'vimeo' => esc_html__('Vimeo', 'tpcore'),
            'vk' => esc_html__('VK', 'tpcore'),
            'website' => esc_html__('Website', 'tpcore'),
            'whatsapp' => esc_html__('WhatsApp', 'tpcore'),
            'wordpress' => esc_html__('WordPress', 'tpcore'),
            'xing' => esc_html__('Xing', 'tpcore'),
            'yelp' => esc_html__('Yelp', 'tpcore'),
            'youtube' => esc_html__('YouTube', 'tpcore'),
        ];
    }
    public function get_tp_contact_form(){
        if ( ! class_exists( 'WPCF7' ) ) {
            return;
        }
        $tp_cfa         = array();
        $tp_cf_args     = array( 'posts_per_page' => -1, 'post_type'=> 'wpcf7_contact_form' );
        $tp_forms       = get_posts( $tp_cf_args );
        $tp_cfa         = ['0' => esc_html__( 'Select Form', 'tpcore' ) ];
        if( $tp_forms ){
            foreach ( $tp_forms as $tp_form ){
                $tp_cfa[$tp_form->ID] = $tp_form->post_title;
            }
        }else{
            $tp_cfa[ esc_html__( 'No contact form found', 'tpcore' ) ] = 0;
        }
        return $tp_cfa;
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

		
		$this->start_controls_section(
            'tp_main_slider',
            [
                'label' => esc_html__('Social Slider', 'tpcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
         'tp_slider_shape_switch',
         [
           'label'        => esc_html__( 'Shape On/Off', 'tpcore' ),
           'type'         => \Elementor\Controls_Manager::SWITCHER,
           'label_on'     => esc_html__( 'Show', 'tpcore' ),
           'label_off'    => esc_html__( 'Hide', 'tpcore' ),
           'return_value' => 'yes',
           'default'      => 'yes',
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
            'tp_box_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image' => esc_html__('Image', 'tpcore'),
                    'icon' => esc_html__('Icon', 'tpcore'),
                    'svg' => esc_html__('SVG', 'tpcore'),
                ],
                'condition' =>[
                    'repeater_condition' =>  'style_1'
                ]
            ]
        );
        $repeater->add_control(
            'tp_box_icon_svg',
            [
                'show_label' => false,
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__('SVG Code Here', 'tpcore'),
                'condition' => [
                    'tp_box_icon_type' => 'svg',
                    'repeater_condition' =>  'style_1'
                ]
            ]
        );

        $repeater->add_control(
            'tp_box_icon_image',
            [
                'label' => esc_html__('Upload Icon Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_box_icon_type' => 'image',
                    'repeater_condition' =>  'style_1'
                ]
            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'tp_box_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'tp_box_icon_type' => 'icon',
                        'repeater_condition' =>  'style_1'
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'tp_box_selected_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'fas fa-star',
                        'library' => 'solid',
                    ],
                    'condition' => [
                        'tp_box_icon_type' => 'icon',
                        'repeater_condition' =>  'style_1'
                    ]
                ]
            );
        }


        $repeater->add_control(
            'tp_slider_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('There are many variations of passages of Lorem Ipsum available but the majority have suffered alteration.', 'tpcore'),
                'placeholder' => esc_html__('Type section description here', 'tpcore'),
            ]
        );

        $repeater->add_control(
        'tp_slider_user',
         [
            'label'       => esc_html__( 'Username', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( 'Shahnewaz', 'tpcore' ),
            'placeholder' => esc_html__( 'Your username', 'tpcore' ),
         ]
        );

        $repeater->add_control(
        'tp_slider_user_designation',
         [
            'label'       => esc_html__( 'User Designation', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( 'President', 'tpcore' ),
            'placeholder' => esc_html__( 'Your Designation', 'tpcore' ),
         ]
        );
        $repeater->add_control(
        'tp_slider_date',
         [
            'label'       => esc_html__( 'Post Date', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( '20 jan 2022', 'tpcore' ),
            'placeholder' => esc_html__( 'Your Date', 'tpcore' ),
         ]
        );

        $this->add_control(
            'slider_list',
            [
                'label' => esc_html__('Slider List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_slider_title' => esc_html__('Grow business.', 'tpcore')
                    ],
                    [
                        'tp_slider_title' => esc_html__('Development.', 'tpcore')
                    ],
                    [
                        'tp_slider_title' => esc_html__('Marketing.', 'tpcore')
                    ],
                ],
                'title_field' => '{{{ tp_slider_title }}}',
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                // 'default' => 'tp-portfolio-thumb',
            ]
        );
        $this->end_controls_section();
    

        // Style
		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Style', 'tpcore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_transform',
			[
				'label' => __( 'Text Transform', 'tpcore' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'None', 'tpcore' ),
					'uppercase' => __( 'UPPERCASE', 'tpcore' ),
					'lowercase' => __( 'lowercase', 'tpcore' ),
					'capitalize' => __( 'Capitalize', 'tpcore' ),
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

	}

    protected function style_tab_content(){

        $this->tp_section_style_controls('about_section', 'Section - Style', '.tp-el-section');

        $this->tp_section_style_controls('services_section_box', 'Box - Style', '.tp-el-box');
        $this->tp_icon_style('section_icon', 'Box - Icon', '.tp-el-box-icon span');
        $this->tp_basic_style_controls('slider_title', 'Box - Title', '.tp-el-box-title');
        $this->tp_basic_style_controls('slider_subtitle', 'Box - Designation', '.tp-el-box-designation');
        $this->tp_basic_style_controls('slider_description', 'Box - Description', '.tp-el-box-content');
        $this->tp_basic_style_controls('slider_date', 'Box - Date', '.tp-el-box-date');
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

		<?php if ( $settings['tp_design_style']  == 'layout-2' ): ?>



		<?php else: 

            $bloginfo = get_bloginfo( 'name' );
		?>



         <!-- testimonial area start -->
         <section class="testimonial__area tp-el-section">
            <div class="container">
               <div class="testimonial__inner-10 p-relative wow fadeInUp tp-el-box" data-wow-delay=".4s" data-wow-duration="1s">
               
                    <?php if (!empty($settings['tp_slider_shape_switch'])) : ?>
                    <div class="testimonial__inner-10-bg p-relative include-bg"  data-background="<?php echo get_template_directory_uri() . '/assets/img/testimonial/10/testimonial-shape-1.png' ?>"></div>
                    <?php endif; ?>

                    <?php if (!empty($settings['tp_slider_shape_switch'])) : ?>
                    <div class="testimonial__shape">
                        <img class="testimonial__shape-9" src="<?php echo get_template_directory_uri() . '/assets/img/testimonial/10/testimonial-shape-2.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                        <img class="testimonial__shape-10" src="<?php echo get_template_directory_uri() . '/assets/img/testimonial/10/testimonial-shape-3.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                    </div>
                    <?php endif; ?>

                  <div class="row">
                     <div class="col-xxl-12">
                        <div class="testimonial__slider-10">
                           <div class="testimonial__slider-active-10 swiper-container">
                              <div class="swiper-wrapper">
                                <?php foreach ($settings['slider_list'] as $item) :
                                    $this->add_render_attribute('title_args', 'class', 'biography__title tp-el-title');

                                    if ( !empty($item['tp_slider_image']['url']) ) {
                                        $tp_slider_image_url = !empty($item['tp_slider_image']['id']) ? wp_get_attachment_image_url( $item['tp_slider_image']['id'], $settings['thumbnail_size']) : $item['tp_slider_image']['url'];
                                        $tp_slider_image_alt = get_post_meta($item["tp_slider_image"]["id"], "_wp_attachment_image_alt", true);
                                    }


                                ?>
                                 <div class="testimonial__item-10 swiper-slide">
                                    <div class="testimonial__content-10 text-center">
                                       <div class="testimonial__icon-10 tp-el-box-icon">
                                        <?php if($item['tp_box_icon_type'] == 'icon') : ?>
                                                <?php if (!empty($item['tp_box_icon']) || !empty($item['tp_box_selected_icon']['value'])) : ?>
                                                        <span><?php tp_render_icon($item, 'tp_box_icon', 'tp_box_selected_icon'); ?></span>
                                                <?php endif; ?>
                                            <?php elseif( $item['tp_box_icon_type'] == 'image' ) : ?>
                                                <span>
                                                    <?php if (!empty($item['tp_box_icon_image']['url'])): ?>
                                                    <img class="team__contact-top-icon" src="<?php echo $item['tp_box_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                                    <?php endif; ?>
                                                </span>
                                            <?php else : ?>
                                                <span>
                                                    <?php if (!empty($item['tp_box_icon_svg'])): ?>
                                                    <?php echo $item['tp_box_icon_svg']; ?>
                                                    <?php endif; ?>
                                                </span>
                                            <?php endif; ?>
                                       </div>

                                        <?php if (!empty($item['tp_slider_description'])) : ?>
                                        <p class="tp-el-box-content"><?php echo tp_kses( $item['tp_slider_description'] ); ?></p>
                                        <?php endif; ?> 

                                       <div class="testimonial__avater-10">
                                          <div class="testimonial__avater-thumb-10"></div>
                                          <div class="testimonial__avater-info-10 d-sm-flex align-items-center justify-content-center">

                                                <?php if(!empty($item['tp_slider_user'])) : ?>
                                                <h3 class="testimonial__avater-title-10 tp-el-box-title"><?php echo tp_kses( $item['tp_slider_user'] ); ?></h3>
                                                <?php endif; ?> 

                                                <?php if(!empty($item['tp_slider_user_designation'])) : ?>
                                                <span class="testimonial__avater-designation-10 tp-el-box-designation"> <?php echo tp_kses( $item['tp_slider_user_designation'] ); ?></span>
                                                <?php endif; ?> 

                                                <?php if(!empty($item['tp_slider_date'])) : ?>
                                                <div class="testimonial__avater-date tp-el-box-date">
                                                    <span><?php echo tp_kses( $item['tp_slider_date'] ); ?></span>
                                                </div>
                                                <?php endif; ?> 
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <?php endforeach; ?> 
                              </div>
                           </div>
                           <div class="testimonial-slider-dot-10 tp-swiper-dot tp-swiper-dot-2 text-center mt-50"></div>
                        </div>
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

$widgets_manager->register( new TP_Social_Slider() );