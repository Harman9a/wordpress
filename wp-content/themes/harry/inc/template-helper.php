<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package harry
 */

/** 
 *
 * harry header
 */

function harry_check_header() {
    $harry_header_style = function_exists( 'get_field' ) ? get_field( 'header_style' ) : NULL;
    $harry_default_header_style = get_theme_mod( 'choose_default_header', 'header-style-1' );

    if ( $harry_header_style == 'header-style-1' ) {
        get_template_part( 'template-parts/header/header-1' );
    } 
    elseif ( $harry_header_style == 'header-style-2' ) {
        get_template_part( 'template-parts/header/header-2' );
    } 
    elseif ( $harry_header_style == 'header-style-3' ) {
        get_template_part( 'template-parts/header/header-3' );
    } 
    elseif ( $harry_header_style == 'header-style-4' ) {
        get_template_part( 'template-parts/header/header-4' );
    } 
    elseif ( $harry_header_style == 'header-style-5' ) {
        get_template_part( 'template-parts/header/header-5' );
    } 
    elseif ( $harry_header_style == 'header-style-6' ) {
        get_template_part( 'template-parts/header/header-6' );
    } 
    elseif ( $harry_header_style == 'header-style-7' ) {
        get_template_part( 'template-parts/header/header-7' );
    } 
    elseif ( $harry_header_style == 'header-style-8' ) {
        get_template_part( 'template-parts/header/header-8' );
    } 
    elseif ( $harry_header_style == 'header-style-9' ) {
        get_template_part( 'template-parts/header/header-9' );
    } 
    elseif ( $harry_header_style == 'header-style-10' ) {
        get_template_part( 'template-parts/header/header-10' );
    } 
    elseif ( $harry_header_style == 'header-style-11' ) {
        get_template_part( 'template-parts/header/header-11' );
    } 
    elseif ( $harry_header_style == 'header-style-12' ) {
        get_template_part( 'template-parts/header/header-12' );
    } 
    elseif ( $harry_header_style == 'header-style-13' ) {
        get_template_part( 'template-parts/header/header-13' );
    } 
    elseif ( $harry_header_style == 'header-style-14' ) {
        get_template_part( 'template-parts/header/header-14' );
    } 
    elseif ( $harry_header_style == 'header-style-15' ) {
        get_template_part( 'template-parts/header/header-15' );
    } 
    elseif ( $harry_header_style == 'header-style-16' ) {
        get_template_part( 'template-parts/header/header-16' );
    } 
    elseif ( $harry_header_style == 'header-style-17' ) {
        get_template_part( 'template-parts/header/header-17' );
    } 
    else {

        /** default header style **/
        if ( $harry_default_header_style == 'header-style-2' ) {
            get_template_part( 'template-parts/header/header-2' );
        } 
        elseif ( $harry_default_header_style == 'header-style-3' ) {
            get_template_part( 'template-parts/header/header-3' );
        }
        elseif ( $harry_default_header_style == 'header-style-4' ) {
            get_template_part( 'template-parts/header/header-4' );
        }
        elseif ( $harry_default_header_style == 'header-style-5' ) {
            get_template_part( 'template-parts/header/header-5' );
        }
        elseif ( $harry_default_header_style == 'header-style-6' ) {
            get_template_part( 'template-parts/header/header-6' );
        }
        elseif ( $harry_default_header_style == 'header-style-7' ) {
            get_template_part( 'template-parts/header/header-7' );
        }
        elseif ( $harry_default_header_style == 'header-style-8' ) {
            get_template_part( 'template-parts/header/header-8' );
        }
        elseif ( $harry_default_header_style == 'header-style-9' ) {
            get_template_part( 'template-parts/header/header-9' );
        }
        elseif ( $harry_default_header_style == 'header-style-10' ) {
            get_template_part( 'template-parts/header/header-10' );
        }
        elseif ( $harry_default_header_style == 'header-style-11' ) {
            get_template_part( 'template-parts/header/header-11' );
        }
        elseif ( $harry_default_header_style == 'header-style-12' ) {
            get_template_part( 'template-parts/header/header-12' );
        }
        elseif ( $harry_default_header_style == 'header-style-13' ) {
            get_template_part( 'template-parts/header/header-13' );
        }
        elseif ( $harry_default_header_style == 'header-style-14' ) {
            get_template_part( 'template-parts/header/header-14' );
        }
        elseif ( $harry_default_header_style == 'header-style-15' ) {
            get_template_part( 'template-parts/header/header-15' );
        }
        elseif ( $harry_default_header_style == 'header-style-16' ) {
            get_template_part( 'template-parts/header/header-16' );
        }
        elseif ( $harry_default_header_style == 'header-style-17' ) {
            get_template_part( 'template-parts/header/header-17' );
        }
        else {
            get_template_part( 'template-parts/header/header-1' );
        }
    }

}
add_action( 'harry_header_style', 'harry_check_header', 10 );


/* harry offcanvas */

