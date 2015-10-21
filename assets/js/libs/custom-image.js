var image_field;
(function($) {
    $(document).on('click', 'input.select-img', function(evt) {
        image_field = $(this).siblings('.img');
        tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
        return false;
    });

    window.send_to_editor = function(html) {
        console.log(html);
        imgurl = $(html).attr('src');
        console.log(imgurl);
        console.log('dzialam');
        image_field.val(imgurl);
        tb_remove();
    }
})(jQuery);