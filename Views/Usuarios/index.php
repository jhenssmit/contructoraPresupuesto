<?php include "Views/Templates/header.php"; ?>

<div class="card">
    <div class="card-header bg-dark text-white">
        Usuarios
    </div>
<div class="card-body pt-0 pb-0"> 
    <table id="tblUsuario">
            <thead>
                <tr>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
</div>
        <!--<button class="btn btn-primary mb-2" type="button" onclick="frmUsuario();"><i class="fas fa-plus"></i></button>-->
<div class="card-body pt-0 pb-0">     
        <table class="table table-light table-bordered table-hover" id="tblUsuarios">
            <thead class="thead-dark">
                <tr>
                    <th>Permisos</th>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Nombre</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
</div>
</div>
<div id="nuevo_usuario" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-primary">
                <h5 class="modal-title text-white" id="title">Nuevo Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                                    <div class="alert border-0 border-start border-5 border-info alert-dismissible fade show py-2 text-white">
                                         <div class="d-flex align-items-center">
                                            <div class="font-35 text-info"><i class='bx bx-info-square'></i>
                                            </div>
                                            <div class="ms-3">
                                                <h6 class="mb-0 text-primary">Advertencia</h6>
                                                <div class="text-black">Todo los campos con <b class="text-danger"> * </b> son obligatorios</div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
            <div class="modal-body">
                <form id="frmUsuario">
                    <div class="form-group">
                        <div class="form-floating mb-3">
                            <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre del Usuario">
                            <label for="nombre">Nombre <span class="text-danger fw-bold">*</span> </label>
                        </div>
                        <div class="form-floating mb-3">
                            <select id="rol" class="form-control" name="rol">
                                <?php foreach ($data['rol'] as $row) { ?>
                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['rol']; ?></option>
                                <?php  } ?>
                            </select>
                            <label for="rol">Rol <span class="text-danger fw-bold">*</span></label>
                        </div><br>
                        <h6 class="modal-title text-dark">Credenciales:</h6>
                        <br>
                        <div class="form-floating mb-3">
                            <input type="hidden" id="id" name="id">
                            <input id="usuario" class="form-control" type="text" name="usuario" placeholder="Usuario">
                            <label for="usuario">Usuario <span class="text-danger fw-bold">*</span></label>
                        </div>
                    </div>
                    <div class="row" id="claves">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input id="clave" class="form-control" type="password" name="clave" placeholder="Contraseña" required/>
                                <label for="clave">Contraseña <span class="text-danger fw-bold">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input id="confirmar" class="form-control" type="password" name="confirmar" placeholder="Confirmar Contraseña" required/>
                                <label for="confirmar">Confirmar Contraseña <span class="text-danger fw-bold">*</span></label>
                            </div>
                        </div>
                    </div><br>
                    
                    <button class="btn btn-primary" type="button" onclick="RegistrarUser(event);" id="btnAction">Registrar</button>
                    <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include "Views/Templates/footer.php"; ?>