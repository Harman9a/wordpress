<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;
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
class TP_About extends Widget_Base {

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
		return 'about';
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
		return __( 'About', 'tp-core' );
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
                    'layout-3' => esc_html__('Layout 3', 'tp-core'),
                    'layout-4' => esc_html__('Layout 4', 'tp-core'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->tp_section_title_render_controls('about', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.');


        // tp_btn_button_group
        $this->start_controls_section(
            'tp_btn_button_group',
            [
                'label' => esc_html__('Button', 'tp-core'),
            ]
        );

        $this->add_control(
            'tp_btn_button_show',
            [
                'label' => esc_html__( 'Show Button', 'tp-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tp-core' ),
                'label_off' => esc_html__( 'Hide', 'tp-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'tp_btn_text',
            [
                'label' => esc_html__('Button Text', 'tp-core'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'tp-core'),
                'title' => esc_html__('Enter button text', 'tp-core'),
                'label_block' => true,
                'condition' => [
                    'tp_btn_button_show' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'tp_btn_link_type',
            [
                'label' => esc_html__('Button Link Type', 'tp-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'label_block' => true,
                'condition' => [
                    'tp_btn_button_show' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'tp_btn_link',
            [
                'label' => esc_html__('Button link', 'tp-core'),
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
                    'tp_btn_link_type' => '1',
                    'tp_btn_button_show' => 'yes'
                ],
                'label_block' => true,
            ]
        );
        $this->add_control(
            'tp_btn_page_link',
            [
                'label' => esc_html__('Select Button Page', 'tp-core'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_btn_link_type' => '2',
                    'tp_btn_button_show' => 'yes'
                ]
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            '_tp_author',
            [
                'label' => esc_html__('Author Image', 'tp-core'),
                'condition' => [
                    'tp_design_style' => ['layout-1']
                ]
            ]
        );

        $this->add_control(
            'tp_author_switch',
            [
                'label' => esc_html__( 'Show Author', 'tp-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tp-core' ),
                'label_off' => esc_html__( 'Hide', 'tp-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'tp_author_thumb',
            [
                'label' => esc_html__( 'Choose Image', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_author_switch' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'tp_author_title',
            [
                'label' => esc_html__('Author Title', 'tp-core'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('TP Title Here', 'tp-core'),
                'placeholder' => esc_html__('Type Heading Text', 'tp-core'),
                'label_block' => true,
                'condition' => [
                    'tp_author_switch' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'tp_author_message',
            [
                'label' => esc_html__('Author Message', 'tp-core'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('TP Title Here', 'tp-core'),
                'placeholder' => esc_html__('Type Heading Text', 'tp-core'),
                'label_block' => true,
                'condition' => [
                    'tp_author_switch' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();
      
        $this->start_controls_section(
            '_tp_experience',
            [
                'label' => esc_html__('Experience', 'tp-core'),
                'condition' => [
                    'tp_design_style' => ['layout-1', 'layout-2']
                ]
            ]
        );

        $this->add_control(
            'tp_experience_switch',
            [
                'label' => esc_html__( 'Show Experience', 'tp-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tp-core' ),
                'label_off' => esc_html__( 'Hide', 'tp-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'tp_experience_num',
            [
                'label' => esc_html__('Experience Number', 'tp-core'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('12', 'tp-core'),
                'placeholder' => esc_html__('Type Experience value (INT)', 'tp-core'),
                'label_block' => true,
                'condition' => [
                    'tp_experience_switch' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'tp_experience_num_text',
            [
                'label' => esc_html__('Experience Number Text', 'tp-core'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Experience Text', 'tp-core'),
                'placeholder' => esc_html__('Type Thumbnail Text', 'tp-core'),
                'label_block' => true,
                'condition' => [
                    'tp_experience_switch' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'tp_experience_icon_type',
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
        $this->add_control(
            'tp_experience_icon_svg',
            [
                'show_label' => false,
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__('SVG Code Here', 'tpcore'),
                'condition' => [
                    'tp_experience_icon_type' => 'svg',
                ]
            ]
        );

        $this->add_control(
            'tp_experience_icon_image',
            [
                'label' => esc_html__('Upload Icon Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_experience_icon_type' => 'image',
                ]
            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $this->add_control(
                'tp_experience_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'tp_experience_icon_type' => 'icon',
                    ]
                ]
            );
        } else {
            $this->add_control(
                'tp_experience_selected_icon',
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
                        'tp_experience_icon_type' => 'icon',
                    ]
                ]
            );
        }

        $this->end_controls_section();

        $this->start_controls_section(
         'tp_shape_section',
             [
               'label' => esc_html__( 'Shape Controls', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
               'condition' => [
                    'tp_design_style' => ['layout-2', 'layout-3']
               ]
             ]
        );

        $this->add_control(
         'tp_shape_switch',
            [
            'label'        => esc_html__( 'Show Shape', 'tpcore' ),
            'type'         => \Elementor\Controls_Manager::SWITCHER,
            'label_on'     => esc_html__( 'Show', 'tpcore' ),
            'label_off'    => esc_html__( 'Hide', 'tpcore' ),
            'return_value' => 'yes',
            'default'      => 'yes',
            ]
        );

        $this->add_control(
         'tp_shape',
            [
            'label'   => esc_html__( 'Upload Image', 'tpcore' ),
            'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_shape_switch' => 'yes',
                    'tp_design_style' => 'layout-2',
               ]
            ]
        );

        $this->add_control(
         'tp_shape_logo',
                [
                'label'   => esc_html__( 'Upload Image Logo', 'tpcore' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                    'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_shape_switch' => 'yes',
                    'tp_design_style' => 'layout-2'
            ]
         ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tp_shape_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ],
                'condition' => [
                    'tp_design_style' => 'layout-2'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tp_shape_logo_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ],
                'condition' => [
                    'tp_design_style' => 'layout-2'
                ]
            ]
        );
        
        $this->end_controls_section();

        //
        $this->start_controls_section(
         'tp_about_call_section',
             [
               'label' => esc_html__( 'About Call', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
               'condition' =>[
                    'tp_design_style' => 'layout-2',
                ]
             ]
        );
        $this->add_control(
         'tp_about_call_switch',
         [
           'label'        => esc_html__( 'About Call On/Off', 'tpcore' ),
           'type'         => \Elementor\Controls_Manager::SWITCHER,
           'label_on'     => esc_html__( 'Show', 'tpcore' ),
           'label_off'    => esc_html__( 'Hide', 'tpcore' ),
           'return_value' => 'yes',
           'default'      => 'yes',
         ]
        );
        $this->add_control(
            'tp_about_call_title',
            [
                'label'       => esc_html__( 'About Call Title', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Default Text', 'tpcore' ),
                'placeholder' => esc_html__( 'Placeholder Text', 'tpcore' ),
                'condition' =>[
                    'tp_about_call_switch' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'tp_about_call_num',
            [
                'label'       => esc_html__( 'About Call Number', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Default Text', 'tpcore' ),
                'placeholder' => esc_html__( 'Placeholder Text', 'tpcore' ),
                'condition' =>[
                    'tp_about_call_switch' => 'yes',
                ]
            ]
        );

        $this->tp_icon_controls('box');
        
        
        $this->end_controls_section();
        

        // _tp_image
		$this->start_controls_section(
            '_tp_image',
            [
                'label' => esc_html__('Thumbnail', 'tp-core'),
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
            'tp_thumb_text',
            [
                'label' => esc_html__('Thumbnail Text', 'tp-core'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Experience', 'tp-core'),
                'placeholder' => esc_html__('Type Thumbnail Text', 'tp-core'),
                'label_block' => true,
                'condition' => [
                    'tp_design_style' => ['layout-1']
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
         'tp_about_video',
             [
               'label' => esc_html__( 'Video', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
               'condition' => [
                    'tp_design_style' => ['layout-3']
                ]
             ]
        );
        
        $this->add_control(
         'tp_about_video_url',
         [
           'label'   => esc_html__( 'Video URL', 'tpcore' ),
           'type'        => \Elementor\Controls_Manager::URL,
           'default'     => [
               'url'               => '#',
               'is_external'       => true,
               'nofollow'          => true,
               'custom_attributes' => '',
             ],
             'placeholder' => esc_html__( 'your link', 'tpcore' ),
             'label_block' => true,
           ]
         );
        
        
        $this->end_controls_section();

        $this->start_controls_section(
         'tp_about_analysis',
             [
               'label' => esc_html__( 'About Analysis', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
               'condition' => [
                'tp_design_style' => 'layout-4'
               ]
             ]
        );
        
        $this->tp_icon_controls('analysis_box', 'layout-4');
        
        $this->add_control(
        'tp_about_analysis_title',
            [
                'label'       => esc_html__( 'Analysis Title', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Data Analysis', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
                'label_block' => true,
            ]
        );

        
        $repeater = new \Elementor\Repeater();
        
         $repeater->add_control(
         'tp_analysis_box_title',
           [
             'label'   => esc_html__( 'Analysis Title', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::TEXT,
             'default'     => esc_html__( 'Business Strategy', 'tpcore' ),
             'label_block' => true,
           ]
         );
         
        
         $repeater->add_control(
         'tp_analysis_box_desc',
           [
             'label'   => esc_html__( 'Analysis Description', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::TEXT,
             'default'     => esc_html__( 'Your total saving', 'tpcore' ),
             'label_block' => true,
           ]
         );
         
         $this->add_control(
           'tp_analysis_list',
           [
             'label'       => esc_html__( 'Analysis List', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::REPEATER,
             'fields'      => $repeater->get_controls(),
             'default'     => [
               [
                 'tp_analysis_box_title'   => esc_html__( 'Analysis Title', 'tpcore' ),
               ],
               [
                 'tp_analysis_box_title'   => esc_html__( 'Analysis Title 2', 'tpcore' ),
               ],
             ],
             'title_field' => '{{{ tp_analysis_box_title }}}',
           ]
         );

         $this->add_control(
         'tp_analysis_discount',
          [
             'label'       => esc_html__( 'Analysis Discount', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::TEXT,
             'default'     => esc_html__( '-36.5%', 'tpcore' ),
             'placeholder' => esc_html__( 'Placeholder Text', 'tpcore' ),
             'label_block' => true,
          ]
         );

        
        $this->end_controls_section();
        

        $this->start_controls_section(
         'about_features_list_sec',
             [
               'label' => esc_html__( 'About List', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
               'condition' => [
                'tp_design_style' => 'layout-4'
               ]
             ]
        );
        
        
        $repeater = new \Elementor\Repeater();
        
         $repeater->add_control(
         'about_features_title',
           [
             'label'   => esc_html__( 'About List Title', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::TEXT,
             'default'     => esc_html__( 'See the action in live', 'tpcore' ),
             'label_block' => true,
           ]
         );
         
         $repeater->add_control(
         'about_features_desc',
            [
                'label'       => esc_html__( 'About List Description', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => esc_html__( 'Our consultants specialise in one of five practice development.', 'tpcore' ),
                'placeholder' => esc_html__( 'Placeholder Text', 'tpcore' ),
                'label_block' => true,
            ]
         );

         $this->add_control(
           'about_features_list',
           [
             'label'       => esc_html__( 'About List', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::REPEATER,
             'fields'      => $repeater->get_controls(),
             'default'     => [
               [
                 'about_features_title'   => esc_html__( 'See the action in live', 'tpcore' ),
               ],
               [
                 'about_features_title'   => esc_html__( 'Intuitive dashboard', 'tpcore' ),
               ],
             ],
             'title_field' => '{{{ about_features_title }}}',
           ]
         );
        
        $this->end_controls_section();

	}

    // style_tab_content
    protected function style_tab_content(){

        $this->tp_section_style_controls('about_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('about_subtitle', 'About - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('about_title', 'About - Title', '.tp-el-title');
        $this->tp_basic_style_controls('about_description', 'About - Description', '.tp-el-content > p');

        $this->tp_basic_style_controls('about_author_title', 'Author - Title', '.tp-el-box-title');
        $this->tp_link_controls_style('about_author_message', 'Author - Message', '.tp-el-author-message');
        
        $this->tp_basic_style_controls('about_author_experience_side', 'Experience - Side Text', '.tp-el-experience-side-title::after');
        $this->tp_basic_style_controls('about_author_experience', 'Experience - Title', '.tp-el-experience-title');
        $this->tp_basic_style_controls('about_experience_year', 'Experience - Year', '.tp-el-experience-num');
        $this->tp_basic_style_controls('about_experience_desc', 'Experience - Desc', '.tp-el-experience-desc');
        $this->tp_icon_style('about_experience_icon', 'Experience - Icon', '.tp-el-experience-icon span');

        $this->tp_basic_style_controls('about_author_contact', 'Contact - Title', '.tp-el-contact-title');
        $this->tp_icon_style('about_author_desc', 'Contact - Icon', '.tp-el-contact-icon span');
        $this->tp_basic_style_controls('about_author_icon', 'Contact - Desc', '.tp-el-contact-desc');

        $this->tp_link_controls_style('about_box_link_btn', 'About - Button', '.tp-el-box-btn');


        $this->tp_icon_style('about_list_icon', 'List - Icon', '.tp-el-list-icon span, .tp-el-list-icon span::after');
        $this->tp_basic_style_controls('about_list_title', 'List - Title', '.tp-el-list-title');
        $this->tp_basic_style_controls('about_list_desc', 'List - Description', '.tp-el-list-desc');

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
            $this->add_render_attribute('title_args', 'class', 'section__title-4-2 tp-el-title');
            $bloginfo = get_bloginfo( 'name' );

            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }
            // shape text
            if ( !empty($settings['tp_shape']['url']) ) {
                $tp_shape = !empty($settings['tp_shape']['id']) ? wp_get_attachment_image_url( $settings['tp_shape']['id'], $settings['tp_shape_size_size']) : $settings['tp_shape']['url'];
                $tp_shape_alt = get_post_meta($settings["tp_shape"]["id"], "_wp_attachment_image_alt", true);
            }
            // shape logo
            if ( !empty($settings['tp_shape_logo']['url']) ) {
                $tp_shape_logo = !empty($settings['tp_shape_logo']['id']) ? wp_get_attachment_image_url( $settings['tp_shape_logo']['id'], $settings['tp_shape_logo_size_size']) : $settings['tp_shape_logo']['url'];
                $tp_shape_logo_alt = get_post_meta($settings["tp_shape_logo"]["id"], "_wp_attachment_image_alt", true);
            }
            

            // Link
            if ('2' == $settings['tp_btn_link_type']) {
                $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_btn_page_link']));
                $this->add_render_attribute('tp-button-arg', 'target', '_self');
                $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn-brown mr-30 tp-el-box-btn');
            } else {
                if ( ! empty( $settings['tp_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'tp-button-arg', $settings['tp_btn_link'] );
                    $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn-brown mr-30 tp-el-box-btn');
                }
            }
        ?>

         <!-- about area start -->
         <section class="about__area grey-bg-8 pt-200 pb-200 tp-el-section">
            <div class="container">
               <div class="row">
                  <div class="col-xxl-6 col-xl-6 col-lg-6">
                    <?php if(!empty($tp_image))  :?>
                     <div class="about__thumb-wrapper-4 p-relative">
                        <div class="about__thumb-4">

                           <img class="about-thumb-main" src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">

                           
                           <img class="about__thumb-shape-1" src="<?php echo get_template_directory_uri() . '/assets/img/about/4/about-shape-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                       
                        </div>

                        <?php if ( !empty($settings['tp_experience_switch']) ) : ?>
                        <div class="about__experience-4 d-none d-sm-flex align-items-start" data-parallax='{"y": -100, "smoothness": 100}'>
                           <div class="about__experience-icon-4 tp-el-experience-icon mr-15">
                            <?php if($settings['tp_experience_icon_type'] == 'icon') : ?>
                                    <?php if (!empty($settings['tp_experience_icon']) || !empty($settings['tp_experience_selected_icon']['value'])) : ?>
                                            <span><?php tp_render_icon($settings, 'tp_experience_icon', 'tp_experience_selected_icon'); ?></span>
                                    <?php endif; ?>
                                <?php elseif( $settings['tp_experience_icon_type'] == 'image' ) : ?>
                                    <span>
                                        <?php if (!empty($settings['tp_experience_icon_image']['url'])): ?>
                                        <img src="<?php echo $settings['tp_experience_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($settings['tp_experience_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                        <?php endif; ?>
                                    </span>
                                <?php else : ?>
                                    <span>
                                        <?php if (!empty($settings['tp_experience_icon_svg'])): ?>
                                        <?php echo $settings['tp_experience_icon_svg']; ?>
                                        <?php endif; ?>
                                    </span>
                                <?php endif; ?>
                           </div>
                           
                           <div class="about__experience-content-4">
                              <h4 class="tp-el-experience-num"><span data-purecounter-duration="1" data-purecounter-end="<?php echo esc_attr($settings['tp_experience_num']); ?>"  class="purecounter"></span>+</h4>
                              <?php if ( !empty($settings['tp_experience_num_text']) ) : ?>
                              <p class="tp-el-experience-title"><?php echo tp_kses( $settings['tp_experience_num_text'] ); ?></p>
                              <?php endif; ?>
                           </div>
                           
                        </div>
                        <?php endif; ?>

                        <?php if ( !empty($settings['tp_shape_switch']) ) : ?>
                        <div class="about__thumb-shape-2 p-relative" data-parallax='{"y": 100, "smoothness": 100}'>
                           <img class="about__thumb-shape-logo" src="<?php echo esc_url($tp_shape); ?>" alt="<?php echo esc_attr($tp_shape_alt); ?>">
                           <img class="about__thumb-shape-logo-icon" src="<?php echo esc_url($tp_shape_logo); ?>" alt="<?php echo esc_attr($tp_shape_logo_alt); ?>">
                        </div>
                        <?php endif; ?>

                     </div>
                     <?php endif; ?>
                  </div>
                  <div class="col-xxl-6 col-xl-6 col-lg-6">
                     <div class="about__wrapper-4 pr-70 tp-el-content">

                     <?php if ( !empty($settings['tp_about_section_title_show']) ) : ?>
                        <div class="section__title-wrapper-4 pr-5 mb-15">
                           <?php if(!empty($settings['tp_about_sub_title' ])): ?>
                            <span class="section__title-pre-4 tp-el-subtitle"><?php echo tp_kses( $settings['tp_about_sub_title' ] ) ?></span>
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
                        <?php endif; ?>

                        <?php if (!empty($settings['tp_about_description' ])): ?>
                        <p><?php echo tp_kses($settings['tp_about_description']); ?></p>
                        <?php endif; ?>

                        <div class="about__btn-4 mt-45 d-sm-flex align-items-center">

                            <?php if ( !empty($settings['tp_btn_text']) ) : ?>
                                <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>>
                                    <?php echo $settings['tp_btn_text']; ?>
                                </a>
                            <?php endif; ?>

                            <?php if(!empty($settings['tp_about_call_switch'])) :?>
                           <div class="about__call d-flex align-items-center">
                              <div class="about__call-icon tp-el-contact-icon">
                              <?php if($settings['tp_box_icon_type'] == 'icon') : ?>
                                    <?php if (!empty($settings['tp_box_icon']) || !empty($settings['tp_box_selected_icon']['value'])) : ?>
                                            <span><?php tp_render_icon($settings, 'tp_box_icon', 'tp_box_selected_icon'); ?></span>
                                    <?php endif; ?>
                                <?php elseif( $settings['tp_box_icon_type'] == 'image' ) : ?>
                                    <span>
                                        <?php if (!empty($settings['tp_box_icon_image']['url'])): ?>
                                        <img src="<?php echo $settings['tp_box_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($settings['tp_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                        <?php endif; ?>
                                    </span>
                                <?php else : ?>
                                    <span>
                                        <?php if (!empty($settings['tp_box_icon_svg'])): ?>
                                        <?php echo $settings['tp_box_icon_svg']; ?>
                                        <?php endif; ?>
                                    </span>
                                <?php endif; ?>
                              </div>
                              <div class="about__call-content">
                                 <h4 class="tp-el-contact-title"><?php echo $settings['tp_about_call_title'];?></h4>
                                 <p class="tp-el-contact-desc"><a href="tel:<?php echo esc_attr($settings['tp_about_call_num']);?>"><?php echo $settings['tp_about_call_num'];?></a></p>
                              </div>
                           </div>
                           <?php endif; ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- about area end -->


        <?php elseif ( $settings['tp_design_style']  == 'layout-3' ):
            $bloginfo = get_bloginfo( 'name' );  
            $this->add_render_attribute('title_args', 'class', 'section__title-5 tp-el-title');

            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }

            
            // Link
            if ('2' == $settings['tp_btn_link_type']) {
                $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_btn_page_link']));
                $this->add_render_attribute('tp-button-arg', 'target', '_self');
                $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn-blue tp-el-box-btn');
            } else {
                if ( ! empty( $settings['tp_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'tp-button-arg', $settings['tp_btn_link'] );
                    $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn-blue tp-el-box-btn');
                }
            }
        ?>

         <!-- about area start -->
         <section class="about__area pt-120 pb-95 p-relative z-index-1 tp-el-section">
         <?php if ( !empty($settings['tp_shape_switch']) ) : ?>
            <div class="about__shape">
               <img class="about__shape-1" src="<?php echo get_template_directory_uri() . '/assets/img/about/5/shape/about-shape-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="about__shape-2" src="<?php echo get_template_directory_uri() . '/assets/img/about/5/shape/about-shape-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
            </div>
            <?php endif; ?>

            <div class="container">
               <div class="row align-items-center">
                  <div class="col-xxl-6 col-xl-6 col-lg-6">
                     <div class="about__wrapper-5 pr-90 mb-10 wow fadeInUp tp-el-content" data-wow-delay=".5s" data-wow-duration="1s">
                     
                        <?php if ( !empty($settings['tp_about_section_title_show']) ) : ?>
                        <div class="section__title-wrapper-5 mb-35">

                            <?php if(!empty($settings['tp_about_sub_title' ])): ?>
                            <span class="section__title-pre-5 tp-el-subtitle"><?php echo tp_kses( $settings['tp_about_sub_title' ] ) ?></span>
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

                        <?php if (!empty($settings['tp_about_description' ])): ?>
                        <p><?php echo tp_kses($settings['tp_about_description']); ?></p>
                        <?php endif; ?>

                        <?php endif; ?>

                        <?php if ( !empty($settings['tp_btn_text']) ) : ?>
                        <div class="about__btn-5">
                           <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>>
                                <?php echo $settings['tp_btn_text']; ?>
                            </a>
                        </div>
                        <?php endif; ?>
                        
                                
                            
                     </div>
                  </div>
                  <div class="col-xxl-6 col-xl-6 col-lg-6">
                     <div class="about__thumb-5 wow fadeInRight" data-wow-delay=".7s" data-wow-duration="1s">
                        <div class="about__thumb-mockup wow">
                           <img class="about-mockup-img" src="<?php echo get_template_directory_uri() . '/assets/img/about/5/about-thumb-mockup.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                           <img class="about-main-5"  src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">

                           <?php if(!empty($settings['tp_about_video_url']['url'])) : ?>
                           <a href="<?php echo esc_attr($settings['tp_about_video_url']['url']); ?>" class="about-play-btn tp-pulse-border popup-video">
                              <span class="video-play-bg"></span>
                              <svg width="17" height="17" viewBox="0 0 18 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path d="M18 11L0 21.3923V0.607696L18 11Z" fill="currentColor"/>
                              </svg>                                 
                           </a>
                           <?php endif; ?>

                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- about area end -->

         <?php elseif ( $settings['tp_design_style']  == 'layout-4' ):
            $bloginfo = get_bloginfo( 'name' );  
            $this->add_render_attribute('title_args', 'class', 'section__title-7 tp-el-title');

            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }

            
            // Link
            if ('2' == $settings['tp_btn_link_type']) {
                $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_btn_page_link']));
                $this->add_render_attribute('tp-button-arg', 'target', '_self');
                $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('tp-button-arg', 'class', 'tp-btnr-border tp-btn-shine-effect tp-link-btn-3 tp-el-box-btn');
            } else {
                if ( ! empty( $settings['tp_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'tp-button-arg', $settings['tp_btn_link'] );
                    $this->add_render_attribute('tp-button-arg', 'class', 'tp-btnr-border tp-btn-shine-effect tp-link-btn-3 tp-el-box-btn');
                }
            }
        ?>

         <!-- about area start -->
         <section class="about__area p-relative z-index-1 pt-120 pb-140 tp-el-section">
            <?php if ( !empty($settings['tp_shape_switch']) ) : ?>
            <div class="about__shape">
               <img class="about__shape-7" src="<?php echo get_template_directory_uri() . '/assets/img/about/7/about-shape-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
            </div>
            <?php endif; ?>
            <div class="container">
               <div class="row">

                  <div class="col-xxl-6 col-lg-6">
                     <div class="about__thumb-wrapper-7 pr-70">
                        <div class="about__thumb-7">
                        <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                        </div>
                        <div class="about__analysis" data-parallax='{"y": -90, "smoothness": 70}'>
                           <div class="about__analysis-top">
                              <div class="about__analysis-icon">
                                <?php if($settings['tp_analysis_box_icon_type'] == 'icon') : ?>
                                    <?php if (!empty($settings['tp_analysis_box_icon']) || !empty($settings['tp_analysis_box_selected_icon']['value'])) : ?>
                                            <span><?php tp_render_icon($settings, 'tp_analysis_box_icon', 'tp_analysis_box_selected_icon'); ?></span>
                                    <?php endif; ?>
                                <?php elseif( $settings['tp_analysis_box_icon_type'] == 'image' ) : ?>
                                    <span>
                                        <?php if (!empty($settings['tp_analysis_box_icon_image']['url'])): ?>
                                        <img src="<?php echo $settings['tp_analysis_box_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($settings['tp_analysis_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                        <?php endif; ?>
                                    </span>
                                <?php else : ?>
                                    <span>
                                        <?php if (!empty($settings['tp_analysis_box_icon_svg'])): ?>
                                        <?php echo $settings['tp_analysis_box_icon_svg']; ?>
                                        <?php endif; ?>
                                    </span>
                                <?php endif; ?>

                                 <p><?php echo tp_kses($settings['tp_about_analysis_title']); ?></p>
                              </div>
                              <div class="about__analysis-content">

                                <?php foreach ($settings['tp_analysis_list'] as $key => $item) :
                                        $class = ($key == '0') ? 'about__analysis-item' : 'about__analysis-item-2';
                                ?>

                                 <div class="<?php echo esc_attr($class); ?>">
                                    <?php if(!empty($item['tp_analysis_box_title'])) : ?>
                                    <h4><?php echo tp_kses($item['tp_analysis_box_title']) ?></h4>
                                    <?php endif; ?>
                                    <?php if(!empty($item['tp_analysis_box_desc'])) : ?>
                                    <p><?php echo tp_kses($item['tp_analysis_box_desc']) ?></p>
                                    <?php endif; ?>
                                 </div>
                                 <?php endforeach; ?>

                                 <?php if(!empty($settings['tp_analysis_discount'])) : ?>
                                 <div class="about__analysis-discount">
                                    <span><?php echo tp_kses($settings['tp_analysis_discount']);?></span>
                                 </div>
                                 <?php endif; ?>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xxl-6 col-lg-6">
                     <div class="about__wrapper-7 pt-35">

                     <?php if ( !empty($settings['tp_about_section_title_show']) ) : ?>
                        <div class="section__title-wrapper-7 mb-40 tp-el-content">
                           <?php if ( !empty($settings['tp_about_sub_title']) ) : ?>
                            <span class="section__title-pre-7 tp-el-subtitle">
                                <?php echo tp_kses( $settings['tp_about_sub_title'] ); ?>
                            </span>
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

                           <?php if ( !empty($settings['tp_about_description']) ) : ?>
                            <p><?php echo tp_kses( $settings['tp_about_description'] ); ?></p>
                            <?php endif; ?>

                        </div>
                        <?php endif; ?>

                        <div class="about__list about__list-counter">
                        <?php foreach ($settings['about_features_list'] as $key => $item) : ?>
                           <div class="about__list-item d-flex align-items-start">
                              <div class="about__list-icon tp-el-list-icon">
                                 <span></span>
                              </div>
                              <div class="about__list-content">
                                <?php if ( !empty($item['about_features_title']) ) : ?>
                                 <h3 class="about__list-title tp-el-list-title"><?php echo tp_kses( $item['about_features_title'] ); ?></h3>
                                 <?php endif; ?>
                                 <?php if ( !empty($item['about_features_desc']) ) : ?>
                                 <p class="tp-el-list-desc"><?php echo tp_kses( $item['about_features_desc'] ); ?></p>
                                 <?php endif; ?>
                              </div>
                           </div>
                           <?php endforeach; ?>
                        </div>

                        <?php if ( !empty($settings['tp_btn_text']) ) : ?>
                        <div class="about__btn-7">
                           <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>>
                           <?php echo $settings['tp_btn_text']; ?>
                              <span>
                                 <i class="fa-regular fa-arrow-right"></i>
                              </span>
                           </a>
                        </div>
                        <?php endif; ?>

                     </div>
                  </div>

               </div>
            </div>
         </section>
         <!-- about area end -->

		<?php else:

            $bloginfo = get_bloginfo( 'name' );
            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }

            // tp_author_thumb
            if ( !empty($settings['tp_author_thumb']['url']) ) {
                $tp_image_2 = !empty($settings['tp_author_thumb']['id']) ? wp_get_attachment_image_url( $settings['tp_author_thumb']['id'], $settings['tp_image_size_size']) : $settings['tp_author_thumb']['url'];
                $tp_image_2_alt = get_post_meta($settings["tp_author_thumb"]["id"], "_wp_attachment_image_alt", true);
            }

			$this->add_render_attribute('title_args', 'class', 'section__title tp-el-title');

            // Link
            if ('2' == $settings['tp_btn_link_type']) {
                $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_btn_page_link']));
                $this->add_render_attribute('tp-button-arg', 'target', '_self');
                $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn tp-el-box-btn');
            } else {
                if ( ! empty( $settings['tp_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'tp-button-arg', $settings['tp_btn_link'] );
                    $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn tp-el-box-btn');
                }
            }
		?>

         <!-- about area start -->
         <section class="about__area pt-120 pb-120 tp-el-section">
            <div class="container">
               <div class="row">
                  <div class="col-xxl-6 col-xl-6 col-lg-6">
                     <div class="about__thumb-wrapper ml-70 pr-100">
                        <div class="about__thumb w-img">
                           <div class="tp-thumb-overlay wow"></div>
                           <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                        </div>
                        <?php if ( !empty($settings['tp_thumb_text']) ) : ?>
                        <div class="about__thumb-text">
                           <h3 class="tp-el-experience-side-title" data-text="<?php echo esc_attr($settings['tp_thumb_text']); ?>"><?php echo tp_kses( $settings['tp_thumb_text'] ); ?></h3>
                        </div>
                        <?php endif; ?>

                        <?php if ( !empty($settings['tp_experience_switch']) ) : ?>
                        <div class="about__experience">
                            <?php if ( !empty($settings['tp_experience_num']) ) : ?>
                           <h4 class="tp-el-experience-num"><span data-purecounter-duration="1" data-purecounter-end="<?php echo esc_attr($settings['tp_experience_num']); ?>"  class="purecounter">0</span></h4>
                           <?php endif; ?>

                           <?php if ( !empty($settings['tp_experience_num_text']) ) : ?>
                           <p class="tp-el-experience-desc"><?php echo tp_kses( $settings['tp_experience_num_text'] ); ?></p>
                           <?php endif; ?>
                        </div>
                        <?php endif; ?>

                     </div>
                  </div>
                  <div class="col-xxl-6 col-xl-6 col-lg-6">
                     <div class="about__wrapper pr-95 tp-el-content">

                        <?php if ( !empty($settings['tp_about_section_title_show']) ) : ?>
                        <div class="section__title-wrapper mb-25">
                            <?php if ( !empty($settings['tp_about_sub_title']) ) : ?>
                            <span class="section__title-pre tp-el-subtitle">
                                <?php echo tp_kses( $settings['tp_about_sub_title'] ); ?>
                            </span>
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
                        
                            <?php if ( !empty($settings['tp_about_description']) ) : ?>
                                <p><?php echo tp_kses( $settings['tp_about_description'] ); ?></p>
                            <?php endif; ?>

                        <?php endif; ?>

                        <?php if ( !empty($settings['tp_author_switch']) ) : ?>
                        <div class="about__author d-sm-flex align-items-center mb-40">
                            <div class="about__author-inner d-flex align-items-center">
                            <?php if ( !empty($tp_image_2) ) : ?>
                                <div class="about__author-thumb mr-10">
                                    <img src="<?php echo esc_url($tp_image_2); ?>" alt="<?php echo esc_attr($tp_image_2_alt); ?>">
                                </div>
                                <?php endif; ?>
                                <div class="about__author-content d-sm-flex align-items-center">
                                    <h3 class="about__author-title tp-el-box-title"><?php echo tp_kses( $settings['tp_author_title'] ); ?></h3>
                                </div>
                            </div>
                            <div class="about__author-btn">
                                <span class="about-author-link tp-el-author-message"><?php echo tp_kses( $settings['tp_author_message'] ); ?></span>
                            </div>
                        </div>
                        <?php endif; ?>

                        <?php if ( !empty($settings['tp_btn_text']) ) : ?>
                        <div class="about__btn">
                           <?php if (!empty($settings['tp_btn_text'])) : ?>
                            <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>>
                                <?php echo $settings['tp_btn_text']; ?>
                            </a>
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

$widgets_manager->register( new TP_About() );
