<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="Assets/images/logoxD1.png" type="">
    <title>Panel Administrativo</title>
    <link href="<?php echo base_url; ?>Assets/css/styles.css" rel="stylesheet" />
    <link href="<?php echo base_url; ?>Assets/css/estilos.css" rel="stylesheet" />
    <link href="<?php echo base_url; ?>Assets/DataTables/datatables.min.css" rel="stylesheet" />
    <script src="<?php echo base_url; ?>Assets/js/all.min.js"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar" style="background: black; justify-content: center; padding: 5px;">
        <nav class="navbar navbar-expand  bg-dark-xD" style="border-radius: 8px; justify-content: center; height: 4%; width: 99%; padding: 20px;background: #212529;">
        
        <!-- Navbar Brand-->
            <a class="navbar-brand ps-3 text-success" href="<?php echo base_url; ?>Inicio">E'CONS PERÚ S.A.C</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <!-- Navbar-->
            <div id="miDiv" style="color: white; display: none;">
                <select id="colorSelector" class="form-select mt-2 text-white" style="background-color: transparent; border: none; outline: none;" onchange="toggleVisibility()">
                                                <option class="" value="" selected disabled>Color</option>
                                                <option class="" value="" selected disabled>-----------</option>
                                                <option class="text-black" value="bg-custom1">Azul</option>
                                                <option class="text-black" value="bg-custom2">Amarillo</option>
                                                <option class="text-black" value="bg-custom3">Claro</option>
                                                <option class="text-black" value="bg-custom4">Rojo</option>
                                                <option class="text-black" value="bg-custom5">Darck</option>
                                                <option class="text-black" value="bg-custom6">Verde</option>
                </select>  
            </div>   
            <button  class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0 text-white" onclick="toggleVisibility()"><i class="fas fa-cog"></i></button>
            <script>
                function toggleVisibility() {
                var div = document.getElementById("miDiv");
                if (div.style.display === "none") {
                    div.style.display = "block";
                } else {
                    div.style.display = "none";
                }
                }
            </script>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-warning" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?php echo $_SESSION['usuario']; ?>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<i class="fas fa-user-tie"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="<?php echo base_url; ?>Perfil">Perfil</a></li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li><a class="dropdown-item" href="<?php echo base_url; ?>Usuarios/salir">Cerrar Sesión</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <div class="sb-sidenav accordion" id="sidenavAccordion" style="background: black;">
                <div id="layoutSidenav_nav" style="justify-content: center; height: 100%; width: auto;  padding-top: 70px; padding-bottom: 30px; padding-left: 15px; padding-right: 15px;">
                    <nav class="sb-sidenav accordion sb-sidenav-dark" style="box-shadow: 2px 2px 8px rgba(0, 0, 0, 25); border-radius: 18px;" id="sidenavAccordion">
                        <div class="sb-sidenav-menu">
                            <div class="nav">
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                    <div class="sb-nav-link-icon text-primary"><i class="fas fa fa-columns"></i></div>
                                    Configuración
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="<?php echo base_url; ?>Usuarios"><div class="sb-nav-link-icon"><i class="fas fa-user text-primary"></i></div> Usuarios</a>
                                        <a class="nav-link" href="<?php echo base_url; ?>Roles"><div class="sb-nav-link-icon"><i class="fas fa-user-tie text-primary"></i></div> Roles</a>
                                    </nav>
                                </div>
                            </div>
                            <div class="nav">
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts1" aria-expanded="false" aria-controls="collapseLayouts">
                                    <div class="sb-nav-link-icon" style="color:white"><i class="fas fa-hard-hat"></i></div>
                                    Materiales
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseLayouts1" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="<?php echo base_url; ?>MatePisos">
                                            <div class="sb-nav-link-icon"><i class="fas fa-layer-group text-primary"></i></div>Pisos
                                        </a>
                                        <a class="nav-link" href="<?php echo base_url; ?>MateParedes">
                                            <div class="sb-nav-link-icon"><i class="fas fa-border-all text-primary"></i></div>Pared
                                        </a>
                                        <a class="nav-link" href="<?php echo base_url; ?>MateTechos">
                                            <div class="sb-nav-link-icon"><i class="fas fa-home text-primary"></i></div>Techo
                                        </a>
                                        <a class="nav-link" href="<?php echo base_url; ?>Medida"><div class="sb-nav-link-icon"><i class="fas fa-ruler text-primary"></i></div> Medidas</a>

                                    </nav>
                                </div>
                            </div>
                            <div class="nav">
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts2" aria-expanded="false" aria-controls="collapseLayouts">
                                    <div class="sb-nav-link-icon text-warning"><i class="fas fa-dollar-sign fa-lg"></i></div>
                                     Presupuesto
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseLayouts2" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="<?php echo base_url; ?>PresupuestoPisos">
                                            <div class="sb-nav-link-icon"><i class="fas fa-layer-group text-primary"></i></div>Calcular Presupuesto Pisos
                                        </a>
                                        <a class="nav-link" href="<?php echo base_url; ?>PresupuestoPared">
                                            <div class="sb-nav-link-icon"><i class="fas fa-border-all text-primary"></i></div>Calcular Presupuesto Pared
                                        </a>
                                        <a class="nav-link" href="<?php echo base_url; ?>PresupuestoTecho">
                                        <div class="sb-nav-link-icon"><i class="fas fa-home text-primary"></i></div>Calcular Presupuesto Techo
                                        </a>
                                    </nav>
                                </div>
                            </div>
                            <div class="nav">
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts3" aria-expanded="false" aria-controls="collapseLayouts">
                                    <div class="sb-nav-link-icon text-success"><i class="fas fa-history"></i></div>
                                    Historial
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseLayouts3" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="<?php echo base_url; ?>HistorialPisos">
                                            <div class="sb-nav-link-icon"><i class="fas fa-layer-group text-primary"></i></div>Historial Presupuesto Pisos
                                        </a>
                                        <a class="nav-link" href="<?php echo base_url; ?>HistorialParedes">
                                            <div class="sb-nav-link-icon"><i class="fas fa-border-all text-primary"></i></div>Historial Presupuesto Pared
                                        </a>
                                        <a class="nav-link" href="<?php echo base_url; ?>HistorialTechos">
                                            <div class="sb-nav-link-icon"><i class="fas fa-home text-primary"></i></div>Historial Presupuesto Techo
                                        </a>
                                    </nav>
                                </div>
                                <div class="nav">
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts4" aria-expanded="false" aria-controls="collapseLayouts">
                                    <div class="sb-nav-link-icon text-info"><i class="fas fa-history"></i></div>
                                    Presupuesto General
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseLayouts4" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="<?php echo base_url; ?>General">
                                            <div class="sb-nav-link-icon"><i class="fas fa-layer-group text-primary"></i></div>Presupuesto General
                                        </a>
                                    </nav>
                                </div>
                            </div>
                                <script>
                                    const colorSelector = document.getElementById('colorSelector');
                                    const navItems = document.querySelectorAll('.bg-dark-xD');

                                    // Obtener el color seleccionado de sessionStorage (si existe)
                                    const selectedColor = sessionStorage.getItem('selectedColor');

                                    // Establecer el color seleccionado en el selector
                                    if (selectedColor) {
                                        colorSelector.value = selectedColor;

                                        navItems.forEach(item => {
                                            item.classList.remove('bg-custom1', 'bg-custom2', 'bg-custom3', 'bg-custom4', 'bg-warning', 'bg-custom6');
                                            item.classList.add(selectedColor);
                                        });
                                    }

                                    colorSelector.addEventListener('change', function() {
                                        const selectedColor = colorSelector.value;

                                        // Almacenar el color seleccionado en sessionStorage
                                        sessionStorage.setItem('selectedColor', selectedColor);

                                        navItems.forEach(item => {
                                            item.classList.remove('bg-custom1', 'bg-custom2', 'bg-custom3', 'bg-custom4', 'bg-warning', 'bg-custom6');
                                            item.classList.add(selectedColor);
                                        });
                                    });
                                        
                                </script>
                            </div>
                            
                        </div>
                                <div class=" text-primary">
                                    <h6 align="center" class= "text-white"><?php echo $_SESSION['nombre']; ?></h6>
                                    <div class="small text-success" align="center" style="font-weight: bold;"> En linea</div>
                                </div>
                                 <br>
                                <div id="miDiv1" style="color: white; display: none;">
                                    <select id="colorSelector1" class="form-select mt-2 text-white" style="background-color: transparent; border: none; outline: none;" onchange="toggleVisibility1()">
                                        <option  class="text-black"value="" selected disabled>Color</option>
                                        <option  class="text-black"value="" selected disabled>-----------</option>
                                        <option class="text-black" value="bg-custom11">Azul</option>
                                        <option class="text-black" value="bg-custom22">Amarillo</option>
                                        <option class="text-black" value="bg-custom33">Claro</option>
                                        <option class="text-black" value="bg-custom44">Rojo</option>
                                        <option class="text-black" value="bg-custom5">Darck</option>
                                        <option class="text-black" value="bg-custom66">Verde</option>
                                    </select>
                                </div>
                                <button  class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0 text-white" onclick="toggleVisibility1()"><i class="fas fa-cog"></i></button>
                                    <script>
                                        function toggleVisibility1() {
                                        var div = document.getElementById("miDiv1");
                                        if (div.style.display === "none") {
                                            div.style.display = "block";
                                        } else {
                                            div.style.display = "none";
                                        }
                                        }
                                    </script>
                                    <script>
                                    const colorSelector1 = document.getElementById('colorSelector1');
                                    const sidenavdark = document.querySelectorAll('.sb-sidenav-dark');

                                    // Obtener el color seleccionado de sessionStorage (si existe)
                                    const selectedColor1 = sessionStorage.getItem('selectedColor1');

                                    // Establecer el color seleccionado en el selector
                                    if (selectedColor1) {
                                        colorSelector1.value = selectedColor1;

                                        sidenavdark.forEach(item => {
                                            item.classList.remove('bg-custom11', 'bg-custom22', 'bg-custom33', 'bg-custom44', 'bg-warning', 'bg-custom66');
                                            item.classList.add(selectedColor1);
                                        });
                                    }

                                    colorSelector1.addEventListener('change', function() {
                                        const selectedColor1 = colorSelector1.value;

                                        // Almacenar el color seleccionado en sessionStorage
                                        sessionStorage.setItem('selectedColor1', selectedColor1);

                                        sidenavdark.forEach(item => {
                                            item.classList.remove('bg-custom11', 'bg-custom22', 'bg-custom33', 'bg-custom44', 'bg-warning', 'bg-custom66');
                                            item.classList.add(selectedColor1);
                                        });
                                    });
                                </script>
                    </nav>
                </div>
                
            </div>
          
        </div>
        <div class="fondoxD" id="layoutSidenav_content" >
            <main>
                <div class="container-fluid px-4 mt-2"> 