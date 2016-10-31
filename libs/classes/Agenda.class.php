<?php

namespace libs\classes;

use libs\ifaces\AgendaIface;
use libs\classes\dao\TbAgendaDAO;
use libs\classes\model\TbAgenda;


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Agenda
 *
 * @author gaspar
 */
class Agenda  implements AgendaIface {

    private $diasNaSemana;
    private $mesesDoAno;
    private $dao;
    

    function __construct() {
        $this->diasNaSemana = array("DOM", "SEG", "TER", "QUA", "QUI", "SEX", "SAB");
        $this->mesesDoAno = array("Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho",
            "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro");
        
        $this->dao = new TbAgendaDAO();
    }
    
    
    function tempo($d) {
        return strtotime($d);
    }

    function desenharCalendario($data = null) {
        if (!isset($data))
            $data = time();

        $eventosNoMes = $this->eventosNoMes($data);
        $controlaInicio = true;
        $controlaUltimo = true;

        $primeiroDia = $this->primeiroDiaDoMes($data) + 1;
        $ultimoDia = $this->ultimoDiaDoMes($data);
        $anoMes = date('Y-m', $data);

        // desenhando a tabela
        $html = self::ABRE_TABLE;
        $html .= self::ABRE_LINHA;

        // desenha a linha do mês
        $html .= self::ABRE_COLUNA . sprintf(self::LINK_ANTERIOR, $this->mesAnterior($data)) . self::FECHA_COLUNA;
        $html .= self::ABRE_COLUNA_CINCO . $this->mesesDoAno[$this->mesCorrente($data) - 1] . '/' . $this->anoCorrente($data) . self::FECHA_COLUNA;
        $html .= self::ABRE_COLUNA . sprintf(self::LINK_PROXIMO, $this->proximoMes($data)) . self::FECHA_COLUNA;
        $html .= self::FECHA_LINHA . self::ABRE_LINHA;
        //desenha a linha da semana;
        foreach ($this->diasNaSemana as $dia):
            $html .= self::ABRE_COLUNA . $dia . self::FECHA_COLUNA;
        endforeach;
        $html .= self::FECHA_LINHA . self::ABRE_LINHA;
        for ($d = 0; $d < $ultimoDia; $d++) :
            if ($d < $primeiroDia && $controlaInicio) :
                $html .= self::ABRE_COLUNA . self::FECHA_COLUNA;
            else:
                $controlaInicio = false;
                $dia = (($d - $primeiroDia) + 1);
                $html .= self::ABRE_COLUNA;
                $html .= ($this->temEventoNesteDia($dia, $eventosNoMes) ? sprintf(self::ABRE_LINK, $this->formatarData($data, $dia)) . $dia . self::FECHA_LINK : $dia);
                $html .= self::FECHA_COLUNA;
            endif;

            if ($d % 7 == 0)
                $html .= self::FECHA_LINHA . self::ABRE_LINHA;
            if ($d == ($ultimoDia - 1) && $controlaUltimo) {
                $controlaUltimo = false;
                $ultimoDia = $ultimoDia + $primeiroDia;
            }
        endfor;
        $html .= self::FECHA_LINHA;
        $html .= self::FECHA_LINHA;
        $html .= self::FECHA_TABELA;
        return $html;
    }
    
    function eventosNaData($data) {
        if($this->dataValida($data)) {
           return $this->dao->listarPorData($data);
        }
    }

    function primeiroDiaDoMes($data) {
        $primeiraData = strtotime('first day of this month', $data);
        return date('w', $primeiraData);
    }

    function ultimoDiaDoMes($data) {
        return date('t', $data);
    }

    function mesCorrente($data) {
        return date('n', $data);
    }
    
    function anoCorrente($data) {
        return date('Y', $data);
    }
    
    function proximoMes($data) {
        return date('Y-m', strtotime('+1 month', $data));
    }
    function  mesAnterior($data) {
        return date('Y-m', strtotime('-1 month', $data));
    }
            
    function eventosNoMes($data) {
        return $this->dao->listarPorMes($data);
    }
    
    function formatarData($data, $dia) {
        if($dia < 10) 
            $dia = '0'.$dia;
        return date("Y-m-{$dia}", $data);
    }
    
    function temEventoNesteDia($dia, $eventos) {
        if(empty($eventos))
            return false;
        
        foreach ($eventos as $evento) : 
            $data = date('d', strtotime($evento->getData()));
            if($dia == $data) {
                return true;
            }
        endforeach;
    }
    
    function dataValida($data, $formato = 'Y-m-d') {
        $d = \DateTime::createFromFormat($formato, $data);
        return $d && $d->format($formato) == $data;
    }

}
