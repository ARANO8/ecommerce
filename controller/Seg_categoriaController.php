<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Content-Type: application/json; charset=UTF-8");


session_start();

require_once ($_SERVER['DOCUMENT_ROOT']."/ecommerce/config/global.php");
require_once (ROOT_DIR ."/model/Seg_categoriaModel.php");

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
    $objCat = new Seg_categoriaModel();
    $var = $objCat->findall();
    echo json_encode($var);
}
function filterId($input){
    $p_id=!empty($input['id']) ? $input['id'] : $_GET['id'];
        $objCat = new Seg_categoriaModel();
    $var = $objCat->findid($p_id);
    echo json_encode($var);
}
function filterPaginateAll($input){
    $page = !empty($input['page']) ? $input['page'] : $_GET['page'];
    $filter = !empty($input['filter']) ? $input['filter'] : $_GET['filter'];
    $nro_record_page = 10;
    $p_limit = 10;
    $p_offset = 0;
    $p_offset = abs(($page-1)*$nro_record_page);
    $objCat = new Seg_categoriaModel();
    $var = $objCat->findpaginateall($filter, $p_limit,$p_offset);
    echo json_encode($var);
}
function insert($input){
    $p_nombreC=!empty ($input['nombreC']) ? $input['nombreC'] : $_POST['nombreC'];
    $objCat = new Seg_categoriaModel();
    $var = $objCat->insert($p_nombreC);
    echo json_encode($var);
}
function update($input){
    $p_idcategoria=!empty ($input['idcategoria']) ? $input['idcategoria'] : $_POST['idcategoria'];
    $p_nombreC=!empty ($input['nombreC']) ? $input['nombreC'] : $_POST['nombreC'];
    $objCat = new Seg_categoriaModel();
    $var = $objCat->update($p_idcategoria,$p_nombreC);
    echo json_encode($var);
}
function delete($input){
    $p_idcategoria=!empty ($input['idcategoria']) ? $input['idcategoria'] : $_POST['idcategoria'];
    $objCat = new Seg_categoriaModel();
    $var = $objCat->delete($p_idcategoria);
    echo json_encode($var); 
}

?>