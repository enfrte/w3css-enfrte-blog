<?php
/**
 * w3css-enfrte-blog functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package w3css-enfrte-blog
 */

if ( ! function_exists( 'a_simple_blog_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function a_simple_blog_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on w3css-enfrte-blog, use a find and replace
	 * to change 'a-simple-blog' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'a-simple-blog', get_template_directory() . '/languages' );

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

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'a-simple-blog' ),
	) );

	/*
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

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'a_simple_blog_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'a_simple_blog_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function a_simple_blog_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'a_simple_blog_content_width', 640 );
}
add_action( 'after_setup_theme', 'a_simple_blog_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function a_simple_blog_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'a-simple-blog' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'a-simple-blog' ),
		'before_widget' => '<section id="%1$s" class="w3-card-4 w3-margin w3-white widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="w3-container w3-padding w3-light-grey"><h4 class="widget-title">',
		'after_title'   => '</h4></div>',
	) );
}
add_action( 'widgets_init', 'a_simple_blog_widgets_init' );

/**
 * Modify The Read More Link Text
 */
function modify_read_more_link() {
	return '<span class="more-link">&nbsp;<a class="w3-tag w3-light-grey w3-hover-black" href="' . esc_url( get_permalink() ) . '">'. __( '. . . continued &rarr;', 'a-simple-blog') . '</a></span>';
}
add_filter( 'the_content_more_link', 'modify_read_more_link' );

/**
 * Enqueue scripts and styles.
 */
function a_simple_blog_scripts() {
	// styles
	wp_enqueue_style( 'a-simple-blog-w3', get_template_directory_uri() . '/css/w3.css',false,'2.98','all'); // see https://developer.wordpress.org/themes/basics/including-css-javascript/
	wp_enqueue_style( 'a-simple-blog-css', get_template_directory_uri() . '/css/fonts.css',false,'','all'); // see https://developer.wordpress.org/themes/basics/including-css-javascript/
	//wp_enqueue_style( 'a-simple-blog-fontawesome', get_template_directory_uri() . '/css/font-awesome.min.css',false,'4.7.0','all'); // see https://developer.wordpress.org/themes/basics/including-css-javascript/
	wp_enqueue_style( 'a-simple-blog-style', get_stylesheet_uri() ); // style.css
	// scripts
	wp_enqueue_script( 'a-simple-blog-w3css-injection', get_template_directory_uri() . '/js/w3css-injection.js', array('jquery'), '' );
	wp_enqueue_script( 'a-simple-blog-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'a-simple-blog-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'a_simple_blog_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

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

/**
 * Load Theme's custom widgets.
 */
require get_template_directory() . '/custom-widgets/about-widget.php';
require get_template_directory() . '/custom-widgets/popular-posts-functions.php';
require get_template_directory() . '/custom-widgets/popular-posts-widget.php';
