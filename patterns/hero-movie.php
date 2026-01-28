<?php
/**
 * Title: メインビジュアル（動画）
 * Slug: theme/hero-movie
 * Categories: theme-parts
 * Keywords:
 * Description:
 */
?>

<!-- wp:cover {"url":"<?php echo esc_url( get_template_directory_uri() ); ?>/assets/video/sample.mp4","dimRatio":0,"isUserOverlayColor":true,"backgroundType":"video","isDark":false,"sizeSlug":"full","align":"full","className":"wp-pattern-hero-movie is-style-default","layout":{"type":"default"}} -->
<div class="wp-block-cover alignfull is-light wp-pattern-hero-movie is-style-default">

	<video class="wp-block-cover__video-background intrinsic-ignore" autoplay muted loop playsinline src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/video/sample.mp4" data-object-fit="cover"></video>

	<span aria-hidden="true" class="wp-block-cover__background has-background-dim-0 has-background-dim"></span>

	<div class="wp-block-cover__inner-container">

		<!-- wp:group {"align":"wide","className":"wp-pattern-hero-movie__container","layout":{"type":"flex","orientation":"vertical"}} -->
		<div class="wp-block-group alignwide wp-pattern-hero-movie__container">

			<!-- wp:heading {"textAlign":"wide","level":1,"align":"wide","className":"wp-pattern-hero-movie__title","style":{"typography":{"lineHeight":"1.5","fontStyle":"normal","fontWeight":"500"},"elements":{"link":{"color":{"text":"var:preset|color|white"}}}},"textColor":"white","fontSize":"level-1"} -->
			<h1 class="wp-block-heading alignwide has-text-align-wide wp-pattern-hero-movie__title has-white-color has-text-color has-link-color has-level-1-font-size" style="font-style:normal;font-weight:500;line-height:1.5">キャッチコピー<br>キャッチコピーキャッチコピー</h1>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"align":"wide","placeholder":"タイトルを入力...","className":"wp-pattern-hero-movie__description","style":{"elements":{"link":{"color":{"text":"var:preset|color|white"}}}},"textColor":"white","fontSize":"medium"} -->
			<p class="alignwide has-text-align-wide wp-pattern-hero-movie__description has-white-color has-text-color has-link-color has-medium-font-size">テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。<br>テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。</p>
			<!-- /wp:paragraph -->

		</div>
		<!-- /wp:group -->

	</div>

</div>
<!-- /wp:cover -->
