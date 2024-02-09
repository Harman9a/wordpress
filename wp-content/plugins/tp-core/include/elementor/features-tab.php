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
class TP_Features_Tab extends Widget_Base {

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
		return 'features-tab';
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
		return __( 'Features Tab', 'tp-core' );
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

        $this->tp_section_title_render_controls('features', 'Section Title', 'Sub Title', 'your title here', 'Hic nesciunt galisum aut dolorem');

        $this->start_controls_section(
            'tp_about_features_sec',
                [
                  'label' => esc_html__( 'Features List', 'tpcore' ),
                  'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
           );
           
        $this->add_control(
         'tp_features_shape_switch',
         [
           'label'        => esc_html__( 'Shape On/Off', 'tpcore' ),
           'type'         => \Elementor\Controls_Manager::SWITCHER,
           'label_on'     => esc_html__( 'Show', 'tpcore' ),
           'label_off'    => esc_html__( 'Hide', 'tpcore' ),
           'return_value' => 'yes',
           'default'      => 'yes',
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
                    'repeater_condition' => 'style_1'
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
            'tp_features_box_subtitle',
              [
                'label'   => esc_html__( 'Features Sub Title', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Business Strategy', 'tpcore' ),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => 'style_2'
                ]
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
                'condition' => [
                    'repeater_condition' => 'style_1'
                ]
              ]
            );
           
            $repeater->add_control(
            'tp_features_box_quote',
              [
                'label'   => esc_html__( 'Features Quote', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => esc_html__( 'Your total saving', 'tpcore' ),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => 'style_2'
                ]
              ]
            );

            $repeater->add_control(
             'tp_features_list_thumb_one',
             [
               'label'   => esc_html__( 'Upload Image', 'tpcore' ),
               'type'    => \Elementor\Controls_Manager::MEDIA,
                 'default' => [
                   'url' => \Elementor\Utils::get_placeholder_image_src(),
               ],
             ]
            );


            $repeater->add_control(
             'tp_features_list_thumb_two',
             [
               'label'   => esc_html__( 'Upload People', 'tpcore' ),
               'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                   'url' => \Elementor\Utils::get_placeholder_image_src(),
               ],
               'condition' => [
                    'repeater_condition' => 'style_1'
               ]
             ]
            );
            $repeater->add_control(
             'tp_features_list_thumb_three',
             [
               'label'   => esc_html__( 'Upload Image Three', 'tpcore' ),
               'type'    => \Elementor\Controls_Manager::MEDIA,
                 'default' => [
                   'url' => \Elementor\Utils::get_placeholder_image_src(),
               ],
                'condition' => [
                    'repeater_condition' => 'style_1'
                ]
             ]
            );

            $repeater->add_control(
             'tp_features_list_person_thumb',
             [
               'label'   => esc_html__( 'Upload People Image', 'tpcore' ),
               'type'    => \Elementor\Controls_Manager::MEDIA,
                 'default' => [
                   'url' => \Elementor\Utils::get_placeholder_image_src(),
               ],
                'condition' => [
                    'repeater_condition' => 'style_2'
                ]
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
                    'condition' => [
                        'repeater_condition' => 'style_1',

                    ]
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
                        'tp_features_link_switcher' => 'yes',
                        'repeater_condition' => 'style_1'
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
                        'repeater_condition' => 'style_1'
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
                        'repeater_condition' => 'style_1'
                    ]
                ]
            );
            
