// ================================================================================
// wp-block-details.js
// 詳細ブロックのスクリプトファイル
// ================================================================================

//details と summary で実装する開閉アニメーション
function detailsToggle() {
const toggleItems = document.querySelectorAll('.lp-faq-item');
if(toggleItems.length === 0) {
	return;
}

const ACTIVE_CLASS = 'is-active';

toggleItems.forEach(function(toggleItem) {
	const summary = toggleItem.querySelector('summary');
	if(!summary) {
	return;
	}

	const toggleItemStyles = getComputedStyle(toggleItem);
	const toggleItemClassList = toggleItem.classList;
	let isBusy = false;
	let startHeight,endHeight;
	summary.addEventListener('click', async function(event) {
	//デフォルトの挙動を無効化（手動でopen属性の切り替えを行うため）
	event.preventDefault();

	//アニメーションが終了するまでリクエストを無効化
	if (isBusy) {
		return;
	}
	isBusy = true;

	const isOpen = toggleItem.open;
	//クリック時に閉じていた場合は先に開く
	if(!isOpen) {
		toggleItem.open = true;
	}
	toggleItemClassList.toggle(ACTIVE_CLASS,!isOpen);

	//summaryエリアの高さを取得（閉じている状態の高さ）
	const summaryStyles = getComputedStyle(summary);
	const summaryHeight = summary.offsetHeight + parseFloat(summaryStyles.marginTop) + parseFloat(summaryStyles.marginBottom) + parseFloat(toggleItemStyles.paddingTop) + parseFloat(toggleItemStyles.paddingBottom) + parseFloat(toggleItemStyles.borderTopWidth) + parseFloat(toggleItemStyles.borderBottomWidth);

	const toggleItemHeight = toggleItem.offsetHeight;
	if(isOpen) {
		//閉じる
		startHeight = toggleItemHeight;
		endHeight = summaryHeight;
	} else {
		//開く
		startHeight = summaryHeight;
		endHeight = toggleItemHeight;
	}

	//開閉アニメーション
	await toggleItem.animate(
		{
			height: [startHeight + 'px', endHeight + 'px']
		},
		{
			duration: 300,
			easing: 'ease'
		}
	).finished;

	//クリック時に開いていた場合はアニメーション終了後に閉じる
	if(isOpen) {
		toggleItem.open = false;
	}
	isBusy = false;
	});

	//ページ内検索での開閉
	toggleItem.addEventListener('toggle', function() {
	if(toggleItem.open) {
		toggleItemClassList.add(ACTIVE_CLASS);
	} else {
		toggleItemClassList.remove(ACTIVE_CLASS);
	}
	});
});
}

document.addEventListener('DOMContentLoaded', () => {
	detailsToggle();
} );
