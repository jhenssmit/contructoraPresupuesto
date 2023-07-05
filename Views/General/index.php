<?php include "Views/Templates/header.php"; ?>

<div class="card">
    <div class="card-header bg-dark text-white">
        Presupuesto Total General
    </div>
    <div class="card-body">
        <style>
            .table {
                border-collapse: collapse;
            }

            .table th,
            .table td {
                border: 1px solid black;
                padding: 8px;
            }

            .table.thick-border th,
            .table.thick-border td {
                border-width: 2px;
            }
        </style>

        <table id="datosTabla" class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Fecha</th>
                    <th>Precio Bajo</th>
                    <th>Precio Medio</th>
                    <th>Precio Alto</th>
                    <th class="print-only">Acciones</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        <button id="btnImprimir" class="btn btn-primary print-only">Imprimir Presupuesto</button> <!-- Botón para imprimir la tabla -->
    </div>
</div>
<style media="print">
    .print-only,
    .acciones-cell {
        display: none;
    }
</style>

<script>
    // Obtener los datos del localStorage
    var datosTotalesJSON = localStorage.getItem('datosTotales');
    var datosTotales = JSON.parse(datosTotalesJSON);

    // Obtener la referencia a la tabla
    var tabla = document.getElementById('datosTabla');

    // Variables para almacenar los totales
    var totalBajo = 0;
    var totalMedio = 0;
    var totalAlto = 0;

    function mostrarMensajeSinDatos() {
        var filaMensaje = document.createElement('tr');
        var mensajeCell = document.createElement('td');
        mensajeCell.textContent = 'No hay datos disponibles';
        mensajeCell.colSpan = 6;
        filaMensaje.appendChild(mensajeCell);
        tabla.appendChild(filaMensaje);
    }

    function actualizarTotales() {
  // Calcular los totales
  totalBajo = 0;
  totalMedio = 0;
  totalAlto = 0;
  for (var j = 0; j < datosTotales.length; j++) {
    totalBajo += parseFloat(datosTotales[j].precioBajoT);
    totalMedio += parseFloat(datosTotales[j].precioMedioT);
    totalAlto += parseFloat(datosTotales[j].precioAltoT);
  }

  if (datosTotales.length > 0) {
    // Actualizar los totales en la fila correspondiente
    var filaTotal = tabla.rows[tabla.rows.length - 1];
    var totalBajoCell = filaTotal.cells[2];
    var totalMedioCell = filaTotal.cells[3];
    var totalAltoCell = filaTotal.cells[4];
    totalBajoCell.textContent = "S/ " + totalBajo.toFixed(2);
    totalMedioCell.textContent = "S/ " + totalMedio.toFixed(2);
    totalAltoCell.textContent = "S/ " + totalAlto.toFixed(2);
    filaTotal.style.display = ''; // Mostrar la fila de totales
  } else {
    // Ocultar la fila de totales
    tabla.rows[tabla.rows.length - 1].style.display = 'none';
  }

  if (datosTotales.length === 0) {
    mostrarMensajeSinDatos(); // Mostrar el mensaje "No hay datos disponibles"
  }
}
    function eliminarFila(indice) {
        // Eliminar el dato correspondiente del arreglo datosTotales
        datosTotales.splice(indice, 1);

        // Actualizar el localStorage con el arreglo actualizado
        localStorage.setItem('datosTotales', JSON.stringify(datosTotales));

        // Eliminar la fila de la tabla
        tabla.deleteRow(indice + 1);

        actualizarTotales();
    }

    function crearFila(datos) {
        var fila = tabla.insertRow();

        var nombreCell = fila.insertCell();
        nombreCell.textContent = datos.nombre;
        nombreCell.style.fontWeight = 'bold';

        var fechaCell = fila.insertCell();
        fechaCell.textContent = datos.fecha;

        var precioBajoCell = fila.insertCell();
        precioBajoCell.textContent = "S/ " + datos.precioBajoT;

        var precioMedioCell = fila.insertCell();
        precioMedioCell.textContent = "S/ " + datos.precioMedioT;

        var precioAltoCell = fila.insertCell();
        precioAltoCell.textContent = "S/ " + datos.precioAltoT;

        // Sumar los valores a los totales correspondientes
        totalBajo += parseFloat(datos.precioBajoT);
        totalMedio += parseFloat(datos.precioMedioT);
        totalAlto += parseFloat(datos.precioAltoT);

        // Agregar una columna para las acciones
        var accionesCell = fila.insertCell();
        accionesCell.classList.add('acciones-cell');
        var eliminarBtn = document.createElement('button');
        eliminarBtn.textContent = 'Eliminar';
        eliminarBtn.classList.add('btn', 'btn-danger', 'print-only'); // Estilo del botón y clase print-only
        eliminarBtn.addEventListener('click', function () {
            var indice = datosTotales.indexOf(datos);
            eliminarFila(indice);
        });

        accionesCell.appendChild(eliminarBtn);
    }

    function inicializarTabla() {
        if (datosTotales && datosTotales.length > 0) {
            for (var i = 0; i < datosTotales.length; i++) {
                var datos = datosTotales[i];
                crearFila(datos);
            }

            // Agregar fila para mostrar los totales
            var filaTotal = tabla.insertRow();
            var totalCell = filaTotal.insertCell();
            totalCell.textContent = 'Total:';
            totalCell.style.fontWeight = 'bold';
            totalCell.colSpan = 2;
            var totalBajoCell = filaTotal.insertCell();
            totalBajoCell.textContent = "S/ " + totalBajo.toFixed(2);
            var totalMedioCell = filaTotal.insertCell();
            totalMedioCell.textContent = "S/ " + totalMedio.toFixed(2);
            var totalAltoCell = filaTotal.insertCell();
            totalAltoCell.textContent = "S/ " + totalAlto.toFixed(2);
        } else {
            mostrarMensajeSinDatos();
        }
    }

    // Agregar evento click al botón de imprimir
    var btnImprimir = document.getElementById('btnImprimir');
    btnImprimir.addEventListener('click', function () {
        // Ocultar contenido no deseado al imprimir
        var elementsToHide = document.getElementsByClassName('print-only');
        for (var i = 0; i < elementsToHide.length; i++) {
            elementsToHide[i].style.display = 'none';
        }

        window.print(); // Imprimir la tabla

        // Restaurar contenido oculto después de imprimir
        for (var i = 0; i < elementsToHide.length; i++) {
            elementsToHide[i].style.display = '';
        }
    });

    // Inicializar la tabla al cargar la página
    window.addEventListener('DOMContentLoaded', function () {
        inicializarTabla();
    });
</script>

<?php include "Views/Templates/footer.php"; ?>
