<?php

session_start();
require_once './config/global.php';

$request=$_SERVER['REQUEST_URI'];
$request=parse_url($request, PHP_URL_PATH);
$segments=explode('/', trim($request,'/'));
function home(){
    require ROOT_VIEW.'/home.php';
}
if ($segments[0]==='ecommerce') {
    switch ($segments[1] ?? '') {
        case 'login':
            # code...
            break;
        case 'web':
            break;
        default:
            home();
            break;
    }
}

?>