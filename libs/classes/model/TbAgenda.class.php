<?php
namespace libs\classes\model;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TbAgenda
 *
 * @author gaspar
 */
class TbAgenda {

    private $id;
    private $evento;
    private $data;
    private $local;
    private $descricao;
    private $ativo;

    function getId() {
        return $this->id;
    }

    function getEvento() {
        return $this->evento;
    }

    function getData() {
        return $this->data;
    }

    function getLocal() {
        return $this->local;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getAtivo() {
        return $this->ativo;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setEvento($evento) {
        $this->evento = $evento;
    }

    function setData($data) {
        $this->data = $data;
    }

    function setLocal($local) {
        $this->local = $local;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setAtivo($ativo) {
        $this->ativo = $ativo;
    }

}
