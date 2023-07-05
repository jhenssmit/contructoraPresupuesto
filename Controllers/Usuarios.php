<?php
class Usuarios extends Controller
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
        $id_user = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermiso($id_user, 'usuarios');
        if (!empty($verificar) || $id_user == 1) {
            $data['rol'] = $this->model->getRoles();
            $this->views->getViews($this, "index", $data);
        } else {
           header('Location: '.base_url. 'Errors/permisos');
        }
    }
    public function list()
    {  
         $data = $this->model->getUsuari();
        for ($i = 0; $i < count($data); $i++) {
            
                $registrarDisabled  = '';
                $id_user = $_SESSION['id_usuario'];
                $verificarRegistrar = $this->model->verificarPermiso($id_user , 'Registrar_Usuario');
                if (!empty($verificarRegistrar) || $id_user == 1) {
                   
                }else{
                    $registrarDisabled = 'disabled';
                }
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-primary mb-2" type="button" onclick="frmUsuario(' . $data[$i]['id'] . ');" '.$registrarDisabled .'><i class="fas fa-plus"></i></button>
                </div>';
            
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
        
    }
    
    public function listar()
    {
        $data = $this->model->getUsuarios();
    for ($i = 0; $i < count($data); $i++) {
        if ($data[$i]['estado'] == 1) {
            $data[$i]['estado'] = '<span class="badge bg-success">Activo</span>';
            if ($data[$i]['id'] == 1){
                $data[$i]['acciones'] = '<div>
                <span class="badge bg-primary">Administrador</span>
                </div>'; 
                $data[$i]['accion'] = '';
            }else{
                $data[$i]['acciones'] = $this->generarAcciones($data[$i]['id']);
                $data[$i]['accion'] = $this->generarAccion($data[$i]['id']);
            }
        }else {
            $data[$i]['estado'] = '<span class="badge bg-danger">Inactivo</span>';
            $reingresarDisabled = '';
            $id_user = $_SESSION['id_usuario'];
            $verificarReingreso = $this->model->verificarPermiso($id_user , 'Reingresar_Usuario');
            if (!empty($verificarReingreso) || $id_user == 1) {
               
            }else{
                $reingresarDisabled = 'disabled';
            }
            $data[$i]['acciones'] = '<div>
            <button class="btn btn-success" type="button" onclick="btnReingresarUser(' . $data[$i]['id'] . ');" '.$reingresarDisabled .'><i class="fas fa-circle"></i></button>
            </div>';
            $data[$i]['accion'] = '';
        }
    }
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
    }
    private function generarAcciones($userId, $inactivo = false) {
        // Verificar permisos para asignar los botones
        $editarDisabled = '';
        $eliminarDisabled = '';
        
        $id_user = $_SESSION['id_usuario'];
        $verificarEditar = $this->model->verificarPermiso($id_user , 'Editar_Usuario');
        if (empty($verificarEditar) && $id_user != 1) {
            $editarDisabled = 'disabled';
        }
    
        $verificarEliminar = $this->model->verificarPermiso($id_user, 'Eliminar_Usuario');
        if (empty($verificarEliminar) && $id_user != 1) {
            $eliminarDisabled = 'disabled';
        }
            
        $acciones = '<div>
        <button class="btn btn-primary" type="button" onclick="btnEditarUser(' . $userId . ');" ' . $editarDisabled . '><i class="fas fa-edit"></i></button>
        <button class="btn btn-danger" type="button" onclick="btnEliminarUser(' . $userId . ');" ' . $eliminarDisabled . '><i class="fas fa-solid fa-ban"></i></button>
        
        <div/>';
        
        $acciones .= '</div>';
    
        return $acciones;
    }
    private function generarAccion($userId, $inactivo = false) {
        // Verificar permisos para asignar los botones
        $permisoDisabled = ''; 
        
        $id_user = $_SESSION['id_usuario'];
       
        $verificarPermiso = $this->model->verificarPermiso($id_user, 'Asignar_Permisos');
        if (empty($verificarPermiso) && $id_user != 1) {
            $permisoDisabled = 'disabled';
            //$permisoDisabled = 'display: none;';
        }
    
        
        /*$acciones = '<div>
        <a class="btn btn-dark permisos-link" href="'.base_url.'Usuarios/permisos/'. $userId .'" style="'.$permisoDisabled.'"><i class="fas fa-key"></i></a>
        <div/>';
        if ($inactivo) {
            $acciones .= '<button class="btn btn-success reingresar-btn" type="button" onclick="reingresarUsuario(' . $userId . ')"><i class="fas fa-circle"></i></button>';
        }*/
        $acciones = '<div>
        <a class="btn btn-dark permisos-link '.$permisoDisabled.'" href="'.base_url.'Usuarios/permisos/'. $userId .'" '.$permisoDisabled.'><i class="fas fa-key"></i></a>
        <div/>';
        if ($inactivo) {
            $acciones .= '<button class="btn btn-success reingresar-btn" type="button" onclick="reingresarUsuario(' . $userId . ')"><i class="fas fa-circle"></i></button>';
        }
    
        $acciones .= '</div>';
    
        return $acciones;
    }
    public function validar()
    {
        $usuario = $_POST['usuario'];
        $clave = $_POST['clave'];

        if (empty($usuario) || empty($clave)) {
            $msg = "Los campos están vacíos";
        } else {
            $usuario = $_POST['usuario'];
            $clave = $_POST['clave'];
            $hash = hash("SHA256", $clave);
            $data = $this->model->getUsuario($usuario, $hash);
            if ($data) {
                $_SESSION['id_usuario'] = $data['id'];
                $_SESSION['usuario'] = $data['usuario'];
                $_SESSION['nombre'] = $data['nombre'];
                $_SESSION['activo'] = true;
                $msg = "ok";
                setcookie("usuario", $data['id'], time() + (86400 * 30), "/");
            } else {
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
        $rol = $_POST['rol'];
        $hash = hash("SHA256", $clave);
        if (empty($usuario) || empty($nombre) || empty($rol)) {
            $msg = array('msg' => 'Todo los campos son obligatorios xd', 'icono' => 'warning');
        } else {
            if ($id == "") {
                if ($clave != $confirmar) {
                    $msg = array('msg' => 'Las contraseña no coinciden', 'icono' => 'warning');
                } else {
                    $data = $this->model->registrarUsuario($usuario, $nombre, $hash, $rol);
                    if ($data == "ok") {
                        $msg = array('msg' => 'Usuario registrado con éxito', 'icono' => 'success');
                    } else if ($data == "existe") {
                        $msg = array('msg' => 'El usuario ya existe', 'icono' => 'warning');
                    } else {
                        $msg = array('msg' => 'Error al registrar el usuario', 'icono' => 'error');
                    }
                }
            } else {
                $data = $this->model->modificarUsuario($usuario, $nombre, $rol, $id);
                if ($data == "modificar") {
                    $msg = array('msg' => 'Usuario modificado con éxito', 'icono' => 'success');
                } else {
                    $msg = array('msg' => 'Error al modificar el usuario', 'icono' => 'error');
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
    public function eliminar(int $id)
    {
            $data = $this->model->accionUsuario(0, $id);
            if($data == 1){
                $msg = array('msg' => 'Usuario dado de baja', 'icono' => 'success');
            }else{
                $msg = array('msg' => 'Error al eliminar el usuario', 'icono' => 'error');
            }
           
         echo json_encode($msg, JSON_UNESCAPED_UNICODE);
            die();
    }
    public function reingresar(int $id)
    {
       
        $data = $this->model->accionUsuario(1, $id);
        if($data == 1){
            $msg = array('msg' => 'Usuario reingresado con éxito', 'icono' => 'success');
        }else{
            $msg = array('msg' => 'Error al reingresar el usuario', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function permisos($id)
    {
            if (empty($_SESSION['activo'])) {
                header("location: " . base_url);
            }
            $data['datos'] = $this->model->getPermisos();
            $permisos = $this->model->getDetallePermisos($id);
            $data['asignados'] = array();
            foreach($permisos as $permiso){
                $data['asignados'][$permiso['id_permiso']] = true;
            }
            $data['id_usuario'] = $id;
            $this->views->getViews($this, "permisos", $data);  
       
    }
  
    public function registrarPermiso()
    {
        $msg = '';
       $id_user = $_POST['id_usuario'];
       $eliminar = $this->model->eliminarPermisos($id_user);
       if ($eliminar == 'ok') {
        if (!empty($_POST['permisos'])) {
            foreach ($_POST['permisos'] as $id_permiso){
                    $msg = $this->model->registrarPermisos($id_user, $id_permiso);
                }
                if ($msg == 'ok') {
                    $msg = array('msg'=> 'Permisos asignados', 'icono' => 'success');

                } else {
                    $msg = array('msg'=> 'Error al asignar los permisos', 'icono' => 'error');

                }
            } else {
                $msg = array('msg' => 'No hay permisos asignados', 'icono' => 'info');
            }
           
       } else {
        $msg = array('msg'=> 'Error al eliminar los permisos anteriores', 'icono' => 'error');
       }
       echo json_encode($msg, JSON_UNESCAPED_UNICODE);
       
    }
    public function salir(){
        session_destroy();
        header("location: ".base_url);
    }
}
?>