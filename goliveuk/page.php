<?php
/**
 * Created by PhpStorm.
 * Date: 9/20/2018
 * Time: 2:59 PM
 * @package WordPress
 * @subpackage Ambrowilks
 * @since Twenty Fourteen 1.0
 */

get_header( 'sub' ); ?>

<div class="content">
    <div class="wrap">
        <div id="dnn_ContentPane" class="Pane">
            <div class="DnnModule DnnModule-DNN_HTML DnnModule-444"><a name="444"></a>
                <div class="c_DNN6 c_DNN6_Header">
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
						the_content();
					endwhile;
					else: ?>
                        <p>Sorry, no posts matched.</p>
					<?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>


<?php get_footer(); ?>
