<?php
/**
 * Manages the plugin settings.
 *
 * @package EmployeeRecognition
 */

namespace Hrswp\EmployeeRecognition\Settings;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Displays the award years settings field html.
 *
 * @since 1.0.0
 *
 * @return void
 */
function settings_field_award_years(): void {
	printf(
		'<fieldset><legend class="screen-reader-text"><span>%1$s</span></legend><p><label for="%2$s">%4$s <strong>%5$s</strong></label></p><textarea name="%2$s" id="%2$s" class="large-text" rows="5">%3$s</textarea></fieldset>',
		esc_html__( 'Award year options', 'hrswp-employee-recognition' ),
		esc_attr( 'hrswp_er_award_years' ),
		esc_textarea( get_option( 'hrswp_er_award_years' ) ),
		esc_html__(
			'Length-of-service awards are grouped by years of service.
			Enter the award year tiers as a number (5, for example) and
			separate multiple years with line breaks. Use -1 (negative
			one) to create an “all years” group.',
			'hrswp-employee-recognition'
		),
		esc_html__( 'Warning: Before deleting a group make sure to unassign all awards from it.', 'hrswp-employee-recognition' )
	);
}

/**
 * Sanitizes the award years option value.
 *
 * This option expects a string of numbers separated by newlines (`\n`).
 * It will strip out any non-number characters from each line.
 *
 * @param string $value The unsanitized value.
 * @return string The sanitized value.
 */
function sanitize_award_year_setting( string $value ): string {
	$value = explode( "\n", $value );
	$value = array_filter( array_map( 'trim', $value ) );
	$value = array_filter(
		array_map(
			function( string $year ): string {
				$year = preg_replace( '/[^\-0-9]/', '', wp_specialchars_decode( $year ) );
				$year = ! is_numeric( $year ) ? '' : $year;
				$year = ( -1 > $year ) ? '' : $year;
				return $year;
			},
			$value
		)
	);
	$value = implode( "\n", $value );

	return $value;
}

/**
 * Displays the plugin settings page.
 *
 * @since 1.0.0
 *
 * @see settings_fields
 * @see do_settings_sections
 * @see submit_button
 * @return void
 */
function settings_page_content(): void {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	ob_start();
	settings_fields( 'hrswp-employee-recognition' );
	do_settings_sections( 'hrswp-employee-recognition' );
	submit_button();
	$fields = ob_get_contents();
	ob_end_clean();

	printf(
		'<div class="wrap"><h1>%1$s</h1><form action="options.php" method="post">%2$s</form></div>',
		esc_html( get_admin_page_title() ),
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		$fields
	);
}

/**
 * Registers plugin settings and settings form fields.
 *
 * @since 1.0.0
 *
 * @see register_setting
 * @see add_settings_section
 * @see add_settings_field
 */
add_action(
	'admin_init',
	function(): void {
		$slug   = 'hrswp-employee-recognition';
		$option = 'hrswp_er_award_years';

		register_setting(
			$slug,
			$option,
			array(
				'sanitize_callback' => __NAMESPACE__ . '\sanitize_award_year_setting',
			)
		);

		add_settings_section(
			$slug . '_section_award_years',
			esc_html__( 'Employee Recognition Awards', 'hrswp-employee-recognition' ),
			'__return_true',
			$slug
		);

		add_settings_field(
			$option,
			esc_html__( 'Length-of-Service Award Years', 'hrswp-employee-recognition' ),
			__NAMESPACE__ . '\settings_field_award_years',
			$slug,
			$slug . '_section_award_years'
		);
	}
);

/**
 * Registers the plugin settings page.
 *
 * @since 1.0.0
 *
 * @see add_options_page
 */
add_action(
	'admin_menu',
	function(): void {
		add_options_page(
			esc_html__( 'HRS Employee Recognition Settings', 'hrswp-employee-recognition' ),
			esc_html__( 'HRS Employee Recognition', 'hrswp-employee-recognition' ),
			'manage_options',
			'hrswp-employee-recognition',
			__NAMESPACE__ . '\settings_page_content'
		);
	}
);
