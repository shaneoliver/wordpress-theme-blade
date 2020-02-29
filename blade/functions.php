<?php

use ShaneOliver\Config;
use ShaneOliver\Setup;
use ShaneOliver\Widgets;
use ShaneOliver\PostTypes;
use ShaneOliver\Admin;
use ShaneOliver\Blocks;
use ShaneOliver\Fields;

// Register Composer Autoload
if (file_exists( __DIR__ . '/vendor/autoload.php')) {
    require_once(__DIR__ . '/vendor/autoload.php');
}

// Bind configuration files to the config container
Config::bind('settings', require(__DIR__ . '/theme/config/settings.php'));
Config::bind('gutenberg', require(__DIR__ . '/theme/config/gutenberg.php'));

// Sets up theme defaults and registers support for various WordPress features.
add_action('after_setup_theme', [new Setup, 'init']);

// Register widget areas
add_action('widgets_init', [new Widgets, 'register']);
add_action('widgets_init', [new Widgets, 'unregister']);

// Enqueue scripts and styles.
add_action('wp_enqueue_scripts', function () {
	wp_enqueue_style('shaneoliver.css', get_theme_file_uri('/dist/css/shaneoliver.css'), false, null);
	wp_enqueue_style('shaneoliver/fontawesome-all.min.css', get_theme_file_uri('/dist/css/fontawesome-all.min.css'), false, null);
    wp_enqueue_style('shaneoliver/fontstack', 'https://fonts.googleapis.com/css?family=Rubik&display=swap', false, null);
    
    wp_enqueue_script('shaneoliver/popper', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js', ['jquery'], null, true);
    wp_enqueue_script('shaneoliver/bootstrap.js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js', ['jquery'], null, true);
    wp_enqueue_script('shaneoliver.js', get_theme_file_uri('/dist/js/shaneoliver.js'), ['jquery'], null, true);
});

// Register Carbon Fields blocks and fields
add_action('carbon_fields_register_fields', [new Blocks, 'register']);
add_action('carbon_fields_register_fields', [new Fields, 'register']);

// Register custom post types
add_action('init', [new PostTypes, 'register']);
add_action('after_switch_theme', [new PostTypes, 'rewrite_flush']);

// Modify the admin screens/functionality
new Admin;

/**
 * Get nav menu items by location
 *
 * @param $location The menu location id
 */
function get_nav_menu_items_by_location( $location, $args = [] ) {
    // Get all locations
    $locations = get_nav_menu_locations();
    // Get object id by location
    $object = wp_get_nav_menu_object( $locations[$location] );
    // Get menu items by menu name
    $menu_items = wp_get_nav_menu_items( $object->name, $args );
    // Return menu post objects
    return $menu_items;
}
