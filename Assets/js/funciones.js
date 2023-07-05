let tblUsuarios, tblMatePiso, tblMatePared, tblMateTecho, tblMateParedIn;
document.addEventListener("DOMContentLoaded", function () {
    const buttons = [{
        extend: 'excelHtml5',
        footer: true,
        title: 'Archivo',
        filename: 'Export_File',
        text: '<span class="badge bg-success"><i class="fas fa-file-excel"></i></span>'
    },
    {
        extend: 'pdfHtml5',
        download: 'open',
        footer: true,
        title: 'Reporte de usuarios',
        filename: 'Reporte de usuarios',
        text: '<span class="badge  bg-danger"><i class="fas fa-file-pdf"></i></span>',
        exportOptions: {
            columns: [0, ':visible']
        }
    },
    {
        extend: 'copyHtml5',
        footer: true,
        title: 'Reporte de usuarios',
        filename: 'Reporte de usuarios',
        text: '<span class="badge  bg-primary"><i class="fas fa-copy"></i></span>',
        exportOptions: {
            columns: [0, ':visible']
        }
    },
    {
        extend: 'print',
        footer: true,
        filename: 'Export_File_print',
        text: '<span class="badge bg-dark"><i class="fas fa-print"></i></span>'
    },
    {
        extend: 'csvHtml5',
        footer: true,
        filename: 'Export_File_csv',
        text: '<span class="badge  bg-success"><i class="fas fa-file-csv"></i></span>'
    }, {
        extend: 'colvis',
        text: '<span class="badge  bg-info"><i class="fas fa-columns"></i></span>',
        postfixButtons: ['colvisRestore']
    }
    ]
    const dom = "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-5'i><'col-sm-7'p>>";

    tblUsuarios = $('#tblUsuarios').DataTable({
        ajax: {
            url: base_url + "Usuarios/listar",
            dataSrc: ''
        },
        columns: [
            { data: 'accion', width: '8%', className: 'text-center' },
            { data: 'id' },
            { data: 'usuario' },
            { data: 'nombre' },
            { data: 'rol' },
            { data: 'estado' },
            { data: 'acciones' }
        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        },
        dom,
        buttons
    });
    //fin de la tabla usuarios
    $('#tblUsuario').DataTable({
        ajax: {
            url: base_url + "Usuarios/list",
            dataSrc: ''
        },
        columns: [

            { data: 'acciones' }
        ],
        searching: false, // Desactivar la búsqueda
        paging: false, // Desactivar la paginación
        info: false, // Ocultar la información de registros
        ordering: false // Desactivar el ordenamiento
    });
    //fin de la tabla usuario

    tblMatePiso = $('#tblMatePiso').DataTable({
        ajax: {
            url: base_url + "MatePisos/listar",
            dataSrc: ''
        },
        columns: [
            { data: 'id_elemento' },
            { data: 'nombre' },
            { data: 'medida' },
            { data: 'cantidad' },
            { data: 'precioBajo' },
            { data: 'precioMedio' },
            { data: 'precioAlto' },
            { data: 'manoObra' },
            { data: 'estado' },
            { data: 'acciones' },
            { data: 'totalBajo', visible: false },
            { data: 'totalMedio', visible: false },
            { data: 'totalAlto', visible: false },
            {
                data: null,
                render: function (data, type, row) {
                    return '<button class="btn btn-primary" onclick="enviarFormulario4(\'' + row.nombre + '\', \'' + row.cantidad + '\', \'' + row.precioBajo + '\', \'' + row.precioMedio + '\', \'' + row.precioAlto + '\', \'' + row.totalBajo + '\', \'' + row.totalMedio + '\', \'' + row.totalAlto + '\', \'' + row.manoObra + '\')"><i class="fas fa-check-square"></i></button>';
                }
            },

        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        },
        dom,
        buttons
    });
    //fin de la tabla Pisos
    $('#tblMatePi').DataTable({
        ajax: {
            url: base_url + "MatePisos/list",
            dataSrc: ''
        },
        columns: [

            { data: 'acciones' },
            { data: 'accione' },
            { data: 'accion' }
        ],
        searching: false, // Desactivar la búsqueda
        paging: false, // Desactivar la paginación
        info: false, // Ocultar la información de registros
        ordering: false // Desactivar el ordenamiento
    });
    //fin de la tabla material_piso
    tblMatePisoIn = $('#tblMatePisoIn').DataTable({
        ajax: {
            url: base_url + "MatePisos/listarInac",
            dataSrc: ''
        },
        columns: [
            { data: 'id_elemento' },
            { data: 'nombre' },
            { data: 'medida' },
            { data: 'cantidad' },
            { data: 'precioBajo' },
            { data: 'precioMedio' },
            { data: 'precioAlto' },
            { data: 'manoObra' },
            { data: 'estado' },
            { data: 'acciones' },
            { data: 'totalBajo', visible: false },
            { data: 'totalMedio', visible: false },
            { data: 'totalAlto', visible: false },

        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        },
        dom,
        buttons
    });
    //fin de la tabla Pisos Ianctivos
    $('#tblMatePar').DataTable({
        ajax: {
            url: base_url + "MateParedes/list",
            dataSrc: ''
        },
        columns: [

            { data: 'acciones' },
            { data: 'accione' },
            { data: 'accion' }

        ],
        searching: false, // Desactivar la búsqueda
        paging: false, // Desactivar la paginación
        info: false, // Ocultar la información de registros
        ordering: false // Desactivar el ordenamiento
    });
    //fin de la tabla material_pared
    tblMatePared = $('#tblMatePared').DataTable({
        ajax: {
            url: base_url + "MateParedes/listar",
            dataSrc: ''
        },
        columns: [
            { data: 'id_elemento' },
            { data: 'nombre' },
            { data: 'medida' },
            { data: 'cantidad' },
            { data: 'precioBajo' },
            { data: 'precioMedio' },
            { data: 'precioAlto' },
            { data: 'manoObra' },
            { data: 'estado' },
            { data: 'acciones' },
            { data: 'totalBajo', visible: false },
            { data: 'totalMedio', visible: false },
            { data: 'totalAlto', visible: false },
            {
                data: null,
                render: function (data, type, row) {
                    return '<button class="btn btn-primary" onclick="enviarFormulario2(\'' + row.nombre + '\', \'' + row.cantidad + '\', \'' + row.precioBajo + '\', \'' + row.precioMedio + '\', \'' + row.precioAlto + '\', \'' + row.totalBajo + '\', \'' + row.totalMedio + '\', \'' + row.totalAlto + '\', \'' + row.manoObra + '\')"><i class="fas fa-check-square"></i></button>';
                }
            },
        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        },
        dom,
        buttons
    });
    //fin de la tabla Paredes
    tblMateParedIn = $('#tblMateParedIn').DataTable({
        ajax: {
            url: base_url + "MateParedes/listarInac",
            dataSrc: ''
        },
        columns: [
            { data: 'id_elemento' },
            { data: 'nombre' },
            { data: 'medida' },
            { data: 'cantidad' },
            { data: 'precioBajo' },
            { data: 'precioMedio' },
            { data: 'precioAlto' },
            { data: 'manoObra' },
            { data: 'estado' },
            { data: 'acciones' },
            { data: 'totalBajo', visible: false },
            { data: 'totalMedio', visible: false },
            { data: 'totalAlto', visible: false },


        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        },
        dom,
        buttons
    });
    //fin de la tabla ParedesInac
    tblMateTecho = $('#tblMateTecho').DataTable({
        ajax: {
            url: base_url + "MateTechos/listar",
            dataSrc: ''
        },
        columns: [
            { data: 'id_elemento' },
            { data: 'nombre' },
            { data: 'medida' },
            { data: 'cantidad' },
            { data: 'precioBajo' },
            { data: 'precioMedio' },
            { data: 'precioAlto' },
            { data: 'manoObra' },
            { data: 'estado' },
            { data: 'acciones' },
            { data: 'totalBajo', visible: false },
            { data: 'totalMedio', visible: false },
            { data: 'totalAlto', visible: false },

            {
                data: null,
                render: function (data, type, row) {
                    return '<button class="btn btn-primary" onclick="enviarFormulario1(\'' + row.nombre + '\', \'' + row.cantidad + '\', \'' + row.precioBajo + '\', \'' + row.precioMedio + '\', \'' + row.precioAlto + '\', \'' + row.totalBajo + '\', \'' + row.totalMedio + '\', \'' + row.totalAlto + '\', \'' + row.manoObra + '\')"><i class="fas fa-check-square"></i></button>';
                }
            },
        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        },
        dom,
        buttons
    });
    //fin de la tabla Techos
    $('#tblMateTec').DataTable({
        ajax: {
            url: base_url + "MateTechos/list",
            dataSrc: ''
        },
        columns: [

            { data: 'acciones' },
            { data: 'accione' },
            { data: 'accion' }
        ],
        searching: false, // Desactivar la búsqueda
        paging: false, // Desactivar la paginación
        info: false, // Ocultar la información de registros
        ordering: false // Desactivar el ordenamiento
    });
    //fin de la tabla material_Techo
    tblMateTechoIn = $('#tblMateTechoIn').DataTable({
        ajax: {
            url: base_url + "MateTechos/listarInac",
            dataSrc: ''
        },
        columns: [
            { data: 'id_elemento' },
            { data: 'nombre' },
            { data: 'medida' },
            { data: 'cantidad' },
            { data: 'precioBajo' },
            { data: 'precioMedio' },
            { data: 'precioAlto' },
            { data: 'manoObra' },
            { data: 'estado' },
            { data: 'acciones' },
            { data: 'totalBajo', visible: false },
            { data: 'totalMedio', visible: false },
            { data: 'totalAlto', visible: false },

        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        },
        dom,
        buttons
    });
    //fin de la tabla Techos Ianctivo
    $('#tblMedida').DataTable({
        ajax: {
            url: base_url + "Medida/list",
            dataSrc: ''
        },
        columns: [

            { data: 'acciones' }
        ],
        searching: false, // Desactivar la búsqueda
        paging: false, // Desactivar la paginación
        info: false, // Ocultar la información de registros
        ordering: false // Desactivar el ordenamiento
    });
    //fin de la tabla medidas
    tblMedidas = $('#tblMedidas').DataTable({
        ajax: {
            url: base_url + "Medida/listar",
            dataSrc: ''
        },
        columns: [
            { data: 'id' },
            { data: 'medida' },
            { data: 'diminutivo' },
            { data: 'estado' },
            { data: 'acciones' }
        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        },
        dom,
        buttons
    });
    //Fin tabla medidas
    tblRol = $('#tblRol').DataTable({
        ajax: {
            url: base_url + "Roles/listar",
            dataSrc: ''
        },
        columns: [
            { data: 'id' },
            { data: 'rol' },
            { data: 'estado' },
            { data: 'acciones' }
        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        },
        dom,
        buttons
    });
    //Fin tabla Rol
})
function frmCambiarPass(e) {
    e.preventDefault();
    const actual = document.getElementById('clave_actual').value;
    const nueva = document.getElementById('clave_nueva').value;
    const confirmar = document.getElementById('confirmar_clave').value;
    if (actual == '' || nueva == '' || confirmar == '') {
        alertas('Todos los campos son obligatorios', 'warning');
    } else {
        const url = base_url + "Perfil/cambiarPass";
        const frm = document.getElementById("frmCambiarPass");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                alertas(res.msg, res.icono);
            }
        }
    }
}