function harry_check_offcanvas() {
    $harry_offcanvas_style = function_exists( 'get_field' ) ? get_field( 'offcanvas_style' ) : NULL;
    $harry_default_offcanvas_style = get_theme_mod( 'choose_default_offcanvas', 'offcanvas-style-1' );

    if ( $harry_offcanvas_style == 'offcanvas-style-1' ) {
        get_template_part( 'template-parts/offcanvas/offcanvas-1' );

    }
    elseif($harry_offcanvas_style == 'offcanvas-style-2' ){
        get_template_part( 'template-parts/offcanvas/offcanvas-2' );
    }
    elseif($harry_offcanvas_style == 'offcanvas-style-3' ){
        get_template_part( 'template-parts/offcanvas/offcanvas-3' );
    }
    elseif($harry_offcanvas_style == 'offcanvas-style-4' ){
        get_template_part( 'template-parts/offcanvas/offcanvas-4' );
    }
    elseif($harry_offcanvas_style == 'offcanvas-style-5' ){
        get_template_part( 'template-parts/offcanvas/offcanvas-5' );
    }
    elseif($harry_offcanvas_style == 'offcanvas-style-6' ){
        get_template_part( 'template-parts/offcanvas/offcanvas-6' );
    }
    elseif($harry_offcanvas_style == 'offcanvas-style-7' ){
        get_template_part( 'template-parts/offcanvas/offcanvas-7' );
    }
    
    else{
        if ( $harry_default_offcanvas_style == 'offcanvas-style-2' ) {
            get_template_part( 'template-parts/offcanvas/offcanvas-2' );
        } 
        elseif ( $harry_default_offcanvas_style == 'offcanvas-style-3' ) {
            get_template_part( 'template-parts/offcanvas/offcanvas-3' );
        } 
        elseif ( $harry_default_offcanvas_style == 'offcanvas-style-4' ) {
            get_template_part( 'template-parts/offcanvas/offcanvas-4' );
        } 
        elseif ( $harry_default_offcanvas_style == 'offcanvas-style-5' ) {
            get_template_part( 'template-parts/offcanvas/offcanvas-5' );
        } 
        elseif ( $harry_default_offcanvas_style == 'offcanvas-style-6' ) {
            get_template_part( 'template-parts/offcanvas/offcanvas-6' );
        } 
        elseif ( $harry_default_offcanvas_style == 'offcanvas-style-7' ) {
            get_template_part( 'template-parts/offcanvas/offcanvas-7' );
        } 
        else {
            get_template_part( 'template-parts/offcanvas/offcanvas-1' );
        }
    }
}

add_action( 'harry_offcanvas_style', 'harry_check_offcanvas', 10 );


/* harry popup-news-letter */

function harry_check_newsletter() {
    $harry_newsletter_style = function_exists( 'get_field' ) ? get_field( 'newsletter_style' ) : NULL;
    $harry_default_newsletter_style = get_theme_mod( 'choose_default_newsletter', 'newsletter-style-1' );

    if ( $harry_newsletter_style == 'newsletter-style-1' ) {
        get_template_part( 'template-parts/newsletter/newsletter-1' );

    }
    elseif($harry_newsletter_style == 'newsletter-style-2' ){
        get_template_part( 'template-parts/newsletter/newsletter-2' );
    }
    elseif($harry_newsletter_style == 'newsletter-style-3' ){
        get_template_part( 'template-parts/newsletter/newsletter-3' );
    }
    
    else{
        if ( $harry_default_newsletter_style == 'newsletter-style-2' ) {
            get_template_part( 'template-parts/newsletter/newsletter-2' );
        } 
        elseif ( $harry_default_newsletter_style == 'newsletter-style-3' ) {
            get_template_part( 'template-parts/newsletter/newsletter-3' );
        } 
        else {
            get_template_part( 'template-parts/newsletter/newsletter-1' );
        }
    }
}

add_action( 'harry_newsletter_style', 'harry_check_newsletter', 10 );


/**
 * [harry_header_lang description]
 * @return [type] [description]
 */
function harry_header_lang_defualt() {
    $harry_header_lang = get_theme_mod( 'harry_header_lang', false );
    if ( $harry_header_lang ): ?>


    <div class="header__lang ml-30">
        <span class="header__lang-selected-lang tp-lang-toggle" id="tp-header-lang-toggle"><?php print esc_html__( 'English', 'harry' );?></span>
        <?php do_action( 'harry_language' );?>
    </div>

    <?php endif;?>
<?php
}

/**
 * [harry_language_list description]
 * @return [type] [description]
 */
function _harry_language( $mar ) {
    return $mar;
}
function harry_language_list() {

    $mar = '';
    $languages = apply_filters( 'wpml_active_languages', NULL, 'orderby=id&order=desc' );
    if ( !empty( $languages ) ) {
        $mar = '<ul class="header__lang-list tp-lang-list">';
        foreach ( $languages as $lan ) {
            $active = $lan['active'] == 1 ? 'active' : '';
            $mar .= '<li class="' . $active . '"><a href="' . $lan['url'] . '">' . $lan['translated_name'] . '</a></li>';
        }
        $mar .= '</ul>';
    } else {
        //remove this code when send themeforest reviewer team
        $mar .= '<ul class="header__lang-list tp-lang-list">';
        $mar .= '<li><a href="#">' . esc_html__( 'English', 'harry' ) . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__( 'Spanish', 'harry' ) . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__( 'French', 'harry' ) . '</a></li>';
        $mar .= ' </ul>';
    }
    print _harry_language( $mar );
}
add_action( 'harry_language', 'harry_language_list' );



/**
 * [harry_language_list description]
 * @return [type] [description]
 */
function _harry_footer_language( $mar ) {
    return $mar;
}
function harry_footer_language_list() {
    $mar = '';
    $languages = apply_filters( 'wpml_active_languages', NULL, 'orderby=id&order=desc' );
    if ( !empty( $languages ) ) {
        $mar = '<ul class="footer__lang-list tp-lang-list-2">';
        foreach ( $languages as $lan ) {
            $active = $lan['active'] == 1 ? 'active' : '';
            $mar .= '<li class="' . $active . '"><a href="' . $lan['url'] . '">' . $lan['translated_name'] . '</a></li>';
        }
        $mar .= '</ul>';
    } else {
        //remove this code when send themeforest reviewer team
        $mar .= '<ul class="footer__lang-list tp-lang-list-2">';
        $mar .= '<li><a href="#">' . esc_html__( 'English', 'harry' ) . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__( 'Spanish', 'harry' ) . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__( 'French', 'harry' ) . '</a></li>';
        $mar .= ' </ul>';
    }
    print _harry_footer_language( $mar );
}
add_action( 'harry_footer_language', 'harry_footer_language_list' );



