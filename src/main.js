// ================================================================================
// script.js
// 案件用のスクリプトファイル
// ================================================================================

// Import
// --------------------------------------------------------------- //

// NOTE: style は別出力。
// import "./../sass/app.scss";
// import "./../sass/editor.scss";

import "@babel/polyfill";
import 'element-closest-polyfill';
import 'matchmedia-polyfill';
import 'matchmedia-polyfill/matchMedia.addListener';
import 'intersection-observer';

// NOTE: IE11 で media query の variable が効かないので CDN から読み込む
// import cssVars from 'css-vars-ponyfill';

import Swiper from 'swiper';
import { Navigation } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/effect-fade';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

import wpBlockDetails from './block/wp-block-details';
// import wpBlockLogoLoopSlider from './block/wp-block-logo-loop-slider';
// import wpBlockCaseCarousel from './block/wp-block-case-carousel';
import wpHamburgerMenu from './block/acf/wp-block-site-menu-button';
import wpSlider from './block/acf/wp-block-slider';

import wpHeader from './pattern/wp-pattern-header';

