<?php
class MateTechosModel extends Query
{
    private $nombre, $id_medida, $cantidad, $precioBajo, $precioMedio, $precioAlto, $id, $estado, $id_elemento, $totalBajo, $totalAlto, $totalMedio, $manoObra;
    public function __construct()
    {
        parent::__construct();
    }
    public function getMaterial()
    {
        $sql = "SELECT * FROM materiales WHERE id = 1";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getMateTecho()
    {
        $sql = "SELECT m.*, e.nombre as id_elemento, u.id as id_medida, u.medida FROM materiales m INNER JOIN elementos e INNER JOIN medidas u WHERE e.id_elemento=m.id_elemento and u.id = m.id_medida and m.id_elemento=2 and m.estado = 1";
        
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getMedida()
    {
        $sql = "SELECT * FROM medidas where estado = 1";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getMateTechoInac()
    {
        $sql = "SELECT m.*, e.nombre as id_elemento, u.id as id_medida, u.medida FROM materiales m INNER JOIN elementos e INNER JOIN medidas u WHERE e.id_elemento=m.id_elemento and u.id = m.id_medida and m.id_elemento=2 and m.estado = 0";
        
        $data = $this->selectAll($sql);
        return $data;
    }
    public function registrarMatePiso(string $nombre, string $id_medida,string $cantidad, string $precioBajo, string $precioMedio, string $precioAlto, string $totalBajo, string $totalMedio, string $totalAlto, string $id_elemento, string $manoObra)
    {
        $this->nombre = $nombre;
        $this->id_medida = $id_medida;
        $this->cantidad = $cantidad;
        $this->precioBajo = $precioBajo;
        $this->precioMedio = $precioMedio;
        $this->precioAlto = $precioAlto;
        $this->id_elemento = $id_elemento;
        $this->totalBajo = $totalBajo;
        $this->totalMedio = $totalMedio;
        $this->totalAlto = $totalAlto;
        $this->manoObra = $manoObra;
        $verificar = "SELECT * FROM Materiales WHERE nombre = '$this->nombre'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $sql = "INSERT INTO materiales(nombre, id_medida,cantidad, precioBajo, precioMedio, precioAlto, totalBajo, totalMedio, totalAlto, id_elemento, manoObra) values (?,?,?,?,?,?,?,?,?,?,?)";
            $datos = array($this->nombre, $this->id_medida, $this->cantidad, $this->precioBajo, $this->precioMedio, $this->precioAlto, $this->totalBajo, $this->totalMedio, $this->totalAlto, $this->manoObra, $this->id_elemento);
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
    public function modificarMatePiso(string $nombre, string $id_medida,string $cantidad, string $precioBajo, string $precioMedio, string $precioAlto, string $id_elemento, string $totalBajo, string $totalMedio, string $totalAlto, string $manoObra, int $id)
    {
        $this->nombre = $nombre;
        $this->id_medida = $id_medida;
        $this->cantidad = $cantidad;
        $this->precioBajo = $precioBajo;
        $this->precioMedio = $precioMedio;
        $this->precioAlto = $precioAlto;
        $this->id_elemento = $id_elemento;
        $this->totalBajo = $totalBajo;
        $this->totalMedio = $totalMedio;
        $this->totalAlto = $totalAlto;
        $this->manoObra = $manoObra;
        $this->id = $id;
        $sql = "UPDATE materiales SET nombre = ?, id_medida = ?, cantidad = ?, precioBajo = ?, precioMedio = ?, precioAlto = ?, id_elemento = ?, totalBajo = ?, totalMedio = ?, totalAlto = ?, manoObra = ? WHERE id = ?";
        $datos = array($this->nombre,$this->id_medida, $this->cantidad, $this->precioBajo, $this->precioMedio, $this->precioAlto, $this->id_elemento, $this->totalBajo, $this->totalMedio, $this->totalAlto, $this->manoObra, $this->id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificar";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function editarMatePiso(int $id)
    {
        $sql = "SELECT * FROM materiales WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }
    public function accionMatePiso(int $estado, int $id)
    {
        $this->id = $id;
        $this->estado = $estado;
        $sql = "UPDATE materiales SET estado = ? WHERE id = ?";
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
