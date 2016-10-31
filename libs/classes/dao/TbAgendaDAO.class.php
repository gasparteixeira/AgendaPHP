<?php
namespace libs\classes\dao;

use libs\classes\model\TbAgenda;
use libs\utils\Conexao;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TbAgendaDAO
 *
 * @author gaspar
 */
class TbAgendaDAO {
    static $instance;
    
    function __construct() {
        //
    }
    
    static function getInstance() {
        if(!isset(self::$instance)) 
            self::$instance = new TbAgendaDAO();
        
        return self::$instance;
    }
    
    
    function adicionar(TbAgenda $agenda) {
        try {
            $sql = "insert into tb_agenda(evento, data, local, descricao) values (:evento, :data, :local, :descricao)";
            $stmt = Conexao::getInstance()->prepare($sql);
            $stmt->bindValue(":evento", $agenda->getEvento());
            $stmt->bindValue(":data", $agenda->getData());
            $stmt->bindValue(":local", $agenda->getLocal());
            $stmt->bindValue(":descricao", $agenda->getDescricao());
            return $stmt->execute();
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }
    
    function listarPorData($data) {
        try {
            $sql = "select * from tb_agenda where DATE(data) = '{$data}' ";
            $stmt = Conexao::getInstance()->query($sql);
            $result = $stmt->fetchAll( \PDO::FETCH_ASSOC );
            return $this->montar($result);
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }
    
    function listarPorMes($data) {
        $ano  = date('Y', $data);
        $mes  = date('m', $data);
        try {
            $sql = "select * from tb_agenda where YEAR(data) = {$ano}  and MONTH(data) = {$mes} ";
            $stmt = Conexao::getInstance()->query($sql);
            $result = $stmt->fetchAll( \PDO::FETCH_ASSOC );
            return $this->montar($result);
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }
    
    
    function montar($rows) {
        $obj = array();

        foreach ($rows as $key => $row) {
            $a = new TbAgenda();
            $a->setId($row['id']);
            $a->setEvento($row['evento']);
            $a->setData($row['data']);
            $a->setLocal($row['local']);
            $a->setDescricao($row['descricao']);
            $a->setAtivo($row['ativo']);
            $obj[$key] = $a;
        }
        return $obj;
    }
}
