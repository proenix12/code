<?php

//Load css and js scripts
function load_css_and_javascript () {
    //load css files
    wp_enqueue_style( 'goliveuk', get_template_directory_uri() . '/assets/css/style.css' );
    //add font fontawesome
    //wp_enqueue_style( 'fontawesome', 'https://use.fontawesome.com/releases/v5.3.1/css/all.css' );
    //Compiled materialize minified CSS
    //wp_enqueue_style( 'materializecss', 'https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize
    //.min.css' );

    //load javascript files
    wp_enqueue_script( 'jquery' );
    // Compiled materialize minified JavaScript
    // wp_enqueue_scripts( 'materializejs', 'https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js' );
    wp_enqueue_script( 'goliveukjs', get_template_directory_uri() . '/assets/js/functions.js' );
    wp_enqueue_script( 'custom-ajax-request', get_template_directory_uri() . '/assets/js/ajax.js');
    wp_enqueue_script('tiny_mce');
    wp_localize_script( 'custom-ajax-request', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
}

add_action( 'wp_enqueue_scripts', 'load_css_and_javascript' );


function your_function() {
    wp_enqueue_script( 'prism', get_template_directory_uri() . '/assets/js/prism.min.js' );
}
add_action( 'wp_footer', 'your_function' );

// register navigation menu
function register_my_menus () {
    register_nav_menus(
        array(
            'header-menu' => __( 'Header Menu' ),
            'footer-menu'  => __( 'Footer Menu' ),
            'fallback_cb' => false,
        )
    );
}

add_action( 'init', 'register_my_menus' );

//thumbnails
if ( function_exists( 'add_theme_support' ) ) {
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 360, 270, true ); // default Post Thumbnail dimensions (cropped)

    // additional image sizes
    // delete the next line if you do not need additional image sizes
    add_image_size( 'category-thumb', 360, 9999 ); //300 pixels wide (and unlimited height)
}


//Option Page
//if( function_exists('acf_add_options_page') ) {
//    acf_add_options_page(array(
//        'page_title' => 'Theme Header Settings',
//        'menu_title' => 'Header Settings',
//        'menu_slug' => 'theme-header-settings',
//        'capability' => 'edit_posts',
//        'redirect' => false
//    ));
//}


