<?php

/**
 * Output the scripts for the staff grid
 *
 * @param   array $args  the args.
 *
 * @return  void.
 */
function rb_staff_layout_scripts( $args ) {

	// * Add the main styles
	wp_enqueue_style( 'es-staff-style' );
}
add_action( 'before_loop_layout_staff_grid', 'rb_staff_layout_scripts' );

// * Output the leadership markup for each item
function rb_staff_layout() {

	$jobtitle = get_post_meta( get_the_ID(), 'job_title', true );
	$content  = apply_filters( 'the_content', get_the_content() ); // note: when we output this, we're applying the filters again. That's intentional because Gutenberg is removing that filter once, and it manifests in breaking the first loop through the_content.
	$title    = get_the_title();
	$email    = get_post_meta( get_the_ID(), 'email_address', true );
	$phone    = get_post_meta( get_the_ID(), 'phone_number', true );
	$linkedin = get_post_meta( get_the_ID(), 'linkedin', true );
	$twitter  = get_post_meta( get_the_ID(), 'twitter', true );
	$facebook = get_post_meta( get_the_ID(), 'facebook', true );
	$slug     = get_post_field( 'post_name', get_post() );

	$contactlabel = 'More information';

	if ( $phone || $email ) {
		$contactlabel = 'Bio & Contact';
	}

	edit_post_link( 'Edit staff member', '<span class="edit-link"><small>', '</small></span>' );

	// * If there's a thumbnail...
	if ( has_post_thumbnail() ) {

		printf( '<div class="featured-image" style="background-image:url( %s )"></div>', esc_url( get_the_post_thumbnail_url( get_the_ID(), 'large' ) ) );

		// if there's content ...
		if ( $content ) {

			printf( '<a href="#staff-%s" class="overlay-link staff-lightbox" data-gallery="overlay-link-%s">', (int) get_the_ID(), (int) get_the_ID() );

				printf( '<span class="overlay-text">%s</span>', esc_html( $contactlabel ) );

			echo '</a>';
		}

		echo '<div class="more-link-wrap">';

		if ( $title ) {
			printf( '<h3 class="name">%s</h3>', esc_html( $title ) );
		}

		if ( $jobtitle ) {
			printf( '<span class="jobtitle">%s</span>', esc_html( $jobtitle ) );
		}

		if ( ! $content ) {
			if ( $email || $linkedin ) {
				echo '<p class="contact">';

				if ( $phone ) {
					printf( '<span class="contact__phone">%s</span>', esc_html( $phone ) );
				}

				if ( $email ) {
					printf( '<a class="contact__email" href="mailto:%s">%s</a>', esc_html( $email ), esc_html( $email ) );
				}

				if ( $linkedin ) {
					printf( '<a href="%s" target="_blank" class="linkedin">LinkedIn</a>', esc_url( $linkedin ) );
				}

				if ( $twitter ) {
					printf( '<a href="%s" target="_blank" class="twitter">Twitter</a>', esc_url( $twitter ) );
				}

				if ( $facebook ) {
					printf( '<a href="%s" target="_blank" class="facebook">Facebook</a>', esc_url( $facebook ) );
				}

				echo '</p>';
			}
		}

		echo '</div>'; // .more-link-wrap

	}

	// * If there's no thumbnail instead...
	if ( ! has_post_thumbnail() ) {
		echo '<div class="no-image"><div class="content-wrap">';

		if ( $title ) {
			printf( '<h3 class="name">%s</h3>', esc_html( $title ) );
		}

		if ( $jobtitle ) {
			printf( '<span class="jobtitle">%s</span>', esc_html( $jobtitle ) );
		}

		if ( ! $content ) {
			if ( $email || $linkedin ) {
				echo '<p class="contact">';

				if ( $phone ) {
					printf( '<span class="contact__phone">%s</span>', esc_html( $phone ) );
				}

				if ( $email ) {
					printf( '<a class="contact__email" href="mailto:%s">%s</a>', esc_html( $email ), esc_html( $email ) );
				}

				if ( $linkedin ) {
					printf( '<a href="%s" target="_blank" class="linkedin">Visit on LinkedIn</a>', esc_url( $linkedin ) );
				}

				echo '</p>';
			}
		}

		if ( $content ) {
			printf( '<a href="#staff-%s" class="button button-small staff-lightbox" data-gallery="more-link-%s" style="margin-top: 20px;">%s</a>', (int) get_the_ID(), (int) get_the_ID(), esc_html( $contactlabel ) );
		}

		echo '</div></div>';
	}

	// * Output the content whether there's a thumbnail or no
	if ( $content ) {
		do_action( 'elodin_do_staff_content' );

	}
}
add_action( 'add_loop_layout_staff_grid', 'rb_staff_layout' );
