<?php 
if(!is_user_logged_in()) {
    wp_redirect(home_url('/my-account'));
    exit;
}
get_header();
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args_posts = array(
    'post_type'  =>   'post',
    'post_status'   => 'any',
    'posts_per_page' => 10,
    'paged' => $paged,
    'author' => current_user_can('administrator') ? '' : get_current_user_id()
);
$posts_query = new WP_Query( $args_posts );
?>

<main id="site-content" role="main">
    <div class="wrap list-post">
        <h2><?php the_title(); ?></h2>
        <?php if( $posts_query->have_posts() ) : ?>
            <table class="list-post">
                <thead>
                    <tr>
                        <th>Tên bài viết</th>
                        <th style="width: 150px">Ảnh đại diện</th>
                        <th style="width: 120px">Trạng thái</th>
                        <th style="width: 145px">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while( $posts_query->have_posts() ) : $posts_query->the_post(); ?>
                        <tr class="post-item">
                            <td width="70%">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </td>
                            <td>
                                <a href="<?php echo get_the_post_thumbnail_url();?>" target="_blank">
                                    <?php echo get_the_post_thumbnail(get_the_ID(), 'thumbnail'); ?>                 
                                </a>
                            </td>
                            <td><?php echo (get_post_status(get_the_ID()) == 'publish') ? 'Đã đăng' : 'Chờ duyệt'; ?></td>
                            <td>
                                <a target="_blank" href="<?php echo home_url(); ?>/sua-bai-viet/?id=<?php the_ID(); ?>">Sửa bài viết</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Không có bài viết nào</p>
        <?php endif; wp_reset_postdata(); wp_pagination($posts_query);  ?>
    </div>
</main>

<?php get_footer(); ?>