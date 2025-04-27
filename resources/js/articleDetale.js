$(document).ready(function() {
    $('tbody tr[data-article-id]').on('click', function() {
        const articleId = $(this).data('article-id');
        window.location.href =`articlesDetail/${articleId}`;
    })
});