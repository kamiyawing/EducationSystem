import './bootstrap';
import '../sass/app.scss'

import $ from 'jquery';

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    }
});

console.log('✅ app.js 読み込まれました');

$(document).on('click', '.grade-button', function () {
    console.log('✅ 学年ボタンが押されました');
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
    e.preventDefault(); // 通常のリンク遷移をキャンセル

    const pageUrl = new URL($(this).attr('href'), window.location.origin);
    const activeGradeId = $('.grade-button.active').data('grade-id'); // どの学年ボタンが押されたか

    if (activeGradeId) {
        pageUrl.searchParams.set('grade_id', activeGradeId); // grade_id を明示的に追加
    }

    $.ajax({
        url: pageUrl.toString(),
        method: 'GET',
        success: function (res) {
            $('#curriculum-list').html(res); // 一覧の部分だけ差し替え
        },
        error: function () {
            alert('ページネーション通信エラー');
        }
    });
});

$(document).on('click', '.grade-button', function () {
    $('.grade-button').removeClass('active');
    $(this).addClass('active');
});