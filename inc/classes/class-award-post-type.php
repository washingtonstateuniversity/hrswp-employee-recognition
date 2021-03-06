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
		add_action( 'init', array( $this, 'action_register_post_type_blocks' ) );
		add_action( 'after_setup_theme', array( $this, 'maybe_flush_rewrite_rules' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'action_register_editor_assets' ) );
		add_filter( 'enter_title_here', array( $this, 'filter_post_title_placeholder' ), 10, 2 );
		add_filter( 'manage_hrswp_er_awards_posts_columns', array( $this, 'filter_manage_post_columns' ), 10, 1 );
		add_action( 'manage_hrswp_er_awards_posts_custom_column', array( $this, 'action_manage_custom_columns' ), 10, 2 );
		add_filter( 'manage_edit-hrswp_er_awards_sortable_columns', array( $this, 'filter_manage_sortable_columns' ), 10, 1 );
		add_action( 'pre_get_posts', array( $this, 'action_awards_list_orderby' ), 10, 1 );
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
			'name'                  => esc_html_x( 'ER Awards Manager', 'post type general name', 'hrswp-er' ),
			'singular_name'         => esc_html_x( 'Award', 'post type singular name', 'hrswp-er' ),
			'add_new'               => _x( 'Create Award', 'post type', 'hrswp-er' ),
			'add_new_item'          => esc_html__( 'ER Awards Manager', 'hrswp-er' ),
			'edit_item'             => esc_html__( 'Edit Award', 'hrswp-er' ),
			'new_item'              => esc_html__( 'New Award', 'hrswp-er' ),
			'all_items'             => esc_html__( 'ER Awards Manager', 'hrswp-er' ),
			'view_items'            => esc_html__( 'View Award', 'hrswp-er' ),
			'search_items'          => esc_html__( 'Search Awards', 'hrswp-er' ),
			'not_found'             => esc_html__( 'No awards found.', 'hrswp-er' ),
			'not_found_in_trash'    => esc_html__( 'No awards found in trash.', 'hrswp-er' ),
			'parent_item_colon'     => 'Award parent',
			'menu_name'             => esc_html__( 'ER Awards', 'hrswp-er' ),
			'featured_image'        => esc_html__( 'Award image', 'hrswp-er' ),
			'set_featured_image'    => esc_html__( 'Set award image', 'hrswp-er' ),
			'remove_featured_image' => esc_html__( 'Remove award image.', 'hrswp-er' ),
			'use_featured_image'    => esc_html__( 'Use as award image', 'hrswp-er' ),
		);

		$template = array(
			array( 'hrswp/er-award-description' ),
			array( 'hrswp/er-award-meta-year' ),
			array( 'hrswp/er-award-inventory' ),
		);

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
			'hierarchical'       => true,
			'template'           => $template,
			'template_lock'      => 'all',
			'supports'           => array(
				'title',
				'editor',
				'author',
				'custom-fields',
				'thumbnail',
				'page-attributes',
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
	public function action_register_award_meta(): void {
		register_meta(
			'post',
			'hrswp_er_awards_year',
			array(
				'object_subtype'    => 'hrswp_er_awards',
				'type'              => 'integer',
				'default'           => (int) 0,
				'show_in_rest'      => true,
				'single'            => true,
				'sanitize_callback' => function( int $value ): int {
					$value = (int) $value;
					if ( empty( $value ) ) {
						$value = (int) 0;
					}
					if ( $value < 0 ) {
						$value = abs( $value );
					}
					return $value;
				},
				'auth_callback'     => function(): bool {
					return current_user_can( 'edit_posts' );
				},
			)
		);

		register_meta(
			'post',
			'hrswp_er_awards_quantity',
			array(
				'object_subtype'    => 'hrswp_er_awards',
				'type'              => 'integer',
				'default'           => 5000,
				'show_in_rest'      => true,
				'single'            => true,
				'sanitize_callback' => function( int $value ): int {
					$value = (int) $value;
					if ( empty( $value ) ) {
						$value = 5000;
					}
					return abs( $value );
				},
				'auth_callback'     => function(): bool {
					return current_user_can( 'edit_posts' );
				},
			)
		);

		register_meta(
			'post',
			'hrswp_er_awards_reserve',
			array(
				'object_subtype'    => 'hrswp_er_awards',
				'type'              => 'integer',
				'default'           => 1,
				'show_in_rest'      => true,
				'single'            => true,
				'sanitize_callback' => function( int $value ): int {
					$value = (int) $value;
					if ( empty( $value ) ) {
						$value = 1;
					}
					return abs( $value );
				},
				'auth_callback'     => function(): bool {
					return current_user_can( 'edit_posts' );
				},
			)
		);
	}

	/**
	 * Registers blocks for the ER Awards post type.
	 *
	 * @since 1.0.0
	 *
	 * @see register_block_type
	 * @return void
	 */
	public function action_register_post_type_blocks(): void {
		$blocks_dir = plugin_dir_path( dirname( __DIR__ ) ) . 'build/blocks';
		if ( ! is_dir( $blocks_dir ) ) {
			return;
		}

		$results    = scandir( $blocks_dir );
		$exclusions = array( '.', '..', 'CVS', 'node_modules', 'vendor', 'bower_components' );
		$dirs       = array();

		foreach ( $results as $result ) {
			if ( in_array( $result, $exclusions, true ) ) {
				continue;
			}
			$result_path = $blocks_dir . '/' . $result;
			if ( is_dir( $result_path ) ) {
				if ( ! in_array( 'block.json', scandir( $result_path ), true ) ) {
					continue;
				}
				$dirs[] = trailingslashit( $result_path );
			}
		}

		if ( ! empty( $dirs ) ) {
			foreach ( $dirs as $dir ) {
				register_block_type( $dir );
			}
		}
	}

	/**
	 * Flushes rewrite rules only on initial activation.
	 *
	 * Need to flush rewrite rules only after the post type is created, but
	 * `register_activation_hook` runs before that, so we create an option flag
	 * on activation and then check for it on each `after_setup_theme` hook.
	 *
	 * @since 1.0.0
	 *
	 * @see flush_rewrite_rules
	 * @return void
	 */
	public function maybe_flush_rewrite_rules(): void {
		if ( is_admin() && true === get_option( 'hrswp-er-flush-rewrite-rules' ) ) {
			delete_option( 'hrswp-er-flush-rewrite-rules' );
			flush_rewrite_rules();
		}
	}

	/**
	 * Registers editor assets.
	 *
	 * @since 1.0.0
	 *
	 * @see wp_register_script
	 * @return void
	 */
	public function action_register_editor_assets(): void {
		$asset_file = include plugin_dir_path( dirname( __DIR__ ) ) . 'build/index.asset.php';

		wp_register_script(
			'hrswp-employee-recognition',
			plugins_url( 'build/index.js', dirname( __DIR__ ) ),
			$asset_file['dependencies'],
			$asset_file['version'],
			true
		);

		wp_register_style(
			'hrswp-employee-recognition-editor',
			plugins_url( 'build/index.css', dirname( __DIR__ ) ),
			array(),
			$asset_file['version'],
		);
	}

	/**
	 * Replaces the "Add title" placeholder for the ER Awards post type.
	 *
	 * @since 1.0.0
	 *
	 * @param string   $text Placeholder text. Default 'Add title'.
	 * @param \WP_Post $post The Post object.
	 * @return string The placeholder text.
	 */
	public function filter_post_title_placeholder( string $text, \WP_Post $post ): string {
		if ( 'hrswp_er_awards' !== $post->post_type ) {
			return $text;
		}
		return __( 'Add award name', 'hrswp-er' );
	}

	/**
	 * Modifies the columns displayed in the Awards Posts list table.
	 *
	 * @since 1.0.0
	 *
	 * @see `manage_{$post_type}_posts_columns`
	 * @param string[] $post_columns An associative array of column headings.
	 * @return array An associative array of column headings.
	 */
	public function filter_manage_post_columns( array $post_columns ): array {
		return array(
			'cb'       => $post_columns['cb'],
			'image'    => __( 'Image', 'hrswp-er' ),
			'title'    => __( 'Title', 'hrswp-er' ),
			'year'     => __( 'Year', 'hrswp-er' ),
			'quantity' => __( 'Quantity', 'hrswp-er' ),
			'date'     => __( 'Date', 'hrswp-er' ),
		);
	}

	/**
	 * Populates the custom column content on the Awards Posts list table.
	 *
	 * @since 1.0.0
	 *
	 * @see `manage_{$post->post_type}_posts_custom_column`
	 * @param string $column_name The name of the column to display.
	 * @param int    $post_id     The current post ID.
	 * @return void
	 */
	public function action_manage_custom_columns( string $column_name, int $post_id ): void {
		switch ( $column_name ) {
			case 'image':
				echo get_the_post_thumbnail( $post_id, array( 9999, 80 ) );
				break;
			case 'year':
				$year = get_post_meta( $post_id, 'hrswp_er_awards_year', true ) ?? '(none)';
				if ( '1' === $year ) {
					esc_html_e( 'All years', 'hrswp-er' );
				} else {
					echo esc_html( (string) $year );
				}
				break;
			case 'quantity':
				echo esc_html(
					number_format( get_post_meta( $post_id, 'hrswp_er_awards_quantity', true ), 0, '.', ',' )
					?? '(none)'
				);
				break;
		}
	}

	/**
	 * Makes the Awards posts list custom columns sortable.
	 *
	 * @since 1.0.0
	 *
	 * @see `manage_{$this->screen->id}_sortable_columns`
	 * @param array $sortable_columns An array of sortable columns.
	 * @return array The array of sortable columns.
	 */
	public function filter_manage_sortable_columns( array $sortable_columns ): array {
		$sortable_columns['year']     = 'awards_year';
		$sortable_columns['quantity'] = 'awards_quantity';

		return $sortable_columns;
	}

	/**
	 * Handles the sorting logic for the Awards posts list custom columns.
	 *
	 * @since 1.0.0
	 *
	 * @see `pre_get_posts`
	 * @param \WP_Query $query The WP_Query instance (passed by reference).
	 * @return void
	 */
	public function action_awards_list_orderby( \WP_Query $query ): void {
		// Exit if not in the admin area or not the main posts query.
		if ( ! is_admin() || ! $query->is_main_query() ) {
			return;
		}

		if ( 'awards_year' === $query->get( 'orderby' ) ) {
			$query->set( 'orderby', 'meta_value' );
			$query->set( 'meta_key', 'hrswp_er_awards_year' );
			$query->set( 'meta_type', 'numeric' );
		}

		if ( 'awards_quantity' === $query->get( 'orderby' ) ) {
			$query->set( 'orderby', 'meta_value_num' );
			$query->set( 'meta_key', 'hrswp_er_awards_quantity' );
			$query->set( 'meta_type', 'numeric' );
		}
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
