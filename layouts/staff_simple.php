<?php

//* Output the scripts for the leadership section
add_action( 'before_loop_layout_staff_simple', 'elodin_staff_simple_layout_scripts' );
function elodin_staff_simple_layout_scripts( $args ) {
	    
    //* Add the main styles
	wp_enqueue_style( 'es-staff-style' );

	//* Enqueue the fancybox scripts
	wp_enqueue_style( 'elodin-staff-fancybox-theme' );
    wp_enqueue_script( 'elodin-staff-fancybox-main' );

}

//* Output the leadership markup for each item
add_action( 'add_loop_layout_staff_simple', 'elodin_staff_simple_layout' );
function elodin_staff_simple_layout() {

	$jobtitle = get_post_meta( get_the_ID(), 'job_title', true );
	$content = apply_filters( 'the_content', apply_filters( 'the_content', get_the_content() ) );
	$title = get_the_title();
	$email = get_post_meta( get_the_ID(), 'email_address', true );
	$phone = get_post_meta( get_the_ID(), 'phone_number', true );
	$excerpt = apply_filters( 'the_content', get_the_excerpt() );
	$linkedin = get_post_meta( get_the_ID(), 'linkedin', true );
	$slug = get_post_field( 'post_name', get_post() );

    //* Main content
    if ( $title )
        printf( '<h3>%s</h3>', $title );

    if ( $jobtitle )
        printf( '<p class="jobtitle">%s</p>', $jobtitle );

    // if ( $excerpt )
    //     echo $excerpt;

    // edit_post_link( 'Edit staff member', '<span class="edit-link"><small>', '</small></span>' );

    //* Lightbox trigger
    if ( $content )
		printf( '<a href="#" data-src="#staff-%s" data-fancybox="%s" class="overlay-link"><span class="">View Bio</span></a>', get_the_ID(), $slug );
        // printf( '<a href="#staff-%s" class="overlay-link" data-lity><span class="">View Bio</span></a>', get_the_ID(), get_the_ID() );
        
    //* Lightbox
	if ( $content )
		do_action( 'elodin_do_staff_content' );
		
}