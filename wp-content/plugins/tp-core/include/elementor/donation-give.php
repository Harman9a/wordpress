<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Donation_Give extends Widget_Base {

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
		return 'donation-give';
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
		return __( 'Donation', 'tpcore' );
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

		$this->start_controls_section(
			'give_form_settings',
			[
				'label' => __( 'GiveWP Form Widget', 'dw4elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'form_id',
			[
				'label' => __( 'Form ID', 'dw4elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => __( 'Choose the GiveWP Form ID you want to embed.', 'dw4elementor' ),
				'input_type' => 'number',
			]
		);

		$this->add_control(
			'show_title',
			[
				'label' => __( 'Show Form Title', 'dw4elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'description' => __( 'Show/hide the GiveWP form title.', 'dw4elementor' ),
				'label_on' => __( 'Show', 'dw4elementor' ),
				'label_off' => __( 'Hide', 'dw4elementor' ),
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_goal',
			[
				'label' => __( 'Show Goal', 'dw4elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'description' => __( 'Show/hide the progress bar and goal for this form.', 'dw4elementor' ),
				'label_on' => __( 'Show', 'dw4elementor' ),
				'label_off' => __( 'Hide', 'dw4elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);


		$this->add_control(
			'show_content',
			[
				'label' => __( 'Show Form Content', 'dw4elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'description' => __( 'Show/hide the content of this form.', 'dw4elementor' ),
				'label_on' => __( 'Show', 'dw4elementor' ),
				'label_off' => __( 'Hide', 'dw4elementor' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'display_style',
			[
				'label' => __( 'Form Display Style', 'dw4elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'description' => __( 'Choose which display to use for this GiveWP form.', 'dw4elementor' ),
				'options' => [
					'onpage' => __('Full Form','dw4elementor'),
					'button' => __('Button Only', 'dw4elementor'),
					'modal' => __('Modal Reveal', 'dw4elementor'),
					'reveal' => __('Reveal', 'dw4elementor')
				],
				'default' => 'onpage'
			]
		);

		$this->add_control(
			'continue_button_title',
			[
				'label' => __( 'Reveal Button Text', 'dw4elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => __( 'Text on the button that reveals the form.', 'dw4elementor' ),
				'default' => __('Continue to Donate', 'dw4elementor'),
				'condition' => [
					'display_style!' => 'onpage',
				]
			]
		);

		$this->add_control(
			'give_form_info',
			[
				'label' => '',
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'content_classes' => 'dw4e-info',
				'raw' => '
					<div class="dw4e">
						<p class="info-head">
							' . __('GIVEWP FORM WIDGET', 'dw4elementor') . '</p>
						<p class="info-message">' . __('This is the GiveWP Form widget. Choose which form you want to embed on this page with it\'s form "ID".', 'dw4elementor') . '</p>
						<p class="dw4e-docs-links">
							<a href="https://givewp.com/documentation/core/shortcodes/give_form/?utm_source=plugin_settings&utm_medium=referral&utm_campaign=Free_Addons&utm_content=dw4elementor" rel="noopener noreferrer" target="_blank"><i class="fa fa-book" aria-hidden="true"></i>' . __('Visit the GiveWP Docs for more info on the GiveWP Form.', 'dw4elementor') . '</a>
						</p>
				</div>'
			]
		);

		$this->end_controls_section();

	}

	// style_tab_content
	protected function style_tab_content(){
        $this->tp_section_style_controls('cta_section', 'Section - Style', '.tp-el-section');
        $this->tp_section_style_controls('cta_box', 'Section - Box', '.tp-el-box');
        $this->tp_basic_style_controls('section_subtitle', 'Section - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('section_title', 'Section - Title', '.tp-el-title');
        $this->tp_basic_style_controls('section_description', 'Section - Description', '.tp-el-content p');
        
        
        $this->tp_input_controls_style('cta_box_input', 'Input Box', '.tp-el-box-input .give-donation-amount.form-row-wide');
        $this->tp_basic_style_controls('cta_box_input_text', 'Input Text', '.tp-el-box-input .give-currency-symbol.give-currency-position-before, .give-text-input.give-amount-top');
        $this->tp_link_controls_style('cta_box_btn', 'Price Box', '.tp-el-box-btn ul li button');
        $this->tp_link_controls_style('cta_box_btn_2', 'Button', '.tp-el-box-btn-2 form > button');
        // $this->tp_link_controls_style('cta_box_btn_arrow', 'CTA - Arrow Text', '.tp-el-box-btn-text');
        
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
		global $give_receipt_args, $donation;

		$settings = $this->get_settings_for_display();

		$form_id = ( 'yes' === $settings['form_id'] ? '' : esc_attr($settings['form_id']));
		$show_title = ( 'yes' === $settings['show_title'] ? 'true' :  'false');
		$show_goal = ( 'yes' === $settings['show_goal'] ? 'true' :  'false');
		$show_content = ( 'yes' === $settings['show_content'] ? 'true' :  'false');
		$display_style = esc_attr( $settings['display_style'] );
		$continue_button_title = esc_attr( $settings['continue_button_title'] );

		$html = do_shortcode('
			[give_form 
				id="' . $form_id . '" 
				show_title="' . $show_title . '" 
				show_goal="' . $show_goal . '" 
				show_content="' . $show_content . '" 
				display_style="' . $display_style . '" 
				continue_button_title="' . $continue_button_title . '" 
				]'
		);

		echo '<div class="givewp-elementor-widget give-form-shortcode-wrap">';
		echo '<div class ="tp-donation tp-el-box-btn tp-el-box-btn-2 tp-el-box-input">';
		echo $html;
		echo '</div> </div>';
	}

	/**
	 * Render the widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function content_template() {
		?>
		<div class="title">
			{{{ settings.title }}}
		</div>
		<?php
	}
}

$widgets_manager->register( new TP_Donation_Give() );