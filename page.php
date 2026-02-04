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


		<?php
		// $labels = [];
		// $data   = [];
		// if (have_rows('chart01')) {
		// 	while (have_rows('chart01')) {
		// 		the_row();
		// 		$labels[] = get_sub_field('name');
		// 		$data[]   = (int) get_sub_field('score');
		// 	}
		// }
		?>

		<?php
		// $chart02_labels = [];
		// $chart02_data   = [];

		// if (have_rows('chart02')) {
		// 	while (have_rows('chart02')) {
		// 		the_row();
		// 		$chart02_labels[] = get_sub_field('name');
		// 		$chart02_data[]   = (int) get_sub_field('score');
		// 	}
		// }

		// $chart02_label = get_field('chart02_label');
		?>
	<?php endif; ?>
	<script>
		const chart01Labels = <?php echo json_encode($labels); ?>;
		const chart01Data = <?php echo json_encode($data); ?>;
	</script>
	<script>
		const chart02Labels = <?php echo json_encode($chart02_labels); ?>;
		const chart02Data = <?php echo json_encode($chart02_data); ?>;
		const chart02Label = "<?php echo esc_js($chart02_label ?: '得点'); ?>";
	</script>


</main>
<?php get_footer(); ?>