<?php

namespace libs\utils;


define('DB_SERVER','localhost');
define('DB_USER','root');
define('DB_PASSWORD','root');
define('DB_NAME','db_agenda');

/**
 * Description of TbAgenda
 *
 * @author gaspar
 */

class Conexao {

    static $instance;

    function __construct() {
        
    }

    static function getInstance() {
        if(!isset(self::$instance)) {
            self::$instance = new \PDO("mysql:host=".DB_SERVER.";dbname=".DB_NAME, DB_USER, DB_PASSWORD, 
                    array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            self::$instance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            self::$instance->setAttribute(\PDO::ATTR_ORACLE_NULLS, \PDO::NULL_EMPTY_STRING);
        }
        return self::$instance;
    }
    
}