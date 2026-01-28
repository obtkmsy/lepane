<?php
/**
 * Title: CTA
 * Slug: theme/cta-stack
 * Categories: theme-parts
 * Keywords:
 * Description:
 */
?>

<!-- wp:cover {"url":"<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/photo-sample.webp","dimRatio":50,"overlayColor":"black","isUserOverlayColor":true,"sizeSlug":"full","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|56-96","bottom":"var:preset|spacing|64-128","right":"var:preset|spacing|24-32","left":"var:preset|spacing|24-32"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover alignfull" style="padding-top:var(--wp--preset--spacing--56-96);padding-right:var(--wp--preset--spacing--24-32);padding-bottom:var(--wp--preset--spacing--64-128);padding-left:var(--wp--preset--spacing--24-32)">

<img class="wp-block-cover__image-background size-full" alt="" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/photo-sample.webp" data-object-fit="cover"/><span aria-hidden="true" class="wp-block-cover__background has-black-background-color has-background-dim"></span>

<div class="wp-block-cover__inner-container">

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group">

<!-- wp:group {"metadata":{"categories":["theme-parts"],"patternName":"theme/heading-variation-1","name":"見出しバリエーション1"},"className":"wp-pattern-heading-var1","style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|24-32"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group wp-pattern-heading-var1" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--24-32)"><!-- wp:paragraph {"className":"wp-pattern-heading-var1__primary","style":{"typography":{"lineHeight":"1.5"}},"fontSize":"level-1","fontFamily":"decoration"} -->
<p class="wp-pattern-heading-var1__primary has-decoration-font-family has-level-1-font-size" style="line-height:1.5">Contact</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"className":"wp-pattern-heading-var1__secondary","style":{"spacing":{"margin":{"top":"var:preset|spacing|4-8","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|white"}}}},"textColor":"white","fontSize":"small"} -->
<h2 class="wp-block-heading wp-pattern-heading-var1__secondary has-white-color has-text-color has-link-color has-small-font-size" style="margin-top:var(--wp--preset--spacing--4-8);margin-bottom:0">お問い合わせ</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"is-style-stacked-on-mobile","style":{"spacing":{"blockGap":"var:preset|spacing|32-48"}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
<div class="wp-block-group is-style-stacked-on-mobile"><!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph -->
<p>ご意見・ご質問等、お気軽にお問い合わせください。<br>ご意見・ご質問等、お気軽にお問い合わせください。</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:buttons {"metadata":{"categories":["theme-parts"],"patternName":"theme/button-wide","name":"ボタン（ワイド）"},"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"white","textColor":"primary","className":"is-style-outline is-style-wide","style":{"elements":{"link":{"color":{"text":"var:preset|color|primary"}}}},"fontSize":"medium"} -->
<div class="wp-block-button is-style-outline is-style-wide"><a class="wp-block-button__link has-primary-color has-white-background-color has-text-color has-background has-link-color has-medium-font-size has-custom-font-size wp-element-button" href="#">お問い合わせはこちら<mark style="background-color:#1D2088" class="has-inline-color">　</mark></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

</div>

</div>
<!-- /wp:cover -->