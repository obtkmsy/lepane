<?php
/**
 * カスタム投稿、カスタムタクソノミーの設定
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
* custom taxonomy 「MEETING」のカテゴリー
*/
add_action('init', function () {
	register_taxonomy(TAX_MEETING_CAT, [CP_MEETING], [
		'label'        => TAX_LABEL_MEETING_CAT,
		'public'       => true,
		'show_ui'      => true,
		'show_in_rest' => true,
		'hierarchical' => true,
		'rewrite'      => [
			'slug' => 'meeting',
			'with_front' => false,
		],
	]);
  
	register_post_type(CP_MEETING, [
		'label'        => CL_MEETING,
		'public'       => true,
		'show_ui'      => true,
		'show_in_menu' => true,
		'show_in_rest' => true,
		'supports'     => ['title','editor','thumbnail'],
		'has_archive'  => true,
		'rewrite'      => [
		  'slug'       => 'meeting',
		  'with_front' => false,
		],
		'taxonomies'   => [TAX_MEETING_CAT, 'post_tag'],
	]);
  
});