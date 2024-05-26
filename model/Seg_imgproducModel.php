<?php 
// Incluye el archivo ModeloBasePDO.php que contiene la clase base para la interacción con la base de datos
include_once "../core/ModeloBasePDO.php";

// Define la clase Seg_imgproducModel que extiende de ModeloBasePDO
class Seg_imgproducModel extends ModeloBasePDO {

    // Constructor de la clase
    public function __construct(){
        // Llama al constructor de la clase padre
        parent::__construct();
    }

    // Método para obtener todas las imagenes
    public function findAll(){
        // Consulta SQL para seleccionar todos los campos de la tabla imagenes
        $sql = "SELECT idimg, rutaimagen FROM imgproduc"; 
        $param = array();
        // Ejecuta la consulta y devuelve el resultado
        return parent::gselect($sql, $param);
    }

    // Método para obtener una imagen por su ID
    public function findId($p_id){
        // Consulta SQL para seleccionar una imagen por su ID
        $sql = "SELECT idimg, rutaimagen
                FROM imgproduc
                WHERE idimg = :p_id;";
        $param = array();
        // Agrega el parámetro ID a la consulta
        array_push($param, [':p_id', $p_id, PDO::PARAM_INT]);
        // Ejecuta la consulta y devuelve el resultado
        return parent::gselect($sql, $param);
    }

    // Método para obtener todas las imagenes con paginación y filtrado
    public function findPaginateAll($p_filtro, $p_limit, $p_offset){
        // Consulta SQL para seleccionar todas las imagenes con paginación y filtrado
        $sql = "SELECT idimg, rutaimagen
                FROM imgproduc
                WHERE upper(concat(IFNULL(idimg,''), IFNULL(rutaimagen,''))) LIKE concat('%',upper(IFNULL(:p_filtro,'')),'%')
                LIMIT :p_limit
                OFFSET :p_offset;";
        $param = array();
        // Agrega los parámetros de filtro, límite y desplazamiento a la consulta
        array_push($param, [':p_filtro', $p_filtro, PDO::PARAM_STR]);
        array_push($param, [':p_limit', $p_limit, PDO::PARAM_INT]);
        array_push($param, [':p_offset', $p_offset, PDO::PARAM_INT]);

        // Ejecuta la consulta y devuelve el resultado
        $var = parent::gselect($sql, $param);

        // Consulta SQL para contar el número total de imagenes que cumplen con el filtro
        $sqlcount = "SELECT COUNT(1) AS cantimagenes
                     FROM imgproduc
                     WHERE upper(concat(IFNULL(idimg,''), IFNULL(rutaimagen,''))) LIKE concat('%',upper(IFNULL(:p_filtro,'')),'%');";
        $param = array();
        // Agrega los parámetros de filtro, límite y desplazamiento a la consulta
        array_push($param, [':p_filtro', $p_filtro, PDO::PARAM_STR]);
        // Ejecuta la consulta y devuelve el resultado
        $var1 = parent::gselect($sqlcount, $param);
        // longitud de la respuesta
        // Agrega la longitud de la respuesta al resultado
        $var['LENGTH'] = $var1['DATA'][0]['cantimagenes'];
        return $var;
    }

    // Método para insertar una nueva imagen
    public function insert($p_rutaimagen){
        // Consulta SQL para insertar una nueva imagen
        $sql = "INSERT INTO imgproduc (rutaimagen) VALUES (:p_rutaimagen);";
        $param = array();
        // Agrega los parámetros de ID y ruta de la imagen a la consulta
        array_push($param, [':p_rutaimagen', $p_rutaimagen, PDO::PARAM_STR]);
        // Ejecuta la consulta y devuelve el resultado
        return parent::ginsert($sql, $param);
    }

    // Método para actualizar una imagen
    public function update($p_idimg, $p_rutaimagen){
        // Consulta SQL para actualizar una imagen
        $sql = "UPDATE imgproduc SET
                rutaimagen = :p_rutaimagen
                WHERE idimg = :p_idimg;";
        $param = array();
        // Agrega los parámetros de ID y ruta de la imagen a la consulta
        array_push($param, [':p_idimg', $p_idimg, PDO::PARAM_INT]);
        array_push($param, [':p_rutaimagen', $p_rutaimagen, PDO::PARAM_STR]);
        // Ejecuta la consulta y devuelve el resultado
        return parent::gupdate($sql, $param);
    }

    // Método para eliminar una imagen
    public function delete($p_idimg){
        // Consulta SQL para eliminar una imagen
        $sql = "DELETE FROM imgproduc WHERE idimg = :p_idimg;";
        $param = array();
        // Agrega el parámetro ID a la consulta
        array_push($param, [':p_idimg', $p_idimg, PDO::PARAM_INT]);
        // Ejecuta la consulta y devuelve el resultado
        return parent::gdelete($sql, $param);
    }
}
?>