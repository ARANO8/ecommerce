<?php
// Permite el acceso desde cualquier origen
header("Access-Control-Allow-Origin: *");
// Permite los métodos PUT, GET, POST, DELETE
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
// Permite los encabezados Origin, X-Requested-With, Content-Type, Accept
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
// Establece el tipo de contenido a JSON
header("Content-Type: application/json; charset=UTF-8");

// Inicia una nueva sesión o reanuda la existente
session_start();

// Incluye el archivo de configuración global
require_once ($_SERVER['DOCUMENT_ROOT']."/ecommerce/config/global.php");
// Incluye el archivo del modelo seg_vendemodel.php
require_once (ROOT_DIR ."/model/Seg_vendeModel.php");

// Obtiene el método HTTP usado en la petición
$method = $_SERVER['REQUEST_METHOD'];
// Decodifica el cuerpo de la petición y lo convierte en un array asociativo
$input = json_decode(file_get_contents('php://input'), true);

try {
    // Obtiene la información de la ruta de la petición
    $Path_Info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : (isset($_SERVER['ORIG_PATH_INFO']) ? $_SERVER['ORIG_PATH_INFO'] : '');
    // Divide la ruta en segmentos
    $request = explode('/', trim($Path_Info, '/'));
} catch (Exception $e) {
    // Imprime el mensaje de error si se produce una excepción
    echo $e->getMessage();
}
// Dependiendo del método HTTP usado en la petición, realiza diferentes acciones
switch ($method) {
    case 'GET':
        // Obtiene el parámetro 'ope' de la petición
        $p_ope = !empty($input['ope']) ? $input['ope'] : $_GET['ope'];
        // Si el parámetro 'ope' no está vacío, realiza diferentes acciones dependiendo de su valor
        if (!empty($p_ope)) {
            if ($p_ope == 'filterall') {
                // Si 'ope' es 'filterall', llama a la función filterAll
                filterAll($input);
            } elseif ($p_ope == 'filterId') {
                // Si 'ope' es 'filterId', llama a la función filterId
                filterId($input);
            } elseif ($p_ope == 'filterSearch') {
                // Si 'ope' es 'filterSearch', llama a la función filterPaginateAll
                filterPaginateAll($input);
            }
        }
        break;
    case 'POST':
        // Si el método es POST, llama a la función insert
        insert($input);
        break;
    case 'PUT':
        // Si el método es PUT, llama a la función update
        update($input);
        break;
    case 'DELETE':
        // Si el método es DELETE, llama a la función delete
        delete($input);
        break;
    default:
        // Si el método no es GET, POST, PUT o DELETE, imprime un mensaje de error      
        echo 'NO SOPORTADO xd';
        break;
}
// Función para obtener todas las ventas
function filterAll($input) {
    // Crea un nuevo objeto seg_vendeModel
    $objVende = new Seg_vendeModel();
    // Llama a la función findAll del objeto seg_vendeModel
    $var = $objVende->findAll();
    // Imprime el resultado en formato JSON
    echo json_encode($var);
}
// Función para obtener una venta por su ID
function filterId($input) {
    // Obtiene el parámetro 'id' de la petición
    $p_idvendedor = !empty($input['idvendedor']) ? $input['idvendedor'] : $_GET['idvendedor'];
    $p_idproducto = !empty($input['idproducto']) ? $input['idproducto'] : $_GET['idproducto'];
    // Crea un nuevo objeto seg_vendeModel
    $objVende = new Seg_vendeModel();
    // Llama a la función findId del objeto seg_vendeModel
    $var = $objVende->findId($p_idvendedor, $p_idproducto);
    // Imprime el resultado en formato JSON
    echo json_encode($var);
}
// Función para obtener todas las ventas con paginación y filtrado
function filterPaginateAll($input) {
    // Obtiene los parámetros 'page' y 'filter' de la petición
    $page = !empty($input['page']) ? $input['page'] : $_GET['page'];
    // Obtiene el parámetro 'filter' de la petición
    $filter = !empty($input['filter']) ? $input['filter'] : $_GET['filter'];
    // Define el número de registros por página
    $nro_record_page = 10;
    // Define el límite y el desplazamiento
    $p_limit = 10;
    $p_offset = 0;
    // Calcula el desplazamiento
    $p_offset = abs(($page - 1) * $nro_record_page);

    // Crea un nuevo objeto seg_vendeModel
    $objVende = new Seg_vendeModel();
    // Llama a la función findPaginateAll del objeto seg_vendeModel
    $var = $objVende->findPaginateAll($filter, $p_limit, $p_offset);
    // Imprime el resultado en formato JSON
    echo json_encode($var);
}

// Función para insertar una nueva venta
function insert($input) {
    // Obtiene los parámetros de la petición
    $p_idvendedor = !empty($input['idvendedor']) ? $input['idvendedor'] : $_POST['idvendedor'];
    $p_idproducto = !empty($input['idproducto']) ? $input['idproducto'] : $_POST['idproducto'];
    $p_cantidad = !empty($input['cantidad']) ? $input['cantidad'] : $_POST['cantidad'];

    // Crea un nuevo objeto seg_vendeModel
    $objVende = new Seg_vendeModel();
    // Llama a la función insert del objeto seg_vendeModel
    $var = $objVende->insert($p_idvendedor, $p_idproducto, $p_cantidad);
    // Imprime el resultado en formato JSON
    echo json_encode($var);
}
// Función para actualizar una vende existente
function update($input) {
    // Obtiene los parámetros de la petición
    $p_idvendedor = !empty($input['idvendedor']) ? $input['idvendedor'] : $_POST['idvendedor'];
    $p_idproducto = !empty($input['idproducto']) ? $input['idproducto'] : $_POST['idproducto'];
    $p_cantidad = !empty($input['cantidad']) ? $input['cantidad'] : $_POST['cantidad'];
    // Crea un nuevo objeto seg_vendeModel
    $objVende = new Seg_vendeModel();
    // Llama a la función update del objeto seg_vendeModel
    $var = $objVende->update($p_idvendedor, $p_idproducto, $p_cantidad);
    // Imprime el resultado en formato JSON
    echo json_encode($var);
}

// Función para eliminar una venta
function delete($input) {
    // Obtiene el parámetro 'id' de la petición
    $p_idvendedor = !empty($input['idvendedor']) ? $input['idvendedor'] : $_POST['idvendedor'];
    $p_idproducto = !empty($input['idproducto']) ? $input['idproducto'] : $_POST['idproducto'];

    // Crea un nuevo objeto seg_vendeModel
    $objVende = new Seg_vendeModel();
    // Llama a la función delete del objeto seg_vendeModel
    $var = $objVende->delete($p_idvendedor, $p_idproducto);
    // Imprime el resultado en formato JSON
    echo json_encode($var);
}
?>
