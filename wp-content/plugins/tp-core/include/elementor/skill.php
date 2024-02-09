<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use \Elementor\Control_Media;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Css_Filter;
use \Elementor\Repeater;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
Use \Elementor\Core\Schemes\Typography;
use \Elementor\Utils;
use \Elementor\Group_Control_Box_Shadow;
use TPCore\Elementor\Controls\Group_Control_TPBGGradient;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Skill extends Widget_Base {

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
		return 'skill-bar';
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
		return __( 'Skill', 'tpcore' );
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
                ],
                'default' => 'layout-1',
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
            'condition' => [
                'tp_design_style' => 'layout-2'
            ]
            ]
        );

		$this->end_controls_section();


        $this->tp_section_title_render_controls('skill', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.');

        $this->start_controls_section(
            'tp_section_subtitle_line_sec',
                [
                  'label' => esc_html__( 'Subtitle Line Color', 'tpcore' ),
                  'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                  'condition' =>[
                    'tp_design_style' => ['layout-2'],
                    ]
                ]
           );
           
           $this->add_control(
               'tp_subtitle_line',
               [
                   'label' => esc_html__( 'Line BG Color', 'tpcore' ),
                   'type' => Controls_Manager::TEXT,
                   'selectors' => [
                       '{{WRAPPER}} .section__title-pre-9::after' => 'background: {{VALUE}};',
                       '{{WRAPPER}} .section__title-pre-1-3::after' => 'background: {{VALUE}};',
                   ],
                   'placeholder' => esc_html__( 'red', 'tpcore' ),
               ]
           );

           
           $this->end_controls_section();

        // Skill
        $this->start_controls_section(
            'tp_progress_bar',
            [
                'label' => esc_html__('Skill Bar', 'tpcore', ['layout-1', 'layout-2']),
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
                    'repeater_condition' => ['style_3'],
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
                    'repeater_condition' => ['style_3'],
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
                    'repeater_condition' => ['style_3'],
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
                        'repeater_condition' => ['style_3'],
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
                        'repeater_condition' => ['style_3'],
                    ]
                ]
            );
        }
        $repeater->add_control(
            'tp_skill_box_title',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__( 'Fact Title', 'tpcore' ),
                'default' => esc_html__( 'Design', 'tpcore' ),
                'placeholder' => esc_html__( 'Type a skill name', 'tpcore' ),
                'condition' =>[
                    'repeater_condition' => ['style_2', 'style_3'],
                ]
            ]
        );

        $repeater->add_control(
            'tp_skill_num',
            [
                'label'       => esc_html__( 'Skill Number', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( '85', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Number', 'tpcore' ),
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
            'skill_bg_color',
            [
                'label'       => esc_html__( 'Skill BG Color', 'tpcore' ),
                'type'     => \Elementor\Controls_Manager::COLOR,
                'selectors' => ['{{WRAPPER}} {{CURRENT_ITEM}} .progress .progress-bar' => 'background-color: {{VALUE}}'],
                'default' => '#50CD57',
                'condition' => ['want_customize' => 'yes'],
            ]
        );

        $this->add_control(
            'tp_skill_list',
            [
                'label' => esc_html__('Services - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_skill_box_title' => esc_html__('Business Stratagy', 'tpcore'),
                        'tp_skill_num' => '95',
                        'tp_skill_icon' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'tp_skill_box_title' => esc_html__('Business Stratagy', 'tpcore'),
                        'tp_skill_num' => '95',
                        'tp_skill_icon' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'tp_skill_box_title' => esc_html__('Business Stratagy', 'tpcore'),
                        'tp_skill_num' => '95',
                        'tp_skill_icon' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                ],
                'title_field' => '{{{ tp_skill_box_title }}}',
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
	}


    protected function style_tab_content(){
        $this->tp_section_style_controls('about_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('about_subtitle', 'Section - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('about_title', 'Section - Title', '.tp-el-title');
        $this->tp_basic_style_controls('about_description', 'Section - Description', '.tp-el-content p');
        
   
        $this->tp_section_style_controls('services_section_box', 'Box - Style', '.tp-el-box');
        $this->tp_icon_style('section_icon', 'Box - Icon', '.tp-el-box-icon span');
        $this->tp_basic_style_controls('services_box_title', 'Box - Title', '.tp-el-box-title');
        $this->tp_link_controls_style('services_box_description', 'Box - Number', '.tp-el-box-number');
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
                 

            if($settings['enable_style_2'] == 'yes'){
                $skill_style_2 = 'skill__style-2';
                $this->add_render_attribute('title_args', 'class', 'section__title tp-el-title'); 
            }else{
                $skill_style_2 = '';
                $this->add_render_attribute('title_args', 'class', 'section__title-9 tp-el-title'); 
            }

           
        ?>

		 
        <div class="skill__wrapper-9 <?php echo esc_attr($skill_style_2); ?> tp-el-section">
            <?php if ( !empty($settings['tp_skill_section_title_show']) ) : ?>
            <div class="section__title-wrapper-9 mb-55 tp-el-content">

                <?php if($settings['enable_style_2'] == 'yes') : ?>
                    <?php if(!empty($settings['tp_skill_sub_title'])): ?>
                    <span class="section__title-pre section__title-pre-1-3 tp-el-subtitle"><?php echo tp_kses($settings['tp_skill_sub_title']); ?></span>
                    <?php endif; ?>

                    <?php
                        if ( !empty($settings['tp_skill_title' ]) ) :
                            printf( '<%1$s %2$s>%3$s</%1$s>',
                                tag_escape( $settings['tp_skill_title_tag'] ),
                                $this->get_render_attribute_string( 'title_args' ),
                                tp_kses( $settings['tp_skill_title' ] )
                                );
                        endif;
                    ?>

                    <?php if (!empty($settings['tp_skill_description' ])): ?>
                    <p><?php echo tp_kses($settings['tp_skill_description']); ?></p>
                    <?php endif; ?>

                <?php else:  ?>
                    <?php if(!empty($settings['tp_skill_sub_title'])): ?>
                    <span class="section__title-pre-9 tp-el-subtitle"><?php echo tp_kses($settings['tp_skill_sub_title']); ?></span>
                    <?php endif; ?>
                    <?php
                        if ( !empty($settings['tp_skill_title' ]) ) :
                            printf( '<%1$s %2$s>%3$s</%1$s>',
                                tag_escape( $settings['tp_skill_title_tag'] ),
                                $this->get_render_attribute_string( 'title_args' ),
                                tp_kses( $settings['tp_skill_title' ] )
                                );
                        endif;
                    ?>
                    <?php if (!empty($settings['tp_skill_description' ])): ?>
                    <p><?php echo tp_kses($settings['tp_skill_description']); ?></p>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            <div class="skill__item-wrapper-9">
                <div class="row">
                    <?php foreach ( $settings['tp_skill_list'] as $index => $item ) : ?>
                    <div class="col-xxl-6 col-md-6 col-sm-6 col-6">
                        <div class="skill__item-9 tp-el-box">
                                                       
                            <div class="skill__icon-9 tp-el-box-icon">
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
                            

                        <div class="skill__content-9">
                            <h4 class="tp-el-box-number"><?php echo esc_html($item['tp_skill_box_title']); ?> <span>(<span data-purecounter-duration="1" data-purecounter-end="<?php echo esc_attr($item['tp_skill_num']); ?>"  class="purecounter">0</span>%)</span></h4>
                        </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>


		<?php elseif ( $settings['tp_design_style']  == 'layout-3' ): 
            $this->add_render_attribute('title_args', 'class', 'skill-section-title tp-el-title');      
        ?>

         <!-- skill area start -->
         <section class="skill__area pt-100 pb-75 tp-el-section">
            <div class="container">
               <div class="row">
                  <div class="col-xl-6 col-lg-6">
                     <div class="skill__wrapper-14 mb-40 tp-el-content">

                        <?php if(!empty($settings['tp_skill_sub_title'])): ?>
                        <span class="tp-section-subtitle-2 tp-el-subtitle"><?php echo tp_kses($settings['tp_skill_sub_title']); ?></span>
                        <?php endif; ?>
                        <?php
                            if ( !empty($settings['tp_skill_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['tp_skill_title_tag'] ),
                                    $this->get_render_attribute_string( 'title_args' ),
                                    tp_kses( $settings['tp_skill_title' ] )
                                    );
                            endif;
                        ?>

                    <?php if ( !empty($settings['tp_skill_description']) ) : ?>
                        <p><?php echo tp_kses( $settings['tp_skill_description'] ); ?></p>
                    <?php endif; ?>

                     </div>
                  </div>
                  <div class="col-xl-6 col-lg-6">
                     <div class="skill__bar">
                        <?php foreach ( $settings['tp_skill_list'] as $index => $item ) : 
                           
                        ?>
                        <div class="skill__bar-item elementor-repeater-item-<?php echo esc_attr($item['_id']); ?>">
                           <h4  class="skill__bar-title tp-el-box-title tp-el-box-icon"> 
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

                              <?php echo esc_html($item['tp_skill_box_title']); ?>
                           </h4>
                           <div class="skill__bar-progress">
                              <div class="progress">
                                 <div class="progress-bar wow slideInLeft" data-wow-delay="0s" data-wow-duration=".8s" role="progressbar" data-width="<?php echo esc_attr($item['tp_skill_num']); ?>%" aria-valuenow="<?php echo esc_attr($item['tp_skill_num']); ?>" aria-valuemin="0" aria-valuemax="100">
                                    <span class="tp-el-box-number"><?php echo esc_html($item['tp_skill_num']); ?></span>
                                 </div>
                               </div>
                           </div>
                        </div>
                        <?php endforeach; ?>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- skill area end -->

		 <?php else:
				 $this->add_render_attribute('title_args', 'class', 'section__title mb-20 tp-el-title');
			 ?>
                <div class="skill__item d-flex flex-wrap align-items-center ">
                    <?php foreach ( $settings['tp_skill_list'] as $index => $item ) : ?>
                    <div class="skill__single text-center mb-20 mr-20 tp-el-box">

                        
                        <div class="skill__icon tp-el-box-icon">
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
                      

                        <div class="skill__content">
                            <h4 class="tp-el-box-number"><span data-purecounter-duration="1" data-purecounter-end="<?php echo esc_attr($item['tp_skill_num']); ?>"  class="purecounter">0</span>%</h4>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            

		 <?php endif; ?>
		<?php
	}

}

$widgets_manager->register( new TP_Skill() );
