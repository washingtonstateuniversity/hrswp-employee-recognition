<?php
/**
 * HRSWP ER Award post type template functions.
 *
 * Gets content for the current Award post type post in the Loop.
 *
 * @package EmployeeRecognition
 */

namespace Hrswp\EmployeeRecognition\AwardsTemplate;

use Hrswp\EmployeeRecognition\Formatting;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Generates the Award Year group formatted for display.
 *
 * @since 1.0.0
 *
 * @param int $post_id The ID of the award post to get the award year for. Default is global $post.
 * @return string The formatted Award Year group.
 */
function award_year_formatted( int $post_id ): string {
	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	$award_year = get_post_meta( $post_id, 'hrswp_er_awards_year', true );

	if ( ! $award_year ) {
		return '';
	}

	return ( '1' !== $award_year ) ? $award_year . ' Years' : 'All Years';
}

/**
 * Prints the login and welcome messages.
 *
 * @since 1.0.0
 *
 * @param object $user The WSU user.
 * @return void
 */
function user_login_message( object $user = null ): void {
	if ( ! $user ) {
		$user = wp_get_current_user();
	}

	$classes = 'wp-block-hrswp-notification';
	$message = '';
	$button  = '';

	// if ( true !== Users\is_wsu_authenticated( $user ) ) {
	if ( ! is_user_logged_in() ) { /* @todo Replace with auth function. */
		$classes .= ' has-action-button is-style-warning';
		$message  = esc_html__( 'Please log in with your WSU username to check eligibility and select an award.', 'hrswp-er' );
		$button   = '<div class="wp-block-hrswp-button"><a class="wp-block-button__link">Log in</a></div>';
	} else {
		/**
		 * Work in progress
		 *
		 * By this point we should already know whether they're eligible
		 * and have their length of service years.
		 *
		 * For development we'll just hardcode a year.
		 *
		 * @todo Make this a function or class.
		 */
		$user_years = (string) '15'; // $user->service_years
		$user_name  = (string) 'Person Person'; // $user->name

		$classes .= ' wp-block-hrswp-notification is-style-positive';
		$message  = sprintf(
			/* translators: 1: the user service years, 2: the user name */
			esc_html__( 'Congratulations on %1$s years of service, %2$s!', 'hrswp-er' ),
			esc_html( $user_years ),
			esc_html( $user_name )
		);
	}

	$button = $button ?? '';

	printf(
		'<div class="%1$s"><p>%2$s</p>%3$s</div>',
		esc_attr( $classes ),
		esc_html( $message ),
		wp_kses_post( $button )
	);
}

/**
 * Prints the awards preview list in the Loop.
 *
 * @since 1.0.0
 *
 * @return void
 */
function awards_list(): void {
	// Get the list of award year groups from the plugin settings.
	$award_years = get_option( 'hrswp_er_award_years' ) ?? '';
	$award_years = explode( "\n", $award_years );

	$awards_list = '';
	while ( have_posts() ) {
		the_post();
		$post_id    = get_the_ID();
		$award_year = get_post_meta( $post_id, 'hrswp_er_awards_year', true );

		// Don't display this award if award year group has been removed.
		if ( ! in_array( $award_year, $award_years, true ) ) {
			continue;
		}

		$previous_post       = get_previous_post();
		$previous_award_year = ( '' !== $previous_post ) ?
			get_post_meta( $previous_post->ID, 'hrswp_er_awards_year', true ) :
			'0';
		$award_year_display  = award_year_formatted( $post_id );

		// Insert group heading if we've switched to a new group.
		if ( $award_year !== $previous_award_year ) {
			$awards_list .= '<h3 class="group-title">' . esc_html( $award_year_display ) . '</h3>';
		}

		$awards_list .= '
			<div class="award-item">
				<figure class="wp-block-image size-small">' . get_the_post_thumbnail() . '</figure>
				<p class="award-title">' . get_the_title() . '</p>
				<div class="award-description">' . get_the_content() . '</div>
				<p class="award-group">' . esc_html( $award_year_display ) . '</p>
			</div>
		';
	}

	printf(
		'<h2>%1$s</h2><div class="awards-list">%2$s</div>',
		esc_html__( 'Preview Awards', 'hrswp-er' ),
		wp_kses( $awards_list, Formatting\awards_template_allowed_html() )
	);
}

/**
 * Generates a form radio element as a list item.
 *
 * @since 1.0.0
 *
 * @param int    $post_id The WP post ID of the award to display. Default is global $post.
 * @param string $name    The text to be used for the input element `name` attribute.
 * @return string The radio element HTML.
 */
function radio_item_html( int $post_id, string $name = '' ): string {
	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	$title = get_the_title( $post_id );
	$value = sanitize_title( $title );

	return sprintf(
		'<div class="form-award-item">
			<figure class="wp-block-image size-small">%4$s</figure>
			<label class="award-title" for="%1$s">%2$s</label>
			<input type="radio" id="%1$s" name="%3$s" value="%1$s">
			<div class="award-description">%5$s</div>
			<p class="award-group">%6$s</p>
		</div>',
		esc_attr( $value ),
		esc_attr( $title ),
		esc_attr( $name ),
		get_the_post_thumbnail( $post_id ),
		get_the_content( $post_id ),
		esc_html( award_year_formatted( $post_id ) )
	);
}

/**
 * Generates the "All Years" group form fieldset.
 *
 * @since 1.0.0
 *
 * @param int $post_id      The WP post ID of the award to display. Default is global $post.
 * @param int $prev_post_id The WP post ID of the previous award in the Loop.
 * @param int $next_post_id The WP post ID of the next award in the Loop.
 * @return string The All Years form fieldset with radio elements.
 */
