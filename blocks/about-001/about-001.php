<?php
if ( function_exists( 'acf_register_block_type' ) ) {

    acf_register_block_type( array(
        'name'			       	=> 'about-001',
        'title'			      	=> __( 'About Me' ),
        'description'	    	=> __( 'A block used to display a heading, subheading, breadcrumbs and a background image, with optional buttons.' ),
        'align'                 => 'full',
        'category'		    	=> 'content',
        'icon'			      	=> 'admin-users',
        'keywords'	    		=> array( 'about', 'content' ),
        'mode'              	=> 'edit',
        'supports'              => array('mode' => false),
        'render_callback'       => 'vp1_about_001',
        'data'                  => placeholder_content(
            array(
                'heading' => __( 'About Me', 'translation' )
            )
        ),
        'example'  => array(
            'attributes' => array(
                'mode' => 'preview',
                'data' => array(
                    'preview_image_help' => get_template_directory_uri() . '/blocks/about-001/about-001.jpg',
                )
            )
        )
    ));
}

function vp1_about_001( $block ) {

    if( isset( $block['data']['preview_image_help'] )  ) :    /* rendering in inserter preview  */

        echo '<img src="' . $block['data']['preview_image_help'] .'" style="width:100%; height:auto;">';

    endif;
}
?>


