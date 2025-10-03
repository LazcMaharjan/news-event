<?php
/**
 * News Event functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package News Event Pro
 */
use NewsEvent\CustomizerDefault as NEV;
if ( ! defined( 'NEWS_EVENT_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	$theme_info = wp_get_theme();
	define( 'NEWS_EVENT_VERSION', $theme_info->get( 'Version' ) );
}

if ( ! defined( 'NEWS_EVENT_PREFIX' ) ) {
	// Replace the prefix of theme if changed.
	define( 'NEWS_EVENT_PREFIX', 'news_event_' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function news_event_setup() {
	$nprefix = 'news-event-';
	/*
	* Make theme available for translation.
	* Translations can be filed in the /languages/ directory.
	* If you're building a theme based on News Event, use a find and replace
	* to change 'news-event-pro' to the name of your theme in all the template files.
	*/
	load_theme_textdomain( 'news-event-pro', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	* Let WordPress manage the document title.
	* By adding theme support, we declare that this theme does not use a
	* hard-coded <title> tag in the document head, and expect WordPress to
	* provide it for us.
	*/
	add_theme_support( 'title-tag' );

	/*
	* Enable support for Post Thumbnails on posts and pages.
	*
	* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	*/
	add_theme_support( 'post-thumbnails' );

	// add_image_size( 'news-event-large', 1400, 800, true );
	add_image_size( $nprefix . 'featured', 1020, 700, true );
	add_image_size( $nprefix . 'list', 600, 400, true );
	add_image_size( $nprefix . 'thumb', 300, 200, true );
	add_image_size( $nprefix . 'small', 150, 95, true );
	add_image_size( $nprefix . 'grid', 400, 250, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Top Header', 'news-event-pro' ),
			'menu-2' => esc_html__( 'Main Header', 'news-event-pro' ),
			'menu-3' => esc_html__( 'Bottom Footer', 'news-event-pro' )
		)
	);

	/*
	* Switch default core markup for search form, comment form, and comments
	* to output valid HTML5.
	*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			NEWS_EVENT_VERSION . 'custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 100,
			'width'       => 100,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'news_event_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function news_event_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'news_event_content_width', 640 );
}
add_action( 'after_setup_theme', 'news_event_content_width', 0 );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

add_filter( 'get_the_archive_title_prefix', 'news_event_prefix_string' );
function news_event_prefix_string($prefix) {
	$archive_page_title_prefix = NEV\news_event_get_customizer_option( 'archive_page_title_prefix' );
	if( $archive_page_title_prefix ) return apply_filters( 'news_event_archive_page_title_prefix', $prefix );
	return apply_filters( 'news_event_archive_page_title_prefix', false );
}

if ( ! function_exists( 'nep_fs' ) ) {
    // Create a helper function for easy SDK access.
    function nep_fs() {
        global $nep_fs;

        if ( ! isset( $nep_fs ) ) {
            // Include Freemius SDK.
            require_once dirname( __FILE__ ) . '/vendor/freemius/start.php';
            $nep_fs = fs_dynamic_init( array(
                'id'                  => '20010',
                'slug'                => 'news-event-pro',
                'premium_slug'        => 'news-event-pro',
                'type'                => 'theme',
                'public_key'          => 'pk_6587c9c93d55f8a61ad5d41fce411',
                'is_premium'          => true,
                'premium_suffix'      => '',
                // If your theme is a serviceware, set this option to false.
                'has_premium_version' => true,
                'has_addons'          => false,
                'has_paid_plans'      => true,
                'menu'                => array(
                    'slug'           => 'news-event-info',
                    'support'        => false,
                ),
            ) );
        }

        return $nep_fs;
    }

    // Init Freemius.
    nep_fs();
    // Signal that SDK was initiated.
    do_action( 'nep_fs_loaded' );
}