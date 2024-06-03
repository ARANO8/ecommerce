<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Content-Type: application/json; charset=UTF-8");


session_start();

require_once ($_SERVER['DOCUMENT_ROOT'] . "/ecommerce/config/global.php");

require_once (ROOT_DIR . "/model/Seg_productoModel.php");

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
            } elseif ($p_ope == 'filterall') {
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
//Funcion para obtener un producto por su id
function filterId($input)
{
    $tseg_producto = new Seg_productoModel();
    $p_idproducto = !empty($input['idproducto']) ? $input['idproducto'] : $_GET['idproducto'];
    $var = $tseg_producto->findId($p_idproducto);
    echo json_encode($var);
}
//Función para obtener todos los productos con paginación y filtrado
function filterPaginateAll($input)
{
    $nro_record_page = 10;
    $page = !empty($input['page']) ? $input['page'] : $_GET['page'];
    $filter = !empty($input['filter']) ? $input['filter'] : $_GET['filter'];
    $p_limit = 10;
    $p_offset = 0;
    $p_offset = abs(($page - 1) * $nro_record_page);
    $tseg_producto = new Seg_productoModel();
    $var = $tseg_producto->findpaginateall($filter, $p_limit, $p_offset);
    echo json_encode($var);
}
//Funcion para obtener todos los usuarios
function filterAll($input)
{
    $tseg_producto = new Seg_productoModel();
    $var = $tseg_producto->findall();
    echo json_encode($var);
}
//Funcion para insertar producto
function insert($input)
{
    $p_nombre = !empty($input['nombre']) ? $input['nombre'] : $_POST['nombre'];
    ;
    $p_precio = !empty($input['precio']) ? $input['precio'] : $_POST['precio'];
    ;
    $p_stock = !empty($input['stock']) ? $input['stock'] : $_POST['stock'];
    ;
    $p_descripcion = !empty($input['descripcion']) ? $input['descripcion'] : $_POST['descripcion'];
    ;
    $p_estatus = !empty($input['estatus']) ? $input['estatus'] : $_POST['estatus'];
    ;
    $p_idimg = !empty($input['idimg']) ? $input['idimg'] : $_POST['idimg'];
    ;

    $tseg_producto = new Seg_productoModel();
    $var = $tseg_producto->insert($p_nombre, $p_precio, $p_stock, $p_descripcion, $p_estatus, $p_idimg);

    echo json_encode($var);
}
//Funcion para actualizar usuario
function update($input)
{
    $p_idproducto = !empty($input['idproducto']) ? $input['idproducto'] : $_POST['idproducto'];
    ;
    $p_nombre = !empty($input['nombre']) ? $input['nombre'] : $_POST['nombre'];
    ;
    $p_precio = !empty($input['precio']) ? $input['precio'] : $_POST['precio'];
    ;
    $p_stock = !empty($input['stock']) ? $input['stock'] : $_POST['stock'];
    ;
    $p_descripcion = !empty($input['descripcion']) ? $input['descripcion'] : $_POST['descripcion'];
    ;
    $p_estatus = !empty($input['estatus']) ? $input['estatus'] : $_POST['estatus'];
    ;
    $p_idimg = !empty($input['idimg']) ? $input['idimg'] : $_POST['idimg'];
    ;

    $tseg_producto = new Seg_productoModel();
    $var = $tseg_producto->update($p_idproducto, $p_nombre, $p_precio, $p_stock, $p_descripcion, $p_estatus, $p_idimg);

    echo json_encode($var);
}
//Funcion para eliminar usuario
function delete($input)
{
    $p_idproducto = !empty($input['idproducto']) ? $input['idproducto'] : $_POST['idproducto'];
    ;
    $tseg_producto = new Seg_productoModel();
    $var = $tseg_producto->delete($p_idproducto);

    echo json_encode($var);
}
