<?php

session_start();
require_once './config/global.php';

$request = $_SERVER['REQUEST_URI'];
$request = parse_url($request, PHP_URL_PATH);
$segments = explode('/', trim($request, '/'));
function home()
{
    require ROOT_VIEW . '/home.php';
}
function verificarlogin_admin(){
    if (!isset($_SESSION['login']['full_name'])) {
        echo '<script>window.location.href="' . HTTP_BASE .'/login_admin"</script>';
    }
}
if ($segments[0]==='ecommerce') {
    switch ($segments[1] ?? '') {
        case 'login':
            require ROOT_VIEW . '/login/login.php';
            break;
        case 'login_admin':
            // verificarlogin_admin();
            require ROOT_VIEW . '/login/login_admin.php';
            break;
        case 'register':
            require ROOT_VIEW . '/login/register.php';
            break;
        case 'registeradmin':
            require ROOT_VIEW . '/login/register_admin.php';
            break;
        case 'homeadmin':
            require ROOT_VIEW . '/homeadmin.php';
            break;
        case 'logout':
            session_destroy();
            $data = [
                'ope' => 'logout',

            ];
            $context = stream_context_create([
                'http' => [
                    'method' => 'POST',
                    'header' => 'Content-Type: application/json',
                    'content' => json_encode($data),
                ]
            ]);
            $url = HTTP_BASE . "/controller/LoginController.php";
            $response = file_get_contents($url, false, $context);
            echo '<script>window.location.href="' . HTTP_BASE . '/login_admin"</script>';
            break;
        case 'logoutadmin':
            session_destroy();
            $data = [
                'ope' => 'logout',

            ];
            $context = stream_context_create([
                'http' => [
                    'method' => 'POST',
                    'header' => 'Content-Type: application/json',
                    'content' => json_encode($data),
                ]
            ]);
            $url = HTTP_BASE . "/controller/LoginController.php";
            $response = file_get_contents($url, false, $context);
            echo '<script>window.location.href="' . HTTP_BASE . '/login_admin"</script>';
            break;
        case 'web':
            break;
        default:
            home();
            break;
    }
}