function frmUsuario() {
    document.getElementById("title").innerHTML = "Nuevo Usuario";
    document.getElementById("btnAction").innerHTML = "Registrar";
    document.getElementById("claves").classList.remove("d-none");
    document.getElementById("frmUsuario").reset();
    $("#nuevo_usuario").modal("show");
    document.getElementById("id").value = "";
}
function RegistrarUser(e) {
    e.preventDefault();
    const usuario = document.getElementById("usuario");
    const nombre = document.getElementById("nombre");
    const clave = document.getElementById("clave");
    const confirmar = document.getElementById("confirmar");
    const rol = document.getElementById("rol");
    if (usuario.value == "" || nombre.value == "" || rol.value == "") {
        alertas('Todo los campos son obligatorios', 'warning');
    } else {
        const url = base_url + "Usuarios/registrar";
        const frm = document.getElementById("frmUsuario");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                $("#nuevo_usuario").modal("hide");
                alertas(res.msg, res.icono);
                tblUsuarios.ajax.reload();
            }
        }
    }
}

function btnEditarUser(id) {
    document.getElementById("title").innerHTML = "Actualizar Usuario";
    document.getElementById("btnAction").innerHTML = "Modificar";
    const url = base_url + "Usuarios/editar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("id").value = res.id;
            document.getElementById("usuario").value = res.usuario;
            document.getElementById("nombre").value = res.nombre;
            document.getElementById("rol").value = res.id_rol;
            document.getElementById("claves").classList.add("d-none");
            $("#nuevo_usuario").modal("show");
        }
    }
}
function btnEliminarUser(id) {
    Swal.fire({
        title: '¿Estás seguro de eliminar?',
        text: "El usuario no se eliminara de forma permanente, solo cambiara de estado inactivo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Usuarios/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    if (this.readyState == 4 && this.status == 200) {
                        const res = JSON.parse(this.responseText);
                        alertas(res.msg, res.icono);
                        tblUsuarios.ajax.reload();

                    }
                }
            }

        }
    })
}
function btnReingresarUser(id) {
    Swal.fire({
        title: '¿Estás seguro de reingresar?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Usuarios/reingresar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblUsuarios.ajax.reload();
                    alertas(res.msg, res.icono);
                }
            }

        }
    })
}

