<?php
/**
 * 固定ページ
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

// get acf
// $sample = get_field('sample');
?>

<?php get_header(); ?>
<main role="main" class="site-main">
	<div class="wp-block-post-content has-global-padding is-layout-constrained wp-block-post-content-is-layout-constrained">
		<?php if ( have_posts() ): ?>
			<?php while ( have_posts() ): the_post(); ?>
				<?php the_content(); ?>
			<?php endwhile; ?>
		<?php else: endif; ?>
	</div>
</main>
<?php get_footer(); ?>
