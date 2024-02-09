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
class TP_Award extends Widget_Base {

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
        return 'award';
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
        return __( 'Award', 'tpcore' );
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

        $this->add_control(
         'award_style_2',
         [
           'label'        => esc_html__( 'Enable Second Style', 'tpcore' ),
           'type'         => \Elementor\Controls_Manager::SWITCHER,
           'label_on'     => esc_html__( 'Show', 'tpcore' ),
           'label_off'    => esc_html__( 'Hide', 'tpcore' ),
           'return_value' => 'yes',
           'default'      => 'no',
           'condition' => [
            'tp_design_style' => 'layout-2'
           ]
         ]
        );

        $this->end_controls_section();

        $this->tp_section_title_render_controls('award', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.');

       $this->start_controls_section(
        'tp_award_section',
            [
              'label' => esc_html__( 'Award Title', 'tpcore' ),
              'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
              'condition' => [
                'tp_design_style' => 'layout-1'
              ]
            ]
       );

       $this->add_control(
            'tp_award_sec_image',
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
                // 'default' => 'tp-post-thumb',
            ]
        );
       
       $this->end_controls_section();

        // Service group
        $this->start_controls_section(
            'tp_award',
            [
                'label' => esc_html__('Award List', 'tpcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

           
           $this->add_control(
               'tp_subtitle_line',
               [
                   'label' => esc_html__( 'Line BG Color', 'tpcore' ),
                   'type' => Controls_Manager::TEXT,
                   'selectors' => [
                       '{{WRAPPER}} .award__item-9::after' => 'background: {{VALUE}};',
                   ],
                   'condition' =>[
                    'tp_design_style' => ['layout-2'],
                   ],
                   'placeholder' => esc_html__( 'red', 'tpcore' ),
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
                'condition' => [
                    'repeater_condition' => ['style_1'],
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
                    'repeater_condition' => ['style_1'],
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
                    'repeater_condition' => ['style_1'],
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
                        'repeater_condition' => ['style_1'],
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
                        'repeater_condition' => ['style_1'],
                    ]
                ]
            );
        }

        $repeater->add_control(
            'tp_award_bg_color',
                [
                'label'       => esc_html__( 'Award BG Color', 'tpcore' ),
                'type'     => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .award__item-5' => 'color: {{VALUE}}',
                    ],
                'default' => '#5EB74B',
                    'condition' => [
                        'repeater_condition' => ['style_1'],
                    ]
                ]
        );

        $repeater->add_control(
            'tp_award_image',
            [
                'label'   => esc_html__( 'Upload Image', 'tpcore' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                    'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'repeater_condition' => ['style_2', 'style_3'],
                ]
            ]
        );
        $repeater->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail_size', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                // 'default' => 'tp-post-thumb',
                'condition' => [
                    'repeater_condition' => ['style_2', 'style_3'],
                ]
            ]
        );

        $repeater->add_control(
            'tp_award_title', [
                'label' => esc_html__('Award Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Award Title', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_award_link_switcher',
            [
                'label' => esc_html__( 'Add Award link', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'tpcore' ),
                'label_off' => esc_html__( 'No', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );
        $repeater->add_control(
            'tp_award_btn_text',
            [
                'label' => esc_html__('Button Text', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'tpcore'),
                'title' => esc_html__('Enter button text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_award_link_switcher' => 'yes',
                    'repeater_condition' => ['style_2'],
                ],
            ]
        );
        $repeater->add_control(
            'tp_award_link_type',
            [
                'label' => esc_html__( 'Award Link Type', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'tp_award_link_switcher' => 'yes'
                ]
            ]
        );
        $repeater->add_control(
            'tp_award_link',
            [
                'label' => esc_html__( 'Award link', 'tpcore' ),
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
                    'tp_award_link_type' => '1',
                    'tp_award_link_switcher' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'tp_award_page_link',
            [
                'label' => esc_html__( 'Select Award Link Page', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_award_link_type' => '2',
                    'tp_award_link_switcher' => 'yes',
                ]
            ]
        );

        $repeater->add_control(
            'tp_award_description',
            [
                'label' => esc_html__('Award Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Description',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_award_meta',
            [
                'label' => esc_html__('Award Meta', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'TP award meta',
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_2', 'style_3'],
                ]
            ]
        );



        $this->add_control(
            'tp_award_list',
            [
                'label' => esc_html__('award - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_award_title' => esc_html__('Business Stratagy', 'tpcore'),
                    ],
                    [
                        'tp_award_title' => esc_html__('Website Development', 'tpcore')
                    ],
                    [
                        'tp_award_title' => esc_html__('Marketing & Reporting', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_award_title }}}',
            ]
        );
        
        $this->end_controls_section();


        // colum controls
        $this->tp_columns('col');

        $this->tp_section_style_controls('about_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('about_subtitle', 'Section - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('about_title', 'Section - Title', '.tp-el-title');
        $this->tp_basic_style_controls('about_description', 'Section - Description', '.tp-el-content p');


        $this->tp_basic_style_controls('award_box_icon', 'Award - Meta', '.tp-el-box-tag p, .tp-el-box-tag span');
        $this->tp_basic_style_controls('award_box_title', 'Award - Title', '.tp-el-box-title');
        $this->tp_basic_style_controls('award_box_desc', 'Award - Description', '.tp-el-box-desc');
        $this->tp_link_controls_style('award_box_btn', 'Award - Link', '.tp-el-box-btn');
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
            
            

            if($settings['award_style_2'] == 'yes'){
                $award_style_2 = 'award__style-2';
                $this->add_render_attribute('title_args', 'class', 'section__title tp-el-title');
            }else{
                $award_style_2 = '';
                $this->add_render_attribute('title_args', 'class', 'section__title-9 tp-el-title');
            }

        ?>


         <!-- award area start -->
         <section class="award__area <?php echo esc_attr($award_style_2); ?> pt-120 pb-10 white-bg tp-el-section">
            <div class="container">
                <?php if ( !empty($settings['tp_award_section_title_show']) ) : ?>
               <div class="row">
                  <div class="col-xxl-12">
                  <?php if(!empty($award_style_2)) : ?>
                        <div class="section__title-wrapper mb-55 text-center tp-el-content">

                            <?php if(!empty($settings['tp_award_sub_title'])) : ?>
                            <span class="section__title-pre-9 tp-el-subtitle"><?php echo tp_kses( $settings['tp_award_sub_title'] ); ?></span>
                            <?php endif; ?>

                            <?php
                                if ( !empty($settings['tp_award_title' ]) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['tp_award_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        tp_kses( $settings['tp_award_title' ] )
                                        );
                                endif;
                            ?>

                            <?php if ( !empty($settings['tp_award_description']) ) : ?>
                            <p><?php echo tp_kses( $settings['tp_award_description'] ); ?></p>
                            <?php endif; ?>

                        </div>

                    <?php else : ?>
                     <div class="section__title-wrapper-9 mb-55 tp-el-content">

                        <?php if(!empty($settings['tp_award_sub_title'])) : ?>
                        <span class="section__title-pre-9 tp-el-subtitle"><?php echo tp_kses( $settings['tp_award_sub_title'] ); ?></span>
                        <?php endif; ?>

                        <?php
                            if ( !empty($settings['tp_award_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['tp_award_title_tag'] ),
                                    $this->get_render_attribute_string( 'title_args' ),
                                    tp_kses( $settings['tp_award_title' ] )
                                    );
                            endif;
                        ?>

                            <?php if ( !empty($settings['tp_award_description']) ) : ?>
                            <p><?php echo tp_kses( $settings['tp_award_description'] ); ?></p>
                            <?php endif; ?>
                     </div>

                     <?php endif; ?>
                  </div>
               </div>
               <?php endif; ?>
               <div class="row">
                  <div class="col-xxl-12">
                     <div class="award__item-wrapper-9 ">
                        <?php foreach ($settings['tp_award_list'] as $key => $item) : 
                            if ( !empty($item['tp_award_image']['url']) ) {
                                $tp_award_image_url = !empty($item['tp_award_image']['id']) ? wp_get_attachment_image_url( $item['tp_award_image']['id'], $item['thumbnail_size_size']) : $item['tp_award_image']['url'];
                                $tp_award_image_alt = get_post_meta($item["tp_award_image"]["id"], "_wp_attachment_image_alt", true);
                                
                            }

                            // Link
                            if ('2' == $item['tp_award_link_type']) {
                                $link = get_permalink($item['tp_award_page_link']);
                                $target = '_self';
                                $rel = 'nofollow';
                            } else {
                                $link = !empty($item['tp_award_link']['url']) ? $item['tp_award_link']['url'] : '';
                                $target = !empty($item['tp_award_link']['is_external']) ? '_blank' : '';
                                $rel = !empty($item['tp_award_link']['nofollow']) ? 'nofollow' : '';
                            }
                        ?>
                        <div class="award__item-9 p-relative wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s">
                           <div class="row align-items-center">
                              <div class="col-xl-3 col-lg-3 col-md-3">
                              <?php if (!empty($item['tp_award_meta'])) : ?>
                                 <div class="award__topic tp-el-box-tag">
                                    <p><?php echo tp_kses( $item['tp_award_meta']); ?></p>
                                 </div>
                                 <?php endif; ?> 
                              </div>
                              <div class="col-xl-7 col-lg-7 col-md-7">
                                 <div class="award__content-9">
                                    <h3 class="award__title-9 tp-el-box-title">
                                        <?php if ($item['tp_award_link_switcher'] == 'yes') : ?>
                                        <a href="<?php echo esc_url($link); ?>" class="tp-img-reveal tp-img-reveal-item" data-img="<?php echo esc_attr($tp_award_image_url); ?>" data-fx="1"><?php echo tp_kses($item['tp_award_title' ]); ?></a>
                                        <?php else : ?>
                                            <?php echo tp_kses($item['tp_award_title' ]); ?>
                                        <?php endif; ?>
                                    </h3>
                                    <?php if (!empty($item['tp_award_description'])) : ?>
                                    <p class="tp-el-box-desc"><?php echo tp_kses( $item['tp_award_description']); ?></p>
                                    <?php endif; ?> 
                                 </div>
                              </div>
                              <?php if (!empty($link)) : ?>
                              <div class="col-xl-2 col-lg-2 col-md-2">
                                 <div class="award__btn-9 text-md-end">
                                    <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>" class="career-link-btn tp-el-box-btn">
                                       <svg width="22" height="18" viewBox="0 0 22 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <path d="M12.7334 1L21 9.00007L12.7334 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                          <path d="M0.999999 8.99756H21" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                       </svg>                                          
                                    </a>
                                 </div>
                              </div>
                              <?php endif; ?> 
                       
                           </div>
                        </div>
                        <?php endforeach; ?>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- award area end -->
         
         <?php elseif ( $settings['tp_design_style']  == 'layout-3' ):
            $this->add_render_attribute('title_args', 'class', 'section__title-8 tp-el-title');
            
        ?>

         <!-- award area start -->
         <section class="award__area pt-130 pb-95 black-bg-13 tp-el-section">
            <div class="container">
            <?php if ( !empty($settings['tp_award_section_title_show']) ) : ?>
               <div class="row">
                  <div class="col-xxl-12">
                     <div class="section__title-wrapper-8 text-center mb-60">
                        <?php if ( !empty($settings['tp_award_sub_title']) ) : ?>
                        <span class="section__title-pre-8 tp-el-subtitle"><?php echo tp_kses( $settings['tp_award_sub_title'] ); ?></span>
                        <?php endif; ?>

                        <?php
                            if ( !empty($settings['tp_award_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['tp_award_title_tag'] ),
                                    $this->get_render_attribute_string( 'title_args' ),
                                    tp_kses( $settings['tp_award_title' ] )
                                    );
                            endif;
                        ?>

                        <?php if ( !empty($settings['tp_award_description']) ) : ?>
                        <p><?php echo tp_kses( $settings['tp_award_description'] ); ?></p>
                        <?php endif; ?>
                     </div>
                  </div>
               </div>
               <?php endif; ?>
               <div class="row">
                  <div class="col-xxl-12">
                        <?php foreach ($settings['tp_award_list'] as $key => $item) : 
                            if ( !empty($item['tp_award_image']['url']) ) {
                                $tp_award_image_url = !empty($item['tp_award_image']['id']) ? wp_get_attachment_image_url( $item['tp_award_image']['id'], $item['thumbnail_size_size']) : $item['tp_award_image']['url'];
                                $tp_award_image_alt = get_post_meta($item["tp_award_image"]["id"], "_wp_attachment_image_alt", true);
                                
                            }

                            // Link
                            if ('2' == $item['tp_award_link_type']) {
                                $link = get_permalink($item['tp_award_page_link']);
                                $target = '_self';
                                $rel = 'nofollow';
                            } else {
                                $link = !empty($item['tp_award_link']['url']) ? $item['tp_award_link']['url'] : '';
                                $target = !empty($item['tp_award_link']['is_external']) ? '_blank' : '';
                                $rel = !empty($item['tp_award_link']['nofollow']) ? 'nofollow' : '';
                            }
                        ?>
                     <div class="award__item-8 transition-3 wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s">
                        <div class="row align-items-center">
                           <div class="col-xl-2 col-lg-2 col-md-2">
                           <?php if (!empty($item['tp_award_meta'])) : ?>
                              <div class="award__year text-md-center pb-30 pl-10 tp-el-box-tag">
                                 <span><?php echo tp_kses( $item['tp_award_meta']); ?></span>
                              </div>
                              <?php endif; ?>                                  
                           </div>
                           <div class="col-xl-2 col-lg-2 col-md-2">
                              <div class="award__icon-8 pl-15">
                                 <span>
                                    <img src="<?php echo esc_url($tp_award_image_url); ?>" alt="<?php echo esc_attr($tp_award_image_alt); ?>">
                                 </span>
                              </div>
                           </div>
                           <div class="col-xl-5 col-lg-5 col-md-5">
                              <div class="award__content-8">
                                    <h3 class="award__title-8 tp-el-box-title">
                                        <?php if ($item['tp_award_link_switcher'] == 'yes') : ?>
                                        <a href="<?php echo esc_url($link); ?>" ><?php echo tp_kses($item['tp_award_title' ]); ?></a>
                                        <?php else : ?>
                                            <?php echo tp_kses($item['tp_award_title' ]); ?>
                                        <?php endif; ?>
                                    </h3>
                                    <?php if (!empty($item['tp_award_description'])) : ?>
                                    <p class="tp-el-box-desc"><?php echo tp_kses( $item['tp_award_description']); ?></p>
                                    <?php endif; ?> 
                              </div>
                           </div>
                           <?php if (!empty($link)) : ?>
                           <div class="col-xl-3 col-lg-3 col-md-3">
                              <div class="award__btn-8 text-md-center">
                                 <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>" class="tp-link-btn-3 tp-el-box-btn">
                                 <?php echo tp_kses($item['tp_award_btn_text']); ?>
                                    <span>
                                       <i class="fa-regular fa-chevron-right"></i>
                                    </span>
                                 </a>
                              </div>
                           </div>
                           <?php endif; ?>                              
                        </div>
                     </div>
                     <?php endforeach; ?>
                  </div>
               </div>
            </div>
         </section>
         <!-- award area end -->


        <?php else:
            $this->add_render_attribute('title_args', 'class', 'tp-title');
            $bloginfo = get_bloginfo( 'name' );
            if ( !empty($settings['tp_award_sec_image']['url']) ) {
                $tp_award_sec_image_url = !empty($settings['tp_award_sec_image']['id']) ? wp_get_attachment_image_url( $settings['tp_award_sec_image']['id'], $settings['thumbnail_size']) : $settings['tp_award_sec_image']['url'];
                $tp_award_sec_image_alt = get_post_meta($settings["tp_award_sec_image"]["id"], "_wp_attachment_image_alt", true);
                
            }
        ?>

         <!-- award area start -->
         <section class="award__area pb-10 p-relative z-index-1">

            <?php if(!empty($settings['tp_award_shape_switch'])): ?>
            <div class="award__shape">
               <img class="award__shape-1" src="<?php echo get_template_directory_uri() . '/assets/img/award/5/shape/award-shape-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="award__shape-2" src="<?php echo get_template_directory_uri() . '/assets/img/award/5/shape/award-shape-2.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
            </div>
            <?php endif; ?>

            <div class="container">

                <?php if(!empty($tp_award_sec_image_url)): ?>
                <div class="row">
                    <div class="col-xxl-12">
                        <div class="award__stroke text-center">
                            <img src="<?php echo esc_attr($tp_award_sec_image_url); ?>" alt="<?php echo esc_attr($tp_award_sec_image_alt); ?>">
                        </div>
                    </div>
                </div>
                <?php endif; ?>

               <div class="row gx-1">

                    <?php foreach ($settings['tp_award_list'] as $key => $item) : ?>
                  <div class="col-xl-<?php echo esc_attr($settings['tp_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['tp_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['tp_col_for_tablet']); ?> col-<?php echo esc_attr($settings['tp_col_for_mobile']); ?>">
                     <div class="award__item-5 mb-30 wow fadeInUp" data-bg-color="<?php echo esc_attr($item['tp_award_bg_color']); ?>" data-wow-delay=".5s" data-wow-duration="1s">
                        <div class="award__icon-5 tp-el-box-icon">
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
                        <div class="award__content-5">
                            <?php if (!empty($item['tp_award_title' ])): ?>
                           <h4 class="award__title-5 tp-el-box-title"><?php echo tp_kses($item['tp_award_title' ]); ?></h4>
                           <?php endif; ?>

                           <?php if (!empty($item['tp_award_description' ])): ?>
                            <p class="tp-el-box-desc"><?php echo tp_kses($item['tp_award_description']); ?></p>
                            <?php endif; ?>
                        </div>
                     </div>
                  </div>
                  <?php endforeach; ?>
               </div>
            </div>
         </section>
         <!-- award area end -->

        <?php endif; ?>

        <?php
    }
}

$widgets_manager->register( new TP_Award() );