<?php
namespace libs\ifaces;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author gaspar
 */
interface AgendaIface {
    
    const ABRE_TABLE = "<table class='table  calendario'>";
    const FECHA_TABELA = "</table>";
    const ABRE_LINHA = "<tr>";
    const FECHA_LINHA = "</tr>";
    const ABRE_COLUNA = "<td>";
    const ABRE_LINK = "<a href='?d=%s'>";
    const FECHA_LINK = "</a>";
    const FECHA_COLUNA = "</td>";
    const ABRE_COLUNA_CINCO = "<td colspan='5'>";
    const LINK_ANTERIOR = "<a href='?d=%s' class='btn btn-default anterior'><i class='fa fa-chevron-left'></i></a>";
    const LINK_PROXIMO = "<a href='?d=%s' class='btn btn-default anterior'><i class='fa fa-chevron-right'></i></a>";
}
