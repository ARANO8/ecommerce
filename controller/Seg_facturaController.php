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
// Incluye el archivo del modelo Seg_facturaModel
require_once (ROOT_DIR ."/model/Seg_facturaModel.php");

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
        echo 'NO SOPORTADO';
        break;
}
// Función para obtener todas las facturas
function filterAll($input) {
    // Crea un nuevo objeto Seg_facturaModel
    $objFactura = new Seg_facturaModel();
    // Llama a la función findAll del objeto Seg_facturaModel
    $var = $objFactura->findAll();
    // Imprime el resultado en formato JSON
    echo json_encode($var);
}
// Función para obtener una factura por su ID
function filterId($input) {
    // Obtiene el parámetro 'id' de la petición
    $p_idfactura = !empty($input['idfactura']) ? $input['idfactura'] : $_GET['idfactura'];
    // Crea un nuevo objeto Seg_facturaModel
    $objFactura = new Seg_facturaModel();
    // Llama a la función findId del objeto Seg_facturaModel
    $var = $objFactura->findId($p_idfactura);
    // Imprime el resultado en formato JSON
    echo json_encode($var);
}
// Función para obtener todas las facturas con paginación y filtrado
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

    // Crea un nuevo objeto Seg_facturaModel
    $objFactura = new Seg_facturaModel();
    // Llama a la función findPaginateAll del objeto Seg_facturaModel
    $var = $objFactura->findPaginateAll($filter, $p_limit, $p_offset);
    // Imprime el resultado en formato JSON
    echo json_encode($var);
}

// Función para insertar una nueva factura
function insert($input) {
    // Obtiene los parámetros de la petición
    $p_montoTotal = !empty($input['montoTotal']) ? $input['montoTotal'] : $_POST['montoTotal'];
    $p_fecha = !empty($input['fecha']) ? $input['fecha'] : $_POST['fecha'];
    $p_id = !empty($input['id']) ? $input['id'] : $_POST['id'];
    
    // Crea un nuevo objeto Seg_facturaModel
    $objFactura = new Seg_facturaModel();
    // Llama a la función insert del objeto Seg_facturaModel
    $var = $objFactura->insert($p_montoTotal, $p_fecha, $p_id);
    // Imprime el resultado en formato JSON
    echo json_encode($var);
}
// Función para actualizar una factura existente
function update($input) {
    // Obtiene los parámetros de la petición
    $p_idfactura = !empty($input['idfactura']) ? $input['idfactura'] : $_POST['idfactura'];
    $p_montoTotal = !empty($input['montoTotal']) ? $input['montoTotal'] : $_POST['montoTotal'];
    $p_fecha = !empty($input['fecha']) ? $input['fecha'] : $_POST['fecha'];
    // Obtiene el parámetro 'idUsuario' de la petición
    $p_id = !empty($input['id']) ? $input['id'] : $_POST['id'];
    // Crea un nuevo objeto Seg_facturaModel
    $objFactura = new Seg_facturaModel();
    // Llama a la función update del objeto Seg_facturaModel
    $var = $objFactura->update($p_idfactura, $p_montoTotal, $p_fecha, $p_id);
    // Imprime el resultado en formato JSON
    echo json_encode($var);
}

// Función para eliminar una factura
function delete($input) {
    // Obtiene el parámetro 'id' de la petición
    $p_idfactura = !empty($input['idfactura']) ? $input['idfactura'] : $_POST['idfactura'];

    // Crea un nuevo objeto Seg_facturaModel
    $objFactura = new Seg_facturaModel();
    // Llama a la función delete del objeto Seg_facturaModel
    $var = $objFactura->delete($p_idfactura);
    // Imprime el resultado en formato JSON
    echo json_encode($var);
}
?>
