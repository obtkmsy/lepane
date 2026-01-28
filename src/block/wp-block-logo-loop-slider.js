// ================================================================================
// wp-block-logo-loop-slider.js
// ロゴループスライダーブロックのスクリプトファイル
// ================================================================================

document.addEventListener('DOMContentLoaded', () => {
	// ページ内の全てのロゴカルーセルコンテナを取得
	const carouselContainers = document.querySelectorAll('.wp-block-logo-loop-slider-contaienr');

	// 各コンテナに対して処理を実行
	carouselContainers.forEach(container => {
		const carouselTrack = container.querySelector('.js-logo-loop-slider-track');
		if (!carouselTrack) {
			return;
		}

		// ロゴトラックの内容を複製し、無限ループを可能にする
		// これにより、アニメーションの終わりで最初の要素がスムーズに現れる
		const trackContent = carouselTrack.innerHTML;
		carouselTrack.innerHTML += trackContent;
	});

});
