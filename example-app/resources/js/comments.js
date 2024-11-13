import axios from 'axios';

export function initializeComments() {
    const commentForms = document.querySelectorAll('.comment-from');

    commentForms.forEach(commentForm => {
        const postId = commentForm.getAttribute('data-post-id-form');
        const commentList = commentForm.parentElement.querySelector('.comment-list');
        const visionAllButton = commentForm.parentElement.querySelector('.vision-all');
        const comment = commentList.parentElement.querySelectorAll('.comment');

        comment.forEach(comment => {
            visionAllButton.addEventListener('click', function (e){
                e.preventDefault();
                comment.classList.toggle('hidden');
            })
        })

        commentForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(commentForm);
            axios.post(`/comments/${postId}/upload`, formData)
                .then(response => {
                    const comment = response.data.comment;
                    addCommentToList(comment, commentList); // Передаем commentList
                    commentForm.reset(); // Очищаем форму после отправки
                })
                .catch(error => {
                    console.error('Ошибка при добавлении комментария:', error);
                });
        });

        // Подписка на событие добавления комментария
        window.Echo.channel(`post.${postId}`)
            .listen('CommentAdded', (event) => {
                addCommentToList(event.comment, commentList); // Передаем commentList
            });
    });

    commentForms.forEach(commentForm => {
        const textarea = commentForm.querySelector('textarea');
        const sendButton = commentForm.querySelector('.send-button');

        // Обработка изменений в текстовом поле
        textarea.addEventListener('input', function() {
            // Если есть текст в поле, показываем кнопку отправки
            if (textarea.value.trim() !== '') {
                sendButton.classList.remove('hidden');
                sendButton.disabled = false;
            } else {
                sendButton.classList.add('hidden');
                sendButton.disabled = true;
            }
            textarea.style.height = 'auto';
            textarea.style.height = `${textarea.scrollHeight}px`;
        });
    });
}

// Функция для добавления комментария в список
        function addCommentToList(comment, commentList) {
            const commentItem = document.createElement('div');
            commentItem.classList.add('flex', 'items-start', 'mb-3', 'mt-3');
            commentItem.innerHTML = `
                <img class="h-8 w-8 rounded-full object-cover mr-3" src="https://via.placeholder.com/40" alt="Avatar">
                <div class="flex-1">
                    <div class="flex justify-between items-center">
                        <div class="font-semibold text-sm">${comment.user.username}</div>
                        <small class="text-gray-500 text-xs">${new Date(comment.created_at).toLocaleString()}</small>
                    </div>
                    <p class="text-sm">${comment.text}</p>
                </div>
            `;

            // Добавляем новый комментарий в список
            commentList.appendChild(commentItem);
}
