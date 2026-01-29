<?php
/**
 * Block Template : メインスライダー
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

$block_main_slider = get_field( 'block_main_slider' );

// id 属性 (anchor)
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
	$anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// class 属性
$class_name = 'has-global-padding wp-block-acf-main-slider wp-block-main-slider swiper-wrapper';
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
	if ( $block_main_slider ) {
?>
	<div <?php echo esc_attr( $anchor ); ?> class="<?php echo esc_attr( $class_name ); ?>" style="<?php echo esc_attr( $styles ); ?>" <?php echo $data_attributes; ?>>
<?php
		foreach ( $block_main_slider as $item ) {
			$block_main_slider_catch = $item['block_main_slider_catch'];
			$block_main_slider_image = $item['block_main_slider_image'];

			if ( $block_main_slider_image ) {
?>
		<div class="wp-block-main-slide-item swiper-slide">
			<p class="wp-block-main-slide__catch">
				<?php echo $block_main_slider_catch; ?>
			</p>

			<?php
				if ( $block_main_slider_image ) {
					$image = wp_get_attachment_image_src( $block_main_slider_image , 'full' );
			?>
				<div class="wp-block-main-slide__image">
					<img src="<?php echo $image[0]; ?>" alt="">
				</div>
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