// header logo
function harry_header_logo() { ?>
      <?php

        $harry_logo_on = function_exists( 'get_field' ) ? get_field( 'is_enable_sec_logo' ) : NULL;
        $harry_logo = get_template_directory_uri() . '/assets/img/logo/logo-black.svg';
        $harry_logo_black = get_template_directory_uri() . '/assets/img/logo/logo.svg';

        $harry_site_logo_width = get_theme_mod( 'harry_logo_width', '120');

        $harry_site_logo = get_theme_mod( 'logo', $harry_logo );
        $harry_secondary_logo = get_theme_mod( 'seconday_logo', $harry_logo_black );
      ?>

      <?php if ( !empty( $harry_logo_on ) ) : ?>
         <a class="secondary-logo" href="<?php print esc_url( home_url( '/' ) );?>">
             <img data-width="<?php echo esc_attr($harry_site_logo_width); ?>" height="auto" src="<?php print esc_url( $harry_secondary_logo );?>" alt="<?php print esc_attr__( 'logo', 'harry' );?>" />
         </a>
      <?php else : ?>
         <a class="standard-logo" href="<?php print esc_url( home_url( '/' ) );?>">
             <img data-width="<?php echo esc_attr($harry_site_logo_width); ?>" height="auto" src="<?php print esc_url( $harry_site_logo );?>" alt="<?php print esc_attr__( 'logo', 'harry' );?>" />
             
         </a>
      <?php endif; ?>
   <?php
}


// harry_footer_logo
function harry_footer_logo() { ?>
      <?php
        $harry_foooter_logo = function_exists( 'get_field' ) ? get_field( 'harry_footer_logo' ) : NULL;

        $harry_logo = get_template_directory_uri() . '/assets/img/logo/logo-black.svg';

        $harry_footer_logo_default = get_theme_mod( 'harry_footer_logo', $harry_logo );
        $harry_site_logo_width = get_theme_mod( 'harry_logo_width', '120');
      ?>

      <?php if ( !empty( $harry_foooter_logo ) ) : ?>
         <a href="<?php print esc_url( home_url( '/' ) );?>">
             <img data-width="<?php echo esc_attr($harry_site_logo_width); ?>" height="auto" src="<?php print esc_url( $harry_foooter_logo );?>" alt="<?php print esc_attr__( 'logo', 'harry' );?>" />
         </a>
      <?php else : ?>
         <a href="<?php print esc_url( home_url( '/' ) );?>">
             <img data-width="<?php echo esc_attr($harry_site_logo_width); ?>" height="auto" src="<?php print esc_url( $harry_footer_logo_default );?>" alt="<?php print esc_attr__( 'logo', 'harry' );?>" />
         </a>
      <?php endif; ?>
   <?php
}

// header logo
function harry_header_secondary_logo() {?>
    <?php
        $harry_logo_black = get_template_directory_uri() . '/assets/img/logo/logo.svg';
        $harry_secondary_logo = get_theme_mod( 'seconday_logo', $harry_logo_black );
        $harry_site_logo_width = get_theme_mod( 'harry_logo_width', '120');
    ?>
      <a class="sticky-logo" href="<?php print esc_url( home_url( '/' ) );?>">
          <img width="<?php echo esc_attr($harry_site_logo_width); ?>" height="auto" src="<?php print esc_url( $harry_secondary_logo );?>" alt="<?php print esc_attr__( 'logo', 'harry' );?>" />
      </a>
    <?php
}

// header logo
function harry_header_sticky_logo() {?>
    <?php
        $harry_sticky_logo = function_exists( 'get_field' ) ? get_field( 'harry_sticky_logo' ) : NULL;
        $harry_logo = get_theme_mod( 'harry_sticky_logo', get_template_directory_uri() . '/assets/img/logo/logo-black-solid.svg' );
        $harry_secondary_logo = get_theme_mod( 'seconday_logo',  get_template_directory_uri() . '/assets/img/logo/logo.svg');
        $harry_site_logo_width = get_theme_mod( 'harry_logo_width', '120');
    ?>
        <?php if ( !empty( $harry_sticky_logo ) ) : ?>
        <a href="<?php print esc_url( home_url( '/' ) );?>">
            <img data-width="<?php echo esc_attr($harry_site_logo_width); ?>" height="auto" class="logo-dark" src="<?php print esc_url( $harry_sticky_logo );?>" alt="logo">
        </a>
        <?php else : ?>
            <a href="<?php print esc_url( home_url( '/' ) );?>">
            <img data-width="<?php echo esc_attr($harry_site_logo_width); ?>" height="auto" class="logo-dark" src="<?php print esc_url( $harry_logo );?>" alt="logo">
            <img data-width="<?php echo esc_attr($harry_site_logo_width); ?>" height="auto" class="logo-light" src="<?php print esc_url( $harry_secondary_logo );?>" alt="logo">
        </a>
        <?php endif; ?>
    <?php
}

function harry_mobile_logo() {
    // side info
    $harry_mobile_logo_hide = get_theme_mod( 'harry_mobile_logo_hide', false );

    $harry_site_logo = get_theme_mod( 'logo', get_template_directory_uri() . '/assets/img/logo/logo.png' );

    ?>

    <?php if ( !empty( $harry_mobile_logo_hide ) ): ?>
    <div class="side__logo mb-25">
        <a class="sideinfo-logo" href="<?php print esc_url( home_url( '/' ) );?>">
            <img src="<?php print esc_url( $harry_site_logo );?>" alt="<?php print esc_attr__( 'logo', 'harry' );?>" />
        </a>
    </div>
    <?php endif;?>



<?php }