//fin usuario

function frmMatePiso() {
    document.getElementById("title").innerHTML = "Nuevo Material";
    document.getElementById("btnAction").innerHTML = "Registrar";
    document.getElementById("frmMatePiso").reset();
    document.getElementById("id").value = "";
    $("#nuevo_matepiso").modal("show");
}
function RegistrarMatePiso(e) {
    e.preventDefault();
    const nombre = document.getElementById("nombre");
    const medida = document.getElementById("medida");
    const cantidad = document.getElementById("cantidad");
    const precioBajo = document.getElementById("precioBajo");
    const precioMedio = document.getElementById("precioMedio");
    const precioAlto = document.getElementById("precioAlto");
    const id_elemento = document.getElementById("id_elemento");
    const manoObra = document.getElementById("manoObra");
    if (nombre.value == "" || cantidad.value == "" || precioBajo.value == "" || precioMedio.value == "" || precioAlto.value == "" || manoObra.value == "" || id_elemento.value == "") {
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Todos los campos son obligatorios',
            showConfirmButton: false,
            timer: 3000
        })
    } else {
        const url = base_url + "MatePisos/registrar";
        const frm = document.getElementById("frmMatePiso");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                const res = JSON.parse(this.responseText);
                if (res == "si") {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Material creado exitosamente',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    frm.reset();
                    $("#nuevo_matepiso").modal("hide");
                    tblMatePiso.ajax.reload();
                    tblMatePared.ajax.reload();
                    tblMateTecho.ajax.reload();
                } else if (res == "modificar") {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Material Modificado exitosamente',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    $("#nuevo_matepiso").modal("hide");
                    tblMatePiso.ajax.reload();
                    tblMatePared.ajax.reload();
                    tblMateTecho.ajax.reload();
                } else {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: res,
                        showConfirmButton: false,
                        timer: 3000
                    })
                }
            }
        }
    }
}

