<?php
class Materiales extends Controller
{
    public function __construct()
    {
        session_start();
        parent::__construct();
    }
    public function index()
    {
        if (empty($_SESSION['activo'])) {
            header("location: ".base_url);
        }
        $this->views->getViews($this, "index");
    }
    public function listar()
    {
        $data = $this->model->getMateriales();
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge bg-success">Activo</span>';
                $data[$i]['acciones'] ='<div style="display: flex; justify-content: center;">
                <button class="btn btn-primary" type="button" onclick="btnEditarMate(' . $data[$i]['id'] . ');" style="padding: 9px; margin-right: 3px;"><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger" type="button" onclick="btnEliminarMate(' . $data[$i]['id'] . ');" style="padding: 9px; margin-left: 3px;"><i class="fas fa-ban"></i></button>
            </div>';
            
           

            } else {
                $data[$i]['estado'] = '<span class="badge bg-danger">Inactivo</span>';
                $data[$i]['acciones'] = '<div><button class="btn btn-success" type="button" onclick="btnReingresarMate(' . $data[$i]['id'] . ');"><i class="fas fa-check"></i></button></div>';
            }
            
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function registrar()
    {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $cantidad = $_POST['cantidad'];
        $precioBajo = $_POST['precioBajo'];
        $precioMedio = $_POST['precioMedio'];
        $precioAlto = $_POST['precioAlto'];
        if (empty($nombre) || empty($cantidad) || empty($precioBajo) || empty($precioMedio) || empty($precioAlto)) {
            $msg = "Todos los campos son obligatorios";
        } else {
            if ($id == "") {
                    $data = $this->model->registrarMaterial($nombre, $cantidad, $precioBajo, $precioMedio, $precioAlto);
                    if ($data == "ok") {
                        $msg = "si";
                    } else if ($data == "existe") {
                        $msg = "El Material ya existe";
                    } else {
                        $msg = "Error al registrar el Material";
                    }
            } else {
                $data = $this->model->modificarMaterial($nombre, $cantidad, $precioBajo, $precioMedio, $precioAlto, $id);
                if ($data == "modificar") {
                    $msg = "modificar";
                } else {
                    $msg = "Error al modificar el Material";
                }
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function Editar(int $id)
    {
        $data = $this->model->editarMate($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function eliminar(int $id)
    {
        $data = $this->model->accionMate(0, $id);
        if($data == 1){
            $msg = "ok";
        }else{
            $msg = "Error al eliminar el Material";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function reingresar(int $id)
    {
        $data = $this->model->accionMate(1, $id);
        if($data == 1){
            $msg = "ok";
        }else{
            $msg = "Error al reingresar el Material";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
}
?>