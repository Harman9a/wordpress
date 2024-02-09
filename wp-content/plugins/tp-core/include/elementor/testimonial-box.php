<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use TPCore\Elementor\Controls\Group_Control_TPBGGradient;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Testimonial_Box extends Widget_Base {

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
		return 'tp-testimonial-box';
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
		return __( 'Testimonial Box', 'tpcore' );
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->tp_section_title_render_controls('testimonial', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.');
   
        $this->start_controls_section(
         'tp_review_image_sec',
            [
            'label' => esc_html__( 'Reviewer', 'Text-domain' ),
            'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'reviewer_image',
            [
                'label'   => esc_html__( 'Upload Reviewer Image', 'Text-domain' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                    'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        
        $this->add_control(
            'reviewer_name', [
                'label' => esc_html__( 'Reviewer Name', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Rasalina William' , 'tpcore' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'reviewer_title', [
                'label' => esc_html__( 'Reviewer Title', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( '- CEO at YES Germany' , 'tpcore' ),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'review_content',
            [
                'label' => esc_html__( 'Review Content', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => 'Aklima The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections Bonorum et Malorum original.',
                'placeholder' => esc_html__( 'Type your review content here', 'tpcore' ),
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail_size',
                'default' => 'thumbnail',
                'exclude' => ['custom'],
                'separator' => 'none',
            ]
        );
        $this->end_controls_section();

	}

    // style_tab_content
    protected function style_tab_content(){
  
        $this->tp_section_style_controls('section_section', 'Section - Style', '.tp-el-section');

        $this->tp_basic_style_controls('testimonial_box_title', 'Testimonial - Name', '.tp-el-box-title');
        $this->tp_basic_style_controls('testimonial_box_subtitle', 'Testimonial - Designation', '.tp-el-box-subtitle');
        $this->tp_basic_style_controls('testimonial_box_desc', 'Testimonial - Description', '.tp-el-box-desc');
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

		<!--	testimonial style 2 -->
		<?php if ( $settings['tp_design_style']  == 'layout-2' ):

			$this->add_render_attribute('title_args', 'class', 'section__title-4 section__title-4-white tp-el-title');

		?>

		<!-- default style -->
		<?php else:
            if ( !empty($settings['reviewer_image']['url']) ) {
                $tp_reviewer_image = !empty($settings['reviewer_image']['id']) ? wp_get_attachment_image_url( $settings['reviewer_image']['id'], $settings['thumbnail_size_size']) : $settings['reviewer_image']['url'];
                $tp_reviewer_image_alt = get_post_meta($settings["reviewer_image"]["id"], "_wp_attachment_image_alt", true);
            }
            $this->add_render_attribute('title_args', 'class', 'tp-el-title');
        ?>

            <div class="testimonial__item-3 tp-el-section">
                <div class="testimonial__avater-3 mb-35 d-sm-flex align-items-center">

                    <?php if ( !empty($tp_reviewer_image) ) : ?>
                    <div class="testimonial__avater-thumb-3">
                        <img src="<?php echo esc_url($tp_reviewer_image); ?>" alt="<?php echo esc_url($tp_reviewer_image_alt); ?>">
                    </div>
                    <?php endif; ?>

                    
                    <div class="tesimonial__avater-info-3">
                        <?php if ( !empty($settings['reviewer_name']) ) : ?>
                        <h4 class="testimonial__avater-title-3 tp-el-box-title"><?php echo tp_kses($settings['reviewer_name']); ?></h4>
                        <?php endif; ?>
                        <?php if ( !empty($settings['reviewer_title']) ) : ?>
                        <span class="testimonial__avater-designation-3 tp-el-box-subtitle"><?php echo tp_kses($settings['reviewer_title']); ?></span>
                        <?php endif; ?>
                    </div>

                </div>

                <?php if ( !empty($settings['review_content']) ) : ?>
                <div class="testimonial__content-3">
                    <p class="tp-el-box-desc"><?php echo tp_kses($settings['review_content']); ?></p>
                </div>
                <?php endif; ?>

            </div>

        <?php endif; ?>

        <?php
	}
}

$widgets_manager->register( new TP_Testimonial_Box() );
