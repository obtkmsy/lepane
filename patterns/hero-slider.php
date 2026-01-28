<?php
/**
 * Title: メインビジュアル（スライダー）
 * Slug: theme/hero-slider
 * Categories: theme-parts
 * Keywords:
 * Description:
 */
?>

<!-- wp:cover {"dimRatio":30,"overlayColor":"default","isUserOverlayColor":true,"minHeightUnit":"px","isDark":false,"align":"full","className":"wp-pattern-hero-slider","layout":{"type":"constrained"}} -->
<div class="wp-block-cover alignfull is-light wp-pattern-hero-slider">

	<span aria-hidden="true" class="wp-block-cover__background has-default-background-color has-background-dim-30 has-background-dim"></span>

	<div class="wp-block-cover__inner-container">

	<!-- wp:paragraph -->
	<p>※ブロックで画像スライダーを入れてください。（親要素のサイズに合わせるにチェックを入れる）</p>
	<!-- /wp:paragraph -->

	<!-- wp:group {"align":"wide","className":"wp-pattern-hero-slider__container","layout":{"type":"flex","orientation":"vertical"}} -->
	<div class="wp-block-group alignwide wp-pattern-hero-slider__container">

		<!-- wp:heading {"textAlign":"wide","level":1,"align":"wide","className":"wp-pattern-hero-slider__title","style":{"typography":{"lineHeight":"1.5","fontStyle":"normal","fontWeight":"500"},"elements":{"link":{"color":{"text":"var:preset|color|white"}}}},"textColor":"white","fontSize":"level-1"} -->
		<h1 class="wp-block-heading alignwide has-text-align-wide wp-pattern-hero-slider__title has-white-color has-text-color has-link-color has-level-1-font-size" style="font-style:normal;font-weight:500;line-height:1.5">キャッチコピー<br>キャッチコピーキャッチコピー</h1>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"align":"wide","placeholder":"タイトルを入力...","className":"wp-pattern-hero-slider__description","style":{"elements":{"link":{"color":{"text":"var:preset|color|white"}}}},"textColor":"white","fontSize":"medium"} -->
		<p class="alignwide has-text-align-wide wp-pattern-hero-slider__description has-white-color has-text-color has-link-color has-medium-font-size">テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。<br>テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。</p>
		<!-- /wp:paragraph -->

	</div>
	<!-- /wp:group -->

	</div>

</div>
<!-- /wp:cover -->
