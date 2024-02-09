<?php
/**
 * harry customizer
 *
 * @package harry
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Added Panels & Sections
 */
function harry_customizer_panels_sections( $wp_customize ) {

    //Add panel
    $wp_customize->add_panel( 'harry_customizer', [
        'priority' => 10,
        'title'    => esc_html__( 'Harry Customizer', 'harry' ),
    ] );

    /**
     * Customizer Section
     */
    $wp_customize->add_section( 'header_top_setting', [
        'title'       => esc_html__( 'Header Top Setting', 'harry' ),
        'description' => '',
        'priority'    => 10,
        'capability'  => 'edit_theme_options',
        'panel'       => 'harry_customizer',
    ] );

    $wp_customize->add_section( 'header_social', [
        'title'       => esc_html__( 'Header Social', 'harry' ),
        'description' => '',
        'priority'    => 11,
        'capability'  => 'edit_theme_options',
        'panel'       => 'harry_customizer',
    ] );

    $wp_customize->add_section( 'section_header_logo', [
        'title'       => esc_html__( 'Header Setting', 'harry' ),
        'description' => '',
        'priority'    => 12,
        'capability'  => 'edit_theme_options',
        'panel'       => 'harry_customizer',
    ] );

    $wp_customize->add_section( 'section_menu', [
        'title'       => esc_html__( 'Menu Setting', 'harry' ),
        'description' => '',
        'priority'    => 12,
        'capability'  => 'edit_theme_options',
        'panel'       => 'harry_customizer',
    ] );

    $wp_customize->add_section( 'section_preloader', [
        'title'       => esc_html__( 'Preloader Setting', 'harry' ),
        'description' => '',
        'priority'    => 13,
        'capability'  => 'edit_theme_options',
        'panel'       => 'harry_customizer',
    ] );

    $wp_customize->add_section( 'blog_setting', [
        'title'       => esc_html__( 'Blog Setting', 'harry' ),
        'description' => '',
        'priority'    => 13,
        'capability'  => 'edit_theme_options',
        'panel'       => 'harry_customizer',
    ] );

    $wp_customize->add_section( 'header_side_setting', [
        'title'       => esc_html__( 'Offcanvas Settings', 'harry' ),
        'description' => '',
        'priority'    => 14,
        'capability'  => 'edit_theme_options',
        'panel'       => 'harry_customizer',
    ] );

    $wp_customize->add_section( 'newsletter_setting', [
        'title'       => esc_html__( 'Newsletter Settings', 'harry' ),
        'description' => 'Newsletter Styles',
        'priority'    => 14,
        'capability'  => 'edit_theme_options',
        'panel'       => 'harry_customizer',
    ] );

    $wp_customize->add_section( 'breadcrumb_setting', [
        'title'       => esc_html__( 'Breadcrumb Setting', 'harry' ),
        'description' => '',
        'priority'    => 15,
        'capability'  => 'edit_theme_options',
        'panel'       => 'harry_customizer',
    ] );

    $wp_customize->add_section( 'blog_setting', [
        'title'       => esc_html__( 'Blog Setting', 'harry' ),
        'description' => '',
        'priority'    => 16,
        'capability'  => 'edit_theme_options',
        'panel'       => 'harry_customizer',
    ] );

    $wp_customize->add_section( 'footer_setting', [
        'title'       => esc_html__( 'Footer Settings', 'harry' ),
        'description' => '',
        'priority'    => 16,
        'capability'  => 'edit_theme_options',
        'panel'       => 'harry_customizer',
    ] );

    $wp_customize->add_section( 'event_setting', [
        'title'       => esc_html__( 'Event Settings', 'harry' ),
        'description' => '',
        'priority'    => 16,
        'capability'  => 'edit_theme_options',
        'panel'       => 'harry_customizer',
    ] );

    $wp_customize->add_section( 'color_setting', [
        'title'       => esc_html__( 'Color Setting', 'harry' ),
        'description' => '',
        'priority'    => 17,
        'capability'  => 'edit_theme_options',
        'panel'       => 'harry_customizer',
    ] );

    $wp_customize->add_section( '404_page', [
        'title'       => esc_html__( '404 Page', 'harry' ),
        'description' => '',
        'priority'    => 18,
        'capability'  => 'edit_theme_options',
        'panel'       => 'harry_customizer',
    ] );

    $wp_customize->add_section( 'shop_sections', [
        'title'       => esc_html__( 'Shop Settings ', 'harry' ),
        'description' => '',
        'priority'    => 19,
        'capability'  => 'edit_theme_options',
        'panel'       => 'harry_customizer',
    ] );

    $wp_customize->add_section( 'typo_setting', [
        'title'       => esc_html__( 'Typography Setting', 'harry' ),
        'description' => '',
        'priority'    => 21,
        'capability'  => 'edit_theme_options',
        'panel'       => 'harry_customizer',
    ] );

    $wp_customize->add_section( 'slug_setting', [
        'title'       => esc_html__( 'Slug Settings', 'harry' ),
        'description' => '',
        'priority'    => 22,
        'capability'  => 'edit_theme_options',
        'panel'       => 'harry_customizer',
    ] );
}

add_action( 'customize_register', 'harry_customizer_panels_sections' );

function _header_menu( $fields ) {
    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_menu_setting',
        'label'       => esc_html__( 'Menu Font', 'harry' ),
        'section'     => 'section_menu',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => '.main-menu ul li a',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'color',
        'settings'    => 'harry_menu_bg_color',
        'label'       => __( 'Menu BG Color', 'harry' ),
        'description' => esc_html__( 'This is a Menu bg color control.', 'harry' ),
        'section'     => 'section_menu',
        'default'     => '#0E3531',
        'priority'    => 10,
    ];

    return $fields;

}
add_filter( 'kirki/fields', '_header_menu' );


