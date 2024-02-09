<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;
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
class TP_Freelancer_Portfolio extends Widget_Base {

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
		return 'tp-freenalcer-portfolio';
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
		return __( 'Freelancer Portfolio', 'tpcore' );
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
                    'layout-3' => esc_html__('Layout 3', 'tp-core')
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
         'tp_portfolio_section',
             [
               'label' => esc_html__( 'Portfolio Box', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
             ]
        );
        
        $this->tp_icon_controls('box', ['layout-1', 'layout-2', 'layout-3']);

        $this->add_control(
            'tp_portfolio_title',
            [
                'label'       => esc_html__( 'Portfolio Title', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Business Strategy', 'tpcore' ),
                'placeholder' => esc_html__( 'Your title', 'tpcore' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
         'tp_portfolio_tag',
            [
            'label'       => esc_html__( 'Portfolio Tags', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXTAREA,
            'rows'        => 10,
            'default'     => esc_html__( '<a href="#">User Research</a> <a href="#">UX Design</a>', 'tpcore' ),
            'placeholder' => esc_html__( 'Your Tags', 'tpcore' ),
            ]
        );

        $this->add_control(
         'tp_portfolio_shape_switch',
         [
           'label'        => esc_html__( 'Shape On/Off', 'tpcore' ),
           'type'         => \Elementor\Controls_Manager::SWITCHER,
           'label_on'     => esc_html__( 'Show', 'tpcore' ),
           'label_off'    => esc_html__( 'Hide', 'tpcore' ),
           'return_value' => 'yes',
           'default'      => 'yes',
         ]
        );
        
        $this->add_control(
            'tp_portfolio_btn_switcher',
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
        $this->add_control(
            'tp_portfolio_btn_text',
            [
                'label' => esc_html__('Button Text', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'tpcore'),
                'title' => esc_html__('Enter button text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_portfolio_btn_switcher' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'tp_portfolio_btn_link_type',
            [
                'label' => esc_html__( 'Portfolio Link Type', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'tp_portfolio_btn_switcher' => 'yes'
                ]
            ]
        );
        $this->add_control(
            'tp_portfolio_btn_link',
            [
                'label' => esc_html__( 'Portfolio link', 'tpcore' ),
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
                    'tp_portfolio_btn_link_type' => '1',
                    'tp_portfolio_btn_switcher' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'tp_portfolio_btn_page_link',
            [
                'label' => esc_html__( 'Select Portfolio Link Page', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_portfolio_btn_link_type' => '2',
                    'tp_portfolio_btn_switcher' => 'yes',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
         'tp_portfolio_thumbanil_section',
             [
               'label' => esc_html__( 'Portfolio Thumbnail', 'Text-domain' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
             ]
        );

        $this->add_control(
            'tp_portfolio_thumbanil_1',
                [
                'label'   => esc_html__( 'Upload Image', 'Text-domain' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                    'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_control(
            'tp_portfolio_thumbanil_2',
                [
                'label'   => esc_html__( 'Upload Image 2', 'Text-domain' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                    'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_design_style' => ['layout-1', 'layout-2']
                ]
            ]
        );
        $this->add_control(
            'tp_portfolio_thumbanil_3',
                [
                'label'   => esc_html__( 'Upload Image 3', 'Text-domain' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                    'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_design_style' => ['layout-2']
                ]
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

    }

    protected function style_tab_content(){
        $this->tp_section_style_controls('portfolio_section', 'Portfolio Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('portfolio_title', 'Portfolio - Title', '.tp-el-title');
        $this->tp_icon_style('portfolio_description', 'Portfolio - Icon', '.tp-el-icon span');
        $this->tp_link_controls_style('portfolio_tag', 'Portfolio - Tag', '.tp-el-box-tag a');
        $this->tp_link_controls_style('portfolio_description', 'Portfolio - Button', '.tp-el-box-btn');
        $this->tp_section_style_controls('portfolio_section_border', 'Portfolio Border - Style', '.tp-el-section::after');
        $this->tp_section_style_controls('portfolio_section_border_hover', 'Portfolio Border Hover - Style', '.tp-el-section::before');
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

            if ( !empty($settings['tp_portfolio_thumbanil_1']['url']) ) {
                $tp_portfolio_thumbanil_1_url = !empty($settings['tp_portfolio_thumbanil_1']['id']) ? wp_get_attachment_image_url( $settings['tp_portfolio_thumbanil_1']['id'], $settings['thumbnail_size']) : $settings['tp_portfolio_thumbanil_1']['url'];
                $tp_portfolio_thumbanil_1_alt = get_post_meta($settings["tp_portfolio_thumbanil_1"]["id"], "_wp_attachment_image_alt", true);
            }  
            if ( !empty($settings['tp_portfolio_thumbanil_2']['url']) ) {
                $tp_portfolio_thumbanil_2_url = !empty($settings['tp_portfolio_thumbanil_2']['id']) ? wp_get_attachment_image_url( $settings['tp_portfolio_thumbanil_2']['id'], $settings['thumbnail_size']) : $settings['tp_portfolio_thumbanil_2']['url'];
                $tp_portfolio_thumbanil_2_alt = get_post_meta($settings["tp_portfolio_thumbanil_2"]["id"], "_wp_attachment_image_alt", true);
            }  
            if ( !empty($settings['tp_portfolio_thumbanil_3']['url']) ) {
                $tp_portfolio_thumbanil_3_url = !empty($settings['tp_portfolio_thumbanil_3']['id']) ? wp_get_attachment_image_url( $settings['tp_portfolio_thumbanil_3']['id'], $settings['thumbnail_size']) : $settings['tp_portfolio_thumbanil_3']['url'];
                $tp_portfolio_thumbanil_3_alt = get_post_meta($settings["tp_portfolio_thumbanil_3"]["id"], "_wp_attachment_image_alt", true);
            }  

            if ('2' == $settings['tp_portfolio_btn_link_type']) {
                $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_portfolio_btn_page_link']));
                $this->add_render_attribute('tp-button-arg', 'target', '_self');
                $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn-white tp-el-box-btn');
            } else {
                if ( ! empty( $settings['tp_portfolio_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'tp-button-arg', $settings['tp_portfolio_btn_link'] );
                    $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn-white tp-el-box-btn');
                }
            }

        ?>

        <div class="portfolio__item-2 portfolio__item-2-content-right has-purple fix tp-el-section">
            <?php if(!empty($settings['tp_portfolio_shape_switch'])): ?>
            <div class="portfolio__shape">
                <img class="portfolio__shape-2 wow fadeInDown" data-wow-delay="1.5s" src="<?php echo get_template_directory_uri() . '/assets/img/portfolio/2/shape/portfolio-shape-2.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                <img class="portfolio__shape-3 wow fadeInDown" data-wow-delay="1.5s" src="<?php echo get_template_directory_uri() . '/assets/img/portfolio/2/shape/portfolio-shape-3.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
            </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-xxl-7 col-xl-7 col-lg-6">
                    <div class="portfolio__thumb-wrapper-2 p-relative">
                        <div class="portfolio__thumb-2 portfolio-thumb-2">
                            <div class="row">
                                <div class="col-md-5">
                                    <img class="portfolio-2-3 wow fadeInRightPortfolio3"  src="<?php echo esc_url($tp_portfolio_thumbanil_1_url); ?>" alt="<?php echo esc_attr($tp_portfolio_thumbanil_1_alt); ?>">
                                </div>
                                <div class="col-md-5">
                                    <img class="portfolio-2-4 wow fadeInRightPortfolio4"  src="<?php echo esc_url($tp_portfolio_thumbanil_2_url); ?>" alt="<?php echo esc_attr($tp_portfolio_thumbanil_2_alt); ?>">
                                    <img class="portfolio-2-5 wow fadeInRightPortfolio5"  src="<?php echo esc_url($tp_portfolio_thumbanil_3_url); ?>" alt="<?php echo esc_attr($tp_portfolio_thumbanil_3_alt); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-5 col-xl-5 col-lg-6">
                    <div class="portfolio__content-2">
                        <div class="portfolio__icon-2 tp-el-icon">
                            <?php if($settings['tp_box_icon_type'] == 'icon') : ?>
                                <?php if (!empty($settings['tp_box_icon']) || !empty($settings['tp_box_selected_icon']['value'])) : ?>
                                        <span><?php tp_render_icon($settings, 'tp_box_icon', 'tp_box_selected_icon'); ?></span>
                                <?php endif; ?>
                            <?php elseif( $settings['tp_box_icon_type'] == 'image' ) : ?>
                                <span>
                                    <?php if (!empty($settings['tp_box_icon_image']['url'])): ?>
                                    <img src="<?php echo $settings['tp_box_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($settings['tp_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                    <?php endif; ?>
                                </span>
                            <?php else : ?>
                                <span>
                                    <?php if (!empty($settings['tp_box_icon_svg'])): ?>
                                    <?php echo $settings['tp_box_icon_svg']; ?>
                                    <?php endif; ?>
                                </span>
                            <?php endif; ?>
                        </div>
                        <?php if(!empty($settings['tp_portfolio_tag'])) : ?>
                        <div class="portfolio__tag-2 tp-el-box-tag">
                            <?php echo tp_kses($settings['tp_portfolio_tag']); ?>
                        </div>
                        <?php endif; ?>

                        <?php if(!empty($settings['tp_portfolio_title'])): ?>
                            <h3 class="portfolio__title-2 tp-el-title">
                                <?php echo tp_kses($settings['tp_portfolio_title']); ?>
                            </h3>
                        <?php endif; ?>
                        <?php if(!empty($settings['tp_portfolio_btn_switcher'])) :?>
                            <div class="portfolio__btn-2">
                                <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>><?php echo $settings['tp_portfolio_btn_text']; ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

		<?php elseif ( $settings['tp_design_style']  == 'layout-3' ):
            $bloginfo = get_bloginfo( 'name' );

            if ( !empty($settings['tp_portfolio_thumbanil_1']['url']) ) {
                $tp_portfolio_thumbanil_1_url = !empty($settings['tp_portfolio_thumbanil_1']['id']) ? wp_get_attachment_image_url( $settings['tp_portfolio_thumbanil_1']['id'], $settings['thumbnail_size']) : $settings['tp_portfolio_thumbanil_1']['url'];
                $tp_portfolio_thumbanil_1_alt = get_post_meta($settings["tp_portfolio_thumbanil_1"]["id"], "_wp_attachment_image_alt", true);
            }  


            if ('2' == $settings['tp_portfolio_btn_link_type']) {
                $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_portfolio_btn_page_link']));
                $this->add_render_attribute('tp-button-arg', 'target', '_self');
                $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn-white tp-el-box-btn');
            } else {
                if ( ! empty( $settings['tp_portfolio_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'tp-button-arg', $settings['tp_portfolio_btn_link'] );
                    $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn-white tp-el-box-btn');
                }
            }

        ?>

        <div class="portfolio__item-2 has-pink fix tp-el-section">
            <?php if(!empty($settings['tp_portfolio_shape_switch'])): ?>
            <div class="portfolio__shape">
                <img class="portfolio__shape-4 wow fadeInDown" data-wow-delay="1.5s" src="<?php echo get_template_directory_uri() . '/assets/img/portfolio/2/shape/portfolio-shape-4.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
            </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-xxl-5 col-xl-5 col-lg-6 col-md-8">
                    <div class="portfolio__content-2">
                        <div class="portfolio__icon-2">
                            <?php if($settings['tp_box_icon_type'] == 'icon') : ?>
                                <?php if (!empty($settings['tp_box_icon']) || !empty($settings['tp_box_selected_icon']['value'])) : ?>
                                        <span><?php tp_render_icon($settings, 'tp_box_icon', 'tp_box_selected_icon'); ?></span>
                                <?php endif; ?>
                            <?php elseif( $settings['tp_box_icon_type'] == 'image' ) : ?>
                                <span>
                                    <?php if (!empty($settings['tp_box_icon_image']['url'])): ?>
                                    <img src="<?php echo $settings['tp_box_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($settings['tp_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                    <?php endif; ?>
                                </span>
                            <?php else : ?>
                                <span>
                                    <?php if (!empty($settings['tp_box_icon_svg'])): ?>
                                    <?php echo $settings['tp_box_icon_svg']; ?>
                                    <?php endif; ?>
                                </span>
                            <?php endif; ?>
                        </div>
                        <?php if(!empty($settings['tp_portfolio_tag'])) : ?>
                        <div class="portfolio__tag-2 tp-el-box-tag">
                            <?php echo tp_kses($settings['tp_portfolio_tag']); ?>
                        </div>
                        <?php endif; ?>

                        <?php if(!empty($settings['tp_portfolio_title'])): ?>
                        <h3 class="portfolio__title-2 tp-el-title">
                            <?php echo tp_kses($settings['tp_portfolio_title']); ?>
                        </h3>
                        <?php endif; ?>

                        <?php if(!empty($settings['tp_portfolio_btn_switcher'])) :?>
                        <div class="portfolio__btn-2">
                            <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>><?php echo $settings['tp_portfolio_btn_text']; ?></a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-xxl-7 col-xl-7 col-lg-6">
                    <div class="portfolio__thumb-wrapper-2 p-relative">
                        <div class="portfolio__thumb-2">
                            <img class="portfolio-2-6 wow fadeInRightPortfolio6"  src="<?php echo esc_url($tp_portfolio_thumbanil_1_url); ?>" alt="<?php echo esc_attr($tp_portfolio_thumbanil_1_alt); ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>

		<?php else:
            if ( !empty($settings['tp_portfolio_thumbanil_1']['url']) ) {
                $tp_portfolio_thumbanil_1_url = !empty($settings['tp_portfolio_thumbanil_1']['id']) ? wp_get_attachment_image_url( $settings['tp_portfolio_thumbanil_1']['id'], $settings['thumbnail_size']) : $settings['tp_portfolio_thumbanil_1']['url'];
                $tp_portfolio_thumbanil_1_alt = get_post_meta($settings["tp_portfolio_thumbanil_1"]["id"], "_wp_attachment_image_alt", true);
            }  
            if ( !empty($settings['tp_portfolio_thumbanil_2']['url']) ) {
                $tp_portfolio_thumbanil_2_url = !empty($settings['tp_portfolio_thumbanil_2']['id']) ? wp_get_attachment_image_url( $settings['tp_portfolio_thumbanil_2']['id'], $settings['thumbnail_size']) : $settings['tp_portfolio_thumbanil_2']['url'];
                $tp_portfolio_thumbanil_2_alt = get_post_meta($settings["tp_portfolio_thumbanil_2"]["id"], "_wp_attachment_image_alt", true);
            }  
            if ( !empty($settings['tp_portfolio_thumbanil_3']['url']) ) {
                $tp_portfolio_thumbanil_3_url = !empty($settings['tp_portfolio_thumbanil_3']['id']) ? wp_get_attachment_image_url( $settings['tp_portfolio_thumbanil_3']['id'], $settings['thumbnail_size']) : $settings['tp_portfolio_thumbanil_3']['url'];
                $tp_portfolio_thumbanil_3_alt = get_post_meta($settings["tp_portfolio_thumbanil_3"]["id"], "_wp_attachment_image_alt", true);
            }  

            if ('2' == $settings['tp_portfolio_btn_link_type']) {
                $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_portfolio_btn_page_link']));
                $this->add_render_attribute('tp-button-arg', 'target', '_self');
                $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn-white tp-el-box-btn');
            } else {
                if ( ! empty( $settings['tp_portfolio_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'tp-button-arg', $settings['tp_portfolio_btn_link'] );
                    $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn-white tp-el-box-btn');
                }
            }

            $bloginfo = get_bloginfo( 'name' );
		?>
            <div class="portfolio__item-2 has-green fix tp-el-section">
                <?php if(!empty($settings['tp_portfolio_shape_switch'])): ?>
                <div class="portfolio__shape">
                    <img class="portfolio__shape-1 wow fadeInDown" data-wow-delay="1.5s" src="<?php echo get_template_directory_uri() . '/assets/img/portfolio/2/shape/portfolio-shape-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                </div>
                <?php endif; ?>
                <div class="row">
                    <div class="col-xxl-5 col-xl-5 col-lg-6">
                        <div class="portfolio__content-2">
                            <div class="portfolio__icon-2 tp-el-icon">
                            <?php if($settings['tp_box_icon_type'] == 'icon') : ?>
                                <?php if (!empty($settings['tp_box_icon']) || !empty($settings['tp_box_selected_icon']['value'])) : ?>
                                        <span><?php tp_render_icon($settings, 'tp_box_icon', 'tp_box_selected_icon'); ?></span>
                                <?php endif; ?>
                            <?php elseif( $settings['tp_box_icon_type'] == 'image' ) : ?>
                                <span>
                                    <?php if (!empty($settings['tp_box_icon_image']['url'])): ?>
                                    <img src="<?php echo $settings['tp_box_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($settings['tp_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                    <?php endif; ?>
                                </span>
                            <?php else : ?>
                                <span>
                                    <?php if (!empty($settings['tp_box_icon_svg'])): ?>
                                    <?php echo $settings['tp_box_icon_svg']; ?>
                                    <?php endif; ?>
                                </span>
                            <?php endif; ?>
                            </div>

                            <?php if(!empty($settings['tp_portfolio_tag'])) : ?>
                            <div class="portfolio__tag-2 tp-el-box-tag">
                                <?php echo tp_kses($settings['tp_portfolio_tag']); ?>
                            </div>
                            <?php endif; ?>

                            <?php if(!empty($settings['tp_portfolio_title'])): ?>
                            <h3 class="portfolio__title-2 tp-el-title">
                                <?php echo tp_kses($settings['tp_portfolio_title']); ?>
                            </h3>
                            <?php endif; ?>

                            <?php if(!empty($settings['tp_portfolio_btn_switcher'])) :?>
                            <div class="portfolio__btn-2">
                                <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>><?php echo $settings['tp_portfolio_btn_text']; ?></a>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php if(!empty($tp_portfolio_thumbanil_1_url) OR !empty($tp_portfolio_thumbanil_2_url)) :?>
                    <div class="col-xxl-7 col-xl-7 col-lg-6">
                        <div class="portfolio__thumb-wrapper-2 p-relative">
                            <div class="portfolio__thumb-2">
                            <img class="portfolio-2-1 wow fadeInRightPortfolio1" src="<?php echo esc_url($tp_portfolio_thumbanil_1_url); ?>" alt="<?php echo esc_attr($tp_portfolio_thumbanil_1_alt); ?>">
                            <img class="portfolio-2-2 wow fadeInRightPortfolio2" src="<?php echo esc_url($tp_portfolio_thumbanil_2_url); ?>" alt="<?php echo esc_attr($tp_portfolio_thumbanil_2_alt); ?>">
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

        <?php endif; ?>

        <?php
	}
}

$widgets_manager->register( new TP_Freelancer_Portfolio() );
