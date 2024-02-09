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
class TP_Contact_Info extends Widget_Base {

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
		return 'contact-info';
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
		return __( 'Contact Info', 'tpcore' );
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
                    'layout-4' => esc_html__('Layout 4', 'tpcore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->tp_section_title_render_controls('contact', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.');

        // Service group
        $this->start_controls_section(
            '_TP_contact_info',
            [
                'label' => esc_html__('Contact  List', 'tpcore'),
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
                    'style_2' => __( 'Style 2', 'tpcore' ),
                    'style_3' => __( 'Style 3', 'tpcore' ),
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
                    'tp_box_icon_type' => 'svg'
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
                        'tp_box_icon_type' => 'icon'
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
                        'tp_box_icon_type' => 'icon'
                    ]
                ]
            );
        }


        $repeater->add_control(
            'tp_contact_info_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Title Here',
                'label_block' => true,
            ]
        );     
        $repeater->add_control(
            'tp_contact_info',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => '201 Stokes New York',
                'label_block' => true,
            ]
        );     

        $repeater->add_control(
            'tp_btn_link_switcher',
            [
                'label' => esc_html__( 'Add Button link', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'tpcore' ),
                'label_off' => esc_html__( 'No', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
                'condition' => [
                    'repeater_condition' => 'style_1'
                ]
            ]
        );
        $repeater->add_control(
            'tp_btn_btn_text',
            [
                'label' => esc_html__('Button Text', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'tpcore'),
                'title' => esc_html__('Enter button text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_btn_link_switcher' => 'yes',
                    'repeater_condition' => 'style_1'
                ],
            ]
        );
        $repeater->add_control(
            'tp_btn_link_type',
            [
                'label' => esc_html__( 'Button Link Type', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'tp_btn_link_switcher' => 'yes',
                    'repeater_condition' => 'style_1'
                ]
            ]
        );
        $repeater->add_control(
            'tp_btn_link',
            [
                'label' => esc_html__( 'Button Link link', 'tpcore' ),
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
                    'tp_btn_link_type' => '1',
                    'tp_btn_link_switcher' => 'yes',
                    'repeater_condition' => 'style_1'
                ]
            ]
        );
        $repeater->add_control(
            'tp_btn_page_link',
            [
                'label' => esc_html__( 'Select Button Link Page', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_btn_link_type' => '2',
                    'tp_btn_link_switcher' => 'yes',
                    'repeater_condition' => 'style_1'
                ]
            ]
        );

        $this->add_control(
            'tp_list',
            [
                'label' => esc_html__('Contact - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_contact_info_title' => esc_html__('united states', 'tpcore'),
                    ],
                    [
                        'tp_contact_info_title' => esc_html__('south Africa', 'tpcore')
                    ],
                    [
                        'tp_contact_info_title' => esc_html__('United Kingdom', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_contact_info_title }}}',
            ]
        );
        $this->add_responsive_control(
            'tp_align',
            [
                'label' => esc_html__( 'Alignment', 'tpcore' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'text-left' => [
                        'title' => esc_html__( 'Left', 'tpcore' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'text-center' => [
                        'title' => esc_html__( 'Center', 'tpcore' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'text-right' => [
                        'title' => esc_html__( 'Right', 'tpcore' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'toggle' => true,
                'separator' => 'before',
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
            'tpcore_contact',
            [
                'label' => esc_html__('Contact Form', 'tpcore'),
                'condition' =>[
                    'tp_design_style' => 'layout-3'
                ]
            ]
        );
        $this->add_control(
        'tp_contact_form_title',
         [
            'label'       => esc_html__( 'Form Title', 'tpcore' ),
            'label_block' => true,
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( 'Lets get in touch with us', 'tpcore' ),
            'placeholder' => esc_html__( 'Your Title', 'tpcore' ),
         ]
        );
        $this->add_control(
            'tpcore_select_contact_form',
            [
                'label'   => esc_html__( 'Select Form', 'tpcore' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '0',
                'options' => $this->get_tp_contact_form(),
            ]
        );

        $this->end_controls_section();

	}

    // TAB_STYLE
    protected function style_tab_content(){
        $this->tp_section_style_controls('section_info', 'Section - Style', '.tp-el-section');

        $this->tp_basic_style_controls('about_subtitle', 'Section - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('about_title', 'Section - Title', '.tp-el-title');
        $this->tp_basic_style_controls('about_description', 'Section - Description', '.tp-el-content-desc');

        
        $this->tp_section_style_controls('about_dsfad', 'Contact - Box', '.tp-el-box');
        $this->start_controls_section(
            'tp_features_box_img',
                [
                  'label' => esc_html__( 'Box Gradient BG Color', 'tpcore' ),
                  'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                ]
           );
           
   
           $this->add_control(
               'tp_gradient_bg_color',
               [
                   'label' => esc_html__('Gradient Background Color', 'tp-core'),
                   'type' => Controls_Manager::TEXT,
                   'label_block' => true,
                   'selectors' => [
                       '{{WRAPPER}} .tp-el-gradient-bg::after' => 'background: {{VALUE}};',
                   ],
               ]
           );
           
           $this->end_controls_section();
        $this->tp_icon_style('section_icon', 'Contact - Icon', '.tp-el-box-icon span');
        $this->tp_basic_style_controls('coming_title', 'Contact - Title', '.tp-el-box-title');
        $this->tp_basic_style_controls('coming_subtitle', 'Contact - Description', '.tp-el-box-desc');
        $this->tp_link_controls_style('coming_btn', 'Contact - Button', '.tp-el-box-btn');

        $this->tp_basic_style_controls('form_title', 'Form - Title', '.tp-el-input-title');
        $this->tp_input_controls_style('contact_input', 'Form - Input', '.tp-el-contact-input input','.tp-el-contact-input textarea');
        $this->tp_link_controls_style('contact_btn', 'Form - Button', '.tp-el-contact-input-btn button');
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
            $this->add_render_attribute('title_args', 'class', 'section__title-4 tp-el-title');
            $bloginfo = get_bloginfo( 'name' );
        ?>

        <div class="contact__wrapper wow fadeInLeft tp-el-section" data-wow-delay=".3s" data-wow-duration="1s">
            <?php if ( !empty($settings['tp_contact_section_title_show']) ) : ?>       
                <div class="section__title-wrapper-4 mb-20">

                    <?php if ( !empty($settings['tp_contact_sub_title']) ) : ?>
                    <span class="section__title-pre-4 tp-el-subtitle">
                        <?php echo tp_kses( $settings['tp_contact_sub_title'] ); ?>
                    </span>
                    <?php endif; ?>

                    <?php
                        if ( !empty($settings['tp_contact_title' ]) ) :
                            printf( '<%1$s %2$s>%3$s</%1$s>',
                                tag_escape( $settings['tp_contact_title_tag'] ),
                                $this->get_render_attribute_string( 'title_args' ),
                                tp_kses( $settings['tp_contact_title' ] )
                                );
                        endif;
                    ?>
                    
                </div>

                <?php if ( !empty($settings['tp_contact_description']) ) : ?>
                <p class="tp-el-content-desc"><?php echo tp_kses( $settings['tp_contact_description'] ); ?></p>
                <?php endif; ?>
            
            <?php endif; ?>

            <div class="contact__list">
                <?php foreach ($settings['tp_list'] as $item) : 
                    // btn Link
                    if ('2' == $item['tp_btn_link_type']) {
                        $link = get_permalink($item['tp_btn_page_link']);
                        $target = '_self';
                        $rel = 'nofollow';
                    } else {
                        $link = !empty($item['tp_btn_link']['url']) ? $item['tp_btn_link']['url'] : '';
                        $target = !empty($item['tp_btn_link']['is_external']) ? '_blank' : '';
                        $rel = !empty($item['tp_btn_link']['nofollow']) ? 'nofollow' : '';
                    }
                ?>
                <div class="contact__list-item d-flex align-items-center tp-el-box">
                    <div class="contact__list-icon tp-el-box-icon">
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
                    <div class="contact__list-content">
                        <?php if($item['tp_contact_info_title']) : ?>
                        <h5 class="tp-el-box-title"><?php echo tp_kses($item['tp_contact_info_title']); ?></h5>
                        <?php endif; ?>

                        <p class="tp-el-box-desc"><?php echo tp_kses($item['tp_contact_info']); ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <?php elseif ( $settings['tp_design_style']  == 'layout-3' ):
            $bloginfo = get_bloginfo( 'name' );
            $this->add_render_attribute('title_args', 'class', 'section__title-9 tp-el-title');
        ?>

         <!-- contact area start -->
         <section class="contact__area pt-150 pb-150 p-relative z-index-1 tp-el-section">
            <div class="contact__shape">
               <span class="contact__shape-1"></span>
            </div>
            <div class="container">
               <div class="row">
                  <div class="col-xxl-5 col-xl-5 col-lg-5 col-md-6">
                     <div class="contact__wrapper-9">
                     <?php if ( !empty($settings['tp_contact_section_title_show']) ) : ?> 
                        <div class="section__title-wrapper-9 mb-85 has-black-p">

                            <?php if ( !empty($settings['tp_contact_sub_title']) ) : ?>
                            <span class="section__title-pre-9 tp-el-subtitle"><?php echo tp_kses( $settings['tp_contact_sub_title'] ); ?></span>
                            <?php endif; ?>

                           <?php
                                if ( !empty($settings['tp_contact_title' ]) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['tp_contact_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        tp_kses( $settings['tp_contact_title' ] )
                                        );
                                endif;
                            ?>

                        <?php if ( !empty($settings['tp_contact_description']) ) : ?>
                            <p class="tp-el-content-desc"><?php echo tp_kses( $settings['tp_contact_description'] ); ?></p>
                        <?php endif; ?>

                        </div>
                        <?php endif; ?>
                        <div class="contact__list-9 mr-100">
                            <?php foreach ($settings['tp_list'] as $item) : 
                                // btn Link
                                if ('2' == $item['tp_btn_link_type']) {
                                    $link = get_permalink($item['tp_btn_page_link']);
                                    $target = '_self';
                                    $rel = 'nofollow';
                                } else {
                                    $link = !empty($item['tp_btn_link']['url']) ? $item['tp_btn_link']['url'] : '';
                                    $target = !empty($item['tp_btn_link']['is_external']) ? '_blank' : '';
                                    $rel = !empty($item['tp_btn_link']['nofollow']) ? 'nofollow' : '';
                                }
                            ?>
                           <div class="contact__list-item-9 flex-wrap d-flex align-items-start tp-el-box tp-el-gradient-bg">
                              <div class="contact__list-icon-9 tp-el-box-icon">
                                    <?php if($item['tp_box_icon_type'] == 'icon') : ?>
                                    <?php if (!empty($item['tp_box_icon']) || !empty($item['tp_box_selected_icon']['value'])) : ?>
                                            <span>
                                                <?php tp_render_icon($item, 'tp_box_icon', 'tp_box_selected_icon'); ?>
                                                <img class="contact-icon-shape" src="<?php echo get_template_directory_uri() . '/assets/img/contact/contact-icon-shape.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                                            </span>
                                    <?php endif; ?>

                                    <?php elseif( $item['tp_box_icon_type'] == 'image' ) : ?>
                                        <span>
                                            <?php if (!empty($item['tp_box_icon_image']['url'])): ?>
                                            <img src="<?php echo $item['tp_box_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                            <?php endif; ?>
                                            <img class="contact-icon-shape" src="<?php echo get_template_directory_uri() . '/assets/img/contact/contact-icon-shape.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                                        </span>

                                    <?php else : ?>
                                        <span>
                                            <?php if (!empty($item['tp_box_icon_svg'])): ?>
                                            <?php echo $item['tp_box_icon_svg']; ?>
                                            <?php endif; ?>
                                            <img class="contact-icon-shape" src="<?php echo get_template_directory_uri() . '/assets/img/contact/contact-icon-shape.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                                        </span>
                                    <?php endif; ?>
                                
                              </div>
                              <div class="contact__list-content-9">
                                    <?php if($item['tp_contact_info_title']) : ?>
                                    <h5 class="tp-el-box-title"><?php echo tp_kses($item['tp_contact_info_title']); ?></h5>
                                    <?php endif; ?> 

                                    <?php if($item['tp_contact_info']) : ?> 
                                    <p class="tp-el-box-desc"><a href="tel:<?php echo esc_attr($item['tp_contact_info']); ?>"><?php echo tp_kses($item['tp_contact_info']); ?></a></p>
                                    <?php endif; ?> 
                              </div>
                           </div>
                           <?php endforeach; ?>
                        </div>
                     </div>
                  </div>
                  <div class="col-xxl-7 col-xl-7 col-lg-7 col-md-6">
                     <div class="contact__form-9 pt-20 pl-70">
                        <?php if($settings['tp_contact_form_title']) : ?>
                        <h4 class="contact__form-9-title tp-el-input-title"><?php echo tp_kses($settings['tp_contact_form_title']) ; ?></h4>
                        <?php endif; ?> 

                        <?php if( !empty($settings['tpcore_select_contact_form']) ) : ?>
                        <div class="contact__form-9-inner tp-el-contact-input tp-el-contact-input-btn">
                            <?php echo do_shortcode( '[contact-form-7  id="'.$settings['tpcore_select_contact_form'].'"]' ); ?>

                        <?php else : ?>
                                <?php echo '<div class="alert alert-info"><p class="m-0">' . __('Please Select contact form.', 'tpcore' ). '</p></div>'; ?>
                        <?php endif; ?>	
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- contact area end -->

         <?php elseif ( $settings['tp_design_style']  == 'layout-4' ):
            $bloginfo = get_bloginfo( 'name' );
            $this->add_render_attribute('title_args', 'class', 'tp-section-title-2 font-40 tp-el-title');
        ?>

         <!-- contact location box area start -->
         <section class="contact__loacation-box-area pt-120 pb-90 tp-el-section">
            <div class="container">
            <?php if ( !empty($settings['tp_contact_section_title_show']) ) : ?> 
               <div class="row">
                  <div class="col-xl-5 col-lg-7 offset-xl-1 col-md-8">
                     <div class="tp-section-wrapper-2 mb-35">
                        <?php if ( !empty($settings['tp_contact_sub_title']) ) : ?>
                        <span class="tp-section-subtitle-2 subtitle-mb-9 tp-el-subtitle">
                            <?php echo tp_kses( $settings['tp_contact_sub_title'] ); ?>
                        </span>
                        <?php endif; ?>

                        <?php
                            if ( !empty($settings['tp_contact_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['tp_contact_title_tag'] ),
                                    $this->get_render_attribute_string( 'title_args' ),
                                    tp_kses( $settings['tp_contact_title' ] )
                                    );
                            endif;
                        ?>

                        <?php if ( !empty($settings['tp_contact_description']) ) : ?>
                            <p class="tp-el-content-desc"><?php echo tp_kses( $settings['tp_contact_description'] ); ?></p>
                        <?php endif; ?>
                     </div>
                  </div>
               </div>
               <?php endif; ?>
               <div class="row">
                    <?php foreach ($settings['tp_list'] as $item) : 
                        // btn Link
                        if ('2' == $item['tp_btn_link_type']) {
                            $link = get_permalink($item['tp_btn_page_link']);
                            $target = '_self';
                            $rel = 'nofollow';
                        } else {
                            $link = !empty($item['tp_btn_link']['url']) ? $item['tp_btn_link']['url'] : '';
                            $target = !empty($item['tp_btn_link']['is_external']) ? '_blank' : '';
                            $rel = !empty($item['tp_btn_link']['nofollow']) ? 'nofollow' : '';
                        }
                    ?>
                  <div class="col-lg-4 col-md-6">
                     <div class="contact__location-box text-center white-bg mb-30 tp-el-box">
                        <div class="contact__location-box-icon tp-el-box-icon">
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
                        <div class="contact__location-box-content">

                            <?php if($item['tp_contact_info_title']) : ?>
                            <h3 class="contact__location-box-title tp-el-box-title"><?php echo tp_kses($item['tp_contact_info_title']); ?></h3>
                            <?php endif; ?> 

                           <?php if($item['tp_contact_info']) : ?>
                           <div class="contact__location-box-info tp-el-box-desc">
                            <?php echo tp_kses($item['tp_contact_info']); ?>
                           </div>
                           <?php endif; ?>
                           <?php if (!empty($link)) : ?>
                           <div class="contact__location-box-btn">
                              <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>" class="tp-btn-border tp-el-box-btn"><?php echo tp_kses($item['tp_btn_btn_text']); ?></a>
                           </div>
                           <?php endif; ?>
                        </div>
                     </div>
                  </div>
                  <?php endforeach; ?>
               </div>
            </div>
         </section>
         <!-- contact location box area end -->

        <?php else:
            $bloginfo = get_bloginfo( 'name' );
            $this->add_render_attribute('title_args', 'class', 'tp-section-title-2 font-40 tp-el-title');
        ?>


         <section class="contact__location-area tp-el-section">
            <div class="container">
               <?php if ( !empty($settings['tp_contact_section_title_show']) ) : ?> 
               <div class="row">
                  <div class="col-xl-5 col-lg-7 offset-xl-1 col-md-8">
                     <div class="tp-section-wrapper-2 mb-35">
                        <?php if ( !empty($settings['tp_contact_sub_title']) ) : ?>
                        <span class="tp-section-subtitle-2 subtitle-mb-9 tp-el-subtitle">
                            <?php echo tp_kses( $settings['tp_contact_sub_title'] ); ?>
                        </span>
                        <?php endif; ?>

                        <?php
                            if ( !empty($settings['tp_contact_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['tp_contact_title_tag'] ),
                                    $this->get_render_attribute_string( 'title_args' ),
                                    tp_kses( $settings['tp_contact_title' ] )
                                    );
                            endif;
                        ?>

                        <?php if ( !empty($settings['tp_contact_description']) ) : ?>
                            <p class="tp-el-content-desc"><?php echo tp_kses( $settings['tp_contact_description'] ); ?></p>
                        <?php endif; ?>
                     </div>
                  </div>
               </div>
               <?php endif; ?>
               <div class="row justify-content-center">
                  <div class="col-xl-10 ">
                     <div class="contact__location-wrapper">
                        <?php foreach ($settings['tp_list'] as $item) : 
                            // btn Link
                            if ('2' == $item['tp_btn_link_type']) {
                                $link = get_permalink($item['tp_btn_page_link']);
                                $target = '_self';
                                $rel = 'nofollow';
                            } else {
                                $link = !empty($item['tp_btn_link']['url']) ? $item['tp_btn_link']['url'] : '';
                                $target = !empty($item['tp_btn_link']['is_external']) ? '_blank' : '';
                                $rel = !empty($item['tp_btn_link']['nofollow']) ? 'nofollow' : '';
                            }
                        ?>
                        <div class="contact__location-item tp-el-box">
                           <div class="row align-items-center">
                              <div class="col-lg-9 col-md-8 col-sm-7">
                                 <div class="contact__location-content d-lg-flex align-items-center">

                                    <?php if($item['tp_contact_info_title']) : ?>
                                    <h3 class="contact__location-title tp-el-box-title"><?php echo tp_kses($item['tp_contact_info_title']); ?></h3>
                                    <?php endif; ?> 

                                    <div class="contact__location-info d-sm-flex flex-wrap align-items-center">
                                       <div class="contact__location-icon mr-45 tp-el-box-icon">
                                        <!--  -->
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
                                        <?php if($item['tp_contact_info']) : ?>
                                       <div class="contact__location-content">
                                            <p class="tp-el-box-desc"><?php echo tp_kses($item['tp_contact_info']); ?></p>
                                       </div>
                                       <?php endif; ?> 
                                    </div>
                                 </div>
                              </div>
                              <?php if (!empty($link)) : ?>
                              <div class="col-lg-3 col-md-4 col-sm-5">
                                 <div class="contact__location-btn text-sm-end">
                                    <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>" class="tp-btn-border tp-el-box-btn"><?php echo tp_kses($item['tp_btn_btn_text']); ?></a>
                                 </div>
                              </div>
                              <?php endif; ?> 
                           </div>
                        </div>
                        <?php endforeach; ?>
                     </div>
                  </div>
               </div>
            </div>
         </section>

        <?php endif; ?>

        <?php 
	}
}

$widgets_manager->register( new TP_Contact_Info() );