function _header_top_fields( $fields ) {
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'harry_topbar_switch',
        'label'    => esc_html__( 'Topbar Switcher', 'harry' ),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'harry' ),
            'off' => esc_html__( 'Disable', 'harry' ),
        ],
    ];
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'harry_sticky_switch',
        'label'    => esc_html__( 'Sticky Switcher', 'harry' ),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'harry' ),
            'off' => esc_html__( 'Disable', 'harry' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'harry_backtotop',
        'label'    => esc_html__( 'Back To Top On/Off', 'harry' ),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'harry' ),
            'off' => esc_html__( 'Disable', 'harry' ),
        ],
    ];

    // right enable disable
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'harry_header_right',
        'label'    => esc_html__( 'Header Right On/Off', 'harry' ),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'harry' ),
            'off' => esc_html__( 'Disable', 'harry' ),
        ],
    ];    

    // search on off
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'harry_header_search',
        'label'    => esc_html__( 'Header Search On/Off', 'harry' ),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'harry' ),
            'off' => esc_html__( 'Disable', 'harry' ),
        ],
    ];

    // Language on off
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'harry_header_lang',
        'label'    => esc_html__( 'Language On/Off', 'harry' ),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'harry' ),
            'off' => esc_html__( 'Disable', 'harry' ),
        ],
    ];

    // login on off
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'harry_header_login',
        'label'    => esc_html__( 'Login On/Off', 'harry' ),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'harry' ),
            'off' => esc_html__( 'Disable', 'harry' ),
        ],
    ];

    // cart on off
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'harry_header_cart',
        'label'    => esc_html__( 'Cart On/Off', 'harry' ),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'harry' ),
            'off' => esc_html__( 'Disable', 'harry' ),
        ],
    ];

    // wishlist on off
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'harry_header_wishlist',
        'label'    => esc_html__( 'Wishlist On/Off', 'harry' ),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'harry' ),
            'off' => esc_html__( 'Disable', 'harry' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'harry_header_hamburger',
        'label'    => esc_html__( 'Header Hamburger On/Off', 'harry' ),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'harry' ),
            'off' => esc_html__( 'Disable', 'harry' ),
        ],
    ];

    
    // hamburger text
    $fields[] = [
        'type'     => 'text',
        'settings' => 'harry_header_hamburger_text',
        'label'    => esc_html__( 'Hamburger Text', 'harry' ),
        'section'  => 'header_top_setting',
        'default'  => esc_html__( 'Intro', 'harry' ),
        'priority' => 10,
    ];


    // email Title
    $fields[] = [
        'type'     => 'text',
        'settings' => 'harry_mail_title',
        'label'    => esc_html__( 'Mail Title', 'harry' ),
        'section'  => 'header_top_setting',
        'default'  => esc_html__( 'Email Us:', 'harry' ),
        'priority' => 10,
    ];    

    // email
    $fields[] = [
        'type'     => 'text',
        'settings' => 'harry_mail_id',
        'label'    => esc_html__( 'Mail ID', 'harry' ),
        'section'  => 'header_top_setting',
        'default'  => esc_html__( 'info@harry.com', 'harry' ),
        'priority' => 10,
    ];    

    // phone title
    $fields[] = [
        'type'     => 'text',
        'settings' => 'harry_phone_title',
        'label'    => esc_html__( 'Phone Title', 'harry' ),
        'section'  => 'header_top_setting',
        'default'  => esc_html__( 'Call Us', 'harry' ),
        'priority' => 10,
    ];    

    // phone
    $fields[] = [
        'type'     => 'text',
        'settings' => 'harry_phone_num',
        'label'    => esc_html__( 'Phone', 'harry' ),
        'section'  => 'header_top_setting',
        'default'  => esc_html__( '+964 742 44 763', 'harry' ),
        'priority' => 10,
    ];    

    // time
    $fields[] = [
        'type'     => 'text',
        'settings' => 'harry_time_text',
        'label'    => esc_html__( 'Time text', 'harry' ),
        'section'  => 'header_top_setting',
        'default'  => esc_html__( 'Sunday-Thures 10am-07pm', 'harry' ),
        'priority' => 10,
    ];    

    // welcome
    $fields[] = [
        'type'     => 'text',
        'settings' => 'harry_welcome_text',
        'label'    => esc_html__( 'Welcome text', 'harry' ),
        'section'  => 'header_top_setting',
        'default'  => esc_html__( 'We are a law firm located in Berlin.', 'harry' ),
        'priority' => 10,
    ];    

    // contact
    $fields[] = [
        'type'     => 'text',
        'settings' => 'harry_contact_button_text',
        'label'    => esc_html__( 'Contact Button Text', 'harry' ),
        'section'  => 'header_top_setting',
        'default'  => esc_html__( 'Lets Talk', 'harry' ),
        'priority' => 10,
    ];    

    $fields[] = [
        'type'     => 'text',
        'settings' => 'harry_contact_button_link',
        'label'    => esc_html__( 'Contact Button URL', 'harry' ),
        'section'  => 'header_top_setting',
        'default'  => esc_html__( '#', 'harry' ),
        'priority' => 10,
    ];

    // login
    $fields[] = [
        'type'     => 'text',
        'settings' => 'harry_login_button_text',
        'label'    => esc_html__( 'Login Button Text', 'harry' ),
        'section'  => 'header_top_setting',
        'default'  => esc_html__( 'Login', 'harry' ),
        'priority' => 10,
    ];    

    $fields[] = [
        'type'     => 'text',
        'settings' => 'harry_login_button_link',
        'label'    => esc_html__( 'Login Button URL', 'harry' ),
        'section'  => 'header_top_setting',
        'default'  => esc_html__( '#', 'harry' ),
        'priority' => 10,
    ];

    return $fields;

}
add_filter( 'kirki/fields', '_header_top_fields' );

/*
Header Social
 */
