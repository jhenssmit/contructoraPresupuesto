<?php
class RolesModel extends Query
{
    private $rol, $id, $estado;
    public function __construct()
    {
        parent::__construct();
    }
    public function getRoles()
    {
        $sql = "SELECT * FROM roles";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function registrarRoles(string $rol)
    {
        $this->rol = $rol;
        $verificar = "SELECT * FROM roles WHERE rol = '$this->rol'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $sql = "INSERT INTO roles(rol) values (?)";
            $datos = array($this->rol);
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
    public function modificarRoles(string $rol, int $id)
    {
        $this->rol = $rol;
        $this->id = $id;
        $sql = "UPDATE roles SET rol = ?WHERE id = ?";
        $datos = array($this->rol, $this->id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificar";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function editarRoles(int $id)
    {
        $sql = "SELECT * FROM roles WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }
    public function accionRoles(int $estado, int $id)
    {
        $this->id = $id;
        $this->estado = $estado;
        $sql = "UPDATE roles SET estado = ? WHERE id = ?";
        $datos = array($this->estado, $this->id);
        $data = $this->save($sql, $datos);
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