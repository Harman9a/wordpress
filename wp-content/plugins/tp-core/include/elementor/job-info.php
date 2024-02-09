<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Utils;
use \Elementor\Control_Media;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Typography;
Use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Job_Info extends Widget_Base {

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
		return 'tp-job-info';
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
		return __( 'Job Info', 'tpcore' );
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
         'tp_job_sec',
             [
               'label' => esc_html__( 'Job Details', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
             ]
        );
        
        $this->add_control(
        'tp_job_subtitle',
            [
                'label'       => esc_html__( 'Job Sub Title', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Traine', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
                'label_block' => true
            ]
        );
        
        $this->add_control(
        'tp_job_title',
            [
                'label'       => esc_html__( 'Job Title', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Javascript Developer', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
                'label_block' => true
            ]
        );

        $this->add_control(
        'tp_job_category',
         [
            'label'       => esc_html__( 'Job Category', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( 'Developer', 'tpcore' ),
            'placeholder' => esc_html__( 'Your text', 'tpcore' ),
            'label_block' => true
         ]
        );

        $this->add_control(
         'tp_job_desc',
         [
           'label'       => esc_html__( 'Job Description', 'tpcore' ),
           'type'        => \Elementor\Controls_Manager::TEXTAREA,
           'rows'        => 10,
           'default'     => esc_html__( 'We’re a collective of thinkers and tinkerers—designers, engineers, writers, and strategists building the platform ', 'tpcore' ),
           'placeholder' => esc_html__( 'Your Description', 'tpcore' ),
         ]
        );

        
        $repeater = new \Elementor\Repeater();

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
                        'tp_box_icon_type' => 'icon',
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
                    ]
                ]
            );
        }
        
         $repeater->add_control(
         'tp_job_info_title',
           [
             'label'   => esc_html__( 'Title', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::TEXT,
             'default'     => esc_html__( 'Full Time', 'tpcore' ),
             'label_block' => true,
           ]
         );
         
         
         $this->add_control(
           'tp_job_info_list',
           [
             'label'       => esc_html__( 'Info List', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::REPEATER,
             'fields'      => $repeater->get_controls(),
             'default'     => [
               [
                 'tp_job_info_title'   => esc_html__( 'Full Time', 'tpcore' ),
               ],
             ],
             'title_field' => '{{{ tp_job_info_title }}}',
           ]
         );
        
        $this->end_controls_section();

        $this->start_controls_section(
         'tp_job_thumb_sec',
             [
               'label' => esc_html__( 'Thumbnail', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
             ]
        );
        
        $this->add_control(
         'tp_image',
         [
           'label'   => esc_html__( 'Upload Image', 'tpcore' ),
           'type'    => \Elementor\Controls_Manager::MEDIA,
             'default' => [
               'url' => \Elementor\Utils::get_placeholder_image_src(),
           ],
         ]
        );
        
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tp_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );
        $this->end_controls_section();
    }
    protected function style_tab_content(){
        $this->tp_section_style_controls('history_section', 'Section - Style', '.tp-el-section');
        $this->tp_link_controls_style('history_subtitle', 'Job - Tag', '.tp-el-box-tag');
        $this->tp_basic_style_controls('history_title', 'Job - Title', '.tp-el-box-title');
        $this->tp_basic_style_controls('history_description', 'Job - Description', '.tp-el-box-desc');
        $this->tp_link_controls_style('history_meta', 'Job - Meta', '.tp-el-box-meta');
        $this->tp_link_controls_style('history_meta_2', 'Job - Info', '.tp-el-box-meta-2 span');

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
		$settings = $this->get_settings_for_display(); ?>

		<?php if ( $settings['tp_design_style']  == 'layout-2' ):
            $this->add_render_attribute('title_args', 'class', 'tp-title tp-el-box-title');
        ?>
                    

		<?php else:

            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }
		?>

         <!-- job details area start -->
         <section class="job__details-area pt-120 tp-el-section">
            <div class="container">
               <div class="row">
                  <div class="col-xxl-12">
                     <div class="job__details-wrapper">
                        <div class="job__details-content mb-50">

                            <?php if (!empty($settings['tp_job_subtitle'])): ?>
                            <div class="job__details-tag mb-10">
                                <span class="tp-el-box-tag"><?php echo $settings['tp_job_subtitle']; ?></span>
                            </div>
                            <?php endif; ?>

                            <?php if (!empty($settings['tp_job_title'])): ?>
                           <h3 class="job__details-title tp-el-box-title"><?php echo $settings['tp_job_title']; ?></h3>
                           <?php endif; ?>

                           <div class="job__meta-wrapper job__details-meta mb-60 d-sm-flex flex-wrap align-items-center">
                              <div class="job__meta-item tp-el-box-meta-2">
                                <?php foreach ($settings['tp_job_info_list'] as $key => $item) :?>
                                 <?php if($item['tp_box_icon_type'] == 'icon') : ?>
                                    <?php if (!empty($item['tp_box_icon']) || !empty($item['tp_box_selected_icon']['value'])) : ?>
                                            <span>
                                                <?php tp_render_icon($item, 'tp_box_icon', 'tp_box_selected_icon'); ?>
                                                <?php echo $item['tp_job_info_title']; ?>
                                            </span>
                                    <?php endif; ?>
                                <?php elseif( $item['tp_box_icon_type'] == 'image' ) : ?>
                                    <span>
                                        <?php if (!empty($item['tp_box_icon_image']['url'])): ?>
                                        <img src="<?php echo $item['tp_box_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                        <?php endif; ?>
                                        <?php echo $item['tp_job_info_title']; ?>
                                    </span>
                                <?php else : ?>
                                    <span>
                                        <?php if (!empty($item['tp_box_icon_svg'])): ?>
                                        <?php echo $item['tp_box_icon_svg']; ?>
                                        <?php endif; ?>
                                        <?php echo $item['tp_job_info_title']; ?>
                                    </span>
                                <?php endif; ?>

                                <?php endforeach; ?>
                              </div>

                              <?php if (!empty($settings['tp_job_category'])): ?>
                              <div class="job__tag">
                                 <span class="tp-el-box-meta"><?php echo $settings['tp_job_category']; ?></span>
                              </div>
                              <?php endif; ?>
                           </div>

                           <?php if (!empty($tp_image)): ?>
                           <div class="job__details-thumb m-img mb-60">
                              <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                           </div>
                           <?php endif; ?>

                           <?php if (!empty($settings['tp_job_desc'])): ?>
                           <p class="tp-el-box-desc"><?php echo $settings['tp_job_desc']; ?></p>
                           <?php endif; ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- job details area emd -->


        <?php endif; ?>

        <?php
	}
}

$widgets_manager->register( new TP_Job_Info() );
