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
class TP_Banner extends Widget_Base {

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
        return 'tp-banner';
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
        return __( 'Banner', 'tpcore' );
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
        'tp_banner_subtitle',
         [
            'label'       => esc_html__( 'Banner Subtitle', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( 'About Us', 'tpcore' ),
            'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
            'label_block' => true,
            'condition' => [
                'tp_design_style' => ['layout-1', 'layout-3','layout-4']
            ]
         ]
        );
        
        $this->add_control(
        'tp_banner_title',
         [
            'label'       => esc_html__( 'Banner Title', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( 'Need a design expert?', 'tpcore' ),
            'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
            'label_block' => true
         ]
        );

        $this->add_control(
         'tp_banner_desc',
         [
           'label'       => esc_html__( 'Description', 'Text-domain' ),
           'type'        => \Elementor\Controls_Manager::TEXTAREA,
           'rows'        => 10,
           'default'     => esc_html__( 'Harry IT allows your business and technology computers to store,', 'Text-domain' ),
           'placeholder' => esc_html__( 'Your Description', 'Text-domain' ),
           'condition' => [
                'tp_design_style' => 'layout-3'
           ]
         ]
        );
        
        $this->end_controls_section();

        // _tp_image
		$this->start_controls_section(
            '_tp_image',
            [
                'label' => esc_html__('Thumbnail', 'tp-core'),
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
        $this->tp_section_style_controls('about_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('about_subtitle', 'Section - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('about_title', 'Section - Title', '.tp-el-title');
        $this->tp_basic_style_controls('about_description', 'Section - Description', '.tp-el-content p');
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

        <!-- about me area start -->
        <section class="about__me about__me-spacing about__me-translate include-bg tp-el-section" data-background="<?php echo esc_url($tp_image); ?>">
            <div class="container">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="about__me-content" data-parallax='{"x": -100, "smoothness": 10}'>
                        <?php if(!empty($settings['tp_banner_title'])) : ?>
                        <h3 class="about__me-title tp-el-title"><?php echo tp_kses($settings['tp_banner_title']); ?></h3>
                        <?php endif; ?>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- about me area end -->

         <?php elseif ( $settings['tp_design_style']  == 'layout-3' ):
            $this->add_render_attribute('title_args', 'class', 'research__title');
            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }
        ?>

         <!-- breadcrumb area start -->
         <section class="breadcrumb__area breadcrumb__style-5 p-relative include-bg pt-170 pb-110 blue-bg tp-el-section">
            <div class="breadcrumb__bg bg-luminosity include-bg" data-background="<?php echo esc_url($tp_image); ?>"></div>
            <div class="container">
               <div class="row align-items-end">
                  <div class="col-xxl-7 col-lg-7">
                     <div class="breadcrumb__content breadcrumb__content-2 p-relative z-index-1">

                        <?php if(!empty($settings['tp_banner_subtitle'])) : ?>
                        <span class="breadcrumb__title-pre tp-el-subtitle"><?php echo tp_kses($settings['tp_banner_subtitle']); ?></span>
                        <?php endif; ?>

                        <?php if(!empty($settings['tp_banner_title'])) : ?>                        
                        <h3 class="breadcrumb__title tp-el-title"><?php echo tp_kses($settings['tp_banner_title']); ?></h3>
                        <?php endif; ?>
                     </div>
                  </div>
                  <?php if(!empty($settings['tp_banner_desc'])) : ?>    
                  <div class="col-xxl-5 col-lg-5">
                     <div class="breadcrumb__content breadcrumb__content-2 p-relative z-index-1 tp-el-content">
                        <p><?php echo tp_kses($settings['tp_banner_desc']);?></p>
                     </div>
                  </div>
                  <?php endif; ?>
               </div>
            </div>
         </section>
         <!-- breadcrumb area end -->

         <?php elseif ( $settings['tp_design_style']  == 'layout-4' ):
            $this->add_render_attribute('title_args', 'class', 'research__title');
            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }
        ?>

        <!-- breadcrumb area start -->
        <section class="breadcrumb__area breadcrumb__style-5 p-relative include-bg pt-170 pb-110 blue-bg tp-el-section">
            <div class="breadcrumb__bg bg-luminosity include-bg" data-background="<?php echo esc_url($tp_image); ?>"></div>
            <div class="container">
               <div class="row">
                  <div class="col-xxl-8">
                     <div class="breadcrumb__content breadcrumb__content-2 p-relative z-index-1">

                        <?php if(!empty($settings['tp_banner_subtitle'])) : ?>
                        <span class="breadcrumb__title-pre tp-el-subtitle"><?php echo tp_kses($settings['tp_banner_subtitle']); ?></span>
                        <?php endif; ?>

                        <?php if(!empty($settings['tp_banner_title'])) : ?>                        
                        <h3 class="breadcrumb__title tp-el-title"><?php echo tp_kses($settings['tp_banner_title']); ?></h3>
                        <?php endif; ?>
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

         <!-- about top area start -->
         <section class="about__heading about__heading-overlay about__spacing include-bg jarallax tp-el-section" data-background="<?php echo esc_url($tp_image); ?>">
            <div class="container">
               <div class="row justify-content-center">
                  <div class="col-xl-8 col-lg-10">
                     <div class="about__heading-content text-center p-relative z-index-1">
                        <?php if(!empty($settings['tp_banner_subtitle'])) : ?>
                        <span class="about__heading-subtitle tp-el-subtitle"><?php echo tp_kses($settings['tp_banner_subtitle']); ?></span>
                        <?php endif; ?>

                        <?php if(!empty($settings['tp_banner_title'])) : ?>
                        <h3 class="about__heading-title tp-el-title"><?php echo tp_kses($settings['tp_banner_title']); ?></h3>
                        <?php endif; ?>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- about top area end -->


        <?php endif; ?>

        <?php
    }
}

$widgets_manager->register( new TP_Banner() );
