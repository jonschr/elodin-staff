<?php
/*
	Plugin Name: Elodin Staff
	Plugin URI: https://elod.in
	Description: Just another staff plugin
	Version: 1.0.3
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
define( 'ELODIN_STAFF', dirname( __FILE__ ) );

// Define the version of the plugin
define ( 'ELODIN_STAFF_VERSION', '1.0.3' );

// Add post types
include_once( 'lib/post_type.php' );

// Add taxonomy
include_once( 'lib/taxonomy.php' );

// Add fields
include_once( 'lib/fields.php' );

// Admin columns
include_once( 'lib/admin_columns.php' );

// Add layouts
include_once( 'layouts/staff.php' );
include_once( 'layouts/staff_grid.php' );
include_once( 'layouts/staff_simple.php' );

//* Enqueue Scripts and Styles
add_action( 'wp_enqueue_scripts', 'elodin_staff_enqueue_scripts_styles' );
function elodin_staff_enqueue_scripts_styles() {

    //* Register lity style
    wp_register_style( 'es-lity-style', plugin_dir_url( __FILE__ ) . 'lity/lity.min.css', array(), ELODIN_STAFF_VERSION, 'screen' );

    //* Register lity script
    wp_register_script( 'es-lity-script', plugin_dir_url( __FILE__ ) . 'lity/lity.min.js', array( 'jquery' ), ELODIN_STAFF_VERSION, true );

    //* Register layout styles
    wp_register_style( 'es-staff-style', plugin_dir_url( __FILE__ ) . 'css/staff-style.css', array(), ELODIN_STAFF_VERSION, 'screen' );

}

// Updater
require 'vendor/plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/jonschr/elodin-staff',
	__FILE__,
	'elodin-staff'
);

// Optional: Set the branch that contains the stable release.
$myUpdateChecker->setBranch('master');