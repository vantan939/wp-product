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

    function get_val_meta($name_meta) {
        return get_post_meta(ID_POST, $name_meta, true);
    }
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
                        <option value="<?php echo $cat->term_id; ?>"><?php echo $cat->name; ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="post-field">
            <label>Ảnh đại diện <span class="rq">*</span></label>
            <input type="file" name="thumbnail" class="rq-field thumbnail-field" />
        </div>
        <div class="post-field">
            <label>Hình ảnh minh họa <span class="rq">*</span></label>
            <input type="file" name="gallery[]" multiple class="rq-field gallery-field" />
        </div>
        <div class="post-field">
            <label>Video sản phẩm</label>
            <input type="file" name="video" class="video-field" />
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
            <input type="text" name="service" value="<?php echo !empty(ID_POST) ? get_val_meta('service') : ''; ?>" />
        </div>
        <div class="post-field">
            <button name="submit" value="submit"><?php echo !empty(ID_POST) ? 'Cập nhật' : 'Đăng bài'; ?></button>
        </div>
    </form>
</div>