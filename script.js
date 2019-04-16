let button = document.getElementById("comments-button");
let comments = document.querySelector('.comment-list');

function hideComments(){
    if (button.innerHTML == 'Show comments'){
        comments.classList.remove('hidden');
        button.innerHTML = 'Hide comments'
    } else {
        comments.className = 'hidden';
        button.innerHTML = 'Show comments';
    }
}


