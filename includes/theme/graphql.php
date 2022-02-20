<?php 

new GraphQL_Class;
class GraphQL_Class {

    function __construct() {
        add_action( 'graphql_register_types', array( $this, 'register_types' ) );
    }
    
    function register_types() {

        register_graphql_object_type( 'logos', [
                'fields' => [
                    'logo'               => [ 'type' => 'String', ],
                    'logoBlue'           => [ 'type' => 'String', ],
                ],
            ]
        );

        register_graphql_object_type( 'socials', [
                'fields' => [
                    'psn'           => [ 'type' => 'String', ],
                    'steam'         => [ 'type' => 'String', ],
                    'facebook'      => [ 'type' => 'String', ],
                    'instagram'     => [ 'type' => 'String', ]
                ],
            ]
        );

        register_graphql_object_type( 'contacts', [
                'fields' => [
                    'contactPhone'     => [ 'type' => 'String', ],
                    'contactEmail'     => [ 'type' => 'String', ],
                    'contactAddress'   => [ 'type' => 'String', ],
                    'contactPostcode'  => [ 'type' => 'String', ]
                ],
            ]
        );

        register_graphql_object_type(
            'Global',
            [
                'description' => __( 'Global Fields', 'bsr' ),
                'fields'      => [
                    'logos'         => [ 'type' => 'logos', ],
                    'socials'       => [ 'type' => 'socials', ],
                    'contactDetails'  => [ 'type' => 'contacts', ],
                ],
            ]
        );

        register_graphql_field(
            'RootQuery',
            'globals',
            [
                'type'        => 'Global',
                'resolve'     => function() {
                    return [
                        'logos' => [
                            'logo'              => get_theme_mod( 'site-logo' ),
                            'logoBlue'          => get_theme_mod( 'blue-logo' )
                        ],
                        'socials' => [
                            'psn'               => get_theme_mod( 'social-psn' ),
                            'steam'             => get_theme_mod( 'social-steam' ),
                            'facebook'          => get_theme_mod( 'social-facebook' ),
                            'instagram'         => get_theme_mod( 'social-instagram' )
                        ],
                        'contactDetails' => [
                            'contactPhone'      => get_theme_mod( 'contact-phone' ),
                            'contactEmail'      => get_theme_mod( 'contact-email' ),
                            'contactAddress'    => get_theme_mod( 'contact-address' ),
                            'contactPostcode'   => get_theme_mod( 'contact-postcode' )
                        ],
                    ];
                }
            ]
        );
    }
}