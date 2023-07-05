<?php
class MedidaModel extends Query
{
    private $medida, $diminutivo, $id, $estado;
    public function __construct()
    {
        parent::__construct();
    }
    public function getMedidas()
    {
        $sql = "SELECT * FROM medidas";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getMedida()
    {
        $sql = "SELECT * FROM medidas WHERE id = 1";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function registrarMedida(string $medida, string $diminutivo)
    {
        $this->medida = $medida;
        $this->diminutivo = $diminutivo;
        $verificar = "SELECT * FROM medidas WHERE medida = '$this->medida'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $sql = "INSERT INTO medidas(medida, diminutivo) values (?,?)";
            $datos = array($this->medida, $this->diminutivo);
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
    public function modificarMedida(string $medida, string $diminutivo, int $id)
    {
        $this->medida = $medida;
        $this->diminutivo = $diminutivo;
        $this->id = $id;
        $sql = "UPDATE medidas SET medida = ?, diminutivo = ? WHERE id = ?";
        $datos = array($this->medida, $this->diminutivo, $this->id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificar";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function editarMedida(int $id)
    {
        $sql = "SELECT * FROM medidas WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }
    public function accionMedida(int $estado, int $id)
    {
        $this->id = $id;
        $this->estado = $estado;
        $sql = "UPDATE medidas SET estado = ? WHERE id = ?";
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