function _header_social_fields( $fields ) {

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'harry_social_switch',
        'label'    => esc_html__( 'Social On/Off', 'harry' ),
        'section'  => 'header_social',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'harry' ),
            'off' => esc_html__( 'Disable', 'harry' ),
        ],
    ];

    // header section social
    $fields[] = [
        'type'     => 'text',
        'settings' => 'harry_topbar_fb_url',
        'label'    => esc_html__( 'Facebook Url', 'harry' ),
        'section'  => 'header_social',
        'default'  => esc_html__( '#', 'harry' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'harry_topbar_twitter_url',
        'label'    => esc_html__( 'Twitter Url', 'harry' ),
        'section'  => 'header_social',
        'default'  => esc_html__( '#', 'harry' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'harry_topbar_linkedin_url',
        'label'    => esc_html__( 'Linkedin Url', 'harry' ),
        'section'  => 'header_social',
        'default'  => esc_html__( '#', 'harry' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'harry_topbar_instagram_url',
        'label'    => esc_html__( 'Instagram Url', 'harry' ),
        'section'  => 'header_social',
        'default'  => esc_html__( '#', 'harry' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'harry_topbar_youtube_url',
        'label'    => esc_html__( 'Youtube Url', 'harry' ),
        'section'  => 'header_social',
        'default'  => esc_html__( '#', 'harry' ),
        'priority' => 10,
    ];


    return $fields;
}
add_filter( 'kirki/fields', '_header_social_fields' );

/*
newsletter setting
 */
function _newsletter_setting_fields( $fields ) {
    $fields[] = [
        'type'        => 'radio-image',
        'settings'    => 'choose_default_newsletter',
        'label'       => esc_html__( 'Select Newsletter Style', 'harry' ),
        'section'     => 'newsletter_setting',
        'placeholder' => esc_html__( 'Select an option...', 'harry' ),
        'priority'    => 10,
        'multiple'    => 1,
        'choices'     => [
            'newsletter-style-1'   => get_template_directory_uri() . '/inc/img/newsletter/newsletter-1.png',
            'newsletter-style-2' => get_template_directory_uri() . '/inc/img/newsletter/newsletter-2.png',
            'newsletter-style-3' => get_template_directory_uri() . '/inc/img/newsletter/newsletter-3.png',

        ],
        'default'     => 'newsletter-style-1',
    ];
    // Breadcrumb Setting
    $fields[] = [
        'type'        => 'image',
        'settings'    => 'newsletter_bg_img',
        'label'       => esc_html__( 'Newsletter Background Image', 'harry' ),
        'description' => esc_html__( 'Newsletter Background Image', 'harry' ),
        'section'     => 'newsletter_setting',
        'default'     => get_template_directory_uri() . '/assets/img/newsletter/newsletter-1.jpg',
    ];

    // header transparent switch
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'harry_newsletter_switch',
        'label'    => esc_html__( 'Newsletter On/Off', 'harry' ),
        'section'  => 'newsletter_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'harry' ),
            'off' => esc_html__( 'Disable', 'harry' ),
        ],
    ]; 

    $fields[] = [
        'type'     => 'text',
        'settings' => 'harry_newsletter_mailchimp_shortcode',
        'label'    => esc_html__( 'Mailchip Shortcode', 'harry' ),
        'section'  => 'newsletter_setting',
        'default'  => esc_html__( 'Your shortcode here', 'harry' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'harry_newsletter_subtitle',
        'label'    => esc_html__( 'Subtitle', 'harry' ),
        'section'  => 'newsletter_setting',
        'default'  => esc_html__( 'Harry Discount', 'harry' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'harry_newsletter_title',
        'label'    => esc_html__( 'Title', 'harry' ),
        'section'  => 'newsletter_setting',
        'default'  => esc_html__( 'Keep up with our daily and weekly newsletters', 'harry' ),
        'priority' => 10,
    ];
    $fields[] = [
        'type'     => 'textarea',
        'settings' => 'harry_newsletter_desc',
        'label'    => esc_html__( 'Description', 'harry' ),
        'section'  => 'newsletter_setting',
        'default'  => esc_html__( 'Keep up with our daily and weekly newsletters', 'harry' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'harry_newsletter_social_switch',
        'label'    => esc_html__( 'Social On/Off', 'harry' ),
        'section'  => 'newsletter_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'harry' ),
            'off' => esc_html__( 'Disable', 'harry' ),
        ],
    ];

    // header section social
    $fields[] = [
        'type'     => 'text',
        'settings' => 'harry_newsletter_fb_url',
        'label'    => esc_html__( 'Facebook Url', 'harry' ),
        'section'  => 'newsletter_setting',
        'default'  => esc_html__( '#', 'harry' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'harry_newsletter_twitter_url',
        'label'    => esc_html__( 'Twitter Url', 'harry' ),
        'section'  => 'newsletter_setting',
        'default'  => esc_html__( '#', 'harry' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'harry_newsletter_linkedin_url',
        'label'    => esc_html__( 'Linkedin Url', 'harry' ),
        'section'  => 'newsletter_setting',
        'default'  => esc_html__( '#', 'harry' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'harry_newsletter_instagram_url',
        'label'    => esc_html__( 'Instagram Url', 'harry' ),
        'section'  => 'newsletter_setting',
        'default'  => esc_html__( '#', 'harry' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'harry_newsletter_youtube_url',
        'label'    => esc_html__( 'Youtube Url', 'harry' ),
        'section'  => 'newsletter_setting',
        'default'  => esc_html__( '#', 'harry' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'harry_login_url',
        'label'    => esc_html__( 'Login URL', 'harry' ),
        'section'  => 'newsletter_setting',
        'default'  => esc_html__( '#', 'harry' ),
        'priority' => 10,
    ];

    return $fields;
}
add_filter( 'kirki/fields', '_newsletter_setting_fields' );

/*
Header Settings
 */
function _header_header_fields( $fields ) {
    $fields[] = [
        'type'        => 'radio-image',
        'settings'    => 'choose_default_header',
        'label'       => esc_html__( 'Select Header Style', 'harry' ),
        'section'     => 'section_header_logo',
        'placeholder' => esc_html__( 'Select an option...', 'harry' ),
        'priority'    => 10,
        'multiple'    => 1,
        'choices'     => [
            'header-style-1'   => get_template_directory_uri() . '/inc/img/header/header-1.png',
            'header-style-2' => get_template_directory_uri() . '/inc/img/header/header-2.png',
            'header-style-3'  => get_template_directory_uri() . '/inc/img/header/header-3.png',
            'header-style-4'  => get_template_directory_uri() . '/inc/img/header/header-4.png',
            'header-style-5'  => get_template_directory_uri() . '/inc/img/header/header-5.png',
            'header-style-6'  => get_template_directory_uri() . '/inc/img/header/header-6.png',
            'header-style-7'  => get_template_directory_uri() . '/inc/img/header/header-7.png',
            'header-style-8'  => get_template_directory_uri() . '/inc/img/header/header-8.png',
            'header-style-9'  => get_template_directory_uri() . '/inc/img/header/header-9.png',
            'header-style-10'  => get_template_directory_uri() . '/inc/img/header/header-10.png',
            'header-style-11'  => get_template_directory_uri() . '/inc/img/header/header-11.png',
            'header-style-12'  => get_template_directory_uri() . '/inc/img/header/header-12.png',
            'header-style-13'  => get_template_directory_uri() . '/inc/img/header/header-13.png',
            'header-style-14'  => get_template_directory_uri() . '/inc/img/header/header-14.png',
            'header-style-15'  => get_template_directory_uri() . '/inc/img/header/header-15.png',
            'header-style-16'  => get_template_directory_uri() . '/inc/img/header/header-16.png',
            'header-style-17'  => get_template_directory_uri() . '/inc/img/header/header-17.png'
        ],
        'default'     => 'header-style-1',
    ];

    // header transparent switch
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'harry_transparent_header',
        'label'    => esc_html__( 'Transparent Style On/Off', 'harry' ),
        'section'  => 'section_header_logo',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'harry' ),
            'off' => esc_html__( 'Disable', 'harry' ),
        ],
    ]; 

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'logo',
        'label'       => esc_html__( 'Header Logo', 'harry' ),
        'description' => esc_html__( 'Upload Your Logo.', 'harry' ),
        'section'     => 'section_header_logo',
        'default'     => get_template_directory_uri() . '/assets/img/logo/logo-black.svg',
    ];

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'seconday_logo',
        'label'       => esc_html__( 'Header Secondary Logo', 'harry' ),
        'description' => esc_html__( 'Header Logo Black', 'harry' ),
        'section'     => 'section_header_logo',
        'default'     => get_template_directory_uri() . '/assets/img/logo/logo.svg',
    ];

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'harry_sticky_logo',
        'label'       => esc_html__( 'Header Sticky Logo', 'harry' ),
        'description' => esc_html__( 'Header Sticky Logo', 'harry' ),
        'section'     => 'section_header_logo',
        'default'     => get_template_directory_uri() . '/assets/img/logo/logo-black-solid.svg',
    ];

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'harry_search_logo',
        'label'       => esc_html__( 'Header Search Logo', 'harry' ),
        'description' => esc_html__( 'Header Search Logo', 'harry' ),
        'section'     => 'section_header_logo',
        'default'     => get_template_directory_uri() . '/assets/img/logo/logo.svg',
    ];

        // preloader text
        $fields[] = [
            'type'     => 'text',
            'settings' => 'harry_logo_width',
            'label'    => esc_html__( 'Logo Width', 'harry' ),
            'section'  => 'section_header_logo',
            'default'  => esc_html__( '120', 'harry' ),
            'priority' => 10,
        ];

    return $fields;
}
add_filter( 'kirki/fields', '_header_header_fields' );

/*
Preloader
 */
function _header_preloader_fields( $fields ) {

    // preloader switch
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'harry_preloader_switch',
        'label'    => esc_html__( 'Preloader On/Off', 'harry' ),
        'section'  => 'section_preloader',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'harry' ),
            'off' => esc_html__( 'Disable', 'harry' ),
        ],
    ];  

    // preloader bar
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'harry_preloader_bar',
        'label'    => esc_html__( 'Preloader Bar On/Off', 'harry' ),
        'section'  => 'section_preloader',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'harry' ),
            'off' => esc_html__( 'Disable', 'harry' ),
        ],
    ];  

    // preloader logo
    $fields[] = [
        'type'        => 'image',
        'settings'    => 'harry_preloader_logo',
        'label'       => esc_html__( 'Logo Preloader', 'harry' ),
        'description' => esc_html__( 'Logo Preloader', 'harry' ),
        'section'     => 'section_preloader',
        'default'     => get_template_directory_uri() . '/assets/img/logo/logo-black.svg',
    ];

    // preloader text
    $fields[] = [
        'type'     => 'text',
        'settings' => 'harry_preloader_text',
        'label'    => esc_html__( 'Preloader text', 'harry' ),
        'section'  => 'section_preloader',
        'default'  => esc_html__( 'Harry', 'harry' ),
        'priority' => 10,
    ];

    // preloader loading text
    $fields[] = [
        'type'     => 'text',
        'settings' => 'harry_preloader_loading_text',
        'label'    => esc_html__( 'Loading text', 'harry' ),
        'section'  => 'section_preloader',
        'default'  => esc_html__( 'Loading', 'harry' ),
        'priority' => 10,
    ];

    return $fields;
}
add_filter( 'kirki/fields', '_header_preloader_fields' );