function btnEditarMatePiso(id) {
    document.getElementById("title").innerHTML = "Actualizar Material";
    document.getElementById("btnAction").innerHTML = "Modificar";
    const url = base_url + "MatePisos/editar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            console.log(res);
            document.getElementById("id").value = res.id;
            document.getElementById("nombre").value = res.nombre;
            document.getElementById("medida").value = res.id_medida;
            document.getElementById("cantidad").value = res.cantidad;
            document.getElementById("precioBajo").value = res.precioBajo;
            document.getElementById("precioMedio").value = res.precioMedio;
            document.getElementById("precioAlto").value = res.precioAlto;
            document.getElementById("manoObra").value = res.manoObra;
            $("#nuevo_matepiso").modal("show");
        }
    }
}
function btnEliminarMatePiso(id) {
    Swal.fire({
        title: '¿Estás seguro de eliminar?',
        text: "El Material no se eliminara de forma permanente, solo cambiara de estado inactivo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("title").innerHTML = "Actualizar Material";
            document.getElementById("btnAction").innerHTML = "Modificar";
            const url = base_url + "MatePisos/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    if (res == "ok") {
                        Swal.fire(
                            'Mensaje!',
                            'El Material se inhabilito con éxito',
                            'success'
                        )
                        tblMatePiso.ajax.reload();
                        tblMatePared.ajax.reload();
                        tblMateTecho.ajax.reload();
                    } else {
                        Swal.fire(
                            'Mensaje!',
                            res,
                            'success'
                        )
                    }
                }
            }

        }
    })
}
function btnReingresarMatePiso(id) {
    Swal.fire({
        title: '¿Estás seguro de reingresar?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "MatePisos/reingresar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    if (res == "ok") {
                        Swal.fire(
                            'Mensaje!',
                            'El usuario se reingreso con éxito',
                            'success'
                        )
                        tblMatePisoIn.ajax.reload();
                        tblMateParedIn.ajax.reload();
                        tblMateTechoIn.ajax.reload();
                    } else {
                        Swal.fire(
                            'Mensaje!',
                            res,
                            'success'
                        )
                    }
                }
            }

        }
    })
}

