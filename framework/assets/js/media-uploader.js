(function($) {
    $(document).ready(function() {
        function optionsframework_add_file(event, selector) {
            var upload = $(".uploaded-file"),
                frame;
            var $el = $(this);
            event.preventDefault();
            if (frame) {
                frame.open();
                return
            }
            frame = wp.media({
                title: $el.data('choose'),
                button: {
                    text: $el.data('update'),
                    close: false
                }
            });
            frame.on('select', function() {
                var attachment = frame.state().get('selection').first();
                frame.close();
                selector.find('.upload').val(attachment.attributes.url);
                if (attachment.attributes.type == 'image') {
                    selector.find('.screenshot').empty().hide().append('<img src="' + attachment.attributes.url + '"><a class="remove-image">Remove</a>').slideDown('fast')
                }
                selector.find('.upload-button').unbind().addClass('remove-file').removeClass('upload-button').val(optionsframework_l10n.remove);
                selector.find('.of-background-properties').slideDown();
                optionsframework_file_bindings()
            });
            frame.open()
        }

        function optionsframework_remove_file(selector) {
            selector.find('.remove-image').hide();
            selector.find('.upload').val('');
            selector.find('.of-background-properties').hide();
            selector.find('.screenshot').slideUp();
            selector.find('.remove-file').unbind().addClass('upload-button').removeClass('remove-file').val(optionsframework_l10n.upload);
            if ($('.section-upload .upload-notice').length > 0) {
                $('.upload-button').remove()
            }
            optionsframework_file_bindings()
        }

        function optionsframework_file_bindings() {
            $('.remove-image, .remove-file').on('click', function() {
                optionsframework_remove_file($(this).parents('.section'))
            });
            $('.upload-button').click(function(event) {
            	console.log('aa');
                optionsframework_add_file(event, $(this).parents('.section'))
            })
        }
        optionsframework_file_bindings()
    })
})(jQuery);
