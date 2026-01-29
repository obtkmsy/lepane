<?php
/**
* 管理画面の設定
*/

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
* 自動整形機能を無効化する
*/
// NOTE: 前記事の対応
//remove_filter( 'the_content', 'wpautop' );
remove_filter( 'the_excerpt', 'wpautop' );
remove_filter( 'the_content', 'wptexturize' );
remove_filter( 'tinymce_templates_content', 'wpautop' );



/**
* editor.css を読み込む
*/
if ( ! function_exists( 'wpdocs_theme_add_editor_styles' ) ) {
	function wpdocs_theme_add_editor_styles() {

		add_theme_support( 'editor-styles' );

		add_editor_style( 'assets/css/editor.css' );

		// サイト側でblock styleを読み込む場合
		add_theme_support( 'wp-block-styles' );

		// align-wideとalign-fullを使用するためには必要
		add_theme_support('align-wide');

		// Embedコンテンツのレスポンシブ化
		add_theme_support('responsive-embeds');
	}
	add_action( 'after_setup_theme', 'wpdocs_theme_add_editor_styles' );
}



/**
 * 画像挿入時にwidthとheightを削除する
 */
if ( ! function_exists( 'remove_width_attribute' ) ) {
	function remove_width_attribute( $html ) {
		$html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
		return $html;
	}
}
add_filter( 'post_thumbnail_html', 'remove_width_attribute', 10 );
add_filter( 'image_send_to_editor', 'remove_width_attribute', 10 );



/**
 * shortcodeがpタグに囲まれる機能を無効化
 */
if ( ! function_exists( 'shortcode_empty_paragraph_fix' ) ) {
	function shortcode_empty_paragraph_fix($content) {
		$array = array (
			'<p>[' => '[',
			']</p>' => ']',
			']<br />' => ']'
		);

		$content = strtr($content, $array);
		return $content;
	}
}
add_filter('the_content', 'shortcode_empty_paragraph_fix');

