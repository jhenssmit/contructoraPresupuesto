<?php
class MateTechos extends Controller
{
    public function __construct()
    {
        session_start();
        parent::__construct();
    }
    public function index()
    {
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url);
        }
        $id_user = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermiso($id_user, 'Material_Techo');
        if (!empty($verificar) || $id_user == 1) {
            $data['medida'] = $this->model->getMedida();
            $this->views->getViews($this, "index",$data);
        } else {
           header('Location: '.base_url. 'Errors/permisos');
        }
    }
    public function inactivo()
    {
        $data['medida'] = $this->model->getMedida();
        $this->views->getViews($this, "inactivo",$data);
        
    }
    public function list()
    {  
         $data = $this->model->getMaterial();
        for ($i = 0; $i < count($data); $i++) {
                $id_user = $_SESSION['id_usuario'];
                $registrarDisabled  = '';
                $verDisabled  = '';
                
                $verificarRegistrar = $this->model->verificarPermiso($id_user , 'Registrar_Material_Techo');
                if (!empty($verificarRegistrar) || $id_user == 1) {
                   
                }else{
                    $registrarDisabled = 'disabled';
                }
                $verificarVer= $this->model->verificarPermiso($id_user , 'Ver_Techo_Inactivo');
                if (!empty($verificarVer) || $id_user == 1) {
                   
                }else{
                    $verDisabled = 'disabled';
                }
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-primary mb-2" type="button" onclick="frmMatePiso(' . $data[$i]['id'] . ');" '.$registrarDisabled .'><i class="fas fa-plus"></i></button>
                </div>';
                $data[$i]['accione'] = '<div>
                &nbsp&nbsp&nbsp&nbsp&nbsp
                </div>';
                $data[$i]['accion'] = '<div>
                <button class="btn btn-danger mb-2" type="button" '.$verDisabled .'><a class="dropdown text-white" href="MateTechos/inactivo"><i class="fas fa-eye-slash"></i></a></button>
                </div>';
            
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function listar()
    {
        $data = $this->model->getMateTecho();
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge bg-success">Activo</span>';
                $data[$i]['acciones'] = '<div style="display: flex; justify-content: center;">';
                $data[$i]['acciones'] = $this->generarAcciones($data[$i]['id']);
            } else {
                $data[$i]['estado'] = '<span class="badge bg-danger">Inactivo</span>';
                $reingresarDisabled = '';
                $id_user = $_SESSION['id_usuario'];
                $verificarReingreso = $this->model->verificarPermiso($id_user , 'Reingresar_Material_Techo');
                if (!empty($verificarReingreso) || $id_user == 1) {
                   
                }else{
                    $reingresarDisabled = 'disabled';
                }
                $data[$i]['acciones'] = '<div><button class="btn btn-success" type="button" onclick="btnReingresarMatePiso(' . $data[$i]['id'] . ');"'.$reingresarDisabled .'><i class="fas fa-ban"></i></button></div>';
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    private function generarAcciones($MateId, $inactivo = false) {
        // Verificar permisos para asignar los botones
        $editarDisabled = '';
        $eliminarDisabled = '';
        
        $id_user = $_SESSION['id_usuario'];
        $verificarEditar = $this->model->verificarPermiso($id_user , 'Editar_Material_Techo');
        if (empty($verificarEditar) && $id_user != 1) {
            $editarDisabled = 'disabled';
        }
    
        $verificarEliminar = $this->model->verificarPermiso($id_user, 'Eliminar_Material_Techo');
        if (empty($verificarEliminar) && $id_user != 1) {
            $eliminarDisabled = 'disabled';
        }
        
        $acciones = '<div>
        <button class="btn btn-primary" type="button" onclick="btnEditarMatePiso(' . $MateId . ');" ' . $editarDisabled . '><i class="fas fa-edit"></i></button>
        <button class="btn btn-danger" type="button" onclick="btnEliminarMatePiso(' . $MateId. ');" ' . $eliminarDisabled . '><i class="fas fa-solid fa-ban"></i></button>
        
        <div/>';
   
        $acciones .= '</div>';
    
        return $acciones;
    }
    public function listarInac()
    {
        $data = $this->model->getMateTechoInac();
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge bg-success">Activo</span>';
                $data[$i]['acciones'] = '<div style="display: flex; justify-content: center;">';
            } else {
                $data[$i]['estado'] = '<span class="badge bg-danger">Inactivo</span>';
                $reingresarDisabled = '';
                $id_user = $_SESSION['id_usuario'];
                $verificarReingreso = $this->model->verificarPermiso($id_user , 'Reingresar_Material_Techo');
                if (!empty($verificarReingreso) || $id_user == 1) {
                   
                }else{
                    $reingresarDisabled = 'disabled';
                }
                $data[$i]['acciones'] = '<div><button class="btn btn-success" type="button" onclick="btnReingresarMatePiso(' . $data[$i]['id'] . ');"'.$reingresarDisabled .'><i class="fas fa-check"></i></button></div>';
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function registrar()
    {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $medida = $_POST['medida'];
        $cantidad = $_POST['cantidad'];
        $precioBajo = $_POST['precioBajo'];
        $precioMedio = $_POST['precioMedio'];
        $precioAlto = $_POST['precioAlto'];
        $id_elemento = $_POST['id_elemento'];
        $manoObra = $_POST['manoObra'];
        if (empty($nombre) || empty($cantidad) || empty($precioBajo) || empty($precioMedio) || empty($precioAlto) || empty($manoObra)) {
            $msg = "Todos los campos son obligatorios";
        } else {
            if ($id == "") {
                $totalBajo = ($cantidad * $precioBajo) / 100;
                $totalMedio = ($cantidad * $precioMedio) / 100;
                $totalAlto = ($cantidad * $precioAlto) / 100;
                $data = $this->model->registrarMatePiso($nombre, $medida, $cantidad, $precioBajo, $precioMedio, $precioAlto, $totalBajo, $totalMedio, $totalAlto, $id_elemento, $manoObra);
                if ($data == "ok") {
                    $msg = "si";
                } else if ($data == "existe") {
                    $msg = "El Techo ya existe";
                } else {
                    $msg = "Error al registrar el Material Techo";
                }
            } else {
                $totalBajo = ($cantidad * $precioBajo) / 100;
                $totalMedio = ($cantidad * $precioMedio) / 100;
                $totalAlto = ($cantidad * $precioAlto) / 100;
                $data = $this->model->modificarMatePiso($nombre, $medida, $cantidad, $precioBajo, $precioMedio, $precioAlto, $id_elemento, $totalBajo, $totalMedio, $totalAlto, $manoObra, $id);
                if ($data == "modificar") {
                    $msg = "modificar";
                } else {
                    $msg = "Error al modificar el Material Techo";
                }
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function Editar(int $id)
    {
        $data = $this->model->editarMatePiso($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function eliminar(int $id)
    {
        $data = $this->model->accionMatePiso(0, $id);
        if ($data == 1) {
            $msg = "ok";
        } else {
            $msg = "Error al eliminar el Material";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function reingresar(int $id)
    {
        $data = $this->model->accionMatePiso(1, $id);
        if ($data == 1) {
            $msg = "ok";
        } else {
            $msg = "Error al reingresar el Material";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
}
