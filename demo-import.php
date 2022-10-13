<?php
function ocdi_import_files()
{
    return array(
        array(
            'import_file_name'             => __('Halim Content', 'halim'),
            // 'categories'                   => array('Category 1', 'Category 2'),
            'local_import_file'            => trailingslashit(get_template_directory()) . 'demo-data/halim-content.xml',
            'local_import_widget_file'     => trailingslashit(get_template_directory()) . 'demo-data/halim-widgets.wie',
            // 'local_import_customizer_file' => trailingslashit(get_template_directory()) . 'ocdi/customizer.dat',
            'local_import_redux'           => array(
                array(
                    'file_path'   => trailingslashit(get_template_directory()) . 'demo-data/redux-demo-data.json',
                    'option_name' => 'redux_demo',
                ),
            ),
            'import_preview_image_url'     => 'https://cdn.pixabay.com/photo/2022/08/28/10/29/butterfly-7416290_960_720.jpg',
            'import_notice'                => __('After you import this demo, you will have to setup the slider separately.', 'your-textdomain'),
            'preview_url'                  => 'http://www.your_domain.com/my-demo-1',
        ),

    );
}
add_filter('ocdi/import_files', 'ocdi_import_files');

function ocdi_after_import_setup()
{
    // Assign menus to their locations.
    $main_menu = get_term_by('name', 'Main Menu', 'nav_menu');

    set_theme_mod(
        'nav_menu_locations',
        array(
            'main-menu' => $main_menu->term_id, // replace 'main-menu' here with the menu location identifier from register_nav_menu() function
        )
    );

    // Assign front page and posts page (blog page).
    $front_page_id = get_page_by_title('Home');
    $blog_page_id  = get_page_by_title('Blog');

    update_option('show_on_front', 'page');
    update_option('page_on_front', $front_page_id->ID);
    update_option('page_for_posts', $blog_page_id->ID);
}
add_action('ocdi/after_import', 'ocdi_after_import_setup');
