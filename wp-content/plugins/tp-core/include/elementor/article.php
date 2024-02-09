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
class TP_Article extends Widget_Base {

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
        return 'tp-article';
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
        return __( 'TP Articles', 'tpcore' );
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

        $this->start_controls_section(
         'tp_arcitle_sec',
             [
               'label' => esc_html__( 'Article Box', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
             ]
        );
        
        
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
         'enable_lg_col',
            [
                'label'        => esc_html__( 'Enabe Large Column', 'tpcore' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'tpcore' ),
                'label_off'    => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );

        $repeater->add_control(
         'enable_sm_item',
            [
                'label'        => esc_html__( 'Enabe Small Style', 'tpcore' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'tpcore' ),
                'label_off'    => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );

        $repeater->add_control(
         'enable_xs_item',
            [
                'label'        => esc_html__( 'Enabe Extra Small Style', 'tpcore' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'tpcore' ),
                'label_off'    => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );

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
                    'repeater_condition' => 'style_2'
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
                    'repeater_condition' => 'style_2'
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
                    'repeater_condition' => 'style_2'
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
                        'repeater_condition' => 'style_2'
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
                        'repeater_condition' => 'style_2'
                    ]
                ]
            );
        }
        
         $repeater->add_control(
         'tp_article_box_title',
           [
             'label'   => esc_html__( 'Title', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::TEXT,
             'default'     => esc_html__( 'Themes', 'tpcore' ),
             'label_block' => true,
           ]
         );

         $repeater->add_control(
         'tp_article_box_subtitle',
          [
             'label'       => esc_html__( 'Subtitle', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::TEXT,
             'default'     => esc_html__( '8 Articles', 'tpcore' ),
             'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
             'label_block' => true,
          ]
         );

         $repeater->add_control(
          'tp_article_box_desc',
          [
            'label'       => esc_html__( 'Description', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXTAREA,
            'rows'        => 10,
            'default'     => esc_html__( 'Everything about themes: built-in features, technical guides,', 'tpcore' ),
            'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
          ]
         );

         $repeater->add_control(
          'tp_article_box_image',
          [
            'label'   => esc_html__( 'Upload Image', 'tpcore' ),
            'type'    => \Elementor\Controls_Manager::MEDIA,
              'default' => [
                'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
            'condition' => [
                'repeater_condition' => 'style_1'
            ]
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
            'tp_article_icon',
            [
                'label'       => esc_html__( 'Icon Color', 'tpcore' ),
                'type'     => \Elementor\Controls_Manager::COLOR,
                'selectors' => ['{{WRAPPER}} {{CURRENT_ITEM}} .articles__icon span' => 'color: {{VALUE}}'],
                'default' => '#5EB74B',
                'condition' => ['want_customize' => 'yes'],
            ]
        );
        
        $repeater->add_control(
            'tp_article_bg',
            [
                'label'       => esc_html__( 'Background Color', 'tpcore' ),
                'type'     => \Elementor\Controls_Manager::COLOR,
                'selectors' => ['{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-color: {{VALUE}}'],
                'default' => '#5EB74B',
                'condition' => ['want_customize' => 'yes'],
            ]
        );
        
        $repeater->add_control(
            'tp_article_nu',
            [
                'label'       => esc_html__( 'Subtitle BG Color', 'tpcore' ),
                'type'     => \Elementor\Controls_Manager::COLOR,
                'selectors' => ['{{WRAPPER}} {{CURRENT_ITEM}} .articles__number' => 'background-color: {{VALUE}}'],
                'default' => '#5EB74B',
                'condition' => ['want_customize' => 'yes'],
            ]
        );
        
        $repeater->add_control(
            'tp_article_n',
            [
                'label'       => esc_html__( 'Subtitle Color', 'tpcore' ),
                'type'     => \Elementor\Controls_Manager::COLOR,
                'selectors' => ['{{WRAPPER}} {{CURRENT_ITEM}} .articles__number' => 'color: {{VALUE}}'],
                'default' => '#5EB74B',
                'condition' => ['want_customize' => 'yes'],
            ]
        );

         $this->add_control(
           'tp_article_list',
            [
                'label'       => esc_html__( 'Article List', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'tp_article_box_title'   => esc_html__( 'Themes', 'tpcore' ),
                    ],
                    [
                        'tp_article_box_title'   => esc_html__( 'Services', 'tpcore' ),
                    ],
                    [
                        'tp_article_box_title'   => esc_html__( 'Extensions', 'tpcore' ),
                    ],
                ],
                'title_field' => '{{{ tp_article_box_title }}}',
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
    }

    protected function style_tab_content(){
        $this->tp_section_style_controls('about_section', 'Section - Style', '.tp-el-section');

        $this->tp_section_style_controls('about_box', 'Box - Style', '.tp-el-box');

        $this->tp_basic_style_controls('about_title', 'Box - Title', '.tp-el-box-title');
        $this->tp_basic_style_controls('about_icon', 'Box - Icon', '.tp-el-box-icon');
        $this->tp_link_controls_style('about_subtitle', 'Box - Subtitle', '.tp-el-box-tag');
        $this->tp_basic_style_controls('about_description', 'Box - Description', '.tp-el-box-desc');
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
        ?>


        <?php else: 
            
        ?>

         <!-- articles area start -->
         <section class="articles__area pt-100 pb-100 tp-el-section">
            <div class="container">
               <div class="row grid">
                    <?php foreach ($settings['tp_article_list'] as $key => $item) :
                        $enable_lg_col = $item['enable_lg_col'] == 'yes' ? '8' : '4';
                        $enable_sm_item = $item['enable_sm_item'] == 'yes' ? 'articles__item-sm' : '';
                        $enable_style_2 = $item['enable_xs_item'] == 'yes' ? 'articles__style-2' : '';

                        if ( !empty($item['tp_article_box_image']['url']) ) {
                            $tp_image = !empty($item['tp_article_box_image']['id']) ? wp_get_attachment_image_url( $item['tp_article_box_image']['id'], $settings['thumbnail_size']) : $item['tp_article_box_image']['url'];
                            $tp_image_alt = get_post_meta($item["tp_article_box_image"]["id"], "_wp_attachment_image_alt", true);
                        }
                    ?>
                  <div class="col-xl-<?php echo esc_attr($enable_lg_col); ?> col-lg-<?php echo esc_attr($enable_lg_col); ?> col-md-6 grid-item">
                     <div class="articles__item tp-el-box <?php echo esc_attr($enable_style_2); ?> <?php echo esc_attr($enable_sm_item); ?> purple-bg p-relative z-index-1 mb-30 wow fadeInUp elementor-repeater-item-<?php echo esc_attr($item['_id']); ?>" data-wow-delay=".3s" data-wow-duration="1s">

                        <?php if(!empty($item['repeater_condition'] == 'style_2')) : ?>
                        <div class="articles__icon tp-el-box-icon">
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

                        <?php else: ?>
                            <?php if (!empty($tp_image)): ?>
                            <div class="articles__thumb">
                                <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                            </div>
                            <?php endif; ?>
                        <?php endif; ?>

                        <div class="articles__content">
                           <div class="articles__top d-flex align-items-center">

                                <?php if(!empty($item['tp_article_box_title'])): ?>
                                <h3 class="articles__title tp-el-box-title"><?php echo tp_kses($item['tp_article_box_title']) ?></h3>
                                <?php endif; ?>

                                <?php if(!empty($item['tp_article_box_subtitle'])): ?>
                                <span class="articles__number tp-el-box-tag"><?php echo tp_kses($item['tp_article_box_subtitle']) ?></span>
                                <?php endif; ?>
                           </div>
                           <?php if(!empty($item['tp_article_box_desc'])): ?>
                           <p class="tp-el-box-desc"><?php echo tp_kses($item['tp_article_box_desc']) ?></p>
                           <?php endif; ?>
                        </div>
                     </div>
                  </div>
                  <?php endforeach; ?>
               </div>
            </div>
         </section>
         <!-- articles area end -->

        <?php endif; ?>

        <?php
    }
}

$widgets_manager->register( new TP_Article() );
