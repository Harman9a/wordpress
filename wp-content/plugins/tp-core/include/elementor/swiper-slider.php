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
class TP_Swiper_Slider extends Widget_Base {

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
		return 'tp-swiper-slider';
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
		return __( 'Swiper Slider', 'tpcore' );
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
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Grow business.', 'tpcore'),
                'placeholder' => esc_html__('Type Heading Text', 'tpcore'),
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
            'tp_slider_title_pos',
            [
                'label' => esc_html__('Title Position', 'tp-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],

                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .slider__content-12' => 'left: {{SIZE}}%;',
                ],
                'condition' => ['want_customize' => 'yes'],
                
            ]
        );

        $repeater->add_control(
         'tp_slider_gradient',
         [
           'label'       => esc_html__( 'Insert Gradient Code', 'tpcore' ),
           'type'        => \Elementor\Controls_Manager::TEXTAREA,
           'rows'        => 10,
           'default'     => esc_html__( 'radial-gradient(98.58% 98.5% at 64.83% 79.1%, #FF80FF 0%, #F174FF 19%, #CD53FF 55%, #9721FF 100%)', 'tpcore' ),
           'placeholder' => esc_html__( 'radial-gradient(98.58% 98.5% at 64.83% 79.1%, #FF80FF 0%, #F174FF 19%, #CD53FF 55%, #9721FF 100%)', 'tpcore' ),
           'condition' => ['want_customize' => 'yes'],
         ]
        );
        
        
        $repeater->add_control(
            'tp_slider_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Branding 2022', 'tpcore'),
                'placeholder' => esc_html__('Type section description here', 'tpcore'),
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

        $this->add_control(
            'slider_list',
            [
                'label' => esc_html__('Slider List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_slider_title' => esc_html__('Design', 'tpcore')
                    ],
                    [
                        'tp_slider_title' => esc_html__('Creative', 'tpcore')
                    ],
                    [
                        'tp_slider_title' => esc_html__('Aristide', 'tpcore')
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
                  'label' => esc_html__( 'Slider Social', 'tpcore' ),
                  'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
           );
           
              $this->add_control(
              'tp_slider_social_title',
                  [
                      'label'       => esc_html__( 'Slider Social Title', 'tpcore' ),
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
                'tp_profile_title',
                [
                    'label' => esc_html__('Profile Title', 'tpcore'),
                    'description' => tp_get_allowed_html_desc( 'basic' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__('Follow: ', 'tpcore'),
                    'placeholder' => esc_html__('Type Sub Heading Text', 'tpcore'),
                    'label_block' => true,
                ]
            );
            $this->add_responsive_control(
                'tp_social_align',
                [
                    'label' => esc_html__('Alignment', 'tp-core'),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'text-start' => [
                            'title' => esc_html__('Left', 'tp-core'),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'text-center' => [
                            'title' => esc_html__('Center', 'tp-core'),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'text-end' => [
                            'title' => esc_html__('Right', 'tp-core'),
                            'icon' => 'eicon-text-align-right',
                        ],
                    ],
                    'default' => 'text-start',
                    'toggle' => false,
                ]
            );
            
    
            $this->end_controls_section();
	}

    protected function style_tab_content(){
        $this->tp_basic_style_controls('slider_title', 'Slider - Title', '.tp-el-title');
        $this->tp_basic_style_controls('slider_description', 'Slider - Meta', '.tp-el-box-meta');
    

        $this->tp_basic_style_controls('slider_social_title', 'Slider Social - Title', '.tp-el-social-title');
        $this->tp_link_controls_style('slider_social_link', 'Slider Social - Link', '.tp-el-social-link');

        $this->tp_link_controls_style('slider_nav_btn', 'Slider Nav - Arrow', '.tp-el-nav-arrow button');
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

		?>


        <!-- slider area start -->
        <section class="slider__area p-relative">
            <div class="slider__active-12 slider__height-12 swiper-container">
               <div class="swiper-wrapper">

                    <?php foreach ($settings['slider_list'] as $key => $item) :

                        $this->add_render_attribute('title_args', 'class', 'slider__title-12 tp-el-title');

                        if ( !empty($item['tp_slider_image']['url']) ) {
                            $tp_slider_image_url = !empty($item['tp_slider_image']['id']) ? wp_get_attachment_image_url( $item['tp_slider_image']['id'], $settings['thumbnail_size']) : $item['tp_slider_image']['url'];
                            $tp_slider_image_alt = get_post_meta($item["tp_slider_image"]["id"], "_wp_attachment_image_alt", true);
                        }

                    ?> 
                  <div class="slider__item-12 slider__bg-12 tp_slider_content_pos elementor-repeater-item-<?php echo esc_attr($item['_id']); ?> d-flex align-items-center swiper-slide" data-background-gradient="<?php echo esc_attr($item['tp_slider_gradient']); ?>">
                     <div class="container">
                        <div class="row">
                           <div class="col-xl-12">
                              <div class="slider__content-12-wrapper p-relative z-index-1">
                                 <div class="slider__thumb-12 p-relative">
                                    <div class="slider__thumb-12-shape">
                                       <svg width="343" height="542" viewBox="0 0 343 542" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <path d="M342.611 0.950439C298.64 96.4119 149.581 129.632 75.7749 186.568C-56.6496 288.697 5.60275 451.591 102.856 541.861C41.2282 466.059 12.5859 431.364 21.0735 334.2C37.6798 144.469 321.718 150.455 342.611 0.950439Z" fill="white"/>
                                       </svg>                                             
                                       <svg width="493" height="681" viewBox="0 0 493 681" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <path d="M492.405 0L478.524 1.41845C469.469 2.35462 456.155 3.77305 439.35 6.18441C422.545 8.59577 402.192 11.8582 379.057 16.1986C355.922 20.5391 330.033 26.4682 302.412 34.4683C273.046 42.9191 244.266 53.2866 216.258 65.5039C201.412 71.8302 186.85 79.2344 172.174 87.0359C157.565 95.0849 143.45 103.999 129.906 113.731C122.894 118.469 116.592 123.83 110.035 128.994C103.478 134.157 97.0337 139.604 91.3564 145.476C79.2872 156.833 68.1785 169.168 58.1438 182.356C48.2326 195.172 39.4024 208.789 31.744 223.065C24.5035 237.162 18.4367 251.831 13.6049 266.923C11.0216 274.328 9.54555 281.931 7.5017 289.42C6.13913 297.023 4.35076 304.456 3.41399 312.115C1.13967 327.138 0.000986929 342.311 0.00758029 357.505C-0.263245 387.711 6.72654 417.54 20.3893 444.485C34.2137 471.577 56.2702 494.272 78.6958 513.762C101.121 533.251 124.512 550.017 145.291 565.875C166.07 581.734 185.033 596.429 200.816 610.188C216.599 623.947 229.827 636.174 239.99 646.727C245.213 651.947 249.556 656.77 253.417 660.911C257.277 665.053 260.485 668.656 262.983 671.635L270.761 680.656L263.636 671.323C261.365 668.231 258.47 664.486 254.836 660.202C251.203 655.918 247.2 650.84 242.232 645.479C232.609 634.386 220.062 621.535 204.904 607.351C189.745 593.166 171.492 577.705 150.969 561.507C130.445 545.308 108.133 527.918 86.5022 508.457C64.8714 488.996 44.9155 466.669 31.886 440.939C19.0438 414.964 12.6745 386.272 13.321 357.307C13.4629 349.988 13.5765 342.64 14.3997 335.349C15.2229 328.059 16.0461 320.597 17.2384 313.136C18.4306 305.675 20.077 298.498 21.4396 291.179C23.5118 283.916 25.0447 276.569 27.5712 269.42C32.0675 254.846 37.7643 240.67 44.6033 227.037C51.7609 213.123 60.0793 199.837 69.4701 187.32C79.0377 174.545 89.6532 162.589 101.207 151.575C106.884 145.901 113.129 140.71 119.119 135.377C125.562 130.355 131.609 125.079 138.337 120.455C164.379 101.688 192.209 85.5338 221.425 72.2273C248.662 59.6694 276.715 48.9595 305.393 40.1704C332.417 31.83 357.738 25.1916 380.476 20.0568C403.214 14.922 423.255 10.9504 439.918 8.17023C456.581 5.39007 469.639 3.1773 478.666 1.92907L492.405 0Z" fill="white"/>
                                       </svg>                                                                                                                          
                                    </div>
                                    <img src="<?php echo esc_url($tp_slider_image_url); ?>" alt="<?php echo esc_attr($tp_slider_image_alt); ?>">
                                 </div>

                                 <div class="slider__content-12">
                                    <?php
                                        if ($item['tp_slider_title_tag']) :
                                            printf('<%1$s %2$s>%3$s</%1$s>',
                                                tag_escape($item['tp_slider_title_tag']),
                                                $this->get_render_attribute_string('title_args'),
                                                tp_kses($item['tp_slider_title'])
                                            );
                                        endif;
                                    ?>
                                 </div>

                                 <div class="slider__content-12-branding">
                                    <?php if (!empty($item['tp_slider_description'])) : ?>
                                    <p class="tp-el-box-meta"><?php echo tp_kses( $item['tp_slider_description'] ); ?></p>
                                    <?php endif; ?> 
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     
                  </div>
                  <?php endforeach; ?>

               </div>
               <div class="slider-pagination-12 tp-swiper-fraction"></div>
               <div class="slider__nav-arrow-12 d-flex flex-column d-none d-md-block tp-el-nav-arrow">
                  <button class="slider-button-12-next"><i class="fa-regular fa-chevron-right"></i></button>
                  <button class="slider-button-12-prev"><i class="fa-regular fa-chevron-left"></i></button>
               </div>
            </div>
            <?php if ($settings['show_profiles'] && is_array($settings['profiles'])) : ?>
            <div class="slider__social-12">
                <?php if (!empty($settings['tp_slider_social_title'])) : ?>
                <span class="tp-el-social-title"><?php echo tp_kses( $settings['tp_slider_social_title'] ); ?></span>
                <?php endif; ?>

                <?php
                    foreach ($settings['profiles'] as $profile) :
                    $icon = $profile['name'];

                    $url = esc_url($profile['link']['url']);

                ?>
                <a target="_blank" rel="noopener"  href="<?php echo esc_url($url); ?>" class="tp-el-social-link elementor-repeater-item-<?php echo esc_attr($profile['_id']) ; ?>"><i class="fab fa-<?php echo esc_attr($icon); ?>" aria-hidden="true"></i></a>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>                 
         </section>
         <!-- slider area end -->

         <?php endif; ?>


		<?php 
	}
}

$widgets_manager->register( new TP_Swiper_Slider() );