/**
 * [harry_header_social_profiles description]
 * @return [type] [description]
 */
function harry_header_social_profiles() {
    $harry_topbar_fb_url = get_theme_mod( 'harry_topbar_fb_url', __( '#', 'harry' ) );
    $harry_topbar_twitter_url = get_theme_mod( 'harry_topbar_twitter_url', __( '#', 'harry' ) );
    $harry_topbar_instagram_url = get_theme_mod( 'harry_topbar_instagram_url', __( '#', 'harry' ) );
    $harry_topbar_linkedin_url = get_theme_mod( 'harry_topbar_linkedin_url', __( '#', 'harry' ) );
    $harry_topbar_youtube_url = get_theme_mod( 'harry_topbar_youtube_url', __( '#', 'harry' ) );
    ?>
        <ul>
        <?php if ( !empty( $harry_topbar_fb_url ) ): ?>
          <li><a href="<?php print esc_url( $harry_topbar_fb_url );?>"><span><i class="fab fa-facebook-f"></i></span></a></li>
        <?php endif;?>

        <?php if ( !empty( $harry_topbar_twitter_url ) ): ?>
            <li><a href="<?php print esc_url( $harry_topbar_twitter_url );?>"><span><i class="fab fa-twitter"></i></span></a></li>
        <?php endif;?>

        <?php if ( !empty( $harry_topbar_instagram_url ) ): ?>
            <li><a href="<?php print esc_url( $harry_topbar_instagram_url );?>"><span><i class="fab fa-instagram"></i></span></a></li>
        <?php endif;?>

        <?php if ( !empty( $harry_topbar_linkedin_url ) ): ?>
            <li><a href="<?php print esc_url( $harry_topbar_linkedin_url );?>"><span><i class="fab fa-linkedin"></i></span></a></li>
        <?php endif;?>

        <?php if ( !empty( $harry_topbar_youtube_url ) ): ?>
            <li><a href="<?php print esc_url( $harry_topbar_youtube_url );?>"><span><i class="fab fa-youtube"></i></span></a></li>
        <?php endif;?>
        </ul>

<?php
}

/**
 * [harry_header_social_profiles description]
 * @return [type] [description]
 */
function harry_newsletter_social_profiles() {
    $harry_newsletter_fb_url = get_theme_mod( 'harry_newsletter_fb_url', __( '#', 'harry' ) );
    $harry_newsletter_twitter_url = get_theme_mod( 'harry_newsletter_twitter_url', __( '#', 'harry' ) );
    $harry_newsletter_instagram_url = get_theme_mod( 'harry_newsletter_instagram_url', __( '#', 'harry' ) );
    $harry_newsletter_linkedin_url = get_theme_mod( 'harry_newsletter_linkedin_url', __( '#', 'harry' ) );
    $harry_newsletter_youtube_url = get_theme_mod( 'harry_newsletter_youtube_url', __( '#', 'harry' ) );
    ?>
        <ul>
        <?php if ( !empty( $harry_newsletter_fb_url ) ): ?>
          <li><a href="<?php print esc_url( $harry_newsletter_fb_url );?>"><span><i class="fab fa-facebook-f"></i></span></a></li>
        <?php endif;?>

        <?php if ( !empty( $harry_newsletter_twitter_url ) ): ?>
            <li><a href="<?php print esc_url( $harry_newsletter_twitter_url );?>"><span><i class="fab fa-twitter"></i></span></a></li>
        <?php endif;?>

        <?php if ( !empty( $harry_newsletter_instagram_url ) ): ?>
            <li><a href="<?php print esc_url( $harry_newsletter_instagram_url );?>"><span><i class="fab fa-instagram"></i></span></a></li>
        <?php endif;?>

        <?php if ( !empty( $harry_newsletter_linkedin_url ) ): ?>
            <li><a href="<?php print esc_url( $harry_newsletter_linkedin_url );?>"><span><i class="fab fa-linkedin"></i></span></a></li>
        <?php endif;?>

        <?php if ( !empty( $harry_newsletter_youtube_url ) ): ?>
            <li><a href="<?php print esc_url( $harry_newsletter_youtube_url );?>"><span><i class="fab fa-youtube"></i></span></a></li>
        <?php endif;?>
        </ul>

<?php
}

/**
 * [harry_offcanvas_social_profiles description]
 * @return [type] [description]
 */
function harry_offcanvas_social_profiles() {

    $harry_offcanvas_fb_url = get_theme_mod( 'harry_offcanvas_fb_url', __( '#', 'harry' ) );
    $harry_offcanvas_twitter_url = get_theme_mod( 'harry_offcanvas_twitter_url', __( '#', 'harry' ) );
    $harry_offcanvas_instagram_url = get_theme_mod( 'harry_offcanvas_instagram_url', __( '#', 'harry' ) );
    $harry_offcanvas_linkedin_url = get_theme_mod( 'harry_offcanvas_linkedin_url', __( '#', 'harry' ) );
    $harry_offcanvas_youtube_url = get_theme_mod( 'harry_offcanvas_youtube_url', __( '#', 'harry' ) );
    ?>
        <?php if ( !empty( $harry_offcanvas_fb_url ) ): ?>
            <a href="<?php print esc_url( $harry_offcanvas_fb_url );?>"><span><i class="fab fa-facebook-f"></i></span></a>
        <?php endif;?>

        <?php if ( !empty( $harry_offcanvas_twitter_url ) ): ?>
            <a href="<?php print esc_url( $harry_offcanvas_twitter_url );?>"><span><i class="fab fa-twitter"></i></span></a>
        <?php endif;?>

        <?php if ( !empty( $harry_offcanvas_instagram_url ) ): ?>
            <a href="<?php print esc_url( $harry_offcanvas_instagram_url );?>"><span><i class="fab fa-instagram"></i></span></a>
        <?php endif;?>

        <?php if ( !empty( $harry_offcanvas_linkedin_url ) ): ?>
            <a href="<?php print esc_url( $harry_offcanvas_linkedin_url );?>"><span><i class="fab fa-linkedin"></i></span></a>
        <?php endif;?>

        <?php if ( !empty( $harry_offcanvas_youtube_url ) ): ?>
            <a href="<?php print esc_url( $harry_offcanvas_youtube_url );?>"><span><i class="fab fa-youtube"></i></span></a>
        <?php endif;?>
<?php
}

