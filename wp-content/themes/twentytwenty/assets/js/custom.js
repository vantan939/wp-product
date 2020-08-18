jQuery(document).ready(function($) {
    function validate_form() {
        var error = [];
        var form = $('.post-upload form');
        form.find('.error, .success').remove();
        form.find('.rq-field').each(function(index) {
            if($(this).val() == '') {
                error.push(index);
                $(this).after($('<p class="error">Trường này không được bỏ trống!</p>'));
            }
        });
        return error.length;
    }

    function reset_field() {
        $('.post-upload form').find('input[type="text"], select, textarea').val('');
        $('.post-upload form').find('input[type="checkbox"]').prop('checked', false);;
    }

    $('.post-upload form').submit(function(e) {
        e.preventDefault();
        $this = $(this);
        if(validate_form() > 0) {
            $this.find('button').after($('<p class="error">Có lỗi xảy ra. Vui lòng kiểm tra lại.</p>'));
            return;
        }
        
        $this.find('button').addClass('submiting');
        $.ajax({
            type: 'post',
            url: admin_ajax_url,
            data: $this.serialize() + "&action=upload_post_product",
            dataType: 'JSON',
            success: function (result) {
                if(result.success) {
                    $this.find('button').removeClass('submiting').after($('<p class="success">Đăng bài thành công!</p>'));
                }                
                reset_field();
            }
        });

        return false;
    });
});