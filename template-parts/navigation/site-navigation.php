<?php
/**
 * サイトナビゲーション
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

?>


<nav class="site-navigation" role="navigation">
	<div class="site-navigation__close js-mobile-menu"></div>
	<div class="site-navigation-info">
		<p class="site-navigation-info__logo">
			<img src="<?php echo IMG; ?>/logo.png" alt="<?php bloginfo('name'); ?>">
		</p>
		<dl class="site-navigation-access sm:hidden">
			<dt>PIANO STUDIO GIFT ラウンジ</dt>
			<dd>〒141-0021<br>東京都品川区上大崎4-1-1<br>パークタワー目黒</dd>
		</dl>
		<dl class="site-navigation-access sm:hidden">
			<dt>新スタジオ</dt>
			<dd>〒141-0021<br>東京都品川区上大崎4-3-14<br>フラワーヒル目黒202号室内</dd>
		</dl>
		<ul class="site-navigation-sns">
			<a href="https://www.instagram.com/pianostudio_gift/" class="site-navigation-sns__item icon-instagram" target="_blank"></a>
			<a href="https://line.me/R/ti/p/%40804zudve" class="site-navigation-sns__item icon-line" target="_blank"></a>
			<a href="mailto:piano.studio.gift@gmail.com" class="site-navigation-sns__item icon-mail" target="_blank"></a>
			<a href="https://www.youtube.com/channel/UCSG0e7jLZOEeNWVgZuq9f9g" class="site-navigation-sns__item icon-youtube" target="_blank"></a>
		</ul>
		<a href="<?php echo home_url(); ?>/contact" class="site-navigation__contact">お問い合わせ</a>
	</div>
	<ul class="site-navigation-lists">
		<li class="site-navigation-lists__item">
			<a href="<?php echo home_url(); ?>/" class="site-navigation-lists__title">TOP</a>
		</li>
		<li class="site-navigation-lists__item">
			<span class="site-navigation-lists__title">SCHOOL</span>
			<ul class="site-navigation-sub">
				<li class="site-navigation-sub__item">
					<a href="<?php echo home_url(); ?>/studio-lounge" class="site-navigation-sub__link">大人の教室</a>
				</li>
				<li class="site-navigation-sub__item">
					<a href="<?php echo home_url(); ?>/studio-child" class="site-navigation-sub__link">子供の教室</a>
				</li>
				<li class="site-navigation-sub__item">
					<a href="<?php echo home_url(); ?>/studio-rental" class="site-navigation-sub__link">スタジオレンタル</a>
				</li>
			</ul>
		</li>
		<li class="site-navigation-lists__item">
			<a href="<?php echo home_url(); ?>/trainer" class="site-navigation-lists__title">TRAINER</a>
		</li>
		<li class="site-navigation-lists__item">
			<a href="<?php echo home_url(); ?>/information" class="site-navigation-lists__title">INFORMATION</a>
		</li>
		<li class="site-navigation-lists__item">
			<a href="<?php echo home_url(); ?>/faq" class="site-navigation-lists__title">Q&A</a>
		</li>
		<li class="site-navigation-lists__item">
			<a href="#access" class="site-navigation-lists__title">ACCESS</a>
		</li>
	</ul>
</nav>