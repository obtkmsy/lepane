// ================================================================================
// wp-pattern-header.js
// 固定ヘッダーパターンのスクリプトファイル
// ================================================================================

document.addEventListener('DOMContentLoaded', function () {
	const header = document.querySelector('.wp-pattern-header.js-fixed');
	if (!header) return; // is-fixedがない場合は何もしない

	function onScroll() {
		if (window.scrollY > 160) {
			header.classList.add('is-scrolled');
		} else {
			header.classList.remove('is-scrolled');
		}
	}

	window.addEventListener('scroll', onScroll);
	onScroll(); // ← ページ読み込み時にも一度判定
});
