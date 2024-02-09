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
class TP_Job_List extends Widget_Base {

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
        return 'tp-job-list';
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
        return __( 'TP Job List', 'tpcore' );
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

        $this->tp_section_title_render_controls('job', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.');
 

        $this->start_controls_section(
         'tp_job_box_sec',
             [
               'label' => esc_html__( 'Job Box', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
             ]
        );
        
        
        $repeater = new \Elementor\Repeater();
        
        $repeater->add_control(
            'tp_job_box_title',
             [
                'label'       => esc_html__( 'Job Title', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Javascript Developer', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Title', 'tpcore' ),
                'label_block' => true
             ]
        );
        
        $repeater->add_control(
            'tp_job_box_meta',
             [
                'label'       => esc_html__( 'Job Meta', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => esc_html__( 'Full Time', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Meta', 'tpcore' ),
                'label_block' => true
             ]
        );

        $repeater->add_control(
        'tp_job_box_designation',
            [
                'label'       => esc_html__( 'Job Designation', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Developer', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Designation', 'tpcore' ),
            ]
        );

        $repeater->add_control(
        'tp_job_box_date',
            [
                'label'       => esc_html__( 'Job Date', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( '01 Jan 2022', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
            ]
        );
        $repeater->add_control(
        'tp_job_box_vacancy',
            [
                'label'       => esc_html__( 'Job Vacancy', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( '04', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
            ]
        );

        $repeater->add_control(
            'tp_job_link_switcher',
            [
                'label' => esc_html__( 'Add Job link', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'tpcore' ),
                'label_off' => esc_html__( 'No', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );
        $repeater->add_control(
            'tp_job_btn_text',
            [
                'label' => esc_html__('Button Text', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'tpcore'),
                'title' => esc_html__('Enter button text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_job_link_switcher' => 'yes',
                ],
            ]
        );
        $repeater->add_control(
            'tp_job_link_type',
            [
                'label' => esc_html__( 'Job Link Type', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'tp_job_link_switcher' => 'yes'
                ]
            ]
        );
        $repeater->add_control(
            'tp_job_link',
            [
                'label' => esc_html__( 'Job Link', 'tpcore' ),
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
                    'tp_job_link_type' => '1',
                    'tp_job_link_switcher' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'tp_job_page_link',
            [
                'label' => esc_html__( 'Select Job Link Page', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_job_link_type' => '2',
                    'tp_job_link_switcher' => 'yes',
                ]
            ]
        );
         
         $this->add_control(
           'tp_job_list',
           [
                'label'       => esc_html__( 'Job List', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                [
                    'tp_job_box_title'   => esc_html__( 'Javascript', 'tpcore' ),
                ],
                ],
                'title_field' => '{{{ tp_job_box_title }}}',
            ]
         );
        
        $this->end_controls_section();


    }

    protected function style_tab_content(){
        $this->tp_section_style_controls('services_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('services_subtitle', 'Section - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('services_title', 'Section - Title', '.tp-el-title');
        $this->tp_basic_style_controls('services_description', 'Section - Description', '.tp-el-content p');
        
        $this->tp_section_style_controls('services_section_box', 'Box - Style', '.tp-el-box');
        $this->tp_basic_style_controls('history_title', 'Job - Title', '.tp-el-box-title');
        $this->tp_basic_style_controls('services_date', 'Job - Date', '.tp-el-box-date');
        $this->tp_basic_style_controls('services_vacan', 'Job - Vacancies', '.tp-el-box-vacan');
        $this->tp_link_controls_style('history_meta', 'Job - Meta', '.tp-el-box-meta span');
        $this->tp_link_controls_style('history_tag', 'Job - Tag', '.tp-el-box-tag');
        $this->tp_link_controls_style('services_box_link_btn', 'Job - Button', '.tp-el-box-btn');
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
            $this->add_render_attribute('title_args', 'class', 'tp-section-title-4 tp-el-title');        
        ?>


         <!-- job area start -->
         <section class="job__area pb-140 pt-35 tp-el-section">
            <div class="container">
                <?php if ( !empty($settings['tp_job_section_title_show']) ) : ?>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="tp-section-wrapper-4 mb-50 tp-el-content">

                        <?php if ( !empty($settings['tp_job_sub_title']) ) : ?>
                        <span class="tp-section-subtitle-2 tp-el-subtitle">
                            <?php echo tp_kses( $settings['tp_job_sub_title'] ); ?>
                        </span>
                        <?php endif; ?>

                            <?php
                                if ( !empty($settings['tp_job_title' ]) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['tp_job_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        tp_kses( $settings['tp_job_title' ] )
                                        );
                                endif;
                            ?>
                            <?php if ( !empty($settings['tp_job_description']) ) : ?>
                                <p><?php echo tp_kses( $settings['tp_job_description'] ); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
               <div class="row">
                  <div class="col-xxl-12">
                     <div class="job__item-wrapper">

                     <?php foreach ($settings['tp_job_list'] as $key => $item) :
                            // Link
                            if ('2' == $item['tp_job_link_type']) {
                                $link = get_permalink($item['tp_job_page_link']);
                                $target = '_self';
                                $rel = 'nofollow';
                            } else {
                                $link = !empty($item['tp_job_link']['url']) ? $item['tp_job_link']['url'] : '';
                                $target = !empty($item['tp_job_link']['is_external']) ? '_blank' : '';
                                $rel = !empty($item['tp_job_link']['nofollow']) ? 'nofollow' : '';
                            }
                        ?>
                        <div class="job__item transition-3 wow fadeInUp tp-el-box" data-wow-delay=".3s" data-wow-duration="1s">
                           <div class="row align-items-center">
                              <div class="col-xl-6 col-lg-7 col-md-9">
                                 <div class="job__content">

                                    <?php if (!empty($item['tp_job_box_title' ])): ?>
                                    <h3 class="job__title tp-el-box-title">
                                        <?php if ($item['tp_job_link_switcher'] == 'yes') : ?>
                                        <a href="<?php echo esc_url($link); ?>"><?php echo tp_kses($item['tp_job_box_title' ]); ?></a>
                                        <?php else : ?>
                                            <?php echo tp_kses($item['tp_job_box_title' ]); ?>
                                        <?php endif; ?>
                                    </h3>
                                    <?php endif; ?>

                                    <div class="job__meta-wrapper d-sm-flex flex-wrap align-items-center">
                                        <?php if (!empty($item['tp_job_box_meta' ])): ?>
                                        <div class="job__meta-item">
                                            <?php echo tp_kses($item['tp_job_box_meta' ]); ?>
                                        </div>
                                        <?php endif; ?>

                                        <?php if (!empty($item['tp_job_box_designation' ])): ?>
                                        <div class="job__tag">
                                            <span class="tp-el-box-tag"><?php echo tp_kses($item['tp_job_box_designation' ]); ?></span>
                                        </div>
                                        <?php endif; ?>

                                    </div>
                                 </div>
                              </div>
                              <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
                                 <div class="job__vacancies">
                                    <?php if (!empty($item['tp_job_box_date' ])): ?>
                                    <span class="tp-el-box-date"><?php echo tp_kses($item['tp_job_box_date' ]); ?></span>
                                    <?php endif; ?>

                                    <?php if (!empty($item['tp_job_box_vacancy' ])): ?>
                                    <p class="tp-el-box-vacan">No of vacancies: <?php echo tp_kses($item['tp_job_box_vacancy' ]); ?></p>
                                    <?php endif; ?>
                                 </div>
                              </div>
                              <?php if (!empty($link)) : ?>
                              <div class="col-xl-3 col-lg-2 col-md-6 col-sm-6">
                                 <div class="job__btn text-xl-end">
                                    <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>" class="tp-btn-border tp-el-box-btn"><?php echo tp_kses($item['tp_job_btn_text']); ?></a>
                                 </div>
                              </div>
                              <?php endif; ?>                               
                           </div>
                        </div>
                        <?php endforeach; ?>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- job area end -->


        <?php endif; ?>

        <?php
    }
}

$widgets_manager->register( new TP_Job_List() );
