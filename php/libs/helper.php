<?php 

function get_param($key, $default_val, $is_post = true) {
    $is_post = $is_post ? $_POST : $_GET ;
    return $is_post[$key] ?? $default_val;
}