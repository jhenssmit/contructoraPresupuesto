<?php include "Views/Templates/header.php"; ?>

    <div class="image-xD">
                    <img src="Assets/images/Logo.png" alt="Logo"></img>
                </div>
    <div class="col-md-8 mx-auto">
    <div class="card radius-10 border-start border-0 border-3 border-info ">
        <div class="card-body ">
            <div class="card radius-10 border-start border-4 border-5 border-dark bg-dark">
              <h6 class="card-title text-center text-white">Datos de usuario</h6>
            </div>
            <hr>
           
            <form id="fghj" onsubmit="">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <h5 style="color:#445D7C; font-weight: bold;">Nombre de Usuario:</h5>
                            <h5><?php echo $_SESSION['usuario']; ?></h5>     
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <h5 style="color:#445D7C; font-weight: bold;">Apellidos y Nombres:</h5>
                            <h5><?php echo $_SESSION['nombre']; ?></h5>
                        </div>
                    </div>
                    
                </div>
                
            </form>
        </div>
    </div>
</div>
<div class="col-md-8 mx-auto">
    <div class="card radius-10 border-start border-0 border-3 border-info">
        <div class="card-body">
            <div class="card radius-10 border-start border-4 border-5 border-dark bg-dark">
             <h6 class="card-title text-center text-info">Modificar contraseña</h6>
            </div>
            <hr>
            <form id="frmCambiarPass" onsubmit="frmCambiarPass(event);">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input id="clave_actual" type="password" class="form-control" placeholder="Contraseña" name="clave_actual" value="">
                            <label for="clave_actual"><i class="fas fa-key"></i> Contraseña Actual</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input id="clave_nueva" type="password" class="form-control" placeholder="Nueva Contraseña" name="clave_nueva" value="">
                            <label for="clave_nueva"><i class="fas fa-key"></i> Nueva Contraseña</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input id="confirmar_clave" type="password" class="form-control" placeholder="Confirmar Contraseña" name="confirmar_clave" value="">
                            <label for="confirmar_clave"><i class="fas fa-key"></i> Confirmar Contraseña</label>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                <button class="btn btn-primary" type="submit">Modificar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>