function harry_footer_social_profiles() {
    $harry_footer_fb_url = get_theme_mod( 'harry_footer_fb_url', __( '#', 'harry' ) );
    $harry_footer_twitter_url = get_theme_mod( 'harry_footer_twitter_url', __( '#', 'harry' ) );
    $harry_footer_instagram_url = get_theme_mod( 'harry_footer_instagram_url', __( '#', 'harry' ) );
    $harry_footer_linkedin_url = get_theme_mod( 'harry_footer_linkedin_url', __( '#', 'harry' ) );
    $harry_footer_youtube_url = get_theme_mod( 'harry_footer_youtube_url', __( '#', 'harry' ) );
    ?>

        <?php if ( !empty( $harry_footer_fb_url ) ): ?>
            <a href="<?php print esc_url( $harry_footer_fb_url );?>">
                <i class="fab fa-facebook-f"></i>
            </a>
        <?php endif;?>

        <?php if ( !empty( $harry_footer_twitter_url ) ): ?>
            <a href="<?php print esc_url( $harry_footer_twitter_url );?>">
                <i class="fab fa-twitter"></i>
            </a>
        <?php endif;?>

        <?php if ( !empty( $harry_footer_instagram_url ) ): ?>
            <a href="<?php print esc_url( $harry_footer_instagram_url );?>">
                <i class="fab fa-instagram"></i>
            </a>
        <?php endif;?>

        <?php if ( !empty( $harry_footer_linkedin_url ) ): ?>
            <a href="<?php print esc_url( $harry_footer_linkedin_url );?>">
                <i class="fab fa-linkedin"></i>
            </a>
        <?php endif;?>

        <?php if ( !empty( $harry_footer_youtube_url ) ): ?>
            <a href="<?php print esc_url( $harry_footer_youtube_url );?>">
                <i class="fab fa-youtube"></i>
            </a>
        <?php endif;?>
<?php
}

/**
 * [harry_header_menu description]
 * @return [type] [description]
 */
function harry_header_menu() {
    ?>
    <?php
        wp_nav_menu( [
            'theme_location' => 'main-menu',
            'menu_class'     => '',
            'container'      => '',
            'fallback_cb'    => 'Harry_Navwalker_Class::fallback',
            'walker'         => new Harry_Navwalker_Class,
        ] );
    ?>
    <?php
}

/**
 * [harry_search_menu description]
 * @return [type] [description]
 */
function harry_header_search_menu() {
    ?>
    <?php
        wp_nav_menu( [
            'theme_location' => 'header-search-menu',
            'menu_class'     => '',
            'container'      => '',
            'fallback_cb'    => 'Harry_Navwalker_Class::fallback',
            'walker'         => new Harry_Navwalker_Class,
        ] );
    ?>
    <?php
}

/**
 * [harry_footer_menu description]
 * @return [type] [description]
 */
function harry_footer_menu() {
    wp_nav_menu( [
        'theme_location' => 'footer-menu',
        'menu_class'     => 'm-0 footer-list-inline-3',
        'container'      => '',
        'fallback_cb'    => 'Harry_Navwalker_Class::fallback',
        'walker'         => new Harry_Navwalker_Class,
    ] );
}

/**
 * [harry_offcanvas_default_menu description]
 * @return [type] [description]
 */
function harry_offcanvas_default_menu() {
    wp_nav_menu( [
        'theme_location' => 'offcanvas-menu',
        'menu_class'     => '',
        'container'      => '',
        'fallback_cb'    => 'Harry_Navwalker_Class::fallback',
        'walker'         => new Harry_Navwalker_Class,
    ] );
}

/**
 * [harry_offcanvas_full_menu description]
 * @return [type] [description]
 */
function harry_offcanvas_full_menu() {
    wp_nav_menu( [
        'theme_location' => 'offcanvas-full-menu',
        'menu_class'     => '',
        'container'      => '',
        'fallback_cb'    => 'Harry_Navwalker_Class::fallback',
        'walker'         => new Harry_Navwalker_Class,
    ] );
}

/**
 *
 * harry footer
 */
add_action( 'harry_footer_style', 'harry_check_footer', 10 );

