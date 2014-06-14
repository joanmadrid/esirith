$(document).ready(function(){
    //tooltips
    $('.has-tooltip').tooltip();

    //countdowns
    $('.countdown').each(function(){
        var self = $(this);
        var text = $(this).text();
        text = text.split(':');
        var date = new Date();
        date.setHours(date.getHours() + parseInt(text[0]));
        date.setMinutes(date.getMinutes() + parseInt(text[1]));
        date.setSeconds(date.getSeconds() + parseInt(text[2]));
        console.log(date);
        $(this).countdown({
            date: date,
            render: function(data) {
                self.text(
                    this.leadingZeros(data.hours, 2)
                        +":"
                        +this.leadingZeros(data.min, 2)
                        +":"
                        +this.leadingZeros(data.sec, 2));
            },
            onEnd: function() {
                self.text('00:00:00');
            }
        });
    });
});