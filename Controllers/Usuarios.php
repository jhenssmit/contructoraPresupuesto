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
            $data[$i]['acciones']='<div><button class="btn btn-primary" type="button" onclick="btnEditarUser('.$data[$i]['id'].');">Editar</button>
            <button class="btn btn-danger" type="button">Inhabilitar</button></div>';
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
    $id = $_POST['id'];
    $caja = $_POST['caja'];
    $hash = hash("SHA256",$clave);
    if (empty($usuario) || empty($nombre) || empty($caja)) {
        $msg = "Todos los campos son obligatorios";
    } else {
        if($id == ""){
            if ($clave != $confirmar) {
                $msg = "Las contraseñas no coinciden";
            } else{ 
                $data = $this->model->registrarUsuario($usuario, $nombre, $hash, $caja);
                if ($data == "ok") {
                    $msg = "si";
                } else if($data == "existe"){
                    $msg = "El usuario ya existe";
                }else{
                    $msg = "Error al registrar el usuario";
                }
            }
        }else{
            $data = $this->model->modificarUsuario($usuario, $nombre, $caja, $id);
            if ($data == "modificar") {
                $msg = "modificar";
            }else{
                $msg = "Error al modificar el usuario";
            }
        }
    }
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
    }
    public function Editar(int $id)
    {
        $data = $this->model->editarUsuario($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
}
?>
