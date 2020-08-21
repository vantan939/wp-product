jQuery(document).ready(function($) {
    ({		
		init: function() {
            this.loadCkeditor();
            this.submit_form();
            this.validate_media_fields_load();
            this.media_preview_handle();
        },

        loadCkeditor: function() {
            if($('.post-upload form').length > 0)
            CKEDITOR.replace('content', {
                on: {
                    change: function() {
                        this.updateElement();    
                    }
                }
            });
        },

        media_preview_handle: function() {
            // For thumbnail
            $('.thumnail-prev .delete').click(function() {
                $(this).parents('.post-field').find('.media').show();
                $(this).parents('.thumnail-prev').remove();
            });

            // For gallery
            $('.gallery-prev .delete').click(function() {
                $(this).parent().remove();
                if($('.gallery-field').nextAll('.gallery-prev').find('.prev-item').length == 0) {
                    $('.gallery-field').nextAll('.gallery-prev').remove();
                }
            });

            // For video
            $('.video-prev .delete').click(function() {
                $(this).parents('.post-field').find('.media').show();
                $(this).parents('.video-prev').hide();
                $(this).parents('.video-prev').find('.media').val('');
            });
        },

        validate_thumbnail_field: function($this) {
            var file = $this.val().toLowerCase();
            var regex = new RegExp("(.*?)\.(png|jpg|jpeg)$");
            if(file != '') {
                $this.nextAll('.error').remove();
                if (!(regex.test(file))) {
                    $this.after($('<p class="error">Định dạng không hợp lệ!</p>'));
                }
                if(($this[0].files[0].size)/1024/1024 > 1 && (regex.test(file))) {
                    $this.after($('<p class="error">Dung lượng tối đa 1MB.</p>'));
                }
            }
        },

        validate_gallery_field: function($this) {
            var files = $this[0].files;
            var regex = new RegExp("(.*?)\.(png|jpg|jpeg)$");
            var error_field = [];
            if(files.length > 0) {
                $this.nextAll('.error').remove();
                for (var i = 0; i < files.length; i++) {                    
                    if (!(regex.test(files[i].name.toLowerCase()))) {
                        error_field.push('format');
                        $this.after($('<p class="error">Định dạng không hợp lệ!</p>'));
                    }
                    if((files[i].size)/1024/1024 > 1 && (files[i].name.toLowerCase()) && !error_field.includes('format')) {
                        error_field.push('size');
                        $this.after($('<p class="error">Dung lượng tối đa 1MB.</p>'));
                    }
                }
            }
        },

        validate_video_field: function($this) {            
            var file = $this.val().toLowerCase();
            var regex = new RegExp("(.*?)\.(mp4)$");
            if(file != '') {
                $this.nextAll('.error').remove();
                if (!(regex.test(file))) {
                    $this.after($('<p class="error">Định dạng không hợp lệ!</p>'));
                }
                if(($this[0].files[0].size)/1024/1024 > 100 && (regex.test(file))) {
                    $this.after($('<p class="error">Dung lượng tối đa 100MB.</p>'));
                }
            }
        },

        validate_media_fields_load: function() {
            var self = this;
            var form = $('.post-upload form');
            form.find('.thumbnail-field').change(function(index) {
                self.validate_thumbnail_field($(this));
            });
            form.find('.gallery-field').change(function(index) {
                self.validate_gallery_field($(this));
            });
            form.find('.video-field').change(function(index) {
                self.validate_video_field($(this));
            });
        },

        validate_fields_submit: function() {
            var self = this;
            var form = $('.post-upload form');
            form.find('.error, .success').remove();
            form.find('.rq-field').each(function(index) {
                if(!$(this).hasClass('media')) {
                    if($(this).val() == '') {
                        if($(this).attr('name') != 'content') {
                            $(this).after($('<p class="error">Trường này không được bỏ trống!</p>'));
                        }else {
                            $(this).nextAll('#cke_content').after($('<p class="error">Trường này không được bỏ trống!</p>'));
                        }                        
                    }
                }
                if($(this).hasClass('thumbnail-field')) {
                    if($(this).nextAll('.thumnail-prev').length == 0) {
                        $(this).after($('<p class="error">Trường này không được bỏ trống!</p>'));
                    }
                }
                if($(this).hasClass('gallery-field')) {
                    if($(this).val() == '' && $(this).nextAll('.gallery-prev').length == 0) {
                        $(this).after($('<p class="error">Trường này không được bỏ trống!</p>'));
                    }
                }
            });
            form.find('.thumbnail-field').each(function(index) {
                self.validate_thumbnail_field($(this));
            });
            form.find('.gallery-field').each(function(index) {
                self.validate_gallery_field($(this));
            });
            form.find('.video-field').each(function(index) {
                self.validate_video_field($(this));
            });
            return form.find('.error:not(.msg)').length;
        },

        reset_field: function() {
            $('.post-upload form').find('input[type="text"], input[type="file"], select, textarea').val('');
            $('.post-upload form').find('input[type="checkbox"]').prop('checked', false);
            CKEDITOR.instances['content'].setData('');
        },

        submit_form: function() {
            var self = this;
            $('.post-upload form').submit(function(e) {
                e.preventDefault();
                $this = $(this);
                if(self.validate_fields_submit() > 0) {
                    $this.find('button').after($('<p class="error msg">Có lỗi xảy ra. Vui lòng kiểm tra lại.</p>'));
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
                        var msg = formData.get('status') == 'update' ? 'Cập nhật thành công!' : 'Đăng bài thành công!';
                        if(result.success) {
                            $this.find('button').removeClass('submiting').after($('<p class="success">'+msg+'</p>'));
                        }                
                        self.reset_field();
                        if(formData.get('status') == 'update') {
                            setTimeout(function(){ 
                                location.reload();
                            }, 1000);
                        }
                        // console.log(result);
                    }
                });
        
                return false;
            });
        }

    }.init());

});