<?php 

new Custom_Post_Types_Class;
class Custom_Post_Types_Class {

    function __construct() {
        add_action( 'init',  array( $this, 'create_posttype' ) );
    }

    function create_posttype() {
        register_post_type( 'reviews',
        // CPT Options
            array(
                'labels' => array(
                    'name' => __( 'Reviews' ),
                    'singular_name' => __( 'Review' )
                ),
                'public' => true,
                'has_archive' => false,
                'rewrite' => array('slug' => 'reviews'),
                'show_in_rest' => true,
                'show_in_graphql' => true,
                'graphql_single_name' => 'review',
                'graphql_plural_name' => 'reviews',
                'supports' => array( 
                    'title', 
                    'editor', 
                    'excerpt', 
                    'thumbnail', 
                    'custom-fields', 
                    'revisions' 
                )
            )
        );
    }
}