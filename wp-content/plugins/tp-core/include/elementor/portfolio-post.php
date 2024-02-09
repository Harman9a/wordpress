<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
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
class TP_Portfolio_Post extends Widget_Base {

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
		return 'tp-portfolio-post';
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
		return __( 'Portfolio Post', 'tpcore' );
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

        $this->add_control(
         'tp_portfolio_shape_switch',
            [
                'label'        => esc_html__( 'Enable Shape?', 'tpcore' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'tpcore' ),
                'label_off'    => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->end_controls_section();


        $this->tp_section_title_render_controls('portfolio', 'Section Title', 'Sub Title', 'Your title here');
        
        // Product Query

        $this->tp_query_controls('portfolio', 'Portfolio', '6', '10', 'portfolio', 'portfolio-cat');

        // tp_btn_button_group

        $this->start_controls_section(
            'tp_portfolio_box_btn_sec',
                [
                  'label' => esc_html__( 'Portfolio Box Button', 'tpcore' ),
                  'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
           );
           
           $this->add_control(
           'tp_portfolio_box_btn',
            [
               'label'       => esc_html__( 'Button Text', 'tpcore' ),
               'type'        => \Elementor\Controls_Manager::TEXT,
               'default'     => esc_html__( 'Show Project', 'tpcore' ),
               'placeholder' => esc_html__( 'Your Url', 'tpcore' ),
            ]
           );

           
           $this->end_controls_section();
        
        // tp_btn_button_group
        $this->tp_button_render('portfolio_view_all', 'Portfolio More Button', ['layout-1'] );


        // tp_post__columns_section
        $this->tp_columns('col', 'Portfolio Column');

	}

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('portfolio_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('portfolio_subtitle', 'Section - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('portfolio_title', 'Section - Title', '.tp-el-title');
        $this->tp_basic_style_controls('portfolio_description', 'Section - Description', '.tp-el-content p');
        $this->tp_link_controls_style('services_link_btn', 'Section - Button', '.tp-el-btn');

        $this->tp_section_style_controls('services_section_box', 'Box - Style', '.tp-el-box');
        $this->tp_basic_style_controls('history_title', 'Portfolio - Title', '.tp-el-box-title');
        $this->tp_link_controls_style('history_tag', 'Portfolio - Tag', '.tp-el-box-tag span');
        $this->tp_link_controls_style('services_box_link_btn', 'Portfolio - Button', '.tp-el-box-btn');
        $this->tp_link_controls_style('services_box_link_btn_plus', 'Portfolio - Plus', '.tp-el-box-plus');
        $this->tp_link_controls_style('services_box_link_video', 'Portfolio - Video - Button', '.tp-el-video-btn');

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

        /**
         * Setup the post arguments.
        */
        $query_args = TP_Helper::get_query_args('portfolio', 'portfolio-cat', $this->get_settings());

       // The Query
       $query = new \WP_Query($query_args);

       $filter_list = $settings['category'];

       $portfolio_filter_btn_active = 1; // for filter button active

        ?>

        <?php if ( $settings['tp_design_style']  == 'layout-2' ): 
            $this->add_render_attribute('title_args', 'class', 'section__title-4 tp-el-title');
        ?>

        <?php else: 
            $this->add_render_attribute('title_args', 'class', 'portfolio__section-title tp-el-title');

            $bloginfo = get_bloginfo( 'name' ); 

            // Link
            if ('2' == $settings['tp_portfolio_view_all_btn_link_type']) {
                $link = get_permalink($settings['tp_portfolio_view_all_btn_page_link']);
                $target = '_self';
                $rel = 'nofollow';
            } else {
                $link = !empty($settings['tp_portfolio_view_all_btn_link']['url']) ? $settings['tp_portfolio_view_all_btn_link']['url'] : '';
                $target = !empty($settings['tp_portfolio_view_all_btn_link']['is_external']) ? '_blank' : '';
                $rel = !empty($settings['tp_portfolio_view_all_btn_link']['nofollow']) ? 'nofollow' : '';
            }
            
            
        ?>


         <!-- portfolio area start -->
         <section class="portfolio__area pt-110 pb-75 p-relative fix tp-el-section">
         <?php if(!empty($settings['tp_portfolio_shape_switch'])) : ?>
            <div class="portfolio__shape">
               <img class="portfolio__shape-13" src="<?php echo get_template_directory_uri() . '/assets/img/portfolio/grid/shape/circle-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="portfolio__shape-14" src="<?php echo get_template_directory_uri() . '/assets/img/portfolio/grid/shape/circle-2.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="portfolio__shape-15" src="<?php echo get_template_directory_uri() . '/assets/img/portfolio/grid/shape/circle-sm.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="portfolio__shape-16" src="<?php echo get_template_directory_uri() . '/assets/img/portfolio/grid/shape/polygon-yellow.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="portfolio__shape-17" src="<?php echo get_template_directory_uri() . '/assets/img/portfolio/grid/shape/polygon-pink.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="portfolio__shape-18" src="<?php echo get_template_directory_uri() . '/assets/img/portfolio/grid/shape/polygon-green.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="portfolio__shape-19" src="<?php echo get_template_directory_uri() . '/assets/img/portfolio/grid/shape/polygon-green-2.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
            </div>
            <?php endif; ?>

            <div class="container">
            <?php if ( !empty($settings['tp_portfolio_section_title_show']) ) : ?>
               <div class="row">
                  <div class="col-xl-12">
                     <div class="portfolio__section-title-wrapper text-center mb-90 tp-el-content">

                        <?php if(!empty($settings['tp_portfolio_sub_title' ])): ?>
                        <span class="portfolio__section-title-pre tp-el-subtitle"><?php echo tp_kses( $settings['tp_portfolio_sub_title' ] ) ?></span>
                        <?php endif; ?>

                        <?php
                            if ( !empty($settings['tp_portfolio_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['tp_portfolio_title_tag'] ),
                                    $this->get_render_attribute_string( 'title_args' ),
                                    tp_kses( $settings['tp_portfolio_title' ] )
                                    );
                            endif;
                        ?>

                        <?php if ( !empty($settings['tp_portfolio_description']) ) : ?>
                            <p><?php echo tp_kses( $settings['tp_portfolio_description'] ); ?></p>
                        <?php endif; ?>
                     </div>
                  </div>
               </div>
               <?php endif; ?>

            <?php if( !empty($filter_list) ) : ?>
               <div class="row">
                  <div class="col-xxl-12">
                     <div class="portfolio__masonary-btn text-center mb-40">
                           <div class="masonary-menu filter-button-group tp-el-mas-btn">
                                <?php 
                                $post_type = 'portfolio';
                                $count_posts = wp_count_posts( $post_type );
                            
                                $published_posts = $count_posts->publish;

                                foreach ( $filter_list as $list ): 

                                ?>
                                    <?php 
                                        if ( $portfolio_filter_btn_active === 1 ): 
                                        $portfolio_filter_btn_active++; 
                                    ?>
                                    <button class="active" data-filter="*"><?php echo esc_html__( 'See All','tpcore' ); ?><span><?php echo $published_posts; ?></span></button>

                                    <button data-filter=".<?php echo esc_attr( $list ); ?>"><?php echo esc_html( $list ); ?> <span></span></button>

                                    <?php else: ?>
                                        <button data-filter=".<?php echo esc_attr( $list ); ?>"><?php echo esc_html( $list ); ?></button>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                           </div>
                     </div>
                  </div>
               </div>
               <?php endif; ?>
               
               <?php if( !empty($filter_list) ) : ?>
                
                <div class="row tp-gx-4 grid">
                <?php 
                
                
                while ($query->have_posts()) : 
                 $query->the_post();
                 global $post;
                 $terms = get_the_terms($post->ID, 'portfolio-cat'); 
                 $item_classes = '';
                 $item_cat_names = '';
                 $item_cats = get_the_terms( $post->ID, 'portfolio-cat' );
                 if( !empty($item_cats) ):
                     $count = count($item_cats) - 1;
                     foreach($item_cats as $key => $item_cat) {
                         $item_classes .= $item_cat->slug . ' ';
                         $item_cat_names .= ( $count > $key ) ? $item_cat->name  . ', ' : $item_cat->name;
                     }
                 endif; 
                 $harry_video_url = function_exists('get_field') ? get_field('add_portfolio_video') : '';

                 ?>
                   <div class="col-xl-4 col-lg-4 col-md-6 tp-portfolio grid-item <?php echo $item_classes; ?>">
                      <div class="portfolio__grid-item mb-40 tp-el-box">
 
                      <?php if ( has_post_thumbnail() ): ?>
                         <div class="portfolio__grid-thumb w-img fix">
                            <a href="<?php echo esc_url( get_the_permalink() ); ?>">
                                <?php the_post_thumbnail($settings['portfolio_thumb_size_size']); ?>
                            </a>
 
                            <?php if(!empty($harry_video_url)) : ?>
                             <div class="portfolio__grid-video">
                                 <a href="<?php echo esc_url($harry_video_url);  ?>" class="portfolio-play-btn popup-video tp-el-video-btn">
                                     <svg width="18" height="22" viewBox="0 0 18 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                         <path d="M18 11L0 21.3923V0.607696L18 11Z" fill="currentColor"/>
                                     </svg>                                    
                                 </a>
                            </div>
                            
                            <?php else: ?>
                             <div class="portfolio__grid-popup">
                                 <a href="<?php echo get_the_post_thumbnail_url(); ?>" class="popup-image tp-el-box-plus">
                                     <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                         <path d="M14.1667 8.33341H0.833333C0.377778 8.33341 0 7.95564 0 7.50008C0 7.04453 0.377778 6.66675 0.833333 6.66675H14.1667C14.6222 6.66675 15 7.04453 15 7.50008C15 7.95564 14.6222 8.33341 14.1667 8.33341Z" fill="currentColor"/>
                                         <path d="M7.4974 15C7.04184 15 6.66406 14.6222 6.66406 14.1667V0.833333C6.66406 0.377778 7.04184 0 7.4974 0C7.95295 0 8.33073 0.377778 8.33073 0.833333V14.1667C8.33073 14.6222 7.95295 15 7.4974 15Z" fill="currentColor"/>
                                     </svg>                                    
                                 </a>
                             </div>
                             <?php endif; ?>
 
                         </div>
                         <?php endif; ?>
                         <div class="portfolio__grid-content">
                            <h3 class="portfolio__grid-title tp-el-box-title">
                               <a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php the_title(); ?></a>
                            </h3>
                            <div class="portfolio__grid-bottom">
                               <div class="portfolio__grid-category tp-el-box-tag">
                                  <span><?php echo esc_html($item_cat_names); ?></span>
                               </div>
                               <div class="portfolio__grid-show-project">
                                  <a href="<?php echo esc_url( get_the_permalink() ); ?>" class="portfolio-link-btn tp-el-box-btn">
                                  <?php echo tp_kses($settings['tp_portfolio_box_btn']); ?>
                                     <span>
                                        <svg width="26" height="9" viewBox="0 0 26 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                           <path d="M21.6934 1L25 4.20003L21.6934 7.4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                           <path d="M0.999999 4.19897H25" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                     </span>
                                  </a>
                               </div>
                            </div>
                         </div>
                      </div>
                   </div>
                   <?php endwhile; 
                     wp_reset_query(); ?>
                </div>
                <?php else : ?>
                    <div class="row grid">
                        <?php 
                        
                        while ($query->have_posts()) : 
                        $query->the_post();
                        global $post;
                        $terms = get_the_terms($post->ID, 'portfolio-cat'); 
                        $item_classes = '';
                        $item_cat_names = '';
                        $item_cats = get_the_terms( $post->ID, 'portfolio-cat' );
                        if( !empty($item_cats) ):
                            $count = count($item_cats) - 1;
                            foreach($item_cats as $key => $item_cat) {
                                $item_classes .= $item_cat->slug . ' ';
                                $item_cat_names .= ( $count > $key ) ? $item_cat->name  . ', ' : $item_cat->name;
                            }
                        endif; 
                        $harry_video_url = function_exists('get_field') ? get_field('add_portfolio_video') : '';
                        ?>
                        <div class="col-xl-<?php echo esc_attr($settings['tp_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['tp_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['tp_col_for_tablet']); ?> col-<?php echo esc_attr($settings['tp_col_for_mobile']); ?> tp-portfolio grid-item <?php echo $item_classes; ?>">
                            <div class="portfolio__grid-item mb-40 tp-el-box">
        
                            <?php if ( has_post_thumbnail() ): ?>
                                <div class="portfolio__grid-thumb w-img fix">
                                    <a href="<?php echo esc_url( get_the_permalink() ); ?>">
                                    <?php the_post_thumbnail($settings['portfolio_thumb_size_size']); ?>
                                    </a>
        
                                    <?php if(!empty($harry_video_url)) : ?>
                                    <div class="portfolio__grid-video">
                                        <a href="<?php echo esc_url($harry_video_url);  ?>" class="portfolio-play-btn popup-video tp-el-video-btn">
                                            <svg width="18" height="22" viewBox="0 0 18 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M18 11L0 21.3923V0.607696L18 11Z" fill="currentColor"/>
                                            </svg>                                    
                                        </a>
                                    </div>
                                    
                                    <?php else: ?>
                                    <div class="portfolio__grid-popup">
                                        <a href="<?php echo get_the_post_thumbnail_url(); ?>" class="popup-image tp-el-box-plus">
                                            <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M14.1667 8.33341H0.833333C0.377778 8.33341 0 7.95564 0 7.50008C0 7.04453 0.377778 6.66675 0.833333 6.66675H14.1667C14.6222 6.66675 15 7.04453 15 7.50008C15 7.95564 14.6222 8.33341 14.1667 8.33341Z" fill="currentColor"/>
                                                <path d="M7.4974 15C7.04184 15 6.66406 14.6222 6.66406 14.1667V0.833333C6.66406 0.377778 7.04184 0 7.4974 0C7.95295 0 8.33073 0.377778 8.33073 0.833333V14.1667C8.33073 14.6222 7.95295 15 7.4974 15Z" fill="currentColor"/>
                                            </svg>                                    
                                        </a>
                                    </div>
                                    <?php endif; ?>
        
                                </div>
                                <?php endif; ?>
                                <div class="portfolio__grid-content">
                                    <h3 class="portfolio__grid-title tp-el-box-title">
                                        <a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php the_title(); ?></a>
                                    </h3>
                                    <div class="portfolio__grid-bottom">
                                    <div class="portfolio__grid-category tp-el-box-tag">
                                        <span><?php echo esc_html($item_cat_names); ?></span>
                                    </div>
                                    <div class="portfolio__grid-show-project">
                                        <a href="<?php echo esc_url( get_the_permalink() ); ?>" class="portfolio-link-btn tp-el-box-btn" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>">
                                        <?php echo tp_kses($settings['tp_portfolio_box_btn']); ?>
                                            <span>
                                                <svg width="26" height="9" viewBox="0 0 26 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M21.6934 1L25 4.20003L21.6934 7.4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M0.999999 4.19897H25" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </span>
                                        </a>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endwhile; 
                        wp_reset_query(); ?>

                    </div>

               <?php endif; ?>

               <?php if($settings['tp_portfolio_view_all_btn_switcher'] == 'yes')  :?>
               <div class="row">
                  <div class="col-xxl-12">
                     <div class="portfolio__load-more text-center">
                        <a class="tp-load-more-btn mt-30 mb-50 tp-el-btn" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>">
                           <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M1 8.5C1 4.36 4.33 1 8.5 1C13.5025 1 16 5.17 16 5.17M16 5.17V1.42M16 5.17H12.67" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M15.9175 8.5C15.9175 12.64 12.5575 16 8.4175 16C4.2775 16 1.75 11.83 1.75 11.83M1.75 11.83H5.14M1.75 11.83V15.58" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                           </svg>                              
                           <?php echo tp_kses($settings['tp_portfolio_view_all_btn_text']); ?>
                        </a>
                     </div>
                  </div>
               </div>
               <?php endif; ?>                   
            </div>
         </section>
         <!-- portfolio area end -->

         

    	<?php endif; ?>

       <?php
	}

}

$widgets_manager->register( new TP_Portfolio_Post() );