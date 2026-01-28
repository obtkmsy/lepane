<?php
/**
 * プラグインのカスタマイズ設定
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Snow Monkey Forms の設定
 */

// 完了画面をページ遷移にする
add_action(
	'wp_enqueue_scripts',
	function() {
		ob_start();
?>
	window.addEventListener(
		'load',
		function() {

<?php
	$option_smf_form = get_field('option_smf_form', 'option');

	if ( $option_smf_form ) {
		foreach ( $option_smf_form as $item ) {
			$option_smf_form_id         = $item['option_smf_form_id'];
			$option_smf_form_thanks_url = $item['option_smf_form_thanks_url'];

			if ( $option_smf_form_id && $option_smf_form_thanks_url ) {
?>
	var contact_<?php echo $option_smf_form_id; ?> = document.getElementById( 'snow-monkey-form-<?php echo $option_smf_form_id; ?>' );
	if ( contact_<?php echo $option_smf_form_id; ?> ) {
		contact_<?php echo $option_smf_form_id; ?>.addEventListener(
			'smf.submit',
			function(event) {
				if ('complete' === event.detail.status) {
					window.location.href = '<?php echo $option_smf_form_thanks_url; ?>';
				}
			}
		);
	}
<?php
			}
		}
	}

?>

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