function all_years_fieldset_html( int $post_id, int $prev_post_id, int $next_post_id ): string {
	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	$prev_award_year = ( $prev_post_id ) ?
		get_post_meta( $prev_post_id, 'hrswp_er_awards_year', true ) :
		'0';
	$next_award_year = ( $next_post_id ) ?
		get_post_meta( $next_post_id, 'hrswp_er_awards_year', true ) :
		'0';

	$all_years_fieldset = '';

	// No previous award year means we're at the start of the group.
	if ( '0' === $prev_award_year ) {
		$all_years_fieldset .= '
			<fieldset class="all-year-awards">
				<legend>' . __( 'Select a pin:', 'hrswp-er' ) . '</legend>
		';
	}

	// Generate the all-year award options.
	$all_years_fieldset .= radio_item_html( $post_id, 'all-year-award' );

	// If the next award year isn't '1' then we're at the end of the group.
	if ( '1' !== $next_award_year ) {
		// Generate the "no pin" option.
		$all_years_fieldset .= '
			<div class="form-award-item">
				<figure class="wp-block-image size-small">
					<svg xmlns="http://www.w3.org/2000/svg" height="198" width="198" viewBox="-12 -14 72 72" ><path d="M40.65 44.95 35.9 40.2Q33.4 42 30.4 43q-3 1-6.4 1-4.25 0-7.9-1.525-3.65-1.525-6.35-4.225-2.7-2.7-4.225-6.35Q4 28.25 4 24q0-3.4 1-6.4 1-3 2.8-5.5L3.05 7.35 5.2 5.2l37.6 37.6ZM24 41q2.75 0 5.2-.775t4.55-2.175l-23.8-23.8q-1.4 2.1-2.175 4.55Q7 21.25 7 24q0 7.25 4.875 12.125T24 41Zm16.2-5.1-2.15-2.15q1.4-2.1 2.175-4.55Q41 26.75 41 24q0-7.25-4.875-12.125T24 7q-2.75 0-5.2.775T14.25 9.95L12.1 7.8Q14.6 6 17.6 5q3-1 6.4-1 4.2 0 7.85 1.55Q35.5 7.1 38.2 9.8q2.7 2.7 4.25 6.35Q44 19.8 44 24q0 3.4-1 6.4-1 3-2.8 5.5ZM26.15 21.85Zm-4.3 4.3Z"/></svg>
				</figure>
				<label class="award-title" for="no-pin">' . __( 'No Pin', 'hrswp-er' ) . '</label>
				<input type="radio" id="no-pin" name="all-year-award" value="no-pin">
				<div class="award-description">' . __( 'Select this option if you would prefer not to receive a pin.', 'hrswp-er' ) . '</div>
				<p class="award-group">All Years</p>
			</div>
		';
		$all_years_fieldset .= '</fieldset>';
	}

	return $all_years_fieldset;
}

/**
 * Generates the general form fieldset.
 *
 * @since 1.0.0
 *
 * @param int $post_id      The WP post ID of the award to display. Default is global $post.
 * @param int $prev_post_id The WP post ID of the previous award in the Loop.
 * @return string The general form fieldset with radio elements.
 */
function general_fieldset_html( int $post_id, int $prev_post_id ): string {
	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	$prev_award_year = ( $prev_post_id ) ?
		get_post_meta( $prev_post_id, 'hrswp_er_awards_year', true ) :
		'0';

	$general_fieldset = '';

	// Previous award year of '1' means we're at the start of the group.
	if ( '1' === $prev_award_year ) {
		$general_fieldset .= '
			<fieldset class="general-awards">
				<legend>' . __( 'Select one award from the length-of-service awards:', 'hrswp-er' ) . '</legend>
		';
	}

	// Generate the general award options.
	$general_fieldset .= radio_item_html( $post_id, 'general-award' );

	return $general_fieldset;
}

/**
 * Prints the awards selection form in the Loop.
 *
 * @since 1.0.0
 *
 * @param object $user The WSU user.
 * @return void
 */
function awards_form( object $user = null ): void {
	// Get the list of award year groups from the plugin settings.
	$award_years   = get_option( 'hrswp_er_award_years' ) ?? '';
	$award_years   = explode( "\n", $award_years );
	$service_years = (string) '16'; /* @todo Will be like: `get_user_service_years();` */
	$user_name     = (string) 'Person Person'; /* @todo Will be like: `get_user_name();` */
	$fields        = '';

	while ( have_posts() ) {
		the_post();
		$post_id    = get_the_ID();
		$award_year = get_post_meta( $post_id, 'hrswp_er_awards_year', true );

		// Don't display this award if award year group has been removed.
		if (
			! in_array( $award_year, $award_years, true ) ||
			$award_year > $service_years
		) {
			continue;
		}

		$prev_post_id = get_previous_post()->ID ?? 0;
		$next_post_id = get_next_post()->ID ?? 0;

		if ( '1' === $award_year ) {
			$fields .= all_years_fieldset_html( $post_id, $prev_post_id, $next_post_id );
		} else {
			$fields .= general_fieldset_html( $post_id, $prev_post_id );
		}
	}

	$fields .= '</fieldset>'; // The `general_fieldset_html` output doesn't close itself.
	$fields .= '<p class="form-submit"><input name="submit" type="submit" id="submit" class="submit" value="' . esc_html__( 'Submit', 'hrswp-er' ) . '" /></p>';

	printf(
		'<h2>%1$s</h2><form method="post" class="awards-form" id="hrswp-los-awards" action="%2$s">%3$s</form>',
		esc_html__( 'Select a Pin and Service Award', 'hrswp-er' ),
		esc_url( site_url( '/inc/awards-post.php' ) ),
		wp_kses( $fields, Formatting\awards_template_allowed_html() )
	);
}
