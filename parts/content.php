<?php global $posts_counter; ?>
                <div id="post-<?php the_ID(); ?>" <?php if ($posts_counter > 0) post_class('divider-top');else post_class(); ?>>
                    <br>
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <p class="text-about">
                        <?php esc_html_e('Author', 'ipcustom') ?>: <?php the_author_posts_link(); ?><br>
                        <?php esc_html_e('Categories', 'ipcustom') ?>: <?php the_category(', ') ?><br>
                        <?php the_time('d.m.Y') ?>
                    </p>
                    <div class="row">
<?php

        ob_start();

        the_post_thumbnail([281, 144]);

        $post_thumbnail = ob_get_clean();

        if (empty($post_thumbnail)) {
    
?>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <p><?php the_excerpt(); ?></p>
                        </div>
<?php

        } else {?>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <a href="<?php the_permalink(); ?>"><?php echo $post_thumbnail; ?></a>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <p><?php the_excerpt(); ?></p>
                        </div>
<?php

        }

?>
                    </div>
                    <p>
                        <a href="<?php the_permalink(); ?>" class="text-gray"><?php esc_html_e('Read more', 'ipcustom') ?></a>
                    </p>
                </div>
<?php

        $posts_counter += 1;
