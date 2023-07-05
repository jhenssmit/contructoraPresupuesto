<?php include "Views/Templates/header.php"; ?>
<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card bg-color4">
            <div class="card-body d-flex justify-content-between text-white">
                Usuarios
                <i class="fas fa-user fa-2x"></i>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a href="<?php echo base_url; ?>Usuarios" class="text-white">Ver Detalles</a>
                <span class="text-white"><?php echo $data['usuarios']['total'] ?></span>

            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-color5">
            <div class="card-body d-flex justify-content-between text-white">
                Materiales para piso
                <i class="fas fa-layer-group fa-2x"></i>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a href="<?php echo base_url; ?>MatePisos" class="text-white">Ver Detalles</a>
                <span class="text-white"><?php echo $data['materiales']['total'] ?></span>

            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-color6">
            <div class="card-body d-flex justify-content-between text-white">
                Materiales para pared
                <i class="fas fa-border-all fa-2x"></i>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a href="<?php echo base_url; ?>MateParedes" class="text-white">Ver Detalles</a>
                <span class="text-white"><?php echo $data['materiale']['total'] ?></span>

            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-color7">
            <div class="card-body d-flex justify-content-between text-white">
                Materiales para techo
                <i class="fas fa-home fa-2x"></i>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a href="<?php echo base_url; ?>MateTechos" class="text-white">Ver Detalles</a>
                <span class="text-white"><?php echo $data['material']['total'] ?></span>

            </div>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-xl-3 col-md-6">
        <div class="card bg-color8">
            <div class="card-body d-flex justify-content-between text-white">
                Unidad de Medida
                <i class="fas fa-user fa-2x"></i>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a href="<?php echo base_url; ?>Medida" class="text-white">Ver Detalles</a>
                <span class="text-white"><?php echo $data['medidas']['total'] ?></span>

            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-color1">
            <div class="card-body d-flex justify-content-between text-white">
                Historial Materiales para piso
                <i class="fas fa-layer-group fa-2x"></i>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a href="<?php echo base_url; ?>HistorialPisos" class="text-white">Ver Detalles</a>
                <span class="text-white"><?php echo $data['historial']['total'] ?></span>

            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-color2">
            <div class="card-body d-flex justify-content-between text-white">
                Historial Materiales para pared
                <i class="fas fa-border-all fa-2x"></i>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a href="<?php echo base_url; ?>HistorialParedes" class="text-white">Ver Detalles</a>
                <span class="text-white"><?php echo $data['historial1']['total'] ?></span>

            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-color3">
            <div class="card-body d-flex justify-content-between text-white">
                Historial Materiales para techo
                <i class="fas fa-home fa-2x"></i>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a href="<?php echo base_url; ?>HistorialTechos" class="text-white">Ver Detalles</a>
                <span class="text-white"><?php echo $data['historial2']['total'] ?></span>

            </div>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-xl-4">
        <div class="card">
           <div class="card-header bg-dark text-white">
                 Historial pisos
           </div>
           <div class="card-body">
            <canvas id="HistorialPiso" width="400" height="400"></canvas>

           </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="card">
           <div class="card-header bg-dark text-white">
                 Historial pared
           </div>
           <div class="card-body">
           <canvas id="HistorialPared" width="400" height="400"></canvas>
           </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="card">
           <div class="card-header bg-dark text-white">
                 Historial techo
           </div>
           <div class="card-body">
           <canvas id="HistorialTecho" width="400" height="400"></canvas>
           </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>