<?php
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * config
 */

// functions の library パス
define( 'PATH', get_template_directory_uri() );

// image のパス
define( 'IMG', get_template_directory_uri() . '/assets/images' );

// フロントページの id
define( 'ID_FRONT', get_option( 'page_on_front' ) );

// 投稿ページの id
define( 'ID_HOME', get_option( 'page_for_posts' ) );


// カスタム投稿の slug
const CP_BLOG = 'blog';

// カスタムタクソノミーの slug
const TAX_BLOG_CAT = 'blog-category';

// カスタムタクソノミーの label
const TAX_LABEL_BLOG_CAT = 'カテゴリー';

// カスタム投稿の label
define( 'CL_BLOG', __('ブログ', 'blog') );


/**
* 管理画面の設定
* - 保存時にカテゴリーのチェックの順番が入れ替わる機能を無効化
* - 固定ページ一覧にスラッグを表示する
* - post のタグをやめる
* - 固定ページのテンプレートをプレビュー時でも有効にする
* - カテゴリーの説明文を非表示に
*/
if ( locate_template( 'inc/admin.php' ) !== '' ) {
	require_once locate_template( 'inc/admin.php' );
}


/**
* エディタの設定
* - 自動整形機能を無効化する
* - editor.css を読み込む
* - 画像挿入時にwidthとheightを削除する
* - shortcodeがpタグに囲まれる機能を無効化
*/
if ( locate_template( 'inc/editor.php' ) !== '' ) {
	require_once locate_template( 'inc/editor.php' );
}


/**
* ブロックエディタ ( Gutenberg ) のカスタマイズ
* - ブロックエディター用の editor.css を読み込む
* - ブロックエディターへの変更
* - ブロックエディターのフォントサイズを変更
* - ブロックエディターのカラーパレットを変更
* - ブロックエディタの必要のものをピックアップ
*/
if ( locate_template( 'inc/gutenberg-customize.php' ) !== '' ) {
	require_once locate_template( 'inc/gutenberg-customize.php' );
}


/**
* 拡張機能の設定
* - アイキャッチ画像の設定
* - メディアで拡張子を許可
* - ページの表示件数を変更
* - 抜粋の設定
* - 投稿のパーマリンク設定
*/
if ( locate_template( 'inc/extension.php' ) !== '' ) {
	require_once locate_template( 'inc/extension.php' );
}


/**
* カスタム投稿、カスタムタクソノミーの設定
*/
if ( locate_template( 'inc/custom.php' ) !== '' ) {
	require_once locate_template( 'inc/custom.php' );
}


/**
* CSS 変数の設定
*/
if ( locate_template( 'inc/variables-style.php' ) !== '' ) {
	require_once locate_template( 'inc/variables-style.php' );
}


/**
* テンプレートで使用する関数集
*/
if ( locate_template( 'inc/templete-functions.php' ) !== '' ) {
	require_once locate_template( 'inc/templete-functions.php' );
}


/**
* テーマカスタマイザーの設定
*/
if ( locate_template( 'inc/customizer.php' ) !== '' ) {
	require_once locate_template( 'inc/customizer.php' );
}


/**
* ブロックの設定
*/
if ( locate_template( 'inc/block.php' ) !== '' ) {
	require_once locate_template( 'inc/block.php' );
}



/**
* メニューの設定
*/
if ( locate_template( 'inc/menu.php' ) !== '' ) {
	require_once locate_template( 'inc/menu.php' );
}


/**
* フロントの設定
* - 不要なタグを出力しない
* - titleタグの設定
* - css, js出力
* - body classにページスラッグを追加
* - body classにブラウザハックを追加
* - GTM, GA の挿入 ( wp_head )
* - GTM, GA の挿入 ( wp_body_open )
*/
if ( locate_template( 'inc/front.php' ) !== '' ) {
	require_once locate_template( 'inc/front.php' );
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
* ACF Pro の設定
*/
if ( locate_template( 'inc/acf.php' ) !== '' ) {
	require_once locate_template( 'inc/acf.php' );
}
