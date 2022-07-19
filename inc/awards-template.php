<?php
/**
 * HRSWP ER Award post type template functions.
 *
 * Gets content for the current Award post type post in the Loop.
 *
 * @package EmployeeRecognition
 */

namespace Hrswp\EmployeeRecognition\AwardsTemplate;

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
 * @param int $next_post_id The WP post ID of the next award in the Loop.
 * @return string The general form fieldset with radio elements.
 */
function general_fieldset_html( int $post_id, int $prev_post_id, int $next_post_id ): string {
	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	$prev_award_year = ( $prev_post_id ) ?
		get_post_meta( $prev_post_id, 'hrswp_er_awards_year', true ) :
		'0';
	$next_award_year = ( $next_post_id ) ?
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

	// No next award year means we're at the end of the group.
	if ( '0' === $next_award_year ) {
		$general_fieldset .= '</fieldset>';
	}

	return $general_fieldset;
}
