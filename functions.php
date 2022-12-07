<?php
// redux customizer 
require_once(get_template_directory() . '/inc/redux.php');
// widgets 
require_once(get_template_directory() . '/widgets/recent-posts.php');
// install required plugins 
require_once get_template_directory() . '/inc/halim-activation.php';
// demo import 
require_once get_template_directory() . '/inc/demo-import.php';
// ACF demo data import
require_once get_template_directory() . '/inc/halim-acf-data.php';


// =======================================
// Theme setup , Theme support
// =======================================
function  halim_setup_theme()
{
    load_theme_textdomain('halim', get_template_directory_uri() . '/languages');

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails', array('post', 'page', 'book', 'team_member', 'client_review', 'portfolio'));

    register_nav_menus(array(
        'main-menu' => __('Main Menu', 'halim'),

    ));
}
add_action('after_setup_theme', 'halim_setup_theme');

// acf css on header 
function rs_add_acf_css()
{
?>
    <style>
        .header-top {
            background-color: <?php echo get_field('heder_top_background', 'option') ?>;
        }
    </style>
<?php
}
add_action('wp_head', 'rs_add_acf_css');


function halim_scripts()
{
    // css 
    wp_enqueue_style('styleshit', get_stylesheet_uri());
    wp_enqueue_style('fonts-googleapis', 'https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700');
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '4.1.0');
    // wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), '4.6.3');
    wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css');
    wp_enqueue_style('magnific-popup', get_template_directory_uri() . '/assets/css/magnific-popup.css', array());
    wp_enqueue_style('carosel', get_template_directory_uri() . '/assets/css/owl.carousel.css', array());
    wp_enqueue_style('style', get_template_directory_uri() . '/assets/css/style.css', array(), '1.0');
    wp_enqueue_style('responsive', get_template_directory_uri() . '/assets/css/responsive.css', array());
   
	
	// javascripts 
    wp_enqueue_script('jquery', get_template_directory_uri() . '/assets/js/jquery.min.js', array('jquery'), '1.12.4', true);
    wp_enqueue_script('popper', get_template_directory_uri() . '/assets/js/popper.min.js', array('jquery'), '', true);
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '4.1.0', true);
    wp_enqueue_script('carosel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array('jquery'), '', true);
    wp_enqueue_script('magnific', get_template_directory_uri() . '/assets/js/jquery.magnific-popup.min.js', array('jquery'), '1.1.0', true);
    wp_enqueue_script('isotope', get_template_directory_uri() . '/assets/js/isotope.min.js', array('jquery'), '3.0.5', true);
    wp_enqueue_script('imageloaded', get_template_directory_uri() . '/assets/js/imageloaded.min.js', array('jquery'), '4.1.4', true);
    wp_enqueue_script('counterup', get_template_directory_uri() . '/assets/js/jquery.counterup.min.js', array('jquery'), '1.0', true);
    wp_enqueue_script('waypoint', get_template_directory_uri() . '/assets/js/waypoint.min.js', array('jquery'), '4.0.0', true);
    wp_enqueue_script('main', get_template_directory_uri() . '/assets/js/main.js', array(), '', true);
}
add_action('wp_enqueue_scripts', 'halim_scripts');



// =======================================
// Filter the excerpt length to 30 words.
// =======================================
function wp_example_excerpt_length($length)
{
    return 30;
}
add_filter('excerpt_length', 'wp_example_excerpt_length');


//================== ACF Option page (theme) =================
if (function_exists('acf_add_options_page')) {

    acf_add_options_page(array(
        'page_title'     => 'Halim Options', 'halim',
        'menu_title'    => 'Halim Options', 'halim',
        'menu_slug'     => 'halim-options',
        'capability'    => 'edit_posts',
        'redirect'        => false
    ));

    acf_add_options_sub_page(array(
        'page_title'     => 'Halim Header Options',
        'menu_title'    => 'Header',
        'parent_slug'    => 'halim-options',
    ));

    acf_add_options_sub_page(array(
        'page_title'     => 'Halim About Options',
        'menu_title'    => 'About',
        'parent_slug'    => 'halim-options',
    ));
    acf_add_options_sub_page(array(
        'page_title'     => 'Halim Faq & Skill Options',
        'menu_title'    => 'FAQ & Skill',
        'parent_slug'    => 'halim-options',
    ));
    acf_add_options_sub_page(array(
        'page_title'     => 'Halim Contact Options',
        'menu_title'    => 'Contact',
        'parent_slug'    => 'halim-options',
    ));
    acf_add_options_sub_page(array(
        'page_title'     => 'Halim Footer Options',
        'menu_title'    => 'Footer',
        'parent_slug'    => 'halim-options',
    ));
};


