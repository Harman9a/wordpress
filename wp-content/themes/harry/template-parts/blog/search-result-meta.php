<?php
    $author_data = get_the_author_meta( 'description', get_query_var( 'author' ) );
    $author_name = get_the_author_meta( 'harry_write_by');
    $facebook_url = get_the_author_meta( 'harry_facebook' );
    $twitter_url = get_the_author_meta( 'harry_twitter' );
    $linkedin_url = get_the_author_meta( 'harry_linkedin' );
    $instagram_url = get_the_author_meta( 'harry_instagram' );
    $harry_url = get_the_author_meta( 'harry_youtube' );
    $harry_write_by = get_the_author_meta( 'harry_write_by' );
    $author_bio_avatar_size = 180;


    $categories = get_the_terms( $post->ID, 'category' );
    $harry_blog_date = get_theme_mod( 'harry_blog_date', true );
    $harry_blog_comments = get_theme_mod( 'harry_blog_comments', true );
    $harry_blog_author = get_theme_mod( 'harry_blog_author', true );
    $harry_blog_cat = get_theme_mod( 'harry_blog_cat', false );
    $harry_blog_view = get_theme_mod( 'harry_blog_view', false );

    if(function_exists('setPostViews')){
        setPostViews(get_the_ID());
    }
?>

    <div class="search__blog-bottom d-flex flex-wrap align-items-center mb-20">
        
        <?php if(!empty(get_author_posts_url( get_the_author_meta( 'ID' ) )) && !empty($harry_blog_author)) : ?>
        <div class="search__blog-meta-author d-flex align-items-center mr-45">
            <?php if(!empty(get_avatar(get_the_author_meta( 'user_email' ), $author_bio_avatar_size, '', '', [ 'class' => 'media-object img-circle' ]))) : ?>
            <div class="search__blog-meta-author-thumb">
                <a href="<?php print esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );?>">
                <?php print get_avatar(get_avatar(get_the_author_meta( 'user_email' ), $author_bio_avatar_size, '', '', [ 'class' => 'media-object img-circle' ]) );?>
                </a>
            </div>
            <?php endif; ?>
            <div class="search__blog-meta-author-content">
                <span><?php echo esc_html__( 'By', 'harry' ); ?><a href="<?php print esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );?>"> <?php print get_the_author();?></a></span>
            </div>
        </div>
        <?php endif; ?>

        <div class="search__blog-meta">
            <span>
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12.9718 6.66668C12.9741 7.54659 12.769 8.4146 12.3732 9.20001C11.9039 10.1412 11.1825 10.9328 10.2897 11.4862C9.39697 12.0396 8.36813 12.3329 7.31844 12.3333C6.4406 12.3356 5.57463 12.13 4.79106 11.7333L1 13L2.26369 9.20001C1.86791 8.4146 1.66281 7.54659 1.6651 6.66668C1.66551 5.61452 1.95815 4.58325 2.51025 3.68838C3.06236 2.79352 3.85211 2.0704 4.79106 1.60002C5.57463 1.20331 6.4406 0.997725 7.31844 1.00002H7.65099C9.03729 1.07668 10.3467 1.66319 11.3284 2.64726C12.3102 3.63132 12.8953 4.94378 12.9718 6.33334V6.66668Z" stroke="#7A7E83" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <?php echo get_comments_number();?>
            </span>

            <?php if(function_exists('getPostViews') && !empty($harry_blog_view)) : ?>
            <span>
                <svg width="17" height="14" viewBox="0 0 17 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M11.0443 7.00397C11.0443 8.43962 9.88694 9.59974 8.45466 9.59974C7.02238 9.59974 5.86499 8.43962 5.86499 7.00397C5.86499 5.56832 7.02238 4.4082 8.45466 4.4082C9.88694 4.4082 11.0443 5.56832 11.0443 7.00397Z" stroke="#7A7E83" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M8.45466 13C11.0082 13 13.3881 11.4918 15.0446 8.88157C15.6956 7.85921 15.6956 6.14078 15.0446 5.11843C13.3881 2.50816 11.0082 1 8.45466 1C5.90115 1 3.52126 2.50816 1.86474 5.11843C1.21371 6.14078 1.21371 7.85921 1.86474 8.88157C3.52126 11.4918 5.90115 13 8.45466 13Z" stroke="#7A7E83" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <?php echo getPostViews(get_the_ID()); ?>
                <?php echo esc_html__('Views', 'harry'); ?>
            </span>
            <?php endif; ?>
        </div>
    </div>


