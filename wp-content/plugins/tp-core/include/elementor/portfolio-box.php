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
class TP_Portfolio_Box extends Widget_Base {

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
        return 'tp-portfolio-box';
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
        return __( 'Portfolio Box', 'tpcore' );
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

        $this->tp_section_title_render_controls('portfolio_sec', 'Section Title', 'Sub Title', 'your title here', 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.');

        // Portfolio group
        $this->start_controls_section(
            'tp_portfolios',
            [
                'label' => esc_html__('Portfolios List', 'tpcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();



        $repeater->add_control(
            'tp_portfolio_image',
            [
                'label' => esc_html__('Upload Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],

            ]
        );


        $repeater->add_control(
            'tp_portfolio_title', [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Portfolio Title', 'tpcore'),
                'label_block' => true,
            ]
        );


        $repeater->add_control(
            'tp_portfolios_cat',
            [
                'label' => esc_html__('Category', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Branding',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
         'tp_portfolio_video_switch',
         [
           'label'        => esc_html__( 'Add Video ?', 'tpcore' ),
           'type'         => \Elementor\Controls_Manager::SWITCHER,
           'label_on'     => esc_html__( 'Show', 'tpcore' ),
           'label_off'    => esc_html__( 'Hide', 'tpcore' ),
           'return_value' => 'yes',
           'default'      => 'no',
         ]
        );

        $repeater->add_control(
         'tp_portfolio_video_url',
         [
           'label'   => esc_html__( 'Add Video URL', 'tpcore' ),
           'type'        => \Elementor\Controls_Manager::URL,
           'default'     => [
               'url'               => '#',
               'is_external'       => true,
               'nofollow'          => true,
               'custom_attributes' => '',
             ],
             'placeholder' => esc_html__( 'Your URL', 'tpcore' ),
             'label_block' => true,
             'condition' => [
                'tp_portfolio_video_switch' => 'yes'
             ]
           ]
         );

        $repeater->add_control(
            'tp_portfolios_link_switcher',
            [
                'label' => esc_html__( 'Add Portfolios link', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'tpcore' ),
                'label_off' => esc_html__( 'No', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );
        $repeater->add_control(
            'tp_portfolios_btn_text',
            [
                'label' => esc_html__('Button Text', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'tpcore'),
                'title' => esc_html__('Enter button text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_portfolios_link_switcher' => 'yes'
                ],
            ]
        );
        $repeater->add_control(
            'tp_portfolios_link_type',
            [
                'label' => esc_html__( 'Portfolio Link Type', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'tp_portfolios_link_switcher' => 'yes'
                ]
            ]
        );
        $repeater->add_control(
            'tp_portfolios_link',
            [
                'label' => esc_html__( 'Portfolio Link link', 'tpcore' ),
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
                    'tp_portfolios_link_type' => '1',
                    'tp_portfolios_link_switcher' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'tp_portfolios_page_link',
            [
                'label' => esc_html__( 'Select Portfolio Link Page', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_portfolios_link_type' => '2',
                    'tp_portfolios_link_switcher' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'tp_portfolio_list',
            [
                'label' => esc_html__('Portfolios - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_portfolio_title' => esc_html__('Business Stratagy', 'tpcore'),
                    ],
                    [
                        'tp_portfolio_title' => esc_html__('Website Development', 'tpcore')
                    ],
                    [
                        'tp_portfolio_title' => esc_html__('Marketing & Reporting', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_portfolio_title }}}',
            ]
        );
        $this->add_responsive_control(
            'tp_portfolio_align',
            [
                'label' => esc_html__( 'Alignment', 'tpcore' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'tpcore' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'tpcore' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'tpcore' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'toggle' => true,
                'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );
        $this->end_controls_section();

        // colum controls
        $this->tp_columns('col');
    }

    protected function style_tab_content(){
        $this->tp_section_style_controls('services_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('services_subtitle', 'Section - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('services_title', 'Section - Title', '.tp-el-title');
        $this->tp_basic_style_controls('services_description', 'Section - Description', '.tp-el-content p');
        
        $this->tp_section_style_controls('services_section_box', 'Box - Style', '.tp-el-box');
        $this->tp_basic_style_controls('history_title', 'Portfolio - Title', '.tp-el-box-title');
        $this->tp_link_controls_style('history_tag', 'Portfolio - Tag', '.tp-el-box-tag span');
        $this->tp_link_controls_style('services_box_link_btn', 'Portfolio - Button', '.tp-el-box-btn');
        $this->tp_link_controls_style('services_box_link_video', 'Portfolio - Video - Button', '.tp-el-video-btn');
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
            $this->add_render_attribute('title_args', 'class', 'research__title');
        ?>



        <?php else:
            $this->add_render_attribute('title_args', 'class', 'section__title tp-el-title');

        ?>

         <!-- portfolio area start -->
         <section class="portfolio__area pt-110 pb-70 tp-el-section">
            <div class="container">
            <?php if ( !empty($settings['tp_portfolio_sec_section_title_show']) ) : ?>
               <div class="row">
                  <div class="col-xl-12">
                     <div class="section__title-wrapper-9 text-center mb-55 tp-el-content">

                        <?php if ( !empty($settings['tp_portfolio_sec_sub_title']) ) : ?>
                        <span class="section__title-pre-9 tp-el-subtitle">
                            <?php echo tp_kses( $settings['tp_portfolio_sec_sub_title'] ); ?>
                        </span>
                        <?php endif; ?>

                        <?php
                            if ( !empty($settings['tp_portfolio_sec_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['tp_portfolio_sec_title_tag'] ),
                                    $this->get_render_attribute_string( 'title_args' ),
                                    tp_kses( $settings['tp_portfolio_sec_title' ] )
                                    );
                            endif;
                        ?>

                        <?php if ( !empty($settings['tp_portfolio_sec_description']) ) : ?>
                            <p><?php echo tp_kses( $settings['tp_portfolio_sec_description'] ); ?></p>
                        <?php endif; ?>

                     </div>
                  </div>
               </div>
               <?php endif; ?>
               <div class="row tp-gx-4">
                    <?php foreach ($settings['tp_portfolio_list'] as $key => $item) :

                            if ( !empty($item['tp_portfolio_image']['url']) ) {
                                $tp_portfolio_image_url = !empty($item['tp_portfolio_image']['id']) ? wp_get_attachment_image_url( $item['tp_portfolio_image']['id'], $settings['thumbnail_size']) : $item['tp_portfolio_image']['url'];
                                $tp_portfolio_image_alt = get_post_meta($item["tp_portfolio_image"]["id"], "_wp_attachment_image_alt", true);
                            }  
                        // Link
                        if ('2' == $item['tp_portfolios_link_type']) {
                            $link = get_permalink($item['tp_portfolios_page_link']);
                            $target = '_self';
                            $rel = 'nofollow';
                        } else {
                            $link = !empty($item['tp_portfolios_link']['url']) ? $item['tp_portfolios_link']['url'] : '';
                            $target = !empty($item['tp_portfolios_link']['is_external']) ? '_blank' : '';
                            $rel = !empty($item['tp_portfolios_link']['nofollow']) ? 'nofollow' : '';
                        }
                    ?>
                  <div class="col-xl-<?php echo esc_attr($settings['tp_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['tp_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['tp_col_for_tablet']); ?> col-<?php echo esc_attr($settings['tp_col_for_mobile']); ?>">
                     <div class="portfolio__grid-item mb-40 wow fadeInUp tp-el-box" data-wow-delay=".3s" data-wow-duration="1s">
                        <div class="portfolio__grid-thumb w-img fix">
                           <a href="<?php echo esc_url($link); ?>">
                              <img src="<?php echo esc_url($tp_portfolio_image_url); ?>" alt="<?php echo esc_attr($tp_portfolio_image_alt); ?>">
                           </a>
                           <?php if($item['tp_portfolio_video_switch'] == 'yes') : ?>
                            <div class="portfolio__grid-video">
                              <a href="<?php echo esc_url($item['tp_portfolio_video_url']['url']); ?>" class="portfolio-play-btn popup-video tp-el-video-btn">
                                 <svg width="18" height="22" viewBox="0 0 18 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M18 11L0 21.3923V0.607696L18 11Z" fill="currentColor"/>
                                 </svg>                                    
                              </a>
                           </div>
                            <?php else : ?>
                                <div class="portfolio__grid-popup">
                                   <a href="<?php echo esc_url($tp_portfolio_image_url); ?>" class="popup-image tp-el-box-btn" data-effect="mfp-zoom-in">
                                      <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                         <path d="M14.1667 8.33341H0.833333C0.377778 8.33341 0 7.95564 0 7.50008C0 7.04453 0.377778 6.66675 0.833333 6.66675H14.1667C14.6222 6.66675 15 7.04453 15 7.50008C15 7.95564 14.6222 8.33341 14.1667 8.33341Z" fill="currentColor"/>
                                         <path d="M7.4974 15C7.04184 15 6.66406 14.6222 6.66406 14.1667V0.833333C6.66406 0.377778 7.04184 0 7.4974 0C7.95295 0 8.33073 0.377778 8.33073 0.833333V14.1667C8.33073 14.6222 7.95295 15 7.4974 15Z" fill="currentColor"/>
                                      </svg>                                    
                                   </a>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="portfolio__grid-content">
                           <?php if (!empty($item['tp_portfolio_title' ])): ?>
                                <h3 class="portfolio__grid-title tp-el-box-title">
                                    <?php if ($item['tp_portfolios_link_switcher'] == 'yes') : ?>
                                    <a href="<?php echo esc_url($link); ?>"><?php echo tp_kses($item['tp_portfolio_title' ]); ?></a>
                                    <?php else : ?>
                                    <?php echo tp_kses($item['tp_portfolio_title' ]); ?>
                                    <?php endif; ?>
                                </h3>
                            <?php endif; ?>
                           <div class="portfolio__grid-bottom">
                              <div class="portfolio__grid-category tp-el-box-tag">
                                 <span>
                                 <?php echo tp_kses($item['tp_portfolios_cat']); ?>
                                 </span>
                              </div>
                              <?php if (!empty($link)) : ?>
                              <div class="portfolio__grid-show-project">
                                 <a class="portfolio-link-btn tp-el-box-btn" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>">
                                 <?php echo tp_kses($item['tp_portfolios_btn_text']); ?>
                                    <span>
                                       <svg width="26" height="9" viewBox="0 0 26 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <path d="M21.6934 1L25 4.20003L21.6934 7.4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                          <path d="M0.999999 4.19897H25" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                       </svg>
                                    </span>
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
         <!-- portfolio area end -->

        <?php endif; ?>

        <?php
    }
}

$widgets_manager->register( new TP_Portfolio_Box() );
