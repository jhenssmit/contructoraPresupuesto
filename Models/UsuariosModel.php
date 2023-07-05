<?php
class UsuariosModel extends Query
{
    private $usuario, $nombre, $clave, $id_rol, $id, $estado;
    public function __construct()
    {
        parent::__construct();
    }
    public function getUsuario(string $usuario, string $clave)
    {
        $sql = "SELECT * FROM usuarios where usuario = '$usuario' and clave = '$clave' and estado = 1";
        $data = $this->select($sql);
        return $data;
    }
    public function getUsuarios()
    {
        $sql = "SELECT u.*, c.id as id_rol, c.rol FROM usuarios u INNER JOIN roles c WHERE u.id_rol = c.id";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getUsuari()
    {
        $sql = "SELECT * FROM usuarios WHERE id = 1";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getRoles()
    {
        $sql = "SELECT * FROM roles where estado = 1";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function registrarUsuario(string $usuario, string $nombre, string $clave, int $id_rol)
    {
        $this->usuario = $usuario;
        $this->nombre = $nombre;
        $this->clave = $clave;
        $this->id_rol = $id_rol;
        $verificar = "SELECT * FROM usuarios WHERE usuario = '$this->usuario'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $sql = "INSERT INTO usuarios(usuario, nombre, clave, id_rol) values (?,?,?,?)";
            $datos = array($this->usuario, $this->nombre, $this->clave, $this->id_rol);
            $data = $this->save($sql, $datos);
            if ($data == 1) {
                $res = "ok";
            } else {
                $res = "error";
            }
        } else {
            $res = "existe";
        }
        return $res;
    }
    public function modificarUsuario(string $usuario, string $nombre, int $id_rol, int $id)
    {
        $this->usuario = $usuario;
        $this->nombre = $nombre;
        $this->id = $id;
        $this->id_rol = $id_rol;
        $sql = "UPDATE usuarios SET usuario = ?, nombre = ?, id_rol = ? WHERE id = ?";
        $datos = array($this->usuario, $this->nombre, $this->id_rol, $this->id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificar";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function editarUsuario(int $id)
    {
        $sql = "SELECT * FROM usuarios WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }
    public function accionUsuario(int $estado, int $id)
    {
        $this->id = $id;
        $this->estado = $estado;
        $sql = "UPDATE usuarios SET estado = ? WHERE id = ?";
        $datos = array($this->estado, $this->id);
        $data = $this->save($sql, $datos);
        return $data;
    } 
    public function getPermisos()
    {
        $sql = "SELECT * FROM permisos";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function registrarPermisos(int $id_user, int $id_permiso)
    {
        $sql = "INSERT INTO detalle_permisos (id_usuario, id_permiso) VALUES (?,?)";
        $datos = array($id_user, $id_permiso);
        $data = $this->save($sql, $datos);
        if ($data == 1){
            $res = 'ok';
        }else{
            $res = 'error';
        }
        return $res;
    }
    public function eliminarPermisos(int $id_user)
    {
        $sql = "DELETE FROM detalle_permisos WHERE id_usuario = ?";
        $datos = array($id_user);
        $data = $this->save($sql, $datos);
        if ($data == 1){
            $res = 'ok';
        }else{
            $res = 'error';
        }
        return $res;
    }
    public function getDetallePermisos(int $id_user)
    {
        $sql = "SELECT * FROM detalle_permisos WHERE id_usuario = $id_user";
        $data = $this->selectAll($sql);
        return $data;
    }
   
    public function verificarPermiso(int $id_user, string $nombre)
    {
        $sql ="SELECT p.id, p.permiso, d.id, d.id_usuario, d.id_permiso FROM permisos p INNER JOIN detalle_permisos d ON p.id = d.id_permiso WHERE d.id_usuario = $id_user  AND p.permiso = '$nombre'";
        $data = $this->selectAll($sql);
        return $data;
    }
    
}
?>