function getCookie(name) {
    var value = "; " + document.cookie;
    var parts = value.split("; " + name + "=");
    if (parts.length == 2) return parts.pop().split(";").shift();
}


//funciones para agregar los datos de los materiales a la proforma Piso
function enviarFormulario4(nombre, cantidad, precioBajo, precioMedio, precioAlto, totalBajo, totalMedio, totalAlto, manoObra) {
    // Obtener los datos previamente seleccionados desde la cookie
    let datosSeleccionados = [];
    if (document.cookie.includes('formularioDatos4')) {
        datosSeleccionados = JSON.parse(getCookie('formularioDatos4'));
    }

    // Agregar los nuevos datos seleccionados al arreglo
    datosSeleccionados.push({
        nombre: nombre,
        cantidad: cantidad,
        precioBajo: precioBajo,
        precioMedio: precioMedio,
        precioAlto: precioAlto,
        totalBajo: totalBajo,
        totalMedio: totalMedio,
        totalAlto: totalAlto,
        manoObra: manoObra
    });

    // Guardar el arreglo completo en la cookie
    document.cookie = "formularioDatos4=" + JSON.stringify(datosSeleccionados) + "; path=/";

    // Redirigir a la página de materiales pisos
    //window.location.href = 'http://localhost/constructora/PresupuestoPared';
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Material agregado exitosamente',
        showConfirmButton: false,
        timer: 3000
    });
}

