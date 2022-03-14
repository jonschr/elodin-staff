<?php

function staff_custom_excerpt_length( $length ) {
	
	// Bail if it's not staff
	if ( get_post_type() != 'staff' )
		return $length;

    return 20;
}

//* Output the scripts for the leadership section
add_action( 'before_loop_layout_staff', 'elodin_staff_layout_scripts' );
function elodin_staff_layout_scripts( $args ) {
	    
    //* Add the main styles
	wp_enqueue_style( 'es-staff-style' );

	//* Enqueue the fancybox scripts
	wp_enqueue_style( 'elodin-staff-fancybox-theme' );
    wp_enqueue_script( 'elodin-staff-fancybox-main' );

	add_filter( 'excerpt_length', 'staff_custom_excerpt_length', 999 );
}

//* Output the leadership markup for each item
add_action( 'add_loop_layout_staff', 'elodin_staff_layout' );
function elodin_staff_layout() {
	
	//* Add the main styles
	wp_enqueue_style( 'es-staff-style' );

	//* Enqueue the fancybox scripts
	wp_enqueue_style( 'elodin-staff-fancybox-theme' );
    wp_enqueue_script( 'elodin-staff-fancybox-main' );

	$jobtitle = esc_html( get_post_meta( get_the_ID(), 'job_title', true ) );
	$content = apply_filters( 'the_content', wp_kses_post( get_the_content() ) ); // note: when we output this, we're applying the filters again. That's intentional because Gutenberg is removing that filter once, and it manifests in breaking the first loop through the_content.
	$title = esc_html( get_the_title() );
	$email = esc_html( get_post_meta( get_the_ID(), 'email_address', true ) );
	$phone = esc_html( get_post_meta( get_the_ID(), 'phone_number', true ) );
	$linkedin = esc_url( get_post_meta( get_the_ID(), 'linkedin', true ) );
	$twitter = esc_url( get_post_meta( get_the_ID(), 'twitter', true ) );
	$facebook = esc_url( get_post_meta( get_the_ID(), 'facebook', true ) );
	$slug = esc_html( get_post_field( 'post_name', get_post() ) );

	if ( has_post_thumbnail() ) 
		printf( '<div class="left"><div class="featured-image" style="background-image:url( %s )"></div></div>', get_the_post_thumbnail_url( get_the_ID(), 'large' ) );

	echo '<div class="right">';

		if ( $title )
			printf( '<h3>%s</h3>', $title );

		if ( $jobtitle )
			printf( '<p class="jobtitle">%s</p>', $jobtitle );

		if ( $excerpt )
			echo $excerpt;

		if ( $content )
			printf( '<p><a href="#" data-src="#staff-%s" data-fancybox="%s" class="button">More information</a></p>', get_the_ID(), $slug );
			
		edit_post_link( 'Edit staff member', '<span class="edit-link"><small>', '</small></span>' );

	echo '</div>'; // .right

	if ( $content )
		do_action( 'elodin_do_staff_content' );
}