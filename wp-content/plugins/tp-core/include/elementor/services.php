<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
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
class TP_Services extends Widget_Base {

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
        return 'services';
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
        return __( 'Services', 'tpcore' );
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

        $this->add_control(
         'tp_services_style_2',
         [
           'label'        => esc_html__( 'Enable Second Style', 'tpcore' ),
           'type'         => \Elementor\Controls_Manager::SWITCHER,
           'label_on'     => esc_html__( 'Show', 'tpcore' ),
           'label_off'    => esc_html__( 'Hide', 'tpcore' ),
           'return_value' => 'yes',
           'default'      => 'no',
           'condition' => [
                'tp_design_style' => 'layout-8'
           ]
         ]
        );

        $this->end_controls_section();

        $this->tp_section_title_render_controls('services', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.');

        // Service group
        $this->start_controls_section(
            'tp_services',
            [
                'label' => esc_html__('Services List', 'tpcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
         'services_shape_switch',
         [
           'label'        => esc_html__( 'Services Shape Switch', 'tpcore' ),
           'type'         => \Elementor\Controls_Manager::SWITCHER,
           'label_on'     => esc_html__( 'Show', 'tpcore' ),
           'label_off'    => esc_html__( 'Hide', 'tpcore' ),
           'return_value' => 'yes',
           'default'      => 'yes',
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
                    'style_2' => __( 'Style 2', 'tpcore' ),
                    'style_3' => __( 'Style 3', 'tpcore' ),
                    'style_4' => __( 'Style 4', 'tpcore' ),
                    'style_5' => __( 'Style 5', 'tpcore' ),
                    'style_6' => __( 'Style 6', 'tpcore' ),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'tp_services_image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __( 'Image', 'tpcore' ),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' =>[
                    'repeater_condition' => ['style_2', 'style_1', 'style_5']
                ]
            ]
        ); 

        $repeater->add_control(
        'tp_services_price',
            [
                'label'       => esc_html__( 'Case Price', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( '$247.00', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Price here', 'tpcore' ),
                'condition' =>[
                    'repeater_condition' => 'style_2'
                ]
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
                    'repeater_condition' => ['style_1', 'style_3', 'style_6'],
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
                    'repeater_condition' => ['style_1', 'style_3', 'style_6'],
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
                    'repeater_condition' => ['style_1', 'style_3', 'style_6'],
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
                        'repeater_condition' => ['style_1', 'style_3', 'style_6'],
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
                        'repeater_condition' => ['style_1', 'style_3', 'style_6'],
                    ]
                ]
            );
        }


        $repeater->add_control(
            'tp_service_subtitle', [
                'label' => esc_html__('Sub Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('80 Projects', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_6']
                ]
            ]
        );

        $repeater->add_control(
            'tp_service_title', [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Service Title', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_service_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered.',
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_1',  'style_2', 'style_3', 'style_4', 'style_5',]
                ]
            ]
        );

        $repeater->add_control(
            'tp_services_link_switcher',
            [
                'label' => esc_html__( 'Add Services link', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'tpcore' ),
                'label_off' => esc_html__( 'No', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );
        $repeater->add_control(
            'tp_services_btn_text',
            [
                'label' => esc_html__('Button Text', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'tpcore'),
                'title' => esc_html__('Enter button text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_services_link_switcher' => 'yes',
                    'repeater_condition' => ['style_1',  'style_2', 'style_3', 'style_4', 'style_5']
                ],
            ]
        );
        $repeater->add_control(
            'tp_services_link_type',
            [
                'label' => esc_html__( 'Service Link Type', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'tp_services_link_switcher' => 'yes'
                ]
            ]
        );
        $repeater->add_control(
            'tp_services_link',
            [
                'label' => esc_html__( 'Service Link link', 'tpcore' ),
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
                    'tp_services_link_type' => '1',
                    'tp_services_link_switcher' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'tp_services_page_link',
            [
                'label' => esc_html__( 'Select Service Link Page', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_services_link_type' => '2',
                    'tp_services_link_switcher' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'tp_service_list',
            [
                'label' => esc_html__('Services - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_service_title' => esc_html__('Business Stratagy', 'tpcore'),
                    ],
                    [
                        'tp_service_title' => esc_html__('Website Development', 'tpcore')
                    ],
                    [
                        'tp_service_title' => esc_html__('Marketing & Reporting', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_service_title }}}',
            ]
        );
        $this->add_responsive_control(
            'tp_service_align',
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



        // Button 
        $this->tp_button_render('services_view_all', 'Services More', ['layout-1', 'layout-2'] );

        $this->start_controls_section(
         'tp_services_shape_section',
             [
               'label' => esc_html__( 'Services Shape', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
               'condition'=> [
                    'tp_design_style' => ['layout-5', 'layout-6', 'layout-7']
               ]
             ]
        );
        
        $this->add_control(
         'tp_services_shape_switch',
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
         'tp_services_logo_sec',
             [
               'label' => esc_html__( 'Logo Controls', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
               'condition' =>[
                'tp_design_style' => 'layout-6'
               ]
             ]
        );
        
        $this->add_control(
         'services_logo_switch',
         [
           'label'        => esc_html__( 'Enable Logo', 'tpcore' ),
           'type'         => \Elementor\Controls_Manager::SWITCHER,
           'label_on'     => esc_html__( 'Show', 'tpcore' ),
           'label_off'    => esc_html__( 'Hide', 'tpcore' ),
           'return_value' => 'yes',
           'default'      => 'yes',
         ]
        );

        $this->add_control(
         'services_logo_bg',
         [
           'label'   => esc_html__( 'Upload BG Image', 'tpcore' ),
           'type'    => \Elementor\Controls_Manager::MEDIA,
             'default' => [
               'url' => \Elementor\Utils::get_placeholder_image_src(),
           ],
         ]
        );
        $this->add_control(
         'services_logo_icon',
         [
           'label'   => esc_html__( 'Upload Icon Image', 'tpcore' ),
           'type'    => \Elementor\Controls_Manager::MEDIA,
             'default' => [
               'url' => \Elementor\Utils::get_placeholder_image_src(),
           ],
         ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'services_thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                // 'default' => 'tp-post-thumb',
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'services_logo_thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
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
        $this->tp_basic_style_controls('services_subtitle', 'Services - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('services_title', 'Services - Title', '.tp-el-title');
        $this->tp_basic_style_controls('services_description', 'Services - Description', '.tp-el-content p');
        $this->tp_link_controls_style('services_more_link_btn', 'Services - More Button', '.tp-el-more-btn');

        $this->tp_section_style_controls('services_section_box', 'Box - Style', '.tp-el-box');
        $this->start_controls_section(
        'tp_features_box_img',
            [
                'label' => esc_html__( 'Gradient BG Color', 'tpcore' ),
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
        $this->tp_basic_style_controls('services_box_title', 'Services - Box - Title', '.tp-el-box-title');
        $this->tp_basic_style_controls('services_box_subtitle', 'Services - Box - Subtitle', '.tp-el-box-subtitle');
        $this->tp_basic_style_controls('services_box_description', 'Services - Box - Description', '.tp-el-box-desc');
        $this->tp_icon_style('services_box_icon', 'Services - Icon/Image/SVG', '.tp-el-box-icon span');
        $this->tp_link_controls_style('services_box_link_btn', 'Services - Box - Button', '.tp-el-box-btn');

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
            $this->add_render_attribute('title_args', 'class', 'section__title-4 tp-el-title');

            if ('2' == $settings['tp_services_view_all_btn_link_type']) {
                $link = get_permalink($settings['tp_services_view_all_btn_page_link']);
                $target = '_self';
                $rel = 'nofollow';
            } else {
                $link = !empty($settings['tp_services_view_all_btn_link']['url']) ? $settings['tp_services_view_all_btn_link']['url'] : '';
                $target = !empty($settings['tp_services_view_all_btn_link']['is_external']) ? '_blank' : '';
                $rel = !empty($settings['tp_services_view_all_btn_link']['nofollow']) ? 'nofollow' : '';
            }
        ?>

        <!-- case result area start -->
        <section class="case__area pt-110 tp-el-section">
            <div class="container">
            <?php if ( !empty($settings['tp_services_section_title_show']) ) : ?>
               <div class="row align-items-end">
                  <div class="col-xxl-7 col-xl-8 col-lg-8 col-md-7">
                     <div class="section__title-wrapper-4 pr-5 mb-60 tp-el-description">

                        <?php if(!empty($settings['tp_services_sub_title' ])): ?>
                        <span class="section__title-pre-4 tp-el-subtitle"><?php echo tp_kses( $settings['tp_services_sub_title' ] ) ?></span>
                        <?php endif; ?>

                        <?php
                            if ( !empty($settings['tp_services_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['tp_services_title_tag'] ),
                                    $this->get_render_attribute_string( 'title_args' ),
                                    tp_kses( $settings['tp_services_title' ] )
                                    );
                            endif;
                        ?>

                        <?php if ( !empty($settings['tp_services_description']) ) : ?>
                            <p><?php echo tp_kses( $settings['tp_services_description'] ); ?></p>
                        <?php endif; ?>

                     </div>
                  </div>
                  <?php if(!empty($settings['tp_services_view_all_btn_switcher'])) :?>
                  <div class="col-xxl-5 col-xl-4 col-lg-4 col-md-5">
                     <div class="case__more text-md-end mb-70">
                        <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>" class="tp-btn-border-brown tp-el-more-btn"><?php echo tp_kses($settings['tp_services_view_all_btn_text']); ?></a>
                     </div>
                  </div>
                  <?php endif; ?>
               </div>
               <?php endif; ?>
               <div class="row">
                    <?php foreach ($settings['tp_service_list'] as $key => $item) :


                        if ( !empty($item['tp_services_image']['url']) ) {
                            $tp_services_image_url = !empty($item['tp_services_image']['id']) ? wp_get_attachment_image_url( $item['tp_services_image']['id'], $settings['thumbnail_size']) : $item['tp_services_image']['url'];
                            $tp_services_image_alt = get_post_meta($item["tp_services_image"]["id"], "_wp_attachment_image_alt", true);
                        }   

                        // Link
                        if ('2' == $item['tp_services_link_type']) {
                            $link = get_permalink($item['tp_services_page_link']);
                            $target = '_self';
                            $rel = 'nofollow';
                        } else {
                            $link = !empty($item['tp_services_link']['url']) ? $item['tp_services_link']['url'] : '';
                            $target = !empty($item['tp_services_link']['is_external']) ? '_blank' : '';
                            $rel = !empty($item['tp_services_link']['nofollow']) ? 'nofollow' : '';
                        }
                    ?>
                  <div class="col-xl-<?php echo esc_attr($settings['tp_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['tp_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['tp_col_for_tablet']); ?> col-<?php echo esc_attr($settings['tp_col_for_mobile']); ?>">
                     <div class="case__item mb-50 wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s">

                     <?php if( !empty($tp_services_image_url) ) : ?>
                        <div class="case__thumb w-img fix">
                           <img src="<?php echo esc_url($tp_services_image_url); ?>" alt="<?php echo esc_url($tp_services_image_alt); ?>">
                        </div>
                        <?php endif; ?>
                        <div class="case__content transition-3 tp-el-box">
   
                            <?php if(!empty($item['tp_services_price'])) :?>
                            <div class="case__price">
                                <span class="tp-el-service-price tp-el-box-subtitle"><?php echo tp_kses($item['tp_services_price']); ?></span>
                            </div>
                            <?php endif; ?>
                        
                            <?php if (!empty($item['tp_service_title' ])): ?>
                                <h3 class="case__title tp-el-box-title">
                                    <?php if ($item['tp_services_link_switcher'] == 'yes') : ?>
                                    <a href="<?php echo esc_url($link); ?>"><?php echo tp_kses($item['tp_service_title' ]); ?></a>
                                    <?php else : ?>
                                        <?php echo tp_kses($item['tp_service_title' ]); ?>
                                    <?php endif; ?>
                                </h3>
                            <?php endif; ?>

                              <?php if (!empty($item['tp_service_description' ])): ?>
                              <p class="tp-el-box-desc"><?php echo tp_kses($item['tp_service_description']); ?></p>
                              <?php endif; ?>
   

                              <?php if (!empty($link)) : ?>
                               <div class="case__btn">
                                  <a class="tp-el-box-btn tp-btn-border-brown-sm" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>">
                                     <?php echo tp_kses($item['tp_services_btn_text']); ?>
                                     <i class="fa-regular fa-arrow-right-long"></i>
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
         <!-- case result area end -->



        <?php elseif ( $settings['tp_design_style']  == 'layout-3' ): 
            $this->add_render_attribute('title_args', 'class', 'section__title-4 tp-el-title');    
        ?>

         <!-- services area start -->
         <section class="servivces__area pt-110 tp-el-section">
            <div class="container">
            <?php if ( !empty($settings['tp_services_section_title_show']) ) : ?>
               <div class="row align-items-end">
                  <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                     <div class="section__title-wrapper-4 mb-60">
                        <?php if(!empty($settings['tp_services_sub_title'])): ?>
                        <span class="section__title-pre-4 tp-el-subtitle"><?php echo tp_kses($settings['tp_services_sub_title']); ?></span>
                        <?php endif; ?>
                        <?php
                            if ( !empty($settings['tp_services_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['tp_services_title_tag'] ),
                                    $this->get_render_attribute_string( 'title_args' ),
                                    tp_kses( $settings['tp_services_title' ] )
                                    );
                            endif;
                        ?>

                     </div>
                  </div>
                  <div class="col-xxl-5 offset-xxl-1 col-xl-6 col-lg-6 col-md-6">
                     <div class="services__more-4 mb-65 tp-el-content">
                        <?php if (!empty($settings['tp_services_description' ])): ?>
                        <p><?php echo tp_kses($settings['tp_services_description']); ?></p>
                        <?php endif; ?>
                     </div>
                  </div>
               </div>
               <?php endif; ?>
               <div class="row">
                    <?php foreach ($settings['tp_service_list'] as $key => $item) :

                        if ( !empty($item['tp_services_image']['url']) ) {
                            $tp_image_url = !empty($item['tp_services_image']['id']) ? wp_get_attachment_image_url( $item['tp_services_image']['id'], $settings['thumbnail_size']) : $item['tp_services_image']['url'];
                            $tp_image_alt = get_post_meta($item["tp_services_image"]["id"], "_wp_attachment_image_alt", true);
                        }
                        // Link
                        if ('2' == $item['tp_services_link_type']) {
                            $link = get_permalink($item['tp_services_page_link']);
                            $target = '_self';
                            $rel = 'nofollow';
                        } else {
                            $link = !empty($item['tp_services_link']['url']) ? $item['tp_services_link']['url'] : '';
                            $target = !empty($item['tp_services_link']['is_external']) ? '_blank' : '';
                            $rel = !empty($item['tp_services_link']['nofollow']) ? 'nofollow' : '';
                        }
                    ?>
                  <div class="col-xl-<?php echo esc_attr($settings['tp_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['tp_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['tp_col_for_tablet']); ?> col-<?php echo esc_attr($settings['tp_col_for_mobile']); ?>">
                     <div class="services__item-4 mb-30 transition-3 fix wow fadeInUp tp-el-box" data-wow-delay=".3s" data-wow-duration="1s">
                        <div class="services__thumb-4 include-bg transition-3" data-background="<?php echo esc_url($tp_image_url); ?>"></div>

                        <div class="services__icon-4 tp-el-box-icon mb-30 transition-3">
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

                        <div class="services__content-4 transition-3">
                                <?php if (!empty($item['tp_service_title' ])): ?>
                                <h4 class="services__title-4 tp-el-box-title">
                                    <?php if ($item['tp_services_link_switcher'] == 'yes') : ?>
                                    <a href="<?php echo esc_url($link); ?>"><?php echo tp_kses($item['tp_service_title' ]); ?></a>
                                    <?php else : ?>
                                        <?php echo tp_kses($item['tp_service_title' ]); ?>
                                    <?php endif; ?>
                                </h4>
                                <?php endif; ?>

                              <?php if (!empty($item['tp_service_description' ])): ?>
                              <p class="tp-el-box-desc"><?php echo tp_kses($item['tp_service_description']); ?></p>
                              <?php endif; ?>
   

                              <?php if (!empty($link)) : ?>
                               <div class="services__btn">
                                  <a class="tp-el-box-btn services-link-btn" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>">
                                     <?php echo tp_kses($item['tp_services_btn_text']); ?>
                                     <i class="fa-regular fa-arrow-right"></i>
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
         <!-- services area end -->

         <?php elseif ( $settings['tp_design_style']  == 'layout-4' ): 
            $this->add_render_attribute('title_args', 'class', 'section__title-4 tp-el-title');    
        ?>

         <!-- award area start -->
         <section class="award__area tp-el-section">
            <div class="container">
               <div class="row">
                    <?php foreach ($settings['tp_service_list'] as $key => $item) :
                        // Link
                        if ('2' == $item['tp_services_link_type']) {
                            $link = get_permalink($item['tp_services_page_link']);
                            $target = '_self';
                            $rel = 'nofollow';
                        } else {
                            $link = !empty($item['tp_services_link']['url']) ? $item['tp_services_link']['url'] : '';
                            $target = !empty($item['tp_services_link']['is_external']) ? '_blank' : '';
                            $rel = !empty($item['tp_services_link']['nofollow']) ? 'nofollow' : '';
                        }
                    ?>
                  <div class="col-xl-<?php echo esc_attr($settings['tp_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['tp_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['tp_col_for_tablet']); ?> col-<?php echo esc_attr($settings['tp_col_for_mobile']); ?>">
                     <div class="award__item white-bg p-relative mb-30 transition-3 wow fadeInUp tp-el-box" data-wow-delay=".3s" data-wow-duration="1s">
                        <div class="award__icon tp-el-box-icon">
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
                        <div class="award__content">
                                <?php if (!empty($item['tp_service_title' ])): ?>
                                <h3 class="award__title tp-el-box-title">
                                    <?php if ($item['tp_services_link_switcher'] == 'yes') : ?>
                                    <a href="<?php echo esc_url($link); ?>"><?php echo tp_kses($item['tp_service_title' ]); ?></a>
                                    <?php else : ?>
                                        <?php echo tp_kses($item['tp_service_title' ]); ?>
                                    <?php endif; ?>
                                </h3>
                                <?php endif; ?>

                           <?php if (!empty($item['tp_service_description' ])): ?>
                              <p class="tp-el-box-desc"><?php echo tp_kses($item['tp_service_description']); ?></p>
                            <?php endif; ?>

                           <?php if (!empty($link)) : ?>
                               <div class="award__btn">
                                  <a class="tp-el-box-btn tp-btn-border-green" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>">
                                     <?php echo tp_kses($item['tp_services_btn_text']); ?>
                                     <i class="fa-regular fa-angle-right"></i>
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
         <!-- award area end -->

        <?php elseif ( $settings['tp_design_style']  == 'layout-5' ): 
            $this->add_render_attribute('title_args', 'class', 'section__title-5 tp-el-title');  
            $bloginfo = get_bloginfo( 'name' );  
        ?>
         <!-- services area start -->
         <section class="services__area grey-bg-8 pt-110 pb-130 p-relative z-index-1 tp-el-section">

            <?php if(!empty($settings['tp_services_shape_switch'])) : ?>
            <div class="services__shape">
               <img class="services__shape-4" src="<?php echo get_template_directory_uri() . '/assets/img/services/5/shape/services-shape-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="services__shape-5" src="<?php echo get_template_directory_uri() . '/assets/img/services/5/shape/services-shape-2.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="services__shape-6" src="<?php echo get_template_directory_uri() . '/assets/img/services/5/shape/services-shape-3.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="services__shape-7" src="<?php echo get_template_directory_uri() . '/assets/img/services/5/shape/services-shape-4.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="services__shape-8" src="<?php echo get_template_directory_uri() . '/assets/img/services/5/shape/services-shape-5.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="services__shape-9" data-parallax='{"y": 150, "smoothness": 10}'  src="<?php echo get_template_directory_uri() . '/assets/img/services/5/shape/services-shape-6.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
            </div>
            <?php endif; ?>


            
            <div class="container">
               <div class="row justify-content-center">
                  <div class="col-xxl-8 col-xl-8 col-lg-10">
                    <?php if ( !empty($settings['tp_services_section_title_show']) ) : ?>
                     <div class="services__section-title-5 wow fadeInUp" data-wow-delay=".5s" data-wow-duration="1s">
                        <div class="section__title-wrapper-5 mb-70 text-center tp-el-content">
                            <?php if(!empty($settings['tp_services_sub_title'])): ?>
                            <span class="section__title-pre-5 tp-el-subtitle"><?php echo tp_kses($settings['tp_services_sub_title']); ?></span>
                            <?php endif; ?>

                           <?php
                                if ( !empty($settings['tp_services_title' ]) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['tp_services_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        tp_kses( $settings['tp_services_title' ] )
                                        );
                                endif;
                            ?>

                            <?php if (!empty($settings['tp_services_description' ])): ?>
                            <p><?php echo tp_kses($settings['tp_services_description']); ?></p>
                            <?php endif; ?>

                        </div>
                     </div>
                     <?php endif; ?>
                  </div>
               </div>
               <div class="row">
               <?php foreach ($settings['tp_service_list'] as $key => $item) :
                        // Link
                        if ('2' == $item['tp_services_link_type']) {
                            $link = get_permalink($item['tp_services_page_link']);
                            $target = '_self';
                            $rel = 'nofollow';
                        } else {
                            $link = !empty($item['tp_services_link']['url']) ? $item['tp_services_link']['url'] : '';
                            $target = !empty($item['tp_services_link']['is_external']) ? '_blank' : '';
                            $rel = !empty($item['tp_services_link']['nofollow']) ? 'nofollow' : '';
                        }
                    ?>
                  <div class="col-xl-<?php echo esc_attr($settings['tp_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['tp_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['tp_col_for_tablet']); ?> col-<?php echo esc_attr($settings['tp_col_for_mobile']); ?>">
                     <div class="services__item-5 mb-30 white-bg wow fadeInUp " data-wow-delay=".3s" data-wow-duration="1s">
                        <div class="services__item-5-inner text-center transition-3 white-bg tp-el-box">
                           <div class="services__content-5">

                                <?php if (!empty($item['tp_service_title' ])): ?>
                                <h3 class="services__title-5 tp-el-box-title">
                                    <?php if ($item['tp_services_link_switcher'] == 'yes') : ?>
                                    <a href="<?php echo esc_url($link); ?>"><?php echo tp_kses($item['tp_service_title' ]); ?></a>
                                    <?php else : ?>
                                        <?php echo tp_kses($item['tp_service_title' ]); ?>
                                    <?php endif; ?>
                                </h3>
                                <?php endif; ?>

                                <?php if (!empty($item['tp_service_description' ])): ?>
                                <p class="tp-el-box-desc"><?php echo tp_kses($item['tp_service_description']); ?></p>
                                <?php endif; ?>
   
                                <?php if (!empty($link)) : ?>
                                <div class="services__btn-5">
                                    <a class="tp-link-btn-circle justify-content-center tp-el-box-btn" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>">
                                    <?php echo tp_kses($item['tp_services_btn_text']); ?>
                                        <span>
                                        <i class="fa-regular fa-arrow-right"></i>
                                        <i class="fa-regular fa-arrow-right"></i>
                                        </span>
                                    </a>
                                </div>
                                <?php endif; ?>
                              
                           </div>
                           <div class="services__thumb-5 tp-el-box-icon">
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
                        </div>
                     </div>
                  </div>
                  <?php endforeach; ?>
               </div>
            </div>

         </section>

         <!-- services area end -->
         <?php elseif ( $settings['tp_design_style']  == 'layout-6' ): 
            $this->add_render_attribute('title_args', 'class', 'section__title-3 has-gradient tp-el-title');  
            $bloginfo = get_bloginfo( 'name' );  

            if ( !empty($settings['services_logo_bg']['url']) ) {
                $services_logo_bg_url = !empty($settings['services_logo_bg']['id']) ? wp_get_attachment_image_url( $settings['services_logo_bg']['id'], $settings['services_thumbnail_size']) : $settings['services_logo_bg']['url'];
                $services_logo_bg_alt = get_post_meta($settings["services_logo_bg"]["id"], "_wp_attachment_image_alt", true);
            }
            if ( !empty($settings['services_logo_icon']['url']) ) {
                $services_logo_icon_url = !empty($settings['services_logo_icon']['id']) ? wp_get_attachment_image_url( $settings['services_logo_icon']['id'], $settings['services_logo_thumbnail_size']) : $settings['services_logo_icon']['url'];
                $services_logo_icon_alt = get_post_meta($settings["services_logo_icon"]["id"], "_wp_attachment_image_alt", true);
            }
            
        ?>


         <!-- services area start -->
         <div class="services__area p-relative z-index-1 black-bg-5 pt-50 pb-120 tp-el-section">
            <div class="container">
            <?php if ( !empty($settings['tp_services_section_title_show']) ) : ?>
               <div class="row">
                  <div class="col-xxl-6 col-xl-6 col-lg-6">
                     <div class="section__title-wrapper-3 mb-65 tp-el-content">
                        <?php if(!empty($settings['tp_services_sub_title'])): ?>
                            <span class="section__title-pre-3 tp-el-subtitle"><?php echo tp_kses($settings['tp_services_sub_title']); ?></span>
                            <?php endif; ?>

                           <?php
                                if ( !empty($settings['tp_services_title' ]) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['tp_services_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        tp_kses( $settings['tp_services_title' ] )
                                        );
                                endif;
                            ?>

                            <?php if (!empty($settings['tp_services_description' ])): ?>
                            <p><?php echo tp_kses($settings['tp_services_description']); ?></p>
                            <?php endif; ?>
                     </div>
                  </div>
               </div>
               <?php endif; ?>
               <div class="row">
                  <div class="col-xxl-5 col-xl-5 col-lg-5 col-md-5">
                     <div class="services__wrapper-3 wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s">
                        <div class="services__list pl-100">

                            <?php foreach ($settings['tp_service_list'] as $key => $item) :

                                if($key == '2'){
                                    $active = "active" ;
                                }else{
                                    $active = "";
                                }
                            ?>
                           <div class="services__list-item services-item-link <?php echo esc_attr($active); ?>" rel="services-img-<?php echo esc_attr($key); ?>">
                              <h3 class="services__list-title tp-el-box-title">
                                 <span class="services-tab-link-btn"><i class="fa-regular fa-angle-right"></i></span>
                                 <button type="button"><?php echo esc_html($item['tp_service_title']); ?></button>
                              </h3>
                           </div>
                           <?php endforeach; ?>
                        </div>
                     </div>
                  </div>
                  <div class="col-xxl-7 col-xl-7 col-lg-7 col-md-7">
                     <div class="services__tab-wrapper wow fadeInUp" data-wow-delay=".5s" data-wow-duration="1s">

                        <div class="services__tab-content pl-65 pr-35">
                            <?php if(!empty($settings['tp_services_shape_switch'])) :?>
                           <img class="services__shape-3" src="<?php echo get_template_directory_uri() . '/assets/img/services/3/services-shape-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                           <?php endif; ?>

                            
                           <div id="services-item-thumb" class="services-img-2">
                           <?php foreach ($settings['tp_service_list'] as $key => $item) :
                                if ( !empty($item['tp_services_image']['url']) ) {
                                        $tp_image_url = !empty($item['tp_services_image']['id']) ? wp_get_attachment_image_url( $item['tp_services_image']['id'], $settings['thumbnail_size']) : $item['tp_services_image']['url'];
                                        $tp_image_alt = get_post_meta($item["tp_services_image"]["id"], "_wp_attachment_image_alt", true);
                                }
                            ?>
                              <img class="services__list-thumb services-img-<?php echo esc_attr($key); ?>" src="<?php echo esc_url($tp_image_url); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                              <?php endforeach; ?>
                           </div>
                           

                           <?php if(!empty($settings['services_logo_switch'])) :?>
                           <div class="services__tab-logo">
                              <img class="services__tab-logo-thumb" src="<?php echo esc_url($services_logo_bg_url); ?>" alt="<?php echo esc_attr($services_logo_bg_alt); ?>">
                              <img class="services__tab-logo-icon" src="<?php echo esc_url($services_logo_icon_url); ?>" alt="<?php echo esc_attr($services_logo_icon_alt); ?>">
                           </div>
                           <?php endif; ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- services area end -->

         <!-- services area end -->
         <?php elseif ( $settings['tp_design_style']  == 'layout-7' ): 
            $this->add_render_attribute('title_args', 'class', 'section__title-7 tp-el-title');  
            $bloginfo = get_bloginfo( 'name' );  

            if ( !empty($settings['services_logo_bg']['url']) ) {
                $services_logo_bg_url = !empty($settings['services_logo_bg']['id']) ? wp_get_attachment_image_url( $settings['services_logo_bg']['id'], $settings['services_thumbnail_size']) : $settings['services_logo_bg']['url'];
                $services_logo_bg_alt = get_post_meta($settings["services_logo_bg"]["id"], "_wp_attachment_image_alt", true);
            }
            if ( !empty($settings['services_logo_icon']['url']) ) {
                $services_logo_icon_url = !empty($settings['services_logo_icon']['id']) ? wp_get_attachment_image_url( $settings['services_logo_icon']['id'], $settings['services_logo_thumbnail_size']) : $settings['services_logo_icon']['url'];
                $services_logo_icon_alt = get_post_meta($settings["services_logo_icon"]["id"], "_wp_attachment_image_alt", true);
            }
            
        ?>

         <!-- services area start -->
         <section class="services__area p-relative z-index-1 pt-110 pb-90 tp-el-section">
         <?php if(!empty($settings['tp_services_shape_switch'])) : ?>
            <div class="services__shape">
               <img class="services__shape-10" src="<?php echo get_template_directory_uri() . '/assets/img/services/7/services-shape-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
            </div>
            <?php endif; ?> 

            <div class="container">
            <?php if ( !empty($settings['tp_services_section_title_show']) ) : ?>
               <div class="row justify-content-center">
                  <div class="col-xxl-8 col-xl-8 col-lg-10 col-md-10">
                     <div class="section__title-wrapper-7 mb-60 text-center tp-el-content">

                        <?php if(!empty($settings['tp_services_sub_title'])): ?>
                        <span class="section__title-pre-7 tp-el-subtitle"><?php echo tp_kses($settings['tp_services_sub_title']); ?></span>
                        <?php endif; ?>                        

                           <?php
                            if ( !empty($settings['tp_services_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['tp_services_title_tag'] ),
                                    $this->get_render_attribute_string( 'title_args' ),
                                    tp_kses( $settings['tp_services_title' ] )
                                    );
                            endif;
                            ?>

                            <?php if (!empty($settings['tp_services_description' ])): ?>
                            <p><?php echo tp_kses($settings['tp_services_description']); ?></p>
                            <?php endif; ?>
                     </div>
                  </div>
               </div>
               <?php endif; ?>
               <div class="services__item-wrapper-7">
                  <div class="row">
                  <?php foreach ($settings['tp_service_list'] as $key => $item) :
                        // Link
                        if ('2' == $item['tp_services_link_type']) {
                            $link = get_permalink($item['tp_services_page_link']);
                            $target = '_self';
                            $rel = 'nofollow';
                        } else {
                            $link = !empty($item['tp_services_link']['url']) ? $item['tp_services_link']['url'] : '';
                            $target = !empty($item['tp_services_link']['is_external']) ? '_blank' : '';
                            $rel = !empty($item['tp_services_link']['nofollow']) ? 'nofollow' : '';
                        }
                    ?>
                     <div class="col-xl-<?php echo esc_attr($settings['tp_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['tp_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['tp_col_for_tablet']); ?> col-<?php echo esc_attr($settings['tp_col_for_mobile']); ?>">
                        <div class="services__item-7 text-center mb-60 wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s">
                           <div class="services__icon-7 tp-el-box-icon">
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
                           <div class="services__content-7 tp-el-box">
   
                              <?php if (!empty($item['tp_service_title' ])): ?>
                                <h3 class="services__title-7 tp-el-box-title">
                                    <?php if ($item['tp_services_link_switcher'] == 'yes') : ?>
                                    <a href="<?php echo esc_url($link); ?>"><?php echo tp_kses($item['tp_service_title' ]); ?></a>
                                    <?php else : ?>
                                        <?php echo tp_kses($item['tp_service_title' ]); ?>
                                    <?php endif; ?>
                                </h3>
                                <?php endif; ?>

                              <?php if (!empty($item['tp_service_description' ])): ?>
                              <p class="tp-el-box-desc"><?php echo tp_kses($item['tp_service_description']); ?></p>
                              <?php endif; ?>

                              <?php if (!empty($link)) : ?>
                              <div class="services__btn-7">
                                 <a class="tp-link-btn-3 tp-el-box-btn" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>">
                                 <?php echo tp_kses($item['tp_services_btn_text']); ?>
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
            </div>
         </section>
         <!-- services area end -->

         <?php elseif ( $settings['tp_design_style']  == 'layout-8' ): 
            $this->add_render_attribute('title_args', 'class', 'section__title-9 tp-el-title');  
            $bloginfo = get_bloginfo( 'name' );  

            $style_2 = $settings['tp_services_style_2'] == 'yes' ? 'services__item-style-2' : '';
            
        ?>

         <!-- services area start -->
         <section class="services__area pb-120 tp-el-section">
            <div class="container">
               <div class="row">
                    <?php foreach ($settings['tp_service_list'] as $key => $item) :
                        // Link
                        if ('2' == $item['tp_services_link_type']) {
                            $link = get_permalink($item['tp_services_page_link']);
                            $target = '_self';
                            $rel = 'nofollow';
                        } else {
                            $link = !empty($item['tp_services_link']['url']) ? $item['tp_services_link']['url'] : '';
                            $target = !empty($item['tp_services_link']['is_external']) ? '_blank' : '';
                            $rel = !empty($item['tp_services_link']['nofollow']) ? 'nofollow' : '';
                        }
                    ?>
                  <div class="col-xl-<?php echo esc_attr($settings['tp_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['tp_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['tp_col_for_tablet']); ?> col-<?php echo esc_attr($settings['tp_col_for_mobile']); ?>">
                     <div class="services__item-9 tp-el-gradient-bg <?php echo esc_attr($style_2); ?> mb-30 transition-3 tp-el-box">
                        <div class="services__item-9-top d-flex align-items-start justify-content-between">
                           <div class="services__icon-9 tp-el-box-icon">
                              <span>
                                <?php if($item['tp_box_icon_type'] == 'icon') : ?>
                                    <?php if (!empty($item['tp_box_icon']) || !empty($item['tp_box_selected_icon']['value'])) : ?>
                                            <span>
                                                <?php tp_render_icon($item, 'tp_box_icon', 'tp_box_selected_icon'); ?>
                                                <img class="services__icon-9-shape" src="<?php echo get_template_directory_uri() . '/assets/img/services/9/services-icon-shape.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>"> 
                                            </span>
                                    <?php endif; ?>
                                <?php elseif( $item['tp_box_icon_type'] == 'image' ) : ?>
                                    <span>
                                        <?php if (!empty($item['tp_box_icon_image']['url'])): ?>
                                        <img src="<?php echo $item['tp_box_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                        <?php endif; ?>
                                        <img class="services__icon-9-shape" src="<?php echo get_template_directory_uri() . '/assets/img/services/9/services-icon-shape.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>"> 
                                    </span>
                                <?php else : ?>
                                    <span>
                                        <?php if (!empty($item['tp_box_icon_svg'])): ?>
                                        <?php echo $item['tp_box_icon_svg']; ?>
                                        <?php endif; ?>
                                        <img class="services__icon-9-shape" src="<?php echo get_template_directory_uri() . '/assets/img/services/9/services-icon-shape.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>"> 
                                    </span>
                                <?php endif; ?>
                                                               
                              </span>
                           </div>
                           <?php if (!empty($link)) : ?>
                           <div class="services__btn-9">
                              <a class="tp-el-box-btn" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>"><i class="fa-light fa-arrow-up-right"></i></a>
                           </div>
                           <?php endif; ?>
                        </div>

                        <div class="services__content-9">

                            <?php if (!empty($item['tp_service_subtitle' ])): ?>
                            <span class="services-project tp-el-box-subtitle"><?php echo tp_kses($item['tp_service_subtitle' ]); ?></span>
                            <?php endif; ?>

                            <?php if (!empty($item['tp_service_title' ])): ?>
                                <h3 class="services__title-9 tp-el-box-title">
                                    <?php if ($item['tp_services_link_switcher'] == 'yes') : ?>
                                    <a href="<?php echo esc_url($link); ?>"><?php echo tp_kses($item['tp_service_title' ]); ?></a>
                                    <?php else : ?>
                                        <?php echo tp_kses($item['tp_service_title' ]); ?>
                                    <?php endif; ?>
                                </h3>
                                <?php endif; ?>
                        </div>
                     </div>
                  </div>
                  <?php endforeach; ?>
               </div>
            </div>
         </section>
         <!-- services area end -->

        <?php else:
            $this->add_render_attribute('title_args', 'class', 'section__title tp-el-title');
            $bloginfo = get_bloginfo( 'name' );

            if ('2' == $settings['tp_services_view_all_btn_link_type']) {
                $link2 = get_permalink($settings['tp_services_view_all_btn_page_link']);
                $target2 = '_self';
                $rel2 = 'nofollow';
            } else {
                $link2 = !empty($settings['tp_services_view_all_btn_link']['url']) ? $settings['tp_services_view_all_btn_link']['url'] : '';
                $target2 = !empty($settings['tp_services_view_all_btn_link']['is_external']) ? '_blank' : '';
                $rel2 = !empty($settings['tp_services_view_all_btn_link']['nofollow']) ? 'nofollow' : '';
            }
        ?>
         

         <!-- services area start -->
         <section class="services__area pb-90 tp-el-section">
            <div class="container">
                <?php if ( !empty($settings['tp_services_section_title_show']) ) : ?>
               <div class="row align-items-end">
                  <div class="col-xxl-7 col-xl-5 col-lg-8 col-md-8 col-sm-8">
                     <div class="section__title-wrapper mb-60 tp-el-content">

                        <?php if ( !empty($settings['tp_services_sub_title']) ) : ?>
                        <span class="section__title-pre tp-el-subtitle">
                            <?php echo tp_kses( $settings['tp_services_sub_title'] ); ?>
                        </span>
                        <?php endif; ?>

                        <?php
                            if ( !empty($settings['tp_services_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['tp_services_title_tag'] ),
                                    $this->get_render_attribute_string( 'title_args' ),
                                    tp_kses( $settings['tp_services_title' ] )
                                    );
                            endif;
                        ?>

                        <?php if ( !empty($settings['tp_services_description']) ) : ?>
                            <p><?php echo tp_kses( $settings['tp_services_description'] ); ?></p>
                        <?php endif; ?>
                     </div>
                  </div>
                  
                  <?php if(!empty($settings['tp_services_view_all_btn_switcher'])) :?>
                  <div class="col-xxl-5 col-xl-7 col-lg-4 col-md-4 col-sm-4">
                     <div class="services__more mb-70 text-md-end">
                        <a class="tp-link-btn-2 tp-el-more-btn" target="<?php echo esc_attr($target2); ?>" rel="<?php echo esc_attr($rel2); ?>" href="<?php echo esc_url($link2); ?>">
                           <?php echo tp_kses($settings['tp_services_view_all_btn_text']); ?>
                           <span>
                              <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path d="M1 7H13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M7 1L13 7L7 13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                              </svg>                              
                           </span>                              
                        </a>
                     </div>
                  </div>
                  <?php endif; ?>
               </div>
               <?php endif; ?>

               <div class="row">
                    <?php foreach ($settings['tp_service_list'] as $key => $item) :
                        // Link
                        if ('2' == $item['tp_services_link_type']) {
                            $link = get_permalink($item['tp_services_page_link']);
                            $target = '_self';
                            $rel = 'nofollow';
                        } else {
                            $link = !empty($item['tp_services_link']['url']) ? $item['tp_services_link']['url'] : '';
                            $target = !empty($item['tp_services_link']['is_external']) ? '_blank' : '';
                            $rel = !empty($item['tp_services_link']['nofollow']) ? 'nofollow' : '';
                        }
                    ?>
                  <div class="col-xl-<?php echo esc_attr($settings['tp_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['tp_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['tp_col_for_tablet']); ?> col-<?php echo esc_attr($settings['tp_col_for_mobile']); ?>">
                     <div class="services__item transition-3 mb-30 fix wow fadeInUp tp-el-box" data-wow-delay=".3s" data-wow-duration="1s">

                     <?php if(!empty($settings['services_shape_switch'])) :?>
                        <div class="services__shape">
                           <img class="services__shape-1" src="<?php echo get_template_directory_uri() . '/assets/img/services/shape/services-shape-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                           <img class="services__shape-2" src="<?php echo get_template_directory_uri() . '/assets/img/services/shape/services-shape-2.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                        </div>
                        <?php endif; ?>
                        
                        <div class="services__item-inner">
                           <div class="services__icon tp-el-box-icon">
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
                           <div class="services__content">
                                <?php if (!empty($item['tp_service_title' ])): ?>
                                <h3 class="services__title tp-el-box-title">
                                    <?php if ($item['tp_services_link_switcher'] == 'yes') : ?>
                                    <a href="<?php echo esc_url($link); ?>"><?php echo tp_kses($item['tp_service_title' ]); ?></a>
                                    <?php else : ?>
                                        <?php echo tp_kses($item['tp_service_title' ]); ?>
                                    <?php endif; ?>
                                </h3>
                                <?php endif; ?>

                              <?php if (!empty($item['tp_service_description' ])): ?>
                              <p class="tp-el-box-desc"><?php echo tp_kses($item['tp_service_description']); ?></p>
                              <?php endif; ?>
   

                              <?php if (!empty($link)) : ?>
                               <div class="services__btn">
                                  <a class="tp-el-box-btn tp-btn-border" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>">
                                     <?php echo tp_kses($item['tp_services_btn_text']); ?>
                                     <i class="fa-regular fa-angle-right"></i>
                                  </a>
                               </div>
                               <?php endif; ?>
                           </div>
                        </div>
                     </div>
                  </div>
                  <?php endforeach; ?>
               </div>
            </div>
         </section>
         <!-- services area end -->


        <?php endif; ?>

        <?php
    }
}

$widgets_manager->register( new TP_Services() ); 