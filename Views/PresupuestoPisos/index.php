<?php
include "Views/Templates/header.php";


// recuperar los datos de las cookies
$formularioDatos4 = isset($_COOKIE['formularioDatos4']) ? json_decode($_COOKIE['formularioDatos4'], true) : array();



// agregar nuevos datos al array
if(isset($_POST['submit'])) {
    $nuevoDato = array(
        'nombre' => $_POST['nombre'],
        'cantidad' => $_POST['cantidad'],
        'precioBajo' => $_POST['precioBajo'],
        'precioMedio' => $_POST['precioMedio'],
        'precioAlto' => $_POST['precioAlto'],
        'totalBajo' => $_POST['totalBajo'],
        'totalMedio' => $_POST['totalMedio'],
        'totalAlto' => $_POST['totalAlto'],
        'manoObra' => $_POST['manoObra']
    );
    $formularioDatos4[] = $nuevoDato;

    // guardar los datos en la cookie y localStorage
    setcookie('formularioDatos4', json_encode($formularioDatos4), time() + 3600, '/');
    echo "<script>localStorage.setItem('formularioDatos4', JSON.stringify(" . json_encode($formularioDatos4) . "));</script>";
}


//total de presupuesto

if(empty($_POST['totalPresupuesto1'])) {
  $totalPresupuesto1 = 0;
} else {
  $totalPresupuesto1 = $_POST['totalPresupuesto1'];
}


$tablaHTML = ''; // Variable para almacenar el código HTML de la tabla

// Verificar si la clave "usuario" está definida en el array $_COOKIE
if (isset($_COOKIE['usuario'])) {
  // Obtener el usuario almacenado en la cookie
  $usuarioLogeado = $_COOKIE['usuario'];

  // Utilizar el valor del usuario en tu aplicación
  //echo "Usuario logeado: " . $usuarioLogeado;
} else {
  echo "No se ha encontrado el usuario logeado.";
}

// Generar el código HTML de la tabla

$tablaHTML ='<table class="table table-light table-bordered table-hover">
              <thead class="thead-dark">
                <tr>
                  <th>Nombre</th>
                  <th>Cantidad</th>
                  <th>Precio Bajo</th>
                  <th>Precio Medio</th>
                  <th>Precio Alto</th>
                  <th>ManoObra</th>
                </tr>
              </thead>
              <tbody>';

$totalCantidad = 0;
$totalPrecioBajo = 0;
$totalPrecioMedio = 0;
$totalPrecioAlto = 0;
$totalManoObra1 = 0;
$manoObra = 0;
// Iniciar el formulario
$formularioHTML = '<form id="formularioDatos" method="post" action="http://localhost/constructora/Views/Historial/historialPiso.php">';
//bucle de los datos
foreach ($formularioDatos4 as $key => $data) {
  $manoObra = $data['manoObra'] / 100;
  $manoObra1 = $manoObra * $totalPresupuesto1;
  $precioIndividualBajo = $data['totalBajo'] * $totalPresupuesto1;
  $Cantidad1 = $precioIndividualBajo / $data['precioBajo'];
  $cantidad2 = ceil($Cantidad1) * $data['precioBajo'];
  $precioIndividualMedio = $data['totalMedio'] * $totalPresupuesto1;
  $cantidad3 = ceil($Cantidad1) * $data['precioMedio'];
  $precioIndividualAlto = $data['totalAlto'] * $totalPresupuesto1;
  $cantidad4 = ceil($Cantidad1) * $data['precioAlto'];
  
  $totalCantidad += ceil($Cantidad1);
  $totalPrecioBajo += $cantidad2;
  $totalPrecioMedio += $cantidad3;
  $totalPrecioAlto += $cantidad4;
  $totalManoObra1 += $manoObra1;


  $fila = '<tr><td>' . $data['nombre'] . '</td>
                <td>' . ceil($Cantidad1) . '</td>
                <td>S/ ' . number_format($cantidad2, 2) . '</td>
                <td>S/ ' . number_format($cantidad3, 2) . '</td>
                <td>S/ ' . number_format($cantidad4, 2) . '</td>
                <td>S/ ' . number_format($manoObra1, 2) . '</td>

          </tr>';
  $tablaHTML .= $fila;
  $formularioHTML .= '<input type="hidden" name="nombre[]" value="' . $data['nombre'] . '">';
    $formularioHTML .= '<input type="hidden" name="cantidad[]" value="' . ceil($Cantidad1) . '">';
    $formularioHTML .= '<input type="hidden" name="precioBajo[]" value="' . $cantidad2 . '">';
    $formularioHTML .= '<input type="hidden" name="precioMedio[]" value="' . $cantidad3 . '">';
    $formularioHTML .= '<input type="hidden" name="precioAlto[]" value="' . $cantidad4 . '">';
    $pared = "1";
    $formularioHTML .= '<input type="hidden" name="idElemento[]" value="' . $pared . '">';
    $formularioHTML .= '<input type="hidden" name="precioBajoT[]" value="' . $totalPrecioBajo + $totalManoObra1  . '">';
    $formularioHTML .= '<input type="hidden" name="precioMedioT[]" value="' . $totalPrecioMedio+ $totalManoObra1  . '">';
    $formularioHTML .= '<input type="hidden" name="precioAltoT[]" value="' . $totalPrecioAlto+ $totalManoObra1  . '">';
    $formularioHTML .= '<input type="hidden" name="user[]" value="' .  $usuarioLogeado . '">';
    $formularioHTML .= '<input type="hidden" name="manoObra[]" value="' .  $manoObra1 . '">';
    $formularioHTML .= '<input type="hidden" name="manoObra1[]" value="' .  $totalManoObra1 . '">';
    date_default_timezone_set('America/Lima');
    $formularioHTML .= '<input type="hidden" name="fechaEnv[]" value="' .  date('Y-m-d H:i:s') . '">';
    
}
    
