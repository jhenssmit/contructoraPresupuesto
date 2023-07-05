<?php
class Roles extends Controller
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
        $id_user = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermiso($id_user, 'Roles');
        if (!empty($verificar) || $id_user == 1) {
            $this->views->getViews($this, "index");
        } else {
           header('Location: '.base_url. 'Errors/permisos');
        }
    }
    public function listar()
    {
        $data = $this->model->getRoles();
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge bg-success">Activo</span>';
                $data[$i]['acciones'] = '<div style="display: flex; justify-content: center;">';
                
                $data[$i]['acciones'] = $this->generarAcciones($data[$i]['id']);

            } else {
                $data[$i]['estado'] = '<span class="badge bg-danger">Inactivo</span>';
                $data[$i]['acciones'] = '<div><button class="btn btn-success" type="button" onclick="btnReingresarRol(' . $data[$i]['id'] . ');"><i class="fas fa-check"></i></button></div>';
            }
            
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    private function generarAcciones($MateId) {
        // Verificar permisos para asignar los botones
     
        
       
        $acciones = '<div>
        <button class="btn btn-primary" type="button" onclick="btnEditarRol(' . $MateId . ');"><i class="fas fa-edit"></i></button>
        <button class="btn btn-danger" type="button" onclick="btnEliminarRol(' . $MateId. ');"><i class="fas fa-solid fa-ban"></i></button>
        
        <div/>';
   
        $acciones .= '</div>';
    
        return $acciones;
    }
    
    public function registrar()
    {
            $rol = $_POST['rol'];
            $id = $_POST['id'];
           
            if (empty($rol)) {
                $msg = array('msg' => 'Todo los campos son obligatorios', 'icono' => 'warning');
            } else {
                if ($id == "") {
                        $data = $this->model->registrarRoles($rol);
                        if ($data == "ok") {
                            $msg = array('msg' => 'Rol registrado con éxito', 'icono' => 'success');
                        } else if ($data == "existe") {
                            $msg = array('msg' => 'El rol ya existe', 'icono' => 'warning');
                        } else {
                            $msg = array('msg' => 'Error al registrar el rol', 'icono' => 'error');
                        }
                } else {
                    $data = $this->model->modificarRoles($rol, $id);
                    if ($data == "modificar") {
                        $msg = array('msg' => 'Rol modificado con éxito', 'icono' => 'success');  
                    } else {
                        $msg = array('msg' => 'Error al modificar el rol', 'icono' => 'error');
                    }
                }
            }
          
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function Editar(int $id)
    {
        $data = $this->model->editarRoles($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function eliminar(int $id)
    {
        
        $data = $this->model->accionRoles(0, $id);
        if($data == 1){
            $msg = array('msg' => 'Rol dado de baja', 'icono' => 'success');
        }else{
            $msg = array('msg' => 'Error al eliminar el Rol', 'icono' => 'error');
        }
       
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    
    public function reingresar(int $id)
    {
       
            $data = $this->model->accionRoles(1, $id);
        if($data == 1){
            $msg = array('msg' => 'Rol reingresado con éxito', 'icono' => 'success');
        }else{
            $msg = array('msg' => 'Error al reingresar el rol', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
}
?>