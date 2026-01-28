// ================================================================================
// wp-block-slider.js
// スライダーのスクリプトファイル
// ================================================================================

import Swiper from 'swiper';
import { EffectFade, Autoplay, Navigation } from 'swiper/modules';


window.addEventListener('load', () => {

	const swiper = new Swiper('.js-slider-swiper', {
		modules: [EffectFade, Autoplay, Navigation],
		loop: true,
		slidesPerView: 1,
		effect: 'fade',
		fadeEffect: {
			crossFade: true
		},
		autoplay: {
			delay: 3000, // 4秒ごとに切り替え（お好みで調整可）
			disableOnInteraction: false, // ユーザー操作後も自動再開したい場合
		},
		speed: 1500,

		// modules: [Navigation],

		// navigation: {
		// 	nextEl: ".swiper-button-next",
		// 	prevEl: ".swiper-button-prev",
		// },

	});

	swiper.on('slideChangeTransitionStart', function () {
  // すべてのimgのanimationを一度リセット
  document.querySelectorAll('.slide-img img').forEach(img => {
    img.style.animation = 'none';
    // 強制リフロー（reflow）で再適用
    void img.offsetWidth;
  });

  // アクティブなスライドだけanimationを再度付与
  const activeImg = document.querySelector('.swiper-slide-active .slide-img img');
  if (activeImg) {
    activeImg.style.animation = 'slide-zoom 6s linear forwards';
  }
});

} );
