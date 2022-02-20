<?php
if ( function_exists( 'acf_register_block_type' ) ) {

    acf_register_block_type( array(
        'name'			       	=> 'heading-content-1',
        'title'			      	=> __( 'Heading & Content'  ),
        'description'	    	=> __( 'A block used to display a heading and content.' ),
        'align'                 => 'full',
        'category'		    	=> 'content',
        'icon'			      	=> 'heading',
        'keywords'	    		=> array( 'heading', 'content' ),
        'mode'	                => 'edit',
        'supports'              => array('mode' => false),
        'render_callback'       => 'vp1_heading_content_1',
        'data'                  => placeholder_content(
            array(
                'heading' => __( 'Heading & Content', 'translation' )
            )
        ),
        'example'  => array(
            'attributes' => array(
                'mode' => 'preview',
                'data' => array(
                    'preview_image_help' => get_template_directory_uri() . '/blocks/heading-content-1/heading-content-1.jpg',
                )
            )
        )
    ));
}

function vp1_heading_content_1( $block ) {

    if( isset( $block['data']['preview_image_help'] )  ) :    /* rendering in inserter preview  */

        echo '<img src="' . $block['data']['preview_image_help'] .'" style="width:100%; height:100%; object-fit:contain;">';

    endif;
}
?>