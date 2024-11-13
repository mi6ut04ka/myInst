export function uploadAvatar() {
    const avatarPreview = document.getElementById('avatar-preview');
    const avatarInput = document.getElementById('avatar');
    const avatarForm = document.getElementById('avatar-form');

    if (avatarPreview && avatarInput && avatarForm) {
        // Открытие инпута файла при клике на изображение
        avatarPreview.addEventListener('click', function () {
            avatarInput.click();
        });

        // Предварительный просмотр загруженного файла
        avatarInput.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    avatarPreview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        // Автоматическая отправка формы после выбора файла
        avatarInput.addEventListener('change', function () {
            avatarForm.submit();
        });
    }
}
