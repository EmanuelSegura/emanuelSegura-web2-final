<?php

require_once "Model/Model.php";
class lotesModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }


// Verificar que realmente existan la ciudad asociada al lote
    function verificaCiudad($id_ciudad){
        $query = $this->db->prepare('SELECT * FROM ciudad WHERE id = ?');
        $query->execute([$id_ciudad]);
        return $query->rowCount();
    }

    // Verificar que realmente existan el laboratorio asociada al lote
    function verificaLab($id_lab){
        $query = $this->db->prepare('SELECT * FROM laboratorio WHERE id = ?');
        $query->execute([$id_lab]);
        return $query->rowCount();
    }

    // Verificar que la ciudad destino cumple con la temperatura requerida por el lote.
    function verificaTemperatura($id_ciudad){
        $query = $this->db->prepare('SELECT temperatura_conservacion FROM ciudad WHERE id = ?');
        $query->execute([$id_ciudad]);
        return $query->rowCount();
    }


    // La temperatura que tendra el lote a agregar
    function temperaturaLote($id_lab){
        $query = $this->db->prepare('SELECT temperatura_requerida FROM laboratorio WHERE id = ?');
        $query->execute([$id_lab]);
        return $query->rowCount();
    }




}









