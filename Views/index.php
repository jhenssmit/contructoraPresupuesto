<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="Assets/images/logoxD1.png" type="">
    <title>Inicio Sesión</title>
    <link href="<?php echo base_url; ?>Assets/css/styles.css" rel="stylesheet" />
    <script src="<?php echo base_url; ?>Assets/js/all.min.js" crossorigin="anonymous"></script>
    <style type="text/css"> h3 { color: orange; } .container-fluid {
            position: relative;
            margin: 0;
            padding-bottom: 5px; /* Alto del footer */
        }</style>
</head>

<body  class="imgxD" style="background: url('Assets/images/img2.jpg') no-repeat; background-size: cover;">
    <div style="position: absolute; top: 50px; left: 10px;">
        <img src="Assets/images/blanco.png" alt="Logo" style="max-width: 350px;"></img>
    </div>

    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>   
                <div style="height: 20vh;"></div>
            <div class ="conteinerxD" >
                <div class="container" >
            
                    <div class="row justify-content-center" >
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5" style="background: linear-gradient(rgba(5, 7, 12, 0.95), rgba(5, 7, 12, 0.40));">
                                <div class="card-header text-center">
                                    <h3 class="font-weight-light my-4" style="color: #8A5B25">Iniciar Sesión</h3>
                                </div>
                                    <div class="alert border-0 border-start border-5 border-info alert-dismissible fade show py-2 text-white">
                                        <div class="d-flex align-items-center">
                                            <div class="font-35 text-info"><i class='bx bx-info-square'></i>
                                            </div>
                                            <div class="ms-3">
                                                <h6 class="mb-0 text-info">Advertencia</h6>
                                                <div>Todo los campos con <b class="text-danger"> * </b> son obligatorios</div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <div class="card-body">
                                    <form id="frmLogin">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="usuario" name="usuario" type="email" placeholder="Ingrese su usuario" />
                                            <label for="usuario"><i class="fas fa-user"></i> Usuario <span class="text-danger fw-bold">*</span></label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="clave" name="clave" type="password" placeholder="ingrese su contraseña" />
                                            <label for="clave"><i class="fas fa-key"></i> Contraseña <span class="text-danger fw-bold">*</span></label>
                                        </div>
                                        <div class="alert alert-danger text-center d-none" role="alert" id="alerta">

                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <button class="btn btn text-white" style= "background: #857E4C; box-shadow: 2px 2px 8px rgba(0, 0, 0, 25);" type="submit" onclick="frmLogin(event);">Iniciar Sesión</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </main>
        </div>
    
        <div style="background: linear-gradient(rgba(255, 255, 255, 0.3), rgba(250, 250, 250, 0.9));">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-black">Copyright &copy; E'CONS PERÚ S.A.C <?php echo date("Y") ?></div>
                        <div>
                            <a href="#">Políticas de Privacidad</a>
                            &middot;
                            <a href="#">Términos &amp; Condiciones</a>
                        </div>
                    </div>
                </div>
        </div>
    <script src="<?php echo base_url; ?>Assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="<?php echo base_url; ?>Assets/js/scripts.js"></script>
    <script>
        const base_url = "<?php echo base_url; ?>";
    </script>
    <script src="<?php echo base_url; ?>Assets/js/login.js"></script>
    </body>
</html>