<?php
if ( function_exists( 'acf_register_block_type' ) ) {

    acf_register_block_type( array(
        'name'			       	=> 'reviews-001',
        'title'			      	=> __( 'Reviews'  ),
        'description'	    	=> __( 'A block used to display the reviews' ),
        'align'                 => 'full',
        'category'		    	=> 'content',
        'icon'			      	=> 'welcome-learn-more',
        'keywords'	    		=> array( 'reviews' ),
        'mode'	                => 'edit',
        'supports'              => array('mode' => false),
    )
    );
}

?>
