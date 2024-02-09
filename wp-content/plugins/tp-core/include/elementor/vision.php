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
class TP_Vision_Tab extends Widget_Base {

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
		return 'vision-tab';
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
		return __( 'Vision Tab', 'tp-core' );
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
		return [ 'tp-core' ];
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
		return [ 'tp-core' ];
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

        $this->add_control(
         'enable_style_2',
         [
           'label'        => esc_html__( 'Enable Style 2', 'tpcore' ),
           'type'         => \Elementor\Controls_Manager::SWITCHER,
           'label_on'     => esc_html__( 'Show', 'tpcore' ),
           'label_off'    => esc_html__( 'Hide', 'tpcore' ),
           'return_value' => 'yes',
           'default'      => 'no',
           'condition' => [
            'tp_design_style' => 'layout-1'
           ]
         ]
        );

        $this->end_controls_section();

        $this->tp_section_title_render_controls('vision', 'Section Title', 'Sub Title', 'your title here', 'Hic nesciunt galisum aut dolorem');

        $this->start_controls_section(
            'tp_about_features_sec',
                [
                  'label' => esc_html__( 'Vision List', 'tpcore' ),
                  'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
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
            'tp_features_box_title',
              [
                'label'   => esc_html__( 'Features Title', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => esc_html__( 'Environment', 'tpcore' ),
                'label_block' => true,
              ]
            );
            
           
            $repeater->add_control(
            'tp_features_box_desc',
              [
                'label'   => esc_html__( 'Features Description', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => esc_html__( 'Lorem ipsum dolor sit amet consectetur adipisicing elit. consectetur numquam ', 'tpcore' ),
                'label_block' => true,
              ]
            );
            
           
            $repeater->add_control(
            'tp_features_box_list',
              [
                'label'   => esc_html__( 'Features List', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => esc_html__( 'List Item', 'tpcore' ),
                'label_block' => true,
              ]
            );
           

            $repeater->add_control(
             'tp_features_list_thumb_one',
                [
                'label'   => esc_html__( 'Upload Image', 'tpcore' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                    'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                ]
            );

            
            $repeater->add_group_control(
                Group_Control_Image_Size::get_type(),
                [
                    'name' => 'thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                    'exclude' => ['custom'],
                    // 'default' => 'tp-post-thumb',
                ]
            );
            $this->add_control(
                'tp_features_list',
                [
                    'label' => esc_html__('Features - List', 'tpcore'),
                    'type' => \Elementor\Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'default' => [
                        [
                            'tp_features_box_title' => esc_html__('Business Stratagy', 'tpcore'),
                        ],
                        [
                            'tp_features_box_title' => esc_html__('Website Development', 'tpcore')
                        ],
                        [
                            'tp_features_box_title' => esc_html__('Marketing & Reporting', 'tpcore')
                        ]
                    ],
                    'title_field' => '{{{ tp_features_box_title }}}',
                ]
            );
            $this->add_responsive_control(
                'tp_features_align_',
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

    // style_tab_content
    protected function style_tab_content(){

        $this->tp_section_style_controls('about_section', 'Section - Style', '.tp-el-section');

        $this->tp_basic_style_controls('portfolio_title', 'Section - Title', '.tp-el-title');
        $this->tp_basic_style_controls('portfolio_subtitle', 'Section - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('portfolio_desc', 'Section - Description', '.tp-el-content p');

        $this->tp_icon_style('video_box_play_icon', 'Box - Icon', '.tp-el-box-icon span');
        $this->tp_link_controls_style('video_box_play_btn', 'Box - Button', '.tp-el-box-btn');
        $this->tp_basic_style_controls('box_desc', 'Box - Description', '.tp-el-box-desc');
        $this->tp_basic_style_controls('section_list', 'Box - List', '.tp-el-box-list ul li, .tp-el-box-list ol li,  .tp-el-box-list');

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
            $this->add_render_attribute('title_args', 'class', 'section__title-6 tp-el-title');
            $bloginfo = get_bloginfo( 'name' );
        ?>

		<?php else:
            $bloginfo = get_bloginfo( 'name' );
            

            if($settings['enable_style_2'] == 'yes'){
                $enable_style_2 = 'vision__style-2';
                $this->add_render_attribute('title_args', 'class', 'tp-section-title-2 tp-el-title');
            }else{
                $enable_style_2 = '';
                $this->add_render_attribute('title_args', 'class', 'section__title-10 tp-el-title');
            }

		?>


         <!-- vision area start -->
         <section class="vision__area <?php echo esc_attr($enable_style_2); ?> pt-110 pb-110 grey-bg-4 tp-el-section">
            <div class="container">
            <?php if ( !empty($settings['tp_vision_section_title_show']) ) : ?>
               <div class="row">
                  <div class="col-xxl-8 col-xl-9 col-lg-10">

                    <?php if($settings['enable_style_2'] == 'yes') : ?>
                    <div class="tp-section-wrapper-2 mb-60 tp-el-content">
                        <?php if ( !empty($settings['tp_vision_sub_title']) ) : ?>
                        <span class="tp-section-subtitle-2 tp-el-subtitle">
                            <?php echo tp_kses( $settings['tp_vision_sub_title'] ); ?>
                        </span>
                        <?php endif; ?>

                        <?php
                            if ( !empty($settings['tp_vision_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['tp_vision_title_tag'] ),
                                    $this->get_render_attribute_string( 'title_args' ),
                                    tp_kses( $settings['tp_vision_title' ] )
                                    );
                            endif;
                        ?>
                        <?php if ( !empty($settings['tp_vision_description']) ) : ?>
                            <p><?php echo tp_kses( $settings['tp_vision_description'] ); ?></p>
                        <?php endif; ?>
                    </div>

                    <?php else : ?>
                        <div class="section__title-wrapper-10 mb-60 tp-el-content">

                            <?php if ( !empty($settings['tp_vision_sub_title']) ) : ?>
                            <span class="section__title-pre-10 tp-el-subtitle">
                                <?php echo tp_kses( $settings['tp_vision_sub_title'] ); ?>
                            </span>
                            <?php endif; ?>

                            <?php
                                if ( !empty($settings['tp_vision_title' ]) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['tp_vision_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        tp_kses( $settings['tp_vision_title' ] )
                                        );
                                endif;
                            ?>
                            <?php if ( !empty($settings['tp_vision_description']) ) : ?>
                                <p><?php echo tp_kses( $settings['tp_vision_description'] ); ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>                    
                  </div>
               </div>
               <?php endif; ?>
               <div class="row">
                  <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-5">
                     <div class="vision__tab tp-tab">
                        <ul class="nav nav-tabs flex-column" id="visionTab" role="tablist">
                            <?php foreach ($settings['tp_features_list'] as $key => $item) :
                                $active = $key == 0 ? 'show active': '';
                                // Link
                                ?>
                            <li class="nav-item wow fadeInUp" role="presentation" data-wow-delay=".1s" data-wow-duration="1s">
                                <button class="nav-link tp-el-box-btn tp-el-box-icon <?php echo esc_attr($active); ?>" id="crime-tab-<?php echo esc_attr($key); ?>" data-bs-toggle="tab" data-bs-target="#crime-<?php echo esc_attr($key); ?>" type="button" role="tab" aria-controls="crime-<?php echo esc_attr($key); ?>" aria-selected="true">
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
                                    <?php echo tp_kses($item['tp_features_box_title']); ?>
                                </button>
                            </li>
                            <?php endforeach; ?>
                         </ul>                       
                     </div>
                  </div>
                  <div class="col-xxl-9 col-xl-8 col-lg-8 col-md-7">
                     <div class="vision__tab-content pl-70">
                        <div class="tab-content" id="visionTabContent">
                            <?php foreach ($settings['tp_features_list'] as $key => $item) : 

                            $active = $key == 0 ? 'show active': '';

                                if ( !empty($item['tp_features_list_thumb_one']['url']) ) {
                                    $features_thumb_url = !empty($item['tp_features_list_thumb_one']['id']) ? wp_get_attachment_image_url( $item['tp_features_list_thumb_one']['id'], $item['thumbnail_size']) : $item['tp_features_list_thumb_one']['url'];
                                    $features_thumb_alt = get_post_meta($item["tp_features_list_thumb_one"]["id"], "_wp_attachment_image_alt", true);
                                }
                            ?>
                           <div class="tab-pane fade <?php echo esc_attr($active) ?>" id="crime-<?php echo esc_attr($key); ?>" role="tabpanel" aria-labelledby="crime-tab-<?php echo esc_attr($key); ?>">
                              <div class="vision__item">
                                    <?php if(!empty($features_thumb_url)) : ?>
                                    <div class="vision__thumb m-img mb-30">
                                        <img src="<?php echo esc_url($features_thumb_url); ?>" alt="<?php echo esc_attr($features_thumb_alt); ?>">
                                    </div>
                                    <?php endif; ?>

                                 <div class="vision__content">

                                    <?php if(!empty($item['tp_features_box_desc'])) : ?>
                                    <p class="tp-el-box-desc"><?php echo tp_kses($item['tp_features_box_desc']); ?></p>
                                    <?php endif; ?>

                                    <?php if(!empty($item['tp_features_box_list'])) : ?>
                                    <div class="vision__list tp-el-box-list">
                                        <?php echo tp_kses($item['tp_features_box_list']); ?>
                                    </div>
                                    <?php endif; ?>
                                 </div>
                              </div>
                           </div>
                           <?php endforeach; ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- vision area end -->

        <?php endif; ?>

        <?php
	}
}

$widgets_manager->register( new TP_Vision_Tab() );
