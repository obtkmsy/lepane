<?php
/**
 * フロントの設定
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * 不要なタグを出力しない
 */
// link rel='index' タグを削除
remove_action( 'wp_head', 'index_rel_link');

// prev link remove
remove_action( 'wp_head', 'parent_post_rel_link', 10);

// link rel='start' タグを削除
remove_action( 'wp_head', 'start_post_rel_link', 10);

// Post Relational Links
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10);

// Really Simple Discovery
remove_action( 'wp_head', 'rsd_link');

// windows Live Writer
remove_action( 'wp_head', 'wlwmanifest_link');

// wordpress Generator
remove_action( 'wp_head', 'wp_generator');

// comment feed
remove_action( 'wp_head', 'feed_links_extra', 3, 0);

// shortlink 削除
remove_action( 'wp_head', 'wp_shortlink_wp_head');

// emoji remove
remove_action( 'wp_head', 'print_emoji_detection_script', 7);

// emoji remove
remove_action( 'wp_print_styles', 'print_emoji_styles' );

// HTML の Head 内に oEmbed スクリプトを出力させない
// remove_action( 'wp_head','wp_oembed_add_host_js' );



/**
 * titleタグの設定
 */
if ( ! function_exists( 'titletag_setup' ) ) {
	function titletag_setup() {
		add_theme_support( 'title-tag' );
	}
}
add_action( 'after_setup_theme', 'titletag_setup' );

// タイトルからキャッチフレーズを削除する
if ( ! function_exists( 'remove_tagline' ) ) {
	function remove_tagline($title) {
		if ( isset($title['tagline']) ) {
			unset( $title['tagline'] );
		}
		return $title;
	}
}
add_filter( 'document_title_parts', 'remove_tagline' );

// セパレータを任意のものに変更する
if ( ! function_exists( 'custom_title_separator' ) ) {
	function custom_title_separator($sep) {
		$sep = '|';
		return $sep;
	}
}
add_filter( 'document_title_separator', 'custom_title_separator' );



/**
 * css, js出力
 */
if ( ! function_exists( 'enqueue_scripts' ) ) {
	function enqueue_scripts() {

		// css
		wp_enqueue_style( 'theme-css', get_template_directory_uri() . '/assets/css/app.css', '?', rand(), 'all' );

		// js
		wp_enqueue_script( 'ponyfill', '//cdn.jsdelivr.net/gh/nuxodin/ie11CustomProperties@4.1.0/ie11CustomProperties.min.js', '', '', '' );
		wp_enqueue_script(
			'swiper',
			'https://unpkg.com/swiper@11/swiper-bundle.min.js',
			[],
			null,
			true
		);
		wp_enqueue_script( 'theme-script', get_template_directory_uri() . '/assets/js/script.js', ['jquery'], rand(), true );
	}
}
add_action( 'wp_enqueue_scripts', 'enqueue_scripts' );



/**
 * body classにページスラッグを追加
 */
if ( ! function_exists( 'pagename_class' ) ) {
	function pagename_class($classes = '') {
		if (is_page()) {
			$page = get_page(get_the_ID());
			$classes[] = $page->post_name;
		}
		return $classes;
	}
}
add_filter('body_class','pagename_class');

if ( ! function_exists( 'is_parent_slug' ) ) {
	function is_parent_slug() {
		global $post;
		if ($post->post_parent) {
			$post_data = get_post($post->post_parent);
			return $post_data->post_name;
		}
	}
}
add_filter('body_class','add_posttype_classes');

if ( ! function_exists( 'locale_class' ) ) {
	function locale_class($classes = '') {
		$locale = get_locale();
		$classes[] = 'lang-' . $locale;
		return $classes;
	}
}
add_filter('body_class','locale_class');

if ( ! function_exists( 'add_posttype_classes' ) ) {
	function add_posttype_classes($classes) {
		$postype = get_query_var('post_type');
		$classes[] = $postype;
		if( !$postype == '' ){
			$m_key = array_search('home', $classes);
			unset($classes[${'m_key'}]);
		}
		return $classes;
	}
}


/**
 * body classにブラウザハックを追加
 */
if ( ! function_exists( 'hack_browser_class' ) ) {
	function hack_browser_class(){
		$classes = '';
		$agent = getenv('HTTP_USER_AGENT');

		if(preg_match('/Trident/',$agent)){
			$classes .= 'msie ';
			if(preg_match('/MSIE 9.0/',$agent)) $classes .= 'ie9';
		}else{
			$classes .= 'noie ';
			if(preg_match('/Firefox/', $agent)){
				$classes .= 'firefox';
			}
			elseif(preg_match('/Chrome/', $agent)){
				$classes .= 'chrome';
			}
			elseif(preg_match('/Safari/', $agent)){
				$classes .= 'safari';
			}
			elseif(preg_match('/Opera/', $agent)){
				$classes .= 'opera';
			}
			elseif(preg_match('/iPhone/',$agent)) {
				$classes .= 'iphone';
			}
			elseif(preg_match('/iPad/',$agent)) {
				$classes .= 'ipad';
			}
			elseif(preg_match('/Android/',$agent)) {
				$classes .= 'android';
			}else{
				//other
			}
		}
		return $classes;
	}
}

if ( ! function_exists( 'hack_add_browser_class' ) ) {
	function hack_add_browser_class($classes) {
		$classArr = explode(' ' ,hack_browser_class());
		$return = array_merge($classes,$classArr);
		return $return;
	}
}
add_filter('body_class', 'hack_add_browser_class');



/**
 * GTM, GA の挿入 ( wp_head )
 */
// if ( ! function_exists( 'front_add_google' ) ) {
// 	function front_add_google() {
// 		// GTM, GA の挿入
// 		$option_google_head = get_field('option_google_head', 'option');
// 		if ( $option_google_head ) {
// 			echo $option_google_head .PHP_EOL;
// 		}
// 	}
// }
// add_action('wp_head', 'front_add_google', 0, 1);



/**
 * GTM, GA の挿入 ( wp_body_open )
 */
// if ( ! function_exists( 'body_open_tag' ) ) {
// 	function body_open_tag() {
// 		$option_google_body = get_field('option_google_body', 'option');
// 		if ( $option_google_body ) {
// 			echo $option_google_body .PHP_EOL;
// 		}
// 	}
// }
// add_filter('wp_body_open', 'body_open_tag');
