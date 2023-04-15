<?php
class  Query extends Connection{
    private $pdo, $con, $sql;
    public function __construct()
    {
        $this->pdo = new connection();
        $this->con = $this->pdo->connect();
    }
    public function select(string $sql)
    {
        $this->sql = $sql;
        $result = $this->con->prepare($this->sql);
        $result->execute();
        $data = $result->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
}



?>