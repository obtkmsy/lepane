<?php
/**
 * ACF PRO の設定
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * オプションページを追加
 */

 add_action( 'acf/init', function() {

	if ( ! function_exists( 'acf_add_options_page' ) ) {
	 return;
	}
   
	// 親ページ
	$parent = acf_add_options_page( array(
	 'menu_slug'  => 'theme-options',
	 'page_title' => 'サイト設定',
	 'menu_title' => 'サイト設定',
	 'icon_url'   => 'dashicons-nametag',
	 'position'   => 59,
	 // 'redirect' => false,
	) );
   
	// サブページ：初期設定
	acf_add_options_sub_page( array(
	 'menu_slug'   => 'common-options',
	 'page_title'  => '初期設定',
	 'menu_title'  => '初期設定',
	 'parent_slug' => $parent['menu_slug'],
	) );
   
	// サブページ：パーツ設定
	acf_add_options_sub_page( array(
	 'menu_slug'   => 'parts-options',
	 'page_title'  => 'パーツ設定',
	 'menu_title'  => 'パーツ設定',
	 'parent_slug' => $parent['menu_slug'],
	) );
   
});

/**
* カスタムフィールドのプレビューを有効にする
*/
if ( ! function_exists( 'get_cf_preview_id' ) ) {
	function get_cf_preview_id($post_id) {
		global $post;
		$preview_id = 0;
		if ( isset($_GET['preview'])
				&& ($post->ID == $post_id)
					&& $_GET['preview'] == true
						&&  ($post_id == url_to_postid($_SERVER['REQUEST_URI']))
			) {
			$preview = wp_get_post_autosave($post_id);
			if ($preview != false) { $preview_id = $preview->ID; }
		}
		return $preview_id;
	}
}

if ( ! function_exists( 'get_cf_preview_metadata' ) ) {
	function get_cf_preview_metadata( $meta_value, $post_id, $meta_key, $single ) {
		if ( $preview_id = get_cf_preview_id($post_id) ) {
			if ( $post_id != $preview_id ) {
				$meta_value = get_post_meta( $preview_id, $meta_key, $single );
			}
		}
		return $meta_value;
	}
}
add_filter( 'get_post_metadata', 'get_cf_preview_metadata', 10, 4 );

if ( ! function_exists( 'get_cf_preview_insert' ) ) {
	function get_cf_preview_insert( $post_id ) {
		global $wpdb;
		if ( wp_is_post_revision($post_id) ) {
			if ( isset($_POST['fields']) && count($_POST['fields']) != 0 ) {
				foreach ( $_POST['fields'] as $key => $value ) {
					$field = get_field($key);
					if ( !isset($field['name']) || !isset($field['key']) ) continue;
					if ( count(get_metadata('post', $post_id, $field['name'], $value) ) != 0) {
						update_metadata('post', $post_id, $field['name'], $value);
						update_metadata('post', $post_id, "_" . $field['name'], $field['key']);
					} else {
						add_metadata('post', $post_id, $field['name'], $value);
						add_metadata('post', $post_id, "_" . $field['name'], $field['key']);
					}
				}
			}
			do_action('save_preview_postmeta', $post_id);
		}
	}
}
add_action('wp_insert_post', 'get_cf_preview_insert' );





// 完了画面をページ遷移にする
add_action(
	'wp_enqueue_scripts',
	function() {
		ob_start();
?>
window.addEventListener(
	'load',
	function() {

		var download = document.getElementById( 'snow-monkey-form-22' );
		if ( download ) {
			download.addEventListener(
				'smf.submit',
				function(event) {
					if ('complete' === event.detail.status) {
						window.location.href = '/contact/thanks/';
					}
				}
			);
		}
	}
);
<?php
		$data = ob_get_clean();
		wp_add_inline_script(
			'snow-monkey-forms',
			$data,
			'after'
		);
	},
	11
);


add_filter('render_block', function ($content, $block) {

	if (($block['blockName'] ?? '') !== 'core/post-template') {
		return $content;
	}

	if (!function_exists('get_field')) {
		return $content;
	}

	// <li class="... wp-block-post ... post-123 ..."> を拾って、post-123 の 123 を使う
	$content = preg_replace_callback(
		'/(<li\b[^>]*class="[^"]*\bwp-block-post\b[^"]*"[^>]*>)/',
		function ($m) {

			$li = $m[1];

			// class に post-123 がある前提
			if (!preg_match('/\bpost-(\d+)\b/', $li, $mm)) {
				return $li;
			}

			$post_id = (int) $mm[1];

			// meeting 以外は触らない
			if (get_post_type($post_id) !== 'meeting') {
				return $li;
			}

			// event_time が true なら is-noon 付与
			$event_time = (bool) get_field('event_time', $post_id);
			if (!$event_time) {
				return $li;
			}

			// 既に付いてたら二重付与しない
			if (strpos($li, ' is-noon') !== false) {
				return $li;
			}

			return preg_replace('/class="([^"]*)"/', 'class="$1 is-noon"', $li, 1);
		},
		$content
	);

	return $content;

}, 10, 2);