//===============================================
// Register sidebar widgets  .
//===============================================
function halim_theme_slug_widgets_init()
{
    // Right sidebar
    register_sidebar(array(
        'name'           => __('Right sidebar', 'textdomain'),
        'id'             => 'right-sidebar',
        'description'    => __('Widgets in this area will be shown on the right side', 'halim'),
        'before_widget'  => '<div class="single-sidebar">',
        'after_widget'   => '</div>',
        'before_title'   => '<h3>',
        'after_title'    => '</h3>',
    ));
    //   sidebar 1 
    register_sidebar(array(
        'name'          => __('Footer 1', 'textdomain'),
        'id'            => 'footer-1',
        'description'   => __('Widgets in this area will be shown on footer left side.', 'textdomain'),
        'before_widget' => '<div class="single-footer footer-logo">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ));
    //   sidebar 2 
    register_sidebar(array(
        'name'          => __('Footer 2', 'textdomain'),
        'id'            => 'footer-2',
        'description'   => __('Widgets in this area will be shown on footer middle.', 'textdomain'),
        'before_widget' => '<div class="single-footer ">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ));
    //   sidebar 3 
    register_sidebar(array(
        'name'          => __('Footer 3', 'textdomain'),
        'id'            => 'footer-3',
        'description'   => __('Widgets in this area will be shown on footer middle.', 'textdomain'),
        'before_widget' => '<div class="single-footer ">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ));
  
}
add_action('widgets_init', 'halim_theme_slug_widgets_init');



// ======================= Comment form rearrange ====================
function move_comment_field($fields)
{

    $comment_field = $fields['comment'];
    unset($fields['comment']);
    $fields['comment'] = $comment_field;

    $comment_field = $fields['cookies'];
    unset($fields['cookies']);
    $fields['cookies'] = $comment_field;
    return $fields;
}
add_filter('comment_form_fields', 'move_comment_field');



// Change default fields, add "placeholder" and change type attributes.===========
function Halim_comment_placeholders($fields)
{
    $fields['author'] = str_replace(
        '<input',
        '<input placeholder="'
            . _x(
                'Your name',
                'halim'
            )
            . '"',
        $fields['author']
    );
    $fields['email'] = str_replace(
        '<input id="email" name="email" type="text"',
        /* We use a proper type attribute to make use of the browser’s
         * validation, and to get the matching keyboard on smartphones.
         */
        '<input type="email" placeholder="Email"  id="email" name="email"',
        $fields['email']
    );
    $fields['url'] = str_replace(
        '<input id="url" name="url" type="text"',
        // Again: a better 'type' attribute value.
        '<input placeholder="Website" id="url" name="url" type="url"',
        $fields['url']
    );
    // =======
    $fields['comment'] = str_replace(
        '<textarea',
        '<textarea placeholder="Comment"',
        $fields['comment_field']
    );

    return $fields;
}
add_filter('comment_form_default_fields', 'Halim_comment_placeholders');



//  add placeholder text to comment field===================
function placeholder_comment_form_field($fields)
{
    $replace_comment = __('Your Comment', 'halim');

    $fields['comment_field'] = '<p class="comment-form-comment"><label for="comment">' . _x('Comment', 'noun') .
        '</label><textarea id="comment" name="comment" cols="45" rows="6" placeholder="' . $replace_comment . '" aria-required="true"></textarea></p>';

    return $fields;
}
add_filter('comment_form_defaults', 'placeholder_comment_form_field', 20);

// Change comment form title =============================
function mycustom_comment_form_title_reply($defaults)
{
    $defaults['title_reply'] = __('Leave a comment');
    return $defaults;
}
add_filter('comment_form_defaults', 'mycustom_comment_form_title_reply');




// remove any feild from comment form ======================
function unset_url_field($fields)
{
    if (isset($fields['url']))
        unset($fields['url']);
    return $fields;
}
add_filter('comment_form_default_fields', 'unset_url_field');

// Custom comments list html markup ======================
https://cutt.ly/uVNYYOp






// =======================================
// acf-json  saves acf data into folder , speeds up ACF and allows for version control
// =======================================
function my_acf_json_save_point($path)
{

    // update path
    $path = get_template_directory() . '/acf-json';


    // return
    return $path;
}

add_filter('acf/settings/save_json', 'my_acf_json_save_point');

// ========================================
// Add social links on author meta box ======================
// ========================================

<?php   // add this code on function.php page
add_filter('user_contactmethods', 'wpse_user_contactmethods', 10, 1);
function wpse_user_contactmethods($contact_methods)
{
	$contact_methods['facebook'] = __('Facebook URL', 'text_domain');
	$contact_methods['twitter']  = __('Twitter URL', 'text_domain');
	$contact_methods['linkedin'] = __('LinkedIn URL', 'text_domain');
	$contact_methods['instagram']  = __('Instagram URL', 'text_domain');
	$contact_methods['vimeo']  = __('Vimeo URL', 'text_domain');

	return $contact_methods;
}

// add this code where you want to gate the social link
<?php echo get_the_author_meta('facebook', $author_id); ?>

// ========================================
// Add extra field into user meta 
//  ========================================

function custom_user_profile_fields($profileuser)
{
?>
    <h1>Extra user information</h1>
    <table class="form-table">
        <tr>
            <th>
                <label for="user_location"><?php _e('Location'); ?></label>
            </th>
            <td>
                <input type="text" name="user_location" id="user_location" value="<?php echo esc_attr(get_the_author_meta('user_location', $profileuser->ID)); ?>" class="regular-text" />
                <br><span class="description"><?php _e('Your location.', 'text-domain'); ?></span>
            </td>
        </tr>
        <tr>
            <th>
                <label for="user_facebook"><?php _e('Facebook'); ?></label>
            </th>
            <td>
                <input type="url" name="user_facebook" id="user_facebook" value="<?php echo esc_attr(get_the_author_meta('user_facebook', $profileuser->ID)); ?>" class="regular-text" />
                <br><span class="description"><?php _e('Your Facebook id link ( e.g https://facebook.com/ridwansakil )', 'text-domain'); ?></span>
            </td>
        </tr>
    </table>
<?php
}
add_action('show_user_profile', 'custom_user_profile_fields');
add_action('edit_user_profile', 'custom_user_profile_fields');


// ======================================
//add Shortcode 
// ======================================

function wpdocs_footag_func()
{
    $content = 'this is coming from shortcode';
    return $content;
}
add_shortcode('rsshort', 'wpdocs_footag_func');


// Use shortcode in a PHP file (outside the post editor).
echo do_shortcode( '[gallery]' );
