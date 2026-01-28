<?php
/**
 * テンプレートで使用する関数集
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * フォントサイズの px → rem に計算する関数
 */

if ( ! function_exists( 'font_size_rem' ) ) {
	function font_size_rem( $size ) {

		$replace = str_replace('px', '', $size);
		$size = (int) $size;
		$size_rem = $size / 10;

		$font_size_rem = $size_rem .'rem';

		return $font_size_rem;
	}
}



/**
 * 全てのカスタム投稿を取得する関数
 */
if ( ! function_exists( 'custom_post_array' ) ) {
	function custom_post_array() {

		// 全ての投稿タイプを取得
		$custom_post_array = get_post_types(
			array(
				'public'    => true,
				'_builtin'  => false
			)
		);

		return $custom_post_array;
	}
}


/**
 * 固定ページでアーカイブ指定した場合にアーカイブページで固定ページの post id を取得する関数
 */
if ( ! function_exists( 'get_page_id' ) ) {
	function get_page_id() {

		// init
		$target_id = '';

		// カスタム投稿アーカイブのみ適用
		if ( is_post_type_archive( custom_post_array() ) || is_singular( custom_post_array() ) ) {
			$slug = get_post_type_object( get_post_type() )->name;
			if ( get_page_by_path($slug) ) {
				$page_id = get_page_by_path($slug)->ID;
				$target_id = $page_id;
			}
		}

		return $target_id;
	}
}



/**
 * single で投稿タイプのスラッグを同じスラッグの固定ページがあればそのタイトルを、なければ投稿タイプの名前を取得する関数
 * NOTE: post の場合は page_for_posts から取得する
 */
if ( ! function_exists( 'get_psot_title' ) ) {
	function get_psot_title() {

		// init
		$get_psot_title;

		$get_post_type = get_post_type();

		if ( $get_post_type == 'post' ) {
			$get_psot_title = get_the_title(ID_HOME);
		} else {
			$get_page_id = get_page_by_path( $get_post_type );

			if ( $get_page_id ) {
				$get_page_id = $get_page_id->ID;
				$get_psot_title = get_the_title($get_page_id);
			} else {
				$get_psot_title = get_post_type_object(get_post_type())->label;
			}

		}

		return $get_psot_title;
	}
}



/**
* 抜粋の設定
*/
if ( ! function_exists( 'post_excerpt' ) ) {
	function post_excerpt( $length ) {
		$excerpt = '';
		$post = get_post( get_the_ID() );
		if ( $post->post_excerpt != '' ) {
			$excerpt = $post->post_excerpt;
		} else {
			$excerpt = $post->post_content;
		}

		if ( $length ) {
			$excerpt_text = mb_substr( strip_tags($excerpt), 0, $length );
		} else {
			$excerpt_text = mb_substr( strip_tags($excerpt), 0, 100 );
		}

		if ( $post->post_excerpt == '' ) {
			$excerpt_text = $excerpt_text . '...';
		}

		$excerpt_text = preg_replace('/(?:\n|\r|\r\n)/', '', $excerpt_text );

		return $excerpt_text;
	}
}



/**
* 日付の設定
*/
if ( ! function_exists( 'posted_on' ) ) {
	function posted_on() {
		$time_string = '<time class="published updated" datetime="%1$s">%2$s</time>';

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() )
		);

		$specified_date = get_field('specified_date');

//		if ( $specified_date ) {
//			$time_string_sp = sprintf(
//				$time_string,
//				esc_attr( $specified_date ),
//				esc_html( $specified_date )
//			);
//		}

		if ( $specified_date ) {
			$specified_date_time = DateTime::createFromFormat('Y.m.d', $specified_date);
			$specified_date_time = $specified_date_time->format(DATE_W3C);
			printf( '<time class="published updated" datetime="' . $specified_date_time . '">' . $specified_date . '</time>' );
		} else {
			printf( $time_string);
		}

	}
}



/**
 * 更新日の設定
 */
if ( ! function_exists( 'updated_on' ) ) {
	function updated_on() {
		$time_string = '<time class="updated" datetime="%1$s">%2$s</time>';
		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);
		printf( $time_string );
	}
}



/**
 * 固定ページでアーカイブ指定した場合にアーカイブページで固定ページの post id を取得する関数
 */
