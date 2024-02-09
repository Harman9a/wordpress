<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
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
class TP_Search_Box extends Widget_Base {

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
		return 'tp-search-box';
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
		return __( 'TP Search Box', 'tpcore' );
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
				],
				'default' => 'layout-1',
			]
		);

		$this->end_controls_section();

		$this->tp_section_title_render_controls('help', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.');

		$this->start_controls_section(
		 'tp_help_sec',
			 [
			   'label' => esc_html__( 'Features', 'tpcore' ),
			   'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
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
			'tp_help_box_title',
			[
				'label'   => esc_html__( 'Title', 'tpcore' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'Your Title', 'tpcore' ),
				'label_block' => true,
			]
		 );

		 $repeater->add_control(
		 'tp_help_box_subtitle',
		  [
			 'label'       => esc_html__( 'Subtitle', 'tpcore' ),
			 'type'        => \Elementor\Controls_Manager::TEXT,
			 'default'     => esc_html__( 'Subtitle', 'tpcore' ),
			 'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
			 'label_block' => true,
		  ]
		 );

		 $repeater->add_control(
            'tp_help_link_switcher',
            [
                'label' => esc_html__( 'Add Help link', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'tpcore' ),
                'label_off' => esc_html__( 'No', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'tp_help_link_type',
            [
                'label' => esc_html__( 'Help Link Type', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'tp_help_link_switcher' => 'yes'
                ]
            ]
        );
        $repeater->add_control(
            'tp_help_link',
            [
                'label' => esc_html__( 'Help link', 'tpcore' ),
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
                    'tp_help_link_type' => '1',
                    'tp_help_link_switcher' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'tp_services_page_link',
            [
                'label' => esc_html__( 'Select Service Link Page', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_services_link_type' => '2',
                    'tp_services_link_switcher' => 'yes',
                ]
            ]
        );
		 
		 $this->add_control(
		   'tp_help_list',
		   [
			 'label'       => esc_html__( 'Help List', 'tpcore' ),
			 'type'        => \Elementor\Controls_Manager::REPEATER,
			 'fields'      => $repeater->get_controls(),
			 'default'     => [
			   [
				 'tp_help_box_title'   => esc_html__( 'Install a theme', 'tpcore' ),
			   ],
			   [
				 'tp_help_box_title'   => esc_html__( 'Change layout', 'tpcore' ),
			   ],
			   [
				 'tp_help_box_title'   => esc_html__( 'Format articles', 'tpcore' ),
			   ],
			 ],
			 'title_field' => '{{{ tp_help_box_title }}}',
		   ]
		 );
		
		
		$this->end_controls_section();
	}

	// style_tab_content
    protected function style_tab_content(){
		$this->tp_section_style_controls('about_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('about_subtitle', 'Section - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('about_title', 'Section - Title', '.tp-el-title');
        $this->tp_basic_style_controls('about_description', 'Section - Description', '.tp-el-content p');

		   
        $this->tp_section_style_controls('services_section_box', 'Box - Style', '.tp-el-box');
        $this->tp_icon_style('section_icon', 'Box - Icon', '.tp-el-box-icon span');
        $this->tp_basic_style_controls('services_box_subtitle', 'Box - Subtitle', '.tp-el-box-subtitle');
        $this->tp_basic_style_controls('services_box_title', 'Box - Title', '.tp-el-box-title');

		$this->tp_input_controls_style('coming_input', 'Form - Input', '.tp-el-box-input input');
        $this->tp_link_controls_style('coming_input_btn', 'Form - Button', '.tp-el-box-input button');
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

	$settings = $this->get_settings_for_display();?>

		<?php if ( $settings['tp_design_style']  == 'layout-2' ):
            $this->add_render_attribute('title_args', 'class', 'section__title-2 tp-el-title');
        ?>

		<!-- default style -->
		<?php else: 
            $this->add_render_attribute('title_args', 'class', 'help__title tp-el-title');
        ?>

         <!-- help center area start -->
         <section class="help__area grey-bg-4 pt-95 pb-80 tp-el-section">
            <div class="container">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="help__wrapper">
					 <?php if ( !empty($settings['tp_help_section_title_show']) ) : ?>
                        <div class="help__content text-center mb-40 tp-el-content">
							<?php if ( !empty($settings['tp_help_sub_title']) ) : ?>
							<span class="faq__title-pre tp-el-subtitle">
								<?php echo tp_kses( $settings['tp_help_sub_title'] ); ?>
							</span>
							<?php endif; ?>

						   <?php
								if ( !empty($settings['tp_help_title' ]) ) :
									printf( '<%1$s %2$s>%3$s</%1$s>',
										tag_escape( $settings['tp_help_title_tag'] ),
										$this->get_render_attribute_string( 'title_args' ),
										tp_kses( $settings['tp_help_title' ] )
										);
								endif;
							?>

                            <?php if ( !empty($settings['tp_help_description']) ) : ?>
								<p><?php echo tp_kses( $settings['tp_help_description'] ); ?></p>
							<?php endif; ?>

                        </div>
                        <div class="help__form tp-el-box-input tp-el-contact-box-btn">
							<form method="get" action="<?php print esc_url( home_url( '/' ) );?>">
                              <div class="help__input-box">
                                 <div class="help__input">
                                    <span>
                                       <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <path d="M9.55 18.1C14.272 18.1 18.1 14.272 18.1 9.55C18.1 4.82797 14.272 1 9.55 1C4.82797 1 1 4.82797 1 9.55C1 14.272 4.82797 18.1 9.55 18.1Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                          <path d="M19.0031 19.0002L17.2031 17.2002" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                       </svg>                                       
                                    </span>
									<input type="search" name="s" value="<?php print esc_attr( get_search_query() )?>" placeholder="<?php print esc_attr__( 'Search for articles...', 'tp-core' );?>" >
                                 </div>
                                 <button type="submit" class="tp-btn"><?php print esc_attr__( 'Search', 'tp-core' );?></button>
                              </div>
                           </form>
                        </div>
						<?php endif; ?>
                        <div class="help__features d-flex flex-wrap justify-content-sm-center">

							<?php foreach ($settings['tp_help_list'] as $key => $item) :// Link
								if ('2' == $item['tp_help_link_type']) {
									$link = get_permalink($item['tp_help_page_link']);
									$target = '_self';
									$rel = 'nofollow';
								} else {
									$link = !empty($item['tp_help_link']['url']) ? $item['tp_help_link']['url'] : '';
									$target = !empty($item['tp_help_link']['is_external']) ? '_blank' : '';
									$rel = !empty($item['tp_help_link']['nofollow']) ? 'nofollow' : '';
								}
							?>
                           <div class="help__features-item d-flex align-items-center tp-el-box">
                              <div class="help__features-icon tp-el-box-icon">
								<?php if($item['tp_box_icon_type'] == 'icon') : ?>
									<?php if (!empty($item['tp_box_icon']) || !empty($item['tp_box_selected_icon']['value'])) : ?>
											<span><?php tp_render_icon($item, 'tp_box_icon', 'tp_box_selected_icon'); ?></span>
									<?php endif; ?>
								<?php elseif( $item['tp_box_icon_type'] == 'image' ) : ?>
									<span>
										<?php if (!empty($item['tp_box_icon_image']['url'])): ?>
										<img src="<?php echo $item['tp_box_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
										<?php endif; ?>
									</span>
								<?php else : ?>
									<span>
										<?php if (!empty($item['tp_box_icon_svg'])): ?>
										<?php echo $item['tp_box_icon_svg']; ?>
										<?php endif; ?>
									</span>
								<?php endif; ?>
                              </div>
                              <div class="help__features-content">
								<?php if (!empty($item['tp_help_box_subtitle' ])): ?>
								<p class="tp-el-box-subtitle"><?php echo tp_kses($item['tp_help_box_subtitle']); ?></p>
								<?php endif; ?>

								 <?php if (!empty($item['tp_help_box_title' ])): ?>
                                <h4 class="help__features-title tp-el-box-title">
                                    <?php if ($item['tp_help_link_switcher'] == 'yes') : ?>
                                    <a href="<?php echo esc_url($link); ?>"><?php echo tp_kses($item['tp_help_box_title' ]); ?></a>
                                    <?php else : ?>
                                        <?php echo tp_kses($item['tp_help_box_title' ]); ?>
                                    <?php endif; ?>
                                </h4>
                                <?php endif; ?>
                              </div>
                           </div>
						   <?php endforeach; ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- help center area end -->

		 <?php endif; ?>

        <?php
    }
}


$widgets_manager->register( new TP_Search_Box() );