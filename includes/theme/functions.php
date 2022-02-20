<?php

function placeholder_content( $custom_placeholders = array() ) {

    // Define placeholder content for our block Renders, key = ACF field name, value = default value
    $placeholders = array(
        'heading_type'      => 'h2',
        'heading'           => 'This is a Heading',
        'content'           => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
        'button_colour'     => 'primary',
        'link_url'          => '/home/',
        'link_label'        => 'Button',
    );

    // If we have passed any custom placeholders that need to be used instead or in addition to
    if ( $custom_placeholders && is_array( $custom_placeholders ) ) {
        // Merge these into the returned placeholders array
        $placeholders = array_merge( $placeholders, $custom_placeholders );
    }

    // Return this for use within render functions (could return in one go but this is simply easier to read)
    return $placeholders;
}