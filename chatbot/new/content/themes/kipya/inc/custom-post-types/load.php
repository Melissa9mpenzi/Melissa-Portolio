<?php
/**
 * Load all custom post type files
 */

// Array of files to include
$cpt_files = array(
    'donations',
    'contact'
);

// Load each file
foreach ($cpt_files as $file) {
    $file_path = get_template_directory() . "/inc/custom-post-types/{$file}.php";
    if (file_exists($file_path)) {
        require_once $file_path;
    }
}