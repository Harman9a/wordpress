<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;
use Elementor\Core\Utils\ImportExport\Url;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Team_Details extends Widget_Base {

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
        return 'tp-team-details';
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
        return __( 'TP Team Details', 'tpcore' );
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->tp_section_title_render_controls('team', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.');
 

        $this->start_controls_section(
         'tp_image_sec',
             [
               'label' => esc_html__( 'Thumbnail', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
             ]
        );

        $this->add_control(
         'tp_team_shape_switch',
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
         'tp_image',
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
                'name' => 'thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                // 'default' => 'tp-post-thumb',
            ]
        );
        
        $this->end_controls_section();

        // Service group
        $this->start_controls_section(
            'tp_services',
            [
                'label' => esc_html__('Info List', 'tpcore'),
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
                    'repeater_condition' => 'style_1'
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
                    'repeater_condition' => 'style_1'
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
                    'repeater_condition' => 'style_1'
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
                        'repeater_condition' => 'style_1'
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
                        'repeater_condition' => 'style_1'
                    ]
                ]
            );
        }


        $repeater->add_control(
            'tp_team_info_title', [
                'label' => esc_html__('Info Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Info Title', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
         'tp_contact_type',
         [
           'label'   => esc_html__( 'Select Type', 'tpcore' ),
           'type' => \Elementor\Controls_Manager::SELECT,
           'options' => [
             'email'  => esc_html__( 'Email', 'tpcore' ),
             'phone'  => esc_html__( 'Phone', 'tpcore' ),
             'map'  => esc_html__( 'Map', 'tpcore' ),
           ],
           'default' => 'email',
         ]
        );

        $repeater->add_control(
         'tp_team_map_url',
         [
           'label'   => esc_html__( 'Map URL', 'tpcore' ),
           'type'        => \Elementor\Controls_Manager::URL,
           'default'     => [
               'url'               => '#',
               'is_external'       => true,
               'nofollow'          => true,
               'custom_attributes' => '',
             ],
             'placeholder' => esc_html__( 'Your URL', 'tpcore' ),
             'label_block' => true,
             'condition' => [
                'tp_contact_type' => 'map'
             ]
           ]
         );

         $this->add_control(
           'tp_team_info_list',
           [
             'label'       => esc_html__( 'Info List', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::REPEATER,
             'fields'      => $repeater->get_controls(),
             'default'     => [
               [
                'tp_team_info_title'   => esc_html__( 'hello@mail.com', 'tpcore' ),
               ],
             ],
             'title_field' => '{{{ tp_team_info_title }}}',
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

    protected function style_tab_content(){
        $this->tp_section_style_controls('comint_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('about_subtitle', 'Section - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('about_title', 'Section - Title', '.tp-el-title');
        $this->tp_basic_style_controls('about_description', 'Section - Description', '.tp-el-content-desc');

        $this->tp_section_style_controls('comint_section_box', 'Box - Style', '.tp-el-box');
		$this->tp_icon_style('section_icon', 'Box - Icon', '.tp-el-box-icon span');
		$this->tp_basic_style_controls('section_title', 'Info - Style', '.tp-el-box-info');
        $this->tp_link_controls_style('coming_time_social', 'Social', '.tp-el-box-social-link');
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
            $this->add_render_attribute('title_args', 'class', 'research__title');
            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }
        ?>



        <?php else:
            $bloginfo = get_bloginfo( 'name' );  
            $this->add_render_attribute('title_args', 'class', 'team__details-title tp-el-title');

            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image_url = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['thumbnail_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }
        ?>



         <!-- team details area start -->
         <section class="team__details-area pt-100 p-relative z-index-1 tp-el-section">

            <?php if(!empty($settings['tp_team_shape_switch'])) : ?>
            <div class="team__details-shape">
               <img class="team__details-shape-1" src="<?php echo get_template_directory_uri() . '/assets/img/team/details/team-details-shape-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="team__details-shape-2" src="<?php echo get_template_directory_uri() . '/assets/img/team/details/team-details-shape-2.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="team__details-shape-3" src="<?php echo get_template_directory_uri() . '/assets/img/team/details/team-details-shape-3.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="team__details-shape-4" src="<?php echo get_template_directory_uri() . '/assets/img/team/details/team-details-shape-4.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
            </div>
            <?php endif; ?>

            <div class="container">
               <div class="team__details-border tp-el-box">
                  <div class="row">
                     <div class="col-xl-5 col-md-6">
                        <div class="team__details-thumb wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s">
                           <img src="<?php echo esc_url($tp_image_url); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                        </div>
                     </div>
                     <div class="col-xl-7 col-md-6">
                        <div class="team__details-content pt-40 pl-15 pr-50 wow fadeInUp" data-wow-delay=".5s" data-wow-duration="1s">
                        <?php if ( !empty($settings['tp_team_section_title_show']) ) : ?>
                            <?php if(!empty($settings['tp_team_sub_title'])): ?>
                            <span class="team__details-subtitle tp-el-subtitle"><?php echo tp_kses($settings['tp_team_sub_title']); ?></span>
                            <?php endif; ?>

                            <?php
                                if ( !empty($settings['tp_team_title' ]) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['tp_team_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        tp_kses( $settings['tp_team_title' ] )
                                        );
                                endif;
                            ?>

                        <?php endif; ?>

                           <div class="team__details-contact mb-10">
                           <?php foreach ($settings['tp_team_info_list'] as $key => $item) :?>
                              <div class="team__details-contact-item d-flex align-items-center">
                                 <!-- for wp if client want to add icon enable it -->
                                 
                                 <?php if($item['repeater_condition'] == 'style_1') : ?>
                                 <div class="team__details-contact-icon tp-el-box-icon">
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
                                 <?php endif; ?>
                                 <div class="team__details-contact-content tp-el-box-info">
                                    <?php if($item['tp_contact_type'] == 'email') : ?>
                                    <p><a href="mailto:<?php echo esc_url($item['tp_team_info_title']); ?>"><?php echo esc_html($item['tp_team_info_title']); ?></a></p>

                                    <?php elseif($item['tp_contact_type'] == 'phone') : ?>
                                    <p><a href="tel:<?php echo esc_url($item['tp_team_info_title']); ?>"><?php echo esc_html($item['tp_team_info_title']); ?></a></p>
                                    
                                    <?php elseif($item['tp_contact_type'] == 'map') : ?>
                                    <p><a href="<?php echo esc_url($item['tp_team_map_url']['url']); ?>" target="_blank"><?php echo esc_html($item['tp_team_info_title']); ?></a></p>
                                    
                                    <?php else : ?>
                                    <p><a href="<?php echo esc_url($item['tp_team_info_title']); ?>" target="_blank"><?php echo esc_html($item['tp_team_info_title']); ?></a></p>
                                    <?php endif; ?>
                                 </div>
                              </div>
                              <?php endforeach; ?>
                           </div>

                           <?php if ( !empty($settings['tp_team_section_title_show']) ) : ?>
                            <?php if ( !empty($settings['tp_team_description']) ) : ?>
                                <p class="tp-el-content-desc"><?php echo tp_kses( $settings['tp_team_description'] ); ?></p>
                            <?php endif; ?>
                            <?php endif; ?>
   
                            <?php if ($settings['show_profiles'] && is_array($settings['profiles'])) : ?>
                           <div class="team__details-social">
                            <?php
                                    foreach ($settings['profiles'] as $profile) :
                                        $icon = $profile['name'];
                                        $url = esc_url($profile['link']['url']);
                                        
                                        printf('<a target="_blank" rel="noopener"  href="%s" class="tp-el-box-social-link elementor-repeater-item-%s"><i class="fab fa-%s" aria-hidden="true"></i></a>',
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
                  </div>
               </div>
            </div>
         </section>
         <!-- team details area end -->


        <?php endif; ?>

        <?php
    }
}

$widgets_manager->register( new TP_Team_Details() );
