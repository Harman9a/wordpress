<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
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
class TP_Portfolio_Details extends Widget_Base {

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
        return 'portfolio-details';
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
        return __( 'Portfolio Details', 'tpcore' );
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

        $this->tp_section_title_render_controls('portfolio', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.');

        $this->start_controls_section(
         'tp_task_sec',
             [
               'label' => esc_html__( 'Task', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
               'condition' => [
                'tp_design_style' => ['layout-1', 'layout-2']
               ]
             ]
        );

        $this->add_control(
         'tp_task_show',
         [
           'label'        => esc_html__( 'Show Task', 'tpcore' ),
           'type'         => \Elementor\Controls_Manager::SWITCHER,
           'label_on'     => esc_html__( 'Show', 'tpcore' ),
           'label_off'    => esc_html__( 'Hide', 'tpcore' ),
           'return_value' => 'yes',
           'default'      => 'yes',
         ]
        );
        
        $this->add_control(
        'tp_task_title',
         [
            'label'       => esc_html__( 'Title', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( 'Task', 'tpcore' ),
            'placeholder' => esc_html__( 'Your text', 'tpcore' ),
         ]
        );

        $this->add_control(
         'tp_task_desc',
         [
           'label'       => esc_html__( 'Description', 'tpcore' ),
           'type'        => \Elementor\Controls_Manager::TEXTAREA,
           'rows'        => 10,
           'default'     => esc_html__( 'Rebuild a unified visual system for the advertising agency, made of steel which can change the world in a while.', 'tpcore' ),
           'placeholder' => esc_html__( 'Your text', 'tpcore' ),
         ]
        );
        
        $this->end_controls_section();

        // Service group
        $this->start_controls_section(
            'tp_services',
            [
                'label' => esc_html__('Portfolio Info List', 'tpcore'),
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
                    'repeater_condition' => ['style_2'],
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
                    'repeater_condition' => ['style_2'],
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
                    'repeater_condition' => ['style_2'],
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
                        'repeater_condition' => ['style_2'],
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
                        'repeater_condition' => ['style_2'],
                    ]
                ]
            );
        }


        $repeater->add_control(
            'tp_service_title', [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Client:', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_service_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Nature Planner',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tp_service_list',
            [
                'label' => esc_html__('Services - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_service_title' => esc_html__('Client:', 'tpcore'),
                    ],
                    [
                        'tp_service_title' => esc_html__('Awards:', 'tpcore')
                    ],
                    [
                        'tp_service_title' => esc_html__('Category:', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_service_title }}}',
            ]
        );
        $this->add_responsive_control(
            'tp_service_align',
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
         'tp_image_sec',
             [
               'label' => esc_html__( 'Thumbnail', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
               'condition' => [
                'tp_design_style' => ['layout-3']
               ]
             ]
        );
        
        
        $repeater = new \Elementor\Repeater();
        

         $repeater->add_control(
          'tp_image',
          [
            'label'   => esc_html__( 'Upload Image', 'tpcore' ),
            'type'    => \Elementor\Controls_Manager::MEDIA,
              'default' => [
                'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
          ]
         );
         
         $this->add_control(
           'tp_image_list',
           [
             'label'       => esc_html__( 'Image List', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::REPEATER,
             'fields'      => $repeater->get_controls(),
             'default'     => [
               [
                 'tp_image'   => esc_html__( 'Default-value', 'tpcore' ),
               ],
               [
                 'tp_image'   => esc_html__( 'Default-value', 'tpcore' ),
               ],
               [
                 'tp_image'   => esc_html__( 'Default-value', 'tpcore' ),
               ],
             ],
             'title_field' => '{{{ tp_image }}}',
           ]
         );

         $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tp_image_size', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
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
                'condition' => [
                    'tp_design_style' => ['layout-3']
                   ]
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

        $this->add_control(
            'tp_profile_title',
            [
                'label' => esc_html__('Profile Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('TP Profile Title', 'tpcore'),
                'placeholder' => esc_html__('Type Sub Heading Text', 'tpcore'),
                'label_block' => true,
            ]
        );
        

        $this->end_controls_section();



        // Button 
        $this->tp_button_render('portfolio_view_all', 'Portfolio Button', ['layout-1', 'layout-2', 'layout-3'] );


        // colum controls
        $this->tp_columns('col');
    }

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('services_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('services_subtitle', 'Section - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('services_title', 'Section - Title', '.tp-el-title');
        $this->tp_basic_style_controls('services_description', 'Section - Description', '.tp-el-content p');
        $this->tp_link_controls_style('services_btn', 'Section - Button', '.tp-el-btn');

        $this->tp_icon_style('section_icon', 'Meta - Icon', '.tp-el-meta-icon span');
        $this->tp_basic_style_controls('services_meta_title', 'Meta - Title', '.tp-el-meta-title');
        $this->tp_basic_style_controls('services_meta_subtitle', 'Meta - Description', '.tp-el-meta-desc');

        $this->tp_basic_style_controls('services_task_description', 'Task - Title', '.tp-el-task-title');
        $this->tp_basic_style_controls('services_task_subtitle', 'Task - Description', '.tp-el-task-desc');

        $this->tp_link_controls_style('slider_social_link', 'Social - Link', '.tp-el-social-link');

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
            $this->add_render_attribute('title_args', 'class', 'portfolio__details-title-2 tp-el-title');


            if ('2' == $settings['tp_portfolio_view_all_btn_link_type']) {
                $link = get_permalink($settings['tp_portfolio_view_all_btn_page_link']);
                $target = '_self';
                $rel = 'nofollow';
            } else {
                $link = !empty($settings['tp_portfolio_view_all_btn_link']['url']) ? $settings['tp_portfolio_view_all_btn_link']['url'] : '';
                $target = !empty($settings['tp_portfolio_view_all_btn_link']['is_external']) ? '_blank' : '';
                $rel = !empty($settings['tp_portfolio_view_all_btn_link']['nofollow']) ? 'nofollow' : '';
            }
        ?>

         <!-- portfolio area start -->
         <section class="portfolio__area pt-100 pb-110 tp-el-section">
            <div class="container">
               <div class="row">
                  <div class="col-xl-8 col-lg-8 col-md-8">
                     <div class="portfolio__details-wrapper-2">
                        <div class="portfolio__details-content-2 mb-40 tp-el-content">
                        <?php if ( !empty($settings['tp_portfolio_section_title_show']) ) : ?>

                            <?php if ( !empty($settings['tp_portfolio_sub_title']) ) : ?>
                            <div class="portfolio__details-category">
                              <span class="tp-el-subtitle"><?php echo tp_kses( $settings['tp_portfolio_sub_title'] ); ?></span>
                           </div>
                            <?php endif; ?>

                            <?php
                                if ( !empty($settings['tp_portfolio_title' ]) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['tp_portfolio_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        tp_kses( $settings['tp_portfolio_title' ] )
                                        );
                                endif;
                            ?>
                            <?php endif; ?>
                           
                            <?php if ( !empty($settings['tp_portfolio_description']) ) : ?>
                            <p><?php echo tp_kses( $settings['tp_portfolio_description'] ); ?></p>
                            <?php endif; ?>                         
                        </div>

                        <?php if ( !empty($settings['tp_task_show']) ) : ?>
                        <div class="portfolio__details-task mb-45">
                           <?php if ( !empty($settings['tp_task_title']) ) : ?>
                           <h3 class="portfolio__details-title-sm tp-el-task-title"><?php echo tp_kses( $settings['tp_task_title'] ); ?></h3>
                           <?php endif; ?> 

                           <?php if ( !empty($settings['tp_task_desc']) ) : ?>
                           <p class="tp-el-task-desc"><?php echo tp_kses( $settings['tp_task_desc'] ); ?></p>
                           <?php endif; ?>
                        </div>
                        <?php endif; ?> 

                        
                        <?php if(!empty($settings['tp_portfolio_view_all_btn_switcher'])) :?>
                        <div class="portfolio__details-btn">
                           <a class="tp-el-btn" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>">
                           <?php echo tp_kses($settings['tp_portfolio_view_all_btn_text']); ?>
                              <span>
                                 <svg width="26" height="9" viewBox="0 0 26 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M21.6934 1L25 4.20003L21.6934 7.4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M0.999999 4.19897H25" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                 </svg>                                                                             
                              </span>
                           </a>
                        </div>
                        <?php endif; ?>
                                                
                     </div>
                  </div>
                  <div class="col-xl-4 col-lg-4 col-md-4">
                  <?php if(!empty($settings['tp_service_list'])) : ?>
                     <div class="portfolio__details-meta portfolio__details-meta-slider pl-100 pt-105 flex-wrap">
                        
                        <?php foreach ($settings['tp_service_list'] as $key => $item) : ?>
                           <div class="portfolio__details-meta-item d-flex align-items-start">
                           <?php if($item['repeater_condition'] == 'style_2') : ?>
                                <div class="portfolio__details-meta-icon tp-el-meta-icon">
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
                                <div class="portfolio__details-meta-content">
                                    <?php if (!empty($item['tp_service_title' ])): ?>
                                    <h5 class="tp-el-meta-title"><?php echo tp_kses($item['tp_service_title' ]); ?></h5>
                                    <?php endif; ?>

                                    <?php if (!empty($item['tp_service_description' ])): ?>
                                    <span class="tp-el-meta-desc"><?php echo tp_kses($item['tp_service_description']); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endforeach; ?> 
                     </div>
                     <?php endif; ?>
                  </div>
               </div>
            </div>
         </section>
         <!-- portfolio area end -->

         <?php elseif ( $settings['tp_design_style']  == 'layout-3' ):
            $this->add_render_attribute('title_args', 'class', 'portfolio__details-info-box-title tp-el-title');


            if ('2' == $settings['tp_portfolio_view_all_btn_link_type']) {
                $link = get_permalink($settings['tp_portfolio_view_all_btn_page_link']);
                $target = '_self';
                $rel = 'nofollow';
            } else {
                $link = !empty($settings['tp_portfolio_view_all_btn_link']['url']) ? $settings['tp_portfolio_view_all_btn_link']['url'] : '';
                $target = !empty($settings['tp_portfolio_view_all_btn_link']['is_external']) ? '_blank' : '';
                $rel = !empty($settings['tp_portfolio_view_all_btn_link']['nofollow']) ? 'nofollow' : '';
            }
        ?>
        

         <!-- portfolio area start -->
         <section class="portfolio__area pt-100 pb-120 tp-el-section">
            <div class="container">
               <div class="row">
                  <div class="col-xl-8">
                     <div class="portfolio__details-img-list p-relative mr-75">
                     
                        <?php if ($settings['show_profiles'] && is_array($settings['profiles'])) : ?>
                        <div class="portfolio__details-img-list-social d-flex flex-column z-index-1">
                            <?php
                                foreach ($settings['profiles'] as $profile) :
                                    $icon = $profile['name'];
                                    $url = esc_url($profile['link']['url']);
                                    
                                    printf('<a target="_blank" rel="noopener"  href="%s" class="tp-el-social-link elementor-repeater-item-%s"><i class="fab fa-%s" aria-hidden="true"></i></a>',
                                        $url,
                                        esc_attr($profile['_id']),
                                        esc_attr($icon)
                                    );
                                endforeach; 
                            ?>
                        </div>
                        <?php endif; ?>
                        <?php foreach ($settings['tp_image_list'] as $key => $item) :
                            if ( !empty($item['tp_image']['url']) ) {
                                $tp_image = !empty($item['tp_image']['id']) ? wp_get_attachment_image_url( $item['tp_image']['id'], $settings['tp_image_size_size']) : $item['tp_image']['url'];
                                $tp_image_alt = get_post_meta($item["tp_image"]["id"], "_wp_attachment_image_alt", true);
                            }
                        ?>
                        <div class="portfolio__details-img-list-box mb-10 m-img">
                           <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                        </div>
                        <?php endforeach; ?> 
                     </div>
                  </div>
                  <div class="col-xl-4">
                     <div class="portfolio__details-info-wrapper">
                     <?php if ( !empty($settings['tp_portfolio_section_title_show']) ) : ?>
                        <div class="portfolio__details-info-content tp-el-content">

                            <?php if ( !empty($settings['tp_portfolio_sub_title']) ) : ?>
                                <span class="tp-el-subtitle"><?php echo tp_kses( $settings['tp_portfolio_sub_title'] ); ?></span>
                            <?php endif; ?>

                            <?php
                                if ( !empty($settings['tp_portfolio_title' ]) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['tp_portfolio_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        tp_kses( $settings['tp_portfolio_title' ] )
                                        );
                                endif;
                            ?>

                            <?php if ( !empty($settings['tp_portfolio_description']) ) : ?>
                            <p><?php echo tp_kses( $settings['tp_portfolio_description'] ); ?></p>
                            <?php endif; ?>

                        </div>
                        <?php endif; ?>

                        <?php if(!empty($settings['tp_service_list'])) : ?>
                        <div class="portfolio__details-meta flex-wrap mb-40">
                            <?php foreach ($settings['tp_service_list'] as $key => $item) : ?>
                            <div class="portfolio__details-meta-item d-flex align-items-start">
                                    <?php if($item['repeater_condition'] == 'style_2') : ?>
                                    <div class="portfolio__details-meta-icon tp-el-meta-icon">
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
                                    <div class="portfolio__details-meta-content">
                                        <?php if (!empty($item['tp_service_title' ])): ?>
                                        <h5 class="tp-el-meta-title"><?php echo tp_kses($item['tp_service_title' ]); ?></h5>
                                        <?php endif; ?>

                                        <?php if (!empty($item['tp_service_description' ])): ?>
                                        <span class="tp-el-meta-desc"><?php echo tp_kses($item['tp_service_description']); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php endforeach; ?> 
                            </div>
                        <?php endif; ?>

                                               

                        <?php if(!empty($settings['tp_portfolio_view_all_btn_switcher'])) :?>
                        <div class="portfolio__details-info-btn">
                           <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>" class="tp-btn w-100 tp-el-btn"><?php echo tp_kses($settings['tp_portfolio_view_all_btn_text']); ?>
                            </a>
                        </div>
                        <?php endif; ?>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- portfolio area end -->

         <?php elseif ( $settings['tp_design_style']  == 'layout-4' ):
            $this->add_render_attribute('title_args', 'class', 'portfolio__details-title tp-el-title');


            if ('2' == $settings['tp_portfolio_view_all_btn_link_type']) {
                $link = get_permalink($settings['tp_portfolio_view_all_btn_page_link']);
                $target = '_self';
                $rel = 'nofollow';
            } else {
                $link = !empty($settings['tp_portfolio_view_all_btn_link']['url']) ? $settings['tp_portfolio_view_all_btn_link']['url'] : '';
                $target = !empty($settings['tp_portfolio_view_all_btn_link']['is_external']) ? '_blank' : '';
                $rel = !empty($settings['tp_portfolio_view_all_btn_link']['nofollow']) ? 'nofollow' : '';
            }
        ?>

         <!-- portfolio area start -->
         <section class="portfolio__area pb-65 pt-110 p-relative tp-el-section">
            <div class="container">
               <div class="row">
                  <div class="col-xxl-9 col-xl-10">
                     <div class="portfolio__details-wrapper">
                        <?php if ( !empty($settings['tp_portfolio_section_title_show']) ) : ?>
                        <div class="portfolio__details-content tp-el-content">

                            <?php if ( !empty($settings['tp_portfolio_sub_title']) ) : ?>
                                <span class="tp-el-subtitle"><?php echo tp_kses( $settings['tp_portfolio_sub_title'] ); ?></span>
                            <?php endif; ?>

                            <?php
                                if ( !empty($settings['tp_portfolio_title' ]) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['tp_portfolio_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        tp_kses( $settings['tp_portfolio_title' ] )
                                        );
                                endif;
                            ?>

                            <?php if ( !empty($settings['tp_portfolio_description']) ) : ?>
                            <p><?php echo tp_kses( $settings['tp_portfolio_description'] ); ?></p>
                            <?php endif; ?>
                        
                        </div>
                        <?php endif; ?>

                        <?php if(!empty($settings['tp_service_list'])) : ?>
                        <div class="portfolio__details-meta flex-wrap d-flex align-items-center">
                            <?php foreach ($settings['tp_service_list'] as $key => $item) : ?>
                                <div class="portfolio__details-meta-item d-flex align-items-start tp-el-meta-icon">
                                    <?php if($item['repeater_condition'] == 'style_2') : ?>
                                    <div class="portfolio__details-meta-icon">
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
                                    <div class="portfolio__details-meta-content">
                                        <?php if (!empty($item['tp_service_title' ])): ?>
                                        <h5 class="tp-el-meta-title"><?php echo tp_kses($item['tp_service_title' ]); ?></h5>
                                        <?php endif; ?>

                                        <?php if (!empty($item['tp_service_description' ])): ?>
                                        <span class="tp-el-meta-desc"><?php echo tp_kses($item['tp_service_description']); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?> 
                        </div>
                        <?php endif; ?>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- portfolio area end -->

        <?php else:
            $this->add_render_attribute('title_args', 'class', 'portfolio__details-title-3 tp-el-title');
            $bloginfo = get_bloginfo( 'name' );

            if ('2' == $settings['tp_portfolio_view_all_btn_link_type']) {
                $link = get_permalink($settings['tp_portfolio_view_all_btn_page_link']);
                $target = '_self';
                $rel = 'nofollow';
            } else {
                $link = !empty($settings['tp_portfolio_view_all_btn_link']['url']) ? $settings['tp_portfolio_view_all_btn_link']['url'] : '';
                $target = !empty($settings['tp_portfolio_view_all_btn_link']['is_external']) ? '_blank' : '';
                $rel = !empty($settings['tp_portfolio_view_all_btn_link']['nofollow']) ? 'nofollow' : '';
            }
        ?>
         

         <!-- portfolio area start -->
         <section class="portfolio__area pt-70 pb-85 tp-el-section">
            <div class="container">
               <div class="row">
                  <div class="col-xl-5 col-lg-5">
                     <div class="portfolio__details-wrapper-2 mb-50">
                        <?php if ( !empty($settings['tp_portfolio_section_title_show']) ) : ?>

                                <?php if ( !empty($settings['tp_portfolio_sub_title']) ) : ?>
                                <span class="portfolio__details-subtitle tp-el-subtitle">
                                    <?php echo tp_kses( $settings['tp_portfolio_sub_title'] ); ?>
                                </span>
                                <?php endif; ?>

                                <?php
                                    if ( !empty($settings['tp_portfolio_title' ]) ) :
                                        printf( '<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape( $settings['tp_portfolio_title_tag'] ),
                                            $this->get_render_attribute_string( 'title_args' ),
                                            tp_kses( $settings['tp_portfolio_title' ] )
                                            );
                                    endif;
                                ?>
                        <?php endif; ?>

                        

                        <?php if(!empty($settings['tp_portfolio_view_all_btn_switcher'])) :?>
                        <div class="portfolio__details-btn-2">
                           <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>" class="tp-btn tp-el-btn">
                            <?php echo tp_kses($settings['tp_portfolio_view_all_btn_text']); ?>
                              <svg width="26" height="9" viewBox="0 0 26 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path d="M21.6934 1L25 4.20003L21.6934 7.4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M0.999999 4.19897H25" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                              </svg>                                 
                           </a>
                        </div>
                        <?php endif; ?>

                  
                     </div>
                  </div>
                  <div class="col-xl-7 col-lg-7">
                     <div class="portfolio__details-wrapper-2">
                        <?php if ( !empty($settings['tp_portfolio_section_title_show']) ) : ?>
                            <?php if ( !empty($settings['tp_portfolio_description']) ) : ?>
                            <div class="portfolio__details-content-2 mb-30 tp-el-content">
                                <p><?php echo tp_kses( $settings['tp_portfolio_description'] ); ?></p>
                            </div>
                            <?php endif; ?>                         
                        <?php endif; ?>    


                        <?php if ( !empty($settings['tp_task_show']) ) : ?>
                        <div class="portfolio__details-task portfolio__details-task-2 mb-50">
                        <?php if ( !empty($settings['tp_task_title']) ) : ?>
                           <h3 class="portfolio__details-title-sm portfolio__details-title-sm-2 tp-el-task-title"><?php echo tp_kses( $settings['tp_task_title'] ); ?></h3>
                           <?php endif; ?> 
                           <?php if ( !empty($settings['tp_task_desc']) ) : ?>
                           <p class="tp-el-task-desc"><?php echo tp_kses( $settings['tp_task_desc'] ); ?></p>
                           <?php endif; ?> 
                        </div>
                        <?php endif; ?> 

                        <?php if(!empty($settings['tp_service_list'])) : ?>
                        <div class="portfolio__details-meta flex-wrap d-flex align-items-center">
                        <?php foreach ($settings['tp_service_list'] as $key => $item) : ?>
                           <div class="portfolio__details-meta-item d-flex align-items-start">
                                <?php if($item['repeater_condition'] == 'style_2') : ?>
                                <div class="portfolio__details-meta-icon tp-el-meta-icon">
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
                                <div class="portfolio__details-meta-content">
                                    <?php if (!empty($item['tp_service_title' ])): ?>
                                    <h5 class="tp-el-meta-title"><?php echo tp_kses($item['tp_service_title' ]); ?></h5>
                                    <?php endif; ?>

                                    <?php if (!empty($item['tp_service_description' ])): ?>
                                    <span class="tp-el-meta-desc"><?php echo tp_kses($item['tp_service_description']); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endforeach; ?> 
                        </div>
                        <?php endif; ?> 
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- portfolio area end -->


        <?php endif; ?>

        <?php
    }
}

$widgets_manager->register( new TP_Portfolio_Details() ); 