<?php
class Usuarios extends Controller{
    public function __construct()
    {
        session_start();
        parent::__construct();
    }
    public function index()
    {
        $data['cajas'] = $this->model->getCajas();
        $this->views->getViews($this,"index", $data);
    }
    public function listar()
    {
        $data = $this->model->getUsuarios();
        for ($i=0; $i<count($data);$i++){
            if($data[$i]['estado']==1){
                $data[$i]['estado']='<span class="badge bg-success">Activo</span>';
            }else{
                $data[$i]['estado']='<span class="badge bg-danger">Inactivo</span>';
            }
            $data[$i]['acciones']='<div><button class="btn btn-primary" type="button">Editar</button>
            <button class="btn btn-danger" type="button">Eliminar</button></div>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function validar()
    {
        if(empty($_POST['usuario']) || empty($_POST['clave'])){
            $msg = "Los campos están vacíos";
        }else{
            $usuario = $_POST['usuario'];
            $clave = $_POST['clave'];
            $data = $this->model->getUsuario($usuario, $clave);
            if($data){
                $_SESSION['id_usuario'] = $data['id'];
                $_SESSION['usuario'] = $data['usuario'];
                $_SESSION['nombre'] = $data['nombre'];
                $msg = "ok";
            }else{
                $msg = "Usuario o contraseña incorrecta";
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function registrar()
{
    $usuario = $_POST['usuario'];
    $nombre = $_POST['nombre'];
    $clave = $_POST['clave'];
    $confirmar = $_POST['confirmar'];
    $caja = $_POST['caja'];
    
    if (empty($usuario) || empty($nombre) || empty($clave) || empty($confirmar) || empty($caja)) {
        $msg = "Todos los campos son obligatorios";
    } else if ($clave != $confirmar) {
        $msg = "Las contraseñas no coinciden";
    } else {
        $data = $this->model->registrarUsuario($usuario, $nombre, $clave, $caja);
        if ($data == "ok") {
            $msg = "si";
        } else {
            $msg = "Error al registrar al usuario";
        }
    }
    
    header('Content-Type: application/json');
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
}
}
?>
