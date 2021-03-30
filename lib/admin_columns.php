<?php

// /**
//  * Automatically set things up if Admin Colums Pro is installed
//  */
// function ac_custom_column_settings_ef7f87bf() {

// 	ac_register_columns( 'staff', array(
// 		array(
// 			'columns' => array(
// 				'5bda06f02ddfb' => array(
// 					'type' => 'column-featured_image',
// 					'label' => 'Image',
// 					'width' => '100',
// 					'width_unit' => 'px',
// 					'featured_image_display' => 'image',
// 					'image_size' => 'cpac-custom',
// 					'image_size_w' => '80',
// 					'image_size_h' => '80',
// 					'edit' => 'on',
// 					'sort' => 'on',
// 					'filter' => 'off',
// 					'filter_label' => '',
// 					'name' => '5bda06f02ddfb',
// 					'label_type' => '',
// 					'bulk-editing' => '',
// 					'export' => '',
// 					'search' => ''
// 				),
// 				'title' => array(
// 					'type' => 'title',
// 					'label' => 'Name',
// 					'width' => '',
// 					'width_unit' => '%',
// 					'edit' => 'on',
// 					'sort' => 'on',
// 					'name' => 'title',
// 					'label_type' => '',
// 					'bulk-editing' => '',
// 					'export' => '',
// 					'search' => ''
// 				),
// 				'5bda068e20ed2' => array(
// 					'type' => 'column-acf_field',
// 					'label' => 'Job title',
// 					'width' => '',
// 					'width_unit' => '%',
// 					'field' => 'field_5a8753261bc62',
// 					'character_limit' => '20',
// 					'edit' => 'on',
// 					'sort' => 'off',
// 					'filter' => 'off',
// 					'filter_label' => '',
// 					'name' => '5bda068e20ed2',
// 					'label_type' => '',
// 					'bulk-editing' => '',
// 					'export' => '',
// 					'search' => ''
// 				),
// 				'5c4791185d6aa' => array(
// 					'type' => 'column-taxonomy',
// 					'label' => 'Categories',
// 					'width' => '',
// 					'width_unit' => '%',
// 					'taxonomy' => 'staffcategories',
// 					'number_of_items' => '10',
// 					'edit' => 'on',
// 					'enable_term_creation' => 'off',
// 					'sort' => 'on',
// 					'filter' => 'on',
// 					'filter_label' => '',
// 					'name' => '5c4791185d6aa',
// 					'label_type' => '',
// 					'export' => '',
// 					'search' => ''
// 				),
// 				'5bda068e1d073' => array(
// 					'type' => 'column-excerpt',
// 					'label' => 'Excerpt',
// 					'width' => '',
// 					'width_unit' => '%',
// 					'excerpt_length' => '5',
// 					'before' => '',
// 					'after' => '',
// 					'edit' => 'on',
// 					'sort' => 'off',
// 					'filter' => 'off',
// 					'filter_label' => '',
// 					'name' => '5bda068e1d073',
// 					'label_type' => '',
// 					'bulk-editing' => '',
// 					'export' => '',
// 					'search' => ''
// 				),
// 				'5bda068e1ec03' => array(
// 					'type' => 'column-content',
// 					'label' => 'Content',
// 					'width' => '',
// 					'width_unit' => '%',
// 					'string_limit' => 'word_limit',
// 					'excerpt_length' => '5',
// 					'before' => '',
// 					'after' => '',
// 					'edit' => 'on',
// 					'sort' => 'off',
// 					'filter' => 'off',
// 					'filter_label' => '',
// 					'name' => '5bda068e1ec03',
// 					'label_type' => '',
// 					'bulk-editing' => '',
// 					'export' => '',
// 					'search' => ''
// 				),
// 				'5bda068e1f72b' => array(
// 					'type' => 'column-acf_field',
// 					'label' => 'Email address',
// 					'width' => '',
// 					'width_unit' => '%',
// 					'field' => 'field_5a8753401bc64',
// 					'edit' => 'on',
// 					'sort' => 'on',
// 					'filter' => 'off',
// 					'filter_label' => '',
// 					'name' => '5bda068e1f72b',
// 					'label_type' => '',
// 					'bulk-editing' => '',
// 					'export' => '',
// 					'search' => ''
// 				),
// 				'5bda068e21690' => array(
// 					'type' => 'column-acf_field',
// 					'label' => 'Phone number',
// 					'width' => '',
// 					'width_unit' => '%',
// 					'field' => 'field_5a8753321bc63',
// 					'character_limit' => '20',
// 					'edit' => 'on',
// 					'sort' => 'on',
// 					'filter' => 'off',
// 					'filter_label' => '',
// 					'name' => '5bda068e21690',
// 					'label_type' => '',
// 					'bulk-editing' => '',
// 					'export' => '',
// 					'search' => ''
// 				),
// 				'5d767eb1148c0' => array(
// 					'type' => 'column-acf_field',
// 					'label' => 'LinkedIn URL',
// 					'width' => '',
// 					'width_unit' => '%',
// 					'field' => 'field_5a8753401bc64ab',
// 					'edit' => 'on',
// 					'sort' => 'on',
// 					'filter' => 'off',
// 					'filter_label' => '',
// 					'name' => '5d767eb1148c0',
// 					'label_type' => '',
// 					'bulk-editing' => '',
// 					'export' => '',
// 					'search' => ''
// 				)
// 			),
// 			'layout' => array(
// 				'id' => '5d767e8822e9e',
// 				'name' => 'Test',
// 				'roles' => false,
// 				'users' => false,
// 				'read_only' => false
// 			)
			
// 		)
// 	) );
// }
// add_action( 'ac/ready', 'ac_custom_column_settings_ef7f87bf' );