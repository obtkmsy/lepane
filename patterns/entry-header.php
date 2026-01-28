<?php
/**
 * Title: 投稿ヘッダー
 * Slug: theme/entry-header
 * Categories: theme-parts
 * Keywords:
 * Description: 投稿詳細で使用するページタイトル
 */
?>

<!-- wp:group {"tagName":"header","style":{"spacing":{"margin":{"top":"0"}}},"layout":{"type":"constrained"}} -->
<header class="wp-block-group" style="margin-top:0">

	<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|24-32"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
	<div class="wp-block-group">
		<!-- wp:post-date {"style":{"elements":{"link":{"color":{"text":"var:preset|color|gray"}}},"typography":{"lineHeight":"1.5"}},"textColor":"gray","fontFamily":"decoration"} /-->

		<!-- wp:post-terms {"term":"category","style":{"border":{"width":"1px"},"elements":{"link":{"color":{"text":"var:preset|color|gray"}}},"typography":{"fontStyle":"normal","fontWeight":"500"}},"textColor":"gray","fontSize":"x-small","borderColor":"gray"} /-->
	</div>
	<!-- /wp:group -->

	<!-- wp:post-title {"level":1,"style":{"typography":{"lineHeight":"1.75"},"spacing":{"margin":{"top":"var:preset|spacing|4-8"}}},"fontSize":"level-3"} /-->

</header>
<!-- /wp:group -->
