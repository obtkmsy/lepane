<?php
/**
 * Block Template : 投稿一覧のアイテム
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

// id 属性 (anchor)
// NOTE: 不使用
// $anchor = '';
// if ( ! empty( $block['anchor'] ) ) {
// 	$anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
// }

// class 属性
$class_name = 'has-global-padding wp-block-acf-site-menu-button wp-block-site-menu-button';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}

// align 属性
// NOTE: 不使用
// if ( ! empty( $block['align'] ) ) {
// 	$class_name .= ' align' . $block['align'];
// }


// style 属性
// get_block_wrapper_attributes() 関数で style 属性のみを取得
$styles = '';
if ( function_exists( 'get_block_wrapper_attributes' ) && isset( $block['name'] ) ) {
	$attributes = get_block_wrapper_attributes();
	if (preg_match('/style="([^"]*)"/', $attributes, $matches)) {
		$styles = $matches[1];
	}
}


// data 属性
// get_block_wrapper_attributes() 関数で data 属性のみを取得
$data_attributes = '';
if ( function_exists( 'get_block_wrapper_attributes' ) && isset( $block['name'] ) ) {
	if (!function_exists('get_data_attributes_only')) {
		function get_data_attributes_only() {
			$attributes_all = get_block_wrapper_attributes();
			preg_match_all('/\bdata-[^=]+="[^"]*"/', $attributes_all, $matches);
			return implode(' ', $matches[0]);
		}
	}
	$data_attributes = get_data_attributes_only();
}

?>

<a id="js-mobile-menu" <?php echo get_block_wrapper_attributes( [ 'class' => $class_name ] ); ?>>

	<span class="dropdown-icon">
		<span class="dropdown-icon__line"></span>
		<span class="dropdown-icon__line"></span>
	</span>

</a>
