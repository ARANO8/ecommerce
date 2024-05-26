<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Content-Type: application/json; charset=UTF-8");


session_start();

require_once ($_SERVER['DOCUMENT_ROOT']."/ecommerce/config/global.php");
require_once (ROOT_DIR ."/model/Seg_compraModel.php");

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'),true);
try {
    $Path_Info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : (isset($_SERVER['ORIG_PATH_INFO']) ? $_SERVER['ORIG_PATH_INFO'] : '');
    $request = explode('/',trim($Path_Info, '/'));
}
catch (Exception $e) {
    echo $e -> getMessage();
}
switch ($method) {
    case 'GET':
        $p_ope = !empty($input['ope']) ? $input['ope'] : $_GET['ope'];
        if (!empty($p_ope)) {
            if ($p_ope == 'filterall') {
                filterAll($input);
            }elseif ($p_ope == 'filterId') {
                filterId($input);
            }elseif ($p_ope == 'filterSearch') {
                filterPaginateAll($input);
            }
        }
        break;
    case 'POST':
        insert($input);
        break;
    case 'PUT':
        update($input);
        break;
    case 'DELETE':
        delete($input);
        break;
    default:
        echo 'NO SOPORTADO';
        break;
}
function filterAll($input){
    $objComp = new Seg_compraModel();
    $var = $objComp->findall();
    echo json_encode($var);
}
function filterId($input){
    $p_idproducto=!empty ($input['idproducto']) ? $input['idproducto'] : $_GET['idproducto'];
    $p_idfactura=!empty ($input['idfactura']) ? $input['idfactura'] : $_GET['idfactura'];
    $objComp = new Seg_compraModel();
    $var = $objComp->findid($p_idproducto, $p_idfactura);
    echo json_encode($var);
}
function filterPaginateAll($input){
    $page = !empty($input['page']) ? $input['page'] : $_GET['page'];
    $filter = !empty($input['filter']) ? $input['filter'] : $_GET['filter'];
    $nro_record_page = 10;
    $p_limit = 10;
    $p_offset = 0;
    $p_offset = abs(($page-1)*$nro_record_page);
    $objComp = new Seg_compraModel();
    $var = $objComp->findpaginateall($filter, $p_limit,$p_offset);
    echo json_encode($var);
}
function insert($input){
    $p_idproducto=!empty ($input['idproducto']) ? $input['idproducto'] : $_POST['idproducto'];
    $p_idfactura=!empty ($input['idfactura']) ? $input['idfactura'] : $_POST['idfactura'];
    $p_precioventa=!empty ($input['precioventa']) ? $input['precioventa'] : $_POST['precioventa'];
    $p_cantidad=!empty ($input['cantidad']) ? $input['cantidad'] : $_POST['cantidad'];
    $objComp = new Seg_compraModel();
    $var = $objComp->insert($p_idproducto, $p_idfactura, $p_precioventa, $p_cantidad);
    echo json_encode($var);
}
function update($input){
    $p_idproducto=!empty ($input['idproducto']) ? $input['idproducto'] : $_POST['idproducto'];
    $p_idfactura=!empty ($input['idfactura']) ? $input['idfactura'] : $_POST['idfactura'];
    $p_precioventa=!empty ($input['precioventa']) ? $input['precioventa'] : $_POST['precioventa'];
    $p_cantidad=!empty ($input['cantidad']) ? $input['cantidad'] : $_POST['cantidad'];
    $objComp = new Seg_compraModel();
    $var = $objComp->update($p_idproducto, $p_idfactura, $p_precioventa, $p_cantidad);
    echo json_encode($var);
}
function delete($input){
    $p_idproducto=!empty ($input['idproducto']) ? $input['idproducto'] : $_POST['idproducto'];
    $p_idfactura=!empty ($input['idfactura']) ? $input['idfactura'] : $_POST['idfactura'];
    $objComp = new Seg_compraModel();
    $var = $objComp->delete($p_idproducto, $p_idfactura);
    echo json_encode($var); 
}

?>