/*
Header Side Info
 */
function _header_side_fields( $fields ) {

    $fields[] = [
        'type'        => 'radio-image',
        'settings'    => 'choose_default_offcanvas',
        'label'       => esc_html__( 'Select Offcanvas Style', 'harry' ),
        'section'     => 'header_side_setting',
        'placeholder' => esc_html__( 'Select an option...', 'harry' ),
        'priority'    => 10,
        'multiple'    => 1,
        'choices'     => [
            'offcanvas-style-1'   => get_template_directory_uri() . '/inc/img/offcanvas/offcanvas-1.png',
            'offcanvas-style-2' => get_template_directory_uri() . '/inc/img/offcanvas/offcanvas-2.png',
            'offcanvas-style-3'  => get_template_directory_uri() . '/inc/img/offcanvas/offcanvas-3.png',
            'offcanvas-style-4'  => get_template_directory_uri() . '/inc/img/offcanvas/offcanvas-4.png',
            'offcanvas-style-5'  => get_template_directory_uri() . '/inc/img/offcanvas/offcanvas-5.png',
            'offcanvas-style-7'  => get_template_directory_uri() . '/inc/img/offcanvas/offcanvas-7.png',
            'offcanvas-style-6'  => get_template_directory_uri() . '/inc/img/offcanvas/offcanvas-6.png',
        ],
        'default'     => 'offcanvas-style-1',
    ];

    // side info settings
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'harry_side_hide',
        'label'    => esc_html__( 'Offcanvas Info On/Off', 'harry' ),
        'section'  => 'header_side_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'harry' ),
            'off' => esc_html__( 'Disable', 'harry' ),
        ],
    ];  

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'harry_offcanvas_full_menu',
        'label'    => esc_html__( 'Offcanvas Full Width Menu On/Off', 'harry' ),
        'section'  => 'header_side_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'harry' ),
            'off' => esc_html__( 'Disable', 'harry' ),
        ],
    ];  

    // offcanvas default menu
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'harry_offcanvas_default_menu',
        'label'    => esc_html__( 'Menu On/Off', 'harry' ),
        'section'  => 'header_side_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'harry' ),
            'off' => esc_html__( 'Disable', 'harry' ),
        ],
    ];  

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'harry_offcanvas_logo',
        'label'       => esc_html__( 'Logo Offcanvas', 'harry' ),
        'description' => esc_html__( 'Logo Offcanvas', 'harry' ),
        'section'     => 'header_side_setting',
        'default'     => get_template_directory_uri() . '/assets/img/logo/logo-black.svg',
    ];

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'harry_offcanvas_signature',
        'label'       => esc_html__( 'Signature Offcanvas', 'harry' ),
        'description' => esc_html__( 'Signature Offcanvas', 'harry' ),
        'section'     => 'header_side_setting',
        'default'     => get_template_directory_uri() . '/assets/img/shape/offcanvas-signature.png',
    ];

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'harry_offcanvas_thumb',
        'label'       => esc_html__( 'Offcanvas Thumbnail', 'harry' ),
        'description' => esc_html__( 'Offcanvas Thumbnail', 'harry' ),
        'section'     => 'header_side_setting',
        'default'     => get_template_directory_uri() . '/assets/img/shape/offcanvas-img-1.png',
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'harry_offcanvas_desc_title',
        'label'    => esc_html__( 'Description Title', 'harry' ),
        'section'  => 'header_side_setting',
        'default'  => esc_html__( 'We help to create visual strategies.', 'harry' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'textarea',
        'settings' => 'harry_offcanvas_description',
        'label'    => esc_html__( 'Description ', 'harry' ),
        'section'  => 'header_side_setting',
        'default'  => esc_html__( 'Im a UX Designer, Over the past 10+ years I’ve created well-crafted mobile and web apps by connecting Business goals with user needs.', 'harry' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'textarea',
        'settings' => 'harry_offcanvas_links',
        'label'    => esc_html__( 'Offcanvas Links', 'harry' ),
        'section'  => 'header_side_setting',
        'default'  => esc_html__( '<a href="#">Privacy Policy</a>
        <a href="#">Use of terms</a>', 'harry' ),
        'priority' => 10,
    ];

    // offcanvas social
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'harry_offcanvas_social',
        'label'    => esc_html__( 'Offcanvas Social On/Off', 'harry' ),
        'section'  => 'header_side_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'harry' ),
            'off' => esc_html__( 'Disable', 'harry' ),
        ],
    ];  

    // offcanvas social
    $fields[] = [
        'type'     => 'text',
        'settings' => 'harry_offcanvas_social_title',
        'label'    => esc_html__( 'Social Title', 'harry' ),
        'section'  => 'header_side_setting',
        'default'  => esc_html__( 'Follow :', 'harry' ),
        'priority' => 10,
    ];
        $fields[] = [
            'type'     => 'text',
            'settings' => 'harry_offcanvas_fb_url',
            'label'    => esc_html__( 'Facebook Url', 'harry' ),
            'section'  => 'header_side_setting',
            'default'  => esc_html__( '#', 'harry' ),
            'priority' => 10,
        ];
    
        $fields[] = [
            'type'     => 'text',
            'settings' => 'harry_offcanvas_twitter_url',
            'label'    => esc_html__( 'Twitter Url', 'harry' ),
            'section'  => 'header_side_setting',
            'default'  => esc_html__( '#', 'harry' ),
            'priority' => 10,
        ];
    
        $fields[] = [
            'type'     => 'text',
            'settings' => 'harry_offcanvas_linkedin_url',
            'label'    => esc_html__( 'Linkedin Url', 'harry' ),
            'section'  => 'header_side_setting',
            'default'  => esc_html__( '#', 'harry' ),
            'priority' => 10,
        ];
    
        $fields[] = [
            'type'     => 'text',
            'settings' => 'harry_offcanvas_instagram_url',
            'label'    => esc_html__( 'Instagram Url', 'harry' ),
            'section'  => 'header_side_setting',
            'default'  => esc_html__( '#', 'harry' ),
            'priority' => 10,
        ];
    
        $fields[] = [
            'type'     => 'text',
            'settings' => 'harry_offcanvas_youtube_url',
            'label'    => esc_html__( 'Youtube Url', 'harry' ),
            'section'  => 'header_side_setting',
            'default'  => esc_html__( '#', 'harry' ),
            'priority' => 10,
        ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'harry_offcanvas_phone',
        'label'    => esc_html__( 'Phone Number', 'harry' ),
        'section'  => 'header_side_setting',
        'default'  => esc_html__( '+0989 7876 9865 9', 'harry' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'harry_offcanvas_mail',
        'label'    => esc_html__( 'Email ID', 'harry' ),
        'section'  => 'header_side_setting',
        'default'  => esc_html__( 'info@harry.com', 'harry' ),
        'priority' => 10,
    ];
    $fields[] = [
        'type'     => 'text',
        'settings' => 'harry_offcanvas_location',
        'label'    => esc_html__( 'Location Text', 'harry' ),
        'section'  => 'header_side_setting',
        'default'  => esc_html__( '32 East Trusel Court North Tonawanda, NY 14120', 'harry' ),
        'priority' => 10,
    ];
    $fields[] = [
        'type'     => 'text',
        'settings' => 'harry_offcanvas_location_url',
        'label'    => esc_html__( 'Location URL', 'harry' ),
        'section'  => 'header_side_setting',
        'default'  => esc_html__( '#', 'harry' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'harry_offcanvas_btn',
        'label'    => esc_html__( 'Button Text', 'harry' ),
        'section'  => 'header_side_setting',
        'default'  => esc_html__( 'Contact Us', 'harry' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'harry_offcanvas_btn_url',
        'label'    => esc_html__( 'Button Link', 'harry' ),
        'section'  => 'header_side_setting',
        'default'  => esc_html__( '#', 'harry' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'harry_offcanvas_btn_2',
        'label'    => esc_html__( 'Button Text 2', 'harry' ),
        'section'  => 'header_side_setting',
        'default'  => esc_html__( 'Work <br> With Us', 'harry' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'harry_offcanvas_btn_2_url',
        'label'    => esc_html__( 'Button Link 2 ', 'harry' ),
        'section'  => 'header_side_setting',
        'default'  => esc_html__( '#', 'harry' ),
        'priority' => 10,
    ];
    return $fields;
}
add_filter( 'kirki/fields', '_header_side_fields' );

/*
_header_page_title_fields
 */
function _header_page_title_fields( $fields ) {
    $fields[] = [
        'type'        => 'radio-image',
        'settings'    => 'choose_default_breadcrumb',
        'label'       => esc_html__( 'Select Breadcrumb Style', 'harry' ),
        'section'     => 'breadcrumb_setting',
        'placeholder' => esc_html__( 'Select an option...', 'harry' ),
        'priority'    => 10,
        'multiple'    => 1,
        'choices'     => [
            'breadcrumb-style-1' => get_template_directory_uri() . '/inc/img/breadcrumb/breadcrumb-1.png',
            'breadcrumb-style-2' => get_template_directory_uri() . '/inc/img/breadcrumb/breadcrumb-2.png',
            'breadcrumb-style-3' => get_template_directory_uri() . '/inc/img/breadcrumb/breadcrumb-3.png',
            'breadcrumb-style-4' => get_template_directory_uri() . '/inc/img/breadcrumb/breadcrumb-4.png',
            'breadcrumb-style-5' => get_template_directory_uri() . '/inc/img/breadcrumb/breadcrumb-5.png'
        ],
        'default'     => 'breadcrumb-style-1',
    ];

    $fields[] = [
        'type'        => 'typography',
		'settings'    => 'breadcrumb_typography_setting',
		'label'       => esc_html__( 'Typography Control', 'harry' ),
		'description' => esc_html__( 'The full set of options.', 'harry' ),
		'section'     => 'breadcrumb_setting',
		'priority'    => 10,
		'transport'   => 'auto',
		'default'     => [
			'font-family'     => '',
			'variant'         => '',
			'font-style'      => 'normal',
			'color'           => '',
			'font-size'       => '',
			'text-transform'  => 'none',
		],
		'output'      => [
			[
				'element' => 'body .breadcrumb__title',
			],
		],
	];

    // Breadcrumb Setting
    $fields[] = [
        'type'        => 'image',
        'settings'    => 'breadcrumb_bg_img',
        'label'       => esc_html__( 'Breadcrumb Background Image', 'harry' ),
        'description' => esc_html__( 'Breadcrumb Background Image', 'harry' ),
        'section'     => 'breadcrumb_setting',
    ];
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'harry_breadcrumb_bg_color',
        'label'       => __( 'Breadcrumb BG Color', 'harry' ),
        'description' => esc_html__( 'This is a Breadcrumb bg color control.', 'harry' ),
        'section'     => 'breadcrumb_setting',
        'default'     => '#e1e1e1',
        'priority'    => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'harry_breadcrumb_pt',
        'label'    => esc_html__( 'Breadcrumb Paddint Top', 'harry' ),
        'section'  => 'breadcrumb_setting',
        'default'  => esc_html__( '115', 'harry' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'harry_breadcrumb_pb',
        'label'    => esc_html__( 'Breadcrumb Paddint Bottom', 'harry' ),
        'section'  => 'breadcrumb_setting',
        'default'  => esc_html__( '130', 'harry' ),
        'priority' => 10,
    ];

    
    return $fields;
}
add_filter( 'kirki/fields', '_header_page_title_fields' );

/*
Header Social
 */
function _header_blog_fields( $fields ) {
// Blog Setting
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'harry_blog_btn_switch',
        'label'    => esc_html__( 'Blog BTN On/Off', 'harry' ),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'harry' ),
            'off' => esc_html__( 'Disable', 'harry' ),
        ],
    ];
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'harry_blog_single_social',
        'label'    => esc_html__( 'Blog Share On/Off', 'harry' ),
        'section'  => 'blog_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'harry' ),
            'off' => esc_html__( 'Disable', 'harry' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'harry_blog_cat',
        'label'    => esc_html__( 'Blog Category Meta On/Off', 'harry' ),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'harry' ),
            'off' => esc_html__( 'Disable', 'harry' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'harry_blog_view',
        'label'    => esc_html__( 'Blog View Meta On/Off', 'harry' ),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'harry' ),
            'off' => esc_html__( 'Disable', 'harry' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'harry_blog_author',
        'label'    => esc_html__( 'Blog Author Meta On/Off', 'harry' ),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'harry' ),
            'off' => esc_html__( 'Disable', 'harry' ),
        ],
    ];
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'harry_blog_date',
        'label'    => esc_html__( 'Blog Date Meta On/Off', 'harry' ),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'harry' ),
            'off' => esc_html__( 'Disable', 'harry' ),
        ],
    ];
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'harry_blog_comments',
        'label'    => esc_html__( 'Blog Comments Meta On/Off', 'harry' ),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'harry' ),
            'off' => esc_html__( 'Disable', 'harry' ),
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'harry_blog_btn',
        'label'    => esc_html__( 'Blog Button text', 'harry' ),
        'section'  => 'blog_setting',
        'default'  => esc_html__( 'Read More', 'harry' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'breadcrumb_blog_title',
        'label'    => esc_html__( 'Blog Title', 'harry' ),
        'section'  => 'blog_setting',
        'default'  => esc_html__( 'Blog', 'harry' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'breadcrumb_blog_title_details',
        'label'    => esc_html__( 'Blog Details Title', 'harry' ),
        'section'  => 'blog_setting',
        'default'  => esc_html__( 'Blog Details', 'harry' ),
        'priority' => 10,
    ];
    return $fields;
}
add_filter( 'kirki/fields', '_header_blog_fields' );

