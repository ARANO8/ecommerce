<?php 
include_once "../core/ModeloBasePDO.php";
class Seg_incluyeModel extends ModeloBasePDO {

    public function __construct(){
        parent::__construct();
    }
    public function findall(){
        $sql="SELECT idcategoria, idproducto FROM incluye;";
        $param=array();
        return parent::gselect($sql, $param);
    }
    public function findid($p_id){
        $sql="SELECT idcategoria, idproducto
        FROM incluye
        WHERE idcategoria = :p_id;";
        $param=array();
        array_push($param, [':p_id', $p_id, PDO::PARAM_INT]);
        return parent::gselect($sql, $param);
    }
    public function findpaginateall($p_filtro, $p_limit, $p_offset){
        $sql="SELECT idcategoria, idproducto
        FROM incluye
        WHERE upper(concat(IFNULL(idcategoria,''),IFNULL(idproducto,''))) LIKE concat('%',upper(IFNULL(:p_filtro,'')),'%')
        LIMIT :p_limit
        OFFSET :p_offset ;";
        $param=array();
        array_push($param, [':p_filtro', $p_filtro, PDO::PARAM_STR]);
        array_push($param, [':p_limit', $p_limit, PDO::PARAM_INT]);
        array_push($param, [':p_offset', $p_offset, PDO::PARAM_INT]);
        $var=parent::gselect($sql, $param);

        $sqlcount="SELECT COUNT(1) AS cantCategorias
        FROM categoria
        WHERE upper(concat(IFNULL(idcategoria,''),IFNULL(idproducto,''))) LIKE concat('%',upper(IFNULL(:filtro,'')),'%');";
        $param=array();
        array_push($param, [':p_filtro', $p_filtro, PDO::PARAM_STR]);
        $var1 = parent::gselect($sqlcount, $param);
        $var['LENGTH']=$var1['DATA'][0]['cantIncluye'];
        return $var;
    }
    public function insert($p_idcategoria, $p_idproducto){
        $sql="INSERT INTO incluye(idcategoria, idproducto)
        VALUES (:p_idcategoria,:p_idproducto);";
        $param=array();
        array_push($param, [':p_idcategoria', $p_idcategoria, PDO::PARAM_INT]);
        array_push($param, [':p_idproducto', $p_idproducto, PDO::PARAM_INT]);
        return parent::ginsert($sql, $param);
    } 
    public function update($p_id,$p_idcategoria, $p_idproducto){
        $sql="UPDATE incluye SET
        idcategoria=:p_idcategoria,
        idproducto=:p_idproducto
        WHERE idcategoria=:p_id;";
        $param=array();
        array_push($param, [':p_id', $p_id, PDO::PARAM_INT]);
        array_push($param, [':p_idcategoria', $p_idcategoria, PDO::PARAM_INT]);
        array_push($param, [':p_idproducto', $p_idproducto, PDO::PARAM_INT]);
        return parent::gupdate($sql, $param);
    }
    public function delete($p_id){
        $sql="DELETE FROM incluye WHERE idcategoria = :p_id;";
        $param=array();
        array_push($param, [':p_id', $p_id, PDO::PARAM_INT]);
        return parent::gdelete($sql, $param);
    }






}


?>