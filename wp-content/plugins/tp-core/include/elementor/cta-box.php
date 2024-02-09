<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;
use Kirki\Field\Text;
use TPCore\Elementor\Controls\Group_Control_TPBGGradient;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_CTA_Box extends Widget_Base {

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
		return 'tp-cta-box';
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
		return __( 'CTA Box', 'tpcore' );
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

     protected static function get_profile_names()
     {
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->tp_section_title_render_controls('cta', 'Section Title', 'Sub Title', 'your title here', 'Hic nesciunt galisum aut dolorem');

        $this->start_controls_section(
            'tpcore_contact',
            [
                'label' => esc_html__('Contact Form', 'tpcore'),
                'condition' => [
                    'tp_design_style' => ['layout-1', 'layout-2', 'layout-3']
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
         'cta_video_sec',
             [
               'label' => esc_html__( 'Video Controls', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
               'condition' => [
                'tp_design_style' => 'layout-1'
               ]
             ]
        );

        $this->add_control(
        'cta_video_label',
         [
            'label'       => esc_html__( 'Video Label', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( 'Watch Video', 'tpcore' ),
            'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
         ]
        );
        
        $this->add_control(
         'cta_video_url',
         [
           'label'   => esc_html__( 'Insert Video URL', 'tpcore' ),
           'type'        => \Elementor\Controls_Manager::URL,
           'default'     => [
               'url'               => '#',
               'is_external'       => true,
               'nofollow'          => true,
               'custom_attributes' => '',
             ],
             'placeholder' => esc_html__( 'youtube.com/video-url', 'tpcore' ),
             'label_block' => true,
           ]
         );

         $this->add_control(
         'cta_video_title',
          [
             'label'       => esc_html__( 'Title', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::TEXT,
             'default'     => esc_html__( 'Special Message', 'tpcore' ),
             'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
          ]
         );

         $this->add_control(
          'cta_video_desc',
          [
            'label'       => esc_html__( 'Description', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXTAREA,
            'rows'        => 10,
            'default'     => esc_html__( 'Democracy arises out of the notion that those.', 'tpcore' ),
            'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
          ]
         );
        
         $this->add_control(
          'cta_video_bg',
          [
            'label'   => esc_html__( 'Upload Background Image', 'tpcore' ),
            'type'    => \Elementor\Controls_Manager::MEDIA,
              'default' => [
                'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
          ]
         );
        $this->end_controls_section();

        $this->start_controls_section(
         'cta_bg_image_sec',
             [
               'label' => esc_html__( 'Thumbnail', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
               'condition' => [
                'tp_design_style' => ['layout-2', 'layout-3']
               ]
             ]
        );
        
        $this->add_control(
         'cta_bg_image',
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
                'name' => 'cta_bg_image_size',
                'exclude' => ['custom'],
            ]
            
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
         'cta_fact_sec',
             [
               'label' => esc_html__( 'Fact Controls', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
               'condition' => [
                'tp_design_style' => 'layout-1'
               ]
             ]
        );

        $this->tp_icon_controls('box', 'layout-1');

        $this->add_control(
        'cta_fact_num',
            [
                'label'       => esc_html__( 'Fact Number', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( '223', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Fact Number', 'tpcore' ),
            ]
        );
        
        $this->add_control(
            'cta_fact_unit',
            [
                'label'       => esc_html__( 'Fact Unit', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'K', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Unit Text', 'tpcore' ),
            ]
        );

        $this->add_control(
        'cta_fact_before_unit',
         [
            'label'       => esc_html__( 'Fact Before Unit', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( '+', 'tpcore' ),
            'placeholder' => esc_html__( 'Your Unit Text', 'tpcore' ),
         ]
        );

        $this->add_control(
        'cta_fact_desc',
         [
            'label'       => esc_html__( 'Fact Description', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( '2022 Win Vote', 'tpcore' ),
            'placeholder' => esc_html__( 'Fact Description', 'tpcore' ),
         ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
         'tp_cta_shape_switch_section',
             [
               'label' => esc_html__( 'CTA Shape Switch', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
               'condition' => [
                'tp_design_style' => ['layout-1', 'layout-2']
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
            'tp_slider_side_sec',
                [
                  'label' => esc_html__( 'Side Text', 'tpcore' ),
                  'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                  'condition' => [
                    'tp_design_style' => 'layout-3'
                   ]
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
			'tp_slider_side_text_color',
			[
				'label' => esc_html__( 'Transform', 'tpcore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slider__bg-text h3' => 'color: {{VALUE}};',
				],
                'default' => '#5EB74B',
                'label_block' => true,
                'placeholder' => esc_html__( 'Color code', 'tpcore' ),
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

        $this->start_controls_section(
            '_section_social',
            [
                'label' => esc_html__('Social Profiles', 'tpcore'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'name',
            [
                'label' => esc_html__('Profile Name', 'tpcore'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'select2options' => [
                    'allowClear' => false,
                ],
                'options' => self::get_profile_names()
            ]
        );

        $repeater->add_control(
            'link', [
                'label' => esc_html__('Profile Link', 'tpcore'),
                'placeholder' => esc_html__('Add your profile link', 'tpcore'),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'autocomplete' => false,
                'show_external' => false,
                'condition' => [
                    'name!' => 'email'
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );
        $this->add_control(
            'profiles',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(name.slice(0,1).toUpperCase() + name.slice(1)) #>',
                'default' => [
                    [
                        'link' => ['url' => 'https://facebook.com/'],
                        'name' => 'facebook'
                    ],
                    [
                        'link' => ['url' => 'https://linkedin.com/'],
                        'name' => 'linkedin'
                    ],
                    [
                        'link' => ['url' => 'https://twitter.com/'],
                        'name' => 'twitter'
                    ]
                ],
            ]
        );

        $this->add_control(
            'show_profiles',
            [
                'label' => esc_html__('Show Profiles', 'tpcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'tpcore'),
                'label_off' => esc_html__('Hide', 'tpcore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
                'style_transfer' => true,
            ]
        );       

        $this->end_controls_section();

	}

	// style_tab_content
	protected function style_tab_content(){
        $this->tp_section_style_controls('cta_section', 'Section - Style', '.tp-el-section');
        $this->tp_section_style_controls('cta_section_inner', 'Section - Inner', '.tp-el-section-inner');
        $this->tp_basic_style_controls('section_subtitle', 'Section - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('section_title', 'Section - Title', '.tp-el-title');
        $this->tp_basic_style_controls('section_description', 'Section - Description', '.tp-el-content p');

        
        // $this->tp_link_controls_style('cta_box_btn', 'CTA - Button', '.tp-el-box-btn');
        // $this->tp_link_controls_style('cta_box_btn_arrow', 'CTA - Arrow Text', '.tp-el-box-btn-text');
        
        $this->tp_link_controls_style('coming_time_social', 'Social', '.tp-el-box-social a');
        $this->tp_input_controls_style('contact_input', 'Form - Input', '.tp-el-contact-input input','.tp-el-contact-input textarea');
        $this->tp_link_controls_style('contact_btn', 'Form - Button', '.tp-el-contact-input-btn button');

        $this->tp_link_controls_style('video_btn', 'Video - Button', '.tp-el-video-btn');
        $this->tp_basic_style_controls('video_label', 'Video - Label', '.tp-el-video-label');
        $this->tp_basic_style_controls('video_title', 'Video - Title', '.tp-el-video-title');
        $this->tp_basic_style_controls('video_desc', 'Video - Description', '.tp-el-video-desc');

        $this->tp_icon_style('info_label', 'Info - Icon', '.tp-el-info-icon span');
        $this->tp_basic_style_controls('info_title', 'Info - Title', '.tp-el-info-title');
        $this->tp_basic_style_controls('info_desc', 'Info - Description', '.tp-el-info-desc');
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
            $this->add_render_attribute('title_args', 'class', 'cta__title-13 tp-el-title');  
            $bloginfo = get_bloginfo( 'name' );  

            if ( !empty($settings['cta_bg_image']['url']) ) {
                $cta_bg_image = !empty($settings['cta_bg_image']['id']) ? wp_get_attachment_image_url( $settings['cta_bg_image']['id'], $settings['cta_bg_image_size_size']) : $settings['cta_bg_image']['url'];
                $cta_bg_image_alt = get_post_meta($settings["cta_bg_image"]["id"], "_wp_attachment_image_alt", true);
            }

        ?>

        <!-- cta area start -->
        <section class="cta__area pt-50 pb-50 p-relative include-bg jarallax tp-el-section" data-background="<?php echo esc_url($cta_bg_image); ?>">
            <div class="container">
               <div class="cta__inner-13 white-bg tp-el-section-inner">
                  <div class="row align-items-center">
                     <div class="col-xl-6 col-lg-6">
                        <div class="cta__content-13 tp-el-content">

                        <?php if ( !empty($settings['tp_cta_sub_title']) ) : ?>
                        <span class="faq__title-pre tp-el-subtitle"><?php echo tp_kses( $settings['tp_cta_sub_title'] ); ?></span>
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
                           <?php if (!empty($settings['tp_cta_description'])) : ?>
                            <p><?php echo tp_kses( $settings['tp_cta_description'] ); ?></p>
                            <?php endif; ?> 

                        </div>
                     </div>
                     <div class="col-xl-6 col-lg-6">
                        <div class="cta__form-13 tp-el-contact-input tp-el-contact-input-btn">
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

         
		<?php elseif ( $settings['tp_design_style']  == 'layout-3' ):
            $this->add_render_attribute('title_args', 'class', 'subscribe__title-11 tp-el-title');  
            $bloginfo = get_bloginfo( 'name' );  

            if ( !empty($settings['cta_bg_image']['url']) ) {
                $cta_bg_image = !empty($settings['cta_bg_image']['id']) ? wp_get_attachment_image_url( $settings['cta_bg_image']['id'], $settings['cta_bg_image_size_size']) : $settings['cta_bg_image']['url'];
                $cta_bg_image_alt = get_post_meta($settings["cta_bg_image"]["id"], "_wp_attachment_image_alt", true);
            }

        ?>

            <div class="slider__item-11 d-flex align-items-center align-items-sm-end p-relative is-khaki tp-el-section">

                <?php if(($settings['tp_slider_side_text_show'] == 'yes')) :?>
                <div class="slider__bg-text">
                    <h3 class="tp-el-side-text"><?php echo tp_kses($settings['tp_slider_side_text']); ?></h3>
                </div>
                <?php endif; ?>

                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xxl-5 col-xl-6 col-lg-6 col-md-8 col-sm-9">
                            <div class="subscribe__wrapper-11 pr-25 tp-el-content tp-el-contact-input tp-el-contact-input-btn">

                                <?php if (!empty($settings['tp_cta_sub_title'])) : ?>
                                <span class="tp-el-subtitle"><?php echo tp_kses( $settings['tp_cta_sub_title'] ); ?></span>
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

                                <?php if (!empty($settings['tp_cta_description'])) : ?>
                                <p><?php echo tp_kses( $settings['tp_cta_description'] ); ?></p>
                                <?php endif; ?> 

                                <?php if( !empty($settings['tpcore_select_contact_form']) ) : ?>
                                    <?php echo do_shortcode( '[contact-form-7  id="'.$settings['tpcore_select_contact_form'].'"]' ); ?>
                                <?php else : ?>
                                        <?php echo '<div class="alert alert-info"><p class="m-0">' . __('Please Select contact form.', 'tpcore' ). '</p></div>'; ?>
                                <?php endif; ?>

                                <?php if ($settings['show_profiles'] && is_array($settings['profiles'])) : ?>
                                <div class="subscribe__social tp-el-box-social">
                                    <?php
                                        foreach ($settings['profiles'] as $profile) :
                                            $icon = $profile['name'];
                                            $url = esc_url($profile['link']['url']);
                                            
                                            printf('<a target="_blank" rel="noopener"  href="%s" class="elementor-repeater-item-%s"><i class="fab fa-%s" aria-hidden="true"></i></a>',
                                                $url,
                                                esc_attr($profile['_id']),
                                                esc_attr($icon)
                                            );
                                        endforeach; 
                                    ?>
                                </div>
                                <?php endif; ?>

                            </div>
                        </div>
                        <div class="col-xxl-7 col-xl-6 col-lg-6 col-md-4 col-sm-3">
                            <div class="subscribe__thumb text-end">
                                <div class="subscribe__thumb-animation-1"></div>
                                <div class="subscribe__thumb-animation-2"></div>

                                <img src="<?php echo esc_url($cta_bg_image) ?>" alt="<?php echo esc_attr($cta_bg_image_alt); ?>">

                            </div>
                        </div>
                    </div>
                </div>
            </div>


		<?php else:
			$this->add_render_attribute('title_args', 'class', 'cta-form-title tp-el-title');
            $bloginfo = get_bloginfo( 'name' );  

            if ( !empty($settings['cta_video_bg']['url']) ) {
                $cta_video_bg = !empty($settings['cta_video_bg']['id']) ? wp_get_attachment_image_url( $settings['cta_video_bg']['id'], $settings['cta_video_bg_size_size']) : $settings['cta_video_bg']['url'];
                $cta_video_bg_alt = get_post_meta($settings["cta_video_bg"]["id"], "_wp_attachment_image_alt", true);
            }

            $bg_shape = $settings['tp_cta_shape_switch'] == 'yes' ? '/assets/img/cta/10/cta-shape.png' : '';


		?>

         <!-- cta area start -->
         <section class="cta__area pb-140 tp-el-section">
            <div class="container">
               <div class="cta__inner-10 include-bg tp-el-section-inner" data-background="<?php echo get_template_directory_uri() . ''.$bg_shape.'' ?>">
                  <div class="row">
                     <div class="col-xxl-6 col-xl-6 col-lg-6">
                        <div class="cta__form-10 tp-el-content tp-el-contact-input tp-el-contact-input-btn">
                            <?php if (!empty($settings['tp_cta_sub_title'])) : ?>
                            <span class="cta-form-sub-title tp-el-subtitle"><?php echo tp_kses( $settings['tp_cta_sub_title'] ); ?></span>
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
                           <?php if (!empty($settings['tp_cta_description'])) : ?>
                            <p><?php echo tp_kses( $settings['tp_cta_description'] ); ?></p>
                            <?php endif; ?> 

                            <?php if( !empty($settings['tpcore_select_contact_form']) ) : ?>
                                <?php echo do_shortcode( '[contact-form-7  id="'.$settings['tpcore_select_contact_form'].'"]' ); ?>
                            <?php else : ?>
                                    <?php echo '<div class="alert alert-info"><p class="m-0">' . __('Please Select contact form.', 'tpcore' ). '</p></div>'; ?>
                            <?php endif; ?>
                        </div>
                     </div>
                     <div class="col-xxl-6 col-xl-6 col-lg-6">
                        <div class="cta__features-wrapper d-sm-flex">
                           <div class="cta__features-item p-relative">
                              <div class="cta__features-overlay">
                                 <img src="<?php echo esc_url($cta_video_bg); ?>" alt="<?php echo esc_attr($cta_video_bg_alt); ?>">
                              </div>

                              <?php if(!empty($settings['cta_video_url']['url'])) : ?>
                              <div class="cta__features-video">
                                 <a href="<?php echo esc_url($settings['cta_video_url']['url']); ?>" class="popup-video tp-el-video-btn">
                                    <svg width="17" height="18" viewBox="0 0 17 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path d="M0 9.00223V5.31839C0 0.564251 3.36026 -1.35234 7.46724 1.01228L10.6533 2.8542L13.8393 4.69612C17.9463 7.06075 17.9463 10.9437 13.8393 13.3083L10.6533 15.1503L7.46724 16.9922C3.36026 19.3568 0 17.4153 0 12.6861V9.00223Z" fill="currentColor"/>
                                    </svg>
                                 </a>
                                 <?php if(!empty($settings['cta_video_label'])) : ?>
                                 <span class="tp-el-video-label"><?php echo esc_html($settings['cta_video_label']) ?></span>
                                 <?php endif; ?>
                              </div>
                                <?php endif; ?>

                              <div class="cta__features-content">

                                <?php if(!empty($settings['cta_video_title'])) : ?>
                                 <h3 class="cta__features-title tp-el-video-title"><?php echo esc_html($settings['cta_video_title']) ?></h3>
                                 <?php endif; ?>

                                 <?php if(!empty($settings['cta_video_desc'])) : ?>
                                 <p class="tp-el-video-desc"><?php echo esc_html($settings['cta_video_desc']) ?></p>
                                 <?php endif; ?>
                              </div>

                           </div>
                           <div class="cta__counter">
                              <div class="cta__counter-icon tp-el-info-icon">
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
                              <div class="cta__counter-content">

                                 <h4 class="tp-el-info-title"><?php echo esc_html($settings['cta_fact_before_unit']) ?><span data-purecounter-duration="1" data-purecounter-end="<?php echo esc_attr($settings['cta_fact_num']) ?>"  class="purecounter">0</span><?php echo esc_html($settings['cta_fact_unit']) ?></h4>
                                 <p class="tp-el-info-desc"><?php echo esc_html($settings['cta_fact_desc']) ?></p>

                              </div>
                           </div>
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

$widgets_manager->register( new TP_CTA_Box() );
