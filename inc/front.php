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
 * css, js出力
 */
if ( ! function_exists( 'enqueue_scripts' ) ) {
	function enqueue_scripts() {

		// css
		wp_enqueue_style( 'common-css', get_template_directory_uri() . '/assets/css/common.css', '?', '', 'all' );
		wp_enqueue_style( 'theme-css', get_template_directory_uri() . '/assets/css/app.css', '?', '', 'all' );

		// js
		wp_enqueue_script( 'theme-script', get_template_directory_uri() . '/assets/js/script.js', '?', '', '' );
	}
}
add_action( 'wp_enqueue_scripts', 'enqueue_scripts' );



/**
 * body classにページスラッグを追加
 */

if ( ! function_exists( 'is_parent_slug' ) ) {
	function is_parent_slug() {
		global $post;
		if ($post->post_parent) {
			$post_data = get_post($post->post_parent);
			return $post_data->post_name;
		}
	}
}

// ページ名クラス追加
if ( ! function_exists( 'pagename_class' ) ) {
	function pagename_class($classes) {
		if ( is_page() ) {
			$slug = get_post_field('post_name', get_the_ID());
			if ( $slug ) {
				$classes[] = $slug;
			}
		}
		return $classes;
	}
}
add_filter('body_class','pagename_class', 101, 1);



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
			}
		}
		return $classes;
	}
}

if ( ! function_exists( 'hack_add_browser_class' ) ) {
	function hack_add_browser_class($classes) {
		$classArr = array_filter(explode(' ', hack_browser_class())); // 空要素除外
		$return = array_merge($classes, $classArr);
		return $return;
	}
}
add_filter('body_class', 'hack_add_browser_class', 100, 1);



/**
 * script の挿入 ( wp_head )
 */
if ( ! function_exists( 'front_add_script' ) ) {
	function front_add_script() {
		// GTM, GA の挿入
		$option_script_head = get_field('option_script_head', 'option');
		if ( $option_script_head ) {
			echo $option_script_head .PHP_EOL;
		}
	}
}
add_action('wp_head', 'front_add_script', 0, 1);



/**
 * script の挿入 ( wp_body_open )
 */
if ( ! function_exists( 'body_open_tag' ) ) {
	function body_open_tag() {
		$option_script_body_open = get_field('option_script_body_open', 'option');
		if ( $option_script_body_open ) {
			echo $option_script_body_open .PHP_EOL;
		}
	}
}
add_filter('wp_body_open', 'body_open_tag');



/**
 * script の挿入 ( wp_footer )
 */
if ( ! function_exists( 'body_end_tag' ) ) {
	function body_end_tag() {
		$option_script_body_end = get_field('option_script_body_end', 'option');
		if ( $option_script_body_end ) {
			echo $option_script_body_end .PHP_EOL;
		}
	}
}
add_action('wp_footer', 'body_end_tag');



/**
 * previous_posts_link() と next_posts_link() にクラス付加
 */
if ( ! function_exists( 'posts_link_attributes' ) ) {
	function posts_link_attributes() {
		return 'class="pager__link"';
	}
}
add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');



/**
* content() 内のタグをハック
*/
if ( ! function_exists( 'content_tag_hack' ) ) {
	function content_tag_hack($the_content) {

		// iframe の wrapper
		// $the_content = preg_replace('/<iframe src="https:\/\/www.google.com/i', '<div class="wp-iframe-map"><iframe src="https://www.google.com', $the_content);
		// $the_content = preg_replace('/<\/iframe>/i', '</iframe></div>', $the_content);

//		// h4
//		if ( is_singular() || is_single()  ) {
//			$the_content = preg_replace('/<h4>/i', '<h4><span>', $the_content);
//			$the_content = preg_replace('/<\/h4>/i', '</span></h4>', $the_content);
//		}
//
		return $the_content;
	}
}
add_filter('the_content', 'content_tag_hack');



/**
 * フロント用の css
 */
//if ( ! function_exists( 'front_add_style' ) ) {
//	function front_add_style() {
//	}
//}
//add_action('wp_head', 'front_add_style');



/**
 * フロント用の js
 */
if ( ! function_exists( 'front_add_script' ) ) {
	function front_add_script() {

	}
}
add_action('wp_head', 'front_add_script');


//add_action('rest_api_init', 'register_rest_images' );
//function register_rest_images(){
//    register_rest_field( array('post'),
//        'fimg_url',
//        array(
//            'get_callback'    => 'get_rest_featured_image',
//            'update_callback' => null,
//            'schema'          => null,
//        )
//    );
//}
//function get_rest_featured_image( $object, $field_name, $request ) {
//    if( $object['featured_media'] ){
//        $img = wp_get_attachment_image_src( $object['featured_media'], 'app-thumb' );
//        return $img[0];
//    }
//    return false;
//}

