(function ($) {
    $(document).on('ready', function() {
        $('[data-toggle=search]').on('focus', function() {
            $(this).parents('.nav').first().addClass('focus');
        });
        $('[data-toggle=search]').on('blur', function() {
            $(this).parents('.nav').first().removeClass('focus');
        });
        $('[data-toggle=scroll-summary]').on('click', function() {
            var target = $(this).data('target');
            var targetNode = $('#page-content').find('h2').get(target);
            var positionY = $(targetNode).offset().top;
            $('html, body').animate({
                scrollTop: positionY
            }, 1000);
            return false;
        });
        // Events
        $(window).on('scroll', function() {
            var positionY = $('html').scrollTop();
            console.log(positionY);
        });
    });

}(jQuery));