// Register Custom Post Type
/**
 * Register a book post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
add_action( 'init', 'project' );
function project() {
    $labels = array(
        'name'               => _x( 'New Project', 'post type general name', 'your-plugin-textdomain' ),
        'singular_name'      => _x( 'Project', 'post type singular name', 'your-plugin-textdomain' ),
        'menu_name'          => _x( 'Project', 'admin menu', 'your-plugin-textdomain' ),
        'name_admin_bar'     => _x( 'Project', 'add new on admin bar', 'your-plugin-textdomain' ),
        'add_new'            => _x( 'Add New', 'book', 'your-plugin-textdomain' ),
        'add_new_item'       => __( 'Add New Project', 'your-plugin-textdomain' ),
        'new_item'           => __( 'New Project', 'your-plugin-textdomain' ),
        'edit_item'          => __( 'Edit Project', 'your-plugin-textdomain' ),
        'view_item'          => __( 'View Project', 'your-plugin-textdomain' ),
        'all_items'          => __( 'All Project', 'your-plugin-textdomain' ),
        'search_items'       => __( 'Search Project', 'your-plugin-textdomain' ),
        'parent_item_colon'  => __( 'Parent Project:', 'your-plugin-textdomain' ),
        'not_found'          => __( 'No books found.', 'your-plugin-textdomain' ),
        'not_found_in_trash' => __( 'No books found in Trash.', 'your-plugin-textdomain' )
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __( 'Description.', 'your-plugin-textdomain' ),
        'public'             => true,
        'publicly_queryable' => true,
        'taxonomies'          => array( 'category', 'Project' ),
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'project' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
    );

    register_post_type( 'Project', $args );
}

//validation function
function filterContactData($data = '') {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


function wpdocs_excerpt_more( $more ) {
    return '<a href="'.get_the_permalink().'" class="read-more">...Read More</a>';
}
add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );

function css($atts = [], $content = null, $tag = ''){
    $atts = shortcode_atts( array(), $atts, 'css' );
  return '<pre><code class="language-css line-numbers">'.$content.'</code></pre>';
}
add_shortcode( 'styles', 'css' ); //[styles][/styles]

function javascript($atts = [], $content = null, $tag = ''){
    $atts = shortcode_atts( array(), $atts, 'javascript' );
    return '<pre><code class="language-javascript line-numbers">'.$content.'</code></pre>';
}
add_shortcode( 'javascript', 'javascript' ); //[javascript][/javascript]

function php($atts = [], $content = null, $tag = ''){
    $atts = shortcode_atts( array(), $atts, 'php' );
    return '<pre><code class="language-php line-numbers">'.$content.'</code></pre>';
}
add_shortcode( 'php', 'php' ); //[php][/php]


function shortcode_button_script()
{
    if(wp_script_is("quicktags"))
    {
        ?>
        <script type="text/javascript">

            //this function is used to retrieve the selected text from the text editor
            function getSel()
            {
                var txtarea = document.getElementById("content");
                var start = txtarea.selectionStart;
                var finish = txtarea.selectionEnd;
                return txtarea.value.substring(start, finish);
            }

            QTags.addButton(
                "code_shortcode",
                "Code",
                callback
            );

            function callback()
            {
                var selected_text = getSel();
                QTags.insertContent("[styles]" +  selected_text + "[/styles]");
            }
        </script>
        <?php
    }
}

add_action("admin_print_footer_scripts", "shortcode_button_script");

function default_comments_on( $data ) {
    if( $data['post_type'] == 'Project' ) {
        $data['comment_status'] = 1;
    }

    return $data;
}
add_filter( 'wp_insert_post_data', 'default_comments_on' );
//add_filter( 'comment_text', 'do_shortcode' );
function change_comments_words($comment) {
    $replace = array(

// 'WORD TO REPLACE' => 'REPLACE WORD WITH THIS'

        'woodpecker' => 'css',
        'stupid' => 'smart',
        'link' => '<a href="http://link.com">link</a>'

    );
    $comment = str_replace(array_keys($replace), $replace, $comment);
    return $comment;
}

add_filter( 'pre_comment_content', 'change_comments_words' );

add_filter( 'comment_form_defaults', 'rich_text_comment_form' );
function rich_text_comment_form( $args ) {
    ob_start();
    wp_editor( '', 'comment', array(
        'media_buttons' => true, // show insert/upload button(s) to users with permission
        'textarea_rows' => '10', // re-size text area
        'dfw' => false, // replace the default full screen with DFW (WordPress 3.4+)
        'tinymce' => array(
            'theme_advanced_buttons1' => 'bold,italic,underline,strikethrough,bullist,numlist,code,blockquote,link,unlink,outdent,indent,|,undo,redo,fullscreen',
            'theme_advanced_buttons2' => '', // 2nd row, if needed
            'theme_advanced_buttons3' => '', // 3rd row, if needed
            'theme_advanced_buttons4' => '' // 4th row, if needed
        ),
        'quicktags' => array(
            'buttons' => 'strong,em,link,block,del,ins,img,ul,ol,li,code,close'
        )
    ) );
    $args['comment_field'] = ob_get_clean();
    return $args;
}

add_action( 'wp_enqueue_scripts', '__THEME_PREFIX__scripts' );
function __THEME_PREFIX__scripts() {
    wp_enqueue_script('jquery');
}
add_filter( 'comment_reply_link', '__THEME_PREFIX__comment_reply_link' );
function __THEME_PREFIX__comment_reply_link($link) {
    return str_replace( 'onclick=', 'data-onclick=', $link );
}
add_action( 'wp_head', '__THEME_PREFIX__wp_head' );
function __THEME_PREFIX__wp_head() {
    ?>
    <script type="text/javascript">
        jQuery(function($){
            $('.comment-reply-link').click(function(e){
                e.preventDefault();
                var args = $(this).data('onclick');
                args = args.replace(/.*(|)/gi, '').replace(/"|s+/g, '');
                args = args.split(',');
                tinymce.EditorManager.execCommand('mceRemoveControl', true, 'comment');
                addComment.moveForm.apply( addComment, args );
                tinymce.EditorManager.execCommand('mceAddControl', true, 'comment');
            });
        });
    </script>
    <?php
}
?>