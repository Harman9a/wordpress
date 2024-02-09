<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Utils;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Advanced_Tab extends Widget_Base {

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
		return 'advanced-tab';
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
		return __( 'Advanced Tab', 'tpcore' );
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->add_control(
         'enable_style_2',
         [
           'label'        => esc_html__( 'Enable Style 2', 'tpcore' ),
           'type'         => \Elementor\Controls_Manager::SWITCHER,
           'label_on'     => esc_html__( 'Show', 'tpcore' ),
           'label_off'    => esc_html__( 'Hide', 'tpcore' ),
           'return_value' => 'yes',
           'default'      => 'no',
           'condition' => [
                'tp_design_style' => 'layout-3'
           ]
         ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
         'tp_services_sec',
             [
               'label' => esc_html__( 'Title', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
               'condition' => [
                    'tp_design_style' => ['layout-4']
                ]
             ]
        );
        
        $this->add_control(
        'tp_services_tab_title',
            [
                'label'       => esc_html__( 'Title', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Our Services', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            'tp_about_section_title',
            [
                'label' => esc_html__('Section Title', 'tpcore'),
                'condition' => [
                    'tp_design_style' => ['layout-2', 'layout-3']
                ]
            ]
        );
        $this->add_control(
            'tp_about_section_title_show',
            [
                'label' => esc_html__( 'Section Title & Content', 'tpcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tpcore' ),
                'label_off' => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'tp_about_sub_title',
            [
                'label' => esc_html__('Sub Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Sub title',
                'placeholder' => esc_html__('Type Before Heading Text', 'tpcore'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'tp_about_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Section Title Here',
                'placeholder' => esc_html__('Type Heading Text', 'tpcore'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'tp_about_title_tag',
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

        $this->add_control(
            'tp_about_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Nulla quis lorem ut libero malesuada feugiat vivamus suscipit tortor eget felis porttitor volutpat.',
                'placeholder' => esc_html__('Type section description here', 'tpcore'),
            ]
        );
        $this->add_responsive_control(
            'tp_about_align',
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

        // _tp_image
        $this->start_controls_section(
            '_tp_image_section',
            [
                'label' => esc_html__('BG Image', 'tp-core'),
                'condition' => [
                    'tp_design_style' => ['layout-2']
                ]
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
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tp_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ],
                'condition' => [
                    'tp_design_style' => ['layout-2']
                ]
            ]
        );
        $this->end_controls_section();

        $this->tp_button_render('about', 'About Button', ['layout-2'] );
        $this->tp_button_render('about_2', 'About Button 2', ['layout-2'] );

        $this->start_controls_section(
         'adt_shape_switch_sec',
             [
               'label' => esc_html__( 'Shape On/Off', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
               'condition' => [
                'tp_design_style' => ['layout-1', 'layout-3']
               ]
             ]
        );
        $this->add_control(
          'adt_shape_switch',
          [
            'label'        => esc_html__( 'Enable Shape', 'tpcore' ),
            'type'         => \Elementor\Controls_Manager::SWITCHER,
            'label_on'     => esc_html__( 'Show', 'tpcore' ),
            'label_off'    => esc_html__( 'Hide', 'tpcore' ),
            'return_value' => 'yes',
            'default'      => 'yes',
          ]
        );
        
        
        $this->end_controls_section();

		$this->start_controls_section(
            '_section_price_tabs',
            [
                'label' => __('Advanced Tabs', 'tpcore'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

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
                  'repeater_condition' => ['style_2'],
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
                  'repeater_condition' => ['style_2'],
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
                  'repeater_condition' => ['style_2'],
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
                      'repeater_condition' => ['style_2'],
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
                      'repeater_condition' => ['style_2'],
                  ]
              ]
          );
      }

        $repeater->add_control(
            'title',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __('Title', 'tpcore'),
                'default' => __('Tab Title', 'tpcore'),
                'placeholder' => __('Type Tab Title', 'tpcore'),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'active_tab',
            [
                'label' => __('Is Active Tab?', 'tpcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'tpcore'),
                'label_off' => __('No', 'tpcore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'frontend_available' => true,
            ]
        );

        $repeater->add_control(
            'template',
            [
                'label' => __('Section Template', 'tpcore'),
                'placeholder' => __('Select a section template for as tab content', 'tpcore'),
  
                'type' => Controls_Manager::SELECT2,
                'options' => get_elementor_templates()
            ]
        );

        $this->add_control(
            'tabs',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{title}}',
                'default' => [
                    [
                        'title' => 'Tab 1',
                    ],
                    [
                        'title' => 'Tab 2',
                    ]
                ]
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
	}

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('fact_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('about_subtitle', 'Section - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('about_title', 'Section - Title', '.tp-el-title');
        $this->tp_basic_style_controls('about_description', 'Section - Description', '.tp-el-content p');

        $this->tp_link_controls_style('about_tab_btn', 'Tab - Button', '.tp-el-tab-btn');
        $this->tp_section_style_controls('about_tab_btn_line', 'Tab - Line', '.tp-el-tab-line');

        $this->tp_link_controls_style('about_box_btn', 'Box - Button', '.tp-el-box-btn');
        $this->tp_link_controls_style('about_box_btn_2', 'Box - Button 2', '.tp-el-box-btn-2');

        $this->tp_section_style_controls('tab_slide', 'Tab - Slide', '.tp-el-tab-slide');
        $this->tp_link_controls_style('tab_item', 'Tab - Item', '.tp-el-box-title');
        $this->tp_link_controls_style('tab_item_active', 'Tab - Item Active', '.tp-el-box-title.active');
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
            $this->add_render_attribute('title_args', 'class', 'section__title-3 has-gradient tp-el-title');

            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }

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

            // btn Link
            if ('2' == $settings['tp_about_2_btn_link_type']) {
                $link2 = get_permalink($settings['tp_about_2_btn_page_link']);
                $target2 = '_self';
                $rel2 = 'nofollow';
            } else {
                $link2 = !empty($settings['tp_about_2_btn_link']['url']) ? $settings['tp_about_2_btn_link']['url'] : '';
                $target2 = !empty($settings['tp_about_2_btn_link']['is_external']) ? '_blank' : '';
                $rel2 = !empty($settings['tp_about_2_btn_link']['nofollow']) ? 'nofollow' : '';
            }

        ?>

         <!-- about area start -->
         <section class="about__area black-bg-5 pt-170 pb-195 tp-el-section">
            <div class="container">
               <div class="row">
                  <div class="col-xl-5 col-lg-6">

                     <div class="about__thumb-3 w-img wow">
                        <img class="about-3-main-thumb wow" src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                     </div>

                  </div>
                  <div class="col-xl-7 col-lg-6">
                     <div class="about__wrapper-3 pt-20 pl-100">
                        <?php if ( !empty($settings['tp_about_section_title_show']) ) : ?>
                        <div class="section__title-wrapper-3 mb-45 tp-el-content">
                            <?php if (!empty($settings['tp_about_sub_title'])) : ?>
                            <span class="section__title-pre-3 tp-el-subtitle"><?php echo tp_kses( $settings['tp_about_sub_title'] ); ?></span>
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
                        
                            <?php if (!empty($settings['tp_about_description'])) : ?>
                            <p><?php echo tp_kses( $settings['tp_about_description'] ); ?></p>
                            <?php endif; ?> 
                        </div>
                        <?php endif; ?>
                        
                            

                        <div class="about__tab">
                           <div class="about__tab-nav">
                              <nav>
                                    <div class="about__tab-inner nav tp-tab-menu d-flex flex-sm-nowrap flex-wrap" id="nav-tab" role="tablist">
                                    <?php foreach ($settings['tabs'] as $key => $tab):
                                        $active = ($key == 0) ? 'active' : '';
                                    ?>
                                       <button class="nav-link tp-el-tab-btn <?php echo esc_attr($active); ?>" id="nav-self-tab-<?php echo esc_attr($key); ?>" data-bs-toggle="tab" data-bs-target="#nav-self-<?php echo esc_attr($key); ?>" type="button" role="tab" aria-controls="nav-self-<?php echo esc_attr($key); ?>" aria-selected="true"><?php echo tp_kses($tab['title']); ?>
                                        </button>
                                       <?php endforeach; ?>
                                       <span id="marker" class="tp-tab-line d-none d-sm-inline-block tp-el-tab-line"></span>
                                    </div>
                               </nav>                               
                           </div>
                           <div class="about__tab-content">
                              <div class="tab-content" id="nav-tabContent">
                                <?php foreach ($settings['tabs'] as $key => $tab):
                                    $active = ($key == 0) ? 'show active' : '';
                                ?>
                                <div class="tab-pane fade <?php echo esc_attr($active); ?>" id="nav-self-<?php echo esc_attr($key); ?>" role="tabpanel" aria-labelledby="nav-self-tab-<?php echo esc_attr($key); ?>">
                                    <?php echo \Elementor\Plugin::instance()->frontend->get_builder_content($tab['template'], true); ?>
                                </div>
                                 <?php endforeach; ?>
                              </div>

                              <div class="about__btn-3 d-sm-flex">
                                    <?php if (!empty($link)) : ?>
                                    <div class="about__btn-3-inner mb-20">
                                        <a href="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>" class="tp-btn-2 tp-el-box-btn"><?php echo tp_kses($settings['tp_about_btn_text']); ?></a>
                                    </div>
                                 <?php endif; ?> 

                                 <?php if (!empty($link2)) : ?>
                                 <div class="about__btn-3-inner mb-20">
                                    <a href="<?php echo esc_attr($target2); ?>" rel="<?php echo esc_attr($rel2); ?>" href="<?php echo esc_url($link2); ?>" class="tp-btn-border-3  tp-el-box-btn-2"><?php echo tp_kses($settings['tp_about_2_btn_text']); ?></a>
                                 </div>
                                 <?php endif; ?> 
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- about area end -->

         <?php elseif ( $settings['tp_design_style']  == 'layout-3' ): 
            $this->add_render_attribute('title_args', 'class', 'section__title-7 tp-el-title');
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

            if($settings['enable_style_2'] == 'yes'){
                $enable_style_2 = 'faq__style-3';
            }else{
                $enable_style_2 = '';
            }

        ?>
         <!-- faq area start -->
         <section class="faq__area <?php echo esc_attr($enable_style_2); ?> p-relative z-index-1 pt-120 pb-120 tp-el-section">

         <?php if(!empty($settings['adt_shape_switch'])) : ?>
            <div class="faq__shape">
               <img class="faq__shape-1" src="<?php echo get_template_directory_uri() . '/assets/img/faq/faq-shape-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
            </div>
          <?php endif; ?>
            <div class="container">
               <div class="row">
                  <div class="col-xxl-5 col-xl-5 col-lg-6">
                     <div class="faq__wrapper">
                     <?php if ( !empty($settings['tp_about_section_title_show']) ) : ?>

                        <div class="section__title-wrapper-7 mb-60 tp-el-content">
                            <?php if (!empty($settings['tp_about_sub_title'])) : ?>
                            <span class="section__title-pre-7 tp-el-subtitle"><?php echo tp_kses( $settings['tp_about_sub_title'] ); ?></span>
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

                            <?php if (!empty($settings['tp_about_description'])) : ?>
                            <p><?php echo tp_kses( $settings['tp_about_description'] ); ?></p>
                            <?php endif; ?> 
                        </div>
                        <?php endif; ?>
                        <div class="faq__tab tp-tab pr-200">
                           <nav>
                              <div class="nav nav-tabs flex-column" id="nav-tab" role="tablist">
                              <?php foreach ($settings['tabs'] as $key => $tab):
                                        $active = ($key == 0) ? 'active' : '';
                                    ?>
                                 <button class="nav-link tp-el-box-title <?php echo esc_attr($active); ?>" id="nav-general-tab-<?php echo esc_attr($key); ?>" data-bs-toggle="tab" data-bs-target="#nav-general-<?php echo esc_attr($key); ?>" type="button" role="tab" aria-controls="nav-general-<?php echo esc_attr($key); ?>" aria-selected="true">
                                    <?php if($tab['tp_box_icon_type'] == 'icon') : ?>
                                      <?php if (!empty($tab['tp_box_icon']) || !empty($tab['tp_box_selected_icon']['value'])) : ?>
                                              <span class=""><?php tp_render_icon($tab, 'tp_box_icon', 'tp_box_selected_icon'); ?></span>
                                      <?php endif; ?>
                                      <?php elseif( $tab['tp_box_icon_type'] == 'image' ) : ?>
                                      <span>
                                          <?php if (!empty($tab['tp_box_icon_image']['url'])): ?>
                                          <img src="<?php echo $tab['tp_box_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($tab['tp_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                          <?php endif; ?>
                                      </span>
                                    <?php else : ?>
                                      <span>
                                          <?php if (!empty($tab['tp_box_icon_svg'])): ?>
                                          <?php echo $tab['tp_box_icon_svg']; ?>
                                          <?php endif; ?>
                                      </span>
                                    <?php endif; ?>

                                    <?php echo tp_kses($tab['title']); ?>
                                 </button>
                                 <?php endforeach; ?>
                              </div>
                           </nav>
                        </div>
                     </div>
                  </div>
                  <div class="col-xxl-7 col-xl-7 col-lg-6">
                     <div class="faq__tab-content tp-accordion">
                        <div class="tab-content" id="nav-tabContent">
                            <?php foreach ($settings['tabs'] as $key => $tab):
                                $active = ($key == 0) ? 'show active' : '';
                            ?>
                           <div class="tab-pane fade <?php echo esc_attr($active); ?>" id="nav-general-<?php echo esc_attr($key); ?>" role="tabpanel" aria-labelledby="nav-general-tab-<?php echo esc_attr($key); ?>">
                           <?php echo \Elementor\Plugin::instance()->frontend->get_builder_content($tab['template'], true); ?>
                           </div>
                           <?php endforeach; ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- faq area end -->

         <?php elseif ( $settings['tp_design_style']  == 'layout-4' ): 
            $this->add_render_attribute('title_args', 'class', 'section__title-7 tp-el-title');
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

         <!-- services area start -->
         <section class="services__area pt-95 pb-90 tp-el-section">
            <div class="container">
               <div class="row">
                  <div class="col-xl-3 col-lg-4">
                     <div class="services__widget">
                        <div class="services__widget-item">
                            <?php if(!empty($settings['tp_services_tab_title'])) : ?>
                           <h3 class="services__widget-title tp-el-title"><?php echo tp_kses($settings['tp_services_tab_title']); ?></h3>
                                <?php endif; ?>
                           <div class="services__widget-content">
                              <div class="services__widget-tab tp-tab">
                                 <ul class="nav nav-tabs flex-column" id="servicesTab" role="tablist">
                                 <?php foreach ($settings['tabs'] as $key => $tab):
                                        $active = ($key == 0) ? 'active' : '';
                                    ?>
                                    <li class="nav-item" role="presentation">
                                      <button class="nav-link tp-el-box-title <?php echo esc_attr($active); ?>" id="responsive-tab-<?php echo esc_attr($key); ?>" data-bs-toggle="tab" data-bs-target="#responsive-<?php echo esc_attr($key); ?>" type="button" role="tab" aria-controls="responsive-<?php echo esc_attr($key); ?>" aria-selected="true"><?php echo tp_kses($tab['title']); ?> 
                                        <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1 11L6 6L1 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                       </button>
                                    </li>
                                    <?php endforeach; ?>
                                  </ul>                          

                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-9 col-lg-8">
                     <div class="services__tab-right">
                        <div class="tab-content" id="myTabContent">
                            <?php foreach ($settings['tabs'] as $key => $tab):
                                $active = ($key == 0) ? 'show active' : '';
                            ?>
                           <div class="tab-pane fade <?php echo esc_attr($active); ?>" id="responsive-<?php echo esc_attr($key); ?>" role="tabpanel" aria-labelledby="responsive-tab-<?php echo esc_attr($key); ?>">
                           <?php echo \Elementor\Plugin::instance()->frontend->get_builder_content($tab['template'], true); ?>
                           </div>
                           <?php endforeach; ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- services area end -->

         <?php elseif ( $settings['tp_design_style']  == 'layout-5' ): 
            $this->add_render_attribute('title_args', 'class', 'section__title-7 tp-el-title');
            $bloginfo = get_bloginfo( 'name' );  

        ?>

         <!-- faq area start -->
         <section class="faq__area pt-100 pb-25 tp-el-section">
            <div class="container">
               <div class="row">
                  <div class="col-xxl-12">
                     <div class="faq__tab-2 tp-tab mb-50">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <?php foreach ($settings['tabs'] as $key => $tab):
                                $active = ($key == 0) ? 'active' : '';
                            ?>
                           <li class="nav-item" role="presentation">
                                <button class="nav-link tp-el-box-title <?php echo esc_attr($active); ?>" id="general-tab-<?php echo esc_attr($key); ?>" data-bs-toggle="tab" data-bs-target="#general-<?php echo esc_attr($key); ?>" type="button" role="tab" aria-controls="general-<?php echo esc_attr($key); ?>" aria-selected="true">
                                <?php if($tab['tp_box_icon_type'] == 'icon') : ?>
                                    <?php if (!empty($tab['tp_box_icon']) || !empty($tab['tp_box_selected_icon']['value'])) : ?>
                                            <span><?php tp_render_icon($tab, 'tp_box_icon', 'tp_box_selected_icon'); ?></span>
                                    <?php endif; ?>
                                    <?php elseif( $tab['tp_box_icon_type'] == 'image' ) : ?>
                                    <span>
                                        <?php if (!empty($tab['tp_box_icon_image']['url'])): ?>
                                        <img src="<?php echo $tab['tp_box_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($tab['tp_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                        <?php endif; ?>
                                    </span>
                                <?php else : ?>
                                    <span>
                                        <?php if (!empty($tab['tp_box_icon_svg'])): ?>
                                        <?php echo $tab['tp_box_icon_svg']; ?>
                                        <?php endif; ?>
                                    </span>
                                <?php endif; ?>
                                <?php echo tp_kses($tab['title']); ?>
                            </button>
                           </li>
                           <?php endforeach; ?>
                         </ul>                        
                     </div>
                  </div>
               </div>
               <div class="faq__item-wrapper">

                  <div class="tab-content" id="faqTabContent">
                    <?php foreach ($settings['tabs'] as $key => $tab):
                        $active = ($key == 0) ? 'show active' : '';
                    ?>
                     <div class="tab-pane fade <?php echo esc_attr($active); ?>" id="general-<?php echo esc_attr($key); ?>" role="tabpanel" aria-labelledby="general-tab-<?php echo esc_attr($key); ?>">
                     <?php echo \Elementor\Plugin::instance()->frontend->get_builder_content($tab['template'], true); ?>
                     </div>
                     <?php endforeach; ?>
                   </div>

               </div>
            </div>
         </section>
         <!-- faq area end -->
		<?php else: 
			$this->add_render_attribute('title_args', 'class', 'sectionTitle__big');
			$bloginfo = get_bloginfo( 'name' );
		?>

         <section class="pricing__area tp-el-price-agency p-relative z-index-1 tp-el-section">
         <?php if(!empty($settings['adt_shape_switch'])) : ?>
            <div class="pricing__shape">
               <img class="pricing__shape-2" src="<?php echo get_template_directory_uri() . '/assets/img/price/5/shape/price-shape-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="pricing__shape-3" src="<?php echo get_template_directory_uri() . '/assets/img/price/5/shape/price-shape-2.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="pricing__shape-4" src="<?php echo get_template_directory_uri() . '/assets/img/price/5/shape/price-shape-3.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="pricing__shape-5" src="<?php echo get_template_directory_uri() . '/assets/img/price/5/shape/price-shape-4.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
            </div>
            <?php endif; ?>
            <div class="container">
               <div class="row justify-content-center">
                  <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
                     <div class="pricing__tab-nav tp-tab mb-50 mx-auto">
                        <nav>
                           <div class="nav nav-tabs price-tab-slide justify-content-center" id="nav-tab" role=tablist>
                              <label for="price-tab-check" class="nav justify-content-center">
                              	<?php foreach ($settings['tabs'] as $key => $tab):
			                        	$active = ($key == 0) ? 'active' : '';
			                        ?>
                                 <span class="nav-link tp-el-box-title <?php echo esc_attr($active); ?>" id="nav-monthly-tab-<?php echo esc_attr($key); ?>" data-bs-toggle="tab" data-bs-target="#nav-monthly-<?php echo esc_attr($key); ?>" role="tab" aria-controls="nav-monthly-<?php echo esc_attr($key); ?>" aria-selected="true"><?php echo tp_kses($tab['title']); ?></span>
                                 <?php endforeach; ?>
                                    <input type="checkbox" id="price-tab-check">
                                    <i class="tp-el-tab-slide"></i>
                              </label>
                           </div>
                         </nav>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-xxl-12">
                     <div class="tab-content wow fadeInUp" id="nav-tabContent" data-wow-delay=".3s" data-wow-duration="1s">
						<?php foreach ($settings['tabs'] as $key => $tab):
                            $active = ($key == 0) ? 'show active' : '';
                        ?>
                        <div class="tab-pane fade <?php echo esc_attr($active); ?>" id="nav-monthly-<?php echo esc_attr($key); ?>" role="tabpanel" aria-labelledby="nav-monthly-tab-<?php echo esc_attr($key); ?>">
                        	<?php echo \Elementor\Plugin::instance()->frontend->get_builder_content($tab['template'], true); ?>
                        </div>
                        <?php endforeach; ?>
                     </div>
                  </div>
               </div>
            </div>
         </section>

	    <?php endif; ?>

		<?php
	}

}
$widgets_manager->register( new TP_Advanced_Tab() );