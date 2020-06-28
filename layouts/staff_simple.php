<?php

//* Output the scripts for the leadership section
add_action( 'before_loop_layout_staff_simple', 'elodin_staff_simple_layout_scripts' );
function elodin_staff_simple_layout_scripts( $args ) {
	    
    // Use the lity lightbox
    wp_enqueue_script( 'lity-script' );	
	wp_enqueue_style( 'lity-style' );
	wp_enqueue_style( 'staff-style' );

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

    //* Main content
    if ( $title )
        printf( '<h3>%s</h3>', $title );

    if ( $jobtitle )
        printf( '<p class="jobtitle">%s</p>', $jobtitle );

    if ( $excerpt )
        echo $excerpt;

    // edit_post_link( 'Edit staff member', '<span class="edit-link"><small>', '</small></span>' );

    //* Lightbox trigger
    if ( $content )
        printf( '<a href="#staff-%s" class="overlay-link" data-lity><span class="">View Bio</span></a>', get_the_ID(), get_the_ID() );
        
    //* Lightbox
	if ( $content ) {
		printf( '<div class="staff-content" id="staff-%s">', get_the_ID() );

			edit_post_link( 'Edit staff member', '<span class="edit-link"><small>', '</small></span>' );

			printf( '<h2>%s</h2>', $title );

			if ( $jobtitle )
				printf( '<p class="title">%s</p>', $jobtitle );

			if ( $phone )
				printf( '<p class="phone">%s</p>', $phone );

			if ( $email || $linkedin ) {
					echo '<p class="contact">';

				if ( $email )
					printf( '<a class="button" href="mailto:%s">Contact</a>', $email );

				if ( $linkedin )
					printf( '<a class="button" href="%s">Visit on LinkedIn</a>', $linkedin );

				echo '</p>';
			}

			echo $content;

		echo '</div>';
	}
}