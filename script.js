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


document.getElementById("delete-post-button").addEventListener('click', function(event) {
    event.preventDefault();
    if(window.confirm("Do you really want to delete this post?")) {
        document.deletePostForm.submit();
    }
})