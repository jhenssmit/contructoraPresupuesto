<?php
class Inicio extends Controller{
    public function __construct()
    {
        session_start();
         if (empty($_SESSION['activo'])) {
            header("location: ".base_url);
        }
        parent::__construct();
    }
    public function index()
    {
        $data['usuarios'] = $this->model->getDatos('usuarios');
        $data['materiales'] = $this->model->getDatos1('materiales');
        $data['materiale'] = $this->model->getDatos2('materiales');
        $data['material'] = $this->model->getDatos3('materiales');
        $data['historial'] = $this->model->getDatos4('historial');
        $data['historial1'] = $this->model->getDatos5('historial');
        $data['historial2'] = $this->model->getDatos6('historial');
        $data['medidas'] = $this->model->getDatos('medidas');
       $this->views->getViews($this, 'index',$data);
    }
    public function reporte()
    {
        $data = $this->model->getReportePisos();
        echo json_encode($data);
        die();
    }
    public function reportePared()
    {
        $data = $this->model->getReportePared();
        echo json_encode($data);
        die();
    }
    public function reporteTecho()
    {
        $data = $this->model->getReporTecho();
        echo json_encode($data);
        die();
    }
}
?>