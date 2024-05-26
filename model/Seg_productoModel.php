<?php

include_once "../core/ModeloBasePDO.php";
class Seg_productoModel extends ModeloBasePDO
{
    public function __construct()
    {
        parent::__construct();
    }
    //Obtiene todos los productos
    public function findall()
    {
        $sql = " SELECT idproducto, nombre, precio, stock, descripcion, idimgprod FROM producto ";
        $param = array();
        return parent::gselect($sql, $param);
    }
    //Obtiene todos los productos con paginación y filtrado
    public function findpaginateall($p_filtro, $p_limit, $p_offset)
    {
        $sql = " SELECT idproducto, nombre, precio, stock, descripcion, idimgprod FROM producto
        WHERE upper(concat(IFNULL(idproducto,''),IFNULL(nombre,''),IFNULL(precio,''),IFNULL(stock,''),IFNULL(descripcion,''),IFNULL(idimgprod,''))) like  CONCAT('%',upper(IFNULL(:p_filtro,'' )), '%') 
        limit :p_limit 
        offset :p_offset  ";
        $param = array();
        array_push($param, [':p_filtro', $p_filtro, PDO::PARAM_STR]);
        array_push($param, [':p_limit', $p_limit, PDO::PARAM_INT]);
        array_push($param, [':p_offset', $p_offset, PDO::PARAM_INT]);
        $var =  parent::gselect($sql, $param);
        $sqlCount = "SELECT count(1) as cant FROM producto 
        WHERE upper(concat(IFNULL(idproducto,''),IFNULL(nombre,''),IFNULL(precio,''),IFNULL(stock,''),IFNULL(descripcion,''),IFNULL(idimgprod,''))) like  CONCAT('%',upper(IFNULL(:p_filtro,'' )), '%') ";
        $param = array();
        array_push($param, [':p_filtro', $p_filtro, PDO::PARAM_STR]);
        $var1 =  parent::gselect($sqlCount, $param);
        $var['LENGTH'] = $var1['DATA'][0]['cant'];
        return $var;
    }
    //Obtiene un producto por su ID
    function findId($p_idproducto)
    {
        $sql = " SELECT idproducto, nombre, precio, stock, descripcion, idimgprod FROM producto
        WHERE idproducto = :p_idproducto";
        $param = array();
        array_push($param, [':p_idproducto', $p_idproducto, PDO::PARAM_STR]);

        return parent::gselect($sql, $param);
    }
    //Inserta un producto
    public function insert($p_nombre, $p_precio, $p_stock, $p_descripcion, $p_idimgprod)
    {
        $sql = " INSERT INTO producto (nombre, precio, stock, descripcion, idimgprod) VALUES (:p_nombre, :p_precio, :p_stock, :p_descripcion, :p_idimgprod) ";
        $param = array();

        array_push($param, [':p_nombre', $p_nombre, PDO::PARAM_STR]);
        array_push($param, [':p_precio', $p_precio, PDO::PARAM_STR]);
        array_push($param, [':p_stock', $p_stock, PDO::PARAM_STR]);
        array_push($param, [':p_descripcion', $p_descripcion, PDO::PARAM_STR]);
        array_push($param, [':p_idimgprod', $p_idimgprod, PDO::PARAM_INT]);

        return parent::ginsert($sql, $param);
    }
    //Actualiza datos de un usuario
    public function update($p_idproducto, $p_nombre, $p_precio, $p_stock, $p_descripcion, $p_idimgprod)
    {
        $sql = "UPDATE producto SET 
                            nombre=:p_nombre,
                            precio=:p_precio,
                            stock=:p_stock,
                            descripcion=:p_descripcion,
                            idimgprod=:p_idimgprod
                        WHERE idproducto = :p_idproducto";
        $param = array();
        array_push($param, [':p_idproducto', $p_idproducto, PDO::PARAM_STR]);
        array_push($param, [':p_nombre', $p_nombre, PDO::PARAM_STR]);
        array_push($param, [':p_precio', $p_precio, PDO::PARAM_STR]);
        array_push($param, [':p_stock', $p_stock, PDO::PARAM_STR]);
        array_push($param, [':p_descripcion', $p_descripcion, PDO::PARAM_STR]);
        array_push($param, [':p_idimgprod', $p_idimgprod, PDO::PARAM_INT]);

        return parent::gupdate($sql, $param);
    }
    //Elimina un producto por su ID
    function delete($p_idproducto)
    {
        $sql = "DELETE FROM producto WHERE idproducto = :p_idproducto";
        $param = array();
        array_push($param, [':p_idproducto', $p_idproducto, PDO::PARAM_STR]);


        return parent::gdelete($sql, $param);
    }
}
