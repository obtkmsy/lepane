<?php

/**
 * フッター
 */

if (!defined('ABSPATH')) {
	exit;
}
?>

<footer role="contentinfo" class="site-footer">
	<div class="footer__inner">
		<h2 class="site-branding">
			<a href="<?php echo home_url(); ?>/" class="site-branding__link">
				<img src="<?php echo IMG; ?>/logo.png" alt="<?php bloginfo('name'); ?>">
			</a>
		</h2>
		<ul class="footer-navigation-lists">
			<li class="footer-navigation-lists__item">
				<a href="<?php echo home_url(); ?>/" class="footer-navigation-lists__title">トップ</a>
			</li>
			<li class="footer-navigation-lists__item">
				<a href="<?php echo home_url(); ?>/schedule" class="footer-navigation-lists__title">交流会日程</a>
			</li>
			<li class="footer-navigation-lists__item">
				<a href="<?php echo home_url(); ?>/about" class="footer-navigation-lists__title">初参加ガイド</a>
			</li>
			<li class="footer-navigation-lists__item">
				<a href="<?php echo home_url(); ?>/blog" class="footer-navigation-lists__title">交流会ブログ</a>
			</li>
			<li class="footer-navigation-lists__item">
				<a href="<?php echo home_url(); ?>/about#contact" class="footer-navigation-lists__title">お問い合わせ</a>
			</li>
		</ul>
	</div>
	<p class="copyright">
		<small>Copyright © LEPANE All Rights Reserved.</small>
	</p>
</footer>

<!-- /.wrap --></div>

<?php wp_footer(); ?>

</body>

</html>