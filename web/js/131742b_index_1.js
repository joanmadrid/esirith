$(document).ready(function(){
    $('.quest-send-companion').click(function(e){
        e.preventDefault();
        var companion = parseInt($(this).prev('select.quest-companion-select').val());
        var quest = parseInt($(this).attr('data-quest'));

        if (companion > 0) {
            window.location = Routing.generate('quest.send_to_quest', {'companion':companion, 'quest':quest});
        }
    });
});