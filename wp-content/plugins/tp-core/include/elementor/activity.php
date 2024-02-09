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
class TP_Activity extends Widget_Base {

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
		return 'tp-activity';
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
		return __( 'Activity', 'tpcore' );
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->tp_section_title_render_controls('activity', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.');

        $this->start_controls_section(
            'tp_activity_person_sec',
            [
                'label' => esc_html__( 'Activity Person', 'tpcore' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
         'tp_activity_image',
            [
                'label'   => esc_html__( 'Upload Image', 'tpcore' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                    'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_control(
            'tp_activity_num',
            [
                'label'       => esc_html__( 'Activity Number', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( '20+', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Number', 'tpcore' ),
            ]
        );
        $this->add_control(
            'tp_activity_num_text',
            [
                'label'       => esc_html__( 'Activity Number', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => esc_html__( 'our team <br> community', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Number', 'tpcore' ),
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
         'tp_activity_score_sc',
             [
               'label' => esc_html__( 'Activity', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
             ]
        );
        
        $this->add_control(
         'tp_activity_score',
            [
            'label'       => esc_html__( 'Activity Score', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXTAREA,
            'rows'        => 10,
            'default'     => esc_html__( 'Total Score 90%', 'tpcore' ),
            'placeholder' => esc_html__( 'Your Score', 'tpcore' ),
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
         'tp_activiy_exp_sec',
             [
               'label' => esc_html__( 'Activity Bar', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
             ]
        );
        
        $this->add_control(
         'tp_activiy_exp_text',
            [
            'label'       => esc_html__( 'Activity Text', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXTAREA,
            'rows'        => 10,
            'default'     => esc_html__( 'Photography', 'tpcore' ),
            'placeholder' => esc_html__( 'Placeholder Text', 'tpcore' ),
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
         'tp_activity_team_sec',
             [
               'label' => esc_html__( 'Team Activity', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
             ]
        );
        
        $this->add_control(
         'tp_activity_team_our',
         [
           'label'       => esc_html__( 'Our Team', 'tpcore' ),
           'type'        => \Elementor\Controls_Manager::TEXTAREA,
           'rows'        => 10,
           'default'     => esc_html__( 'Our Team Activity', 'tpcore' ),
           'placeholder' => esc_html__( 'Your Team Activity', 'tpcore' ),
         ]
        );
        $this->add_control(
         'tp_activity_team_other',
         [
           'label'       => esc_html__( 'Other Team', 'tpcore' ),
           'type'        => \Elementor\Controls_Manager::TEXTAREA,
           'rows'        => 10,
           'default'     => esc_html__( 'Other Team Activity', 'tpcore' ),
           'placeholder' => esc_html__( 'Other Team Activity', 'tpcore' ),
         ]
        );
        
        
        $this->end_controls_section();

        $this->start_controls_section(
        'tp_activity_shape_section',
            [
                'label' => esc_html__( 'Activity Shape', 'tpcore' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
        'tp_activity_shape_switch',
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
    }

    protected function style_tab_content(){
        $this->tp_section_style_controls('about_section', 'Section - Style', '.tp-el-section');

        $this->tp_basic_style_controls('about_subtitle', 'Acticity - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('about_title', 'Acticity - Title', '.tp-el-title');
        $this->tp_basic_style_controls('about_description', 'Acticity - Description', '.tp-el-content p');

        $this->tp_icon_style('about_list_num', 'Acticity - Number', '.tp-el-box-num');
        $this->tp_basic_style_controls('about_list_text', 'Acticity - Number Title', '.tp-el-box-text');

        $this->tp_basic_style_controls('about_bar_title', 'Skill - Title', '.tp-el-bar-title');
        $this->tp_section_style_controls('about_bar_bg', 'Skill - Background', '.tp-el-bar-item');
        $this->tp_section_style_controls('about_bar_bg_sm', 'Skill Small - Background', '.tp-el-bar-item-sm');
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
			$this->add_render_attribute('title_args', 'class', 'section__title-3 section__title-3-2 tp-el-title');
            if ( !empty($settings['tp_activity_image']['url']) ) {
                $tp_image_url = !empty($settings['tp_activity_image']['id']) ? wp_get_attachment_image_url( $settings['tp_activity_image']['id'], $settings['thumbnail_size']) : $settings['tp_activity_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_activity_image"]["id"], "_wp_attachment_image_alt", true);
        } 

            $bloginfo = get_bloginfo( 'name' ); 
		?>

         <!-- review area start -->
         <section class="review__area pt-120 pb-120 black-bg-5 tp-el-section">

            <?php if(!empty($settings['tp_activity_shape_switch'])) : ?>
            <div class="review__inner pt-130 pb-135 p-relative">
               <div class="review__shape">
                    <img class="review__shape-1" src="<?php echo get_template_directory_uri() . '/assets/img/review/shape/vector-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                    <img class="review__shape-2" src="<?php echo get_template_directory_uri() . '/assets/img/review/shape/vector-2.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                    <img class="review__shape-3" src="<?php echo get_template_directory_uri() . '/assets/img/review/shape/vector-3.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                    <img class="review__shape-4" src="<?php echo get_template_directory_uri() . '/assets/img/review/shape/vector-4.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                    <img class="review__shape-5" src="<?php echo get_template_directory_uri() . '/assets/img/review/shape/vector-5.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                    <img class="review__shape-6" src="<?php echo get_template_directory_uri() . '/assets/img/review/shape/vector-6.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                    <img class="review__shape-7" src="<?php echo get_template_directory_uri() . '/assets/img/review/shape/vector-7.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                </div>
            <?php endif; ?>

               <div class="container">
                  <div class="row">
                     <div class="col-xxl-6 col-xl-6 col-lg-6">
                        <div class="review__wrapper">
                            <?php if ( !empty($settings['tp_activity_section_title_show']) ) : ?>
                            <div class="section__title-wrapper-3 mb-40 tp-el-content">
                                <?php if(!empty($settings['tp_activity_sub_title'])): ?>
                                <span class="section__title-pre-3 tp-el-subtitle"><?php echo tp_kses($settings['tp_activity_sub_title']); ?></span>
                                <?php endif; ?>

                                <?php
                                if ( !empty($settings['tp_activity_title' ]) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['tp_activity_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        tp_kses( $settings['tp_activity_title' ] )
                                        );
                                endif;
                                ?>

                                <?php if (!empty($settings['tp_activity_description'])) : ?>
                                <p><?php echo tp_kses( $settings['tp_activity_description'] ); ?></p>
                                <?php endif; ?> 

                            </div>
                            <?php endif; ?>
                        </div>
                     

                           <div class="review__person d-flex align-items-center">
                               <img src="<?php echo esc_attr($tp_image_url); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                              <ul>
                                 <li>
                                    <span class="tp-el-box-num"><?php echo tp_kses($settings['tp_activity_num']); ?></span>
                                 </li>
                              </ul>
                              <p class="tp-el-box-text"><?php echo tp_kses($settings['tp_activity_num_text']); ?></p>
                           </div>
                        </div>
                        <div class="col-xxl-5 offset-xxl-1 col-xl-6 col-lg-6">
                            <div class="review__skill">
                                <?php if(!empty($settings['tp_activity_num_text'])) : ?>
                                <div class="review__skill-score">
                                    <p class="tp-el-bar-title"><?php echo tp_kses($settings['tp_activity_score']); ?></p>
                                </div>
                                <?php endif; ?>

                                <?php if(!empty($settings['tp_activiy_exp_text'])) : ?>
                                <div class="review__skill-item d-flex align-items-center justify-content-between mb-35 tp-el-bar-item">
                                    <?php echo tp_kses($settings['tp_activiy_exp_text']); ?>
                                </div>
                                <?php endif; ?>

                                <?php if(!empty($settings['tp_activity_team_our'])) : ?>
                                <div class="review__skill-item-sm d-flex align-items-center mb-10 ml-95 ">
                                    <p class="tp-el-bar-title"><?php echo tp_kses($settings['tp_activity_team_our']); ?></p>
                                    <div class="review__skill-item-sm-bar tp-el-bar-item"></div>
                                </div>
                                <?php endif; ?>

                                <?php if(!empty($settings['tp_activity_team_other'])) : ?>
                                <div class="review__skill-item-xs d-flex align-items-center ml-80">
                                    <p class="tp-el-bar-title"><?php echo tp_kses($settings['tp_activity_team_other']); ?></p>
                                    <div class="review__skill-item-xs-bar tp-el-bar-item-sm"></div>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- review area end -->
        <?php endif; ?>

        <?php
	}
}

$widgets_manager->register( new TP_Activity() );
