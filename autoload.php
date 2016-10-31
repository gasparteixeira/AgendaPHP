<?php


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function __autoload($classe) {
    
    $classe = WWW_RAIZ . SP . str_replace("\\", SP, $classe). '.class.php';
    
    if(!file_exists($classe) && !endsWith($classe, "PDO.class.php")) {
        throw new Exception("A classe '{$classe}' não foi localizada.");
    }
    
    if(!endsWith($classe, "PDO.class.php")) 
       require_once($classe);
}

function endsWith($haystack, $needle) {
    return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== false);
}