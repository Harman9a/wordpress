<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Contact_IconBox extends Widget_Base {

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
		return 'to-contact-iconbox';
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
		return __( 'Contact Icon Box', 'tpcore' );
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

    protected static function get_profile_names()
    {
        return [
            'apple' => esc_html__('Apple', 'tpcore'),
            'behance' => esc_html__('Behance', 'tpcore'),
            'bitbucket' => esc_html__('BitBucket', 'tpcore'),
            'codepen' => esc_html__('CodePen', 'tpcore'),
            'delicious' => esc_html__('Delicious', 'tpcore'),
            'deviantart' => esc_html__('DeviantArt', 'tpcore'),
            'digg' => esc_html__('Digg', 'tpcore'),
            'dribbble' => esc_html__('Dribbble', 'tpcore'),
            'email' => esc_html__('Email', 'tpcore'),
            'facebook' => esc_html__('Facebook', 'tpcore'),
            'flickr' => esc_html__('Flicker', 'tpcore'),
            'foursquare' => esc_html__('FourSquare', 'tpcore'),
            'github' => esc_html__('Github', 'tpcore'),
            'houzz' => esc_html__('Houzz', 'tpcore'),
            'instagram' => esc_html__('Instagram', 'tpcore'),
            'jsfiddle' => esc_html__('JS Fiddle', 'tpcore'),
            'linkedin' => esc_html__('LinkedIn', 'tpcore'),
            'medium' => esc_html__('Medium', 'tpcore'),
            'pinterest' => esc_html__('Pinterest', 'tpcore'),
            'product-hunt' => esc_html__('Product Hunt', 'tpcore'),
            'reddit' => esc_html__('Reddit', 'tpcore'),
            'slideshare' => esc_html__('Slide Share', 'tpcore'),
            'snapchat' => esc_html__('Snapchat', 'tpcore'),
            'soundcloud' => esc_html__('SoundCloud', 'tpcore'),
            'spotify' => esc_html__('Spotify', 'tpcore'),
            'stack-overflow' => esc_html__('StackOverflow', 'tpcore'),
            'tripadvisor' => esc_html__('TripAdvisor', 'tpcore'),
            'tumblr' => esc_html__('Tumblr', 'tpcore'),
            'twitch' => esc_html__('Twitch', 'tpcore'),
            'twitter' => esc_html__('Twitter', 'tpcore'),
            'vimeo' => esc_html__('Vimeo', 'tpcore'),
            'vk' => esc_html__('VK', 'tpcore'),
            'website' => esc_html__('Website', 'tpcore'),
            'whatsapp' => esc_html__('WhatsApp', 'tpcore'),
            'wordpress' => esc_html__('WordPress', 'tpcore'),
            'xing' => esc_html__('Xing', 'tpcore'),
            'yelp' => esc_html__('Yelp', 'tpcore'),
            'youtube' => esc_html__('YouTube', 'tpcore'),
        ];
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

        $this->end_controls_section();

		$this->start_controls_section(
            'tp_icon_box',
            [
                'label' => esc_html__('Icon Box', 'tpcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'tp_bg_image',
            [
                'label' => esc_html__('BG Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
								'condition' => [
                    'tp_bg_image' => 'layout-1'
                ]
            ]
        );

        $this->add_control(
            'tp_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'image' => esc_html__('Image', 'tpcore'),
                    'icon' => esc_html__('Icon', 'tpcore'),
                    'svg' => esc_html__('SVG', 'tpcore'),
                ],
            ]
        );

        $this->add_control(
            'tp_icon_box_image',
            [
                'label' => esc_html__('Upload Icon Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_icon_type' => 'image'
                ]

            ]
        );

		$this->add_control(
			'tp_icon_box_svg',
			[
					'show_label' => false,
					'type' => Controls_Manager::TEXTAREA,
					'label_block' => true,
					'placeholder' => esc_html__('SVG Code Here', 'tpcore'),
					'condition' => [
							'tp_icon_type' => 'svg'
					]
			]
		);

        if (tp_is_elementor_version('<', '2.6.0')) {
            $this->add_control(
                'tp_icon_box_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'tp_icon_type' => 'icon'
                    ]
                ]
            );
        } else {
            $this->add_control(
                'tp_icon_box_selected_icon',
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
                        'tp_icon_type' => 'icon'
                    ]
                ]
            );
        }

        $this->add_control(
            'tp_icon_box_title', [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Icon Box Title', 'tpcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tp_icon_box_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('location@website.com', 'tpcore'),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

		$this->start_controls_section(
            '_section_social',
            [
                'label' => esc_html__('Social Profiles', 'tpcore'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'name',
            [
                'label' => esc_html__('Profile Name', 'tpcore'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'select2options' => [
                    'allowClear' => false,
                ],
                'options' => self::get_profile_names()
            ]
        );

        $repeater->add_control(
            'link', [
                'label' => esc_html__('Profile Link', 'tpcore'),
                'placeholder' => esc_html__('Add your profile link', 'tpcore'),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'autocomplete' => false,
                'show_external' => false,
                'condition' => [
                    'name!' => 'email'
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );
        $this->add_control(
            'profiles',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(name.slice(0,1).toUpperCase() + name.slice(1)) #>',
                'default' => [
                    [
                        'link' => ['url' => 'https://facebook.com/'],
                        'name' => 'facebook'
                    ],
                    [
                        'link' => ['url' => 'https://linkedin.com/'],
                        'name' => 'linkedin'
                    ],
                    [
                        'link' => ['url' => 'https://twitter.com/'],
                        'name' => 'twitter'
                    ]
                ],
            ]
        );

        $this->add_control(
            'show_profiles',
            [
                'label' => esc_html__('Show Profiles', 'tpcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'tpcore'),
                'label_off' => esc_html__('Hide', 'tpcore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
                'style_transfer' => true,
            ]
        );


        $this->end_controls_section();
	}

    protected function style_tab_content(){
        $this->tp_section_style_controls('comint_section', 'Section - Style', '.tp-el-section');

		$this->tp_icon_style('section_icon', 'Contact - Icon', '.tp-el-box-icon span');
		$this->tp_basic_style_controls('section_title', 'Contact - Title', '.tp-el-box-title');
		$this->tp_basic_style_controls('section_desc', 'Contact - Description', '.tp-el-box-desc');
        $this->tp_link_controls_style('coming_time_social', 'Coming - Social', '.tp-el-box-social a');

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
            $this->add_render_attribute('title_args', 'class', 'research__title');
        ?>

        <div class="research__item research__item-border text-center mb-30 transition-3">
            <div class="research__thumb mb-35">
                <?php if($settings['tp_icon_type'] !== 'image') : ?>
                <?php if (!empty($settings['tp_icon']) || !empty($settings['tp_selected_icon']['value'])) : ?>
                    <div class="tp-icon">
                        <?php tp_render_icon($settings, 'tp_icon', 'tp_selected_icon'); ?>
                    </div>
                <?php endif; ?>
                <?php else : ?>
                    <div class="icon">
                        <?php echo Group_Control_Image_Size::get_attachment_image_html($settings, 'full', 'tp_icon_image'); ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="research__content">
                <?php
                if ( !empty($settings['tp_title' ]) ) :
                    printf( '<%1$s %2$s>%3$s</%1$s>',
                        tag_escape( $settings['tp_title_tag'] ),
                        $this->get_render_attribute_string( 'title_args' ),
                        tp_kses( $settings['tp_title' ] )
                        );
                endif;
                ?>
                <?php if ( !empty($settings['tp_desctiption']) ) : ?>
                <p><?php echo tp_kses( $settings['tp_desctiption'] ); ?></p>
                <?php endif; ?>
            </div>
        </div>

		<?php else:


		?>

	     <div class="contact__item text-center mb-30 transition-3 white-bg tp-el-section">
	        <div class="contact__icon tp-el-box-icon">
				 <?php if($settings['tp_icon_type'] == 'icon') : ?>
					 <?php if (!empty($settings['tp_icon_box_icon']) || !empty($settings['tp_icon_box_selected_icon']['value'])) : ?>
						<span><?php tp_render_icon($settings, 'tp_icon_box_icon', 'tp_icon_box_selected_icon'); ?></span>
					 <?php endif; ?>
				 <?php elseif( $settings['tp_icon_type'] == 'image' ) : ?>
					 <span>
						 <?php if (!empty($settings['tp_icon_box_image']['url'])): ?>
						 <img class="light" src="<?php echo $settings['tp_icon_box_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($settings['tp_icon_box_image']['url']), '_wp_attachment_image_alt', true); ?>">
						 <?php endif; ?>
					 </span>
				 <?php else : ?>
					 <span>
						 <?php if (!empty($settings['tp_icon_box_svg'])): ?>
						 <?php echo $settings['tp_icon_box_svg']; ?>
						 <?php endif; ?>
					 </span>
				 <?php endif; ?>
	        </div>
	        <div class="contact__content">
	        	<?php if (!empty($settings['tp_icon_box_title' ])): ?>
	            <span class="contact-item-subtitle tp-el-box-title"><?php echo tp_kses($settings['tp_icon_box_title' ]); ?></span>
	            <?php endif; ?>

				<?php if (!empty($settings['tp_icon_box_description' ])): ?>
				<p class="tp-el-box-desc"><?php echo tp_kses($settings['tp_icon_box_description']); ?></p>
				<?php endif; ?>

                <?php if ($settings['show_profiles'] && is_array($settings['profiles'])) : ?>
                <div class="contact__social tp-el-box-social">
                    <ul>
                        <?php
                        foreach ($settings['profiles'] as $profile) :
                            $icon = $profile['name'];
                            $url = esc_url($profile['link']['url']);
                            printf('<a target="_blank" rel="noopener"  href="%s" class="elementor-repeater-item-%s"><i class="fab fa-%s" aria-hidden="true"></i></a>',
                                $url,
                                esc_attr($profile['_id']),
                                esc_attr($icon)
                            );
                        endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>
	        </div>
	     </div>

        <?php endif; ?>

        <?php
	}
}

$widgets_manager->register( new TP_Contact_IconBox() );
