<?php
session_start();  // Iniciar sesión al comienzo de la petición
require_once './config/global.php';

$request = $_SERVER['REQUEST_URI'];
$request = parse_url($request, PHP_URL_PATH);
$segments = explode('/', trim($request, '/'));

// Función para verificar si el usuario está autenticado
//$request = '/seg_modulo/list';
echo "$request";
switch ($request) {
    case '/':
    case '':

        //require ROOT_DIR . '/view/seg_modulo/list.php';
        break;

    default:
        //http_response_code(404);
        require ROOT_DIR . '/view/home.php';
        break;
    }
?>