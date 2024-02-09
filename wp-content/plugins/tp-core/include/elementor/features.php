<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Features extends Widget_Base {

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
		return 'features';
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
		return __( 'Features', 'tpcore' );
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->tp_section_title_render_controls('features', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.');

        // Service group
        $this->start_controls_section(
            'tp_features',
            [
                'label' => esc_html__('Features List', 'tpcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
         'features_shape_switch',
            [
                'label'        => esc_html__( 'Features Shape Switch', 'tpcore' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'tpcore' ),
                'label_off'    => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition' => [
                    'tp_design_style' => ['layout-1', 'layout-2']
                ]

            ]
        );

        $this->add_control(
         'features_translate',
         [
           'label'        => esc_html__( 'Translate Content -50?', 'Text-domain' ),
           'type'         => \Elementor\Controls_Manager::SWITCHER,
           'label_on'     => esc_html__( 'Show', 'Text-domain' ),
           'label_off'    => esc_html__( 'Hide', 'Text-domain' ),
           'return_value' => 'yes',
           'default'      => 'yes',
           'condition' => [
                'tp_design_style' => ['layout-3']
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
                    'repeater_condition' => ['style_1', 'style_2'],
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
                    'repeater_condition' => ['style_1', 'style_2'],
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
                    'repeater_condition' => ['style_1', 'style_2'],
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
                        'repeater_condition' => ['style_1', 'style_2'],
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
                        'repeater_condition' => ['style_1', 'style_2'],
                    ]
                ]
            );
        }

        $repeater->add_control(
            'tp_features_title', [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Service Title', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_features_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered.',
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
            'features_border_color',
            [
                'label'       => esc_html__( 'Features Border Color', 'tpcore' ),
                'type'     => \Elementor\Controls_Manager::COLOR,
                'selectors' => ['{{WRAPPER}} {{CURRENT_ITEM}}::after' => 'background-color: {{VALUE}}'],
                'default' => '#5EB74B',
                'condition' => ['want_customize' => 'yes'],
            ]
        );


        $repeater->add_control(
            'features_icon_color',
            [
                'label' => esc_html__( 'Features Icon Color', 'tp-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .features__icon span' => 'color: {{VALUE}} !important',
                ],
                'condition' => ['want_customize' => 'yes'],
            ]
        );
        $repeater->add_control(
            'features_link_color',
            [
                'label' => esc_html__( 'Features Button Color', 'tp-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .features__btn a' => 'color: {{VALUE}} !important',
                ],
                'condition' => ['want_customize' => 'yes'],
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
            'tp_features_btn_text',
            [
                'label' => esc_html__('Button Text', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'tpcore'),
                'title' => esc_html__('Enter button text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_features_link_switcher' => 'yes',
                    'repeater_condition' => ['style_1'],
                ],
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
                'label' => esc_html__( 'Features Link link', 'tpcore' ),
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
                'label' => esc_html__( 'Select Service Link Page', 'tpcore' ),
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
                        'tp_features_title' => esc_html__('Business Stratagy', 'tpcore'),
                    ],
                    [
                        'tp_features_title' => esc_html__('Website Development', 'tpcore')
                    ],
                    [
                        'tp_features_title' => esc_html__('Marketing & Reporting', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_features_title }}}',
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

        // colum controls
        $this->tp_columns('col');
	}

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('services_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('services_subtitle', 'Section - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('services_title', 'Section - Title', '.tp-el-title');
        $this->tp_basic_style_controls('services_description', 'Section - Description', '.tp-el-content p');

        $this->tp_section_style_controls('services_box', 'Features - Box', '.tp-el-box');
        $this->tp_basic_style_controls('services_box_title', 'Features - Box - Title', '.tp-el-box-title');
        $this->tp_basic_style_controls('services_box_description', 'Features - Box - Description', '.tp-el-box-desc');
        $this->tp_link_controls_style('services_box_link_btn', 'Features - Box - Button', '.tp-el-box-btn');

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

		<?php if ( $settings['tp_design_style']  == 'layout-2' ) : 
            $this->add_render_attribute('title_args', 'class', 'section__title-6 tp-el-title');    
        ?>


         <!-- features area start -->
         <section class="features__area p-relative z-index-1 grey-bg-7 pt-110 pb-90 tp-el-section">

         <?php if(!empty($settings['features_shape_switch'])) : ?>
            <div class="features__shape">
               <img class="features__shape-1" src="<?php echo get_template_directory_uri() . '/assets/img/features/features-shape-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="features__shape-2" src="<?php echo get_template_directory_uri() . '/assets/img/features/features-shape-2.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="features__shape-3" src="<?php echo get_template_directory_uri() . '/assets/img/features/features-shape-3.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="features__shape-4" src="<?php echo get_template_directory_uri() . '/assets/img/features/features-shape-4.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="features__shape-5" src="<?php echo get_template_directory_uri() . '/assets/img/features/features-shape-5.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
            </div>
            <?php endif; ?>

            <div class="container">
                <?php if ( !empty($settings['tp_features_section_title_show']) ) : ?>
               <div class="row justify-content-center">
                  <div class="col-xxl-6 col-xl-7 col-lg-7">
                     <div class="section__title-wrapper-6 mb-60 text-center tp-el-content">

                        <?php if(!empty($settings['tp_features_sub_title'])): ?>
                        <span class="section__title-pre-6 tp-el-subtitle"><?php echo tp_kses($settings['tp_features_sub_title']); ?></span>
                        <?php endif; ?>

                        <?php
                            if ( !empty($settings['tp_features_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['tp_features_title_tag'] ),
                                    $this->get_render_attribute_string( 'title_args' ),
                                    tp_kses( $settings['tp_features_title' ] )
                                    );
                            endif;
                        ?>

                        <?php if ( !empty($settings['tp_features_description']) ) : ?>
                        <p><?php echo tp_kses( $settings['tp_features_description'] ); ?></p>
                        <?php endif; ?>

                     </div>
                  </div>
               </div>
               <?php endif; ?>

               <div class="row">
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
                  <div class="col-xl-<?php echo esc_attr($settings['tp_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['tp_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['tp_col_for_tablet']); ?> col-<?php echo esc_attr($settings['tp_col_for_mobile']); ?>">
                     <div class="features__item transition-3 mb-30 wow fadeInUp tp-el-box elementor-repeater-item-<?php echo esc_attr($item['_id']); ?>" data-wow-delay=".3s" data-wow-duration="1s">
                        <div class="features__icon tp-el-box-icon">
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
                        <div class="features__content">
                           <?php if (!empty($item['tp_features_title' ])): ?>
                            <h3 class="features__title tp-el-box-title">
                                <?php if ($item['tp_features_link_switcher'] == 'yes') : ?>
                                <a href="<?php echo esc_url($link); ?>"><?php echo tp_kses($item['tp_features_title' ]); ?></a>
                                <?php else : ?>
                                    <?php echo tp_kses($item['tp_features_title' ]); ?>
                                <?php endif; ?>
                            </h3>
                            <?php endif; ?>
                            <?php if (!empty($item['tp_features_description' ])): ?>
                            <p class="tp-el-box-desc"><?php echo tp_kses($item['tp_features_description']); ?></p>
                            <?php endif; ?>

                            <?php if (!empty($link)) : ?>
                           <div class="features__btn">
                              <a class="tp-el-box-btn" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>">
                                 <svg width="45" height="44" viewBox="0 0 45 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M43.999 22.1553H1.57262" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M33.6991 32.451L43.998 22.002L33.549 11.703" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 </svg>                                                                      
                              </a>
                           </div>
                           <?php endif; ?>                            
                        </div>
                     </div>
                  </div>
                  <?php endforeach; ?>
               </div>
            </div>
         </section>
         <!-- features area end -->

        <?php elseif ( $settings['tp_design_style']  == 'layout-3' ) : 
            $this->add_render_attribute('title_args', 'class', 'section__title-6 tp-el-title');    

            $features_translate = $settings['features_translate'] == 'yes' ? 'is-translate-50' : '';
        ?>

        <!-- features area start -->
        <section class="features__area">
         <div class="container">
            <div class="features__wrapper-15 <?php echo esc_attr($features_translate); ?> white-bg">
               <div class="row gx-0">
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
                  <div class="col-xl-<?php echo esc_attr($settings['tp_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['tp_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['tp_col_for_tablet']); ?> col-<?php echo esc_attr($settings['tp_col_for_mobile']); ?>">
                     <div class="features__item-15 text-center wow fadeInUp tp-el-box" data-wow-delay=".3s" data-wow-duration="1s">
                        <div class="features__icon-15 mb-40 tp-el-box-icon">
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
                        <div class="features__content-15">
                           <?php if (!empty($item['tp_features_title' ])): ?>
                            <h3 class="features__title-15 tp-el-box-title">
                                <?php if ($item['tp_features_link_switcher'] == 'yes') : ?>
                                <a href="<?php echo esc_url($link); ?>"><?php echo tp_kses($item['tp_features_title' ]); ?></a>
                                <?php else : ?>
                                    <?php echo tp_kses($item['tp_features_title' ]); ?>
                                <?php endif; ?>
                            </h3>
                            <?php endif; ?>

                           <?php if (!empty($item['tp_features_description' ])): ?>
                            <p class="tp-el-box-desc"><?php echo tp_kses($item['tp_features_description']); ?></p>
                            <?php endif; ?>
                        </div>
                     </div>
                  </div>
                  <?php endforeach; ?>
               </div>
            </div>
         </div>
        </section>
        <!-- features area end -->

		<?php else: 
            $bloginfo = get_bloginfo( 'name' );
            $this->add_render_attribute('title_args', 'class', 'section__title-7 tp-el-title');    
        ?>

         <!-- features area start -->
         <section class="features__area p-relative z-index-1 pt-125 tp-el-section">
         <?php if(!empty($settings['features_shape_switch'])) : ?>
            <div class="features__shape">
               <img class="features__shape-6" src="<?php echo get_template_directory_uri() . '/assets/img/features/7/features-shape-2.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
            </div>
            <?php endif; ?>

            <div class="container">
            <?php if ( !empty($settings['tp_features_section_title_show']) ) : ?>
               <div class="row justify-content-center">
                  <div class="col-xxl-7 col-xl-8 col-lg-9">
                     <div class="section__title-wrapper-7 text-center mb-60 tp-el-content">
                            <?php if(!empty($settings['tp_features_sub_title'])): ?>
                            <span class="section__title-pre-7 tp-el-subtitle"><?php echo tp_kses($settings['tp_features_sub_title']); ?></span>
                            <?php endif; ?>
                           <?php
                                if ( !empty($settings['tp_features_title' ]) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['tp_features_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        tp_kses( $settings['tp_features_title' ] )
                                        );
                                endif;
                            ?>

                            <?php if ( !empty($settings['tp_features_description']) ) : ?>
                            <p><?php echo tp_kses( $settings['tp_features_description'] ); ?></p>
                            <?php endif; ?>

                     </div>
                  </div>
               </div>
               <?php endif; ?>

               <div class="row">
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
                  <div class="col-xl-<?php echo esc_attr($settings['tp_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['tp_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['tp_col_for_tablet']); ?> col-<?php echo esc_attr($settings['tp_col_for_mobile']); ?>">
                     <div class="features__item-7 text-center mb-20 white-bg transition-3 wow fadeInUp tp-el-box" data-wow-delay=".3s" data-wow-duration="1s">

                        <div class="features__icon-7 tp-el-box-icon">
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

                        <div class="features__content-7">
                            <?php if (!empty($item['tp_features_title' ])): ?>
                            <h3 class="features__title-7 tp-el-box-title">
                                <?php if ($item['tp_features_link_switcher'] == 'yes') : ?>
                                <a href="<?php echo esc_url($link); ?>"><?php echo tp_kses($item['tp_features_title' ]); ?></a>
                                <?php else : ?>
                                    <?php echo tp_kses($item['tp_features_title' ]); ?>
                                <?php endif; ?>
                            </h3>
                            <?php endif; ?>


                            <?php if (!empty($item['tp_features_description' ])): ?>
                            <p class="tp-el-box-desc"><?php echo tp_kses($item['tp_features_description']); ?></p>
                            <?php endif; ?>

                            <?php if (!empty($link)) : ?>
                            <div class="features__btn-7">
                                <a class="tp-link-btn-3 tp-el-box-btn" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>">
                                <?php echo tp_kses($item['tp_features_btn_text']); ?>
                                    <span> 
                                        <i class="fa-regular fa-arrow-right"></i>
                                    </span>
                                </a>
                            </div>
                            <?php endif; ?>                              
                        </div>
                     </div>
                  </div>
                  <?php endforeach; ?>
               </div>

            </div>
         </section>
         <!-- features area end -->
        <?php endif; ?>

        <?php
	}
}

$widgets_manager->register( new TP_Features() );
