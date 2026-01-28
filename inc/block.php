<?php
/**
 * ブロックの設定
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
* ブロックカテゴリーを追加
*/

if ( ! function_exists( 'add_block_categories' ) ) {
	function add_block_categories( $categories , $post ) {

		$add_categories = [
			[
				'slug' => 'theme-original',
				'title' => 'テーマオリジナル',
				'icon' => '',
			],
		];
		$categories = array_merge( $add_categories , $categories);
		return $categories;
	}
}
add_filter( 'block_categories_all', 'add_block_categories', 10, 2);




/**
* ACFブロックを追加
*/

if ( ! function_exists( 'register_acf_blocks' ) ) {
	function register_acf_blocks() {
		// // 汎用
		register_block_type( __DIR__ . '/../blocks/hamburger-menu' );
		register_block_type( __DIR__ . '/../blocks/srcset-image' );
		register_block_type( __DIR__ . '/../blocks/entry-item' );
		register_block_type( __DIR__ . '/../blocks/slider' );

	}
}
add_action( 'init', 'register_acf_blocks' );




/**
* ブロックスタイルを追加
*/

if ( function_exists( 'register_block_style' ) ) {

	// 段落
	register_block_style(
		'core/paragraph',
		array(
			'name'         => 'note',
			'label'        => '注釈',
			'is_default'   => false
		)
	);

	// 見出し
	// register_block_style(
	// 	'core/heading',
	// 	array(
	// 		'name'         => 'plain',
	// 		'label'        => '装飾なし',
	// 		'is_default'   => false
	// 	)
	// );

	// リスト
	// register_block_style (
	// 	'core/list',
	// 	array(
	// 		'name'         => 'check',
	// 		'label'        => 'チェックマーク',
	// 		'is_default'   => false
	// 	)
	// );
	// register_block_style (
	// 	'core/list',
	// 	array(
	// 		'name'         => 'check-has-white-background',
	// 		'label'        => '白背景色ありチェックマーク',
	// 		'is_default'   => false
	// 	)
	// );

	// グループ
	register_block_style(
		'core/group',
		array(
			'name'         => 'narrow-size',
			'label'        => '幅狭',
			'is_default'   => false
		)
	);
	register_block_style(
		'core/group',
		array(
			'name'         => 'stacked-on-mobile',
			'label'        => 'モバイル縦表示',
			'is_default'   => false
		)
	);

	// カラム
	register_block_style(
		'core/columns',
		array(
			'name'         => 'narrow-size',
			'label'        => '幅狭',
			'is_default'   => false
		)
	);

	// // テーブル
	// register_block_style (
	// 	'core/table',
	// 	array(
	// 		'name'         => 'horizontal-header',
	// 		'label'        => '横1列目タイトル',
	// 		'is_default'   => false
	// 	)
	// );

	// ボタン
	register_block_style (
		'core/button',
		array(
			'name'         => 'wide',
			'label'        => '幅広',
			'is_default'   => false
		)
	);
	// register_block_style (
	// 	'core/button',
	// 	array(
	// 		'name'         => 'text-type',
	// 		'label'        => 'テキストタイプ',
	// 		'is_default'   => false
	// 	)
	// );

	// register_block_style (
	// 	'flexible-table-block/table',
	// 	array(
	// 		'name'         => 'fixed',
	// 		'label'        => 'SPスクロール',
	// 		'is_default'   => false
	// 	)
	// );

	// register_block_style (
	// 	'core/gallery',
	// 	array(
	// 		'name'         => 'logo',
	// 		'label'        => 'ロゴ',
	// 		'is_default'   => false
	// 	)
	// );

	register_block_style (
		'core/cover',
		array(
			'name'         => 'full',
			'label'        => '高さ100%',
			'is_default'   => false
		)
	);

	// Plugins : Flexible Table Block
	// register_block_style (
	// 	'flexible-table-block/table',
	// 	array(
	// 		'name'         => 'horizontal',
	// 		'label'        => '行見出し型',
	// 		'is_default'   => false
	// 	)
	// );


}



/**
* カテゴリー一覧ブロックのタグを変更 ( post のみ )
*/

if ( ! function_exists( 'add_all_link_to_categories_block' ) ) {
	function add_all_link_to_categories_block( $block_content, $block ) {
		if ( $block['blockName'] === 'core/categories' ) {

			if ( is_home() || is_category()|| is_tag() ) {
				if ( is_home() ) {
					$all_link = '<li class="cat-item cat-item-all current-cat"><a href="' . esc_url( get_permalink( get_option( 'page_for_posts' ) ) ) . '">すべて</a></li>';
				} else {
					$all_link = '<li class="cat-item cat-item-all"><a href="' . esc_url( get_permalink( get_option( 'page_for_posts' ) ) ) . '">すべて</a></li>';
				}
			}

			$block_content = preg_replace( '/<ul([^>]*)>/', '<ul$1>' . $all_link, $block_content );
		}

		return $block_content;
	}
}
add_filter( 'render_block', 'add_all_link_to_categories_block', 10, 2 );



/**
* 詳細ブロックのタグを変更
*/

if ( ! function_exists( 'customize_summary_in_details_block' ) ) {
	function customize_summary_in_details_block( $block_content, $block ) {
		if ( $block['blockName'] === 'core/details' ) {
			// summaryタグの中身をspanでラップ（必要に応じてもっと精密に）
			$block_content = preg_replace_callback(
				'/\<summary\>(.*?)\<\/summary\>/s',
				function( $matches ) {
					$inner = trim( $matches[1] );
					return '<summary>' . $inner . '<span class="wp-block-details__icon"></span></summary>';
				},
				$block_content
			);
		}
		return $block_content;
	}
}
add_filter( 'render_block', 'customize_summary_in_details_block', 10, 2 );

