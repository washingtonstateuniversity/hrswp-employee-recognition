<?php
/**
 * The HRSWP ER Award list template part.
 *
 * Displays a list of Awards in the Loop with a sign-in field.
 *
 * @package EmployeeRecognition
 */

namespace Hrswp\EmployeeRecognition\Templates\AwardsList;

use Hrswp\EmployeeRecognition\AwardsTemplate;

if ( have_posts() ) {
	// Get the list of award year groups from the plugin settings.
	$award_years = get_option( 'hrswp_er_award_years' ) ?? '';
	$award_years = explode( "\n", $award_years );
	?>
	<div class="awards-list">
		<?php
		while ( have_posts() ) {
			the_post();
			$award_year = get_post_meta( $post->ID, 'hrswp_er_awards_year', true );

			// Don't display this award if award year group has been removed.
			if ( ! in_array( $award_year, $award_years, true ) ) {
				continue;
			}

			$previous_post       = get_previous_post();
			$previous_award_year = ( '' !== $previous_post ) ?
				get_post_meta( $previous_post->ID, 'hrswp_er_awards_year', true ) :
				'0';
			$award_year_display  = AwardsTemplate\award_year_formatted( $post->ID );

			// Insert group heading if we've switched to a new group.
			if ( $award_year !== $previous_award_year ) {
				echo '<h3 class="group-title">' . esc_html( $award_year_display ) . '</h3>';
			}
			?>
			<div class="award-item">
				<figure class="wp-block-image size-small"><?php the_post_thumbnail(); ?></figure>
				<p class="award-title"><?php the_title(); ?></p>
				<div class="award-description"><?php the_content(); ?></div>
				<p class="award-group"><?php echo esc_html( $award_year_display ); ?></p>
			</div>
			<?php
		}
		?>
	</div>
	<?php
} else {
	echo '<p>' . esc_html__( 'We couldn&rsquo;t find any awards.', 'hrswp-er' ) . '</p>';
}
