<?php
/**
 * Displays a list of awards.
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
		<h1><?php esc_html_e( 'Employee Recognition Awards', 'hrswp-er' ) ?></h1>
	</header>
	<section class="row single gutter awards-archive">

		<?php
		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post();
				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'archive-content column one' ); ?>>
					<header class="article-header">
						<p class="article-title"><?php the_title(); ?></p>
					</header>
					<div class="article-content">
						<?php the_content(); ?>
					</div>
				</article>
				<?php
			}
		} else {
			?>
			<article class="archive-content column one">
				<header class="article-header">
					<p>
						<?php esc_html_e( 'We couldn&rsquo;t find any awards.', 'hrswp-er' ); ?>
					</p>
				</header>
			</article>
			<?php
		}
		?>
	</section>
	<?php // Render\archive_pagination(); ?>
	<?php // get_template_part( 'build/templates/footer' ); ?>

</main><!--/#page-->

<?php
get_footer();
