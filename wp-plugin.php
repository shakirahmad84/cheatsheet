<?php

/*
1. Go to wp-config.php file and make WP_DEBUG as TRUE.
*/

/**
 * Plugin Name:       My Basic Plugin
 * Plugin URI:        https://nixsit.com/plugins/the-basic-plugin/
 * Description:       Handle the basics with this plugin.
 * Version:           0.0.1
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Shakir Ahmad
 * Author URI:        https://nixsit.com/shakir
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       my-basics-plugin
 * Domain Path:       /languages
 */

/**
 * Functions for checking directory URL
 */
function directory_urls(){
    echo plugins_url();
    echo "<br>";
    echo plugin_dir_url(__FILE__);
    echo "<br>";
    echo plugin_dir_path(__FILE__);
    echo "<br>";
    echo plugin_basename(__FILE__);
    echo "<br>";
    echo includes_url();
    echo "<br>";
    echo content_url();
    echo "<br>";
    echo admin_url();
    echo "<br>";
    echo home_url();
    echo "<br>";
    echo admin_url();
    echo "<br>";
    echo site_url();
    echo "<br>";
    echo wp_upload_dir();
    echo "<br>";
    
}

/**
 * Write in theme Template
 */
directory_urls();

/**
 * Using Directory
 */

echo plugins_url('assets/css/style.css', __FILE__);
echo plugins_url('assets/js/script.js', __FILE__);
echo plugins_url('assets/img/screenshot.png', __FILE__);


?>
<img src=".plugins_url('assets/img/screenshot.png', __FILE__)." alt="">
<?php
function theme_stylesheet(){
    wp_enqueue_style( 'myCSS', plugins_url( '/assets/css/style.css', __FILE__ ) );
}
add_action('admin_print_styles', 'theme_stylesheet');

function theme_script(){
    wp_enqueue_script( 'my_custom_script', plugin_dir_url( __FILE__ ) . 'assets/js/script.js', array('jquery'), '1.0.0', false );
}
add_action('admin_enqueue_scripts', 'theme_script');


/***************************
 ***** Activation Hook *****
 ***************************/
function pluginprefix_setup_post_type() {
    register_post_type( 'book', ['public' => 'true'] );
}
add_action( 'init', 'pluginprefix_setup_post_type' );
 
function pluginprefix_install() {
    pluginprefix_setup_post_type();
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'pluginprefix_install' );


/*****************************
 ***** Deactivation Hook *****
 *****************************/
function pluginprefix_deactivation() {
    unregister_post_type( 'book' );
    flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'pluginprefix_deactivation' );

/***************************
 ***** Uninstall Hook *****
 ***************************/
function pluginprefix_function_to_run(){
    // if uninstall.php is not called by WordPress, die
    if (!defined('WP_UNINSTALL_PLUGIN')) {
        die;
    }
    $option_name = 'wporg_option';
    delete_option($option_name);
    // for site options in Multisite
    delete_site_option($option_name);
    // drop a custom database table
    global $wpdb;
    $wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}mytable");
}
register_uninstall_hook(__FILE__, 'pluginprefix_function_to_run');


/**********************************************
 ***** Check for Existing Implementations *****
 **********************************************/
Variables: isset() (includes arrays, objects, etc.)
Functions: function_exists()
Classes: class_exists()
Constants: defined()
    
    
/*********************************
 ********** Action Hook **********
 *********************************/    
function wporg_custom(){
    // do something
}
add_action('init', 'wporg_custom');

/*********************************
 ********** Filter Hook **********
 *********************************/    
function wporg_filter_title($title){
    return 'The ' . $title . ' was filtered';
}
add_filter('the_title', 'wporg_filter_title');

function wporg_css_body_class($classes){
    if (!is_admin()) {
        $classes[] = 'wporg-is-awesome';
    }
    return $classes;
}
add_filter('body_class', 'wporg_css_body_class');

/*********************************
 ********** Custom Hook **********
 *********************************/   
// use do_action() for Action Hook
function wporg_settings_page_html(){
    ?>
    Foo: <input id="foo" name="foo" type="text">
    Bar: <input id="bar" name="bar" type="text">
    <?php
    do_action('wporg_after_settings_page_html');
}

function myprefix_add_settings(){
    ?>
    New 1: <input id="new_setting" name="new_settings" type="text">
    <?php
}
add_action('wporg_after_settings_page_html', 'myprefix_add_settings');

// use apply_filters() for Filter Hook
function wporg_create_post_type(){
    $post_type_params = [/* ... */]; 
    register_post_type(
        'post_type_slug',
        apply_filters('wporg_post_type_params', $post_type_params)
    );
}

function myprefix_change_post_type_params($post_type_params){
    $post_type_params['hierarchical'] = true;
    return $post_type_params;
}
add_filter('wporg_post_type_params', 'myprefix_change_post_type_params');

// Removing Actions and Filters
function my_theme_setup_slider(){
    // ...
}
add_action('template_redirect', 'my_theme_setup_slider', 9);

function wporg_disable_slider(){
    // make sure all parameters match the add_action() call exactly
    remove_action('template_redirect', 'my_theme_setup_slider', 9);
}
// make sure we call remove_action() after add_action() has been called
add_action('after_setup_theme', 'wporg_disable_slider');


