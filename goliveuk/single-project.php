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
?>
     <?php echo do_shortcode(get_post_field('post_content', $id));?>
<?php comments_template(); ?>

<?php get_footer(); ?>
