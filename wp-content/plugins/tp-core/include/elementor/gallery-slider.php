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
class TP_Gallery_Slider extends Widget_Base {

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
		return 'tp-gallery-slider';
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
		return __( 'Gallery Slider', 'tpcore' );
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

    protected static function get_profile_names(){
        return [
            '500px' => esc_html__('500px', 'tpcore'),
            'apple' => esc_html__('Apple', 'tpcore'),
            'behance' => esc_html__('Behance', 'tpcore'),
            'bitbucket' => esc_html__('BitBucket', 'tpcore'),
            'codepen' => esc_html__('CodePen', 'tpcore'),
            'delicious' => esc_html__('Delicious', 'tpcore'),
            'deviantart' => esc_html__('DeviantArt', 'tpcore'),
            'digg' => esc_html__('Digg', 'tpcore'),
            'dribbble' => esc_html__('Dribbble', 'tpcore'),
            'email' => esc_html__('Email', 'tpcore'),
            'facebook' => esc_html__('Facebook', 'tpcore'),
            'flickr' => esc_html__('Flicker', 'tpcore'),
            'foursquare' => esc_html__('FourSquare', 'tpcore'),
            'github' => esc_html__('Github', 'tpcore'),
            'houzz' => esc_html__('Houzz', 'tpcore'),
            'instagram' => esc_html__('Instagram', 'tpcore'),
            'jsfiddle' => esc_html__('JS Fiddle', 'tpcore'),
            'linkedin' => esc_html__('LinkedIn', 'tpcore'),
            'medium' => esc_html__('Medium', 'tpcore'),
            'pinterest' => esc_html__('Pinterest', 'tpcore'),
            'product-hunt' => esc_html__('Product Hunt', 'tpcore'),
            'reddit' => esc_html__('Reddit', 'tpcore'),
            'slideshare' => esc_html__('Slide Share', 'tpcore'),
            'snapchat' => esc_html__('Snapchat', 'tpcore'),
            'soundcloud' => esc_html__('SoundCloud', 'tpcore'),
            'spotify' => esc_html__('Spotify', 'tpcore'),
            'stack-overflow' => esc_html__('StackOverflow', 'tpcore'),
            'tripadvisor' => esc_html__('TripAdvisor', 'tpcore'),
            'tumblr' => esc_html__('Tumblr', 'tpcore'),
            'twitch' => esc_html__('Twitch', 'tpcore'),
            'twitter' => esc_html__('Twitter', 'tpcore'),
            'vimeo' => esc_html__('Vimeo', 'tpcore'),
            'vk' => esc_html__('VK', 'tpcore'),
            'website' => esc_html__('Website', 'tpcore'),
            'whatsapp' => esc_html__('WhatsApp', 'tpcore'),
            'wordpress' => esc_html__('WordPress', 'tpcore'),
            'xing' => esc_html__('Xing', 'tpcore'),
            'yelp' => esc_html__('Yelp', 'tpcore'),
            'youtube' => esc_html__('YouTube', 'tpcore'),
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

		
		$this->start_controls_section(
            'tp_main_slider',
            [
                'label' => esc_html__('Common Slider', 'tpcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'tp_slider_image',
            [
                'label' => esc_html__('Upload Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $this->add_control(
            'slider_list',
            [
                'label' => esc_html__('Slider List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                // 'default' => 'tp-portfolio-thumb',
            ]
        );
        $this->end_controls_section();

	}

    protected function style_tab_content(){
        $this->tp_section_style_controls('comint_section', 'Section - Style', '.tp-el-section');

        $this->tp_link_controls_style('slider_btn', 'Slider - Arrow', '.tp-el-arrow button span, .tp-el-arrow button i');
        $this->tp_link_controls_style('slider_dot', 'Slider - Dots', '.tp-el-dots .slick-dots li button');
        $this->tp_link_controls_style('slider_dot_active', 'Slider - Dot Active', '.tp-el-dots .slick-dots li.slick-active button');
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

		<?php if ( $settings['tp_design_style']  == 'layout-2' ): ?>

         <!-- portfolio slider area start -->
         <section class="portfolio__area fix pb-130 tp-el-section">
            <div class="container">
               <div class="row justify-content-center">
                  <div class="col-xl-10 col-lg-10">
                     <div class="portfolio__details-slider-2 p-relative">
                        <div class="portfolio__details-slider-active-2">
                        <?php foreach ($settings['slider_list'] as $item) :
                                $this->add_render_attribute('title_args', 'class', 'slider__title tp-el-title');

                                if ( !empty($item['tp_slider_image']['url']) ) {
                                    $tp_slider_image_url = !empty($item['tp_slider_image']['id']) ? wp_get_attachment_image_url( $item['tp_slider_image']['id'], $settings['thumbnail_size']) : $item['tp_slider_image']['url'];
                                    $tp_slider_image_alt = get_post_meta($item["tp_slider_image"]["id"], "_wp_attachment_image_alt", true);
                                }

                            ?>
                            <div>
                                <div class="portfolio__details-slider-item-2 w-img">
                                     <img src="<?php echo esc_url($tp_slider_image_url ); ?>" alt="<?php echo esc_attr($tp_slider_image_alt); ?>">
                                </div>
                            </div>
                           <?php endforeach; ?> 
                        </div>
                        <div class="portfolio__details-arrow portfolio-details-slider-arrow-2 tp-el-arrow d-none d-md-block"></div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- portfolio slider area end -->

         <?php elseif ( $settings['tp_design_style']  == 'layout-3' ): ?>
         <!-- portfolio slider area start -->
         <section class="portfolio__area fix">
            <div class="container">
               <div class="row justify-content-center">
                  <div class="col-xl-10">
                     <div class="portfolio__details-slider pl-50 pr-50">
                        <div class="portfolio__details-slider-active tp-el-dots">
                        <?php foreach ($settings['slider_list'] as $item) :
                                $this->add_render_attribute('title_args', 'class', 'slider__title tp-el-title');

                                if ( !empty($item['tp_slider_image']['url']) ) {
                                    $tp_slider_image_url = !empty($item['tp_slider_image']['id']) ? wp_get_attachment_image_url( $item['tp_slider_image']['id'], $settings['thumbnail_size']) : $item['tp_slider_image']['url'];
                                    $tp_slider_image_alt = get_post_meta($item["tp_slider_image"]["id"], "_wp_attachment_image_alt", true);
                                }

                            ?>
                            <div>
                                <div class="portfolio__details-slider-item">
                                    <img src="<?php echo esc_url($tp_slider_image_url ); ?>" alt="<?php echo esc_attr($tp_slider_image_alt); ?>">
                                </div>
                            </div>
                           <?php endforeach; ?>
                        </div>
                        <div class="portfolio-details-slider-dot tp-swiper-dot-2 text-center mt-45"></div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- portfolio slider area end -->

		<?php else: ?>


         <!-- about gallery slider area start -->
         <section class="about__gallery-area fix tp-el-section">
            <div class="container">
               <div class="row justify-content-center">
                  <div class="col-xl-10 col-lg-10">
                     <div class="about__gallery-slider pl-50 pr-50 p-relative">
                        <div class="about__gallery-slider-active">
                            <?php foreach ($settings['slider_list'] as $item) :
                                $this->add_render_attribute('title_args', 'class', 'slider__title tp-el-title');

                                if ( !empty($item['tp_slider_image']['url']) ) {
                                    $tp_slider_image_url = !empty($item['tp_slider_image']['id']) ? wp_get_attachment_image_url( $item['tp_slider_image']['id'], $settings['thumbnail_size']) : $item['tp_slider_image']['url'];
                                    $tp_slider_image_alt = get_post_meta($item["tp_slider_image"]["id"], "_wp_attachment_image_alt", true);
                                }

                            ?>
                           <div class="about__gallery-item">
                              <div class="about__gallery-thumb m-img">
                                 <img src="<?php echo esc_url($tp_slider_image_url ); ?>" alt="<?php echo esc_attr($tp_slider_image_alt); ?>">
                              </div>
                           </div>
                           <?php endforeach; ?> 
                        </div>
                        
                        <div class="about__gallery-arrow tp-el-arrow d-none d-sm-block"></div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- about gallery slider area end -->

         <?php endif; ?>


		<?php 
	}
}

$widgets_manager->register( new TP_Gallery_Slider() );