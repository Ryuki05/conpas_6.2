$(function () {
    var accordionHeaders = $('.s_07 .accordion_one .accordion_header');
    var accordionState = JSON.parse(localStorage.getItem('accordionState')) || {};

    accordionHeaders.each(function (index, element) {
        var accordionId = 'accordion_' + index;
        
        // アコーディオンの開閉状態を復元
        if (accordionState[accordionId]) {
            $(element).addClass('open');
            $(element).next('.accordion_inner').slideDown();
        } else {
            $(element).removeClass('open'); // 追加：初期状態で閉じる
            $(element).next('.accordion_inner').slideUp(); // 追加：初期状態で閉じる
        }

        // アコーディオンのクリックイベントリスナー内の処理に矢印のクラスを切り替えるコードを追加
        $(element).click(function () {
            $(this).toggleClass('open');
            $(this).next('.accordion_inner').slideToggle();
            $(this).find('.arrow_icon').toggleClass('down'); // 矢印のクラスを切り替える
            accordionState[accordionId] = $(this).hasClass('open');
            localStorage.setItem('accordionState', JSON.stringify(accordionState));
        });

        // アコーディオンの初期状態に応じて矢印の表示を制御するコードを追加
        if ($(element).hasClass('open')) {
            $(element).find('.arrow_icon').addClass('down'); // 開いている場合は下向き矢印を表示
        } else {
            $(element).find('.arrow_icon').removeClass('down'); // 閉じている場合は矢印を非表示
        }
    });
});
