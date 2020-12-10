<?php

require_once "libs/smarty/Smarty.class.php";
class View
{
    private $smarty;

    function __construct(){
        $this->smarty= new Smarty();
    }

    function showHome(){
        $this->smarty->display('templates/home.tpl');
    }

    function ShowMsj($mensaje){
    }

    // comentado para que no tire error x no tener template
    
    // asignarLote($nroLote,$anioVencimiento,$id_ciudad,$id_lab){
    //     $this->smarty->display('templates/lotes.tpl');
    // }


}
