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
// Incluye el archivo del modelo Seg_imgprodModel
require_once (ROOT_DIR ."/model/Seg_imgproducModel.php");

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
// Función para obtener todas las imagenes
function filterAll($input) {
    // Crea un nuevo objeto Seg_imgproducModel
    $objFactura = new Seg_imgproducModel();
    // Llama a la función findAll del objeto Seg_imgproducModel
    $var = $objFactura->findAll();
    // Imprime el resultado en formato JSON
    echo json_encode($var);
}
// Función para obtener una factura por su ID
function filterId($input) {
    // Obtiene el parámetro 'id' de la petición
    $p_id = !empty($input['idimg']) ? $input['idimg'] : $_GET['idimg'];
    // Crea un nuevo objeto Seg_imgproducModel
    $objImgproduc = new Seg_imgproducModel();
    // Llama a la función findId del objeto Seg_imgproducModel
    $var = $objImgproduc->findId($p_id);
    // Imprime el resultado en formato JSON
    echo json_encode($var);
}
// Función para obtener todas las imagenes con paginación y filtrado
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

    // Crea un nuevo objeto Seg_imgproducModel
    $objImagenproduc = new Seg_imgproducModel();
    // Llama a la función findPaginateAll del objeto Seg_imgprodModel
    $var = $objImagenproduc->findPaginateAll($filter, $p_limit, $p_offset);
    // Imprime el resultado en formato JSON
    echo json_encode($var);
}

// Función para insertar una nueva imagen
// necesita dos parametros, el primero es el nombre de la imagen y el segundo es la ruta de la imagen
function insert($input) {
    // echo json_encode($_FILES["imagen"]);
    echo json_encode(!empty($_FILES["imagen"]));
    // Verifica si el formulario ha sido enviado
    if(!empty($_FILES["imagen"]["tmp_name"])) {
        // Obtiene los parámetros de la petición
        $imagen = $_FILES["imagen"]["tmp_name"];
        // Obtiene el nombre, tipo y tamaño de la imagen
        $nombreImagen = $_FILES["imagen"]["name"];
        $tipoImagen = strtolower(pathinfo($nombreImagen, PATHINFO_EXTENSION));
        $sizeImagen = $_FILES["imagen"]["size"];
        $directorio = "/archivos/";

        // Verifica el tipo de imagen
        if (($tipoImagen == "jpg" || $tipoImagen == "jpeg" || $tipoImagen == "png" || $tipoImagen == "gif") && $sizeImagen < 5000000) {
            // Crea un nuevo objeto Seg_imgproducModel
            $objImagenproduc = new Seg_imgproducModel();
            // Inserta un nuevo registro vacío para obtener el ID
            $var = $objImagenproduc->insert("");

            if ($var) {
                $idRegistro = $objImagenproduc->getLastInsertId();  // Método para obtener el último ID insertado
                $ruta = $directorio.$idRegistro.".".$tipoImagen;

                // Actualiza el registro con la ruta de la imagen
                $actualizarImagen = $objImagenproduc->update($idRegistro, $ruta);

                // Mueve la imagen al directorio especificado
                if (move_uploaded_file($imagen, $ruta)) {
                    echo json_encode(["success" => "Imagen subida correctamente"]);
                } else {
                    echo json_encode(["error" => "Error al subir la imagen"]);
                }
            } else {
                echo json_encode(["error" => "Error al insertar el registro de imagen"]);
            }
        } else {
            echo json_encode(["error" => "Formato de imagen no permitido, o sobre paso el limite de tamaño permitido"]);
        }
        // Imprime el resultado en formato JSON
        //echo json_encode($var);
    } else {
        echo json_encode(["error" => "No se ha enviado ninguna imagen"]);
    }
}

// Función para actualizar una imagen existente
function update($input) {
    // Obtiene los parámetros de la petición de la imagen a actualizar
    $p_idimg = !empty($input['idimg']) ? $input['idimg'] : $_POST['idimg'];
    $nombreActual = !empty($input['nombre']) ? $input['nombre'] : $_POST['nombre'];

    // Verifica si el formulario ha sido enviado y si hay una imagen nueva
    if(!empty($_FILES["imagen"]["tmp_name"])) {
        $imagen = $_FILES["imagen"]["tmp_name"];
        $nombreImagen = $_FILES["imagen"]["name"];
        $tipoImagen = strtolower(pathinfo($nombreImagen, PATHINFO_EXTENSION));
        $sizeImagen = $_FILES["imagen"]["size"];
        $directorio = "/archivos/";

        // Verifica si el archivo es una imagen válida y su tamaño
        if(($tipoImagen == "jpg" || $tipoImagen == "jpeg" || $tipoImagen == "png" || $tipoImagen == "gif") && $sizeImagen < 5000000) {
            // Intenta eliminar la imagen anterior
            try {
                // Verifica si la imagen anterior existe en el sistema de archivos
                if (file_exists($nombreActual)) {
                    // Elimina la imagen anterior del sistema de archivos
                    unlink($nombreActual);
                }
            } catch (\Throwable $th) {
                echo json_encode(["error" => "Error al eliminar la imagen anterior"]);
                return;
            }

            // Crea la nueva ruta de la imagen
            $ruta = $directorio . $p_idimg . "." . $tipoImagen;

            // Mueve la nueva imagen al directorio especificado
            if (move_uploaded_file($imagen, $ruta)) {
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



// Función para eliminar una imagen
function delete($input) {
    // Obtiene el parámetro 'id' de la petición
    $p_idimg = !empty($input['id']) ? $input['id'] : $_POST['id'];
    $nombre = !empty($input['nombre']) ? $input['nombre'] : $_POST['nombre'];

    // Elimina la imagen del sistema de archivos
    try {
        // Verifica si la imagen existe en el sistema de archivos
        if (file_exists($nombre)) {
            // Elimina la imagen del sistema de archivos
            unlink($nombre);
        } else {
            // Imprime un mensaje de error si la imagen no se encuentra en el sistema de archivos
            echo json_encode(["error" => "Imagen no encontrada en el sistema de archivos"]);
            return;
        }
    } catch (\Throwable $th) {
        // Imprime un mensaje de error si se produce una excepción al eliminar la imagen
        echo json_encode(["error" => "Error al eliminar la imagen del sistema de archivos"]);
        return;
    }
    // Crea un nuevo objeto Seg_imgproducModel
    $objImgproduc = new Seg_imgproducModel();
    // Llama a la función delete del objeto Seg_imgproducModel
    $var = $objImgproduc->delete($p_idimg);

    // Verifica si la eliminación en la base de datos fue exitosa
    if ($var) {
        // Imprime un mensaje de éxito si la eliminación en la base de datos fue exitosa
        echo json_encode(["success" => "Imagen eliminada correctamente"]);
    } else {
        // Imprime un mensaje de error si la eliminación en la base de datos no fue exitosa
        echo json_encode(["error" => "Error al eliminar la imagen de la base de datos"]);
    }

    // Imprime el resultado en formato JSON
    ///echo json_encode($var);
}
?>
