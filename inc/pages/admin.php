<?php
/**
 * 
 * @package newplugin
 */

 namespace Inc\Pages;

 class Admin{

    public function add_admin_pages()
    {
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

    public function admin_index()
    {
        // template
        require_once PLUGIN_PATH . "templates/admin.php";
    }
 }