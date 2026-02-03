<?php

/**
 * index.php
 *
 * アーカイブ用にて使用
 */

if (!defined('ABSPATH')) {
	exit;
}
?>

<?php get_header(); ?>

<main role="main" class="site-main">
	<div class="wp-block-post-content has-global-padding is-layout-constrained wp-block-post-content-is-layout-constrained">
		<?php if (have_posts()): ?>
			<div class="entry-loop has-border-top">
				<?php while (have_posts()): the_post(); ?>
					<?php get_template_part('template', 'parts/loop/entry-item'); ?>
				<?php endwhile; ?>
			</div>

			<?php get_template_part('template', 'parts/component/pager'); ?>


		<?php else: endif; ?>
	</div>
</main>

<?php get_footer(); ?>