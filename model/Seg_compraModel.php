<?php 
include_once "../core/ModeloBasePDO.php";
class Seg_compraModel extends ModeloBasePDO {

    public function __construct(){
        parent::__construct();
    }
    public function findall(){
        $sql="SELECT `idproducto`, `idfactura`, `precioventa`, `cantidad` FROM `compra`;";
        $param=array();
        return parent::gselect($sql, $param);
    }
    public function findid($p_idproducto, $p_idfactura){
        $sql="SELECT `idproducto`, `idfactura`, `precioventa`, `cantidad`
        FROM `compra`
        WHERE idproducto = :p_idproducto AND idfactura=:p_idfactura;";
        $param=array();
        array_push($param, [':p_idproducto', $p_idproducto, PDO::PARAM_INT]);
        array_push($param, [':p_idfactura', $p_idfactura, PDO::PARAM_INT]);
        return parent::gselect($sql, $param);
    }
    public function findpaginateall($p_filtro, $p_limit, $p_offset){
        $sql="SELECT `idproducto`, `idfactura`, `precioventa`, `cantidad`
        FROM `compra`
        WHERE upper(concat(IFNULL(idproducto,''),IFNULL(idfactura,''),IFNULL(precioventa,''),IFNULL(cantidad,'')))
        LIKE concat('%',upper(IFNULL(:p_filtro,'')),'%')
        LIMIT :p_limit
        OFFSET :p_offset ;";
        $param=array();
        array_push($param, [':p_filtro', $p_filtro, PDO::PARAM_STR]);
        array_push($param, [':p_limit', $p_limit, PDO::PARAM_INT]);
        array_push($param, [':p_offset', $p_offset, PDO::PARAM_INT]);
        $var=parent::gselect($sql, $param);

        $sqlcount="SELECT COUNT(1) AS cantCompras
        FROM `categoria`
        WHERE upper(concat(IFNULL(idproducto,''),IFNULL(idfactura,''),IFNULL(precioventa,''),IFNULL(cantidad,'')))
        LIKE concat('%',upper(IFNULL(:p_filtro,'')),'%')";
        $param=array();
        array_push($param, [':p_filtro', $p_filtro, PDO::PARAM_STR]);
        $var1 = parent::gselect($sqlcount, $param);
        $var['LENGTH']=$var1['DATA'][0]['cantCompras'];
        return $var;
    }
    public function insert($p_idproducto, $p_idfactura, $p_precioventa, $p_cantidad){
        $sql="INSERT INTO `compra`(`idproducto`, `idfactura`, `precioventa`, `cantidad`) VALUES
        (:p_idproducto, :p_idfactura, :p_precioventa, :p_cantidad)";
        $param=array();
        array_push($param, [':p_idproducto', $p_idproducto, PDO::PARAM_INT]);
        array_push($param, [':p_idfactura', $p_idfactura, PDO::PARAM_INT]);
        array_push($param, [':p_precioventa', $p_precioventa]);
        array_push($param, [':p_cantidad', $p_cantidad, PDO::PARAM_INT]);
        return parent::ginsert($sql, $param);
    } 
    public function update($p_idproducto, $p_idfactura, $p_precioventa, $p_cantidad){
        $sql="UPDATE `compra`SET
        `idproducto`=:p_idproducto,
        `idfactura`=p_idfactura,
        `precioventa`=:p_precioventa,
        `cantidad`=:p_cantidad
        WHERE idproducto=:p_idproducto AND idfactura=:p_idfactura;";
        $param=array();
        array_push($param, [':p_idproducto', $p_idproducto, PDO::PARAM_INT]);
        array_push($param, [':p_idfactura', $p_idfactura, PDO::PARAM_INT]);
        array_push($param, [':p_precioventa', $p_precioventa]);
        array_push($param, [':p_cantidad', $p_cantidad, PDO::PARAM_INT]);
        return parent::gupdate($sql, $param);
    }
    public function delete($p_idproducto, $p_idfactura){
        $sql="DELETE FROM `compra` WHERE idproducto=:p_idproducto AND idfactura=:p_idfactura";
        $param=array();
        array_push($param, [':p_idproducto', $p_idproducto, PDO::PARAM_INT]);
        array_push($param, [':p_idfactura', $p_idfactura, PDO::PARAM_INT]);
        return parent::gdelete($sql, $param);
    }






}


?>