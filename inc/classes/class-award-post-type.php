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
		add_filter( 'template_include', array( $this, 'filter_template_include' ), 10, 1 );
		add_filter( 'nav_menu_css_class', array( $this, 'filter_nav_menu_css_class' ), 15, 3 );
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
			'rewrite'            => array( 'slug' => 'recognition/awards' ),
			'show_in_rest'       => true,
			'capability_type'    => 'post',
			'has_archive'        => true,
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
	public function action_register_award_meta() {
		register_meta(
			'post',
			'hrswp_er_awards_year',
			array(
				'object_subtype'    => 'hrswp_er_awards',
				'type'              => 'integer',
				'default'           => -1,
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

		register_meta(
			'post',
			'hrswp_er_awards_quantity',
			array(
				'object_subtype'    => 'hrswp_er_awards',
				'type'              => 'integer',
				'default'           => 5000,
				'show_in_rest'      => true,
				'single'            => true,
				'sanitize_callback' => function( $value ) {
					$value = (int) $value;
					if ( empty( $value ) ) {
						$value = 5000;
					}
					return abs( $value );
				},
				'auth_callback'     => function() {
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
				'sanitize_callback' => function( $value ) {
					$value = (int) $value;
					if ( empty( $value ) ) {
						$value = 1;
					}
					return abs( $value );
				},
				'auth_callback'     => function() {
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
		if ( is_admin() && 'flush' === get_option( 'hrswp-er-flush-rewrite-rules' ) ) {
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
	 * Filters the path of the awards post type archive template.
	 *
	 * @since 1.0.0
	 *
	 * @param string $template The path of the template to include.
	 * @return string The path of the template to include.
	 */
	public function filter_template_include( string $template ): string {
		if ( is_post_type_archive( 'hrswp_er_awards' ) ) {
			$template = dirname( __DIR__, 2 ) . '/templates/awards.php';
		}

		return $template;
	}

	/**
	 * Moves `active` menu class from default archive to awards archive page.
	 *
	 * Hooks into `nav_menu_css_class` using a later priority to allow parent
	 * theme to finish its own modifications.
	 *
	 * @since 1.0.0
	 *
	 * @param array     $classes Required. Current list of nav menu item classes.
	 * @param \WP_Post  $item    Post object representing the menu item data.
	 * @param \stdClass $args    The arguments used to create the menu.
	 * @return array Array of CSS classes for the nav menu item.
	 */
	public function filter_nav_menu_css_class( array $classes, \WP_Post $item, \stdClass $args ): array {
		if (
			in_array( $args->menu, array( 'site' ), true ) &&
			is_post_type_archive( 'hrswp_er_awards' )
		) {
			if ( get_option( 'page_for_posts' ) === $item->object_id ) {
				$classes = array();
			}
			if ( 'post_type_archive' === $item->type ) {
				$classes[] = 'active';
			}
		}

		return $classes;
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
