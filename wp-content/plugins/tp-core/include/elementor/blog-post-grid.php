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
class TP_Blog_Post_Grid extends Widget_Base {

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
		return 'blogpost-grid';
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
		return __( 'Blog Post Grid', 'tpcore' );
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
 
        // tp_btn_button_group
        $this->tp_button_render('blog_view_all', 'Blog More Button', ['layout-4', 'layout-5', 'layout-6', 'layout-7', 'layout-8'] );
        
        // Blog Query
		$this->tp_query_controls('blog', 'Blog');

        // layout Panel
        $this->tp_post_layout_2('post', 'Blog');

	}

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('blog_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('blog_subtitle', 'Section - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('blog_title', 'Section - Title', '.tp-el-title');
        $this->tp_basic_style_controls('blog_description', 'Section - Description', '.tp-el-content p');

        $this->tp_basic_style_controls('blog_box_title', 'Blog - Box - Title', '.tp-el-box-title');
        $this->tp_basic_style_controls('blog_box_desc', 'Blog - Box - Description', '.tp-el-box-desc');
        $this->tp_link_controls_style('blog_box_tag', 'Blog - Box - Tag', '.tp-el-box-tag');
        $this->tp_link_controls_style('blog_box_meta', 'Blog - Box - Meta', '.tp-el-box-meta span');
        $this->tp_link_controls_style('blog_box_btn', 'Blog - Box - Button', '.tp-el-box-btn');
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

        $filter_list = $settings['category'];

        // The Query
        $query = new \WP_Query($query_args);


        ?>

        <?php if ( $settings['tp_design_style']  == 'layout-2' ): 
            
            $blog_column = is_active_sidebar( 'blog-sidebar' ) ? 8 : 12;

            if(is_active_sidebar( 'blog-sidebar' ) && !empty($settings['enable_sidebar'] == 'yes')){
                $blog_column = 8;

                $blog_item_column = 'col-xl-6 col-lg-12 col-md-6 grid-item';
            }else{
                $blog_column = 12;
                $blog_item_column = 'col-xxl-4 col-xl-4 col-lg-6 col-md-6 grid-item';
            }

            $enable_border_style_sidebar = $settings['enable_border_style_sidebar'] == 'yes' ? 'sidebar__widget-style-2' : '';
            $enable_border_style_item = $settings['enable_border_style_item'] == 'yes' ? 'blog__masonary' : '';
            $pagination_style = $settings['enable_border_style_item'] == 'yes' ? 'tp-pagination-style-2' : '';


            $this->add_render_attribute('title_args', 'class', 'section__title tp-el-title');

            if(($settings['enable_border_style_item'] == 'yes') OR ($settings['enable_border_style_sidebar'] == 'yes')){
                $bg_color = "white-bg";
            }else{
                $bg_color = "grey-bg-4";
            }
        ?>


         <!-- blog grid area start -->
         <section class="blog__grid <?php echo esc_attr($bg_color); ?> pt-90 pb-100 tp-el-section">
            <div class="container">
                <?php if ( !empty($settings['tp_blog_section_title_show']) ) : ?>
                <div class="row">
                    <div class="col-xxl-12">
                        <div class="section__title-wrapper section-title-sm mb-60 tp-el-content <?php echo esc_attr( $settings['tp_section_align'] ); ?>">

                        <?php if ( !empty($settings['tp_blog_sub_title']) ) : ?>
                        <span class="faq__title-pre tp-el-subtitle"><?php echo tp_kses( $settings['tp_blog_sub_title'] ); ?></span>
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
                <?php endif; ?>
               <div class="row">
               <?php if ($query->have_posts()) : ?>
                  <div class="col-lg-<?php print esc_attr( $blog_column );?>">
                     <div class="row grid">
                     <?php if ($query->have_posts()) : 
                            while ($query->have_posts()) : 
                            $query->the_post();
                            global $post;

                            $categories = get_the_category($post->ID);
                            $author_bio_avatar_size = 180;
                        ?>
                        <div class="<?php echo esc_attr($blog_item_column); ?>">
                        <?php
                            
                            if(has_post_thumbnail()){
                                $no_img_class = '';
                            }else{
                                $no_img_class = 'no-img';
                            }
                        ?> 

                           <div class="blog__grid-item <?php echo esc_attr($enable_border_style_item); ?> <?php echo esc_attr($no_img_class); ?>">
                              <div class="blog__item-10 white-bg transition-3 mb-30 fix">
                              <?php if ( has_post_thumbnail() ): ?> 
                                 <div class="blog__thumb-10 w-img fix">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail( $post->ID, $settings['thumbnail_size'] );?>
                                    </a>
                                    <div class="blog__tag-10 tp-el-box-tag">
                                        <a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>"><?php echo esc_html($categories[0]->name); ?></a>
                                    </div>
                                 </div>
                                 <?php endif; ?>
                                 <div class="blog__content-10">
                                    <div class="blog__content-10-top">
                                       <div class="blog__meta-10-wrapper d-flex align-items-center">
                                          <div class="blog__meta-10 has-date tp-el-box-meta">
                                             <span>
                                                <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                   <path d="M7.5 14C11.0899 14 14 11.0899 14 7.5C14 3.91015 11.0899 1 7.5 1C3.91015 1 1 3.91015 1 7.5C1 11.0899 3.91015 14 7.5 14Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                   <path d="M7.5 3.59961V7.49961L10.1 8.79961" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg> <?php the_time( 'd M, Y' ); ?>
                                             </span>
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

                                    <div class="blog__content-10-bottom d-flex align-items-center justify-content-between">
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
                                          <span>
                                             <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12.9718 6.66668C12.9741 7.54659 12.769 8.4146 12.3732 9.20001C11.9039 10.1412 11.1825 10.9328 10.2897 11.4862C9.39697 12.0396 8.36813 12.3329 7.31844 12.3333C6.4406 12.3356 5.57463 12.13 4.79106 11.7333L1 13L2.26369 9.20001C1.86791 8.4146 1.66281 7.54659 1.6651 6.66668C1.66551 5.61452 1.95815 4.58325 2.51025 3.68838C3.06236 2.79352 3.85211 2.0704 4.79106 1.60002C5.57463 1.20331 6.4406 0.997725 7.31844 1.00002H7.65099C9.03729 1.07668 10.3467 1.66319 11.3284 2.64726C12.3102 3.63132 12.8953 4.94378 12.9718 6.33334V6.66668Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                             </svg><?php echo get_comments_number($post->ID);?>
                                          </span>
                                          <?php if(function_exists('getPostViews')) : ?>
                                          <span>
                                             <svg width="17" height="14" viewBox="0 0 17 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M11.0443 7.00397C11.0443 8.43962 9.88694 9.59974 8.45466 9.59974C7.02238 9.59974 5.86499 8.43962 5.86499 7.00397C5.86499 5.56832 7.02238 4.4082 8.45466 4.4082C9.88694 4.4082 11.0443 5.56832 11.0443 7.00397Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M8.45466 13C11.0082 13 13.3881 11.4918 15.0446 8.88157C15.6956 7.85921 15.6956 6.14078 15.0446 5.11843C13.3881 2.50816 11.0082 1 8.45466 1C5.90115 1 3.52126 2.50816 1.86474 5.11843C1.21371 6.14078 1.21371 7.85921 1.86474 8.88157C3.52126 11.4918 5.90115 13 8.45466 13Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                             </svg><?php echo getPostViews(get_the_ID()); ?>
                                          </span>
                                          <?php endif; ?>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <?php 
                            endwhile; 
                            wp_reset_query(); 
                            endif;
                        ?>
                     </div>
                     <?php if(!empty($settings['tp_post__pagination']) && ('-1' != $settings['posts_per_page'])) :?>
                    <div class="tp-pagination <?php echo esc_attr($pagination_style); ?> mt-20">
                        <?php
                        $big = 999999999;

                        if (get_query_var('paged')) {
                            $paged = get_query_var('paged');
                        } else if (get_query_var('page')) {
                            $paged = get_query_var('page');
                        } else {
                            $paged = 1;
                        }

                        echo paginate_links( array(
                            'base'       => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
                            'format'     => '?paged=%#%',
                            'current'    => $paged,
                            'total'      => $query->max_num_pages,
                            'type'       =>'list',
                            'prev_text'  =>'<i class="fa-light fa-arrow-left-long"></i> Prev',
                            'next_text'  =>'Next <i class="fa-light fa-arrow-right-long"></i>',
                            'show_all'   => false,
                            'end_size'   => 1,
                            'mid_size'   => 4,
                        ) );
                        ?>
                    </div>
                    <?php endif; ?>
                  </div>
                  <?php endif; ?>

                  <?php if ( is_active_sidebar( 'blog-sidebar' )  && !empty($settings['enable_sidebar'] == 'yes')) : ?>
                  <div class="col-lg-4">
                     <div class="sidebar__wrapper <?php echo esc_attr($enable_border_style_sidebar); ?> pl-40">
                        <?php get_sidebar();?>
                     </div>
                  </div>
                  <?php endif;?>
               </div>
            </div>
         </section>
         <!-- blog grid area end -->


         <?php elseif ( $settings['tp_design_style']  == 'layout-3' ): 
            
            $blog_column = is_active_sidebar( 'blog-sidebar' ) ? 8 : 12;

            if(is_active_sidebar( 'blog-sidebar' ) && !empty($settings['enable_sidebar'] == 'yes')){
                $blog_column = 8;
                $blog_column_align = '';
            }else{
                $blog_column = 12;
                $blog_column_align = 'justify-content-center';
            }


            $this->add_render_attribute('title_args', 'class', 'section__title tp-el-title');

        ?>

         <!-- blog grid area start -->
         <section class="blog__list grey-bg-4 pt-90 pb-100 tp-el-section">
            <div class="container">
            <?php if ( !empty($settings['tp_blog_section_title_show']) ) : ?>
                <div class="row">
                    <div class="col-xxl-12">
                        <div class="section__title-wrapper tp-el-content section-title-sm mb-60 <?php echo esc_attr( $settings['tp_section_align'] ); ?>">

                        <?php if ( !empty($settings['tp_blog_sub_title']) ) : ?>
                        <span class="faq__title-pre tp-el-subtitle"><?php echo tp_kses( $settings['tp_blog_sub_title'] ); ?></span>
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
                <?php endif; ?>

                <div class="row <?php echo esc_attr($blog_column_align); ?>">
                    <?php if ($query->have_posts()) : ?>
                    <div class="col-lg-<?php print esc_attr( $blog_column );?>">
                        <div class="blog__list-item-wrapper">
                            <?php if ($query->have_posts()) : 
                                while ($query->have_posts()) : 
                                $query->the_post();
                                global $post;

                                $categories = get_the_category($post->ID);
                                $author_bio_avatar_size = 180;

                                if ( has_post_thumbnail() ){
                                    $blog_img_col = 'col-xl-7 col-lg-12 col-md-6';
                                    $no_img_class = '';
                                }else{
                                    $blog_img_col = 'col-xl-12 col-lg-12 col-md-6';
                                    $no_img_class = 'no-img';
                                }
                            ?>
                            <div class="blog__list-item <?php echo esc_attr($no_img_class); ?>">
                                <div class="blog__item-10 white-bg transition-3 fix">
                                    <div class="row">
                                        <?php if ( has_post_thumbnail() ): ?> 
                                            <div class="col-xl-5 col-lg-12 col-md-6">
                                                <div class="blog__thumb-10 w-img fix">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php the_post_thumbnail( $post->ID, $settings['thumbnail_size'] );?>
                                                    </a>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <div class="<?php echo esc_attr($blog_img_col); ?>">
                                            <div class="blog__content-10">
                                                <div class="blog__content-10-top">
                                                    <div class="blog__meta-10-wrapper d-flex align-items-center">
                                                        <div class="blog__tag-10">
                                                            <a class="tp-el-box-tag" href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>"><?php echo esc_html($categories[0]->name); ?></a>
                                                        </div>
                                                        <div class="blog__meta-10 has-date tp-el-box-meta">
                                                            <span>
                                                                <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M7.5 14C11.0899 14 14 11.0899 14 7.5C14 3.91015 11.0899 1 7.5 1C3.91015 1 1 3.91015 1 7.5C1 11.0899 3.91015 14 7.5 14Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M7.5 3.59961V7.49961L10.1 8.79961" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                                </svg> <?php the_time( 'd M, Y' ); ?>
                                                            </span>
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
                                                <div class="blog__content-10-bottom d-flex align-items-center flex-wrap">
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
                                                        <span>
                                                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M12.9718 6.66668C12.9741 7.54659 12.769 8.4146 12.3732 9.20001C11.9039 10.1412 11.1825 10.9328 10.2897 11.4862C9.39697 12.0396 8.36813 12.3329 7.31844 12.3333C6.4406 12.3356 5.57463 12.13 4.79106 11.7333L1 13L2.26369 9.20001C1.86791 8.4146 1.66281 7.54659 1.6651 6.66668C1.66551 5.61452 1.95815 4.58325 2.51025 3.68838C3.06236 2.79352 3.85211 2.0704 4.79106 1.60002C5.57463 1.20331 6.4406 0.997725 7.31844 1.00002H7.65099C9.03729 1.07668 10.3467 1.66319 11.3284 2.64726C12.3102 3.63132 12.8953 4.94378 12.9718 6.33334V6.66668Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                            </svg><?php echo get_comments_number($post->ID);?>
                                                        </span>
                                                        <?php if(function_exists('getPostViews')) : ?>
                                                        <span>
                                                            <svg width="17" height="14" viewBox="0 0 17 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M11.0443 7.00397C11.0443 8.43962 9.88694 9.59974 8.45466 9.59974C7.02238 9.59974 5.86499 8.43962 5.86499 7.00397C5.86499 5.56832 7.02238 4.4082 8.45466 4.4082C9.88694 4.4082 11.0443 5.56832 11.0443 7.00397Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M8.45466 13C11.0082 13 13.3881 11.4918 15.0446 8.88157C15.6956 7.85921 15.6956 6.14078 15.0446 5.11843C13.3881 2.50816 11.0082 1 8.45466 1C5.90115 1 3.52126 2.50816 1.86474 5.11843C1.21371 6.14078 1.21371 7.85921 1.86474 8.88157C3.52126 11.4918 5.90115 13 8.45466 13Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                            </svg><?php echo getPostViews(get_the_ID()); ?>
                                                        </span>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php 
                                endwhile; 
                                wp_reset_query(); 
                                endif;
                            ?>
                        </div>
                        <?php if($settings['tp_post__pagination'] == 'yes' && '-1' != $settings['posts_per_page']) :?>
                            <div class="tp-pagination mt-20">
                                <?php
                                $big = 999999999;

                                if (get_query_var('paged')) {
                                    $paged = get_query_var('paged');
                                } else if (get_query_var('page')) {
                                    $paged = get_query_var('page');
                                } else {
                                    $paged = 1;
                                }

                                echo paginate_links( array(
                                    'base'       => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
                                    'format'     => '?paged=%#%',
                                    'current'    => $paged,
                                    'total'      => $query->max_num_pages,
                                    'type'       =>'list',
                                    'prev_text'  =>'<i class="fa-light fa-arrow-left-long"></i> Prev',
                                    'next_text'  =>'Next <i class="fa-light fa-arrow-right-long"></i>',
                                    'show_all'   => false,
                                    'end_size'   => 1,
                                    'mid_size'   => 4,
                                ) );
                                ?>
                            </div>
                            <?php endif; ?>
                    </div>
                    <?php endif; ?>

                    <?php if ( is_active_sidebar( 'blog-sidebar' )  && !empty($settings['enable_sidebar'] == 'yes')) : ?>
                    <div class="col-lg-4">
                        <div class="sidebar__wrapper pl-40">
                            <?php get_sidebar();?>
                        </div>
                    </div>
                    <?php endif;?>
                </div>

               </div>
            </div>
         </section>
         <!-- blog grid area end -->


        <?php elseif ( $settings['tp_design_style']  == 'layout-4' ): 
            
            $blog_column = is_active_sidebar( 'blog-sidebar' ) ? 8 : 12;

            if(is_active_sidebar( 'blog-sidebar' ) && !empty($settings['enable_sidebar'] == 'yes')){
                $blog_column = 8;
                $blog_column_align = '';
            }else{
                $blog_column = 12;
                $blog_column_align = 'justify-content-center';
            }


            $this->add_render_attribute('title_args', 'class', 'section__title tp-el-title');
            
            
        ?>

        <?php if ($query->have_posts()) : ?>
         <!-- blog grid area start -->
         <section class="blog__masonary pb-120">
            <?php if ( !empty($settings['tp_blog_section_title_show']) ) : ?>
                <div class="container">
                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="section__title-wrapper section-title-sm mb-60 <?php echo esc_attr( $settings['tp_section_align'] ); ?>">
    
                            <?php if ( !empty($settings['tp_blog_sub_title']) ) : ?>
                            <span class="faq__title-pre tp-el-subtitle"><?php echo tp_kses( $settings['tp_blog_sub_title'] ); ?></span>
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
                </div>
            <?php endif; ?>
            <div class="container-fluid gx-xl-5 gx-3">
               <div class="row row-cols-1 row-cols-xxl-5 row-cols-xl-3 row-cols-lg-2 row-cols-md-2 grid">
                    <?php if ($query->have_posts()) : 
                        while ($query->have_posts()) : 
                        $query->the_post();
                        global $post;

                        $blog_masonary_img_height = function_exists( 'get_field' ) ? get_field( 'blog_image_height' ) : NULL;


                        $categories = get_the_category($post->ID);
                        $author_bio_avatar_size = 180;

                        if ( has_post_thumbnail() ){
                            $blog_img_col = 'col-xl-7 col-lg-12 col-md-6';
                            $no_img_class = '';
                        }else{
                            $blog_img_col = 'col-xl-12 col-lg-12 col-md-6';
                            $no_img_class = 'no-img';
                        }
                    ?>
                    <div class="col grid-item">
                        <div class="blog__grid-item blog__masonary <?php echo esc_attr($no_img_class); ?>">
                            <div class="blog__item-10 white-bg transition-3 mb-30 fix">
                            <?php if ( has_post_thumbnail() ): ?> 
                            <div class="blog__thumb-10 w-img fix" data-height="<?php echo esc_attr($blog_masonary_img_height); ?>">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail( $post->ID, $settings['thumbnail_size'] );?>
                                </a>
                                <div class="blog__tag-10">
                                    <a class="tp-el-box-tag" href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>"><?php echo esc_html($categories[0]->name); ?></a>
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="blog__content-10">
                                <div class="blog__content-10-top">
                                    <div class="blog__tag-10 tp-masonary-no-img-tag ">
                                        <a class="tp-el-box-tag" href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>"><?php echo esc_html($categories[0]->name); ?></a>
                                    </div>
                                    <div class="blog__meta-10-wrapper d-flex align-items-center">
                                        <div class="blog__meta-10 has-date">
                                            <span>
                                                <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M7.5 14C11.0899 14 14 11.0899 14 7.5C14 3.91015 11.0899 1 7.5 1C3.91015 1 1 3.91015 1 7.5C1 11.0899 3.91015 14 7.5 14Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M7.5 3.59961V7.49961L10.1 8.79961" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg> <?php the_time( 'd M, Y' ); ?>
                                            </span>
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
                                <div class="blog__content-10-bottom d-flex flex-wrap align-items-center justify-content-between">
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
                                        <span>
                                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12.9718 6.66668C12.9741 7.54659 12.769 8.4146 12.3732 9.20001C11.9039 10.1412 11.1825 10.9328 10.2897 11.4862C9.39697 12.0396 8.36813 12.3329 7.31844 12.3333C6.4406 12.3356 5.57463 12.13 4.79106 11.7333L1 13L2.26369 9.20001C1.86791 8.4146 1.66281 7.54659 1.6651 6.66668C1.66551 5.61452 1.95815 4.58325 2.51025 3.68838C3.06236 2.79352 3.85211 2.0704 4.79106 1.60002C5.57463 1.20331 6.4406 0.997725 7.31844 1.00002H7.65099C9.03729 1.07668 10.3467 1.66319 11.3284 2.64726C12.3102 3.63132 12.8953 4.94378 12.9718 6.33334V6.66668Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg><?php echo get_comments_number($post->ID);?>
                                        </span>
                                        <span>
                                            <svg width="17" height="14" viewBox="0 0 17 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M11.0443 7.00397C11.0443 8.43962 9.88694 9.59974 8.45466 9.59974C7.02238 9.59974 5.86499 8.43962 5.86499 7.00397C5.86499 5.56832 7.02238 4.4082 8.45466 4.4082C9.88694 4.4082 11.0443 5.56832 11.0443 7.00397Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M8.45466 13C11.0082 13 13.3881 11.4918 15.0446 8.88157C15.6956 7.85921 15.6956 6.14078 15.0446 5.11843C13.3881 2.50816 11.0082 1 8.45466 1C5.90115 1 3.52126 2.50816 1.86474 5.11843C1.21371 6.14078 1.21371 7.85921 1.86474 8.88157C3.52126 11.4918 5.90115 13 8.45466 13Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg><?php echo getPostViews(get_the_ID()); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                <?php 
                    endwhile; 
                    wp_reset_query(); 
                    endif;
                ?>
               </div>
               
            </div>
         </section>
         <!-- blog grid area end -->
         <?php endif; ?>





        <?php else: ?>
        <!-- blog area start -->


        <?php if ($query->have_posts()) : ?>
            
         <!-- blog breadcrumb start -->
         <section class="blog__breadcrumb tp-el-section">
            <div class="blog__breadcrumb-slider p-relative">
               <div class="blog__breadcrumb-slider-active swiper-container">
                  <div class="swiper-wrapper">
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
                     <div class="blog__breadcrumb-item blog__breadcrumb-height blog__breadcrumb-overlay black-bg include-bg d-flex align-items-end swiper-slide" data-background="<?php echo get_the_post_thumbnail_url( $post->ID, $settings['thumbnail_size'] );?>">
                        <div class="container">
                           <div class="col-xxl-8 col-xl-8 col-lg-10">
                              <div class="blog__breadcrumb-thumb"></div>
                              <div class="blog__breadcrumb-content">
                                 <div class="blog__breadcrumb-tag">
                                    <a class="tp-el-box-tag" href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>"><?php echo esc_html($categories[0]->name); ?></a>
                                 </div>
                                 <h3 class="blog__breadcrumb-title tp-el-box-title">
                                    <a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), $settings['tp_blog_title_word'], ''); ?></a>
                                 </h3>

                                 <div class="blog__breadcrumb-meta tp-el-box-meta">
                                    <span>
                                       <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path d="M7.5 14C11.0899 14 14 11.0899 14 7.5C14 3.91015 11.0899 1 7.5 1C3.91015 1 1 3.91015 1 7.5C1 11.0899 3.91015 14 7.5 14Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                       <path d="M7.5 3.59961V7.49961L10.1 8.79961" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                       </svg> <?php the_time( get_option('date_format') ); ?>
                                    </span>
                                    <span>
                                       <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <path d="M12.9718 6.66668C12.9741 7.54659 12.769 8.4146 12.3732 9.20001C11.9039 10.1412 11.1825 10.9328 10.2897 11.4862C9.39697 12.0396 8.36813 12.3329 7.31844 12.3333C6.4406 12.3356 5.57463 12.13 4.79106 11.7333L1 13L2.26369 9.20001C1.86791 8.4146 1.66281 7.54659 1.6651 6.66668C1.66551 5.61452 1.95815 4.58325 2.51025 3.68838C3.06236 2.79352 3.85211 2.0704 4.79106 1.60002C5.57463 1.20331 6.4406 0.997725 7.31844 1.00002H7.65099C9.03729 1.07668 10.3467 1.66319 11.3284 2.64726C12.3102 3.63132 12.8953 4.94378 12.9718 6.33334V6.66668Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                       </svg><?php echo get_comments_number($post->ID);?>
                                    </span>
                                    <?php if(function_exists('getPostViews')) : ?>
                                    <span>
                                       <svg width="17" height="14" viewBox="0 0 17 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <path d="M11.0443 7.00397C11.0443 8.43962 9.88694 9.59974 8.45466 9.59974C7.02238 9.59974 5.86499 8.43962 5.86499 7.00397C5.86499 5.56832 7.02238 4.4082 8.45466 4.4082C9.88694 4.4082 11.0443 5.56832 11.0443 7.00397Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                          <path d="M8.45466 13C11.0082 13 13.3881 11.4918 15.0446 8.88157C15.6956 7.85921 15.6956 6.14078 15.0446 5.11843C13.3881 2.50816 11.0082 1 8.45466 1C5.90115 1 3.52126 2.50816 1.86474 5.11843C1.21371 6.14078 1.21371 7.85921 1.86474 8.88157C3.52126 11.4918 5.90115 13 8.45466 13Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                       </svg><?php echo getPostViews(get_the_ID()); ?>
                                        <?php endif; ?>
                                    </span>
                                 </div>
                                 <?php if(!empty($settings['tp_post_button'])) :?>
                                 <div class="blog__breadcrumb-btn">
                                    <a href="<?php the_permalink(); ?>" class="tp-btn-border-2 tp-el-box-btn"><?php echo tp_kses($settings['tp_post_button']); ?></a>
                                 </div>
                                 <?php endif; ?>
                        
                              </div>
                           </div>
                        </div>
                     </div>
                     <?php endwhile; wp_reset_query(); ?>
                  </div>
               </div>
               <div class="blog-slider-dot-breadcrumb tp-swiper-dot"></div>
            </div>
         </section>
         <!-- blog breadcrumb end -->
           
        <?php endif; ?>

         <!-- blog area end -->
         

    	<?php endif; ?>

       <?php
	}

}

$widgets_manager->register( new TP_Blog_Post_Grid() );