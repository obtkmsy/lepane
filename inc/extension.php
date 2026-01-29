<?php
/**
 * 拡張機能の設定
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
* アイキャッチ画像の設定
*/
add_theme_support( 'post-thumbnails' );
// add_image_size( 'thumbnail_sample', 460, 460, true);


/**
 * メディアで拡張子を許可
 */
if ( ! function_exists( 'set_mime_types' ) ) {
	function set_mime_types($mimes) {
		$mimes['svg'] = 'image/svg+xml';
		return $mimes;
	}
}
add_filter('upload_mimes', 'set_mime_types');


/**
* 抜粋の設定
*/
if ( ! function_exists( 'post_excerpt' ) ) {
	function post_excerpt( $length, $id ) {
		$excerpt = '';
		if ( $id ) {
			$post = get_post( $id );
		} else {
			$post = get_post( get_the_ID() );
		}
		if ( $post->post_excerpt != '' ) {
			$excerpt = $post->post_excerpt;
		} else {
			$excerpt = $post->post_content;
		}

		if ( $length ) {
			$excerpt_text = mb_substr( strip_tags($excerpt), 0, $length ) . '...';
		} else {
			$excerpt_text = mb_substr( strip_tags($excerpt), 0, 55 ) . '...';
		}

		$excerpt_text = preg_replace('/(?:\n|\r|\r\n)/', '', $excerpt_text );

		return $excerpt_text;
	}
}
