<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Control_Media;
use \Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Portfolio_Slider extends Widget_Base {

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
		return 'tp-portfolio-slider';
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
		return __( 'Portfolio Slider', 'tpcore' );
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
         'tp_portfolio_sec',
             [
               'label' => esc_html__( 'Portfolio Slider', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
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
                ]
            ]
        );
        $repeater->add_control(
            'tp_portfolio_cat',
                [
                    'label'       => esc_html__( 'Category', 'tpcore' ),
                    'type'        => \Elementor\Controls_Manager::TEXT,
                    'default'     => esc_html__( 'Category', 'tpcore' ),
                    'placeholder' => esc_html__( 'Your Category', 'tpcore' ),
                    'label_block' => true,
                ]
        );
        $repeater->add_control(
            'tp_portfolio_meta',
                [
                    'label'       => esc_html__( 'Meta', 'tpcore' ),
                    'type'        => \Elementor\Controls_Manager::TEXT,
                    'default'     => esc_html__( '24 Jan, 2022', 'tpcore' ),
                    'placeholder' => esc_html__( 'Your Meta', 'tpcore' ),
                    'label_block' => true,
                ]
        );
        
         $repeater->add_control(
         'tp_portfolio_box_title',
           [
             'label'   => esc_html__( 'Portfolio Title', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::TEXT,
             'default'     => esc_html__( 'Default-value', 'tpcore' ),
             'label_block' => true,
           ]
         );
         
         $repeater->add_control(
            'tp_portfolio_link_switcher',
            [
                'label' => esc_html__( 'Add Portfolio link', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'tpcore' ),
                'label_off' => esc_html__( 'No', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );
        $repeater->add_control(
            'tp_portfolio_btn_text',
            [
                'label' => esc_html__('Button Text', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'tpcore'),
                'title' => esc_html__('Enter button text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_portfolio_link_switcher' => 'yes',
                ],
            ]
        );
        $repeater->add_control(
            'tp_portfolio_link_type',
            [
                'label' => esc_html__( 'Portfolio Link Type', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'tp_portfolio_link_switcher' => 'yes'
                ]
            ]
        );
        $repeater->add_control(
            'tp_portfolio_link',
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
                    'tp_portfolio_link_type' => '1',
                    'tp_portfolio_link_switcher' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'tp_portfolio_page_link',
            [
                'label' => esc_html__( 'Select Portfolio Link Page', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_portfolio_link_type' => '2',
                    'tp_portfolio_link_switcher' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'tp_portfolio_description', [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('One morning, when Gregor Samsa woke from troubled dreams', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
         'tp_portfolio_video_url',
         [
           'label'   => esc_html__( 'Add Video', 'tpcore' ),
           'type'        => \Elementor\Controls_Manager::URL,
           'default'     => [
               'url'               => '#',
               'is_external'       => true,
               'nofollow'          => true,
               'custom_attributes' => '',
             ],
             'placeholder' => esc_html__( 'Your URL', 'tpcore' ),
             'label_block' => true,
           ]
         );
         
         $this->add_control(
           'tp_portfolio_list',
           [
             'label'       => esc_html__( 'Portfolio List', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::REPEATER,
             'fields'      => $repeater->get_controls(),
             'default'     => [
                [
                    'tp_portfolio_box_title' => esc_html__('Business Stratagy', 'tpcore'),
                ],
                [
                    'tp_portfolio_box_title' => esc_html__('Website Development', 'tpcore')
                ],
                [
                    'tp_portfolio_box_title' => esc_html__('Marketing & Reporting', 'tpcore')
                ],
             ],
             'title_field' => '{{{ tp_portfolio_box_title }}}',
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

        $this->start_controls_section(
         'tp_social_sec',
             [
               'label' => esc_html__( 'Social', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
             ]
        );
        
        $this->add_control(
        'tp_social_title',
         [
            'label'       => esc_html__( 'Social Title', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( 'Follow Us :', 'tpcore' ),
            'placeholder' => esc_html__( 'Your Title', 'tpcore' ),
            'label_block' => true
         ]
        );
        
        $repeater = new \Elementor\Repeater();
        
        $repeater->add_control(
        'social_title',
         [
            'label'       => esc_html__( 'Social Title', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( 'Fb', 'tpcore' ),
            'placeholder' => esc_html__( 'Your Title', 'tpcore' ),
            'label_block' => true
         ]
        );
         $repeater->add_control(
          'social_url',
          [
            'label'   => esc_html__( 'Social Title', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::URL,
            'default'     => [
                'url'               => '#',
                'is_external'       => true,
                'nofollow'          => true,
                'custom_attributes' => '',
              ],
              'placeholder' => esc_html__( 'Social Url', 'tpcore' ),
              'label_block' => true,
            ]
          );
         
         $this->add_control(
           'tp_social_list',
           [
             'label'       => esc_html__( 'Social List', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::REPEATER,
             'fields'      => $repeater->get_controls(),
             'default'     => [
               [
                 'social_title'   => esc_html__( 'Fb', 'tpcore' ),
               ],
               [
                 'social_title'   => esc_html__( 'Be', 'tpcore' ),
               ],
               [
                 'social_title'   => esc_html__( 'Yt', 'tpcore' ),
               ],
             ],
             'title_field' => '{{{ social_title }}}',
           ]
         );
        
        $this->end_controls_section();


	}

    // style_tab_content
    protected function style_tab_content(){
        // $this->tp_section_style_controls('video_section', 'Section - Style', '.tp-el-section');
        // $this->tp_basic_style_controls('section_title', 'Section - Title', '.tp-el-title');
        // $this->tp_basic_style_controls('section_subtitle', 'Section - Subtitle', '.tp-el-subtitle');
        // $this->tp_basic_style_controls('section_description', 'Section - Description', '.tp-el-content p');
        // $this->tp_link_controls_style('video_box_play_btn', 'Video - Button', '.tp-el-box-btn');

        $this->tp_section_style_controls('portfolio_section', 'Section - Style', '.tp-el-section');

        $this->tp_section_style_controls('services_section_box', 'Box - Style', '.tp-el-box');
        $this->tp_basic_style_controls('history_title', 'Portfolio - Title', '.tp-el-box-title');
        $this->tp_basic_style_controls('history_desc', 'Portfolio - Description', '.tp-el-box-desc');
        $this->tp_link_controls_style('history_tag', 'Portfolio - Tag', '.tp-el-box-tag span');
        $this->tp_link_controls_style('services_box_link_btn', 'Portfolio - Button', '.tp-el-box-btn');
        $this->tp_link_controls_style('services_box_link_video', 'Portfolio - Video - Button', '.tp-el-video-btn');

        $this->tp_basic_style_controls('slider_social_title', 'Social - Title', '.tp-el-social-title');
        $this->tp_link_controls_style('slider_social_link', 'Social - Link', '.tp-el-social-link');

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
            $bloginfo = get_bloginfo( 'name' );
		?> 
         

		<?php else:
         $bloginfo = get_bloginfo( 'name' );
			$this->add_render_attribute('title_args', 'class', 'video__title tp-el-title');
		?>


         <!-- portfolio area start -->
         <section class="portfolio__horizontal p-relative">
            <div class="portfolio__horizontal-social">

                <?php if(!empty($settings['tp_social_title'])) : ?>
                <span class="tp-el-social-title"><?php echo tp_kses($settings['tp_social_title']); ?></span>
                <?php endif; ?>

                <?php foreach ($settings['tp_social_list'] as $item) : ?>
                    <?php if(!empty($item['social_url']['url'])) : ?>
                    <a class="tp-el-social-link" href="<?php echo esc_url($item['social_url']['url']) ?>"><?php echo tp_kses($item['social_title']); ?></a>
                    <?php endif; ?>
                <?php endforeach; ?>  
            </div>
            <div class="portfolio__horizontal-slider">
               <div class="portfolio__horizontal-active swiper-container">
                  <div class="swiper-wrapper">
                    <?php foreach ($settings['tp_portfolio_list'] as $item) :
                        if ( !empty($item['tp_portfolio_image']['url']) ) {
                            $tp_portfolio_image_url = !empty($item['tp_portfolio_image']['id']) ? wp_get_attachment_image_url( $item['tp_portfolio_image']['id'], $settings['thumbnail_size']) : $item['tp_portfolio_image']['url'];
                            $tp_portfolio_image_alt = get_post_meta($item["tp_portfolio_image"]["id"], "_wp_attachment_image_alt", true);
                        }
                        // Link
                        if ('2' == $item['tp_portfolio_link_type']) {
                            $link = get_permalink($item['tp_portfolio_page_link']);
                            $target = '_self';
                            $rel = 'nofollow';
                        } else {
                            $link = !empty($item['tp_portfolio_link']['url']) ? $item['tp_portfolio_link']['url'] : '';
                            $target = !empty($item['tp_portfolio_link']['is_external']) ? '_blank' : '';
                            $rel = !empty($item['tp_portfolio_link']['nofollow']) ? 'nofollow' : '';
                        }

                    ?>
                     <div class="portfolio__horizontal-item swiper-slide">
                        <div class="portfolio__horizontal-thumb include-bg" data-background="<?php echo esc_url($tp_portfolio_image_url); ?>"></div>
                        <div class="portfolio__horizontal-inner tp-el-box">
                           <div class="container">
                              <div class="row">
                                 <div class="col-xxl-9 col-xl-10">
                                    <div class="portfolio__horizontal-wrapper d-md-flex align-items-start">
                                        <?php if(!empty($item['tp_portfolio_video_url']['url'])) : ?>
                                        <div class="portfolio__horizontal-video">
                                            <a href="<?php echo esc_url($item['tp_portfolio_video_url']['url']); ?>" class="popup-video tp-el-video-btn">
                                                <svg width="14" height="18" viewBox="0 0 18 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M18 11L0 21.3923V0.607696L18 11Z" fill="currentColor"/>
                                                </svg>                                             
                                            </a>
                                        </div>
                                        <?php endif; ?>
                                       <div class="portfolio__horizontal-content">
                                          <div class="portfolio__horizontal-meta tp-el-box-tag">
                                                <?php if(!empty($item['tp_portfolio_cat'])) : ?>
                                                <span><?php  echo tp_kses($item['tp_portfolio_cat']); ?></span>
                                                <?php endif; ?>

                                                <?php if(!empty($item['tp_portfolio_meta'])) : ?>
                                                <span><?php  echo tp_kses($item['tp_portfolio_meta']); ?></span>
                                                <?php endif; ?>
                                          </div>


                                            <h3 class="portfolio__horizontal-title tp-el-box-title">
                                                <?php if ($item['tp_portfolio_link_switcher'] == 'yes') : ?>
                                                <a href="<?php echo esc_url($link); ?>"><?php echo tp_kses($item['tp_portfolio_box_title' ]); ?></a>
                                                <?php else : ?>
                                                    <?php echo tp_kses($item['tp_portfolio_box_title' ]); ?>
                                                <?php endif; ?>
                                            </h3>

                                            <?php if (!empty($item['tp_portfolio_description' ])): ?>
                                            <p class="tp-el-box-desc"><?php echo tp_kses($item['tp_portfolio_description' ]); ?></p>
                                            <?php endif; ?>
   
                                            <?php if (!empty($link)) : ?>
                                          <div class="portfolio__horizontal-btn">
                                             <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>" class="tp-btn-border tp-link-btn tp-el-box-btn">
                                             <?php echo tp_kses($item['tp_portfolio_btn_text']); ?>
                                                <span>
                                                   <svg width="26" height="9" viewBox="0 0 26 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                      <path d="M21.6934 1L25 4.20003L21.6934 7.4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                      <path d="M0.999999 4.19897H25" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                   </svg>
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
                           </div>
                        </div>
                     </div>
                     <?php endforeach; ?>  
                  </div>
               </div>
               <div class="portfolio-horizontal-dot d-none d-sm-flex"></div>
            </div>
         </section>
         <!-- portfolio area end -->


        <?php endif; ?>

        <?php

	}

}

$widgets_manager->register( new TP_Portfolio_Slider() );