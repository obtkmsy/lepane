<?php
/**
 * Block Template : コース内容
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

$block_course_list = get_field( 'block_course_list' );

// id 属性 (anchor)
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
	$anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// class 属性
$class_name = 'has-global-padding wp-block-acf-course-list wp-block-course-list';
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
	if ( $block_course_list ) {
?>
	<div <?php echo esc_attr( $anchor ); ?> class="<?php echo esc_attr( $class_name ); ?>" style="<?php echo esc_attr( $styles ); ?>" <?php echo $data_attributes; ?>>
<?php
		foreach ( $block_course_list as $item ) {
			$block_course_list_title = $item['block_course_list_title'];
			$block_course_list_suppl = $item['block_course_list_suppl'];
			$block_course_list_time = $item['block_course_list_time'];
			$block_course_list_price = $item['block_course_list_price'];
			$block_course_list_per = $item['block_course_list_per'];

			if ( $block_course_list_price ) {
?>
	<div class="wp-block-course-item">
		<?php
			if ( $block_course_list_title ) {
		?>
			<div class="wp-block-course-row is-pink">
				<p>
					<?php echo $block_course_list_title; ?>
				</p>
				<span>
					<?php echo $block_course_list_suppl; ?>
				</span>
			</div>
		<?php
			}
		?>
		<?php
			if ( $block_course_list_time ) {
		?>
			<div class="wp-block-course-row">
				<p>
					<?php echo $block_course_list_time; ?>
				</p>
			</div>
		<?php
			}
		?>
		<?php
			if ( $block_course_list_price ) {
		?>
			<div class="wp-block-course-row">
				<p>
					<?php echo $block_course_list_price; ?>
				</p>
				<span>
					<?php echo $block_course_list_per; ?>
				</span>
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