/*****************************************
 ********** Administration Menu **********
 *****************************************/

// Top Level Menu
function wporg_options_page_html() {
    ?>
    <div class="wrap">
      <h1><?php esc_html( get_admin_page_title() ); ?></h1>
      <form action="options.php" method="post">
        <?php
        // output security fields for the registered setting "wporg_options"
        settings_fields( 'wporg_options' );
        // output setting sections and their fields
        // (sections are registered for "wporg", each field is registered to a specific section)
        do_settings_sections( 'wporg' );
        // output save settings button
        submit_button( 'Save Settings' );
        ?>
      </form>
    </div>
    <?php
}

function wporg_options_page() {
    add_menu_page(
        'WPOrg',
        'WPOrg Options',
        'manage_options',
        'wporg',
        'wporg_options_page_html',
        plugin_dir_url(__FILE__) . 'images/icon_wporg.png',
        20
    );
}
add_action( 'admin_menu', 'wporg_options_page' );

function wporg_options_page() {
    add_menu_page(
        'WPOrg',
        'WPOrg Options',
        'manage_options',
        plugin_dir_path(__FILE__) . 'admin/view.php',
        null,
        plugin_dir_url(__FILE__) . 'images/icon_wporg.png',
        20
    );
}
add_action( 'admin_menu', 'wporg_options_page' );

// Sub Menu
function wporg_options_page_html(){
    // check user capabilities
    if (!current_user_can('manage_options')) {
        return;
    }
    ?>
    <div class="wrap">
        <h1><?= esc_html(get_admin_page_title()); ?></h1>
        <form action="options.php" method="post">
            <?php
            // output security fields for the registered setting "wporg_options"
            settings_fields('wporg_options');
            // output setting sections and their fields
            // (sections are registered for "wporg", each field is registered to a specific section)
            do_settings_sections('wporg');
            // output save settings button
            submit_button('Save Settings');
            ?>
        </form>
    </div>
    <?php
}

function wporg_options_page(){
    add_submenu_page(
        'tools.php',
        'WPOrg Options',
        'WPOrg Options',
        'manage_options',
        'wporg',
        'wporg_options_page_html'
    );
}
add_action('admin_menu', 'wporg_options_page');























/**************************
 ********** CRUD **********
 **************************/

// READ
global $wpdb;
$results = $wpdb->get_results('SELECT id, post_title FROM wp_posts WHERE post_status = "publish"');
//    var_dump($results);
foreach($results as $result){
    echo $result->id."<br>";
    echo $result->post_title."<br>";
}
    
// CREAT
global $wpdb;
$wpdb->insert('wp_shakir', array('id'=>23, 'name'=>'shakir', 'cell'=>'01783360384', 'status'=>1), array('%d', '%s', '%s', '%d'));
// Example
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $name = $_POST["name"];
    $cell = $_POST["cell"];
    global $wpdb;
    $wpdb->insert('wp_shakir', array('name'=>$name, 'cell'=>$cell), array('%s', '%s'));
}
<form action="<?php $_PHP_SELF; ?>" method="post">
    Name : <input type="text" name="name"><br>
    Cell : <input type="text" name="cell"><br>
    <input type="submit" value="Done">
</form>

// UPDATE
global $wpdb;
$wpdb->update('wp_shakir', array('name'=>'ahmad', 'cell'=>'01848308007', 'status'=>2), array('id'=>20), array('%s', '%s', '%d'));


// DELETE
global $wpdb;
$wpdb->delete('wp_shakir', array('id'=>20));


/*******************************
 ********** SHORTCODE **********
 *******************************/
/*** self-closing Shortcodes / Show = [heading]  ***/
function zboom_heading(){
    echo "<h1>Hello World Shakir</h1>";
}
add_shortcode('heading', 'zboom_heading');



/*** Enclosing Shortcodes / Show = [heading][/heading] ***/
function zboom_heading( $atts, $content ){
    return "<h1>". $content ."</h1>";
}
add_shortcode('heading', 'zboom_heading');



/*** Shortcodes with Parameters / Show = [heading position="center"]HI[/heading]  ***/

function zboom_heading( $atts, $content ){
    
    $heading = shortcode_atts(array(
        'position'  =>  'left',
    ), $atts);
    
    return "<h1 align='".$heading['position']."'>". $content ."</h1>";
    
}
add_shortcode('heading', 'zboom_heading');

function zboom_heading( $atts, $content ){
    
    $heading = extract(shortcode_atts(array(
        'position'  =>  'left',
    ), $atts));
    
    return "<h1 align='".$position."'>". $content ."</h1>";
    
}
add_shortcode('heading', 'zboom_heading');


// show [img width="500px" height="300px"]https://images.pexels.com/photos/414612/pexels-photo-414612.jpeg[/img]
function zboom_image($atts, $content){
    
    $image = shortcode_atts(array(
        'width'   =>  '300px',
        'height'  =>  '300px',
    ), $atts);
    return '<img height="'.$image['height'].'"  width="'.$image['width'].'" src="'.$content.'">';
}
add_shortcode('img', 'zboom_image');



function zboom_block_shortcode(){
    op_start(); ?>
    
// HTML, CSS, JavaScript Code like slider, block, section etc
    
    <?php
    $block = ob_get_clean();
    return $block;
}
add_shortcode('block', 'zboom_block_shortcode');