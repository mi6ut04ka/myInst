import axios from "axios";
export function subscribe(){
    const followButtons = document.querySelectorAll('.follow-button');

    followButtons.forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.getAttribute('data-user-id');
            subscribeToUser(userId);
        });
    });
};

// Функция для подписки на пользователя
function subscribeToUser(userId) {
    axios.post(`/subscribe/${userId}`)
        .then(response => {
            if (response.data.message) {
                removeFollowButtons(userId);
            }
        })
        .catch(error => {
            // Обработка ошибок
            if (error.response) {
                console.error('Ошибка:', error.response.data.message);
                alert('Произошла ошибка при подписке. Пожалуйста, попробуйте еще раз.');
            } else {
                console.error('Ошибка:', error.message);
                alert('Произошла ошибка. Пожалуйста, попробуйте еще раз.');
            }
        });
}

function removeFollowButtons(userId) {
    const followButtons = document.querySelectorAll('.follow-button[data-user-id="' + userId + '"]');
    followButtons.forEach(button => {
        button.closest('form').remove();
    });
}
