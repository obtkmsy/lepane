<?php
/**
 * Title: メインビジュアル（単一画像）
 * Slug: theme/hero-cover
 * Categories: theme-parts
 * Keywords:
 * Description:
 */
?>

<!-- wp:cover {"url":"<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/photo-sample.webp","dimRatio":40,"overlayColor":"black","isUserOverlayColor":true,"sizeSlug":"full","align":"full","className":"wp-pattern-hero-cover","layout":{"type":"constrained"}} -->
<div class="wp-block-cover alignfull wp-pattern-hero-cover">

	<img class="wp-block-cover__image-background size-full" alt="" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/photo-sample.webp" data-object-fit="cover"/>

	<span aria-hidden="true" class="wp-block-cover__background has-black-background-color has-background-dim-40 has-background-dim"></span>

	<div class="wp-block-cover__inner-container">

	<!-- wp:group {"align":"wide","className":"wp-pattern-hero-cover__container","layout":{"type":"flex","orientation":"vertical"}} -->
	<div class="wp-block-group alignwide wp-pattern-hero-cover__container">

		<!-- wp:heading {"textAlign":"wide","level":1,"align":"wide","className":"wp-pattern-hero-cover__title","style":{"typography":{"lineHeight":"1.5","fontStyle":"normal","fontWeight":"500"}},"fontSize":"level-1"} -->
		<h1 class="wp-block-heading alignwide has-text-align-wide wp-pattern-hero-cover__title has-level-1-font-size" style="font-style:normal;font-weight:500;line-height:1.5">キャッチコピー<br>キャッチコピーキャッチコピー</h1>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"align":"wide","placeholder":"タイトルを入力...","className":"wp-pattern-hero-cover__description","fontSize":"medium"} -->
		<p class="alignwide has-text-align-wide wp-pattern-hero-cover__description has-medium-font-size">テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。<br>テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。</p>
		<!-- /wp:paragraph -->

	</div>
	<!-- /wp:group -->

	</div>

</div>
<!-- /wp:cover -->
