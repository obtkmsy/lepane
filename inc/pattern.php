<?php
/**
 * パターンの設定
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

function register_theme_pattern_categories() {

	register_block_pattern_category(
		'theme-parts',
		array(
			'label' => 'よく使うパーツ',
			'description' => '',
		)
	);

	// register_block_pattern_category(
	// 	'theme-templates',
	// 	array(
	// 		'label' => '[オリジナル] ページ作成用テンプレート',
	// 		'description' => 'ページを作る際に使用するテンプレート集',
	// 	)
	// );

	// register_block_pattern_category(
	// 	'theme-default',
	// 	array(
	// 		'label' => '[オリジナル] デフォルトパーツ',
	// 		'description' => 'テーマ専用のデフォルトパーツ',
	// 	)
	// );

}
add_action( 'init', 'register_theme_pattern_categories' );
