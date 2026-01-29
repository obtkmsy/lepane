<?php
/**
 * ヘッダー
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
}
$first_visit = !isset($_COOKIE['visited']);
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="wrapper">
	<header role="banner" class="site-header" id="js-header">
		<?php
			if ( is_front_page() ) {
		?>
			<h1 class="site-branding">
				<a href="<?php echo home_url(); ?>/" class="site-branding__link">
					<img src="<?php echo IMG; ?>/logo.png" alt="<?php bloginfo('name'); ?>">
				</a>
			</h1>
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

		<?php get_template_part('template', 'parts/navigation/site-navigation'); ?>
	</header>