function getCookie(name) {
    var cookieValue = null;
    if (document.cookie && document.cookie !== '') {
        var cookies = document.cookie.split(';');
        for (var i = 0; i < cookies.length; i++) {
            var cookie = cookies[i].trim();
            if (cookie.substring(0, name.length + 1) === (name + '=')) {
                cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                break;
            }
        }
    }
    return cookieValue;
}

function eliminarFila4(nombre) {
    if (!localStorage) {
        console.error("El navegador no soporta localStorage.");
        return;
    }

    var formularioDatos4 = JSON.parse(getCookie('formularioDatos4'));

    if (confirm("¿Estás seguro de que deseas eliminar este elemento?")) {
        if (formularioDatos4) {
            var index = formularioDatos4.findIndex(function (elemento) {
                return elemento.nombre === nombre;
            });

            if (index !== -1) {
                formularioDatos4.splice(index, 1);
                localStorage.setItem('formularioDatos4', JSON.stringify(formularioDatos4));
                document.cookie = "formularioDatos4=" + JSON.stringify(formularioDatos4) + "; path=/; max-age=3600;";
                document.querySelector("table tbody").deleteRow(index);
                location.reload();
            } else {
                console.error("El elemento con nombre " + nombre + " no existe en el array.");
            }
        } else {
            console.error("El array formularioDatos4 no existe o es null.");
        }
    }
}

//funciones para agregar los datos de los materiales a la proforma Techo
function enviarFormulario1(nombre, cantidad, precioBajo, precioMedio, precioAlto, totalBajo, totalMedio, totalAlto, manoObra) {
    // Obtener los datos previamente seleccionados desde la cookie
    let datosSeleccionados = [];
    if (document.cookie.includes('formularioDatos1')) {
        datosSeleccionados = JSON.parse(getCookie('formularioDatos1'));
    }

    // Agregar los nuevos datos seleccionados al arreglo
    datosSeleccionados.push({
        nombre: nombre,
        cantidad: cantidad,
        precioBajo: precioBajo,
        precioMedio: precioMedio,
        precioAlto: precioAlto,
        totalBajo: totalBajo,
        totalMedio: totalMedio,
        totalAlto: totalAlto,
        manoObra: manoObra
    });

    // Guardar el arreglo completo en la cookie
    document.cookie = "formularioDatos1=" + JSON.stringify(datosSeleccionados) + "; path=/";

    // Redirigir a la página de materiales techos
    //window.location.href = 'http://localhost/constructora/PresupuestoPared';
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Material agregado exitosamente',
        showConfirmButton: false,
        timer: 3000
    });
}


function eliminarFila1(nombre) {
    if (!localStorage) {
        console.error("El navegador no soporta localStorage.");
        return;
    }

    var formularioDatos1 = JSON.parse(getCookie('formularioDatos1'));

    if (confirm("¿Estás seguro de que deseas eliminar este elemento?")) {
        if (formularioDatos1) {
            var index = formularioDatos1.findIndex(function (elemento) {
                return elemento.nombre === nombre;
            });

            if (index !== -1) {
                formularioDatos1.splice(index, 1);
                localStorage.setItem('formularioDatos1', JSON.stringify(formularioDatos1));
                document.cookie = "formularioDatos1=" + JSON.stringify(formularioDatos1) + "; path=/; max-age=3600;";
                document.querySelector("table tbody").deleteRow(index);
                location.reload();
            } else {
                console.error("El elemento con nombre " + nombre + " no existe en el array.");
            }
        } else {
            console.error("El array formularioDatos1 no existe o es null.");
        }
    }
}

