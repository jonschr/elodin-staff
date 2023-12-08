<?php

add_action( 'elodin_do_staff_content', 'elodin_staff_content' );
function elodin_staff_content() {
	
	//* Add the main styles
	wp_enqueue_style( 'es-staff-style' );

	//* Enqueue the fancybox scripts
	wp_enqueue_style( 'elodin-staff-fancybox-theme' );
    wp_enqueue_script( 'elodin-staff-fancybox-main' );
	
	global $post;
	
	$jobtitle = esc_html( get_post_meta( get_the_ID(), 'job_title', true ) );
	$content = apply_filters( 'the_content', wp_kses_post( get_the_content() ) ); // note: when we output this, we're applying the filters again. That's intentional because Gutenberg is removing that filter once, and it manifests in breaking the first loop through the_content.
	$title = esc_html( get_the_title() );
	$email = esc_html( get_post_meta( get_the_ID(), 'email_address', true ) );
	$phone = esc_html( get_post_meta( get_the_ID(), 'phone_number', true ) );
	$linkedin = esc_url( get_post_meta( get_the_ID(), 'linkedin', true ) );
	$twitter = esc_url( get_post_meta( get_the_ID(), 'twitter', true ) );
	$facebook = esc_url( get_post_meta( get_the_ID(), 'facebook', true ) );
	
	printf( '<div class="staff-content" style="display: none;" id="staff-%s">', get_the_ID() );
		
		// if ( has_post_thumbnail() )
		// 	the_post_thumbnail( 'medium', ['class' => 'featured-right']);			
			
		echo '<div class="info">';
		
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
					printf( '<a class="button" target="_blank" href="%s">LinkedIn</a>', $linkedin );
					
				if ( $twitter )
					printf( '<a class="button" target="_blank" href="%s">Twitter</a>', $twitter );
					
				if ( $facebook )
					printf( '<a class="button" target="_blank" href="%s">Facebook</a>', $facebook );

				echo '</p>';
			}

		echo '</div>'; // .info

		if ( $content )
			echo apply_filters( 'the_content', $content );
            
        edit_post_link( 'Edit staff member', '<span class="edit-link"><small>', '</small></span>' );

	echo '</div>';
	
}
