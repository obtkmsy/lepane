<?php
/**
* 管理画面の設定
*/

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * 保存時にカテゴリーのチェックの順番が入れ替わる機能を無効化
 */
if ( ! function_exists( 'wp_terms_checklist_args_fix' ) ) {
	function wp_terms_checklist_args_fix ( $args, $post_id ) {
		$args['checked_ontop'] = false;
		return $args;
	}
}
add_filter('wp_terms_checklist_args', 'wp_terms_checklist_args_fix', 10, 2);


/**
 * 固定ページ一覧にスラッグを表示する
 */

if ( ! function_exists( 'add_page_columns_name_slug' ) ) {
	function add_page_columns_name_slug( $columns ) {
		$date_escape = $columns['date'];
		unset($columns['date']);
		$columns['slug'] = 'スラッグ';
		$columns['date'] = $date_escape;
		return $columns;
	}
}
add_filter( 'manage_pages_columns', 'add_page_columns_name_slug');

if ( ! function_exists( 'add_page_column' ) ) {
	function add_page_column( $column_name, $post_id ) {
		if( $column_name == 'slug' ) {
			$post = get_post($post_id);
			$slug = $post->post_name;
			echo esc_attr($slug);
		}
	}
}
add_action( 'manage_pages_custom_column', 'add_page_column', 10, 2);


/**
* post のタグをやめる
*/

if ( ! function_exists( 'my_unregister_tags' ) ) {
	function my_unregister_tags() {
		global $wp_taxonomies;

		if (!empty($wp_taxonomies['post_tag']->object_type)) {
			foreach ($wp_taxonomies['post_tag']->object_type as $i => $object_type) {
				if ($object_type == 'post') {
					unset($wp_taxonomies['post_tag']->object_type[$i]);
				}
			}
		}

		return true;
	}
}

add_action('init', 'my_unregister_tags');



/**
 * 固定ページのテンプレートをプレビュー時でも有効にする
 */
if ( ! function_exists( 'templete_preview_available' ) ) {
	function templete_preview_available($return, $post_id, $meta_key, $single) {
		global $post;
		$page_template_key='_wp_page_template';
		if (($meta_key==$page_template_key) && isset($post) && $post->ID == $post_id && is_preview()){
			//プレビュー状態のとき
			global $wpdb;
			$return=$wpdb->get_var($wpdb->prepare("SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = %s AND post_id = %d",$page_template_key,$post_id));
		}
		return $return;
	}
}
add_filter('get_post_metadata', 'templete_preview_available', 20, 4);



/**
 * カテゴリーの説明文を非表示に
 */
if ( ! function_exists( 'hide_description_row' ) ) {
	function hide_description_row() {
		echo '<style> .term-description-wrap { display: none; } </style>';
	}
}
add_action( 'category_edit_form', 'hide_description_row');
add_action( 'category_add_form', 'hide_description_row');
//add_action( 'faq-category_edit_form', 'hide_description_row');
//add_action( 'blog-cat_add_form', 'hide_description_row');



/**
 * デバイス別改行のショートコード
 * [br-sp], [br-pc]
 */
if ( ! function_exists( 'br_sp' ) ) {
	function br_sp() {
		return '<br class="md:hidden">';
	}
}
add_shortcode('br-sp', 'br_sp');

if ( ! function_exists( 'br_pc' ) ) {
	function br_pc() {
		return '<br class="sm:hidden">';
	}
}
add_shortcode('br-pc', 'br_pc');



add_filter( 'post_thumbnail_html', function( $html, $post_id, $post_thumbnail_id, $size, $attr ) {

	// 既にアイキャッチが出力されている場合はそのまま
	if ( ! empty( $html ) ) {
		return $html;
	}

	// 代替画像のパス（テーマ内に配置しておく）
	// 例：/assets/img/noimage-*.webp を用意
	$map = array(
		'thumbnail' => get_theme_file_uri( '/assets/images/thumbnail.jpg' ),
		'medium'    => get_theme_file_uri( '/assets/images/thumbnail.jpg' ),
		'large'     => get_theme_file_uri( '/assets/images/thumbnail.jpg' ),
		'full'      => get_theme_file_uri( '/assets/images/thumbnail.jpg' ),
	);

	// $size は文字列 or 配列のことがある
	$key = is_string( $size ) ? $size : 'full';
	$src = isset( $map[ $key ] ) ? $map[ $key ] : $map['full'];

	// 既存クラスを維持しつつ、判別用クラスを付与
	$class = 'wp-post-image is-fallback';
	if ( is_array( $attr ) && ! empty( $attr['class'] ) ) {
		$class = trim( $attr['class'] . ' is-fallback' );
	}

	// ALT は記事タイトルを使用（必要に応じて固定文言でもOK）
	$alt = esc_attr( get_the_title( $post_id ) );

	return sprintf(
		'<img src="%s" alt="%s" class="%s" loading="lazy" decoding="async" />',
		esc_url( $src ),
		$alt,
		esc_attr( $class )
	);
}, 10, 5 );



// 初回のみローディングを表示
add_action('send_headers', function() {
    if (!isset($_COOKIE['visited'])) {
        setcookie('visited', '1', time() + 60*60*24*30, '/wpnew');
    }
});