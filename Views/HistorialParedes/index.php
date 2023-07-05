<?php
include "Views/Templates/header.php";
?>

<div class="card">
    <div class="card-header bg-dark text-white">
        Historial Pared
    </div>
    <div class="card-body pt-0 pb-0">
        <br>
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

        <?php
        try {
            // Obtener la conexión PDO
            $pdo = new PDO("mysql:host=localhost;dbname=constructora", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Consultar los registros agrupados por fecha
            $stmt = $pdo->query("SELECT DISTINCT fechaEnv FROM historial WHERE idElemento = '3' ORDER BY fechaEnv DESC");
            $fechas = $stmt->fetchAll(PDO::FETCH_COLUMN);

            // Iterar por cada fecha y mostrar la tabla correspondiente
            foreach ($fechas as $fecha) {
                // Obtener los registros para la fecha actual
                $stmt = $pdo->prepare("SELECT * FROM historial WHERE fechaEnv = ?");
                $stmt->execute([$fecha]);
                $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
                // Obtener el valor de precioBajoT del último registro
                $precioBajoT = $resultados[count($resultados) - 1]['precioBajoT'];
                $precioMedioT = $resultados[count($resultados) - 1]['precioMedioT'];
                $precioAltoT = $resultados[count($resultados) - 1]['precioAltoT'];
                // Construir la tabla para la fecha actual
                $tablaHTML = '<table class="table table-light table-bordered table-hover tblHistorialPared">
                                <caption>Fecha: ' . $fecha . '</caption>
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Cantidad</th>
                                        <th>Precio Bajo</th>
                                        <th>Precio Medio</th>
                                        <th>Precio Alto</th>
                                        <th>Mano Obra</th>
                                    </tr>
                                </thead>
                                <tbody>';

                $totalCantidad = 0;
                $totalPrecioBajo = 0;
                $totalPrecioMedio = 0;
                $totalPrecioAlto = 0;

                foreach ($resultados as $registro) {
                    $nombre = $registro['nomMaterial'];
                    $cantidad = $registro['cantidad'];
                    $precioBajo = $registro['precioBajoMate'];
                    $precioMedio = $registro['precioMedioMate'];
                    $precioAlto = $registro['precioAltoMate'];
                    $manoObra = $registro['manoObra'];
                    $manoObra1 = $registro['manoObra1'];

                    $fila = '<tr>
                                <td>' . $nombre . '</td>
                                <td>' . $cantidad . '</td>
                                <td>S/' . $precioBajo . '</td>
                                <td>S/' . $precioMedio . '</td>
                                <td>S/' . $precioAlto . '</td>
                                <td>S/' . $manoObra . '</td>
                            </tr>';

                    $tablaHTML .= $fila;

                    // Calcular totales
                    $totalCantidad += $cantidad;
                    $totalPrecioBajo += $precioBajo;
                    $totalPrecioMedio += $precioMedio;
                    $totalPrecioAlto += $precioAlto;
                }

                $tablaHTML .= '<tfoot>
                                <tr>
                                    <td colspan="2"><strong>mano Obra:</strong></td>
                                    <td>S/' . $manoObra1 . '</td>
                                    <td>S/' . $manoObra1 . '</td>
                                    <td>S/' . $manoObra1 . '</td>
                                </tr>
                                <tr>
                                    <td colspan="2"><strong>Total:</strong></td>
                                    <td>S/' . $precioBajoT . '</td>
                                    <td>S/' . $precioMedioT . '</td>
                                    <td>S/' . $precioAltoT . '</td>
                                </tr>
                            </tfoot>';

                            $tablaHTML .= '</tbody></table>';

                $tablaHTML .= '<td colspan="5">
                <button class="agregar-btn btn btn-success" data-fecha="' . $fecha . '" data-precio-bajo="' . $precioBajoT . '" data-precio-medio="' . $precioMedioT . '" data-precio-alto="' . $precioAltoT . '">Agregar al presupuesto general</button>
            </td><br><br>
            <form id="eliminarForm" method="POST" action="http://localhost/constructora/Views/Eliminar/eliminarHistorialPared.php" onsubmit="return confirmarEliminacion();">
                <input type="hidden" name="fecha" value="' . $fecha . '">
                <button type="submit" name="eliminar" class="btn btn-danger">Eliminar</button>
            </form><br>
                <script>
                function confirmarEliminacion() {
                    return confirm("¿Estás seguro de que deseas eliminar los registros?");
                }
            </script><br><br>';

                // Mostrar la tabla en la página
                echo $tablaHTML;
            }

            // Script para DataTables y botones de exportación
            echo '
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const buttons = [{
                        extend: "excelHtml5",
                        footer: true,
                        title: "Archivo",
                        filename: "Export_File",
                        text: \'<span class="badge bg-success"><i class="fas fa-file-excel"></i></span>\'
                    },
                    {
                        extend: "pdfHtml5",
                        download: "open",
                        footer: true,
                        title: "Reporte de historial pared",
                        filename: "Reporte de historial pared",
                        text: \'<span class="badge  bg-danger"><i class="fas fa-file-pdf"></i></span>\',
                        exportOptions: {
                            columns: [0, ":visible"]
                        }
                    },
                    {
                        extend: "copyHtml5",
                        footer: true,
                        title: "Reporte de historial pared",
                        filename: "Reporte de historial pared",
                        text: \'<span class="badge  bg-primary"><i class="fas fa-copy"></i></span>\',
                        exportOptions: {
                            columns: [0, ":visible"]
                        }
                    },
                    {
                        extend: "print",
                        footer: true,
                        filename: "Export_File_print",
                        text: \'<span class="badge  bg-secondary"><i class="fas fa-print"></i></span>\',
                        exportOptions: {
                            columns: [0, ":visible"]
                        }
                    }];

                    const tables = document.querySelectorAll(".tblHistorialPared");
                    tables.forEach(function(table) {
                        $(table).DataTable({
                            dom: "Blfrtip",
                            buttons: buttons,
                            searching: false, // Desactivar la búsqueda
                            paging: false, // Desactivar la paginación
                            info: false, // Ocultar la información de registros
                            ordering: false // Desactivar el ordenamiento
                        });
                    });
                });
            </script>';
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        ?>

    </div>
</div>

<?php
include "Views/Templates/footer.php";
?>
<script>
    $('.agregar-btn').click(function () {
        var fecha = $(this).data('fecha');
        var precioBajoT = $(this).data('precio-bajo');
        var precioMedioT = $(this).data('precio-medio');
        var precioAltoT = $(this).data('precio-alto');
        var nombre = "Presupuesto Paredes"

        // Obtener los datos almacenados previamente en localStorage
        var datosTotalesJSON = localStorage.getItem('datosTotales');
        var datosTotales = [];

        if (datosTotalesJSON !== null) {
            datosTotales = JSON.parse(datosTotalesJSON);
        }

        // Agregar los nuevos datos al array
        datosTotales.push({
            nombre: nombre,
            fecha: fecha,
            precioBajoT: precioBajoT,
            precioMedioT: precioMedioT,
            precioAltoT: precioAltoT
        });

        // Guardar el array actualizado en localStorage
        localStorage.setItem('datosTotales', JSON.stringify(datosTotales));

        Swal.fire({
        icon: 'success',
        title: '¡Éxito!',
        text: 'Los datos han sido agregados exitosamente.',
    });
    });
</script>
