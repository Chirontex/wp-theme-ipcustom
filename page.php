<?php get_header(); ?>

            <main role="main" class="inner cover" id="main_block">
<?php

if (have_posts()) {

    $posts_counter = 0;

    while (have_posts()) {

        the_post();

        get_template_part('parts/content', 'page');

        if (comments_open() || get_comments_number()) comments_template();

    }

} else {?>
                <p class="lead"><?php esc_html_e('No posts', 'ipcustom') ?>.</p>
<?php }

the_posts_pagination([
    'show_all' => false,
    'end_size' => 1,
    'mid_size' => 1,
    'prev_next' => true,
    'prev_text' => htmlspecialchars('«').' '.esc_html__('Previous', 'ipcustom'),
    'next_text' => esc_html__('Next', 'ipcustom').' '.htmlspecialchars('»'),
    'add_args' => false,
    'add_fragment' => '',
    'screen_reader_text' => ''
]);

?>
            </main>
            <script type="text/javascript">
            custom_appearance("main_block", 0);
            </script>

<?php get_footer(); ?>