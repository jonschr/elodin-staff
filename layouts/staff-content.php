<?php

/**
 * Output the staff content
 *
 * @return void.
 */
function elodin_staff_content() {

	// * Add the main styles
	wp_enqueue_style( 'es-staff-style' );

	// * Fancybox
	wp_enqueue_style( 'elodin-staff-glightbox-theme' );
	wp_enqueue_script( 'elodin-staff-glightbox-main' );
	wp_enqueue_script( 'elodin-staff-glightbox-init' );

	global $post;

	$jobtitle   = esc_html( get_post_meta( get_the_ID(), 'job_title', true ) );
	$content    = apply_filters( 'the_content', wp_kses_post( get_the_content() ) ); // note: when we output this, we're applying the filters again. That's intentional because Gutenberg is removing that filter once, and it manifests in breaking the first loop through the_content.
	$title      = esc_html( get_the_title() );
	$email      = esc_html( get_post_meta( get_the_ID(), 'email_address', true ) );
	$phone      = esc_html( get_post_meta( get_the_ID(), 'phone_number', true ) );
	$linkedin   = esc_url( get_post_meta( get_the_ID(), 'linkedin', true ) );
	$twitter    = esc_url( get_post_meta( get_the_ID(), 'twitter', true ) );
	$facebook   = esc_url( get_post_meta( get_the_ID(), 'facebook', true ) );
	$background = get_the_post_thumbnail_url( get_the_ID(), 'large' );

	printf( '<div class="staff-content" style="display: none;" id="staff-%s">', (int) get_the_ID() );

		if ( $background ) {

			echo '<div class="photo-wrap">';
				echo '<div class="photo-large">';
					printf( '<img src="%s" alt="%s" />', esc_url( $background ), esc_html( $title ) );
				echo '</div>';
			echo '</div>';

		}

		echo '<div class="info">';

			printf( '<h2>%s</h2>', esc_html( $title ) );

			if ( $jobtitle ) {
				printf( '<p class="title">%s</p>', esc_html( $jobtitle ) );
			}

			if ( $phone ) {
				printf( '<p class="phone">%s</p>', esc_html( $phone ) );
			}

			if ( $email || $linkedin ) {
				echo '<p class="contact">';

				if ( $email ) {
					printf( '<a class="button" href="mailto:%s">Contact</a>', esc_html( $email ) );
				}

				if ( $linkedin ) {
					printf( '<a class="button" target="_blank" href="%s">LinkedIn</a>', esc_url( $linkedin ) );
				}

				if ( $twitter ) {
					printf( '<a class="button" target="_blank" href="%s">Twitter</a>', esc_url( $twitter ) );
				}

				if ( $facebook ) {
					printf( '<a class="button" target="_blank" href="%s">Facebook</a>', esc_url( $facebook ) );
				}

				echo '</p>';
			}

		echo '</div>'; // .info

		if ( $content ) {
			echo wp_kses_post( apply_filters( 'the_content', $content ) );
		}

		edit_post_link( 'Edit staff member', '<p><span class="edit-link">', '</span></p>' );

		if ( current_user_can( 'edit_posts' ) ) {

			// get the current URL.
			$url = home_url( add_query_arg( null, null ) );

			// append the staff member's ID, like #staff-%s.
			$url .= '#staff-' . get_the_ID();

			printf( '<p><span class="staff-permalink"><a target="_blank" href="%s">Staff lightbox permalink</a></span></p>', esc_url( $url ) );
		}

	echo '</div>';
}
add_action( 'elodin_do_staff_content', 'elodin_staff_content' );