//funciones para agregar los datos de los materiales a la proforma Pared
function enviarFormulario2(nombre, cantidad, precioBajo, precioMedio, precioAlto, totalBajo, totalMedio, totalAlto, manoObra) {
    // Obtener los datos previamente seleccionados desde la cookie
    let datosSeleccionados = [];
    if (document.cookie.includes('formularioDatos2')) {
        datosSeleccionados = JSON.parse(getCookie('formularioDatos2'));
    }

    // Agregar los nuevos datos seleccionados al arreglo
    datosSeleccionados.push({
        nombre: nombre,
        cantidad: cantidad,
        precioBajo: precioBajo,
        precioMedio: precioMedio,
        precioAlto: precioAlto,
        totalBajo: totalBajo,
        totalMedio: totalMedio,
        totalAlto: totalAlto,
        manoObra: manoObra
    });

    // Guardar el arreglo completo en la cookie
    document.cookie = "formularioDatos2=" + JSON.stringify(datosSeleccionados) + "; path=/";

    // Redirigir a la página de materiales techos
    //window.location.href = 'http://localhost/constructora/PresupuestoTecho';
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Material agregado exitosamente',
        showConfirmButton: false,
        timer: 3000
    });
}

function eliminarFila2(nombre) {
    if (!localStorage) {
        console.error("El navegador no soporta localStorage.");
        return;
    }

    var formularioDatos2 = JSON.parse(getCookie('formularioDatos2'));

    if (confirm("¿Estás seguro de que deseas eliminar este elemento?")) {
        if (formularioDatos2) {
            var index = formularioDatos2.findIndex(function (elemento) {
                return elemento.nombre === nombre;
            });

            if (index !== -1) {
                formularioDatos2.splice(index, 1);
                localStorage.setItem('formularioDatos2', JSON.stringify(formularioDatos2));
                document.cookie = "formularioDatos2=" + JSON.stringify(formularioDatos2) + "; path=/; max-age=3600;";
                document.querySelector("table tbody").deleteRow(index);
                location.reload();
            } else {
                console.error("El elemento con nombre " + nombre + " no existe en el array.");
            }
        } else {
            console.error("El array formularioDatos2 no existe o es null.");
        }
    }
}
function frmMedida() {
    document.getElementById("title").innerHTML = "Nueva Medida";
    document.getElementById("btnAction").innerHTML = "Registrar";
    document.getElementById("frmMedida").reset();
    document.getElementById("id").value = "";
    $("#nueva_medida").modal("show");
}
function RegistrarMedida(e) {
    e.preventDefault();
    const medida = document.getElementById("medida");
    const diminutivo = document.getElementById("diminutivo");
    if (medida.value == "" || diminutivo.value == "") {
        alertas('Todo los campos son obligatorios', 'warning');
    } else {
        const url = base_url + "Medida/registrar";
        const frm = document.getElementById("frmMedida");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                $("#nueva_medida").modal("hide");
                alertas(res.msg, res.icono);
                tblMedidas.ajax.reload();
            }
        }
    }
}

function btnEditarMedida(id) {
    document.getElementById("title").innerHTML = "Actualizar Medida";
    document.getElementById("btnAction").innerHTML = "Modificar";
    const url = base_url + "Medida/editar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("id").value = res.id;
            document.getElementById("medida").value = res.medida;
            document.getElementById("diminutivo").value = res.diminutivo;
            $("#nueva_medida").modal("show");
        }
    }
}
function btnEliminarMedida(id) {
    Swal.fire({
        title: '¿Estás seguro de eliminar?',
        text: "La medida no se eliminara de forma permanente, solo cambiara de estado inactivo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'No',
        confirmButtonText: 'Si!'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("title").innerHTML = "Actualizar Medida";
            document.getElementById("btnAction").innerHTML = "Modificar";
            const url = base_url + "Medida/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    alertas(res.msg, res.icono);
                    tblMedidas.ajax.reload();
                }
            }

        }
    })
}
function btnReingresarMedida(id) {
    Swal.fire({
        title: '¿Estás seguro de reingresar?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Medida/reingresar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblMedidas.ajax.reload();
                    alertas(res.msg, res.icono);
                }
            }

        }
    })
}
function frmRol() {
    document.getElementById("title").innerHTML = "Nueva Rol";
    document.getElementById("btnAction").innerHTML = "Registrar";
    document.getElementById("frmRol").reset();
    document.getElementById("id").value = "";
    $("#nuevo_rol").modal("show");
}
function RegistrarRol(e) {
    e.preventDefault();
    const rol = document.getElementById("rol");
    if (rol.value == "") {
        alertas('Todo los campos son obligatorios', 'warning');
    } else {
        const url = base_url + "Roles/registrar";
        const frm = document.getElementById("frmRol");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                $("#nuevo_rol").modal("hide");
                alertas(res.msg, res.icono);
                tblRol.ajax.reload();
            }
        }
    }
}

