<?php
/**
 * Created by PhpStorm.
 * Date: 9/21/2018
 * Time: 5:37 PM
 * Template Name:
 *
 * @package WordPress
 * @subpackage Name
 * @since Twenty Fourteen 1.0
 */
get_header();
$the_post = get_post();
$id = get_the_ID();
setPostViews(get_the_ID());
?>
<div class="wrap">
    <div class="topics">
        <div class="topics__heading">
            <h2 class="topics__heading-title"><?php  echo $the_post->post_title; ?></h2>
        </div>
        <div class="topic_style">
        <?php echo do_shortcode(get_post_field('post_content', $id));?>

        </div>
     <?php comments_template('/template-parts/batter-comments.php'); ?>
    </div>
</div>

<?php get_footer(); ?>
