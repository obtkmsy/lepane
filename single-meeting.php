<?php
/**
 * single.php
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php get_header(); ?>
<main role="main" class="site-main">
	<div class="wp-block-post-content has-global-padding is-layout-constrained wp-block-post-content-is-layout-constrained">
		<!-- wp:group {"metadata":{"categories":[],"patternName":"core/block/20","name":"下層ページ上部(見出し\u0026画像)"},"align":"full","className":"page-main","layout":{"type":"constrained"}} -->
		<div class="wp-block-group alignfull page-main js-wave-animation"><!-- wp:group {"className":"page-main-detail","layout":{"type":"constrained"}} -->
		<div class="wp-block-group page-main-detail"><!-- wp:heading {"level":1} -->
		<h1 class="wp-block-heading">インフォメーション</h1>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p>新しいレッスン情報やイベントは<br>
		こちらでチェック！</p>
		<!-- /wp:paragraph --></div>
		<!-- /wp:group -->

		<!-- wp:image {"id":10,"sizeSlug":"large","linkDestination":"none","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
		<figure class="wp-block-image size-large"><img src="<?php echo home_url(); ?>/wp-content/uploads/2025/11/page-lounge-info.jpg" alt="" class="wp-image-10"/></figure>
		<!-- /wp:image --></div>
		<!-- /wp:group -->

		<article class="single-post-contents">
			<div class="entry-header__info">
				<p class="entry-header__date">
					<?php posted_on(); ?>
				</p>
				<p class="entry-header__cat">
					<?php
					$cats = get_the_category();
					if ( $cats ) {
						echo esc_html( implode(' / ', wp_list_pluck( $cats, 'name' ) ) );
					}
					?>
				</p>
			</div>
			<h2 class="entry-header__title"><?php the_title(); ?></h2>
			<div class="entry-header__thumbnail">
				<?php 
				if ( has_post_thumbnail() ) {
					$thumb_url = get_the_post_thumbnail_url( get_the_ID() );
				} else {
					$thumb_url = get_template_directory_uri() . '/assets/images/thumbnail.jpg';
				}
				?>
				<img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php the_title_attribute(); ?>">
			</div>
			<?php if ( have_posts() ): ?>
				<?php while ( have_posts() ): the_post(); ?>
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
