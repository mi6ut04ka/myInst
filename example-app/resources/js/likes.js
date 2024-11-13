import axios from 'axios';

export function initializeLikes() {
    const likeForms = document.querySelectorAll('.like-form');

    likeForms.forEach(form => {
        const button = form.querySelector('.like-button');

        // Удаляем старый обработчик, если он есть
        const oldHandler = button.getAttribute('data-initialized');
        if (!oldHandler) {
            button.addEventListener('click', function() {
                const postId = form.getAttribute('data-post-id');

                axios.post(`/posts/${postId}/like`)
                    .then(response => {
                        const newIcon = response.data.liked ? 'like-icon.svg' : 'unlike-icon.svg';
                        button.querySelector('img').src = `/storage/icons/${newIcon}`;
                    })
                    .catch(error => {
                        console.error('Ошибка при обработке лайка:', error);
                    });
            });

            // Отмечаем, что кнопка была инициализирована
            button.setAttribute('data-initialized', 'true');
        }
    });
}
