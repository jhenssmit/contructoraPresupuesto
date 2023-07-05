<?php include "Views/Templates/header.php"; ?>

<div class="card">
    <div class="card-header bg-dark text-white">
        Roles
    </div>
<div class="card-body">   
        <button class="btn btn-primary mb-2" type="button" onclick="frmRol();"><i class="fas fa-plus"></i></button>
        <table class="table table-light table-bordered table-hover" id="tblRol">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
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
<div id="nuevo_rol" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-primary">
                <h5 class="modal-title text-white" id="title">Nuevo Rol</h5>
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
                <form id="frmRol">
                    <div class="form-group">
                        <div class="form-floating mb-3">
                            <input type="hidden" id="id" name="id">
                            <input id="rol" class="form-control" type="text" name="rol" placeholder="Nombre del Rol">
                            <label for="rol">Rol<span class="text-danger fw-bold">*</span> </label>
                        </div>
                    </div>
                    <br> 
                    <button class="btn btn-primary" type="button" onclick="RegistrarRol(event);" id="btnAction">Registrar</button>
                    <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include "Views/Templates/footer.php"; ?>