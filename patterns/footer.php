<?php
/**
 * Title: デフォルトフッター
 * Slug: theme/footer
 * Categories: footer
 * Keywords:
 * Description:
 */
?>

<!-- wp:group {"align":"full","className":"wp-pattern-footer","style":{"spacing":{"padding":{"top":"var:preset|spacing|32-48","bottom":"var:preset|spacing|40-64"}}},"backgroundColor":"default","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull wp-pattern-footer has-default-background-color has-background" style="padding-top:var(--wp--preset--spacing--32-48);padding-bottom:var(--wp--preset--spacing--40-64)">

	<!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|56-96"}},"layout":{"type":"grid","columnCount":1,"minimumColumnWidth":null}} -->
	<div class="wp-block-group alignwide">

		<!-- wp:group {"align":"wide","className":"wp-pattern-footer-top","style":{"spacing":{"blockGap":"0"},"layout":{"columnSpan":1,"rowSpan":1}},"layout":{"type":"default"}} -->
		<div class="wp-block-group alignwide wp-pattern-footer-top">

			<!-- wp:group {"className":"wp-pattern-footer-information","layout":{"type":"default"}} -->
			<div class="wp-block-group wp-pattern-footer-information">
				<!-- wp:image {"lightbox":{"enabled":false},"sizeSlug":"full","linkDestination":"custom","className":"wp-pattern-footer-information__logo"} -->
				<figure class="wp-block-image size-full wp-pattern-footer-information__logo">
					<a href="<?php echo home_url(); ?>">
						<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/dummy-512x160.png" alt="" class=""/>
					</a>
				</figure>
				<!-- /wp:image -->

				<!-- wp:paragraph {"className":"wp-pattern-footer-information__title","style":{"elements":{"link":{"color":{"text":"var:preset|color|white"}}},"spacing":{"margin":{"top":"var:preset|spacing|8-16"}},"typography":{"lineHeight":"1.75"}},"textColor":"white","fontSize":"small"} -->
				<p class="wp-pattern-footer-information__title has-white-color has-text-color has-link-color has-small-font-size" style="margin-top:var(--wp--preset--spacing--8-16);line-height:1.75"><a href="<?php echo home_url(); ?>" title="HOME">サイト名やキャッチコピー1行目<br>サイト名やキャッチコピー2行目</a></p>
				<!-- /wp:paragraph -->

				<!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|light-gray"}}},"typography":{"lineHeight":"1.75"},"spacing":{"margin":{"top":"var:preset|spacing|16-24"}}},"textColor":"light-gray","fontSize":"small"} -->
				<p class="has-light-gray-color has-text-color has-link-color has-small-font-size" style="margin-top:var(--wp--preset--spacing--16-24);line-height:1.75">〒105-0011<br>東京都港区芝公園４丁目２−８</p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->

			<!-- wp:group {"className":"wp-pattern-footer-navigations has-rows","style":{"spacing":{"blockGap":"var:preset|spacing|24-32"}},"layout":{"type":"grid","columnCount":2,"minimumColumnWidth":null}} -->
			<div class="wp-block-group wp-pattern-footer-navigations has-rows">
				<!-- wp:navigation {"textColor":"white","overlayMenu":"never","className":"wp-pattern-footer-navigation","style":{"spacing":{"blockGap":"var:preset|spacing|fixed-16"},"layout":{"columnSpan":1}},"layout":{"type":"flex","orientation":"vertical","flexWrap":"nowrap"}} -->
					<!-- wp:navigation-link {"label":"お知らせ","url":"#"} /-->
					<!-- wp:navigation-link {"label":"代表挨拶","url":"#"} /-->
					<!-- wp:navigation-link {"label":"事業内容","url":"#"} /-->
				<!-- /wp:navigation -->

				<!-- wp:navigation {"textColor":"white","overlayMenu":"never","className":"wp-pattern-footer-navigation","style":{"spacing":{"blockGap":"var:preset|spacing|fixed-16"},"layout":{"columnSpan":1}},"layout":{"type":"flex","orientation":"vertical","flexWrap":"nowrap"}} -->
					<!-- wp:navigation-link {"label":"会社概要","url":"#"} /-->
					<!-- wp:navigation-link {"label":"メンバー","url":"#"} /-->
					<!-- wp:navigation-link {"label":"採用情報","url":"#"} /-->
				<!-- /wp:navigation -->

				<!-- wp:navigation {"textColor":"white","overlayMenu":"never","className":"wp-pattern-footer-navigation","style":{"spacing":{"blockGap":"var:preset|spacing|fixed-16"},"layout":{"columnSpan":1}},"layout":{"type":"flex","orientation":"vertical","flexWrap":"nowrap"}} -->
					<!-- wp:navigation-link {"label":"お問い合わせ","url":"#"} /-->
					<!-- wp:navigation-link {"label":"プライバシーポリシー","url":"#"} /-->
				<!-- /wp:navigation -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"align":"wide","className":"wp-pattern-footer-bottom","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
		<div class="wp-block-group alignwide wp-pattern-footer-bottom">
			<!-- wp:paragraph {"className":"wp-pattern-footer-copyright","style":{"elements":{"link":{"color":{"text":"var:preset|color|light-gray"}}},"typography":{"letterSpacing":"1px"}},"textColor":"light-gray","fontSize":"x-small","fontFamily":"decoration"} -->
			<p class="wp-pattern-footer-copyright has-light-gray-color has-text-color has-link-color has-decoration-font-family has-x-small-font-size" style="letter-spacing:1px">Copyright &copy; knowledge commons LLC. All rights reserved.</p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph {"className":"wp-pattern-footer-pagetop","style":{"elements":{"link":{"color":{"text":"var:preset|color|gray"}}}},"textColor":"gray"} -->
			<p class="wp-pattern-footer-pagetop has-gray-color has-text-color has-link-color"><a href="#" title=""><mark style="background-color:#767676" class="has-inline-color">Back to Top</mark></a></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->

	</div>
	<!-- /wp:group -->

</div>
<!-- /wp:group -->
