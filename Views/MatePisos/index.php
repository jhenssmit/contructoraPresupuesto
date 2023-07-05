<?php
include "Views/Templates/header.php"; ?>
<div class="card">
    <div class="card-header bg-dark text-white">
        Materiales Pisos
    </div>
    <div class="card-body pt-0 pb-0"> 
      <table id="tblMatePi">
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
<div class="card-body pt-0 pb-0">   
<!--<button class="btn btn-primary mb-2" type="button" onclick="frmMatePiso();"><i class="fas fa-plus"></i></button>-->
<table class="table table-light table-bordered table-hover" id="tblMatePiso">
    <thead class="thead-dark">
        <tr>
            <th>Elemento</th>
            <th>Nombre</th>
            <th>Unidad de Medida</th>
            <th>Cantidad</th>
            <th>PrecioBajo</th>
            <th>PrecioMedio</th>
            <th>PrecioAlto</th>
            <th>manoObra</th>
            <th>Estado</th>
            <th></th>
            <th hidden></th>
            <th hidden></th>
            <th hidden></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
</div>
</div>
<div id="nuevo_matepiso" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" style= "box-shadow: 10px 10px 80px rgba(0, 0, 0, 100);  border-radius: 35px; ">
        <div class="modal-content">
            <div class="modal-header text-white" style="background-color:slategrey">
                <h5 class="modal-title text-white" id="title">Nuevo Material</h5>
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
                <form id="frmMatePiso">
                    <div class="form-floating mb-3">
                        <input type="hidden" id="id" name="id">
                        <input value="1" type="hidden" id="id_elemento" name="id_elemento">
                        <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre del Material">
                         <label for="nombre">Nombre <span class="text-danger fw-bold">*</span></label>
                    </div>
                    <div class="form-floating mb-3">
                            <select id="medida" class="form-control" name="medida">
                                <?php foreach ($data['medida'] as $row) { ?>
                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['medida']; ?></option>
                                <?php  } ?>
                            </select>
                            <label for="medida">Unidad de Medida <span class="text-danger fw-bold">*</span></label>
                    </div>
                    <div class="form-floating mb-3">
                        <input id="cantidad" class="form-control" type="number" name="cantidad" placeholder="cantidad">
                        <label for="cantidad">Cantidad <span class="text-danger fw-bold">*</span></label>
                    </div>
                    <div class="form-floating mb-3">
                        <input id="precioBajo" class="form-control" type="number" name="precioBajo" placeholder="precioBajo">
                        <label for="precioBajo">Precio Bajo <span class="text-danger fw-bold">*</span></label>
                    </div>
                    <div class="form-floating mb-3">
                        <input id="precioMedio" class="form-control" type="number" name="precioMedio" placeholder="precioMedio">
                          <label for="precioMedio">Precio Medio <span class="text-danger fw-bold">*</span></label>
                    </div>
                    <div class="form-floating mb-3">
                        
                        <input id="precioAlto" class="form-control" type="number" name="precioAlto" placeholder="precioAlto">
                        <label for="precioAlto">Precio Alto <span class="text-danger fw-bold">*</span></label>
                    </div><br>
                    <div class="form-floating mb-3">
                        <input id="manoObra" class="form-control" type="number" name="manoObra" placeholder="manoObra">
                        <label for="manoObra">manoObra <span class="text-danger fw-bold">*</span></label>
                    </div><br>
                    <button class="btn btn-primary" type="button" onclick="RegistrarMatePiso(event);" id="btnAction">Registrar</button>
                    <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include "Views/Templates/footer.php"; ?>