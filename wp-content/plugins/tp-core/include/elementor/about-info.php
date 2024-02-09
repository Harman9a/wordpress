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
class TP_About_Info extends Widget_Base {

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
		return 'tp-about-info';
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
		return __( 'About Info', 'tpcore' );
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
    protected function register_controls(){
        $this->register_controls_section();
        $this->style_tab_content();
    } 

    protected function register_controls_section() {
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
                    'layout-3' => esc_html__('Layout 3', 'tp-core'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'tp_about_section_title',
            [
                'label' => esc_html__('Title & Content', 'tpcore'),
                'condition' => [
                    'tp_design_style' => 'layout-3'
                ]
            ]
        );
        if (true){
            $this->add_control(
                'tp_about_section_title_show',
                [
                    'label' => esc_html__( 'Section Title & Content', 'tpcore' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', 'tpcore' ),
                    'label_off' => esc_html__( 'Hide', 'tpcore' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
        }

        $this->add_control(
            'tp_about_sub_title',
            [
                'label' => esc_html__('Sub Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Your Sub Title',
                'placeholder' => esc_html__('Type Before Heading Text', 'tpcore'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'tp_about_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Section Title',
                'placeholder' => esc_html__('Type Heading Text', 'tpcore'),
                'label_block' => true,
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
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'I would like to express my thanks for the work you done for me over the past years!',
                'placeholder' => esc_html__('Type section description here', 'tpcore'),
            ]
        );
        $this->add_responsive_control(
            'tp_about_align',
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
                'default' => 'text-left',
                'toggle' => false,
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
         'tp_about_info_section',
            [
               'label' => esc_html__( 'About Info', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
               'condition' => [
                'tp_design_style' => 'layout-1'
               ]
            ]
        );
        
        $this->add_control(
         'tp_about_text',
            [
            'label'       => esc_html__( 'About Text', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXTAREA,
            'rows'        => 10,
            'default'     => esc_html__( 'Im a UX Designer, Over the past 10+ years I’ve created well-crafted mobile and web apps by connecting Business goals with user needs.Currently Service and Interaction Designer UIUXer office.', 'tpcore' ),
            'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
            ]
        );

        $this->add_control(
            'tp_about_author_title',
            [
                'label'       => esc_html__( 'About Author Title', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Your Author Title', 'tpcore' ),
                'placeholder' => esc_html__( 'Placeholder Text', 'tpcore' ),
                'label_block' => true
            ]
        );

        $this->add_control(
         'tp_about_author_signature',
         [
           'label'   => esc_html__( 'About Author Signature', 'tpcore' ),
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
                'default' => 'thumbnail',
                'separator' => 'before',
                'exclude' => [
                    'custom'
                ]
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            'about_tab_info',
            [
               'label' => esc_html__( 'About Info', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
               'condition' => [
                'tp_design_style' => 'layout-2'
               ]
            ]
        );

        $this->add_control(
         'about_tab_desc',
            [
            'label'       => esc_html__( 'About Description', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXTAREA,
            'rows'        => 10,
            'default'     => esc_html__( 'I started in my children’s room, got pro renowned digital agencies', 'tpcore' ),
            'placeholder' => esc_html__( 'Your Content', 'tpcore' ),
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
         'tp_about_sec',
             [
               'label' => esc_html__( 'About Description', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
               'condition' => [
                'tp_design_style' => 'layout-3'
               ]
             ]
        );
        
        $this->add_control(
         'tp_about_desc',
         [
           'label'       => esc_html__( 'About Description', 'tpcore' ),
           'type'        => \Elementor\Controls_Manager::TEXTAREA,
           'rows'        => 10,
           'default'     => esc_html__( 'Through a unique combination of engineering, construction and design ', 'tpcore' ),
           'placeholder' => esc_html__( 'Placeholder Text', 'tpcore' ),
         ]
        );
        
        $this->end_controls_section();


        $this->start_controls_section(
            'about_tab_list',
            [
               'label' => esc_html__( 'About Contact', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
               'condition' => [
                'tp_design_style' => ['layout-2', 'layout-3']
               ]
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
                    'tp_box_icon_type' => 'svg'
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
                        'tp_box_icon_type' => 'icon'
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
                        'tp_box_icon_type' => 'icon'
                    ]
                ]
            );
        }
        
        $repeater->add_control(
            'about_contact_title',
            [
                'label'       => esc_html__( 'Contact Title', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Email Us', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Content', 'tpcore' ),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'about_contact_name',
            [
                'label'       => esc_html__( 'Contact Text', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'harry@support.com', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'about_contact_type',
            [
                'label' => esc_html__('Select Contact Type', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'tel',
                'options' => [
                    'tel' => esc_html__('Telephone', 'tpcore'),
                    'mailto' => esc_html__('Email', 'tpcore'),
                    'default' => esc_html__('Default', 'tpcore'),
                ],
    
            ]
        );
       
        $repeater->add_control(
         'about_contact_url',
         [
            'label'   => esc_html__( 'Contact Url', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::URL,
            'label_block' => true,
            'default'     => [
                'url'               => '#',
                'is_external'       => true,
                'nofollow'          => true,
                'custom_attributes' => '',
                ],
                'placeholder' => esc_html__( 'Your Url', 'tpcore' ),
                'label_block' => true,
            ]
         );

        $this->add_control(
            'tp_about_list',
            [
                'label' => esc_html__('About - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_title' => esc_html__('united states', 'tpcore'),
                    ],
                    [
                        'tp_title' => esc_html__('south Africa', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_title }}}',
            ]
        );
        
        $this->end_controls_section();


        $this->start_controls_section(
         'tp_about_img_sec',
             [
               'label' => esc_html__( 'Image', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
               'condition' => [
                'tp_design_style' => 'layout-3'
               ]
             ]
        );
        
        $this->add_control(
            'tp_about_img',
            [
                'label'   => esc_html__( 'Upload Image', 'tpcore' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                    'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
         'tp_about_ex_enable',
            [
            'label'        => esc_html__( 'Enable Experience', 'tpcore' ),
            'type'         => \Elementor\Controls_Manager::SWITCHER,
            'label_on'     => esc_html__( 'Show', 'tpcore' ),
            'label_off'    => esc_html__( 'Hide', 'tpcore' ),
            'return_value' => 'yes',
            'default'      => 'yes',
            ]
        );

        $this->add_control(
            'tp_about_img_2',
            [
                'label'   => esc_html__( 'Upload Experience Image', 'tpcore' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                    'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_about_ex_enable' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'tp_about_ex_num',
            [
                'label'       => esc_html__( 'Experience Year', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( '25', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Year', 'tpcore' ),
                'condition' => [
                    'tp_about_ex_enable' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'tp_about_ex_text',
            [
                'label'       => esc_html__( 'Experience Description', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => esc_html__( 'Start In 1982', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
                'condition' => [
                    'tp_about_ex_enable' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'tp_about_ex_desc',
            [
                'label'       => esc_html__( 'Experience Description', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => esc_html__( 'Years Experience', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
                'condition' => [
                    'tp_about_ex_enable' => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'about_thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                // 'default' => 'tp-portfolio-thumb',
            ]
        );
        
        $this->end_controls_section();
        
        $this->tp_button_render('about', 'About Button ', 'layout-3');

        $this->start_controls_section(
            'about_video_sec',
                [
                  'label' => esc_html__( 'Video', 'tpcore' ),
                  'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                  'condition' =>[
                    'tp_design_style' => 'layout-3'
                  ]
                ]
           );
           
        $this->add_control(
        'about_video_text',
         [
            'label'       => esc_html__( 'Video Text', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( 'View our Story', 'tpcore' ),
            'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
         ]
        );           
           $this->add_control(
            'about_video_url',
            [
              'label'   => esc_html__( 'Video URL', 'tpcore' ),
              'type'        => \Elementor\Controls_Manager::URL,
              'default'     => [
                  'url'               => '#',
                  'is_external'       => true,
                  'nofollow'          => true,
                  'custom_attributes' => '',
                ],
                'placeholder' => esc_html__( 'Your URL', 'tpcore' ),
                'label_block' => true,
              ]
            );
           
           $this->end_controls_section();
    }

    protected function style_tab_content(){
        $this->tp_section_style_controls('about_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('about_subtitle', 'Section - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('about_title', 'Section - Title', '.tp-el-title');
        $this->tp_basic_style_controls('about_description', 'Section - Description', '.tp-el-desc');

        $this->tp_basic_style_controls('about_box_description', 'Box - Description', '.tp-el-box-desc');
        $this->tp_icon_style('about_box_icon', 'Box - Icon', '.tp-el-box-icon span');
        $this->tp_basic_style_controls('about_box_title', 'Box - Title', '.tp-el-box-title');
        $this->tp_link_controls_style('about_box_url', 'Box - Url', '.tp-el-box-url');
        $this->tp_link_controls_style('about_box_btn', 'Box - Button', '.tp-el-box-btn');
        $this->tp_link_controls_style('about_box_video_btn', 'Box - Video Text', '.tp-el-box-video-btn');
        $this->tp_link_controls_style('about_box_video_icon_btn', 'Box - Video Icon', '.tp-el-box-video-icon::after');

        $this->tp_basic_style_controls('about_experience_title', 'Experience - Title', '.tp-el-exp-title');
        $this->tp_basic_style_controls('about_experience_num', 'Experience - Number', '.tp-el-exp-num');
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

        ?>

        <div class="about__self tp-el-section">
            <?php if(!empty($settings['about_tab_desc'])) : ?>
            <div class="about__self-des">
                <p class="tp-el-box-desc"><?php echo tp_kses($settings['about_tab_desc']); ?></p>
            </div>
            <?php endif; ?>
            <div class="about__info d-sm-flex d-lg-block d-xl-flex align-items-center">
                <?php foreach ($settings['tp_about_list'] as $item) : ?>
                <div class="about__info-item d-flex align-items-center mr-40 mb-55">
                    <div class="about__info-icon mr-15 tp-el-box-icon">
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
                    <div class="about__info-content">
                        <?php if(!empty($item['about_contact_title'])) :?>
                        <h4 class="tp-el-box-title"><?php echo esc_html($item['about_contact_title']); ?></h4>
                        <?php endif; ?>

                        <?php if(!empty($item['about_contact_name'])) :?>
                        <p class="tp-el-box-url"><a href="mailto:<?php echo esc_attr($item['about_contact_url']['url']); ?>"><?php echo esc_html($item['about_contact_name']); ?></a></p>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <?php elseif ( $settings['tp_design_style']  == 'layout-3' ):
            $this->add_render_attribute('title_args', 'class', 'section__title-8 tp-el-title');

            if ( !empty($settings['tp_about_img']['url']) ) {
                $tp_about_img_url = !empty($settings['tp_about_img']['id']) ? wp_get_attachment_image_url( $settings['tp_about_img']['id'], $settings['about_thumbnail_size']) : $settings['tp_about_img']['url'];
                $tp_about_img_alt = get_post_meta($settings["tp_about_img"]["id"], "_wp_attachment_image_alt", true);
            }

            if ( !empty($settings['tp_about_img_2']['url']) ) {
                $tp_about_img_2_url = !empty($settings['tp_about_img_2']['id']) ? wp_get_attachment_image_url( $settings['tp_about_img_2']['id'], $settings['about_thumbnail_size']) : $settings['tp_about_img_2']['url'];
                $tp_about_img_2_alt = get_post_meta($settings["tp_about_img_2"]["id"], "_wp_attachment_image_alt", true);
            }


            // Link
            if ('2' == $settings['tp_about_btn_link_type']) {
                $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_about_btn_page_link']));
                $this->add_render_attribute('tp-button-arg', 'target', '_self');
                $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn-border-8 mb-20 mr-30 tp-el-box-btn');
            } else {
                if ( ! empty( $settings['tp_about_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'tp-button-arg', $settings['tp_about_btn_link'] );
                    $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn-border-8 mb-20 mr-30 tp-el-box-btn');
                }
            }
        ?>
         <!-- about area start -->
         <section id="tpabout" class="about__area black-bg-12 pt-140 tp-el-section">
            <div class="container">
               <div class="row">
                  <div class="col-xxl-6 col-lg-6">
                     <div class="about__thumb-wrapper-8 pr-100 pb-100 p-relative">
                        
                        <?php if(!empty($tp_about_img_url)) : ?>
                        <div class="about__thumb-8 w-img wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s">
                           <img src="<?php echo esc_url($tp_about_img_url); ?>" alt="<?php echo esc_attr($tp_about_img_alt); ?>">
                        </div>
                        <?php endif; ?>

                        <?php if(!empty($settings['tp_about_ex_enable'])) : ?>
                        <div class="about__thumb-8-right wow fadeInUp" data-wow-delay=".6s" data-wow-duration="1s">
                           <div class="about__thumb-bg include-bg" data-background="<?php echo esc_url($tp_about_img_2_url); ?>">
                              <?php echo tp_kses($settings['tp_about_ex_num']); ?>
                           </div>

                           <?php if(!empty($settings['tp_about_ex_text'])) : ?>
                           <div class="about__thumb-8-right-content tp-el-exp-title">
                              <p><?php echo tp_kses($settings['tp_about_ex_text']); ?></p>
                           </div>
                           <?php endif; ?>

                           <?php if(!empty($settings['tp_about_ex_desc'])) : ?>
                           <div class="about__thumb-8-right-year">
                              <p class="tp-el-exp-num"><?php echo tp_kses($settings['tp_about_ex_desc']); ?></p>
                           </div>
                           <?php endif; ?>

                        </div>
                        <?php endif; ?>
                     </div>
                  </div>
                  <div class="col-xxl-6 col-lg-6">
                     <div class="about__wrapper-8 pt-30 pl-70 wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s">
                     <?php if ( !empty($settings['tp_about_section_title_show']) ) : ?>
                        <div class="section__title-wrapper-8 mb-15">

                        <?php if ( !empty($settings['tp_about_sub_title']) ) : ?>
                        <span class="section__title-pre-8 tp-el-subtitle">
                            <?php echo tp_kses( $settings['tp_about_sub_title'] ); ?>
                        </span>
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
                        </div>
                        
                        <?php if ( !empty($settings['tp_about_description']) ) : ?>
                            <p class="about-wrapper-8-paragraph tp-el-desc"><?php echo tp_kses( $settings['tp_about_description'] ); ?></p>
                        <?php endif; ?>

                        <?php endif; ?>

                        <?php if ( !empty($settings['tp_about_desc']) ) : ?>
                        <p class="tp-el-box-desc"><?php echo tp_kses($settings['tp_about_desc']); ?></p>
                        <?php endif; ?>

                        <?php foreach ($settings['tp_about_list'] as $item) : 

                            if($item['about_contact_type'] == 'tel'){
                                $contact_type = 'tel:';
                            }elseif($item['about_contact_type'] == 'mailto'){
                                $contact_type = 'mailto:';
                            }else{
                                $contact_type = '';
                            }
                        ?>
                        <div class="about__call-8 d-flex align-items-center mb-50">
                           <div class="about__call-icon-8 mr-20 tp-el-box-icon">
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
                           <div class="about__call-content-8">
                                <?php if(!empty($item['about_contact_title'])) :?>
                                <h4 class="tp-el-box-title"><?php echo esc_html($item['about_contact_title']); ?></h4>
                                <?php endif; ?>
                              <?php if(!empty($item['about_contact_name'])) :?>
                            <p class="tp-el-box-url"><a href="<?php echo esc_url($contact_type); ?><?php echo esc_attr($item['about_contact_url']['url']); ?>"><?php echo esc_html($item['about_contact_name']); ?></a></p>
                            <?php endif; ?>

                           </div>
                        </div>
                        <?php endforeach; ?>

                        <div class="about__btn-8 d-block d-sm-flex align-items-center">

                           <?php if (!empty($settings['tp_about_btn_text'])) : ?>
                            <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>>
                                <?php echo $settings['tp_about_btn_text']; ?>
                            </a>
                            <?php endif; ?>

                            <?php if(!empty($settings['about_video_url']['url'])) : ?>
                           <a href="<?php echo esc_url($settings['about_video_url']['url']); ?>" class="about-play-btn-2 mb-20 popup-video tp-el-box-video-btn">
                              <span class="tp-el-box-video-icon">
                                 <svg width="13" height="15" viewBox="0 0 13 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13 7.56533L0.146194 14.9831L0.146194 0.147537L13 7.56533Z" fill="currentColor"/>
                                 </svg>                                                                       
                              </span>
                              <?php echo tp_kses($settings['about_video_text']); ?>
                           </a>
                           <?php endif; ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- about area end -->

		<?php else:
			$this->add_render_attribute('title_args', 'class', 'tp-title mb-30 tp-el-title');
            if ( !empty($settings['tp_about_author_signature']['url']) ) {
                $tp_about_author_signature_url = !empty($settings['tp_about_author_signature']['id']) ? wp_get_attachment_image_url( $settings['tp_about_author_signature']['id'], $settings['thumbnail_size']) : $settings['tp_about_author_signature']['url'];
                $tp_about_author_signature_alt = get_post_meta($settings["tp_about_author_signature"]["id"], "_wp_attachment_image_alt", true);
            }  
		?>
            <div class="about__author-wrapper text-center wow fadeInUp tp-el-section" data-wow-delay=".3s" data-wow-duration="1s">

            <?php if(!empty($settings['tp_about_text'])) :?>
                <div class="about__author-text">
                    <p class="tp-el-desc"><?php echo esc_html($settings['tp_about_text']); ?></p>
                </div>
                <?php endif; ?>

                <div class="about__author-info">

                    <?php if(!empty($settings['tp_about_author_title'])): ?>
                    <h3 class="about__author-title-2 tp-el-title"><?php echo tp_kses($settings['tp_about_author_title']); ?></h3>
                    <?php endif; ?>

                    <?php if(!empty($tp_about_author_signature_url)) :?>
                    <div class="about__author-sign">
                        <img src="<?php echo esc_url($tp_about_author_signature_url); ?>" alt="<?php echo esc_attr($tp_about_author_signature_alt); ?>">
                    </div>
                    <?php endif; ?>
                </div>
            </div>

        <?php endif; ?>

        <?php
	}
}

$widgets_manager->register( new TP_About_Info() );
