<?php

/**
 * ヘッダー
 */

if (!defined('ABSPATH')) {
	exit;
}
$first_visit = !isset($_COOKIE['visited']);
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>

	<div class="wrapper">
		<header role="banner" class="site-header" id="js-header">
			<h1 class="header__caption">異業種交流会レパンは人脈作りから成果を3倍にする名刺交換会。年間4000名が参加、1回の平均は約20名（半数以上が初参加です）東京23区内・福岡・大阪・名古屋・静岡・富山・横浜・船橋・群馬・仙台・札幌で開催中。毎回半数以上が初参加！</h1>
			<div class="header__inner">
				<div class="heder__logo-area">
					<?php
					if (is_front_page()) {
					?>
						<h2 class="site-branding">
							<a href="<?php echo home_url(); ?>/" class="site-branding__link">
								<img src="<?php echo IMG; ?>/logo.png" alt="<?php bloginfo('name'); ?>">
							</a>
						</h2>
					<?php
					} else {
					?>
						<p class="site-branding">
							<a href="<?php echo home_url(); ?>/" class="site-branding__link">
								<img src="<?php echo IMG; ?>/logo.png" alt="<?php bloginfo('name'); ?>">
							</a>
						</p>
					<?php
					}
					?>
				</div>
				<nav class="site-navigation" role="navigation">
					<ul class="site-navigation-lists">
						<li class="site-navigation-lists__item">
							<a href="<?php echo home_url(); ?>/" class="site-navigation-lists__title">トップ</a>
						</li>
						<li class="site-navigation-lists__item">
							<a href="<?php echo home_url(); ?>#meeting" class="site-navigation-lists__title">交流会日程</a>
						</li>
						<li class="site-navigation-lists__item">
							<a href="<?php echo home_url(); ?>/about" class="site-navigation-lists__title">初参加ガイド</a>
						</li>
						<li class="site-navigation-lists__item">
							<a href="<?php echo home_url(); ?>/blog" class="site-navigation-lists__title">交流会ブログ</a>
						</li>
						<li class="site-navigation-lists__item">
							<a href="<?php echo home_url(); ?>/about#contact" class="site-navigation-lists__title">お問い合わせ</a>
						</li>
					</ul>
				</nav>
				<div class="toggle_btn">
					<div class="openbtn-area">
						<span></span>
						<span></span>
						<span></span>
					</div>
				</div>
				<!-- toggle_btn -->
			</div>

			<?php //get_template_part('template', 'parts/navigation/site-navigation'); 
			?>
		</header>