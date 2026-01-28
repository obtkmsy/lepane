<?php
/**
 * Title: 固定ヘッダー
 * Slug: theme/header-fixed
 * Categories: header
 * Keywords:
 * Description: 上部に固定するヘッダー。ヘッダー分の高さスペースは別で確保する必要があるのでテンプレートやコンテンツ側でパディングの設定を行ってください。
 */
?>

<!-- wp:group {"metadata":{"categories":["header"],"patternName":"theme/header-fixed","name":"固定ヘッダー"},"align":"full","className":"wp-pattern-header is-fixed js-fixed","style":{"spacing":{"padding":{"top":"0","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|white"}}}},"textColor":"white","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull wp-pattern-header is-fixed js-fixed has-white-color has-text-color has-link-color" style="padding-top:0;padding-bottom:0">

	<!-- wp:group {"className":"wp-pattern-header__container","style":{"spacing":{"blockGap":"0"},"elements":{"link":{"color":{"text":"var:preset|color|default"}}}},"textColor":"default","layout":{"type":"flex","flexWrap":"nowrap"}} -->
	<div class="wp-block-group wp-pattern-header__container has-default-color has-text-color has-link-color">

		<!-- wp:group {"className":"wp-pattern-site-branding","style":{"spacing":{"blockGap":"var:preset|spacing|8-16"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
		<div class="wp-block-group wp-pattern-site-branding">

			<!-- wp:image {"lightbox":{"enabled":false},"sizeSlug":"full","linkDestination":"custom","className":"wp-pattern-site-branding__logo"} -->
			<figure class="wp-block-image size-full wp-pattern-site-branding__logo">
				<a href="#">
					<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/dummy-512x160.png" alt="" class=""/>
				</a>
			</figure>
			<!-- /wp:image -->

			<!-- wp:heading {"className":"wp-pattern-site-branding__title","style":{"typography":{"fontStyle":"normal","fontWeight":"400","lineHeight":"1.5"},"elements":{"link":{"color":{"text":"var:preset|color|default"}}}},"textColor":"default","fontSize":"small"} -->
			<h2 class="wp-block-heading wp-pattern-site-branding__title has-default-color has-text-color has-link-color has-small-font-size" style="font-style:normal;font-weight:400;line-height:1.5">
				<a href="#" title="">サイト名やキャッチコピー<br>モバイルやタブレット非表示</a>
			</h2>
			<!-- /wp:heading -->

		</div>
		<!-- /wp:group -->

		<!-- wp:acf/hamburger-menu {"name":"acf/hamburger-menu","data":{"block_hamburgermenu_color":"","_block_hamburgermenu_color":"field_6882570052604"},"mode":"auto","textColor":"default","style":{"elements":{"link":{"color":{"text":"var:preset|color|default"}}}}} /-->

		<!-- wp:pattern {"slug":"theme/navigation"} /-->

	</div>
	<!-- /wp:group -->

</div>
<!-- /wp:group -->
