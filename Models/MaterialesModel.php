<?php
class MaterialesModel extends Query
{
    private $nombre, $cantidad, $precioBajo, $precioMedio, $precioAlto, $id, $estado;
    public function __construct()
    {
        parent::__construct();
    }
    public function getMateriales()
    {
        $sql = "SELECT * FROM materiales";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function registrarMaterial(string $nombre, string $cantidad, string $precioBajo, string $precioMedio, string $precioAlto)
    {
        $this->nombre = $nombre;
        $this->cantidad = $cantidad;
        $this->precioBajo = $precioBajo;
        $this->precioMedio = $precioMedio;
        $this->precioAlto = $precioAlto;
        $verificar = "SELECT * FROM materiales WHERE nombre = '$this->nombre'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $sql = "INSERT INTO materiales(nombre, cantidad, precioBajo, precioMedio, precioAlto) values (?,?,?,?,?)";
            $datos = array($this->nombre, $this->cantidad, $this->precioBajo, $this->precioMedio, $this->precioAlto);
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
    public function modificarMaterial(string $nombre, string $cantidad, string $precioBajo, string $precioMedio, string $precioAlto, int $id)
    {
        $this->nombre = $nombre;
        $this->cantidad = $cantidad;
        $this->precioBajo = $precioBajo;
        $this->precioMedio = $precioMedio;
        $this->precioAlto = $precioAlto;
        $this->id = $id;
        $sql = "UPDATE materiales SET nombre = ?, cantidad = ?, precioBajo = ?, precioMedio = ?, precioAlto = ? WHERE id = ?";
        $datos = array($this->nombre, $this->cantidad, $this->precioBajo, $this->precioMedio, $this->precioAlto, $this->id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificar";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function editarMate(int $id)
    {
        $sql = "SELECT * FROM materiales WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }
    public function accionMate(int $estado, int $id)
    {
        $this->id = $id;
        $this->estado = $estado;
        $sql = "UPDATE materiales SET estado = ? WHERE id = ?";
        $datos = array($this->estado, $this->id);
        $data = $this->save($sql, $datos);
        return $data;
    } 
    
}
?>