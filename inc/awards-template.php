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
		'<li>
			<label for="%1$s">%2$s</label>
			<input type="radio" id="%1$s" name="%3$s" value="%1$s">
		</li>',
		esc_attr( $value ),
		esc_attr( $title ),
		esc_attr( $name )
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
				<legend>' . __( 'Select a pin or select "no pin" if you do not want one.', 'hrswp-er' ) . '</legend>
				<ul>
		';
	}

	// Generate the all-year award options.
	$all_years_fieldset .= radio_item_html( $post_id, 'all-year-award' );

	// If the next award year isn't '1' then we're at the end of the group.
	if ( '1' !== $next_award_year ) {
		// Generate the "no pin" option.
		$all_years_fieldset .= '
			<li>
				<label for="no-pin">' . __( 'No Pin', 'hrswp-er' ) . '</label>
				<input type="radio" id="no-pin" name="all-year-award" value="no-pin">
			</li>
		';
		$all_years_fieldset .= '</ul></fieldset>';
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
				<legend>' . __( 'Select one award from the length-of-service awards.', 'hrswp-er' ) . '</legend>
				<ul>
		';
	}

	// Generate the general award options.
	$general_fieldset .= radio_item_html( $post_id, 'general-award' );

	// No next award year means we're at the end of the group.
	if ( '0' === $next_award_year ) {
		$general_fieldset .= '</ul></fieldset>';
	}

	return $general_fieldset;
}
