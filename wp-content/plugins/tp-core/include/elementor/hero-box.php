<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Control_Media;
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
class TP_Hero_Box extends Widget_Base {

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
		return 'hero-box';
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
		return __( 'Hero Box', 'tp-core' );
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


    protected static function get_profile_names()
    {
        return [
            'apple' => esc_html__('Apple', 'tp-core'),
            'behance' => esc_html__('Behance', 'tp-core'),
            'bitbucket' => esc_html__('BitBucket', 'tp-core'),
            'codepen' => esc_html__('CodePen', 'tp-core'),
            'delicious' => esc_html__('Delicious', 'tp-core'),
            'deviantart' => esc_html__('DeviantArt', 'tp-core'),
            'digg' => esc_html__('Digg', 'tp-core'),
            'dribbble' => esc_html__('Dribbble', 'tp-core'),
            'email' => esc_html__('Email', 'tp-core'),
            'facebook' => esc_html__('Facebook', 'tp-core'),
            'flickr' => esc_html__('Flicker', 'tp-core'),
            'foursquare' => esc_html__('FourSquare', 'tp-core'),
            'github' => esc_html__('Github', 'tp-core'),
            'houzz' => esc_html__('Houzz', 'tp-core'),
            'instagram' => esc_html__('Instagram', 'tp-core'),
            'jsfiddle' => esc_html__('JS Fiddle', 'tp-core'),
            'linkedin' => esc_html__('LinkedIn', 'tp-core'),
            'medium' => esc_html__('Medium', 'tp-core'),
            'pinterest' => esc_html__('Pinterest', 'tp-core'),
            'product-hunt' => esc_html__('Product Hunt', 'tp-core'),
            'reddit' => esc_html__('Reddit', 'tp-core'),
            'slideshare' => esc_html__('Slide Share', 'tp-core'),
            'snapchat' => esc_html__('Snapchat', 'tp-core'),
            'soundcloud' => esc_html__('SoundCloud', 'tp-core'),
            'spotify' => esc_html__('Spotify', 'tp-core'),
            'stack-overflow' => esc_html__('StackOverflow', 'tp-core'),
            'tripadvisor' => esc_html__('TripAdvisor', 'tp-core'),
            'tumblr' => esc_html__('Tumblr', 'tp-core'),
            'twitch' => esc_html__('Twitch', 'tp-core'),
            'twitter' => esc_html__('Twitter', 'tp-core'),
            'vimeo' => esc_html__('Vimeo', 'tp-core'),
            'vk' => esc_html__('VK', 'tp-core'),
            'website' => esc_html__('Website', 'tp-core'),
            'whatsapp' => esc_html__('WhatsApp', 'tp-core'),
            'wordpress' => esc_html__('WordPress', 'tp-core'),
            'xing' => esc_html__('Xing', 'tp-core'),
            'yelp' => esc_html__('Yelp', 'tp-core'),
            'youtube' => esc_html__('YouTube', 'tp-core'),
        ];
    }


