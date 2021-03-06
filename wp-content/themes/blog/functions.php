<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

<?php
/**
 * blog functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package blog
 */

if ( ! function_exists( 'blog_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function blog_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on blog, use a find and replace
	 * to change 'blog' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'blog', get_template_directory() . '/languages' );

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
		'primary' => esc_html__( 'Primary', 'blog' ),
		'footer' => esc_html__( 'Footer', 'blog' ),
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

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'blog_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'blog_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function blog_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'blog_content_width', 640 );
}
add_action( 'after_setup_theme', 'blog_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function blog_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'blog' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'blog_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function blog_scripts() {
	wp_enqueue_style( 'blog-style', get_stylesheet_uri() );

	wp_enqueue_script( 'blog-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'blog-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'blog_scripts' );

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


//Pagination
function classic_pagination(){
	$pagination = get_the_posts_pagination( array(
		'mid_size' => 2,
		'prev_text' => __( '<span class="fa fa-chevron-left"></span>', 'textdomain' ),
		'next_text' => __( '<span class="fa fa-chevron-right"></span>', 'textdomain' ),
		'screen_reader_text' => __( ' ', 'textdomain' ),
	) );
	echo $pagination;
}


function mytheme_customize_register( $wp_customize ) {
    //Facebook
	$wp_customize->add_setting( 'social_links_facebook' , array(
    'default'     => '',
    'transport'   => 'refresh',
	) );

	$wp_customize->add_section( 'lucidlms_geekhub_social_links' , array(
    'title'      => __( 'Social links by Geekhub', 'lucidlms-child' ),
    'priority'   => 30,
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_links_facebook', array(
	'label'        => __( 'Facebook', 'mytheme' ),
	'section'    => 'lucidlms_geekhub_social_links',
	'settings'   => 'social_links_facebook',
	) ) );

	//Twitter
	$wp_customize->add_setting( 'social_links_twitter' , array(
    'default'     => '',
    'transport'   => 'refresh',
	) );

	$wp_customize->add_section( 'lucidlms_geekhub_social_links' , array(
    'title'      => __( 'Social links by Geekhub', 'lucidlms-child' ),
    'priority'   => 30,
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_links_twitter', array(
	'label'        => __( 'Twitter', 'mytheme' ),
	'section'    => 'lucidlms_geekhub_social_links',
	'settings'   => 'social_links_twitter',
	) ) );

	//Pinterest
	$wp_customize->add_setting( 'social_links_pinterest' , array(
    'default'     => '',
    'transport'   => 'refresh',
	) );

	$wp_customize->add_section( 'lucidlms_geekhub_social_links' , array(
    'title'      => __( 'Social links by Geekhub', 'lucidlms-child' ),
    'priority'   => 30,
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_links_pinterest', array(
	'label'        => __( 'Pinterest', 'mytheme' ),
	'section'    => 'lucidlms_geekhub_social_links',
	'settings'   => 'social_links_pinterest',
	) ) );

	//Google Plus
	$wp_customize->add_setting( 'social_links_google_plus' , array(
    'default'     => '',
    'transport'   => 'refresh',
	) );

	$wp_customize->add_section( 'lucidlms_geekhub_social_links' , array(
    'title'      => __( 'Social links by Geekhub', 'lucidlms-child' ),
    'priority'   => 30,
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_links_google_plus', array(
	'label'        => __( 'Google Plus', 'mytheme' ),
	'section'    => 'lucidlms_geekhub_social_links',
	'settings'   => 'social_links_google_plus',
	) ) );

}
add_action( 'customize_register', 'mytheme_customize_register' );