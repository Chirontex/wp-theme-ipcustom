<?php

if (post_password_required()) return; ?>
<div id="comments" class="comments-area">
<?php

if (have_comments()) { ?>

    <h2 class="comments-title"><?php printf(_nx('One comment:', '%1$s comments:', get_comments_number(), 'comments title', 'ipcustom'), number_format_i18n(get_comments_number()), '<span>'.get_the_title().'</span>'); ?></h2>
    <ul class="comment-list">
<?php

    wp_list_comments([
        'style' => 'ul',
        'short_ping' => true,
        'avatar_size' => 37,
        'callback' => 'ipcustom_comments_stylization'
    ]);

?>
    </ul>
<?php

    if (get_comment_pages_count() > 1 && get_option('page_comments')) { ?>
    <nav class="navigation comment-navigation" role="navigation">
        <h1 class="screen-reader-text section-heading"><?php esc_html_e('Comment navigation', 'ipcustom'); ?></h1>
        <div class="nav-previous"><?php previous_comments_link('&amp;larr; '.esc_html__('Older Comments', 'ipcustom')); ?></div>
        <div class="nav-next"><?php next_comments_link(esc_html__('Newer Comments', 'ipcustom').' &amp;rarr;'); ?></div>
    </nav>

<?php

    }

}

comment_form([
    'comment_field' => '<p class="comment-form-comment form-group"><textarea id="comment" name="comment" class="form-control" cols="45" rows="8" aria-required="true" placeholder="'.esc_html__('write your comment here').'"></textarea></p>',
    'submit_button' => '<button type="submit" name="%1$s" id="%2$s" class="%3$s btn btn-dark">%4$s</button>',
    'title_reply' => esc_html__('Speak about it', 'ipcustom'),
    'title_reply_to' => esc_html__('Reply to', 'ipcustom').' %s |',
    'fields' => [
        'author' => '<p class="comment-form-author form-group"><label for="author">'.esc_html__('Name', 'ipcustom').'</label>'.($req ? '<span class="required"> *</span>' : '').'<input id="author" name="author" type="text" class="form-control" placeholder="'.esc_html__('your name', 'ipcustom').'" value="'.esc_attr($commenter['comment_author']).'" size="30"'.$aria_req.' /></p>',
	    'email' => '<p class="comment-form-email form-group"><label for="email">'.esc_html__('E-mail', 'ipcustom').'</label>'.($req ? '<span class="required"> *</span>' : '').'<input id="email" name="email" type="text" class="form-control" placeholder="'.esc_html__('your e-mail', 'ipcustom').'" value="'.esc_attr($commenter['comment_author_email']).'" size="30"'.$aria_req.' /></p>'/*,
	    'url' => '<p class="comment-form-url form-group"><label for="url">'.esc_html__('Website', 'ipcustom').'</label><input id="url" name="url" type="text" class="form-control" placeholder="'.esc_html__('your website', 'ipcustom').'" value="'.esc_attr($commenter['comment_author_url']).'" size="30" /></p>'*/
    ]
]);

?>
</div>