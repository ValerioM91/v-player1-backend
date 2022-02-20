<?php
if ( function_exists( 'acf_register_block_type' ) ) {

    acf_register_block_type( array(
        'name'			       	=> 'hero-image-001',
        'title'			      	=> __( 'Homepage Hero'  ),
        'description'	    	=> __( '' ),
        'align'                 => 'full',
        'category'		    	=> 'heros',
        'icon'			      	=> 'desktop',
        'keywords'	    		=> array( 'hero', 'image', 'breadcrumbs' ),
        'mode'	                => 'edit',
        'supports'              => array('mode' => false),
        'render_callback'       => 'vp1_hero_image_001',
        'data'                  => placeholder_content(
            array(
                'heading' => __( 'Homepage Hero', 'translation' )
            )
        ),
        'example'  => array(
            'attributes' => array(
                'mode' => 'preview',
                'data' => array(
                    'preview_image_help' => get_template_directory_uri() . '/blocks/hero-image-001/hero-image-001.jpg',
                )
            )
        )
    ));
}

function vp1_hero_image_001( $block ) {

    if( isset( $block['data']['preview_image_help'] )  ) :    /* rendering in inserter preview  */

        echo '<img src="' . $block['data']['preview_image_help'] .'" style="width:100%; height:100%; object-fit:contain;">';

    endif;
}
?>