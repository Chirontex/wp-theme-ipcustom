                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <br>
                    <h2><?php the_title(); ?></h2>
                    <p class="text-about">
                        <?php esc_html_e('Author', 'ipcustom') ?>: <?php the_author_posts_link(); ?><br>
                        <?php esc_html_e('Categories', 'ipcustom') ?>: <?php the_category(', ') ?><br>
                        <?php the_time('d.m.Y') ?>
                    </p>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <?php the_post_thumbnail('post-thumbnail', ['id' => 'post-thumbnail-single']); ?>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <p><?php the_content(); ?></p>
                        </div>
                    </div>
                </div>