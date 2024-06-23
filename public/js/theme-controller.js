document.addEventListener('DOMContentLoaded', function() {
    const themeControllers = document.querySelectorAll('.theme-controller');

    // ローカルストレージからテーマを読み込む
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme) {
        document.documentElement.setAttribute('data-theme', savedTheme);
        const themeController = document.querySelector(`.theme-controller[value="${savedTheme}"]`);
        if (themeController) {
            themeController.checked = true;
        }
    }

    themeControllers.forEach(controller => {
        controller.addEventListener('change', function() {
            const selectedTheme = this.value;
            document.documentElement.setAttribute('data-theme', selectedTheme);
            // ローカルストレージにテーマを保存
            localStorage.setItem('theme', selectedTheme);
        });
    });

    // ラベルクリックでラジオボタンの選択をトリガー
    document.querySelectorAll('label[for="theme-dropdown"]').forEach(label => {
        label.addEventListener('click', function() {
            const radioButton = label.previousElementSibling;
            radioButton.checked = true;
            radioButton.dispatchEvent(new Event('change'));
        });
    });
});