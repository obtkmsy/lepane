<?php
/**
 * メニューの設定
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * メニューの登録
 */
// register_nav_menus(
// 	array(
// 		'site_menu' => 'サイトメニュー',
// 	)
// );


/**
 * デフォルトで nav_menu の自動付与される li の id を削除する。
 */
if ( ! function_exists( 'remove_menu_id' ) ) {
	function remove_menu_id( $id ) {
		return $id = array();
	}
}
add_filter('nav_menu_item_id', 'remove_menu_id', 10);


/**
 * デフォルトで nav_menu の自動付与されるコンテナと ul の id を削除する。
 */
if ( ! function_exists( 'nav_menu_args_remove' ) ) {
	function nav_menu_args_remove($args = ''){
		$args['container']  = false;
		return $args;
	}
}
add_filter('wp_nav_menu_args', 'nav_menu_args_remove');



/**
 * 特定の class がある場合に nav_menu に アコーディオン用のタグを挿入する
 */
function my_custom_menu_item_output( $item_output, $item, $depth, $args ) {
	// 特定のCSSクラスが含まれているかチェック
	if ( in_array( 'is-parent', $item->classes ) ) {
		// 追加するリンクのHTMLを定義
		$button_html = '<a href="javascript:void(0)" class="menu-toggle-button js-menu-toggle"></a>';
		// 既存の出力に追加
		$item_output .= $button_html;
	}
	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'my_custom_menu_item_output', 10, 4 );


/**
 * Walker_Nav_Menu の設定
 */

/**
 * ヘッダーメニュー
 */
class site_menu_walker extends Walker_Nav_Menu {
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		global $wp_query;
		$output .= '<ul class="site-menu-child js-site-menu-child">';
	}

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0, $current_object_id = 0 ) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$classes = empty ( $item->classes ) ? array () : (array) $item->classes;
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$class_names = join(
								' ',
								apply_filters
									(
										'nav_menu_css_class',
										array_filter( $classes ),
										$item
									)
							);

		$output .= $indent . '<li class="';
		$output .= 'site-menu-item';

		if ( in_array('menu-item-has-children', $item->classes) ) {
			$output .= ' has-children';
		}

		// current の場合は active 表示
		if ( in_array('current_page_item', $item->classes) || in_array('current-menu-item', $item->classes) ) {
			$output .= ' site-menu-item--active';
		}
		// 管理画面側で class がある場合も表示
		if ( $item->classes[0] != '' ) {
			$output .= ' ' . $item->classes[0];
		}
		if ( $item->classes[1] != '' ) {
			$output .= ' ' . $item->classes[1];
		}
		$output .= '">';

		// front のページ内リンク
		if ( is_front_page() ) {
			if ( in_array('self', $item->classes) ) {
				$url = $item->url;
				$host = home_url();
				$anchor = str_replace($host, '', $item->url);
				$url = $anchor;
			} else {
				$url = $item->url;
			}
		} else {
			$url = $item->url;
		}

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $url              ) .'"' : '';
		$item_output = $args->before;

		$item_output .= '<a'. $attributes .' class="site-menu-item__link"><span>';
		// $item_output .= '<span class="site-menu-item__title">';

		// $item_output .= '<span class="site-menu-item__link-inner">' . $args->link_before . '' . apply_filters( 'the_title', $item->title, $item->ID ) . '' . $args->link_after . '</span>';

		if ( $item->target ) {
			$item_output .= $args->link_before . '<span>' . apply_filters( 'the_title', $item->title, $item->ID ) . '</span>' . $args->link_after;
		} else {
			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		}

		// $item_output .= '</span>';
		if ( $item->description ) {
			$item_output .= '<span class="site-menu-item__sub">' . $item->description . '</span>';
		}
		$item_output .= '</span></a>';

		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args, $current_object_id );
	}
}



/**
 * フッターメニュー
 */

class footer_menu_walker extends Walker_Nav_Menu {
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		global $wp_query;
		$output .= '<ul class="footer-menu-child">';
	}

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0, $current_object_id = 0 ) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$classes = empty ( $item->classes ) ? array () : (array) $item->classes;
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$class_names = join(
								' ',
								apply_filters
									(
										'nav_menu_css_class',
										array_filter( $classes ),
										$item
									)
							);

		$output .= $indent . '<li class="';
		$output .= 'footer-menu-item';

		// current の場合は active 表示
		if ( in_array('current_page_item', $item->classes) || in_array('current-menu-item', $item->classes) ) {
			$output .= ' footer-menu-item--active';
		}
		// 管理画面側で class がある場合も表示
		if ( $item->classes[0] != '' ) {
			$output .= ' ' . $item->classes[0];
		}
		$output .= '">';

		// front のページ内リンク
		if ( is_front_page() ) {
			if ( in_array('self', $item->classes) ) {
				$url = $item->url;
				$host = home_url();
				$anchor = str_replace($host, '', $item->url);
				$url = $anchor;
			} else {
				$url = $item->url;
			}
		} else {
			$url = $item->url;
		}

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $url              ) .'"' : '';
		$item_output = $args->before;

		$item_output .= '<a'. $attributes .' class="footer-menu-item__link">';
		// $item_output .= '<span class="footer-menu-item__title">';

		// $item_output .= '<span class="footer-menu-item__link-inner">' . $args->link_before . '' . apply_filters( 'the_title', $item->title, $item->ID ) . '' . $args->link_after . '</span>';
		$item_output .= $args->link_before . '' . apply_filters( 'the_title', $item->title, $item->ID ) . '' . $args->link_after;
		// $item_output .= '</span>';
		if ( $item->description ) {
			$item_output .= '<span class="footer-menu-item__sub">' . $item->description . '</span>';
		}
		$item_output .= '</a>';

		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args, $current_object_id );
	}
}

