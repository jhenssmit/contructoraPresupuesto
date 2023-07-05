<?php
include "Views/Templates/header.php"; ?>

<div class="card">
    <div class="card-header bg-dark text-white">
        Materiales Paredes
    </div>
<div class="card-body">   
<button class="btn btn-success mb-2" type="button"><a class="dropdown text-white" href="<?php echo base_url; ?>MateParedes" ><i class="fas fa-solid fa-eye"></i></a></button>
<table class="table table-light table-bordered table-hover" id="tblMateParedIn">
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
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
</div>
</div>

<?php include "Views/Templates/footer.php"; ?>