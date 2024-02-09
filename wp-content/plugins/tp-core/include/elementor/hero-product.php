<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Control_Media;
use \Elementor\Repeater;
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
class TP_Hero_Product extends Widget_Base {

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
		return 'hero-product';
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
		return __( 'Hero Product Banner', 'tp-core' );
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'tp_slider_section_title',
            [
                'label' => esc_html__('Title & Content', 'tpcore'),
            ]
        );

        $this->add_control(
            'tp_slider_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Sony Airpods Max',
                'placeholder' => esc_html__('Type Heading Text', 'tpcore'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'tp_slider_title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'tpcore'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => esc_html__('H1', 'tpcore'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => esc_html__('H2', 'tpcore'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => esc_html__('H3', 'tpcore'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => esc_html__('H4', 'tpcore'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => esc_html__('H5', 'tpcore'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => esc_html__('H6', 'tpcore'),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h2',
                'toggle' => false,
            ]
        );


        $this->add_responsive_control(
            'tp_slider_align',
            [
                'label' => esc_html__('Alignment', 'tp-core'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'text-start' => [
                        'title' => esc_html__('Left', 'tp-core'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'text-center' => [
                        'title' => esc_html__('Center', 'tp-core'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'text-end' => [
                        'title' => esc_html__('Right', 'tp-core'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'text-start',
                'toggle' => false,
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
         'tp_slider_side_sec',
             [
               'label' => esc_html__( 'Side Text', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
             ]
        );
        
        $this->add_control(
         'tp_slider_side_text_show',
            [
            'label'        => esc_html__( 'Enable Side Text ?', 'tpcore' ),
            'type'         => \Elementor\Controls_Manager::SWITCHER,
            'label_on'     => esc_html__( 'Show', 'tpcore' ),
            'label_off'    => esc_html__( 'Hide', 'tpcore' ),
            'return_value' => 'yes',
            'default'      => 'yes',
            ]
        );

        $this->add_control(
        'tp_slider_side_text',
            [
                'label'       => esc_html__( 'Slider Side Text', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'headphone', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
			'tp_slider_side_text_color',
			[
				'label' => esc_html__( 'Transform', 'tpcore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slider__bg-text h3' => 'color: {{VALUE}};',
				],
                'default' => '#5EB74B',
                'label_block' => true,
                'placeholder' => esc_html__( 'Color code', 'tpcore' ),
			]
		);

        $this->add_control(
			'tp_slider_side_text_transform',
			[
				'label' => esc_html__( 'Transform', 'tpcore' ),
				'type' => Controls_Manager::TEXT,
				'selectors' => [
					'{{WRAPPER}} .slider__bg-text' => 'transform: {{VALUE}};',
				],
                'label_block' => true,
                'placeholder' => esc_html__( 'translate(200px) rotate(-90deg)', 'tpcore' ),
			]
		);
        


        $this->end_controls_section();

        $this->start_controls_section(
         'tp_product_sec',
             [
               'label' => esc_html__( 'Product Price', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
             ]
        );
        
        $this->add_control(
         'tp_product_discount_enable',
         [
           'label'        => esc_html__( 'Enable Product Discount?', 'tpcore' ),
           'type'         => \Elementor\Controls_Manager::SWITCHER,
           'label_on'     => esc_html__( 'Show', 'tpcore' ),
           'label_off'    => esc_html__( 'Hide', 'tpcore' ),
           'return_value' => 'yes',
           'default'      => 'yes',
         ]
        );

        $this->add_control(
        'tp_product_new_price',
            [
                'label'       => esc_html__( 'New Price', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( '$380', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
                'condition' =>[
                    'tp_product_discount_enable' => 'yes'
                ]
            ]
        );

        $this->add_control(
        'tp_product_old_price',
            [
                'label'       => esc_html__( 'Old Price', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( '$450', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
                'condition' =>[
                    'tp_product_discount_enable' => 'yes'
                ]
            ]
        );
        $this->add_control(
        'tp_product_price',
         [
            'label'       => esc_html__( 'Price', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( '$350', 'tpcore' ),
            'placeholder' => esc_html__( 'Your Text', 'tpcore' ),

         ]
        );
        
        $this->end_controls_section();
 
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
                'label' => esc_html__( 'Choose Image 2', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_design_style' => 'layout-2'
                ]
            ]
        );
        $this->add_control(
            'tp_image_3',
            [
                'label' => esc_html__( 'Choose Image 3', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_design_style' => 'layout-2'
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
         'tp_nav_sec',
             [
               'label' => esc_html__( 'Navigation Image', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
               'condition' => [
                    'tp_design_style' => 'layout-2'
                ]
             ]
        );
        $this->add_control(
         'tp_image_nav',
         [
           'label'   => esc_html__( 'Upload Image', 'tpcore' ),
           'type'    => \Elementor\Controls_Manager::MEDIA,
             'default' => [
               'url' => \Elementor\Utils::get_placeholder_image_src(),
           ],
         ]
        );
        
        $this->add_control(
            'tp_image_nav_2',
            [
                'label' => esc_html__( 'Choose Image 2', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_control(
            'tp_image_nav_3',
            [
                'label' => esc_html__( 'Choose Image 3', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tp_image_nav_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
         'tp_tooltip_sec',
             [
               'label' => esc_html__( 'Tooltip', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
               'condition' => [
                    'tp_design_style' => 'layout-1'
                ]
             ]
        );
        
        
        $repeater = new \Elementor\Repeater();
        
         $repeater->add_control(
         'tp_product_tooltip_title',
           [
             'label'   => esc_html__( 'Tooltip Title', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::TEXT,
             'default'     => esc_html__( 'Active noise control', 'tpcore' ),
             'label_block' => true,
           ]
         );
         $repeater->add_control(
         'tp_product_tooltip_desc',
           [
             'label'   => esc_html__( 'Tooltip Description', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::TEXTAREA,
             'default'     => esc_html__( 'Mint Green', 'tpcore' ),
             'label_block' => true,
           ]
         );

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
			'tp_product_tooltip_transfrom',
			[
				'label' => esc_html__( 'Transform', 'tpcore' ),
				'type' => Controls_Manager::TEXT,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'transform: {{VALUE}};',
				],
                'label_block' => true,
                'placeholder' => esc_html__( 'translate(200px) rotate(-90deg)', 'tpcore' ),
                'condition' => [
                    'want_customize' => 'yes'
                ]
			]
		);

         $this->add_control(
           'tp_product_tooltip_list',
           [
             'label'       => esc_html__( 'Tooltip List', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::REPEATER,
             'fields'      => $repeater->get_controls(),
             'default'     => [
               [
                 'tp_product_tooltip_title'   => esc_html__( 'Active noise control', 'tpcore' ),
               ],
             ],
             'title_field' => '{{{ tp_product_tooltip_title }}}',
           ]
         );
        
        
        $this->end_controls_section();

        $this->tp_button_render('slider', 'Button', ['layout-1', 'layout-2']);
	}
    

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('hero_section', 'Section - Style', '.tp-el-section');

        $this->tp_basic_style_controls('hero_subtitle', 'Hero - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('hero_title', 'Hero - Title', '.tp-el-title');
        $this->tp_basic_style_controls('hero_description', 'Hero - Description', '.tp-el-content p');

        $this->tp_basic_style_controls('hero_price', 'Price', '.tp-el-box-price');
        $this->tp_basic_style_controls('hero_price_new', 'Price New', '.tp-el-box-price-new');
        $this->tp_basic_style_controls('hero_price_old', 'Price - Old', '.tp-el-box-price-old');


        $this->tp_section_style_controls('hero_tooltip', 'Tooltip - Box', '.slider__product-tooltip .tp-el-tooltip, .slider__product-tooltip .tp-el-tooltip::after');
        $this->tp_basic_style_controls('hero_tooltip_title', 'Tooltip - Title', '.slider__product-tooltip .tp-el-tooltip-title');
        $this->tp_basic_style_controls('hero_tooltip_subtitle', 'Tooltip - Subtitle', '.slider__product-tooltip .tp-el-tooltip-subtitle');

        $this->tp_link_controls_style('hero_button', 'Hero - Button', '.tp-el-box-btn');

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
            $this->add_render_attribute('title_args', 'class', 'slider__title-11 slider__title-11-product tp-el-title');

            if ('2' == $settings['tp_slider_btn_link_type']) {
                $link = get_permalink($settings['tp_slider_btn_page_link']);
                $target = '_self';
                $rel = 'nofollow';
            } else {
                $link = !empty($settings['tp_slider_btn_link']['url']) ? $settings['tp_slider_btn_link']['url'] : '';
                $target = !empty($settings['tp_slider_btn_link']['is_external']) ? '_blank' : '';
                $rel = !empty($settings['tp_slider_btn_link']['nofollow']) ? 'nofollow' : '';
            }

            // main image
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

            // nav image
            if ( !empty($settings['tp_image_nav']['url']) ) {
                $tp_image_nav = !empty($settings['tp_image_nav']['id']) ? wp_get_attachment_image_url( $settings['tp_image_nav']['id'], $settings['tp_image_nav_size_size']) : $settings['tp_image_nav']['url'];
                $tp_image_nav_alt = get_post_meta($settings["tp_image_nav"]["id"], "_wp_attachment_image_alt", true);
            }

            if ( !empty($settings['tp_image_nav_2']['url']) ) {
                $tp_image_nav_2 = !empty($settings['tp_image_nav_2']['id']) ? wp_get_attachment_image_url( $settings['tp_image_nav_2']['id'], $settings['tp_image_nav_size_size']) : $settings['tp_image_nav_2']['url'];
                $tp_image_nav_2_alt = get_post_meta($settings["tp_image_nav_2"]["id"], "_wp_attachment_image_alt", true);
            }

            if ( !empty($settings['tp_image_nav_3']['url']) ) {
                $tp_image_nav_3 = !empty($settings['tp_image_nav_3']['id']) ? wp_get_attachment_image_url( $settings['tp_image_nav_3']['id'], $settings['tp_image_nav_size_size']) : $settings['tp_image_nav_3']['url'];
                $tp_image_nav_3_alt = get_post_meta($settings["tp_image_nav_3"]["id"], "_wp_attachment_image_alt", true);
            }
        ?>

            <div class="slider__item-11 slider__item-11-dark d-flex align-items-center p-relative is-dark gradient-bg-dark tp-el-section">

                <?php if(($settings['tp_slider_side_text_show'] == 'yes')) :?>
                <div class="slider__bg-text">
                    <h3><?php echo tp_kses($settings['tp_slider_side_text']); ?></h3>
                </div>
                <?php endif; ?>

                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xxl-5 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-8">
                            <div class="slider__content-11 slider__content-11-product">

                                <?php
                                    if ($settings['tp_slider_title_tag']) :
                                        printf('<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape($settings['tp_slider_title_tag']),
                                            $this->get_render_attribute_string('title_args'),
                                            tp_kses($settings['tp_slider_title'])
                                        );
                                    endif;
                                ?>

                                <div class="slider__product mb-35">

                                    <?php if($settings['tp_product_discount_enable'] == 'yes') : ?>

                                    <?php if(!empty($settings['tp_product_new_price'])) : ?>
                                    <span class="slider__product-price new-price tp-el-box-price-new">
                                        <?php echo tp_kses($settings['tp_product_new_price']) ?>
                                        <svg width="80" height="12" viewBox="0 0 80 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M7.14206 6.94656C12.1629 5.66085 17.191 4.67944 22.2691 3.92173C17.6776 4.1216 13.086 4.23794 8.49923 4.22004C8.17246 4.22004 7.90532 3.88295 7.90532 3.47426C7.9077 3.06259 8.17485 2.72849 8.50401 2.72849C22.1236 2.78218 50.3506 1.62472 63.9416 0.768569C67.5671 0.53887 71.1139 0.33599 74.7395 0.216666C75.6649 0.186835 76.5928 0.12719 77.5182 0.0854268C78 0.064545 79.2451 -0.0130244 79.4193 0.00189115C79.913 0.0406715 79.9869 0.577618 79.9941 0.661145C80.0132 0.85803 80.0012 1.1534 79.7245 1.37713C79.7055 1.39503 79.5981 1.47855 79.3572 1.51434C65.8903 3.51899 37.7324 3.26539 24.2488 5.1358C18.5768 5.92632 12.9739 6.97644 7.38297 8.40833C5.42948 8.9065 4.31558 9.2227 2.75565 9.74176C5.32691 10.586 7.96257 11.0543 10.6245 11.3049C10.6245 11.3049 7.14206 12.4781 4.504 11.7762C1.86594 11.0743 1.80633 11.0006 0.48492 10.4607C0.179612 10.3384 0.0865993 10.0997 0.0484359 9.97147C-0.0350466 9.70299 -0.0255071 9.40765 0.196318 9.13619C0.255948 9.06459 0.370434 8.96315 0.549325 8.89155C0.783076 8.79908 1.26727 8.70365 1.48432 8.62907C3.63102 7.88926 4.78308 7.54915 7.14206 6.94656Z" fill="currentColor"/>
                                        </svg>                                         
                                    </span>
                                    <?php endif; ?>

                                    <?php if(!empty($settings['tp_product_old_price'])) : ?>
                                    <span class="slider__product-price old-price tp-el-box-price-old"><?php echo tp_kses($settings['tp_product_old_price']) ?></span>
                                    <?php endif; ?>

                                    <?php else : ?>

                                    <?php if(!empty($settings['tp_product_price'])) : ?>
                                    <span class="slider__product-price tp-el-box-price"><?php echo tp_kses($settings['tp_product_price']) ?></span>
                                    <?php endif; ?>

                                    <?php endif; ?>
                                </div>

                                <?php if (!empty($link)) : ?>
                                <div class="slider__btn-11">
                                    <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>" class="tp-btn-9 tp-el-box-btn">
                                    <?php echo tp_kses($settings['tp_slider_btn_text']); ?>
                                        <span>
                                            <svg width="20" height="10" viewBox="0 0 20 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M15.28 1.54999L19 5.27002L15.28 8.98999" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M1 5.27002H19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>                                             
                                        </span>
                                    </a>
                                </div>
                                <?php endif; ?> 
                                                                   
                            </div>
                        </div>
                        <div class="col-xxl-7 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-4">
                            <div class="slider__product-wrapper d-flex">

                                <div id="product_wrapper" class="product-img-2">
                                    <div class="slider__product-thumb-single product-img-1">
                                        <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                                    </div>
                                    <div class="slider__product-thumb-single product-img-2">
                                        <img src="<?php echo esc_url($tp_image_2); ?>" alt="<?php echo esc_attr($tp_image_2_alt); ?>">
                                    </div>
                                    <div class="slider__product-thumb-single product-img-3">
                                        <img src="<?php echo esc_url($tp_image_3); ?>" alt="<?php echo esc_attr($tp_image_3_alt); ?>">
                                    </div>
                                </div>

                                <div class="slider__product-thumb-nav d-flex flex-lg-column">
                                    <span class="slider__product-thumb-nav-border">
                                        <svg width="168" height="468" viewBox="0 0 168 468" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6.47988 1C141.484 44.2679 289.939 296.912 1 467" stroke="white" stroke-opacity="0.2" stroke-dasharray="5 5"/>
                                        </svg>                                          
                                    </span>
                                    <div class="slider__product-thumb-sm product-img-sm-1" rel="product-img-1">
                                        <img src="<?php echo esc_url($tp_image_nav); ?>" alt="<?php echo esc_attr($tp_image_nav_alt); ?>">
                                    </div>
                                    <div class="slider__product-thumb-sm product-img-sm-2 active" rel="product-img-2">
                                        <img src="<?php echo esc_url($tp_image_nav_2); ?>" alt="<?php echo esc_attr($tp_image_nav_2_alt); ?>">
                                    </div>
                                    <div class="slider__product-thumb-sm product-img-sm-3" rel="product-img-3">
                                        <img src="<?php echo esc_url($tp_image_nav_3); ?>" alt="<?php echo esc_attr($tp_image_nav_3_alt); ?>">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

		<?php else: 
            $bloginfo = get_bloginfo( 'name' );
			$this->add_render_attribute('title_args', 'class', 'slider__title-11 tp-el-title');


            if ('2' == $settings['tp_slider_btn_link_type']) {
                $link = get_permalink($settings['tp_slider_btn_page_link']);
                $target = '_self';
                $rel = 'nofollow';
            } else {
                $link = !empty($settings['tp_slider_btn_link']['url']) ? $settings['tp_slider_btn_link']['url'] : '';
                $target = !empty($settings['tp_slider_btn_link']['is_external']) ? '_blank' : '';
                $rel = !empty($settings['tp_slider_btn_link']['nofollow']) ? 'nofollow' : '';
            }

            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }
		?>

                <div class="slider__item-11 d-flex align-items-end p-relative green-bg-6 tp-el-section">
                    <?php if(($settings['tp_slider_side_text_show'] == 'yes')) :?>
                    <div class="slider__bg-text">
                        <h3><?php echo tp_kses($settings['tp_slider_side_text']); ?></h3>
                    </div>
                    <?php endif; ?>

                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-xxl-4 col-xl-4 col-lg-5 col-md-6 col-sm-6 col-10">
                                <div class="slider__content-11 mb-80 p-relative z-index-1">
                                
                                    <?php
                                        if ($settings['tp_slider_title_tag']) :
                                            printf('<%1$s %2$s>%3$s</%1$s>',
                                                tag_escape($settings['tp_slider_title_tag']),
                                                $this->get_render_attribute_string('title_args'),
                                                tp_kses($settings['tp_slider_title'])
                                            );
                                        endif;
                                    ?>

                                    <div class="slider__product mb-35">

                                        <?php if($settings['tp_product_discount_enable'] == 'yes') : ?>

                                        <?php if(!empty($settings['tp_product_new_price'])) : ?>
                                        <span class="slider__product-price new-price tp-el-box-price-new">
                                            <?php echo tp_kses($settings['tp_product_new_price']) ?>
                                            <svg width="80" height="12" viewBox="0 0 80 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M7.14206 6.94656C12.1629 5.66085 17.191 4.67944 22.2691 3.92173C17.6776 4.1216 13.086 4.23794 8.49923 4.22004C8.17246 4.22004 7.90532 3.88295 7.90532 3.47426C7.9077 3.06259 8.17485 2.72849 8.50401 2.72849C22.1236 2.78218 50.3506 1.62472 63.9416 0.768569C67.5671 0.53887 71.1139 0.33599 74.7395 0.216666C75.6649 0.186835 76.5928 0.12719 77.5182 0.0854268C78 0.064545 79.2451 -0.0130244 79.4193 0.00189115C79.913 0.0406715 79.9869 0.577618 79.9941 0.661145C80.0132 0.85803 80.0012 1.1534 79.7245 1.37713C79.7055 1.39503 79.5981 1.47855 79.3572 1.51434C65.8903 3.51899 37.7324 3.26539 24.2488 5.1358C18.5768 5.92632 12.9739 6.97644 7.38297 8.40833C5.42948 8.9065 4.31558 9.2227 2.75565 9.74176C5.32691 10.586 7.96257 11.0543 10.6245 11.3049C10.6245 11.3049 7.14206 12.4781 4.504 11.7762C1.86594 11.0743 1.80633 11.0006 0.48492 10.4607C0.179612 10.3384 0.0865993 10.0997 0.0484359 9.97147C-0.0350466 9.70299 -0.0255071 9.40765 0.196318 9.13619C0.255948 9.06459 0.370434 8.96315 0.549325 8.89155C0.783076 8.79908 1.26727 8.70365 1.48432 8.62907C3.63102 7.88926 4.78308 7.54915 7.14206 6.94656Z" fill="currentColor"/>
                                            </svg>                                          
                                        </span>
                                        <?php endif; ?>

                                        <?php if(!empty($settings['tp_product_old_price'])) : ?>
                                        <span class="slider__product-price old-price tp-el-box-price-old"><?php echo tp_kses($settings['tp_product_old_price']) ?></span>
                                        <?php endif; ?>
                                        
                                        <?php else : ?>

                                        <?php if(!empty($settings['tp_product_price'])) : ?>
                                        <span class="slider__product-price tp-el-box-price"><?php echo tp_kses($settings['tp_product_price']) ?></span>
                                        <?php endif; ?>

                                        <?php endif; ?>
                                    </div>

                                    <?php if (!empty($link)) : ?>
                                    <div class="slider__btn-11">
                                        <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>" class="tp-btn-9 tp-el-box-btn">
                                        <?php echo tp_kses($settings['tp_slider_btn_text']); ?>
                                            <span>
                                                <svg width="20" height="10" viewBox="0 0 20 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M15.28 1.54999L19 5.27002L15.28 8.98999" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M1 5.27002H19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>                                             
                                            </span>
                                        </a>
                                    </div>
                                    <?php endif; ?> 
                                                            
                                </div>
                            </div>
                            <div class="col-xxl-8 col-xl-8 col-lg-7 col-md-6 col-sm-6 col-2">
                                <div class="slider__thumb-11 p-relative">

                                    <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">

                                    <div class="slider__product-tooltip">
                                    <?php foreach ($settings['tp_product_tooltip_list'] as $item) :?>
                                        <div class="tp-tooltip-single elementor-repeater-item-<?php echo esc_attr($item['_id']); ?>">
                                            <div class="tp-tooltip-circle">
                                                <div class="tp-tooltip-effect-1"></div>
                                                <div class="tp-tooltip-effect-2"></div>
                                            </div>
                                            <div class="tp-tooltip-content transition-3 tp-el-tooltip">

                                                <?php if(!empty($item['tp_product_tooltip_title'])) : ?>
                                                <h5 class="tp-el-tooltip-title"><?php echo tp_kses($item['tp_product_tooltip_title']) ?></h5>
                                                <?php endif; ?>

                                                <?php if(!empty($item['tp_product_tooltip_desc'])) : ?>
                                                <p class="tp-el-tooltip-subtitle"><?php echo tp_kses($item['tp_product_tooltip_desc']) ?></p>
                                                <?php endif; ?>

                                            </div>
                                        </div>
                                        <?php endforeach; ?> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        <?php endif; ?>

        <?php 
		
	}

}

$widgets_manager->register( new TP_Hero_Product() );