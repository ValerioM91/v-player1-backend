<?php
if ( function_exists( 'acf_register_block_type' ) ) {

    acf_register_block_type( array(
        'name'			       	=> 'full-image-1',
        'title'			      	=> __( 'Full Image'  ),
        'description'	    	=> __( 'A block used to display an image.' ),
        'align'                 => 'full',
        'category'		    	=> 'content',
        'icon'			      	=> 'format-image',
        'keywords'	    		=> array( 'image', ),
        'mode'              	=> 'edit',
        'supports'              => array('mode' => false),
        'render_callback'       => 'vp1_full_image_1',
        'data'                  => placeholder_content(
            array(
                'heading' => __( 'Full Image', 'translation' )
            )
        ),
        'example'  => array(
            'attributes' => array(
                'mode' => 'preview',
                'data' => array(
                    'preview_image_help' => get_template_directory_uri() . '/blocks/full-image-1/full-image-1.jpg',
                )
            )
        )
    ));
}

function vp1_full_image_1( $block ) {

    if( isset( $block['data']['preview_image_help'] )  ) :    /* rendering in inserter preview  */

        echo '<img src="' . $block['data']['preview_image_help'] .'" style="width:100%; height:auto;">';

    endif;
}
?>
