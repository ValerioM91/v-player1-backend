<?php
new Customizer;
class Customizer {

    /**
     * Called on class init
     */
    function __construct() {

        /* Add the WordPress actions to register customizer components */
        add_action( 'customize_register', array( $this, 'site_logo' ) );
        add_action( 'customize_register', array( $this, 'contact_details' ) );
        add_action( 'customize_register', array( $this, 'social_links' ) );
    }

    /**
     * Register site logo
     * @return null
     */
    public function site_logo( $customizer ) {
        // Add our setting
        $customizer->add_setting( 'site-logo' );

        // Add control for our logo option
        $customizer->add_control(
            new WP_Customize_Image_Control(
                $customizer, 'site-logo', array(
                    'label'          => __( 'Site Logo', 'translation' ),
                    'description'    => __( 'This is your main logo.', 'translation' ),
                    'section'        => 'title_tagline',
                    'settings'       => 'site-logo',
                )
            )
        );

        // Add our setting
        $customizer->add_setting( 'blue-logo' );

        // Add control for our logo option
        $customizer->add_control(
            new WP_Customize_Image_Control(
                $customizer, 'blue-logo', array(
                    'label'          => __( 'Blue Logo', 'translation' ),
                    'description'    => __( 'This logo is for white/light backgrounds.', 'translation' ),
                    'section'        => 'title_tagline',
                    'settings'       => 'blue-logo',
                )
            )
        );
    }

    /**
     * Register contact details in customizer
     * @return null
     */
    public function contact_details( $customizer ) {
        // Add our customizer section
        $customizer->add_section(
            'contact-details', array(
                'title'      => __( 'Contact Details', 'translation' ),
                'priority'   => 1000,
            )
        );

        // Add our different settings
        $customizer->add_setting( 'contact-phone' );
        $customizer->add_setting( 'contact-email' );
        $customizer->add_setting( 'contact-address' );
        $customizer->add_setting( 'contact-postcode' );

        // Add controls for our settings, within a section
        $customizer->add_control(
            new WP_Customize_Control(
                $customizer, 'contact-phone', array(
                    'label'          => __( 'Telephone Number', 'translation' ),
                    'section'        => 'contact-details',
                    'settings'       => 'contact-phone',
                    'type'           => 'text',
                )
            )
        );

        $customizer->add_control(
            new WP_Customize_Control(
                $customizer, 'contact-email', array(
                    'label'          => __( 'Email Address', 'translation' ),
                    'section'        => 'contact-details',
                    'settings'       => 'contact-email',
                    'type'           => 'email',
                )
            )
        );

        $customizer->add_control(
            new WP_Customize_Control(
                $customizer, 'contact-address', array(
                    'label'          => __( 'Address', 'translation' ),
                    'section'        => 'contact-details',
                    'settings'       => 'contact-address',
                    'type'           => 'textarea',
                )
            )
        );

        $customizer->add_control(
            new WP_Customize_Control(
                $customizer, 'contact-postcode', array(
                    'label'          => __( 'Address Postcode (Used for Maps)', 'translation' ),
                    'section'        => 'contact-details',
                    'settings'       => 'contact-postcode',
                    'type'           => 'text',
                )
            )
        );

        return $customizer;
    }

    /**
     * Register social accounts in customizer
     * @return null
     */
    public function social_links( $customizer ) {
        // Add our customizer section
        $customizer->add_section(
            'social-links', array(
                'title'      => __( 'Social Links', 'translation' ),
                'priority'   => 1100,
            )
        );

        $socials = array(
            'psn'           => 'PlayStation Network',
            'steam'         => 'Steam',
            'facebook'      => 'Facebook',
            'instagram'     => 'Instagram',
        );

        // Loop over all our socials
        foreach ( $socials as $key => $name ) {
            // Add our different settings
            $customizer->add_setting( 'social-' . $key );
            $test = sprintf( __( '%1$s URL', 'translation' ), $name );
            // Add controls for our settings, within a section
            $customizer->add_control(
                new WP_Customize_Control(
                    $customizer, 'social-' . $key, array(
                        'label'          => sprintf( __( '%1$s URL', 'translation' ), $name ),
                        'description'    => sprintf( __( 'Insert the URL (web address) for your %1$s here.', 'translation' ), $key ),
                        'section'        => 'social-links',
                        'settings'       => 'social-' . $key,
                        'type'           => 'url',
                    )
                )
            );
        }

        return $customizer;
    }
}