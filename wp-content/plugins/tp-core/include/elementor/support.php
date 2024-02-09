<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Support extends Widget_Base {

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
		return 'support';
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
		return __( 'Support', 'tpcore' );
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
                    'layout-2' => esc_html__('Layout 2', 'tpcore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->tp_section_title_render_controls('support', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.');

        // Service group
        $this->start_controls_section(
            'tp_support',
            [
                'label' => esc_html__('Support List', 'tpcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
         'support_shape_switch',
            [
                'label'        => esc_html__( 'Suppport Shape Switch', 'tpcore' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'tpcore' ),
                'label_off'    => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition' =>[
                        'tp_design_style' => 'layout-1'
                ]
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
                    'style_2' => __( 'Style 2', 'tpcore' ),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'tp_box_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image' => esc_html__('Image', 'tpcore'),
                    'icon' => esc_html__('Icon', 'tpcore'),
                    'svg' => esc_html__('SVG', 'tpcore'),
                ],
                'condition' => [
                    'repeater_condition' => ['style_1', 'style_2'],
                ]
            ]
        );
        $repeater->add_control(
            'tp_box_icon_svg',
            [
                'show_label' => false,
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__('SVG Code Here', 'tpcore'),
                'condition' => [
                    'tp_box_icon_type' => 'svg',
                    'repeater_condition' => ['style_1', 'style_2'],
                ]
            ]
        );

        $repeater->add_control(
            'tp_box_icon_image',
            [
                'label' => esc_html__('Upload Icon Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_box_icon_type' => 'image',
                    'repeater_condition' => ['style_1', 'style_2'],
                ]
            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'tp_box_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'tp_box_icon_type' => 'icon',
                        'repeater_condition' => ['style_1', 'style_2'],
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'tp_box_selected_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'fas fa-star',
                        'library' => 'solid',
                    ],
                    'condition' => [
                        'tp_box_icon_type' => 'icon',
                        'repeater_condition' => ['style_1', 'style_2'],
                    ]
                ]
            );
        }

        $repeater->add_control(
            'tp_support_box_title', [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Service Title', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_support_link_switcher',
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
            'tp_support_btn_text',
            [
                'label' => esc_html__('Button Text', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'tpcore'),
                'title' => esc_html__('Enter button text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_support_link_switcher' => 'yes',
                    'repeater_condition' => ['style_1'],
                ],
            ]
        );
        $repeater->add_control(
            'tp_support_link_type',
            [
                'label' => esc_html__( 'Service Link Type', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'tp_support_link_switcher' => 'yes'
                ]
            ]
        );
        $repeater->add_control(
            'tp_support_link',
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
                    'tp_support_link_type' => '1',
                    'tp_support_link_switcher' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'tp_support_page_link',
            [
                'label' => esc_html__( 'Select Service Link Page', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_support_link_type' => '2',
                    'tp_support_link_switcher' => 'yes',
                ]
            ]
        );

        $repeater->add_control(
            'tp_support_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered.',
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_1'],
                ]
            ]
        );


        $this->add_control(
            'tp_support_list',
            [
                'label' => esc_html__('Features - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_support_box_title' => esc_html__('Business Stratagy', 'tpcore'),
                    ],
                    [
                        'tp_support_box_title' => esc_html__('Website Development', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_support_box_title }}}',
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

        $this->start_controls_section(
         'tp_support_thumb_sec',
             [
               'label' => esc_html__( 'Support Thumbnail', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
               'condition' => [
                'tp_design_style' => 'layout-1'
               ]
             ]
        );

        $this->add_control(
         'tp_support_thumb_shape_switch',
         [
           'label'        => esc_html__( 'Support Shape On/Off', 'tpcore' ),
           'type'         => \Elementor\Controls_Manager::SWITCHER,
           'label_on'     => esc_html__( 'Show', 'tpcore' ),
           'label_off'    => esc_html__( 'Hide', 'tpcore' ),
           'return_value' => 'yes',
           'default'      => 'yes',
         ]
        );
        
        $this->add_control(
         'tp_support_thumb',
            [
            'label'   => esc_html__( 'Upload Image', 'tpcore' ),
            'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail_support', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                // 'default' => 'tp-post-thumb',
            ]
        );

        $this->end_controls_section();
        
        $this->tp_button_render('box_1', 'Support Button 1');
        $this->tp_button_render('box_2', 'Support Button 2');

        // colum controls
        $this->tp_columns('col');
	}

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('services_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('services_subtitle', 'Services - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('services_title', 'Services - Title', '.tp-el-title');
        $this->tp_basic_style_controls('services_description', 'Services - Description', '.tp-el-content p');

        $this->tp_section_style_controls('services_section_box', 'Box - Style', '.tp-el-box');
        $this->tp_basic_style_controls('services_box_title', 'Services - Box - Title', '.tp-el-box-title');
        $this->tp_basic_style_controls('services_box_subtitle', 'Services - Box - Subtitle', '.tp-el-box-subtitle');
        $this->tp_basic_style_controls('services_box_description', 'Services - Box - Description', '.tp-el-box-desc');
        $this->tp_icon_style('services_box_icon', 'Services - Icon/Image/SVG', '.tp-el-box-icon span');
        $this->tp_link_controls_style('services_box_link_btn', 'Services - Box - Button', '.tp-el-box-btn');
        $this->tp_link_controls_style('services_box_link_btn_2', 'Box - Button 2', '.tp-el-box-btn-2');

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
            $this->add_render_attribute('title_args', 'class', 'tp-section-title-2 tp-el-title');        
        ?>

        
         <!-- support area start -->
         <section class="support__area pb-90 tp-el-section">
            <div class="container">
            <?php if ( !empty($settings['tp_support_section_title_show']) ) : ?>
               <div class="row justify-content-center">
                  <div class="col-xxl-7 col-xl-7 col-lg-8 col-md-11">
                     <div class="tp-section-wrapper-2 tp-section-wrapper-2-sm mb-60 text-center tp-el-content">

                         <?php if ( !empty($settings['tp_support_sub_title']) ) : ?>
                        <span class="tp-section-subtitle-2 tp-el-subtitle">
                            <?php echo tp_kses( $settings['tp_support_sub_title'] ); ?>
                        </span>
                        <?php endif; ?>

                        <?php
                            if ( !empty($settings['tp_support_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['tp_support_title_tag'] ),
                                    $this->get_render_attribute_string( 'title_args' ),
                                    tp_kses( $settings['tp_support_title' ] )
                                    );
                            endif;
                        ?>
                        <?php if (!empty($settings['tp_support_description' ])): ?>
                        <p><?php echo tp_kses($settings['tp_support_description']); ?></p>
                        <?php endif; ?>
                     </div>
                  </div>
               </div>
               <?php endif; ?>
               <div class="row">
                  <div class="col-xxl-12">
                     <div class="support__wrapper-2 d-flex flex-wrap align-items-center justify-content-center">
                     <?php foreach ($settings['tp_support_list'] as $key => $item) : 
                        
                         // Link
                         if ('2' == $item['tp_support_link_type']) {
                            $link = get_permalink($item['tp_support_page_link']);
                            $target = '_self';
                            $rel = 'nofollow';
                        } else {
                            $link = !empty($item['tp_support_link']['url']) ? $item['tp_support_link']['url'] : '';
                            $target = !empty($item['tp_support_link']['is_external']) ? '_blank' : '';
                            $rel = !empty($item['tp_support_link']['nofollow']) ? 'nofollow' : '';
                        }
                        ?>
                        <div class="support__item-2 d-flex align-items-center mb-10 wow fadeInUp tp-el-box" data-wow-delay=".3s" data-wow-duration="1s">
                           <div class="support__icon-2 mr-15 tp-el-box-icon">
                                <?php if($item['tp_box_icon_type'] == 'icon') : ?>
                                    <?php if (!empty($item['tp_box_icon']) || !empty($item['tp_box_selected_icon']['value'])) : ?>
                                            <span><?php tp_render_icon($item, 'tp_box_icon', 'tp_box_selected_icon'); ?></span>
                                    <?php endif; ?>
                                <?php elseif( $item['tp_box_icon_type'] == 'image' ) : ?>
                                    <span>
                                        <?php if (!empty($item['tp_box_icon_image']['url'])): ?>
                                        <img src="<?php echo $item['tp_box_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                        <?php endif; ?>
                                    </span>
                                <?php else : ?>
                                    <span>
                                        <?php if (!empty($item['tp_box_icon_svg'])): ?>
                                        <?php echo $item['tp_box_icon_svg']; ?>
                                        <?php endif; ?>
                                    </span>
                                <?php endif; ?>
                           </div>
                           <div class="support__content-2">
                              <?php if (!empty($item['tp_support_box_title' ])): ?>
                                <h3 class="support__title-2 tp-el-box-title">
                                    <?php if ($item['tp_support_link_switcher'] == 'yes') : ?>
                                    <a href="<?php echo esc_url($link); ?>"><?php echo tp_kses($item['tp_support_box_title' ]); ?></a>
                                    <?php else : ?>
                                        <?php echo tp_kses($item['tp_support_box_title' ]); ?>
                                    <?php endif; ?>
                                </h3>
                                <?php endif; ?>
                           </div>
                        </div>
                        <?php endforeach; ?>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- support area end -->

		<?php else: 
            $bloginfo = get_bloginfo( 'name' );
            $this->add_render_attribute('title_args', 'class', 'section__title-7 tp-el-title');    
            if ( !empty($settings['tp_support_thumb']['url']) ) {
                $tp_support_image_url = !empty($settings['tp_support_thumb']['id']) ? wp_get_attachment_image_url( $settings['tp_support_thumb']['id'], $settings['thumbnail_support_size']) : $settings['tp_support_thumb']['url'];
                $tp_support_image_alt = get_post_meta($settings["tp_support_thumb"]["id"], "_wp_attachment_image_alt", true);
            }  

            // Link
            if ('2' == $settings['tp_box_1_btn_link_type']) {
                $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_box_1_btn_page_link']));
                $this->add_render_attribute('tp-button-arg', 'target', '_self');
                $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('tp-button-arg', 'class', 'tp-btnr-2 mr-5 mb-15 tp-btn-shine-effect tp-el-box-btn');
            } else {
                if ( ! empty( $settings['tp_box_1_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'tp-button-arg', $settings['tp_box_1_btn_link'] );
                    $this->add_render_attribute('tp-button-arg', 'class', 'tp-btnr-2 mr-5 mb-15 tp-btn-shine-effect tp-el-box-btn');
                }
            }
            // Link
            if ('2' == $settings['tp_box_2_btn_link_type']) {
                $this->add_render_attribute('tp-button-arg-2', 'href', get_permalink($settings['tp_box_2_btn_page_link']));
                $this->add_render_attribute('tp-button-arg-2', 'target', '_self');
                $this->add_render_attribute('tp-button-arg-2', 'rel', 'nofollow');
                $this->add_render_attribute('tp-button-arg-2', 'class', 'tp-btnr-border-2 mb-15 tp-btn-shine-effect tp-link-btn-3 tp-el-box-btn-2');
            } else {
                if ( ! empty( $settings['tp_box_2_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'tp-button-arg-2', $settings['tp_box_2_btn_link'] );
                    $this->add_render_attribute('tp-button-arg-2', 'class', 'tp-btnr-border-2 mb-15 tp-btn-shine-effect tp-link-btn-3 tp-el-box-btn-2');
                }
            }
        ?>

         <!-- support area start -->
         <section class="support__area p-relative z-index-1 pt-160 pb-155 tp-el-section">
            <?php if(!empty($settings['support_shape_switch'])) : ?>
            <div class="support__shape">
               <img class="support__shape-4" src="<?php echo get_template_directory_uri() . '/assets/img/support/support-shape-4.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
            </div>
            <?php endif; ?>
            <div class="container">
               <div class="row">
                  <div class="col-xxl-6 col-lg-6">

                     <div class="support__wrapper pt-25">
                     <?php if ( !empty($settings['tp_support_section_title_show']) ) : ?>
                        <div class="section__title-wrapper-7">

                           <?php if(!empty($settings['tp_support_sub_title'])): ?>
                            <span class="section__title-pre-7 tp-el-subtitle"><?php echo tp_kses($settings['tp_support_sub_title']); ?></span>
                            <?php endif; ?>

                           <?php
                                if ( !empty($settings['tp_support_title' ]) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['tp_support_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        tp_kses( $settings['tp_support_title' ] )
                                        );
                                endif;
                            ?>
                        </div>
                        <?php endif; ?>
                        
                        <?php if ( !empty($settings['tp_support_section_title_show']) ) : ?>
                        <div class="tp-el-content">
                            <?php if (!empty($settings['tp_support_description' ])): ?>
                            <p><?php echo tp_kses($settings['tp_support_description']); ?></p>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>

                        <div class="support__item-wrapper">
                           <div class="row">
                                <?php foreach ($settings['tp_support_list'] as $key => $item) : 
                                     // Link
                                    if ('2' == $item['tp_support_link_type']) {
                                        $link = get_permalink($item['tp_support_page_link']);
                                        $target = '_self';
                                        $rel = 'nofollow';
                                    } else {
                                        $link = !empty($item['tp_support_link']['url']) ? $item['tp_support_link']['url'] : '';
                                        $target = !empty($item['tp_support_link']['is_external']) ? '_blank' : '';
                                        $rel = !empty($item['tp_support_link']['nofollow']) ? 'nofollow' : '';
                                    }    
                                ?>
                              <div class="col-sm-6">
                                 <div class="support__item mb-55 tp-el-box">
                                    <div class="support__icon tp-el-box-icon">
                                    <?php if($item['tp_box_icon_type'] == 'icon') : ?>
                                        <?php if (!empty($item['tp_box_icon']) || !empty($item['tp_box_selected_icon']['value'])) : ?>
                                                <span><?php tp_render_icon($item, 'tp_box_icon', 'tp_box_selected_icon'); ?></span>
                                        <?php endif; ?>
                                    <?php elseif( $item['tp_box_icon_type'] == 'image' ) : ?>
                                        <span>
                                            <?php if (!empty($item['tp_box_icon_image']['url'])): ?>
                                            <img src="<?php echo $item['tp_box_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                            <?php endif; ?>
                                        </span>
                                    <?php else : ?>
                                        <span>
                                            <?php if (!empty($item['tp_box_icon_svg'])): ?>
                                            <?php echo $item['tp_box_icon_svg']; ?>
                                            <?php endif; ?>
                                        </span>
                                    <?php endif; ?>
                                    </div>
                                    <div class="support__content">
                                       <?php if (!empty($item['tp_support_box_title' ])): ?>
                                        <h3 class="support_box__title tp-el-box-title">
                                            <?php if ($item['tp_support_link_switcher'] == 'yes') : ?>
                                            <a href="<?php echo esc_url($link); ?>"><?php echo tp_kses($item['tp_support_box_title' ]); ?></a>
                                            <?php else : ?>
                                                <?php echo tp_kses($item['tp_support_box_title' ]); ?>
                                            <?php endif; ?>
                                        </h3>
                                        <?php endif; ?>
                                        <?php if (!empty($item['tp_support_description' ])): ?>
                                        <p class="tp-el-box-desc"><?php echo tp_kses($item['tp_support_description']); ?></p>
                                        <?php endif; ?>
                                    </div>
                                 </div>
                              </div>
                              <?php endforeach; ?>
                           </div>
                        </div>
                        <div class="support__btn">

                        <?php if (!empty($settings['tp_box_1_btn_text'])) : ?>
                            <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>>
                                <?php echo $settings['tp_box_1_btn_text']; ?>                            
                            </a>
                            
                        <?php endif; ?>
                        <?php if (!empty($settings['tp_box_2_btn_text'])) : ?>
                            <a <?php echo $this->get_render_attribute_string( 'tp-button-arg-2' ); ?>>
                                <?php echo $settings['tp_box_2_btn_text']; ?>  
                                <span>
                                    <i class="fa-regular fa-arrow-right"></i>
                                </span>                          
                            </a>
                        <?php endif; ?>
                        </div>
                     </div>
                  </div>
                  <div class="col-xxl-6 col-lg-6">
                     <div class="support__thumb-wrapper pl-100">

                     <?php if(!empty($settings['tp_support_thumb_shape_switch'])): ?>
                        <div class="support__shape">
                           <img class="support__shape-1" src="<?php echo get_template_directory_uri() . '/assets/img/support/support-shape-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                           <img class="support__shape-2" data-parallax='{"y": -50, "smoothness": 40}' src="<?php echo get_template_directory_uri() . '/assets/img/support/support-shape-2.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                           <img class="support__shape-3" data-parallax='{"y": 50, "smoothness": 40}' src="<?php echo get_template_directory_uri() . '/assets/img/support/support-shape-3.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                        </div>
                        <?php endif; ?>

                        <div class="support__thumb">
                           <img class="" src="<?php echo esc_attr($tp_support_image_url); ?>" alt="<?php echo esc_attr($tp_support_image_alt); ?>">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- support area end -->
         <!-- features area end -->
        <?php endif; ?>

        <?php
	}
}

$widgets_manager->register( new TP_Support() );