            $repeater->add_group_control(
                Group_Control_Image_Size::get_type(),
                [
                    'name' => 'thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                    'exclude' => ['custom'],
                    // 'default' => 'tp-post-thumb',
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
                'tp_features_align_',
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

	}

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('about_section', 'Section - Style', '.tp-el-section');
        $this->tp_section_style_controls('about_section_box', 'Box - Style', '.tp-el-box-inner');

        $this->tp_basic_style_controls('about_subtitle', 'Section - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('about_title', 'Section - Title', '.tp-el-title');
        $this->tp_basic_style_controls('about_description', 'Section - Description', '.tp-el-content p');

        $this->tp_section_style_controls('about_box', 'Item - Style', '.tp-el-box');

        $this->start_controls_section(
         'tp_features_box_img',
             [
               'label' => esc_html__( 'Image Gradient BG Color', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
             ]
        );
        

        $this->add_control(
            'tp_gradient_bg_color',
            [
                'label' => esc_html__('Background Color', 'tp-core'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'selectors' => [
                    '{{WRAPPER}} .tp-el-gradient-bg::after' => 'background: {{VALUE}};',
                ],
            ]
        );
        
        $this->end_controls_section();

        $this->tp_icon_style('section_icon', 'Features - Icon', '.tp-el-box-icon span');
		$this->tp_basic_style_controls('faq_title', 'Features - Title', '.tp-el-box-title');
		$this->tp_basic_style_controls('faq_description', 'Features - Description', '.tp-el-box-desc');
        $this->tp_link_controls_style('faq_btn', 'Features Button', '.tp-el-box-btn');

        

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
            $this->add_render_attribute('title_args', 'class', 'section__title-6 tp-el-title');
            $bloginfo = get_bloginfo( 'name' );
        ?>

         <!-- features area start -->
         <section class="features__area pt-140 pb-140 tp-el-section">
            <div class="container">
               <div class="row">
                  <div class="col-xl-4 col-lg-4 col-md-6">
                     <div class="features__wrapper-9 mr-30">
                        <?php foreach ($settings['tp_features_list'] as $key => $item) :
                            $active = $key == 0 ? 'active': '';
                        ?>
                        <div class="features__content-9 features-item-content tp-el-content tp-el-box <?php echo esc_attr($active); ?>" rel="features-img-<?php echo esc_attr($key); ?>">
                            <?php if(!empty($item['tp_features_box_subtitle'])): ?>
                            <span class="tp-el-subtitle"><?php echo $item['tp_features_box_subtitle'] ;?></span>
                            <?php endif; ?>

                            <?php if(!empty($item['tp_features_box_subtitle'])) :?>
                            <h3 class="features__title-9 tp-el-title"><?php echo $item['tp_features_box_title'] ;?></h3>
                            <?php endif; ?>

                            <?php if ( !empty($settings['tp_features_box_description']) ) : ?>
                            <p><?php echo tp_kses( $settings['tp_features_box_description'] ); ?></p>
                            <?php endif; ?>

                        </div>
                        <?php endforeach; ?>
                     </div>
                  </div>
                  <div class="col-xl-8 col-lg-8 col-md-6 d-none d-md-block">
                     <div class="features__thumb-wrapper-9 pl-20 tp-el-gradient-bg">

                        <div id="features-item-thumb" class="features-img-0">
                        <?php foreach ($settings['tp_features_list'] as $key => $item) :
                            $active = $key == 0 ? 'active': '';


                            if ( !empty($item['tp_features_list_thumb_one']['url']) ) {
                                $features_thumb_url = !empty($item['tp_features_list_thumb_one']['id']) ? wp_get_attachment_image_url( $item['tp_features_list_thumb_one']['id'], $item['thumbnail_size']) : $item['tp_features_list_thumb_one']['url'];
                                $features_thumb_alt = get_post_meta($item["tp_features_list_thumb_one"]["id"], "_wp_attachment_image_alt", true);
                            }

                            if ( !empty($item['tp_features_list_person_thumb']['url']) ) {
                                $tp_features_list_person_thumb_url = !empty($item['tp_features_list_person_thumb']['id']) ? wp_get_attachment_image_url( $item['tp_features_list_person_thumb']['id'], $settings['thumbnail_size']) : $item['tp_features_list_person_thumb']['url'];
                                $tp_features_list_person_thumb_alt = get_post_meta($item["tp_features_list_person_thumb"]["id"], "_wp_attachment_image_alt", true);
                            }
                        ?>
                           <div class="features__thumb-9 transition-3 features-img-<?php echo esc_attr($key); ?> <?php echo esc_attr($active); ?>">

                                <?php if(!empty($features_thumb_url)) :?>
                                <img src="<?php echo esc_url($features_thumb_url); ?>" alt="<?php echo esc_attr($features_thumb_alt); ?>">
                                <?php endif; ?>

                              <div class="features__thumb-9-content">
                                 <?php if(!empty($item['tp_features_box_quote'])) :?>
                                 <p class="tp-el-box-desc"><?php echo tp_kses($item['tp_features_box_quote']); ?></p>
                                 <?php endif; ?>

                                 <?php if(!empty($tp_features_list_person_thumb_url)) :?>
                                 <div class="features-users">
                                    <img src="<?php echo esc_url($tp_features_list_person_thumb_url); ?>" alt="<?php echo esc_attr($tp_features_list_person_thumb_alt); ?>">
                                 </div>
                                 <?php endif; ?>
                              </div>
                           </div>
                           <?php endforeach; ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- features area end -->

		<?php else:
            $bloginfo = get_bloginfo( 'name' );
            $this->add_render_attribute('title_args', 'class', 'section__title-7 tp-el-title');

		?>

         <!-- features list area start -->
         <section class="features__list-area tp-el-section">
            <div class="container">

               <div class="features__list-inner green-light-bg-4 pt-110 pb-135 pl-100 pr-100 p-relative z-index-1 tp-el-box-inner">

                <?php if(!empty($settings['tp_features_shape_switch'])) :?>
                <img class="features__shape-8" src="<?php echo get_template_directory_uri() . '/assets/img/features/7/features-shape-2.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                <?php endif; ?>

                <?php if ( !empty($settings['tp_features_section_title_show']) ) : ?>
                  <div class="row">
                     <div class="col-xxl-12">
                        <div class="section__title-wrapper-7 mb-85 tp-el-content">

                            <?php if ( !empty($settings['tp_features_sub_title']) ) : ?>
                            <span class="section__title-pre-7 tp-el-subtitle">
                                <?php echo tp_kses( $settings['tp_features_sub_title'] ); ?>
                            </span>
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
                     <div class="col-xxl-5 col-xl-5 col-lg-6">
                        <div class="features__list-wrapper tp-tab">
                           <ul class="nav nav-tabs" id="featuresTab" role="tablist">
                                <?php foreach ($settings['tp_features_list'] as $key => $item) :

                                    $active = $key == 0 ? 'show active': '';
                                    // Link
                                    if ('2' == $item['tp_features_link_type']) {
                                        $link = get_permalink($item['tp_features_page_link']);
                                        $target = '_self';
                                        $rel = 'nofollow';
                                    } else {
                                        $link = !empty($item['tp_features_link']['url']) ? $item['tp_features_link']['url'] : '';
                                        $target = !empty($item['tp_features_link']['is_external']) ? '_blank' : '_self';
                                        $rel = !empty($item['tp_features_link']['nofollow']) ? 'nofollow' : '';
                                    }
                                ?>
                              <li class="nav-item" role="presentation">
                                <div class="features__list-item white-bg transition-3 nav-link <?php echo esc_attr($active); ?>" id="customer-tab-<?php echo esc_attr($key); ?>" data-bs-toggle="tab" data-bs-target="#customer-<?php echo esc_attr($key); ?>" role="tab" aria-controls="customer-<?php echo esc_attr($key); ?>" aria-selected="true">
                                 <div class="features__list-item-wrapper d-sm-flex align-items-center justify-content-between white-bg tp-el-box transition-3">
                                    <div class="features__list-item-inner  d-sm-flex align-items-center">
                                       <div class="features__list-icon mr-20 tp-el-box-icon">
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
                                       <div class="features__list-content">

                                       <?php if (!empty($item['tp_features_box_title' ])): ?>
                                        <h3 class="features__list-title tp-el-box-title">
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
                                    <?php if (!empty($link)) : ?>
                                    <div class="features__list-btn">
                                       <a class="tp-link-btn-4 tp-el-box-btn" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>">
                                          <span>
                                             <i class="fa-regular fa-angle-right"></i>
                                          </span>
                                       </a>
                                    </div>
                                    <?php endif; ?> 
                                 </div>
                                </div>
                              </li>
                              <?php endforeach; ?>
                            </ul>
                        </div>
                     </div>
                     <div class="col-xxl-7 col-xl-7 col-lg-6">
                           <div class="tab-content" id="myTabContent">

                                <?php foreach ($settings['tp_features_list'] as $key => $item) : 

                                    $active = $key == 0 ? 'show active': '';
                                    
                                    if ( !empty($item['tp_features_list_thumb_one']['url']) ) {
                                        $features_thumb_url = !empty($item['tp_features_list_thumb_one']['id']) ? wp_get_attachment_image_url( $item['tp_features_list_thumb_one']['id'], $item['thumbnail_size']) : $item['tp_features_list_thumb_one']['url'];
                                        $features_thumb_alt = get_post_meta($item["tp_features_list_thumb_one"]["id"], "_wp_attachment_image_alt", true);
                                    }
                                    if ( !empty($item['tp_features_list_thumb_two']['url']) ) {
                                        $features_thumb_two_url = !empty($item['tp_features_list_thumb_two']['id']) ? wp_get_attachment_image_url( $item['tp_features_list_thumb_two']['id'], $item['thumbnail_size']) : $item['tp_features_list_thumb_two']['url'];
                                        $features_thumb_two_alt = get_post_meta($item["tp_features_list_thumb_two"]["id"], "_wp_attachment_image_alt", true);
                                    }
                                    if ( !empty($item['tp_features_list_thumb_three']['url']) ) {
                                        $features_thumb_three_url = !empty($item['tp_features_list_thumb_three']['id']) ? wp_get_attachment_image_url( $item['tp_features_list_thumb_three']['id'], $item['thumbnail_size']) : $item['tp_features_list_thumb_three']['url'];
                                        $features_thumb_three_alt = get_post_meta($item["tp_features_list_thumb_three"]["id"], "_wp_attachment_image_alt", true);
                                    }
                                ?>
                                <div class="tab-pane fade <?php echo esc_attr($active); ?>" id="customer-<?php echo esc_attr($key); ?>" role="tabpanel" aria-labelledby="customer-tab-<?php echo esc_attr($key); ?>">
                                    <div class="features__list-thumb-wrapper">

                                        <?php if(!empty($features_thumb_url)) : ?>
                                        <img class="features__list-thumb-1" src="<?php echo esc_url($features_thumb_url); ?>" alt="<?php echo esc_attr($features_thumb_alt); ?>">
                                        <?php endif; ?>

                                        <?php if(!empty($features_thumb_two_url)) : ?>
                                        <img class="features__list-thumb-2" src="<?php echo esc_url($features_thumb_two_url); ?>" alt="<?php echo esc_attr($features_thumb_two_alt); ?>">
                                        <?php endif; ?>

                                        <?php if(!empty($features_thumb_three_url)) : ?>
                                        <img class="features__list-thumb-3" src="<?php echo esc_url($features_thumb_three_url); ?>" alt="<?php echo esc_attr($features_thumb_three_alt); ?>">
                                        <?php endif; ?>

                                        <?php if(!empty($settings['tp_features_shape_switch'])) :?>
                                        <img class="features__shape-7" src="<?php echo get_template_directory_uri() . '/assets/img/features/7/features-shape-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                                        <?php endif; ?>

                                    </div>
                                </div>
                                <?php endforeach; ?>

                           </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- features list area end -->

        <?php endif; ?>

        <?php
	}
}

$widgets_manager->register( new TP_Features_Tab() );
