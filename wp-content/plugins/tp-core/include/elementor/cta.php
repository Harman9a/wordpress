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

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_CTA extends Widget_Base {

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
		return 'tp-cta';
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
		return __( 'CTA', 'tpcore' );
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


	// controls file 
	protected function register_controls_section(){
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
                    'layout-5' => esc_html__('Layout 5', 'tpcore'),
                    'layout-6' => esc_html__('Layout 6', 'tpcore'),
                    'layout-7' => esc_html__('Layout 7', 'tpcore'),
                    'layout-8' => esc_html__('Layout 8', 'tpcore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->add_control(
         'cta_style_2',
            [
            'label'        => esc_html__( 'Enable Second Style', 'tpcore' ),
            'type'         => \Elementor\Controls_Manager::SWITCHER,
            'label_on'     => esc_html__( 'Show', 'tpcore' ),
            'label_off'    => esc_html__( 'Hide', 'tpcore' ),
            'return_value' => 'yes',
            'default'      => 'no',
                'condition' => [
                    'tp_design_style' => 'layout-3'
                ]
            ]
        );

        $this->add_control(
         'cta_style_3',
            [
            'label'        => esc_html__( 'Enable Third Style', 'tpcore' ),
            'type'         => \Elementor\Controls_Manager::SWITCHER,
            'label_on'     => esc_html__( 'Show', 'tpcore' ),
            'label_off'    => esc_html__( 'Hide', 'tpcore' ),
            'return_value' => 'yes',
            'default'      => 'no',
                'condition' => [
                    'tp_design_style' => 'layout-4'
                ]
            ]
        );

        $this->add_control(
            'tp_cta_bg',
            [
              'label'   => esc_html__( 'Upload Image', 'tpcore' ),
              'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                  'url' => \Elementor\Utils::get_placeholder_image_src(),
              ],
              'condition' => [
                'tp_design_style' => 'layout-3',
                'cta_style_2' => 'yes'
            ]
            ]
           );
   
           $this->add_group_control(
               Group_Control_Image_Size::get_type(),
               [
                   'name' => 'thumbnail_bg', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                   'exclude' => ['custom'],
                   // 'default' => 'tp-post-thumb',
                   'condition' => [
                        'tp_design_style' => 'layout-3',
                        'cta_style_2' => 'yes'
                    ]
               ]
               
           );

        $this->end_controls_section();

        $this->tp_section_title_render_controls('cta', 'Section Title', 'Sub Title', 'your title here', 'Hic nesciunt galisum aut dolorem');


        $this->start_controls_section(
            'tpcore_contact',
            [
                'label' => esc_html__('Contact Form', 'tpcore'),
                'condition' => [
                    'tp_design_style' => ['layout-1', 'layout-6', 'layout-7', 'layout-8']
               ]
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

        $this->start_controls_section(
         'cta_bg_sec_2',
             [
               'label' => esc_html__( 'Background', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
               'condition' => [
                    'tp_design_style' => 'layout-5'
               ]
             ]
        );
        
        $this->add_control(
         'cta_bg_img',
            [
                'label'   => esc_html__( 'Background Image', 'tpcore' ),
                'label_block' => true,
                'type'    => \Elementor\Controls_Manager::MEDIA,
                    'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
         'cta_features_sec',
             [
               'label' => esc_html__( 'Features List', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
               'condition' =>[
                    'tp_design_style' => 'layout-6'
               ]
             ]
        );
        
        $this->add_control(
         'cta_features',
            [
            'label'       => esc_html__( 'Features Text', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXTAREA,
            'rows'        => 10,
            'default'     => esc_html__( 'Features List here', 'tpcore' ),
            'placeholder' => esc_html__( 'Your List', 'tpcore' ),
            ]
        );
        
        
        $this->end_controls_section();

        $this->start_controls_section(
         'cta_bg_sec',
             [
               'label' => esc_html__( 'CTA Background Layer', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
               'condition' =>[
                    'tp_design_style' => ['layout-3', 'layout-6', 'layout-8']
               ]
             ]
        );
        
        $this->add_control(
            'cta_bg_switch',
                [
                'label'        => esc_html__( 'Enable Bg', 'tpcore' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'tpcore' ),
                'label_off'    => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );
   
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'cta__overlay-5',
                'label'   => esc_html__( 'Background Color', 'tpcore' ),
                'types'    => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .cta__overlay-5',
                'condition' => [
                    'tp_design_style' => 'layout-3'
                ]
            ]
        );
   
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'subscribe__overlay',
                'label'   => esc_html__( 'Background Color', 'tpcore' ),
                'types'    => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .subscribe__overlay',
                'condition' => [
                    'tp_design_style' => 'layout-6'
                ]
            ]
        );
   
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'subscribe__bg',
                'label'   => esc_html__( 'Background Color', 'tpcore' ),
                'types'    => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .subscribe__bg',
                'condition' => [
                    'tp_design_style' => 'layout-8'
                ]
            ]
        );
        
        
        $this->end_controls_section();

        $this->start_controls_section(
         'tp_cta_shape_switch_section',
             [
               'label' => esc_html__( 'CTA Shape Switch', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
               'condition' => [
                    'tp_design_style' => ['layout-1', 'layout-2', 'layout-3', 'layout-4', 'layout-6', 'layout-7']
                ]
             ]
        );
        
        $this->add_control(
         'tp_cta_shape_switch',
            [
            'label'        => esc_html__( 'Enable Shape', 'tpcore' ),
            'type'         => \Elementor\Controls_Manager::SWITCHER,
            'label_on'     => esc_html__( 'Show', 'tpcore' ),
            'label_off'    => esc_html__( 'Hide', 'tpcore' ),
            'return_value' => 'yes',
            'default'      => 'yes',
            ]
        );
                
        $this->end_controls_section();

        $this->start_controls_section(
         'cta_icon_section',
             [
               'label' => esc_html__( 'CTA Icon', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
               'condition' => [
                    'tp_design_style' => 'layout-2'
               ]
             ]
        );
        
        $this->tp_icon_controls('box');

        $this->end_controls_section();


        // tp_btn_button_group
        $this->start_controls_section(
            'tp_btn_button_group',
            [
                'label' => esc_html__('Button', 'tpcore'),
            ]
        );

        $this->add_control(
            'tp_btn_button_show',
            [
                'label' => esc_html__( 'Show Button', 'tpcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tpcore' ),
                'label_off' => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'tp_btn_text',
            [
                'label' => esc_html__('Button Text', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'tpcore'),
                'title' => esc_html__('Enter button text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_btn_button_show' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'tp_btn_link_type',
            [
                'label' => esc_html__('Button Link Type', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'label_block' => true,
                'condition' => [
                    'tp_btn_button_show' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'tp_btn_link',
            [
                'label' => esc_html__('Button link', 'tpcore'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'tpcore'),
                'show_external' => false,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                    'custom_attributes' => '',
                ],
                'condition' => [
                    'tp_btn_link_type' => '1',
                    'tp_btn_button_show' => 'yes'
                ],
                'label_block' => true,
            ]
        );
        $this->add_control(
            'tp_btn_page_link',
            [
                'label' => esc_html__('Select Button Page', 'tpcore'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_btn_link_type' => '2',
                    'tp_btn_button_show' => 'yes'
                ]
            ]
        );
        $this->end_controls_section();

        $this->tp_button_render('cta_2', 'Cta Button 2', 'layout-4');

	}

	// style_tab_content
	protected function style_tab_content(){
        $this->tp_section_style_controls('cta_section', 'Section - Style', '.tp-el-section');
        $this->tp_section_style_controls('cta_box', 'Section - Box', '.tp-el-box');
        $this->tp_basic_style_controls('section_subtitle', 'Section - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('section_title', 'Section - Title', '.tp-el-title');
        $this->tp_basic_style_controls('section_description', 'Section - Description', '.tp-el-content p');
        
        
        $this->tp_link_controls_style('cta_box_btn', 'CTA - Button', '.tp-el-box-btn');
        $this->tp_link_controls_style('cta_box_btn_2', 'CTA - Button 2', '.tp-el-box-btn-2');
        // $this->tp_link_controls_style('cta_box_btn_arrow', 'CTA - Arrow Text', '.tp-el-box-btn-text');
        
        $this->tp_icon_style('section_icon', 'Contact - Icon', '.tp-el-box-icon span');
        $this->tp_input_controls_style('contact_input', 'Contact - Input', '.tp-el-contact-input input','.tp-el-contact-input textarea');
        $this->tp_link_controls_style('contact_btn', 'Contact - Button', '.tp-el-contact-input-btn button');

        $this->tp_basic_style_controls('section_list', 'List - Style', '.tp-el-list ul li');
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
            $this->add_render_attribute('title_args', 'class', 'ticket__title tp-el-title');  
            $bloginfo = get_bloginfo( 'name' );  

            // btn Link
            if ('2' == $settings['tp_btn_link_type']) {
                $link = get_permalink($settings['tp_btn_page_link']);
                $target = '_self';
                $rel = 'nofollow';
            } else {
                $link = !empty($settings['tp_btn_link']['url']) ? $settings['tp_btn_link']['url'] : '';
                $target = !empty($settings['tp_btn_link']['is_external']) ? '_blank' : '';
                $rel = !empty($settings['tp_btn_link']['nofollow']) ? 'nofollow' : '';
            }

        ?>
        <div class="tp-ticket-area tp-el-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-xl-8 col-lg-10 ">
                        <div class="ticket__wrapper blue-bg-2 d-md-flex flex-wrap align-items-center justify-content-between tp-el-box ">
                            <div class="ticket__inner d-sm-flex align-items-center">
                                <div class="ticket__shape">
                                    <img class="ticket__shape-1 wow fadeInDown" data-wow-delay=".3s" data-wow-duration="1s" src="<?php echo get_template_directory_uri() . '/assets/img/ticket/ticket-shape-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                                    <img class="ticket__shape-2 wow fadeInDown" data-wow-delay=".5s" data-wow-duration="1s" src="<?php echo get_template_directory_uri() . '/assets/img/ticket/ticket-shape-2.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                                    <img class="ticket__shape-3 wow fadeInUp" data-wow-delay=".7s" data-wow-duration="1s" src="<?php echo get_template_directory_uri() . '/assets/img/ticket/ticket-shape-3.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                                </div>

                                <div class="ticket__icon mr-15 tp-el-box-icon">
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

                                <div class="ticket__content tp-el-content">

                                    <?php if ( !empty($settings['tp_cta_sub_title']) ) : ?>
                                    <span class="ticket__title-pre tp-el-subtitle">
                                        <?php echo tp_kses( $settings['tp_cta_sub_title'] ); ?>
                                    </span>
                                    <?php endif; ?>

                                    <?php
                                        if ( !empty($settings['tp_cta_title' ]) ) :
                                            printf( '<%1$s %2$s>%3$s</%1$s>',
                                                tag_escape( $settings['tp_cta_title_tag'] ),
                                                $this->get_render_attribute_string( 'title_args' ),
                                                tp_kses( $settings['tp_cta_title' ] )
                                                );
                                        endif;
                                    ?>
                                    <?php if (!empty($settings['tp_cta_description' ])): ?>
                                    <p><?php echo tp_kses($settings['tp_cta_description']); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                               
                            <?php if (!empty($link)) : ?>
                            <div class="ticket__btn">
                                <a class="tp-btn-white-sm tp-el-box-btn" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>"><?php echo tp_kses($settings['tp_btn_text']); ?></a>
                            </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <?php elseif ( $settings['tp_design_style']  == 'layout-3' ):
            $this->add_render_attribute('title_args', 'class', 'cta__title-5 tp-el-title');
            $bloginfo = get_bloginfo( 'name' );  

            // btn Link
            if ('2' == $settings['tp_btn_link_type']) {
                $link = get_permalink($settings['tp_btn_page_link']);
                $target = '_self';
                $rel = 'nofollow';
            } else {
                $link = !empty($settings['tp_btn_link']['url']) ? $settings['tp_btn_link']['url'] : '';
                $target = !empty($settings['tp_btn_link']['is_external']) ? '_blank' : '';
                $rel = !empty($settings['tp_btn_link']['nofollow']) ? 'nofollow' : '';
            }

            

            if($settings['cta_style_2'] == 'yes'){
                $cta_style_2 =  'cta__style-2';
                $cta_bg_class = 'cta__half-bg';
            }else{
                $cta_style_2 =  '';
                $cta_bg_class = 'cta__overlay-5';
            }

            if ( !empty($settings['tp_cta_bg']['url']) ) {
                $tp_cta_bg = !empty($settings['tp_cta_bg']['id']) ? wp_get_attachment_image_url( $settings['tp_cta_bg']['id'], $settings['thumbnail_bg_size']) : $settings['tp_cta_bg']['url'];
                $tp_cta_bg_alt = get_post_meta($settings["tp_cta_bg"]["id"], "_wp_attachment_image_alt", true);
                
            }
        ?>

         <!-- cta area start -->
         <section class="cta__area <?php echo esc_attr($cta_style_2); ?> p-relative z-index-1 tp-el-section">

            <?php if(!empty($settings['cta_bg_switch'])) : ?>
            <div class="<?php echo esc_attr($cta_bg_class) ?>"></div>
            <?php endif; ?>

            <div class="container">
               <div class="cta__inner-5 tp-el-box cta-blue-bg">

               <?php if($settings['cta_style_2'] == 'yes') : ?>
                    <?php if(!empty($settings['tp_cta_shape_switch'])) : ?>
                    <div class="cta__shape-bg include-bg" data-background="<?php echo esc_url($tp_cta_bg) ?>"></div>
                    <?php endif; ?>
               <?php else: ?>
                <?php if(!empty($settings['tp_cta_shape_switch'])) : ?>
                    <div class="cta__shape">
                        <img class="cta__shape-7 wow fadeInDown" data-wow-delay=".3s" data-wow-duration="1s" src="<?php echo get_template_directory_uri() . '/assets/img/cta/5/cta-shape-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                        <img class="cta__shape-8 wow fadeInDown" data-wow-delay=".5s" data-wow-duration="1s" src="<?php echo get_template_directory_uri() . '/assets/img/cta/5/cta-shape-2.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                        <img class="cta__shape-9 wow fadeInUp" data-wow-delay=".7s" data-wow-duration="1s" src="<?php echo get_template_directory_uri() . '/assets/img/cta/5/cta-shape-3.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                        <img class="cta__shape-10 wow fadeInUp" data-wow-delay=".9s" data-wow-duration="1s" src="<?php echo get_template_directory_uri() . '/assets/img/cta/5/cta-shape-4.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                        <img class="cta__shape-11 wow fadeInUp" data-wow-delay=".6s" data-wow-duration="1s" src="<?php echo get_template_directory_uri() . '/assets/img/cta/5/cta-shape-5.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                        <img class="cta__shape-12 wow fadeInUp" data-wow-delay=".7s" data-wow-duration="1s" src="<?php echo get_template_directory_uri() . '/assets/img/cta/5/cta-shape-6.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                        <img class="cta__shape-13 wow fadeInUp" data-wow-delay=".8s" data-wow-duration="1s" src="<?php echo get_template_directory_uri() . '/assets/img/cta/5/cta-shape-7.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                        <img class="cta__shape-14 wow fadeInUp" data-wow-delay=".9s" data-wow-duration="1s" src="<?php echo get_template_directory_uri() . '/assets/img/cta/5/cta-shape-8.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                        <img class="cta__shape-15 wow fadeInUp" data-wow-delay="1s" data-wow-duration="1s" src="<?php echo get_template_directory_uri() . '/assets/img/cta/5/cta-shape-9.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                        <img class="cta__shape-16 wow fadeInUp" data-wow-delay="1.1s" data-wow-duration="1s" src="<?php echo get_template_directory_uri() . '/assets/img/cta/5/cta-shape-10.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                    </div>
                    <?php endif; ?>
                  <?php endif; ?>
                  <div class="row align-items-center">
                     <div class="col-xxl-8 col-xl-8 col-lg-8">

                        <div class="cta__content-5 tp-el-content">

                           <?php if(!empty($settings['tp_cta_sub_title'])): ?>
                            <span class="section__title-pre-5 tp-el-subtitle"><?php echo tp_kses($settings['tp_cta_sub_title']); ?></span>
                            <?php endif; ?>

                           <?php
                                if ( !empty($settings['tp_cta_title' ]) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['tp_cta_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        tp_kses( $settings['tp_cta_title' ] )
                                        );
                                endif;
                            ?>

                            <?php if ( !empty($settings['tp_cta_description']) ) : ?>
                            <p><?php echo tp_kses( $settings['tp_cta_description'] ); ?></p>
                            <?php endif; ?>

                        </div>
                     </div>

                     <div class="col-xxl-4 col-xl-4 col-lg-4">
                     <?php if (!empty($link)) : ?>
                        <div class="cta__btn-5 text-lg-end">
                           <a class="tp-btn-orange-2 tp-el-box-btn" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>"><?php echo tp_kses($settings['tp_btn_text']); ?></a>
                        </div>
                        <?php endif; ?>
                     </div>                  
                  </div>
               </div>
            </div>
         </section>
         <!-- cta area end -->

         <?php elseif ( $settings['tp_design_style']  == 'layout-4' ):
            $this->add_render_attribute('title_args', 'class', 'section__title-7 tp-el-title');
            $bloginfo = get_bloginfo( 'name' );  

            // btn Link
            if ('2' == $settings['tp_btn_link_type']) {
                $link = get_permalink($settings['tp_btn_page_link']);
                $target = '_self';
                $rel = 'nofollow';
            } else {
                $link = !empty($settings['tp_btn_link']['url']) ? $settings['tp_btn_link']['url'] : '';
                $target = !empty($settings['tp_btn_link']['is_external']) ? '_blank' : '';
                $rel = !empty($settings['tp_btn_link']['nofollow']) ? 'nofollow' : '';
            }

            if ('2' == $settings['tp_cta_2_btn_link_type']) {
                $link2 = get_permalink($settings['tp_cta_2_btn_page_link']);
                $target2 = '_self';
                $rel2 = 'nofollow';
            } else {
                $link2 = !empty($settings['tp_cta_2_btn_link']['url']) ? $settings['tp_cta_2_btn_link']['url'] : '';
                $target2 = !empty($settings['tp_cta_2_btn_link']['is_external']) ? '_blank' : '_self';
                $rel2 = !empty($settings['tp_cta_2_btn_link']['nofollow']) ? 'nofollow' : '';
            }

            if($settings['cta_style_3'] == 'yes'){
                $enable_style_3 = 'cta__style-3 grey-bg-7';
            }else{
                $enable_style_3 = 'green-light-bg-4';
            }

        ?>
         <!-- cta area start -->
         <section class="cta__area <?php echo esc_attr($enable_style_3); ?> p-relative z-index-1 pt-115 pb-60 tp-el-section">
         <?php if(!empty($settings['tp_cta_shape_switch'])) :?>
            <div class="cta__shape">
               <img class="cta__shape-17" src="<?php echo get_template_directory_uri() . '/assets/img/cta/7/cta-shape-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="cta__shape-18" src="<?php echo get_template_directory_uri() . '/assets/img/cta/7/cta-shape-2.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="cta__shape-19" src="<?php echo get_template_directory_uri() . '/assets/img/cta/7/cta-shape-3.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="cta__shape-20" src="<?php echo get_template_directory_uri() . '/assets/img/cta/7/cta-shape-4.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
            </div>
            <?php endif; ?>
            <div class="container">
               <div class="row align-items-center">
                  <div class="col-xxl-6 col-lg-6">
                     <div class="cta__wrapper-7">
                        <div class="section__title-wrapper-7 mb-60 tp-el-content">
                            <?php if ( !empty($settings['tp_cta_sub_title']) ) : ?>
                            <span class="section__title-pre-7 tp-el-subtitle">
                                <?php echo tp_kses( $settings['tp_cta_sub_title'] ); ?>
                            </span>
                            <?php endif; ?>

                            <?php
                                if ( !empty($settings['tp_cta_title' ]) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['tp_cta_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        tp_kses( $settings['tp_cta_title' ] )
                                        );
                                endif;
                            ?>    
                                     
                            <?php if ( !empty($settings['tp_cta_description']) ) : ?>
                            <p><?php echo tp_kses( $settings['tp_cta_description'] ); ?></p>
                            <?php endif; ?>
                        </div>
                     </div>
                  </div>
                  <div class="col-xxl-6 col-lg-6">
                     <div class="cta__btn-wrapper-7 d-sm-flex align-items-center justify-content-lg-end mb-40">
                        <?php if (!empty($link)) : ?>
                        <a class="tp-cta-btn mr-20 mb-20 tp-el-box-btn" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>"><?php echo tp_kses($settings['tp_btn_text']); ?></a>
                        <?php endif; ?>

                        
                        <?php if(!empty($settings['tp_cta_2_btn_switcher'])) :?>
                        <a class="tp-cta-btn-yellow mb-20 tp-el-box-btn-2" target="<?php echo esc_attr($target2); ?>" rel="<?php echo esc_attr($rel2); ?>" href="<?php echo esc_url($link2); ?>"><?php echo tp_kses($settings['tp_cta_2_btn_text']); ?></a>
                        <?php endif; ?>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- cta area end -->

         <?php elseif ( $settings['tp_design_style']  == 'layout-5' ):
            $this->add_render_attribute('title_args', 'class', 'cta__title-6 tp-el-title');
            $bloginfo = get_bloginfo( 'name' );  

            if ( !empty($settings['cta_bg_img']['url']) ) {
                $cta_bg_img_url = !empty($settings['cta_bg_img']['id']) ? wp_get_attachment_image_url( $settings['cta_bg_img']['id'], $settings['thumbnail_size']) : $settings['cta_bg_img']['url'];
                $cta_bg_img_alt = get_post_meta($settings["cta_bg_img"]["id"], "_wp_attachment_image_alt", true);
            }

            // btn Link
            if ('2' == $settings['tp_btn_link_type']) {
                $link = get_permalink($settings['tp_btn_page_link']);
                $target = '_self';
                $rel = 'nofollow';
            } else {
                $link = !empty($settings['tp_btn_link']['url']) ? $settings['tp_btn_link']['url'] : '';
                $target = !empty($settings['tp_btn_link']['is_external']) ? '_blank' : '';
                $rel = !empty($settings['tp_btn_link']['nofollow']) ? 'nofollow' : '';
            }

        ?>
         <!-- cta area start -->
         <section class="cta__area pb-140">
            <div class="container">
               <div class="cta__inner-6 p-relative include-bg wow fadeInUp backdrop-bg" data-wow-delay=".5s" data-wow-duration="1s" data-background="<?php echo esc_attr($cta_bg_img_url); ?>">
                  <div class="row align-items-center">
                     <div class="col-xl-6 col-lg-7">
                        <div class="cta__content-6 wow fadeInDown tp-el-content" data-wow-delay=".7s" data-wow-duration="1s">

                            <?php if ( !empty($settings['tp_cta_sub_title']) ) : ?>
                            <span class="tp-cta-subtitle-6 tp-el-subtitle">
                                <?php echo tp_kses( $settings['tp_cta_sub_title'] ); ?>
                            </span>
                            <?php endif; ?>

                           <?php
                                if ( !empty($settings['tp_cta_title' ]) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['tp_cta_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        tp_kses( $settings['tp_cta_title' ] )
                                        );
                                endif;
                            ?>

                            <?php if ( !empty($settings['tp_cta_description']) ) : ?>
                            <p><?php echo tp_kses( $settings['tp_cta_description'] ); ?></p>
                            <?php endif; ?>

                        </div>
                     </div>
                     <?php if (!empty($link)) : ?>
                     <div class="col-xl-6 col-lg-5">
                        <div class="cta__btn-6 text-lg-end wow fadeInDown" data-wow-delay=".9s" data-wow-duration="1s">
                            
                           <a class="tp-btn-white-2 tp-link-btn-3 tp-el-box-btn" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>">
                            <?php echo tp_kses($settings['tp_btn_text']); ?>
                              <span>
                                 <i class="fa-regular fa-arrow-right"></i>
                              </span>
                           </a>
                        </div>
                     </div>
                     <?php endif; ?>
                  </div>
               </div>
            </div>
         </section>
         <!-- cta area end -->


         <?php elseif ( $settings['tp_design_style']  == 'layout-6' ):
            $this->add_render_attribute('title_args', 'class', 'subscribe__title tp-el-title');
            $bloginfo = get_bloginfo( 'name' );  

            if ( !empty($settings['cta_bg_img']['url']) ) {
                $cta_bg_img_url = !empty($settings['cta_bg_img']['id']) ? wp_get_attachment_image_url( $settings['cta_bg_img']['id'], $settings['thumbnail_size']) : $settings['cta_bg_img']['url'];
                $cta_bg_img_alt = get_post_meta($settings["cta_bg_img"]["id"], "_wp_attachment_image_alt", true);
            }

        ?>

         <!-- cta area start -->
         <section class="subscribe__area p-relative z-index-1 pt-70 grey-bg-7 tp-el-section">
         <?php if(!empty($settings['cta_bg_switch'])) : ?>
            <div class="subscribe__overlay"></div>
            <?php endif; ?>
            <div class="container">
               <div class="subscribe__inner p-relative z-index-1 theme-bg-6 fix tp-el-box">
               <?php if(!empty($settings['tp_cta_shape_switch'])) :?>
                  <div class="subscribe__shape">
                     <img class="subscribe__shape-1" src="<?php echo get_template_directory_uri() . '/assets/img/cta/6/subscribe-shape-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                     <img class="subscribe__shape-2" src="<?php echo get_template_directory_uri() . '/assets/img/cta/6/subscribe-shape-2.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                  </div>
                  <?php endif; ?>
                  <div class="row justify-content-center">
                     <div class="col-xxl-6 col-xl-7 col-lg-8 col-md-10 col-sm-11">
                        <div class="subscribe__wrapper text-center tp-el-content">

                            <?php if ( !empty($settings['tp_cta_sub_title']) ) : ?>
                            <span class="tp-cta-subtitle-6 tp-el-subtitle">
                                <?php echo tp_kses( $settings['tp_cta_sub_title'] ); ?>
                            </span>
                            <?php endif; ?>

                           <?php
                                if ( !empty($settings['tp_cta_title' ]) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['tp_cta_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        tp_kses( $settings['tp_cta_title' ] )
                                        );
                                endif;
                            ?>
                         
                           <?php if ( !empty($settings['tp_cta_description']) ) : ?>
                                <p><?php echo tp_kses( $settings['tp_cta_description'] ); ?></p>
                            <?php endif; ?>
   
                           <div class="subscribe__form text-start tp-el-contact-input tp-el-contact-input-btn">
                                <?php if( !empty($settings['tpcore_select_contact_form']) ) : ?>
                                <?php echo do_shortcode( '[contact-form-7  id="'.$settings['tpcore_select_contact_form'].'"]' ); ?>
                                <?php else : ?>
                                    <?php echo '<div class="alert alert-info"><p class="m-0">' . __('Please Select contact form.', 'tpcore' ). '</p></div>'; ?>
                                <?php endif; ?>

                            <?php if(!empty($settings['cta_features'])) : ?>
                              <div class="subscribe__form-list text-sm-center tp-el-list">
                                 <?php echo tp_kses($settings['cta_features']); ?>
                              </div>
                              <?php endif; ?>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- cta area end -->

         <?php elseif ( $settings['tp_design_style']  == 'layout-7' ):
            $this->add_render_attribute('title_args', 'class', 'section__title-10 tp-el-title');
            $bloginfo = get_bloginfo( 'name' );  

            if ( !empty($settings['cta_bg_img']['url']) ) {
                $cta_bg_img_url = !empty($settings['cta_bg_img']['id']) ? wp_get_attachment_image_url( $settings['cta_bg_img']['id'], $settings['thumbnail_size']) : $settings['cta_bg_img']['url'];
                $cta_bg_img_alt = get_post_meta($settings["cta_bg_img"]["id"], "_wp_attachment_image_alt", true);
            }

        ?>

         <!-- subscribe area start -->
         <section class="subscribe__area fix p-relative black-bg-18 tp-el-section">
            <?php if(!empty($settings['tp_cta_shape_switch'])) : ?>
            <div class="subscribe__shape">
               <img class="subscribe__shape-3" src="<?php echo get_template_directory_uri() . '/assets/img/cta/10/subscribe-shape-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
            </div>
            <?php endif; ?>
            <div class="container">
               <div class="subscribe__inner-10 pt-70 pb-30 has-border">
                  <div class="row align-items-end">
                     <div class="col-xxl-7 col-xl-7 col-lg-6">
                        <div class="section__title-wrapper-10 is-white mb-45 tp-el-content">
                           <?php if ( !empty($settings['tp_cta_sub_title']) ) : ?>
                            <span class="section__title-pre-10 tp-el-subtitle"><?php echo tp_kses( $settings['tp_cta_sub_title'] ); ?></span>
                            <?php endif; ?>

                           <?php
                                if ( !empty($settings['tp_cta_title' ]) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['tp_cta_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        tp_kses( $settings['tp_cta_title' ] )
                                        );
                                endif;
                            ?>

                            <?php if ( !empty($settings['tp_cta_description']) ) : ?>
                                <p><?php echo tp_kses( $settings['tp_cta_description'] ); ?></p>
                            <?php endif; ?>

                        </div>
                     </div>
                     <div class="col-xxl-5 col-xl-5 col-lg-6">
                        <div class="subscribe__form-10 mb-55 tp-el-contact-input tp-el-contact-input-btn">
                            <?php if( !empty($settings['tpcore_select_contact_form']) ) : ?>
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
         <!-- subscribe area end -->

         <?php elseif ( $settings['tp_design_style']  == 'layout-8' ):
            $this->add_render_attribute('title_args', 'class', 'subscribe__title-14 tp-el-title');
            $bloginfo = get_bloginfo( 'name' );  
        ?>

         <!-- subscribe area start -->
         <section class="subscribe__area p-relative z-index-1">

            <?php if(!empty($settings['cta_bg_switch'])) : ?>
            <div class="subscribe__bg"></div>
            <?php endif; ?>
            <div class="container">
               <div class="subscribe__inner-14">
                  <div class="row gx-0 align-items-center">
                     <div class="col-xl-5 col-lg-5">

                        <div class="subscribe__section-title-wrapper tp-el-content">

                            <?php if ( !empty($settings['tp_cta_sub_title']) ) : ?>
                            <span class="subscribe-subtitle tp-el-subtitle"><?php echo tp_kses( $settings['tp_cta_sub_title'] ); ?></span>
                            <?php endif; ?>
    
                            <?php
                                if ( !empty($settings['tp_cta_title' ]) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['tp_cta_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        tp_kses( $settings['tp_cta_title' ] )
                                        );
                                endif;
                            ?>
    
                            <?php if ( !empty($settings['tp_cta_description']) ) : ?>
                                <p class="subscribe-desc"><?php echo tp_kses( $settings['tp_cta_description'] ); ?></p>
                            <?php endif; ?>
                        </div>
                     </div>
                     <div class="col-xl-7 col-lg-7">
                        <div class="subscribe__form-14 tp-el-contact-input tp-el-contact-input-btn">
                            <?php if( !empty($settings['tpcore_select_contact_form']) ) : ?>
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
         <!-- subscribe area end -->

		<?php else:
			$this->add_render_attribute('title_args', 'class', 'cta__title tp-el-title');
            $bloginfo = get_bloginfo( 'name' );  
            // Link
            if ('2' == $settings['tp_btn_link_type']) {
                $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_btn_page_link']));
                $this->add_render_attribute('tp-button-arg', 'target', '_self');
                $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('tp-button-arg', 'class', 'tp-solid-btn tp-el-box-btn');
            } else {
                if ( ! empty( $settings['tp_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'tp-button-arg', $settings['tp_btn_link'] );
                    $this->add_render_attribute('tp-button-arg', 'class', 'tp-solid-btn tp-el-box-btn');
                }
            }
		?>

         <!-- cta area start -->
         <section class="cta__area z-index-1 p-relative fix">

            <?php if(!empty($settings['tp_cta_shape_switch'])) :?>
            <div class="cta__shape">
               <img class="cta__shape-1" src="<?php echo get_template_directory_uri() . '/assets/img/cta/cta-shape-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="cta__shape-2" src="<?php echo get_template_directory_uri() . '/assets/img/cta/cta-shape-2.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="cta__shape-3" src="<?php echo get_template_directory_uri() . '/assets/img/cta/cta-shape-3.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="cta__shape-4" src="<?php echo get_template_directory_uri() . '/assets/img/cta/cta-shape-4.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="cta__shape-5" src="<?php echo get_template_directory_uri() . '/assets/img/cta/cta-shape-5.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="cta__shape-6" src="<?php echo get_template_directory_uri() . '/assets/img/cta/cta-man.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
            </div>
            <?php endif; ?>

            <div class="container">
               <div class="cta__inner">
                  <div class="row align-items-center">
                     <div class="col-xxl-5 col-xl-5 col-lg-6">
                        <div class="cta__content tp-el-content">

                        <?php if ( !empty($settings['tp_cta_sub_title']) ) : ?>
                        <span class="cta__title-pre tp-el-subtitle">
                            <?php echo tp_kses( $settings['tp_cta_sub_title'] ); ?>
                        </span>
                        <?php endif; ?>

                           <?php
                                if ( !empty($settings['tp_cta_title' ]) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['tp_cta_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        tp_kses( $settings['tp_cta_title' ] )
                                        );
                                endif;
                            ?>

                            <?php if ( !empty($settings['tp_cta_description']) ) : ?>
                                <p><?php echo tp_kses( $settings['tp_cta_description'] ); ?></p>
                            <?php endif; ?>
                        </div>
                     </div>
                     <div class="col-xxl-7 col-xl-7 col-lg-6">
                        <div class="cta__form p-relative z-index-1 tp-el-contact-input tp-el-contact-input-btn">
                        <?php if( !empty($settings['tpcore_select_contact_form']) ) : ?>
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
         <!-- cta area end -->
        <?php endif; ?>

        <?php
	}
}

$widgets_manager->register( new TP_CTA() );