$formularioHTML .= '<button type="submit" class="btn btn-success">Agregar al Historial</button></form>';
    
$tablaHTML .= '<tfoot>
<tr>
    <td colspan="2"><strong>ManoObra:</strong></td>
    <td>S/ ' . number_format($totalManoObra1, 2) . '</td>
    <td>S/ ' . number_format($totalManoObra1, 2) . '</td>
    <td>S/ ' . number_format($totalManoObra1, 2) . '</td>
  </tr>
  <tr>
    <td colspan="2"><strong>Total:</strong></td>
    <td>S/ ' . number_format($totalPrecioBajo + $totalManoObra1, 2) . '</td>
    <td>S/ ' . number_format($totalPrecioMedio+ $totalManoObra1, 2) . '</td>
    <td>S/ ' . number_format($totalPrecioAlto+ $totalManoObra1, 2) . '</td>
  </tr>
</tfoot>';

$tablaHTML .= '</tbody></table>';



?>

<style>
  .table {
    border-collapse: collapse; /* Combina los bordes adyacentes en uno solo */
  }
  
  .table th, .table td {
    border: 1px solid black; /* Establece un borde de 1 píxel para las celdas */
    padding: 8px; /* Añade un espacio interno a las celdas para mayor legibilidad */
  }
  
  .table.thick-border th, .table.thick-border td {
    border-width: 2px; /* Establece el ancho del borde en 2 píxeles */
  }
</style>
<div class="card">
    <div class="card-header bg-dark text-white">
    Presupuesto de Materiales que van en los pisos
    </div>
<div class="card-body pt-0 pb-0">   
    <br>
<?php if (empty($formularioDatos4)): ?>
  <table class="table table-light table-bordered table-hover">
    <thead class="thead-dark">
      <tr>
        <th>Nombre</th>
        <th>Precio Bajo * unidad</th>
        <th>Precio Medio * unidad</th>
        <th>Precio Alto * unidad</th>
        <th>ManoObra</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td colspan="6"><div style="text-align: center; font-size: 30px; color:#1e90ff; font-weight: bold;">No hay datos.</div></td>
      </tr>
    </tbody>
  </table>
<?php else: ?>
  <table class="table table-light table-bordered table-hover">
    <thead class="thead-dark">
      <tr>
        <th>Nombre</th>
        <th>Precio Bajo * unidad</th>
        <th>Precio Medio * unidad</th>
        <th>Precio Alto * unidad</th>
        <th>ManoObra</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($formularioDatos4 as $key => $data): ?>
        <tr>
          <td><?php echo $data['nombre']; ?></td>
          <td>S/ <?php echo $data['precioBajo']; ?></td>
          <td>S/ <?php echo $data['precioMedio']; ?></td>
          <td>S/ <?php echo $data['precioAlto']; ?></td>
          <td>S/ <?php echo $data['manoObra']; ?></td>
          <td><button class="btn btn-danger" onclick="eliminarFila4('<?php echo $data['nombre']; ?>')">Eliminar</button></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; 
$message = isset($_GET['message']) ? $_GET['message'] : "";

if (!empty($message)) {
  echo '<script>
      window.addEventListener("DOMContentLoaded", function() {
          var messageElement = document.getElementById("message");
          messageElement.innerHTML = "'. $message .'";
          messageElement.style.display = "block";
          setTimeout(function() {
              messageElement.style.display = "none";
              // Redirigir a la página de PresupuestoTecho
              window.location.href = "http://localhost/constructora/PresupuestoPisos";
          }, 3000);
      });
  </script>';
  unset($_GET['message']);
}?>
<form action="PresupuestoPisos" method="post">
  <label for="">Agregar Metraje</label><br>
  <input type="number" step="any" name="totalPresupuesto1" id="totalPresupuesto1" value="<?php echo $totalPresupuesto1 === null ? 0 : $totalPresupuesto1;?>"><br><br>
  <button class="btn btn-primary" type="submit">Actualizar total</button> 
</form><br>
<p class="alert alert-info" id="message" style="display: none;"></p>
<?php echo $tablaHTML;
echo $formularioHTML;?>

</div>
</div>

<?php include "Views/Templates/footer.php"; ?>