function btnEditarRol(id) {
    document.getElementById("title").innerHTML = "Actualizar Rol";
    document.getElementById("btnAction").innerHTML = "Modificar";
    const url = base_url + "Roles/editar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("id").value = res.id;
            document.getElementById("rol").value = res.rol;
            $("#nuevo_rol").modal("show");
        }
    }
}
function btnEliminarRol(id) {
    Swal.fire({
        title: '¿Estás seguro de eliminar?',
        text: "El Rol no se eliminara de forma permanente, solo cambiara de estado inactivo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'No',
        confirmButtonText: 'Si!'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("title").innerHTML = "Actualizar Rol";
            document.getElementById("btnAction").innerHTML = "Modificar";
            const url = base_url + "Roles/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    alertas(res.msg, res.icono);
                    tblRol.ajax.reload();
                }
            }

        }
    })
}
function btnReingresarRol(id) {
    Swal.fire({
        title: '¿Estás seguro de reingresar?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Roles/reingresar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblRol.ajax.reload();
                    alertas(res.msg, res.icono);
                }
            }

        }
    })
}
function alertas(mensaje, icono) {
    Swal.fire({
        position: 'top-end',
        icon: icono,
        title: mensaje,
        showConfirmButton: false,
        timer: 3000
    })
}

function registrarPermisos(e) {
    e.preventDefault();
    const url = base_url + "Usuarios/registrarPermiso";
    const frm = document.getElementById('formulario');
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            if (res != '') {
                alertas(res.msg, res.icono);
            } else {
                alertas('Error no identificado', 'error');
            }
        }
    }
}
reportePisos();
reportePared();
reporteTecho();
function reportePisos() {
    const url = base_url + "Inicio/reporte";
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            let nombre = [];
            let cantidad = [];
            for (let i = 0; i < res.length; i++) {
                nombre.push(res[i]['nombre']);
                cantidad.push(res[i]['cantidad']);
            }
            var ctx = document.getElementById("HistorialPiso");
            var myPieChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: nombre,
                    datasets: [{
                        data: cantidad,
                        backgroundColor: ['#007bff', '#dc3545', '#ffc107', '#28a745'],
                    }],
                },
            });
        }
    }
}
function reportePared() {
    const url = base_url + "Inicio/reportePared";
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            let nombre = [];
            let cantidad = [];
            for (let i = 0; i < res.length; i++) {
                nombre.push(res[i]['nombre']);
                cantidad.push(res[i]['cantidad']);
            }
            var ctx = document.getElementById("HistorialPared");
            var myPieChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: nombre,
                    datasets: [{
                        data: cantidad,
                        backgroundColor: ['#007bff', '#dc3545', '#ffc107', '#28a745'],
                    }],
                },
            });
        }
    }
}
function reporteTecho() {
    const url = base_url + "Inicio/reporteTecho";
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            let nombre = [];
            let cantidad = [];
            for (let i = 0; i < res.length; i++) {
                nombre.push(res[i]['nombre']);
                cantidad.push(res[i]['cantidad']);
            }
            var ctx = document.getElementById("HistorialTecho");
            var myPieChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: nombre,
                    datasets: [{
                        data: cantidad,
                        backgroundColor: ['#007bff', '#dc3545', '#ffc107', '#28a745'],
                    }],
                },
            });
        }
    }
}