/*
Footer
 */
function _header_footer_fields( $fields ) {
    // Footer Setting
    $fields[] = [
        'type'        => 'radio-image',
        'settings'    => 'choose_default_footer',
        'label'       => esc_html__( 'Choose Footer Style', 'harry' ),
        'section'     => 'footer_setting',
        'default'     => '5',
        'placeholder' => esc_html__( 'Select an option...', 'harry' ),
        'priority'    => 10,
        'multiple'    => 1,
        'choices'     => [
            'footer-style-1'   => get_template_directory_uri() . '/inc/img/footer/footer-1.png',
            'footer-style-2' => get_template_directory_uri() . '/inc/img/footer/footer-2.png',
            'footer-style-3' => get_template_directory_uri() . '/inc/img/footer/footer-3.png',
            'footer-style-4' => get_template_directory_uri() . '/inc/img/footer/footer-4.png',
            'footer-style-5' => get_template_directory_uri() . '/inc/img/footer/footer-5.png',
            'footer-style-6' => get_template_directory_uri() . '/inc/img/footer/footer-6.png',
            'footer-style-7' => get_template_directory_uri() . '/inc/img/footer/footer-7.png',
            'footer-style-8' => get_template_directory_uri() . '/inc/img/footer/footer-8.png',
            'footer-style-9' => get_template_directory_uri() . '/inc/img/footer/footer-9.png',
            'footer-style-12' => get_template_directory_uri() . '/inc/img/footer/footer-12.png',
            'footer-style-13' => get_template_directory_uri() . '/inc/img/footer/footer-13.png'
        ],
        'default'     => 'footer-style-1',
    ];

    $fields[] = [
        'type'        => 'select',
        'settings'    => 'footer_widget_number',
        'label'       => esc_html__( 'Widget Number', 'harry' ),
        'section'     => 'footer_setting',
        'default'     => '4',
        'placeholder' => esc_html__( 'Select an option...', 'harry' ),
        'priority'    => 10,
        'multiple'    => 1,
        'choices'     => [
            '4' => esc_html__( 'Widget Number 4', 'harry' ),
            '3' => esc_html__( 'Widget Number 3', 'harry' ),
            '2' => esc_html__( 'Widget Number 2', 'harry' ),
        ],
    ];

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'harry_footer_bg',
        'label'       => esc_html__( 'Footer Background Image.', 'harry' ),
        'description' => esc_html__( 'Footer Background Image.', 'harry' ),
        'section'     => 'footer_setting',
    ];


    $fields[] = [
        'type'        => 'image',
        'settings'    => 'harry_footer_logo',
        'label'       => esc_html__( 'Footer Logo', 'harry' ),
        'description' => esc_html__( 'Upload Your Logo.', 'harry' ),
        'section'     => 'footer_setting',
        'default'     => get_template_directory_uri() . '/assets/img/logo/logo-black.svg',
    ];

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'harry_footer_payment',
        'label'       => esc_html__( 'Footer Payment Image.', 'harry' ),
        'description' => esc_html__( 'Footer Payment Image.', 'harry' ),
        'section'     => 'footer_setting',
        'default'     => get_template_directory_uri() . '/assets/img/footer/footer-payment.png',
    ];

    $fields[] = [
        'type'        => 'color',
        'settings'    => 'harry_footer_bg_color',
        'label'       => __( 'Footer BG Color', 'harry' ),
        'description' => esc_html__( 'This is a Footer bg color control.', 'harry' ),
        'section'     => 'footer_setting',
        'default'     => '#1D1D4D',
        'priority'    => 10,
    ];

    $fields[] = [
        'type'        => 'textarea',
        'settings'    => 'harry_footer_bottom_menu',
        'label'       => __( 'Footer Bottom Links', 'harry' ),
        'description' => esc_html__( 'Example: <a href="your-link">Link Text</a>.', 'harry' ),
        'section'     => 'footer_setting',
        'priority'    => 10,
    ];

    // footer language
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'harry_footer_bottom_language',
        'label'    => esc_html__( 'Language On/Off', 'harry' ),
        'section'  => 'footer_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'harry' ),
            'off' => esc_html__( 'Disable', 'harry' ),
        ],
    ];

    

    // social switch
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'harry_footer_social_switch',
        'label'    => esc_html__( 'Social On/Off', 'harry' ),
        'section'  => 'footer_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'harry' ),
            'off' => esc_html__( 'Disable', 'harry' ),
        ],
    ];

    // footer section social
    $fields[] = [
        'type'     => 'text',
        'settings' => 'harry_footer_fb_url',
        'label'    => esc_html__( 'Facebook Url', 'harry' ),
        'section'  => 'footer_setting',
        'default'  => esc_html__( '#', 'harry' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'harry_footer_twitter_url',
        'label'    => esc_html__( 'Twitter Url', 'harry' ),
        'section'  => 'footer_setting',
        'default'  => esc_html__( '#', 'harry' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'harry_footer_linkedin_url',
        'label'    => esc_html__( 'Linkedin Url', 'harry' ),
        'section'  => 'footer_setting',
        'default'  => esc_html__( '#', 'harry' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'harry_footer_instagram_url',
        'label'    => esc_html__( 'Instagram Url', 'harry' ),
        'section'  => 'footer_setting',
        'default'  => esc_html__( '#', 'harry' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'harry_footer_youtube_url',
        'label'    => esc_html__( 'Youtube Url', 'harry' ),
        'section'  => 'footer_setting',
        'default'  => esc_html__( '#', 'harry' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'footer_style_2_switch',
        'label'    => esc_html__( 'Footer Style 2 On/Off', 'harry' ),
        'section'  => 'footer_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'harry' ),
            'off' => esc_html__( 'Disable', 'harry' ),
        ],
    ];    

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'footer_style_3_switch',
        'label'    => esc_html__( 'Footer Style 3 On/Off', 'harry' ),
        'section'  => 'footer_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'harry' ),
            'off' => esc_html__( 'Disable', 'harry' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'footer_style_4_switch',
        'label'    => esc_html__( 'Footer Style 4 On/Off', 'harry' ),
        'section'  => 'footer_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'harry' ),
            'off' => esc_html__( 'Disable', 'harry' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'footer_style_5_switch',
        'label'    => esc_html__( 'Footer Style 5 On/Off', 'harry' ),
        'section'  => 'footer_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'harry' ),
            'off' => esc_html__( 'Disable', 'harry' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'footer_style_6_switch',
        'label'    => esc_html__( 'Footer Style 6 On/Off', 'harry' ),
        'section'  => 'footer_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'harry' ),
            'off' => esc_html__( 'Disable', 'harry' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'footer_style_7_switch',
        'label'    => esc_html__( 'Footer Style 7 On/Off', 'harry' ),
        'section'  => 'footer_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'harry' ),
            'off' => esc_html__( 'Disable', 'harry' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'footer_style_8_switch',
        'label'    => esc_html__( 'Footer Style 8 On/Off', 'harry' ),
        'section'  => 'footer_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'harry' ),
            'off' => esc_html__( 'Disable', 'harry' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'footer_style_9_switch',
        'label'    => esc_html__( 'Footer Style 9 On/Off', 'harry' ),
        'section'  => 'footer_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'harry' ),
            'off' => esc_html__( 'Disable', 'harry' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'footer_style_12_switch',
        'label'    => esc_html__( 'Footer Style 12 On/Off', 'harry' ),
        'section'  => 'footer_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'harry' ),
            'off' => esc_html__( 'Disable', 'harry' ),
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'harry_copyright',
        'label'    => esc_html__( 'Copyright', 'harry' ),
        'section'  => 'footer_setting',
        'default'  => esc_html__( 'Copyright &copy; 2023 Theme_Pure. All Rights Reserved', 'harry' ),
        'priority' => 10,
    ];
    return $fields;
}
add_filter( 'kirki/fields', '_header_footer_fields' );


function harry_event_fields( $fields ) {

    $fields[] = [
        'type'     => 'text',
        'settings' => 'harry_event_button_text',
        'label'    => esc_html__( 'Event Button text', 'harry' ),
        'section'  => 'event_setting',
        'default'  => esc_html__( 'Make an Appointment', 'harry' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'harry_event_button_url',
        'label'    => esc_html__( 'Event Url', 'harry' ),
        'section'  => 'event_setting',
        'default'  => esc_html__( '#', 'harry' ),
        'priority' => 10,
    ];

    return $fields;
}

add_filter( 'kirki/fields', 'harry_event_fields' );

// color
function harry_color_fields( $fields ) {
    // Color Settings
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'harry_color_option',
        'label'       => __( 'Theme Color', 'harry' ),
        'description' => esc_html__( 'This is a Theme color control.', 'harry' ),
        'section'     => 'color_setting',
        'default'     => '#F50963',
        'priority'    => 10,
    ];
    // Color Settings
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'harry_color_option_2',
        'label'       => __( 'Secondary Color', 'harry' ),
        'description' => esc_html__( 'This is a Primary color control.', 'harry' ),
        'section'     => 'color_setting',
        'default'     => '#008080',
        'priority'    => 10,
    ];
     // Color Settings
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'harry_color_option_3',
        'label'       => __( 'Theme Color 3', 'harry' ),
        'description' => esc_html__( 'This is a Theme color control.', 'harry' ),
        'section'     => 'color_setting',
        'default'     => '#F31E5E',
        'priority'    => 10,
    ];
     // Color Settings
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'harry_color_option_4',
        'label'       => __( 'Theme Color 4', 'harry' ),
        'description' => esc_html__( 'This is a Theme color control.', 'harry' ),
        'section'     => 'color_setting',
        'default'     => '#AB6C56',
        'priority'    => 10,
    ];
     // Color Settings
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'harry_color_option_5',
        'label'       => __( 'Theme Color 5', 'harry' ),
        'description' => esc_html__( 'This is a Theme color control.', 'harry' ),
        'section'     => 'color_setting',
        'default'     => '#4353FF',
        'priority'    => 10,
    ];
     // Color Settings
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'harry_color_option_6',
        'label'       => __( 'Theme Color 6', 'harry' ),
        'description' => esc_html__( 'This is a Theme color control.', 'harry' ),
        'section'     => 'color_setting',
        'default'     => '#3661FC',
        'priority'    => 10,
    ];
     // Color Settings
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'harry_color_option_7',
        'label'       => __( 'Theme Color 7', 'harry' ),
        'description' => esc_html__( 'This is a Theme color control.', 'harry' ),
        'section'     => 'color_setting',
        'default'     => '#2CAE76',
        'priority'    => 10,
    ];
     // Color Settings
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'harry_color_option_8',
        'label'       => __( 'Theme Color 8', 'harry' ),
        'description' => esc_html__( 'This is a Theme color control.', 'harry' ),
        'section'     => 'color_setting',
        'default'     => '#FF5A1B',
        'priority'    => 10,
    ];
     // Color Settings
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'harry_color_option_9',
        'label'       => __( 'Theme Color 9', 'harry' ),
        'description' => esc_html__( 'This is a Theme color control.', 'harry' ),
        'section'     => 'color_setting',
        'default'     => '#03041C',
        'priority'    => 10,
    ];
     // Color Settings
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'harry_color_option_10',
        'label'       => __( 'Theme Color 10', 'harry' ),
        'description' => esc_html__( 'This is a Theme color control.', 'harry' ),
        'section'     => 'color_setting',
        'default'     => '#ED212C',
        'priority'    => 10,
    ];
     // Color Settings
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'harry_color_scrollup',
        'label'       => __( 'ScrollUp Color', 'harry' ),
        'description' => esc_html__( 'This is a ScrollUp colo control.', 'harry' ),
        'section'     => 'color_setting',
        'default'     => '#03041C',
        'priority'    => 10,
    ];

     // Color Settings
    $fields[] = [
        'type'        => 'text',
        'settings'    => 'harry_color_footer_gradient',
        'label'       => __( 'Footer Gradient Color', 'harry' ),
        'description' => esc_html__( 'This is a Footer Gradient.', 'harry' ),
        'section'     => 'color_setting',
        'default'     => '',
        'priority'    => 10,
    ];

    return $fields;
}
add_filter( 'kirki/fields', 'harry_color_fields' );