if ( ! function_exists( 'calc_file_size' ) ) {
	function calc_file_size($size) {
		$b = 1024;        // バイト
		$mb = pow($b, 2); // メガバイト
		$gb = pow($b, 3); // ギガバイト

		switch(true){
			case $size >= $gb:
				$target = $gb;
				$unit = 'GB';
				break;
			case $size >= $mb:
				$target = $mb;
				$unit = 'MB';
				break;
			default:
				$target = $b;
				$unit = 'KB';
				break;
		}

		$new_size = round($size / $target, 2);
		$file_size = number_format($new_size, 2, '.', ',') . $unit;

		return $file_size;
	}
}



/**
 * リンク生成用の関数
 */
if ( ! function_exists( 'link_url' ) ) {
	function link_url( $slug ) {

		$url = esc_url( home_url() . '/' . $slug );

		return $url;
	}
}



/**
 * カスタム投稿で「前の記事・次の記事」を適用する。
 */
// if ( ! function_exists( 'mod_get_adjacent_post' ) ) {
// 	function mod_get_adjacent_post($direction = 'prev', $post_types = 'post') {
// 		global $post, $wpdb;
// 		if(empty($post)) return NULL;
// 		if(!$post_types) return NULL;
// 		if(is_array($post_types)){
// 			$txt = '';
// 			for($i = 0; $i <= count($post_types) - 1; $i++){
// 				$txt .= "'".$post_types[$i]."'";
// 				if($i != count($post_types) - 1) $txt .= ', ';
// 			}
// 			$post_types = $txt;
// 		}
// 		$current_post_date = $post->post_date;
// 		$join = '';
// 		$in_same_cat = FALSE;
// 		$excluded_categories = '';
// 		$adjacent = $direction == 'prev' ? 'previous' : 'next';
// 		$op = $direction == 'prev' ? '<' : '>';
// 		$order = $direction == 'prev' ? 'DESC' : 'ASC';
// 		$join  = apply_filters( "get_{$adjacent}_post_join", $join, $in_same_cat, $excluded_categories );
// 		$where = apply_filters( "get_{$adjacent}_post_where", $wpdb->prepare("WHERE p.post_date $op %s AND p.post_type IN({$post_types}) AND p.post_status = 'publish'", $current_post_date), $in_same_cat, $excluded_categories );
// 		$sort  = apply_filters( "get_{$adjacent}_post_sort", "ORDER BY p.post_date $order LIMIT 1" );
// 		$query = "SELECT p.* FROM $wpdb->posts AS p $join $where $sort";
// 		$query_key = 'adjacent_post_' . md5($query);
// 		$result = wp_cache_get($query_key, 'counts');
// 		if ( false !== $result )
// 			return $result;
// 		$result = $wpdb->get_row("SELECT p.* FROM $wpdb->posts AS p $join $where $sort");
// 		if ( null === $result )
// 			$result = '';
// 		wp_cache_set($query_key, $result, 'counts');
// 		return $result;
// 	}
// }



/**
 * rowspan 生成用
 */

if ( ! function_exists( 'make_rowspan' ) ) {
	function make_rowspan( $data, $i, $count=1 ) {
		// 最終行なら終わり
		if ( $i === count($data) - 1 ) {
			return get_rowspan_code( $count, $data[$i] );
		}
		//次も同じ値が続くかどうかを判定
		if ( $data[$i] === $data[$i+1] ) {
			return make_rowspan( $data, $i+1, $count+1 );
		} else {
			return get_rowspan_code( $count, $data[$i] );
		}
	}
}

if ( ! function_exists( 'get_rowspan_code' ) ) {
	function get_rowspan_code( $count, $data ) {
		if ( $count > 1 ) {
			return 'rowspan="' . $count . '"';
		} else {
			return '';
		}
	}
}



/**
 * Synchronized Pattern Helper
 *
 * 指定したIDの同期パターンをレンダリングして出力する関数。
 *
 * @param int $pattern_id 同期パターンの投稿ID。
 */
function display_synced_pattern( $pattern_id ) {
	// IDが指定されていない、または0以下の場合は何もしない
	if ( empty( $pattern_id ) || !is_numeric( $pattern_id ) || $pattern_id <= 0 ) {
		return;
	}

	// 指定されたIDの投稿（同期パターン）を取得
	$pattern_post = get_post( (int) $pattern_id );

	// 投稿が存在し、かつ内容がある場合のみ処理を実行
	if ( $pattern_post && $pattern_post->post_content ) {
		// 投稿内容をブロックにパース（解析）する
		$blocks = parse_blocks( $pattern_post->post_content );

		// 各ブロックをループで回し、レンダリングして出力
		foreach ( $blocks as $block ) {
			// ブロックのHTMLをレンダリングして出力
			echo render_block( $block );
		}
	}
}

