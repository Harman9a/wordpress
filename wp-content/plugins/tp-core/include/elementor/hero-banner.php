<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Control_Media;
use \Elementor\Repeater;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Utils;
use TPCore\Elementor\Controls\Group_Control_TPBGGradient;
use TPCore\Elementor\Controls\Group_Control_TPGradient;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Hero_Banner extends Widget_Base {

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
		return 'hero-banner';
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
		return __( 'Hero Banner', 'tp-core' );
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
		return [ 'tp-core' ];
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
		return [ 'tp-core' ];
	}


    protected static function get_profile_names()
    {
        return [
            'apple' => esc_html__('Apple', 'tp-core'),
            'behance' => esc_html__('Behance', 'tp-core'),
            'bitbucket' => esc_html__('BitBucket', 'tp-core'),
            'codepen' => esc_html__('CodePen', 'tp-core'),
            'delicious' => esc_html__('Delicious', 'tp-core'),
            'deviantart' => esc_html__('DeviantArt', 'tp-core'),
            'digg' => esc_html__('Digg', 'tp-core'),
            'dribbble' => esc_html__('Dribbble', 'tp-core'),
            'email' => esc_html__('Email', 'tp-core'),
            'facebook' => esc_html__('Facebook', 'tp-core'),
            'flickr' => esc_html__('Flicker', 'tp-core'),
            'foursquare' => esc_html__('FourSquare', 'tp-core'),
            'github' => esc_html__('Github', 'tp-core'),
            'houzz' => esc_html__('Houzz', 'tp-core'),
            'instagram' => esc_html__('Instagram', 'tp-core'),
            'jsfiddle' => esc_html__('JS Fiddle', 'tp-core'),
            'linkedin' => esc_html__('LinkedIn', 'tp-core'),
            'medium' => esc_html__('Medium', 'tp-core'),
            'pinterest' => esc_html__('Pinterest', 'tp-core'),
            'product-hunt' => esc_html__('Product Hunt', 'tp-core'),
            'reddit' => esc_html__('Reddit', 'tp-core'),
            'slideshare' => esc_html__('Slide Share', 'tp-core'),
            'snapchat' => esc_html__('Snapchat', 'tp-core'),
            'soundcloud' => esc_html__('SoundCloud', 'tp-core'),
            'spotify' => esc_html__('Spotify', 'tp-core'),
            'stack-overflow' => esc_html__('StackOverflow', 'tp-core'),
            'tripadvisor' => esc_html__('TripAdvisor', 'tp-core'),
            'tumblr' => esc_html__('Tumblr', 'tp-core'),
            'twitch' => esc_html__('Twitch', 'tp-core'),
            'twitter' => esc_html__('Twitter', 'tp-core'),
            'vimeo' => esc_html__('Vimeo', 'tp-core'),
            'vk' => esc_html__('VK', 'tp-core'),
            'website' => esc_html__('Website', 'tp-core'),
            'whatsapp' => esc_html__('WhatsApp', 'tp-core'),
            'wordpress' => esc_html__('WordPress', 'tp-core'),
            'xing' => esc_html__('Xing', 'tp-core'),
            'yelp' => esc_html__('Yelp', 'tp-core'),
            'youtube' => esc_html__('YouTube', 'tp-core'),
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
                'label' => esc_html__('Design Layout', 'tp-core'),
            ]
        );
        $this->add_control(
            'tp_design_style',
            [
                'label' => esc_html__('Select Layout', 'tp-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'tp-core'),
                    'layout-2' => esc_html__('Layout 2', 'tp-core'),
                    'layout-3' => esc_html__('Layout 3', 'tp-core'),
                    'layout-4' => esc_html__('Layout 4', 'tp-core'),
                    'layout-5' => esc_html__('Layout 5', 'tp-core'),
                    'layout-6' => esc_html__('Layout 6', 'tp-core'),
                    'layout-7' => esc_html__('Layout 7', 'tp-core'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->tp_section_title_render_controls('slider', 'Slider Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.');

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
                       '{{WRAPPER}} .slider__title-pre-9::after' => 'background: {{VALUE}};',
                   ],
                   'placeholder' => esc_html__( 'red', 'tpcore' ),
               ]
           );

           
           $this->end_controls_section();

        $this->start_controls_section(
            'tp_section_thumb_shape',
                [
                  'label' => esc_html__( 'Image Gradient Shape Color', 'tpcore' ),
                  'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                  'condition' =>[
                    'tp_design_style' => ['layout-7'],
                    ]
                ]
           );
           
           $this->add_control(
               'tp_section_thumb_gadient',
               [
                   'label' => esc_html__( 'BG Color', 'tpcore' ),
                   'type' => Controls_Manager::TEXT,
                   'selectors' => [
                       '{{WRAPPER}} .slider__thumb-9::after' => 'background: {{VALUE}};',
                   ],
                   'placeholder' => esc_html__( 'red', 'tpcore' ),
               ]
           );

           
           $this->end_controls_section();

        // tp_btn_button_group
        $this->tp_button_render('slider', 'Button', ['layout-1', 'layout-2', 'layout-3', 'layout-4', 'layout-6', 'layout-7']);

        // Button 
        $this->tp_button_render('portfolio', 'Portfolio Button', ['layout-2'] );

        // _tp_image
        $this->start_controls_section(
            '_tp_image_section',
            [
                'label' => esc_html__('BG Image', 'tp-core'),
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
            ]
        );
        $this->add_control(
            'tp_image_2',
            [
                'label' => esc_html__( 'Choose Image', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' =>[
                    'tp_design_style' => ['layout-3', 'layout-4', 'layout-6'],
                ]
            ]
        );
        $this->add_control(
            'tp_image_3',
            [
                'label' => esc_html__( 'Choose Image', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' =>[
                    'tp_design_style' => ['layout-6'],
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
         'hero_people_sec',
             [
               'label' => esc_html__( 'Hero People', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
               'condition' => [
                'tp_design_style' => 'layout-6'
               ]
             ]
        );
        $this->add_control(
         'hero_people_image',
            [
            'label'   => esc_html__( 'Upload Image', 'tpcore' ),
            'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
            ]
        );
        $this->add_control(
         'hero_people_text',
         [
           'label'       => esc_html__( 'Hero People Text', 'tpcore' ),
           'type'        => \Elementor\Controls_Manager::TEXTAREA,
           'rows'        => 10,
           'default'     => esc_html__( 'Default Text', 'tpcore' ),
           'placeholder' => esc_html__( 'Placeholder Text', 'tpcore' ),
         ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail_size', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                // 'default' => 'tp-post-thumb',
            ]
        );
        $this->end_controls_section();


        // tp_slider_mouse_group
        $this->start_controls_section(
            'tp_slider_mouse_group',
            [
                'label' => esc_html__('Scroll Button', 'tp-core'),
                'condition' => [
                    'tp_design_style' => ['layout-1', 'layout-4']
                ],
            ]
            
        );

        $this->add_control(
            'tp_slider_mouse_show',
            [
                'label' => esc_html__( 'Show Scroll Icon', 'tp-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tp-core' ),
                'label_off' => esc_html__( 'Hide', 'tp-core' ),
                'return_value' => 'yes',
                'default' => true,
                
            ]
        );

        $this->add_control(
            'tp_slider_mouse_link',
            [
                'label' => esc_html__('Scroll link', 'tp-core'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'tp-core'),
                'show_external' => false,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                    'custom_attributes' => '',
                ],
                'condition' => [
                    'tp_slider_mouse_show' => 'yes'
                ],
                'label_block' => true,
            ]
        );

        $this->add_control(
        'tp_slider_mouse_text',
         [
            'label'       => esc_html__( 'Scroll Text', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( 'Scroll Down', 'tpcore' ),
            'placeholder' => esc_html__( 'your text', 'tpcore' ),
         ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
         'tp_slider_shape',
             [
               'label' => esc_html__( 'Hero Shape Switch', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
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

        $this->add_control(
         'enable_gradient_bg',
         [
           'label'        => esc_html__( 'Gradient Shape On/Off', 'tpcore' ),
           'type'         => \Elementor\Controls_Manager::SWITCHER,
           'label_on'     => esc_html__( 'Show', 'tpcore' ),
           'label_off'    => esc_html__( 'Hide', 'tpcore' ),
           'return_value' => 'yes',
           'default'      => 'no',
         ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
         'slider_rating_section',
            [
            'label' => esc_html__( 'Hero Rating', 'tpcore' ),
            'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            'condition' => [
                'tp_design_style' => 'layout-2',
            ]
            ]
        );

        $this->tp_icon_controls('box', ['layout-2', 'layout-3']);

        $this->add_control(
        'slider_rating_text',
            [
                'label'       => esc_html__( 'Slider Rating Text', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Excellent 4.9 out of 5 ', 'tpcore' ),
                'placeholder' => esc_html__( 'Placeholder Text', 'tpcore' ),
            ]
        );

        $this->add_control(
         'slider_rating_image',
            [
            'label'   => esc_html__( 'Slider Rating Image', 'tpcore' ),
            'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
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

        $this->start_controls_section(
            'tpcore_contact',
            [
                'label' => esc_html__('Contact Form', 'tpcore'),
                'condition' => [
                    'tp_design_style' => 'layout-5'
                ]
            ]
        );

        $this->add_control(
            'tpcore_select_contact_form',
            [
                'label'   => esc_html__( 'Select Form', 'tpcore' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '0',
                'options' => $this->get_tp_contact_form(),
            ]
        );

        $this->add_control(
         'tp_hero_form_feature',
            [
            'label'       => esc_html__( 'Form Feature', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXTAREA,
            'rows'        => 10,
            'default'     => esc_html__( 'Feature 1', 'tpcore' ),
            'placeholder' => esc_html__( 'Placeholder Text', 'tpcore' ),
            ]
        );

        $this->end_controls_section();
        
        $this->start_controls_section(
         'tp_hero_social_sec',
             [
               'label' => esc_html__( 'Hero Social', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
               'condition' => [
                    'tp_design_style' => 'layout-7'
               ]
             ]
        );
        

           
           $this->add_control(
           'tp_hero_social_title',
               [
                   'label'       => esc_html__( 'Hero Social Title', 'tpcore' ),
                   'type'        => \Elementor\Controls_Manager::TEXT,
                   'default'     => esc_html__( 'Check out my:', 'tpcore' ),
                   'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
               ]
           );

           $this->add_control(
            'show_profiles',
            [
                'label' => esc_html__('Show Profiles', 'tpcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'tpcore'),
                'label_off' => esc_html__('Hide', 'tpcore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
                'style_transfer' => true,
            ]
        );
   
           $repeater = new Repeater();

           $repeater->add_control(
            'tp_box_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'icon' => esc_html__('Icon', 'tpcore'),
                    'svg' => esc_html__('SVG', 'tpcore'),
                ],
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
                ]
            ]
        );

   
           $repeater->add_control(
               'name',
               [
                   'label' => esc_html__('Profile Name', 'tpcore'),
                   'type' => Controls_Manager::SELECT2,
                   'label_block' => true,
                   'select2options' => [
                       'allowClear' => false,
                   ],
                   'options' => self::get_profile_names(),
                   'condition' => [
                        'tp_box_icon_type' => 'icon',
                    ]
               ]
           );

   
           $repeater->add_control(
               'link', [
                   'label' => esc_html__('Profile Link', 'tpcore'),
                   'placeholder' => esc_html__('Add your profile link', 'tpcore'),
                   'type' => Controls_Manager::URL,
                   'label_block' => true,
                   'autocomplete' => false,
                   'show_external' => false,
                   'condition' => [
                       'name!' => 'email'
                   ],
                   'dynamic' => [
                       'active' => true,
                   ]
               ]
           );
           $this->add_control(
               'profiles',
               [
                   'show_label' => false,
                   'type' => Controls_Manager::REPEATER,
                   'fields' => $repeater->get_controls(),
                   'title_field' => '<# print(name.slice(0,1).toUpperCase() + name.slice(1)) #>',
                   'default' => [
                       [
                           'link' => ['url' => 'https://facebook.com/'],
                           'name' => 'facebook'
                       ],
                       [
                           'link' => ['url' => 'https://linkedin.com/'],
                           'name' => 'linkedin'
                       ],
                       [
                           'link' => ['url' => 'https://twitter.com/'],
                           'name' => 'twitter'
                       ]
                   ],
               ]
           );
   
        
        $this->end_controls_section();

	}
    

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('hero_section', 'Section - Style', '.tp-el-section');
        $this->tp_section_style_controls('hero_section_box', 'Box - Style', '.tp-el-section-box');
        $this->tp_section_style_controls('hero_section_bg', 'Hero - Thumb BG', '.tp-el-thumb-bg');
        $this->tp_basic_style_controls('hero_subtitle', 'Hero - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('hero_title', 'Hero - Title', '.tp-el-title');
        $this->tp_basic_style_controls('hero_description', 'Hero - Description', '.tp-el-content > p');

        $this->tp_basic_style_controls('hero_rating', 'Rating - Icon', '.tp-el-rating-icon');
        $this->tp_basic_style_controls('hero_text', 'Rating - Text', '.tp-el-rating-text');

        // gradient button color
        $this->start_controls_section(
            'tp_hero_gradient_btn_button',
            [
                'label' => esc_html__('Hero Gradient Button', 'tp-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tp_hero_gradient_btn_typography',
                'selector' => '{{WRAPPER}} .tp-el-gradient-btn',
            ]
        );


        $this->start_controls_tabs('tp_hero_gradient_btn_button_tabs');

        // Normal State Tab
        $this->start_controls_tab('tp_hero_gradient_btn_btn_normal', ['label' => esc_html__('Normal', 'tp-core')]);

        $this->add_control(
            'tp_hero_gradient_btn_btn_normal_text_color',
            [
                'label' => esc_html__('Text Color', 'tp-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-el-gradient-btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tp_hero_gradient_btn_btn_normal_bg_color',
            [
                'label' => esc_html__('Background Color', 'tp-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-el-gradient-btn' => 'background: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'tp_hero_gradient_btn_bg_color',
            [
                'label' => esc_html__('Gradient BG Color', 'tp-core'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'selectors' => [
                    '{{WRAPPER}} .tp-el-gradient-btn::after' => 'background: {{VALUE}};',
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'tp_hero_gradient_btn_btn_box_shadow',
                'label' => esc_html__( 'Box Shadow', 'tp-core' ),
                'selector' => '{{WRAPPER}} .tp-el-gradient-btn',
            ]
        );

        $this->add_control(
            'tp_hero_gradient_btn_btn_normal_border_style',
            [
                'label' => esc_html__('Border Style', 'tp-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__('Default', 'tp-core'),
                    'none' => esc_html__('None', 'tp-core'),
                    'solid' => esc_html__('Solid', 'tp-core'),
                    'double' => esc_html__('Double', 'tp-core'),
                    'dotted' => esc_html__('Dotted', 'tp-core'),
                    'dashed' => esc_html__('Dashed', 'tp-core'),
                    'groove' => esc_html__('Groove', 'tp-core'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-el-gradient-btn' => 'border-style: {{VALUE}} !important;;',
                ],
            ]
        );

        $this->add_responsive_control(
            'tp_hero_gradient_btn_btn_normal_border_width',
            [
                'label' => esc_html__('Border Width', 'tp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .tp-el-gradient-btn' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'tp_hero_gradient_btn_btn_normal_border_color',
            [
                'label' => esc_html__('Border Color', 'tp-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-el-gradient-btn' => 'border-color: {{VALUE}} !important;;',
                ],
            ]

        );


        $this->add_control(
            'tp_hero_gradient_btn_btn_border_radius',
            [
                'label' => esc_html__('Border Radius', 'tp-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-el-gradient-btn' => 'border-radius: {{SIZE}}px;',
                ],
            ]
        );

        $this->end_controls_tab();

        // Hover State Tab
        $this->start_controls_tab('tp_hero_gradient_btn_btn_hover', ['label' => esc_html__('Hover', 'tp-core')]);

        $this->add_control(
            'tp_hero_gradient_btn_btn_hover_text_color',
            [
                'label' => esc_html__('Text Color', 'tp-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-el-gradient-btn:hover' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'tp_hero_gradient_btn_btn_hover_bg_color',
            [
                'label' => esc_html__('Background Color', 'tp-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-el-gradient-btn:hover' => 'background: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'tp_hero_gradient_btn_btn_hover_box_shadow',
                'label' => esc_html__( 'Box Shadow', 'tp-core' ),
                'selector' => '{{WRAPPER}} .tp-el-gradient-btn:hover',
            ]
        );

        $this->add_control(
            'tp_hero_gradient_btn_btn_hover_border_style',
            [
                'label' => esc_html__('Border Style', 'tp-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__('Default', 'tp-core'),
                    'none' => esc_html__('None', 'tp-core'),
                    'solid' => esc_html__('Solid', 'tp-core'),
                    'double' => esc_html__('Double', 'tp-core'),
                    'dotted' => esc_html__('Dotted', 'tp-core'),
                    'dashed' => esc_html__('Dashed', 'tp-core'),
                    'groove' => esc_html__('Groove', 'tp-core'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-el-gradient-btn' => 'border-style: {{VALUE}} !important;;',
                ],
            ]
        );

        $this->add_responsive_control(
            'tp_hero_gradient_btn_btn_hover_border_width',
            [
                'label' => esc_html__('Border Width', 'tp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .tp-el-gradient-btn' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'tp_hero_gradient_btn_btn_hover_border_color',
            [
                'label' => esc_html__('Border Color', 'tp-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-el-gradient-btn:hover' => 'border-color: {{VALUE}} !important;',
                ],
            ]
        );




        $this->end_controls_tab();

        $this->end_controls_tabs();

                $this->add_responsive_control(
            'tp_hero_gradient_btn_padding',
            [
                'label' => esc_html__('Padding', 'tp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .tp-el-gradient-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'tp_hero_gradient_btn_margin',
            [
                'label' => esc_html__('Margin', 'tp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .tp-el-gradient-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->tp_link_controls_style('hero_button', 'Hero - Button', '.tp-el-box-btn');
        $this->tp_link_controls_style('hero_button_2', 'Hero - Button 2', '.tp-el-box-btn-2');

        $this->tp_input_controls_style('coming_input', 'Form - Input', '.tp-el-box-input input');
        $this->tp_link_controls_style('coming_input_btn', 'Form - Button', '.tp-el-box-input button');

        $this->tp_basic_style_controls('slider_social_title', 'Slider Social - Title', '.tp-el-social-title');
        $this->tp_link_controls_style('slider_social_link', 'Slider Social - Link', '.tp-el-social-link');


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

		<?php if ( $settings['tp_design_style']  == 'layout-2' ): 

            $bloginfo = get_bloginfo( 'name' );
            $this->add_render_attribute('title_args', 'class', 'slider__title-2 tp-el-title');

            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }

            if ( !empty($settings['slider_rating_image']['url']) ) {
                $slider_rating_image = !empty($settings['slider_rating_image']['id']) ? wp_get_attachment_image_url( $settings['slider_rating_image']['id'], $settings['thumbnail_size']) : $settings['slider_rating_image']['url'];
                $slider_rating_image_alt = get_post_meta($settings["slider_rating_image"]["id"], "_wp_attachment_image_alt", true);
            }

            // mouse link
            if ( ! empty( $settings['tp_slider_mouse_link']['url'] ) ) {
                $this->add_link_attributes( 'tp-button-arg', $settings['tp_slider_mouse_link'] );
                $this->add_link_attributes( 'tp-button-text-arg', $settings['tp_slider_mouse_link'] );
                $this->add_render_attribute('tp-button-arg', 'class', 'mouse-scroll-icon');
            }

            // portfolio button
            if ('2' == $settings['tp_portfolio_btn_link_type']) {
                $link = get_permalink($settings['tp_portfolio_btn_page_link']);
                $target = '_self';
                $rel = 'nofollow';
            } else {
                $link = !empty($settings['tp_portfolio_btn_link']['url']) ? $settings['tp_portfolio_btn_link']['url'] : '';
                $target = !empty($settings['tp_portfolio_btn_link']['is_external']) ? '_blank' : '';
                $rel = !empty($settings['tp_portfolio_btn_link']['nofollow']) ? 'nofollow' : '';
            }

            // slider btn link
            if ('2' == $settings['tp_slider_btn_link_type']) {
                $link2 = get_permalink($settings['tp_slider_btn_page_link']);
                $target2 = '_self';
                $rel2 = 'nofollow';
            } else {
                $link2 = !empty($settings['tp_slider_btn_link']['url']) ? $settings['tp_slider_btn_link']['url'] : '';
                $target2 = !empty($settings['tp_slider_btn_link']['is_external']) ? '_blank' : '';
                $rel2 = !empty($settings['tp_slider_btn_link']['nofollow']) ? 'nofollow' : '';
            }

        ?>
         <!-- slider area start -->
         <section class="slider__area pt-100 p-relative z-index-1">
            <div class="tp-slider-overlay-freelancer-green tp-el-section-box"></div>
            <div class="tp-slider-overlay-freelancer"></div>
         <?php if(!empty($settings['tp_slider_shape_switch'])) : ?>
            <div class="slider__shape-2">
               <img class="slider__shape-2-1" src=" <?php echo get_template_directory_uri() . '/assets/img/slider/2/shape/slider-shape-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="slider__shape-2-2" src=" <?php echo get_template_directory_uri() . '/assets/img/slider/2/shape/slider-shape-2.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="slider__shape-2-3" src=" <?php echo get_template_directory_uri() . '/assets/img/slider/2/shape/slider-shape-3.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
            </div>
            <?php endif; ?>

            <?php if(!empty($settings['tp_portfolio_btn_switcher'])) :?>
            <div class="slider__portfolio-btn">
               <a class="slider-portfolio-btn tp-el-box-btn-2" target="<?php echo esc_attr($target2); ?>" rel="<?php echo esc_attr($rel2); ?>" href="<?php echo esc_url($link2); ?>">
                  <svg width="12" height="12" viewBox="0 0 14 14" fill="none">
                     <path d="M3.5 2.25001C3.5 1.28351 2.7165 0.500001 1.75 0.500001C0.783502 0.500001 0 1.28351 0 2.25001C0 3.2165 0.783502 4 1.75 4C2.7165 4 3.5 3.2165 3.5 2.25001Z" fill="currentColor"/>
                     <path d="M3.5 12.25C3.5 11.2835 2.7165 10.5 1.75 10.5C0.783502 10.5 0 11.2835 0 12.25C0 13.2165 0.783502 14 1.75 14C2.7165 14 3.5 13.2165 3.5 12.25Z" fill="currentColor"/>
                     <path d="M13.5 2.25001C13.5 1.28351 12.7165 0.500002 11.75 0.500002C10.7835 0.500002 10 1.28351 10 2.25001C10 3.2165 10.7835 4 11.75 4C12.7165 4 13.5 3.2165 13.5 2.25001Z" fill="currentColor"/>
                     <path d="M13.5 12.25C13.5 11.2835 12.7165 10.5 11.75 10.5C10.7835 10.5 10 11.2835 10 12.25C10 13.2165 10.7835 14 11.75 14C12.7165 14 13.5 13.2165 13.5 12.25Z" fill="currentColor"/>
                  </svg>
                  <?php echo tp_kses($settings['tp_portfolio_btn_text']); ?>
               </a>
            </div>
            <?php endif; ?>

            <?php if (!empty($settings['tp_slider_mouse_link'])) : ?>
            <div class="slider__mouse-scroll smooth d-flex align-items-center">
               <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>></a>
               <p><a <?php echo $this->get_render_attribute_string( 'tp-button-text-arg' ); ?>><?php echo esc_html($settings['tp_slider_mouse_text']); ?></a></p>
            </div>
            <?php endif; ?>

            <div class="container">
               <div class="row align-items-center">
                  <div class="col-xxl-5 col-xl-5 col-lg-6">
                     <div class="slider__content-2 tp-el-content">

                        <?php if ( !empty($settings['tp_slider_section_title_show']) ) : ?>
                            <?php if (!empty($settings['tp_slider_sub_title'])) : ?>
                            <span class="slider__title-pre-2 tp-el-subtitle"><?php echo tp_kses( $settings['tp_slider_sub_title'] ); ?></span>
                            <?php endif; ?>

                            <?php
                                if ( !empty($settings['tp_slider_title' ]) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['tp_slider_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        tp_kses( $settings['tp_slider_title' ] )
                                        );
                                endif;
                            ?>

                        <?php if ( !empty($settings['tp_slider_description']) ) : ?>
                            <p><?php echo tp_kses( $settings['tp_slider_description'] ); ?></p>
                        <?php endif; ?>

                        <?php endif; ?> 
                        <?php if (!empty($link2)) : ?>
                        <div class="slider__btn-2">
                           <a target="<?php echo esc_attr($target2); ?>" rel="<?php echo esc_attr($rel2); ?>" href="<?php echo esc_url($link2); ?>" class="tp-btn-green tp-el-box-btn"><?php echo tp_kses($settings['tp_slider_btn_text']); ?></a>
                        </div>
                        <?php endif; ?> 

                        
                        <div class="slider__review">
                            <?php if($settings['tp_box_icon_type'] == 'icon') : ?>
                                <?php if (!empty($settings['tp_box_icon']) || !empty($settings['tp_box_selected_icon']['value'])) : ?>
                                        <span class="slider__review-icon tp-el-rating-icon"><?php tp_render_icon($settings, 'tp_box_icon', 'tp_box_selected_icon'); ?></span>
                                <?php endif; ?>
                            <?php elseif( $settings['tp_box_icon_type'] == 'image' ) : ?>
                                <span>
                                    <?php if (!empty($settings['tp_box_icon_image']['url'])): ?>
                                    <img src="<?php echo $settings['tp_box_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($settings['tp_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                    <?php endif; ?>
                                </span>
                            <?php else : ?>
                                <span class="slider__review-icon tp-el-rating-icon">
                                    <?php if (!empty($settings['tp_box_icon_svg'])): ?>
                                    <?php echo $settings['tp_box_icon_svg']; ?>
                                    <?php endif; ?>
                                </span>
                            <?php endif; ?>
                           <p class="tp-el-rating-text"><?php echo tp_kses($settings['slider_rating_text']); ?></p>
                           <span class="slider__review-client"><img src="<?php echo esc_url($slider_rating_image); ?>" alt="<?php echo esc_attr($slider_rating_image_alt); ?>">
                        </span>
                        </div>

                     </div>
                  </div>
                  <div class="col-xxl-7 col-xl-7 col-lg-6">
                    <?php if(!empty($tp_image)) :?>
                     <div class="slider__thumb-wrapper-2 pt-20 ml-40 tp-el-thumb-bg" data-overlay="green" data-overlay-opacity="3">
                        <div class="slider__thumb-2 m-img text-center">
                           <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                        </div>
                     </div>
                     <?php endif; ?>
                  </div>
               </div>
            </div>
         </section>
         <!-- slider area end -->

        <?php elseif ( $settings['tp_design_style']  == 'layout-3' ): 
            $bloginfo = get_bloginfo( 'name' );
            $this->add_render_attribute('title_args', 'class', 'slider__title-5 tp-el-title');

            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }
            if ( !empty($settings['tp_image_2']['url']) ) {
                $tp_image_2 = !empty($settings['tp_image_2']['id']) ? wp_get_attachment_image_url( $settings['tp_image_2']['id'], $settings['tp_image_size_size']) : $settings['tp_image_2']['url'];
                $tp_image_2_alt = get_post_meta($settings["tp_image_2"]["id"], "_wp_attachment_image_alt", true);
            }

            // btn Link
            if ('2' == $settings['tp_slider_btn_link_type']) {
                $link = get_permalink($settings['tp_slider_btn_page_link']);
                $target = '_self';
                $rel = 'nofollow';
            } else {
                $link = !empty($settings['tp_slider_btn_link']['url']) ? $settings['tp_slider_btn_link']['url'] : '';
                $target = !empty($settings['tp_slider_btn_link']['is_external']) ? '_blank' : '';
                $rel = !empty($settings['tp_slider_btn_link']['nofollow']) ? 'nofollow' : '';
            }

        ?>
         <!-- slider area start -->
         <section class="slider__area box-plr-5-245 slider__height-5 d-flex align-items-center p-relative z-index-1 fix tp-el-section">

            <?php if(!empty($settings['tp_slider_shape_switch'])) : ?>
            <div class="slider__shape">
               <img class="slider__shape-5" src="<?php echo get_template_directory_uri() . '/assets/img/slider/5/shape/slider-shape-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="slider__shape-6" src="<?php echo get_template_directory_uri() . '/assets/img/slider/5/shape/slider-shape-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="slider__shape-7" src="<?php echo get_template_directory_uri() . '/assets/img/slider/5/shape/slider-shape-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="slider__shape-8" src="<?php echo get_template_directory_uri() . '/assets/img/slider/5/shape/slider-shape-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
            </div>
            <?php endif; ?>

            <div class="container-fluid">
               <div class="row">
                  <div class="col-xxl-6 col-xl-6 col-lg-6">
                     <div class="slider__content-5 tp-el-content">

                        <?php if (!empty($settings['tp_slider_sub_title'])) : ?>
                        <span class="slider__title-pre-5 tp-el-subtitle"><?php echo tp_kses( $settings['tp_slider_sub_title'] ); ?></span>
                        <?php endif; ?>


                        <?php
                            if ( !empty($settings['tp_slider_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['tp_slider_title_tag'] ),
                                    $this->get_render_attribute_string( 'title_args' ),
                                    tp_kses( $settings['tp_slider_title' ] )
                                    );
                            endif;
                        ?>
                        

                        <?php if (!empty($settings['tp_slider_description'])) : ?>
                        <p><?php echo tp_kses( $settings['tp_slider_description'] ); ?></p>
                        <?php endif; ?> 


                        <?php if (!empty($link)) : ?>
                        <div class="slider__btn-4">
                           <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>" class="tp-btn-blue-sm tp-el-box-btn"><?php echo tp_kses($settings['tp_slider_btn_text']); ?></a>
                        </div>
                        <?php endif; ?> 
                     </div>
                  </div>
                  <div class="col-xxl-6 col-xl-6 col-lg-6">
                     <div class="slider__thumb-5 text-end scene-2">

                        <?php if(!empty($tp_image)) : ?>
                        <div class="slider-thumb-5 one">
                           <img class="slider__thumb-5-1 layer" data-depth=".2" src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                        </div>
                        <?php endif; ?> 

                        <?php if(!empty($tp_image_2)) : ?>
                        <div class="slider-thumb-5 two">
                           <img class="slider__thumb-5-2 layer" data-depth=".3" src="<?php echo esc_url($tp_image_2); ?>" alt="<?php echo esc_attr($tp_image_2_alt); ?>">
                        </div>
                        <?php endif; ?> 
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- slider area end -->

        <?php elseif ( $settings['tp_design_style']  == 'layout-4' ): 
            $bloginfo = get_bloginfo( 'name' );
            $this->add_render_attribute('title_args', 'class', 'slider__title-3 tp-el-title');

            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }
            if ( !empty($settings['tp_image_2']['url']) ) {
                $tp_image_2 = !empty($settings['tp_image_2']['id']) ? wp_get_attachment_image_url( $settings['tp_image_2']['id'], $settings['tp_image_size_size']) : $settings['tp_image_2']['url'];
                $tp_image_2_alt = get_post_meta($settings["tp_image_2"]["id"], "_wp_attachment_image_alt", true);
            }

            // btn Link
            if ('2' == $settings['tp_slider_btn_link_type']) {
                $link = get_permalink($settings['tp_slider_btn_page_link']);
                $target = '_self';
                $rel = 'nofollow';
            } else {
                $link = !empty($settings['tp_slider_btn_link']['url']) ? $settings['tp_slider_btn_link']['url'] : '';
                $target = !empty($settings['tp_slider_btn_link']['is_external']) ? '_blank' : '';
                $rel = !empty($settings['tp_slider_btn_link']['nofollow']) ? 'nofollow' : '';
            }

        ?>

        <!-- slider area start -->
        <section class="slider__area slider__border slider__height-3 d-flex align-items-center p-relative box-plr-245 p-relative fix tp-el-section" >

            <div class="slider__shape">
                <img class="slider__shape-camera" data-parallax='{"y": -120, "smoothness": 20}' src="<?php echo esc_url($tp_image_2); ?>" alt="<?php echo esc_attr($tp_image_2_alt); ?>">
            </div>

            <div class="slider__bg-3 include-bg" data-background="<?php echo esc_url($tp_image); ?>"></div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xxl-8">
                        <div class="slider__content-3 p-relative z-index-1 wow fadeInUp tp-el-content" data-wow-delay=".5s" data-wow-duration="1s">

                            <?php if (!empty($settings['tp_slider_sub_title'])) : ?>
                            <span class="slider__title-pre-3 tp-el-subtitle"><?php echo tp_kses( $settings['tp_slider_sub_title'] ); ?></span>
                            <?php endif; ?>

                            <?php
                                if ( !empty($settings['tp_slider_title' ]) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['tp_slider_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        tp_kses( $settings['tp_slider_title' ] )
                                        );
                                endif;
                            ?>
                        
                            <?php if (!empty($settings['tp_slider_description'])) : ?>
                            <p><?php echo tp_kses( $settings['tp_slider_description'] ); ?></p>
                            <?php endif; ?> 

                            
                            <?php if (!empty($link)) : ?>
                            <div class="slider__btn">
                                <a href="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>" class="tp-btn-border-2 tp-el-box-btn"><?php echo tp_kses($settings['tp_slider_btn_text']); ?></a>
                            </div>
                            <?php endif; ?> 
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- slider area end -->

        <?php elseif ( $settings['tp_design_style']  == 'layout-5' ): 
           $bloginfo = get_bloginfo( 'name' );
            $this->add_render_attribute('title_args', 'class', 'slider__title-7 tp-el-title');

            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }
            if ( !empty($settings['tp_image_2']['url']) ) {
                $tp_image_2 = !empty($settings['tp_image_2']['id']) ? wp_get_attachment_image_url( $settings['tp_image_2']['id'], $settings['tp_image_size_size']) : $settings['tp_image_2']['url'];
                $tp_image_2_alt = get_post_meta($settings["tp_image_2"]["id"], "_wp_attachment_image_alt", true);
            }

            // btn Link
            if ('2' == $settings['tp_slider_btn_link_type']) {
                $link = get_permalink($settings['tp_slider_btn_page_link']);
                $target = '_self';
                $rel = 'nofollow';
            } else {
                $link = !empty($settings['tp_slider_btn_link']['url']) ? $settings['tp_slider_btn_link']['url'] : '';
                $target = !empty($settings['tp_slider_btn_link']['is_external']) ? '_blank' : '';
                $rel = !empty($settings['tp_slider_btn_link']['nofollow']) ? 'nofollow' : '';
            }

        ?>

         <!-- slider area start -->
         <section class="slider__area pt-180 z-index-1 p-relative fix tp-el-section" data-bg-color="green-light-3">
            <?php if(!empty($settings['tp_slider_shape_switch'])) : ?>
            <div class="slider__shape">
               <img class="slider__shape-19" src="<?php echo get_template_directory_uri() . '/assets/img/slider/7/shape/slider-shape-4.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
            </div>
            <?php endif; ?>

            <div class="container">
               <div class="row align-items-end">
                  <div class="col-xxl-6 col-xl-6 col-lg-6">
                     <div class="slider__content-7 tp-el-content">

                        <?php
                            if ( !empty($settings['tp_slider_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['tp_slider_title_tag'] ),
                                    $this->get_render_attribute_string( 'title_args' ),
                                    tp_kses( $settings['tp_slider_title' ] )
                                    );
                            endif;
                        ?>

                        <?php if (!empty($settings['tp_slider_description'])) : ?>
                        <p><?php echo tp_kses( $settings['tp_slider_description'] ); ?></p>
                        <?php endif; ?>

                        <div class="slider__subscribe tp-el-box-input ">
                            <?php if( !empty($settings['tpcore_select_contact_form']) ) : ?>
                            <div class="tp-form-wrapper">
                                <?php echo do_shortcode( '[contact-form-7  id="'.$settings['tpcore_select_contact_form'].'"]' ); ?>
                            </div>
                            <?php else : ?>
                                <?php echo '<div class="alert alert-info"><p class="m-0">' . __('Please Select contact form.', 'tpcore' ). '</p></div>'; ?>
                            <?php endif; ?>


                        <?php if(!empty($settings['tp_hero_form_feature'])): ?>
                           <div class="slider__subscribe-list ">
                           <?php echo tp_kses($settings['tp_hero_form_feature']); ?>
                           </div>
                           <?php endif; ?>
                        </div>
                     </div>
                  </div>
                  <div class="col-xxl-6 col-xl-6 col-lg-6">
                     <div class="slider__thumb-wrapper-7">
                        <?php if(!empty($settings['tp_slider_shape_switch'])) : ?>
                        <img class="slider__thumb-7-shape-1" src="<?php echo get_template_directory_uri() . '/assets/img/slider/7/shape/slider-shape-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                        <img class="slider__thumb-7-shape-2" data-parallax='{"y": -100, "smoothness": 80}' src="<?php echo get_template_directory_uri() . '/assets/img/slider/7/shape/slider-shape-2.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                        <img class="slider__thumb-7-shape-3" data-parallax='{"y": 100, "smoothness": 80}' src="<?php echo get_template_directory_uri() . '/assets/img/slider/7/shape/slider-shape-3.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                        <?php endif; ?>
                        
                        <div class="slider__thumb-7">
                           <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- slider area end -->

        
         <?php elseif ( $settings['tp_design_style']  == 'layout-6' ): 
           $bloginfo = get_bloginfo( 'name' );
            $this->add_render_attribute('title_args', 'class', 'slider__title-6 tp-el-title');

            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }
            if ( !empty($settings['tp_image_2']['url']) ) {
                $tp_image_2 = !empty($settings['tp_image_2']['id']) ? wp_get_attachment_image_url( $settings['tp_image_2']['id'], $settings['tp_image_size_size']) : $settings['tp_image_2']['url'];
                $tp_image_2_alt = get_post_meta($settings["tp_image_2"]["id"], "_wp_attachment_image_alt", true);
            }
            if ( !empty($settings['tp_image_3']['url']) ) {
                $tp_image_3 = !empty($settings['tp_image_3']['id']) ? wp_get_attachment_image_url( $settings['tp_image_3']['id'], $settings['tp_image_size_size']) : $settings['tp_image_3']['url'];
                $tp_image_3_alt = get_post_meta($settings["tp_image_3"]["id"], "_wp_attachment_image_alt", true);
            }

            if ( !empty($settings['hero_people_image']['url']) ) {
                $hero_people_image = !empty($settings['hero_people_image']['id']) ? wp_get_attachment_image_url( $settings['hero_people_image']['id'], $settings['thumbnail_size_size']) : $settings['hero_people_image']['url'];
                $hero_people_image_alt = get_post_meta($settings["hero_people_image"]["id"], "_wp_attachment_image_alt", true);
            }


            // btn Link
            if ('2' == $settings['tp_slider_btn_link_type']) {
                $link = get_permalink($settings['tp_slider_btn_page_link']);
                $target = '_self';
                $rel = 'nofollow';
            } else {
                $link = !empty($settings['tp_slider_btn_link']['url']) ? $settings['tp_slider_btn_link']['url'] : '';
                $target = !empty($settings['tp_slider_btn_link']['is_external']) ? '_blank' : '';
                $rel = !empty($settings['tp_slider_btn_link']['nofollow']) ? 'nofollow' : '';
            }

        ?>


         <!-- slider area start -->
         <section class="slider__area slider__height-6 p-relative box-plr-6-245 d-flex align-items-center fix tp-el-section">
         <?php if(!empty($settings['tp_slider_shape_switch'])) : ?>
            <div class="slider__shape">
               <img class="slider__shape-9" src="<?php echo get_template_directory_uri() . '/assets/img/slider/6/shape/slider-shape-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="slider__shape-10" src="<?php echo get_template_directory_uri() . '/assets/img/slider/6/shape/slider-shape-2.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="slider__shape-11" src="<?php echo get_template_directory_uri() . '/assets/img/slider/6/shape/slider-shape-3.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="slider__shape-12" src="<?php echo get_template_directory_uri() . '/assets/img/slider/6/shape/slider-shape-4.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="slider__shape-13" src="<?php echo get_template_directory_uri() . '/assets/img/slider/6/shape/slider-shape-5.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="slider__shape-14" src="<?php echo get_template_directory_uri() . '/assets/img/slider/6/shape/slider-shape-6.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="slider__shape-15" src="<?php echo get_template_directory_uri() . '/assets/img/slider/6/shape/slider-shape-7.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="slider__shape-16" src="<?php echo get_template_directory_uri() . '/assets/img/slider/6/shape/slider-shape-8.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="slider__shape-17" src="<?php echo get_template_directory_uri() . '/assets/img/slider/6/shape/slider-shape-9.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="slider__shape-18" src="<?php echo get_template_directory_uri() . '/assets/img/slider/6/shape/slider-shape-10.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
            </div>
            <?php endif; ?>

            <div class="container-fluid">
               <div class="row align-items-center">
                  <div class="col-xxl-5 col-xl-6 col-lg-6">
                     <div class="slider__content-6 tp-el-content">
                        <?php if (!empty($settings['tp_slider_sub_title'])) : ?>
                        <span class="slider__title-pre-6 tp-el-subtitle"><?php echo tp_kses( $settings['tp_slider_sub_title'] ); ?></span>
                        <?php endif; ?>

                        <?php
                            if ( !empty($settings['tp_slider_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['tp_slider_title_tag'] ),
                                    $this->get_render_attribute_string( 'title_args' ),
                                    tp_kses( $settings['tp_slider_title' ] )
                                    );
                            endif;
                        ?>
                        
                        <?php if (!empty($settings['tp_slider_description'])) : ?>
                        <p><?php echo tp_kses( $settings['tp_slider_description'] ); ?></p>
                        <?php endif; ?>

                        <?php if (!empty($link)) : ?>
                        <div class="slider__btn-6">
                           <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>" class="tp-btn-border-5 tp-link-btn-3 tp-el-box-btn">
                           <?php echo tp_kses($settings['tp_slider_btn_text']); ?>
                              <span>
                                 <i class="fa-regular fa-arrow-right"></i>
                              </span>
                           </a>
                        </div>
                        <?php endif; ?>                        

                        <?php if(!empty($hero_people_image)) :?>
                        <div class="slider__user">
                           <img src="<?php echo esc_url($hero_people_image); ?>" alt="<?php echo esc_attr($hero_people_image_alt); ?>">
                           <p><?php echo tp_kses($settings['hero_people_text']);?></p>
                        </div>
                        <?php endif; ?>  
                     </div>
                  </div>
                  <div class="col-xxl-5 offset-xxl-1 col-xl-6 col-lg-6">
                     <div class="slider__thumb-wrapper-6 mb-10 pl-40 pr-30 scene">
                        <div class="slider__thumb-6 pl-20 one">
                           <img class="layer" data-depth="0.2" src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                        </div>
                        <div class="slider__thumb-6 two">
                           <img class="layer" data-depth="0.3" src="<?php echo esc_url($tp_image_2); ?>" alt="<?php echo esc_attr($tp_image_2_alt); ?>">
                        </div>
                        <div class="slider__thumb-6 three">
                           <img class="layer" data-depth="0.4" src="<?php echo esc_url($tp_image_3); ?>" alt="<?php echo esc_attr($tp_image_3_alt); ?>">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- slider area end -->


         <?php elseif ( $settings['tp_design_style']  == 'layout-7' ): 
            $bloginfo = get_bloginfo( 'name' );
            $this->add_render_attribute('title_args', 'class', 'slider__title-9 tp-el-title');

            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }

            // btn Link
            if ('2' == $settings['tp_slider_btn_link_type']) {
                $link = get_permalink($settings['tp_slider_btn_page_link']);
                $target = '_self';
                $rel = 'nofollow';
            } else {
                $link = !empty($settings['tp_slider_btn_link']['url']) ? $settings['tp_slider_btn_link']['url'] : '';
                $target = !empty($settings['tp_slider_btn_link']['is_external']) ? '_blank' : '';
                $rel = !empty($settings['tp_slider_btn_link']['nofollow']) ? 'nofollow' : '';
            }

            $enable_gradient_bg = $settings['enable_gradient_bg'] == 'yes' ? 'tp-disable-gradient' : '' ;
        ?>

         <!-- slider area start -->
         <section class="slider__area slider__height-9 pt-140 p-relative fix tp-el-section tp_subtitle_line">
            <div class="slider__item-9">
               <div class="container">
                  <div class="row align-items-end">
                     <div class="col-xl-7 col-lg-6 col-md-7">
                        <div class="slider__content-9 tp-el-content">

                            <?php if (!empty($settings['tp_slider_sub_title'])) : ?>
                            <span class="slider__title-pre-9 tp-el-subtitle"><?php echo tp_kses( $settings['tp_slider_sub_title'] ); ?></span>
                            <?php endif; ?>

                            <?php
                                if ( !empty($settings['tp_slider_title' ]) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['tp_slider_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        tp_kses( $settings['tp_slider_title' ] )
                                        );
                                endif;
                            ?>
                           
                           <?php if (!empty($settings['tp_slider_description'])) : ?>
                            <p><?php echo tp_kses( $settings['tp_slider_description'] ); ?></p>
                            <?php endif; ?>

                            <?php if (!empty($link)) : ?>
                           <div class="slider__btn-9 mb-85">
                              <a class="tp-btn-5 tp-link-btn-3 tp-el-gradient-btn" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>"> 
                              <?php echo tp_kses($settings['tp_slider_btn_text']); ?>
                                 <span>
                                    <i class="fa-regular fa-arrow-right"></i>
                                 </span>
                              </a>
                           </div>
                           <?php endif; ?> 
                           

                        

                           <div class="slider__social-9 d-flex flex-wrap align-items-center">
                                <?php if (!empty($settings['tp_hero_social_title'])) : ?>
                                <span class="tp-el-social-title"><?php echo tp_kses( $settings['tp_hero_social_title'] ); ?></span>
                                <?php endif; ?> 

                                <?php if ($settings['show_profiles'] && is_array($settings['profiles'])) : ?>
                                <ul>
                                    <?php
                                        foreach ($settings['profiles'] as $profile) :
                                        $icon = $profile['name'];
                                        $svg = $profile['tp_box_icon_svg'];

                                        $url = esc_url($profile['link']['url']);

                                    ?>
                                    <li>
                                        <a target="_blank" rel="noopener"  href="<?php echo esc_url($url); ?>" class="tp-el-social-link elementor-repeater-item-<?php echo esc_attr($profile['_id']) ; ?>">
                                        <?php if (!empty($svg)) : ?>
                                            <?php echo tp_kses($svg); ?>
                                        <?php else : ?>
                                            <i class="fab fa-<?php echo esc_attr($icon); ?>" aria-hidden="true"></i>
                                        <?php endif; ?>
                                        </a>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                                <?php endif; ?> 
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-5 col-lg-6 col-md-5 order-first order-md-last">
                        <div class="slider__thumb-9 <?php echo esc_attr($enable_gradient_bg) ?> p-relative scene">
                        <?php if(!empty($settings['tp_slider_shape_switch'])) : ?>
                           <div class="slider__shape">
                              <div class="slider__shape-20">
                                 <img class="layer" data-depth=".2" src="<?php echo get_template_directory_uri() . '/assets/img/slider/9/slider-shape-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                              </div>
                              <div class="slider__shape-21">
                                 <img class="layer" data-depth=".3" src="<?php echo get_template_directory_uri() . '/assets/img/slider/9/slider-shape-2.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                              </div>
                           </div>
                            <?php endif; ?>
                            
                           <img class="slider__thumb-9-main" src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">

                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- slider area end -->

		<?php else: 
            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }


            if ( ! empty( $settings['tp_slider_mouse_link']['url'] ) ) {
                $this->add_link_attributes( 'tp-button-text-arg', $settings['tp_slider_mouse_link'] );
                $this->add_link_attributes( 'tp-button-arg', $settings['tp_slider_mouse_link'] );
                $this->add_render_attribute('tp-button-arg', 'class', 'mouse-scroll-icon mouse-scroll-icon-4');
            }

            // btn Link
            if ('2' == $settings['tp_slider_btn_link_type']) {
                $link = get_permalink($settings['tp_slider_btn_page_link']);
                $target = '_self';
                $rel = 'nofollow';
            } else {
                $link = !empty($settings['tp_slider_btn_link']['url']) ? $settings['tp_slider_btn_link']['url'] : '';
                $target = !empty($settings['tp_slider_btn_link']['is_external']) ? '_blank' : '';
                $rel = !empty($settings['tp_slider_btn_link']['nofollow']) ? 'nofollow' : '';
            }

            $bloginfo = get_bloginfo( 'name' );
			$this->add_render_attribute('title_args', 'class', 'slider__title-4 tp-el-title');
		?>

         <!-- slider area start -->
         <section class="slider__area slider-mt-50 p-relative z-index-1 slider__height-4 d-flex align-items-center tp-el-section" data-bg-color="green-dark">
            <?php if (!empty($settings['tp_slider_mouse_link'])) : ?>
            <div class="slider__mouse-scroll slider__mouse-scroll-4 smooth d-flex align-items-center">
               <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>></a>
               <p><a <?php echo $this->get_render_attribute_string( 'tp-button-text-arg' ); ?>><?php echo esc_html($settings['tp_slider_mouse_text']); ?></a></p>
            </div>
            <?php endif; ?>

            <?php if(!empty($settings['tp_slider_shape_switch'])) : ?>
            <div class="slider__shape">
               <img class="slider__shape-4-1" src="<?php echo get_template_directory_uri() . '/assets/img/slider/4/slider-shape-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="slider__shape-4-2 jarallax" src="<?php echo get_template_directory_uri() . '/assets/img/slider/4/slider-shape-2.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="slider__shape-4-3 jarallax" src="<?php echo get_template_directory_uri() . '/assets/img/slider/4/slider-shape-3.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
            </div>
            <?php endif; ?>

            <div class="container">
               <div class="row align-items-center">
                  <div class="col-xxl-7 col-xl-6 col-lg-6 col-md-6">
                     <div class="slider__content-4 tp-el-content">
                            <?php if (!empty($settings['tp_slider_sub_title'])) : ?>
                            <span class="slider__title-pre-4 tp-el-subtitle"><?php echo tp_kses( $settings['tp_slider_sub_title'] ); ?></span>
                            <?php endif; ?>

                            <?php
                                if ( !empty($settings['tp_slider_title' ]) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['tp_slider_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        tp_kses( $settings['tp_slider_title' ] )
                                        );
                                endif;
                            ?>

                            <?php if (!empty($settings['tp_slider_description'])) : ?>
                            <p><?php echo tp_kses( $settings['tp_slider_description'] ); ?></p>
                            <?php endif; ?> 

                        <?php if (!empty($link)) : ?>
                        <div class="slider__btn-4">
                           <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>" class="tp-btn-brown tp-el-box-btn"><?php echo tp_kses($settings['tp_slider_btn_text']); ?></a>
                        </div>
                        <?php endif; ?> 
                     </div>
                  </div>
                  <div class="col-xxl-5 col-xl-6 col-lg-6 col-md-6">

                     <div class="slider__thumb-4 m-img " >
                        <img class="wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s" src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                     </div>

                  </div>
               </div>
            </div>
         </section>
         <!-- slider area end -->


        <?php endif; ?>

        <?php 
		
	}

}

$widgets_manager->register( new TP_Hero_Banner() );