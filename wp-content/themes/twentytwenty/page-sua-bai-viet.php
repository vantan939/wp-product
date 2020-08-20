<?php
if(!isset($_GET['id'])) {
    wp_redirect(home_url('/danh-sach-bai'));
    exit;
}
get_header();
?>

<main id="site-content" role="main">
    <div class="wrap">
        <h2><?php the_title(); ?></h2>
        <?php get_template_part('template-parts/content-post-product'); ?>.
    </div>
</main>

<script>var admin_ajax_url = "<?php echo admin_url('admin-ajax.php');?>";</script>
<?php get_footer(); ?>