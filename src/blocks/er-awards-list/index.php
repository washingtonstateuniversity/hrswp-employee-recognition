<?php
/**
 * Server-side rendering of the `hrswp/er-awards-list` block.
 *
 * @package EmployeeRecognition
 */

namespace Hrswp\EmployeeRecognition\Blocks\ERAwardsList;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function render( $attributes ) {
	return '<p>Fish</p>';
}

/**
 * Registers the `hrswpsqlsrv/job-classifications` block on the server.
 *
 * Use later priority to make sure required resources are ready
 *
 * @since 1.0.0
 *
 * @return void
 */
add_action(
	'init',
	function() {
		register_block_type_from_metadata(
			__DIR__ . '/block.json',
			array(
				'render_callback' => __NAMESPACE__ . '\render',
			)
		);
	},
	25
);
