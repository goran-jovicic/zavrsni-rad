let button = document.getElementById("comments-button");
let comments = document.querySelector('.single-comment');

function hideComments(){
    if (button.innerHTML == 'Show comments'){
        comments.classList.remove('hidden');
        button.innerHTML = 'Hide comments'
    } else {
        comments.className = 'hidden';
        button.innerHTML = 'Show comments';
    }
}


let deleteButton = document.getElementById("delete-post-button");
let post 
console.log(deleteButton);