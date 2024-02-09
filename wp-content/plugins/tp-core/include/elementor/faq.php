<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_FAQ extends Widget_Base {

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
		return 'tp-faq';
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
		return __( 'FAQ', 'tpcore' );
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
                    'layout-4' => esc_html__('Layout 4', 'tpcore'),
                    'layout-5' => esc_html__('Layout 5', 'tpcore'),
                ],
                'default' => 'layout-1',
            ]
        );

		$this->add_control(
		 'enable_style_2',
		 [
		   'label'        => esc_html__( 'Enable Style 2', 'tpcore' ),
		   'type'         => \Elementor\Controls_Manager::SWITCHER,
		   'label_on'     => esc_html__( 'Show', 'tpcore' ),
		   'label_off'    => esc_html__( 'Hide', 'tpcore' ),
		   'return_value' => 'yes',
		   'default'      => 'no',
		   'condition' => [
			'tp_design_style' => ['layout-2']
		]
		 ]
		);

		$this->add_control(
		 	'ac_style_2',
			[
				'label'        => esc_html__( 'Enable Accordion 2nd ID', 'tpcore' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'tpcore' ),
				'label_off'    => esc_html__( 'Hide', 'tpcore' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'condition' => [
					'tp_design_style' => ['layout-2', 'layout-4']
				]
			]
		);

		$this->add_control(
		 	'ac_style_3',
			[
				'label'        => esc_html__( 'Enable Accordion 3rd ID', 'tpcore' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'tpcore' ),
				'label_off'    => esc_html__( 'Hide', 'tpcore' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'condition' => [
					'tp_design_style' => ['layout-2', 'layout-4']
				]
			]
		);

		$this->add_control(
		 	'ac_style_4',
			[
				'label'        => esc_html__( 'Enable Accordion 4th ID', 'tpcore' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'tpcore' ),
				'label_off'    => esc_html__( 'Hide', 'tpcore' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'condition' => [
					'tp_design_style' => ['layout-2', 'layout-4']
				]
			]
		);

		$this->add_control(
		 	'ac_style_5',
			[
				'label'        => esc_html__( 'Enable Accordion 5th ID', 'tpcore' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'tpcore' ),
				'label_off'    => esc_html__( 'Hide', 'tpcore' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'condition' => [
					'tp_design_style' => ['layout-2', 'layout-4']
				]
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'tp_faq_section_title',
            [
                'label' => esc_html__('Title & Content', 'tpcore'),
				'condition' => [
					'tp_design_style' => ['layout-3', 'layout-4', 'layout-5']
				]
            ]
        );
        if (true){
            $this->add_control(
                'tp_faq_section_title_show',
                [
                    'label' => esc_html__( 'Section Title & Content', 'tpcore' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', 'tpcore' ),
                    'label_off' => esc_html__( 'Hide', 'tpcore' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
        }

        $this->add_control(
            'tp_faq_sub_title',
            [
                'label' => esc_html__('Sub Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Subtitle Here',
                'placeholder' => esc_html__('Type Before Heading Text', 'tpcore'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'tp_faq_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Your Section Title',
                'placeholder' => esc_html__('Type Heading Text', 'tpcore'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'tp_faq_title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'tpcore'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => esc_html__('H1', 'tpcore'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => esc_html__('H2', 'tpcore'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => esc_html__('H3', 'tpcore'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => esc_html__('H4', 'tpcore'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => esc_html__('H5', 'tpcore'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => esc_html__('H6', 'tpcore'),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h3',
                'toggle' => false,
            ]
        );

        $this->add_control(
            'tp_faq_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Cepteur sint occaecat cupidatat proident, taken possession of my entire soul',
                'placeholder' => esc_html__('Type section description here', 'tpcore'),
            ]
        );
        $this->add_responsive_control(
            'tp_faq_align',
            [
                'label' => esc_html__('Alignment', 'tp-core'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'text-start' => [
                        'title' => esc_html__('Left', 'tp-core'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'text-center' => [
                        'title' => esc_html__('Center', 'tp-core'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'text-end' => [
                        'title' => esc_html__('Right', 'tp-core'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'text-center',
                'toggle' => false,
            ]
        );
        $this->end_controls_section();

		$this->start_controls_section(
		 'tp_faq_video_sec',
			 [
			   'label' => esc_html__( 'Section Label', 'tpcore' ),
			   'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			   'condition' => [
				'tp_design_style' => 'layout-3'
			   ]
			 ]
		);
		
		$this->add_control(
		 'tp_faq_video_url',
		 [
		   'label'   => esc_html__( 'Video URL', 'tpcore' ),
		   'type'        => \Elementor\Controls_Manager::URL,
		   'default'     => [
			   'url'               => '#',
			   'is_external'       => true,
			   'nofollow'          => true,
			   'custom_attributes' => '',
			 ],
			 'placeholder' => esc_html__( 'Your URL', 'tpcore' ),
			 'label_block' => true,
		   ]
		 );
		
		 $this->add_control(
		  'tp_image',
		  [
			'label'   => esc_html__( 'Section Label', 'tpcore' ),
			'type'    => \Elementor\Controls_Manager::MEDIA,
			  'default' => [
				'url' => \Elementor\Utils::get_placeholder_image_src(),
			],
		  ]
		 );
		 $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                // 'default' => 'tp-portfolio-thumb',
            ]
        );
		$this->end_controls_section();

		$this->start_controls_section(
            '_accordion',
            [
                'label' => esc_html__( 'Accordion', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'accordion_title', [
                'label' => esc_html__( 'Accordion Item', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'This is accordion item title' , 'tpcore' ),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'accordion_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Facilis fugiat hic ipsam iusto laudantium libero maiores minima molestiae mollitia repellat rerum sunt ullam voluptates? Perferendis, suscipit.',
                'label_block' => true,
            ]
        );
        $this->add_control(
            'accordions',
            [
                'label' => esc_html__( 'Repeater Accordion', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'accordion_title' => esc_html__( 'This is accordion item title #1', 'tpcore' ),
                    ],
                    [
                        'accordion_title' => esc_html__( 'This is accordion item title #2', 'tpcore' ),
                    ],
                    [
                        'accordion_title' => esc_html__( 'This is accordion item title #3', 'tpcore' ),
                    ],
                    [
                        'accordion_title' => esc_html__( 'This is accordion item title #4', 'tpcore' ),
                    ],
                ],
                'title_field' => '{{{ accordion_title }}}',
            ]
        );

        $this->add_control(
            'space_accordion_item',
            [
                'label' => esc_html__( 'Accordion space gap', 'tpcore' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .faq__wrapper .accordion-item' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

		$this->start_controls_section(
		 'faq_side_text_control',
			 [
			   'label' => esc_html__( 'Faq Side Text', 'tpcore' ),
			   'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => [
					'tp_design_style' => 'layout-1' 
				]
			 ]
		);
		
		
		$this->add_control(
			'faq_side_text',
				[
					'label'       => esc_html__( 'Faq Side Text', 'tpcore' ),
					'type'        => \Elementor\Controls_Manager::TEXT,
					'default'     => esc_html__( 'FAQ', 'tpcore' ),
					'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
				]
		);
		
		$this->end_controls_section();
	}

	protected function style_tab_content(){
		$this->tp_section_style_controls('faq_section', 'Section - Style', '.tp-el-section');
		$this->tp_basic_style_controls('about_subtitle', 'Section - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('about_title', 'Section - Title', '.tp-el-title');
        $this->tp_basic_style_controls('about_description', 'Section - Description', '.tp-el-content-desc');

		$this->tp_section_style_controls('faq_box', 'Box - Style', '.tp-el-box');
		$this->tp_basic_style_controls('faq_title', 'Faq - Title', '.tp-el-box-title');
		$this->tp_basic_style_controls('faq_description', 'Faq - Description', '.tp-el-box-desc');
		$this->tp_basic_style_controls('faq_side_title', 'Faq - Side Text', '.tp-el-box-side-text');

		$this->tp_link_controls_style('faq_video', 'Video Button', '.tp-el-video-btn');
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
            			
			if($settings['ac_style_2'] == 'yes'){
				$ac_id = 'ac-id-2';
				$ac_id_head = 'ac-id-head-2';
			}

			elseif($settings['ac_style_3'] == 'yes'){
				$ac_id = 'ac-id-3';
				$ac_id_head = 'ac-id-head-3';
			}

			elseif($settings['ac_style_4'] == 'yes'){
				$ac_id = 'ac-id-4';
				$ac_id_head = 'ac-id-head-4';
			}

			elseif($settings['ac_style_5'] == 'yes'){
				$ac_id = 'ac-id-5';
				$ac_id_head = 'ac-id-head-5';
			}

			else{
				$ac_id = 'collapseOne';
				$ac_id_head = 'headingOne';
			}
			

			if($settings['enable_style_2'] == 'yes'){
                $enable_style_2 = 'faq__style-3';
            }else{
                $enable_style_2 = '';
            }

			
        ?>

		<div class="tp-accordion-style <?php echo esc_attr($enable_style_2); ?> tp-el-section">
			<div class="faq__tab-content tp-accordion">
				<div class="accordion" id="general_accordion-<?php echo esc_attr($this->get_id()); ?>">
					<?php  foreach ( $settings['accordions'] as $index => $item) :
						$collapsed = ($index == '0' ) ? '' : 'collapsed';
						$aria_expanded = ($index == '0' ) ? "true" : "false";
						$show = ($index == '0' ) ? "show" : "";
	
						
	
					?>
					<div class="accordion-item tp-el-box">
						<h2 class="accordion-header" id="<?php echo esc_attr($ac_id_head);?>-<?php echo esc_attr($index); ?>">
							<button class="accordion-button tp-el-box-title <?php echo esc_attr($collapsed); ?>" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo esc_attr($ac_id); ?>-<?php echo esc_attr($index); ?>" aria-expanded="<?php echo esc_attr($aria_expanded); ?>" aria-controls="<?php echo esc_attr($ac_id); ?>-<?php echo esc_attr($index); ?>">
							<?php echo esc_html($item['accordion_title']); ?>
							</button>
						</h2>
						<div id="<?php echo esc_attr($ac_id); ?>-<?php echo esc_attr($index); ?>" class="accordion-collapse collapse <?php echo esc_attr($show); ?>" aria-labelledby="<?php echo esc_attr($ac_id_head); ?>-<?php echo esc_attr($index); ?>" data-bs-parent="#general_accordion-<?php echo esc_attr($this->get_id()); ?>">
							<div class="accordion-body">
								<p class="tp-el-box-desc"><?php echo tp_kses($item['accordion_description']); ?></p>
							</div>
						</div>
					</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>

		<?php elseif ( $settings['tp_design_style']  == 'layout-3' ): 
			$this->add_render_attribute('title_args', 'class', 'faq__title tp-el-title');

			if ( !empty($settings['tp_image']['url']) ) {
				$tp_image_url = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['thumbnail_size']) : $settings['tp_image']['url'];
				$tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
				
			}
		?>

         <!-- faq area start -->
         <section class="faq__area p-relative tp-el-section">
            <div class="faq__video" data-background="<?php echo esc_url($tp_image_url); ?>">
			<?php if(!empty($settings['tp_faq_video_url']['url'])): ?>
               <div class="faq__video-btn">
                  <a href="<?php echo esc_url($settings['tp_faq_video_url']['url']); ?>" class="tp-pulse-border popup-video tp-el-video-btn">
                     <svg width="18" height="22" viewBox="0 0 18 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 11L0 21.3923V0.607696L18 11Z" fill="currentColor"/>
                     </svg>                        
                  </a>
               </div>
			   <?php endif; ?>
            </div>
            <div class="container-fluid">
               <div class="row justify-content-end">
                  <div class="col-xxl-7 col-xl-7 col-lg-7">
                     <div class="faq__wrapper-2 faq__gradient-border faq__style-2 tp-accordion pl-160">
					 <?php if ( !empty($settings['tp_faq_section_title_show']) ) : ?>
                        <div class="faq__title-wrapper">

						   <?php if ( !empty($settings['tp_faq_sub_title']) ) : ?>
							<span class="faq__title-pre tp-el-subtitle"><?php echo tp_kses( $settings['tp_faq_sub_title'] ); ?></span>
							<?php endif; ?>
							<?php
								if ( !empty($settings['tp_faq_title' ]) ) :
									printf( '<%1$s %2$s>%3$s</%1$s>',
										tag_escape( $settings['tp_faq_title_tag'] ),
										$this->get_render_attribute_string( 'title_args' ),
										tp_kses( $settings['tp_faq_title' ] )
										);
								endif;
							?>

						<?php if ( !empty($settings['tp_faq_description']) ) : ?>
                            <p class="tp-el-content-desc"><?php echo tp_kses( $settings['tp_faq_description'] ); ?></p>
                        <?php endif; ?>

                        </div>
						<?php endif; ?>
                        <div class="accordion" id="faqaccordion-<?php echo esc_attr($this->get_id()); ?>">
							<?php foreach ( $settings['accordions'] as $index => $item) :
								$collapsed = ($index == '0' ) ? '' : 'collapsed';
								$aria_expanded = ($index == '0' ) ? "true" : "false";
								$show = ($index == '0' ) ? "show" : "";

							?>
                           <div class="accordion-item tp-el-box">
                             <h2 class="accordion-header" id="headingOne-<?php echo esc_attr($index); ?>">
                               <button class="accordion-button tp-el-box-title <?php echo esc_attr($collapsed); ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne-<?php echo esc_attr($index); ?>" aria-expanded="<?php echo esc_attr($aria_expanded); ?>" aria-controls="collapseOne-<?php echo esc_attr($index); ?>">
							   <?php echo esc_html($item['accordion_title']); ?>
                                 <span class="accordion-btn"></span>
                               </button>
                             </h2>
                             <div id="collapseOne-<?php echo esc_attr($index); ?>" class="accordion-collapse collapse <?php echo esc_attr($show); ?>" aria-labelledby="headingOne-<?php echo esc_attr($index); ?>" data-bs-parent="#faqaccordion-<?php echo esc_attr($this->get_id()); ?>">
                               <div class="accordion-body">
                                 <p class="tp-el-box-desc"><?php echo tp_kses($item['accordion_description']); ?></p>
                               </div>
                             </div>
                           </div>
						   <?php endforeach; ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- faq area end -->

		 <?php elseif ( $settings['tp_design_style']  == 'layout-4' ): 
			$this->add_render_attribute('title_args', 'class', 'faq__title-2 tp-el-title');

			if ( !empty($settings['tp_image']['url']) ) {
				$tp_image_url = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['thumbnail_size_size']) : $settings['tp_image']['url'];
				$tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
				
			}

			if($settings['ac_style_2'] == 'yes'){
				$ac_id = 'ac-id-2';
				$ac_id_head = 'ac-id-head-2';
			}

			elseif($settings['ac_style_3'] == 'yes'){
				$ac_id = 'ac-id-3';
				$ac_id_head = 'ac-id-head-3';
			}

			elseif($settings['ac_style_4'] == 'yes'){
				$ac_id = 'ac-id-4';
				$ac_id_head = 'ac-id-head-4';
			}

			elseif($settings['ac_style_5'] == 'yes'){
				$ac_id = 'ac-id-5';
				$ac_id_head = 'ac-id-head-5';
			}

			else{
				$ac_id = 'collapseOne';
				$ac_id_head = 'headingOne';
			}
			
		?>

		<div class="faq__item pb-95 tp-el-section">
			<div class="row">
			<?php if ( !empty($settings['tp_faq_section_title_show']) ) : ?>
				<div class="col-xl-3 col-lg-3 col-md-4">
					<div class="faq__content">
						<?php if ( !empty($settings['tp_faq_sub_title']) ) : ?>
						<span class="faq__title-pre tp-el-subtitle"><?php echo tp_kses( $settings['tp_faq_sub_title'] ); ?></span>
						<?php endif; ?>

						<?php
							if ( !empty($settings['tp_faq_title' ]) ) :
								printf( '<%1$s %2$s>%3$s</%1$s>',
									tag_escape( $settings['tp_faq_title_tag'] ),
									$this->get_render_attribute_string( 'title_args' ),
									tp_kses( $settings['tp_faq_title' ] )
									);
							endif;
						?>
						<?php if ( !empty($settings['tp_faq_description']) ) : ?>
						<p class="tp-el-content-desc"><?php echo tp_kses( $settings['tp_faq_description'] ); ?></p>
						<?php endif; ?>
					</div>
				</div>
				<?php endif; ?>
				<div class="col-xl-9 col-lg-9 col-md-8">
					<div class="faq__wrapper faq__style-4 tp-accordion">
					<div class="accordion" id="general_accordion-<?php echo esc_attr($this->get_id()); ?>">
						<?php foreach ( $settings['accordions'] as $index => $item) :
							$collapsed = ($index == '0' ) ? '' : 'collapsed';
							$aria_expanded = ($index == '0' ) ? "true" : "false";
							$show = ($index == '0' ) ? "show" : "";

						?>
						<div class="accordion-item tp-el-box">
							<h2 class="accordion-header" id="<?php echo esc_attr($ac_id_head);?>-<?php echo esc_attr($index); ?>">
								<button class="accordion-button tp-el-box-title <?php echo esc_attr($collapsed); ?>" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo esc_attr($ac_id); ?>-<?php echo esc_attr($index); ?>" aria-expanded="<?php echo esc_attr($aria_expanded); ?>" aria-controls="<?php echo esc_attr($ac_id); ?>-<?php echo esc_attr($index); ?>">
								<?php echo esc_html($item['accordion_title']); ?>
								<span class="accordion-btn"></span>
								</button>
							</h2>
							<div id="<?php echo esc_attr($ac_id); ?>-<?php echo esc_attr($index); ?>" class="accordion-collapse collapse <?php echo esc_attr($show); ?>" aria-labelledby="<?php echo esc_attr($ac_id_head); ?>-<?php echo esc_attr($index); ?>" data-bs-parent="#general_accordion-<?php echo esc_attr($this->get_id()); ?>">
								<div class="accordion-body">
									<p class="tp-el-box-desc"><?php echo tp_kses($item['accordion_description']); ?></p>
								</div>
							</div>
						</div>
						<?php endforeach; ?>
					</div>
					</div>
				</div>
			</div>
		</div>

		<?php elseif ( $settings['tp_design_style']  == 'layout-5' ): 
			$this->add_render_attribute('title_args', 'class', 'services__details-faq-title tp-el-title');			
		?>

		<div class="services__details-faq faq__style-3 tp-el-section">
		<?php if ( !empty($settings['tp_faq_section_title_show']) ) : ?>

				<?php if ( !empty($settings['tp_faq_sub_title']) ) : ?>
				<span class="faq__title-pre tp-el-subtitle"><?php echo tp_kses( $settings['tp_faq_sub_title'] ); ?></span>
				<?php endif; ?>

				<?php
					if ( !empty($settings['tp_faq_title' ]) ) :
						printf( '<%1$s %2$s>%3$s</%1$s>',
							tag_escape( $settings['tp_faq_title_tag'] ),
							$this->get_render_attribute_string( 'title_args' ),
							tp_kses( $settings['tp_faq_title' ] )
							);
					endif;
				?>
				<?php if ( !empty($settings['tp_faq_description']) ) : ?>
				<p class="tp-el-content-desc"><?php echo tp_kses( $settings['tp_faq_description'] ); ?></p>
				<?php endif; ?>
			<?php endif; ?>
				<div class="faq__tab-content tp-accordion">
					<div class="accordion" id="faqaccordion-<?php echo esc_attr($this->get_id()); ?>">
						<?php foreach ( $settings['accordions'] as $index => $item) :
							$collapsed = ($index == '0' ) ? '' : 'collapsed';
							$aria_expanded = ($index == '0' ) ? "true" : "false";
							$show = ($index == '0' ) ? "show" : "";

						?>
						<div class="accordion-item tp-el-box">
							<h2 class="accordion-header" id="headingOne-<?php echo esc_attr($index); ?>">
								<button class="accordion-button tp-el-box-title <?php echo esc_attr($collapsed); ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne-<?php echo esc_attr($index); ?>" aria-expanded="<?php echo esc_attr($aria_expanded); ?>" aria-controls="collapseOne-<?php echo esc_attr($index); ?>">
									<?php echo esc_html($item['accordion_title']); ?>
								</button>
							</h2>
							<div id="collapseOne-<?php echo esc_attr($index); ?>" class="accordion-collapse collapse <?php echo esc_attr($show); ?>" aria-labelledby="headingOne-<?php echo esc_attr($index); ?>" data-bs-parent="#faqaccordion-<?php echo esc_attr($this->get_id()); ?>">
								<div class="accordion-body">
									<p class="tp-el-box-desc"><?php echo tp_kses($item['accordion_description']); ?></p>
								</div>
							</div>
						</div>
						<?php endforeach; ?>  
					</div>
				</div>
		</div>

        <?php else : ?>

		
			<!-- faq area start -->
			<section class="faq__area pb-120 tp-el-section" >
				<div class="container">
				<div class="faq__inner p-relative">
					<?php if(!empty($settings['faq_side_text'])) :?>
					<div class="faq__text d-none d-lg-block">
						<h3 class="tp-el-box-side-text" data-text="<?php echo esc_attr($settings['faq_side_text']); ?>"><?php echo esc_html($settings['faq_side_text']); ?></h3>
					</div>
					<?php endif; ?>
					<div class="row justify-content-end">
						<div class="col-xxl-9 col-xl-9 col-lg-9">
							<div class="faq__wrapper tp-accordion pt-65">
								<div class="accordion" id="faqaccordion-<?php echo esc_attr($this->get_id()); ?>">
									<?php foreach ( $settings['accordions'] as $index => $item) :
										$collapsed = ($index == '0' ) ? '' : 'collapsed';
										$aria_expanded = ($index == '0' ) ? "true" : "false";
										$show = ($index == '0' ) ? "show" : "";

									?>
									<div class="accordion-item tp-el-box">
										<h2 class="accordion-header" id="headingOne-<?php echo esc_attr($index); ?>">
										<button class="accordion-button tp-el-box-title <?php echo esc_attr($collapsed); ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne-<?php echo esc_attr($index); ?>" aria-expanded="<?php echo esc_attr($aria_expanded); ?>" aria-controls="collapseOne-<?php echo esc_attr($index); ?>">
											<?php echo esc_html($item['accordion_title']); ?>
											<span class="accordion-btn"></span>
										</button>
										</h2>
										<div id="collapseOne-<?php echo esc_attr($index); ?>" class="accordion-collapse collapse <?php echo esc_attr($show); ?>" aria-labelledby="headingOne-<?php echo esc_attr($index); ?>" data-bs-parent="#faqaccordion-<?php echo esc_attr($this->get_id()); ?>">
											<div class="accordion-body">
												<p class="tp-el-box-desc"><?php echo tp_kses($item['accordion_description']); ?></p>
											</div>
										</div>
									</div>
									<?php endforeach; ?>  
								</div>
							</div>
						</div>
					</div>
				</div>
				</div>
			</section>
			<!-- faq area end -->

        <?php endif; ?>

		<?php
	}

}

$widgets_manager->register( new TP_FAQ() );
