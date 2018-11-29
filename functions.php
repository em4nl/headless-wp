<?php


// don't run without WordPress context
if (!defined('ABSPATH')) {
    exit;
}


// find out if this is a frontend request
$current_path = trim(esc_url_raw(add_query_arg(array())), '/');
$home_path = trim(parse_url(home_url(), PHP_URL_PATH), '/');
if ($home_path && strpos($current_path, $home_path) === 0) {
    $current_path = trim(substr($current_path, strlen($home_path)), '/');
}
$is_frontend_req = (!preg_match('/^(admin|login|wp-content)/', $current_path)
                    && (!is_admin() || (defined('DOING_AJAX') && DOING_AJAX)));


// add an options page to the menu
if (is_admin()) {
    add_action('admin_menu', function() {
        add_menu_page(
            'Headless theme options',
            'Headless',
            'manage_options',
            'headless-options',
            function() {
                include __DIR__ . '/options.php';
            },
            'dashicons-dismiss',
            80
        );
    });
    add_action('admin_init', function() {
        register_setting('em4nl_headless', 'em4nl_headless_command_or_webhook');
        register_setting('em4nl_headless', 'em4nl_headless_is_webhook', array(
            'type' => 'boolean',
        ));
        register_setting('em4nl_headless', 'em4nl_headless_redirect_url');
        register_setting('em4nl_headless', 'em4nl_headless_redirect_is_permanent', array(
            'type' => 'boolean',
        ));
    });
}


// find out if advanced custom fields is active
include_once(ABSPATH . 'wp-admin/includes/plugin.php');
$is_acf_active = (is_plugin_active('advanced-custom-fields/acf.php')
                  || is_plugin_active('advanced-custom-fields-pro/acf.php'));


// register hook to run when content is changed
$on_save_post = function() {
    $cmd_or_wh = get_option('em4nl_headless_command_or_webhook');
    if ($cmd_or_wh) {
        $is_wh = get_option('em4nl_headless_is_webhook');
        if ($is_wh) {
            // TODO
            // - add more options for user like different http
            //   methods, headers or post data
            // - handle errors
            // - bonus: show errors to user (after save_post? how?)
            file_get_contents($cmd_or_wh);
        } else {
            // TODO
            // - handle errors/output/exit_code
            exec($cmd_or_wh);
        }
    }
};
add_action('save_post', $on_save_post, 20);
if ($is_acf_active) {
    add_action('acf/save_post', $on_save_post, 20);
}


// if this is an admin panel request, do nothing more
if (!$is_frontend_req) return;


// if it is a frontend request, stop the unnecessary querying
add_action('do_parse_request', function($do_parse, $wp) {
    $wp->query_vars = array();
    remove_action('template_redirect', 'redirect_canonical');
    return FALSE;
}, 30, 2);
