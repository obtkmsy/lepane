<?php
/**
 * Block Template : デバイス切り替え画像
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

$block_srcsetimage    = get_field( 'block_srcsetimage' );
$block_srcsetimage_md = get_field( 'block_srcsetimage_md' );
$block_srcsetimage_link = get_field( 'block_srcsetimage_link' );


// id 属性 (anchor)
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
	$anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// class 属性
$class_name = 'has-global-padding wp-block-acf-image wp-block-image wp-block-acf-srcset-image wp-block-srcset-image';
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
	if ( $block_srcsetimage && $block_srcsetimage_md ) {
		$image = wp_get_attachment_image_src( $block_srcsetimage , 'full' );
		$image_md = wp_get_attachment_image_src( $block_srcsetimage_md , 'full' );
?>
	<figure <?php echo esc_attr( $anchor ); ?> <?php echo get_block_wrapper_attributes( [ 'class' => $class_name ] ); ?>>

		<?php
			if ( $block_srcsetimage_link ) {
				$link_url = $block_srcsetimage_link['url'];
				$link_title = $block_srcsetimage_link['title'];
				$link_target = $block_srcsetimage_link['target'] ? $block_srcsetimage_link['target'] : '_self';
		?>
			<a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>" title="<?php echo esc_html( $link_title ); ?>">
				<picture>
					<source srcset="<?php echo $image[0]; ?>" media="(max-width: 781px)">
					<img src="<?php echo $image_md[0]; ?>" alt="">
				</picture>
			</a>
		<?php
			} else {
		?>
			<picture>
				<source srcset="<?php echo $image[0]; ?>" media="(max-width: 781px)">
				<img src="<?php echo $image_md[0]; ?>" alt="">
			</picture>
		<?php
			}
		?>


	</figure>
<?php
	}
?>

