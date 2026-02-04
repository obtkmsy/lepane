<?php

/**
 * single.php
 */

if (!defined('ABSPATH')) {
	exit;
}
?>

<?php get_header(); ?>
<main role="main" class="site-main">
	<div class="wp-block-post-content has-global-padding is-layout-constrained wp-block-post-content-is-layout-constrained">
		<article class="single-post-contents">
			<h2 class="entry-header__title"><?php the_title(); ?></h2>
			<div class="entry-header__info">
				<p class="entry-header__date">
					<?php posted_on(); ?>
				</p>
				<p class="entry-header__cat">
					<?php
					$cats = get_the_category();
					if ($cats) {
						echo esc_html(implode(' / ', wp_list_pluck($cats, 'name')));
					}
					?>
				</p>
			</div>
			<!-- <div class="entry-header__thumbnail">
				<?php
				// if ( has_post_thumbnail() ) {
				// 	$thumb_url = get_the_post_thumbnail_url( get_the_ID() );
				// } else {
				// 	$thumb_url = get_template_directory_uri() . '/assets/images/thumbnail.png';
				// }
				?>
				<img src="<?php //echo esc_url( $thumb_url ); 
									?>" alt="<?php //the_title_attribute(); 
																																?>">
			</div> -->
			<?php if (have_posts()): ?>
				<?php while (have_posts()): the_post(); ?>
					<div class="single-post-content">
						<?php the_content(); ?>
					</div>
				<?php endwhile; ?>
			<?php else: endif; ?>
			<?php get_template_part('template', 'parts/entry/local-navigation'); ?>
		</article>
	</div>
</main>
<?php get_footer(); ?>