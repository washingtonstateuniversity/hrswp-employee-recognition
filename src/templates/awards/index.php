<?php
/**
 * The HRSWP ER Awards post type archive template.
 *
 * Displays a list of awards and sign-in notification to non-authenticated
 * users, or the award selection form if a user is authenticated.
 *
 * @package EmployeeRecognition
 */

namespace Hrswp\EmployeeRecognition\Templates\Awards;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
?>

<main id="wsuwp-main" class="hrswp-employee-recognition-awards-archive">
	<header class="page-header">
		<h1><?php esc_html_e( 'Length of Service Awards', 'hrswp-er' ); ?></h1>
	</header>

	<section class="row single gutter awards-archive">
		<div class="column one">
		<?php
		/**
		 * SSO user authentication
		 *
		 * If the user isn't signed in or isn't eligible for an award, then
		 * display a preview of all available awards.
		 *
		 * Using `is_user_logged_in` for now until we have SSO set up to retrieve
		 * user access validation and data.
		 *
		 * @todo Get SSO set up to authenticate user and get their WSU ID
		 *       for use in retrieving their LOS award status.
		 */
		if ( ! is_user_logged_in() ) {
			?>
			<div class="wp-block-hrswp-notification has-action-button is-style-warning">
				<p><strong>Please log in with your WSU username to check eligibility and select an award.</strong></p>
				<div class="wp-block-hrswp-button"><a class="wp-block-button__link">Log in</a></div>
			</div>
			<h2>Preview Awards</h2>
			<?php
			require_once dirname( __DIR__ ) . '/awards-list/index.php';
		} else {
			// Display the award selection form.
			require_once dirname( __DIR__ ) . '/awards-form/index.php';
		}
		?>
		</div>
	</section>

	<?php get_template_part( 'build/templates/footer' ); ?>

</main>

<?php
get_footer();
