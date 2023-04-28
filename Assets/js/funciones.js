let tblUsuarios, tblMateriales;
document.addEventListener("DOMContentLoaded", function () {
    tblUsuarios = $('#tblUsuarios').DataTable({
        ajax: {
            url: base_url + "Usuarios/listar",
            dataSrc: ''
        },
        columns: [
            { data: 'id' },
            { data: 'usuario' },
            { data: 'nombre' },
            { data: 'rol' },
            { data: 'estado' },
            { data: 'acciones' }
        ]
    });
    //fin de la tabla usuarios
    tblMateriales = $('#tblMateriales').DataTable({
        ajax: {
            url: base_url + "Materiales/listar",
            dataSrc: ''
        },
        columns: [
            { data: 'id' },
            { data: 'nombre' },
            { data: 'cantidad' },
            { data: 'precioBajo' },
            { data: 'precioMedio' },
            { data: 'precioAlto' },
            { data: 'estado' },
            { data: 'acciones' }
        ]
    });
})

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
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Todos los campos son obligatorios',
            showConfirmButton: false,
            timer: 3000
        })
    } else {
        const url = base_url + "Usuarios/registrar";
        const frm = document.getElementById("frmUsuario");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res == "si") {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Usuario creado exitosamente',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    frm.reset();
                    $("#nuevo_usuario").modal("hide");
                    tblUsuarios.ajax.reload();
                } else if (res == "modificar") {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Usuario Modificado exitosamente',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    $("#nuevo_usuario").modal("hide");
                    tblUsuarios.ajax.reload();
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
            console.log(res);
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
        confirmButtonText: 'Si!'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("title").innerHTML = "Actualizar Usuario";
            document.getElementById("btnAction").innerHTML = "Modificar";
            const url = base_url + "Usuarios/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    if(res == "ok"){
                        Swal.fire(
                            'Mensaje!',
                            'El usuario se inhabilito con éxito',
                            'success'
                        )
                        tblUsuarios.ajax.reload();
                    }else{
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
function btnReingresarUser(id) {
    Swal.fire({
        title: '¿Estás seguro de reingresar?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("title").innerHTML = "Actualizar Usuario";
            document.getElementById("btnAction").innerHTML = "Modificar";
            const url = base_url + "Usuarios/reingresar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    if(res == "ok"){
                        Swal.fire(
                            'Mensaje!',
                            'El usuario se reingreso con éxito',
                            'success'
                        )
                        tblUsuarios.ajax.reload();
                    }else{
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

//fin usuario

function frmMateriales() {
    document.getElementById("title").innerHTML = "Nuevo Material";
    document.getElementById("btnAction").innerHTML = "Registrar";
    document.getElementById("frmMaterial").reset();
    document.getElementById("id").value = "";
    $("#nuevo_material").modal("show");
}
function RegistrarMat(e) {
    e.preventDefault();
    const nombre = document.getElementById("nombre");
    const cantidad = document.getElementById("cantidad");
    const precioBajo = document.getElementById("precioBajo");
    const precioMedio= document.getElementById("precioMedio");
    const precioAlto= document.getElementById("precioAlto");
    if (nombre.value == "" || cantidad.value == "" || precioBajo.value == "" || precioMedio.value == "" || precioAlto.value == "") {
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Todos los campos son obligatorios',
            showConfirmButton: false,
            timer: 3000
        })
    } else {
        const url = base_url + "Materiales/registrar";
        const frm = document.getElementById("frmMaterial");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
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
                    $("#nuevo_material").modal("hide");
                    tblMateriales.ajax.reload();
                } else if (res == "modificar") {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Material Modificado exitosamente',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    $("#nuevo_material").modal("hide");
                    tblMateriales.ajax.reload();
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

function btnEditarMate(id) {
    document.getElementById("title").innerHTML = "Actualizar Usuario";
    document.getElementById("btnAction").innerHTML = "Modificar";
    const url = base_url + "Materiales/editar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            console.log(res);
            document.getElementById("id").value = res.id;
            document.getElementById("nombre").value = res.nombre;
            document.getElementById("cantidad").value = res.cantidad;
            document.getElementById("precioBajo").value = res.precioBajo;
            document.getElementById("precioMedio").value = res.precioMedio;
            document.getElementById("precioAlto").value = res.precioAlto;
            $("#nuevo_material").modal("show");
        }
    }
}
function btnEliminarMate(id) {
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
            document.getElementById("title").innerHTML = "Actualizar Usuario";
            document.getElementById("btnAction").innerHTML = "Modificar";
            const url = base_url + "Materiales/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    if(res == "ok"){
                        Swal.fire(
                            'Mensaje!',
                            'El Material se inhabilito con éxito',
                            'success'
                        )
                        tblMateriales.ajax.reload();
                    }else{
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
function btnReingresarMate(id) {
    Swal.fire({
        title: '¿Estás seguro de reingresar?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Materiales/reingresar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    if(res == "ok"){
                        Swal.fire(
                            'Mensaje!',
                            'El usuario se reingreso con éxito',
                            'success'
                        )
                        tblMateriales.ajax.reload();
                    }else{
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