// 404
function harry_404_fields( $fields ) {
    // 404 settings
    $fields[] = [
        'type'        => 'image',
        'settings'    => 'harry_404_bg',
        'label'       => esc_html__( '404 Image.', 'harry' ),
        'description' => esc_html__( '404 Image.', 'harry' ),
        'section'     => '404_page',
    ];
    $fields[] = [
        'type'     => 'text',
        'settings' => 'harry_error_title',
        'label'    => esc_html__( 'Not Found Title', 'harry' ),
        'section'  => '404_page',
        'default'  => esc_html__( 'Oops! Page not found', 'harry' ),
        'priority' => 10,
    ];
    $fields[] = [
        'type'     => 'textarea',
        'settings' => 'harry_error_desc',
        'label'    => esc_html__( '404 Description Text', 'harry' ),
        'section'  => '404_page',
        'default'  => esc_html__( 'Whoops, this is embarassing. Looks like the page you were looking for was not found.', 'harry' ),
        'priority' => 10,
    ];
    $fields[] = [
        'type'     => 'text',
        'settings' => 'harry_error_link_text',
        'label'    => esc_html__( '404 Link Text', 'harry' ),
        'section'  => '404_page',
        'default'  => esc_html__( 'Back To Home', 'harry' ),
        'priority' => 10,
    ];
    return $fields;
}
add_filter( 'kirki/fields', 'harry_404_fields' );

