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
class TP_About_2 extends Widget_Base {

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
		return 'tp-about-2';
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
		return __( 'About 2', 'tpcore' );
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

    protected function register_controls_section(){
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
         'tp_about_sec',
             [
               'label' => esc_html__( 'Title & Description', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
             ]
        );
        
        $this->add_control(
        'tp_about_subtitle',
         [
            'label'       => esc_html__( 'Sub Title', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( 'EXPERIENCE AGENCY', 'tpcore' ),
            'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
            'label_block' => true
         ]
        );
        
        $this->add_control(
        'tp_about_title',
         [
            'label'       => esc_html__( 'Title', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( 'Create out standing and flexible ', 'tpcore' ),
            'placeholder' => esc_html__( 'Placeholder Text', 'tpcore' ),
            'label_block' => true
         ]
        );
        
        $this->add_control(
            'tp_about_title_tag',
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
                'default' => 'h3',
                'toggle' => false,
            ]
        );
        $this->add_control(
         'tp_about_description',
         [
           'label'       => esc_html__( 'Description', 'tpcore' ),
           'type'        => \Elementor\Controls_Manager::TEXTAREA,
           'rows'        => 10,
           'default'     => esc_html__( 'We help our clients succeed by creating brand identities, digital experiences, and print materials achieve marketing goals.!', 'tpcore' ),
           'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
         ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
         'tp_about_thumb_sec',
             [
               'label' => esc_html__( 'About Thumbnail', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
             ]
        );

        $this->add_control(
         'tp_about_shape_switch',
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
         'tp_about_thumb',
         [
           'label'   => esc_html__( 'Upload Image', 'tpcore' ),
           'type'    => \Elementor\Controls_Manager::MEDIA,
             'default' => [
               'url' => \Elementor\Utils::get_placeholder_image_src(),
           ],
         ]
        );
        
        $this->add_control(
         'tp_about_thumb_2',
         [
           'label'   => esc_html__( 'Upload Image 2', 'tpcore' ),
           'type'    => \Elementor\Controls_Manager::MEDIA,
             'default' => [
               'url' => \Elementor\Utils::get_placeholder_image_src(),
           ],
           'condition' => [
                'tp_design_style' => 'layout-1'
            ]
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
         'tp_about_list_sec',
             [
               'label' => esc_html__( 'Features List', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
               'condition' => [
                    'tp_design_style' => 'layout-2'
                ]
             ]
        );
        
        
        $repeater = new \Elementor\Repeater();
        
         $repeater->add_control(
         'tp_features_title',
           [
             'label'   => esc_html__( 'Features Title', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::TEXT,
             'default'     => esc_html__( 'Art Direction', 'tpcore' ),
             'label_block' => true,
           ]
         );
         
         $this->add_control(
           'tp_features_list',
           [
             'label'       => esc_html__( 'Features List', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::REPEATER,
             'fields'      => $repeater->get_controls(),
             'default'     => [
               [
                 'tp_features_title'   => esc_html__( 'Art Direction', 'tpcore' ),
               ],
               [
                 'tp_features_title'   => esc_html__( 'Graphic Design', 'tpcore' ),
               ],
               [
                 'tp_features_title'   => esc_html__( 'Motion Graphics', 'tpcore' ),
               ],
             ],
             'title_field' => '{{{ tp_features_title }}}',
           ]
         );
        
        
        $this->end_controls_section();
        


        $this->tp_button_render('about', 'About Button', ['layout-1'] );
    }

    protected function style_tab_content(){
        $this->tp_section_style_controls('about_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('about_subtitle', 'Section - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('about_title', 'Section - Title', '.tp-el-title');
        $this->tp_basic_style_controls('about_description', 'Section - Description', '.tp-el-content p');
        
        $this->tp_link_controls_style('about_button', 'Section - Button', '.tp-el-box-btn');
        $this->tp_basic_style_controls('about_list', 'List', '.tp-el-list');
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

            $this->add_render_attribute('title_args', 'class', 'tp-section-title-3 tp-el-title');
            $bloginfo = get_bloginfo( 'name' ); 

            if ( !empty($settings['tp_about_thumb']['url']) ) {
                $about_img = !empty($settings['tp_about_thumb']['id']) ? wp_get_attachment_image_url( $settings['tp_about_thumb']['id'], $settings['thumbnail_size']) : $settings['tp_about_thumb']['url'];
                $about_img_alt = get_post_meta($settings["tp_about_thumb"]["id"], "_wp_attachment_image_alt", true);
            }

        ?>

        <!-- about area start -->
        <section class="about__area pt-10 pb-130 tp-el-section">
            <div class="container">
               <div class="row">
                  <div class="col-xl-6 col-lg-6">
                     <div class="about__thumb-15 p-relative z-index-1 w-img wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s">
                        <?php if(!empty($settings['tp_about_shape_switch'])) : ?>   
                        <div class="about__thumb-15-shape">
                           <img src="<?php echo get_template_directory_uri() . '/assets/img/about/15/about-thumb-shape.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                        </div>
                        <img class="about__thumb-15-shape-2" src="<?php echo get_template_directory_uri() . '/assets/img/about/15/about-thumb-shape-2.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                        <?php endif; ?>

                        <img src="<?php echo esc_url($about_img); ?>" alt="<?php echo esc_attr($about_img_alt); ?>">
                     </div>
                  </div>
                  <div class="col-xl-6 col-lg-6">
                     <div class="about__wrapper-15 pl-45 wow fadeInUp" data-wow-delay=".6s" data-wow-duration="1s">
                        <div class="tp-section-wrapper-3 mb-25 tp-el-content">

                           <?php if(!empty($settings['tp_about_sub_title'])) : ?>
                           <span class="tp-section-subtitle-3 tp-el-subtitle"><?php echo tp_kses( $settings['tp_about_sub_title'] ); ?></span>
                           <?php endif; ?>

                           <?php
                                if ( !empty($settings['tp_about_title' ]) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['tp_about_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        tp_kses( $settings['tp_about_title' ] )
                                        );
                                endif;
                            ?>
                         
                           <?php if ( !empty($settings['tp_about_description']) ) : ?>
                            <p><?php echo tp_kses( $settings['tp_about_description'] ); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="about__list-2">
                           <ul>
                           <?php foreach ($settings['tp_features_list'] as $key => $item) : ?>
                              <li class="tp-el-list"><?php echo tp_kses($item['tp_features_title']); ?></li>
                              <?php endforeach; ?>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
        </section>
        <!-- about area end -->

		<?php else: 

            if ( !empty($settings['tp_about_thumb']['url']) ) {
                $about_img = !empty($settings['tp_about_thumb']['id']) ? wp_get_attachment_image_url( $settings['tp_about_thumb']['id'], $settings['thumbnail_size']) : $settings['tp_about_thumb']['url'];
                $about_img_alt = get_post_meta($settings["tp_about_thumb"]["id"], "_wp_attachment_image_alt", true);
                
            }

            if ( !empty($settings['tp_about_thumb_2']['url']) ) {
                $about_img_2 = !empty($settings['tp_about_thumb_2']['id']) ? wp_get_attachment_image_url( $settings['tp_about_thumb_2']['id'], $settings['thumbnail_size']) : $settings['tp_about_thumb_2']['url'];
                $about_img_2_alt = get_post_meta($settings["tp_about_thumb_2"]["id"], "_wp_attachment_image_alt", true);
                
            }


            $this->add_render_attribute('title_args', 'class', 'tp-section-title-2 tp-el-title');
            $bloginfo = get_bloginfo( 'name' );  

            // Link
            if ('2' == $settings['tp_about_btn_link_type']) {
                $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_about_btn_page_link']));
                $this->add_render_attribute('tp-button-arg', 'target', '_self');
                $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn tp-el-box-btn');
            } else {
                if ( ! empty( $settings['tp_about_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'tp-button-arg', $settings['tp_about_btn_link'] );
                    $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn tp-el-box-btn');
                }
            }
		?>	

         <!-- about area start -->
         <section class="about__area pb-140 tp-el-section">
            <div class="container">
               <div class="row">
                  <div class="col-xl-6 col-lg-6">
                     <div class="about__thumb-wrapper-14 p-relative wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s">
                        <?php if(!empty($settings['tp_about_shape_switch'])) : ?>
                        <div class="about__shape">
                           <img class="about__shape-8" src="<?php echo get_template_directory_uri() . '/assets/img/about/14/about-shape-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                           <img class="about__shape-9" src="<?php echo get_template_directory_uri() . '/assets/img/about/14/about-shape-2.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                        </div>
                        <?php endif; ?>
                        <div class="about__thumb-14 m-img">
                           <img class="about-img-1" src="<?php echo esc_url($about_img); ?>" alt="<?php echo esc_attr($about_img_alt); ?>">
                           <img class="about-img-2" src="<?php echo esc_url($about_img_2); ?>" alt="<?php echo esc_attr($about_img_2_alt); ?>">
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-6 col-lg-6">
                     <div class="about__wrapper-14 pl-75 pt-45 wow fadeInUp" data-wow-delay=".5s" data-wow-duration="1s">
                        <div class="tp-section-wrapper-2 mb-40 tp-el-content">

                            <?php if(!empty($settings['tp_about_sub_title'])) : ?>
                            <span class="tp-section-subtitle-2 tp-el-subtitle"><?php echo tp_kses( $settings['tp_about_sub_title'] ); ?></span>
                            <?php endif; ?>

                           <?php
                                if ( !empty($settings['tp_about_title' ]) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['tp_about_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        tp_kses( $settings['tp_about_title' ] )
                                        );
                                endif;
                            ?>
                         
                           <?php if ( !empty($settings['tp_about_description']) ) : ?>
                            <p><?php echo tp_kses( $settings['tp_about_description'] ); ?></p>
                            <?php endif; ?>
                        </div>

                        <?php if (!empty($settings['tp_about_btn_text'])) : ?>
                        <div class="about-btn">
                           <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>><?php echo $settings['tp_about_btn_text']; ?></a>
                        </div>                        
                        <?php endif; ?>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- about area end -->

        <?php endif; ?>

        <?php 
	}
}

$widgets_manager->register( new TP_About_2() );