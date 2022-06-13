<?php
/**
 * Registers a new WP REST API endpoint.
 *
 * @package EmployeeRecognition
 */

namespace Hrswp\EmployeeRecognition\API;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Registers the REST API routes.
 *
 * @since 1.0.0
 *
 * @see register_rest_route
 * @see sanitize_key
 * @see current_user_can
 */
add_action(
	'rest_api_init',
	function(): void {
		register_rest_route(
			'employee-recognition/v1',
			'/option/(?P<option>[a-z0-9_\-]+)',
			array(
				'methods'             => \WP_REST_Server::READABLE,
				'callback'            => __NAMESPACE__ . '\get_er_option',
				'args'                => array(
					'option' => array(
						'sanitize_callback' => function( string $param ): string {
							return sanitize_key( $param );
						},
					),
				),
				'permission_callback' => function (): bool {
					return current_user_can( 'edit_posts' );
				},
			)
		);
	}
);

/**
 * Retrieves the value of a plugin option.
 *
 * @since 1.0.0
 *
 * @see get_option
 * @param \WP_REST_Request $request Object containing data from the REST request.
 * @return \WP_REST_Response|\WP_Error If response generated an error, WP_Error, if response is already an instance, WP_REST_Response, otherwise returns a new WP_REST_Response instance.
 */
function get_er_option( \WP_REST_Request $request ): object {
	if ( ! isset( $request['option'] ) || empty( $request['option'] ) ) {
		return rest_ensure_response(
			new \WP_Error(
				'missing-option-key',
				__( 'No option key provided for query.', 'hrswp-er' )
			)
		);
	}

	$value = get_option( $request['option'] );

	if ( ! isset( $value ) || false === $value ) {
		return rest_ensure_response(
			new \WP_Error(
				'option-value-not-found',
				__( 'Option value not found.', 'hrswp-er' )
			)
		);
	}

	return rest_ensure_response( $value );
}
