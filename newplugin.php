<?php
/*
Plugin Name: New Plugin
Plugin URI: http://wordpress.org/plugins/hello-dolly/
Description: This is not just a plugin, it symbolizes the hope and enthusiasm of an entire generation summed up in two words sung most famously by Louis Armstrong: Hello, Dolly. When activated you will randomly see a lyric from <cite>Hello, Dolly</cite> in the upper right of your admin screen on every page.
Author: Matt Mullenweg
Version: 1.7.2
Author URI: http://ma.tt/
*/


defined("ABSPATH") or die("Dont !");


class Newclass{
    // methods

    function __construct() {
        add_action("init", array(
            $this, "custom_post_type"
        ));

        $this->plugin = plugin_basename(__FILE__);
    }

    public $plugin;

    // registering style and scripts
    function register()
    {
        add_action( "admin_enqueue_scripts", array( $this, "enqueue" ) );
        // adding settings page 
        add_action( "admin_menu", array( $this, "add_settings_page" ) );
        // adding slug redirection
        
        add_filter( "plugin_action_links_$this->plugin", array($this, "settings_link") );
        echo $this->plugin;
    }

    // adding custom slug for settings or for all custom page
    public function settings_link($links)
    {
        // adding custom link for settings
        $settings_link = '<a href="admin.php">Settings</a>';
        array_push($links, $settings_link);
        return $links;

    }

    // adding function for settings page
    public function add_settings_page()
    {
        // parameters
        // page_title, menu_title, capablity=>manage_options, menu_slug, 'template', 'icons', position
        add_menu_page(
            "New Plugin",
            "NewPlugin",
            "manage_options",
            "new plugin",
            array( 
                $this, "admin_index"
            ),
            "dashicons-store", 110
        );
    }

    public function admin_index(){
        // template
        require_once plugin_dir_path(__FILE__) . "templates/admin.php";
    }

    function activating_plugin() {
        $this->custom_post_type();
        flush_rewrite_rules();
    }

    function deactivating_plugin() {
        flush_rewrite_rules();
    }

    function uninstalling_plugin() {

    }

    function custom_post_type(){
        register_post_type("Book", [
            "public" => true,
            "label" => "Books"
        ]);
    }

    function enqueue()
    {
        // css files
        wp_enqueue_style(
            "mypluginstyle", plugins_url("/assets/css/my_style.css", __FILE__)
        );
        // Script
        wp_enqueue_script("myscript", plugins_url("/assets/js/my_script.js", __FILE__));
    }

}

if ( !class_exists("NewPlugin") ){
    $newplugin = new Newclass();
    $newplugin->register();
}


// activate
register_activation_hook(__FILE__, array($newplugin, "activating_plugin"));
// deactivate
register_deactivation_hook(__FILE__, array( $newplugin, "deactivating_plugin" ));
// unistalling