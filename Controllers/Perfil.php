<?php
class Perfil extends Controller
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
    public function cambiarPass()
    {
        $actual = $_POST['clave_actual'];
        $nueva = $_POST['clave_nueva'];
        $confirmar = $_POST['confirmar_clave'];
        if(empty($actual) || empty($nueva) || empty($confirmar)){
            $mensaje = array('msg' => 'Todo los campos son obligatorios','icono' => 'warning');
        }else{
           if ($nueva != $confirmar) {
            $mensaje = array('msg' => 'Las contraseñas no coinciden','icono' => 'warning');
           } else {
                $id = $_SESSION['id_usuario'];
                $hash = hash("SHA256", $actual);
                $data = $this->model->getPass($hash,$id);
                if(!empty($data)){
                    $verificar = $this -> model ->modificarPass(hash("SHA256", $nueva), $id);
                    if($verificar == 1){
                        $mensaje = array('msg' => 'Contraseña modificada con éxito','icono' => 'success');
                    }else{
                        $mensaje = array('msg' => 'Error al modifical la contraseña','icono' => 'danger');
                    }
                }else{
                      $mensaje = array('msg' => 'La contraseña actual incorrecta','icono' => 'warning');
                    
                }
           }
           
        }
        echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);
        die();
    }

}
?>