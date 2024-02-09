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
class TP_Portfolio_Navigation extends Widget_Base {

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
		return 'tp-portfolio-navigation';
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
		return __( 'Portfolio Navigation', 'tpcore' );
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();


        $this->tp_section_style_controls('video_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('section_title', 'Box - Title', '.tp-el-box-title');
        $this->tp_basic_style_controls('section_subtitle', 'Box - Subtitle', '.tp-el-box-subtitle');
        $this->tp_icon_style('section_icon', 'Box - Icon', '.tp-el-box-icon');
        $this->tp_icon_style('section_icon_dot', 'Dot - Icon', '.tp-el-icon span');
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

        <?php if ( get_previous_post_link() AND get_next_post_link() ): 
                  $prev_post = get_adjacent_post(false, '', true);
                  $next_post = get_adjacent_post(false, '', false);
            ?>

         <!-- portfolio navigation area start -->
            <section class="portfolio__navigation-area portfolio__more-border d-none d-md-block tp-el-section">
                  <div class="container">
                    <div class="row align-items-center">
                    <?php if ( get_previous_post_link() ): ?>
                        <div class="col-xl-5 col-lg-5 col-md-5">
                            <div class="portfolio__more-left d-flex align-items-center">
                                <div class="portfolio__more-icon">
                                    <a href="<?php echo get_permalink($prev_post->ID) ?>" class="tp-el-box-icon">
                                        <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M7 12.9718L2.06061 8.04401C1.47727 7.46205 1.47727 6.50975 2.06061 5.92778L7 1" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </a>
                                </div>
                                <div class="portfolio__more-content">
                                    <p class="tp-el-box-subtitle"><?php print esc_html__( 'Previous Work', 'harry' );?></p>
                                    <h4 class="tp-el-box-title">
                                        <a href="<?php echo get_permalink($prev_post->ID) ?>"><?php print get_previous_post_link( '%link ', '%title' );?></a>
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <?php endif;?>
                        <div class="col-xl-2 col-lg-2 col-md-2">
                              <div class="portfolio__more-menu text-center tp-el-icon">
                                    <span>
                                          <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.6673 4.66662C12.9559 4.66662 14.0006 3.62196 14.0006 2.33331C14.0006 1.04466 12.9559 0 11.6673 0C10.3786 0 9.33398 1.04466 9.33398 2.33331C9.33398 3.62196 10.3786 4.66662 11.6673 4.66662Z" fill="currentColor"/>
                                            <path d="M2.33331 4.66662C3.62196 4.66662 4.66662 3.62196 4.66662 2.33331C4.66662 1.04466 3.62196 0 2.33331 0C1.04466 0 0 1.04466 0 2.33331C0 3.62196 1.04466 4.66662 2.33331 4.66662Z" fill="currentColor"/>
                                            <path d="M11.6673 13.9996C12.9559 13.9996 14.0006 12.955 14.0006 11.6663C14.0006 10.3777 12.9559 9.33301 11.6673 9.33301C10.3786 9.33301 9.33398 10.3777 9.33398 11.6663C9.33398 12.955 10.3786 13.9996 11.6673 13.9996Z" fill="currentColor"/>
                                            <path d="M2.33331 13.9996C3.62196 13.9996 4.66662 12.955 4.66662 11.6663C4.66662 10.3777 3.62196 9.33301 2.33331 9.33301C1.04466 9.33301 0 10.3777 0 11.6663C0 12.955 1.04466 13.9996 2.33331 13.9996Z" fill="currentColor"/>
                                          </svg>                                    
                                    </span>
                              </div>
                        </div>
                        <?php if ( get_next_post_link() ): ?>
                        <div class="col-xl-5 col-lg-5 col-md-5">
                              <div class="portfolio__more-right d-flex align-items-center justify-content-end">
                                    <div class="portfolio__more-content">
                                        <p class="tp-el-box-subtitle"><?php print esc_html__( 'Next Work', 'harry' );?></p>
                                        <h4 class="tp-el-box-title">
                                            <a href="<?php echo get_permalink($next_post->ID) ?>"><?php print get_next_post_link( '%link ', '%title' );?></a>
                                        </h4>
                                    </div>
                                    <div class="portfolio__more-icon">
                                        <a href="<?php echo get_permalink($next_post->ID) ?>" class="tp-el-box-icon">
                                            <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1 12.9718L5.93939 8.04401C6.52273 7.46205 6.52273 6.50975 5.93939 5.92778L1 1" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>                                                      
                                        </a>
                                    </div>
                              </div>
                        </div>
                        <?php endif;?>
                    </div>
                </div>
            </section>
         <!-- portfolio navigation area end -->

            <?php endif;?> <!-- navigation end -->


        <?php endif; ?>

        <?php

	}

}

$widgets_manager->register( new TP_Portfolio_Navigation() );
