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
class TP_Price_Box extends Widget_Base {

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
		return 'tp-price-box';
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
		return __( 'Price Box', 'tpcore' );
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

        $this->add_control(
         'tp_price_style',
            [
                'label'        => esc_html__( 'Enable Style Square', 'tpcore' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'tpcore' ),
                'label_off'    => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );

        $this->end_controls_section();

        $this->tp_section_title_render_controls('price', 'Section Title', 'Sub Title', 'your title here', 'Hic nesciunt galisum aut dolorem');


        // Header
        $this->start_controls_section(
            '_section_header',
            [
                'label' => __('Price Contact', 'tpcore'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'tp_price_contact_title',
            [
                'label' => __('Title', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __('Contact Us', 'tpcore'),
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        $this->add_control(
            'tp_contact_btn_button_show',
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
            'tp_contact_btn_text',
            [
                'label' => esc_html__('Button Text', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'tpcore'),
                'title' => esc_html__('Enter button text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_contact_btn_button_show' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'tp_contact_btn_link_type',
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
                    'tp_contact_btn_button_show' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'tp_contact_btn_link',
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
                    'tp_contact_btn_link_type' => '1',
                    'tp_contact_btn_button_show' => 'yes'
                ],
                'label_block' => true,
            ]
        );
        $this->add_control(
            'tp_contact_btn_page_link',
            [
                'label' => esc_html__('Select Button Page', 'tpcore'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_contact_btn_link_type' => '2',
                    'tp_contact_btn_button_show' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'tp_price_contact_thumb',
            [
                'label'   => esc_html__( 'Upload Image', 'tpcore' ),
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
                // 'default' => 'tp-portfolio-thumb',
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

            // inner price tab
            $this->start_controls_tabs('price_tab_section');
            
                //price plan one
                $this->start_controls_tab(
                    'price_plan_1',
                    [
                        'label'   => esc_html__( 'Silver Plan', 'tpcore' ),
                    ]
                    );
                

                $this->tp_price_currency('silver', 'Silver Plan');
                    
                $this->end_controls_tab();

                //price plan two
                $this->start_controls_tab(
                    'price_plan_2',
                        [
                            'label'   => esc_html__( 'Advanced', 'tpcore' ),
                        ]
                    );

                $this->tp_price_currency('advanced', 'Advanced Plan');
                
                $this->end_controls_tab();

                //price plan three
                $this->start_controls_tab(
                'price_plan_3',
                    [
                        'label'   => esc_html__( 'Enterprise', 'tpcore' ),
                    ]
                );
                $this->tp_price_currency('enterprise', 'Enterprise Plan');

                $this->end_controls_tab();
            
            $this->end_controls_tabs();

        $this->end_controls_section();


        $this->start_controls_section(
         'tp_price_shape_sec',
             [
               'label' => esc_html__( 'Shape Switch', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
             ]
        );
        
        $this->add_control(
         'tp_price_shape_switch',
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


        $this->start_controls_section(
            '_section_features',
            [
                'label' => __('Features', 'tpcore'),
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
            'tp_price_feature_info_text',
            [
                'label' => __('Features Title', 'tpcore'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('Unlimited project', 'tpcore'),
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        $repeater->add_control(
            'tp_price_feature_info_tooltip',
            [
                'label' => __('Features Tooltip', 'tpcore'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('Exciting Feature Available. You can download', 'tpcore'),
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        $repeater->add_control(
            'tp_price_features_option',
            [
                'label' => __('Plan One Feature', 'tpcore'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('1TB', 'tpcore'),
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        $repeater->add_control(
            'tp_price_features_option_2',
            [
                'label' => __('Plan Two Feature', 'tpcore'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('$6/Year', 'tpcore'),
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        $repeater->add_control(
            'tp_price_features_option_3',
            [
                'label' => __('Plan Three Feature', 'tpcore'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('Unlimited', 'tpcore'),
                'dynamic' => [
                    'active' => true
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
                'title_field' => '{{{ tp_price_feature_info_text }}}',
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

		// tp_btn_button_group
        $this->start_controls_section(
            'tp_btn_button_group',
            [
                'label' => esc_html__('Button', 'tpcore'),
            ]
        );

                $this->start_controls_tabs('tp_price_btn_group');
                
                    $this->start_controls_tab(
                        'tp_price_btn_1',
                        [
                            'label'   => esc_html__( 'Silver Btn', 'tpcore' ),
                        ]
                    );
                    
                    $this->tp_price_btn_controls('silver_btn', 'Silver Btn');
                    $this->end_controls_tab();
                
                    $this->start_controls_tab(
                        'tp_price_btn_2',
                        [
                            'label'   => esc_html__( 'Advanced Btn', 'tpcore' ),
                        ]
                    );
                    
                    $this->tp_price_btn_controls('advanced_btn', 'Advanced Btn');

                    $this->end_controls_tab();
                
                    $this->start_controls_tab(
                        'tp_price_btn_3',
                        [
                            'label'   => esc_html__( 'Enterprise Btn', 'tpcore' ),
                        ]

                    );
                    
                    $this->tp_price_btn_controls('enterprise_btn', 'Enterprise Btn');

                    $this->end_controls_tab();
        
                $this->end_controls_tabs();
                



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

	}

    protected function style_tab_content(){


        $this->tp_section_style_controls('section_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('section_subtitle', 'Section - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('section_title', 'Section - Title', '.tp-el-title');
        $this->tp_basic_style_controls('section_description', 'Section - Description', '.tp-el-content p');
        $this->tp_link_controls_style('portfolio_btn', 'Section - Button', '.tp-el-btn');

        $this->tp_section_style_controls('section_section_box', 'Box - Style', '.tp-el-box');

        $this->tp_basic_style_controls('pricing_head_title', 'Price - Head Title', '.tp-el-head-title');
        $this->tp_link_controls_style('pricing_head_btn', 'Price - Head Button', '.tp-el-head-btn');

        $this->tp_basic_style_controls('pricing_subtitle', 'Price - Subtitle', '.tp-el-box-subtitle');
        $this->tp_basic_style_controls('pricing_title', 'Price - Number', '.tp-el-box-title');
        $this->tp_basic_style_controls('pricing_desc', 'Price - Description', '.tp-el-box-desc');

        $this->tp_link_controls_style('pricing_badge', 'Price - Badge', '.tp-el-box-badge');
        $this->tp_basic_style_controls('pricing_feature', 'Price - Feature', '.tp-el-box-feature p');

        $this->tp_link_controls_style('pricing_btn', 'Price - Button', '.tp-el-box-btn');
        $this->tp_link_controls_style('pricing_btn_active', 'Price - Button Active', '.tp-el-box-btn-active');
  
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

        ?>



         <!-- default style -->
        <?php else:
            
            $bloginfo = get_bloginfo( 'name' );  
            // contact
            if ('2' == $settings['tp_contact_btn_link_type']) {
                $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_contact_btn_page_link']));
                $this->add_render_attribute('tp-button-arg', 'target', '_self');
                $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn-11 tp-el-head-btn');
            } else {
                if ( ! empty( $settings['tp_contact_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'tp-button-arg', $settings['tp_contact_btn_link'] );
                    $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn-11 tp-el-head-btn');
                }
            }

            // plan one btn
            if ('2' == $settings['tp_silver_btn_link_type']) {
                $this->add_render_attribute('tp-button-arg-silver', 'href', get_permalink($settings['tp_silver_btn_page_link']));
                $this->add_render_attribute('tp-button-arg-silver', 'target', '_self');
                $this->add_render_attribute('tp-button-arg-silver', 'rel', 'nofollow');
                $this->add_render_attribute('tp-button-arg-silver', 'class', 'tp-btnr-border-2 tp-el-box-btn');
            } else {
                if ( ! empty( $settings['tp_silver_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'tp-button-arg-silver', $settings['tp_silver_btn_link'] );
                    $this->add_render_attribute('tp-button-arg-silver', 'class', 'tp-btnr-border-2 tp-el-box-btn');
                }
            }

            // price two btn
            if ('2' == $settings['tp_advanced_btn_link_type']) {
                $this->add_render_attribute('tp-button-arg-advanced', 'href', get_permalink($settings['tp_advanced_btn_page_link']));
                $this->add_render_attribute('tp-button-arg-advanced', 'target', '_self');
                $this->add_render_attribute('tp-button-arg-advanced', 'rel', 'nofollow');
                $this->add_render_attribute('tp-button-arg-advanced', 'class', 'tp-btnr-border-2 tp-el-box-btn-active');
            } else {
                if ( ! empty( $settings['tp_advanced_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'tp-button-arg-advanced', $settings['tp_advanced_btn_link'] );
                    $this->add_render_attribute('tp-button-arg-advanced', 'class', 'tp-btnr-border-2 tp-el-box-btn-active');
                }
            }

            // price two btn
            if ('2' == $settings['tp_enterprise_btn_link_type']) {
                $this->add_render_attribute('tp-button-arg-enterprise', 'href', get_permalink($settings['tp_enterprise_btn_page_link']));
                $this->add_render_attribute('tp-button-arg-enterprise', 'target', '_self');
                $this->add_render_attribute('tp-button-arg-enterprise', 'rel', 'nofollow');
                $this->add_render_attribute('tp-button-arg-enterprise', 'class', 'tp-btnr-border-2 tp-el-box-btn');
            } else {
                if ( ! empty( $settings['tp_enterprise_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'tp-button-arg-enterprise', $settings['tp_enterprise_btn_link'] );
                    $this->add_render_attribute('tp-button-arg-enterprise', 'class', 'tp-btnr-border-2 tp-el-box-btn');
                }
            }



            if ($settings['silver_currency'] === 'custom') {
                $currency = $settings['currency_custom'];
            } else {
                $currency = self::get_currency_symbol($settings['silver_currency']);
            }

            if ($settings['advanced_currency'] === 'custom') {
                $currency2 = $settings['currency_custom'];
            } else {
                $currency2 = self::get_currency_symbol($settings['advanced_currency']);
            }

            if ($settings['enterprise_currency'] === 'custom') {
                $currency3 = $settings['currency_custom'];
            } else {
                $currency3 = self::get_currency_symbol($settings['enterprise_currency']);
            }

            if ( !empty($settings['tp_price_contact_thumb']['url']) ) {
                $tp_price_contact_thumb_url = !empty($settings['tp_price_contact_thumb']['id']) ? wp_get_attachment_image_url( $settings['tp_price_contact_thumb']['id'], $settings['thumbnail_size']) : $settings['tp_price_contact_thumb']['url'];
                $tp_price_contact_thumb_alt = get_post_meta($settings["tp_price_contact_thumb"]["id"], "_wp_attachment_image_alt", true);
            }

            $active_price = $settings['active_price'] ? 'price-active' : '';
            
            $price_style = $settings['tp_price_style'] == 'yes' ? 'pricing__style-2' : '';

            if($settings['tp_price_style'] == 'yes'){
                $price_style = 'pricing__style-2';
                $this->add_render_attribute('title_args', 'class', 'tp-section-title-2 font-70 tp-el-title');
            }else{
                $price_style = '';
                $this->add_render_attribute('title_args', 'class', 'section__title-7 tp-el-title');
            }
        ?>

         <!-- pricing area start -->
         <section class="pricing__area pt-130 p-relative z-index-1 tp-el-section">

            <?php if(!empty($settings['tp_price_shape_switch'])) :?>
            <div class="pricing__shape">
               <img class="pricing__shape-6" src="<?php echo get_template_directory_uri() . '/assets/img/price/7/price-shape-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
            </div>
            <?php endif; ?>

            <div class="container">
            <?php if ( !empty($settings['tp_price_section_title_show']) ) : ?>
               <div class="row justify-content-center">
                  <div class="col-xl-7 col-lg-8">

                  <?php if ( !empty($settings['tp_price_style'] == 'yes') ) : ?>
                    
                    <div class="tp-section-wrapper-2 mb-65 text-center tp-el-content">
                        <?php if ( !empty($settings['tp_price_sub_title']) ) : ?>
                        <span class="tp-section-subtitle-2 tp-el-subtitle"><?php echo tp_kses( $settings['tp_price_sub_title'] ); ?></span>
                        <?php endif; ?>

                        <?php
                                if ( !empty($settings['tp_price_title' ]) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['tp_price_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        tp_kses( $settings['tp_price_title' ] )
                                        );
                                endif;
                            ?>

                        <?php if ( !empty($settings['tp_price_description']) ) : ?>
                            <p><?php echo tp_kses( $settings['tp_price_description'] ); ?></p>
                        <?php endif; ?>
                     </div>
                     
                     <?php else: ?>
                        <div class="section__title-wrapper-7 text-center mb-60 tp-el-content">
                        <?php if ( !empty($settings['tp_price_sub_title']) ) : ?>
                        <span class="section__title-pre-7 tp-el-subtitle"><?php echo tp_kses( $settings['tp_price_sub_title'] ); ?></span>
                        <?php endif; ?>

                        <?php
                                if ( !empty($settings['tp_price_title' ]) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['tp_price_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        tp_kses( $settings['tp_price_title' ] )
                                        );
                                endif;
                            ?>

                        <?php if ( !empty($settings['tp_price_description']) ) : ?>
                            <p><?php echo tp_kses( $settings['tp_price_description'] ); ?></p>
                        <?php endif; ?>
                     </div>
                     <?php endif; ?>
                  </div>
               </div>
               <?php endif; ?>
               <div class="pricing__table <?php echo esc_attr($price_style); ?> white-bg tp-el-box">
                  <div class="pricing__table-wrapper">
                     <!-- pricng header -->
                     <div class="pricing__header grey-bg-13">
                        <div class="row gx-0">
                           <div class="col-xl-4 col-4">
                              <div class="pricing__header-content">

                                <?php if (!empty($settings['tp_price_contact_title'])) : ?>
                                 <h3 class="pricing__header-title tp-el-head-title"><?php echo tp_kses($settings['tp_price_contact_title']); ?></h3>
                                 <?php endif; ?>

                                 <?php if (!empty($settings['tp_contact_btn_button_show'])) : ?>
                                 <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>><?php echo $settings['tp_contact_btn_text']; ?></a>
                                 <?php endif; ?>

                                 <?php if (!empty($tp_price_contact_thumb_url)) : ?>
                                 <img class="pricing-header-shape" src="<?php echo esc_attr($tp_price_contact_thumb_url); ?>" alt="<?php echo esc_attr($tp_price_contact_thumb_alt); ?>">
                                 <?php endif; ?>
                              </div>
                           </div>
                           <div class="col-xl-8 col-8">
                              <div class="pricing__header-top-wrapper d-flex align-items-center">

                                 <!-- pricing heading one -->
                                 <div class="pricing__top-7 p-relative text-center">

                                    <?php if(!empty($settings['silver_title'])) : ?>
                                    <div class="pricing__tag-7">
                                       <span class="tp-el-box-subtitle"><?php echo tp_kses($settings['silver_title']); ?></span>
                                    </div>
                                    <?php endif; ?>

                                    <div class="pricing__title-wrapper-7">
                                        <?php if(!empty($settings['silver_price'])) : ?>
                                        <h3 class="pricing__title-7 tp-el-box-title"><?php echo esc_html($currency); ?><?php echo tp_kses($settings['silver_price']); ?><?php if (!empty($settings['silver_period'])) : ?><span><?php echo tp_kses($settings['silver_period']) ;?></span><?php endif; ?></h3>
                                        <?php endif; ?>

                                        <?php if(!empty($settings['silver_desc'])) : ?>
                                       <p class="tp-el-box-desc"><?php echo tp_kses($settings['silver_desc']); ?></p>
                                       <?php endif; ?>
                                    </div>
                                 </div>

                                 <!-- pricing heading two -->
                                 <div class="pricing__top-7 p-relative text-center">

                                    <?php if ( !empty($settings['show_badge']) ) : ?>
                                    <div class="pricing__popular-2">
                                       <span class="tp-el-box-badge"><?php echo esc_html($settings['badge_text']); ?></span>
                                    </div>
                                    <?php endif; ?>


                                    <?php if(!empty($settings['advanced_title'])) : ?>
                                    <div class="pricing__tag-7">
                                       <span class="tp-el-box-subtitle"><?php echo tp_kses($settings['advanced_title']); ?></span>
                                    </div>
                                    <?php endif; ?>
                                    <div class="pricing__title-wrapper-7">
                                    <?php if(!empty($settings['advanced_price'])) : ?>
                                       <h3 class="pricing__title-7 tp-el-box-title"><?php echo esc_html($currency2); ?><?php echo tp_kses($settings['advanced_price']); ?><?php if (!empty($settings['advanced_period'])) : ?><span><?php echo tp_kses($settings['advanced_period']) ;?></span><?php endif; ?></h3>
                                       <?php endif; ?>

                                       <?php if(!empty($settings['advanced_desc'])) : ?>
                                       <p class="tp-el-box-desc"><?php echo tp_kses($settings['advanced_desc']); ?></p>
                                       <?php endif; ?>
                                    </div>
                                 </div>
                                 

                                 <!-- pricing heading three -->
                                 <div class="pricing__top-7 p-relative text-center">

                                    <?php if(!empty($settings['enterprise_title'])) : ?>
                                    <div class="pricing__tag-7">
                                       <span class="tp-el-box-subtitle"><?php echo tp_kses($settings['enterprise_title']); ?></span>
                                    </div>
                                    <?php endif; ?>
                                    <div class="pricing__title-wrapper-7">
                                    <?php if(!empty($settings['enterprise_price'])) : ?>
                                       <h3 class="pricing__title-7 tp-el-box-title"><?php echo esc_html($currency3); ?><?php echo tp_kses($settings['enterprise_price']); ?><?php if (!empty($settings['enterprise_period'])) : ?><span><?php echo tp_kses($settings['enterprise_period']) ;?></span><?php endif; ?></h3>
                                       <?php endif; ?>

                                       <?php if(!empty($settings['enterprise_desc'])) : ?>
                                       <p class="tp-el-box-desc"><?php echo tp_kses($settings['enterprise_desc']); ?></p>
                                       <?php endif; ?>
                                    </div>
                                    
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>

                     <!-- pricing features item wrapper -->
                     <div class="pricing__feature-item-wrapper">
                        <!-- pricing features item -->

                        <?php if ( !empty($settings['show_features']) ) : ?>
                            <?php foreach ($settings['features_list'] as $index => $item) : ?>
                            <div class="pricing__feature-info-item">
                                <div class="row gx-0 align-items-center">
                                    <div class="col-xl-4 col-4">
                                        <div class="pricing__feature-info-content d-flex align-items-center">

                                            <?php if(!empty($item['tp_price_feature_info_tooltip'])): ?>
                                            <div class="pricing__feature-info-details">
                                                <span>
                                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M9 1.5C4.99594 1.5 1.75 4.74594 1.75 8.75C1.75 12.7541 4.99594 16 9 16C13.0041 16 16.25 12.7541 16.25 8.75C16.25 4.74594 13.0041 1.5 9 1.5ZM0.25 8.75C0.25 3.91751 4.16751 0 9 0C13.8325 0 17.75 3.91751 17.75 8.75C17.75 13.5825 13.8325 17.5 9 17.5C4.16751 17.5 0.25 13.5825 0.25 8.75ZM9 7.75C9.55229 7.75 10 8.19771 10 8.75V11.95C10 12.5023 9.55229 12.95 9 12.95C8.44771 12.95 8 12.5023 8 11.95V8.75C8 8.19771 8.44771 7.75 9 7.75ZM9 4.5498C8.44771 4.5498 8 4.99752 8 5.5498C8 6.10209 8.44771 6.5498 9 6.5498H9.008C9.56028 6.5498 10.008 6.10209 10.008 5.5498C10.008 4.99752 9.56028 4.5498 9.008 4.5498H9Z" fill="currentColor"/>
                                                    </svg>                                 
                                                </span>

                                                <div class="pricing__feature-info-tooltip transition-3">
                                                    <p><?php echo tp_kses($item['tp_price_feature_info_tooltip']); ?></p>
                                                </div>
                                            </div>
                                            <?php endif; ?>

                                            <?php if(!empty($item['tp_price_feature_info_text'])): ?>
                                            <div class="pricing__feature-info-text">
                                            <p><?php echo tp_kses($item['tp_price_feature_info_text']); ?></p>
                                            </div>
                                            <?php endif; ?>

                                        </div>
                                    </div>
                                    <div class="col-xl-8 col-8">
                                        <div class="pricing__feature-info-wrapper d-flex align-items-center">

                                            <div class="pricing__feature-info-available text-center tp-el-box-feature">
                                                <p>
                                                    <?php echo tp_kses($item['tp_price_features_option']); ?>
                                                </p>
                                            </div>

                                            <div class="pricing__feature-info-available text-center tp-el-box-feature">
                                                <p>
                                                    <?php echo tp_kses($item['tp_price_features_option_2']); ?>
                                                </p>
                                            </div>
 
                                            <div class="pricing__feature-info-available text-center tp-el-box-feature">
                                                <p>
                                                    <?php echo tp_kses($item['tp_price_features_option_3']); ?>
                                                </p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        <?php endif; ?>

                        <!-- pricing button -->
                        <div class="pricing__footer">
                           <div class="row gx-0">
                              <div class="col-xl-4 col-4">
                                 <div class="pricing__footer-content"></div>
                              </div>

                              <div class="col-xl-8 col-8">

                                 <div class="pricing__btn-wrapper-7 d-flex align-items-center">
                                    <?php if (!empty($settings['tp_silver_btn_button_show'])) : ?>                        
                                    <div class="pricing__btn-7 text-center">
                                       <a <?php echo $this->get_render_attribute_string( 'tp-button-arg-silver' ); ?>><?php echo $settings['tp_silver_btn_text']; ?></a>
                                    </div>
                                    <?php endif; ?>

                                    <?php if (!empty($settings['tp_advanced_btn_button_show'])) : ?> 
                                    <div class="pricing__btn-7 <?php echo esc_attr($active_price); ?> text-center">
                                       <a <?php echo $this->get_render_attribute_string( 'tp-button-arg-advanced' ); ?>><?php echo $settings['tp_advanced_btn_text']; ?></a>
                                    </div>
                                    <?php endif; ?>

                                    <?php if (!empty($settings['tp_enterprise_btn_button_show'])) : ?> 
                                    <div class="pricing__btn-7 text-center">
                                       <a <?php echo $this->get_render_attribute_string( 'tp-button-arg-enterprise' ); ?>><?php echo $settings['tp_enterprise_btn_text']; ?></a>
                                    </div>
                                    <?php endif; ?>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- pricing area end -->

        <?php endif; ?>

        <?php
    }
}

$widgets_manager->register( new TP_Price_Box() );