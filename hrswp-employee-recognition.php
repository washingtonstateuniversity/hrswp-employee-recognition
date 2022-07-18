<?php
/**
 * Plugin Name: HRSWP Employee Recognition
 * Plugin URI: https://github.com/washingtonstateuniversity/hrswp-employee-recognition
 * Update URI: https://api.github.com/repos/washingtonstateuniversity/hrswp-employee-recognition/releases/latest
 * Description: WSU HRS plugin that helps to manage the employee recognition progmam.
 * Version: 1.0.0-alpha.3
 * Author: Adam Turner
 * Author URI: https://hrs.wsu.edu/
 * License: GPLv3 or later
 * Text Domain: hrswp-employee-recognition
 * Requires PHP: 7.3
 * Requires at least: 5.9
 * Tested up to: 5.9.2
 *
 * @package EmployeeRecognition
 */

namespace Hrswp\EmployeeRecognition;

use Hrswp\EmployeeRecognition\AwardPostType;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

register_activation_hook(
	__FILE__,
	function (): void {
		// Add an option to check for flushing rewrite rules after activation.
		add_option( 'hrswp-er-flush-rewrite-rules', 'flush' );
	}
);

register_deactivation_hook(
	__FILE__,
	function (): void {
		delete_option( 'hrswp-er-flush-rewrite-rules' );
		flush_rewrite_rules();
	}
);

// Load settings, template tags, and API endpoint.
require_once dirname( __FILE__ ) . '/inc/settings.php';
require_once dirname( __FILE__ ) . '/inc/template-tags.php';
require_once dirname( __FILE__ ) . '/inc/api.php';
require_once dirname( __FILE__ ) . '/inc/formatting.php';

// Load class.
require_once dirname( __FILE__ ) . '/inc/classes/class-award-post-type.php';

AwardPostType\Award_Post_Type::factory();
