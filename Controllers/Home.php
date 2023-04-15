<?php
class Home extends Controller
{
    public function index()
    {
        $this->views->getViews($this, "index");
    }
}


?>