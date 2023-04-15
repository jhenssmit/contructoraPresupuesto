<?php
class Views{
    public function getViews($controlador, $vista)
    {
        $controlador = get_class($controlador);
        if($controlador == "Home")
        {
            $vista = "Views/".$vista.".php";
        }else
        {
            $vista = "Views/".$controlador."/".$vista.".php";
        }
        require $vista;
    }
}
?>