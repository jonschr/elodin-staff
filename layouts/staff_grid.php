<?php

//* Output the scripts for the leadership section
add_action( 'before_loop_layout_staff_grid', 'rb_staff_layout_scripts' );
function rb_staff_layout_scripts( $args ) {
	
	// Use the lity lightbox
    wp_enqueue_script( 'es-lity-script' );	
	wp_enqueue_style( 'es-lity-style' );
	wp_enqueue_style( 'es-staff-style' );
}

//* Output the leadership markup for each item
add_action( 'add_loop_layout_staff_grid', 'rb_staff_layout' );
function rb_staff_layout() {

	$jobtitle = get_post_meta( get_the_ID(), 'job_title', true );
	$content = apply_filters( 'the_content', get_the_content() ); // note: when we output this, we're applying the filters again. That's intentional because Gutenberg is removing that filter once, and it manifests in breaking the first loop through the_content.
	$title = get_the_title();
	$email = get_post_meta( get_the_ID(), 'email_address', true );
	$phone = get_post_meta( get_the_ID(), 'phone_number', true );
	$linkedin = get_post_meta( get_the_ID(), 'linkedin', true );

	$contactlabel = 'More information';
	
	if ( $phone || $email )
		$contactlabel = 'Bio & Contact';

	edit_post_link( 'Edit staff member', '<span class="edit-link"><small>', '</small></span>' );

	//* If there's a thumbnail...
	if ( has_post_thumbnail() ) {
	    
	    printf( '<div class="featured-image" style="background-image:url( %s )"></div>', get_the_post_thumbnail_url( get_the_ID(), 'large' ) );

		//* No overlay at all if there's no content
	    if ( $content ) {

			printf( '<a href="#staff-%s" data-lity class="overlay-link">', get_the_ID() );

				printf('<span class="overlay-text">%s</span>', $contactlabel );

			echo '</a>';
	    }

		// Only do the link if there's a title
	    if ( $content )
			printf( '<a href="#staff-%s" data-lity class="more-link">', get_the_ID() ); 

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
									printf( '<a href="%s" target="_blank" class="linkedin">Visit on LinkedIn</a>', $linkedin );
	
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
				printf( '<a href="#staff-%s" data-lity class="button button-small" style="margin-top: 20px;">%s</a>', get_the_ID(), $contactlabel );

		echo '</div></div>';
	}
		
	//* Output the content whether there's a thumbnail or no
	if ( $content ) {
		printf( '<div class="staff-content" id="staff-%s">', get_the_ID() );

			if ( has_post_thumbnail() )
				the_post_thumbnail( 'medium', ['class' => 'featured-right']);

			printf( '<h2>%s</h2>', $title );

			echo '<div class="info">';

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

		echo '</div>';
	}
}