<?php get_header();

while(have_posts()) {
    the_post();
?>
       <h2 class="page-heading"><?php the_title(); ?></h2>
            <div id="post-container">
                <section id="blogpost">
                    <div class="card">
                        <div class="card-meta-blogpost">
                            <p>Posted by <?php the_author(); ?> on <?php the_time('F j, Y');?> 
                            <?php if(get_post_type() == 'post') { ?>
                            in <a href="#"><?php echo get_the_category_list(', '); ?></a></p>
                            <?php }?>
                        </div>
                        <div class="card-image">
                            <img src="<?php echo get_the_post_thumbnail_url(get_the_ID());?>" alt="Card Image">
                        </div>
                        <div class="card-description">
                            <h3>The Introduction</h3>
                          <?php the_content();?>
                        </div>
                    </div>
                    <div id="comments-section">
                        <?php 
                        $fields =  array(

                        'author' =>
                            '<input placeholder="Name" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
                            '" size="30"' . $aria_req . ' />',

                        'email' =>
                            '<input placeholder="E-mail" id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
                            '" size="30"' . $aria_req . ' />',
                        );
                                                
                        $args = array(
                        'title_reply' => 'Share Your Thoughts',
                        'fields' => $fields,
                        'comment_field' => '<textarea placeholder="Your Comment" id="comment" name="comment" cols="45" rows="8" aria-required="true">' .
                            '</textarea>',
                        'comment_notes_before' => '<p class="comment-notes">' . __( 'Your email address will not be published. All fields are required.' ) . ( $req ? $required_text : '' ) .
                         '</p>',
                        );

                        comment_form($args);
                        
                        $comments_number = get_comments_number();
                        if($comments_number != 0) {
                        ?>
                    
                        <div class="comments">
                            <h3>What others say</h3>
                            <ol class="all-comments">
                                <?php
                                $comments = get_comments(array(
                                    'post_id' => $post->ID,
                                    'status' => 'approve'
                                ));
                                wp_list_comments(array(
                                    'per_page' => 15
                                ), $comments);
                                ?>
                            </ol>
                        </div>
                        <?php } ?>
                    </div>
                </section>
<?php } ?>
                <aside id="sidebar">
                    <?php dynamic_sidebar('main_sidebar');?>
                </aside>

            </div>

  <?php get_footer();?>