// course_settings
function harry_learndash_fields( $fields ) {

    $fields[] = [
        'type'     => 'number',
        'settings' => 'harry_learndash_post_number',
        'label'    => esc_html__( 'Learndash Post Per page', 'harry' ),
        'section'  => 'learndash_course_settings',
        'default'  => 6,
        'priority' => 10,
    ];

    $fields[] = [
        'type'        => 'select',
        'settings'    => 'harry_learndash_order',
        'label'       => esc_html__( 'Post Order', 'harry' ),
        'section'     => 'learndash_course_settings',
        'default'     => 'DESC',
        'placeholder' => esc_html__( 'Select an option...', 'harry' ),
        'priority'    => 10,
        'multiple'    => 1,
        'choices'     => [
            'ASC' => esc_html__( 'ASC', 'harry' ),
            'DESC' => esc_html__( 'DESC', 'harry' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'harry_learndash_related',
        'label'    => esc_html__( 'Show Related?', 'harry' ),
        'section'  => 'learndash_course_settings',
        'default'  => 1,
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'harry' ),
            'off' => esc_html__( 'Disable', 'harry' ),
        ],
    ];

    return $fields;

}

if ( class_exists( 'SFWD_LMS' ) ) {
add_filter( 'kirki/fields', 'harry_learndash_fields' );
}


