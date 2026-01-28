<?php
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * config
 */

// functions の library パス
define( 'PATH', get_template_directory_uri() );


// 言語のパス
define( 'LOCALE', get_locale() );


// image のパス
define( 'IMG', get_template_directory_uri() . '/assets/images' );


// フロントページの id
define( 'ID_FRONT', get_option( 'page_on_front' ) );


// 投稿ページの id
define( 'ID_HOME', get_option( 'page_for_posts' ) );


// カスタム投稿の slug
// const CP_SMR = 'seminar';

// カスタムタクソノミーの slug
// const TAX_STT_CAT = 'seminar-status';



/**
* 管理画面の設定
*/
if ( locate_template( 'inc/admin.php' ) !== '' ) {
	require_once locate_template( 'inc/admin.php' );
}


/**
* エディタの設定
*/
if ( locate_template( 'inc/editor.php' ) !== '' ) {
	require_once locate_template( 'inc/editor.php' );
}


/**
* ブロックエディタ ( Gutenberg ) のカスタマイズ
*/
if ( locate_template( 'inc/gutenberg-customize.php' ) !== '' ) {
	require_once locate_template( 'inc/gutenberg-customize.php' );
}


/**
* 拡張機能の設定
*/
if ( locate_template( 'inc/extension.php' ) !== '' ) {
	require_once locate_template( 'inc/extension.php' );
}


/**
* メニューの設定
*/
if ( locate_template( 'inc/menu.php' ) !== '' ) {
	require_once locate_template( 'inc/menu.php' );
}


/**
* フロントの設定
*/
if ( locate_template( 'inc/front.php' ) !== '' ) {
	require_once locate_template( 'inc/front.php' );
}


/**
* パターンの設定
*/
if ( locate_template( 'inc/pattern.php' ) !== '' ) {
	require_once locate_template( 'inc/pattern.php' );
}


/**
* ブロックの設定
*/
if ( locate_template( 'inc/block.php' ) !== '' ) {
	require_once locate_template( 'inc/block.php' );
}


/**
* テンプレートで使用する関数集
*/
if ( locate_template( 'inc/templete-functions.php' ) !== '' ) {
	require_once locate_template( 'inc/templete-functions.php' );
}


/**
* パンくずの設定
*/
if ( locate_template( 'inc/breadcrumb-function.php' ) !== '' ) {
	require_once locate_template( 'inc/breadcrumb-function.php' );
}


/**
* リダイレクトの設定
*/
if ( locate_template( 'inc/redirect.php' ) !== '' ) {
	require_once locate_template( 'inc/redirect.php' );
}


/**
* ACF Pro の設定
*/
if ( locate_template( 'inc/acf.php' ) !== '' ) {
	require_once locate_template( 'inc/acf.php' );
}


/**
* ショートコードの設定
*/
if ( locate_template( 'inc/shortcode.php' ) !== '' ) {
	require_once locate_template( 'inc/shortcode.php' );
}


/**
* プラグインのカスタマイズ設定
*/
if ( locate_template( 'inc/plugins.php' ) !== '' ) {
	require_once locate_template( 'inc/plugins.php' );
}

