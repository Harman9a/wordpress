<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Box_Shadow;
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
class TP_About_Box extends Widget_Base {

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
		return 'about-box';
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
		return __( 'About Box', 'tp-core' );
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->tp_section_title_render_controls('about', 'Section Title', 'Sub Title', 'your title here', 'Hic nesciunt galisum aut dolorem');

        $this->start_controls_section(
            'tp_section_subtitle_line_sec',
                [
                  'label' => esc_html__( 'Subtitle Line Color', 'tpcore' ),
                  'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                  'condition' =>[
                    'tp_design_style' => ['layout-2'],
                    ]
                ]
           );
           
           $this->add_control(
               'tp_subtitle_line',
               [
                   'label' => esc_html__( 'Line BG Color', 'tpcore' ),
                   'type' => Controls_Manager::TEXT,
                   'selectors' => [
                       '{{WRAPPER}} .about-subtitle::after' => 'background: {{VALUE}};',
                   ],
                   'placeholder' => esc_html__( 'red', 'tpcore' ),
               ]
           );

           
           $this->end_controls_section();

        $this->start_controls_section(
            'tp_about_features_sec',
                [
                  'label' => esc_html__( 'About Features', 'tpcore' ),
                  'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                  'condition' =>[
                    'tp_design_style' => 'layout-1'
                  ]
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
            'tp_box_icon_image',
            [
                'label' => esc_html__('Upload Icon Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_box_icon_type' => 'image',
                    
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
                        
                    ]
                ]
            );
        }

        $repeater->add_control(
            'want_customize',
            [
                'label' => esc_html__( 'Want To Customize?', 'tpcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'tpcore' ),
                'label_off' => esc_html__( 'No', 'tpcore' ),
                'return_value' => 'yes',
                'description' => esc_html__( 'You can customize this item from here or customize from Style tab', 'tpcore' ),
                'style_transfer' => true,
            ]
        );
        
        
        $repeater->add_control(
            'features_icon_color',
            [
                'label'       => esc_html__( 'Feature Icon Color', 'tpcore' ),
                'type'     => \Elementor\Controls_Manager::COLOR,
                'selectors' => ['{{WRAPPER}} {{CURRENT_ITEM}} span' => 'color: {{VALUE}}'],
                'default' => '#5EB74B',
                'condition' => ['want_customize' => 'yes'],
            ]
        );


            $repeater->add_control(
            'tp_features_box_title',
              [
                'label'   => esc_html__( 'Features Title', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Business Strategy', 'tpcore' ),
                'label_block' => true,
              ]
            );
            
           
            $repeater->add_control(
            'tp_features_box_desc',
              [
                'label'   => esc_html__( 'Features Description', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => esc_html__( 'Your total saving', 'tpcore' ),
                'label_block' => true,
              ]
            );

            $repeater->add_control(
                'tp_features_link_switcher',
                [
                    'label' => esc_html__( 'Add Features link', 'tpcore' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Yes', 'tpcore' ),
                    'label_off' => esc_html__( 'No', 'tpcore' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'separator' => 'before',
                ]
            );

            $repeater->add_control(
                'tp_features_link_type',
                [
                    'label' => esc_html__( 'Features Link Type', 'tpcore' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'options' => [
                        '1' => 'Custom Link',
                        '2' => 'Internal Page',
                    ],
                    'default' => '1',
                    'condition' => [
                        'tp_features_link_switcher' => 'yes'
                    ]
                ]
            );
            $repeater->add_control(
                'tp_features_link',
                [
                    'label' => esc_html__( 'Features link', 'tpcore' ),
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
                        'tp_features_link_type' => '1',
                        'tp_features_link_switcher' => 'yes',
                    ]
                ]
            );
            $repeater->add_control(
                'tp_features_page_link',
                [
                    'label' => esc_html__( 'Select Features Link Page', 'tpcore' ),
                    'type' => \Elementor\Controls_Manager::SELECT2,
                    'label_block' => true,
                    'options' => tp_get_all_pages(),
                    'condition' => [
                        'tp_features_link_type' => '2',
                        'tp_features_link_switcher' => 'yes',
                    ]
                ]
            );
            
            $this->add_control(
                'tp_features_list',
                [
                    'label' => esc_html__('Features - List', 'tpcore'),
                    'type' => \Elementor\Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'default' => [
                        [
                            'tp_features_box_title' => esc_html__('Business Stratagy', 'tpcore'),
                        ],
                        [
                            'tp_features_box_title' => esc_html__('Website Development', 'tpcore')
                        ],
                        [
                            'tp_features_box_title' => esc_html__('Marketing & Reporting', 'tpcore')
                        ]
                    ],
                    'title_field' => '{{{ tp_features_box_title }}}',
                ]
            );
            $this->add_responsive_control(
                'tp_features_align',
                [
                    'label' => esc_html__( 'Alignment', 'tpcore' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'text-left' => [
                            'title' => esc_html__( 'Left', 'tpcore' ),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'text-center' => [
                            'title' => esc_html__( 'Center', 'tpcore' ),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'text-right' => [
                            'title' => esc_html__( 'Right', 'tpcore' ),
                            'icon' => 'eicon-text-align-right',
                        ],
                    ],
                    'toggle' => true,
                    'separator' => 'before',
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
            'about_fact_sec',
                [
                  'label' => esc_html__( 'Fact', 'tpcore' ),
                  'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                  'condition' =>[
                    'tp_design_style' => 'layout-1'
                  ]
                ]
           );
           
           $repeater = new \Elementor\Repeater();
           
            $repeater->add_control(
            'about_fact_title',
              [
                'label'   => esc_html__( 'Fact Title', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Years Of Experience', 'tpcore' ),
                'label_block' => true,
              ]
            );
            $repeater->add_control(
            'about_fact_number',
             [
                'label'       => esc_html__( 'Fact Number', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( '24', 'tpcore' ),
                'placeholder' => esc_html__( 'Placeholder Text', 'tpcore' ),
             ]
            );
            
            $this->add_control(
              'about_fact_list',
              [
                'label'       => esc_html__( 'Fact List', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                  [
                    'about_fact_title'   => esc_html__( 'Years Of Experience', 'tpcore' ),
                  ],
                  [
                    'about_fact_title' => esc_html__('Website Development', 'tpcore')
                  ],
                ],
                'title_field' => '{{{ about_fact_title }}}',
              ]
            );
           
           
           
           $this->end_controls_section();

           $this->start_controls_section(
            'about_video_sec',
                [
                  'label' => esc_html__( 'Video', 'tpcore' ),
                  'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                  'condition' =>[
                    'tp_design_style' => 'layout-1'
                  ]
                ]
           );
           
           $this->add_control(
            'about_video_thumb',
            [
              'label'   => esc_html__( 'Upload Image', 'tpcore' ),
              'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                  'url' => \Elementor\Utils::get_placeholder_image_src(),
              ],
            ]
           );
           
           $this->add_control(
            'about_video_url',
            [
              'label'   => esc_html__( 'Video URL', 'tpcore' ),
              'type'        => \Elementor\Controls_Manager::URL,
              'default'     => [
                  'url'               => '#',
                  'is_external'       => true,
                  'nofollow'          => true,
                  'custom_attributes' => '',
                ],
                'placeholder' => esc_html__( 'Your URL', 'tpcore' ),
                'label_block' => true,
              ]
            );

            $this->add_group_control(
                Group_Control_Image_Size::get_type(),
                [
                    'name' => 'video_thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                    'exclude' => ['custom'],
                    // 'default' => 'tp-post-thumb',
                ]
            );
           
           $this->end_controls_section();

        $this->tp_button_render('about', 'Button', 'layout-2');

	}

    // style_tab_content
    protected function style_tab_content(){

        $this->tp_section_style_controls('about_section', 'Section - Style', '.tp-el-section');
        $this->tp_section_style_controls('about_section_inner', 'Section Inner - Style', '.tp-el-section-inner');
        $this->tp_basic_style_controls('about_subtitle', 'Section - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('about_title', 'Section - Title', '.tp-el-title');
        $this->tp_basic_style_controls('about_description', 'Section - Description', '.tp-el-content p');

        $this->tp_link_controls_style('about_btn', 'Section - Button', '.tp-el-box-btn');
        

        // gradient button color
        $this->start_controls_section(
            'tp_hero_gradient_btn_button',
            [
                'label' => esc_html__('About Gradient Button', 'tp-core'),
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

        $this->tp_icon_style('about_box_icon', 'Features - Icon', '.tp-el-box-icon span');
        $this->tp_basic_style_controls('about_box_title', 'Features - Title', '.tp-el-box-title');
        $this->tp_basic_style_controls('about_box_desc', 'Features - Description', '.tp-el-box-desc');

        $this->tp_basic_style_controls('about_fact', 'Fact - Title', '.tp-el-fact-title');
        $this->tp_basic_style_controls('about_desc', 'Fact - Description', '.tp-el-fact-desc');

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
            $this->add_render_attribute('title_args', 'class', 'about-title tp-el-title');
            $bloginfo = get_bloginfo( 'name' );

            // btn Link
            if ('2' == $settings['tp_about_btn_link_type']) {
                $link = get_permalink($settings['tp_about_btn_page_link']);
                $target = '_self';
                $rel = 'nofollow';
            } else {
                $link = !empty($settings['tp_about_btn_link']['url']) ? $settings['tp_about_btn_link']['url'] : '';
                $target = !empty($settings['tp_about_btn_link']['is_external']) ? '_blank' : '';
                $rel = !empty($settings['tp_about_btn_link']['nofollow']) ? 'nofollow' : '';
            }
        ?>

        <!-- about area start -->
        <section class="about__area about__space-145 tp-el-section">
            <div class="about__inner-9 black-bg tp-el-section-inner wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s">
               <div class="container">
                  <div class="row justify-content-center">
                     <div class="col-xxl-10 col-xl-10 col-lg-11 col-md-10">
                        <div class="about__wrapper-9 tp-el-content">
                            <?php if ( !empty($settings['tp_about_section_title_show']) ) : ?>
                                <?php if ( !empty($settings['tp_about_sub_title']) ) : ?>
                                <span class="about-subtitle tp-el-subtitle"><?php echo tp_kses( $settings['tp_about_sub_title'] ); ?></span>
                                <?php endif; ?>

                                <?php
                                    if ( !empty($settings['tp_about_title' ]) ) :
                                        printf( '<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape( $settings['tp_about_title_tag'] ),
                                            $this->get_render_attribute_string( 'title_args' ),
                                            tp_kses( $settings['tp_about_title' ] )
                                            );
                                    endif;
                                ?>

                                <?php if (!empty($settings['tp_about_description' ])): ?>
                                <p><?php echo tp_kses($settings['tp_about_description']); ?></p>
                                <?php endif; ?>
                            <?php endif; ?>

                            <?php if (!empty($link)) : ?>
                           <div class="about__btn-9">
                              <a class="tp-btn-5 tp-btn-5-white tp-el-gradient-btn" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>"><?php echo tp_kses($settings['tp_about_btn_text']); ?></a>
                           </div>
                           <?php endif; ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- about area end -->


		<?php else:
            $bloginfo = get_bloginfo( 'name' );
            $this->add_render_attribute('title_args', 'class', 'section__title-6 tp-el-title');

            if ( !empty($settings['about_video_thumb']['url']) ) {
                $about_video_thumb_url = !empty($settings['about_video_thumb']['id']) ? wp_get_attachment_image_url( $settings['about_video_thumb']['id'], $settings['video_thumbnail_size']) : $settings['about_video_thumb']['url'];
                $about_video_thumb_alt = get_post_meta($settings["about_video_thumb"]["id"], "_wp_attachment_image_alt", true);
            }

		?>

         <!-- about area start -->
         <section class="about__area pt-110 pb-120 p-relative tp-el-section">

            <?php if(!empty($settings['tp_about_shape_switch'])) :?>
            <div class="about__shape">
               <img class="about__shape-3" src="<?php echo get_template_directory_uri() . '/assets/img/about/6/shape/about-shape-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="about__shape-4" src="<?php echo get_template_directory_uri() . '/assets/img/about/6/shape/about-shape-2.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="about__shape-5" src="<?php echo get_template_directory_uri() . '/assets/img/about/6/shape/about-shape-3.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="about__shape-6" src="<?php echo get_template_directory_uri() . '/assets/img/about/6/shape/about-shape-4.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
            </div>
            <?php endif; ?>

            <div class="container">
            <?php if ( !empty($settings['tp_about_section_title_show']) ) : ?>
               <div class="row">
                  <div class="col-xxl-5 col-xl-7 col-lg-6">
                     <div class="about__section-wrapper-6">

                        <div class="section__title-wrapper-6 mb-125">

                            <?php if (!empty($settings['tp_about_sub_title'])) : ?>
                            <span class="slider__title-pre-6 tp-el-subtitle"><?php echo tp_kses( $settings['tp_about_sub_title'] ); ?></span>
                            <?php endif; ?>

                           <?php
                                if ( !empty($settings['tp_about_title' ]) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['tp_about_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        tp_kses( $settings['tp_about_title' ] )
                                        );
                                endif;
                            ?>
                        </div>

                     </div>
                  </div>
                  <div class="col-xxl-6 offset-xxl-1 col-xl-5 offset-xl-0 col-lg-5 offset-lg-1">
                     <div class="section__title-wrapper-6 tp-el-content">
                        <?php if (!empty($settings['tp_about_description' ])): ?>
                        <p><?php echo tp_kses($settings['tp_about_description']); ?></p>
                        <?php endif; ?>
                     </div>
                  </div>
               </div>
               <?php endif; ?>
               <div class="row">
                  <div class="col-xxl-3 col-xl-3 col-lg-4">
                     <div class="about__features">
                        <?php foreach ($settings['tp_features_list'] as $key => $item) :
                            // Link
                            if ('2' == $item['tp_features_link_type']) {
                                $link = get_permalink($item['tp_features_page_link']);
                                $target = '_self';
                                $rel = 'nofollow';
                            } else {
                                $link = !empty($item['tp_features_link']['url']) ? $item['tp_features_link']['url'] : '';
                                $target = !empty($item['tp_features_link']['is_external']) ? '_blank' : '';
                                $rel = !empty($item['tp_features_link']['nofollow']) ? 'nofollow' : '';
                            }
                        ?>
                        <div class="about__features-item d-flex align-items-start wow fadeInUp elementor-repeater-item-<?php echo esc_attr($item['_id']); ?>" data-wow-delay=".3s" data-wow-duration="1s">
                           <div class="about__features-icon tp-el-box-icon <?php echo esc_attr($item['features_icon_color']); ?>">
                              <?php if($item['tp_box_icon_type'] == 'icon') : ?>
                                <?php if (!empty($item['tp_box_icon']) || !empty($item['tp_box_selected_icon']['value'])) : ?>
                                        <span><?php tp_render_icon($item, 'tp_box_icon', 'tp_box_selected_icon'); ?></span>
                                <?php endif; ?>
                            <?php elseif( $item['tp_box_icon_type'] == 'image' ) : ?>
                                <span>
                                    <?php if (!empty($item['tp_box_icon_image']['url'])): ?>
                                    <img src="<?php echo $item['tp_box_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
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
                           <div class="about__features-content">
                                <?php if (!empty($item['tp_features_box_title' ])): ?>
                                <h3 class="about__features-title tp-el-box-title">
                                    <?php if ($item['tp_features_link_switcher'] == 'yes') : ?>
                                    <a href="<?php echo esc_url($link); ?>"><?php echo tp_kses($item['tp_features_box_title' ]); ?></a>
                                    <?php else : ?>
                                        <?php echo tp_kses($item['tp_features_box_title' ]); ?>
                                    <?php endif; ?>
                                </h3>
                                <?php endif; ?>

                            <?php if (!empty($item['tp_features_box_desc' ])): ?>
                            <p class="tp-el-box-desc"><?php echo tp_kses($item['tp_features_box_desc']); ?></p>
                            <?php endif; ?>

                              
                           </div>
                        </div>
                        <?php endforeach; ?>
                     </div>
                  </div>
                  <div class="col-xxl-9 col-xl-9 col-lg-8">
                     <div class="about__video-wrapper wow fadeInUp" data-wow-delay=".5s" data-wow-duration="1s">

                         <div class="about__video-counter d-sm-flex align-items-center">
                            <?php foreach ($settings['about_fact_list'] as $key => $item) : ?>

                           <div class="about__video-counter-item d-flex align-items-center">
                            <?php if(!empty($item['about_fact_number' ])): ?>
                              <h4 class="tp-el-fact-title"><span><?php echo tp_kses($item['about_fact_number' ]); ?></span></h4>
                              <?php endif; ?>

                              <?php if(!empty($item['about_fact_title' ])): ?>
                              <p class="tp-el-fact-desc"><?php echo tp_kses($item['about_fact_title' ]); ?></p>
                              <?php endif; ?>
                           </div>
                           <?php endforeach; ?>
                        </div>

                        <?php if(!empty($about_video_thumb_url)) : ?>
                        <div class="about__video-thumb">
                           <img src="<?php echo esc_url($about_video_thumb_url); ?>" alt="<?php echo esc_attr($about_video_thumb_alt); ?>">
                           <?php if(!empty($settings['about_video_url']['url'])) : ?>
                           <div class="about__play">
                              <a href="<?php echo esc_url($settings['about_video_url']['url']); ?>" class="about__play-btn popup-video tp-pulse-border">
                                 <span class="video-play-bg"></span>
                                 <img src="<?php echo get_template_directory_uri() . '/assets/img/about/6/about-play-icon.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                              </a>
                           </div>
                           <?php endif; ?>
                        </div>
                        <?php endif; ?>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- about area end -->

        <?php endif; ?>

        <?php
	}
}

$widgets_manager->register( new TP_About_Box() );
