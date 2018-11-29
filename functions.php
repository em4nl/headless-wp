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


// if this is an admin panel request, do nothing more
if (!$is_frontend_req) return;


// if it is a frontend request, stop the unnecessary querying
add_action('do_parse_request', function($do_parse, $wp) {
    $wp->query_vars = array();
    remove_action('template_redirect', 'redirect_canonical');
    return FALSE;
});
