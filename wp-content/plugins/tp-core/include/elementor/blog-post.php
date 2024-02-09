<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Blog_Post extends Widget_Base {

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
		return 'blogpost';
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
		return __( 'Blog Post', 'tpcore' );
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

        $this->tp_section_title_render_controls('blog', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.');
 
        $this->start_controls_section(
            'tp_section_subtitle_line_sec',
                [
                  'label' => esc_html__( 'Subtitle Line Color', 'tpcore' ),
                  'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                  'condition' =>[
                    'tp_design_style' => ['layout-7'],
                    ]
                ]
           );
           
           $this->add_control(
               'tp_subtitle_line',
               [
                   'label' => esc_html__( 'Line BG Color', 'tpcore' ),
                   'type' => Controls_Manager::TEXT,
                   'selectors' => [
                       '{{WRAPPER}} .section__title-pre-9::after' => 'background: {{VALUE}};',
                   ],
                   'placeholder' => esc_html__( 'red', 'tpcore' ),
               ]
           );

           
           $this->end_controls_section();

        // tp_btn_button_group
        $this->tp_button_render('blog_view_all', 'Blog More Button', ['layout-4', 'layout-5', 'layout-6', 'layout-7', 'layout-8'] );
        
        // Blog Query
		$this->tp_query_controls('blog', 'Blog');

        // layout Panel
        $this->tp_post_layout('post', 'Blog');

        // tp_post__columns_section
        $this->tp_columns('blog', 'Blog Column');

        // tp_post__slider_columns_section
		$this->tp_post_carousel_col('post', 'Blog');
	}

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('blog_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('blog_subtitle', 'Blog - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('blog_title', 'Blog - Title', '.tp-el-title');
        $this->tp_basic_style_controls('blog_description', 'Blog - Description', '.tp-el-content p');
        $this->tp_link_controls_style('blog_box_btn', 'Blog - Button', '.tp-el-btn');

// gradient button color
$this->start_controls_section(
    'tp_hero_gradient_btn_button',
    [
        'label' => esc_html__('Gradient Button', 'tp-core'),
        'tab' => Controls_Manager::TAB_STYLE,
    ]
);

$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name' => 'tp_hero_gradient_btn_typography',
        'selector' => '{{WRAPPER}} .tp-el-gradient-btn',
    ]
);


$this->start_controls_tabs('tp_hero_gradient_btn_button_tabs');

// Normal State Tab
$this->start_controls_tab('tp_hero_gradient_btn_btn_normal', ['label' => esc_html__('Normal', 'tp-core')]);

$this->add_control(
    'tp_hero_gradient_btn_btn_normal_text_color',
    [
        'label' => esc_html__('Text Color', 'tp-core'),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .tp-el-gradient-btn' => 'color: {{VALUE}};',
        ],
    ]
);

$this->add_control(
    'tp_hero_gradient_btn_btn_normal_bg_color',
    [
        'label' => esc_html__('Background Color', 'tp-core'),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .tp-el-gradient-btn' => 'background: {{VALUE}} !important;',
        ],
    ]
);

$this->add_control(
    'tp_hero_gradient_btn_bg_color',
    [
        'label' => esc_html__('Gradient BG Color', 'tp-core'),
        'type' => Controls_Manager::TEXT,
        'label_block' => true,
        'selectors' => [
            '{{WRAPPER}} .tp-el-gradient-btn::after' => 'background: {{VALUE}};',
        ],
    ]
);


$this->add_group_control(
    Group_Control_Box_Shadow::get_type(),
    [
        'name' => 'tp_hero_gradient_btn_btn_box_shadow',
        'label' => esc_html__( 'Box Shadow', 'tp-core' ),
        'selector' => '{{WRAPPER}} .tp-el-gradient-btn',
    ]
);

$this->add_control(
    'tp_hero_gradient_btn_btn_normal_border_style',
    [
        'label' => esc_html__('Border Style', 'tp-core'),
        'type' => Controls_Manager::SELECT,
        'options' => [
            '' => esc_html__('Default', 'tp-core'),
            'none' => esc_html__('None', 'tp-core'),
            'solid' => esc_html__('Solid', 'tp-core'),
            'double' => esc_html__('Double', 'tp-core'),
            'dotted' => esc_html__('Dotted', 'tp-core'),
            'dashed' => esc_html__('Dashed', 'tp-core'),
            'groove' => esc_html__('Groove', 'tp-core'),
        ],
        'selectors' => [
            '{{WRAPPER}} .tp-el-gradient-btn' => 'border-style: {{VALUE}} !important;;',
        ],
    ]
);

$this->add_responsive_control(
    'tp_hero_gradient_btn_btn_normal_border_width',
    [
        'label' => esc_html__('Border Width', 'tp-core'),
        'type' => Controls_Manager::DIMENSIONS,
        'size_units' => ['px', '%', 'em'],
        'selectors' => [
            '{{WRAPPER}} .tp-el-gradient-btn' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
        ],
        'separator' => 'before',
    ]
);

$this->add_control(
    'tp_hero_gradient_btn_btn_normal_border_color',
    [
        'label' => esc_html__('Border Color', 'tp-core'),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .tp-el-gradient-btn' => 'border-color: {{VALUE}} !important;;',
        ],
    ]

);


$this->add_control(
    'tp_hero_gradient_btn_btn_border_radius',
    [
        'label' => esc_html__('Border Radius', 'tp-core'),
        'type' => Controls_Manager::SLIDER,
        'range' => [
            'px' => [
                'max' => 100,
            ],
        ],
        'selectors' => [
            '{{WRAPPER}} .tp-el-gradient-btn' => 'border-radius: {{SIZE}}px;',
        ],
    ]
);

$this->end_controls_tab();

// Hover State Tab
$this->start_controls_tab('tp_hero_gradient_btn_btn_hover', ['label' => esc_html__('Hover', 'tp-core')]);

$this->add_control(
    'tp_hero_gradient_btn_btn_hover_text_color',
    [
        'label' => esc_html__('Text Color', 'tp-core'),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .tp-el-gradient-btn:hover' => 'color: {{VALUE}} !important;',
        ],
    ]
);

$this->add_control(
    'tp_hero_gradient_btn_btn_hover_bg_color',
    [
        'label' => esc_html__('Background Color', 'tp-core'),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .tp-el-gradient-btn:hover' => 'background: {{VALUE}} !important;',
        ],
    ]
);

$this->add_group_control(
    Group_Control_Box_Shadow::get_type(),
    [
        'name' => 'tp_hero_gradient_btn_btn_hover_box_shadow',
        'label' => esc_html__( 'Box Shadow', 'tp-core' ),
        'selector' => '{{WRAPPER}} .tp-el-gradient-btn:hover',
    ]
);

$this->add_control(
    'tp_hero_gradient_btn_btn_hover_border_style',
    [
        'label' => esc_html__('Border Style', 'tp-core'),
        'type' => Controls_Manager::SELECT,
        'options' => [
            '' => esc_html__('Default', 'tp-core'),
            'none' => esc_html__('None', 'tp-core'),
            'solid' => esc_html__('Solid', 'tp-core'),
            'double' => esc_html__('Double', 'tp-core'),
            'dotted' => esc_html__('Dotted', 'tp-core'),
            'dashed' => esc_html__('Dashed', 'tp-core'),
            'groove' => esc_html__('Groove', 'tp-core'),
        ],
        'selectors' => [
            '{{WRAPPER}} .tp-el-gradient-btn' => 'border-style: {{VALUE}} !important;;',
        ],
    ]
);

