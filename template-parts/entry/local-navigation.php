<?php
/**
 * 投稿ページネーション for 投稿
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

$prev_post = get_previous_post();
$next_post = get_next_post();
?>

<div class="local-navigation-items">

	<div class="local-navigation-item">
		<?php
			if ( !empty( $prev_post ) ) {
				$prev_id    = $prev_post->ID;
				$prev_title = get_the_title( $prev_id );
		?>
			<div class="local-navigation-item__container is-prev">
				<a href="<?php echo get_permalink( $prev_id ); ?>" class="local-navigation-item__link">
					<div class="local-navigation-item__title">
						前の記事へ
					</div>
				</a>
			</div>
		<?php
			}
		?>
	</div>

	<div class="has-text-align-center local-navigation-button">
		<a href="<?php echo home_url(); ?>/information" class="back-button">
			新着情報トップへ
		</a>
	</div>

	<div class="local-navigation-item">
		<?php
			if ( !empty( $next_post ) ) {
				$next_id    = $next_post->ID;
				$next_title = get_the_title( $next_id );
		?>
			<div class="local-navigation-item__container is-next">
				<a href="<?php echo get_permalink( $next_id ); ?>" class="local-navigation-item__link">
					<div class="local-navigation-item__title">
						前の記事へ
					</div>
				</a>
			</div>
		<?php
			}
		?>
	</div>

</div>

