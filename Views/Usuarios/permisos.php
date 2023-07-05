<?php include "Views/Templates/header.php"; ?>
<script>
  function activarTodos() {
    var checkboxes = document.querySelectorAll('input[name="permisos[]"]');
    checkboxes.forEach(function(checkbox) {
      checkbox.checked = true;
    });
  }

  function desactivarTodos() {
    var checkboxes = document.querySelectorAll('input[name="permisos[]"]');
    checkboxes.forEach(function(checkbox) {
      checkbox.checked = false;
    });
  }
</script>
<div class="col-md-8 mx-auto">
   <div class="card">
     <div class="card-header text-center bg-dark text-white">
        Asignar Permisos
     </div>
     <div class="card-body">
        <form id="formulario" onsubmit="registrarPermisos(event)">
        <div class="row">
            <div class="col-md-6 text-center text-capitalize p-2">
              <button class="btn btn-success" type="button" onclick="activarTodos()">Activar todos</button>
            </div>
            <div class="col-md-6 text-center text-capitalize p-2">
              <button class="btn btn-secondary" type="button" onclick="desactivarTodos()">Desactivar todos</button>
            </div>
            <?php foreach ($data['datos'] as $row) {  ?>
              <div class="col-md-3 text-center text-capitalize p-3">
                <label  for=""><?php echo $row['permiso']; ?></label><br>
                <label class="switch">
                  <input type="checkbox" name="permisos[]" value="<?php echo $row['id']; ?>" <?php echo isset($data['asignados'] [$row['id']]) ? 'checked' : ''; ?>>
                  <span class="slider round"></span>
                </label>
              </div>
            <?php }?>  
            <input type="hidden" value="<?php echo $data['id_usuario']; ?>" name="id_usuario">
        </div>
        <div class="d-grid gap-2">
            <button class="btn btn-outline-primary" type="submit">Asignar Permisos</button>
            <a class="btn btn-outline-danger" href="<?php echo base_url; ?>Usuarios">Cancelar</a>
        </div> 
        </form>
     </div>
   </div>
</div>
<?php include "Views/Templates/footer.php"; ?>