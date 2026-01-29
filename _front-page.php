<?php
/**
 * TOP ページ
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

// get acf
// $sample = get_field('sample');

$args = array(
	'post_type' => 'post',
	'posts_per_page' => 4,
	'orderby' => 'date',
	'order' => 'DESC'
);
$the_query = new WP_Query($args);
?>

<?php get_header(); ?>

<main role="main">
	<div class="cta">
		<h3 class="cta__heading">まずは無料オンライン相談会から♪<br>気になる点を解消しましょう</h3>
		<p class="cta__text">
			「教室の雰囲気は?」<br>
			「先生の人柄はどんなかんじだろう?」<br>
			「体験レッスンに行って入会を断れない雰囲気だったらどうしよう?」など、<br>
			体験レッスンに申し込みたいと考えていても いきなりだと少し抵抗がありますよね。<br>
			GIFT ではそのような不安を解消すべく、<br>
			事前に ZOOM での相談会を行っております。<br>
			気になる点は何でもお聞きください!<br>
			心配事をなくしてから、 ゆったりとした気持ちで体験レッスンに望みましょう。 <br>
			無料オンライン相談会で皆さんにお会いすることを楽しみにしております♪
		</p>
		<a href="#" class="cta__banner">
			<img src="<?php echo IMG; ?>/banner.jpg" alt="lINE登録">
		</a>
	</div>
	<div class="access">
		<p class="access__text">
			JR・東急「目黒駅」より徒歩1分。<br class="md:hidden">
			都心の好アクセスにありながら、<br class="md:hidden">
			落ち着いて音楽に向き合える上質なスタジオです。<br>
			初めてお越しの方には、<br class="md:hidden">
			ご予約後に詳しい所在地・入館方法を<br class="md:hidden">
			ご案内いたします。
		</p>
		<div class="access-contents">
			<div class="access-map">
				<img src="<?php echo IMG; ?>/map.jpg" alt="マップ">
			</div>
			<ul class="access-studio">
				<li class="access-studio__item">
					<h4 class="access-studio__title">PIANO STUDIO GIFT ラウンジ</h4>
					<p class="access-studio__detail">
						〒141-0021<br>
						東京都品川区上大崎4-1-1 パークタワー目黒 
					</p>
					<div class="access-studio__image">
						<img src="<?php echo IMG; ?>/studio-lounge.jpg" alt="PIANO STUDIO GIFT ラウンジ">
					</div>
				</li>
				<li class="access-studio__item">
					<h4 class="access-studio__title">新スタジオ</h4>
					<p class="access-studio__detail">
						〒141-0021<br>
						東京都品川区上大崎4-3-14 フラワーヒル目黒<br class="md:hidden">202号室内
					</p>
					<div class="access-studio__image">
						<img src="<?php echo IMG; ?>/studio-new.jpg" alt="新スタジオ">
					</div>
				</li>
			</ul>
		</div>
	</div>
</main>

<?php get_footer(); ?>
