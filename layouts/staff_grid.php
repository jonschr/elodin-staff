<?php

//* Output the scripts for the leadership section
add_action( 'before_loop_layout_staff_grid', 'rb_staff_layout_scripts' );
function rb_staff_layout_scripts( $args ) {

	//* Add the main styles
	wp_enqueue_style( 'es-staff-style' );

	//* Enqueue the fancybox scripts
	wp_enqueue_style( 'elodin-staff-fancybox-theme' );
    wp_enqueue_script( 'elodin-staff-fancybox-main' );
}

//* Output the leadership markup for each item
add_action( 'add_loop_layout_staff_grid', 'rb_staff_layout' );
function rb_staff_layout() {

	$jobtitle = esc_html( get_post_meta( get_the_ID(), 'job_title', true ) );
	$content = apply_filters( 'the_content', wp_kses_post( get_the_content() ) ); // note: when we output this, we're applying the filters again. That's intentional because Gutenberg is removing that filter once, and it manifests in breaking the first loop through the_content.
	$title = esc_html( get_the_title() );
	$email = esc_html( get_post_meta( get_the_ID(), 'email_address', true ) );
	$phone = esc_html( get_post_meta( get_the_ID(), 'phone_number', true ) );
	$linkedin = esc_url( get_post_meta( get_the_ID(), 'linkedin', true ) );
	$twitter = esc_url( get_post_meta( get_the_ID(), 'twitter', true ) );
	$facebook = esc_url( get_post_meta( get_the_ID(), 'facebook', true ) );
	$slug = esc_html( get_post_field( 'post_name', get_post() ) );

	$contactlabel = 'More information';
	
	if ( $phone || $email )
		$contactlabel = 'Bio & Contact';

	edit_post_link( 'Edit staff member', '<span class="edit-link"><small>', '</small></span>' );

	//* If there's a thumbnail...
	if ( has_post_thumbnail() ) {
	    
	    printf( '<div class="featured-image" style="background-image:url( %s )"></div>', get_the_post_thumbnail_url( get_the_ID(), 'large' ) );

		//* No overlay at all if there's no content
	    if ( $content ) {

			printf( '<a href="#" data-src="#staff-%s" data-fancybox="%s" class="overlay-link">', get_the_ID(), $slug );

				printf('<span class="overlay-text">%s</span>', $contactlabel );

			echo '</a>';
	    }

		// Only do the link if there's a title
	    if ( $content )
			printf( '<a href="#staff-%s" data-fancybox=%s" class="more-link">', get_the_ID(), $slug ); 

				echo '<div class="more-link-wrap">';
				
					if ( $title )
						printf( '<h3 class="name">%s</h3>', $title );
					
					if ( $jobtitle )
						printf( '<span class="jobtitle">%s</span>', $jobtitle );
						
					if ( !$content ) {
						if ( $email || $linkedin ) {
							echo '<p class="contact">';
	
								if ( $phone )
									printf( '<span class="contact__phone">%s</span>', $phone );
									
								if ( $email )
									printf( '<a class="contact__email" href="mailto:%s">%s</a>', $email, $email );
		
								if ( $linkedin )
									printf( '<a href="%s" target="_blank" class="linkedin">LinkedIn</a>', $linkedin );
									
								if ( $twitter )
									printf( '<a href="%s" target="_blank" class="twitter">Twitter</a>', $twitter );
									
								if ( $facebook )
									printf( '<a href="%s" target="_blank" class="facebook">Facebook</a>', $facebook );
	
							echo '</p>';
						}
					}

				echo '</div>'; // .more-link-wrap


		// End the link if there's content
		if ( $content )
			echo '</a>'; // .more-link
	}

	//* If there's no thumbnail instead...
	if ( !has_post_thumbnail() ) {
		echo '<div class="no-image"><div class="content-wrap">';

			if ( $title )
				printf( '<h3 class="name">%s</h3>', $title );

			if ( $jobtitle )
				printf( '<span class="jobtitle">%s</span>', $jobtitle );
				
			if ( !$content ) {
				if ( $email || $linkedin ) {
					echo '<p class="contact">';

						if ( $phone )
							printf( '<span class="contact__phone">%s</span>', $phone );
							
						if ( $email )
							printf( '<a class="contact__email" href="mailto:%s">%s</a>', $email, $email );

						if ( $linkedin )
							printf( '<a href="%s" target="_blank" class="linkedin">Visit on LinkedIn</a>', $linkedin );

					echo '</p>';
				}
			}

			if ( $content )
				printf( '<a href="#" data-src="#staff-%s" data-fancybox class="button button-small" style="margin-top: 20px;">%s</a>', get_the_ID(), $contactlabel );

		echo '</div></div>';
	}
		
	//* Output the content whether there's a thumbnail or no
	if ( $content ) {
		do_action( 'elodin_do_staff_content' );
		
	}
}

