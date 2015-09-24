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

                // bind remove file to button after new image was chosen
                optionsframework_file_bindings( 'add', selector.find('.remove-file') );
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

            // bind upload image to button after current image was deleted
            optionsframework_file_bindings( 'remove', selector.find('.upload-button') )
        }

        function optionsframework_file_bindings(event, selector) {
            
            if ( event === "add" && selector )
            {

                selector.on('click', function() {

                    var selector = $(this).parents('.section').length > 0 ? $(this).parents('.section') : $(this).parents('td');
                    optionsframework_remove_file(selector);

                });

            } else if ( event === "remove" && selector )
            {

                selector.on('click', function(event) {

                    var selector = $(this).parents('.section').length > 0 ? $(this).parents('.section') : $(this).parents('td');
                    optionsframework_add_file(event, selector);

                });

            } else
            {

                $('.remove-image, .remove-file').on('click', function() {
                    
                    var selector = $(this).parents('.section').length > 0 ? $(this).parents('.section') : $(this).parents('td');
                    optionsframework_remove_file(selector);

                });
                $('.upload-button').click(function(event) {
                    
                    var selector = $(this).parents('.section').length > 0 ? $(this).parents('.section') : $(this).parents('td');
                    optionsframework_add_file(event, selector);

                });

            }
        }
        optionsframework_file_bindings()
    })
})(jQuery);
