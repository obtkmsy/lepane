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
register_nav_menus(
	array(
		'header_menu'     => 'ヘッダーメニュー',
		'footer_menu'     => 'フッターメニュー',
		'footer_sub_menu' => 'フッターサブメニュー',
	)
);


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
 * デフォルトで nav_menu に span タグを挿入する
 */
//if ( ! function_exists( 'modify_menu_insert' ) ) {
//	function modify_menu_insert( $args ) {
//
//		$args['after'] = '<span></span>';
//
//		return $args;
//	}
//}
//add_filter( 'wp_nav_menu_args', 'modify_menu_insert' );


/**
 * Walker_Nav_Menu の設定
 */

/**
 * ヘッダーメニュー
 */
class header_menu_walker extends Walker_Nav_Menu {
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		global $wp_query;
		$output .= '<ul class="header-menu-child js-header-menu-child">';
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
		$output .= 'header-menu-item';

		if ( in_array('menu-item-has-children', $item->classes) ) {
			$output .= ' has-children';
		}

		// current の場合は active 表示
		if ( in_array('current_page_item', $item->classes) || in_array('current-menu-item', $item->classes) ) {
			$output .= ' header-menu-item--active';
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

		$item_output .= '<a'. $attributes .' class="header-menu-item__link">';
		// $item_output .= '<span class="header-menu-item__title">';

		// $item_output .= '<span class="header-menu-item__link-inner">' . $args->link_before . '' . apply_filters( 'the_title', $item->title, $item->ID ) . '' . $args->link_after . '</span>';
		$item_output .= $args->link_before . '' . apply_filters( 'the_title', $item->title, $item->ID ) . '' . $args->link_after;
		// $item_output .= '</span>';
		if ( $item->description ) {
			$item_output .= '<span class="header-menu-item__sub">' . $item->description . '</span>';
		}
		$item_output .= '</a>';

		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args, $current_object_id );
	}
}



/**
 * フッターサブメニュー
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
		// if ( in_array('current_page_item', $item->classes) || in_array('current-menu-item', $item->classes) ) {
			// $output .= ' footer-menu-item--active';
		// }

		// 管理画面側で class がある場合も表示
		if ( $item->classes[0] != '' ) {
			$output .= ' ' . $item->classes[0];
		}
		$output .= '">';

		$url = $item->url;

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $url              ) .'"' : '';
		$item_output = $args->before;

		$item_output .= '<a'. $attributes .' class="footer-menu-item__link">';

		$item_output .= $args->link_before . '' . apply_filters( 'the_title', $item->title, $item->ID ) . '' . $args->link_after;
		// $item_output .= '</span>';
		// if ( $item->description ) {
			// $item_output .= '<span class="footer-menu-item__sub">' . $item->description . '</span>';
		// }
		$item_output .= '</a>';

		if ( in_array('menu-item-has-children', $item->classes) ) {
			$item_output .= '<a href="javascript:void(0);" class="js-footer-menu-toggle footer-menu-item__toggle"></a>';
		}

		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args, $current_object_id );
	}
}



/**
 * フッターサブメニュー
 */

class footer_sub_menu_walker extends Walker_Nav_Menu {
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		global $wp_query;
		$output .= '<ul class="footer-sub-menu-child">';
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
		$output .= 'footer-sub-menu-item';

		// current の場合は active 表示
		if ( in_array('current_page_item', $item->classes) || in_array('current-menu-item', $item->classes) ) {
			$output .= ' footer-sub-menu-item--active';
		}
		// 管理画面側で class がある場合も表示
		if ( $item->classes[0] != '' ) {
			$output .= ' ' . $item->classes[0];
		}
		$output .= '">';

		$url = $item->url;

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $url              ) .'"' : '';
		$item_output = $args->before;

		$item_output .= '<a'. $attributes .' class="footer-sub-menu-item__link">';

		$item_output .= $args->link_before . '' . apply_filters( 'the_title', $item->title, $item->ID ) . '' . $args->link_after;
		// $item_output .= '</span>';
		// if ( $item->description ) {
			// $item_output .= '<span class="footer-sub-menu-item__sub">' . $item->description . '</span>';
		// }
		$item_output .= '</a>';

		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args, $current_object_id );
	}
}

