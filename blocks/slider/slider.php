<?php
/**
 * Block Template : ロゴループスライダー
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

// id 属性 (anchor)
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
	$anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// class 属性
$class_name = 'has-global-padding wp-block-acf-slider wp-block-slider';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}

// align 属性
if ( ! empty( $block['align'] ) ) {
	$class_name .= ' align' . $block['align'];
}


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

// get acf
$block_slider = get_field('block_slider');
$block_slider_fade_flag = get_field('block_slider_fade_flag');
$block_slider_full_flag = get_field('block_slider_full_flag');

if ( $block_slider_full_flag ) {
	$class_name .= ' is-full-size';
}
?>

<div <?php echo esc_attr( $anchor ); ?> <?php echo get_block_wrapper_attributes( [ 'class' => $class_name ] ); ?>>

	<?php
		if ( $block_slider ) {
	?>
		<div class="swiper js-slider-swiper">
			<div class="swiper-wrapper">

				<?php
					foreach ( $block_slider as $item ) {
						$block_slider_image = $item['block_slider_image'];
						if ( $block_slider_image ) {
							$image = wp_get_attachment_image_src( $block_slider_image , 'full' );
				?>
					<div class="swiper-slide">
						<div class="swiper-img <?php
							if ( $block_slider_fade_flag ) {
								echo 'is-scaled-animation';
							}
						?>">
							<img src="<?php echo $image[0]; ?>" alt="">
						</div>
					</div>
				<?php
						}
					}
				?>

			</div>
		</div>
	<?php
		}
	?>

</div>
