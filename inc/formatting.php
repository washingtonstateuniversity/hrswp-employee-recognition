<?php
/**
 * Formatting API handles formatting output.
 *
 * @package EmployeeRecognition
 */

namespace Hrswp\EmployeeRecognition\Formatting;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Returns an array of allowed HTML tags and attributes for the Awards template.
 *
 * @since 1.0.0
 *
 * @return array Array of allowed HTML tags and their allowed attributes.
 */
function awards_template_allowed_html(): array {
	return array(
		'fieldset' => array(
			'class' => array(),
		),
		'legend'   => array(),
		'ul'       => array(),
		'li'       => array(),
		'label'    => array(
			'for' => array(),
		),
		'input'    => array(
			'type'  => array(),
			'id'    => array(),
			'name'  => array(),
			'value' => array(),
		),
	);
}
