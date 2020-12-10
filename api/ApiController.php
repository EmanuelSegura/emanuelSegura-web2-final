<?php

require_once "Model/lotesModel.php";
require_once "Controller/Controller.php";
require_once "api/ApiView.php";

class ApiController
{
    private $lotesModel;
    private $Controller;
    private $view;
    private $data;

    function __construct(){
        $this->lotesModel= new LotesModel();
       $this->Controller= new Controller();
        $this->view= new APIView();
        $this->data= file_get_contents('php://input');
    }

    function getData(){
        return json_decode($this->data);
    }

    public function get($params = null) {
        $idLote = $params[':ID'];
        $lote = $this->model->get($idLote);
        if ($lote)
            $this->view->response($lote, 200);
        else
            $this->view->response("El lote con el id=$idLote no existe", 404);
    }


    public function getDisponibles($params = null){
        $lotes = $this->model->getDisponibles();
        if ($lotes)
            $this->view->response($lotes, 200);
        else
            $this->view->response("No hay lotes disponibles", 404);
    }
    

    public function updateEstadoLote($params = null) {
        $idLote = $params[':ID'];
        $body = $this->getData();

        $usado =     $body->usado;

        $success = $this->model->updateEstadoLote($usado);

        if ($success) {
            $this->view->response("Se actualizó el estado del lote $idLote exitosamente", 200);
        }
        else { 
            $this->view->response("No se pudo actualizar el estado del lote", 500);
        }
    }

    
}
