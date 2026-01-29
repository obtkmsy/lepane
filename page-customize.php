<?php
/**
 * Template Name: 下層テンプレート
 */


if ( !defined( 'ABSPATH' ) ) {
	exit;
}

// get acf
// $sample = get_field('sample');
?>

<?php get_header(); ?>
<main role="main" class="site-main">
	<div class="has-global-padding px-0 is-full">
		<?php if ( have_posts() ): ?>
			<?php while ( have_posts() ): the_post(); ?>
				<?php the_content(); ?>
			<?php endwhile; ?>
		<?php else: endif; ?>
	</div>
</main>
<?php get_footer(); ?>
