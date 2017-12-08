(function ($) {
    $(document).on('ready', function() {
        $('[data-toggle=fancybox]').fancybox();
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
            var heightMax = $('#header').height();
            if (positionY > heightMax) {
                $('#header').addClass('static');
            } else {
                $('#header').removeClass('static');
            }
        });
        $(window).trigger('scroll');
    });

}(jQuery));