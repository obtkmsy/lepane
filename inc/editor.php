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

// NOTE: 旧記事を活かすためにコメントアウト
//remove_filter( 'the_content', 'wpautop' );
//remove_filter( 'the_excerpt', 'wpautop' );
//remove_filter( 'the_content', 'wptexturize' );
//remove_filter( 'tinymce_templates_content', 'wpautop' );



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
* ビジュアルエディタ id 削除機能を無効化
*/
if ( ! function_exists( 'tinymce_init' ) ) {
	function tinymce_init( $init ) {
		$init['verify_html'] = false;
		return $init;
	}
}
add_filter('tiny_mce_before_init', 'tinymce_init');



/**
 * ビジュアルエディタの余計な機能を無効化
 *
 * 全てのタグ・全ての属性を許可する
 * <a> タグに全てのタグを入れられるようにする
 * 自動的に <p> タグで囲われることを防ぐ
 */
if ( ! function_exists( 'override_mce_options' ) ) {
	function override_mce_options( $init_array ) {
		global $allowedposttags;

		$init_array['valid_elements']          = '*[*]';
		$init_array['extended_valid_elements'] = '*[*]';
		$init_array['valid_children']          = '+a[' . implode( '|', array_keys( $allowedposttags ) ) . ']';
		$init_array['indent']                  = true;
		$init_array['wpautop']                 = false;
		$init_array['force_p_newlines']        = false;

		return $init_array;
	}
}
add_filter( 'tiny_mce_before_init', 'override_mce_options' );



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



/**
* 投稿タイプごとに幅を変更
*/
if ( ! function_exists( 'admin_add_html_styles' ) ) {
	function admin_add_html_styles() {
		/*
		?>
			<style>
				.post-type-post .editor-styles-wrapper .wp-block {
					max-width: 928px;
				}
			</style>
		<?php
		*/
	}
}
add_action('admin_head', 'admin_add_html_styles');



/**
 * ブロックエディタのツールバーのカスタマイズ js を読み込み
 */

function enqueue_custom_toolbar_script() {
	wp_enqueue_script(
		'custom-toolbar-button',
		get_template_directory_uri() . '/admin/editor.js',
		array(
			'wp-plugins',
			'wp-edit-post',
			'wp-element',
			'wp-components',
			'wp-data',
			'wp-block-editor'
		),
		filemtime( get_template_directory() . '/admin/editor.js' ),
		true
	);
}
add_action( 'enqueue_block_editor_assets', 'enqueue_custom_toolbar_script' );



/**
 * width-toolbar.jsをブロックエディタにだけ読み込む
 */

// add_action('enqueue_block_editor_assets', function() {
// 	// テーマディレクトリ直下やassets/js/配下など、パスは任意でOK
// 	wp_enqueue_script(
// 		'theme-width-toolbar',
// 		get_template_directory_uri() . '/admin/width-toolbar.js',
// 		array('wp-blocks', 'wp-element', 'wp-edit-post', 'wp-components', 'wp-compose'),
// 		filemtime(get_template_directory() . '/admin/width-toolbar.js'),
// 		true
// 	);
// });



