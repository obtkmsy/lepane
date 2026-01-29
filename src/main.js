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

// import smooth from './js/smooth-scroll';
import wpBlockDetails from './js/wp-block-details';
import script from './js/script';
