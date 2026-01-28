<?php
/**
 * ACF PRO の設定
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * オプションページを追加
 */
add_action( 'acf/init', function() {

	if ( ! function_exists( 'acf_add_options_page' ) ) {
	 return;
	}

	// 親ページ
	$parent = acf_add_options_page( array(
	 'menu_slug'  => 'theme-options',
	 'page_title' => 'サイト設定',
	 'menu_title' => 'サイト設定',
	 'icon_url'   => 'dashicons-nametag',
	 'position'   => 59,
	 // 'redirect' => false,
	) );

	// サブページ：初期設定
	acf_add_options_sub_page( array(
	 'menu_slug'   => 'common-options',
	 'page_title'  => '初期設定',
	 'menu_title'  => '初期設定',
	 'parent_slug' => $parent['menu_slug'],
	) );

	// サブページ：プラグイン設定
	acf_add_options_sub_page( array(
	 'menu_slug'   => 'plugins-options',
	 'page_title'  => 'プラグイン設定',
	 'menu_title'  => 'プラグイン設定',
	 'parent_slug' => $parent['menu_slug'],
	) );

});



/**
* カスタムフィールドのプレビューを有効にする
*/
if ( ! function_exists( 'get_cf_preview_id' ) ) {
	function get_cf_preview_id($post_id) {
		global $post;
		$preview_id = 0;
		if ( isset($_GET['preview'])
				&& ($post->ID == $post_id)
					&& $_GET['preview'] == true
						&&  ($post_id == url_to_postid($_SERVER['REQUEST_URI']))
			) {
			$preview = wp_get_post_autosave($post_id);
			if ($preview != false) { $preview_id = $preview->ID; }
		}
		return $preview_id;
	}
}

if ( ! function_exists( 'get_cf_preview_metadata' ) ) {
	function get_cf_preview_metadata( $meta_value, $post_id, $meta_key, $single ) {
		if ( $preview_id = get_cf_preview_id($post_id) ) {
			if ( $post_id != $preview_id ) {
				$meta_value = get_post_meta( $preview_id, $meta_key, $single );
			}
		}
		return $meta_value;
	}
}
add_filter( 'get_post_metadata', 'get_cf_preview_metadata', 10, 4 );

if ( ! function_exists( 'get_cf_preview_insert' ) ) {
	function get_cf_preview_insert( $post_id ) {
		global $wpdb;
		if ( wp_is_post_revision($post_id) ) {
			if ( isset($_POST['fields']) && count($_POST['fields']) != 0 ) {
				foreach ( $_POST['fields'] as $key => $value ) {
					$field = get_field($key);
					if ( !isset($field['name']) || !isset($field['key']) ) continue;
					if ( count(get_metadata('post', $post_id, $field['name'], $value) ) != 0) {
						update_metadata('post', $post_id, $field['name'], $value);
						update_metadata('post', $post_id, "_" . $field['name'], $field['key']);
					} else {
						add_metadata('post', $post_id, $field['name'], $value);
						add_metadata('post', $post_id, "_" . $field['name'], $field['key']);
					}
				}
			}
			do_action('save_preview_postmeta', $post_id);
		}
	}
}
add_action('wp_insert_post', 'get_cf_preview_insert' );



/**
* 管理画面の関連フィールドをカスタマイズ
*/

if ( ! function_exists( 'relationship_result_customize' ) ) {
	function relationship_result_customize( $title, $post, $field, $post_id ) {
		$page_views = get_field('p_number', $post->ID);
		if ( $page_views ) {
			$title .= ' 【' . $page_views .  '】';
		}

		return $title;
	}
}
add_filter('acf/fields/relationship/result', 'relationship_result_customize', 10, 4);



/**
* REST API に追加
*/

add_filter('acf/rest_api/field_settings/show_in_rest', '__return_true');

