<?php
$args = array(
    'hide_empty'      => false,
    'orderby' => 'name',
    'order'   => 'ASC'
);             
$cats = get_categories($args);
define('ID_POST', $_GET['id']);
if(isset($_GET['id'])) {    
    $post_title = get_the_title(ID_POST);
    $post_content = apply_filters('the_content', get_post_field('post_content', ID_POST));    
    $cat_id = get_the_category(ID_POST)[0]->term_id;
    $tags = get_the_tags(ID_POST);
    $tags_arr = [];
    if(!empty($tags)) {
        foreach($tags as $tag) {
            $tags_arr[] = $tag->name; 
        }
    }

    function get_val_meta($name_meta) {
        return get_post_meta(ID_POST, $name_meta, true);
    }

    $thumbnail = get_post_thumbnail_id(ID_POST);
    $gallery = get_val_meta('gallery_image');
    $video = get_val_meta('video');
}
?>
<div class="post-upload">
    <form action="" method="POST" autocomplete="off">
        <div class="post-field">
            <label>Tiêu đề <span class="rq">*</span></label>
            <input type="text" name="title" name="title" class="rq-field" value="<?php echo !empty(ID_POST) ? $post_title : ''; ?>" />
        </div>
        <div class="post-field">
            <label>Nội dung <span class="rq">*</span></label>
            <textarea name="content" id="" cols="30" rows="10" class="rq-field"><?php echo !empty(ID_POST) ? $post_content : ''; ?></textarea>
        </div>
        <div class="post-field">
            <label>Chuyên mục <span class="rq">*</span></label>                    
            <select name="category" id="category" class="rq-field">
                <option value="">Chọn chuyên mục</option>
                <?php foreach($cats as $cat): ?>
                    <?php if($cat->slug != 'uncategorized'): ?>
                        <option <?php echo ($cat->term_id == $cat_id) ? 'selected' : ''; ?> value="<?php echo $cat->term_id; ?>"><?php echo $cat->name; ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="post-field">
            <label>Ảnh đại diện <span class="rq">*</span></label>
            <input type="file" name="thumbnail" class="rq-field thumbnail-field media" <?php echo !empty($thumbnail) ? 'style=display:none;' : '';  ?> />
            <?php if(!empty($thumbnail)): ?>
                <div class="img-prev thumnail-prev">
                    <div class="prev-item">
                        <img width="20" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/close.png" class="delete">
                        <a href="<?php echo wp_get_attachment_image_src($thumbnail, 'full')[0]; ?>" target="_blank">
                            <?php echo wp_get_attachment_image($thumbnail); ?>
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="post-field">
            <label>Hình ảnh minh họa <span class="rq">*</span></label>
            <input type="file" name="gallery[]" multiple class="rq-field gallery-field media" />
            <?php if(!empty($gallery)): ?>
                <div class="img-prev gallery-prev">
                    <?php foreach($gallery as $id): ?>
                        <div class="prev-item">
                            <img width="20" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/close.png" class="delete">
                            <a href="<?php echo wp_get_attachment_image_src($id, 'full')[0]; ?>" target="_blank">
                                <?php echo wp_get_attachment_image($id); ?>
                            </a>
                            <input type="hidden" name="gallery_old_ids[]" value="<?php echo $id; ?>">
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="post-field">
            <label>Video sản phẩm</label>
            <input type="file" name="video" class="video-field media" <?php echo !empty($video) ? 'style=display:none;' : '';  ?> />
            <?php if(!empty($video)): ?>                
                <div class="img-prev video-prev">
                    <div class="prev-item">
                        <img width="20" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/close.png" class="delete">
                        <a href="<?php echo wp_get_attachment_url($video); ?>" target="_blank">
                            <div class="video-img-prev">
                                <img src="<?php echo home_url(); ?>/wp-includes/images/media/video.png" alt="">
                            </div>
                            <div class="info-video">
                                File name: <?php echo get_the_title($video). '.'. wp_get_attachment_metadata($video)['fileformat']; ?> <br>
                                Size: <?php echo round(wp_get_attachment_metadata($video)['filesize'] / 1024).'KB'; ?>
                            </div>
                            <input type="hidden" name="video_old_id" value="<?php echo $video; ?>" >
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="post-field">
            <input type="checkbox" value="1" name="hot" id="hot" 
                <?php echo !empty(ID_POST) && get_val_meta('hot') ? 'checked' : ''; ?> 
            > <label for="hot">Sản phẩm hot</label>
        </div>
        <div class="post-field">
            <input type="checkbox" value="1" name="confirmed" id="confirmed" 
                <?php echo !empty(ID_POST) && get_val_meta('confirmed') ? 'checked' : ''; ?> 
            > <label for="confirmed">Sản phẩm đã xác nhận</label>
        </div>
        <div class="post-field">
            <input type="checkbox" value="1" name="confirmed_copy" id="confirmed_copy" 
                <?php echo !empty(ID_POST) && get_val_meta('confirmed_copy') ? 'checked' : ''; ?> 
            > <label for="confirmed_copy">Sản phẩm kiểm định</label>
        </div>
        <div class="post-field">
            <label>Kiểm định/Có VIDEO</label>
            <select name="video_on">
                <option <?php echo (!empty(ID_POST) && get_val_meta('video_on') == 'confirm') ? 'selected' : ''; ?> value="confirm">Kiểm định</option>
                <option <?php echo (!empty(ID_POST) && get_val_meta('video_on') == 'video') ? 'selected' : ''; ?> value="video">Có VIDEO</option>
            </select>
        </div>
        <div class="post-field">
            <label>Tags</label>
            <input type="text" name="tags" placeholder="Ví dụ: tag1, tag2" value="<?php echo !empty($tags_arr) ? implode (", ", $tags_arr) : ''; ?>" />
        </div>
        <div class="post-field">
            <label>Giá</label>
            <input type="text" name="price" value="<?php echo !empty(ID_POST) ? get_val_meta('price') : ''; ?>" />
        </div>
        <div class="post-field">
            <label>Số điện thoại liên hệ</label>
            <input type="text" name="phone" value="<?php echo !empty(ID_POST) ? get_val_meta('phone') : ''; ?>" />
        </div>
        <div class="post-field">
            <label>Mô tả ngắn</label>
            <textarea name="description" id="" cols="30" rows="10"><?php echo !empty(ID_POST) ? get_val_meta('description') : ''; ?></textarea>                    
        </div>
        <div class="post-field">
            <label>Năm sản xuất</label>
            <input type="text" name="year" value="<?php echo !empty(ID_POST) ? get_val_meta('year') : ''; ?>"  />
        </div>
        <div class="post-field">
            <label>Chiều cao</label>
            <input type="text" name="height" value="<?php echo !empty(ID_POST) ? get_val_meta('height') : ''; ?>" />
        </div>
        <div class="post-field">
            <label>Trọng lượng</label>
            <input type="text" name="weight" value="<?php echo !empty(ID_POST) ? get_val_meta('weight') : ''; ?>" />
        </div>
        <div class="post-field">
            <label>Thông số</label>
            <input type="text" name="params" value="<?php echo !empty(ID_POST) ? get_val_meta('params') : ''; ?>" />
        </div>
        <div class="post-field">
            <label>Xuất xứ</label>
            <input type="text" name="country" value="<?php echo !empty(ID_POST) ? get_val_meta('country') : ''; ?>" />
        </div>
        <div class="post-field">
            <label>Địa chỉ</label>
            <input type="text" name="address" value="<?php echo !empty(ID_POST) ? get_val_meta('address') : ''; ?>" />
        </div>
        <div class="post-field">
            <label>Thời gian</label>
            <input type="text" name="time" value="<?php echo !empty(ID_POST) ? get_val_meta('time') : ''; ?>" />
        </div>
        <div class="post-field">
            <label>Dịch vụ</label>
            <textarea name="service" id="" cols="30" rows="10"><?php echo !empty(ID_POST) ? get_val_meta('service') : ''; ?></textarea>                                
        </div>
        <div class="post-field">
            <input type="hidden" name="post_id" value="<?php echo !empty(ID_POST) ? ID_POST : ''; ?>">
            <input type="hidden" name="status" value="<?php echo !empty(ID_POST) ? 'update' : 'create'; ?>">
            <button name="submit" value="submit"><?php echo !empty(ID_POST) ? 'Cập nhật' : 'Đăng bài'; ?></button>
        </div>
    </form>
</div>