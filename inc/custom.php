<?php
/**
 * カスタム投稿、カスタムタクソノミーの設定
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
* custom post 「OUR STORY」を追加
*/
// if ( ! function_exists( 'create_post_type_ourstory' ) ) {
// 	function create_post_type_ourstory() {

// 		register_post_type( 'ourstory',
// 		array(
// 			'labels'         => array(
// 				'name'           => 'OUR STORY',
// 				'singular_name'  => 'OUR STORY'
// 			),
// 			'rewrite'        => array(true, 'with_front' => false),
// 			'public'         => true,
// 			'menu_position'  => 4,
// 			'has_archive'    => true,
// 			'show_in_rest'   => true,
// 			'supports'       => array(
// 					'author',
// 					'custom-fields',
// 					'revisions',
// 					'title',
// 					'editor',
// 					'thumbnail',
// 					'excerpt',
// 					'comments',
// 					'page-attributes',
// 					'trackbacks',
// 				)
// 			)
// 		);
// 	}
// }
// add_action( 'init', 'create_post_type_ourstory' );



/**
* custom taxonomy 「テスト」のカテゴリー
*/

// if ( ! function_exists( 'create_taxonomy_series_cat' ) ) {
// 	function create_taxonomy_series_cat() {
// 		register_taxonomy(
// 			TAX_TEST_CAT,
// 			array('OUR STORY'),
// 			array(
// 				'hierarchical'           => true,
// 				'update_count_callback'  => '_update_post_term_count',
// 				'label'                  => TAX_LABEL_TEST_CAT,
// 				'singular_label'         => TAX_LABEL_TEST_CAT,
// 				'public'                 => true,
// 				'show_ui'                => true,
// 				'show_in_rest'           => true
// 			)
// 		);
// 	}
// }
// add_action( 'init', 'create_taxonomy_series_cat' );
