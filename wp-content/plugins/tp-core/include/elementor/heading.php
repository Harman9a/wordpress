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

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Heading extends Widget_Base {

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
		return 'tp-heading';
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
		return __( 'Heading', 'tpcore' );
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
                    'layout-6' => esc_html__('Layout 6', 'tpcore'),
                    'layout-7' => esc_html__('Layout 7', 'tpcore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();


        
        $this->tp_section_title_render_controls('section', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.');

		$this->tp_button_render('testimonial', 'Testimonial Button', ['layout-4'] );

	}

    protected function style_tab_content(){
        $this->tp_section_style_controls('portfolio_section', 'Section - Style', '.tp-el-section');

        $this->tp_basic_style_controls('portfolio_title', 'Section - Title', '.tp-el-title');
        $this->tp_basic_style_controls('portfolio_subtitle', 'Section - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('portfolio_desc', 'Section - Description', '.tp-el-content p');
		$this->tp_link_controls_style('portfolio_description', 'Section - Button', '.tp-el-box-btn');
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
            $this->add_render_attribute('title_args', 'class', 'section__title-2 tp-el-title');
        ?>

		<div class="section__title-wrapper-2 <?php echo esc_attr( $settings['tp_section_align'] ); ?> tp-el-section tp-el-content">
			<?php if ( !empty($settings['tp_section_sub_title']) ) : ?>
			<span class="section__title-pre-2 tp-el-subtitle"><?php echo tp_kses( $settings['tp_section_sub_title'] ); ?></span>
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

		<?php elseif ( $settings['tp_design_style']  == 'layout-3' ):
            $this->add_render_attribute('title_args', 'class', 'section__title-5 tp-el-title');
        ?>

		<div class="section__title-wrapper-5 <?php echo esc_attr( $settings['tp_section_align'] ); ?> tp-el-section tp-el-content">
			<?php if ( !empty($settings['tp_section_sub_title']) ) : ?>
			<span class="section__title-pre-5 tp-el-subtitle"><?php echo tp_kses( $settings['tp_section_sub_title'] ); ?></span>
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

		<?php elseif ( $settings['tp_design_style']  == 'layout-4' ):
            $this->add_render_attribute('title_args', 'class', 'section__title-3 has-gradient tp-el-title');
			$sub_center = $settings['tp_section_align'] == 'text-center' ? 'has-center' : '';
            // Link
            if ('2' == $settings['tp_testimonial_btn_link_type']) {
                $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_testimonial_btn_page_link']));
                $this->add_render_attribute('tp-button-arg', 'target', '_self');
                $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn-border-4 tp-el-box-btn');
            } else {
                if ( ! empty( $settings['tp_testimonial_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'tp-button-arg', $settings['tp_testimonial_btn_link'] );
                    $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn-border-4 tp-el-box-btn');
                }
            }
        ?>

			<?php if ( !empty($settings['tp_section_section_title_show']) ) : ?>
			<div class="section__title-wrapper-3 mb-50 tp-el-section tp-el-content">
				<?php if ( !empty($settings['tp_section_sub_title']) ) : ?>
				<span class="section__title-pre-3 <?php echo esc_attr($sub_center); ?> tp-el-subtitle">
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
			<?php endif; ?>

			<?php if (!empty($settings['tp_testimonial_btn_text'])) : ?>
			<div class="testimonial__btn-3 mb-95">
				<a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>><?php echo $settings['tp_testimonial_btn_text']; ?></a>
			</div>
			<?php endif; ?>
			

		<?php elseif ( $settings['tp_design_style']  == 'layout-5' ):
            $this->add_render_attribute('title_args', 'class', 'section__title-3 has-gradient tp-el-title');
			$sub_center = $settings['tp_section_align'] == 'text-center' ? 'has-center' : '';
        ?>

			<?php if ( !empty($settings['tp_section_section_title_show']) ) : ?>
			<div class="section__title-wrapper-3 <?php echo esc_attr( $settings['tp_section_align'] ); ?> mb-50 tp-el-content tp-el-section">
					<?php if ( !empty($settings['tp_section_sub_title']) ) : ?>
                        <span class="section__title-pre-3 <?php echo esc_attr($sub_center); ?> tp-el-subtitle">
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
			<?php endif; ?>
	
		<?php elseif ( $settings['tp_design_style']  == 'layout-6' ):
            $this->add_render_attribute('title_args', 'class', 'section__title-10 tp-el-title');
			$sub_center = $settings['tp_section_align'] == 'text-center' ? 'text-center' : '';
        ?>

         <!-- blog area start -->
		 <?php if ( !empty($settings['tp_section_section_title_show']) ) : ?>
		 <div class="section__title-wrapper-10 tp-el-content tp-el-section <?php echo esc_attr($sub_center); ?> mb-45  ">

			<?php if ( !empty($settings['tp_section_sub_title']) ) : ?>
				<span class="section__title-pre-10 tp-el-subtitle">
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
		<?php endif; ?>
         <!-- blog area end -->


		<?php elseif ( $settings['tp_design_style']  == 'layout-7' ):
            $this->add_render_attribute('title_args', 'class', 'tp-section-title tp-el-title');
			$sub_center = $settings['tp_section_align'] == 'text-center' ? 'text-center' : '';
        ?>
		<!-- heading style -->
		<section class="tp-section-style-area pt-60 pb-90 tp-el-section">
            <div class="container">
			<?php if ( !empty($settings['tp_section_section_title_show']) ) : ?>
               <div class="row">
                  <div class="col-xl-4 col-lg-5">
                     <div class="tp-section-wrapper tp-el-content ">
						<?php if ( !empty($settings['tp_section_sub_title']) ) : ?>
							<span class="tp-section-subtitle tp-el-subtitle">
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
                     </div>
                  </div>
				  <div class="col-xl-8 col-lg-7">
						<?php if ( !empty($settings['tp_section_description']) ) : ?>
						<div class="tp-section-wrapper tp-el-content">
							<p><?php echo tp_kses( $settings['tp_section_description'] ); ?></p>
						</div>
						<?php endif; ?>
					</div>
               </div>
			   <?php endif; ?>
            </div>
         </section>
         <!-- heading style -->

		<?php else:
			$this->add_render_attribute('title_args', 'class', 'section__title tp-el-title');
		?>

        <?php if ( !empty($settings['tp_section_section_title_show']) ) : ?>
        <div class="section__title-wrapper tp-el-content tp-el-section <?php echo esc_attr( $settings['tp_section_align'] ); ?> mb-60">
            <?php if ( !empty($settings['tp_section_sub_title']) ) : ?>
            <span class="section__title-pre tp-el-subtitle">
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
        <?php endif; ?>

        <?php endif; ?>

        <?php
	}
}

$widgets_manager->register( new TP_Heading() );
