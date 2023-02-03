<?php
if (!function_exists('asset')) {
    function asset($path)
    {
        return sprintf($_ENV['APP_LOCATION'].'/public/%s', ltrim($path, '/'));
    }   
}