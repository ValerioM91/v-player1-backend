<?php
if ( function_exists( 'acf_register_block_type' ) ) {

    acf_register_block_type( array(
        'name'			       	=> 'final-comment-1',
        'title'			      	=> __( 'Final Comment'  ),
        'description'	    	=> __( 'A block used to display a final comment.' ),
        'align'                 => 'full',
        'category'		    	=> 'content',
        'icon'			      	=> 'admin-comments',
        'keywords'	    		=> array( 'final', 'comment' ),
        'mode'	                => 'edit',
        'supports'              => array('mode' => false),
        'render_callback'       => 'vp1_final_comment',
        'data'                  => placeholder_content(
            array(
                'heading' => __( 'Final Comment', 'translation' )
            )
        ),
        'example'  => array(
            'attributes' => array(
                'mode' => 'preview',
                'data' => array(
                    'preview_image_help' => get_template_directory_uri() . '/blocks/final-comment-1/final-comment-1.jpg',
                )
            )
        )
    ));
}

function vp1_final_comment( $block ) {

    if( isset( $block['data']['preview_image_help'] )  ) :    /* rendering in inserter preview  */

        echo '<img src="' . $block['data']['preview_image_help'] .'" style="width:100%; height:auto;">';

    endif;
}
?>
