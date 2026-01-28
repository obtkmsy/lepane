// ================================================================================
// editor.js
// エディター用のスクリプトファイル
// ================================================================================

/*
 * 幅広・全幅のオプションをブロックに追加
 *
 * 適用ブロック
 * - 段落
 * - リスト
 */

wp.hooks.addFilter(
	'blocks.registerBlockType',
	'my-plugin/add-align-all',
	(settings, name) => {
		settings.supports = settings.supports || {};

		// 対象ブロックが段落またはリストの場合、明示的にアラインメントオプションを追加
		if ( typeof settings.supports.align === 'undefined' ) {
			if ( ['core/paragraph', 'core/list'].includes(name) ) {
				settings.supports.align = [ 'left', 'center', 'right', 'wide', 'full' ];
			}
		} else {
			let alignmentOptions = [];
		if ( settings.supports.align === true ) {
			alignmentOptions = [ 'left', 'center', 'right' ];
		} else if ( Array.isArray( settings.supports.align ) ) {
			alignmentOptions = settings.supports.align;
		}

		// 重複なく wide, full を追加
		[ 'wide', 'full' ].forEach(option => {
			if ( ! alignmentOptions.includes(option) ) {
			alignmentOptions.push(option);
			}
		});

		settings.supports.align = alignmentOptions;
		}

		return settings;
	}
);



/*
 * カスタムクラスの設定
 */

// (function( wp ) {
// 	var createHigherOrderComponent = wp.compose.createHigherOrderComponent;
// 	var addFilter = wp.hooks.addFilter;
// 	var Fragment = wp.element.Fragment;
// 	var createElement = wp.element.createElement;
// 	var BlockControls = wp.blockEditor.BlockControls;
// 	var ToolbarButton = wp.components.ToolbarButton; // wp.components から取得
// 	var getBlockType = wp.blocks && wp.blocks.getBlockType;

// 	var withCustomClassButton = createHigherOrderComponent(
// 		function( BlockEdit ) {
// 			return function( props ) {
// 				if ( getBlockType && props.name ) {
// 					var blockType = getBlockType( props.name );
// 					if ( blockType && blockType.supports && blockType.supports.customClassName === false ) {
// 						return createElement( BlockEdit, props );
// 					}
// 				}

// 				var isSelected = props.isSelected;
// 				var clientId = props.clientId;
// 				var attributes = props.attributes;
// 				var dispatch = wp.data.dispatch( 'core/block-editor' );
// 				var updateBlockAttributes = dispatch.updateBlockAttributes;

// 				function toggleCustomClass() {
// 					var currentClass = attributes.className || '';
// 					var newClass =
// 						currentClass.indexOf( 'my-custom-class' ) !== -1
// 							? currentClass.replace( 'my-custom-class', '' ).trim()
// 							: ( currentClass + ' my-custom-class' ).trim();
// 					updateBlockAttributes( clientId, { className: newClass } );
// 				}

// 				// ボタンの active 状態を判定
// 				var isActive = attributes.className && attributes.className.indexOf( 'my-custom-class' ) !== -1;

// 				return createElement(
// 					Fragment,
// 					null,
// 					createElement( BlockEdit, props ),
// 					isSelected
// 						? createElement(
// 							BlockControls,
// 							null,
// 							createElement( ToolbarButton, {
// 								label: 'カスタムクラス追加/削除',
// 								icon: 'admin-customizer',
// 								onClick: toggleCustomClass,
// 								isActive: isActive
// 							} )
// 						)
// 						: null
// 				);
// 			};
// 		},
// 		'withCustomClassButton'
// 	);

// 	addFilter(
// 		'editor.BlockEdit',
// 		'custom-class-button/with-custom-class-button',
// 		withCustomClassButton
// 	);
// })( window.wp );
