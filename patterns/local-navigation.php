<?php
/**
 * Title: ローカルナビゲーション
 * Slug: theme/local-navigation
 * Categories: theme-parts
 * Keywords:
 * Description: 投稿詳細で使用するローカルナビゲーション
 */
?>

<!-- wp:group {"className":"wp-pattern-local-navigation","style":{"spacing":{"margin":{"top":"var:preset|spacing|32-48"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between","verticalAlignment":"center"}} -->
<div class="wp-block-group wp-pattern-local-navigation" style="margin-top:var(--wp--preset--spacing--32-48)">

	<!-- wp:post-navigation-link {"type":"previous","label":"前のお知らせ","arrow":"arrow","style":{"elements":{"link":{"color":{"text":"var:preset|color|gray"}}}},"textColor":"gray"} /-->

	<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
	<div class="wp-block-buttons">
		<!-- wp:button {"textColor":"gray","className":"is-style-outline","style":{"elements":{"link":{"color":{"text":"var:preset|color|gray"}}},"spacing":{"padding":{"top":"var:preset|spacing|fixed-8","bottom":"var:preset|spacing|fixed-8"}},"typography":{"fontStyle":"normal","fontWeight":"400"}}} -->
		<div class="wp-block-button is-style-outline">
			<a class="wp-block-button__link has-gray-color has-text-color has-link-color wp-element-button" href="#" style="padding-top:var(--wp--preset--spacing--fixed-8);padding-bottom:var(--wp--preset--spacing--fixed-8);font-style:normal;font-weight:400">お知らせ一覧</a>
		</div>
		<!-- /wp:button -->
	</div>
	<!-- /wp:buttons -->

	<!-- wp:post-navigation-link {"label":"次のお知らせ","arrow":"arrow","style":{"elements":{"link":{"color":{"text":"var:preset|color|gray"}}}},"textColor":"gray"} /-->

</div>
<!-- /wp:group -->
