<?php 

new ACF_Class;
class ACF_Class {

    function __construct() {
        /* Add the WordPress actions to register ACF pages */
        add_action( 'acf/init', array( $this, 'add_options_pages' ) );
        /* Add a category to the Gutenberg editor for our custom blocks to appear under */
        add_filter( 'block_categories', array( $this, 'gutenberg_custom_block_categories' ), 10, 2 );
        /* Programmatically load all Gutenberg block field groups from the blocks folders */
        add_action( 'acf/init', array( $this, 'load_gutenberg_groups' ) );
        /* And then load all render templates for where the blocks are used */
        add_action( 'acf/init', array( $this, 'load_gutenberg_blocks' ) );
        /* Function to allow JSON files to be loaded for fixed Classic Editor templates and options pages, e.g. Global content */
        add_action( 'acf/init', array( $this, 'load_json_groups' ) );
    }

    
    function add_options_pages() {

        acf_add_options_page(array(
            'page_title' 	=> 'Global Content',
            'menu_title'	=> 'Global Content',
            'menu_slug' 	=> 'theme-general-settings',
            'capability'	=> 'edit_posts',
            'icon_url'      => 'dashicons-admin-site',
            'position'      => 10
        ));

        acf_add_options_sub_page( array(
            'page_title'    => 'Edit Global Content',
            'parent_slug'	=> 'theme-general-settings',
            'capability'    => 'manage_options',
        ) );
    }

    function gutenberg_custom_block_categories( $categories, $post ) {

        // Return the new array, with the original categories merged with our new
        return array_merge( $categories, array(
            array(
                'slug'  => 'blogs',
                'title' => __( 'Blogs', 'translation' ),
            ),
            array(
                'slug'  => 'forms',
                'title' => __( 'Forms', 'translation' ),
            ),
            array(
                'slug'  => 'headings',
                'title' => __( 'Headings', 'translation' ),
            ),
            array(
                'slug'  => 'heros',
                'title' => __( 'Homepage Heros', 'translation' ),
            ),
            array(
                'slug'  => 'content',
                'title' => __( 'Content Blocks', 'translation' ),
            ),
        ));
    }

    function load_gutenberg_groups() {

        // Set the path of the initial directory we want to loop over
        $fields_path = get_template_directory() . "/" . "blocks/";

        // Create a recursive iterator over the iterator, that is, loop through the top level folders,
        // and for each folder found, then loop through any child folders
        $folders = new RecursiveIteratorIterator( new RecursiveDirectoryIterator( $fields_path ) );

        // For each folder (subfolder) foundtempla
        foreach ( $folders as $file ) {

            // If this is a file and not another folder, which includes . (current dir) and .. (parent dir) paths, proceed
            if ( ! $file->isDir() && $file->isFile() ) {

                //If the file is JSON, assume this is a field file
                if ( 'json' === $file->getExtension() ) {

                    // Get the files contents and decode them (true means load as array)
                    $array = json_decode( file_get_contents( $file->getPathname() ), true );

                    // Register this field group
                    register_field_group( $array );


                }

            }
        }

    }

    function load_gutenberg_blocks() {

        // Set the folder we want to loop through each file of - our render folder
        $fields_path = get_template_directory() . "/" . "blocks/";
        // Create a new directory iterator to Programmatically loop through
        $folders = new RecursiveIteratorIterator( new RecursiveDirectoryIterator( $fields_path ) );

        // For each file found, proceed
        foreach ( $folders as $file ) {

            // Just to be safe, check this isn't another folder
            if ( ! $file->isDir() && $file->isFile() ) {

                // If it's a PHP file, assume that it's our render file
                if ( 'php' === $file->getExtension() ) {

                    // Include the render file to call the contents of the file
                    include_once $fields_path . $file->getBasename('.php') . '/' . $file->getBasename();
                }

            }
        }
    }

    function load_json_groups() {
        
        // Setup directory iterator for field groups
        $dir = new DirectoryIterator( get_template_directory() . '/' . 'acf-fields/' );

        // Loop over all the files in the directory
        foreach ( $dir as $file ) {
            // If the file is hidden/system or not a json file
            if ( $file->isDot() || 'json' != $file->getExtension() ) {
                continue; // Skip it
            }

            // Get the files contents and decode them (true means load as array)
            $array = json_decode( file_get_contents( $file->getPathname() ), true );
            // Register this field group
            register_field_group( $array );
        }
    }
}