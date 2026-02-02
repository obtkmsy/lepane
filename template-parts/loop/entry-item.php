<?php
/**
 * 投稿の一覧アイテム
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php

if ( ! function_exists( 'get_first_text_block_text' ) ) {
	function get_first_text_block_text( $post = null ) {
		$post = get_post( $post );
		if ( ! $post ) return '';

		$blocks = parse_blocks( $post->post_content );
		$resolve_reusable = function( $block ) {
			if ( $block['blockName'] === 'core/block' && ! empty( $block['attrs']['ref'] ) ) {
				$ref = get_post( (int) $block['attrs']['ref'] );
				if ( $ref ) {
					return parse_blocks( $ref->post_content );
				}
			}
			return [ $block ];
		};

		$find_first_paragraph_text = function( $blocks ) use ( &$find_first_paragraph_text, $resolve_reusable ) {
			foreach ( $blocks as $block ) {
				// 再利用ブロックなら展開
				$expanded = $resolve_reusable( $block );
				if ( count( $expanded ) > 1 || $expanded[0] !== $block ) {
					$text = $find_first_paragraph_text( $expanded );
					if ( $text !== '' ) return $text;
					continue;
				}

				if ( $block['blockName'] === 'core/paragraph' ) {
					$plain = wp_strip_all_tags( render_block( $block ), true );
					$plain = trim( preg_replace( "/[\r\n\t ]+/", ' ', $plain ) );
					if ( $plain !== '' ) return $plain;
				}
				if ( ! empty( $block['innerBlocks'] ) ) {
					$text = $find_first_paragraph_text( $block['innerBlocks'] );
					if ( $text !== '' ) return $text;
				}
			}
			return '';
		};

		$text = $find_first_paragraph_text( $blocks );

		if ( $text === '' ) {
			$content = get_post_field( 'post_content', $post );
			$text = wp_strip_all_tags( strip_shortcodes( $content ), true );
			$text = trim( preg_replace( "/[\r\n\t ]+/", ' ', $text ) );
		}

		return $text;
	}
}

if ( ! function_exists( 'the_first_text_block' ) ) {
	function the_first_text_block( $post = null ) {
		$text = get_first_text_block_text( $post );
		if ( $text !== '' ) {
			echo esc_html( $text );
		}
	}
}

?>

<article class="entry-item">
	<a href="<?php the_permalink(); ?>" class="entry-item__link">
		<div class="entry-item__thumbnail">
			<?php 
			if ( has_post_thumbnail() ) {
				$thumb_url = get_the_post_thumbnail_url( get_the_ID() );
			} else {
				$thumb_url = get_template_directory_uri() . '/assets/images/thumbnail.png';
			}
			?>
			<img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php the_title_attribute(); ?>">
		</div>
		<div class="entry-item__detail">
			<h2 class="entry-item__title">
				<?php the_title(); ?>
			</h2>
			<div class="entry-item__info">
				<p class="entry-item__date">
					<?php posted_on(); ?>
				</p>
				<p class="entry-item__cat">
					<?php
					$cats = get_the_category();
					if ( $cats ) {
						echo esc_html( implode(' / ', wp_list_pluck( $cats, 'name' ) ) );
					}
					?>
				</p>
			</div>
			<p class="entry-item__text">
				<?php the_first_text_block(); ?>
			</p>
		</div>
	</a>
</article>