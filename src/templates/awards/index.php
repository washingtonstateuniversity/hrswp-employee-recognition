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

use Hrswp\EmployeeRecognition\AwardsTemplate;
use Hrswp\EmployeeRecognition\Users;

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
			if ( have_posts() ) {
				AwardsTemplate\user_login_message();

				// if ( true !== Users\is_wsu_authenticated() ) {
				if ( ! is_user_logged_in() ) { /* @todo Replace with auth function. */
					AwardsTemplate\awards_list();
				} else {
					AwardsTemplate\awards_form();
				}
			} else {
				printf(
					/* translators: the help email address as an href element */
					'<p>' . esc_html__( 'Sorry, we couldn&rsquo;t find any awards. Please contact HRS at %s.', 'hrswp-er' ) . '</p>',
					'<a href="' . esc_url( 'mailto:hrs.employeerecognition@wsu.edu' ) . '">' . esc_html( 'hrs.employeerecognition@wsu.edu' ) . '</a>'
				);
			}
			?>
		</div>
	</section>

	<?php get_template_part( 'build/templates/footer' ); ?>

</main>

<?php
get_footer();
