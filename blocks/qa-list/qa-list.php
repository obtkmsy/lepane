<?php
/**
 * Block Template : Q&A
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

$block_qa_list = get_field( 'block_qa_list' );

// id 属性 (anchor)
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
	$anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// class 属性
$class_name = 'has-global-padding wp-block-acf-qa-list wp-block-qa-list';
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
	if ( $block_qa_list ) {
?>
	<div <?php echo esc_attr( $anchor ); ?> class="<?php echo esc_attr( $class_name ); ?>" style="<?php echo esc_attr( $styles ); ?>" <?php echo $data_attributes; ?>>
<?php
		foreach ( $block_qa_list as $item ) {
			$block_qa_list_title = $item['block_qa_list_title'];
			$block_qa_list_detail = $item['block_qa_list_detail'];

			if ( $block_qa_list_title ) {
?>
	<div class="wp-block-qa-item">

		<p class="wp-block-qa-item__title">
			<?php echo $block_qa_list_title; ?>
			<span></span>
		</p>

		<div class="wp-block-qa-item__detail">
			<p>
				<?php echo $block_qa_list_detail; ?>
			</p>
		</div>
		
	</div>
<?php
			}
		}
?>
	</div>
<?php
	}
?>


