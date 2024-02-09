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
class TP_Coming_Soon extends Widget_Base {

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
		return 'tp-coming-soon';
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
		return __( 'Coming Soon', 'tpcore' );
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
         'tp_coming_sec',
            [
                'label' => esc_html__( 'Coming Content', 'tpcore' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
         'tp_coming_shape_switch',
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
        'tp_coming_date',
         [
            'label'       => esc_html__( 'Date', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( 'Sep 30 2024 20:20:22', 'tpcore' ),
            'placeholder' => esc_html__( 'Sep 30 2024 20:20:22', 'tpcore' ),
            'label_block' => true
         ]
        );

        $this->add_control(
        'tp_coming_title',
         [
            'label'       => esc_html__( 'Title', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( 'Our website is ', 'tpcore' ),
            'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
            'label_block' => true
         ]
        );

        $this->add_control(
         'tp_coming_desc',
         [
           'label'       => esc_html__( 'Description', 'tpcore' ),
           'type'        => \Elementor\Controls_Manager::TEXTAREA,
           'rows'        => 10,
           'default'     => esc_html__( 'We will be here soon with something amazing technology', 'tpcore' ),
           'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
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
         'tp_image_sec',
             [
               'label' => esc_html__( 'Thumbnail', 'Text-domain' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
             ]
        );
        
        $this->add_control(
         'tp_image',
         [
           'label'   => esc_html__( 'Upload Image', 'Text-domain' ),
           'type'    => \Elementor\Controls_Manager::MEDIA,
             'default' => [
               'url' => \Elementor\Utils::get_placeholder_image_src(),
           ],
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
        $this->tp_section_style_controls('comint_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('coming_title', 'Coming - Title', '.tp-el-box-title');
        $this->tp_basic_style_controls('coming_subtitle', 'Coming - Description', '.tp-el-box-desc');
        $this->tp_basic_style_controls('coming_time_number', 'Coming - Number', '.tp-el-box-number ul li span');
        $this->tp_basic_style_controls('coming_time_text', 'Coming - Number Text', '.tp-el-box-number-text ul li');
        $this->tp_link_controls_style('coming_time_social', 'Coming - Social', '.tp-el-box-social a');
        $this->tp_input_controls_style('coming_input', 'Form - Input', '.tp-el-box-input input');
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

		?>

		<?php if ( $settings['tp_design_style']  == 'layout-2' ):
            $this->add_render_attribute('title_args', 'class', 'tpcta-title mb-40');
        ?>


		<?php else:
			$this->add_render_attribute('title_args', 'class', 'tpcta-title mb-40');
            $bloginfo = get_bloginfo( 'name' );  

            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image_url = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['thumbnail_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }
		?>

        <!-- coming soon area start -->
        <section class="coming__area coming__height d-flex align-items-center tp-el-section">
        <?php if(!empty($settings['tp_coming_shape_switch'])) : ?>
         <div class="coming__shape">
            <img class="coming__shape-1" src="<?php echo get_template_directory_uri() . '/assets/img/coming/coming-shape-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
         </div>
         <?php endif; ?>

         <div class="container">
            <div class="row align-items-center">
               <div class="col-xl-7 col-lg-6">
                  <div class="coming__content pt-55">
                     <div class="coming__countdown tp-el-box-number-text tp-el-box-number" data-countdown data-date="<?php echo esc_attr($settings['tp_coming_date']); ?>">
                        <ul>
                            <li><span data-days>0</span> Days</li>
                            <li><span data-hours>0</span> Hours</li>
                            <li><span data-minutes>0</span> Minutes</li>
                            <li><span data-seconds>0</span> Seconds</li>
                        </ul>         
                    </div>


                    <?php if(!empty($settings['tp_coming_title'])) :?>
                    <h3 class="coming__title tp-el-box-title"><?php echo tp_kses($settings['tp_coming_title']); ?></h3>
                    <?php endif; ?>

                    <?php if(!empty($settings['tp_coming_desc'])) :?>
                    <p class="tp-el-box-desc"><?php echo tp_kses($settings['tp_coming_desc']); ?></p>
                    <?php endif; ?>

                     <div class="coming__form tp-el-box-input">
                        <?php if( !empty($settings['tpcore_select_contact_form']) ) : ?>
                        <?php echo do_shortcode( '[contact-form-7  id="'.$settings['tpcore_select_contact_form'].'"]' ); ?>
                        <?php else : ?>
                            <?php echo '<div class="alert alert-info"><p class="m-0">' . __('Please Select contact form.', 'tpcore' ). '</p></div>'; ?>
                        <?php endif; ?>
                     </div>

                     <?php if ($settings['show_profiles'] && is_array($settings['profiles'])) : ?>
                     <div class="coming__social tp-el-box-social">
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

               <?php if(!empty($tp_image_url)) :?>
               <div class="col-xl-5 col-lg-6">
                  <div class="coming__thumb">
                     <img src="<?php echo esc_url($tp_image_url); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                  </div>
               </div>
               <?php endif; ?> 
            </div>
         </div>
        </section>
        <!-- coming soon area end -->

        <?php endif; ?>

        <?php
	}
}

$widgets_manager->register( new TP_Coming_Soon() );
