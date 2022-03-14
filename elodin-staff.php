<?php
/*
	Plugin Name: Elodin Staff
	Plugin URI: https://elod.in
	Description: Just another staff plugin
	Version: 1.4
    Author: Jon Schroeder
    Author URI: https://elod.in

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
    GNU General Public License for more details.
*/


/* Prevent direct access to the plugin */
if ( !defined( 'ABSPATH' ) ) {
    die( "Sorry, you are not allowed to access this page directly." );
}

// Plugin directory
define( 'ELODIN_STAFF_DIR', plugin_dir_path( __FILE__ ) );
define( 'ELODIN_STAFF_PATH', plugin_dir_url( __FILE__ ) );

// Define the version of the plugin
define ( 'ELODIN_STAFF_VERSION', '1.4' );

// Add post types
include_once( 'lib/post_type.php' );

// Add taxonomy
include_once( 'lib/taxonomy.php' );

// Add documentation link
include_once( 'lib/documentation-link.php' );

// Add fields
// include_once( 'lib/fields.php' );

// Add layouts
include_once( 'layouts/staff.php' );
include_once( 'layouts/staff_content.php' );
include_once( 'layouts/staff_grid.php' );
include_once( 'layouts/staff_simple.php' );

//* Enqueue Scripts and Styles
add_action( 'wp_enqueue_scripts', 'elodin_staff_enqueue_scripts_styles' );
function elodin_staff_enqueue_scripts_styles() {

    //* Register layout styles
    wp_register_style( 'es-staff-style', plugin_dir_url( __FILE__ ) . 'css/staff-style.css', array(), ELODIN_STAFF_VERSION, 'screen' );
    
    //* Fancybox
    wp_register_style( 'elodin-staff-fancybox-theme', plugin_dir_url( __FILE__ ) . '/vendor/fancybox/dist/fancybox.css', array(), ELODIN_STAFF_VERSION, 'screen' );
    wp_register_script( 'elodin-staff-fancybox-main', plugin_dir_url( __FILE__ ) . '/vendor/fancybox/dist/fancybox.umd.js', array( 'jquery' ), ELODIN_STAFF_VERSION, true );
    // wp_register_script( 'elodin-staff-fancybox-init', plugin_dir_url( __FILE__ ) . '/vendor/js/fancybox-init.js', array( 'fancybox-main' ), ELODIN_STAFF_VERSION, true );

}

/////////////////
// INCLUDE ACF //
/////////////////

// Define path and URL to the ACF plugin.
define( 'ELODIN_STAFF_ACF_PATH', plugin_dir_path( __FILE__ ) . 'vendor/acf/' );
define( 'ELODIN_STAFF_ACF_URL', plugin_dir_url( __FILE__ ) . 'vendor/acf/' );

if( !class_exists('ACF') ) {
    
    // Include the ACF plugin.
    include_once( ELODIN_STAFF_ACF_PATH . 'acf.php' );
    
    // Customize the url setting to fix incorrect asset URLs.
    add_filter('acf/settings/url', 'elodin_staff_acf_settings_url');
    
}

function elodin_staff_acf_settings_url( $url ) {
    return ELODIN_STAFF_ACF_URL;
}

//! UNCOMMENT THIS FILTER TO SAVE ACF FIELDS TO PLUGIN
// add_filter('acf/settings/save_json', 'elodin_staff_acf_json_save_point');
function elodin_staff_acf_json_save_point( $path ) {
    
    // update path
    $path = ELODIN_STAFF_DIR . 'acf-json';
    
    // return
    return $path;
    
}

add_filter( 'acf/settings/load_json', 'elodin_staff_acf_json_load_point' );
function elodin_staff_acf_json_load_point( $paths ) {
    
    // remove original path (optional)
    unset($paths[0]);
    
    // append path
    $paths[] = ELODIN_STAFF_DIR . 'acf-json';
    
    // return
    return $paths;
    
}

///////////////////////
// ADMIN COLUMNS PRO //
///////////////////////

// add_filter( 'acp/storage/file/directory/writable', '__return_false' ); //* CHANGE TO __return_true TO MAKE CHANGES
// add_filter( 'acp/storage/file/directory', 'elodin_staff_acp_storage_file_directory' );
// function elodin_staff_acp_storage_file_directory( $path ) {
// 	// Use a writable path, directory will be created for you
//     return ELODIN_STAFF_DIR . '/acp-settings';
// }

use AC\ListScreenRepository\Storage\ListScreenRepositoryFactory;
use AC\ListScreenRepository\Rules;
use AC\ListScreenRepository\Rule;
add_filter( 'acp/storage/repositories', function( array $repositories, ListScreenRepositoryFactory $factory ) {
    
    //! Change $writable to true to allow changes to columns for the content types below
    $writable = false;
    
    // Add rules to target individual list tables.
    // Defaults to Rules::MATCH_ANY added here for clarity, other option is Rules::MATCH_ALL
    $rules = new Rules( Rules::MATCH_ANY );
    $rules->add_rule( new Rule\EqualType( 'staff' ) );
    
    // Register your repository to the stack
    $repositories['elodin-staff'] = $factory->create(
        ELODIN_STAFF_DIR . '/acp-settings',
        $writable,
        $rules
    );
    
    return $repositories;
    
}, 10, 2 );

////////////////////
// PLUGIN UPDATER //
////////////////////

require 'vendor/plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/jonschr/elodin-staff',
	__FILE__,
	'elodin-staff'
);

// Optional: Set the branch that contains the stable release.
$myUpdateChecker->setBranch('master');