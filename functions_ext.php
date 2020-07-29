<?php

function ipcustom_comments_stylization($comment, $args, $depth)
{

    if ($args['style'] === 'div') {

        $tag = 'div';
        $add_below = 'comment';

    } else {

        $tag = 'li';
        $add_below = 'div-comment';

    } ?>

    <<?= $tag ?> <?php if (empty($args['has_children'])) comment_class();else comment_class('parent'); ?> id="comment-<?php comment_ID(); ?>">
<?php

    if ($tag != 'div') {
        
?>
        <div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
<?php

    }
    
?>
            <br />
            <div class="comment-author vcard">
<?php

    if ($args['avatar_size'] !== 0) echo get_avatar($comment, $args['avatar_size']);

    printf(' <span class="fn">%s</span> |', get_comment_author_link());

?>
                <a href="<?= htmlspecialchars(get_comment_link($comment->comment_ID)); ?>"><?php printf(esc_html__('%1$s at %2$s'), get_comment_date(), get_comment_time()); ?></a> | 
                <?php edit_comment_link(esc_html__('Edit', 'ipcustom'), ' ', ''); ?>
            </div>
            <br />
<?php

    comment_text(); 

    if ($comment->comment_approved == '0') {
        
?>
            <em class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'ipcustom') ?></em><br />
<?php

    }
    
?>
            <div class="reply">
<?php comment_reply_link(array_merge($args, ['add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']])); ?>
            </div>
<?php if ($tag != 'div') { ?></div><?php } ?>
<?php

}
