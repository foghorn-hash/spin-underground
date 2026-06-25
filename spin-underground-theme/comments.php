<?php
/**
 * The template for displaying comments
 */

if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area">
    <?php
    if ( have_comments() ) :
        ?>
        <h2 class="comments-title">
            <?php
            $comment_count = get_comments_number();
            if ( 1 === $comment_count ) {
                esc_html_e( 'One Response', 'spinunderground' );
            } else {
                printf( 
                    esc_html( _n( '%s Response', '%s Responses', $comment_count, 'spinunderground' ) ),
                    esc_html( number_format_i18n( $comment_count ) )
                );
            }
            ?>
        </h2>

        <ol class="comment-list">
            <?php
            wp_list_comments( array(
                'style'      => 'ol',
                'short_ping' => true,
                'avatar_size' => 40,
                'callback'   => 'spinunderground_comment_callback',
            ) );
            ?>
        </ol>

        <?php
        the_comments_pagination( array(
            'prev_text' => esc_html__( 'Older Comments', 'spinunderground' ),
            'next_text' => esc_html__( 'Newer Comments', 'spinunderground' ),
        ) );
    endif;
    ?>

    <?php
    if ( comments_open() ) :
        ?>
        <div class="comment-respond">
            <?php
            comment_form( array(
                'class_submit' => 'btn',
                'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" placeholder="' . esc_attr__( 'Your comment...', 'spinunderground' ) . '" required></textarea></p>',
                'title_reply'   => esc_html__( 'Leave a Reply', 'spinunderground' ),
            ) );
            ?>
        </div>
    <?php
    else :
        ?>
        <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'spinunderground' ); ?></p>
        <?php
    endif;
    ?>
</div>
