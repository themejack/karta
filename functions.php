<?php
/**
 * Karta functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Karta
 */

// Exclude Easy Forms for MailChimp by Yikes plugin styles.
if ( ! defined( 'YIKES_MAILCHIMP_EXCLUDE_STYLES' ) ) {
	define( 'YIKES_MAILCHIMP_EXCLUDE_STYLES', true );
}

// Exclude Contact Form 7 plugin styles.
add_filter( 'wpcf7_load_css', '__return_false' );

if ( ! function_exists( 'karta_setup' ) ) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function karta_setup() {

		/**
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on karta, use a find and replace
		 * to change 'karta' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'karta', get_template_directory() . '/languages' );

		/**
		 * Add default posts and comments RSS feed links to head.
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/**
		 * Add custom image sizes.
		 */
		add_image_size( 'karta-grid-3', 351, 9999 );
		add_image_size( 'karta-grid-2', 460, 9999 );

		/**
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		/**
		 * This theme uses wp_nav_menu() in one location.
		 */
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'karta' ),
		) );

		/**
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/**
		 * Enable support for Post Formats.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/post-formats/
		 */
		add_theme_support( 'post-formats', array(
			'link',
		) );

		/**
		 * Enable support for Custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 200,
			'width'       => 200,
			'flex-height' => true,
			'flex-width'  => true,
			'header-text' => array( 'site-description' ),
		) );

		// Add editor style.
		add_editor_style( array( get_template_directory_uri() . '/admin/css/karta-editor.css' , '//fonts.googleapis.com/css?family=Work+Sans:400,500,600,700,800' ) ) ;
	}
endif;
add_action( 'after_setup_theme', 'karta_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function karta_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'karta_content_width', 550 );
}
add_action( 'after_setup_theme', 'karta_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function karta_widgets_init() {
	/**
	 * Footer sidebar.
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'karta' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Add footer widgets here.', 'karta' ),
		'before_widget' => '<div class="col-xs-12 col-sm-4"><section id="%1$s" class="site-footer-widget %2$s">',
		'after_widget'  => '</section></div>',
		'before_title'  => '<h3 class="site-footer-widget__title">',
		'after_title'   => '</h3>',
	) );

	/**
	 * Modals sidebar.
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'Modals', 'karta' ),
		'id'            => 'modals-1',
		'description'   => esc_html__( 'Add modals here.', 'karta' ),
		'before_widget' => '<div class="modal modal--widget"><div class="modal__close"><a href="#">X</a></div><div class="modal__content"><div class="modal__widget widget-%2$s" id="%1$s"">',
		'after_widget'  => '</div></div></div>',
		'before_title'  => '<div data-modal-id="',
		'after_title'   => '"></div>',
	) );
}
add_action( 'widgets_init', 'karta_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function karta_scripts() {
	wp_enqueue_style( 'karta-fonts', '//fonts.googleapis.com/css?family=Work+Sans:400,500,600,700,800' );

	wp_enqueue_style( 'karta-style', get_template_directory_uri() . '/css/style.css', array( 'karta-fonts' ) );

	wp_enqueue_script( 'karta-vendors', get_template_directory_uri() . '/js/vendors.js', array( 'jquery', 'jquery-masonry' ), '20160411', true );
	wp_enqueue_script( 'karta-scripts', get_template_directory_uri() . '/js/scripts.js', array( 'karta-vendors' ), '20160411', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'karta_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
