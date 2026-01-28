<?php
/**
 * リダイレクトの設定
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
* 存在しないページはリダイレクト
*/

if ( !function_exists('custom_tax_redirect') ) {

	function custom_tax_redirect() {

		// 投稿タイプ：メンバー
		// if ( is_singular(CP_MEM) ) {
		// 	wp_redirect( get_home_url(), 301 );
		// 	exit;
		// }
	}

	add_action('template_redirect', 'custom_tax_redirect');
}

