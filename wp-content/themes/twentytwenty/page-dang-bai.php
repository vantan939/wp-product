<?php 
get_header();
$args = array(
    'hide_empty'      => false,
    'orderby' => 'name',
    'order'   => 'ASC'
);             
$cats = get_categories($args);
?>

<main id="site-content" role="main">
    <div class="wrap">
        <h2><?php the_title(); ?></h2>
        <div class="post-upload">
            <form action="" method="POST" autocomplete="off">
                <div class="post-field">
                    <label>Tiêu đề <span class="rq">*</span></label>
                    <input type="text" name="title" name="title" class="rq-field" />
                </div>
                <div class="post-field">
                    <label>Nội dung <span class="rq">*</span></label>
                    <textarea name="content" id="" cols="30" rows="10" class="rq-field"></textarea>
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
                    <input type="file" name="thumbnail" class="rq-field" />
                </div>
                <div class="post-field">
                    <label>Hình ảnh minh họa <span class="rq">*</span></label>
                    <input type="file" name="gallery[]" multiple class="rq-field" />
                </div>
                <div class="post-field">
                    <label>Video sản phẩm</label>
                    <input type="file" name="video" />
                </div>
                <div class="post-field">
                    <input type="checkbox" value="1" name="hot" id="hot"> <label for="hot">Sản phẩm hot</label>
                </div>
                <div class="post-field">
                    <input type="checkbox" value="1" name="confirmed" id="confirmed"> <label for="confirmed">Sản phẩm đã xác nhận</label>
                </div>
                <div class="post-field">
                    <input type="checkbox" value="1" name="confirmed_copy" id="confirmed_copy"> <label for="confirmed_copy">Sản phẩm kiểm định</label>
                </div>
                <div class="post-field">
                    <label>Giá</label>
                    <input type="text" name="price" />
                </div>
                <div class="post-field">
                    <label>Số điện thoại liên hệ</label>
                    <input type="text" name="phone" />
                </div>
                <div class="post-field">
                    <label>Mô tả ngắn</label>
                    <input type="text" name="description" />
                </div>
                <div class="post-field">
                    <label>Năm sản xuất</label>
                    <input type="text" name="year" />
                </div>
                <div class="post-field">
                    <label>Chiều cao</label>
                    <input type="text" name="height" />
                </div>
                <div class="post-field">
                    <label>Trọng lượng</label>
                    <input type="text" name="weight" />
                </div>
                <div class="post-field">
                    <label>Thông số</label>
                    <input type="text" name="params" />
                </div>
                <div class="post-field">
                    <label>Xuất xứ</label>
                    <input type="text" name="country" />
                </div>
                <div class="post-field">
                    <label>Địa chỉ</label>
                    <input type="text" name="address" />
                </div>
                <div class="post-field">
                    <label>Thời gian</label>
                    <input type="text" name="time" />
                </div>
                <div class="post-field">
                    <label>Dịch vụ</label>
                    <input type="text" name="service" />
                </div>
                <div class="post-field">
                    <label></label>
                </div>
                <div class="post-field">
                    <button name="submit" value="submit">Đăng bài</button>
                </div>
            </form>
        </div>
    </div>
</main>

<script>var admin_ajax_url = "<?php echo admin_url('admin-ajax.php');?>";</script>
<?php get_footer(); ?>