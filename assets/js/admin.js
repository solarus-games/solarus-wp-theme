(function ($) {
    $(document).on('ready', function() {
        $('[data-toggle=type-content]').on('change', function() {
            $('#post-content-default').hide();
            $('#post-content-md').hide();
            $('#post-content-txt').hide();
        });
    });

}(jQuery));