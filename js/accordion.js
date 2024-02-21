// accordion.js

$(function(){
    $('.i_box').click(function(){
        $(this).next('.accordion_inner').slideToggle();
        $(this).toggleClass("open");
    });
});
