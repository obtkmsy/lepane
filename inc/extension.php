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

// dafault : thumbnail : 0 x 0
// dafault : medium : 760 x 760

// add_image_size( 'case_thumbnail', 896, 554, true);



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
 * ページの表示件数を変更 ( 製品は全件表示 )
 */
// if ( ! function_exists( 'customize_posts_per_page' ) ) {
// 	function customize_posts_per_page($query) {
// 		if ( is_admin() || ! $query->is_main_query() ) {
// 			return;
// 		}
// 	}
// }
// add_action( 'pre_get_posts', 'customize_posts_per_page', 10, 3 );



/**
 * 検索キーワードをカスタマイズ
 */

// if ( ! function_exists( 'custom_search' ) ) {
// 	function custom_search($search, $wp_query) {
// 		global $wpdb;
// 		if ( ! $wp_query->is_search ) return $search;
// 		if ( ! isset( $wp_query->query_vars ) ) return $search;

// 		$search_words = explode( ' ', isset( $wp_query->query_vars['s'] ) ? $wp_query->query_vars['s'] : '' );
// 		if ( count( $search_words ) > 0 ) {
// 			$search = '';

// 			foreach ( $search_words as $word ) {
// 				if ( ! empty( $word ) ) {
// 					$search_word = '%' . esc_sql( $word ) . '%';
// 					$search .= " AND (
// 						{$wpdb->posts}.post_title LIKE '{$search_word}' -- タイトル
// 						OR {$wpdb->posts}.post_content LIKE '{$search_word}' -- コンテンツ
// 						OR {$wpdb->posts}.ID IN ( -- タグ、カテゴリー、ターム
// 							SELECT distinct r.object_id
// 							FROM {$wpdb->term_relationships} AS r
// 							INNER JOIN {$wpdb->term_taxonomy} AS tt ON r.term_taxonomy_id = tt.term_taxonomy_id
// 							INNER JOIN {$wpdb->terms} AS t ON tt.term_id = t.term_id
// 							WHERE t.name LIKE '{$search_word}'
// 							OR tt.description LIKE '{$search_word}'
// 						)
// 						OR {$wpdb->posts}.ID IN ( -- カスタムフィールド
// 							SELECT distinct post_id
// 							FROM {$wpdb->postmeta}
// 							WHERE {$wpdb->postmeta}.meta_key IN ('keywords','p_number','p_name') AND meta_value LIKE '{$search_word}'
// 						)
// 					)";
// 				}
// 			}
// 		}
// 		return $search;
// 	}
// }
// add_filter( 'posts_search', 'custom_search', 10, 2 );
