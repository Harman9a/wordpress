<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use TPCore\Elementor\Controls\Group_Control_TPBGGradient;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Portfolio_Architech extends Widget_Base {

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
		return 'tp-portfolio-architech';
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
		return __( 'Architechture Portfolio', 'tpcore' );
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

        $this->tp_section_title_render_controls('portfolio', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.');

        // Button 
        $this->tp_button_render('portfolio_view_all', 'Portfolio More', ['layout-1'] );

        // Portfolio group
        $this->start_controls_section(
            'tp_portfolio',
            [
                'label' => esc_html__('Portfolio List', 'tpcore'),
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
                    'style_6' => __( 'Style 2', 'tpcore' ),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

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
            'tp_portfolio_date',
                [
                    'label'       => esc_html__( 'Date', 'tpcore' ),
                    'type'        => \Elementor\Controls_Manager::TEXT,
                    'default'     => esc_html__( '2022', 'tpcore' ),
                    'placeholder' => esc_html__( 'Your Category', 'tpcore' ),
                    'label_block' => true,
                ]
        );
        $repeater->add_control(
            'tp_portfolio_meta',
                [
                    'label'       => esc_html__( 'Place', 'tpcore' ),
                    'type'        => \Elementor\Controls_Manager::TEXT,
                    'default'     => esc_html__( 'Dawsbury, Hungery', 'tpcore' ),
                    'placeholder' => esc_html__( 'Your Category', 'tpcore' ),
                    'label_block' => true,
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
            'tp_portfolio_link_switcher',
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
            'tp_portfolio_link_type',
            [
                'label' => esc_html__( 'Service Link Type', 'tpcore' ),
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
                    'tp_portfolio_link_type' => '1',
                    'tp_portfolio_link_switcher' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'tp_portfolio_page_link',
            [
                'label' => esc_html__( 'Select Service Link Page', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_portfolio_link_type' => '2',
                    'tp_portfolio_link_switcher' => 'yes',
                ]
            ]
        );


        $this->add_control(
            'tp_portfolio_list',
            [
                'label' => esc_html__('Portfolio - List', 'tpcore'),
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
                    ],
                    [
                        'tp_portfolio_title' => esc_html__('Mobile Development', 'tpcore')
                    ],
                    [
                        'tp_portfolio_title' => esc_html__('Marketing & Reporting', 'tpcore')
                    ],
                    [
                        'tp_portfolio_title' => esc_html__('Mobile Development', 'tpcore')
                    ],
                ],
                'title_field' => '{{{ tp_portfolio_title }}}',
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


        $this->tp_columns('col');

	}

        // style_tab_content
    protected function style_tab_content(){


        $this->tp_section_style_controls('section_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('section_subtitle', 'Section - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('section_title', 'Section - Title', '.tp-el-title');
        $this->tp_basic_style_controls('section_description', 'Section - Description', '.tp-el-content p');
        $this->tp_link_controls_style('portfolio_btn', 'Portfolio - Button', '.tp-el-btn');
        
        $this->tp_basic_style_controls('portfolio_box_title', 'Portfolio - Title', '.tp-el-box-title');
        $this->tp_basic_style_controls('portfolio_box_tag', 'Portfolio - Tag', '.tp-el-box-tag span');

        $this->tp_link_controls_style('portfolio_arrow', 'Portfolio - Arrow', '.tp-el-arrow button');
  
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
            $this->add_render_attribute('title_args', 'class', 'section__title-5 tp-el-title');
            $bloginfo = get_bloginfo( 'name' );  

        ?>

		<?php else:
			$this->add_render_attribute('title_args', 'class', 'section__title-8 tp-el-title');

            if ('2' == $settings['tp_portfolio_view_all_btn_link_type']) {
                $link = get_permalink($settings['tp_portfolio_view_all_btn_page_link']);
                $target = '_self';
                $rel = 'nofollow';
            } else {
                $link = !empty($settings['tp_portfolio_view_all_btn_link']['url']) ? $settings['tp_portfolio_view_all_btn_link']['url'] : '';
                $target = !empty($settings['tp_portfolio_view_all_btn_link']['is_external']) ? '_blank' : '';
                $rel = !empty($settings['tp_portfolio_view_all_btn_link']['nofollow']) ? 'nofollow' : '';
            }
		?>


         <!-- portfolio area start -->
         <section class="portfolio_area pt-110 black-bg-13 tp-el-section">
            <div class="container">
            <?php if ( !empty($settings['tp_portfolio_section_title_show']) ) : ?>
               <div class="row align-items-end">
                  <div class="col-xl-6 col-lg-8 col-md-7">
                    <div class="section__title-wrapper-8 mb-60 tp-el-content">
                        <?php if ( !empty($settings['tp_portfolio_sub_title']) ) : ?>
                        <span class="section__title-pre-8 tp-el-subtitle"><?php echo tp_kses( $settings['tp_portfolio_sub_title'] ); ?></span>
                        <?php endif; ?>

                        <?php
                            if ( !empty($settings['tp_portfolio_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['tp_portfolio_title_tag'] ),
                                    $this->get_render_attribute_string( 'title_args' ),
                                    tp_kses( $settings['tp_portfolio_title' ] )
                                    );
                            endif;
                        ?>
                        <?php if ( !empty($settings['tp_portfolio_description']) ) : ?>
                        <p><?php echo tp_kses( $settings['tp_portfolio_description'] ); ?></p>
                        <?php endif; ?>
                     </div>
                  </div>
                  <?php if(!empty($settings['tp_portfolio_view_all_btn_switcher'])) :?>
                  <div class="col-xl-6 col-lg-4 col-md-5">
                     <div class="portfolio__more-8 text-md-end mb-70">
                        <a class="tp-btn-border-7 tp-el-btn" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>"><?php echo tp_kses($settings['tp_portfolio_view_all_btn_text']); ?> <i class="fa-regular fa-chevron-right"></i></a>
                     </div>
                  </div>
                  <?php endif; ?> 
                                     
               </div>
               <?php endif; ?>
               
            </div>
            <div class="container-fluid gx-0">
               <div class="row gx-0">
                  <div class="col-xxl-12">
                     <div class="portfolio__slider-8 p-relative fix">

                        <div id="portfolio-bg-img" class="portfolio-img-2">
                            <?php foreach ($settings['tp_portfolio_list'] as $key => $item) :
                                if ( !empty($item['tp_portfolio_image']['url']) ) {
                                    $tp_portfolio_image_url = !empty($item['tp_portfolio_image']['id']) ? wp_get_attachment_image_url( $item['tp_portfolio_image']['id'], $settings['thumbnail_size']) : $item['tp_portfolio_image']['url'];
                                    $tp_portfolio_image_alt = get_post_meta($item["tp_portfolio_image"]["id"], "_wp_attachment_image_alt", true);
                                }

                                if($key == '2'){
                                    $active = "active" ;
                                }else{
                                    $active = "";
                                }
                            ?>
                           <div class="portfolio-bg portfolio-img-<?php echo esc_attr($key); ?>" data-background="<?php echo esc_url($tp_portfolio_image_url); ?>"></div>
                           <?php endforeach; ?>  
                        </div>

                        <div class="portfolio__slider-active-8 swiper-container">
                           <div class="swiper-wrapper">
                                <?php foreach ($settings['tp_portfolio_list'] as $key => $item) :
                                    if ( !empty($item['tp_portfolio_image']['url']) ) {
                                        $tp_portfolio_image_url = !empty($item['tp_portfolio_image']['id']) ? wp_get_attachment_image_url( $item['tp_portfolio_image']['id'], $settings['thumbnail_size']) : $item['tp_portfolio_image']['url'];
                                        $tp_portfolio_image_alt = get_post_meta($item["tp_portfolio_image"]["id"], "_wp_attachment_image_alt", true);
                                    }

                                    if($key == '2'){
                                        $active = "active" ;
                                    }else{
                                        $active = "";
                                    }

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
                              <div class="portfolio__item-8 swiper-slide <?php echo esc_attr($active); ?>" rel="portfolio-img-<?php echo esc_attr($key); ?>">
                                 <div class="portfolio__content-8">
                                    <div class="portfolio__meta-8 tp-el-box-tag">
                                        <?php if(!empty($item['tp_portfolio_date'])) : ?>
                                       <span><?php echo tp_kses($item['tp_portfolio_date']); ?></span>
                                       <?php endif; ?>
                                       <?php if(!empty($item['tp_portfolio_meta'])) :?>
                                       <span><?php echo tp_kses($item['tp_portfolio_meta']); ?></span>
                                       <?php endif; ?>
                                    </div>

                                    <?php if (!empty($item['tp_portfolio_title' ])): ?>
                                    <h3 class="portfolio__title-8 tp-el-box-title">
                                        <?php if ($item['tp_portfolio_link_switcher'] == 'yes') : ?>
                                        <a href="<?php echo esc_url($link); ?>"><?php echo tp_kses($item['tp_portfolio_title' ]); ?></a>
                                        <?php else : ?>
                                            <?php echo tp_kses($item['tp_portfolio_title' ]); ?>
                                        <?php endif; ?>
                                    </h3>
                                    <?php endif; ?>
                                 </div>
                              </div>
                              <?php endforeach; ?>
                           </div>
                           <div class="portfolio__nav-8 tp-el-arrow">
                              <button type="button" class="portfolio-button-prev-8"><i class="fa-regular fa-chevron-left"></i></button>
                              <button type="button" class="portfolio-button-next-8"><i class="fa-regular fa-chevron-right"></i></button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- portfolio area end -->

        <?php endif; ?>

        <?php
	}
}

$widgets_manager->register( new TP_Portfolio_Architech() );
