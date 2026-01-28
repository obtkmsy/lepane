// ================================================================================
// wp-block-site-menu-button.js
// ハンバーガーメニューのスクリプトファイル
// ================================================================================

document.addEventListener('DOMContentLoaded', () => {

	const dropDownButton = document.getElementById('js-mobile-menu');
	const menuOpenTarget = document.querySelector('body');

	if ( dropDownButton ) {
		dropDownButton.addEventListener('click', function() {
			dropDownButton.classList.toggle('is-close');
			menuOpenTarget.classList.toggle('is-menu-open');
		} );
	}

} );
