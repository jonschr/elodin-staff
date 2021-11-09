<?php

add_action( 'elodin_do_staff_content', 'elodin_staff_content' );
function elodin_staff_content() {
	global $post;
	
	$jobtitle = get_post_meta( get_the_ID(), 'job_title', true );
	$content = apply_filters( 'the_content', get_the_content() ); // note: when we output this, we're applying the filters again. That's intentional because Gutenberg is removing that filter once, and it manifests in breaking the first loop through the_content.
	$title = get_the_title();
	$email = get_post_meta( get_the_ID(), 'email_address', true );
	$phone = get_post_meta( get_the_ID(), 'phone_number', true );
	$linkedin = get_post_meta( get_the_ID(), 'linkedin', true );
	// $slug = get_post_field( 'post_name', get_post() );
	
	printf( '<div class="staff-content" id="staff-%s">', get_the_ID() );
		
		if ( has_post_thumbnail() )
			the_post_thumbnail( 'medium', ['class' => 'featured-right']);			
			
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
					printf( '<a class="button" href="%s">Visit on LinkedIn</a>', $linkedin );

				echo '</p>';
			}

		echo '</div>'; // .info

		if ( $content )
			echo apply_filters( 'the_content', $content );
            
        edit_post_link( 'Edit staff member', '<span class="edit-link"><small>', '</small></span>' );

	echo '</div>';
	
}
