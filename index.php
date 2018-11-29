<?php


// don't run without WordPress context
if (!defined('ABSPATH')) {
    exit;
}


// redirect if a redirect url is set
$redirect_url = get_option('em4nl_headless_redirect_url');
if ($redirect_url) {
    $permanent = get_option('em4nl_headless_redirect_is_permanent');
    wp_redirect($redirect_url, $permanent ? '301' : '302');
}
