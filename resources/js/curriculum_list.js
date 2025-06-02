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
        data: { grade_id: gradeId, ajaxOnly: 1 },
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

    const activeGradeId = $('.grade-button.active').data('grade-id');
    const page = new URL($(this).attr('href')).searchParams.get('page');

    if (!activeGradeId) {
        alert('学年を選択してからページを切り替えてください');
        return;
    }

    const pageUrl = new URL(window.curriculumFilterUrl, window.location.origin);
    pageUrl.searchParams.set('grade_id', activeGradeId);
    pageUrl.searchParams.set('page', page);
    pageUrl.searchParams.set('ajaxOnly', '1');

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