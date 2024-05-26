<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Content-Type: application/json; charset=UTF-8");


session_start();

require_once($_SERVER['DOCUMENT_ROOT'] . "/ecommerce/config/global.php");

require_once(ROOT_DIR . "/model/Seg_usuarioModel.php");

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

try {
    $Path_Info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : (isset($_SERVER['ORIG_PATH_INFO']) ? $_SERVER['ORIG_PATH_INFO'] : '');
    $request = explode('/', trim($Path_Info, '/'));
} catch (Exception $e) {
    echo $e->getMessage();
}
//Peticion
switch ($method) {
    case 'GET': //consulta

        $p_ope = !empty($input['ope']) ? $input['ope'] : $_GET['ope'];
        if (!empty($p_ope)) {

            if ($p_ope == 'filterId') {
                filterId($input);
            } elseif ($p_ope == 'filterSearch') {
                filterPaginateAll($input);
            } elseif ($p_ope ==  'filterall') {
                filterAll($input);
            }
        }

        break;
    case 'POST': //inserta
        insert($input);
        break;
    case 'PUT': //actualiza
        update($input);
        break;
    case 'DELETE': //elimina
        delete($input);
        break;
    default: //metodo NO soportado
        echo 'METODO NO SOPORTADO';
        break;
}
//Funcion para obtener un usuario por su id
function  filterId($input)
{
    $tseg_usuario = new Seg_usuarioModel();
    $p_id = !empty($input['id']) ? $input['id'] : $_GET['id'];
    $var = $tseg_usuario->findId($p_id);
    echo json_encode($var);
}
//Función para obtener todas los usuarios con paginación y filtrado
function  filterPaginateAll($input)
{
    $nro_record_page = 10;
    $page = !empty($input['page']) ? $input['page'] : $_GET['page'];
    $filter = !empty($input['filter']) ? $input['filter'] : $_GET['filter'];
    $p_limit = 10;
    $p_offset = 0;
    $p_offset = abs(($page - 1) * $nro_record_page);
    $tseg_usuario = new Seg_usuarioModel();
    $var = $tseg_usuario->findpaginateall($filter, $p_limit, $p_offset);
    echo json_encode($var);
}
//Funcion para obtener todos los usuarios
function  filterAll($input)
{
    $tseg_usuario = new Seg_usuarioModel();
    $var = $tseg_usuario->findall();
    echo json_encode($var);
}
//Funcion para insertar usuario
function insert($input)
{
    $p_id = !empty($input['id']) ? $input['id'] : $_POST['id'];;
    $p_nombre = !empty($input['nombre']) ? $input['nombre'] : $_POST['nombre'];;
    $p_correo = !empty($input['correo']) ? $input['correo'] : $_POST['correo'];;
    $p_user = !empty($input['user']) ? $input['user'] : $_POST['user'];;
    $p_password = !empty($input['password']) ? $input['password'] : $_POST['password'];;
    $p_direccion = !empty($input['direccion']) ? $input['direccion'] : $_POST['direccion'];;
    $p_fotoperfil = !empty($input['fotoperfil']) ? $input['fotoperfil'] : $_POST['fotoperfil'];;
    $p_cliente = !empty($input['cliente']) ? $input['cliente'] : $_POST['cliente'];;
    $p_vendedor = !empty($input['vendedor']) ? $input['vendedor'] : $_POST['vendedor'];;

    $tseg_usuario = new Seg_usuarioModel();
    $var = $tseg_usuario->insert($p_id, $p_nombre, $p_correo, $p_user, $p_password, $p_direccion, $p_fotoperfil, $p_cliente, $p_vendedor);

    echo json_encode($var);
}
//Funcion para actualizar usuario
function update($input)
{
    $p_id = !empty($input['id']) ? $input['id'] : $_POST['id'];;
    $p_nombre = !empty($input['nombre']) ? $input['nombre'] : $_POST['nombre'];;
    $p_correo = !empty($input['correo']) ? $input['correo'] : $_POST['correo'];;
    $p_user = !empty($input['user']) ? $input['user'] : $_POST['user'];;
    $p_password = !empty($input['password']) ? $input['password'] : $_POST['password'];;
    $p_direccion = !empty($input['direccion']) ? $input['direccion'] : $_POST['direccion'];;
    $p_fotoperfil = !empty($input['fotoperfil']) ? $input['fotoperfil'] : $_POST['fotoperfil'];;
    $p_cliente = !empty($input['cliente']) ? $input['cliente'] : $_POST['cliente'];;
    $p_vendedor = !empty($input['vendedor']) ? $input['vendedor'] : $_POST['vendedor'];;

    $tseg_usuario = new Seg_usuarioModel();
    $var = $tseg_usuario->update($p_id, $p_nombre, $p_correo, $p_user, $p_password, $p_direccion, $p_fotoperfil, $p_cliente, $p_vendedor);

    echo json_encode($var);
}
//Funcion para eliminar usuario
function delete($input)
{
    $p_id = !empty($input['id']) ? $input['id'] : $_POST['id'];;

    $tseg_usuario = new Seg_usuarioModel();
    $var = $tseg_usuario->delete($p_id);

    echo json_encode($var);
}