$this->add_responsive_control(
    'tp_hero_gradient_btn_btn_hover_border_width',
    [
        'label' => esc_html__('Border Width', 'tp-core'),
        'type' => Controls_Manager::DIMENSIONS,
        'size_units' => ['px', '%', 'em'],
        'selectors' => [
            '{{WRAPPER}} .tp-el-gradient-btn' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
        ],
        'separator' => 'before',
    ]
);

$this->add_control(
    'tp_hero_gradient_btn_btn_hover_border_color',
    [
        'label' => esc_html__('Border Color', 'tp-core'),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .tp-el-gradient-btn:hover' => 'border-color: {{VALUE}} !important;',
        ],
    ]
);




$this->end_controls_tab();

$this->end_controls_tabs();

        $this->add_responsive_control(
    'tp_hero_gradient_btn_padding',
    [
        'label' => esc_html__('Padding', 'tp-core'),
        'type' => Controls_Manager::DIMENSIONS,
        'size_units' => ['px', 'em', '%'],
        'selectors' => [
            '{{WRAPPER}} .tp-el-gradient-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
    ]
);
$this->add_responsive_control(
    'tp_hero_gradient_btn_margin',
    [
        'label' => esc_html__('Margin', 'tp-core'),
        'type' => Controls_Manager::DIMENSIONS,
        'size_units' => ['px', 'em', '%'],
        'selectors' => [
            '{{WRAPPER}} .tp-el-gradient-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
    ]
);

$this->end_controls_section();
        $this->tp_basic_style_controls('blog_box_title', 'Box - Title', '.tp-el-box-title');
        $this->tp_basic_style_controls('blog_box_desc', 'Box - Description', '.tp-el-box-desc');
        $this->tp_link_controls_style('blog_box_tag', 'Box - Tag', '.tp-el-box-tag');
        $this->tp_basic_style_controls('blog_box_meta', 'Box - Meta', '.tp-el-box-meta span');
        $this->tp_link_controls_style('blog_box_btn_2', 'Box - Button', '.tp-el-box-btn');
        $this->tp_link_controls_style('blog_box_author', 'Box - Author', '.tp-el-author-title');
        $this->tp_link_controls_style('blog_box_arrow', 'Box - Author', '.tp-el-box-arrow');
        
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
        $query_args = TP_Helper::get_query_args('post', 'category', $this->get_settings());

        // The Query
        $query = new \WP_Query($query_args);


        $filter_list = $settings['category'];

        // var_dump($query);

        $carousel_args = [
            'arrows' => ('yes' === $settings['tp_post__arrow']),
            'dots' => ('yes' === $settings['tp_post__dots']),
            'autoplay' => ('yes' === $settings['tp_post__autoplay']),
            'autoplay_speed' => absint($settings['tp_post__autoplay_speed']),
            'infinite' => ('yes' === $settings['tp_post__infinite']),
            'for_xl_desktop' => absint($settings['tp_post__slider_for_xl_desktop']),
            'slidesToShow' => absint($settings['tp_post__slider_for_desktop']),
            'for_laptop' => absint($settings['tp_post__slider_for_laptop']),
            'for_tablet' => absint($settings['tp_post__slider_for_tablet']),
            'for_mobile' => absint($settings['tp_post__slider_for_mobile']),
            'for_xs_mobile' => absint($settings['tp_post__slider_for_xs_mobile']),
        ];
        $this->add_render_attribute('tp-carousel-post-data', 'data-settings', wp_json_encode($carousel_args));

        ?>

        <?php if ( $settings['tp_design_style']  == 'layout-2' ): 
            

            if($settings['enable_style_2'] == 'yes'){
                $enable_style_2 = 'blog__style-2';
                $blog_col = 'col-xxl-8 col-xl-8 col-lg-5 col-md-7 col-sm-8';
                $blog_col_2 = 'col-xxl-4 col-xl-4 col-lg-7 col-md-5 col-sm-4';
                $this->add_render_attribute('title_args', 'class', 'tp-section-title-2 tp-el-title');
            }else{
                $enable_style_2 = '';
                $blog_col = 'col-xxl-5 col-xl-5 col-lg-5 col-md-7 col-sm-8';
                $blog_col_2 = 'col-xxl-7 col-xl-7 col-lg-7 col-md-5 col-sm-4';
                $this->add_render_attribute('title_args', 'class', 'section__title-4 tp-el-title');
            }
        ?>

        <!-- blog area start -->
        <section class="blog__area <?php echo esc_attr($enable_style_2); ?> fix pt-100 pb-70 tp-el-section">
            <div class="container">
            <?php if ( !empty($settings['tp_blog_section_title_show']) ) : ?>
               <div class="row align-items-center">
                  <div class="<?php echo esc_attr($blog_col); ?>">

                  <!-- second style -->
                    <?php if($settings['enable_style_2'] == 'yes'): ?>
                        <div class="tp-section-title-wrapper-4 mb-60 tp-el-content">

                            <?php if(!empty($settings['tp_blog_sub_title'])): ?>
                            <span class="tp-section-subtitle-2 is-uppercase subtitle-mb-2 tp-el-subtitle"><?php echo tp_kses($settings['tp_blog_sub_title']); ?></span>
                            <?php endif; ?>

                            <?php
                                if ( !empty($settings['tp_blog_title' ]) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['tp_blog_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        tp_kses( $settings['tp_blog_title' ] )
                                        );
                                endif;
                            ?>

                            <?php if (!empty($item['tp_blog_description'])) : ?>
                            <p><?php echo tp_kses( $item['tp_blog_description'] ); ?></p>
                            <?php endif; ?> 
                        </div>

                    <!-- default style -->
                    <?php else: ?>
                     <div class="section__title-wrapper-4 mb-60 tp-el-content">

                        <?php if(!empty($settings['tp_blog_sub_title'])): ?>
                        <span class="section__title-pre-4 tp-el-subtitle"><?php echo tp_kses($settings['tp_blog_sub_title']); ?></span>
                        <?php endif; ?>

                        <?php
                            if ( !empty($settings['tp_blog_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['tp_blog_title_tag'] ),
                                    $this->get_render_attribute_string( 'title_args' ),
                                    tp_kses( $settings['tp_blog_title' ] )
                                    );
                            endif;
                        ?>

                            <?php if (!empty($item['tp_blog_description'])) : ?>
                            <p><?php echo tp_kses( $item['tp_blog_description'] ); ?></p>
                            <?php endif; ?> 
                     </div>
                     <?php endif; ?>
                  </div>
                  <div class="<?php echo esc_attr($blog_col_2); ?>">
                     <div class="blog__nav text-sm-end d-none d-sm-block tp-el-box-arrow">
                        <button class="blog-slider-button-prev"><i class="fa-light fa-angle-left"></i></button>
                        <button class="blog-slider-button-next"><i class="fa-light fa-angle-right"></i></button>
                     </div>
                  </div>
               </div>
               <?php endif; ?>
               <div class="row">
                  <div class="col-xxl-12">
                     <div class="blog__slider">
                        <div class="blog__slider-active swiper-container">
                           <div class="swiper-wrapper">
                                <?php if ($query->have_posts()) : ?>
                                    <?php while ($query->have_posts()) : 
                                        $query->the_post();
                                        global $post;
                                        $categories = get_the_category($post->ID);

                                        if(has_post_thumbnail()){
                                            $post_thumbnail = 'has-thumbnail';
                                            $post_thumbnail_col = 'col-lg-7 col-md-7 col-sm-6';
                                        }else{
                                            $post_thumbnail = 'no-thumbnail';
                                            $post_thumbnail_col = 'col-lg-12 col-md-12 col-sm-12';
                                        }
                                        $author_bio_avatar_size = 180;
                                    ?>
                              <div class="blog__item-4 swiper-slide">
                                 <div class="row">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                    <div class="col-lg-5 col-md-5 col-sm-6">
                                       <div class="blog__thumb-4 m-img">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail( $post->ID, $settings['thumbnail_size'] );?>
                                            </a>
                                       </div>
                                    </div>
                                    <?php endif; ?>
                                    <div class="<?php echo esc_attr($post_thumbnail_col); ?>">
                                       <div class="blog__content-4 <?php echo esc_attr($post_thumbnail); ?>">
                                          <div class="blog__tag-4">
                                             <a class="tp-el-box-tag" href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>"><?php echo esc_html($categories[0]->name); ?></a>
                                          </div>
                                          <h3 class="blog__title-4 tp-el-box-title">
                                             <a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), $settings['tp_blog_title_word'], ''); ?></a>
                                          </h3>
                                          <?php if (!empty($settings['tp_post_content'])):
                                                $tp_post_content_limit = (!empty($settings['tp_post_content_limit'])) ? $settings['tp_post_content_limit'] : '';
                                        ?>
                                          <p class="tp-el-box-desc"><?php print wp_trim_words(get_the_excerpt(get_the_ID()), $tp_post_content_limit, ''); ?></p>
                                          <?php endif; ?>

                                          <div class="blog__author d-flex align-items-center mb-30">
                                             <div class="blog__author-thumb">
                                                <a href="<?php print esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )?>">
                                                <?php print get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size, '', '', [ 'class' => 'media-object img-circle' ] );?>
                                                </a>
                                             </div>
                                             <div class="blog__author-content">
                                                <h3 class="blog__author-title tp-el-author-title">
                                                   <a href="<?php print esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )?>"><?php print get_the_author();?></a>
                                                </h3>
                                             </div>
                                          </div>

                                          <div class="blog__meta-4 d-flex align-items-center justify-content-between tp-el-box-meta">
                                             <span>
                                                <svg width="14" height="16" viewBox="0 0 14 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                   <path d="M4.33325 1V3" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                                   <path d="M9.66675 1V3" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                                   <path d="M1.33374 5.72656H12.6671" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                                   <path d="M13 5.33285V10.9995C13 12.9995 12 14.3328 9.66667 14.3328H4.33333C2 14.3328 1 12.9995 1 10.9995V5.33285C1 3.33285 2 1.99951 4.33333 1.99951H9.66667C12 1.99951 13 3.33285 13 5.33285Z" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                                   <path d="M9.46297 8.79964H9.46896" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                   <path d="M9.46297 10.8001H9.46896" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                   <path d="M6.99691 8.79964H7.0029" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                   <path d="M6.99691 10.8001H7.0029" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                   <path d="M4.52938 8.79964H4.53537" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                   <path d="M4.52938 10.8001H4.53537" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg> <?php the_time( 'd M Y' ); ?>
                                             </span>
                                             <span>
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                   <path d="M12.5291 11.381L12.8021 13.5929C12.8721 14.1739 12.2491 14.5799 11.7521 14.2789L8.81916 12.5359C8.49716 12.5359 8.18217 12.515 7.87417 12.473C8.39216 11.864 8.70016 11.0939 8.70016 10.2609C8.70016 8.27295 6.97817 6.66299 4.85018 6.66299C4.03818 6.66299 3.28919 6.89397 2.66619 7.29997C2.64519 7.12497 2.63818 6.94997 2.63818 6.76797C2.63818 3.58298 5.40317 1 8.81916 1C12.2351 1 15.0001 3.58298 15.0001 6.76797C15.0001 8.65796 14.0271 10.331 12.5291 11.381Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                   <path d="M8.69997 10.261C8.69997 11.094 8.39197 11.8641 7.87397 12.4731C7.18098 13.313 6.08198 13.852 4.84998 13.852L3.02299 14.937C2.71499 15.126 2.32299 14.867 2.36499 14.51L2.53999 13.131C1.602 12.4801 1 11.437 1 10.261C1 9.02904 1.658 7.94406 2.666 7.30006C3.28899 6.89407 4.03799 6.66309 4.84998 6.66309C6.97797 6.66309 8.69997 8.27305 8.69997 10.261Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                                <?php comments_number();?>
                                             </span>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <?php endwhile; wp_reset_query(); ?>
                            <?php endif; ?>
                           </div>
                        </div>
                        <div class="blog-slider-4 tp-swiper-dot text-center d-sm-none"></div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- blog area end -->

        <!-- default style -->

        <?php elseif ( $settings['tp_design_style']  == 'layout-3' ): 
            $this->add_render_attribute('title_args', 'class', 'section__title-4 tp-el-title');
        ?>
                <?php if ($query->have_posts()) : 
                    while ($query->have_posts()) : 
                    $query->the_post();
                    global $post;

                    $categories = get_the_category($post->ID);
                ?>
                <div class="blog__item-2 white-bg transition-3 mb-30 wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s">
                <?php if ( has_post_thumbnail() ): ?> 
                    <div class="blog__thumb-2 p-relative w-img fix">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail( $post->ID, $settings['thumbnail_size'] );?>
                        </a>
                        <div class="blog__meta-2">
                            <h4><?php the_time( 'd' ); ?> <span><?php the_time( 'M' ); ?></span></h4>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="blog__content-2">
                        <div class="blog__tag-2">
                            <a class="tp-el-box-tag" href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>"><?php echo esc_html($categories[0]->name); ?></a>
                        </div>
                        <h3 class="blog__title-2 tp-el-box-title">
                            <a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), $settings['tp_blog_title_word'], ''); ?></a>
                        </h3>
                        <?php if (!empty($settings['tp_post_content'])):
                            $tp_post_content_limit = (!empty($settings['tp_post_content_limit'])) ? $settings['tp_post_content_limit'] : '';
                        ?>
                        <p class="tp-el-box-desc"><?php print wp_trim_words(get_the_excerpt(get_the_ID()), $tp_post_content_limit, ''); ?></p>
                        <?php endif; ?>

                        <?php if(!empty($settings['tp_post_button'])) :?>
                        <div class="blog__btn">
                            <a href="<?php the_permalink(); ?>"  class="tp-btn-border-green-2 tp-el-box-btn"><?php echo tp_kses($settings['tp_post_button']); ?></a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php 
                    endwhile; 
                    wp_reset_query(); 
                    endif;
                ?>

            <?php elseif ( $settings['tp_design_style']  == 'layout-4' ): 
                $this->add_render_attribute('title_args', 'class', 'section__title-5 tp-el-title');
                $bloginfo = get_bloginfo( 'name' );  

                if ('2' == $settings['tp_blog_view_all_btn_link_type']) {
                    $link = get_permalink($settings['tp_blog_view_all_btn_page_link']);
                    $target = '_self';
                    $rel = 'nofollow';
                } else {
                    $link = !empty($settings['tp_blog_view_all_btn_link']['url']) ? $settings['tp_blog_view_all_btn_link']['url'] : '';
                    $target = !empty($settings['tp_blog_view_all_btn_link']['is_external']) ? '_blank' : '';
                    $rel = !empty($settings['tp_blog_view_all_btn_link']['nofollow']) ? 'nofollow' : '';
                }
            ?>

         <!-- blog area start -->
         <section class="blog__area p-relative z-index-1 pt-150 pb-130 tp-el-section">

            <?php if(!empty($settings['tp_blog_shape'])) : ?>
            <div class="blog__shape">
               <img class="blog__shape-1" src="<?php echo get_template_directory_uri() . '/assets/img/blog/5/shape/shape-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="blog__shape-2" src="<?php echo get_template_directory_uri() . '/assets/img/blog/5/shape/shape-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="blog__shape-3" src="<?php echo get_template_directory_uri() . '/assets/img/blog/5/shape/shape-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="blog__shape-4" src="<?php echo get_template_directory_uri() . '/assets/img/blog/5/shape/shape-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
            </div>
            <?php endif; ?>

            <div class="container">
                <?php if ( !empty($settings['tp_blog_section_title_show']) ) : ?>
               <div class="row">
                  <div class="col-xxl-12">
                     <div class="section__title-wrapper-5 mb-50 text-center tp-el-content">

                        <?php if(!empty($settings['tp_blog_sub_title'])): ?>
                        <span class="section__title-pre-5 tp-el-subtitle"><?php echo tp_kses($settings['tp_blog_sub_title']); ?></span>
                        <?php endif; ?>

                        <?php
                            if ( !empty($settings['tp_blog_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['tp_blog_title_tag'] ),
                                    $this->get_render_attribute_string( 'title_args' ),
                                    tp_kses( $settings['tp_blog_title' ] )
                                    );
                            endif;
                        ?>

                            <?php if (!empty($item['tp_blog_description'])) : ?>
                            <p><?php echo tp_kses( $item['tp_blog_description'] ); ?></p>
                            <?php endif; ?> 
                     </div>
                  </div>
               </div>
               <?php endif; ?>
               <div class="row">
               <?php if ($query->have_posts()) : ?>
                        <?php while ($query->have_posts()) : 
                        $query->the_post();
                        global $post;

                        $categories = get_the_category($post->ID);

                        if(has_post_thumbnail()){
                            $post_thumbnail_col = 'col-xl-7 col-lg-12';
                            $post_thumb_content = '';
                        }else{
                            $post_thumbnail_col = 'col-lg-12 col-md-12 col-sm-12';
                            $post_thumb_content = 'blog__content-5-padding';
                        }

                        ?>
                  <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                     <div class="blog__item-5 mb-30 wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s">
                        <div class="row">
                        <?php if ( has_post_thumbnail() ): ?> 
                           <div class="col-xl-5 col-lg-12">
                              <div class="blog__thumb-5">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail( $post->ID, $settings['thumbnail_size'] );?>
                                </a>
                              </div>
                           </div>
                           <?php endif; ?>  
                           
                        <div class="<?php echo esc_attr($post_thumbnail_col); ?>">
                            <div class="blog__content-5 <?php echo esc_attr($post_thumb_content); ?>">
                                <div class="blog__tag-5">
                                    <a class="tp-el-box-tag" href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>"><?php echo esc_html($categories[0]->name); ?></a>
                                </div>

                                <h3 class="blog__title-5 tp-el-box-title">
                                    <a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), $settings['tp_blog_title_word'], ''); ?></a>
                                </h3>

                                <div class="blog__meta-5 tp-el-box-meta">
                                    <span><i class="fa-regular fa-clock"></i> <?php the_time( 'd M Y' ); ?></span>
                                    <span><i class="fa-regular fa-comment"></i> <?php comments_number();?></span>
                                </div>

                                <?php if (!empty($settings['tp_post_content'])):
                                    $tp_post_content_limit = (!empty($settings['tp_post_content_limit'])) ? $settings['tp_post_content_limit'] : '';
                                ?>
                                <p class="tp-el-box-desc"><?php print wp_trim_words(get_the_excerpt(get_the_ID()), $tp_post_content_limit, ''); ?></p>
                                <?php endif; ?>

                                <?php if(!empty($settings['tp_post_button'])) :?>
                                <div class="blog__btn-5">
                                    <a href="<?php the_permalink(); ?>" class="tp-link-btn-circle tp-el-box-btn">
                                    <?php echo tp_kses($settings['tp_post_button']); ?>
                                        <span>
                                            <i class="fa-regular fa-arrow-right"></i>
                                            <i class="fa-regular fa-arrow-right"></i>
                                        </span>
                                    </a>
                                </div>
                                <?php endif; ?>                               
                                
                            </div>
                            </div>
                        </div>
                     </div>
                  </div>
                  <?php endwhile; wp_reset_query(); ?>
                <?php endif; ?>

               </div>

               <?php if(!empty($settings['tp_blog_view_all_btn_switcher'])) :?>
               <div class="row">
                  <div class="col-xxl-12">
                     <div class="blog__more-5 mt-30 text-center wow fadeInUp" data-wow-delay=".7s" data-wow-duration="1s">
                        <a class="tp-btn-round tp-el-btn"  target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>"><?php echo tp_kses($settings['tp_blog_view_all_btn_text']); ?></a>
                     </div>
                  </div>
               </div>
               <?php endif; ?>
            </div>
         </section>
         <!-- blog area end -->

         <?php elseif ( $settings['tp_design_style']  == 'layout-5' ): 
                $this->add_render_attribute('title_args', 'class', 'section__title-7 tp-el-title');
                $bloginfo = get_bloginfo( 'name' );  
                if ('2' == $settings['tp_blog_view_all_btn_link_type']) {
                    $link = get_permalink($settings['tp_blog_view_all_btn_page_link']);
                    $target = '_self';
                    $rel = 'nofollow';
                } else {
                    $link = !empty($settings['tp_blog_view_all_btn_link']['url']) ? $settings['tp_blog_view_all_btn_link']['url'] : '';
                    $target = !empty($settings['tp_blog_view_all_btn_link']['is_external']) ? '_blank' : '';
                    $rel = !empty($settings['tp_blog_view_all_btn_link']['nofollow']) ? 'nofollow' : '';
                }
            ?>

         <!-- blog area start -->
         <section class="blog__area blog__border-7 pb-115 pt-30 tp-el-section">
            <div class="container">
            <?php if ( !empty($settings['tp_blog_section_title_show']) ) : ?>
               <div class="row align-items-end">
                  <div class="col-lg-8 col-md-7">
                     <div class="blog__section-title-7">
                        <div class="section__title-wrapper-7 mb-60 tp-el-content">
                        <?php if(!empty($settings['tp_blog_sub_title'])): ?>
                        <span class="section__title-pre-7 tp-el-subtitle"><?php echo tp_kses($settings['tp_blog_sub_title']); ?></span>
                        <?php endif; ?>

                        <?php
                            if ( !empty($settings['tp_blog_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['tp_blog_title_tag'] ),
                                    $this->get_render_attribute_string( 'title_args' ),
                                    tp_kses( $settings['tp_blog_title' ] )
                                    );
                            endif;
                        ?>
                        <?php if ( !empty($settings['tp_blog_description']) ) : ?>
                            <p><?php echo tp_kses( $settings['tp_blog_description'] ); ?></p>
                        <?php endif; ?>
                        </div>
                     </div>
                  </div>
                  <?php if(!empty($settings['tp_blog_view_all_btn_switcher'])) :?>
                  <div class="col-lg-4 col-md-5">
                     <div class="blog__btn-7 text-md-end mb-60">
                        <a class="tp-btnr-border-2 tp-btn-shine-effect tp-el-btn" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>"><?php echo tp_kses($settings['tp_blog_view_all_btn_text']); ?></a>
                     </div>
                  </div>
                  <?php endif; ?>
               </div>
               <?php endif; ?>
               <div class="row tp-gx-6">
                    <?php if ($query->have_posts()) : ?>
                    <?php while ($query->have_posts()) : 
                    $query->the_post();
                    global $post;

                    $categories = get_the_category($post->ID);
                    $author_bio_avatar_size = 180;
                    ?>
                  <div class="col-xxl-4 col-lg-4 col-md-6">
                     <div class="blog__item-7 transition-3 white-bg mb-30">
                     <?php if ( has_post_thumbnail() ): ?> 
                        <div class="blog__thumb-7 w-img mb-25">
                           <a href="<?php the_permalink(); ?>">
                             <?php the_post_thumbnail( $post->ID, $settings['thumbnail_size'] );?>
                           </a>
                        </div>
                        <?php endif; ?>
                        <div class="blog__content-7">
                           <div class="blog__content-top-7 d-flex align-items-center">
                              <div class="blog__tag-7">
                                 <a class="tp-el-box-tag" href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>"><?php echo esc_html($categories[0]->name); ?></a>
                              </div>
                              <div class="blog__meta-7 tp-el-box-meta">
                                 <span><i class="fa-regular fa-clock"></i> <?php the_time( get_option('date_format') ); ?></span>
                              </div>
                           </div>
                           <h3 class="blog__title-7 tp-el-box-title">
                              <a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), $settings['tp_blog_title_word'], ''); ?></a>
                           </h3>
                           <?php if (!empty($settings['tp_post_content'])):
                                $tp_post_content_limit = (!empty($settings['tp_post_content_limit'])) ? $settings['tp_post_content_limit'] : '';
                            ?>
                            <p class="tp-el-box-desc"><?php print wp_trim_words(get_the_excerpt(get_the_ID()), $tp_post_content_limit, ''); ?></p>
                            <?php endif; ?>
                            
                           <div class="blog__content-bottom-7 d-flex align-items-center justify-content-between">
                              <div class="blog__meta-author d-flex align-items-center">
                                 <div class="blog__meta-author-thumb">
                                    <a href="<?php print esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )?>">
                                    <?php print get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size, '', '', [ 'class' => 'media-object img-circle' ] );?>
                                    </a>
                                 </div>
                                 <div class="blog__meta-author-content tp-el-author-title">
                                    <span>By<a href="<?php print esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )?>"> <?php print get_the_author();?></a></span>
                                 </div>
                              </div>
                              <div class="blog__meta-7 tp-el-box-meta">
                                 <span><i class="fa-regular fa-comment"></i> <?php echo get_comments_number($post->ID);?></span>

                                 <?php if(function_exists('getPostViews')) : ?>
                                 <span><i class="fa-light fa-eye"></i> <?php echo getPostViews(get_the_ID()); ?></span>
                                 <?php endif; ?>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <?php endwhile; wp_reset_query(); ?>
                    <?php endif; ?>
               </div>
            </div>
         </section>
         <!-- blog area end -->

        <?php elseif ( $settings['tp_design_style']  == 'layout-6' ): 
            $this->add_render_attribute('title_args', 'class', 'section__title-6 tp-el-title');
            $bloginfo = get_bloginfo( 'name' );  
            if ('2' == $settings['tp_blog_view_all_btn_link_type']) {
                $link = get_permalink($settings['tp_blog_view_all_btn_page_link']);
                $target = '_self';
                $rel = 'nofollow';
            } else {
                $link = !empty($settings['tp_blog_view_all_btn_link']['url']) ? $settings['tp_blog_view_all_btn_link']['url'] : '';
                $target = !empty($settings['tp_blog_view_all_btn_link']['is_external']) ? '_blank' : '';
                $rel = !empty($settings['tp_blog_view_all_btn_link']['nofollow']) ? 'nofollow' : '';
            }
        ?>

         <!-- blog area start -->
         <section class="blog__area pt-45 pb-140 tp-el-section">
            <div class="container">
            <?php if ( !empty($settings['tp_blog_section_title_show']) ) : ?>
               <div class="row align-items-end">
                  <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7">
                     <div class="section__title-wrapper-6 mb-60 tp-el-content">

                        <?php if(!empty($settings['tp_blog_sub_title'])): ?>
                        <span class="section__title-pre-6 tp-el-subtitle"><?php echo tp_kses($settings['tp_blog_sub_title']); ?></span>
                        <?php endif; ?>

                        <?php
                            if ( !empty($settings['tp_blog_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['tp_blog_title_tag'] ),
                                    $this->get_render_attribute_string( 'title_args' ),
                                    tp_kses( $settings['tp_blog_title' ] )
                                    );
                            endif;
                        ?>

                        <?php if ( !empty($settings['tp_blog_description']) ) : ?>
                            <p><?php echo tp_kses( $settings['tp_blog_description'] ); ?></p>
                        <?php endif; ?>
                     </div>
                  </div>
                  <?php if(!empty($settings['tp_blog_view_all_btn_switcher'])) :?>
                  <div class="col-xxl-8 col-xl-7 col-lg-7 col-md-5">
                     <div class="blog__more-6 text-md-end mb-70">
                        <a class="tp-btn-blue-2 tp-link-btn-3 tp-el-btn" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>">
                            <?php echo tp_kses($settings['tp_blog_view_all_btn_text']); ?>
                           <span>
                              <i class="fa-regular fa-arrow-right"></i>
                           </span>
                        </a>
                     </div>
                  </div>
                  <?php endif; ?>
               </div>
               <?php endif; ?>
               <div class="row">
                  <div class="col-xxl-12">
                    <?php if ($query->have_posts()) : ?>
                        <?php while ($query->have_posts()) : 
                        $query->the_post();
                        global $post;

                        
                        
                        $categories = get_the_category($post->ID);
                        $category_icon = function_exists( 'get_field' ) ? get_field( 'category_icon', $categories[0] ) : '';
                        $author_bio_avatar_size = 180;
                        $harry_video_url = function_exists( 'get_field' ) ? get_field( 'fromate_style' ) : NULL;
                        
                    ?>
                     <div class="blog__item-6 wow fadeInUp scene" data-wow-delay=".3s" data-wow-duration="1s">
                        
                     <?php if ( has_post_thumbnail() ): ?>                         
                        <div class="blog__thumb-6">
                           <a href="<?php the_permalink(); ?>">
                              <img class="layer" data-depth=".3" src="<?php echo get_the_post_thumbnail_url( $post->ID, $settings['thumbnail_size'] );?>" alt="">
                           </a>
                        </div>
                        <?php endif; ?>
                        <div class="row">
                           <div class="col-md-2 col-sm-6">
                              <div class="blog__tag-6">
                                 <a class="tp-el-box-tag" href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>">

                                    <?php if(!empty($category_icon)) : ?>
                                    <?php echo tp_kses($category_icon); ?>
                                    <?php else :?>
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                            <path d="M18.3307 9.99984C18.3307 5.39984 14.5974 1.6665 9.9974 1.6665C5.3974 1.6665 1.66406 5.39984 1.66406 9.99984C1.66406 14.5998 5.3974 18.3332 9.9974 18.3332" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M6.66667 2.5H7.5C5.875 7.36667 5.875 12.6333 7.5 17.5H6.66667" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M12.4961 2.5C13.3044 4.93333 13.7128 7.46667 13.7128 10" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M2.49609 13.3333V12.5C4.92943 13.3083 7.46276 13.7167 9.99609 13.7167" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M2.49609 7.5C7.36276 5.875 12.6294 5.875 17.4961 7.5" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M15.1667 17.8334C16.6394 17.8334 17.8333 16.6394 17.8333 15.1667C17.8333 13.6939 16.6394 12.5 15.1667 12.5C13.6939 12.5 12.5 13.6939 12.5 15.1667C12.5 16.6394 13.6939 17.8334 15.1667 17.8334Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M18.3333 18.3333L17.5 17.5" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    <?php endif; ?>
                                    <?php echo esc_html($categories[0]->name); ?>
                                 </a>
                              </div>
                           </div>
                           <div class="col-md-3 col-sm-6">
                              <h3 class="blog__title-6 tp-el-box-title">
                                 <a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), $settings['tp_blog_title_word'], ''); ?></a>
                              </h3>
                           </div>
                           <div class="col-md-6 col-sm-6">
                              <div class="blog__content-6">
                                    <?php if (!empty($settings['tp_post_content'])):
                                        $tp_post_content_limit = (!empty($settings['tp_post_content_limit'])) ? $settings['tp_post_content_limit'] : '';
                                    ?>
                                    <p class="tp-el-box-desc"><?php print wp_trim_words(get_the_excerpt(get_the_ID()), $tp_post_content_limit, ''); ?></p>
                                    <?php endif; ?>

                                 <div class="blog__meta-6 tp-el-box-meta">
                                    <span><a href="<?php print esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )?>"><i class="fa-regular fa-user"></i> <?php print get_the_author();?></a></span>
                                    <span><i class="fa-regular fa-clock"></i> <?php the_time( get_option('date_format') ); ?></span>
                                 </div>
                              </div>
                           </div>

                           <?php if(!empty($harry_video_url)) : ?>
                           <div class="col-md-1 col-sm-6">
                              <div class="blog__play text-lg-end mt-25">
                                 <a href="<?php echo esc_url($harry_video_url); ?>" class="blog__play-btn popup-video tp-el-box-btn"><i class="fas fa-play"></i></a>
                              </div>
                           </div>
                           <?php endif; ?>

                        </div>
                     </div>
                     <?php endwhile; wp_reset_query(); ?>
                    <?php endif; ?>
                  </div>
               </div>
            </div>
         </section>
         <!-- blog area end -->

         <?php elseif ( $settings['tp_design_style']  == 'layout-7' ): 
            $this->add_render_attribute('title_args', 'class', 'section__title-9 tp-el-title');
            $bloginfo = get_bloginfo( 'name' );  
            if ('2' == $settings['tp_blog_view_all_btn_link_type']) {
                $link = get_permalink($settings['tp_blog_view_all_btn_page_link']);
                $target = '_self';
                $rel = 'nofollow';
            } else {
                $link = !empty($settings['tp_blog_view_all_btn_link']['url']) ? $settings['tp_blog_view_all_btn_link']['url'] : '';
                $target = !empty($settings['tp_blog_view_all_btn_link']['is_external']) ? '_blank' : '';
                $rel = !empty($settings['tp_blog_view_all_btn_link']['nofollow']) ? 'nofollow' : '';
            }
        ?>

         <!-- blog area start -->
         <section class="blog__area grey-bg-12 pt-115 pb-90 p-relative z-index-1 tp-el-section">
            <div class="container">
            <?php if ( !empty($settings['tp_blog_section_title_show']) ) : ?>
               <div class="row align-items-end">
                  <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-7">
                     <div class="section__title-wrapper-9 mb-65 tp-el-content">
                        <?php if ( !empty($settings['tp_blog_sub_title']) ) : ?>
                        <span class="section__title-pre-9 tp-el-subtitle"><?php echo tp_kses( $settings['tp_blog_sub_title'] ); ?></span>
                        <?php endif; ?>
                        

                        <?php
                            if ( !empty($settings['tp_blog_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['tp_blog_title_tag'] ),
                                    $this->get_render_attribute_string( 'title_args' ),
                                    tp_kses( $settings['tp_blog_title' ] )
                                    );
                            endif;
                        ?>

                        <?php if ( !empty($settings['tp_blog_description']) ) : ?>
                            <p><?php echo tp_kses( $settings['tp_blog_description'] ); ?></p>
                        <?php endif; ?>

                     </div>
                  </div>
                  <?php if(!empty($settings['tp_blog_view_all_btn_switcher'])) :?>
                  <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-5">
                     <div class="blog__more-9 mb-85 text-md-end">
                        <a class="tp-btn-5 tp-el-gradient-btn" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>"><?php echo tp_kses($settings['tp_blog_view_all_btn_text']); ?></a>
                     </div>
                  </div>
                  <?php endif; ?>                  
               </div>
               <?php endif; ?>
               <div class="row">
               <?php if ($query->have_posts()) :
                    while ($query->have_posts()) : 
                    $query->the_post();
                    global $post;

                    $categories = get_the_category($post->ID);

                    if(has_post_thumbnail()){
                        $post_thumbnail_col = 'col-xxl-7 col-xl-7';
                    }else{
                        $post_thumbnail_col = 'col-lg-12 col-md-12 col-sm-12';
                    }

                    ?>
                  <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                     <div class="blog__item-9 mb-30 wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s">
                     <?php if ( has_post_thumbnail() ): ?> 
                        <div class="blog__thumb-9 w-img fix">
                           <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail( $post->ID, $settings['thumbnail_size'] );?>
                            </a>
                        </div>
                        <?php endif; ?>
                        <div class="blog__content-9">
                           <div class="blog__meta-9 tp-el-box-meta">
                              <span>
                                <?php the_time( get_option('date_format') ); ?>
                              </span>
                              <span>
                                 <a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>"><?php echo esc_html($categories[0]->name); ?></a>
                              </span>
                           </div>
                           <h3 class="blog__title-9 tp-el-box-title">
                                <a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), $settings['tp_blog_title_word'], ''); ?></a>
                           </h3>
                        </div>
                     </div>
                  </div>
                  <?php endwhile;
                        wp_reset_query();
                        endif;
                   ?>
               </div>
            </div>
         </section>
         <!-- blog area end -->

         <?php elseif ( $settings['tp_design_style']  == 'layout-8' ): 
            $this->add_render_attribute('title_args', 'class', 'section__title-8 tp-el-title');
            $bloginfo = get_bloginfo( 'name' );  

            if ('2' == $settings['tp_blog_view_all_btn_link_type']) {
                $link = get_permalink($settings['tp_blog_view_all_btn_page_link']);
                $target = '_self';
                $rel = 'nofollow';
            } else {
                $link = !empty($settings['tp_blog_view_all_btn_link']['url']) ? $settings['tp_blog_view_all_btn_link']['url'] : '';
                $target = !empty($settings['tp_blog_view_all_btn_link']['is_external']) ? '_blank' : '';
                $rel = !empty($settings['tp_blog_view_all_btn_link']['nofollow']) ? 'nofollow' : '';
            }
        ?>

         <!-- blog area start -->
         <section class="blog__area black-bg-12 pt-110 pb-100 tp-el-section">
            <div class="container">
            <?php if ( !empty($settings['tp_blog_section_title_show']) ) : ?>
               <div class="row align-items-end">
                  <div class="col-xxl-8 col-xl-8 col-lg-8">
                     <div class="section__title-wrapper-8 mb-70 tp-el-content">

                        <?php if ( !empty($settings['tp_blog_sub_title']) ) : ?>
                        <span class="section__title-pre-8 tp-el-subtitle"><?php echo tp_kses( $settings['tp_blog_sub_title'] ); ?></span>
                        <?php endif; ?>

                        <?php
                            if ( !empty($settings['tp_blog_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['tp_blog_title_tag'] ),
                                    $this->get_render_attribute_string( 'title_args' ),
                                    tp_kses( $settings['tp_blog_title' ] )
                                    );
                            endif;
                        ?>

                        <?php if ( !empty($settings['tp_blog_description']) ) : ?>
                            <p><?php echo tp_kses( $settings['tp_blog_description'] ); ?></p>
                        <?php endif; ?>

                     </div>
                  </div>
                  <?php if(!empty($settings['tp_blog_view_all_btn_switcher'])) :?>
                  <div class="col-xxl-4 col-xl-4 col-lg-4">
                     <div class="blog__more-8 text-lg-end mb-80">
                        <a class="tp-btn-border-7 tp-el-btn"  target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>"><?php echo tp_kses($settings['tp_blog_view_all_btn_text']); ?> <i class="fa-regular fa-chevron-right"></i></a>
                     </div>
                  </div>
                  <?php endif; ?>                 
               </div>
               <?php endif; ?>
               <div class="row">
                  <div class="col-xxl-12">
                     <div class="blog__slider-8 wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s">
                        <div class="blog__slider-active-8 swiper-container">
                           <div class="swiper-wrapper">
                            <?php if ($query->have_posts()) : ?>
                                <?php while ($query->have_posts()) : 
                                $query->the_post();
                                global $post;

                                $categories = get_the_category($post->ID);

                                if(has_post_thumbnail()){
                                    $post_thumbnail_col = 'col-xxl-7 col-xl-7';
                                }else{
                                    $post_thumbnail_col = 'col-lg-12 col-md-12 col-sm-12';
                                }

                                ?>
                              <div class="blog__item-8 swiper-slide transition-3 p-relative fix">
                                 <div class="blog__thumb-8 transition-3" data-background="<?php echo get_the_post_thumbnail_url( $post->ID, $settings['thumbnail_size'] );?>"></div>
                                    <div class="blog__tag-8 tp-el-box-meta">
                                        <span>
                                            <a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>"><?php echo esc_html($categories[0]->name); ?></a>
                                        </span>
                                    </div>
                                    <div class="blog__content-8">
                                        <div class="blog__meta-8 tp-el-box-meta">
                                            <span class="blog-category">
                                                <a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>"><?php echo esc_html($categories[0]->name); ?></a>
                                            </span>
                                            <span><?php the_time( get_option('date_format') ); ?></span>
                                        </div>
                                        <h3 class="blog__title-8 tp-el-box-title">
                                            <a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), $settings['tp_blog_title_word'], ''); ?></a>
                                        </h3>
                                    </div>
                                </div>
                                <?php endwhile; wp_reset_query(); ?>
                                <?php endif; ?>
                           </div>
                        </div>
                        <div class="blog-slider-dot-8 mt-40 tp-swiper-dot tp-swiper-dot-2 text-center"></div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- blog area end -->

         <?php elseif ( $settings['tp_design_style']  == 'layout-9' ): 
            $this->add_render_attribute('title_args', 'class', 'section__title-8 tp-el-title');
            $bloginfo = get_bloginfo( 'name' );  

            if ('2' == $settings['tp_blog_view_all_btn_link_type']) {
                $link = get_permalink($settings['tp_blog_view_all_btn_page_link']);
                $target = '_self';
                $rel = 'nofollow';
            } else {
                $link = !empty($settings['tp_blog_view_all_btn_link']['url']) ? $settings['tp_blog_view_all_btn_link']['url'] : '';
                $target = !empty($settings['tp_blog_view_all_btn_link']['is_external']) ? '_blank' : '';
                $rel = !empty($settings['tp_blog_view_all_btn_link']['nofollow']) ? 'nofollow' : '';
            }
        ?>

        <?php if ($query->have_posts()) : ?>
            <?php while ($query->have_posts()) : 
            $query->the_post();
            global $post;

            $categories = get_the_category($post->ID);

            if(has_post_thumbnail()){
                $post_thumbnail_col = 'col-xxl-7 col-xl-7';
            }else{
                $post_thumbnail_col = 'col-lg-12 col-md-12 col-sm-12';
            }

            $author_bio_avatar_size = 180;

        ?>
            <div class="blog__item-10 white-bg transition-3 mb-30 fix">
            <?php if ( has_post_thumbnail() ): ?> 
            <div class="blog__thumb-10 w-img fix">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail( $post->ID, $settings['thumbnail_size'] );?>
                </a>
            </div>
            <?php endif; ?>
            <div class="blog__content-10">
                <div class="blog__content-10-top">
                    <div class="blog__meta-10-wrapper d-flex align-items-center">
                        <div class="blog__tag-10 mr-10">
                            <a class="tp-el-box-tag" href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>"><?php echo esc_html($categories[0]->name); ?></a>
                        </div>
                        <div class="blog__meta-10 tp-el-box-meta">
                            <span><?php the_time( get_option('date_format') ); ?></span>
                        </div>
                    </div>
                    <h3 class="blog__title-10 tp-el-box-title">
                        <a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), $settings['tp_blog_title_word'], ''); ?></a>
                    </h3>

                    <?php if (!empty($settings['tp_post_content'])):
                        $tp_post_content_limit = (!empty($settings['tp_post_content_limit'])) ? $settings['tp_post_content_limit'] : '';
                    ?>
                    <p class="tp-el-box-desc"><?php print wp_trim_words(get_the_excerpt(get_the_ID()), $tp_post_content_limit, ''); ?></p>
                    <?php endif; ?>
                </div>
                <div class="blog__content-10-bottom d-flex align-items-center">
                    <div class="blog__meta-author-10 d-flex align-items-center">
                        <div class="blog__meta-author-thumb-10">
                            <a href="<?php print esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )?>">
                                <?php print get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size, '', '', [ 'class' => 'media-object img-circle' ] );?>
                            </a>
                        </div>
                        <div class="blog__meta-author-content-10 tp-el-box-meta">
                            <span>By<a href="<?php print esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )?>"> <?php print get_the_author();?></a></span>
                        </div>
                    </div>
                    <div class="blog__meta-10 blog-meta-10-2 tp-el-box-meta">
                        <span><?php comments_number();?></span>
                    </div>
                </div>
            </div>
            </div>
            <?php endwhile; wp_reset_query();  endif;?>


        <?php elseif ( $settings['tp_design_style']  == 'layout-10' ): 
            $this->add_render_attribute('title_args', 'class', 'section__title-8 tp-el-title');
            $bloginfo = get_bloginfo( 'name' );  

            if ('2' == $settings['tp_blog_view_all_btn_link_type']) {
                $link = get_permalink($settings['tp_blog_view_all_btn_page_link']);
                $target = '_self';
                $rel = 'nofollow';
            } else {
                $link = !empty($settings['tp_blog_view_all_btn_link']['url']) ? $settings['tp_blog_view_all_btn_link']['url'] : '';
                $target = !empty($settings['tp_blog_view_all_btn_link']['is_external']) ? '_blank' : '';
                $rel = !empty($settings['tp_blog_view_all_btn_link']['nofollow']) ? 'nofollow' : '';
            }
        ?>

                    <?php if ($query->have_posts()) : ?>
                        <?php while ($query->have_posts()) : 
                        $query->the_post();
                        global $post;

                        $categories = get_the_category($post->ID);

                        if(has_post_thumbnail()){
                            $post_thumbnail_col = 'col-xxl-7 col-xl-7';
                        }else{
                            $post_thumbnail_col = 'col-lg-12 col-md-12 col-sm-12';
                        }

                        $author_bio_avatar_size = 180;

                    ?>
                    <div class="blog__item-10 blog__item-10-overlay white-bg transition-3 mb-30 fix order-last">
                        <div class="blog__thumb-10 m-img fix transition-3 include-bg" data-background="<?php echo get_the_post_thumbnail_url( $post->ID, $settings['thumbnail_size'] );?>"></div>
                        <div class="blog__content-10">
                           <div class="blog__content-10-top">
                              <div class="blog__meta-10-wrapper d-flex align-items-center">
                                 <div class="blog__tag-10 mr-10">
                                    <a class="tp-el-box-tag" href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>"><?php echo esc_html($categories[0]->name); ?></a>
                                 </div>
                                 <div class="blog__meta-10 tp-el-box-meta">
                                    <span><?php the_time( get_option('date_format') ); ?></span>
                                 </div>
                              </div>
                              <h3 class="blog__title-10 tp-el-box-title">
                              <a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), $settings['tp_blog_title_word'], ''); ?></a>
                              </h3>
                           </div>
                           <div class="blog__content-10-bottom d-flex align-items-center">
                              <div class="blog__meta-author-10 d-flex align-items-center">
                                 <div class="blog__meta-author-thumb-10">
                                    <a href="<?php print esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )?>">
                                        <?php print get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size, '', '', [ 'class' => 'media-object img-circle' ] );?>
                                    </a>
                                </div>
                                <div class="blog__meta-author-content-10 tp-el-box-meta">
                                    <span>By<a href="<?php print esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )?>"> <?php print get_the_author();?></a></span>
                                </div>
                              </div>
                              <div class="blog__meta-10 blog-meta-10-2 tp-el-box-meta">
                                <span><?php comments_number();?></span>
                              </div>
                           </div>
                        </div>
                     </div>
                     <?php endwhile; wp_reset_query();  endif;?>

        <?php elseif ( $settings['tp_design_style']  == 'layout-11' ): 
            $this->add_render_attribute('title_args', 'class', 'section__title-8 tp-el-title');
            $bloginfo = get_bloginfo( 'name' );  

            if ('2' == $settings['tp_blog_view_all_btn_link_type']) {
                $link = get_permalink($settings['tp_blog_view_all_btn_page_link']);
                $target = '_self';
                $rel = 'nofollow';
            } else {
                $link = !empty($settings['tp_blog_view_all_btn_link']['url']) ? $settings['tp_blog_view_all_btn_link']['url'] : '';
                $target = !empty($settings['tp_blog_view_all_btn_link']['is_external']) ? '_blank' : '';
                $rel = !empty($settings['tp_blog_view_all_btn_link']['nofollow']) ? 'nofollow' : '';
            }
        ?>

            <?php if ($query->have_posts()) : ?>
                <?php while ($query->have_posts()) : 
                $query->the_post();
                global $post;

                $categories = get_the_category($post->ID);

                if(has_post_thumbnail()){
                    $post_thumbnail_col = 'col-xxl-7 col-xl-7';
                }else{
                    $post_thumbnail_col = 'col-lg-12 col-md-12 col-sm-12';
                }

                $author_bio_avatar_size = 180;

            ?>
            <div class="blog__item-10 blog__item-10-sm white-bg transition-3 mb-30 fix">
                <div class="blog__content-10">
                    <div class="blog__content-10-top">
                        <div class="blog__meta-10-wrapper d-flex flex-wrap align-items-center">
                            <div class="blog__tag-10 mr-10">
                                <a class="tp-el-box-meta" href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>"><?php echo esc_html($categories[0]->name); ?></a>
                            </div>
                            <div class="blog__meta-10">
                                <span><?php the_time( get_option('date_format') ); ?></span>
                            </div>
                        </div>
                        <h3 class="blog__title-10">
                            <a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), $settings['tp_blog_title_word'], ''); ?></a>
                        </h3>
                    </div>
                    <div class="blog__content-10-bottom d-flex flex-wrap align-items-center">
                        <div class="blog__meta-author-10 d-flex align-items-center">
                            <div class="blog__meta-author-thumb-10">
                                <a href="<?php print esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )?>">
                                    <?php print get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size, '', '', [ 'class' => 'media-object img-circle' ] );?>
                                </a>
                            </div>
                            <div class="blog__meta-author-content-10">
                                <span>By<a href="<?php print esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )?>"> <?php print get_the_author();?></a></span>
                            </div>
                        </div>
                        <div class="blog__meta-10 blog-meta-10-2 tp-el-box-meta">
                         <span><?php comments_number();?></span>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; wp_reset_query();  endif;?>
        <?php else: ?>
        <!-- blog area start -->


        <?php if ($query->have_posts()) : ?>
            <?php while ($query->have_posts()) : 
            $query->the_post();
            global $post;

            $categories = get_the_category($post->ID);

            if(has_post_thumbnail()){
                $post_thumbnail_col = 'col-xxl-7 col-xl-7';
            }else{
                $post_thumbnail_col = 'col-lg-12 col-md-12 col-sm-12';
            }

            ?>
                <div class="blog__item white-bg transition-3 mb-30 wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s">
                    <div class="row">
                    <?php if ( has_post_thumbnail() ): ?> 
                        <div class="col-xxl-5 col-xl-5">
                            <div class="blog__thumb m-img fix">
                                <div class="tp-thumb-overlay wow"></div>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail( $post->ID, $settings['thumbnail_size'] );?>
                                </a>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="<?php echo esc_attr($post_thumbnail_col); ?>">
                            <div class="blog__content">
                                <div class="blog__content-top">
                                    <div class="blog__tag">
                                        <a class="tp-el-box-tag" href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>"><?php echo esc_html($categories[0]->name); ?></a>
                                    </div>
                                    <h3 class="blog__title tp-el-box-title">
                                        <a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), $settings['tp_blog_title_word'], ''); ?></a>
                                    </h3>
                                </div>
                                <div class="blog__meta tp-el-box-meta">
                                    <span>
                                        <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.5 14C11.0899 14 14 11.0899 14 7.5C14 3.91015 11.0899 1 7.5 1C3.91015 1 1 3.91015 1 7.5C1 11.0899 3.91015 14 7.5 14Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M7.5 3.59961V7.49961L10.1 8.79961" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <?php the_time( get_option('date_format') ); ?>
                                    </span>
                                
                                    <span> <?php echo theme_domain_reading_time(); ?> Read</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; wp_reset_query(); ?>
        <?php endif; ?>

         <!-- blog area end -->
         

    	<?php endif; ?>

       <?php
	}

}

$widgets_manager->register( new TP_Blog_Post() );