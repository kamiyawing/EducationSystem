import $ from 'jquery';

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    }
});

console.log('✅ curriculum_list.js 読み込まれました');

$(document).on('click', '.grade-button', function () {
    $('.grade-button').removeClass('active');
    $(this).addClass('active');

    const gradeId = $(this).data('grade-id');

    $.ajax({
        url: window.curriculumFilterUrl,
        method: 'GET',
        data: { grade_id: gradeId },
        success: function (res) {
            $('#curriculum-list').html(res);
        },
        error: function () {
            alert('通信に失敗しました');
        }
    });
});

$(document).on('click', '.pagination a', function (e) {
    e.preventDefault();

    const pageUrl = new URL($(this).attr('href'), window.location.origin);
    const activeGradeId = $('.grade-button.active').data('grade-id');

    if (activeGradeId) {
        pageUrl.searchParams.set('grade_id', activeGradeId);
    }

    $.ajax({
        url: pageUrl.toString(),
        method: 'GET',
        success: function (res) {
            $('#curriculum-list').html(res);
        },
        error: function () {
            alert('ページネーション通信エラー');
        }
    });
});