// shopsettings
function harry_shop_fields( $fields ) {
    $fields[] = [
        'type' => 'toggle',
        'settings' => 'bacola_free_shipping',
        'label' => esc_attr__( 'Free shipping bar', 'harry' ),
        'section' => 'shop_sections',
        'default' => '0',
    ];     

    $fields[] = [
        'type' => 'text',
        'settings' => 'shipping_progress_bar_amount',
        'label' => esc_attr__( 'Goal Amount', 'harry' ),
        'description' => esc_attr__( 'Amount to reach 100% defined in your currency absolute value. For example: 300', 'harry' ),
        'section' => 'shop_sections',
        'default' => '100',
        'required' => array(
            array(
              'setting'  => 'bacola_free_shipping',
              'operator' => '==',
              'value'    => '1',
            ),
        ),
    ];     

    $fields[] = [
        'type' => 'toggle',
        'settings' => 'shipping_progress_bar_location_mini_cart',
        'label' => esc_attr__( 'Mini cart', 'harry' ),
        'section' => 'shop_sections',
        'default' => '0',
        'required' => array(
            array(
              'setting'  => 'bacola_free_shipping',
              'operator' => '==',
              'value'    => '1',
            ),
        ),
    ];  

    $fields[] = [
        'type' => 'toggle',
        'settings' => 'shipping_progress_bar_location_card_page',
        'label' => esc_attr__( 'Cart page', 'harry' ),
        'section' => 'shop_sections',
        'default' => '0',
        'required' => array(
            array(
              'setting'  => 'bacola_free_shipping',
              'operator' => '==',
              'value'    => '1',
            ),
        ),
    ];      

    $fields[] = [
        'type' => 'toggle',
        'settings' => 'shipping_progress_bar_location_checkout',
        'label' => esc_attr__( 'Checkout page', 'harry' ),
        'section' => 'shop_sections',
        'default' => '0',
        'required' => array(
            array(
              'setting'  => 'bacola_free_shipping',
              'operator' => '==',
              'value'    => '1',
            ),
        ),
    ];   

    $fields[] = [
        'type' => 'textarea',
        'settings' => 'shipping_progress_bar_message_initial',
        'label' => esc_attr__( 'Initial Message', 'harry' ),
        'description' => esc_attr__( 'Message to show before reaching the goal. Use shortcode [remainder] to display the amount left to reach the minimum.', 'harry' ),
        'section' => 'shop_sections',
        'default' => 'Add [remainder] to cart and get free shipping!',
        'required' => array(
            array(
              'setting'  => 'bacola_free_shipping',
              'operator' => '==',
              'value'    => '1',
            ),
        ),
    ];    

    $fields[] = [
        'type' => 'textarea',
        'settings' => 'shipping_progress_bar_message_success',
        'label' => esc_attr__( 'Success message', 'harry' ),
        'description' => esc_attr__( 'Message to show after reaching 100%.', 'harry' ),
        'section' => 'shop_sections',
        'default' => 'Your order qualifies for free shipping!',
        'required' => array(
            array(
              'setting'  => 'bacola_free_shipping',
              'operator' => '==',
              'value'    => '1',
            ),
        ),
    ];

    return $fields;
}

if (  class_exists( 'WooCommerce' ) ) {
    add_filter( 'kirki/fields', 'harry_shop_fields' );
}


/**
 * Added Fields
 */
function harry_typo_fields( $fields ) {
    // typography settings
    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_body_setting',
        'label'       => esc_html__( 'Body Font', 'harry' ),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'body',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h_setting',
        'label'       => esc_html__( 'Heading h1 Fonts', 'harry' ),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h1',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h2_setting',
        'label'       => esc_html__( 'Heading h2 Fonts', 'harry' ),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'body h2',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h3_setting',
        'label'       => esc_html__( 'Heading h3 Fonts', 'harry' ),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h3',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h4_setting',
        'label'       => esc_html__( 'Heading h4 Fonts', 'harry' ),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h4',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h5_setting',
        'label'       => esc_html__( 'Heading h5 Fonts', 'harry' ),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h5',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h6_setting',
        'label'       => esc_html__( 'Heading h6 Fonts', 'harry' ),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h6',
            ],
        ],
    ];
    return $fields;
}

add_filter( 'kirki/fields', 'harry_typo_fields' );


// course_settings
function harry_course_fields( $fields ) {

    $fields[] = [
        'type'        => 'radio-image',
        'settings'    => 'course_style',
        'label'       => esc_html__( 'Select Course Style', 'harry' ),
        'section'     => 'tutor_course_settings',
        'default'     => '5',
        'placeholder' => esc_html__( 'Select an option...', 'harry' ),
        'priority'    => 10,
        'multiple'    => 1,
        'choices'     => [
            'standard'   => get_template_directory_uri() . '/inc/img/course/course-1.jpg',
            'course_with_sidebar' => get_template_directory_uri() . '/inc/img/course/course-2.jpg',
            'course_solid'  => get_template_directory_uri() . '/inc/img/course/course-3.jpg',
        ],
        'default'     => 'standard',
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'course_search_switch',
        'label'    => esc_html__( 'Show search?', 'harry' ),
        'section'  => 'tutor_course_settings',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'harry' ),
            'off' => esc_html__( 'Disable', 'harry' ),
        ],
        'active_callback' => [
            [
                'setting'  => 'course_with_sidebar',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];    

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'course_latest_post_switch',
        'label'    => esc_html__( 'Show latest post?', 'harry' ),
        'section'  => 'tutor_course_settings',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'harry' ),
            'off' => esc_html__( 'Disable', 'harry' ),
        ],
        'active_callback' => [
            [
                'setting'  => 'course_with_sidebar',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];    

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'course_category_switch',
        'label'    => esc_html__( 'Show category filter?', 'harry' ),
        'section'  => 'tutor_course_settings',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'harry' ),
            'off' => esc_html__( 'Disable', 'harry' ),
        ],
        'active_callback' => [
            [
                'setting'  => 'course_with_sidebar',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];    

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'course_skill_switch',
        'label'    => esc_html__( 'Show skill filter?', 'harry' ),
        'section'  => 'tutor_course_settings',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'harry' ),
            'off' => esc_html__( 'Disable', 'harry' ),
        ],
        'active_callback' => [
            [
                'setting'  => 'course_with_sidebar',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];

    return $fields;

}

add_filter( 'kirki/fields', 'harry_course_fields' );




/**
 * Added Fields
 */
function harry_slug_setting( $fields ) {
    // slug settings
    $fields[] = [
        'type'     => 'text',
        'settings' => 'harry_serv_slug',
        'label'    => esc_html__( 'Services Slug', 'harry' ),
        'section'  => 'slug_setting',
        'default'  => esc_html__( 'services', 'harry' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'harry_port_slug',
        'label'    => esc_html__( 'Portfolio Slug', 'harry' ),
        'section'  => 'slug_setting',
        'default'  => esc_html__( 'portfolio', 'harry' ),
        'priority' => 10,
    ];

    return $fields;
}

add_filter( 'kirki/fields', 'harry_slug_setting' );


/**
 * This is a short hand function for getting setting value from customizer
 *
 * @param string $name
 *
 * @return bool|string
 */
function harry_THEME_option( $name ) {
    $value = '';
    if ( class_exists( 'harry' ) ) {
        $value = Kirki::get_option( harry_get_theme(), $name );
    }

    return apply_filters( 'harry_THEME_option', $value, $name );
}

/**
 * Get config ID
 *
 * @return string
 */
function harry_get_theme() {
    return 'harry';
}