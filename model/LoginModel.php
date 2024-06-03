<?php
include_once "../core/ModeloBasePDO.php";
class LoginModel extends ModeloBasePDO
{
    public function __construct()
    {
        parent::__construct();
    }
    public function findall()
    {
        $sql = "SELECT email, full_name, password_hash FROM login ";
        $param = array();
        return parent::gselect($sql, $param);
    }
    public function findid($p_email)
    {
        $sql = "SELECT email, full_name, password_hash FROM login
         WHERE email = :p_email  ";
        $param = array();
        array_push($param, [':p_email', $p_email, PDO::PARAM_STR]);
        return parent::gselect($sql, $param);
    }
    public function findpaginateall($p_filtro, $p_limit, $p_offset)
    {
        $sql = "SELECT email, full_name, password_hash FROM login
        WHERE upper(concat(IFNULL(email,''),IFNULL(full_name,''),IFNULL(password_hash,''))) like concat('%',upper(IFNULL(:p_filtro,'')),'%') 
        limit :p_limit
        OFFSET :p_offset  ";
        $param = array();
        array_push($param, [':p_filtro', $p_filtro, PDO::PARAM_STR]);
        array_push($param, [':p_limit', $p_limit, PDO::PARAM_INT]);
        array_push($param, [':p_offset', $p_offset, PDO::PARAM_INT]);
        $var = parent::gselect($sql, $param);

        $sqlCount = "SELECT concat(1) as cant
        FROM login
        WHERE upper(concat(IFNULL(email,''),IFNULL(full_name,''),IFNULL(password_hash,''))) like concat('%',upper(IFNULL(:p_filtro,'')),'%')";
        $param = array();
        array_push($param, [':p_filtro', $p_filtro, PDO::PARAM_STR]);
        $var1 = parent::gselect($sqlCount, $param);
        $var['LENGTH'] = $var1['DATA'][0]['cant'];
        return $var;
    }
    public function verificarlogin($p_email, $p_password_hash)
    {
        $sql = "SELECT email, full_name
            FROM login
            WHERE
            email = :p_email AND 
            password_hash = :p_password_hash";
        $param = array();
        array_push($param, [':p_email', $p_email, PDO::PARAM_STR]);
        array_push($param, [':p_password_hash', $p_password_hash, PDO::PARAM_STR]);
        return parent::gselect($sql, $param);
    }
    public function register($p_email, $p_full_name, $p_password_hash)
    {
        $sql = "INSERT INTO login(email, full_name, password_hash, registration_date) 
        VALUES (:p_email,:p_full_name,:p_password_hash,now())";
        $param = array();
        array_push($param, [':p_email', $p_email, PDO::PARAM_STR]);
        array_push($param, [':p_full_name', $p_full_name, PDO::PARAM_STR]);
        array_push($param, [':p_password_hash', $p_password_hash, PDO::PARAM_STR]);

        return parent::ginsert($sql, $param);
    }
    public function update($p_email, $p_full_name, $p_password_hash)
    {
        $sql = " UPDATE login SET 
                        full_name=:p_fullname,
                        password_hash=:p_password_hash,
                        registration_date=now()";
        $param = array();
        array_push($param, [':p_email', $p_email, PDO::PARAM_STR]);
        array_push($param, [':p_full_name', $p_full_name, PDO::PARAM_STR]);
        array_push($param, [':p_password_hash', $p_password_hash, PDO::PARAM_STR]);
        return parent::gupdate($sql, $param);
    }
    public function delete($p_email)
    {
        $sql = "DELETE FROM  login  WHERE  email = :p_email";
        $param = array();
        array_push($param, [':p_email', $p_email, PDO::PARAM_STR]);
        return parent::gdelete($sql, $param);
    }
}