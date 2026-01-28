// ================================================================================
// swiper.js
// スワイパーのスクリプトファイル
// ================================================================================

import Swiper from 'swiper';
import { Navigation } from 'swiper/modules';
// import 'swiper/css';

document.addEventListener('DOMContentLoaded', () => {

	const swiper = new Swiper('.js-case-swiper', {
		loop: true,
		slidesPerView: 'auto',
		spaceBetween: 32,
		centeredSlides: true,

		modules: [Navigation],

		navigation: {
			nextEl: ".swiper-button-next",
			prevEl: ".swiper-button-prev",
		},

	});


} );






