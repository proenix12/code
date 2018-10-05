<?php
/**
 * Created by PhpStorm.
 * Date: 10/4/2018
 * Time: 10:37 AM
 * Template Name: Homepage
 *
 * @package WordPress
 * @subpackage Name
 * @since Twenty Fourteen 1.0
 */
get_header();

?>
    <div class = "wrap">
        <?php
        $args = array(
            'post_type'   => 'Project',
            'post_status' => 'publish'
        );?>
        <div class="post">
            <div class="post_header clearfix">
                <div class="post_topic">Topic</div>
                <div class="post_category">Category</div>
                <div class="post_users">Users</div>
                <div class="post_replies">Replies</div>
                <div class="post_views">Views</div>
                <div class="post_activity">Activity</div>
            </div>
            <div class = "post_body">
                <?php

                $testimonials = new WP_Query( $args );
                if ( $testimonials->have_posts() ) {
                    while ( $testimonials->have_posts() ) {
                        $testimonials->the_post();
                        $user_id = get_the_author_id();
                        $user_name = get_the_author_meta($field ='display_name', $user_id = false);
                        ?>

                        <div class="post_header clearfix">
                            <div class="post_topic"><h3><a href="<?php echo get_post_permalink();
                                    ?>"><?php the_title(); ?></a></h3></div>
                            <div class="post_category"><?php
                                $terms = get_terms('category');
                                $count = count($terms);
                                foreach ($terms as $term){
                                    echo '<a href="'.esc_url( get_term_link($term) ).'?category='.$term->slug.'">'
                                         .$term->slug
                                         .'</a>';
                                }
                                ?></div>
                            <div class="post_users"><?php echo $user_name; ?></div>
                            <div class="post_replies">Replies</div>
                            <div class="post_views"><?php echo getPostViews(get_the_ID()); ?></div>
                            <div class="post_activity"><?php the_modified_time("D-m-y"); ?></div>
                        </div>

                        <?php
//echo get_permalink();
//echo get_the_title();
                        //the_content();
//        //the_excerpt();
//        echo get_post_permalink();
                        //echo do_shortcode('[styles][/styles]');
                    }
                    wp_reset_postdata();
                } ?>
            </div>
        </div>
    </div>
<?php

//load footer section
get_footer();