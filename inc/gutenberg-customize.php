<?php
/**
* 管理画面の設定
*/

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
* ブロックエディター用の editor.css を読み込む
*/
if ( ! function_exists( 'wpdocs_block_editor_styles' ) ) {
	function wpdocs_block_editor_styles() {
		wp_enqueue_style( 'wpdocs_block_editor_styles', get_theme_file_uri( '/assets/css/editor.css' ), false, '1.0', 'all' );
	}
	add_action( 'enqueue_block_editor_assets', 'wpdocs_block_editor_styles' );
}



/**
* ブロックエディターへの変更
*/
if ( ! function_exists( 'admin_add_html_styles' ) ) {
	function admin_add_html_styles() {
		?>
			<style>
				html {
					font-size: 62.5%;
				}
				.post-type-products .editor-styles-wrapper {
					background-color: var(--global--color-bg-primary) !important;
				}
				.post-type-products .editor-styles-wrapper .wp-block.block-library-html__edit {
					/* max-width: 100%; */
				}
			</style>
		<?php
	}
}
add_action('admin_head', 'admin_add_html_styles');


/**
 * ブロックエディタの必要のものをピックアップ
 */

// 許可ブロックの制御（WP 5.8+ 推奨フック）
add_filter( 'allowed_block_types_all', function( $allowed_block_types, $editor_context ) {
	$post_type = ( isset( $editor_context->post ) && $editor_context->post )
		? $editor_context->post->post_type
		: null;

	// 固定ページは全ブロック許可（＝パターンも全部出る）
	if ( $post_type === 'page' ) {
		return true; // これで全許可
	}

	// それ以外の投稿タイプは従来のリストで制限
	$allowed = array(
		// ACF
		'acf/banner',
		'acf/qa-list',
		'acf/course-list',
		'acf/main-slider',
		// Snow Monkey Forms
		'snow-monkey-forms/form',

		// 一般
		'core/paragraph','core/heading','core/image','core/list','core/quote',
		'core/audio','core/cover','core/file','core/video',

		// フォーマット
		'core/preformatted','core/table','core/code','core/freeform','core/html','core/pullquote',

		// レイアウト
		'core/buttons','core/button','core/columns','core/column','core/group',
		'core/media-text','core/separator','core/spacer', // spacer を許可に戻す

		// 最近のレイアウト（パターンで使用頻度高）
		'core/row','core/stack',

		// ウィジェット/埋め込み 等
		'core/shortcode','core/embed',

		// ナビ系（使うパターンがあるなら）
		'core/navigation','core/page-list',

		// 再利用ブロック
		'core/block',
	);

	return $allowed;
}, 10, 2 );




/**
* ブロックパターンの初期のものを削除
*/

// if ( ! function_exists( 'remove_default_block_pattern' ) ) {
// 	function remove_default_block_pattern() {
// 		$patterns = [
// 			'core/two-buttons',                  // 2ボタン
// 			'core/three-buttons',                // 3つのボタン
// 			'core/text-two-columns',             // 2カラムのテキスト
// 			'core/text-two-columns-with-images', // 画像を含む2カラムのテキスト
// 			'core/text-three-columns-buttons',   // ボタンを含む3カラムのテキスト
// 			'core/two-images',                   // 2つ並べて表示された画像
// 			'core/large-header',                 // 見出しを含む大きなヘッダー
// 			'core/large-header-button',          // 見出しとボタンを含む大きなヘッダー
// 			'core/heading-paragraph',            // 見出しと段落
// 			'core/quote',                        // 引用
// 		];
// 		foreach ( $patterns as $pattern ) {
// 			unregister_block_pattern( $pattern );
// 		}
// 	}
// }
// add_action( 'init', 'remove_default_block_pattern' );


