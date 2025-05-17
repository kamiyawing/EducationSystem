$(document).ready(function() {
    $('.curriculum-link').on('click', function() {
        const curriculumId = $(this).data('curriculum-id');
        window.location.href =`delivery/${curriculumId}`;
    })
});