<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use TPCore\Elementor\Controls\Group_Control_TPBGGradient;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Portfolio_Gallery extends Widget_Base {

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
		return 'portfolio-gallery';
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
		return __( 'Portfolio Gallery', 'tpcore' );
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


        // tp_section_title
        $this->start_controls_section(
            'tp_section_title',
            [
                'label' => esc_html__('Title & Content', 'tpcore'),
                'condition' => [
                    'tp_design_style' => ['layout-1', 'layout-3', 'layout-4']
               ]
            ]
        );

        $this->add_control(
            'tp_section_title_show',
            [
                'label' => esc_html__( 'Section Title & Content', 'tpcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tpcore' ),
                'label_off' => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'tp_sub_title',
            [
                'label' => esc_html__('Sub Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('TP Sub Title', 'tpcore'),
                'placeholder' => esc_html__('Type Sub Heading Text', 'tpcore'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'tp_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('TP Title Here', 'tpcore'),
                'placeholder' => esc_html__('Type Heading Text', 'tpcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tp_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('TP section description here', 'tpcore'),
                'placeholder' => esc_html__('Type section description here', 'tpcore'),
            ]
        );

        $this->add_control(
            'tp_title_tag',
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

        $this->add_responsive_control(
            'tp_title_align',
            [
                'label' => esc_html__('Alignment', 'tpcore'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'tpcore'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'tpcore'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'tpcore'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => false,
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};'
                ]
            ]
        );
        $this->end_controls_section();


        $this->start_controls_section(
            '_section_gallery',
            [
                'label' => esc_html__( 'Gallery - Content', 'tpcore' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                
            ]
        );

        $this->add_control(
         'tp_portfolio_shape_switch',
         [
           'label'        => esc_html__( 'Enable Shape', 'tpcore' ),
           'type'         => \Elementor\Controls_Manager::SWITCHER,
           'label_on'     => esc_html__( 'Show', 'tpcore' ),
           'label_off'    => esc_html__( 'Hide', 'tpcore' ),
           'return_value' => 'yes',
           'default'      => 'yes',
           'condition' => [
            'tp_design_style' =>  ['layout-1', 'layout-3', 'layout-4']
        ]
         ]
        );

        $this->add_control(
            'tp_full_box_link_active',
            [
              'label'        => esc_html__( 'Enable Full Box Link ?', 'tpcore' ),
              'type'         => \Elementor\Controls_Manager::SWITCHER,
              'label_on'     => esc_html__( 'Show', 'tpcore' ),
              'label_off'    => esc_html__( 'Hide', 'tpcore' ),
              'return_value' => 'yes',
              'default'      => 'no',
              'condition' => [
                   'tp_design_style' => ['layout-2']
               ]
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
                    'style_3' => __( 'Style 3', 'tpcore' ),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'tp_gallery_column_switch',
            [
                'label' => esc_html__( 'Large Column ?', 'tpcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tpcore' ),
                'label_off' => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );


        $repeater->add_control(
            'images',
            [
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
        'subtitle',
         [
            'label'       => esc_html__( 'Sub Title', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( 'Category Title', 'tpcore' ),
            'placeholder' => esc_html__( 'Your Title', 'tpcore' ),
            'label_block' => true,
             'condition' => [
                'repeater_condition' => ['style_2']
                ]
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'tpcore' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Type gallery title', 'tpcore' ),
                'default' => esc_html__( 'Gallery Title', 'tpcore' ),
            ]
        );        

        $repeater->add_control(
         'description',
         [
           'label'       => esc_html__( 'Description', 'tpcore' ),
           'type'        => \Elementor\Controls_Manager::TEXTAREA,
           'rows'        => 10,
           'default'     => esc_html__( 'If you are going to use a passage of Lorem Ipsum, you need to be sure there is anything embarrassing hidden in the middle of text', 'tpcore' ),
           'placeholder' => esc_html__( 'Type description here', 'tpcore' ),
           'condition' => [
                'repeater_condition' => 'style_2'
           ]

         ]
        );
        $repeater->add_control(
            'filter',
            [
                'label' => esc_html__( 'Filter Name (Category)', 'tpcore' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Type gallery filter name', 'tpcore' ),
                'description' => esc_html__( 'Filter name will be used in filter menu. Added more category by , separator.', 'tpcore' ),
                'default' => esc_html__( 'Filter Name', 'tpcore' ),
            ]
        );

        $repeater->add_control(
         'tp_portfolio_video_switch',
            [
            'label'        => esc_html__( 'Add video ?', 'tpcore' ),
            'type'         => \Elementor\Controls_Manager::SWITCHER,
            'label_on'     => esc_html__( 'Show', 'tpcore' ),
            'label_off'    => esc_html__( 'Hide', 'tpcore' ),
            'return_value' => 'yes',
            'default'      => 'no',
            'condition' => [
                'repeater_condition' => ['style_1', 'style_3']
                ]
            ]
        );

        $repeater->add_control(
            'tp_portfolio_video_url',
            [
            'label'   => esc_html__( 'Video URL', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::URL,
            'default'     => [
                'url'               => '#',
                'is_external'       => true,
                'nofollow'          => true,
                'custom_attributes' => '',
                ],
                'placeholder' => esc_html__( 'your url', 'tpcore' ),
                'label_block' => true,
                'condition' => [
                    'tp_portfolio_video_switch' => 'yes',
                    'repeater_condition' => ['style_1', 'style_3']
                ]
            ]
        );

        $repeater->add_control(
            'tp_services_link_switcher',
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
            'tp_services_btn_text',
            [
                'label' => esc_html__('Button Text', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'tpcore'),
                'title' => esc_html__('Enter button text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_services_link_switcher' => 'yes',
                    'repeater_condition' => 'style_1'
                ],
            ]
        );
        $repeater->add_control(
            'tp_services_link_type',
            [
                'label' => esc_html__( 'Service Link Type', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'tp_services_link_switcher' => 'yes'
                ]
            ]
        );
        $repeater->add_control(
            'tp_services_link',
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
                    'tp_services_link_type' => '1',
                    'tp_services_link_switcher' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'tp_services_page_link',
            [
                'label' => esc_html__( 'Select Service Link Page', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_services_link_type' => '2',
                    'tp_services_link_switcher' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'gallery',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'show_label' => false,
                'title_field' => sprintf( esc_html__( 'Filter Group: %1$s', 'tpcore' ), '{{filter}}' ),
                'default' => [
                    [
                        'images' => Utils::get_placeholder_image_src(),
                        'filter' => esc_html__( 'Web Design', 'tpcore' ),
                        'title' => esc_html__( 'Ecommerce Product Apps', 'tpcore' ),

                    ],
                    [
                        'images' => Utils::get_placeholder_image_src(),
                        'filter' => esc_html__( 'Logo Design', 'tpcore' ),
                        'title' => esc_html__( 'Cryptocurrency web Application', 'tpcore' ),

                    ],
                    [
                        'images' => Utils::get_placeholder_image_src(),
                        'filter' => esc_html__( 'Mobile App', 'tpcore' ),
                        'title' => esc_html__( 'Making 3d Illustration', 'tpcore' ),

                    ],
                    [
                        'images' => Utils::get_placeholder_image_src(),
                        'filter' => esc_html__( 'Ui/Kit', 'tpcore' ),
                        'title' => esc_html__( 'Hilon - Personal Portfolio', 'tpcore' ),

                    ]
                ]
            ]
        );

        $this->add_control(
            'title_tag',
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
                'default' => 'h4',
                'toggle' => false,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'gallery_thumbnail',
                'default' => 'tp-gallery-thumb',
                'separator' => 'before',
                'exclude' => [
                    'custom'
                ]
            ]
        );
        $this->add_control(
            'show_filter',
            [
                'label' => esc_html__( 'Show Filter', 'tpcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'tpcore' ),
                'label_off' => esc_html__( 'No', 'tpcore' ),
                'separator' => 'before',
                'return_value' => 'yes',
                'default' => 'yes'
            ]
        );
        $this->add_control(
            'show_all_filter',
            [
                'label' => esc_html__( 'Show "All Project" Filter?', 'tpcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'tpcore' ),
                'label_off' => esc_html__( 'No', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'description' => esc_html__( 'Enable to display "All Project" filter in filter menu.', 'tpcore' ),
                'condition' => [
                    'show_filter' => 'yes'
                ],
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'all_filter_label',
            [
                'label' => esc_html__( 'Filter Label', 'tpcore' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'All Project', 'tpcore' ),
                'placeholder' => esc_html__( 'Type filter label', 'tpcore' ),
                'description' => esc_html__( 'Type "All Project" filter label.', 'tpcore' ),
                'condition' => [
                    'show_all_filter' => 'yes',
                    'show_filter' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();

        // tp_btn_button_group
        $this->tp_button_render('portfolio_view_all', 'Portfolio More Button', ['layout-1', 'layout-3', 'layout-4'] );

	}

            // style_tab_content
    protected function style_tab_content(){
      

        $this->tp_section_style_controls('services_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('services_subtitle', 'Section - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('services_title', 'Section - Title', '.tp-el-title');
        $this->tp_basic_style_controls('services_description', 'Section - Description', '.tp-el-content p');
        
        $this->tp_section_style_controls('services_section_box', 'Box - Style', '.tp-el-box');
        $this->tp_basic_style_controls('history_title', 'Portfolio - Title', '.tp-el-box-title');
        $this->tp_basic_style_controls('history_desc', 'Portfolio - Description', '.tp-el-box-desc');
        $this->tp_link_controls_style('history_tag', 'Portfolio - Tag', '.tp-el-box-tag span');
        $this->tp_link_controls_style('services_box_link_btn', 'Portfolio - Button', '.tp-el-box-btn');
        $this->tp_link_controls_style('services_box_link_btn_plus', 'Portfolio - Plus', '.tp-el-box-plus');
        $this->tp_link_controls_style('services_box_link_video', 'Portfolio - Video - Button', '.tp-el-video-btn');

        $this->tp_link_controls_style('portfolio_box_masonary_btn', 'Masonary - Button', '.tp-el-mas-btn button');
        $this->tp_link_controls_style('portfolio_box_masonary_btn_active', 'Masonary - Button Active', '.tp-el-mas-btn button.active');

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


        if ( empty( $settings['gallery'] ) ) {
            return;
        }


        $categories = array();
        $cats = array();
        foreach ($settings['gallery'] as $index => $gallery) :

            $cats = explode(",", $gallery['filter']);
            
            foreach ($cats as $i => $cat){
                $categories[tp_slugify( $cat )] = $cat;
            }

        endforeach;

       

		?>


        <!--    portfolio style 2 -->
        <?php if ( $settings['tp_design_style']  == 'layout-2' ): 
            $this->add_render_attribute('title_args', 'class', 'portfolio__title tp-el-box-title');
        ?>


         <!-- portfolio area start -->
         <section class="portfolio__area pt-60 pb-110 tp-el-section">
            <div class="container">
               <div class="row">
                  <div class="col-xxl-12">
                     <div class="portfolio__masonary-btn-2 text-center mb-50">
                        <div class="masonary-menu filter-button-group tp-el-mas-btn">
                            <?php if ( $settings['show_all_filter'] === 'yes' ) : ?>
                                <button data-filter="*" class="active tp-el-mas-btn"><?php echo esc_html( $settings['all_filter_label'] ); ?></button>
                            <?php endif; ?>

                            <?php foreach ( $categories as $key => $val ) :?> 
                              <button data-filter=".<?php echo esc_attr($key); ?>"><?php echo esc_html( $val ); ?></button>
                            <?php endforeach;?>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row gx-2 grid">
               <?php
                    $cars = array();
                    foreach ($settings['gallery'] as $index => $gallery) :
                        $cars = explode(",",  $gallery['filter']);
                        $big_image  = (!empty(wp_get_attachment_image_url( $gallery['images']['id'], 'full'))) ? wp_get_attachment_image_url( $gallery['images']['id'], 'full') : Utils::get_placeholder_image_src();

                        // Link
                        if ('2' == $gallery['tp_services_link_type']) {
                            $link = get_permalink($gallery['tp_services_page_link']);
                            $target = '_self';
                            $rel = 'nofollow';
                        } else {
                            $link = !empty($gallery['tp_services_link']['url']) ? $gallery['tp_services_link']['url'] : '';
                            $target = !empty($gallery['tp_services_link']['is_external']) ? '_blank' : '';
                            $rel = !empty($gallery['tp_services_link']['nofollow']) ? 'nofollow' : '';
                        }

                        $gallery_columns = $gallery['tp_gallery_column_switch'] == 'yes' ? '6' : '4';

                        $item_classes = strtolower(implode( ' ', $cars));
                    ?>

                    

                    <?php if($settings['tp_full_box_link_active'] == 'yes') : ?>
                  <div class="col-xl-<?php echo esc_attr($gallery_columns); ?> col-lg-4 col-md-6 tp-portfolio grid-item <?php echo esc_attr($item_classes); ?>">
                        <a href="<?php echo esc_url($link); ?>">
                     <div class="portfolio__item mb-8 fix transition-3 tp-el-box">
                        <div class="portfolio__thumb include-bg" data-background="<?php echo esc_attr($big_image); ?>"></div>
                        <div class="portfolio__content">
                           <?php if(!empty($gallery['subtitle'])) : ?>
                                <div class="portfolio__tag tp-el-box-tag">
                                    <span><?php echo esc_html($gallery['subtitle']); ?></span>
                                </div>
                                <?php endif; ?>

                           <?php
                            if ( !empty($gallery['title']) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['title_tag'] ),
                                    $this->get_render_attribute_string( 'title_args' ),
                                    tp_kses( $gallery['title' ] ),
                                    );
                            endif;
                            ?>
                        </div>

                        <?php if(!empty($gallery['description'])) : ?>
                               
                        <div class="portfolio__text">
                           <p class="tp-el-box-desc"><?php echo esc_html($gallery['description']); ?></p>
                        </div>
                        <?php endif; ?>
                     </div>
                     </a>
                  </div>
                  <?php else : ?>
                  <div class="col-xl-<?php echo esc_attr($gallery_columns); ?> col-lg-4 col-md-6 tp-portfolio grid-item <?php echo esc_attr($item_classes); ?>">
                     <div class="portfolio__item mb-8 fix transition-3 tp-el-box">
                        <div class="portfolio__thumb include-bg" data-background="<?php echo esc_attr($big_image); ?>"></div>
                        <div class="portfolio__content">
                           <?php if(!empty($gallery['subtitle'])) : ?>
                                <div class="portfolio__tag tp-el-box-tag">
                                    <span><?php echo esc_html($gallery['subtitle']); ?></span>
                                </div>
                                <?php endif; ?>

                           <?php
                            if ( !empty($gallery['title']) ) :
                                printf( '<%1$s %2$s><a href="%4$s">%3$s</a></%1$s>',
                                    tag_escape( $settings['title_tag'] ),
                                    $this->get_render_attribute_string( 'title_args' ),
                                    tp_kses( $gallery['title' ] ),
                                    esc_url($link)
                                    );
                            endif;
                            ?>
                        </div>

                        <?php if(!empty($gallery['description'])) : ?>
                               
                        <div class="portfolio__text">
                           <p class="tp-el-box-desc"><?php echo esc_html($gallery['description']); ?></p>
                        </div>
                        <?php endif; ?>
                     </div>
                  </div>
                  <?php endif; ?>
                  <?php endforeach; ?>
               </div>
            </div>
         </section>
         <!-- portfolio area end -->


        <!--    portfolio style 3 -->
        <?php elseif ( $settings['tp_design_style']  == 'layout-3' ): 
            $bloginfo = get_bloginfo( 'name' ); 
            $this->add_render_attribute('title', 'class', 'portfolio__section-title tp-el-title');

            // Link
            if ('2' == $settings['tp_portfolio_view_all_btn_link_type']) {
                $link3 = get_permalink($settings['tp_portfolio_view_all_btn_page_link']);
                $target3 = '_self';
                $rel3 = 'nofollow';
            } else {
                $link3 = !empty($settings['tp_portfolio_view_all_btn_link']['url']) ? $settings['tp_portfolio_view_all_btn_link']['url'] : '';
                $target3 = !empty($settings['tp_portfolio_view_all_btn_link']['is_external']) ? '_blank' : '';
                $rel3 = !empty($settings['tp_portfolio_view_all_btn_link']['nofollow']) ? 'nofollow' : '';
            }
        ?>

         <!-- portfolio area start -->
         <section class="portfolio__area pt-110 pb-80 p-relative fix tp-el-section">
         <?php if(!empty($settings['tp_portfolio_shape_switch'])) : ?>
            <div class="portfolio__shape">
               <img class="portfolio__shape-13" src="<?php echo get_template_directory_uri() . '/assets/img/portfolio/grid/shape/circle-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="portfolio__shape-14" src="<?php echo get_template_directory_uri() . '/assets/img/portfolio/grid/shape/circle-2.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="portfolio__shape-15" src="<?php echo get_template_directory_uri() . '/assets/img/portfolio/grid/shape/circle-sm.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="portfolio__shape-16" src="<?php echo get_template_directory_uri() . '/assets/img/portfolio/grid/shape/polygon-yellow.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="portfolio__shape-17" src="<?php echo get_template_directory_uri() . '/assets/img/portfolio/grid/shape/polygon-pink.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="portfolio__shape-18" src="<?php echo get_template_directory_uri() . '/assets/img/portfolio/grid/shape/polygon-green.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="portfolio__shape-19" src="<?php echo get_template_directory_uri() . '/assets/img/portfolio/grid/shape/polygon-green-2.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
            </div>
            <?php endif; ?>
            <div class="container">

                <!-- section title -->
               <div class="row">
                  <div class="col-xl-12">
                     <div class="portfolio__section-title-wrapper text-center mb-90">

                        <?php if ( !empty($settings['tp_sub_title']) ) : ?>
                        <span class="portfolio__section-title-pre tp-el-subtitle"><?php echo tp_kses( $settings['tp_sub_title'] ); ?></span>
                        <?php endif; ?>


                        <?php
                            if ( !empty($settings['tp_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['tp_title_tag'] ),
                                    $this->get_render_attribute_string( 'title' ),
                                    tp_kses( $settings['tp_title' ] )
                                    );
                            endif;
                        ?>

                        <?php if ( !empty($settings['tp_description']) ) : ?>
                            <p><?php echo tp_kses( $settings['tp_description'] ); ?></p>
                        <?php endif; ?>
                     </div>
                  </div>
               </div>

                <!-- filter button -->
                <?php  if(!empty($settings['show_filter'])) :?>
                <div class="row">
                    <div class="col-xxl-12">
                        <div class="portfolio__masonary-btn text-center mb-40">
                            <div class="masonary-menu filter-button-group tp-el-mas-btn">

                                <?php if ( $settings['show_all_filter'] === 'yes' ) : ?>
                                    <button data-filter="*" class="active tp-el-mas-btn">
                                        <?php echo esc_html( $settings['all_filter_label'] ); ?> 
                                    </button>
                                <?php endif; ?>

                                <?php foreach ( $categories as $key => $val ) :?> 
                                <button data-filter=".<?php echo esc_attr($key); ?>">
                                <?php echo esc_html( $val ); ?> 
                                    </button>
                                <?php endforeach;?>
                                

                            </div>
                        </div>
                    </div>
                </div>
               <?php endif; ?>
               <div class="row tp-gx-4 grid">
               <?php
                    $cars = array();
                    foreach ($settings['gallery'] as $index => $gallery) :
                        $cars = explode(",",  $gallery['filter']);
                        $big_image  = (!empty(wp_get_attachment_image_url( $gallery['images']['id'], 'full'))) ? wp_get_attachment_image_url( $gallery['images']['id'], 'full') : Utils::get_placeholder_image_src();

                        // Link
                        if ('2' == $gallery['tp_services_link_type']) {
                            $link = get_permalink($gallery['tp_services_page_link']);
                            $target = '_self';
                            $rel = 'nofollow';
                        } else {
                            $link = !empty($gallery['tp_services_link']['url']) ? $gallery['tp_services_link']['url'] : '';
                            $target = !empty($gallery['tp_services_link']['is_external']) ? '_blank' : '';
                            $rel = !empty($gallery['tp_services_link']['nofollow']) ? 'nofollow' : '';
                        }

                        $gallery_columns = $gallery['tp_gallery_column_switch'] == 'yes' ? '6' : '4';

                        $item_classes = strtolower(implode( ' ', $cars));
                    ?>

                    
                  <div class="col-xl-<?php echo esc_attr($gallery_columns); ?> col-lg-4 col-md-6 tp-portfolio grid-item <?php echo esc_attr($item_classes); ?>">
                     <div class="portfolio__grid-item mb-40 tp-el-box">
                        <div class="portfolio__grid-thumb w-img fix tp-img-reveal tp-img-reveal-item" data-fx="24" data-meta-tag="<?php echo esc_html($gallery['filter']); ?>" data-title="<?php echo tp_kses($gallery['title']);?>">
                           <a href="<?php echo esc_url($link); ?>">
                                <?php if(!empty(wp_get_attachment_image( $gallery['images']['id']))) : ?>
                                    <?php echo wp_get_attachment_image( $gallery['images']['id'], $settings['gallery_thumbnail_size'] ); ?>
                                <?php else:  ?>
                                    <?php echo Group_Control_Image_Size::get_attachment_image_html($gallery, 'full', 'images') ?>
                                <?php endif; ?>
                           </a>

                           <?php if($gallery['tp_portfolio_video_switch'] == 'yes') : ?>
                           <div class="portfolio__grid-video">
                              <a href="<?php echo esc_url($gallery['tp_portfolio_video_url']['url']); ?>" class="portfolio-play-btn popup-video tp-el-video-btn">
                                 <svg width="18" height="22" viewBox="0 0 18 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M18 11L0 21.3923V0.607696L18 11Z" fill="currentColor"/>
                                 </svg>                                    
                              </a>
                           </div>
                           <?php endif; ?>
                        </div>
                     </div>
                  </div>
                  <?php endforeach; ?>
               </div>
               
               <?php if(!empty($settings['tp_portfolio_view_all_btn_switcher'])) :?>
               <div class="row">
                  <div class="col-xxl-12">
                     <div class="portfolio__load-more text-center">
                        <a target="<?php echo esc_attr($target3); ?>" rel="<?php echo esc_attr($rel3); ?>" href="<?php echo esc_url($link3); ?>" class="tp-load-more-btn mt-30 mb-50 tp-el-btn">
                           <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M1 8.5C1 4.36 4.33 1 8.5 1C13.5025 1 16 5.17 16 5.17M16 5.17V1.42M16 5.17H12.67" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M15.9175 8.5C15.9175 12.64 12.5575 16 8.4175 16C4.2775 16 1.75 11.83 1.75 11.83M1.75 11.83H5.14M1.75 11.83V15.58" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                           </svg>                              
                           <?php echo tp_kses($settings['tp_portfolio_view_all_btn_text']); ?>
                        </a>
                     </div>
                  </div>
               </div>
               <?php endif; ?>           
            </div>
         </section>
         <!-- portfolio area end -->

            <!--    portfolio style 4 -->
            <?php elseif ( $settings['tp_design_style']  == 'layout-4' ): 
                $bloginfo = get_bloginfo( 'name' ); 
                $this->add_render_attribute('title', 'class', 'portfolio__section-title tp-el-title');

                // Link
                if ('2' == $settings['tp_portfolio_view_all_btn_link_type']) {
                    $link3 = get_permalink($settings['tp_portfolio_view_all_btn_page_link']);
                    $target3 = '_self';
                    $rel3 = 'nofollow';
                } else {
                    $link3 = !empty($settings['tp_portfolio_view_all_btn_link']['url']) ? $settings['tp_portfolio_view_all_btn_link']['url'] : '';
                    $target3 = !empty($settings['tp_portfolio_view_all_btn_link']['is_external']) ? '_blank' : '';
                    $rel3 = !empty($settings['tp_portfolio_view_all_btn_link']['nofollow']) ? 'nofollow' : '';
                }
            ?>

         <!-- portfolio area start -->
         <section class="portfolio__area pb-75 pt-110 p-relative fix tp-el-section">
         <?php if(!empty($settings['tp_portfolio_shape_switch'])) : ?>
            <div class="portfolio__shape">
               <img class="portfolio__shape-20" src="<?php echo get_template_directory_uri() . '/assets/img/portfolio/masonary/shape/circle-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="portfolio__shape-21" src="<?php echo get_template_directory_uri() . '/assets/img/portfolio/masonary/shape/polygon-green.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="portfolio__shape-22" src="<?php echo get_template_directory_uri() . '/assets/img/portfolio/masonary/shape/polygon-pink.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="portfolio__shape-23" src="<?php echo get_template_directory_uri() . '/assets/img/portfolio/masonary/shape/polygon-yellow.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
            </div>
            <?php endif; ?>
            <div class="container-fluid tp-gx-20">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="portfolio__section-title-wrapper text-center mb-90 tp-el-content">
                        <?php if ( !empty($settings['tp_sub_title']) ) : ?>
                        <span class="portfolio__section-title-pre tp-el-subtitle"><?php echo tp_kses( $settings['tp_sub_title'] ); ?></span>
                        <?php endif; ?>


                        <?php
                            if ( !empty($settings['tp_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['tp_title_tag'] ),
                                    $this->get_render_attribute_string( 'title' ),
                                    tp_kses( $settings['tp_title' ] )
                                    );
                            endif;
                        ?>

                        <?php if ( !empty($settings['tp_description']) ) : ?>
                            <p><?php echo tp_kses( $settings['tp_description'] ); ?></p>
                        <?php endif; ?>
                     </div>
                  </div>
               </div>

                <!-- filter button -->
                <?php  if(!empty($settings['show_filter'])) :?>
                <div class="row">
                    <div class="col-xxl-12">
                        <div class="portfolio__masonary-btn text-center mb-40">
                            <div class="masonary-menu filter-button-group tp-el-mas-btn">

                                <?php if ( $settings['show_all_filter'] === 'yes' ) : ?>
                                    <button data-filter="*" class="active tp-el-mas-btn">
                                        <?php echo esc_html( $settings['all_filter_label'] ); ?> 
                                    </button>
                                <?php endif; ?>

                                <?php foreach ( $categories as $key => $val ) :?> 
                                <button data-filter=".<?php echo esc_attr($key); ?>">
                                <?php echo esc_html( $val ); ?> 
                                    </button>
                                <?php endforeach;?>
 
                            </div>
                        </div>
                    </div>
                </div>
               <?php endif; ?>
               <div class="row tp-gx-20 grid">
               <?php
                    $cars = array();
                    foreach ($settings['gallery'] as $index => $gallery) :
                        $cars = explode(",",  $gallery['filter']);
                        $big_image  = (!empty(wp_get_attachment_image_url( $gallery['images']['id'], 'full'))) ? wp_get_attachment_image_url( $gallery['images']['id'], 'full') : Utils::get_placeholder_image_src();

                        // Link
                        if ('2' == $gallery['tp_services_link_type']) {
                            $link = get_permalink($gallery['tp_services_page_link']);
                            $target = '_self';
                            $rel = 'nofollow';
                        } else {
                            $link = !empty($gallery['tp_services_link']['url']) ? $gallery['tp_services_link']['url'] : '';
                            $target = !empty($gallery['tp_services_link']['is_external']) ? '_blank' : '';
                            $rel = !empty($gallery['tp_services_link']['nofollow']) ? 'nofollow' : '';
                        }

                        $gallery_columns = $gallery['tp_gallery_column_switch'] == 'yes' ? '6' : '3';

                        $item_classes = strtolower(implode( ' ', $cars));
                    ?>

                    
                  <div class="col-xl-<?php echo esc_attr($gallery_columns); ?> col-lg-4 col-md-6 grid-item <?php echo esc_attr($item_classes); ?>">
                     <div class="portfolio__grid-item mb-20 tp-el-box">
                        <div class="portfolio__grid-thumb tp-protfolio-masonary w-img fix tp-img-reveal tp-img-reveal-item" data-fx="24" data-meta-tag="<?php echo esc_html($gallery['filter']); ?>" data-title="<?php echo tp_kses($gallery['title']);?>">
                            <a href="<?php echo esc_url($link); ?>">
                                    <?php if(!empty(wp_get_attachment_image( $gallery['images']['id']))) : ?>
                                        <?php echo wp_get_attachment_image( $gallery['images']['id'], $settings['gallery_thumbnail_size'] ); ?>
                                    <?php else:  ?>
                                        <?php echo Group_Control_Image_Size::get_attachment_image_html($gallery, 'full', 'images') ?>
                                    <?php endif; ?>
                            </a>

                            <?php if($gallery['tp_portfolio_video_switch'] == 'yes') : ?>
                            <div class="portfolio__grid-video">
                                <a href="<?php echo esc_url($gallery['tp_portfolio_video_url']['url']); ?>" class="portfolio-play-btn popup-video tp-el-video-btn">
                                    <svg width="18" height="22" viewBox="0 0 18 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M18 11L0 21.3923V0.607696L18 11Z" fill="currentColor"/>
                                    </svg>                                    
                                </a>
                            </div>
                            <?php endif; ?>
                        </div>
                     </div>
                  </div>
                  <?php endforeach; ?>
               </div>

               <?php if(!empty($settings['tp_portfolio_view_all_btn_switcher'])) :?>
               <div class="row">
                  <div class="col-xxl-12">
                     <div class="portfolio__load-more text-center">
                        <a target="<?php echo esc_attr($target3); ?>" rel="<?php echo esc_attr($rel3); ?>" href="<?php echo esc_url($link3); ?>" class="tp-load-more-btn mt-30 mb-50 tp-el-box-btn">
                           <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M1 8.5C1 4.36 4.33 1 8.5 1C13.5025 1 16 5.17 16 5.17M16 5.17V1.42M16 5.17H12.67" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M15.9175 8.5C15.9175 12.64 12.5575 16 8.4175 16C4.2775 16 1.75 11.83 1.75 11.83M1.75 11.83H5.14M1.75 11.83V15.58" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                           </svg>                              
                           <?php echo tp_kses($settings['tp_portfolio_view_all_btn_text']); ?>
                        </a>
                     </div>
                  </div>
               </div>
               <?php endif; ?>   
            </div>
         </section>
         <!-- portfolio area end -->

        <!-- default style -->
        <?php else:
            $this->add_render_attribute('title', 'class', 'portfolio__section-title tp-el-title');

            $this->add_render_attribute('title_args', 'class', 'portfolio__grid-title tp-el-box-title');
            $bloginfo = get_bloginfo( 'name' ); 

            // Link
            if ('2' == $settings['tp_portfolio_view_all_btn_link_type']) {
                $link3 = get_permalink($settings['tp_portfolio_view_all_btn_page_link']);
                $target3 = '_self';
                $rel3 = 'nofollow';
            } else {
                $link3 = !empty($settings['tp_portfolio_view_all_btn_link']['url']) ? $settings['tp_portfolio_view_all_btn_link']['url'] : '';
                $target3 = !empty($settings['tp_portfolio_view_all_btn_link']['is_external']) ? '_blank' : '';
                $rel3 = !empty($settings['tp_portfolio_view_all_btn_link']['nofollow']) ? 'nofollow' : '';
            }

            
        ?>



         <!-- portfolio area start -->
         <section class="portfolio__area pt-110 pb-75 p-relative fix tp-el-section">
         <?php if(!empty($settings['tp_portfolio_shape_switch'])) : ?>
            <div class="portfolio__shape">
               <img class="portfolio__shape-13" src="<?php echo get_template_directory_uri() . '/assets/img/portfolio/grid/shape/circle-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="portfolio__shape-14" src="<?php echo get_template_directory_uri() . '/assets/img/portfolio/grid/shape/circle-2.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="portfolio__shape-15" src="<?php echo get_template_directory_uri() . '/assets/img/portfolio/grid/shape/circle-sm.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="portfolio__shape-16" src="<?php echo get_template_directory_uri() . '/assets/img/portfolio/grid/shape/polygon-yellow.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="portfolio__shape-17" src="<?php echo get_template_directory_uri() . '/assets/img/portfolio/grid/shape/polygon-pink.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="portfolio__shape-18" src="<?php echo get_template_directory_uri() . '/assets/img/portfolio/grid/shape/polygon-green.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="portfolio__shape-19" src="<?php echo get_template_directory_uri() . '/assets/img/portfolio/grid/shape/polygon-green-2.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
            </div>
            <?php endif; ?>

            <!-- section title -->
            <div class="container">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="portfolio__section-title-wrapper text-center mb-90 tp-el-content">
                        <?php if ( !empty($settings['tp_sub_title']) ) : ?>
                        <span class="portfolio__section-title-pre tp-el-subtitle"><?php echo tp_kses( $settings['tp_sub_title'] ); ?></span>
                        <?php endif; ?>


                        <?php
                            if ( !empty($settings['tp_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['tp_title_tag'] ),
                                    $this->get_render_attribute_string( 'title' ),
                                    tp_kses( $settings['tp_title' ] )
                                    );
                            endif;
                        ?>

                        <?php if ( !empty($settings['tp_description']) ) : ?>
                            <p><?php echo tp_kses( $settings['tp_description'] ); ?></p>
                        <?php endif; ?>
                     </div>
                  </div>
               </div>

               <!-- filter button -->
               <?php  if(!empty($settings['show_filter'])) :?>
               <div class="row">
                  <div class="col-xxl-12">
                     <div class="portfolio__masonary-btn text-center mb-40">
                           <div class="masonary-menu filter-button-group tp-el-mas-btn">

                            <?php if ( $settings['show_all_filter'] === 'yes' ) : ?>
                                <button data-filter="*" class="active tp-el-mas-btn">
                                    <?php echo esc_html( $settings['all_filter_label'] ); ?> 
                                </button>
                            <?php endif; ?>

                            <?php foreach ( $categories as $key => $val ) :?> 
                              <button data-filter=".<?php echo esc_attr($key); ?>">
                              <?php echo esc_html( $val ); ?> 
                                </button>
                              <?php endforeach;?>
                              

                           </div>
                     </div>
                  </div>
               </div>
               <?php endif; ?>

               <!-- filter item start -->
               <div class="row tp-gx-4 grid">
               <?php
                    $cars = array();
                    foreach ($settings['gallery'] as $index => $gallery) :
                        $cars = explode(",",  $gallery['filter']);
                        $big_image  = (!empty(wp_get_attachment_image_url( $gallery['images']['id'], 'full'))) ? wp_get_attachment_image_url( $gallery['images']['id'], 'full') : Utils::get_placeholder_image_src();

                        // Link
                        if ('2' == $gallery['tp_services_link_type']) {
                            $link = get_permalink($gallery['tp_services_page_link']);
                            $target = '_self';
                            $rel = 'nofollow';
                        } else {
                            $link = !empty($gallery['tp_services_link']['url']) ? $gallery['tp_services_link']['url'] : '';
                            $target = !empty($gallery['tp_services_link']['is_external']) ? '_blank' : '';
                            $rel = !empty($gallery['tp_services_link']['nofollow']) ? 'nofollow' : '';
                        }

                        

                        $gallery_columns = $gallery['tp_gallery_column_switch'] == 'yes' ? '6' : '4';

                        $item_classes = strtolower(implode( ' ', $cars));
                    ?>
                  <div class="col-xl-<?php echo esc_attr($gallery_columns); ?> col-lg-4 col-md-6 tp-portfolio grid-item <?php echo esc_attr($item_classes); ?>">
                     <div class="portfolio__grid-item mb-40 tp-el-box">
                        <div class="portfolio__grid-thumb w-img fix">
                            <a href="<?php echo esc_url($link); ?>">
                                <?php if(!empty(wp_get_attachment_image( $gallery['images']['id']))) : ?>
                                    <?php echo wp_get_attachment_image( $gallery['images']['id'], $settings['gallery_thumbnail_size'] ); ?>
                                <?php else:  ?>
                                    <?php echo Group_Control_Image_Size::get_attachment_image_html($gallery, 'full', 'images') ?>
                                <?php endif; ?>
                           </a>

                            <?php if($gallery['tp_portfolio_video_switch'] == 'yes') : ?>
                            <div class="portfolio__grid-video">
                                <a href="<?php echo esc_url($gallery['tp_portfolio_video_url']['url']); ?>" class="portfolio-play-btn popup-video tp-el-video-btn">
                                    <svg width="18" height="22" viewBox="0 0 18 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M18 11L0 21.3923V0.607696L18 11Z" fill="currentColor"/>
                                    </svg>                                    
                                </a>
                           </div>
                           <?php else : ?>
                            <div class="portfolio__grid-popup">
                              <a href="<?php echo wp_get_attachment_image_url( $gallery['images']['id'], 'full'); ?>" class="popup-image tp-el-box-plus">
                                 <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14.1667 8.33341H0.833333C0.377778 8.33341 0 7.95564 0 7.50008C0 7.04453 0.377778 6.66675 0.833333 6.66675H14.1667C14.6222 6.66675 15 7.04453 15 7.50008C15 7.95564 14.6222 8.33341 14.1667 8.33341Z" fill="currentColor"/>
                                    <path d="M7.4974 15C7.04184 15 6.66406 14.6222 6.66406 14.1667V0.833333C6.66406 0.377778 7.04184 0 7.4974 0C7.95295 0 8.33073 0.377778 8.33073 0.833333V14.1667C8.33073 14.6222 7.95295 15 7.4974 15Z" fill="currentColor"/>
                                 </svg>                                    
                              </a>
                           </div>
                           <?php endif; ?>
                        </div>
                        <div class="portfolio__grid-content">
                           <?php
                            if ( !empty($gallery['title']) ) :
                                printf( '<%1$s %2$s><a href="%4$s">%3$s</a></%1$s>',
                                    tag_escape( $settings['title_tag'] ),
                                    $this->get_render_attribute_string( 'title_args' ),
                                    tp_kses( $gallery['title' ] ),
                                    esc_url($link)
                                    );
                            endif;
                            ?>
                           <div class="portfolio__grid-bottom">
                               <?php if(!empty($gallery['filter'])) : ?>
                                <div class="portfolio__grid-category tp-el-box-tag">
                                    <span><?php echo esc_html($gallery['filter']); ?></span>
                                </div>
                                <?php endif; ?>

                                <?php if (!empty($link)) : ?>
                                <div class="portfolio__grid-show-project">
                                    <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>" class="portfolio-link-btn tp-el-box-btn">
                                        <?php echo tp_kses($gallery['tp_services_btn_text']); ?>
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
                     </div>
                  </div>
                  <?php endforeach; ?>
               </div>

               <?php if(!empty($settings['tp_portfolio_view_all_btn_switcher'])) :?>
               <div class="row">
                  <div class="col-xxl-12">
                     <div class="portfolio__load-more text-center">
                        <a target="<?php echo esc_attr($target3); ?>" rel="<?php echo esc_attr($rel3); ?>" href="<?php echo esc_url($link3); ?>" class="tp-load-more-btn mt-30 mb-50">
                           <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M1 8.5C1 4.36 4.33 1 8.5 1C13.5025 1 16 5.17 16 5.17M16 5.17V1.42M16 5.17H12.67" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M15.9175 8.5C15.9175 12.64 12.5575 16 8.4175 16C4.2775 16 1.75 11.83 1.75 11.83M1.75 11.83H5.14M1.75 11.83V15.58" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                           </svg>                              
                           <?php echo tp_kses($settings['tp_portfolio_view_all_btn_text']); ?>
                        </a>
                     </div>
                  </div>
               </div>
               <?php endif; ?>
              
            </div>
         </section>
         <!-- portfolio area end -->
         <?php endif; ?>

		<?php
	}


}

$widgets_manager->register( new TP_Portfolio_Gallery() );