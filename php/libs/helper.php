<?php

function get_param($key, $default_val, $is_post = true)
{
    $is_post = $is_post ? $_POST : $_GET;
    return $is_post[$key] ?? $default_val;
}

// function redirect($path) {
//     $path = BASE_CONTEXT_PATH . trim($path, /);
//     return header("Locale:{$path}");
// }

function redirect($path)
{
    if ($path === GO_HOME) {
        $path = get_url('');
    } elseif ($path === GO_REFERER) {
        $path = $_SERVER['HTTP_REFERER'];
    } else {
        $path = get_url($path);
    }
    header("Location:{$path}");
    die();
}

function get_url($path)
{
    return BASE_CONTEXT_PATH . trim($path, '/');
}

function is_alnum($val)
{
    return preg_match("/^[a-zA-Z0-9]+$/", $val);
}
