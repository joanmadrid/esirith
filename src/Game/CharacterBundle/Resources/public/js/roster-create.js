$(document).ready(function(){
    var hidden = $('.roster-portrait > input[type=hidden]');
    $('.roster-portrait').children('img').click(function(e){
        e.preventDefault();
        $(this).siblings('.active').removeClass('active');
        $(this).addClass('active');
        hidden.val($(this).attr('data-portrait'));
    });
});