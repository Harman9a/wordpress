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
class TP_Experience extends Widget_Base {

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
		return 'tp-experience';
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
		return __( 'Experience', 'tpcore' );
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        // Experience group
        $this->start_controls_section(
            'tp_experience',
            [
                'label' => esc_html__('Experience List', 'tpcore'),
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
                    'repeater_condition' => ['style_1', 'style_3'],
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
                    'repeater_condition' => ['style_1', 'style_3'],
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
                    'repeater_condition' => ['style_1', 'style_3'],
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
                        'repeater_condition' => ['style_1', 'style_3'],
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
                        'repeater_condition' => ['style_1', 'style_3'],
                    ]
                ]
            );
        }


        $repeater->add_control(
            'tp_experience_title', [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Experience Title', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_experience_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'UI/UX Web Designer',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_experience_year',
            [
                'label' => esc_html__('Year', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'January 2018 - March 2019',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_experience_link_switcher',
            [
                'label' => esc_html__( 'Add Services link', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'tpcore' ),
                'label_off' => esc_html__( 'No', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'tp_experience_link_type',
            [
                'label' => esc_html__( 'Service Link Type', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'tp_experience_link_switcher' => 'yes'
                ]
            ]
        );
        $repeater->add_control(
            'tp_experience_link',
            [
                'label' => esc_html__( 'Service Link link', 'tpcore' ),
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
                    'tp_experience_link_type' => '1',
                    'tp_experience_link_switcher' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'tp_experience_page_link',
            [
                'label' => esc_html__( 'Select Service Link Page', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_experience_link_type' => '2',
                    'tp_experience_link_switcher' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'enable_style_2',
            [
                'label'        => esc_html__( 'Enable Second Style', 'tpcore' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'tpcore' ),
                'label_off'    => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );

        $this->add_control(
            'enable_style_3',
            [
                'label'        => esc_html__( 'Enable Third Style', 'tpcore' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'tpcore' ),
                'label_off'    => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );
        

        $this->add_control(
        'experience_title',
            [
                'label'       => esc_html__( 'Experince Title', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Experience', 'tpcore' ),
                'placeholder' => esc_html__( 'Placeholder Text', 'tpcore' ),
                'label_block' => true,
                'condition' =>[
                    'enable_style_2' => 'yes',
                ]
            ]
        );

        $this->add_control(
        'experience_title_2',
            [
                'label'       => esc_html__( 'Experince Title', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Experience', 'tpcore' ),
                'placeholder' => esc_html__( 'Placeholder Text', 'tpcore' ),
                'label_block' => true,
                'condition' =>[
                    'enable_style_3' => 'yes',
                ]
            ]
        );




        $this->add_control(
            'tp_experience_list',
            [
                'label' => esc_html__('Experience - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_experience_title' => esc_html__('Business Stratagy', 'tpcore'),
                    ],
                    [
                        'tp_experience_title' => esc_html__('Website Development', 'tpcore')
                    ],
                    [
                        'tp_experience_title' => esc_html__('Marketing & Reporting', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_experience_title }}}',
            ]
        );
        $this->add_responsive_control(
            'tp_experience_align',
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

  

    }

    protected function style_tab_content(){
        $this->tp_section_style_controls('portfolio_section', 'Section - Style', '.tp-el-section');
        $this->tp_section_style_controls('portfolio_box', 'Experience Box', '.tp-el-box');
        $this->tp_basic_style_controls('about_titless', 'Title', '.tp-el-title');
        $this->tp_icon_style('about_icon', 'Experience - Icon', '.tp-el-box-icon span');
        $this->tp_basic_style_controls('about_subtitle', 'Experience - Title', '.tp-el-box-title');
        $this->tp_basic_style_controls('about_title', 'Experience - Description', '.tp-el-box-desc');
        $this->tp_basic_style_controls('about_year', 'Experience - Year', '.tp-el-box-year');
        $this->tp_link_controls_style('coming_input_btn', 'Button', '.tp-el-box-btn');
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

		<?php else:

            $enable_style_2 = ($settings['enable_style_2'] == 'yes') ? 'career__style-2' : '' ;
 
            $enable_style_3 = ( $settings['enable_style_3'] == 'yes') ? 'career__style-2  career__style-3 ' : '' ;

            
            
		?>

            <div class="career__wrapper pl-60 <?php echo esc_attr($enable_style_2); ?> <?php echo esc_attr($enable_style_3); ?> tp-el-section">

                <?php if(!empty($settings['enable_style_2'] == 'yes')) : ?>
                <h4 class="career__title tp-el-title"><?php echo tp_kses($settings['experience_title']); ?></h4>
                <?php endif; ?>

                <?php if(!empty($settings['enable_style_3'] == 'yes')) : ?>
                    <h4 class="career__title tp-el-title"><?php echo tp_kses($settings['experience_title_2']); ?></h4>
                <?php endif; ?>


                <?php foreach ( $settings['tp_experience_list'] as $index => $item ) : 
    
                    // Link
                    if ('2' == $item['tp_experience_link_type']) {
                        $link = get_permalink($item['tp_experience_page_link']);
                        $target = '_self';
                        $rel = 'nofollow';
                    } else {
                        $link = !empty($item['tp_experience_link']['url']) ? $item['tp_experience_link']['url'] : '';
                        $target = !empty($item['tp_experience_link']['is_external']) ? '_blank' : '';
                        $rel = !empty($item['tp_experience_link']['nofollow']) ? 'nofollow' : '';
                    }
     
                ?>
                <div class="career__item transition-3 white-bg d-sm-flex align-items-center justify-content-between wow fadeInUp tp-el-box" data-wow-delay=".3s" data-wow-duration="1s">
                    <div class="career__info d-sm-flex align-items-center">
                        <div class="career__logo mr-20 tp-el-box-icon">
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
    
                        <div class="career__info-content">
                            <?php if(!empty($item['tp_experience_title'])) : ?>
                            <h3 class="career__info-title tp-el-box-title"><?php echo tp_kses($item['tp_experience_title']); ?></h3>
                            <?php endif; ?>
    
                            <?php if(!empty($item['tp_experience_description'])) : ?>
                            <span class="career__info-designation tp-el-box-desc"><?php echo tp_kses($item['tp_experience_description']); ?></span>
                            <?php endif; ?>
                        </div>
    
                    </div>
                    <div class="career__year text-sm-end">
    
                        <?php if (!empty($link)) : ?>
                        <div class="career__btn">
                            <a class="career-link-btn tp-el-box-btn" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>">
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 11L11 1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M1 1H11V11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>                                       
                            </a>
                        </div>
                        <?php endif; ?>
                        
                        <?php if(!empty($item['tp_experience_year'])) : ?>
                        <div class="career__year-info">
                            <p class="tp-el-box-year"><?php echo tp_kses($item['tp_experience_year']); ?></p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

        <?php endif; ?>

        <?php
	}
}

$widgets_manager->register( new TP_Experience() );
