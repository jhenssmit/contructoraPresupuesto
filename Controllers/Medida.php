<?php
class Medida extends Controller
{
    public function __construct()
    {
        session_start();
         if (empty($_SESSION['activo'])) {
            header("location: ".base_url);
        }
        parent::__construct();
    }
    public function index()
    {
            $this->views->getViews($this, "index");
       
    }
    public function list()
    {  
         $data = $this->model->getMedida();
        for ($i = 0; $i < count($data); $i++) {
            
               
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-primary mb-2" type="button" onclick="frmMedida(' . $data[$i]['id'] . ');"><i class="fas fa-plus"></i></button>
                </div>';
            
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function listar()
    {
        $data = $this->model->getMedidas();
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge bg-success">Activo</span>';
                $data[$i]['acciones'] = '<div style="display: flex; justify-content: center;">';
                
                $data[$i]['acciones'] = $this->generarAcciones($data[$i]['id']);

            } else {
                $data[$i]['estado'] = '<span class="badge bg-danger">Inactivo</span>';
                $data[$i]['acciones'] = '<div><button class="btn btn-success" type="button" onclick="btnReingresarMedida(' . $data[$i]['id'] . ');"><i class="fas fa-check"></i></button></div>';
            }
            
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    private function generarAcciones($MateId) {
        // Verificar permisos para asignar los botones
     
        
       
        $acciones = '<div>
        <button class="btn btn-primary" type="button" onclick="btnEditarMedida(' . $MateId . ');"><i class="fas fa-edit"></i></button>
        <button class="btn btn-danger" type="button" onclick="btnEliminarMedida(' . $MateId. ');"><i class="fas fa-solid fa-ban"></i></button>
        
        <div/>';
   
        $acciones .= '</div>';
    
        return $acciones;
    }
    
    public function registrar()
    {
       
            $id = $_POST['id'];
            $medida = $_POST['medida'];
            $diminutivo = $_POST['diminutivo'];
            if (empty($medida) || empty($diminutivo)) {
                $msg = array('msg' => 'Todo los campos son obligatorios', 'icono' => 'warning');
            } else {
                if ($id == "") {
                        $data = $this->model->registrarMedida($medida, $diminutivo);
                        if ($data == "ok") {
                            $msg = array('msg' => 'Medida registrado con éxito', 'icono' => 'success');
                        } else if ($data == "existe") {
                            $msg = array('msg' => 'La medida ya existe', 'icono' => 'warning');
                        } else {
                            $msg = array('msg' => 'Error al registrar la medida', 'icono' => 'error');
                        }
                } else {
                    $data = $this->model->modificarMedida($medida, $diminutivo, $id);
                    if ($data == "modificar") {
                        $msg = array('msg' => 'Medida modificado con éxito', 'icono' => 'success');  
                    } else {
                        $msg = array('msg' => 'Error al modificar la Medida', 'icono' => 'error');
                    }
                }
            }
          
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function Editar(int $id)
    {
        $data = $this->model->editarMedida($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function eliminar(int $id)
    {
        
        $data = $this->model->accionMedida(0, $id);
        if($data == 1){
            $msg = array('msg' => 'Material dado de baja', 'icono' => 'success');
        }else{
            $msg = array('msg' => 'Error al eliminar el Material', 'icono' => 'error');
        }
       
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    
    public function reingresar(int $id)
    {
       
            $data = $this->model->accionMedida(1, $id);
        if($data == 1){
            $msg = array('msg' => 'Medida reingresado con éxito', 'icono' => 'success');
        }else{
            $msg = array('msg' => 'Error al reingresar la medida', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
}
?>