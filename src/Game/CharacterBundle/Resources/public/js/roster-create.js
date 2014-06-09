$(document).ready(function(){

    //portrait - selection
    var hidden = $('.roster-portrait > input[type=hidden]');
    $('.roster-portrait').children('img').click(function(e){
        e.preventDefault();
        $(this).siblings('.active').removeClass('active');
        $(this).addClass('active');
        hidden.val($(this).attr('data-portrait-folder')+'/'+$(this).attr('data-portrait-file'));
    });

    //portrait - filters
    $('.roster-filter > a').click(function(e){
        e.preventDefault();
        var filter = $(this).attr('data-filter');

        $('.roster-portrait').children('img').show();
        if (filter != '') {
            $('.roster-portrait').children('img:not([data-portrait-folder='+filter+'])').hide();
        }
    });
});