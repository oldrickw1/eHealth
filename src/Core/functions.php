<?php

function urlIs($value)
{
    return $_SERVER['REQUEST_URI'] === $value;
}


function base_path($path)
{
    return BASE_PATH . $path;
}


function send_json_response($data, $status_code = 200) {
    http_response_code($status_code);
    header('Content-Type: application/json');
    echo json_encode($data);
}
