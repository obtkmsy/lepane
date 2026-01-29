<?php
/**
 * ページ送り
 *
 * wp page navi には頼らず実装。
 *
 * @param base            URLを参照してページ番号付きのリンクを生成するために使用。'format' という引数によって置き換え。初期値は '%_%'
 * @param format          ページネーションの構造を指定するのに使用。初期値は '?page=%#%'
 * @param total           全体のページ数。初期値は '1'
 * @param current         現在のページ番号。初期値は '0'
 * @param show_all        trueの場合すべてのページ番号が表示。false の場合は、'end_size' と 'mid_size' の引数でコントロール。初期値は 'false'
 * @param end_size        ページ番号のリストの両端(最初と最後)に表示する数字をいくつかにするか設定。初期値は '1'
 * @param mid_size        現在のページの両側に表示する数字をいくつかにするか設定。現在のページは含まず。初期値は '2'
 * @param prev_next       リストの中に prev, next のリンクを含むか否か。初期値は 'true'
 * @param prev_text       前ページのリンクラベル。初期値は '__('« Previous')'
 * @param prev_text       次ページのリンクラベル。初期値は '__('Next »')'
 * @param type            戻り値。初期値は 'array'
 * @param add_args        追加のクエリ引数の配列。初期値は 'false'
 * @param add_fragment    それぞれのリンクに付け加える文字列。初期値はなし。
 *
 * @link https://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/paginate_links
 */

 if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'pager' ) ) {
	function pager() {
		global $wp_query;

		$total = $wp_query->max_num_pages;
		if ( $total <= 1 ) {
			return;
		}

		$current = max( 1, get_query_var( 'paged' ) );
		$max_links = 5;
		$half = floor( $max_links / 2 );

		if ( $total <= $max_links ) {
			$start = 1;
			$end   = $total;
		} else {
			if ( $current - $half <= 0 ) {
				$start = 1;
				$end   = $max_links;
			} elseif ( $current + $half > $total ) {
				$start = $total - $max_links + 1;
				$end   = $total;
			} else {
				$start = $current - $half;
				$end   = $current + $half;
			}
		}

		echo '<div class="pager">' . PHP_EOL;
			echo '<div class="pager-lists">' . PHP_EOL;

				// 前へのリンク（常に表示）
				if ( $current > 1 ) {
					$prev_link = get_pagenum_link( $current - 1 );
					echo '<div class="pager-list"><a class="page-numbers prev" href="' . esc_url( $prev_link ) . '"></a></div>' . PHP_EOL;
				} else {
					// 無効状態として表示
					echo '<div class="pager-list"><span class="page-numbers prev"></span></div>' . PHP_EOL;
				}

				// ページ番号リンクの出力
				for ( $i = $start; $i <= $end; $i++ ) {
					$page_link = get_pagenum_link( $i );
					$class = ( $i == $current ) ? ' is-current' : '';
					echo '<div class="pager-list"><a class="page-numbers' . $class . '" href="' . esc_url( $page_link ) . '">' . $i . '</a></div>' . PHP_EOL;
				}

				// 次へのリンク（常に表示）
				if ( $current < $total ) {
					$next_link = get_pagenum_link( $current + 1 );
					echo '<div class="pager-list"><a class="page-numbers next" href="' . esc_url( $next_link ) . '"></a></div>' . PHP_EOL;
				} else {
					// 無効状態として表示
					echo '<div class="pager-list"><span class="page-numbers next"></span></div>' . PHP_EOL;
				}

			echo '</div>' . PHP_EOL;
		echo '</div>' . PHP_EOL;

		wp_reset_query();
	}
}

pager();
?>