    public function get_tp_contact_form(){
        if ( ! class_exists( 'WPCF7' ) ) {
            return;
        }
        $tp_cfa         = array();
        $tp_cf_args     = array( 'posts_per_page' => -1, 'post_type'=> 'wpcf7_contact_form' );
        $tp_forms       = get_posts( $tp_cf_args );
        $tp_cfa         = ['0' => esc_html__( 'Select Form', 'tpcore' ) ];
        if( $tp_forms ){
            foreach ( $tp_forms as $tp_form ){
                $tp_cfa[$tp_form->ID] = $tp_form->post_title;
            }
        }else{
            $tp_cfa[ esc_html__( 'No contact form found', 'tpcore' ) ] = 0;
        }
        return $tp_cfa;
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->tp_section_title_render_controls('slider', 'Slider Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.');


        // tp_btn_button_group
        $this->tp_button_render('slider', 'Button', ['layout-1']);

        // _tp_image
        $this->start_controls_section(
            '_tp_image_section',
            [
                'label' => esc_html__('BG Image', 'tp-core'),
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
        $this->add_control(
            'tp_image_bg',
            [
                'label' => esc_html__( 'Choose Background Image', 'tp-core' ),
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



        $this->start_controls_section(
         'tp_slider_shape',
             [
               'label' => esc_html__( 'Border Effect', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
             ]
        );

        $this->add_control(
            'tp_slider_border_switch',
            [
                'label'        => esc_html__( 'Effect On/Off', 'tpcore' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'tpcore' ),
                'label_off'    => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );
        
        $this->end_controls_section();


	}
    

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('hero_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('hero_subtitle', 'Hero - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('hero_title', 'Hero - Title', '.tp-el-title');
        $this->tp_basic_style_controls('hero_description', 'Hero - Description', '.tp-el-content p');
        $this->tp_link_controls_style('hero_button', 'Hero - Button', '.tp-el-box-btn');
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

            $bloginfo = get_bloginfo( 'name' );
            $this->add_render_attribute('title_args', 'class', 'slider__title-2 tp-el-title');

        ?>

		<?php else: 
            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }

            if ( !empty($settings['tp_image_bg']['url']) ) {
                $tp_image_bg = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image_bg']['id'], $settings['tp_image_size_size']) : $settings['tp_image_bg']['url'];
                $tp_image_bg_alt = get_post_meta($settings["tp_image_bg"]["id"], "_wp_attachment_image_alt", true);
            }


            if ( ! empty( $settings['tp_slider_mouse_link']['url'] ) ) {
                $this->add_link_attributes( 'tp-button-text-arg', $settings['tp_slider_mouse_link'] );
                $this->add_link_attributes( 'tp-button-arg', $settings['tp_slider_mouse_link'] );
                $this->add_render_attribute('tp-button-arg', 'class', 'mouse-scroll-icon mouse-scroll-icon-4');
            }

            // btn Link
            if ('2' == $settings['tp_slider_btn_link_type']) {
                $link = get_permalink($settings['tp_slider_btn_page_link']);
                $target = '_self';
                $rel = 'nofollow';
            } else {
                $link = !empty($settings['tp_slider_btn_link']['url']) ? $settings['tp_slider_btn_link']['url'] : '';
                $target = !empty($settings['tp_slider_btn_link']['is_external']) ? '_blank' : '';
                $rel = !empty($settings['tp_slider_btn_link']['nofollow']) ? 'nofollow' : '';
            }

            $bloginfo = get_bloginfo( 'name' );
			$this->add_render_attribute('title_args', 'class', 'slider__title-10 tp-el-title');
		?>

         <!-- slider area start -->
         <section class="slider__area fix">
            <div class="slider__item-10 slider__height-10 d-flex align-items-center black-bg-17 p-relative z-index-1 tp-el-section">
               <div class="slider__bg-10 include-bg jarallax" data-background="<?php echo esc_url($tp_image_bg); ?>"></div>
               <div class="container">
                  <div class="row align-items-center">
                     <div class="col-xxl-7 col-xl-6 col-lg-6 col-md-6 col-sm-8">
                        <div class="slider__content-10 mb-60 tp-el-content">

                           <?php if (!empty($settings['tp_slider_sub_title'])) : ?>
                            <span class="slider__title-pre-10 tp-el-subtitle"><?php echo tp_kses( $settings['tp_slider_sub_title'] ); ?></span>
                            <?php endif; ?>

                           <?php
                                if ( !empty($settings['tp_slider_title' ]) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['tp_slider_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        tp_kses( $settings['tp_slider_title' ] )
                                        );
                                endif;
                            ?>

                           <?php if (!empty($settings['tp_slider_description'])) : ?>
                            <p><?php echo tp_kses( $settings['tp_slider_description'] ); ?></p>
                            <?php endif; ?> 

                            <?php if (!empty($link)) : ?>
                           <div class="slider__btn-10">
                              <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>" class="tp-btn-7 tp-el-box-btn"><?php echo tp_kses($settings['tp_slider_btn_text']); ?> <i class="fa-regular fa-angle-right"></i></a>
                           </div>
                           <?php endif; ?>                    
                        </div>
                     </div>
                     <div class="col-xxl-5 col-xl-6 col-lg-6 col-md-6 col-sm-4 order-first order-sm-last">
                        <div class="slider__thumb-10 text-end">
                        <?php if(!empty($settings['tp_slider_border_switch'])) : ?>
                           <span class="thumb-border"></span>
                           <?php endif; ?>   
                           <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- slider area end -->

        <?php endif; ?>

        <?php 
		
	}

}

$widgets_manager->register( new TP_Hero_Box() );