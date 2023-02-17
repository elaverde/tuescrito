<?php
if (!function_exists('asset')) {
    function asset($path)
    {
        return sprintf('/'.$_ENV['APP_LOCATION'].'/public/%s', ltrim($path, '/'));
    }   
}
if (!function_exists('profile_image')) {
    function profile_image($photo)
    {
        if($photo == 'default.jpg' or $photo == 'none' or $photo == 'no-photo.jpg'){
            $photo_url = $_ENV['APP_URL']. $_ENV['APP_LOCATION'].'/public/assets/img/default.jpg';
        }else{
            $photo_url = $_ENV['APP_URL'].$_ENV['APP_LOCATION'].'/' . $_ENV['APP_STORAGE'] .'/'.'admins' .'/'.  $photo;
        }
        return $photo_url;
    }   
}