function harry_check_footer() {
    $harry_footer_style = function_exists( 'get_field' ) ? get_field( 'footer_style' ) : NULL;
    $harry_default_footer_style = get_theme_mod( 'choose_default_footer', 'footer-style-1' );

    if ( $harry_footer_style == 'footer-style-1' ) {
        get_template_part( 'template-parts/footer/footer-1' );
    } 
    elseif ( $harry_footer_style == 'footer-style-2' ) {
        get_template_part( 'template-parts/footer/footer-2' );
    } 
    elseif ( $harry_footer_style == 'footer-style-3' ) {
        get_template_part( 'template-parts/footer/footer-3' );
    }
    elseif ( $harry_footer_style == 'footer-style-4' ) {
        get_template_part( 'template-parts/footer/footer-4' );
    }
    elseif ( $harry_footer_style == 'footer-style-5' ) {
        get_template_part( 'template-parts/footer/footer-5' );
    }
    elseif ( $harry_footer_style == 'footer-style-6' ) {
        get_template_part( 'template-parts/footer/footer-6' );
    }
    elseif ( $harry_footer_style == 'footer-style-7' ) {
        get_template_part( 'template-parts/footer/footer-7' );
    }
    elseif ( $harry_footer_style == 'footer-style-8' ) {
        get_template_part( 'template-parts/footer/footer-8' );
    }
    elseif ( $harry_footer_style == 'footer-style-9' ) {
        get_template_part( 'template-parts/footer/footer-9' );
    }
    elseif ( $harry_footer_style == 'footer-style-12' ) {
        get_template_part( 'template-parts/footer/footer-12' );
    }
    elseif ( $harry_footer_style == 'footer-style-13' ) {
        get_template_part( 'template-parts/footer/footer-13' );
    }
    elseif ( $harry_footer_style == 'footer-style-10' ) {
       
    }
     else {

        /** default footer style **/
        if ( $harry_default_footer_style == 'footer-style-2' ) {
            get_template_part( 'template-parts/footer/footer-2' );
        } 
        elseif ( $harry_default_footer_style == 'footer-style-3' ) {
            get_template_part( 'template-parts/footer/footer-3' );
        } 
        elseif ( $harry_default_footer_style == 'footer-style-4' ) {
            get_template_part( 'template-parts/footer/footer-4' );
        } 
        elseif ( $harry_default_footer_style == 'footer-style-5' ) {
            get_template_part( 'template-parts/footer/footer-5' );
        } 
        elseif ( $harry_default_footer_style == 'footer-style-6' ) {
            get_template_part( 'template-parts/footer/footer-6' );
        } 
        elseif ( $harry_default_footer_style == 'footer-style-7' ) {
            get_template_part( 'template-parts/footer/footer-7' );
        } 
        elseif ( $harry_default_footer_style == 'footer-style-8' ) {
            get_template_part( 'template-parts/footer/footer-8' );
        } 
        elseif ( $harry_default_footer_style == 'footer-style-9' ) {
            get_template_part( 'template-parts/footer/footer-9' );
        } 
        
        elseif ( $harry_default_footer_style == 'footer-style-12' ) {
            get_template_part( 'template-parts/footer/footer-12' );
        }
        elseif ( $harry_default_footer_style == 'footer-style-13' ) {
            get_template_part( 'template-parts/footer/footer-13' );
        }
        elseif ( $harry_default_footer_style == 'footer-style-10' ) {

        }  
        else {
            get_template_part( 'template-parts/footer/footer-1' );
        }

    }
}

// harry_copyright_text
function harry_copyright_text() {
   print get_theme_mod( 'harry_copyright', esc_html__( 'Copyright © 2023 Theme_Pure. All Rights Reserved', 'harry' ) );
}



/**
 *
 * pagination
 */
if ( !function_exists( 'harry_pagination' ) ) {

    function _harry_pagi_callback( $pagination ) {
        return $pagination;
    }

    //page navegation
    function harry_pagination( $prev, $next, $pages, $args ) {
        global $wp_query, $wp_rewrite;
        $menu = '';
        $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

        if ( $pages == '' ) {
            global $wp_query;
            $pages = $wp_query->max_num_pages;

            if ( !$pages ) {
                $pages = 1;
            }

        }

        $pagination = [
            'base'      => add_query_arg( 'paged', '%#%' ),
            'format'    => '',
            'total'     => $pages,
            'current'   => $current,
            'prev_text' => $prev,
            'next_text' => $next,
            'type'      => 'array',
        ];

        //rewrite permalinks
        if ( $wp_rewrite->using_permalinks() ) {
            $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
        }

        if ( !empty( $wp_query->query_vars['s'] ) ) {
            $pagination['add_args'] = ['s' => get_query_var( 's' )];

            
        }     

        $pagi = '';
        if ( paginate_links( $pagination ) != '' ) {
            $paginations = paginate_links( $pagination );
            $pagi .= '<ul>';
            foreach ( $paginations as $key => $pg ) {
                $pagi .= '<li>' . $pg . '</li>';
            }
            $pagi .= '</ul>';
        }

        print _harry_pagi_callback( $pagi );
    }
}


