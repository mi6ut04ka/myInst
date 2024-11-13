// lazyLoading.js
import axios from "axios";
import {initializeLikes} from "./likes.js";
import {initializeComments} from "./comments.js";
import {subscribe} from "./subscribe.js";

export const lazyLoadingPost = () => {
    const postsContainer = document.getElementById('posts');
    let skip = parseInt(postsContainer.dataset.initialSkip); // Получаем начальное количество постов
    let loading = false; // Флаг загрузки

    window.addEventListener('scroll', function() {
        // Проверка, достигли ли мы конца страницы
        if (window.scrollY + window.innerHeight >= document.body.offsetHeight && !loading) {
            loading = true; // Устанавливаем флаг загрузки

            axios.get('/posts/load-more', {
                params: { skip: skip }
            })
        .then(function (response) {
                // Добавляем загруженные посты в контейнер
                postsContainer.insertAdjacentHTML('beforeend', response.data.html);
                skip += response.data.count; // Увеличиваем значение пропуска
                loading = false; // Сбрасываем флаг загрузки

                initializeLikes();
                initializeComments();
                subscribe();
            })
                .catch(function (error) {
                    console.error('Error loading more posts:', error);
                    loading = false; // Сбрасываем флаг загрузки в случае ошибки
                });
        }
    });
}
