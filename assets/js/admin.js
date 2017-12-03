(function ($) {
    $(document).on('ready', function() {
        $('[data-toggle=tabs]').tabs();
        $('[data-toggle=type-content]').on('change', function() {
            $('#post-content-default').hide();
            $('#post-content-md').hide();
            $('#post-content-txt').hide();
        });
        $('[data-toggle=preview]').each(function() {
            var previewNode = this;
            var id = $(previewNode).data('id');
            var type = $(previewNode).data('type');
            var language = $(previewNode).data('language');
            var data = {
                'action': 'get_preview',
                'type': type,
                'id': id,
                'language': language
            };
            $.ajax({
                'type': 'POST',
                'url': ajaxurl,
                'data': data,
                'success': function(response) {
                    $(previewNode).html(response);
                }
            });
        });
    });

}(jQuery));