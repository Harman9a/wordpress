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
class TP_Instagram_Post extends Widget_Base {

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
		return 'tp-instagram';
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
		return __( 'Instagram Post', 'tpcore' );
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

		// tp_section_title
        $this->tp_section_title_render_controls('instagram', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.');


		$this->start_controls_section(
            'tp_instagram_section',
            [
                'label' => __( 'Instagram Slider', 'tpcore' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
         'tp_instagram_code',
         [
           'label'       => esc_html__( 'Intagram Slider Code', 'tpcore' ),
           'type'        => \Elementor\Controls_Manager::TEXTAREA,
           'rows'        => 10,
           'default'     => esc_html__( '', 'tpcore' ),
           'placeholder' => esc_html__( 'Short Code', 'tpcore' ),
		   'condition' => [
			'tp_design_style' => ['layout-1', 'layout-2']
		   ]
         ]
        );

		
		$repeater = new \Elementor\Repeater();
		
		 $repeater->add_control(
		 'tp_insta_title',
		   [
			 'label'   => esc_html__( 'Instagram Title', 'tpcore' ),
			 'type'        => \Elementor\Controls_Manager::TEXT,
			 'default'     => esc_html__( 'Instagram', 'tpcore' ),
			 'label_block' => true,
			 'condition' => [
				'tp_design_style' => ['layout-3']
			   ]
		   ]
		 );

		 $repeater->add_control(
		  'tp_image',
		  [
			'label'   => esc_html__( 'Upload Image', 'tpcore' ),
			'type'    => \Elementor\Controls_Manager::MEDIA,
			  'default' => [
				'url' => \Elementor\Utils::get_placeholder_image_src(),
			],
		  ]
		 );

		 $repeater->add_control(
		  'tp_insta_link',
		  [
			'label'   => esc_html__( 'Instagram Link', 'Text-domain' ),
			'type'        => \Elementor\Controls_Manager::URL,
			'default'     => [
				'url'               => '#',
				'is_external'       => true,
				'nofollow'          => true,
				'custom_attributes' => '',
			  ],
			  'placeholder' => esc_html__( 'Your Link Here', 'Text-domain' ),
			  'label_block' => true,
			]
		  );
		 
		 $this->add_control(
		   'tp_insta_list',
		   [
			 'label'       => esc_html__( 'Instagram List', 'tpcore' ),
			 'type'        => \Elementor\Controls_Manager::REPEATER,
			 'fields'      => $repeater->get_controls(),
			 'default'     => [
			   [
				 'tp_insta_title'   => esc_html__( 'Image 1', 'tpcore' ),
			   ],
			 ],
			 'title_field' => '{{{ tp_insta_title }}}',
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
	}


    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('section_section', 'Section - Style', '.tp-el-section');
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

		<?php if ( $settings['tp_design_style']  == 'layout-2' ) : 
            $this->add_render_attribute('title_args', 'class', 'tp-title tp-el-title');
        ?>
		<?php print do_shortcode($settings['tp_instagram_code']); ?>

		<?php elseif ( $settings['tp_design_style']  == 'layout-3' ) : 
            $this->add_render_attribute('title_args', 'class', 'tp-title tp-el-title');
        ?>

         <!-- instagram area start -->
         <div class="instagram__slider black-bg-5 pb-30 box-plr-15 tp-el-section">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-xxl-12">
                     <div class="instagram__slider-active-swiper swiper-container" data-wow-delay=".3s" data-wow-duration="1s">
                        <div class="swiper-wrapper">
						<?php foreach ($settings['tp_insta_list'] as $key => $item) :
							if ( !empty($item['tp_image']['url']) ) {
								$tp_image_url = !empty($item['tp_image']['id']) ? wp_get_attachment_image_url( $item['tp_image']['id'], $settings['thumbnail_size']) : $item['tp_image']['url'];
								$tp_image_alt = get_post_meta($item["tp_image"]["id"], "_wp_attachment_image_alt", true);
							}

							$link = $item['tp_insta_link']['url'];
						?>
                           <div class="instagram__item swiper-slide w-img wow slideInDown" data-wow-delay=".3s" data-wow-duration="1s">
                              <img src="<?php echo esc_url($tp_image_url) ?>" alt="<?php esc_attr($tp_image_alt); ?>">

							  <?php if(!empty($link)): ?>
                              <div class="instagram__btn">
                                 <a href="<?php echo esc_url($link); ?>" class="tp-instagram-btn popup-image"><i class="fa-brands fa-instagram"></i></a>
                              </div>
							  <?php endif; ?>
                           </div>
						   <?php endforeach; ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- instagram area end -->

        <?php else : 
            $this->add_render_attribute('title_args', 'class', 'award__title-4 tp-el-title');
        ?>

         <!-- instagram area start -->
         <div class="instagram__slider black-bg-5 pb-30 box-plr-15 tp-el-section">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-xxl-12">
                     <div class="instagram__slider-active instagram__open-icon">
                        <?php print do_shortcode($settings['tp_instagram_code']); ?>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- instagram area end -->

	   <?php endif; ?>

		<?php
	}


}

$widgets_manager->register( new TP_Instagram_Post() );
