<?php

include_once "../core/ModeloBasePDO.php";
class Seg_usuarioModel extends ModeloBasePDO
{
    public function __construct()
    {
        parent::__construct();
    }
    //Obtiene todos los usuarios
    public function findall()
    {
        $sql = " SELECT id, nombre, correo, user, password, direccion, fotoperfil, cliente, vendedor FROM usuario ";
        $param = array();
        return parent::gselect($sql, $param);
    }
    //Obtiene todas los usuarios con paginación y filtrado
    public function findpaginateall($p_filtro, $p_limit, $p_offset)
    {
        $sql = " SELECT id, nombre, correo, user, password, direccion, fotoperfil, cliente, vendedor FROM usuario
        WHERE upper(concat(IFNULL(id,''),IFNULL(nombre,''),IFNULL(correo,''),IFNULL(user,''),IFNULL(password,''),IFNULL(direccion,''),IFNULL(fotoperfil,''),IFNULL(cliente,''),IFNULL(vendedor,''))) like  CONCAT('%',upper(IFNULL(:p_filtro,'' )), '%') 
        limit :p_limit 
        offset :p_offset  ";
        $param = array();
        array_push($param, [':p_filtro', $p_filtro, PDO::PARAM_STR]);
        array_push($param, [':p_limit', $p_limit, PDO::PARAM_INT]);
        array_push($param, [':p_offset', $p_offset, PDO::PARAM_INT]);
        $var =  parent::gselect($sql, $param);
        $sqlCount = "SELECT count(1) as cant FROM usuario 
        WHERE upper(concat(IFNULL(id,''),IFNULL(nombre,''),IFNULL(correo,''),IFNULL(user,''),IFNULL(password,''),IFNULL(direccion,''),IFNULL(fotoperfil,''),IFNULL(cliente,''),IFNULL(vendedor,''))) like  CONCAT('%',upper(IFNULL(:p_filtro,'' )), '%') ";
        $param = array();
        array_push($param, [':p_filtro', $p_filtro, PDO::PARAM_STR]);
        $var1 =  parent::gselect($sqlCount, $param);
        $var['LENGTH'] = $var1['DATA'][0]['cant'];
        return $var;
    }
    //Obtiene un usuario por su ID
    function findId($p_id)
    {
        $sql = " SELECT id, nombre, correo, user, password, direccion, fotoperfil, cliente, vendedor FROM usuario
        WHERE id = :p_id";
        $param = array();
        array_push($param, [':p_id', $p_id, PDO::PARAM_STR]);

        return parent::gselect($sql, $param);
    }
    //Inserta un usuario
    public function insert($p_id, $p_nombre, $p_correo, $p_user, $p_password, $p_direccion, $p_fotoperfil, $p_cliente, $p_vendedor)
    {
        $sql = " INSERT INTO usuario(id, nombre, correo, user, password, direccion, fotoperfil, cliente, vendedor) VALUES (:p_id, :p_nombre, :p_correo, :p_user, :p_password, :p_direccion, :p_fotoperfil, :p_cliente, :p_vendedor) ";
        $param = array();
        array_push($param, [':p_id', $p_id, PDO::PARAM_STR]);

        array_push($param, [':p_nombre', $p_nombre, PDO::PARAM_STR]);

        array_push($param, [':p_correo', $p_correo, PDO::PARAM_STR]);

        array_push($param, [':p_user', $p_user, PDO::PARAM_STR]);

        array_push($param, [':p_password', $p_password, PDO::PARAM_STR]);

        array_push($param, [':p_direccion', $p_direccion, PDO::PARAM_INT]);

        array_push($param, [':p_fotoperfil', $p_fotoperfil, PDO::PARAM_STR]);

        array_push($param, [':p_cliente', $p_cliente, PDO::PARAM_STR]);

        array_push($param, [':p_vendedor', $p_vendedor, PDO::PARAM_STR]);

        return parent::ginsert($sql, $param);
    }
    //Actualiza datos de un usuario
    public function update($p_id, $p_nombre, $p_correo, $p_user, $p_password, $p_direccion, $p_fotoperfil, $p_cliente, $p_vendedor)
    {
        $sql = "UPDATE usuario SET id=':p_id',nombre=:p_nombre,correo=:p_correo,user=:p_user,password=:p_password,direccion=:p_direccion,fotoperfil=:p_fotoperfil,cliente=:p_cliente,vendedor=:p_vendedor
        WHERE id = :p_id";
        $param = array();
        array_push($param, [':p_id', $p_id, PDO::PARAM_STR]);

        array_push($param, [':p_nombre', $p_nombre, PDO::PARAM_STR]);

        array_push($param, [':p_correo', $p_correo, PDO::PARAM_STR]);

        array_push($param, [':p_user', $p_user, PDO::PARAM_STR]);

        array_push($param, [':p_password', $p_password, PDO::PARAM_STR]);

        array_push($param, [':p_direccion', $p_direccion, PDO::PARAM_INT]);

        array_push($param, [':p_fotoperfil', $p_fotoperfil, PDO::PARAM_STR]);

        array_push($param, [':p_cliente', $p_cliente, PDO::PARAM_STR]);

        array_push($param, [':p_vendedor', $p_vendedor, PDO::PARAM_STR]);


        return parent::gupdate($sql, $param);
    }
    //Elimina un usuario por su ID
    function delete($p_id)
    {
        $sql = "DELETE FROM usuario WHERE id = :p_id";
        $param = array();
        array_push($param, [':p_id', $p_id, PDO::PARAM_STR]);


        return parent::gdelete($sql, $param);
    }
    //=========FALTA COLUMNA ESTADO===========

    //Verifica la sesion de un usuario por su email y password
    /*public function verificarlogin($p_correo, $p_password)
    {
        $sql = "SELECT id, nombre, correo, user, password, direccion, fotoperfil, cliente, vendedor,FALTAESTADO
        FROM usuario
    WHERE estado = 'ACTIVO' AND 
    email = :p_correo AND 
    psw = :p_password";
        $param = array();
        array_push($param, [':p_correo', $p_correo, PDO::PARAM_STR]);
        array_push($param, [':p_password', $p_password, PDO::PARAM_STR]);
        return parent::gselect($sql, $param);
    }*/

    //Registra un nuevo usuario
    /*public function register($p_cod_usu, $p_psw, $p_email, $p_estado, $p_usu_cre)
    {
        $sql = " INSERT INTO seg_usuario
         (cod_usu,psw,email,estado,usu_cre,fh_cre) 
 VALUES (:p_cod_usu,:p_psw,:p_email,:p_estado,:p_usu_cre,now()) ";
        $param = array();
        array_push($param, [':p_cod_usu', $p_cod_usu, PDO::PARAM_STR]);
        array_push($param, [':p_psw', $p_psw, PDO::PARAM_STR]);
        array_push($param, [':p_email', $p_email, PDO::PARAM_STR]);
        array_push($param, [':p_estado', $p_estado, PDO::PARAM_STR]);
        array_push($param, [':p_usu_cre', $p_usu_cre, PDO::PARAM_STR]);
        return parent::ginsert($sql, $param);
    }*/
}
