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
class TP_Photographer_Portfolio extends Widget_Base {

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
		return 'tp-portfolio-photo';
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
		return __( 'Photographer Portfolio', 'tpcore' );
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
        $repeater->add_control(
            'tp_portfolio_description', [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Portfolio description', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => 'style_1'
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
        'tp_portfolio_tag',
            [
                'label'       => esc_html__( 'Tag', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Canons', 'tpcore' ),
                'placeholder' => esc_html__( 'Your tag', 'tpcore' ),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
        'tp_portfolio_location',
            [
                'label'       => esc_html__( 'Location', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'New York', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Location', 'tpcore' ),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
        'tp_portfolio_date',
            [
                'label'       => esc_html__( 'Date', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Oct 24, 2022', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Category', 'tpcore' ),
                'label_block' => true,
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
        $this->tp_link_controls_style('portfolio_btn', 'Section - Button', '.tp-el-btn');

        $this->tp_basic_style_controls('portfolio_box_title', 'Portfolio - Title', '.tp-el-box-title');
        $this->tp_basic_style_controls('portfolio_box_tag', 'Portfolio - Tag', '.tp-el-box-tag');
        $this->tp_link_controls_style('portfolio_box_meta', 'Portfolio - Meta', '.tp-el-box-meta span');
  
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
            $this->add_render_attribute('title_args', 'class', 'section__title-3 has-gradient tp-el-title');
            $bloginfo = get_bloginfo( 'name' );

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
         <section class="portfolio__area p-relative black-bg-5 portfolio__overlay pt-110 pb-90 fix tp-el-section">

            <?php if(!empty($settings['tp_portfolio_shape_switch'])) : ?>
            <div class="portfolio__shape">
               <img class="portfolio__shape-5" src="<?php echo get_template_directory_uri() . '/assets/img/portfolio/3/portfolio-shape-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
            </div>
            <?php endif; ?>

            <div class="container">
            <?php if ( !empty($settings['tp_portfolio_section_title_show']) ) : ?>
               <div class="row align-items-end">
                  <div class="col-xxl-5 col-xl-6 col-md-8">
                     <div class="section__title-wrapper-3 mb-60 tp-el-content">

                        <?php if(!empty($settings['tp_portfolio_sub_title'])): ?>
                        <span class="section__title-pre-3 tp-el-subtitle"><?php echo tp_kses($settings['tp_portfolio_sub_title']); ?></span>
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
                  <?php if(!empty($settings['tp_portfolio_view_all_btn_switcher'])): ?>
                  <div class="col-xxl-7 col-xl-6 col-md-4">
                     <div class="portfolio__more text-md-end mb-60">
                        <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>" class="tp-btn-3 --hover-style-2 tp-el-btn"><?php echo tp_kses($settings['tp_portfolio_view_all_btn_text']); ?></a>
                     </div>
                  </div>
                  <?php endif; ?>

               </div>
               <?php endif; ?>

               <div class="row">
                  <div class="col-xxl-12">
                     <div class="portfolio__slider">
                        <div class="portfolio__slider-active">
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
                           <div class="portfolio__item-3 transition-3 wow fadeInUp tp-el-box" data-wow-delay=".3s" data-wow-duration="1s">
                              <div class="portfolio__thumb-3 w-img" data-background="<?php echo esc_attr($tp_portfolio_image_url); ?>"></div>
                              <div class="portfolio__content-3 transition-3">
                             
                                <?php if (!empty($item['tp_portfolio_cat' ])): ?>
                                 <div class="portfolio__tag-3">
                                    <span class="tp-el-box-tag"><?php echo tp_kses($item['tp_portfolio_cat']); ?></span>
                                 </div>
                                 <?php endif; ?>
                                 <h3 class="portfolio__title-3 tp-el-box-title">
                                    <?php if ($item['tp_portfolio_link_switcher'] == 'yes') : ?>
                                    <a href="<?php echo esc_url($link); ?>"><?php echo tp_kses($item['tp_portfolio_title' ]); ?></a>
                                    <?php else : ?>
                                        <?php echo tp_kses($item['tp_portfolio_title' ]); ?>
                                    <?php endif; ?>
                                 </h3>
                                 <div class="portfolio__meta-3 transition-3 tp-el-box-meta">

                                    <?php if(!empty($item['tp_portfolio_tag'])) :?>
                                    <span>
                                       <svg width="16" height="13" viewBox="0 0 16 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <path d="M13.1541 2.1366H11.7847C11.3382 1.62005 10.7986 1.20827 10.1993 0.92676C9.60001 0.645251 8.95375 0.5 8.30054 0.5C7.64732 0.5 7.00107 0.645251 6.40177 0.92676C5.80247 1.20827 5.26288 1.62005 4.81642 2.1366H2.94345C2.68824 2.1366 2.43552 2.19105 2.19973 2.29686C1.96394 2.40267 1.74969 2.55775 1.56922 2.75326C1.20476 3.1481 1 3.68361 1 4.242V10.3946C1 10.953 1.20476 11.4885 1.56922 11.8833C1.74969 12.0788 1.96394 12.2339 2.19973 12.3397C2.43552 12.4455 2.68824 12.5 2.94345 12.5H13.1541C13.6696 12.5 14.1639 12.2782 14.5284 11.8833C14.8928 11.4885 15.0976 10.953 15.0976 10.3946V4.242C15.0976 3.68361 14.8928 3.1481 14.5284 2.75326C14.1639 2.35842 13.6696 2.1366 13.1541 2.1366ZM14.0906 10.3946C14.0906 10.6637 13.992 10.9217 13.8163 11.112C13.6407 11.3022 13.4025 11.4091 13.1541 11.4091H2.94345C2.69508 11.4091 2.45688 11.3022 2.28126 11.112C2.10564 10.9217 2.00697 10.6637 2.00697 10.3946V4.242C2.00697 3.97294 2.10564 3.71489 2.28126 3.52463C2.45688 3.33437 2.69508 3.22748 2.94345 3.22748H5.02788C5.10061 3.22749 5.17247 3.21042 5.23852 3.17747C5.30458 3.14451 5.36326 3.09645 5.41053 3.03658C5.76406 2.58397 6.20441 2.22028 6.70091 1.97082C7.19741 1.72136 7.73813 1.59214 8.28543 1.59214C8.83273 1.59214 9.37345 1.72136 9.86995 1.97082C10.3665 2.22028 10.8068 2.58397 11.1603 3.03658C11.2108 3.10083 11.2744 3.15151 11.346 3.18463C11.4177 3.21776 11.4954 3.23243 11.5732 3.22748H13.1692C13.415 3.23178 13.6493 3.34055 13.8217 3.53035C13.9941 3.72015 14.0906 3.97575 14.0906 4.242V10.3946Z" fill="white" stroke="white" stroke-width="0.2"/>
                                          <path d="M8.30049 3.22754C7.65322 3.22754 7.02048 3.43547 6.4823 3.82504C5.94411 4.21461 5.52465 4.76833 5.27695 5.41616C5.02925 6.06399 4.96444 6.77685 5.09072 7.46458C5.21699 8.15232 5.52868 8.78404 5.98637 9.27987C6.44406 9.7757 7.02719 10.1134 7.66202 10.2502C8.29686 10.387 8.95488 10.3168 9.55288 10.0484C10.1509 9.78007 10.662 9.32565 11.0216 8.74262C11.3812 8.15958 11.5731 7.47412 11.5731 6.77291C11.5718 5.83307 11.2266 4.93212 10.6131 4.26755C9.99968 3.60297 9.16804 3.22898 8.30049 3.22754ZM8.30049 9.2274C7.85238 9.2274 7.41433 9.08345 7.04174 8.81375C6.66915 8.54405 6.37875 8.16071 6.20727 7.71221C6.03578 7.26371 5.99092 6.77019 6.07834 6.29407C6.16576 5.81794 6.38155 5.38059 6.69841 5.03733C7.01527 4.69406 7.41897 4.46029 7.85847 4.36559C8.29797 4.27088 8.75353 4.31949 9.16753 4.50526C9.58153 4.69104 9.93538 5.00563 10.1843 5.40927C10.4333 5.81291 10.5662 6.28746 10.5662 6.77291C10.5648 7.42344 10.3257 8.04692 9.9011 8.50691C9.47649 8.9669 8.90098 9.22596 8.30049 9.2274Z" fill="white" stroke="white" stroke-width="0.2"/>
                                          <path d="M3.01374 1.59113H4.02071C4.15424 1.59113 4.28231 1.53366 4.37673 1.43137C4.47115 1.32908 4.52419 1.19035 4.52419 1.04569C4.52419 0.901026 4.47115 0.762291 4.37673 0.660001C4.28231 0.55771 4.15424 0.500244 4.02071 0.500244H3.01374C2.88021 0.500244 2.75214 0.55771 2.65772 0.660001C2.5633 0.762291 2.51025 0.901026 2.51025 1.04569C2.51025 1.19035 2.5633 1.32908 2.65772 1.43137C2.75214 1.53366 2.88021 1.59113 3.01374 1.59113Z" fill="white" stroke="white" stroke-width="0.2"/>
                                          <path d="M12.5801 5.409C12.8582 5.409 13.0836 5.1648 13.0836 4.86356C13.0836 4.56232 12.8582 4.31812 12.5801 4.31812C12.3021 4.31812 12.0767 4.56232 12.0767 4.86356C12.0767 5.1648 12.3021 5.409 12.5801 5.409Z" fill="white" stroke="white" stroke-width="0.2"/>
                                       </svg>
                                       <?php echo esc_html($item['tp_portfolio_tag']); ?>
                                    </span>
                                    <?php endif; ?>

                                    <?php if(!empty($item['tp_portfolio_location'])) :?>
                                    <span>
                                       <svg width="12" height="15" viewBox="0 0 12 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <path d="M10.4286 6.40909C10.4286 10.2273 5.71429 13.5 5.71429 13.5C5.71429 13.5 1 10.2273 1 6.40909C1 5.10712 1.49668 3.85847 2.38078 2.93784C3.26488 2.01721 4.46398 1.5 5.71429 1.5C6.96459 1.5 8.16369 2.01721 9.04779 2.93784C9.93189 3.85847 10.4286 5.10712 10.4286 6.40909Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                          <path d="M5.71401 8.04568C6.58188 8.04568 7.28544 7.31305 7.28544 6.40931C7.28544 5.50557 6.58188 4.77295 5.71401 4.77295C4.84613 4.77295 4.14258 5.50557 4.14258 6.40931C4.14258 7.31305 4.84613 8.04568 5.71401 8.04568Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                       </svg>
                                       <?php echo esc_html($item['tp_portfolio_location']); ?>
                                    </span>
                                    <?php endif; ?>

                                    <?php if(!empty($item['tp_portfolio_date'])) :?>
                                    <span>
                                       <svg width="13" height="15" viewBox="0 0 13 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <path d="M4 1.5V3.3" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                          <path d="M8.80029 1.5V3.3" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                          <path d="M1.30029 5.75415H11.5003" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                          <path d="M11.8 5.40015V10.5001C11.8 12.3001 10.9 13.5001 8.8 13.5001H4C1.9 13.5001 1 12.3001 1 10.5001V5.40015C1 3.60015 1.9 2.40015 4 2.40015H8.8C10.9 2.40015 11.8 3.60015 11.8 5.40015Z" stroke="white" stroke-width="1.2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                          <path d="M8.61702 8.51997H8.62241" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                          <path d="M8.61653 10.32H8.62192" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                          <path d="M6.39729 8.51997H6.40268" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                          <path d="M6.39729 10.32H6.40268" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                          <path d="M4.17659 8.51997H4.18198" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                          <path d="M4.17659 10.32H4.18198" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                       </svg>
                                       <?php echo esc_html($item['tp_portfolio_date']); ?>
                                    </span>
                                    <?php endif; ?>
                                    
                                 </div>
                              </div>
                           </div> 
                           <?php endforeach; ?>
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

$widgets_manager->register( new TP_Photographer_Portfolio() );
