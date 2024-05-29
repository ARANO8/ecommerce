<?php

require_once 'conectar.php';
include_once './../config/global.php';




class ModeloBasePDO
{
    private $secret_key;
    private $conectar;
    protected $_db;

    public function __construct()
    {
        $this->conectar = new Conectar();
        $this->secret_key = SECRET_KEY;
        $this->_db = $this->conectar->conexionPDO();
    }

    function loadparam($result, $param)
    {
        // la linea hace 
        foreach ($param as $value) {
            if (isset($value[2])) {
                $result->bindValue($value[0], $value[1], $value[2]);
            } else {

                $result->bindValue($value[0], $value[1]);
            }
        }

    }

    function gselect($query, $param)
    {
        $array = array();
        try {
            $result = $this->_db->prepare($query);

            $this->loadparam($result, $param);

            $result->execute();
            http_response_code(200);
            $array['TOKEN'] = $this->generatetoken();
            $array['DATA'] = $result->fetchAll(PDO::FETCH_ASSOC);
            $array['ESTADO'] = true;
            $array['NRO'] = count($array['DATA']);
        } catch (PDOException $e) {
            http_response_code(401);
            $array['ESTADO'] = false;
            $array['ERROR'] = $e->getMessage();
        }
        return $array;
    }
    function glastid($query)
    {
        $array = array();
        try {
            // Preparar la consulta
            $result = $this->_db->prepare($query);

            // Ejecutar la consulta
            $result->execute();

            // Configurar el código de respuesta HTTP
            http_response_code(200);

            // Rellenar el array de resultados
            $array['TOKEN'] = $this->generatetoken(); // Asumiendo que esta función sigue siendo necesaria
            $array['DATA'] = $result->fetchAll(PDO::FETCH_ASSOC);
            $array['ESTADO'] = true;
            $array['NRO'] = count($array['DATA']);
        } catch (PDOException $e) {
            // Configurar el código de respuesta HTTP en caso de error
            http_response_code(401);

            // Rellenar el array de errores
            $array['ESTADO'] = false;
            $array['ERROR'] = $e->getMessage();
        }
        return $array;
    }


    function ginsert($query, $param)
    {
        $array = array();
        try {
            $result = $this->_db->prepare($query);
            $this->loadparam($result, $param);
            $result->execute();
            $array['ESTADO'] = true;

        } catch (PDOException $e) {
            $array['ESTADO'] = false;
            $array['ERROR'] = $e->getMessage();
        }
        return $array;
    }

    function gupdate($query, $param)
    {
        $array = array();
        try {
            $result = $this->_db->prepare($query);
            $this->loadparam($result, $param);
            $result->execute();
            $array['ESTADO'] = true;
        } catch (PDOException $e) {
            $array['ESTADO'] = false;
            $array['ERROR'] = $e->getMessage();
        }
        return $array;
    }

    function gdelete($query, $param)
    {
        $array = array();
        try {
            $result = $this->_db->prepare($query);
            $this->loadparam($result, $param);
            $result->execute();
            $array['ESTADO'] = true;
        } catch (PDOException $e) {
            $array['ESTADO'] = false;
            $array['ERROR'] = $e->getMessage();
        }
        return $array;
    }

    function gprocedure($query, $param)
    {
        $array = array();
        try {
            $result = $this->_db->prepare($query);
            $this->loadparam($result, $param);
            $result->execute();
            $array['ESTADO'] = true;

        } catch (PDOException $e) {
            $array['ESTADO'] = false;
            $array['ERROR'] = $e->getMessage();
        }
        return $array;
    }

    function gprocedureSelect($query, $param)
    {
        $array = array();
        try {
            $result = $this->_db->prepare($query);
            $this->loadparam($result, $param);
            $result->execute();
            $array['ESTADO'] = true;
            $array['DATA'] = $result->fetchAll(PDO::FETCH_ASSOC);
            $array['NRO'] = count($array['DATA']);
        } catch (PDOException $e) {
            $array['ESTADO'] = false;
            $array['ERROR'] = $e->getMessage();
        }
        return $array;
    }


    function utf8_converter($array)
    {
        array_walk_recursive($array, function (&$item, $key) {
            if (!mb_detect_encoding($item, 'utf-8', true)) {
                $item = utf8_encode($item);
            }
        });

        return $array;
    }
    function settings()
    {
        if (isset($_SERVER['HTTP_ORIGIN'])) {
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400');    // cache for 1 day
        }

        // Access-Control headers are received during OPTIONS requests
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
                header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
                header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

            exit(0);
        }

    }
    function generatetoken()
    {


        $iat = time(); // time of token issued at
        $nbf = $iat + 0; //not before in seconds
        $exp = $iat + 1800; // expire time of token in seconds


        return 'TOKEN';
    }

}
