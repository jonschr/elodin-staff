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
	    
    // Use the lity lightbox
    wp_enqueue_script( 'lity-script' );	
	wp_enqueue_style( 'lity-style' );
	wp_enqueue_style( 'staff-style' );

	add_filter( 'excerpt_length', 'staff_custom_excerpt_length', 999 );
}

//* Output the leadership markup for each item
add_action( 'add_loop_layout_staff', 'elodin_staff_layout' );
function elodin_staff_layout() {

	$jobtitle = get_post_meta( get_the_ID(), 'job_title', true );
	$content = apply_filters( 'the_content', get_the_content() );
	$title = get_the_title();
	$email = get_post_meta( get_the_ID(), 'email_address', true );
	$phone = get_post_meta( get_the_ID(), 'phone_number', true );
	$excerpt = apply_filters( 'the_content', get_the_excerpt() );

	if ( has_post_thumbnail() ) echo '<div class="left">';

			if ( has_post_thumbnail() ) 
			    printf( '<div class="featured-image" style="background-image:url( %s )"></div>', get_the_post_thumbnail_url( get_the_ID(), 'large' ) );
		
	if ( has_post_thumbnail() ) echo '</div>'; // .left

	echo '<div class="right">';

		if ( $title )
			printf( '<h3>%s</h3>', $title );

		if ( $jobtitle )
			printf( '<p class="jobtitle">%s</p>', $jobtitle );

		if ( $excerpt )
			echo $excerpt;

		edit_post_link( 'Edit staff member', '<span class="edit-link"><small>', '</small></span>' );

		if ( $content )
			echo '<p>';

			if ( $content )
				printf( '<a href="#staff-%s" class="overlay-link button button-small" data-lity>View Bio</a>', get_the_ID(), get_the_ID() );

		if ( $content )
			echo '</p>';
		
	// if ( $content )
	// 	printf( '<a href="#" data-featherlight="#staff-%s" class="overlay-link button">Bio & Contact</a><a href="#" data-featherlight="#staff-%s" class="more-link"><span class="name hoverinfo">%s</span><span class="jobtitle hoverinfo">%s</span></a>', get_the_ID(), get_the_ID(), $title, $jobtitle );

	echo '</div>'; // .right

	if ( $content ) {
		printf( '<div class="staff-content" id="staff-%s">', get_the_ID() );

			edit_post_link( 'Edit staff member', '<span class="edit-link"><small>', '</small></span>' );

			if ( has_post_thumbnail() )
				the_post_thumbnail( 'medium', ['class' => 'featured-right']);

			printf( '<h2>%s</h2>', $title );

			if ( $jobtitle )
				printf( '<p class="title">%s</p>', $jobtitle );

			if ( $phone )
				printf( '<p class="phone">%s</p>', $phone );

			if ( $email )
				printf( '<p class="contact"><a class="button button-clear" href="mailto:%s">Contact</a></p>', $email );


			echo $content;

		echo '</div>';
	}
}