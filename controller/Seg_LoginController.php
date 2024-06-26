<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Content-Type: application/json; charset=UTF-8");


session_start();

require_once ($_SERVER['DOCUMENT_ROOT'] . "/ecommerce/config/global.php");

require_once (ROOT_DIR . "/model/Seg_usuarioModel.php");


$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

try {
    $Path_Info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : (isset($_SERVER['ORIG_PATH_INFO']) ? $_SERVER['ORIG_PATH_INFO'] : '');
    $request = explode('/', trim($Path_Info, '/'));
} catch (Exception $e) {
    echo $e->getMessage();
}
switch ($method) {

    case 'GET': //consulta

        $p_ope = !empty($input['ope']) ? $input['ope'] : $_GET['ope'];
        if (!empty($p_ope)) {


            if ($p_ope == 'filterall') {
                filterAll($input);
            }
        }
        break;
    case 'POST':
        $p_ope = !empty($input['ope']) ? $input['ope'] : $_POST['ope'];
        if ($p_ope == 'login') {
            login($input);
        } else if ($p_ope == 'register') {
            register($input);
        } else if ($p_ope == 'logout') {
            session_destroy();
        }
        break;
}

function filterAll($input)
{
    $tseg_usuario = new Seg_usuarioModel();
    $var = $tseg_usuario->findall();
    echo json_encode($var);
}

function login($input)
{
    $p_correo = !empty($input['correo']) ? $input['correo'] : $_POST['correo'];
    $p_password = !empty($input['password']) ? $input['password'] : $_POST['password'];
    $p_password = hash('sha512', md5($p_password));
    $su = new Seg_usuarioModel();
    $var = $su->verificarlogin($p_correo, $p_password);
    //echo json_encode(count($var));
    //    var_dump($var['DATA']);
    if (count($var['DATA']) > 0) {
        $_SESSION['login'] = $var['DATA'][0];
        echo "ok";
        echo json_encode($var);
        exit();
    } else {
        $array = array();
        $array['ESTADO'] = false;
        $array['ERROR'] = "Usuario o Contraseña no valida, verifique sus datos, demasiados intentos bloqueara al usuario el acceso al sistema.";
        echo json_encode($var);
        exit();
    }
}
function register($input)
{
    $p_nombre = !empty($input['nombre']) ? $input['nombre'] : $_POST['nombre'];
    ;
    $p_correo = !empty($input['correo']) ? $input['correo'] : $_POST['correo'];
    ;
    $p_user = !empty($input['user']) ? $input['user'] : $_POST['user'];
    ;

    $p_password = !empty($input['password']) ? $input['password'] : $_POST['password'];
    ;
    $p_password = hash('sha512', md5($p_password));

    $p_direccion = !empty($input['direccion']) ? $input['direccion'] : $_POST['direccion'];
    ;
    $tseg_login = new Seg_usuarioModel();//p_user, p_direccion
    $var = $tseg_login->register($p_nombre, $p_correo, $p_user, $p_password, $p_direccion);

    echo json_encode($var);
}
