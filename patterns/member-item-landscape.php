<?php
/**
 * Title: メンバー（横長の写真 + 下にテキスト）
 * Slug: theme/member-item-landscape
 * Categories: theme-parts
 * Keywords:
 * Description:
 */
?>

<!-- wp:group {"tagName":"article","className":"wp-pattern-member-item-landscape","style":{"spacing":{"blockGap":"var:preset|spacing|8-16"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<article class="wp-block-group wp-pattern-member-item-landscape">

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","align":"center"} -->
<figure class="wp-block-image aligncenter size-full">
	<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/dummy-560x373.png" alt="" class=""/>
</figure>
<!-- /wp:image -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"0"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group" style="margin-top:0">
<!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|gray"}}},"typography":{"lineHeight":"1.5"}},"textColor":"gray","fontSize":"x-small"} -->
<p class="has-gray-color has-text-color has-link-color has-x-small-font-size" style="line-height:1.5">肩書き</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3,"style":{"typography":{"lineHeight":"1.5","fontStyle":"normal","fontWeight":"700"},"spacing":{"margin":{"top":"var:preset|spacing|fixed-4"}}},"fontSize":"medium"} -->
<h3 class="wp-block-heading has-medium-font-size" style="margin-top:var(--wp--preset--spacing--fixed-4);font-style:normal;font-weight:700;line-height:1.5">山田 太郎</h3>
<!-- /wp:heading -->
</div>
<!-- /wp:group -->
</article>
<!-- /wp:group -->
