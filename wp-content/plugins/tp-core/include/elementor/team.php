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
class TP_Team extends Widget_Base {

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
        return 'tp-team';
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
        return __( 'Team', 'tpcore' );
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
    protected function register_controls() {
        

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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();


        // tp_section_title
        $this->tp_section_title_render_controls('team', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.');

        // member list
        $this->start_controls_section(
            '_section_teams',
            [
                'label' => __( 'Members', 'tpcore' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

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

        $repeater->start_controls_tabs(
            '_tab_style_member_box_itemr'
        );

        $repeater->start_controls_tab(
            '_tab_member_info',
            [
                'label' => __( 'Information', 'tpcore' ),
            ]
        );

        $repeater->add_control(
            'image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __( 'Image', 'tpcore' ),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );                      

        $repeater->add_control(
            'title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Title', 'tpcore' ),
                'default' => __( 'TP Member Title', 'tpcore' ),
                'placeholder' => __( 'Type title here', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'designation',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'label' => __( 'Job Title', 'tpcore' ),
                'default' => __( 'TP Officer', 'tpcore' ),
                'placeholder' => __( 'Type designation here', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );   

        $repeater->add_control(
            'description',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'show_label' => true,
                'label' => __( 'Team Description', 'tpcore' ),
                'default' => __( 'Nulla quis lorem ut libero malesuada feugiat vivamus suscipit tortor eget felis porttitor volutpat.', 'tpcore' ),
                'placeholder' => __( 'Type description here', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'repeater_condition' =>  'style_1'
                ]
            ]
        );   

        $repeater->add_control(
            'item_url',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => false,
                'placeholder' => __( 'Type link here', 'tpcore' ),
                'default' => __( '#', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
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
                'condition' =>[
                    'repeater_condition' =>  'style_2'
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
                    'repeater_condition' =>  'style_2'
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
                    'repeater_condition' =>  'style_2'
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
                        'repeater_condition' =>  'style_2'
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
                        'repeater_condition' =>  'style_2'
                    ]
                ]
            );
        }

        $repeater->add_control(
        'tp_team_contact_title',
            [
                'label'       => esc_html__( 'Contact Title', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Contact with me', 'tpcore' ),
                'placeholder' => esc_html__( 'Your text here', 'tpcore' ),
                'condition' =>[
                    'repeater_condition' =>  'style_2'
                ]
            ]
        );

        $repeater->add_control(
        'tp_team_contact_tel',
            [
                'label'       => esc_html__( 'Contact Phone', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( '0905142563', 'tpcore' ),
                'placeholder' => esc_html__( 'Your text here', 'tpcore' ),
                'condition' =>[
                    'repeater_condition' =>  'style_2'
                ]
            ]
        );

        $repeater->add_control(
        'tp_team_contact_email',
            [
                'label'       => esc_html__( 'Contact Email', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'harry@mail.com', 'tpcore' ),
                'placeholder' => esc_html__( 'Your text here', 'tpcore' ),
                'condition' =>[
                    'repeater_condition' =>  'style_2'
                ]
            ]
        );

        $repeater->end_controls_tab();

        $repeater->start_controls_tab(
            '_tab_member_links',
            [
                'label' => __( 'Links', 'tpcore' ),
            ]
        );

        $repeater->add_control(
            'show_social',
            [
                'label' => __( 'Show Options?', 'tpcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'tpcore' ),
                'label_off' => __( 'No', 'tpcore' ),
                'return_value' => 'yes',
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'web_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Website Address', 'tpcore' ),
                'placeholder' => __( 'Add your profile link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'email_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Email', 'tpcore' ),
                'placeholder' => __( 'Add your email link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );           

        $repeater->add_control(
            'phone_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Phone', 'tpcore' ),
                'placeholder' => __( 'Add your phone link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'facebook_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Facebook', 'tpcore' ),
                'default' => __( '#', 'tpcore' ),
                'placeholder' => __( 'Add your facebook link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );                

        $repeater->add_control(
            'twitter_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Twitter', 'tpcore' ),
                'default' => __( '#', 'tpcore' ),
                'placeholder' => __( 'Add your twitter link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'instagram_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Instagram', 'tpcore' ),
                'default' => __( '#', 'tpcore' ),
                'placeholder' => __( 'Add your instagram link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );       

        $repeater->add_control(
            'linkedin_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'LinkedIn', 'tpcore' ),
                'placeholder' => __( 'Add your linkedin link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'youtube_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Youtube', 'tpcore' ),
                'placeholder' => __( 'Add your youtube link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'googleplus_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Google Plus', 'tpcore' ),
                'placeholder' => __( 'Add your Google Plus link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'flickr_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Flickr', 'tpcore' ),
                'placeholder' => __( 'Add your flickr link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'vimeo_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Vimeo', 'tpcore' ),
                'placeholder' => __( 'Add your vimeo link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'behance_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Behance', 'tpcore' ),
                'placeholder' => __( 'Add your hehance link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'dribble_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Dribbble', 'tpcore' ),
                'placeholder' => __( 'Add your dribbble link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'pinterest_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Pinterest', 'tpcore' ),
                'placeholder' => __( 'Add your pinterest link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'gitub_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Github', 'tpcore' ),
                'placeholder' => __( 'Add your github link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        ); 

        $repeater->end_controls_tab();
        $repeater->end_controls_tabs();

        // REPEATER
        $this->add_control(
            'teams',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(title || "Carousel Item"); #>',
                'default' => [
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ]
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'medium_large',
                'separator' => 'before',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => __( 'Title HTML Tag', 'tpcore' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1'  => [
                        'title' => __( 'H1', 'tpcore' ),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2'  => [
                        'title' => __( 'H2', 'tpcore' ),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3'  => [
                        'title' => __( 'H3', 'tpcore' ),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4'  => [
                        'title' => __( 'H4', 'tpcore' ),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5'  => [
                        'title' => __( 'H5', 'tpcore' ),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6'  => [
                        'title' => __( 'H6', 'tpcore' ),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h3',
                'toggle' => false,
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => __( 'Alignment', 'tpcore' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'tpcore' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'tpcore' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'tpcore' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .single-carousel-item' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
         'team_shape_sec',
             [
               'label' => esc_html__( 'Shape Control', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
               'condition' => [
                'tp_design_style' => 'layout-4'
               ]
             ]
        );
        
        $this->add_control(
         'team_shape_switch',
         [
           'label'        => esc_html__( 'Shape On/Off', 'tpcore' ),
           'type'         => \Elementor\Controls_Manager::SWITCHER,
           'label_on'     => esc_html__( 'Show', 'tpcore' ),
           'label_off'    => esc_html__( 'Hide', 'tpcore' ),
           'return_value' => 'yes',
           'default'      => 'yes',
         ]
        );
        
        $this->end_controls_section();

        $this->tp_button_render('team_view_all', 'Team More', ['layout-1', 'layout-2', 'layout-3'] );

        // tp_team_columns_section
        // colum controls
        $this->tp_columns('col');


        $this->tp_section_style_controls('team_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('team_subtitle', 'Section - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('team_title', 'Section - Title', '.tp-el-title');
        $this->tp_basic_style_controls('team_description', 'Section - Description', '.tp-el-content p');
        $this->tp_link_controls_style('team_box_more', 'Team - More', '.tp-el-box-more-btn');

        $this->tp_icon_style('section_icon', 'Team - Icon', '.tp-el-box-icon span');
        $this->tp_basic_style_controls('team_box_title', 'Team - Box - Title', '.tp-el-box-title');
        $this->tp_basic_style_controls('team_box_subtitle', 'Team - Box -  Designation', '.tp-el-box-subtitle');
        $this->tp_basic_style_controls('team_box_desc', 'Team - Box -  Description', '.tp-el-box-desc');
        $this->tp_basic_style_controls('team_box_info', 'Team - Info', '.tp-el-box-info p');
        $this->tp_link_controls_style('team_box_link_btn', 'Team - Box - Social', '.tp-el-box-social ul li a, .tp-el-box-social ul li a, .tp-el-box-social, .tp-el-box-social a');
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

        <!-- style 2 -->
        <?php if ( $settings['tp_design_style'] === 'layout-2' ): 
            $this->add_render_attribute( 'title_args', 'class', 'section__title-4 tp-el-title' );
            $this->add_render_attribute( 'title_team', 'class', 'team__title-4 tp-el-box-title' );

            // Link
            if ('2' == $settings['tp_team_view_all_btn_link_type']) {
                $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_team_view_all_btn_page_link']));
                $this->add_render_attribute('tp-button-arg', 'target', '_self');
                $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn-border-brown tp-el-more-btn');
            } else {
                if ( ! empty( $settings['tp_team_view_all_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'tp-button-arg', $settings['tp_team_view_all_btn_link'] );
                    $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn-border-brown tp-el-more-btn');
                }
            }

        ?>
         <!-- team area start -->
         <section class="team__area pt-120 pb-80 tp-el-section">
            <div class="container">
            <?php if ( !empty($settings['tp_team_section_title_show']) ) : ?>
               <div class="row align-items-end">
                  <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-7">
                     <div class="section__title-wrapper-4 mb-60 tp-el-content">
                        <?php if ( !empty($settings['tp_team_sub_title']) ) : ?>
                        <span class="section__title-pre-4 tp-el-subtitle">
                            <?php echo tp_kses( $settings['tp_team_sub_title'] ); ?>
                        </span>
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

                    <?php if ( !empty($settings['tp_team_description']) ) : ?>
                        <p><?php echo tp_kses( $settings['tp_team_description'] ); ?></p>
                    <?php endif; ?>

                     </div>
                  </div>
                  <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-5">
                    <?php if (!empty($settings['tp_team_view_all_btn_text'])) : ?>
                     <div class="team__more-4 mb-70 text-md-end">
                        <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>>
                            <?php echo $settings['tp_team_view_all_btn_text']; ?>                            
                        </a>
                     </div>
                     <?php endif; ?>
                  </div>
               </div>
               <?php endif; ?>
               <div class="row">
                    <?php foreach ( $settings['teams'] as $item ) :
                        $title = tp_kses( $item['title' ] );
                        $item_url = esc_url($item['item_url']);

                        if ( !empty($item['image']['url']) ) {
                            $tp_team_image_url = !empty($item['image']['id']) ? wp_get_attachment_image_url( $item['image']['id'], $settings['thumbnail_size']) : $item['image']['url'];
                            $tp_team_image_alt = get_post_meta($item["image"]["id"], "_wp_attachment_image_alt", true);
                        }            
                    ?>
                  <div class="col-xl-<?php echo esc_attr($settings['tp_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['tp_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['tp_col_for_tablet']); ?> col-<?php echo esc_attr($settings['tp_col_for_mobile']); ?>">
                     <div class="team__item-4 p-relative z-index-1 fix mb-40">
                        <?php if( !empty($tp_team_image_url) ) : ?>
                        <div class="team__thumb-4 w-img fix">
                           <img src="<?php echo esc_url($tp_team_image_url); ?>" alt="<?php echo esc_attr($tp_team_image_alt); ?>">
                        </div>
                        <?php endif; ?>
                        <div class="team__content-4 fix">

                           <?php printf( '<%1$s %2$s><a href="%4$s">%3$s</a></%1$s>',
                                tag_escape( $settings['title_tag'] ),
                                $this->get_render_attribute_string( 'title_team' ),
                                $title,
                                $item_url
                            ); ?>

                           <?php if( !empty($item['designation']) ) : ?>
                            <span class="team__designation-4 tp-el-box-subtitle"><?php echo tp_kses( $item['designation'] ); ?></span>
                            <?php endif; ?>

                            <?php if( !empty($item['description']) ) : ?>
                            <p class="tp-el-box-desc"><?php echo tp_kses( $item['description'] ); ?></p>
                            <?php endif; ?>

                           <?php if( !empty($item['show_social'] ) ) : ?> 
                           <div class="team__social-4 tp-el-box-social">
                              <?php if( !empty($item['web_title'] ) ) : ?>
                                <a href="<?php echo esc_url( $item['web_title'] ); ?>"><i class="fa-regular fa-globe"></i></a>
                                <?php endif; ?>  

                                <?php if( !empty($item['email_title'] ) ) : ?>
                                <a href="mailto:<?php echo esc_url( $item['email_title'] ); ?>"><i class="fa-regular fa-envelope"></i></a>
                                <?php endif; ?>  

                                <?php if( !empty($item['phone_title'] ) ) : ?>
                                <a href="tell:<?php echo esc_url( $item['phone_title'] ); ?>"><i class="fa-regular fa-phone"></i></a>
                                <?php endif; ?>  

                                <?php if( !empty($item['facebook_title'] ) ) : ?>
                                <a href="<?php echo esc_url( $item['facebook_title'] ); ?>"><i class="fa-brands fa-facebook-f"></i></a>
                                <?php endif; ?>

                                <?php if( !empty($item['twitter_title'] ) ) : ?>
                                <a href="<?php echo esc_url( $item['twitter_title'] ); ?>"><i class="fa-brands fa-twitter"></i></a>
                                <?php endif; ?>

                                <?php if( !empty($item['instagram_title'] ) ) : ?>
                                <a href="<?php echo esc_url( $item['instagram_title'] ); ?>"><i class="fa-brands fa-instagram"></i></a>
                                <?php endif; ?>

                                <?php if( !empty($item['linkedin_title'] ) ) : ?>
                                <a href="<?php echo esc_url( $item['linkedin_title'] ); ?>"><i class="fa-brands fa-linkedin-in"></i></a>
                                <?php endif; ?>

                                <?php if( !empty($item['youtube_title'] ) ) : ?>
                                <a href="<?php echo esc_url( $item['youtube_title'] ); ?>"><i class="fa-brands fa-youtube"></i></a>
                                <?php endif; ?>

                                <?php if( !empty($item['googleplus_title'] ) ) : ?>
                                <a href="<?php echo esc_url( $item['googleplus_title'] ); ?>"><i class="fa-brands fa-google-plus-g"></i></a>
                                <?php endif; ?>

                                <?php if( !empty($item['flickr_title'] ) ) : ?>
                                <a href="<?php echo esc_url( $item['flickr_title'] ); ?>"><i class="fa-brands fa-flickr"></i></a>
                                <?php endif; ?>

                                <?php if( !empty($item['vimeo_title'] ) ) : ?>
                                <a href="<?php echo esc_url( $item['vimeo_title'] ); ?>"><i class="fa-brands fa-vimeo-v"></i></a>
                                <?php endif; ?>

                                <?php if( !empty($item['behance_title'] ) ) : ?>
                                <a href="<?php echo esc_url( $item['behance_title'] ); ?>"><i class="fa-brands fa-behance"></i></a>
                                <?php endif; ?>

                                <?php if( !empty($item['dribble_title'] ) ) : ?>
                                <a href="<?php echo esc_url( $item['dribble_title'] ); ?>"><i class="fa-brands fa-dribbble"></i></a>
                                <?php endif; ?>

                                <?php if( !empty($item['pinterest_title'] ) ) : ?>
                                <a href="<?php echo esc_url( $item['pinterest_title'] ); ?>"><i class="fa-brands fa-pinterest-p"></i></a>
                                <?php endif; ?>

                                <?php if( !empty($item['gitub_title'] ) ) : ?>
                                <a href="<?php echo esc_url( $item['gitub_title'] ); ?>"><i class="fa-brands fa-github"></i></a>
                                <?php endif; ?>
                           </div>
                            <?php endif; ?>
                        </div>
                     </div>
                  </div>
                  <?php endforeach; ?>
               </div>
            </div>
         </section>
         <!-- team area end -->

        <!-- style 3 -->
        <?php elseif ( $settings['tp_design_style'] === 'layout-3' ): 
            $this->add_render_attribute( 'title_args', 'class', 'section__title-6 tp-el-title' );
            $this->add_render_attribute( 'title_team', 'class', 'team__title-6 tp-el-box-title' );

            // Link
            if ('2' == $settings['tp_team_view_all_btn_link_type']) {
                $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_team_view_all_btn_page_link']));
                $this->add_render_attribute('tp-button-arg', 'target', '_self');
                $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn-border-5 tp-link-btn-3 tp-el-more-btn');
            } else {
                if ( ! empty( $settings['tp_team_view_all_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'tp-button-arg', $settings['tp_team_view_all_btn_link'] );
                    $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn-border-5 tp-link-btn-3 tp-el-more-btn');
                }
            }

        ?>

         <!-- team area start -->
         <section class="team__area pt-110 pb-125 tp-el-section">
            <div class="container">
            <?php if ( !empty($settings['tp_team_section_title_show']) ) : ?>
               <div class="row justify-content-center">
                  <div class="col-xxl-8 col-xl-9 col-lg-10">
                     <div class="section__title-wrapper-6 mb-60 text-center tp-el-content">

                     <?php if ( !empty($settings['tp_team_sub_title']) ) : ?>
                        <span class="section__title-pre-6 tp-el-subtitle"><?php echo tp_kses( $settings['tp_team_sub_title'] ); ?></span>
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

                        <?php if ( !empty($settings['tp_team_description']) ) : ?>
                            <p><?php echo tp_kses( $settings['tp_team_description'] ); ?></p>
                        <?php endif; ?>

                     </div>
                  </div>
               </div>
               <?php endif; ?>
               <div class="row">
               <?php foreach ( $settings['teams'] as $item ) :
                        $title = tp_kses( $item['title' ] );
                        $item_url = esc_url($item['item_url']);

                        if ( !empty($item['image']['url']) ) {
                            $tp_team_image_url = !empty($item['image']['id']) ? wp_get_attachment_image_url( $item['image']['id'], $settings['thumbnail_size']) : $item['image']['url'];
                            $tp_team_image_alt = get_post_meta($item["image"]["id"], "_wp_attachment_image_alt", true);
                        }            
                    ?>
                  <div class="col-xl-<?php echo esc_attr($settings['tp_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['tp_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['tp_col_for_tablet']); ?> col-<?php echo esc_attr($settings['tp_col_for_mobile']); ?>">
                     <div class="team__item-6 mb-80 transition-3 wow fadeInLeft" data-wow-delay=".3s" data-wow-duration="1s">
                         <?php if( !empty($tp_team_image_url) ) : ?>
                        <div class="team__thumb-6 w-img fix">
                            <a href="<?php echo esc_attr($item['item_url']); ?>">
                                <img src="<?php echo esc_url($tp_team_image_url); ?>" alt="<?php echo esc_attr($tp_team_image_alt); ?>">
                            </a>
                        </div>
                        <?php endif; ?>
                        <div class="team__content-6 transition-3">
                           <div class="team__content-6-bg"></div>
                           <?php printf( '<%1$s %2$s><a href="%4$s">%3$s</a></%1$s>',
                                tag_escape( $settings['title_tag'] ),
                                $this->get_render_attribute_string( 'title_team' ),
                                $title,
                                $item_url
                            ); ?>

                           <?php if( !empty($item['designation']) ) : ?>
                            <span class="team__designation-6 tp-el-box-subtitle"><?php echo tp_kses( $item['designation'] ); ?></span>
                            <?php endif; ?>
                        </div>
                     </div>
                  </div>
                  <?php endforeach; ?>
               </div>

               <?php if (!empty($settings['tp_team_view_all_btn_text'])) : ?>                     
               <div class="row">
                  <div class="col-xxl-12">
                     <div class="team__more-6 mt-25 text-center">
                        <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?> >
                        <?php echo $settings['tp_team_view_all_btn_text']; ?>     
                           <span>
                              <i class="fa-regular fa-arrow-right"></i>
                           </span>
                        </a>
                     </div>
                  </div>
               </div>
               <?php endif; ?>
            </div>
         </section>
         <!-- team area end -->

        <!-- style 4 -->
        <?php elseif ( $settings['tp_design_style'] === 'layout-4' ): 
            $this->add_render_attribute( 'title_args', 'class', 'section__title-8 tp-el-title' );
            $this->add_render_attribute( 'title_team', 'class', 'team__title-8 tp-el-box-title' );

            // Link
            if ('2' == $settings['tp_team_view_all_btn_link_type']) {
                $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_team_view_all_btn_page_link']));
                $this->add_render_attribute('tp-button-arg', 'target', '_self');
                $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn-border-5 tp-link-btn-3 tp-el-box-btn');
            } else {
                if ( ! empty( $settings['tp_team_view_all_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'tp-button-arg', $settings['tp_team_view_all_btn_link'] );
                    $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn-border-5 tp-link-btn-3 tp-el-box-btn');
                }
            }

        ?>

         <!-- team area start -->
         <section class="team__area team__border p-relative black-bg-12 pt-110 pb-100 tp-el-section">

            <?php if(!empty($settings['team_shape_switch'] == 'yes')) : ?>
            <div class="team__bg-8" data-background="<?php echo get_template_directory_uri() . '/assets/img/team/8/team-bg-1.png' ?>"></div>
            <?php endif; ?>

            <div class="container">
            <?php if ( !empty($settings['tp_team_section_title_show']) ) : ?>
               <div class="row">
                  <div class="col-xxl-12">
                     <div class="section__title-wrapper-8 text-center mb-70 tp-el-content">
                        <?php if ( !empty($settings['tp_team_sub_title']) ) : ?>
                        <span class="section__title-pre-8"><?php echo tp_kses( $settings['tp_team_sub_title'] ); ?></span>
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

                        <?php if ( !empty($settings['tp_team_description']) ) : ?>
                            <p><?php echo tp_kses( $settings['tp_team_description'] ); ?></p>
                        <?php endif; ?>

                     </div>
                  </div>
               </div>
               <?php endif; ?>
               <div class="row">
                    <?php foreach ( $settings['teams'] as $item ) :
                        $title = tp_kses( $item['title' ] );
                        $item_url = esc_url($item['item_url']);

                        if ( !empty($item['image']['url']) ) {
                            $tp_team_image_url = !empty($item['image']['id']) ? wp_get_attachment_image_url( $item['image']['id'], $settings['thumbnail_size']) : $item['image']['url'];
                            $tp_team_image_alt = get_post_meta($item["image"]["id"], "_wp_attachment_image_alt", true);
                        }            
                    ?>
                  <div class="col-xl-<?php echo esc_attr($settings['tp_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['tp_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['tp_col_for_tablet']); ?> col-<?php echo esc_attr($settings['tp_col_for_mobile']); ?>">
                     <div class="team__item-8 text-center black-bg-14 mb-30 wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s">
                        <div class="team__thumb-8 mb-45">
                           <a href="<?php echo esc_attr($item_url); ?>">
                                <img src="<?php echo esc_url($tp_team_image_url); ?>" alt="<?php echo esc_attr($tp_team_image_alt); ?>">
                            </a>
                        </div>
                        <div class="team__content-8">
                            <?php printf( '<%1$s %2$s><a href="%4$s">%3$s</a></%1$s>',
                                tag_escape( $settings['title_tag'] ),
                                $this->get_render_attribute_string( 'title_team' ),
                                $title,
                                $item_url
                            ); ?>
                           
                           <?php if( !empty($item['designation']) ) : ?>
                            <span class="team__designation-8 tp-el-box-subtitle"><?php echo tp_kses( $item['designation'] ); ?></span>
                            <?php endif; ?>

                            <?php if( !empty($item['show_social'] ) ) : ?> 
                            <div class="team__social-8 d-flex flex-wrap align-items-center justify-content-center tp-el-box-social">
                                    <?php if( !empty($item['web_title'] ) ) : ?>
                                    <a href="<?php echo esc_url( $item['web_title'] ); ?>"><i class="fa-regular fa-globe"></i></a>
                                    <?php endif; ?>  
                                    
                                    <?php if( !empty($item['phone_title'] ) ) : ?>
                                        <a href="tel:<?php echo esc_url( $item['phone_title'] ); ?>"><i class="fa-regular fa-phone"></i></a>
                                    <?php endif; ?>

                                    <?php if( !empty($item['email_title'] ) ) : ?>
                                    <a href="mailto:<?php echo esc_url( $item['email_title'] ); ?>"><i class="fa-regular fa-envelope"></i></a>
                                    <?php endif; ?>

                                    <?php if( !empty($item['facebook_title'] ) ) : ?>
                                        <a href="<?php echo esc_url( $item['facebook_title'] ); ?>"><i class="fa-brands fa-facebook-f"></i></a>
                                    <?php endif; ?>

                                    <?php if( !empty($item['twitter_title'] ) ) : ?>
                                        <a href="<?php echo esc_url( $item['twitter_title'] ); ?>"><i class="fa-brands fa-twitter"></i></a>
                                    <?php endif; ?>

                                    <?php if( !empty($item['instagram_title'] ) ) : ?>
                                        <a href="<?php echo esc_url( $item['instagram_title'] ); ?>"><i class="fa-brands fa-instagram"></i></a>
                                    <?php endif; ?>

                                    <?php if( !empty($item['linkedin_title'] ) ) : ?>
                                        <a href="<?php echo esc_url( $item['linkedin_title'] ); ?>"><i class="fa-brands fa-linkedin-in"></i></a>
                                    <?php endif; ?>

                                    <?php if( !empty($item['youtube_title'] ) ) : ?>
                                        <a href="<?php echo esc_url( $item['youtube_title'] ); ?>"><i class="fa-brands fa-youtube"></i></a>
                                    <?php endif; ?>

                                    <?php if( !empty($item['googleplus_title'] ) ) : ?>
                                        <a href="<?php echo esc_url( $item['googleplus_title'] ); ?>"><i class="fa-brands fa-google-plus-g"></i></a>
                                    <?php endif; ?>

                                    <?php if( !empty($item['flickr_title'] ) ) : ?>
                                        <a href="<?php echo esc_url( $item['flickr_title'] ); ?>"><i class="fa-brands fa-flickr"></i></a>
                                    <?php endif; ?>

                                    <?php if( !empty($item['vimeo_title'] ) ) : ?>
                                        <a href="<?php echo esc_url( $item['vimeo_title'] ); ?>"><i class="fa-brands fa-vimeo-v"></i></a>
                                    <?php endif; ?>

                                    <?php if( !empty($item['behance_title'] ) ) : ?>
                                        <a href="<?php echo esc_url( $item['behance_title'] ); ?>"><i class="fa-brands fa-behance"></i></a>
                                    <?php endif; ?>

                                    <?php if( !empty($item['dribble_title'] ) ) : ?>
                                        <a href="<?php echo esc_url( $item['dribble_title'] ); ?>"><i class="fa-brands fa-dribbble"></i></a>
                                    <?php endif; ?>
                                    <?php if( !empty($item['pinterest_title'] ) ) : ?>
                                        <a href="<?php echo esc_url( $item['pinterest_title'] ); ?>"><i class="fa-brands fa-pinterest-p"></i></a>
                                    <?php endif; ?>

                                    <?php if( !empty($item['gitub_title'] ) ) : ?>
                                        <a href="<?php echo esc_url( $item['gitub_title'] ); ?>"><i class="fa-brands fa-github"></i></a>
                                    <?php endif; ?>
                            </div>
                           <?php endif; ?>
                        </div>
                     </div>
                  </div>
                  <?php endforeach; ?>
               </div>
            </div>
         </section>
         <!-- team area end -->

        <!-- style 5 -->
        <?php elseif ( $settings['tp_design_style'] === 'layout-5' ): 
            $this->add_render_attribute( 'title_args', 'class', 'section__title-10 tp-el-title' );
            $this->add_render_attribute( 'title_team', 'class', 'team__title-10 tp-el-box-title' );

        ?>

         <!-- team area start -->
         <section class="team__area pb-100 tp-el-section">
            <div class="container">
            <?php if ( !empty($settings['tp_team_section_title_show']) ) : ?>
               <div class="row">
                  <div class="col-xxl-12">
                     <div class="section__title-wrapper-10 text-center mb-45 tp-el-content">

                        <?php if ( !empty($settings['tp_team_sub_title']) ) : ?>
                        <span class="section__title-pre-10 tp-el-subtitle"><?php echo tp_kses( $settings['tp_team_sub_title'] ); ?></span>
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
                        <?php if ( !empty($settings['tp_team_description']) ) : ?>
                            <p><?php echo tp_kses( $settings['tp_team_description'] ); ?></p>
                        <?php endif; ?>
                     </div>
                  </div>
               </div>
               <?php endif; ?>
               <div class="row">
                  <div class="col-xxl-12">
                     <div class="team__slider-10">
                        <div class="team__slider-active-10 swiper-container">
                           <div class="swiper-wrapper">
                                <?php foreach ( $settings['teams'] as $item ) :
                                    $title = tp_kses( $item['title' ] );
                                    $item_url = esc_url($item['item_url']);

                                    if ( !empty($item['image']['url']) ) {
                                        $tp_team_image_url = !empty($item['image']['id']) ? wp_get_attachment_image_url( $item['image']['id'], $settings['thumbnail_size']) : $item['image']['url'];
                                        $tp_team_image_alt = get_post_meta($item["image"]["id"], "_wp_attachment_image_alt", true);
                                    }            
                                ?>
                              <div class="team__item-10 swiper-slide wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s">
                                 <div class="team__thumb-10 p-relative">
                                    <a href="<?php echo esc_attr($item_url); ?>">
                                        <img src="<?php echo esc_url($tp_team_image_url); ?>" alt="<?php echo esc_attr($tp_team_image_alt); ?>">
                                    </a>
         
                                    <div class="team__contact-overlay">
                                       <div class="team__contact-top tp-el-box-icon">
                                        <?php if($item['tp_box_icon_type'] == 'icon') : ?>
                                            <?php if (!empty($item['tp_box_icon']) || !empty($item['tp_box_selected_icon']['value'])) : ?>
                                                    <span><?php tp_render_icon($item, 'tp_box_icon', 'tp_box_selected_icon'); ?></span>
                                            <?php endif; ?>
                                        <?php elseif( $item['tp_box_icon_type'] == 'image' ) : ?>
                                            <span>
                                                <?php if (!empty($item['tp_box_icon_image']['url'])): ?>
                                                <img class="team__contact-top-icon" src="<?php echo $item['tp_box_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                                <?php endif; ?>
                                            </span>
                                        <?php else : ?>
                                            <span>
                                                <?php if (!empty($item['tp_box_icon_svg'])): ?>
                                                <?php echo $item['tp_box_icon_svg']; ?>
                                                <?php endif; ?>
                                            </span>
                                        <?php endif; ?>
                                        <?php if(!empty($item['tp_team_contact_title'])) : ?>
                                          <p><?php echo tp_kses($item['tp_team_contact_title']) ?></p>
                                          <?php endif; ?>

                                       </div>
                                       <div class="team__contact-wrapper tp-el-box-info">

                                          <?php if(!empty($item['tp_team_contact_tel'])) : ?>
                                          <p class="team-tel"><a href="tel:<?php echo esc_attr($item['tp_team_contact_tel']); ?>"><?php echo tp_kses($item['tp_team_contact_tel']) ?></a></p>
                                          <?php endif; ?>

                                          <?php if(!empty($item['tp_team_contact_email'])) : ?>
                                          <p><a href="mailto:<?php echo esc_attr($item['tp_team_contact_email']); ?>"><?php echo tp_kses($item['tp_team_contact_email']) ?></a></p>
                                          <?php endif; ?>
                                       </div>

                                       <?php if( !empty($item['show_social'] ) ) : ?> 
                                        <div class="team__social-10 d-flex justify-content-center tp-el-box-social">
                                            <?php if( !empty($item['web_title'] ) ) : ?>
                                            <a href="<?php echo esc_url( $item['web_title'] ); ?>"><i class="fa-regular fa-globe"></i></a>
                                            <?php endif; ?>  
                                            
                                            <?php if( !empty($item['phone_title'] ) ) : ?>
                                                <a href="tel:<?php echo esc_url( $item['phone_title'] ); ?>"><i class="fa-regular fa-phone"></i></a>
                                            <?php endif; ?>

                                            <?php if( !empty($item['email_title'] ) ) : ?>
                                            <a href="mailto:<?php echo esc_url( $item['email_title'] ); ?>"><i class="fa-regular fa-envelope"></i></a>
                                            <?php endif; ?>

                                            <?php if( !empty($item['facebook_title'] ) ) : ?>
                                                <a href="<?php echo esc_url( $item['facebook_title'] ); ?>"><i class="fa-brands fa-facebook-f"></i></a>
                                            <?php endif; ?>

                                            <?php if( !empty($item['twitter_title'] ) ) : ?>
                                                <a href="<?php echo esc_url( $item['twitter_title'] ); ?>"><i class="fa-brands fa-twitter"></i></a>
                                            <?php endif; ?>

                                            <?php if( !empty($item['instagram_title'] ) ) : ?>
                                                <a href="<?php echo esc_url( $item['instagram_title'] ); ?>"><i class="fa-brands fa-instagram"></i></a>
                                            <?php endif; ?>

                                            <?php if( !empty($item['linkedin_title'] ) ) : ?>
                                                <a href="<?php echo esc_url( $item['linkedin_title'] ); ?>"><i class="fa-brands fa-linkedin-in"></i></a>
                                            <?php endif; ?>

                                            <?php if( !empty($item['youtube_title'] ) ) : ?>
                                                <a href="<?php echo esc_url( $item['youtube_title'] ); ?>"><i class="fa-brands fa-youtube"></i></a>
                                            <?php endif; ?>

                                            <?php if( !empty($item['googleplus_title'] ) ) : ?>
                                                <a href="<?php echo esc_url( $item['googleplus_title'] ); ?>"><i class="fa-brands fa-google-plus-g"></i></a>
                                            <?php endif; ?>

                                            <?php if( !empty($item['flickr_title'] ) ) : ?>
                                                <a href="<?php echo esc_url( $item['flickr_title'] ); ?>"><i class="fa-brands fa-flickr"></i></a>
                                            <?php endif; ?>

                                            <?php if( !empty($item['vimeo_title'] ) ) : ?>
                                                <a href="<?php echo esc_url( $item['vimeo_title'] ); ?>"><i class="fa-brands fa-vimeo-v"></i></a>
                                            <?php endif; ?>

                                            <?php if( !empty($item['behance_title'] ) ) : ?>
                                                <a href="<?php echo esc_url( $item['behance_title'] ); ?>"><i class="fa-brands fa-behance"></i></a>
                                            <?php endif; ?>

                                            <?php if( !empty($item['dribble_title'] ) ) : ?>
                                                <a href="<?php echo esc_url( $item['dribble_title'] ); ?>"><i class="fa-brands fa-dribbble"></i></a>
                                            <?php endif; ?>
                                            <?php if( !empty($item['pinterest_title'] ) ) : ?>
                                                <a href="<?php echo esc_url( $item['pinterest_title'] ); ?>"><i class="fa-brands fa-pinterest-p"></i></a>
                                            <?php endif; ?>

                                            <?php if( !empty($item['gitub_title'] ) ) : ?>
                                                <a href="<?php echo esc_url( $item['gitub_title'] ); ?>"><i class="fa-brands fa-github"></i></a>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                    </div>
                                 </div>
                                 <div class="team__content-10 text-center">
                                    <?php printf( '<%1$s %2$s><a href="%4$s">%3$s</a></%1$s>',
                                        tag_escape( $settings['title_tag'] ),
                                        $this->get_render_attribute_string( 'title_team' ),
                                        $title,
                                        $item_url
                                    ); ?>
                                    <?php if( !empty($item['designation']) ) : ?>
                                    <span class="team__designation-10 tp-el-box-subtitle"><?php echo tp_kses( $item['designation'] ); ?></span>
                                    <?php endif; ?>
                                 </div>
                              </div>
                              <?php endforeach; ?>
                           </div>
                           <div class="tp-swiper-dot tp-swiper-dot-2 team-slider-dot-10 text-center mt-50"></div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- team area end -->

        <!-- style default -->
        <?php else : 
            $this->add_render_attribute('title_args', 'class', 'section__title tp-el-title');
            $this->add_render_attribute( 'title_team', 'class', 'team__title tp-el-box-title' );

            // Link
            if ('2' == $settings['tp_team_view_all_btn_link_type']) {
                $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_team_view_all_btn_page_link']));
                $this->add_render_attribute('tp-button-arg', 'target', '_self');
                $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('tp-button-arg', 'class', 'tp-link-btn-2 tp-el-box-more-btn');
            } else {
                if ( ! empty( $settings['tp_team_view_all_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'tp-button-arg', $settings['tp_team_view_all_btn_link'] );
                    $this->add_render_attribute('tp-button-arg', 'class', 'tp-link-btn-2 tp-el-box-more-btn');
                }
            }
        ?>

         <section class="team__area pt-115 tp-el-section">
            <div class="container">
                <?php if ( !empty($settings['tp_team_section_title_show']) ) : ?>
                <div class="row align-items-end">
                    <div class="col-xxl-5 col-xl-5 col-lg-6 col-md-6 col-sm-7">
                        <div class="section__title-wrapper mb-60 tp-el-content">

                        <?php if ( !empty($settings['tp_team_sub_title']) ) : ?>
                        <span class="section__title-pre tp-el-subtitle">
                            <?php echo tp_kses( $settings['tp_team_sub_title'] ); ?>
                        </span>
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

                            <?php if ( !empty($settings['tp_team_description']) ) : ?>
                                <p><?php echo tp_kses( $settings['tp_team_description'] ); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-xxl-7 col-xl-7 col-lg-6 col-md-6 col-sm-5">
                        <?php if (!empty($settings['tp_team_view_all_btn_text'])) : ?>
                        <div class="team__join mb-70 text-sm-end">
                            <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>>
                            <?php echo $settings['tp_team_view_all_btn_text']; ?>
                            <span>
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 7H13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M7 1L13 7L7 13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>                              
                            </span>                              
                            </a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
               <?php endif; ?>
               <div class="row">
                  <div class="col-xxl-12">
                     <div class="team__slider wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1.2s">
                        <div class="team__slider-active swiper-container">
                           <div class="swiper-wrapper">
                                <?php foreach ( $settings['teams'] as $item ) :
                                    $title = tp_kses( $item['title' ] );
                                    $item_url = esc_url($item['item_url']);

                                    if ( !empty($item['image']['url']) ) {
                                        $tp_team_image_url = !empty($item['image']['id']) ? wp_get_attachment_image_url( $item['image']['id'], $settings['thumbnail_size']) : $item['image']['url'];
                                        $tp_team_image_alt = get_post_meta($item["image"]["id"], "_wp_attachment_image_alt", true);
                                    }            
                                ?>
                              <div class="team__item swiper-slide">
                                <?php if( !empty($tp_team_image_url) ) : ?>
                                 <div class="team__thumb w-img fix transition-3">
                                    <div class="tp-thumb-overlay wow"></div>
                                        <a href="<?php echo esc_attr($item_url); ?>">
                                            <img src="<?php echo esc_url($tp_team_image_url); ?>" alt="<?php echo esc_attr($tp_team_image_alt); ?>">
                                        </a>
                                    <?php if( !empty($item['show_social'] ) ) : ?> 
                                    <div class="team__action">
                                        <ul>
                                            <?php if( !empty($item['email_title'] ) ) : ?>
                                            <li>
                                                <a class="tp-el-box-social" href="mailto:<?php echo esc_attr($item['email_title']); ?>"><i class="far fa-envelope"></i></a>
                                            </li>
                                            <?php endif; ?>

                                            <li>
                                                <a href="#" class="tp-el-box-social"><i class="far fa-share-alt"></i></a>
                                                <div class="team__social tp-el-box-social">
                                                    <ul>
                                                        <?php if( !empty($item['web_title'] ) ) : ?>
                                                        <li>
                                                            <a href="<?php echo esc_url( $item['web_title'] ); ?>"><i class="fa-regular fa-globe"></i></a>
                                                        </li>
                                                        <?php endif; ?>  
                                                        
                                                        <?php if( !empty($item['phone_title'] ) ) : ?>
                                                        <li>
                                                            <a href="tel:<?php echo esc_url( $item['phone_title'] ); ?>"><i class="fa-regular fa-phone"></i></a>
                                                        </li>
                                                        <?php endif; ?>
                                                        
                                                        <?php if( !empty($item['facebook_title'] ) ) : ?>
                                                        <li>
                                                            <a href="<?php echo esc_url( $item['facebook_title'] ); ?>"><i class="fa-brands fa-facebook-f"></i></a>
                                                        </li>
                                                        <?php endif; ?>

                                                        <?php if( !empty($item['twitter_title'] ) ) : ?>
                                                        <li>
                                                            <a href="<?php echo esc_url( $item['twitter_title'] ); ?>"><i class="fa-brands fa-twitter"></i></a>
                                                        </li>
                                                        <?php endif; ?>

                                                        <?php if( !empty($item['instagram_title'] ) ) : ?>
                                                        <li>
                                                            <a href="<?php echo esc_url( $item['instagram_title'] ); ?>"><i class="fa-brands fa-instagram"></i></a>
                                                        </li>
                                                        <?php endif; ?>

                                                        <?php if( !empty($item['linkedin_title'] ) ) : ?>
                                                        <li>
                                                            <a href="<?php echo esc_url( $item['linkedin_title'] ); ?>"><i class="fa-brands fa-linkedin-in"></i></a>
                                                        </li>
                                                        <?php endif; ?>

                                                        <?php if( !empty($item['youtube_title'] ) ) : ?>
                                                        <li>
                                                            <a href="<?php echo esc_url( $item['youtube_title'] ); ?>"><i class="fa-brands fa-youtube"></i></a>
                                                        </li>
                                                        <?php endif; ?>

                                                        <?php if( !empty($item['googleplus_title'] ) ) : ?>
                                                        <li>
                                                            <a href="<?php echo esc_url( $item['googleplus_title'] ); ?>"><i class="fa-brands fa-google-plus-g"></i></a>
                                                        </li>
                                                        <?php endif; ?>

                                                        <?php if( !empty($item['flickr_title'] ) ) : ?>
                                                        <li>
                                                            <a href="<?php echo esc_url( $item['flickr_title'] ); ?>"><i class="fa-brands fa-flickr"></i></a>
                                                        </li>
                                                        <?php endif; ?>

                                                        <?php if( !empty($item['vimeo_title'] ) ) : ?>
                                                        <li>
                                                            <a href="<?php echo esc_url( $item['vimeo_title'] ); ?>"><i class="fa-brands fa-vimeo-v"></i></a>
                                                        </li>
                                                        <?php endif; ?>

                                                        <?php if( !empty($item['behance_title'] ) ) : ?>
                                                        <li>
                                                            <a href="<?php echo esc_url( $item['behance_title'] ); ?>"><i class="fa-brands fa-behance"></i></a>
                                                        </li>
                                                        <?php endif; ?>

                                                        <?php if( !empty($item['dribble_title'] ) ) : ?>
                                                        <li>
                                                            <a href="<?php echo esc_url( $item['dribble_title'] ); ?>"><i class="fa-brands fa-dribbble"></i></a>
                                                        </li>
                                                        <?php endif; ?>
                                                        <?php if( !empty($item['pinterest_title'] ) ) : ?>
                                                        <li>
                                                            <a href="<?php echo esc_url( $item['pinterest_title'] ); ?>"><i class="fa-brands fa-pinterest-p"></i></a>
                                                        </li>
                                                        <?php endif; ?>

                                                        <?php if( !empty($item['gitub_title'] ) ) : ?>
                                                        <li>
                                                            <a href="<?php echo esc_url( $item['gitub_title'] ); ?>"><i class="fa-brands fa-github"></i></a>
                                                        </li>
                                                        <?php endif; ?>
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <?php endif; ?>
                                 </div>
                                 <?php endif; ?>
                                 <div class="team__content">
                                    <?php printf( '<%1$s %2$s><a href="%4$s">%3$s</a></%1$s>',
                                        tag_escape( $settings['title_tag'] ),
                                        $this->get_render_attribute_string( 'title_team' ),
                                        $title,
                                        $item_url
                                    ); ?>
                                    <?php if( !empty($item['designation']) ) : ?>
                                    <span class="team__designation tp-el-box-subtitle"><?php echo tp_kses( $item['designation'] ); ?></span>
                                    <?php endif; ?>
                                 </div>
                              </div>
                              <?php endforeach; ?>
                           </div>
                        </div>
                        <div class="team-slider-dot tp-swiper-dot text-center mt-50"></div>
                     </div>
                  </div>
               </div>
            </div>
         </section>

        <?php endif; ?>  

        <?php
    }
}

$widgets_manager->register( new TP_Team() );