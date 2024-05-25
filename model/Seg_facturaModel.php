<?php 
// Incluye el archivo ModeloBasePDO.php que contiene la clase base para la interacción con la base de datos
include_once "../core/ModeloBasePDO.php";

// Define la clase Seg_facturaModel que extiende de ModeloBasePDO
class Seg_facturaModel extends ModeloBasePDO {

    // Constructor de la clase
    public function __construct(){
        // Llama al constructor de la clase padre
        parent::__construct();
    }

    // Método para obtener todas las facturas
    public function findAll(){
        // Consulta SQL para seleccionar todos los campos de la tabla factura
        $sql = "SELECT idfactura, montoTotal, fecha, id AS idUsuario FROM factura;";
        $param = array();
        // Ejecuta la consulta y devuelve el resultado
        return parent::gselect($sql, $param);
    }

    // Método para obtener una factura por su ID
    public function findId($p_id){
        // Consulta SQL para seleccionar una factura por su ID
        $sql = "SELECT idfactura, montoTotal, fecha, id AS idUsuario
                FROM factura
                WHERE idfactura = :p_id;";
        $param = array();
        // Agrega el parámetro ID a la consulta
        array_push($param, [':p_id', $p_id, PDO::PARAM_INT]);
        // Ejecuta la consulta y devuelve el resultado
        return parent::gselect($sql, $param);
    }

    // Método para obtener todas las facturas con paginación y filtrado
    public function findPaginateAll($p_filtro, $p_limit, $p_offset){
        // Consulta SQL para seleccionar todas las facturas con paginación y filtrado
        $sql = "SELECT idfactura, montoTotal, fecha, id AS idUsuario
                FROM factura
                WHERE upper(concat(IFNULL(idfactura,''), IFNULL(montoTotal,''), IFNULL(fecha,''), IFNULL(id,''))) LIKE concat('%',upper(IFNULL(:p_filtro,'')),'%')
                LIMIT :p_limit
                OFFSET :p_offset;";
        $param = array();
        // Agrega los parámetros de filtro, límite y desplazamiento a la consulta
        array_push($param, [':p_filtro', $p_filtro, PDO::PARAM_STR]);
        array_push($param, [':p_limit', $p_limit, PDO::PARAM_INT]);
        array_push($param, [':p_offset', $p_offset, PDO::PARAM_INT]);

        // Ejecuta la consulta y devuelve el resultado
        $var = parent::gselect($sql, $param);

        // Consulta SQL para contar el número total de facturas que cumplen con el filtro
        $sqlcount = "SELECT COUNT(1) AS cantFacturas
                     FROM factura
                     WHERE upper(concat(IFNULL(idfactura,''), IFNULL(montoTotal,''), IFNULL(fecha,''), IFNULL(id,''))) LIKE concat('%',upper(IFNULL(:p_filtro,'')),'%');";
        $param = array();
        // Agrega los parámetros de filtro, límite y desplazamiento a la consulta
        array_push($param, [':p_filtro', $p_filtro, PDO::PARAM_STR]);
        // Ejecuta la consulta y devuelve el resultado
        $var1 = parent::gselect($sqlcount, $param);
        // longitud de la respuesta
        // Agrega la longitud de la respuesta al resultado
        $var['LENGTH'] = $var1['DATA'][0]['cantFacturas'];
        return $var;
    }

    // Método para insertar una nueva factura
    public function insert($p_montoTotal, $p_fecha, $p_idUsuario){
        // Consulta SQL para insertar una nueva factura
        $sql = "INSERT INTO factura (montoTotal, fecha, id) VALUES (:p_montoTotal, :p_fecha, :p_idUsuario);";
        $param = array();
        // Agrega los parámetros de monto total, fecha e ID de usuario a la consulta
        array_push($param, [':p_montoTotal', $p_montoTotal, PDO::PARAM_STR]);
        array_push($param, [':p_fecha', $p_fecha, PDO::PARAM_STR]);
        array_push($param, [':p_idUsuario', $p_idUsuario, PDO::PARAM_INT]);
        // Ejecuta la consulta y devuelve el resultado
        return parent::ginsert($sql, $param);
    }

    // Método para actualizar una factura
    public function update($p_idfactura, $p_montoTotal, $p_fecha, $p_idUsuario){
        // Consulta SQL para actualizar una factura
        $sql = "UPDATE factura SET
                montoTotal = :p_montoTotal,
                fecha = :p_fecha,
                id = :p_idUsuario
                WHERE idfactura = :p_idfactura;";
        $param = array();
        // Agrega los parámetros de ID, monto total, fecha e ID de usuario a la consulta
        array_push($param, [':p_idfactura', $p_idfactura, PDO::PARAM_INT]);
        array_push($param, [':p_montoTotal', $p_montoTotal, PDO::PARAM_STR]);
        array_push($param, [':p_fecha', $p_fecha, PDO::PARAM_STR]);
        array_push($param, [':p_idUsuario', $p_idUsuario, PDO::PARAM_INT]);
        // Ejecuta la consulta y devuelve el resultado
        return parent::gupdate($sql, $param);
    }

    // Método para eliminar una factura
    public function delete($p_idfactura){
        // Consulta SQL para eliminar una factura
        $sql = "DELETE FROM factura WHERE idfactura = :p_idfactura;";
        $param = array();
        // Agrega el parámetro ID a la consulta
        array_push($param, [':p_idfactura', $p_idfactura, PDO::PARAM_INT]);
        // Ejecuta la consulta y devuelve el resultado
        return parent::gdelete($sql, $param);
    }
}
?>