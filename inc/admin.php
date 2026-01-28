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
 * 固定ページに抜粋を入れる
 */

add_post_type_support( 'page', 'excerpt' );



/**
* 別テンプレートの場合クラスを付与する
*/
// if ( ! function_exists( 'custom_admin_body_class' ) ) {
// 	function custom_admin_body_class( $classes ) {

// 		global $post;

// 		if ( isset( $post->ID ) ) {
// 			$page_template = get_page_template_slug( $post->ID );
// 			if ( $page_template == 'page-background-gray.php' ) {
// 				return $classes. ' page-background-gray';
// 			}
// 			if ( $page_template == 'page-door.php' ) {
// 				return $classes. ' page-background-gray';
// 			}
// 		}
// 		return $classes;
// 	}
// }
// add_filter( 'admin_body_class', 'custom_admin_body_class' );



/**
* 管理画面に CSS を読み込む
*/
// if ( ! function_exists( 'add_admin_style' ) ) {
// 	function add_admin_style(){
// 		$path_css = '//fonts.googleapis.com/css2?family=Material+Symbols+Outlined';
// 		wp_enqueue_style('admin-font-css', $path_css);
// 	}
// }
// add_action('admin_enqueue_scripts', 'add_admin_style');

