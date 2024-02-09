<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Utils;
use \Elementor\Control_Media;

use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Typography;
Use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Heading_2 extends Widget_Base {

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
		return 'tp-heading-2';
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
		return __( 'Heading Two', 'tpcore' );
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        // _tp_image
		$this->start_controls_section(
            '_tp_image',
            [
                'label' => esc_html__('Thumbnail', 'tp-core'),
                'condition' => [
                    'tp_design_style' => ['layout-2']
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
                'name' => 'thumbnail',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );
        $this->end_controls_section();

        
        $this->tp_section_title_render_controls('section', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.');


	}

    protected function style_tab_content(){
        $this->tp_section_style_controls('portfolio_section', 'Section - Style', '.tp-el-section');

        $this->tp_basic_style_controls('portfolio_title', 'Section - Title', '.tp-el-title');
        $this->tp_basic_style_controls('portfolio_subtitle', 'Section - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('portfolio_desc', 'Section - Description', '.tp-el-content p');
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
			if ( !empty($settings['tp_image']['url']) ) {
				$tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['thumbnail_size']) : $settings['tp_image']['url'];
				$tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
			}

            $this->add_render_attribute('title_args', 'class', 'tp-section-title-2 font-70 tp-el-title');
        ?>


         <!-- contact area start -->
         <section class="tp-section-area p-relative z-index-1 tp-section-spacing tp-el-section">
            <div class="tp-section-bg include-bg" data-background="<?php echo esc_url($tp_image); ?>"></div>
            <div class="container">
               <div class="row justify-content-center">
                  <div class="col-xl-8 col-lg-8">
                     <div class="tp-section-wrapper-2 text-center tp-el-content">

						<?php if ( !empty($settings['tp_section_sub_title']) ) : ?>
						<span class="faq__title-pre tp-el-subtitle">
							<?php echo tp_kses( $settings['tp_section_sub_title'] ); ?>
						</span>
						<?php endif; ?>
						
						<?php
                            if ( !empty($settings['tp_section_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['tp_section_title_tag'] ),
                                    $this->get_render_attribute_string( 'title_args' ),
                                    tp_kses( $settings['tp_section_title' ] )
                                    );
                            endif;
                        ?>

						<?php if ( !empty($settings['tp_section_description']) ) : ?>
                            <p><?php echo tp_kses( $settings['tp_section_description'] ); ?></p>
                        <?php endif; ?>

                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- contact area end -->

         <?php elseif ( $settings['tp_design_style']  == 'layout-3' ):

            $this->add_render_attribute('title_args', 'class', 'tp-section-title-3 tp-el-title');
        ?>

            <?php if ( !empty($settings['tp_section_section_title_show']) ) : ?>
            <div class="tp-section-wrapper-3 tp-el-section tp-el-content <?php echo esc_attr( $settings['tp_section_align'] ); ?>">
                <?php if ( !empty($settings['tp_section_sub_title']) ) : ?>
                <span class="tp-section-subtitle-3 tp-el-subtitle"><?php echo tp_kses( $settings['tp_section_sub_title'] ); ?></span>
                <?php endif; ?>

                <?php
                    if ( !empty($settings['tp_section_title' ]) ) :
                        printf( '<%1$s %2$s>%3$s</%1$s>',
                            tag_escape( $settings['tp_section_title_tag'] ),
                            $this->get_render_attribute_string( 'title_args' ),
                            tp_kses( $settings['tp_section_title' ] )
                            );
                    endif;
                ?>

                <?php if ( !empty($settings['tp_section_description']) ) : ?>
                    <p><?php echo tp_kses( $settings['tp_section_description'] ); ?></p>
                <?php endif; ?>

            </div>
            <?php endif; ?>

         <?php elseif ( $settings['tp_design_style']  == 'layout-4' ):

            $this->add_render_attribute('title_args', 'class', 'donate__title tp-el-title');
        ?>
            

            <?php if ( !empty($settings['tp_section_section_title_show']) ) : ?>
            <div class="donate__content mb-45 tp-el-section tp-el-content <?php echo esc_attr( $settings['tp_section_align'] ); ?>">

                <?php if ( !empty($settings['tp_section_sub_title']) ) : ?>
                <span class="section__title-pre-10 tp-el-subtitle"><?php echo tp_kses( $settings['tp_section_sub_title'] ); ?></span>
                <?php endif; ?>

                <?php
                    if ( !empty($settings['tp_section_title' ]) ) :
                        printf( '<%1$s %2$s>%3$s</%1$s>',
                            tag_escape( $settings['tp_section_title_tag'] ),
                            $this->get_render_attribute_string( 'title_args' ),
                            tp_kses( $settings['tp_section_title' ] )
                            );
                    endif;
                ?>

                <?php if ( !empty($settings['tp_section_description']) ) : ?>
                    <p><?php echo tp_kses( $settings['tp_section_description'] ); ?></p>
                <?php endif; ?>
            </div>
            <?php endif; ?>

		<?php else:
			$this->add_render_attribute('title_args', 'class', 'tp-section-title-5 tp-el-title');
		?>

         <!-- section title area -->
         <?php if ( !empty($settings['tp_section_section_title_show']) ) : ?>
         <section class="tp-section-area pt-120 tp-el-section">
            <div class="container">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="tp-section-wrapper-5 tp-el-content <?php echo esc_attr( $settings['tp_section_align'] ); ?> mb-85">
                            <?php if ( !empty($settings['tp_section_sub_title']) ) : ?>
                            <span class="tp-section-subtitle-5 tp-el-subtitle">
                                <?php echo tp_kses( $settings['tp_section_sub_title'] ); ?>
                            </span>
                            <?php endif; ?>
                        <?php
                            if ( !empty($settings['tp_section_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['tp_section_title_tag'] ),
                                    $this->get_render_attribute_string( 'title_args' ),
                                    tp_kses( $settings['tp_section_title' ] )
                                    );
                            endif;
                        ?>
                        <?php if ( !empty($settings['tp_section_description']) ) : ?>
                            <p><?php echo tp_kses( $settings['tp_section_description'] ); ?></p>
                        <?php endif; ?>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <?php endif; ?>
         <!-- section title end -->

        <?php endif; ?>

        <?php
	}
}

$widgets_manager->register( new TP_Heading_2() );
