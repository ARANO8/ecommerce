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
require_once ($_SERVER['DOCUMENT_ROOT'] . "/ecommerce/config/global.php");
// Incluye el archivo del modelo Seg_imgprodModel
require_once (ROOT_DIR . "/model/Seg_imgproducModel.php");

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

        //echo json_encode($p_ope);
        // Si el parámetro 'ope' no está vacío, realiza diferentes acciones dependiendo de su valor
        if (!empty($p_ope)) {
            if ($p_ope == 'filterall') {
                // Si 'ope' es 'filterall', llama a la función filterAll
                filterAll($input);
            } elseif ($p_ope == 'filterId') {
                // Si 'ope' es 'filterId', llama a la función filterId
                filterId($input);
            } elseif ($p_ope == 'lastid') {
                lastid($input);
            }
        }
        break;
    case 'POST':
        // Si el método es POST, llama a la función insert
        update($input);
        break;

    default:
        // Si el método no es GET, POST, PUT o DELETE, imprime un mensaje de error      
        echo 'NO SOPORTADO';
        break;
}
// Función para obtener todas las imagenes
function filterAll($input)
{
    // Crea un nuevo objeto Seg_imgproducModel
    $objFactura = new Seg_imgproducModel();
    // Llama a la función findAll del objeto Seg_imgproducModel
    $var = $objFactura->findAll();
    // Imprime el resultado en formato JSON
    echo json_encode($var);
}
// funcion necesaria para img
function filterId($input)
{
    // Obtiene el parámetro 'id' de la petición
    $p_id = !empty($input['idimg']) ? $input['idimg'] : $_GET['idimg'];
    // Crea un nuevo objeto Seg_imgproducModel
    $objImgproduc = new Seg_imgproducModel();
    // Llama a la función findId del objeto Seg_imgproducModel
    $var = $objImgproduc->findId($p_id);
    // Imprime el resultado en formato JSON
    echo json_encode($var);
}
function lastid($input)
{
    $objId = new Seg_imgproducModel();
    $var = $objId->getLastInsertId();
    echo json_encode($var);

}

// Función para actualizar una imagen existente
function update($input)
{
    // MANERA DE ENVIAR IMAGENES CON UNA BARRIBLE DE VERIFICACION EN EL NOMBRE
    // como es envia un POST el nombre la imagen debe ser el id del que se quiere reemplazar
    // sin afectar la extencion, solo se debe cambiar el nombre de la imagen subida por el id a hacer update
    // antes de enviar el POST desde el FRONT 
////////////////////////////////////////////////////
    $_FILES['imagen']['name'] = "51.gif";
    /////////////////////////////////////////////////
    if (!empty($_FILES["imagen"]["tmp_name"])) {
        $imagen = $_FILES["imagen"]["tmp_name"];
        //nombreImagen, tiene los datos para encontrar la anterior ruta y eliminar la anterior imagen
        $nombreImagen = $_FILES["imagen"]["name"];
        //echo json_encode($_FILES);
        $infoImagen = pathinfo($nombreImagen);
        // extrane el name del archivo que seria el id de la imagen -> update
        $p_idimg = $infoImagen["filename"];
        $tipoImagen = strtolower($infoImagen["extension"]);
        $sizeImagen = $_FILES["imagen"]["size"];
        $directorio = "archivos/";

        //echo json_encode($infoImagen);
        $objImgproduc = new Seg_imgproducModel();
        //encuentra la anterior ruta para eliminar el archivo
        $last_ruta = $objImgproduc->findId($infoImagen["filename"]);
        //////echo json_encode($last_ruta["DATA"][0]["rutaimagen"]);
        $nombreImagen = $last_ruta["DATA"][0]["rutaimagen"];
        //echo json_encode([$tipoImagen . ' y ' . $nombreImagen . ' > ' . $p_idimg]);
        // Verifica si el archivo es una imagen válida y su tamaño    && $sizeImagen < 5000000
        if (($tipoImagen == "jpg" || $tipoImagen == "jpeg" || $tipoImagen == "png" || $tipoImagen == "gif") && $sizeImagen < 5000000) {
            try {
                // Verifica si la imagen anterior existe en el sistema de archivos
                if (file_exists("../" . $nombreImagen)) {
                    // Elimina la imagen anterior del sistema de archivos
                    unlink("../" . $nombreImagen);
                    echo json_encode(["eliminadoOK"]);
                }
            } catch (\Throwable $th) {
                echo json_encode(["error" => "Error al eliminar la imagen anterior"]);
                return;
            }


            $ruta = $directorio . $p_idimg . "." . $tipoImagen;

            // Mueve la nueva imagen al directorio especificado
            if (move_uploaded_file($imagen, "../" . $ruta)) {
                // Crea un nuevo objeto Seg_imgproducModel
                $objImagenproduc = new Seg_imgproducModel();
                // Llama a la función update del objeto Seg_imgproducModel
                $var = $objImagenproduc->update($p_idimg, $ruta);

                // Verifica si la actualización en la base de datos fue exitosa
                if ($var) {
                    echo json_encode(["success" => "Imagen actualizada correctamente"]);
                } else {
                    echo json_encode(["error" => "Error al actualizar el registro de la imagen en la base de datos"]);
                }
            } else {
                echo json_encode(["error" => "Error al subir la nueva imagen"]);
            }
        } else {
            echo json_encode(["error" => "Formato de imagen no permitido o tamaño demasiado grande"]);
        }
    } else {
        echo json_encode(["error" => "No se ha enviado ninguna imagen"]);
    }
}



?>