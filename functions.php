<?php

/**
 * Load the master include file
 */
require_once trailingslashit( get_template_directory() ) . 'includes/init.php';

/**
 * Init hook for registering of post types etc
 */
new ThemeFunctions;
class ThemeFunctions {

    function __construct() {

        // Menu hooks
        add_action( 'init', array( $this, 'register_menus' ) );

        // Theme support hook
        add_action( 'init', array( $this, 'theme_support' ) );

        // Remove standard WordPress blocks from Gutenberg
        add_filter( 'allowed_block_types_all', array( $this, 'remove_default_blocks' ) );
    }

    /**
     * Hook to register navigation menu positions
     * @return null
     */
    public function register_menus() {
        // Register the nav menus
        register_nav_menus(
            array(
                'main-nav'        => __( 'Main Header Navigation' ),
                'mobile-nav'      => __( 'Mobile Header Navigation' ),
            )
        );
    }

    /**
     * Hook to add varying theme support
     * @return null
     */
    public function theme_support() {
        // Add post thumbnail support to post types as required
        add_theme_support( 'post-thumbnails', array( 'post' ) );
        // HTML5 Support
        add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
        // WordPress 4.4 Title Support
        add_theme_support( 'title-tag' );
        // Allow the wide/full width alignment option for blocks within Gutenberg
        add_theme_support( 'align-wide' );
    }

    /**
     * Remove all core blocks from the Gutenberg editor view
     * @param array $allowed_blocks The array of all blocks
     * @return array $filtered_blocks The filtered list of blocks to show in the CMS
     */
    public function remove_default_blocks( $allowed_blocks ) {

        // Get all registered Gutenberg blocks to filter through
        $registered_blocks = WP_Block_Type_Registry::get_instance()->get_all_registered();

        // This array will hold the blocks we want to keep/display
        $filtered_blocks = array();

        // Loop through each block
        foreach ( $registered_blocks as $block ) {

            // If the pattern does not match core/ (the default WordPress blocks)
            if ( strpos( $block->name , 'core/' ) === false ) {

                // Add this to the array of acceptable blocks
                array_push( $filtered_blocks, $block->name  );
            }
        }

        // Return the accepted blocks to display in the CMS!
        return $filtered_blocks;
    }
}


/**
 * Enable svg upload
 */
function add_file_types_to_uploads($file_types){
	$new_filetypes = array();
	$new_filetypes['svg'] = 'image/svg+xml';
	$file_types = array_merge($file_types, $new_filetypes );
    return $file_types;
}
add_filter('upload_mimes', 'add_file_types_to_uploads');