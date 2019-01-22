<?php

add_action( 'init', 'elodin_staff_create_taxonomy', 0 );

// create two taxonomies, genres and writers for the post type "book"
function elodin_staff_create_taxonomy() {

	// Add new taxonomy, NOT hierarchical (like tags)
	$labels = array(
		'name'                       => _x( 'Staff Categories', 'Staff Categories', 'elodin-staff' ),
		'singular_name'              => _x( 'Staff Category', 'Staff Category', 'elodin-staff' ),
		'search_items'               => __( 'Search categories', 'elodin-staff' ),
		'popular_items'              => __( 'Popular categories', 'elodin-staff' ),
		'all_items'                  => __( 'All categories', 'elodin-staff' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Category', 'elodin-staff' ),
		'update_item'                => __( 'Update Category', 'elodin-staff' ),
		'add_new_item'               => __( 'Add New Category', 'elodin-staff' ),
		'new_item_name'              => __( 'New Category Name', 'elodin-staff' ),
		'separate_items_with_commas' => __( 'Separate staff categories with commas', 'elodin-staff' ),
		'add_or_remove_items'        => __( 'Add or remove staff categories', 'elodin-staff' ),
		'choose_from_most_used'      => __( 'Choose from the most used staff categories', 'elodin-staff' ),
		'not_found'                  => __( 'No staff categories found.', 'elodin-staff' ),
		'menu_name'                  => __( 'Categories', 'elodin-staff' ),
	);

	$args = array(
		'hierarchical'          => true,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'staff-category' ),
	);

	register_taxonomy( 'staffcategories', 'staff', $args );
}
