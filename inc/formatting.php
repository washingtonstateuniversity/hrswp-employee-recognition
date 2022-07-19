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
		'div'      => array(
			'class' => array(),
		),
		'label'    => array(
			'class' => array(),
			'for'   => array(),
		),
		'input'    => array(
			'type'  => array(),
			'id'    => array(),
			'name'  => array(),
			'value' => array(),
		),
		'figure'   => array(
			'class' => array(),
		),
		'img'      => array(
			'src'         => array(),
			'class'       => array(),
			'alt'         => array(),
			'data-src'    => array(),
			'data-srcset' => array(),
			'data-sizes'  => array(),
			'srcset'      => array(),
			'sizes'       => array(),
			'width'       => array(),
			'height'      => array(),
			'loading'     => array(),
		),
		'noscript' => array(),
		'p'        => array(
			'class' => array(),
		),
		'svg'      => array(
			'xmlns'   => array(),
			'width'   => array(),
			'height'  => array(),
			'viewbox' => array(),
		),
		'path'     => array(
			'd' => array(),
		),
	);
}
