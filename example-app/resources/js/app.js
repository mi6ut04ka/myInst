import './bootstrap';
import {initializeLikes} from "./likes.js";
import {initializeComments} from "./comments.js";
import {lazyLoadingPost} from "./lazyLoadingPost.js";
import {subscribe} from "./subscribe.js"
import {uploadAvatar} from "./avatar.js";
import {modal} from "./modal.js";


document.addEventListener('DOMContentLoaded', function() {
    uploadAvatar();
    modal();
    const postsContainer = document.getElementById('posts');
    const initialSkip = postsContainer.dataset.initialSkip;
    lazyLoadingPost(initialSkip);

    subscribe();
    initializeComments();
    initializeLikes();
});

