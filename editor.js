// ================================================================================
// editor.js
// エディター用のスクリプトファイル
// ================================================================================
const { Fragment, createElement } = wp.element;
const { registerFormatType, toggleFormat, insert } = wp.richText;
const { RichTextToolbarButton, RichTextShortcut, BlockFormatControls } = wp.blockEditor;
const { useSelect } = wp.data;


/*!
  * ツールバーに"PCのみ改行 / スマホのみ改行"ボタンを追加（出力はショートコード）
*/

const addShortcodeButton = () => {
	registerFormatType( 'theme-format/break-sp', {
		title: 'break-sp',
		tagName: 'span',
		className: 'break-sp',
		edit: function( props ) {
			return wp.element.createElement(
				RichTextToolbarButton,
				{
					icon: 'editor-break',
					title: '改行（スマホのみ）',
					onClick: function() {
						props.onChange( insert(
							props.value,
							'[br-sp]',
							props.value.start,
							props.value.end
						) );
					}
				}
			);
		},
	} );

	registerFormatType( 'theme-format/break-pc', {
		title: 'break-pc',
		tagName: 'span',
		className: 'break-pc',
		edit: function( props ) {
			return wp.element.createElement(
				RichTextToolbarButton,
				{
					icon: 'editor-break',
					title: '改行（PCのみ）',
					onClick: function() {
						props.onChange( insert(
							props.value,
							'[br-pc]',
							props.value.start,
							props.value.end
						) );
					}
				}
			);
		},
	} );

}

addShortcodeButton();