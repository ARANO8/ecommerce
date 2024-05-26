<?php 
include_once "../core/ModeloBasePDO.php";
class Seg_categoriaModel extends ModeloBasePDO {

    public function __construct(){
        parent::__construct();
    }
    public function findall(){
        $sql="SELECT  idcategoria ,  nombreC  FROM  categoria; ";
        $param=array();
        return parent::gselect($sql, $param);
    }
    public function findid($p_idcategoria){
        $sql="SELECT `idcategoria`, `nombreC`
        FROM `categoria`
        WHERE idcategoria=:p_idcategoria; ";
        $param=array();
        array_push($param,[':p_idcategoria',$p_idcategoria,PDO::PARAM_INT]);
        return parent::gselect($sql, $param);
    }
    public function findpaginateall($p_filtro, $p_limit, $p_offset){
        $sql="SELECT `idcategoria`, `nombreC`
        FROM `categoria`
        WHERE upper(concat(IFNULL(idcategoria,''),IFNULL(nombreC,''))) LIKE concat('%',upper(IFNULL(:p_filtro,'')),'%')
        LIMIT :p_limit
        OFFSET :p_offset ;";
        $param=array();
        array_push($param, [':p_filtro', $p_filtro, PDO::PARAM_STR]);
        array_push($param, [':p_limit', $p_limit, PDO::PARAM_INT]);
        array_push($param, [':p_offset', $p_offset, PDO::PARAM_INT]);
        $var=parent::gselect($sql, $param);

        $sqlcount="SELECT COUNT(1) AS cantCategorias
        FROM `categoria`
        WHERE upper(concat(IFNULL(idcategoria,''),IFNULL(nombreC,''))) LIKE concat('%',upper(IFNULL(:filtro,'')),'%');";
        $param=array();
        array_push($param, [':p_filtro', $p_filtro, PDO::PARAM_STR]);
        $var1 = parent::gselect($sqlcount, $param);
        $var['LENGTH']=$var1['DATA'][0]['cantCategorias'];
        return $var;
    }
    public function insert($p_nombreC){
        $sql="INSERT INTO `categoria`(`nombreC`) VALUES (:p_nombreC)";
        $param=array();
        array_push($param, [':p_nombreC', $p_nombreC, PDO::PARAM_STR]);
        return parent::ginsert($sql, $param);
    } 
    public function update($p_idcategoria,$p_nombreC){
        $sql="UPDATE `categoria` SET
        `nombreC`= :p_nombreC
        WHERE idcategoria= :p_idcategoria;";
        $param=array();
        array_push($param, [':p_idcategoria', $p_idcategoria, PDO::PARAM_INT]);
        array_push($param, [':p_nombreC', $p_nombreC, PDO::PARAM_STR]);
        return parent::gupdate($sql, $param);
    }
    public function delete($p_idcategoria){
        $sql="DELETE FROM `categoria` WHERE idcategoria=:p_idcategoria;";
        $param=array();
        array_push($param, [':p_idcategoria', $p_idcategoria, PDO::PARAM_INT]);
        return parent::gdelete($sql, $param);
    }






}


?>