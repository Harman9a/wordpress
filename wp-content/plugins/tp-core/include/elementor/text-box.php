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
class TP_Text_Box extends Widget_Base {

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
		return 'tp-text-box';
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
		return __( 'TP Text Box', 'tpcore' );
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
		
		$this->add_control(
		'tp_text_description',
		 [
			'label'       => esc_html__( 'Description', 'tpcore' ),
			'type'        => \Elementor\Controls_Manager::TEXTAREA,
			'default'     => esc_html__( 'Ut at maximus magna. Vestibulum interdum sapien in facilisis imperdiet.', 'tpcore' ),
			'placeholder' => esc_html__( 'Your Description', 'tpcore' ),
			'label_block' => true
		 ]
		);
		
		$this->add_control(
		'tp_text_description_2',
			[
				'label'       => esc_html__( 'Description 2', 'tpcore' ),
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
				'default'     => esc_html__( 'Ut at maximus magna. Vestibulum interdum sapien in facilisis imperdiet.', 'tpcore' ),
				'placeholder' => esc_html__( 'Your Description', 'tpcore' ),
				'label_block' => true,
				'condition' => [
					'tp_design_style' => 'layout-2'
				]
			]
		);
		
		$this->end_controls_section();

		$this->start_controls_section(
		 'tp_list_sec',
			 [
			   'label' => esc_html__( 'Info List', 'tpcore' ),
			   'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			   'condition' => [
					'tp_design_style' => 'layout-2'
				]
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

        // _tp_image
		$this->start_controls_section(
            '_tp_image',
            [
                'label' => esc_html__('Thumbnail', 'tp-core'),
                'condition' => [
                    'tp_design_style' => ['layout-4']
                ]
            ]
        );
        $this->add_control(
            'tp_image',
            [
                'label' => esc_html__( 'Choose Image', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );        

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );
        $this->end_controls_section();
    }

    protected function style_tab_content(){
		$this->tp_section_style_controls('services_section', 'Section - Style', '.tp-el-section');


        $this->tp_basic_style_controls('services_box_title', 'Box - Title', '.tp-el-box-title');
        $this->tp_basic_style_controls('services_box_description', 'Box - Description', '.tp-el-box-desc, .tp-el-box-desc p');
        $this->tp_basic_style_controls('services_box_link_list', 'Box - List', '.tp-el-box-list ul li, .tp-el-box-list ol li');
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

         <!-- team details about area start -->
         <div class="team__details-about tp-el-section">
            <div class="container">
               <div class="team__details-about-border pt-90 pb-65">
                  <div class="row justify-content-center">
                     <div class="col-lg-8">
                        <div class="team__details-about-content wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s">

						   	<?php if(!empty($settings['tp_text_title'])): ?>
							<h3 class="team__details-about-title tp-el-box-title"><?php echo tp_kses($settings['tp_text_title']) ?></h3>
							<?php endif; ?>

							<?php if(!empty($settings['tp_text_description'])): ?>
							<p class="tp-el-box-desc"><?php echo tp_kses($settings['tp_text_description']); ?></p>
							<?php endif; ?>

                           <div class="team__details-about-list pt-10 mb-35 tp-el-box-list">
                              <ol>
							  	<?php foreach ($settings['tp_text_list_list'] as $key => $item) :?>
                                 <li><?php echo tp_kses($item['tp_text_list_title']); ?></li>
								 <?php endforeach; ?>
                              </ol>
                           </div>

                           <?php if(!empty($settings['tp_text_description_2'])): ?>
							<p class="tp-el-box-desc"><?php echo tp_kses($settings['tp_text_description_2']); ?></p>
							<?php endif; ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- team details about area end -->

		 <?php elseif ( $settings['tp_design_style']  == 'layout-3' ): ?>
		<section class="job__details-area tp-el-section">
			<div class="container">
				<div class="row">
					<div class="col-xxl-12">
						<div class="job__details-wrapper">
							<div class="job__details-about mb-35">
								<?php if(!empty($settings['tp_text_title'])): ?>
								<h3 class="job__details-about-title tp-el-box-title"><?php echo tp_kses($settings['tp_text_title']) ?></h3>
							<?php endif; ?>

							<?php if(!empty($settings['tp_text_description'])): ?>
							<p class="tp-el-box-desc"><?php echo tp_kses($settings['tp_text_description']); ?></p>
							<?php endif; ?>
						</div>
					</div>
                  </div>
               </div>
            </div>
         </section>


		<?php else: 

		?>	
         <!-- about text area start -->
         <section class="about__text pt-115 pb-100 tp-el-section">
            <div class="container">
               <div class="row">
                  <div class="col-xl-4 col-lg-4">
                     <div class="about__text-wrapper wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s">
						<?php if(!empty($settings['tp_text_title'])): ?>
                        <h3 class="about__text-title tp-el-box-title"><?php echo tp_kses($settings['tp_text_title']) ?></h3>
						<?php endif; ?>
                     </div>
                  </div>
                  <div class="col-xl-8 col-lg-8">
                     <div class="about__text wow fadeInUp tp-el-box-desc" data-wow-delay=".6s" data-wow-duration="1s">
					 <?php echo tp_kses($settings['tp_text_description']); ?>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- about text area end -->
        

        <?php endif; ?>

        <?php 
	}
}

$widgets_manager->register( new TP_Text_Box() );