<?php
/**
 * Block Template : バナー
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

$block_banner = get_field( 'block_banner' );

// id 属性 (anchor)
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
	$anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// class 属性
$class_name = 'has-global-padding wp-block-acf-banner wp-block-banner';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}

// align 属性
if ( ! empty( $block['align'] ) ) {
	$class_name .= ' align' . $block['align'];
}


// style 属性
// get_block_wrapper_attributes() 関数で style 属性のみを取得
$attributes = get_block_wrapper_attributes();
$styles = '';

if (preg_match('/style="([^"]*)"/', $attributes, $matches)) {
	$styles = $matches[1];
}

// data 属性
// get_block_wrapper_attributes() 関数で data 属性のみを取得
if (!function_exists('get_data_attributes_only')) {
	function get_data_attributes_only() {
		$attributes_all = get_block_wrapper_attributes();

		preg_match_all('/\bdata-[^=]+="[^"]*"/', $attributes_all, $matches);

		return implode(' ', $matches[0]);
	}
}
$data_attributes = get_data_attributes_only();

?>

<?php
	if ( $block_banner ) {
?>
	<div <?php echo esc_attr( $anchor ); ?> class="<?php echo esc_attr( $class_name ); ?>" style="<?php echo esc_attr( $styles ); ?>" <?php echo $data_attributes; ?>>
<?php
		foreach ( $block_banner as $item ) {
			$block_banner_image = $item['block_banner_image'];
			$block_banner_link = $item['block_banner_link'];

			if ( $block_banner_image ) {
?>
	<div class="wp-block-banner">
		
		<?php
			if ( $block_banner_image ) {
				$image = wp_get_attachment_image_src( $block_banner_image , 'full' );
		?>
			<a href="<?php echo $block_banner_link['url']; ?>" target="<?php echo $block_banner_link['target']; ?>" class="wp-block_banner_link">
				<img src="<?php echo $image[0]; ?>" alt="">
			</a>
		<?php
			}
		?>
	</div>
<?php
			}
		}
?>
	</div>
<?php
	}
?>


