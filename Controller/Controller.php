<?php

require_once "View/View.php";
class Controller
{

    private $view;

    public function __construct(){
        $this->view= new View();
    }

    public function ShowHome(){
        $this->view->showHome();
    }

    // asignar un lote al sistema
    public function asignarLote(){
        $nroLote = $_POST['nro_lote'];
        $anioVencimiento = $_POST['año_vencimiento'];
        $id_ciudad = $_POST['id_ciudad'];
        $id_lab = $_POST['id_laboratorio'];

        if(empty($nroLote || $anioVencimiento || $id_ciudad || $id_lab )) {
            $msg = 'Faltan datos obligatorios';
            $this->view->showMsg($msg);
        }else{
            if($_SESSION['ADMIN']==1 && isset($_SESSION['EMAIL'])){
                $verificaCiudad = $this->model->verificaCiudad($id_ciudad);
                $verificaLab = $this->model->verificaLab($id_lab);

                if(isset($verificaCiudad) && (isset($verificaLab))){
                    $existe = true;
                }else{
                    $msg = 'No existe ciudad y/o laboratorio asociado al lote';
                    $this->view->showMsg($msg);
                    }

                    if ($existe){
                        $temp = $this->model->verificaTemperatura($id_ciudad);
                        $tempLote = $this->model->temperaturaLote($id_lab);
                        // Asumo que debian tener la misma temp para que sea correcta la asignacion.
                        if ($temp == $tempLote ){
                            $this->view->asignarLote($nroLote,$anioVencimiento,$id_ciudad,$id_lab);
                        }else{
                            $msg += 'La temperatura asignada al lote es incorrecta.';
                            $this->view->showMsg($msg);
                        }
                    }

            } else{
                $msg = 'Inicie sesion con una cuenta de administrador para efectuar cambios en el sistema';
                $this->view->showMsg($msg);
            }
        }



    }


}

