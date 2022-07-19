<?php
/**
 * The HRSWP ER Award selection form template part.
 *
 * Displays the award-selection form in the Loop.
 *
 * @package EmployeeRecognition
 */

namespace Hrswp\EmployeeRecognition\Templates\AwardsForm;

use Hrswp\EmployeeRecognition\AwardsTemplate;
use Hrswp\EmployeeRecognition\Formatting;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( have_posts() ) {
	// Get the list of award year groups from the plugin settings.
	$award_years = get_option( 'hrswp_er_award_years' ) ?? '';
	$award_years = explode( "\n", $award_years );

	/**
	 * Work in progress
	 *
	 * By this point we should already know whether they're eligible
	 * and have their length of service years.
	 *
	 * For development we'll just hardcode a year.
	 *
	 * @todo Make this a function.
	 */
	$user_service_years = (string) '15';
	$user_name          = (string) 'Person Person';

	?>
	<div class="wp-block-hrswp-notification is-style-positive">
		<p><strong>
			<?php
			printf(
				/* translators: 1: the user service years, 2: the user name */
				esc_html__( 'Congratulations on %1$s years of service, %2$s!', 'hrswp-er' ),
				esc_html( $user_service_years ),
				esc_html( $user_name )
			);
			?>
		</strong></p>
	</div>
	<h2><?php esc_html_e( 'Select a Pin and Service Award', 'hrswp-er' ); ?></h2>
	<form method="post" class="awards-form" id="hrswp-los-awards" action="/recognition/awards/">
		<?php
		while ( have_posts() ) {
			the_post();
			$award_year = get_post_meta( $post->ID, 'hrswp_er_awards_year', true );

			// Don't display this award if award year group has been removed.
			if (
				! in_array( $award_year, $award_years, true ) ||
				$award_year > $user_service_years
			) {
				continue;
			}

			$prev_post_id = get_previous_post()->ID ?? 0;
			$next_post_id = get_next_post()->ID ?? 0;

			if ( '1' === $award_year ) {
				echo wp_kses(
					AwardsTemplate\all_years_fieldset_html( $post->ID, $prev_post_id, $next_post_id ),
					Formatting\awards_template_allowed_html()
				);
			} else {
				echo wp_kses(
					AwardsTemplate\general_fieldset_html( $post->ID, $prev_post_id, $next_post_id ),
					Formatting\awards_template_allowed_html()
				);
			}
		}
		?>
		<button type="submit">Submit</button>
	</form>
	<?php
} else {
	printf(
		/* translators: the help email address as an href element */
		'<p>' . esc_html__( 'Sorry, we couldn&rsquo;t find any awards. Please contact HRS at %s.', 'hrswp-er' ) . '</p>',
		'<a href="mailto:hrs.employeerecognition@wsu.edu">hrs.employeerecognition@wsu.edu</a>'
	);
}
