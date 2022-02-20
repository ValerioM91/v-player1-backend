<?php
$include_dir = trailingslashit( get_template_directory() ) . 'includes/';

include_once $include_dir . 'theme/customizer.php';

// Only load the ACF helper if plugin is active
if ( class_exists( 'acf' ) ) {
    include_once $include_dir . 'theme/acf.php';
}

include_once $include_dir . 'theme/custom-post-types.php';

include_once $include_dir . 'theme/graphql.php';

require_once $include_dir . 'theme/functions.php';