export function modal(){
    const openModalBtnFollowers = document.getElementById('openModalBtn-followers');
    const modalFollowers = document.getElementById('modal-followers');
    const closeModalBtnFollowers = document.getElementById('closeModalBtn-followers');

    const openModalBtnFollowing = document.getElementById('openModalBtn-following');
    const modalFollowing = document.getElementById('modal-following');
    const closeModalBtnFollowing = document.getElementById('closeModalBtn-following');

    // Открытие модального окна для подписчиков
    if (openModalBtnFollowers) {
        openModalBtnFollowers.addEventListener('click', function() {
            modalFollowers.classList.remove('hidden');
        });
    }

    // Закрытие модального окна для подписчиков
    if (closeModalBtnFollowers) {
        closeModalBtnFollowers.addEventListener('click', function() {
            modalFollowers.classList.add('hidden');
        });
    }

    // Открытие модального окна для подписок
    if (openModalBtnFollowing) {
        openModalBtnFollowing.addEventListener('click', function() {
            modalFollowing.classList.remove('hidden');
        });
    }

    // Закрытие модального окна для подписок
    if (closeModalBtnFollowing) {
        closeModalBtnFollowing.addEventListener('click', function() {
            modalFollowing.classList.add('hidden');
        });
    }

    // Закрытие модальных окон при клике вне их
    window.addEventListener('click', function(event) {
        if (event.target === modalFollowers) {
            modalFollowers.classList.add('hidden');
        }
        if (event.target === modalFollowing) {
            modalFollowing.classList.add('hidden');
        }
    });
}
