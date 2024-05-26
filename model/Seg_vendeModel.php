<?php 
// Incluye el archivo ModeloBasePDO.php que contiene la clase base para la interacción con la base de datos
include_once "../core/ModeloBasePDO.php";

// Define la clase Seg_vendeModel que extiende de ModeloBasePDO
class Seg_vendeModel extends ModeloBasePDO {

    // Constructor de la clase
    public function __construct(){
        // Llama al constructor de la clase padre
        parent::__construct();
    }

    // Método para obtener todas las ventas
    public function findAll(){
        // Consulta SQL para seleccionar todos los campos de la tabla ventas
        $sql = "SELECT idvendedor, idproducto, cantidad FROM vende";
        $param = array();
        // Ejecuta la consulta y devuelve el resultado
        return parent::gselect($sql, $param);
    }

    // Método para obtener una venta por su ID
    public function findId($p_idvendedor, $p_idproducto){
        // Consulta SQL para seleccionar una venta por su ID
        $sql = "SELECT idvendedor, idproducto, cantidad
                FROM vende
                WHERE idvendedor = :p_idvendedor AND idproducto = :p_idproducto;";
        $param = array();
        // Agrega el parámetro ID a la consulta
        array_push($param, [':p_idvendedor', $p_idvendedor, PDO::PARAM_INT]);
        array_push($param, [':p_idproducto', $p_idproducto, PDO::PARAM_INT]);
        // Ejecuta la consulta y devuelve el resultado
        return parent::gselect($sql, $param);
    }

    // Método para obtener todas las ventas con paginación y filtrado
    public function findPaginateAll($p_filtro, $p_limit, $p_offset){
        // Consulta SQL para seleccionar todas las ventas con paginación y filtrado
        $sql = "SELECT idvendedor, idproducto, cantidad 
                FROM vende
                WHERE upper(concat(IFNULL(idvendedor,''), IFNULL(idproducto,''), IFNULL(cantidad,''))) LIKE concat('%',upper(IFNULL(:p_filtro,'')),'%')
                LIMIT :p_limit
                OFFSET :p_offset;";
        $param = array();
        // Agrega los parámetros de filtro, límite y desplazamiento a la consulta
        array_push($param, [':p_filtro', $p_filtro, PDO::PARAM_STR]);
        array_push($param, [':p_limit', $p_limit, PDO::PARAM_INT]);
        array_push($param, [':p_offset', $p_offset, PDO::PARAM_INT]);

        // Ejecuta la consulta y devuelve el resultado
        $var = parent::gselect($sql, $param);

        // Consulta SQL para contar el número total de ventas que cumplen con el filtro
        $sqlcount = "SELECT COUNT(1) AS cantVentas
                     FROM vende
                     WHERE upper(concat(IFNULL(idvendedor,''), IFNULL(idproducto,''), IFNULL(cantidad,''))) LIKE concat('%',upper(IFNULL(:p_filtro,'')),'%');";
        $param = array();
        // Agrega los parámetros de filtro, límite y desplazamiento a la consulta
        array_push($param, [':p_filtro', $p_filtro, PDO::PARAM_STR]);
        // Ejecuta la consulta y devuelve el resultado
        $var1 = parent::gselect($sqlcount, $param);
        // longitud de la respuesta
        // Agrega la longitud de la respuesta al resultado
        $var['LENGTH'] = $var1['DATA'][0]['cantVentas'];
        return $var;
    }

    // Método para insertar una nueva venta
    public function insert($p_idvendedor, $p_idproducto, $p_cantidad){
        // Consulta SQL para insertar una nueva venta
        $sql = "INSERT INTO vende (idvendedor, idproducto, cantidad) VALUES (:p_idvendedor, :p_idproducto, :p_cantidad);";
        $param = array();
        // Agrega los parámetros de ID de vendedor, ID de producto y cantidad a la consulta
        array_push($param, [':p_idvendedor', $p_idvendedor, PDO::PARAM_INT]);
        array_push($param, [':p_idproducto', $p_idproducto, PDO::PARAM_INT]);
        array_push($param, [':p_cantidad', $p_cantidad, PDO::PARAM_INT]);
        // Ejecuta la consulta y devuelve el resultado
        return parent::ginsert($sql, $param);
    }

    // Método para actualizar una venta
    public function update($p_idvendedor, $p_idproducto, $p_cantidad){
        // Consulta SQL para actualizar una venta
        $sql = "UPDATE vende SET
                idvendedor = :p_idvendedor,
                idproducto = :p_idproducto,
                cantidad = :p_cantidad
                WHERE idvendedor = :p_idvendedor; AND idproducto = :p_idproducto;";
        $param = array();
        // Agrega los parámetros de ID de vendedor, ID de producto y cantidad a la consulta
        array_push($param, [':p_idvendedor', $p_idvendedor, PDO::PARAM_INT]);
        array_push($param, [':p_idproducto', $p_idproducto, PDO::PARAM_INT]);
        array_push($param, [':p_cantidad', $p_cantidad, PDO::PARAM_INT]);
        // Ejecuta la consulta y devuelve el resultado
        return parent::gupdate($sql, $param);
    }

    // Método para eliminar una venta
    public function delete($p_idvendedor, $p_idproducto){
        // Consulta SQL para eliminar una venta
        $sql = "DELETE FROM vende WHERE idvendedor = :p_idvendedor; AND idproducto = :p_idproducto;";
        $param = array();
        // Agrega el parámetro ID a la consulta
        array_push($param, [':p_idvendedor', $p_idvendedor, PDO::PARAM_INT]);
        array_push($param, [':p_idproducto', $p_idproducto, PDO::PARAM_INT]);
        // Ejecuta la consulta y devuelve el resultado
        return parent::gdelete($sql, $param);
    }
}
?>