// header top bg color
function harry_breadcrumb_bg_color() {
    $color_code = get_theme_mod( 'harry_breadcrumb_bg_color', '#e1e1e1' );
    wp_enqueue_style( 'harry-custom', HARRY_THEME_CSS_DIR . 'harry-custom.css', [] );
    if ( $color_code != '' ) {
        $custom_css = '';
        $custom_css .= ".breadcrumb-bg.gray-bg{ background: " . $color_code . "}";

        wp_add_inline_style( 'harry-breadcrumb-bg', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'harry_breadcrumb_bg_color' );

// breadcrumb-spacing top
function harry_breadcrumb_spacing() {
    $padding_px = get_theme_mod( 'harry_breadcrumb_spacing', '160px' );
    wp_enqueue_style( 'harry-custom', HARRY_THEME_CSS_DIR . 'harry-custom.css', [] );
    if ( $padding_px != '' ) {
        $custom_css = '';
        $custom_css .= ".breadcrumb-spacing{ padding-top: " . $padding_px . "}";

        wp_add_inline_style( 'harry-breadcrumb-top-spacing', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'harry_breadcrumb_spacing' );

// breadcrumb-spacing bottom
function harry_breadcrumb_bottom_spacing() {
    $padding_px = get_theme_mod( 'harry_breadcrumb_bottom_spacing', '160px' );
    wp_enqueue_style( 'harry-custom', HARRY_THEME_CSS_DIR . 'harry-custom.css', [] );
    if ( $padding_px != '' ) {
        $custom_css = '';
        $custom_css .= ".breadcrumb-spacing{ padding-bottom: " . $padding_px . "}";

        wp_add_inline_style( 'harry-breadcrumb-bottom-spacing', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'harry_breadcrumb_bottom_spacing' );

// scrollup
function harry_scrollup_switch() {
    $scrollup_switch = get_theme_mod( 'harry_scrollup_switch', false );
    wp_enqueue_style( 'harry-custom', HARRY_THEME_CSS_DIR . 'harry-custom.css', [] );
    if ( $scrollup_switch ) {
        $custom_css = '';
        $custom_css .= "#scrollUp{ display: none !important;}";

        wp_add_inline_style( 'harry-scrollup-switch', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'harry_scrollup_switch' );

// theme color
function harry_custom_color() {
    $color_code = get_theme_mod( 'harry_color_option', '#F50963' );
    wp_enqueue_style( 'harry-custom', HARRY_THEME_CSS_DIR . 'harry-custom.css', [] );
    if ( $color_code != '' ) {
        $custom_css = '';
        $custom_css .= "html:root { --tp-theme-1 : " . $color_code . "}";

        wp_add_inline_style( 'harry-custom', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'harry_custom_color' );


// theme color secondary
function harry_custom_color_secondary() {
    $color_code = get_theme_mod( 'harry_color_option_2', '#008080' );
    wp_enqueue_style( 'harry-custom', HARRY_THEME_CSS_DIR . 'harry-custom.css', [] );
    if ( $color_code != '' ) {
        $custom_css = '';
        $custom_css .= "html:root { --tp-theme-2 : " . $color_code . "}";

        wp_add_inline_style( 'harry-custom', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'harry_custom_color_secondary' );

// harry_custom_color_third
function harry_custom_color_third() {
    $color_code = get_theme_mod( 'harry_color_option_3', '#F31E5E' );
    wp_enqueue_style( 'harry-custom', HARRY_THEME_CSS_DIR . 'harry-custom.css', [] );
    if ( $color_code != '' ) {
        $custom_css = '';
        $custom_css .= "html:root { --tp-theme-3 : " . $color_code . "}";
        wp_add_inline_style( 'harry-custom', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'harry_custom_color_third' );

// harry_custom_color_fourth
function harry_custom_color_fourth() {
    $color_code = get_theme_mod( 'harry_color_option_4', '#AB6C56' );
    wp_enqueue_style( 'harry-custom', HARRY_THEME_CSS_DIR . 'harry-custom.css', [] );
    if ( $color_code != '' ) {
        $custom_css = '';
        $custom_css .= "html:root { --tp-theme-4 : " . $color_code . "}";
        wp_add_inline_style( 'harry-custom', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'harry_custom_color_fourth' );


// harry_custom_color_five
function harry_custom_color_five() {
    $color_code = get_theme_mod( 'harry_color_option_5', '#4353FF' );
    wp_enqueue_style( 'harry-custom', HARRY_THEME_CSS_DIR . 'harry-custom.css', [] );
    if ( $color_code != '' ) {
        $custom_css = '';
        $custom_css .= "html:root { --tp-theme-5 : " . $color_code . "}";
        wp_add_inline_style( 'harry-custom', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'harry_custom_color_five' );

// harry_custom_color_six
function harry_custom_color_six() {
    $color_code = get_theme_mod( 'harry_color_option_6', '#3661FC' );
    wp_enqueue_style( 'harry-custom', HARRY_THEME_CSS_DIR . 'harry-custom.css', [] );
    if ( $color_code != '' ) {
        $custom_css = '';
        $custom_css .= "html:root { --tp-theme-6 : " . $color_code . "}";
        wp_add_inline_style( 'harry-custom', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'harry_custom_color_six' );

// harry_custom_color_seven
function harry_custom_color_seven() {
    $color_code = get_theme_mod( 'harry_color_option_7', '#2CAE76' );
    wp_enqueue_style( 'harry-custom', HARRY_THEME_CSS_DIR . 'harry-custom.css', [] );
    if ( $color_code != '' ) {
        $custom_css = '';
        $custom_css .= "html:root { --tp-theme-7 : " . $color_code . "}";
        wp_add_inline_style( 'harry-custom', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'harry_custom_color_seven' );

// harry_custom_color_eight
function harry_custom_color_eight() {
    $color_code = get_theme_mod( 'harry_color_option_8', '#FF5A1B' );
    wp_enqueue_style( 'harry-custom', HARRY_THEME_CSS_DIR . 'harry-custom.css', [] );
    if ( $color_code != '' ) {
        $custom_css = '';
        $custom_css .= "html:root { --tp-theme-8 : " . $color_code . "}";
        wp_add_inline_style( 'harry-custom', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'harry_custom_color_eight' );

// harry_custom_color_nine
function harry_custom_color_nine() {
    $color_code = get_theme_mod( 'harry_color_option_9', '#03041C' );
    wp_enqueue_style( 'harry-custom', HARRY_THEME_CSS_DIR . 'harry-custom.css', [] );
    if ( $color_code != '' ) {
        $custom_css = '';
        $custom_css .= "html:root { --tp-theme-9 : " . $color_code . "}";
        wp_add_inline_style( 'harry-custom', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'harry_custom_color_nine' );

// harry_custom_color_ten
function harry_custom_color_ten() {
    $color_code = get_theme_mod( 'harry_color_option_10', '#ED212C' );
    wp_enqueue_style( 'harry-custom', HARRY_THEME_CSS_DIR . 'harry-custom.css', [] );
    if ( $color_code != '' ) {
        $custom_css = '';
        $custom_css .= "html:root { --tp-theme-10 : " . $color_code . "}";
        wp_add_inline_style( 'harry-custom', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'harry_custom_color_ten' );

// scroll to top color
function harry_custom_color_scrollup() {
    $color_code = get_theme_mod( 'harry_color_scrollup', '#03041C' );
    wp_enqueue_style( 'harry-custom', HARRY_THEME_CSS_DIR . 'harry-custom.css', [] );
    if ( $color_code != '' ) {
        $custom_css = '';
        $custom_css .= "html .back-to-top-btn { background-color: " . $color_code . "}";
        wp_add_inline_style( 'harry-custom', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'harry_custom_color_scrollup' );


// harry_kses_intermediate
function harry_kses_intermediate( $string = '' ) {
    return wp_kses( $string, harry_get_allowed_html_tags( 'intermediate' ) );
}

function harry_get_allowed_html_tags( $level = 'basic' ) {
    $allowed_html = [
        'b'      => [],
        'i'      => [],
        'u'      => [],
        'em'     => [],
        'br'     => [],
        'abbr'   => [
            'title' => [],
        ],
        'span'   => [
            'class' => [],
        ],
        'strong' => [],
        'a'      => [
            'href'  => [],
            'title' => [],
            'class' => [],
            'id'    => [],
        ],
    ];

    if ($level === 'intermediate') {
        $allowed_html['a'] = [
            'href' => [],
            'title' => [],
            'class' => [],
            'id' => [],
        ];
        $allowed_html['div'] = [
            'class' => [],
            'id' => [],
        ];
        $allowed_html['img'] = [
            'src' => [],
            'class' => [],
            'alt' => [],
        ];
        $allowed_html['del'] = [
            'class' => [],
        ];
        $allowed_html['ins'] = [
            'class' => [],
        ];
        $allowed_html['bdi'] = [
            'class' => [],
        ];
        $allowed_html['i'] = [
            'class' => [],
            'data-rating-value' => [],
        ];
    }

    return $allowed_html;
}



// WP kses allowed tags
// ----------------------------------------------------------------------------------------
function harry_kses($raw){

   $allowed_tags = array(
      'a'                         => array(
         'class'   => array(),
         'href'    => array(),
         'rel'  => array(),
         'title'   => array(),
         'target' => array(),
      ),
      'abbr'                      => array(
         'title' => array(),
      ),
      'b'                         => array(),
      'blockquote'                => array(
         'cite' => array(),
      ),
      'cite'                      => array(
         'title' => array(),
      ),
      'code'                      => array(),
      'del'                    => array(
         'datetime'   => array(),
         'title'      => array(),
      ),
      'dd'                     => array(),
      'div'                    => array(
         'class'   => array(),
         'title'   => array(),
         'style'   => array(),
      ),
      'dl'                     => array(),
      'dt'                     => array(),
      'em'                     => array(),
      'h1'                     => array(),
      'h2'                     => array(),
      'h3'                     => array(),
      'h4'                     => array(),
      'h5'                     => array(),
      'h6'                     => array(),
      'i'                         => array(
         'class' => array(),
      ),
      'img'                    => array(
         'alt'  => array(),
         'class'   => array(),
         'height' => array(),
         'src'  => array(),
         'width'   => array(),
      ),
      'li'                     => array(
         'class' => array(),
      ),
      'ol'                     => array(
         'class' => array(),
      ),
      'p'                         => array(
         'class' => array(),
      ),
      'q'                         => array(
         'cite'    => array(),
         'title'   => array(),
      ),
      'span'                      => array(
         'class'   => array(),
         'title'   => array(),
         'style'   => array(),
      ),
      'iframe'                 => array(
         'width'         => array(),
         'height'     => array(),
         'scrolling'     => array(),
         'frameborder'   => array(),
         'allow'         => array(),
         'src'        => array(),
      ),
      'strike'                 => array(),
      'br'                     => array(),
      'strong'                 => array(),
      'data-wow-duration'            => array(),
      'data-wow-delay'            => array(),
      'data-wallpaper-options'       => array(),
      'data-stellar-background-ratio'   => array(),
      'ul'                     => array(
         'class' => array(),
      ),
      'svg' => array(
           'class' => true,
           'aria-hidden' => true,
           'aria-labelledby' => true,
           'role' => true,
           'xmlns' => true,
           'width' => true,
           'height' => true,
           'viewbox' => true, // <= Must be lower case!
       ),
       'g'     => array( 'fill' => true ),
       'title' => array( 'title' => true ),
       'path'  => array( 'd' => true, 'fill' => true,  ),
      );

   if (function_exists('wp_kses')) { // WP is here
      $allowed = wp_kses($raw, $allowed_tags);
   } else {
      $allowed = $raw;
   }

   return $allowed;
}

// / This code filters the Archive widget to include the post count inside the link /
add_filter( 'get_archives_link', 'harry_archive_count_span' );
function harry_archive_count_span( $links ) {
    $links = str_replace('</a>&nbsp;(', '<span > (', $links);
    $links = str_replace(')', ')</span></a> ', $links);
    return $links;
}


// / This code filters the Category widget to include the post count inside the link /
add_filter('wp_list_categories', 'harry_cat_count_span');
function harry_cat_count_span($links) {
  $links = str_replace('</a> (', '<span> (', $links);
  $links = str_replace(')', ')</span></a>', $links);
  return $links;
}