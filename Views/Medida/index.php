<?php
include "Views/Templates/header.php"; ?>
<div class="card">
    <div class="card-header bg-dark text-white">
        Medidas
    </div>
    <div class="card-body pt-0 pb-0"> 
      <table id="tblMedida">
            <thead>
                <tr>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
<div class="card-body pt-0 pb-0">
    <!--<button class="btn btn-primary mb-2" id ="btnRegistrar" type="button" onclick="frmMateriales();"><i class="fas fa-plus"></i></button>-->
<table class="table table-light table-bordered table-hover" id="tblMedidas">
    <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Diminutivo</th>
            <th>Estado</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    </tbody>   
    </table>
  </div>
</div>
<div id="nueva_medida" class="modal fade" tabindex="-1"  role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" style= "box-shadow: 10px 10px 80px rgba(0, 0, 0, 100);  border-radius: 35px; ">
        <div class="modal-content">
            <div class="modal-header  text-white" style="background-color:slategrey">
                <h5 class="modal-title text-white" id="title">Nueva Medida</h5>
                <button type="button" class="btn-close  btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
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
                <form id="frmMedida">
                <div class="form-group">
                         <div class="form-floating mb-3">
                             <input type="hidden" id="id" name="id">
                            <input id="medida" class="form-control" type="text" name="medida" placeholder="Nombre del Material">
                            <label for="medida">Nombre <span class="text-danger fw-bold">*</span></label>
                        </div>
                       
                    
                    <div class="form-floating mb-3">
                        <input id="diminutivo" class="form-control" type="text" name="diminutivo" placeholder="diminutivo">
                        <label for="diminutivo">Diminutivo <span class="text-danger fw-bold">*</span></label>
                    </div>
                </div><br>
                    <button class="btn btn-primary" type="button" onclick="RegistrarMedida(event);" id="btnAction">Registrar</button>
                    <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include "Views/Templates/footer.php"; ?>