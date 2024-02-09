<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;

use \Etn\Utils\Helper as Helper;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Event_New_Post extends Widget_Base {

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
        return 'event-test';
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
        return __( 'Event Post', 'tpcore' );
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

    public function get_event_category() {
        return Helper::get_event_category();
    }

    public function get_event_tag() {
        return Helper::get_event_tag();
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();


        $this->tp_section_title_render_controls('section', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.');


        // Start of event section
        $this->start_controls_section(
            'section_tab',
            [
                'label' => esc_html__( 'Harry Event', 'tpcore' ),
            ]
        );
        $this->add_control(
            'etn_event_cat',
            [
                'label'    => esc_html__( 'Event Category', 'tpcore' ),
                'type'     => Controls_Manager::SELECT2,
                'options'  => $this->get_event_category(),
                'multiple' => true,
            ]
        );
        $this->add_control(
            'etn_event_tag',
            [
                'label'    => esc_html__( 'Event Tag', 'tpcore' ),
                'type'     => Controls_Manager::SELECT2,
                'options'  => $this->get_event_tag(),
                'multiple' => true,
            ]
        );
        $this->add_control(
            'etn_event_count',
            [
                'label'   => esc_html__( 'Event count', 'tpcore' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => '6',
            ]
        );

        $this->add_control(
            'etn_desc_show',
            [
                'label'   => esc_html__( 'Show Description', 'tpcore' ),
                'type'    => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'tpcore' ),
                'label_off' => esc_html__( 'No', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'etn_desc_limit',
            [
                'label'   => esc_html__( 'Description Limit', 'tpcore' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 20,
            ]
        );

        $this->add_control(
            'etn_event_col',
            [
                'label'   => esc_html__( 'Event column', 'tpcore' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '4',
                'options' => [
                    '3' => esc_html__( '4 Column ', 'tpcore' ),
                    '4' => esc_html__( '3 Column', 'tpcore' ),
                    '6' => esc_html__( '2 Column', 'tpcore' ),

                ],
            ]
        );

        $this->add_control(
            'filter_with_status',
            [
                'label'     => esc_html__( 'Event status filter By', 'tpcore' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => '',
                'options'   => [
                    ''        => esc_html__( 'All', 'tpcore' ),
                    'upcoming' => esc_html__( 'upcoming Event', 'tpcore' ),
                    'expire' => esc_html__( 'Expire Event', 'tpcore' ),
                ],
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label'     => esc_html__( 'Order Event By', 'tpcore' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'post_date',
                'options'   => [
                    'ID'        => esc_html__( 'Id', 'tpcore' ),
                    'title'     => esc_html__( 'Title', 'tpcore' ),
                    'post_date' => esc_html__( 'Post Date', 'tpcore' ),
                    'etn_start_date' => esc_html__( 'Event Start Date', 'tpcore' ),
                    'etn_end_date' => esc_html__( 'Event End Date', 'tpcore' ),
                ],
            ]
        );

        $this->add_control(
            'order',
            [
                'label'   => esc_html__( 'Event Order', 'tpcore' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'DESC',
                'options' => [
                    'ASC' => esc_html__( 'Ascending', 'tpcore' ),
                    'DESC' => esc_html__( 'Descending', 'tpcore' ),
                ],
            ]
        );
        $this->add_control(
            'show_event_location',
            [
                'label'   => esc_html__( 'Show Event Location', 'tpcore' ),
                'type'    => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'tpcore' ),
                'label_off' => esc_html__( 'No', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_parent_event',
            [
                'label'   => esc_html__( 'Show Recurring Parent Events', 'tpcore' ),
                'type'    => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'tpcore' ),
                'label_off' => esc_html__( 'No', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'show_child_event',
            [
                'label'   => esc_html__( 'Show Recurring Child Event', 'tpcore' ),
                'type'    => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'tpcore' ),
                'label_off' => esc_html__( 'No', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'show_event_time',
            [
                'label'   => esc_html__( 'Show Event Time', 'tpcore' ),
                'type'    => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'tpcore' ),
                'label_off' => esc_html__( 'No', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'show_event_btn',
            [
                'label'   => esc_html__( 'Show Event Button', 'tpcore' ),
                'type'    => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'tpcore' ),
                'label_off' => esc_html__( 'No', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();

    }

    protected function style_tab_content(){
        $this->tp_section_style_controls('portfolio_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('portfolio_title', 'Section - Title', '.tp-el-title');
        $this->tp_basic_style_controls('portfolio_subtitle', 'Section - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('portfolio_desc', 'Section - Description', '.tp-el-content p');

        $this->tp_section_style_controls('coming_box', 'Event - Box', '.tp-el-box');
        $this->tp_basic_style_controls('coming_title', 'Event - Title', '.tp-el-box-title');
        $this->tp_basic_style_controls('coming_subtitle', 'Event - Speaker', '.tp-el-box-subtitle');
        $this->tp_basic_style_controls('coming_desig', 'Event - Designation', '.tp-el-box-designation');
        $this->tp_basic_style_controls('coming_desc', 'Event - Description', '.tp-el-box-desc');
        $this->tp_basic_style_controls('coming_meta', 'Event - Meta', '.tp-el-box-meta');
        $this->tp_link_controls_style('coming_tag', 'Event - Tag', '.tp-el-box-tag');
        $this->tp_link_controls_style('coming_btn', 'Event - Button', '.tp-el-box-btn');


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

        $event_cat          = $settings["etn_event_cat"];
        $event_tag          = $settings["etn_event_tag"];
        $event_count        = $settings["etn_event_count"];
        $etn_event_col      = $settings["etn_event_col"];
        $etn_desc_limit     = $settings["etn_desc_limit"];
        $order              = (isset($settings["order"]) ? $settings["order"] : 'DESC');
        $show_event_location = (isset($settings["show_event_location"]) ? $settings["show_event_location"] : 'yes');
        $show_end_date      = (isset($settings["show_end_date"]) ? $settings["show_end_date"] : 'no');
        $etn_desc_show      = (isset($settings["etn_desc_show"]) ? $settings["etn_desc_show"] : 'yes');
        $orderby            = $settings["orderby"];
        $show_child_event   = $settings["show_child_event"];
        $show_parent_event  = $settings["show_parent_event"];
        $show_event_time  = $settings["show_event_time"];
        $show_event_btn  = $settings["show_event_btn"];

        if ( $orderby == "etn_start_date" || $orderby == "etn_end_date" ) {
            $orderby_meta       = "meta_value";
        } else {
            $orderby_meta       = null;
        }
        $filter_with_status       = $settings['filter_with_status'];
        $post_parent = Helper::show_parent_child( $show_parent_event , $show_child_event  );

        $data           = Helper::post_data_query('etn', $event_count, $order, $event_cat, 'etn_category',
        null, null, $event_tag, $orderby_meta, $orderby, $filter_with_status, $post_parent);

        ?>

        <?php if ( $settings['tp_design_style']  == 'layout-2' ): 
            $this->add_render_attribute('title_args', 'class', 'section__title-10 mb-15 tp-el-title');
        ?>

         <!-- event area start -->
         <section class="event__area pt-110 pb-120 tp-el-section">
            <div class="container">
            <?php if ( !empty($settings['tp_section_section_title_show']) ) : ?>
               <div class="row">
                  <div class="col-xxl-12">
                     <div class="section__title-wrapper-10 mb-60 text-center tp-el-content">
                            <?php if ( !empty($settings['tp_section_sub_title']) ) : ?>
                            <span class="section__title-pre-10 tp-el-subtitle">
                                <?php echo tp_kses( $settings['tp_section_sub_title'] ); ?>
                            </span>
                            <?php endif; ?>

                            <?php
                                if ( !empty($settings['tp_section_title' ]) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['tp_section_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        tp_kses( $settings['tp_section_title' ] )
                                        );
                                endif;
                            ?>

                            <?php if ( !empty($settings['tp_section_description']) ) : ?>
                                <p><?php echo tp_kses( $settings['tp_section_description'] ); ?></p>
                            <?php endif; ?>
                     </div>
                  </div>
               </div>
               <?php endif; ?>
               <div class="row">
                  <div class="col-xxl-12">
                     <div class="event__item-wrapper-10">
                            <?php if ( !empty( $data ) ) :
                            foreach ( $data as $index => $value ) :
                                $social             = get_post_meta($value->ID, 'etn_event_socials', true);
                                $etn_event_location = get_post_meta($value->ID, 'etn_event_location', true);                           

                                $category           = Helper::cate_with_link($value->ID, 'etn_category');
                                $start_date         = get_post_meta( $value->ID, 'etn_start_date', true );
                                $end_date           = get_post_meta( $value->ID, 'etn_end_date', true );
                                // $etn_start_date_new = Helper::etn_date_new( $start_date );
                                $etn_start_date     = Helper::etn_date( $start_date );
                                $etn_end_date       = Helper::etn_date( $end_date );
                                $start_date_digit   = date("d", strtotime($start_date));
                                $start_date_year_month = date("F d, Y", strtotime($start_date));
                                
                                $event_options      = get_option("etn_event_options");
                                
                                $data = Helper::single_template_options( $value->ID );

                            ?>
                        <div class="event__item-10 transition-3 d-md-flex align-items-center tp-el-box">

                           <div class="event__thumb-10 w-img mr-25">

                              <a href="<?php echo get_the_permalink($value->ID); ?>" target="_blank">
                                <?php echo get_the_post_thumbnail($value->ID); ?>
                              </a>
                              

                              <div class="event__thumb-10-overlay">
                                 <img class="event-thumb-shape" src="<?php echo get_template_directory_uri() . '/assets/img/event/10/event-shape-1.png' ?>" alt="<?php echo esc_attr__('event-shape', 'harry') ?>">
                                 <?php 
                                    $etn_schedule = get_post_meta($value->ID, 'etn_event_schedule', true);
                    
                                    if ($etn_schedule != '') : 
                                        $etn_schedule_topics = get_post_meta($etn_schedule[0], 'etn_schedule_topics', true);
                                        $etn_schedule_speakers_ids = $etn_schedule_topics[0]['etn_shedule_speaker'];
                                    
                                    foreach($etn_schedule_speakers_ids as $speaker): 
                                        $speaker_name = get_post_meta($speaker, 'etn_speaker_title', true);
                                        $speaker_avatar = get_the_post_thumbnail_url( $speaker, 'thumbnail' );
                                        $speaker_url = get_the_permalink($speaker);
                                        $etn_speaker_designation = get_post_meta($speaker, 'etn_speaker_designation', true);
                                    ?>
                                 <h3 class="tp-el-box-subtitle"><?php echo esc_html($speaker_name);  ?></h3>
                                 <span class="tp-el-box-designation"> <?php echo wp_kses_post( $etn_speaker_designation);  ?></span>
                                 <?php endforeach; endif; ?>
                              </div>
                           </div>
                           <div class="event__item-10-inner d-lg-flex justify-content-between align-items-center">
                              <div class="event__content-10">
                                 <div class="event__meta-10">

                                    <span class="event-tag tp-el-box-tag">
                                        <?php echo tp_kses($category); ?>
                                    </span>

                                    <span class="tp-el-box-meta"><i class="fa-light fa-clock"></i><?php echo esc_html($start_date_year_month); ?></span>
                                 </div>
                                 <h3 class="event__title-10 tp-el-box-title">
                                    <a href="<?php echo get_the_permalink($value->ID); ?>"><?php echo get_the_title($value->ID); ?></a>
                                 </h3>
                                 <?php if(!empty($etn_event_location)) : ?>
                                 <p class="tp-el-box-desc"><?php echo esc_html($etn_event_location); ?></p>
                                 <?php endif; ?>
                              </div>
                              <div class="event__more-10 text-lg-end">
                                 <a href="<?php echo esc_url(get_the_permalink($value->ID)); ?>" class="tp-btn-border-9 tp-el-box-btn" title="<?php echo get_the_title($value->ID); ?>"><?php echo esc_html__('Book a Seat', 'tpcore'); ?> <i class="fa-regular fa-chevron-right"></i></a>
                              </div>
                           </div>
                        </div>
                        <?php 
                        endforeach;
                        else : ?>
                            <p class="etn-not-found-post"><?php echo esc_html__('No Post Found', 'tpcore'); ?></p>
                        <?php endif; ?>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- event area end -->

<?php else: 
            $this->add_render_attribute('title_args', 'class', 'section__title mb-15 tp-el-title');

        ?>

        <!-- event area start -->
        <section class="event__area grey-bg-4 pt-110 pb-115 tp-el-section">
            <div class="container">
            <?php if ( !empty($settings['tp_section_section_title_show']) ) : ?>
               <div class="row">
                    <div class="col-xxl-9 col-xl-8">
                        <div class="section__title-wrapper mb-50 tp-el-content">
                            
                            <?php if ( !empty($settings['tp_section_sub_title']) ) : ?>
                            <span class="section__title-pre tp-el-subtitle">
                                <?php echo tp_kses( $settings['tp_section_sub_title'] ); ?>
                            </span>
                            <?php endif; ?>

                            <?php
                                if ( !empty($settings['tp_section_title' ]) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['tp_section_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        tp_kses( $settings['tp_section_title' ] )
                                        );
                                endif;
                            ?>

                            <?php if ( !empty($settings['tp_section_description']) ) : ?>
                                <p><?php echo tp_kses( $settings['tp_section_description'] ); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
               </div>
               <?php endif; ?>
               <div class="row">
                  <div class="col-xxl-12">

                    <?php if ( !empty( $data ) ) :
                        foreach ( $data as $index => $value ) :
                            $social             = get_post_meta($value->ID, 'etn_event_socials', true);
                            $etn_event_location = get_post_meta($value->ID, 'etn_event_location', true);
                            $category           = Helper::cate_with_link($value->ID, 'etn_category');
                            $start_date         = get_post_meta( $value->ID, 'etn_start_date', true );
                            $end_date           = get_post_meta( $value->ID, 'etn_end_date', true );
                            // $etn_start_date_new = Helper::etn_date_new( $start_date );
                            $etn_start_date     = Helper::etn_date( $start_date );
                            $etn_end_date       = Helper::etn_date( $end_date );

                            $start_date_digit   = date("d", strtotime($start_date));
                            $start_date_year_month = date("F d, Y", strtotime($start_date));
                            
                            $event_options      = get_option("etn_event_options");
                            
                            $data = Helper::single_template_options( $value->ID );
                        

                        ?>
                    <div class="event__item white-bg transition-3 wow fadeInUp tp-el-box" data-wow-delay=".3s" data-wow-duration="1s">
                        <div class="row align-items-center">
                            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-6">
                                <h3 class="event__title tp-el-box-title">
                                    <a href="<?php echo get_the_permalink($value->ID); ?>"><?php echo get_the_title($value->ID); ?></a>
                                </h3>
                            </div>
                            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-6">
                                <div class="event__speaker">
                                    <ul>
                                        <?php 
                                            $etn_schedule = get_post_meta($value->ID, 'etn_event_schedule', true);
                            
                                            if ($etn_schedule != '') : 
                                                $etn_schedule_topics = get_post_meta($etn_schedule[0], 'etn_schedule_topics', true);
                                                $etn_schedule_speakers_ids = $etn_schedule_topics[0]['etn_shedule_speaker'];
                                            
                                            foreach($etn_schedule_speakers_ids as $speaker): 
                                                $speaker_name = get_post_meta($speaker, 'etn_speaker_title', true);
                                                $speaker_avatar = get_the_post_thumbnail_url( $speaker, 'thumbnail' );
                                                $speaker_url = get_the_permalink($speaker);
                                            ?>
                                        <li>
                                            <?php if(!empty($speaker_url)) : ?>
                                            <a href="<?php echo esc_url($speaker_url); ?>">
                                                <img src="<?php echo esc_url($speaker_avatar); ?>" alt="<?php echo esc_attr($speaker_name); ?>">
                                              
                                            </a>
                                            <?php else : ?>
                                                <img src="<?php echo esc_url($speaker_avatar); ?>" alt="<?php echo esc_attr($speaker_name); ?>">
                                            <?php endif; ?>
                                        </li>
                                        <?php endforeach; endif; ?>
                                    </ul>
                                    <span class="tp-el-box-subtitle"><?php echo esc_html__('Speaker', 'tpcore'); ?></span>
                                </div>


                                
                            </div>
                            <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-3 col-sm-6">
                                <div class="event__meta">
                                    <span class="tp-el-box-meta"><?php echo esc_html($start_date_year_month); ?></span>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6">
                                <div class="event__more float-lg-end">
                                    <a href="<?php echo esc_url(get_the_permalink($value->ID)); ?>" class="tp-btn-border-pink tp-el-box-btn" title="<?php echo get_the_title($value->ID); ?>"><?php echo esc_html__('Buy Tickets', 'tpcore'); ?>
                                        <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1 9L5 5L1 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                     </div>
                    <?php 
                        endforeach;
                        else : ?>
                            <p class="etn-not-found-post"><?php echo esc_html__('No Post Found', 'tpcore'); ?></p>
                    <?php endif; ?>
                  </div>
               </div>
            </div>
         </section>
         <!-- event area end -->

<?php endif; ?>

<?php
    }

}

$widgets_manager->register( new TP_Event_New_Post() );