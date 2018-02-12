<?php

require_once( DP_PLUGIN_DIR . 'class.router.php' );

/**
 * DanceParty
 */
class DanceParty
{
    const NAME = 'Dance Party';
    const OPTION_GROUP = 'danceparty-options';
    const CONTROLLER_DIR = DP_PLUGIN_DIR . 'controllers/';
    const VIEW_DIR = DP_PLUGIN_DIR . 'views/';

    private static $init_done = false;

    static function init() {
        if ( !self::$init_done) {
            self::init_hooks();
        }
    }

    static function init_hooks() {
        Router::init_hooks();

        $init_done = true;
    }

    /* Called when the plugin is activated through the admin panel */
    public static function activation_hook() {
      Router::register_routes();
      flush_rewrite_rules();

      self::create_tables();
    }

    public static function deactivation_hook() {
        flush_rewrite_rules();
    }

    public static function create_tables() {
        require_once( DP_PLUGIN_DIR . 'models/user.php' );
        require_once( DP_PLUGIN_DIR . 'models/event.php' );
        require_once( DP_PLUGIN_DIR . 'models/roles.php' );

        User::create_table();
        Membership::create_table();
        Event::create_table();
        Role::create_table();
    }

    public static function render_view( $view, $context ) {
        include_once( 'class.formbuilder.php' );

        include DanceParty::VIEW_DIR . $view;
    }

    public static function render_view_with_template( $view, $context ) {
        include DanceParty::VIEW_DIR . 'layout.php';
    }

    public static function run_controller( $controller ) {
        include DanceParty::CONTROLLER_DIR . $controller;
    }
}

?>
