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
class TP_Img_Hotspot extends Widget_Base {

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
		return 'tp-img-hotspot';
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
		return __( 'Image Hotspot', 'tpcore' );
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

    protected function register_controls_section(){
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
         'tp_thumb_sec',
             [
               'label' => esc_html__( 'Thumbnail', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
             ]
        );

        $this->add_control(
         'tp_img',
         [
           'label'   => esc_html__( 'Upload Thumbnail', 'Text-domain' ),
           'type'    => \Elementor\Controls_Manager::MEDIA,
             'default' => [
               'url' => \Elementor\Utils::get_placeholder_image_src(),
           ],
         ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'medium',
                'exclude' => [
                    'custom'
                ]
            ]
        );
        
        
        
        $this->end_controls_section();

		$this->start_controls_section(
		 'tp_list_sec',
			 [
			   'label' => esc_html__( 'Tooltip List', 'tpcore' ),
			   'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			 ]
		);
		
		$repeater = new \Elementor\Repeater();
		
		$repeater->add_control(
		'tp_tooltip_number',
		  [
			'label'   => esc_html__( 'Number', 'tpcore' ),
			'type'        => \Elementor\Controls_Manager::TEXT,
			'default'     => esc_html__( '01', 'tpcore' ),
			'label_block' => true,
		  ]
		);
		
		$repeater->add_control(
		'tp_tooltip_text',
		  [
			'label'   => esc_html__( 'Description', 'tpcore' ),
			'type'        => \Elementor\Controls_Manager::TEXT,
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
                'label_block' => true,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'transform: {{VALUE}};',
				],
                'placeholder' => esc_html__( 'translate(200px) rotate(-90deg)', 'tpcore' ),
                'condition' => [
                    'want_customize' => 'yes'
                ]
			]
		);
        
        $repeater->add_control(
			'tp_product_tooltip_color',
			[
				'label' => esc_html__( 'Color', 'tpcore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} span' => 'color: {{VALUE}};',
				],
                'placeholder' => esc_html__( 'White', 'tpcore' ),
                'condition' => [
                    'want_customize' => 'yes'
                ]
			]
		);
                
        
        $repeater->add_control(
			'tp_product_tooltip_bg',
			[
				'label' => esc_html__( 'Background Color', 'tpcore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} span' => 'background-color: {{VALUE}};',
				],
                'placeholder' => esc_html__( 'red', 'tpcore' ),
                'condition' => [
                    'want_customize' => 'yes'
                ]
			]
		);
        
        $repeater->add_control(
			'tp_product_tooltip_desc_bg',
			[
				'label' => esc_html__( 'Tooltip Text Background', 'tpcore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .tp-tooltip-content' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} {{CURRENT_ITEM}} .tp-tooltip-content::after' => 'background-color: {{VALUE}};',
				],
                'placeholder' => esc_html__( 'red', 'tpcore' ),
                'condition' => [
                    'want_customize' => 'yes'
                ]
			]
		);
        
        $repeater->add_control(
			'tp_product_tooltip_desc_text',
			[
				'label' => esc_html__( 'Tooltip Text Color', 'tpcore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .tp-el-tooltip-subtitle' => 'color: {{VALUE}};',
				],
                'placeholder' => esc_html__( 'red', 'tpcore' ),
                'condition' => [
                    'want_customize' => 'yes'
                ]
			]
		);
		
        
        $repeater->add_control(
			'tp_product_tooltip_shadow_bg',
			[
				'label' => esc_html__( 'Shadow Background', 'tpcore' ),
                'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} span::after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} {{CURRENT_ITEM}} span::before' => 'background-color: {{VALUE}};',
				],
                'placeholder' => esc_html__( 'red', 'tpcore' ),
                'condition' => [
                    'want_customize' => 'yes'
                ]
			]
		);
		
		$this->add_control(
		  'tp_tooltip_list',
		  [
			'label'       => esc_html__( 'Features List', 'tpcore' ),
			'type'        => \Elementor\Controls_Manager::REPEATER,
			'fields'      => $repeater->get_controls(),
			'default'     => [
			  [
				'tp_tooltip_number'   => esc_html__( '01', 'tpcore' ),
			  ],
			],
			'title_field' => '{{{ tp_tooltip_number }}}',
		  ]
		);
		
		
		$this->end_controls_section();
    }

    protected function style_tab_content(){

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
            if ( !empty($settings['tp_img']['url']) ) {
                $tp_img_url = !empty($settings['tp_img']['id']) ? wp_get_attachment_image_url( $settings['tp_img']['id'], $settings['thumbnail_size']) : $settings['tp_img']['url'];
                $tp_img_alt = get_post_meta($settings["tp_img"]["id"], "_wp_attachment_image_alt", true);
            }
        ?>	
            
        <div class="tp-img-hotspot" id="yourDiv">
            <?php foreach ($settings['tp_tooltip_list'] as $key => $item) : ?> 
				<div class="tp-hotspot-item elementor-repeater-item-<?php echo esc_attr($item['_id']); ?>">
					<div class="tp-hotspot-wrapper ">
						<span class="tp-hotspot tp-hotspot tp-pulse-border-2 "><?php echo esc_html($item['tp_tooltip_number']) ?></span>
					</div>
					<div class="tp-tooltip-single">
						<div class="tp-tooltip-content transition-3 tp-el-tooltip">
							<p class="tp-el-tooltip-subtitle"><?php echo esc_html($item['tp_tooltip_text']) ?></p>
						</div>
					</div>
				</div>
            <?php endforeach; ?>
            <img src="<?php echo esc_url($tp_img_url); ?>" alt="<?php echo esc_attr($tp_img_alt); ?>">
        </div>
      

        <?php endif; ?>

        <?php 
	}
}

$widgets_manager->register( new TP_Img_Hotspot() );