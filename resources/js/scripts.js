/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var Agenda = {
    
    criarLink: function() {
        $.each($(".calendario td"), function(indice, valor){
            if($.isNumeric($(valor).text())) {
                $(valor).addClass("clicavel");
            }
        });
    }
    
};

(function($) {
    "use strict";
    Agenda.criarLink();
})(jQuery);