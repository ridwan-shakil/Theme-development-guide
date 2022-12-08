<?php
// My custom comments output html
function better_comments($comment, $args, $depth)
{

    // Get correct tag used for the comments
    if ('div' === $args['style']) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    } ?>

    <<?php echo $tag; ?> <?php comment_class(empty($args['has_children']) ? '' : 'parent'); ?> id="comment-<?php comment_ID() ?>">

        <?php
        // Switch between different comment types
        switch ($comment->comment_type):
            case 'pingback':
            case 'trackback': ?>
                <div class="pingback-entry"><span class="pingback-heading"><?php esc_html_e('Pingback:', 'textdomain'); ?></span> <?php comment_author_link(); ?></div>
                <?php
                break;
            default:

                if ('div' != $args['style']) { ?>
                    <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
                    <?php } ?>
                    <div class="comment-author vcard">
                        <?php
                        // Display avatar unless size is set to 0
                        if ($args['avatar_size'] != 0) {
                            $avatar_size = !empty($args['avatar_size']) ? $args['avatar_size'] : 70; // set default avatar size
                            echo get_avatar($comment, $avatar_size);
                        }
                        ?>
                    </div><!-- .comment-author -->
                    <div class="comment-details">
                        <div class="comment-meta commentmetadata">

                            <?php
                            // Display author name
                            printf(__('<cite class="fn">%s</cite> <span class="says"></span>', 'textdomain'), get_comment_author_link());
                            ?>


                            <!-- Time  -->
                            <div>
                                <a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)); ?>">
                                    <?php
                                    /* translators: 1: date, 2: time */
                                    printf(
                                        __('%1$s at %2$s', 'textdomain'),
                                        get_comment_date(),
                                        get_comment_time()
                                    ); ?>
                                </a><?php
                                    edit_comment_link(__('(Edit)', 'textdomain'), '  ', ''); ?>
                            </div>
                        </div><!-- .comment-meta -->
                        <div class="comment-text"><?php comment_text(); ?></div><!-- .comment-text -->
                        <?php
                        // Display comment moderation text
                        if ($comment->comment_approved == '0') { ?>
                            <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'textdomain'); ?></em><br />
                        <?php  } ?>
                        <div class="reply ">
                            <?php
                            // Display comment reply link
                            comment_reply_link(array_merge($args, array(
                                'add_below' => $add_below,
                                'depth'     => $depth,
                                'max_depth' => $args['max_depth']
                            ))); ?>
                        </div>
                    </div><!-- .comment-details -->
                    <?php
                    if ('div' != $args['style']) { ?>
                    </div>
    <?php }
                    // IMPORTANT: Note that we do NOT close the opening tag, WordPress does this for us
                    break;
            endswitch; // End comment_type check.
        }
