<?php

/**
 * テンプレートで使用する関数集
 */

if (!defined('ABSPATH')) {
	exit;
}


/**
 * フォントサイズの px → rem に計算する関数
 */

if (! function_exists('font_size_rem')) {
	function font_size_rem($size)
	{

		$replace = str_replace('px', '', $size);
		$size = (int) $size;
		$size_rem = $size / 10;

		$font_size_rem = $size_rem . 'rem';

		return $font_size_rem;
	}
}



/**
 * 全てのカスタム投稿を取得する関数
 */
if (! function_exists('custom_post_array')) {
	function custom_post_array()
	{

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
if (! function_exists('get_page_id')) {
	function get_page_id()
	{

		// init
		$target_id = '';

		// カスタム投稿アーカイブのみ適用
		if (is_post_type_archive(custom_post_array()) || is_singular(custom_post_array())) {
			$slug = get_post_type_object(get_post_type())->name;
			$page_id = get_page_by_path($slug)->ID;
			$target_id = $page_id;
		}

		return $target_id;
	}
}



/**
 * single で投稿タイプのスラッグを同じスラッグの固定ページがあればそのタイトルを、なければ投稿タイプの名前を取得する関数
 * NOTE: post の場合は page_for_posts から取得する
 */
if (! function_exists('get_psot_title')) {
	function get_psot_title()
	{

		// init
		$get_psot_title;

		$get_post_type = get_post_type();

		if ($get_post_type == 'post') {
			$get_psot_title = get_the_title(ID_HOME);
		} else {
			$get_page_id = get_page_by_path($get_post_type);

			if ($get_page_id) {
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
if (! function_exists('post_excerpt')) {
	function post_excerpt($length)
	{
		$excerpt = '';
		$post = get_post(get_the_ID());
		if ($post->post_excerpt != '') {
			$excerpt = $post->post_excerpt;
		} else {
			$excerpt = $post->post_content;
		}

		if ($length) {
			$excerpt_text = mb_substr(strip_tags($excerpt), 0, $length);
		} else {
			$excerpt_text = mb_substr(strip_tags($excerpt), 0, 100);
		}

		if ($post->post_excerpt == '') {
			$excerpt_text = $excerpt_text . '...';
		}

		$excerpt_text = preg_replace('/(?:\n|\r|\r\n)/', '', $excerpt_text);

		return $excerpt_text;
	}
}



/**
 * 日付の設定
 */
if (! function_exists('posted_on')) {
	function posted_on()
	{
		$w = (int) get_the_date('w');
		$week_abbr = array('SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT');
		$weekday   = $week_abbr[$w];

		$year  = get_the_date('Y');
		$month = get_the_date('m');
		$day   = get_the_date('d');

		$display_date = sprintf(
			'<span class="year">%1$s</span><strong class="month">.%2$s</strong>.%3$s',
			esc_html($year),
			esc_html($month),
			esc_html($day)
		);

		$time_string = sprintf(
			'<time class="published updated" datetime="%1$s">%2$s <span class="weekday">%3$s</span></time>',
			esc_attr(get_the_date(DATE_W3C)),
			$display_date,
			esc_html($weekday)
		);

		printf($time_string);
	}
}



/**
 * 固定ページでアーカイブ指定した場合にアーカイブページで固定ページの post id を取得する関数
 */
if (! function_exists('calc_file_size')) {
	function calc_file_size($size)
	{
		$b = 1024;        // バイト
		$mb = pow($b, 2); // メガバイト
		$gb = pow($b, 3); // ギガバイト

		switch (true) {
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
if (! function_exists('link_url')) {
	function link_url($slug)
	{

		$url = esc_url(home_url() . '/' . $slug);

		return $url;
	}
}



/**
 * ラインアップの rowspan 生成用
 */

if (! function_exists('make_rowspan')) {
	function make_rowspan($data, $i, $count = 1)
	{
		// 最終行なら終わり
		if ($i === count($data) - 1) {
			return get_rowspan_code($count, $data[$i]);
		}
		//次も同じ値が続くかどうかを判定
		if ($data[$i] === $data[$i + 1]) {
			return make_rowspan($data, $i + 1, $count + 1);
		} else {
			return get_rowspan_code($count, $data[$i]);
		}
	}
}

if (! function_exists('get_rowspan_code')) {
	function get_rowspan_code($count, $data)
	{
		if ($count > 1) {
			return 'rowspan="' . $count . '"';
		} else {
			return '';
		}
	}
}



/**
 * アプトのダウンロード URL の生成
 */
if (! function_exists('apt_donwload_url')) {
	function apt_donwload_url($q)
	{
		if ($q) {
			$url = 'https://www.sotuu.net/php/download.php?q=' . $q . '&e=' . get_home_url() . '/download/download/';
			return $url;
		} else {
			return '';
		}
	}
}
