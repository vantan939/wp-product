<?php 
get_header();
$args_posts = array(
    'post_type'  =>   'post'    
);
$posts_query = new WP_Query( $args_posts );
?>

<main id="site-content" role="main">
    <div class="wrap">
        <h2><?php the_title(); ?></h2>
        <?php if( $posts_query->have_posts() ) : ?>
            <table class="list-post">
                <?php while( $posts_query->have_posts() ) : $posts_query->the_post(); ?>
                    <tr class="post-item">
                        <td width="70%"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td>
                        <td><a target="_blank" href="<?php echo home_url(); ?>/sua-bai-viet/?id=<?php the_ID(); ?>">Sửa bài viết</a></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php endif; wp_reset_postdata(); ?>
    </div>
</main>

<?php get_footer(); ?>