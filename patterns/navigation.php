<?php
/**
 * Title: ナビゲーション
 * Slug: theme/navigation
 * Categories: header
 * Keywords:
 * Description:
 */
?>

<!-- wp:group {"className":"wp-pattern-navigation","style":{"spacing":{"blockGap":"0"},"elements":{"link":{"color":{"text":"var:preset|color|white"}}}},"textColor":"white","layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group wp-pattern-navigation has-white-color has-text-color has-link-color">

	<!-- wp:navigation {"ref":139,"textColor":"default","overlayMenu":"never","hasIcon":false,"style":{"typography":{"fontStyle":"normal","fontWeight":"500"}},"layout":{"type":"flex","orientation":"horizontal"}} -->
		<!-- wp:navigation-link {"label":"お知らせ","url":"#"} /-->
		<!-- wp:navigation-link {"label":"代表挨拶","url":"#"} /-->
		<!-- wp:navigation-link {"label":"事業内容","url":"#"} /-->
		<!-- wp:navigation-link {"label":"会社概要","url":"#"} /-->
		<!-- wp:navigation-link {"label":"メンバー","url":"#"} /-->
	<!-- /wp:navigation -->

	<!-- wp:buttons {"style":{"spacing":{"blockGap":{"left":"0"}}}} -->
	<div class="wp-block-buttons">

		<!-- wp:button {"textColor":"primary","className":"is-style-outline","style":{"elements":{"link":{"color":{"text":"var:preset|color|primary"}}}}} -->
		<div class="wp-block-button is-style-outline">
			<a class="wp-block-button__link has-primary-color has-text-color has-link-color wp-element-button" href="#">ボタン</a>
		</div>
		<!-- /wp:button -->

		<!-- wp:button {"backgroundColor":"primary"} -->
		<div class="wp-block-button">
			<a class="wp-block-button__link has-primary-background-color has-background wp-element-button" href="#">ボタン</a>
		</div>
		<!-- /wp:button -->

	</div>
	<!-- /wp:buttons -->

</div>
<!-- /wp:group -->


