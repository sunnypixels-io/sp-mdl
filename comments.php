<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Material_Design_Lite
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required() ||
    !get_theme_mod('comments_enabled', true) ||
    (!get_theme_mod('comments_enabled_4_pages', true) && is_page())) {
    return;
}
?>


<div id="comments" class="mdl-card__supporting-text comments mdl-cell mdl-cell--12-col mdl-comments">

    <?php // You can start editing here -- including this comment! ?>

    <?php if (have_comments()) : ?>
        <h4 class="comments-title">
            <?php
            printf(_nx('One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'material-design-lite'),
                number_format_i18n(get_comments_number()), '<span>' . get_the_title() . '</span>');
            ?>
        </h4>

        <ol class="comment-list">
            <?php
            wp_list_comments(array(
                'callback' => 'sp_mdl_comment',
                'style' => 'ol',
                'short_ping' => true,
                'format'    => 'html5',
                'avatar_size' => '48'
            ));
            ?>
        </ol><!-- .comment-list -->

        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : // are there comments to navigate through ?>
            <nav id="comment-nav-below" class="comment-navigation" role="navigation">
                <div class="nav-previous"><?php previous_comments_link(__('&larr; Older Comments', 'material-design-lite')); ?></div>
                <div class="nav-next"><?php next_comments_link(__('Newer Comments &rarr;', 'material-design-lite')); ?></div>
            </nav><!-- #comment-nav-below -->
        <?php endif; // check for comment navigation ?>

    <?php endif; // have_comments() ?>

    <?php
    // If comments are closed and there are comments, let's leave a little note, shall we?
    if (!comments_open() && '0' != get_comments_number() && post_type_supports(get_post_type(), 'comments')) :
        ?>
        <p class="no-comments"><?php _e('Comments are closed.', 'material-design-lite'); ?></p>
    <?php endif; ?>



    <?php
    $req = get_option('require_name_email');
    $aria_req = ($req ? " aria-required='true' data-required=''" : '');
    $req_optional = $req ? '' : ' ' . __('(optional)', 'material-design-lite');
    $comment_field_label = '0' != get_comments_number() ? __('Join the discussion', 'material-design-lite') : __('Start the discussion', 'material-design-lite');

    $comments_args = array(
        // change the title of send button
        'label_submit' => __('Submit', 'material-design-lite'),
        'class_submit' => 'submit mdl-button mdl-js-button mdl-button--primary mdl-js-ripple-effect sp-mdl-submit',
        'submit_field' => '<div class="mdl-cell mdl-cell--12-col"><p class="form-submit">%1$s %2$s</p></div>',
        // change the title of the reply section
        'title_reply' => '',

        'comment_notes_before' => '',
        'comment_notes_after'  => '',
        'title_reply_before'   => '<div class="mdl-grid pvn"><div class="mdl-cell mdl-cell--12-col mvn">',
        'title_reply_after'    => '</div></div>',
        'cancel_reply_before'  => '',
        'cancel_reply_after'   => '',

        'class_form' => 'comment-form mdl-grid',

        // redefine your own textarea (the comment body)
        'comment_field' => '<div class="mdl-cell mdl-cell--12-col mvn"><div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">' .
            '<textarea class="mdl-textfield__input js-sp-mdl-comment-textearea" rows="1" data-autoresize id="comment" name="comment" aria-required="true"></textarea>' .
            '<label class="mdl-textfield__label" for="comment">' . $comment_field_label . '</label></div></div>',

        'fields' => apply_filters('comment_form_default_fields', array(
            'author' =>
                '<div class="mdl-cell mdl-cell--12-col mdl-cell--6-col-desktop sp-mdl-comment-fields js-sp-mdl-comment-fields mvn"><div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">' .
                '<input class="mdl-textfield__input" id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) .
                '" size="30"' . $aria_req . ' /><label class="mdl-textfield__label" for="author">' . __('Name', 'material-design-lite') . $req_optional . '</label></div></div>',
            'email' =>
                '<div class="mdl-cell mdl-cell--12-col mdl-cell--6-col-desktop sp-mdl-comment-fields js-sp-mdl-comment-fields mvn"><div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">' .
                '<input class="mdl-textfield__input" id="email" name="email" type="text" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}" value="' . esc_attr($commenter['comment_author_email']) .
                '" size="30"' . $aria_req . ' /><label class="mdl-textfield__label" for="email">' . __('Email', 'material-design-lite') . $req_optional . '</label>' .
                '<span class="mdl-textfield__note"><span id="email-notes"></span>' . __( 'Note: Your email address will not be published.', 'material-design-lite' ) .
                '</span></div></div>',
            'url' =>
                '<div class="mdl-cell mdl-cell--12-col sp-mdl-comment-fields js-sp-mdl-comment-fields mvn"><div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">' .
                '<input class="mdl-textfield__input" id="url" name="url" type="text" value="' . esc_attr($commenter['comment_author_url']) .
                '" size="30" /><label class="mdl-textfield__label" for="website">' . __('Website (optional)', 'material-design-lite') . '</label></div></div>'
        ) ),
    );

    if ( has_action( 'set_comment_cookies', 'wp_set_comment_cookies' ) && get_option( 'show_comments_cookies_opt_in' ) ) {
        $consent           = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';
        $comments_args['fields']['cookies'] = '<div class="mdl-cell mdl-cell--12-col sp-mdl-comment-fields js-sp-mdl-comment-fields mvn"><p class="comment-form-cookies-consent">' .
            '<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="wp-comment-cookies-consent">' .
            '<input id="wp-comment-cookies-consent" class="mdl-checkbox__input" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' />' .
            '<span class="mdl-checkbox__label">' . __( 'Save my name, email, and website in this browser for the next time I comment.', 'material-design-lite') .
            '</span></label></p></div>';
    }

    comment_form($comments_args); ?>

</div><!-- #comments -->
