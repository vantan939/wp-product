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
        form.find('.thumbnail-field').change(function(index) {
            $(this).nextAll('.error').remove();
            var file = $(this).val().toLowerCase();
            var regex = new RegExp("(.*?)\.(png|jpg|jpeg)$");
            if(file != '') {
                if (!(regex.test(file))) {
                    error.push(index);
                    $(this).after($('<p class="error">Định dạng không hợp lệ!</p>'));
                }
                if((this.files[0].size)/1024/1024 > 1 && (regex.test(file))) {
                    error.push(index);
                    $(this).after($('<p class="error">Dung lượng tối đa 1MB.</p>'));
                }
            }
        });
        form.find('.gallery-field').change(function(index) {
            $(this).nextAll('.error').remove();
            var files = $(this)[0].files;
            var regex = new RegExp("(.*?)\.(png|jpg|jpeg)$");
            var error_field = [];
            if(files != '') {
                for (var i = 0; i < files.length; i++) {                    
                    if (!(regex.test(files[i].name.toLowerCase()))) {
                        error_field.push('format');
                        $(this).after($('<p class="error">Định dạng không hợp lệ!</p>'));
                    }
                    if((files[i].size)/1024/1024 > 1 && (files[i].name.toLowerCase()) && !error_field.includes('format')) {
                        error_field.push('size');
                        $(this).after($('<p class="error">Dung lượng tối đa 1MB.</p>'));
                    }
                }
            }
        });
        form.find('.video-field').change(function(index) {
            $(this).nextAll('.error').remove();
            var file = $(this).val().toLowerCase();
            var regex = new RegExp("(.*?)\.(mp4)$");
            if(file != '') {
                if (!(regex.test(file))) {
                    error.push(index);
                    $(this).after($('<p class="error">Định dạng không hợp lệ!</p>'));
                }
                if((this.files[0].size)/1024/1024 > 1 && (regex.test(file))) {
                    error.push(index);
                    $(this).after($('<p class="error">Dung lượng tối đa 100MB.</p>'));
                }
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
        var formData = new FormData(this);
        formData.append('action', 'upload_post_product');
        $.ajax({
            type: 'post',
            url: admin_ajax_url,
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'JSON',
            success: function (result) {
                if(result.success) {
                    $this.find('button').removeClass('submiting').after($('<p class="success">Đăng bài thành công!</p>'));
                }                
                reset_field();
                // console.log(result);
            }
        });

        return false;
    });
});