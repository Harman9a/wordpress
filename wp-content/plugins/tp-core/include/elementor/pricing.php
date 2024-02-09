<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Repeater;
use \Elementor\Control_Media;
use \Elementor\Utils;
Use \Elementor\Core\Schemes\Typography;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Image_Size;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Pricing extends Widget_Base {

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
		return 'tp-pricing';
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
		return __( 'Pricing', 'tpcore' );
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
	protected function register_controls() {


        $this->start_controls_section(
            '_section_design_title',
            [
                'label' => __('Design Style', 'tpcore'),
                'tab' => Controls_Manager::TAB_CONTENT,
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->add_control(
            'active_price',
            [
                'label' => __('Active Price', 'tpcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'tpcore'),
                'label_off' => __('Hide', 'tpcore'),
                'return_value' => 'yes',
                'default' => false,
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();

        // _tp_icon
        $this->start_controls_section(
            '_tp_icon',
            [
                'label' => esc_html__('Icon', 'tpcore'),
                'condition' => [
                    'tp_design_style' => 'layout-10'
                ]
            ]
        );
        $this->add_control(
            'tp_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'image' => esc_html__('Image', 'tpcore'),
                    'icon' => esc_html__('Icon', 'tpcore'),
                ],
            ]
        );

        $this->add_control(
            'tp_icon_image',
            [
                'label' => esc_html__('Upload Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_icon_type' => 'image'
                ]

            ]
        );
        if (tp_is_elementor_version('<', '2.6.0')) {
            $this->add_control(
                'tp_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'tp_icon_type' => 'icon'
                    ]
                ]
            );
        } else {
            $this->add_control(
                'tp_selected_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICONS,
                    'label_block' => true,
                    'default' => [
                        'value' => 'fas fa-star',
                        'library' => 'solid',
                    ],
                    'condition' => [
                        'tp_icon_type' => 'icon'
                    ]
                ]
            );
        }
        $this->end_controls_section();

        // Header
        $this->start_controls_section(
            '_section_header',
            [
                'label' => __('Header', 'tpcore'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Title', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __('Basic', 'tpcore'),
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label' => __('Sub Title', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __('Sub Title', 'tpcore'),
                'dynamic' => [
                    'active' => true
                ],
                'condition' => [
                    'tp_design_style' => ['layout-10'],
                ]
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => __('Description', 'tpcore'),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => __('description', 'tpcore'),
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_pricing',
            [
                'label' => __('Pricing', 'tpcore'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'currency',
            [
                'label' => __('Currency', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'label_block' => false,
                'options' => [
                    '' => __('None', 'tpcore'),
                    'baht' => '&#3647; ' . _x('Baht', 'Currency Symbol', 'tpcore'),
                    'bdt' => '&#2547; ' . _x('BD Taka', 'Currency Symbol', 'tpcore'),
                    'dollar' => '&#36; ' . _x('Dollar', 'Currency Symbol', 'tpcore'),
                    'euro' => '&#128; ' . _x('Euro', 'Currency Symbol', 'tpcore'),
                    'franc' => '&#8355; ' . _x('Franc', 'Currency Symbol', 'tpcore'),
                    'guilder' => '&fnof; ' . _x('Guilder', 'Currency Symbol', 'tpcore'),
                    'krona' => 'kr ' . _x('Krona', 'Currency Symbol', 'tpcore'),
                    'lira' => '&#8356; ' . _x('Lira', 'Currency Symbol', 'tpcore'),
                    'peso' => '&#8369; ' . _x('Peso', 'Currency Symbol', 'tpcore'),
                    'pound' => '&#163; ' . _x('Pound Sterling', 'Currency Symbol', 'tpcore'),
                    'real' => 'R$ ' . _x('Real', 'Currency Symbol', 'tpcore'),
                    'ruble' => '&#8381; ' . _x('Ruble', 'Currency Symbol', 'tpcore'),
                    'indian_rupee' => '&#8377; ' . _x('Rupee (Indian)', 'Currency Symbol', 'tpcore'),
                    'shekel' => '&#8362; ' . _x('Shekel', 'Currency Symbol', 'tpcore'),
                    'won' => '&#8361; ' . _x('Won', 'Currency Symbol', 'tpcore'),
                    'yen' => '&#165; ' . _x('Yen/Yuan', 'Currency Symbol', 'tpcore'),
                    'custom' => __('Custom', 'tpcore'),
                ],
                'default' => 'dollar',
            ]
        );

        $this->add_control(
            'currency_custom',
            [
                'label' => __('Custom Symbol', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'condition' => [
                    'currency' => 'custom',
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'price',
            [
                'label' => __('Price', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => '9.99',
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        $this->add_control(
            'period',
            [
                'label' => __('Period', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Per Month', 'tpcore'),
                'dynamic' => [
                    'active' => true
                ]
            ]
        );
        $this->add_control(
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
        $this->add_control(
            'tp_box_icon_svg',
            [
                'show_label' => false,
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__('SVG Code Here', 'tpcore'),
                'condition' => [
                    'tp_box_icon_type' => 'svg'
                ]
            ]
        );

        $this->add_control(
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
            $this->add_control(
                'tp_box_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'tp_box_icon_type' => 'icon'
                    ]
                ]
            );
        } else {
            $this->add_control(
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
                        'tp_box_icon_type' => 'icon'
                    ]
                ]
            );
        }

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
            '_section_features',
            [
                'label' => __('Features', 'tpcore'),
            ]
        );

        $this->add_control(
            'features_title',
            [
                'label' => __('Title', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Features', 'tpcore'),
                'separator' => 'after',
                'label_block' => true,
                'dynamic' => [
                    'active' => true
                ],
                'condition' => [
                    'tp_design_style' => ['layout-10'],
                ],
            ]
        );

        $this->add_control(
            'show_features',
            [
                'label' => __('Show', 'tpcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'tpcore'),
                'label_off' => __('Hide', 'tpcore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'style_transfer' => true,
            ]
        );


        $repeater = new Repeater();


        $repeater->add_control(
            'tp_feature_unavailable',
            [
                'label' => __('Feature Hide ?', 'tpcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'tpcore'),
                'label_off' => __('Hide', 'tpcore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'text',
            [
                'label' => __('Text', 'tpcore'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('Exciting Feature', 'tpcore'),
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'tp_features_icon',
                [
                    'show_label' => true,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fal fa-check',
                ]
            );
        } else {
            $repeater->add_control(
                'tp_features_selected_icon',
                [
                    'show_label' => true,
                    'type' => Controls_Manager::ICONS,
                    'label_block' => true,
                    'default' => [
                        'value' => 'fal fa-check',
                        'library' => 'fa-solid',
                    ]
                ]
            );
        }


        $this->add_control(
            'tp_features_title',
            [
                'label'       => esc_html__( 'Features Title', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Includes', 'tpcore' ),
                'placeholder' => esc_html__( 'Placeholder Text', 'tpcore' ),
                'condition' => [
                    'tp_design_style' => 'layout-1'
                ]
            ]
        );
        $this->add_control(
            'features_list',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'show_label' => false,
                'default' => [
                    [
                        'text' => __('Standard Feature', 'tpcore'),
                        'icon' => 'fa fa-check',
                    ],
                    [
                        'text' => __('Another Great Feature', 'tpcore'),
                        'icon' => 'fa fa-check',
                    ],
                    [
                        'text' => __('Obsolete Feature', 'tpcore'),
                        'icon' => 'fa fa-close',
                    ],
                    [
                        'text' => __('Exciting Feature', 'tpcore'),
                        'icon' => 'fa fa-check',
                    ],
                ],
                'title_field' => '<# print((text)); #>',
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            '_section_features_right',
            [
                'label' => __('Features Right', 'tpcore'),
            ]
        );

        $this->add_control(
            'show_features_right',
            [
                'label' => __('Show', 'tpcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'tpcore'),
                'label_off' => __('Hide', 'tpcore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'style_transfer' => true,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'tp_feature_unavailable_right',
            [
                'label' => __('Feature Hide ?', 'tpcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'tpcore'),
                'label_off' => __('Hide', 'tpcore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'text_right',
            [
                'label' => __('Text', 'tpcore'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('Exciting Feature', 'tpcore'),
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'tp_features_icon_right',
                [
                    'show_label' => true,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fal fa-check',
                ]
            );
        } else {
            $repeater->add_control(
                'tp_features_selected_icon_right',
                [
                    'show_label' => true,
                    'type' => Controls_Manager::ICONS,
                    'label_block' => true,
                    'default' => [
                        'value' => 'fal fa-check',
                        'library' => 'fa-solid',
                    ]
                ]
            );
        }

        $this->add_control(
            'features_list_right',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'show_label' => false,
                'default' => [
                    [
                        'text_right' => __('Standard Feature', 'tpcore'),
                        'icon_right' => 'fa fa-check',
                    ],
                    [
                        'text_right' => __('Another Great Feature', 'tpcore'),
                        'icon_right' => 'fa fa-check',
                    ],
                    [
                        'text_right' => __('Obsolete Feature', 'tpcore'),
                        'icon_right' => 'fa fa-close',
                    ],
                    [
                        'text_right' => __('Exciting Feature', 'tpcore'),
                        'icon_right' => 'fa fa-check',
                    ],
                ],
                'title_field' => '<# print((text_right)); #>',
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            '_section_badge',
            [
                'label' => __('Badge', 'tpcore'),
            ]
        );

        $this->add_control(
            'show_badge',
            [
                'label' => __('Show', 'tpcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'tpcore'),
                'label_off' => __('Hide', 'tpcore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'badge_position',
            [
                'label' => __('Position', 'tpcore'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'tpcore'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => __('Right', 'tpcore'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'toggle' => false,
                'default' => 'left',
                'style_transfer' => true,
                'condition' => [
                    'show_badge' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'badge_text',
            [
                'label' => __('Badge Text', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Recommended', 'tpcore'),
                'placeholder' => __('Type badge text', 'tpcore'),
                'condition' => [
                    'show_badge' => 'yes'
                ],
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'price_rating',
            [
                'label' => __('Rating', 'tpcore'),
            ]
        );

        $this->add_control(
            'price_rating_number',
            [
                'label' => esc_html__('Select Icon Type', 'tpcore'),
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

        $this->end_controls_section();

		// tp_btn_button_group
        $this->start_controls_section(
            'tp_btn_button_group',
            [
                'label' => esc_html__('Button', 'tpcore'),
            ]
        );

        $this->add_control(
            'tp_btn_button_show',
            [
                'label' => esc_html__( 'Show Button', 'tpcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tpcore' ),
                'label_off' => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'tp_btn_text',
            [
                'label' => esc_html__('Button Text', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'tpcore'),
                'title' => esc_html__('Enter button text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_btn_button_show' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'tp_btn_link_type',
            [
                'label' => esc_html__('Button Link Type', 'tpcore'),
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
                'label' => esc_html__('Button link', 'tpcore'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'tpcore'),
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
                'label' => esc_html__('Select Button Page', 'tpcore'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_btn_link_type' => '2',
                    'tp_btn_button_show' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'tp_align',
            [
                'label' => esc_html__('Alignment', 'tpcore'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'tpcore'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'tpcore'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'tpcore'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => false,
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};'
                ]
            ]
        );
        
        $this->end_controls_section();

        $this->tp_section_style_controls('pricing_section', 'Section - Style', '.tp-el-section');
        $this->tp_section_style_controls('pricing_box', 'Price - Box', '.tp-el-box');
        $this->tp_link_controls_style('pricing_badge', 'Price - Badge', '.tp-el-badge');
        $this->tp_link_controls_style('pricing_category', 'Price - Category', '.tp-el-box-category');
        $this->tp_basic_style_controls('pricing_ammount', 'Price - Ammount', '.tp-el-box-ammount');
        $this->tp_basic_style_controls('pricing_period', 'Price - Period', '.tp-el-box-period');
        $this->tp_basic_style_controls('pricing_desc', 'Price - Description', '.tp-el-box-desc');
        $this->tp_basic_style_controls('features_title', 'Features - Title', '.tp-el-feature-title');
        $this->tp_basic_style_controls('pricing_list', 'Price - List', '.tp-el-box-list');
        $this->tp_basic_style_controls('pricing_list_unavailabe', 'Price - List Unavailable', '.tp-el-box-list-unavailable');
        $this->tp_link_controls_style('pricing_btn', 'Price - Button', '.tp-el-box-btn');


	}

    private static function get_currency_symbol($symbol_name)
    {
        $symbols = [
            'baht' => '&#3647;',
            'bdt' => '&#2547;',
            'dollar' => '&#36;',
            'euro' => '&#128;',
            'franc' => '&#8355;',
            'guilder' => '&fnof;',
            'indian_rupee' => '&#8377;',
            'pound' => '&#163;',
            'peso' => '&#8369;',
            'peseta' => '&#8359',
            'lira' => '&#8356;',
            'ruble' => '&#8381;',
            'shekel' => '&#8362;',
            'rupee' => '&#8360;',
            'real' => 'R$',
            'krona' => 'kr',
            'won' => '&#8361;',
            'yen' => '&#165;',
        ];

        return isset($symbols[$symbol_name]) ? $symbols[$symbol_name] : '';
    }

    private static function get_currency_symbol_text($symbol_text)
    {
        $symbols =[
            'baht' => 'THB',
            'bdt' => 'BDT',
            'dollar' => 'USD',
            'euro' => 'EUR',
            'franc' => 'EUR',
            'guilder' => 'GLD',
            'indian_rupee' => 'INR',
            'pound' => 'GBP',
            'peso' => 'MXN',
            'lira' => 'TRY',
            'ruble' => 'RUB',
            'shekel' => 'ILS',
            'real' => 'BRL',
            'krona' => 'KR',
            'won' => 'KRW',
            'yen' => 'JPY',
        ];

        return isset($symbols[$symbol_text]) ? $symbols[$symbol_text] : '';
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
            $this->add_render_attribute('title_args', 'class', 'tp-title');


            // Link
            if ('2' == $settings['tp_btn_link_type']) {
                $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_btn_page_link']));
                $this->add_render_attribute('tp-button-arg', 'target', '_self');
                $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn-border-3 tp-el-box-btn');
            } else {
                if ( ! empty( $settings['tp_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'tp-button-arg', $settings['tp_btn_link'] );
                    $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn-border-3 tp-el-box-btn');
                }
            }

            if ($settings['currency'] === 'custom') {
                $currency = $settings['currency_custom'];
            } else {
                $currency = self::get_currency_symbol($settings['currency']);
            }

            $class_name = $settings['active_price'] ? 'active' : '';

        ?>

         <!-- pricing area start -->
         <section class="pricing__area black-bg-5 tp-el-section">
            <div class="container">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="pricing__item mb-20 wow fadeInUp tp-el-box" data-wow-delay=".3s" data-wow-duration="1s">
                        <div class="row align-items-center">
                           <div class="col-xxl-3 col-xl-3 col-lg-3">

                              <div class="pricing__content text-center text-lg-start">
                                <?php if(!empty($settings['title'])) :?>
                                 <div class="pricing__category">
                                    <span class="tp-el-box-category"><?php echo esc_html($settings['title']); ?></span>
                                 </div>

                                 <?php endif; ?>  
                                 <h3 class="pricing__title tp-el-box-title tp-el-box-ammount"><?php echo esc_html($currency); ?><?php echo tp_kses($settings['price']); ?><span class="pricing-currency tp-el-box-period"> <?php echo self::get_currency_symbol_text($settings['currency']); ?></span></h3>
                              </div>
                           </div>
                    

                           <div class="col-xxl-6 col-xl-6 col-lg-6">
                              <div class="pricing__feature d-lg-flex align-items-center justify-content-between">
                                 <div class="pricing__feature-left">
                                    <?php if ( !empty($settings['show_features']) ) : ?>
                                    <ul>
                                        <?php foreach ($settings['features_list'] as $index => $item) :
                                            $availability = $item['tp_feature_unavailable'] ? 'disable has-denied' : '';
                                        ?>
                                        <li class="<?php echo esc_attr($availability); ?> tp-el-box-list"><?php echo tp_kses($item['text']); ?> </li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <?php endif; ?>

                                 </div>
                                 <div class="pricing__feature-right">
                                    <?php if ( !empty($settings['show_features']) ) : ?>
                                    <ul>
                                        <?php foreach ($settings['features_list_right'] as $index => $item) :
                                            $availability = $item['tp_feature_unavailable_right'] ? 'disable has-denied' : '';
                                        ?>
                                        <li class="<?php echo esc_attr($availability); ?> tp-el-box-list"><?php echo tp_kses($item['text_right']); ?> </li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <?php endif; ?>

                                 </div>
                              </div>
                           </div>
                           <?php if (!empty($settings['tp_btn_button_show'])) : ?>
                           <div class="col-xxl-3 col-xl-3 col-lg-3">
                              <div class="pricing__btn text-center text-lg-end">
                                 <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>><?php echo $settings['tp_btn_text']; ?></a>
                              </div>
                           </div>
                           <?php endif; ?>
                        
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- pricing area end -->

         <!-- default style -->
        <?php else:
            $this->add_render_attribute('title_args', 'class', 'tp-title');

            // Link
            if ('2' == $settings['tp_btn_link_type']) {
                $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_btn_page_link']));
                $this->add_render_attribute('tp-button-arg', 'target', '_self');
                $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn-grey w-100 tp-el-box-btn');
            } else {
                if ( ! empty( $settings['tp_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'tp-button-arg', $settings['tp_btn_link'] );
                    $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn-grey w-100 tp-el-box-btn');
                }
            }

            if ($settings['currency'] === 'custom') {
                $currency = $settings['currency_custom'];
            } else {
                $currency = self::get_currency_symbol($settings['currency']);
            }

            $class_name = $settings['active_price'] ? 'price-active' : '';
            $item_active = $settings['show_badge'] ? 'price-badge-active' : '';
        ?>

            <div class="pricing__item-5 d-flex flex-column <?php echo esc_attr($item_active); ?>  mb-40 <?php echo esc_attr($class_name); ?> tp-el-box">
                <div class="pricing__top-5 grey-bg-10 p-relative">
                    <?php if ( !empty($settings['show_badge']) ) : ?>
                    <div class="pricing__popular tp-el-badge">
                        <p><?php echo esc_html($settings['badge_text']); ?></p>
                    </div>
                    <?php endif; ?>
                    <div class="pricing__icon-5 tp-el-box-icon">
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

                    <?php if (!empty($settings['period'])) : ?>
                    <div class="pricing__title-wrapper">
                        <h3 class="pricing__title-5 tp-el-box-ammount"><?php echo esc_html($currency); ?><?php echo tp_kses($settings['price']); ?><span class="tp-el-box-period"><?php echo tp_kses($settings['period']); ?></span></h3>

                        <?php if(!empty($settings['description'])) : ?>
                        <p class="tp-el-box-desc"><?php echo tp_kses($settings['description']); ?></p>
                        <?php endif; ?>

                    </div>
                    <?php endif; ?>
                    
                    
                    <?php if(!empty($settings['title'])) :?>
                    <div class="pricing__tag-5">
                        <span class="tp-el-box-category"> <?php echo esc_html($settings['title']); ?></span>
                    </div>
                    <?php endif; ?>   
                    
                </div>

                <div class="pricing__content-5">
                    <div class="pricing__content-5-inner d-flex flex-column justify-content-between">
                        
                        <div class="pricing__feature-5">
                            <?php if(!empty($settings['tp_features_title'])) :?>
                                <p class="tp-el-feature-title"><?php echo esc_html($settings['tp_features_title']); ?></p>
                            <?php endif; ?>

                            <?php if ( !empty($settings['show_features']) ) : ?>
                            <ul>
                                <?php foreach ($settings['features_list'] as $index => $item) :
                                    $availability = $item['tp_feature_unavailable'] ? 'disable tp-el-box-list-unavailable' : '';
                                ?>
                                <li class="<?php echo esc_attr($availability); ?> tp-el-box-list"><?php echo tp_kses($item['text']); ?> </li>
                                <?php endforeach; ?>
                            </ul>
                            <?php endif; ?>
                            
                        </div>
                
                        <?php if (!empty($settings['tp_btn_button_show'])) : ?>
                        <div class="pricing__btn-5">
                            <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>><?php echo $settings['tp_btn_text']; ?></a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        <?php endif; ?>

        <?php
    }
}

$widgets_manager->register( new TP_Pricing() );