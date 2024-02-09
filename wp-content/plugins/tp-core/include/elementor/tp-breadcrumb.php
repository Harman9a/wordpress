<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;
use Elementor\Core\Utils\ImportExport\Url;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Breadcrumb extends Widget_Base {

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
        return 'tp-breadcrumb';
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
        return __( 'TP Breadcrumb', 'tpcore' );
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
                    'layout-2' => esc_html__('Layout 2', 'tp-core'),
                    'layout-3' => esc_html__('Layout 3', 'tp-core'),
                    'layout-4' => esc_html__('Layout 4', 'tp-core'),
                    'layout-5' => esc_html__('Layout 5', 'tp-core'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
         'tp_banner_sec',
             [
               'label' => esc_html__( 'Title & Content', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
             ]
        );
        
        $this->add_control(
        'tp_breadcrumb_subtitle',
         [
            'label'       => esc_html__( 'Breadcrumb Subtitle', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( 'About Us', 'tpcore' ),
            'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
            'label_block' => true,
            'condition'=> [
                'tp_design_style' => 'layout-2'
            ]
         ]
        );
        
        $this->add_control(
        'tp_breadcrumb_title',
         [
            'label'       => esc_html__( 'Breadcrumb Title', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( 'Keep it Minimal, yet Expressive', 'tpcore' ),
            'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
            'label_block' => true
         ]
        );

        $this->add_control(
         'tp_breadcrumb_desc',
         [
           'label'       => esc_html__( 'Description', 'tpcore' ),
           'type'        => \Elementor\Controls_Manager::TEXTAREA,
           'rows'        => 10,
           'default'     => esc_html__( 'Harry IT allows your business and technology computers to store,', 'tpcore' ),
           'placeholder' => esc_html__( 'Your Description', 'tpcore' ),
           'condition'=> [
                'tp_design_style' => 'layout-2'
            ]
         ]
        );

        $this->add_control(
         'tp_breadcrumb_shape_switch',
         [
           'label'        => esc_html__( 'Enable Shape', 'tpcore' ),
           'type'         => \Elementor\Controls_Manager::SWITCHER,
           'label_on'     => esc_html__( 'Show', 'tpcore' ),
           'label_off'    => esc_html__( 'Hide', 'tpcore' ),
           'return_value' => 'yes',
           'default'      => 'yes',
           'condition'=> [
                'tp_design_style' => ['layout-3', 'layout-5']
            ]
         ]
        );
        
        $this->end_controls_section();

       $this->start_controls_section(
        'tp_breadcrumb_video_sec',
            [
              'label' => esc_html__( 'Video', 'tpcore' ),
              'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
              'condition'=> [
                    'tp_design_style' => 'layout-1'
                ]
            ]
       );
       
       $this->add_control(
        'tp_breadcrumb_video_url',
        [
          'label'   => esc_html__( 'Add URL', 'tpcore' ),
          'type'        => \Elementor\Controls_Manager::URL,
          'default'     => [
              'url'               => '#',
              'is_external'       => true,
              'nofollow'          => true,
              'custom_attributes' => '',
            ],
            'placeholder' => esc_html__( 'Enter Your Url', 'tpcore' ),
            'label_block' => true,
          ]
        );
       
       $this->end_controls_section();

        // _tp_image
		$this->start_controls_section(
            '_tp_image',
            [
                'label' => esc_html__('Thumbnail', 'tp-core'),
                'condition' => [
                    'tp_design_style' => ['layout-1', 'layout-2', 'layout-3']
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
                ]
            ]
        );
        $this->end_controls_section();
    }

    protected function style_tab_content(){
		$this->tp_section_style_controls('services_section', 'Section - Style', '.tp-el-section');
        
        $this->tp_basic_style_controls('services_box_title', 'Box - Title', '.tp-el-title');
        $this->tp_basic_style_controls('services_box_list', 'Box - List', '.tp-el-list span');
        $this->tp_basic_style_controls('services_box_description', 'Box - Description', '.tp-el-content p');
        $this->tp_link_controls_style('services_box_btn', 'Video - Button', '.tp-el-video-btn');
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
            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }
        ?>


         <!-- breadcrumb area start -->
         <section class="breadcrumb__area breadcrumb__style-3 breadcrumb__spacing-2 include-bg pt-200 pb-235 grey-bg-4 tp-el-section" data-background="<?php echo esc_url($tp_image); ?>">
            <div class="container">
               <div class="row">
                  <div class="col-xxl-7">
                     <div class="breadcrumb__content p-relative z-index-1 tp-el-content">
                        <div class="breadcrumb__list tp-el-list ">
                            <?php if(function_exists('bcn_display')) {
                                bcn_display();
                            } ?>
                        </div>
                        <?php if(!empty($settings['tp_breadcrumb_title'])) : ?>                        
                        <h3 class="breadcrumb__title tp-el-title"><?php echo tp_kses($settings['tp_breadcrumb_title']); ?></h3>
                        <?php endif; ?>

                        <?php if(!empty($settings['tp_breadcrumb_desc'])) : ?>  
                        <p><?php echo tp_kses($settings['tp_breadcrumb_desc']); ?></p>
                        <?php endif; ?>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- breadcrumb area end -->

         <?php elseif ( $settings['tp_design_style']  == 'layout-3' ):
            $this->add_render_attribute('title_args', 'class', 'research__title');
            $bloginfo = get_bloginfo( 'name' );  

            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }
        ?>

         <!-- breadcrumb area start -->
         <section class="breadcrumb__area breadcrumb__style-7 breadcrumb__bg-3 p-relative z-index-1 include-bg pt-180 pb-100 purple-bg tp-el-section">
            <div class="breadcrumb__bg-shape include-bg" data-background="<?php echo esc_url($tp_image); ?>"></div>

            <?php if(!empty($settings['tp_breadcrumb_shape_switch'])) :?>
            <div class="breadcrumb__shape">
               <img class="breadcrumb__shape-1" src="<?php echo get_template_directory_uri() . '/assets/img/breadcrumb/breadcrumb-dot-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="breadcrumb__shape-2" src="<?php echo get_template_directory_uri() . '/assets/img/breadcrumb/breadcrumb-dot-2.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
            </div>
            <?php endif; ?>

            <div class="container">
               <div class="row justify-content-center">
                  <div class="col-xxl-7 col-xl-8 col-lg-9">
                     <div class="breadcrumb__content breadcrumb__content-2 p-relative z-index-1 text-center">

                        <?php if(!empty($settings['tp_breadcrumb_title'])) : ?>                        
                        <h3 class="breadcrumb__title tp-el-title"><?php echo tp_kses($settings['tp_breadcrumb_title']); ?></h3>
                        <?php endif; ?>
                        <div class="breadcrumb__list tp-el-list">
                            <?php if(function_exists('bcn_display')) {
                                bcn_display();
                            } ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- breadcrumb area end -->

        <?php elseif ( $settings['tp_design_style']  == 'layout-4' ):
            $this->add_render_attribute('title_args', 'class', 'research__title');
            $bloginfo = get_bloginfo( 'name' );  

            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }
        ?>

         <!-- breadcrumb area start -->
         <section class="breadcrumb__area breadcrumb__style-8 p-relative include-bg pt-110 pb-50 tp-el-section">
            <div class="container">
               <div class="row justify-content-center">
                  <div class="col-xxl-8 col-xl-8 col-lg-10">
                     <div class="breadcrumb__content text-center p-relative z-index-1">
                        <?php if(!empty($settings['tp_breadcrumb_title'])) : ?>                        
                        <h3 class="breadcrumb__title tp-el-title"><?php echo tp_kses($settings['tp_breadcrumb_title']); ?></h3>
                        <?php endif; ?>

                        <div class="breadcrumb__list tp-el-list">
                            <?php if(function_exists('bcn_display')) {
                                bcn_display();
                            } ?>
                        </div>
                        
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- breadcrumb area end -->



        <?php elseif ( $settings['tp_design_style']  == 'layout-5' ):
            $this->add_render_attribute('title_args', 'class', 'research__title');
            $bloginfo = get_bloginfo( 'name' );  
        ?>

         <!-- breadcrumb area start -->
         <section class="breadcrumb__area include-bg pt-110 pb-115 white-bg p-relative z-index-1 tp-el-section">
         <?php if(!empty($settings['tp_breadcrumb_shape_switch'])) :?>
            <div class="breadcrumb__shape">
               <img class="breadcrumb__shape-3" src="<?php echo get_template_directory_uri() . '/assets/img/breadcrumb/shape/breadcrumb-shape-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="breadcrumb__shape-4" src="<?php echo get_template_directory_uri() . '/assets/img/breadcrumb/shape/breadcrumb-shape-2.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="breadcrumb__shape-5" src="<?php echo get_template_directory_uri() . '/assets/img/breadcrumb/shape/breadcrumb-shape-3.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="breadcrumb__shape-6" src="<?php echo get_template_directory_uri() . '/assets/img/breadcrumb/shape/breadcrumb-shape-4.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="breadcrumb__shape-7" src="<?php echo get_template_directory_uri() . '/assets/img/breadcrumb/shape/breadcrumb-shape-5.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
            </div>
            <?php endif; ?>
            <div class="container">
               <div class="row">
                  <div class="col-xxl-7">
                     <div class="breadcrumb__content p-relative z-index-1">
                        <?php if(!empty($settings['tp_breadcrumb_title'])) : ?>                        
                        <h3 class="breadcrumb__title tp-el-title"><?php echo tp_kses($settings['tp_breadcrumb_title']); ?></h3>
                        <?php endif; ?>
                        <div class="breadcrumb__list tp-el-list">
                            <?php if(function_exists('bcn_display')) {
                                bcn_display();
                            } ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- breadcrumb area end -->

        <?php else:
            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }
        ?>

        <!-- breadcrumb area start -->
        <section class="breadcrumb__area breadcrumb__style-4 breadcrumb__spacing include-bg grey-bg-4 tp-el-section" data-background="<?php echo esc_url($tp_image); ?>">
            <div class="container">
               <div class="row justify-content-end">
                  <div class="col-xl-7 col-lg-9">
                     <div class="breadcrumb__content p-relative z-index-1">

                        <?php if(!empty($settings['tp_breadcrumb_video_url']['url'])): ?>
                        <div class="breadcrumb__video mb-30">
                           <a href="<?php echo esc_url($settings['tp_breadcrumb_video_url']['url']); ?>" class="breadcrumb__video-btn popup-video tp-el-video-btn">
                              <svg width="14" height="18" viewBox="0 0 18 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path d="M18 11L0 21.3923V0.607696L18 11Z" fill="currentColor"/>
                              </svg>                                 
                           </a>
                        </div>
                        <?php endif; ?>

                        <div class="breadcrumb__list tp-el-list">
                           <?php if(function_exists('bcn_display')) {
                                bcn_display();
                            } ?>
                        </div>


                        <?php if(!empty($settings['tp_breadcrumb_title'])) : ?>                        
                        <h3 class="breadcrumb__title tp-el-title"><?php echo tp_kses($settings['tp_breadcrumb_title']); ?></h3>
                        <?php endif; ?>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- breadcrumb area end -->



        <?php endif; ?>

        <?php
    }
}

$widgets_manager->register( new TP_Breadcrumb() );
