<?php
class InicioModel extends Query
{
    public function getDatos(string $table)
    {
        $sql = "SELECT COUNT(*) AS total FROM $table WHERE estado = 1" ;
        $data = $this->select($sql);
        return $data;
    }
    public function getDatos1(string $table)
    {
        $sql = "SELECT COUNT(*) AS total FROM $table WHERE id_elemento = 1 and estado = 1";
        $data = $this->select($sql);
        return $data;
    }
    public function getDatos2(string $table)
    {
        $sql = "SELECT COUNT(*) AS total FROM $table WHERE id_elemento = 3 and estado = 1";
        $data = $this->select($sql);
        return $data;
    }
    public function getDatos3(string $table)
    {
        $sql = "SELECT COUNT(*) AS total FROM $table WHERE id_elemento = 2 and estado = 1";
        $data = $this->select($sql);
        return $data;
    }
    public function getDatos4(string $table)
    {
        $sql = "SELECT COUNT(*) AS total FROM $table WHERE idElemento = 1";
        $data = $this->select($sql);
        return $data;
    }
    public function getDatos5(string $table)
    {
        $sql = "SELECT COUNT(*) AS total FROM $table WHERE idElemento = 3";
        $data = $this->select($sql);
        return $data;
    }
    public function getDatos6(string $table)
    {
        $sql = "SELECT COUNT(*) AS total FROM $table WHERE idElemento = 2";
        $data = $this->select($sql);
        return $data;
    }
    public function getReportePisos()
    {
        $sql = "SELECT * FROM materiales WHERE id_elemento = 1 and estado = 1";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getReportePared()
    {
        $sql = "SELECT * FROM materiales WHERE id_elemento = 3 and estado = 1";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getReporTecho()
    {
        $sql = "SELECT * FROM materiales WHERE id_elemento = 2 and estado = 1";
        $data = $this->selectAll($sql);
        return $data;
    }
    
}
?>