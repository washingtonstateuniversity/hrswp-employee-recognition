<?php
/**
 * Set up the Award post type
 *
 * @package EmployeeRecognition
 */

namespace Hrswp\EmployeeRecognition\AwardPostType;

/**
 * Post type class.
 */
class Award_Post_Type {

	/**
	 * Sets up the award post type.
	 *
	 * @since 1.0.0
	 */
	public function setup(): void {
		add_action( 'init', array( $this, 'action_register_post_types' ) );
		add_action( 'init', array( $this, 'action_register_award_meta' ) );
	}

	/**
	 * Registers the award post type.
	 *
	 * @since 1.0.0
	 *
	 * @see register_post_type
	 * @return void
	 */
	public function action_register_post_types(): void {
		$award_labels = array(
			'name'               => esc_html_x( 'ER Awards Manager', 'post type general name', 'hrswp-employee-recognition' ),
			'singular_name'      => esc_html_x( 'Award', 'post type singular name', 'hrswp-employee-recognition' ),
			'add_new'            => _x( 'Create Award', 'post type', 'hrswp-employee-recognition' ),
			'add_new_item'       => esc_html__( 'ER Awards Manager', 'hrswp-employee-recognition' ),
			'edit_item'          => esc_html__( 'Edit Award', 'hrswp-employee-recognition' ),
			'new_item'           => esc_html__( 'New Award', 'hrswp-employee-recognition' ),
			'all_items'          => esc_html__( 'ER Awards Manager', 'hrswp-employee-recognition' ),
			'view_items'         => esc_html__( 'View Award', 'hrswp-employee-recognition' ),
			'search_items'       => esc_html__( 'Search Awards', 'hrswp-employee-recognition' ),
			'not_found'          => esc_html__( 'No awards found.', 'hrswp-employee-recognition' ),
			'not_found_in_trash' => esc_html__( 'No awards found in trash.', 'hrswp-employee-recognition' ),
			'parent_item_colon'  => '',
			'menu_name'          => esc_html__( 'ER Awards', 'hrswp-employee-recognition' ),
		);

		$template = array();

		$award_args = array(
			'labels'             => $award_labels,
			'public'             => false,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => 'tools.php',
			'menu_position'      => 80,
			'query_var'          => false,
			'rewrite'            => false,
			'show_in_rest'       => true,
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => false,
			'supports'           => array(
				'title',
				'editor',
				'author',
				'custom-fields',
				'thumbnail',
			),
		);

		register_post_type( 'hrswp_er_awards', $award_args );
	}

	/**
	 * Registers the ER Awards post meta.
	 *
	 * @since 1.0.0
	 *
	 * @see register_meta
	 * @return void
	 */
	public function action_register_award_meta() {
		register_meta(
			'post',
			'hrswp_er_awards_year',
			array(
				'object_subtype'    => 'hrswp_er_awards',
				'type'              => 'integer',
				'default'           => 1,
				'show_in_rest'      => true,
				'single'            => true,
				'sanitize_callback' => function( $value ) {
					$value = (int) $value;
					if ( empty( $value ) ) {
						$value = 1;
					}
					if ( $value < -1 ) {
						$value = abs( $value );
					}
					return $value;
				},
				'auth_callback'     => function() {
					return current_user_can( 'edit_posts' );
				},
			)
		);
	}

	/**
	 * Returns a singleton instance of the class.
	 *
	 * @since 1.0.0
	 *
	 * @return Award_Post_Type
	 */
	public static function factory(): Award_Post_Type {
		static $instance = false;

		if ( ! $instance ) {
			$instance = new self();
			$instance->setup();
		}

		return $instance;
	}
}
