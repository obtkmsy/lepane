<?php

/**
 * 固定ページ
 */

if (!defined('ABSPATH')) {
	exit;
}

?>

<?php get_header(); ?>
<main role="main" class="site-main">
	<div class="wp-block-post-content has-global-padding is-layout-constrained wp-block-post-content-is-layout-constrained">
		<?php if (have_posts()): ?>
			<?php while (have_posts()): the_post(); ?>
				<?php the_content(); ?>
			<?php endwhile; ?>
		<?php else: endif; ?>
	</div>
	<?php if ((is_home() || is_front_page()) && !is_paged()) : ?>
		<canvas id="chart01"></canvas>
		<canvas id="chart02"></canvas>
	<?php endif; ?>
</main>
<?php get_footer(); ?>