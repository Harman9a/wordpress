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
class TP_Contact_Box extends Widget_Base {

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
		return 'contact-box';
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
		return __( 'Contact Box', 'tpcore' );
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


    protected static function get_profile_names()
    {
        return [
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

        $this->tp_section_title_render_controls('contact', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.');

        // Service group
        $this->start_controls_section(
            '_TP_contact_info',
            [
                'label' => esc_html__('Contact Info List', 'tpcore'),
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
                    'repeater_condition' => ['style_1', 'style_3', 'style_6'],
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
                    'repeater_condition' => ['style_1', 'style_3', 'style_6'],
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
                    'repeater_condition' => ['style_1', 'style_3', 'style_6'],
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
                        'repeater_condition' => ['style_1', 'style_3', 'style_6'],
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
                        'repeater_condition' => ['style_1', 'style_3', 'style_6'],
                    ]
                ]
            );
        }



        $repeater->add_control(
            'tp_box_title', [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Service Title', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_contact_info',
            [
                'label' => esc_html__('Contact Info', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => '201 Stokes New York',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'want_customize',
            [
                'label' => esc_html__( 'Want To Customize?', 'tpcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'tpcore' ),
                'label_off' => esc_html__( 'No', 'tpcore' ),
                'return_value' => 'yes',
                'description' => esc_html__( 'You can customize this item from here or customize from Style tab', 'tpcore' ),
                'style_transfer' => true,
            ]
        );
        
        
        $repeater->add_control(
            'contact_icon_color',
            [
                'label'       => esc_html__( 'Contact Icon Color', 'tpcore' ),
                'type'     => \Elementor\Controls_Manager::COLOR,
                'selectors' => ['{{WRAPPER}} {{CURRENT_ITEM}} span' => 'color: {{VALUE}}'],
                'default' => '#5EB74B',
                'condition' => ['want_customize' => 'yes'],
            ]
        );
        
        $repeater->add_control(
            'contact_bg_color',
            [
                'label'       => esc_html__( 'Contact BG Color', 'tpcore' ),
                'type'     => \Elementor\Controls_Manager::COLOR,
                'selectors' => ['{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-color: {{VALUE}}'],
                'default' => '#5EB74B',
                'condition' => ['want_customize' => 'yes'],
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
                        'tp_box_title' => esc_html__('united states', 'tpcore'),
                    ],
                    [
                        'tp_box_title' => esc_html__('south Africa', 'tpcore')
                    ],
                    [
                        'tp_box_title' => esc_html__('United Kingdom', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_box_title }}}',
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
            ]
        );

        $this->add_control(
         'tp_contact_shape_switch',
         [
           'label'        => esc_html__( 'Enable Shape?', 'tpcore' ),
           'type'         => \Elementor\Controls_Manager::SWITCHER,
           'label_on'     => esc_html__( 'Show', 'tpcore' ),
           'label_off'    => esc_html__( 'Hide', 'tpcore' ),
           'return_value' => 'yes',
           'default'      => 'yes',
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
            'tp_slider_side_sec',
                [
                  'label' => esc_html__( 'Side Text', 'tpcore' ),
                  'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
           );
           
           $this->add_control(
            'tp_slider_side_text_show',
               [
               'label'        => esc_html__( 'Enable Side Text ?', 'tpcore' ),
               'type'         => \Elementor\Controls_Manager::SWITCHER,
               'label_on'     => esc_html__( 'Show', 'tpcore' ),
               'label_off'    => esc_html__( 'Hide', 'tpcore' ),
               'return_value' => 'yes',
               'default'      => 'yes',
               ]
           );
   
           $this->add_control(
           'tp_slider_side_text',
               [
                   'label'       => esc_html__( 'Slider Side Text', 'tpcore' ),
                   'type'        => \Elementor\Controls_Manager::TEXT,
                   'default'     => esc_html__( 'headphone', 'tpcore' ),
                   'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
                   'label_block' => true,
               ]
           );
   
           $this->add_control(
               'tp_slider_side_text_transform',
               [
                   'label' => esc_html__( 'Transform', 'tpcore' ),
                   'type' => Controls_Manager::TEXT,
                   'selectors' => [
                       '{{WRAPPER}} .slider__bg-text' => 'transform: {{VALUE}};',
                   ],
                   'label_block' => true,
                   'placeholder' => esc_html__( 'translate(200px) rotate(-90deg)', 'tpcore' ),
               ]
           );
           
   
   
           $this->end_controls_section();

	}

	// style_tab_content
	protected function style_tab_content(){
        $this->tp_section_style_controls('comint_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('about_subtitle', 'Section - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('about_title', 'Section - Title', '.tp-el-title');
        $this->tp_basic_style_controls('about_description', 'Section - Description', '.tp-el-content p');

        $this->tp_section_style_controls('coming_box', 'Contact - Box', '.tp-el-contact-box');
        $this->tp_basic_style_controls('coming_title', 'Contact - Title', '.tp-el-box-title');
        $this->tp_basic_style_controls('coming_subtitle', 'Contact - Description', '.tp-el-box-desc p');
        $this->tp_input_controls_style('coming_input', 'Form - Input', '.tp-el-box-input input', '.tp-el-box-input textarea');
        $this->tp_link_controls_style('coming_input_btn', 'Form - Button', '.tp-el-box-input button');
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

        $this->add_render_attribute('title_args', 'class', 'section__title-11 tp-el-title');  
        $bloginfo = get_bloginfo( 'name' );  

		?>

                <div class="slider__item-11 d-flex align-items-center p-relative is-white tp-el-section">

                    <?php if(($settings['tp_slider_side_text_show'] == 'yes')) :?>
                    <div class="slider__bg-text">
                        <h3 class="tp-el-side-text"><?php echo tp_kses($settings['tp_slider_side_text']); ?></h3>
                    </div>
                    <?php endif; ?>

                    <div class="container">
                        <div class="contact__inner-11 mt-50 p-relative z-index-1">

                            <?php if(!empty($settings['tp_contact_shape_switch'])) :?>
                            <div class="contact__shape">
                                <span class="contact__shape-circle"></span>
                                <img class="contact__shape-2" src="<?php echo get_template_directory_uri() . '/assets/img/contact/contact-man.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                            </div>
                            <?php endif; ?> 

                            <div class="row">
                                <div class="col-xxl-12">
                                    <div class="section__title-wrapper-11 mb-55 tp-el-content">

                                        <?php if (!empty($settings['tp_contact_sub_title'])) : ?>
                                        <span class="section__title-pre-11 tp-el-subtitle"><?php echo tp_kses( $settings['tp_contact_sub_title'] ); ?></span>
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

                                        <?php if (!empty($settings['tp_contact_description'])) : ?>
                                        <p><?php echo tp_kses( $settings['tp_contact_description'] ); ?></p>
                                        <?php endif; ?> 

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-6 d-none d-lg-block">
                                    <div class="contact__wrapper-11">
                                        <div class="contact__list-11">
                                        <?php foreach ($settings['tp_list'] as $item) : ?>
                                            <div class="contact__list-item-11 d-flex align-items-center fix elementor-repeater-item-<?php echo esc_attr($item['_id']); ?>">
                                                <div class="contact__list-icon-11 tp-el-box-icon">
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
                                                <div class="contact__list-content-11 tp-el-box-desc">
                                                    <?php if (!empty($item['tp_box_title'])) : ?>
                                                    <h5 class="tp-el-box-title"><?php echo tp_kses($item['tp_box_title' ]); ?></h5>
                                                    <?php endif; ?> 
                                                    <?php echo tp_kses($item['tp_contact_info']); ?>

                                                </div>
                                            </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-8 col-xl-7 col-lg-7 col-md-12">
                                    <div class="contact__form-11 ml-70 tp-el-contact-box tp-el-box-input">
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
                </div>

        <?php
	}
}

$widgets_manager->register( new TP_Contact_Box() );
