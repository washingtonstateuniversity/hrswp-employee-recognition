<?php
/**
 * Used to set up all HRSWP ER blocks used with the block editor.
 *
 * @package EmployeeRecognition
 */

namespace Hrswp\EmployeeRecognition\Blocks;

// Include files required for

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Include files required for dynamic block registration.
require plugin_dir_path( dirname( __FILE__ ) ) . 'build/blocks/er-awards-list/index.php';

/**
* Registers blocks for the ER Awards post type.
*
* @since 1.0.0
*
* @see register_block_type
* @return void
*/
function action_register_post_type_blocks(): void {
	$block_folders = array(
		'er-award-description',
		'er-award-inventory',
		'er-award-meta-year',
	);

	foreach ( $block_folders as $block_folder ) {
		register_block_type(
			plugin_dir_path( dirname( __FILE__ ) ) . 'build/blocks/' . $block_folder
		);
	}
}
add_action( 'init', __NAMESPACE__ . '\action_register_post_type_blocks' );
