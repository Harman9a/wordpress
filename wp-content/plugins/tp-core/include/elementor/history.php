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
class TP_History extends Widget_Base {

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
		return 'history';
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
		return __( 'History', 'tpcore' );
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();


		$this->tp_section_title_render_controls('history', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.');

        // history group
		$this->start_controls_section(
            'tp_history',
            [
                'label' => esc_html__('History List', 'tpcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

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
			'tp_history_icon_type',
			[
				'label' => esc_html__('Select Icon Type', 'tpcore'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'icon',
				'options' => [
					'image' => esc_html__('Image', 'tpcore'),
					'icon' => esc_html__('Icon', 'tpcore'),
					'svg' => esc_html__('Svg', 'tpcore'),
				],
				'condition' => [
					'repeater_condition' => 'style_2',
				],
			]
		);

		if (tp_is_elementor_version('<', '2.6.0')) {
			$repeater->add_control(
				'tp_history_icon',
				[
					'show_label' => false,
					'type' => Controls_Manager::ICON,
					'label_block' => true,
					'default' => 'fa-solid fa-check',
					'condition' => [
							'tp_history_icon_type' => 'icon'
					]
				]
			);
		} else {
			$repeater->add_control(
				'tp_history_selected_icon',
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
						'repeater_condition' => 'style_2',
						'tp_history_icon_type' => 'icon'
					]
				]
			);
		}

		$repeater->add_control(
			'tp_history_icon_svg',
			[
				'show_label' => false,
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'placeholder' => esc_html__('SVG Code Here', 'tpcore'),
				'condition' => [
					'repeater_condition' => 'style_2',
					'tp_history_icon_type' => 'svg'
				]
			]
		);

		$repeater->add_control(
			'tp_history_icon_image',
			[
				'label' => esc_html__('Upload Icon Image', 'tpcore'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'repeater_condition' => 'style_2',
					'tp_history_icon_type' => 'image'
				]

			]
		);

        $repeater->add_control(
            'tp_history_title', [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('History Title', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_history_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered.',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_history_year',
            [
                'label' => esc_html__('Year', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '2000 - 2005',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_history_meta',
            [
                'label' => esc_html__('Category', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Family Law',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tp_history_list',
            [
                'label' => esc_html__('History - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_history_title' => esc_html__('Discover', 'tpcore'),
                    ]
                ],
                'title_field' => '{{{ tp_history_title }}}',
            ]
        );
        $this->add_responsive_control(
            'tp_history_list_align',
            [
                'label' => esc_html__( 'Alignment', 'tpcore' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'text-left' => [
                        'title' => esc_html__( 'Left', 'tpcore' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'text-center' => [
                        'title' => esc_html__( 'Center', 'tpcore' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'text-right' => [
                        'title' => esc_html__( 'Right', 'tpcore' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'toggle' => true,
                'separator' => 'before',
            ]
        );
        $this->end_controls_section();

		// _tp_image
		$this->start_controls_section(
			'_tp_image',
			[
				'label' => esc_html__('Thumbnail', 'tpcore'),
			]
		);
		$this->add_control(
			'tp_history_image',
			[
				'label' => esc_html__( 'Choose Image', 'tpcore' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'tp_history_image_2',
			[
				'label' => esc_html__( 'Choose Image 2', 'tpcore' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'tp_history_thumb_number',
			[
				'label'       => esc_html__( 'Thumbnail Number', 'Text-domain' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( '76+', 'Text-domain' ),
				'placeholder' => esc_html__( 'Your Text Here', 'Text-domain' ),
			]
		);
		$this->add_control(
			'tp_history_thumb_text',
			[
				'label'       => esc_html__( 'Thumbnail Number', 'Text-domain' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'Winning Awards', 'Text-domain' ),
				'placeholder' => esc_html__( 'Your Text Here', 'Text-domain' ),
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
	
	// style_tab_content
    protected function style_tab_content(){
		$this->tp_section_style_controls('history_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('history_subtitle', 'History - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('history_title', 'History - Title', '.tp-el-title');
        $this->tp_basic_style_controls('history_description', 'History - Description', '.tp-el-content > p');
		
		$this->tp_section_style_controls('history_thumb', 'Thumbnail - Overlay', '.tp-el-thumb-bg::after');
		$this->tp_basic_style_controls('history_box_title', 'History - Box - Title', '.tp-el-box-title');
        $this->tp_basic_style_controls('history_box_experience', 'History - Box - Subtitle', '.tp-el-box-subtitle');
        $this->tp_basic_style_controls('history_box_message', 'History - Box - Description', '.tp-el-box-desc');
		$this->tp_link_controls_style('history_box_meta', 'History - Box - Meta', '.tp-el-box-meta');
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

		<?php if ( $settings['tp_design_style']  == 'layout-2' ) : ?>

			<section class="process__area tp-el-section">
				 <div class="container">
						<div class="row">
							<?php foreach ($settings['tp_history_list'] as $key => $item) :
								 $number = $key + 1;

								?>
							 <div class="col-xl-<?php echo esc_attr($settings['tp_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['tp_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['tp_col_for_tablet']); ?> col-<?php echo esc_attr($settings['tp_col_for_mobile']); ?>">
									<div class="process__item-2 text-center p-relative transition-3 mb-30">
										<div class="process__step">
											<span class="tp-el-box-subtitle">step <?php echo esc_html__($number); ?></span>
										</div>
										<div class="process__icon-2 history-icon-color tp-el-box-icon">
											<?php if($item['tp_history_icon_type'] !== 'image') : ?>
													<?php if (!empty($item['tp_history_icon']) || !empty($item['tp_history_selected_icon']['value'])) : ?>
															<span class="fea__icon"><?php tp_render_icon($item, 'tp_history_icon', 'tp_history_selected_icon'); ?></span>
													<?php endif; ?>
											<?php else : ?>
													<span class="fea__icon">
															<?php if (!empty($item['tp_history_image']['url'])): ?>
															<img class="light" src="<?php echo $item['tp_history_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_history_image']['url']), '_wp_attachment_image_alt', true); ?>">
															<?php endif; ?>
													</span>
											<?php endif; ?>
										</div>
										<div class="process__content-2">

											<?php if (!empty($item['tp_history_title' ])): ?>
											<h3 class="process__title-2 tp-el-box-title">
												<?php echo tp_kses($item['tp_history_title' ]); ?>
											</h3>
											<?php endif; ?>

											<?php if (!empty($item['tp_history_description' ])): ?>
											<p class="tp-el-box-desc"><?php echo tp_kses($item['tp_history_description']); ?></p>
											<?php endif; ?>

										 </div>
									</div>
							 </div>
							 <?php endforeach; ?>
						</div>
				 </div>
			</section>


		<?php else:


				if ( !empty($settings['tp_history_image']['url']) ) {
					$tp_history_image = !empty($settings['tp_history_image']['id']) ? wp_get_attachment_image_url( $settings['tp_history_image']['id'], $settings['tp_image_size_size']) : $settings['tp_history_image']['url'];
					$tp_history_image_alt = get_post_meta($settings["tp_history_image"]["id"], "_wp_attachment_image_alt", true);
				}

				if ( !empty($settings['tp_history_image_2']['url']) ) {
					$tp_history_image_2 = !empty($settings['tp_history_image_2']['id']) ? wp_get_attachment_image_url( $settings['tp_history_image_2']['id'], $settings['tp_image_size_size']) : $settings['tp_history_image']['url'];
					$tp_history_image_2_alt = get_post_meta($settings["tp_history_image_2"]["id"], "_wp_attachment_image_alt", true);
				}

				$this->add_render_attribute('title_args', 'class', 'section__title-4 tp-el-title');
			?>


			<!-- history area start -->
			<section class="history__area pt-30 pb-140 tp-el-section">
            <div class="container">
            <?php if ( !empty($settings['tp_history_section_title_show']) ) : ?>
               <div class="row">
                  <div class="col-xxl-6 col-xl-6 col-lg-6">
                     <div class="section__title-wrapper-4 mb-60 tp-el-content">
                        <?php if(!empty($settings['tp_history_sub_title'])): ?>
                        <span class="section__title-pre-4 tp-el-subtitle"><?php echo esc_html($settings['tp_history_sub_title']); ?></span>
                        <?php endif; ?>

                        <?php
                            if ( !empty($settings['tp_history_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['tp_history_title_tag'] ),
                                    $this->get_render_attribute_string( 'title_args' ),
                                    tp_kses( $settings['tp_history_title' ] )
                                    );
                            endif;
                        ?>

						<?php if ( !empty($settings['tp_history_description']) ) : ?>
							<p><?php echo tp_kses( $settings['tp_history_description'] ); ?></p>
						<?php endif; ?>
                     </div>
                  </div>
               </div>
               <?php endif; ?>
               <div class="row">
                  <div class="col-xxl-6 col-xl-6 col-lg-6">
                     <div class="history__thumb-wrapper d-sm-flex pr-70">
						<?php if(!empty($tp_history_image))  :?>
                        <div class="history__thumb">
                           <img src="<?php echo esc_url($tp_history_image); ?>" alt="<?php echo esc_attr($tp_history_image_alt); ?> ">
                        </div>
						<?php endif; ?>

						<?php if(!empty($tp_history_image_2))  :?>
                        <div class="history__thumb-right-wrapper">
                           <div class="history__thumb-right p-relative include-bg tp-el-thumb-bg" data-background="<?php echo esc_url($tp_history_image_2); ?>">
                              <?php echo esc_html($settings['tp_history_thumb_number']); ?>
                           </div>
						   <?php if(!empty($settings['tp_history_thumb_text'])) :?>
                           <div class="history-thumb-text">
                              <p><?php echo esc_html($settings['tp_history_thumb_text']); ?></p>
                           </div>
						   <?php endif; ?>
                        </div>
						<?php endif; ?>
                     </div>
                  </div>
                  <div class="col-xxl-6 col-xl-6 col-lg-6">
                     <div class="history__list pl-65 pr-90">
						<?php foreach ($settings['tp_history_list'] as $key => $item) :
						?>
                        <div class="history__list-item d-flex align-items-start">
							<?php if(!empty($item['tp_history_year'])): ?>
                           <div class="history__year wow fadeInLeft" data-wow-delay=".3s">
                              <h5 class="history__year-title tp-el-box-subtitle"><?php echo tp_kses($item['tp_history_year']); ?></h5>
                           </div>
						   <?php endif; ?>

                           <div class="history__list-content">
                              <div class="history__list-dot">
                                 <span></span>
                              </div>
                              <div class="history__list-content-inner wow fadeInRight" data-wow-delay=".3s">
							  <?php if(!empty($item['tp_history_title'])): ?>
                                 <h4 class="history__list-title tp-el-box-title"><?php echo esc_html($item['tp_history_title']); ?></h4>
								<?php endif; ?>

								<?php if(!empty($item['tp_history_description'])): ?>
                                 <p class="tp-el-box-desc"><?php echo tp_kses($item['tp_history_description']); ?></p>
								 <?php endif; ?>

								 <?php if(!empty($item['tp_history_meta'])): ?>
                                 <div class="history__list-meta">
                                    <span class="tp-el-box-meta"><?php echo esc_html($item['tp_history_meta']); ?></span>
                                 </div>
								 <?php endif; ?>
                              </div>
                           </div>
                        </div>
						<?php endforeach; ?>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- history area end -->


        <?php endif; ?>

        <?php
	}
}

$widgets_manager->register( new TP_History() );
