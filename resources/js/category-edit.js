$(document).ready(function() {
    // カテゴリ名の編集ボタンのクリックイベント
    $('.edit-button').on('click', function(event) {
        event.preventDefault();
        const categoryId = $(this).data('category-id');
        const categoryNameElem = $(this).siblings('.category-name');
        const colorPicker = $(`.color-picker[data-category-id="${categoryId}"]`);

        // カテゴリ名をinputに変換
        const input = $('<input>', {
            type: 'text',
            value: categoryNameElem.text(),
            class: 'category-name-input'
        });
        categoryNameElem.replaceWith(input);

        // カラーパレットを表示
        colorPicker.show();

        // カテゴリ名の変更を保存
        input.on('blur', function() {
            const newName = input.val();
            const newColor = colorPicker.val();

            // AJAXリクエストでカテゴリ名と色を更新
            $.ajax({
                url: `/category/${categoryId}`,
                type: 'PUT',
                data: {
                    name: newName,
                    color: newColor,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        // 更新が成功した場合、カテゴリ名と色を更新
                        input.replaceWith(categoryNameElem);
                        categoryNameElem.text(newName);
                        categoryNameElem.css('color', newColor);
                        colorPicker.hide();
                    } else {
                        // エラー処理
                        alert('カテゴリの更新に失敗しました。');
                    }
                }
            });
        });
    });
});