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
class TP_List extends Widget_Base {

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
		return 'tp-list';
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
		return __( 'TP List', 'tpcore' );
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
                    'layout-2' => esc_html__('Layout 2', 'tp-core'),
                    'layout-3' => esc_html__('Layout 3', 'tp-core'),
                    'layout-4' => esc_html__('Layout 4', 'tp-core'),
                    'layout-5' => esc_html__('Layout 5', 'tp-core'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

		$this->start_controls_section(
		 'tp_text_sec',
			 [
			   'label' => esc_html__( 'Title & Description', 'tpcore' ),
			   'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			 ]
		);

		$this->add_control(
		'tp_text_title',
		 [
			'label'       => esc_html__( 'Title', 'tpcore' ),
			'type'        => \Elementor\Controls_Manager::TEXT,
			'default'     => esc_html__( 'It started with a', 'tpcore' ),
			'placeholder' => esc_html__( 'Your Title', 'tpcore' ),
			'label_block' => true
		 ]
		);
		
		
		
		$this->end_controls_section();

		$this->start_controls_section(
		 'tp_list_sec',
			 [
			   'label' => esc_html__( 'Info List', 'tpcore' ),
			   'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			 ]
		);
		
		$repeater = new \Elementor\Repeater();
		
		$repeater->add_control(
		'tp_text_list_title',
		  [
			'label'   => esc_html__( 'Title', 'tpcore' ),
			'type'        => \Elementor\Controls_Manager::TEXT,
			'default'     => esc_html__( 'Default-value', 'tpcore' ),
			'label_block' => true,
		  ]
		);
		
		$this->add_control(
		  'tp_text_list_list',
		  [
			'label'       => esc_html__( 'Features List', 'tpcore' ),
			'type'        => \Elementor\Controls_Manager::REPEATER,
			'fields'      => $repeater->get_controls(),
			'default'     => [
			  [
				'tp_text_list_title'   => esc_html__( 'Neque sodales ut etiam', 'tpcore' ),
			  ],
			  [
				'tp_text_list_title'   => esc_html__( 'Adipiscing elit aliquam purus', 'tpcore' ),
			  ],
			  [
				'tp_text_list_title'   => esc_html__( 'Mauris commodo quis imperdiet', 'tpcore' ),
			  ],
			],
			'title_field' => '{{{ tp_text_list_title }}}',
		  ]
		);
		
		
		$this->end_controls_section();
    }

    protected function style_tab_content(){
		$this->tp_basic_style_controls('history_title', 'Title', '.tp-el-box-title');
		$this->tp_basic_style_controls('history_list', 'List', '.tp-el-box-list');
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

		<?php if ( $settings['tp_design_style']  == 'layout-2' ): ?>

            <div class="job__details-list mb-40">
                <?php if(!empty($settings['tp_text_title'])): ?>
                <h3 class="job__details-list-title-2 tp-el-box-title"><?php echo tp_kses($settings['tp_text_title']) ?></h3>
                <?php endif; ?>

                <ul>
                    <?php foreach ($settings['tp_text_list_list'] as $key => $item) :?>
                    <li class="tp-el-box-list"><?php echo tp_kses($item['tp_text_list_title']); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>

			<?php elseif ( $settings['tp_design_style']  == 'layout-3' ): ?>
			<div class="policy__list mb-35">
				<?php if(!empty($settings['tp_text_title'])): ?>
                <h3 class="policy__title tp-el-box-title"><?php echo tp_kses($settings['tp_text_title']) ?></h3>
                <?php endif; ?>
				<ul>
                    <?php foreach ($settings['tp_text_list_list'] as $key => $item) :?>
                    <li class="tp-el-box-list"><?php echo tp_kses($item['tp_text_list_title']); ?></li>
                    <?php endforeach; ?>
                </ul>
			</div>


			<?php elseif ( $settings['tp_design_style']  == 'layout-4' ): ?>
			<div class="services__details-list mb-45">
				<?php if(!empty($settings['tp_text_title'])): ?>
                <h3 class="services__details-list-title tp-el-box-title"><?php echo tp_kses($settings['tp_text_title']) ?></h3>
                <?php endif; ?>
				<ul>
					<?php foreach ($settings['tp_text_list_list'] as $key => $item) :?>
                    <li class="tp-el-box-list"><?php echo tp_kses($item['tp_text_list_title']); ?></li>
                    <?php endforeach; ?>
				</ul>
			</div>

		<?php elseif ( $settings['tp_design_style']  == 'layout-5' ): ?>

			<div class="event__details-list mb-60">
				<?php if(!empty($settings['tp_text_title'])): ?>
				<h3 class="event__details-list-title tp-el-box-title"><?php echo tp_kses($settings['tp_text_title']) ?></h3>
				<?php endif; ?>

				<ul class="has-two-side">
					<?php foreach ($settings['tp_text_list_list'] as $key => $item) :?>
                    <li class="tp-el-box-list"><?php echo tp_kses($item['tp_text_list_title']); ?></li>
                    <?php endforeach; ?>
				</ul>
			</div>

		<?php else: 

		?>	
        
         <div class="job__details-list mb-60">

            <?php if(!empty($settings['tp_text_title'])): ?>
            <h3 class="job__details-list-title tp-el-box-title"><?php echo tp_kses($settings['tp_text_title']) ?></h3>
            <?php endif; ?>
            <ul>
                <?php foreach ($settings['tp_text_list_list'] as $key => $item) :?>
                <li class="tp-el-box-list"><?php echo tp_kses($item['tp_text_list_title']); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <?php endif; ?>

        <?php 
	}
}

$widgets_manager->register( new TP_List() );