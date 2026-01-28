<?php
/**
 * Block Template : 投稿一覧のアイテム
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
$class_name = 'has-global-padding wp-block-acf-entry-item wp-block-entry-item';
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

// get post object
global $post;

// post category item
$cats = get_the_category();

?>

<article <?php echo esc_attr( $anchor ); ?> <?php echo get_block_wrapper_attributes( [ 'class' => $class_name ] ); ?>>

	<a href="<?php the_permalink(); ?>" class="wp-block-entry-item__link">

		<div class="wp-block-entry-item__meta">
			<div class="wp-block-entry-item__date">
				<?php posted_on(); ?>
			</div>
			<?php
				if ( $cats ) {
			?>
				<div class="wp-block-entry-item__categories">
					<?php
						foreach( $cats as $item ) {
					?>
						<div class="category-button">
							<?php echo esc_html( $item->name ) .PHP_EOL; ?>
						</div>
					<?php
						}
					?>
				</div>
			<?php
				}
			?>
		</div>

		<h3 class="wp-block-entry-item__title">
			<?php the_title(); ?>
		</h3>

	</a>

</article>
