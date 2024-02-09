<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Typography;
Use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Background;
use TPCore\Elementor\Controls\Group_Control_TPBGGradient;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Fact extends Widget_Base {

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
		return 'tp-fact';
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
		return __( 'Fact', 'tpcore' );
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

        $this->tp_section_title_render_controls('fact_sec', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.');

        // Service group
        $this->start_controls_section(
            'tp_fact',
            [
                'label' => esc_html__('Fact List', 'tpcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
    
        $this->add_control(
         'fact_shape_switch',
         [
           'label'        => esc_html__( 'Fact Shape On/Off', 'tpcore' ),
           'type'         => \Elementor\Controls_Manager::SWITCHER,
           'label_on'     => esc_html__( 'Show', 'tpcore' ),
           'label_off'    => esc_html__( 'Hide', 'tpcore' ),
           'return_value' => 'yes',
           'default'      => 'yes',
         ]
        );
    
        $this->add_control(
         'fact_overlay_switch',
         [
           'label'        => esc_html__( 'Fact Overlay On/Off', 'tpcore' ),
           'type'         => \Elementor\Controls_Manager::SWITCHER,
           'label_on'     => esc_html__( 'Show', 'tpcore' ),
           'label_off'    => esc_html__( 'Hide', 'tpcore' ),
           'return_value' => 'yes',
           'default'      => 'yes',
           'condition' => [
                'tp_design_style' => 'layout-8'
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
                'condition' => [
                    'repeater_condition' => 'style_1'
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
                    'repeater_condition' => 'style_1'
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
                    'repeater_condition' => 'style_1',
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
                        'repeater_condition' => 'style_1'
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
                        'repeater_condition' => 'style_1'
                    ]
                ]
            );
        }

        $repeater->add_control(
            'tp_fact_number', [
                'label' => esc_html__('Number', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('17', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_fact_number_unit', [
                'label' => esc_html__('Number Quantity', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('%', 'tpcore'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'tp_fact_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Food', 'tpcore'),
                'label_block' => true,
            ]
        );         
        $repeater->add_control(
            'tp_fact_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'There are many ',
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => 'style_1'
                ]
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
            'fact_bg_color',
            [
                'label'       => esc_html__( 'Fact BG Color', 'tpcore' ),
                'type'     => \Elementor\Controls_Manager::COLOR,
                'selectors' => ['{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-color: {{VALUE}}'],
                'default' => '#5EB74B',
                'condition' => ['want_customize' => 'yes'],
            ]
        );


        $repeater->add_control(
            'base_title_color',
            [
                'label' => esc_html__( 'Fact Title Color', 'tp-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .counter__title-5' => 'color: {{VALUE}} !important',
                ],
                'condition' => ['want_customize' => 'yes'],
            ]
        );
        $repeater->add_control(
            'base_icon_color',
            [
                'label' => esc_html__( 'Fact Icon Color', 'tp-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .counter__icon-5 span' => 'color: {{VALUE}} !important',
                ],
                'condition' => ['want_customize' => 'yes'],
            ]
        );
        $repeater->add_control(
            'base_num_color',
            [
                'label' => esc_html__( 'Fact Number Color', 'tp-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .counter__no h4' => 'color: {{VALUE}} !important',
                ],
                'condition' => ['want_customize' => 'yes'],
            ]
        );

        $this->add_control(
            'tp_fact_list',
            [
                'label' => esc_html__('Fact - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_fact_title' => esc_html__('Business', 'tpcore'),
                    ],
                    [
                        'tp_fact_title' => esc_html__('Website', 'tpcore')
                    ],
                    [
                        'tp_fact_title' => esc_html__('Marketing', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_fact_title }}}',
            ]
        );
        $this->add_responsive_control(
            'tp_fact_align',
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
        $this->end_controls_section();


        $this->start_controls_section(
            'tp_fact_banner_section',
                [
                'label' => esc_html__( 'Fact Banner', 'tpcore' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'tp_design_style' => 'layout-2',
                ]
            ]
        );
        
        $this->add_control(
            'fact_banner_title',
            [
                'label'       => esc_html__( 'Banner Title', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Banner Title', 'tpcore' ),
                'placeholder' => esc_html__( 'Placeholder Text', 'tpcore' ),
            ]
        );

        $this->add_control(
            'fact_banner_desc',
            [
                'label'       => esc_html__( 'Banner Description', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'rows'        => 10,
                'default'     => esc_html__( 'Banner Description', 'tpcore' ),
                'placeholder' => esc_html__( 'Placeholder Text', 'tpcore' ),
            ]
        );
        $this->add_control(
            'tp_fact_banner_image',
            [
                'label'   => esc_html__( 'Banner Thumbnail', 'tpcore' ),
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
        $this->tp_section_style_controls('fact_section', 'Section - Style', '.tp-el-section');
        $this->tp_section_style_controls('fact_section_box', 'Box - Style', '.tp-el-box');
        $this->tp_basic_style_controls('fact_box_title', 'Fact - Title', '.tp-el-box-title');
        $this->tp_basic_style_controls('fact_box_number', 'Fact - Number', '.tp-el-box-number');
        $this->tp_icon_style('fact_box_icon', 'Fact - Icon', '.tp-el-box-icon span');
        $this->tp_basic_style_controls('fact_box_description', 'Fact - Description', '.tp-el-box-desc');
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


         <!-- fun fact area start -->
         <section class="fact__area tp-el-section">
            <div class="container">
               <div class="row gx-2 gy-2 gy-lg-0">
                <?php foreach ($settings['tp_fact_list'] as $key => $item) : ?>
                  <div class="col-xxl-4 col-lg-4 col-md-6">
                     <div class="fact__item white-bg d-flex align-items-center wow fadeInDown tp-el-box" data-wow-delay=".3s" data-wow-duration="1s">
                        <div class="fact__icon d-flex ">
                            <div class="fact__icon-wrapper">
                                <div class="fact__icon-inner tp-el-box-icon">
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
                                <span class="tp-el-box-number tp-fact-number"><?php echo tp_kses($item['tp_fact_number' ]); ?></span>
                            </div>
                        </div>
                        <div class="fact__content">
                           <h4 class="tp-el-box-title"><?php echo tp_kses($item['tp_fact_title' ]); ?></h4>
                           <p class="tp-el-box-desc"><?php echo tp_kses($item['tp_fact_description' ]); ?></p>
                        </div>
                     </div>
                  </div>
                  <?php endforeach; ?>

                  <?php if(!empty($settings['fact_banner_title']) OR !empty($settings['fact_banner_desc'])) : 
                    if ( !empty($settings['tp_fact_banner_image']['url']) ) {
                        $tp_fact_image_url = !empty($settings['tp_fact_banner_image']['id']) ? wp_get_attachment_image_url( $settings['tp_fact_banner_image']['id'], $settings['thumbnail_size']) : $settings['tp_fact_banner_image']['url'];
                        $tp_fact_image_alt = get_post_meta($settings["tp_fact_banner_image"]["id"], "_wp_attachment_image_alt", true);
                    }
                    ?>
                  <div class="col-xxl-4 col-lg-4 col-md-6">
                     <div class="fact__banner fact__banner-overlay p-relative z-index-1 wow fadeInDown" data-wow-delay=".7s" data-wow-duration="1s">
                        <div class="fact__banner-bg include-bg"  data-background="<?php echo esc_url($tp_fact_image_url); ?>"></div>

                        <div class="fact__banner-content">
                           <h5 class="tp-el-box-title"><?php echo esc_html($settings['fact_banner_title']); ?></h5>
                           <p class="tp-el-box-desc"><?php echo tp_kses($settings['fact_banner_desc']); ?></p>
                        </div>
                     </div>
                  </div>
                  <?php endif; ?>
               </div>
            </div>
         </section>
         <!-- fun fact area end -->


        <?php elseif ( $settings['tp_design_style']  == 'layout-3' ): 
            $bloginfo = get_bloginfo( 'name' );
        ?>

         <!-- counter area start -->
         <section class="counter__area counter__border-2 tp-el-section">
            <div class="container">
               <div class="counter__inner-4 tp-el-box" data-bg-color="green-dark-2">
                  <div class="conter__shape">
                     <img class="counter__shape-10" src="<?php echo get_template_directory_uri() . '/assets/img/counter/4/counter-shape-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                  </div>
                  <div class="row">
                  <?php 
                        foreach ($settings['tp_fact_list'] as $key => $item) :  
                    ?>
                     <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6">
                        <div class="counter__item-4-wrapper d-flex justify-content-center wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s">
                           <div class="counter__item-4">
                              <h4 class="counter__title-4 tp-el-box-number"><span data-purecounter-duration="1" data-purecounter-end="<?php echo tp_kses($item['tp_fact_number' ]); ?>"  class="purecounter">0</span><?php echo tp_kses($item['tp_fact_number_unit']);?></h4>
                              <div class="counter__content-4">
                                 <p class="tp-el-box-title"><?php echo tp_kses($item['tp_fact_title' ]); ?></p>
                              </div>
                           </div>
                        </div>
                     </div>
                     <?php endforeach; ?>
                  </div>
               </div>
            </div>
         </section>
         <!-- counter area end -->

        <?php elseif ( $settings['tp_design_style']  == 'layout-4' ): 
            $bloginfo = get_bloginfo( 'name' );
        ?>

        <div class="about__counter-wrapper tp-el-section">
            <div class="row gx-1 gy-1 gy-lg-0">
                <?php 
                    foreach ($settings['tp_fact_list'] as $key => $item) :  
                ?>
                <div class="col-xxl-4 col-lg-4 col-md-6">
                    <div class="about__counter-item d-flex justify-content-center align-items-center tp-el-box">
                        <div class="about__counter-text mr-15">
                            <h3 class="tp-el-box-number"><span data-purecounter-duration="1" data-purecounter-end="<?php echo tp_kses($item['tp_fact_number' ]); ?>"  class="purecounter">0</span><?php echo tp_kses($item['tp_fact_number_unit']);?></h3>
                        </div>
                        <div class="about__counter-content">
                            <h3 class="tp-el-box-title"><?php echo tp_kses($item['tp_fact_title' ]); ?></h3>
                            <p class="tp-el-box-desc"><?php echo tp_kses($item['tp_fact_description' ]); ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>


        <?php elseif ( $settings['tp_design_style']  == 'layout-5' ): 
            $bloginfo = get_bloginfo( 'name' );
        ?>

         <!-- counter area start -->
         <section class="counter__area counter__border-radius pb-110 p-relative z-index-1 tp-el-section">
            <?php if(!empty($settings['fact_shape_switch'])) : ?>
            <div class="counter__shape">
               <img class="counter__shape-11" src="<?php echo get_template_directory_uri() . '/assets/img/counter/5/counter-shape-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="counter__shape-12" src="<?php echo get_template_directory_uri() . '/assets/img/counter/5/counter-shape-2.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
            </div>
            <?php endif; ?>

            <div class="container">
                <div class="row gx-2">
                    <?php 
                        foreach ($settings['tp_fact_list'] as $key => $item) :  
                    ?>
                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                        <div class="counter__item-5 mb-30 wow zoomIn elementor-repeater-item-<?php echo esc_attr($item['_id']); ?>" data-wow-delay=".3s" data-wow-duration="1s">
                            <div class="counter__icon-5">
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
                            
                            <?php if (!empty($item['tp_fact_title' ])): ?>
                            <div class="counter__content-5">
                                <h3 class="counter__title-5"><?php echo tp_kses($item['tp_fact_title' ]); ?></h3>
                            </div>
                            <?php endif; ?>

                            <?php if (!empty($item['tp_fact_number' ])): ?>
                            <div class="counter__no">
                                <h4><span data-purecounter-duration="1" data-purecounter-end="<?php echo tp_kses($item['tp_fact_number' ]); ?>"  class="purecounter">0</span><?php echo tp_kses($item['tp_fact_number_unit']);?></h4>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
         </section>
         <!-- counter area end -->

        <?php elseif ( $settings['tp_design_style']  == 'layout-6' ): 
            $bloginfo = get_bloginfo( 'name' );
            $this->add_render_attribute('title_args', 'class', 'section__title-7 tp-el-title');    
        ?>
         <!-- counter area start -->
         <section class="counter__area p-relative z-index-1 green-light-bg-4 pt-145 pb-110 fix tp-el-section">

            <div class="counter__border-animation"></div>
            <?php if(!empty($settings['fact_shape_switch'])) : ?>
            <div class="counter__shape">
               <img class="counter__shape-13" src="<?php echo get_template_directory_uri() . '/assets/img/counter/7/counter-shape-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="counter__shape-14" src="<?php echo get_template_directory_uri() . '/assets/img/counter/7/counter-shape-2.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="counter__shape-15" src="<?php echo get_template_directory_uri() . '/assets/img/counter/7/counter-shape-3.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
            </div>
            <?php endif; ?>

            <div class="container">
            <?php if ( !empty($settings['tp_fact_sec_section_title_show']) ) : ?>
               <div class="row justify-content-center">
                  <div class="col-xxl-8 col-xl-8 col-lg-9">
                     <div class="section__title-wrapper-7 mb-60 text-center tp-el-content">
                            <?php if(!empty($settings['tp_fact_sec_sub_title'])): ?>
                            <span class="section__title-pre-7 tp-el-subtitle"><?php echo tp_kses($settings['tp_fact_sec_sub_title']); ?></span>
                            <?php endif; ?>

                            <?php
                                if ( !empty($settings['tp_fact_sec_title' ]) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['tp_fact_sec_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        tp_kses( $settings['tp_fact_sec_title' ] )
                                        );
                                endif;
                            ?>

                        <?php if ( !empty($settings['tp_fact_sec_description']) ) : ?>
                            <p><?php echo tp_kses( $settings['tp_fact_sec_description'] ); ?></p>
                        <?php endif; ?>

                        </div>
                    </div>
               </div>
               <?php endif; ?>
               <div class="row">
                    <?php 
                        foreach ($settings['tp_fact_list'] as $key => $item) :  
                    ?>
                  <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6">
                     <div class="counter__item-7 white-bg mb-30 text-center tp-el-box">
                        <div class="counter__icon-7 tp-el-box-icon">
                          
                              <img class="counter__icon-7-shape" src="<?php echo get_template_directory_uri() . '/assets/img/counter/7/counter-icon-shape-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
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
                        <div class="counter__content-7">
                           <h4><span data-purecounter-duration="1" data-purecounter-end="<?php echo tp_kses($item['tp_fact_number' ]); ?>"  class="purecounter tp-el-box-number">0</span><?php echo tp_kses($item['tp_fact_number_unit']);?></h4>
                           <p class="tp-el-box-title"><?php echo tp_kses($item['tp_fact_title' ]); ?></p>
                        </div>
                     </div>
                  </div>
                  <?php endforeach; ?>
               </div>
            </div>
         </section>
         <!-- counter area end -->

        <?php elseif ( $settings['tp_design_style']  == 'layout-7' ): 
            $bloginfo = get_bloginfo( 'name' );
            $this->add_render_attribute('title_args', 'class', 'section__title-7 tp-el-title');    
        ?>

         <!-- counter area start -->
         <section class="counter__area counter__border-8 black-bg-12 pt-125 pb-80 tp-el-section">
            <div class="container">
               <div class="row">
                    <?php 
                    foreach ($settings['tp_fact_list'] as $key => $item) :  
                    ?>
                  <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                     <div class="counter__item-8 mb-40 wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s">
                        <div class="counter__content-8 d-flex align-items-center">
                           <h4 class="tp-el-box-number"><span data-purecounter-duration="1" data-purecounter-end="<?php echo tp_kses($item['tp_fact_number' ]); ?>"  class="purecounter">0</span><?php echo tp_kses($item['tp_fact_number_unit']);?></h4>
                           <p class="tp-el-box-title"><?php echo tp_kses($item['tp_fact_title' ]); ?></p>
                        </div>
                     </div>
                  </div>
                  <?php endforeach; ?>
               </div>
            </div>
         </section>
         <!-- counter area end -->

        <?php elseif ( $settings['tp_design_style']  == 'layout-8' ): 
            $bloginfo = get_bloginfo( 'name' );
            $this->add_render_attribute('title_args', 'class', 'section__title-7 tp-el-title');    
        ?>

         <!-- counter area start -->
         <section class="counter__area p-relative z-index-1 tp-el-section">
            <?php if(!empty($settings['fact_overlay_switch'])) : ?>
            <div class="counter__overlay-10"></div>
            <?php endif; ?>
            <div class="container">
               <div class="counter__inner-10 tp-el-box">
                    <?php if(!empty($settings['fact_shape_switch'])) : ?>
                    <div class="counter__inner-10-shape include-bg" data-background="<?php echo get_template_directory_uri() . '/assets/img/counter/10/counter-shape-1.png' ?>"></div>
                    <?php endif; ?>

                    <div class="row">
                    <?php foreach ($settings['tp_fact_list'] as $key => $item) : ?>
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                            <div class="counter__item-10 text-center mb-30 wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s">
                            <div class="counter__content-10">
                                <h4 class="tp-el-box-number"><span data-purecounter-duration="1" data-purecounter-end="<?php echo tp_kses($item['tp_fact_number' ]); ?>"  class="purecounter">0</span><?php echo tp_kses($item['tp_fact_number_unit']);?></h4>
                                <p class="tp-el-box-title"><?php echo tp_kses($item['tp_fact_title' ]); ?></p>
                            </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
               </div>
            </div>
         </section>
         <!-- counter area end -->



		<?php else: 
            $bloginfo = get_bloginfo( 'name' );
        ?>	
        <!-- counter area start -->
         <section class="counter__area counter__border pb-110 tp-el-section">
            <div class="container">
               <div class="counter__inner black-bg fix tp-el-box">
                <?php if(!empty($settings['fact_shape_switch'])) : ?>
                <div class="counter__shape">
                    <img class="counter__shape-1 wow fadeInDown" data-wow-duration="1s" data-wow-delay=".3s" src="<?php echo get_template_directory_uri() . '/assets/img/counter/counter-shape-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                    <img class="counter__shape-2 wow fadeInDown" data-wow-duration="1s" data-wow-delay=".7s" src="<?php echo get_template_directory_uri() . '/assets/img/counter/counter-shape-2.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                    <img class="counter__shape-3 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".7s" src="<?php echo get_template_directory_uri() . '/assets/img/counter/counter-shape-3.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                    <img class="counter__shape-4 wow fadeInUp" data-wow-duration="1s" data-wow-delay="1.2s" src="<?php echo get_template_directory_uri() . '/assets/img/counter/counter-shape-4.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">

                    <img class="counter__shape-5 wow fadeInLeft" data-wow-duration="1s" src="<?php echo get_template_directory_uri() . '/assets/img/counter/counter-shape-circle-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                    <img class="counter__shape-6 wow fadeInRight" data-wow-duration="1s" src="<?php echo get_template_directory_uri() . '/assets/img/counter/counter-shape-circle-2.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">

                    <img class="counter__shape-7 wow fadeInUp" data-wow-duration="1s" src="<?php echo get_template_directory_uri() . '/assets/img/counter/counter-shape-line-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                    <img class="counter__shape-8 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s" src="<?php echo get_template_directory_uri() . '/assets/img/counter/counter-shape-line-2.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                    <img class="counter__shape-9 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".7s" src="<?php echo get_template_directory_uri() . '/assets/img/counter/counter-shape-line-3.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                  </div>
                  <?php endif; ?>
                  <div class="row justify-content-center">
                    <?php 
                        foreach ($settings['tp_fact_list'] as $key => $item) :  
                    ?>
                    <div class="col-xxl-4 col-xl-4 col-lg-4">
                        <div class="counter__item">
                            <div class="counter__content">
                                <p class="tp-el-box-title"><?php echo tp_kses($item['tp_fact_title' ]); ?></p>
                                <?php if (!empty($item['tp_fact_number' ])): ?>
                                <h3 class="counter__title tp-el-box-number"><span data-purecounter-duration="1" data-purecounter-end="<?php echo tp_kses($item['tp_fact_number' ]); ?>"  class="purecounter">0</span><?php echo tp_kses($item['tp_fact_number_unit']);?></h3>
                                <?php endif; ?> 
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                  </div>
               </div>
            </div>
         </section>

        <?php endif; ?>

        <?php 
	}
}

$widgets_manager->register( new TP_Fact() );