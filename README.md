## 横幅のバリエーションについて

* ナローサイズ（案件オリジナル） : 832px
* コンテントサイズ : 1024px
* 幅広サイズ : 1216px
* 全幅サイズ : 100% ※PCは左右に40pxのスペースを置く
* 左右幅 : 24px ※PCは40px


## ウインドウサイズについて

* スマホは固定サイズ
* PCについては 1080px（iPad 9世代 まで） 〜 1296px まではサイズ可変で1080px未満は横スクロールを出す


## theme.json 上での clamp 関数について

下記を使用する。

* Values min : スマホの入力した数値
* Values max : PCの入力した数値
* Viewport min : 375
* Viewport max : 1296


ヘッダーについては下記で対応する

* Values min : 64
* Values max : 96
* Viewport min : 782
* Viewport max : 1296


## 一時メモ

```
<!-- wp:cover {"dimRatio":30,"overlayColor":"default","isUserOverlayColor":true,"minHeightUnit":"px","isDark":false,"align":"full","className":"wp-pattern-hero-slider","layout":{"type":"constrained"}} -->
<div class="wp-block-cover alignfull is-light wp-pattern-hero-slider"><span aria-hidden="true" class="wp-block-cover__background has-default-background-color has-background-dim-30 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:acf/slider {"name":"acf/slider","data":{"field_688821b342b3b":{"6888337fe058e":{"field_688821f142b3c":"288"},"row-1":{"field_688821f142b3c":"559"},"row-2":{"field_688821f142b3c":"560"}},"field_68882ee45d8f6":"1","field_68882f1d58741":"1"},"mode":"auto"} /-->

<!-- wp:group {"align":"wide","className":"wp-pattern-hero-slider__container","layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group alignwide wp-pattern-hero-slider__container"><!-- wp:heading {"textAlign":"wide","level":1,"align":"wide","className":"wp-pattern-hero-slider__title","style":{"typography":{"lineHeight":"1.5","fontStyle":"normal","fontWeight":"500"},"elements":{"link":{"color":{"text":"var:preset|color|white"}}}},"textColor":"white","fontSize":"level-1"} -->
<h1 class="wp-block-heading alignwide has-text-align-wide wp-pattern-hero-slider__title has-white-color has-text-color has-link-color has-level-1-font-size" style="font-style:normal;font-weight:500;line-height:1.5">キャッチコピー<br>キャッチコピーキャッチコピー</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"wide","placeholder":"タイトルを入力...","className":"wp-pattern-hero-slider__description","style":{"elements":{"link":{"color":{"text":"var:preset|color|white"}}}},"textColor":"white","fontSize":"medium"} -->
<p class="alignwide has-text-align-wide wp-pattern-hero-slider__description has-white-color has-text-color has-link-color has-medium-font-size">テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。<br>テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover -->
```