add_filter('render_block', function ($content, $block) {

	$block_name = $block['blockName'] ?? '';

	// 1) Post Date ブロック：event_date を表示（なければ開催日未定）
	if ($block_name === 'core/post-date') {

		global $post;
		if (empty($post) || empty($post->ID) || !function_exists('get_field')) {
			return $content;
		}

		$val = get_field('event_date', $post->ID);

		$class = 'wp-block-post-date';
		$extra = $block['attrs']['className'] ?? '';
		if ($extra) $class .= ' ' . $extra;

		if (empty($val)) {
			return '<div class="' . esc_attr($class) . '">開催日未定</div>';
		}
		return '<div class="' . esc_attr($class) . '">' . esc_html($val) . '</div>';
	}

	// 2) Post Template ブロック：meeting かつ event_time=true の投稿に is-noon を付与
	if ($block_name === 'core/post-template') {

		global $post;
		if (empty($post) || get_post_type($post) !== 'meeting' || !function_exists('get_field')) {
			return $content;
		}

		$event_time = (bool) get_field('event_time', $post->ID);
		if (!$event_time) {
			return $content;
		}

		return preg_replace(
			'/class="([^"]*wp-block-post[^"]*)"/',
			'class="$1 is-noon"',
			$content,
			1
		);
	}

	return $content;

}, 10, 2);



add_action('pre_get_posts', function ($q) {

	if (is_admin() || ! $q->is_main_query()) return;
	if (! $q->is_post_type_archive('event')) return;

	$q->set('event_custom_sort', 1);
	$q->set('orderby', 'none');

}, 20);

add_action('pre_get_posts', function ($q) {

	if (is_admin() || ! $q->is_main_query()) return;
	if (! $q->is_post_type_archive('event')) return;
	$q->set('event_custom_sort', 1);
	$q->set('orderby', 'none');

}, 20);



add_action('pre_get_posts', function ($q) {

	if (is_admin() || ! $q->is_main_query()) return;
	if (! $q->is_tax('meeting-category')) return;
	$q->set('post_type', 'meeting');
	$q->set('meeting_custom_sort', 1);
	$q->set('orderby', 'none');

}, 9999);


add_filter('posts_clauses', function ($clauses, $q) {

	if (is_admin() || ! $q->is_main_query()) return $clauses;
	if (! $q->get('meeting_custom_sort')) return $clauses;

	global $wpdb;

	if (strpos($clauses['join'], 'event_date_pm') === false) {
		$clauses['join'] .= " LEFT JOIN {$wpdb->postmeta} AS event_date_pm
			ON ({$wpdb->posts}.ID = event_date_pm.post_id AND event_date_pm.meta_key = 'event_date')";
	}
	$clauses['orderby'] = "
		CASE
			WHEN event_date_pm.meta_value IS NULL OR event_date_pm.meta_value = '' THEN 1
			ELSE 0
		END ASC,
		CAST(event_date_pm.meta_value AS UNSIGNED) ASC,
		{$wpdb->posts}.post_modified DESC
	";

	return $clauses;

}, 9999, 2);



 add_action('pre_get_posts', function ($q) {

	if (is_admin()) return;
	$post_type = $q->get('post_type');
	$is_meeting = ($post_type === 'meeting')
		|| (is_array($post_type) && in_array('meeting', $post_type, true));

	if (! $is_meeting) return;
	$q->set('suppress_filters', false);
	$q->set('meeting_custom_sort', 1);

	$q->set('orderby', 'none');

}, 9999);


add_filter('posts_clauses', function ($clauses, $q) {

	if (is_admin()) return $clauses;
	if (! $q->get('meeting_custom_sort')) return $clauses;

	global $wpdb;

	if (strpos($clauses['join'], 'event_date_pm') === false) {
		$clauses['join'] .= " LEFT JOIN {$wpdb->postmeta} AS event_date_pm
			ON ({$wpdb->posts}.ID = event_date_pm.post_id AND event_date_pm.meta_key = 'event_date')";
	}

	$clauses['orderby'] = "
		CASE
			WHEN event_date_pm.meta_value IS NULL OR event_date_pm.meta_value = '' THEN 1
			ELSE 0
		END ASC,
		CAST(event_date_pm.meta_value AS UNSIGNED) ASC,
		{$wpdb->posts}.post_modified DESC
	";

	return $clauses;

}, 9999, 2);
