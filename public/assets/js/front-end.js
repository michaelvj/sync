/**
 * Plugins first, because AJAX is blocking
 */
(function ($) {
    /**
     * Data-api for offcanvas.
     * Enable with data-toggle="offcanvas"
     */
    $(document).on("click.bs.offcanvas.data-api", "[data-toggle=\"offcanvas\"]", function () {
        var $this = $(this),
            $target = $(this.hash);

        $target.toggleClass("in");
        $('body').toggleClass('noscroll');
    });

    /**
     * Auto-open.
     */
    $(window).on("load.bs.offcanvas.data-api", function () {
        var hash = window.location.hash,
            $el = $('[href="' + hash + '"]');

        if ($el) {
            // Emulate click
            $el.click();
        }
    });

    /**
     * Close Offcanvas
     * data-dismiss="offcanvas"
     */
    $(document).on("click.bs.offcanvas.data-api", "[data-dismiss=\"offcanvas\"]", function () {
        $(this).parents('.offcanvas').removeClass("in");
        $('body').removeClass('noscroll');
        // To prevent hash-jump, set to non-existing ID
        window.location.hash = '!';
    });
})(jQuery);

$(function () {

    // Clock in right corner
    var $clock = $('#clock');

    var clock = function(){
        var now = moment();

        $clock.text(now.format('DD MMMM, HH:mm:ss'));

        setTimeout(clock, 1000);
    }
    clock();

    // Set background from cookie
    var parts = document.cookie.split("weathercode="),
        weathercode = parts.pop().split(";").shift();

    if (weathercode) {
        var url = YahooWeatherCodeToImage(weathercode);
        $('body').addClass('background').css('background-image', 'url(' + url + ')');
    }

    // Basic widget functions
    var $widget = {
        loading: function($el){
            var loader = '<div class="load">' +
                            '<h1>' + $el.find('.panel-title').text() +' laden&hellip;</h1>' +
                            '<div class="progress progress-striped active">' +
                                '<div class="progress-bar" style="width: 100%"></div>' +
                            '</div>' +
                         '</div>';
            $el.find('.panel-body').append(loader);
        },
        done: function($el){
            $el.addClass('ready').find('.load').remove();
        },
        error: function($el){
            var loader = '<div class="load">' +
                            '<h1>Fout: ' +  $el.find('.panel-title').text() + ' niet geladen</h1>' +
                          '</div>'

            $el.find('.panel-body').append(loader);
        }
    };

    // Init loading
    $widget.loading($('.weather'));

    // Get weather from Yahoo
    $.getJSON("https://query.yahooapis.com/v1/public/yql?q=SELECT%20*%20FROM%20weather.forecast%20WHERE%20woeid%3D%22727690%22%20AND%20u%3D%22c%22&format=json", function(data){
        var condition = data.query.results.channel.item.condition,
            currentcode = condition.code,
            parts = document.cookie.split("weathercode="),
            background = parts.pop().split(";").shift();

        // Change cookie to current status
        if (background !== currentcode) {
            document.cookie = 'weathercode=' + currentcode + '; expires=' + new Date(Date.now() + 24 * 60 * 60 * 1000).toGMTString() + '; path=/';

            var url = YahooWeatherCodeToImage(currentcode);
            $('body').addClass('background').css('background-image', 'url(' + url + ')');
        }

        var $weather = $('.weather'),
            forecasts = data.query.results.channel.item.forecast;

        // Today
        $weather.find('.day-0 .temp').html(condition.temp + ' &deg;C');
        $weather.find('.day-0 .condition').text(YahooWeatherCodeToString(condition.code));

        // Tomorrow, etc
        for(var i = 1; i <= 2; i++){
            $weather.find('.day-' + i + ' .temp').html(forecasts[i].high + ' &deg;C');
            $weather.find('.day-' + i + ' .condition').text(YahooWeatherCodeToString(forecasts[i].code));
        }

        // Loading is dismissed
        $widget.done($weather);
    }, function(){
        $widget.error($('.weather'));
    });

    // Holiday countdown

    $widget.loading($('.countdown'));

    $.getJSON("http://wouter075.nl/rooster/2/vakanties.php", function(data){
        var $countdown = $('.countdown'),
            now        = moment(new Date()),
            closest    = {
                diff: null,
                obj: {}
            };

        $.map(data, function(date, name){
            var date = date.split(' t/m '),
                start = moment(date[0], 'DD-MM-YYYY');

            // Holiday is yet to come
            if(start.isAfter(now)){
                // Get closest holiday
                var difference = start.unix() - now.unix();

                if(!closest.diff || difference < closest.diff){
                    closest.diff = difference;
                    closest.obj.name = name;
                    closest.obj.date = [start, moment(date[1], 'DD-MM-YYYY')];
                }
            }
        });

        $countdown.find('.title').text(closest.obj.name);

        // Has an end date
        if(closest.obj.date[1].isValid()){
            var start = closest.obj.date[0].format('DD MMMM'),
                end = closest.obj.date[1].format('DD MMMM'),
                description = start + ' &ndash; ' + end;
        } else {
            description = closest.obj.date[0].format('DD MMMM')
        }
        $countdown.find('.description').html(description);

        var timer = function(){
            var start = closest.obj.date[0],
                days = start.diff(Date.now(), 'days'),
                time = start.clone().subtract(Date.now());

            days += (days == '1') ? ' dag' : ' dagen';

            $countdown.find('.days').text(days);
            $countdown.find('.time').text(time.format('HH:mm:ss'));

            setTimeout(timer, 1000);
        }

        timer();

        $widget.done($countdown);
    }, function(){
        $widget.error($('.countdown'));
    });

    function YahooWeatherCodeToString(code) {
        code = parseInt(code, 10);
        switch (code) {
            case 0:
            case 1:
            case 2:
                return "Storm";
            case 3:
            case 4:
            case 37:
            case 38:
            case 39:
            case 45:
            case 47:
                return "Onweer";
            case 5:
            case 6:
            case 7:
            case 8:
            case 10:
            case 18:
                return "IJzel";
            case 9:
                return "Motregen";
            case 11:
            case 12:
            case 40:
                return "Buien";
            case 13:
            case 14:
            case 15:
            case 16:
            case 42:
            case 43:
            case 46:
                return "Sneeuw";
            case 17:
                return "Hagel";
            case 19:
            case 20:
            case 21:
            case 22:
                return "Mistig";
            case 23:
            case 24:
            case 26:
            case 27:
            case 28:
                return "Bewolkt";
            case 25:
            case 31:
            case 32:
            case 36:
                return "Zonnig";
            case 29:
            case 30:
            case 44:
                return "Gedeeltelijk bewolkt";
            case 33:
            case 34:
                return "Licht bewolkt"
            case 35:
                return "Regen en hagel";

            default:
                return "Niet beschikbaar";
        }
    }

    function YahooWeatherCodeToImage(code) {
        code = parseInt(code, 10);
        switch (code) {
            case 0:
            case 1:
            case 2:
                return "/assets/img/weather/10.jpg";
            case 3:
            case 4:
            case 37:
            case 38:
            case 39:
            case 45:
            case 47:
                return "/assets/img/weather/11.jpg";
            case 5:
            case 6:
            case 7:
            case 8:
            case 10:
            case 18:
                return "/assets/img/weather/13.jpg";
            case 9:
                return "/assets/img/weather/04.jpg";
            case 11:
            case 12:
            case 40:
                return "/assets/img/weather/10.jpg";
            case 13:
            case 14:
            case 15:
            case 16:
            case 42:
            case 43:
            case 46:
                return "/assets/img/weather/13.jpg";
            case 17:
                return "/assets/img/weather/10.jpg";
            case 19:
            case 20:
            case 21:
            case 22:
                return "/assets/img/weather/50.jpg";
            case 23:
            case 24:
            case 26:
            case 27:
            case 28:
                return "/assets/img/weather/04.jpg";
            case 25:
            case 31:
            case 32:
            case 36:
                return "/assets/img/weather/01.jpg";
            case 29:
            case 30:
            case 44:
                return "/assets/img/weather/03.jpg";
            case 33:
            case 34:
                return "/assets/img/weather/02.jpg";
            case 35:
                return "/assets/img/weather/09.jpg";

            default:
                return "Niet beschikbaar";
        }
    }
});