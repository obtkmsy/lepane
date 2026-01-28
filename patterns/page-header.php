<?php
/**
 * Title: ページヘッダー
 * Slug: theme/page-header
 * Categories: theme-parts
 * Keywords:
 * Description: 第2階層以降で使用するページタイトル
 */
?>

<!-- wp:group {"tagName":"header","align":"full","className":"wp-pattern-page-header","layout":{"type":"constrained"}} -->
<header class="wp-block-group alignfull wp-pattern-page-header"><!-- wp:group {"align":"wide","className":"wp-pattern-page-header__inner","layout":{"type":"default"}} -->
<div class="wp-block-group alignwide wp-pattern-page-header__inner"><!-- wp:paragraph {"className":"wp-pattern-page-title","style":{"elements":{"link":{"color":{"text":"var:preset|color|default"}}},"typography":{"lineHeight":"1.5"}},"textColor":"default","fontSize":"title","fontFamily":"decoration"} -->
<p class="wp-pattern-page-title has-default-color has-text-color has-link-color has-decoration-font-family has-title-font-size" style="line-height:1.5">Headline</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"className":"wp-pattern-page-subtitle","style":{"elements":{"link":{"color":{"text":"var:preset|color|primary"}}},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"primary","fontSize":"medium"} -->
<h2 class="wp-block-heading wp-pattern-page-subtitle has-primary-color has-text-color has-link-color has-medium-font-size" style="margin-top:0;margin-bottom:0">タイトル</h2>
<!-- /wp:heading --></div>
<!-- /wp:group --></header>
<!-- /wp:group -->
