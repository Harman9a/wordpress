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
class TP_Architech_Slider extends Widget_Base {

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
		return 'tp-slider-architech';
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
		return __( 'Architech Slider', 'tpcore' );
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
            'facebook-f' => esc_html__('Facebook', 'tpcore'),
            'flickr' => esc_html__('Flicker', 'tpcore'),
            'foursquare' => esc_html__('FourSquare', 'tpcore'),
            'github' => esc_html__('Github', 'tpcore'),
            'houzz' => esc_html__('Houzz', 'tpcore'),
            'instagram' => esc_html__('Instagram', 'tpcore'),
            'jsfiddle' => esc_html__('JS Fiddle', 'tpcore'),
            'linkedin-in' => esc_html__('LinkedIn', 'tpcore'),
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
                ],
                'default' => 'layout-1',
            ]
        );
        $this->end_controls_section();

		
		$this->start_controls_section(
            'tp_main_slider',
            [
                'label' => esc_html__('Slider', 'tpcore'),
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
            'tp_slider_image',
            [
                'label' => esc_html__('Upload Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );
        $repeater->add_control(
            'tp_slider_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Grow business.', 'tpcore'),
                'placeholder' => esc_html__('Type Heading Text', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_slider_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('There are many variations of passages of Lorem Ipsum available but the majority have suffered alteration.', 'tpcore'),
                'placeholder' => esc_html__('Type section description here', 'tpcore'),
            ]
        );

        $repeater->add_control(
         'tp_slider_nav_image',
            [
                'label'   => esc_html__( 'Navigation Image', 'tpcore' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                    'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
         'tp_slider_nav_title',
         [
           'label'       => esc_html__( 'Slider Nav TItle', 'tpcore' ),
           'type'        => \Elementor\Controls_Manager::TEXTAREA,
           'description' => tp_get_allowed_html_desc( 'intermediate' ),
           'default'     => esc_html__( 'Commercial building Concept in village', 'tpcore' ),
           'placeholder' => esc_html__( 'Placeholder Text', 'tpcore' ),
         ]
        );

        $repeater->add_control(
            'tp_slider_title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'tpcore'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => esc_html__('H1', 'tpcore'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => esc_html__('H2', 'tpcore'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => esc_html__('H3', 'tpcore'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => esc_html__('H4', 'tpcore'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => esc_html__('H5', 'tpcore'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => esc_html__('H6', 'tpcore'),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h2',
                'toggle' => false,
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
                ]
            ]
        );

        $this->add_control(
            'slider_list',
            [
                'label' => esc_html__('Slider List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_slider_title' => esc_html__('Grow business.', 'tpcore')
                    ],
                    [
                        'tp_slider_title' => esc_html__('Development.', 'tpcore')
                    ],
                    [
                        'tp_slider_title' => esc_html__('Marketing.', 'tpcore')
                    ],
                ],
                'title_field' => '{{{ tp_slider_title }}}',
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

        $this->start_controls_section(
            'tp_slider_social_sec',
                [
                  'label' => esc_html__( 'Hero Social', 'tpcore' ),
                  'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
           );
           
              $this->add_control(
              'tp_slider_social_title',
                  [
                      'label'       => esc_html__( 'Hero Social Title', 'tpcore' ),
                      'type'        => \Elementor\Controls_Manager::TEXT,
                      'default'     => esc_html__( 'Follow Us', 'tpcore' ),
                      'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
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
      
              $repeater = new Repeater();
   
              $repeater->add_control(
               'tp_box_icon_type',
               [
                   'label' => esc_html__('Select Icon Type', 'tpcore'),
                   'type' => \Elementor\Controls_Manager::SELECT,
                   'default' => 'icon',
                   'options' => [
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
                       'tp_box_icon_type' => 'svg',
                   ]
               ]
           );
   
      
              $repeater->add_control(
                  'name',
                  [
                      'label' => esc_html__('Profile Name', 'tpcore'),
                      'type' => Controls_Manager::SELECT2,
                      'label_block' => true,
                      'select2options' => [
                          'allowClear' => false,
                      ],
                      'options' => self::get_profile_names(),
                      'condition' => [
                           'tp_box_icon_type' => 'icon',
                       ]
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
      
           
           $this->end_controls_section();

        // tp_slider_mouse_group
        $this->start_controls_section(
            'tp_slider_mouse_group',
            [
                'label' => esc_html__('Scroll Button', 'tp-core'),
            ]
            
        );

        $this->add_control(
            'tp_slider_mouse_show',
            [
                'label' => esc_html__( 'Show Scroll Icon', 'tp-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tp-core' ),
                'label_off' => esc_html__( 'Hide', 'tp-core' ),
                'return_value' => 'yes',
                'default' => true,
                
            ]
        );

        $this->add_control(
            'tp_slider_mouse_link',
            [
                'label' => esc_html__('Scroll link', 'tp-core'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'tp-core'),
                'show_external' => false,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                    'custom_attributes' => '',
                ],
                'condition' => [
                    'tp_slider_mouse_show' => 'yes'
                ],
                'label_block' => true,
            ]
        );
        $this->end_controls_section();

	}

    protected function style_tab_content(){
        $this->tp_basic_style_controls('slider_title', 'Slider - Title', '.tp-el-title');
        $this->tp_basic_style_controls('slider_description', 'Slider - Description', '.tp-el-content p');
        $this->tp_link_controls_style('slider_btn', 'Slider - Button', '.tp-el-btn');

        $this->tp_basic_style_controls('slider_nav_bg', 'Slider Nav Background', '.tp-el-nav-bg');
        $this->tp_basic_style_controls('slider_nav_subtitle', 'Slider Nav - Subtitle', '.tp-el-nav-subtitle');
        $this->tp_basic_style_controls('slider_nav_title', 'Slider Nav - Title', '.tp-el-nav-title');
        $this->tp_link_controls_style('slider_nav_btn', 'Slider Nav - Arrow', '.tp-el-nav-arrow button');
        $this->tp_link_controls_style('slider_nav_number', 'Slider Nav - Number', '.tp-el-nav-num span button, .tp-el-nav-num span');

        $this->tp_basic_style_controls('slider_social_title', 'Slider Social - Title', '.tp-el-social-title');
        $this->tp_link_controls_style('slider_social_link', 'Slider Social - Link', '.tp-el-social-link');
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



		<?php else: 
			if ( ! empty( $settings['tp_slider_mouse_link']['url'] ) ) {
                $this->add_link_attributes( 'tp-button-arg', $settings['tp_slider_mouse_link'] );
                $this->add_render_attribute('tp-button-arg', 'class', 'mouse-scroll-btn');
            }
		?>


         <!-- slider area start -->
         <section class="slider__area p-relative">

                <?php if ($settings['show_profiles'] && is_array($settings['profiles'])) : ?>
                <div class="slider__social d-none d-lg-block">
                    <ul>
                        <?php
                            foreach ($settings['profiles'] as $profile) :
                            $icon = $profile['name'];
                            $svg = $profile['tp_box_icon_svg'];

                            $url = esc_url($profile['link']['url']);

                        ?>
                        <li>
                            <a target="_blank" rel="noopener"  href="<?php echo esc_url($url); ?>" class="tp-el-social-link elementor-repeater-item-<?php echo esc_attr($profile['_id']) ; ?>">
                            <?php if (!empty($svg)) : ?>
                                <?php echo tp_kses($svg); ?>
                            <?php else : ?>
                                <i class="fa-brands fa-<?php echo esc_attr($icon); ?>" aria-hidden="true"></i>
                            <?php endif; ?>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>

                    <?php if (!empty($settings['tp_slider_social_title'])) : ?>
                    <span class="tp-el-social-title"><?php echo tp_kses( $settings['tp_slider_social_title'] ); ?></span>
                    <?php endif; ?>
                </div>
                <?php endif; ?> 

            <div class="slider__active swiper-container">
               <div class="swiper-wrapper">
                    <?php foreach ($settings['slider_list'] as $item) :
                        $this->add_render_attribute('title_args', 'class', 'slider__title-8 tp-el-title');

                        if ( !empty($item['tp_slider_image']['url']) ) {
                            $tp_slider_image_url = !empty($item['tp_slider_image']['id']) ? wp_get_attachment_image_url( $item['tp_slider_image']['id'], $settings['thumbnail_size']) : $item['tp_slider_image']['url'];
                            $tp_slider_image_alt = get_post_meta($item["tp_slider_image"]["id"], "_wp_attachment_image_alt", true);
                        }

                        if ( !empty($item['tp_slider_nav_image']['url']) ) {
                            $tp_slider_nav_image_url = !empty($item['tp_slider_nav_image']['id']) ? wp_get_attachment_image_url( $item['tp_slider_nav_image']['id'], $settings['thumbnail_size']) : $item['tp_slider_nav_image']['url'];
                            $tp_slider_nav_image_alt = get_post_meta($item["tp_slider_nav_image"]["id"], "_wp_attachment_image_alt", true);
                        }

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
                  <div class="slider__item-8 p-relative z-index-1 slider__height-8 swiper-slide d-flex align-items-center">
                     <div class="slider__bg-8 include-bg" data-background="<?php echo esc_url($tp_slider_image_url); ?>"></div>
                     <div class="container">
                        <div class="row justify-content-center">
                           <div class="col-xxl-10 col-xl-8 col-lg-9">
                              <div class="slider__content-8 tp-el-content">
                                 
                                    <?php
                                        if ($item['tp_slider_title_tag']) :
                                            printf('<%1$s %2$s>%3$s</%1$s>',
                                                tag_escape($item['tp_slider_title_tag']),
                                                $this->get_render_attribute_string('title_args'),
                                                tp_kses($item['tp_slider_title'])
                                            );
                                        endif;
                                    ?>

                                    <?php if (!empty($item['tp_slider_description'])) : ?>
                                    <p><?php echo tp_kses( $item['tp_slider_description'] ); ?></p>
                                    <?php endif; ?> 

                                <?php if (!empty($link)) : ?>
                                <div class="slider__btn-8">
                                    <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>" class="tp-btn-4 tp-style-border tp-el-btn"><?php echo tp_kses($item['tp_btn_btn_text']); ?><i class="fa-regular fa-chevron-right"></i></a>
                                </div>
                                <?php endif; ?>                                    
                                
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <?php endforeach; ?>
               </div>
               <div class="main-slider-dot-8 d-none d-sm-flex tp-el-nav-num"></div>
            </div>
            <div class="slider__nav d-none d-sm-block">
               <div class="slider__nav-active swiper-container">
                  <div class="swiper-wrapper">
                  <?php foreach ($settings['slider_list'] as $key => $item) :
                        $this->add_render_attribute('nav_title_args', 'class', 'slider-nav-title tp-el-title');

                        if ( !empty($item['tp_slider_nav_image']['url']) ) {
                            $tp_slider_nav_image_url = !empty($item['tp_slider_nav_image']['id']) ? wp_get_attachment_image_url( $item['tp_slider_nav_image']['id'], $settings['thumbnail_size']) : $item['tp_slider_nav_image']['url'];
                            $tp_slider_nav_image_alt = get_post_meta($item["tp_slider_nav_image"]["id"], "_wp_attachment_image_alt", true);
                        }

                        if($key < 9){
                            $index = '0' . ($key + 1 ) . '.';
                        }else{
                            $index = $key + 1 . '.';

                        }

                    ?> 
                     <div class="slider__nav-item d-flex align-items-center swiper-slide tp-el-nav-bg">
                        <div class="slider__nav-content">
                           <span class="tp-el-nav-subtitle"><?php echo $index; ?></span>

                           <?php if(!empty($item['tp_slider_nav_title']))  :?>
                           <h3 class="slider-nav-title tp-el-nav-title"><?php echo tp_kses($item['tp_slider_nav_title']); ?></h3>
                           <?php endif; ?>    
                        </div>
                        <?php if(!empty($tp_slider_nav_image_url)) : ?>
                        <div class="slider__nav-thumb">
                           <img src="<?php echo esc_url($tp_slider_nav_image_url); ?>" alt="<?php echo esc_url($tp_slider_nav_image_alt); ?>">
                        </div>
                        <?php endif; ?>
                     </div>
                     <?php endforeach; ?> 
                  </div>
               </div>

               <div class="slider__nav-arrow d-flex flex-column tp-el-nav-arrow">
                  <button class="slider-button-8-next"><i class="fa-regular fa-chevron-right"></i></button>
                  <button class="slider-button-8-prev"><i class="fa-regular fa-chevron-left"></i></button>
               </div>
            </div>

            <?php if (!empty($settings['tp_slider_mouse_link'])) : ?>
                <div class="mouse-scroll mouse-scroll-8">
                    <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>></a>
                </div>
            <?php endif; ?>
         </section>
         <!-- slider area end -->

         <?php endif; ?>


		<?php 
	}
}

$widgets_manager->register( new TP_Architech_Slider() );