<?php get_header(); ?>

<main id="site-content" role="main">
    <div class="wrap">
        <h2><?php the_title(); ?></h2>
        <div class="post-upload">
            <form action="" method="GET" autocomplete="off">
                <div class="post-field">
                    <label>Tiêu đề</label>
                    <input type="text" name="title" />
                </div>
                <div class="post-field">
                    <label>Nội dung</label>
                    <textarea name="content" id="" cols="30" rows="10"></textarea>
                </div>
                <div class="post-field">
                    <label>Chuyên mục</label>
                    <select name="category" id="category">
                        <option value="">Chọn chuyên mục</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select>
                </div>
                <div class="post-field">
                    <input type="checkbox" value="yes"> Sản phẩm hot
                </div>
                <div class="post-field">
                    <input type="checkbox" value="yes"> Sản phẩm đã xác nhận
                </div>
                <div class="post-field">
                    <input type="checkbox" value="yes"> Sản phẩm kiểm định
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

<?php get_footer(); ?>