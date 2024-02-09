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
class TP_Services_Box extends Widget_Base {

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
        return 'services-box';
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
        return __( 'Services Box', 'tpcore' );
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
                    ]
                ]
            );
        }

        $repeater->add_control(
            'tp_service_subtitle', [
                'label' => esc_html__('Sub Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Main Mission', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => 'style_2',
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
            ]
        );

        $repeater->add_control(
            'tp_service_meta', [
                'label' => esc_html__('Services Meta', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('280 Projects', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => 'style_1',
                ],
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
                    'repeater_condition' => ['style_2', 'style_3']
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
                'label' => esc_html__( 'Service Link', 'tpcore' ),
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
        $this->tp_button_render('services_view_all', 'Services More', ['layout-2'] );

        // colum controls
        $this->tp_columns('col');
    }

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('services_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('services_subtitle', 'Services - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('services_title', 'Services - Title', '.tp-el-title');
        $this->tp_basic_style_controls('services_description', 'Services - Description', '.tp-el-content p');
        $this->tp_link_controls_style('services_btn', 'Services - Button', '.tp-el-btn');

        $this->tp_section_style_controls('services_section_box', 'Services - Box - Style', '.tp-el-box');
        $this->tp_basic_style_controls('services_box_title', 'Services - Box - Title', '.tp-el-box-title');
        $this->tp_basic_style_controls('services_box_subtitle', 'Services - Box - Subtitle', '.tp-el-box-subtitle');
        $this->tp_basic_style_controls('services_box_description', 'Services - Box - Description', '.tp-el-box-desc');
        $this->tp_basic_style_controls('services_box_meta', 'Services - Box - Meta', '.tp-el-box-meta');
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
            $this->add_render_attribute('title_args', 'class', 'features__section-title tp-el-title');

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
         <!-- features area start -->
         <section class="features__area pb-100 tp-el-section">
            <div class="container">
            <?php if ( !empty($settings['tp_services_section_title_show']) ) : ?>
               <div class="row justify-content-center">
                  <div class="col-xxl-9 col-xl-10 col-lg-10">
                     <div class="features__section-title-wrapper text-center mb-40 tp-el-content">

                     <?php if ( !empty($settings['tp_services_sub_title']) ) : ?>
                    <span class="section__title-pre-10 tp-el-subtitle">
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
               </div>
               <?php endif; ?>

               <?php if(!empty($settings['tp_services_view_all_btn_switcher'])) :?>
               <div class="row">
                  <div class="col-xxl-12">
                     <div class="features__more-10 text-center">
                        <a class="tp-btn-7 tp-btn-7-sm tp-el-btn" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>"><?php echo tp_kses($settings['tp_services_view_all_btn_text']); ?></a>
                     </div>
                  </div>
               </div>
               <?php endif; ?>
               <div class="features__wrapper-10">
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
                        <div class="features__item-10 transition-3 mb-30 wow fadeInUp tp-el-box" data-wow-delay=".3s" data-wow-duration="1s">
                           <div class="features__icon-10 tp-el-box-icon">
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
                           <div class="features__content-10">

                           <?php if (!empty($item['tp_service_subtitle' ])): ?>
                              <span class="tp-el-box-subtitle"><?php echo tp_kses($item['tp_service_subtitle']); ?></span>
                              <?php endif; ?>
                              <?php if (!empty($item['tp_service_title' ])): ?>
                                <h3 class="features__title-10 tp-el-box-title">
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
                              <div class="features__btn-10">
                                 <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>" class="tp-btn-border-9 tp-el-box-btn"><?php echo tp_kses($item['tp_services_btn_text']); ?> <i class="fa-regular fa-angle-right"></i></a>
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
         <!-- features area end -->

         <?php elseif ( $settings['tp_design_style']  == 'layout-3' ):
            $this->add_render_attribute('title_args', 'class', 'tp-section-title-3 tp-el-title');

        ?>

        <!-- services area start -->
        <section class="services__area pt-110 pb-100 grey-bg-15 tp-el-section">
            <div class="container">
            <?php if ( !empty($settings['tp_services_section_title_show']) ) : ?>
               <div class="row">
                  <div class="col-xxl-12">
                     <div class="tp-section-wrapper-3 mb-50 text-center tp-el-content">
   
                        <?php if ( !empty($settings['tp_services_sub_title']) ) : ?>
                        <span class="tp-section-subtitle-3 tp-el-subtitle"><?php echo tp_kses( $settings['tp_services_sub_title'] ); ?></span>
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

                        <?php if ( !empty($settings['tp_section_description']) ) : ?>
                            <p><?php echo tp_kses( $settings['tp_section_description'] ); ?></p>
                        <?php endif; ?>
                     </div>
                  </div>
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
                     <div class="services__item-15 d-sm-flex align-items-start transition-3 mb-30 wow fadeInUp tp-el-box" data-wow-delay=".3s" data-wow-duration="1s">
                        <div class="services__icon-15 mr-45 tp-el-box-icon">
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
                        <div class="services__content-15">

                           <?php if (!empty($item['tp_service_title' ])): ?>
                            <h3 class="services__title-15 tp-el-box-title">
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
                           <div class="services__btn-15">
                              <a class="tp-el-box-btn" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>">
                              <?php echo tp_kses($item['tp_services_btn_text']); ?>
                                 <span>
                                    <svg width="32" height="10" viewBox="0 0 32 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path d="M26.8667 1L31 5.00003L26.8667 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                       <path d="M1 4.99878H31" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>                                                                            
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
        <!-- services area end -->

        <?php else:
            $this->add_render_attribute('title_args', 'class', 'section__title-8 tp-el-title');
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
         <section class="services__area pt-115 pb-105 black-bg-12 tp-el-section">
            <div class="container">
            <?php if ( !empty($settings['tp_services_section_title_show']) ) : ?>
               <div class="row">
                  <div class="col-xxl-12">
                     <div class="section__title-wrapper-8 text-center mb-60 tp-el-content">
                        <?php if ( !empty($settings['tp_services_sub_title']) ) : ?>
                        <span class="section__title-pre-8 tp-el-subtitle"><?php echo tp_kses( $settings['tp_services_sub_title'] ); ?></span>
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
                     <div class="services__item-8 animate-border-2 d-lg-flex align-items-start transition-3 mb-30 wow fadeInDown tp-el-box" data-wow-delay=".3s" data-wow-duration="1s">
                        <span class="services-border-2"></span>
                        <div class="services__shape">
                           <img class="services__shape-11" src="<?php echo get_template_directory_uri() . '/assets/img/services/8/services-shape-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                        </div>
                        <div class="services__icon-8 mr-30 tp-el-box-icon">
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
                        <div class="services__content-8">
                           <?php if (!empty($item['tp_service_title' ])): ?>
                                <h3 class="services__title-8 tp-el-box-title">
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

                            <?php if (!empty($item['tp_service_meta' ])): ?>
                            <div class="services__project-no tp-el-box-meta">
                                <span><?php echo tp_kses($item['tp_service_meta']); ?></span>
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


        <?php endif; ?>

        <?php
    }
}

$widgets_manager->register( new TP_Services_Box() ); 