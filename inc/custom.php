<?php
/**
 * カスタム投稿、カスタムタクソノミーの設定
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
* custom taxonomy 「BLOG」のカテゴリー
*/
add_action('init', function () {
	register_taxonomy(TAX_BLOG_CAT, [CP_BLOG], [
	  'label'        => TAX_LABEL_BLOG_CAT,
	  'public'       => true,
	  'show_ui'      => true,
	  'show_in_rest' => true,
	  'hierarchical' => true,
	  'rewrite'      => ['slug' => TAX_BLOG_CAT],
	]);
  
	register_post_type(CP_BLOG, [
	  'label'        => CL_BLOG,
	  'public'       => true,
	  'show_ui'      => true,
	  'show_in_menu' => true,
	  'show_in_rest' => true,
	  'supports'     => ['title','editor','thumbnail'],
	  'has_archive'  => true,
	  'taxonomies'   => [TAX_BLOG_CAT],
	  'taxonomies'   => [TAX_BLOG_CAT, 'post_tag'],
	]);
  
});