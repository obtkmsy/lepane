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
		register_block_type( __DIR__ . '/../blocks/qa-list' );
		// register_block_type( __DIR__ . '/../blocks/banner' );
		// register_block_type( __DIR__ . '/../blocks/course-list' );
		// register_block_type( __DIR__ . '/../blocks/main-slider' );
	}
}
add_action( 'init', 'register_acf_blocks' );




/**
* ブロックスタイルを追加
*/

if ( function_exists( 'register_block_style' ) ) {

	register_block_style(
		'core/paragraph',
		array(
			'name'         => 'note',
			'label'        => '注釈',
			'is_default'   => false
		)
	);

	register_block_style(
		'core/paragraph',
		[
			'name'  => 'pc-center-sp-left',
			'label' => 'PC中央 / SP左',
			'inline_style' => '
				.is-style-pc-center-sp-left { text-align: left!important; }
				@media (min-width: 960px) {
					.is-style-pc-center-sp-left { text-align: center!important; }
				}
			',
		]
	);

	// 見出し
	register_block_style(
		'core/heading',
		array(
			'name'         => 'plain',
			'label'        => '装飾なし',
			'is_default'   => false
		)
	);

	register_block_style(
		'core/heading',
		array(
			'name'         => 'band-heading',
			'label'        => '帯付き見出し',
			'is_default'   => false
		)
	);

	register_block_style(
		'core/heading',
		array(
			'name'         => 'mincho-heading',
			'label'        => '明朝見出し',
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
		'core/buttons',
		array(
			'name'         => 'anchor',
			'label'        => 'アンカー',
			'is_default'   => false
		)
	);


}

