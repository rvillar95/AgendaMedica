<!DOCTYPE html>
<?php
date_default_timezone_set("America/Santiago");
$user = $this->session->userdata("administrador"); ?>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vitades | Agenda</title>
    <link href="<?php echo base_url() ?>lib/css/toastr.min.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="<?php echo base_url() ?>lib/img/icono.png">
    <link href="<?php echo base_url() ?>lib/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>lib/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>lib/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>lib/css/datatables.min.css" rel="stylesheet" type="text/css" />
</head>

<body class="">
    <div id="wrapper">
        <div id="page-wrapper" class="gray-bg" style="padding: 0px; margin: 0px;">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0; background-color: cyan;">
                    <center>
                        <ul class="nav navbar-top-links navbar-left">
                            <img src="<?php echo base_url() ?>lib/img/Logo.png" class="img-responsive" style="width: 240px; height: 65px; padding-left: 20px ; padding-top: 10px;" alt="" />
                        </ul>
                    </center>
                    <ul class="nav navbar-top-links navbar-right" style="padding-left: 10px;">
                        <li style="left: 10px">
                            <span class="" style="color: white;"></span>
                        </li>
                        <li style="padding: 10px;">
                            <a id="btn" style="color: white;">
                                <i class="fa fa-sign-out" style="color: white"></i> Salir
                            </a>
                        </li>
                    </ul>

                </nav>
            </div>

            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-4">
                    <h2>Modulo Agenda Medica</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo base_url() ?>Menu">Inicio</a>
                        </li>
                        <li class="active">
                            <strong>Modulo Agenda Medica</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-sm-8">
                    <div class="title-action">
                        <a href="" class="btn btn-primary">Actualizar Pagina</a>
                    </div>
                </div>
            </div>
            <div class="wrapper wrapper-content  animated fadeInRight">
                <div class="row" style="padding: 20px;">
                    <h2><strong>Registros Agenda Medica</strong></h2>
                    <div><button class="btn btn-primary" id="btnModal">Agregar<i class="fa fa-book"></i></button></div>
                    <br>
                    <div class="table-responsive">
                        <table id="dataTables-agenda" class="table table-striped table-bordered table-hover dataTables-agenda">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Medico</th>
                                    <th>Especialidad</th>
                                    <th>Inicio</th>
                                    <th>Fin</th>
                                    <th>Tiempo</th>
                                    <th>Estado</th>
                                    <th>Ver</th>
                                </tr>
                            </thead>
                            <tbody id="tbodyMedicos">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="footer">
                <div class="pull-right">

                </div>
                <div>
                    <strong>Copyright</strong> <a href="https://solucionesvillar.cl" style="color: graytext">Soluciones Villar</a> &copy; 2017-<?php echo date('Y') ?>
                </div>
            </div>

        </div>
    </div>

    <div class="modal inmodal fade" id="modal-agenda" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Agenda Medica</h4>
                    <small class="font-bold">Selecciona al medico y su especialidad y agenda horarios de atencion.</small>
                </div>
                <div class="modal-body" id="info-paciente">
                    <label for="" id="medico"></label>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <select name="medicos" id="medicos" class="form-control"></select>
                        </div>
                        <div class="form-group col-md-6">
                            <select name="especialidades" id="especialidades" class="form-control">
                                <option disabled selected>Seleccione una especialidad</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Hora Inicio</label>
                            <input type="datetime-local" id="hora_inicio" value="<?php echo date('Y') . '-' . date('m') . '-' . date('d') . 'T' . strftime("%H:%M") ?>" min="<?php echo date('Y') . '-' . date('m') . '-' . date('d') . 'T' . strftime("%H:%M") ?>" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Hora Fin</label>
                            <input type="datetime-local" id="hora_fin" value="<?php echo date('Y') . '-' . date('m') . '-' . date('d') . 'T' . strftime("%H:%M") ?>" min="<?php echo date('Y') . '-' . date('m') . '-' . date('d') . 'T' . strftime("%H:%M") ?>" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <button type="submit" id="btnAgregar" class="btn btn-primary block full-width m-b">Agregar Horario</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal inmodal fade" id="modal-detalle-agenda" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Detalle Horas</h4>
                    <small class="font-bold">Vea las horas generadas.</small>
                    <div class="row">
                        <div class="col-md-3" style="background-color: #f5f5f5;">
                            <h4>No Definido</h4>
                        </div>
                        <div class="col-md-3" style="background-color: #B2EBF2;">
                            <h4>Presencial</h4>
                        </div>
                        <div class="col-md-3" style="background-color: #80DEEA;">
                            <h4>Internet</h4>
                        </div>
                        <div class="col-md-3" style="background-color: cyan;">
                            <h4>Presencial e Internet</h4>
                        </div>
                    </div>
                </div>
                <div class="modal-body" id="info-paciente">
                    <label for="" id="medico"></label>
                    <div class="row">
                        <div class="col-md-12 table-responsive" id="solicitudes" style="display: none;">
                            <table class="table table-striped table-bordered table-hover tableDetalle">
                                <thead>
                                    <tr>
                                        <th>Rut Paciente</th>
                                        <th>Nombre Paciente</th>
                                        <th>Correo Paciente</th>
                                        <th>Notificado</th>
                                        <th>Estado</th>
                                        <th>Fecha</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody id="tbodyMedicos">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Paciente</th>
                                        <th>Orden</th>
                                        <th>Inicio</th>
                                        <th>Fin</th>
                                        <th>Tipo</th>
                                        <th>Estado</th>
                                        <th>Ver Solicitudes <span id="totalSolicitudes"></span></th>
                                        <th>Agregar Paciente</th>
                                    </tr>
                                </thead>
                                <tbody id="tbodyDetalle">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="divFormulario" class="col-md-12" style="display: none; padding-top: 20px;">
                                <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12"><label>Rut</label><input id="username" required type="text" name="j_username" class="form-control" oninput="checkRut(this)" onblur="formateaRut(this); buscarNombre(this);"></div>
                                <br>
                                <h3 id="seleccion"></h3>
                            </div>
                            <div id="existe" class="col-md-12" style="display: none; padding-top: 20px;">

                            </div>
                            <div id="noexiste" class="col-md-12" style="display: none; padding-top: 20px;">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="background-color: cyan;"></div>
    <script src="<?php echo base_url() ?>lib/js/jquery-2.1.1.js"></script>
    <script src="<?php echo base_url() ?>lib/js/rut.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>lib/js/datatables.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>lib/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>lib/js/toastr.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>lib/js/inspinia.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>lib/js/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>lib/js/pace.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>lib/js/jquery.metisMenu.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>lib/js/jquery.peity.min.js" type="text/javascript"></script>
    <script>
        $(function() {
            $(document).ready(function() {
                var idSeleccionado = 0;
                var idDetalle = 0;
                var dia = "";
                getMedicos();
                getEstados();
                $("#btnModal").click(function(e) {
                    e.preventDefault();
                    $("#modal-agenda").modal('show');
                });

                var modal = document.getElementById("modal-detalle-agenda");
                if (modal.style.display == "none") {
                    console.log("hola");
                    var table = $('.tableDetalle').DataTable();
                    table.destroy();
                }

                function getMedicos(id) {
                    $.ajax({
                        url: 'getMedicosSelect',
                        type: 'POST',
                        dataType: 'json',
                    }).then(function(msg) {
                        fila = "";
                        fila += "<option disabled selected>Seleccione un Medico</option>";
                        $.each(msg, function(i, o) {
                            $("#medicos").empty();
                            fila += "<option value='" + o.idMedico + "'>" + o.NombreMedico + "</option>";
                            $("#medicos").append(fila);
                        });
                    });
                }

                $("body").on("click", "#btnAddSolicitudNoExistente", function(e) {
                    e.preventDefault();
                    var rut = $("#username").val();
                    var nombre = $("#nombre").val();
                    var direccion = $("#direccion").val();
                    var telefono = $("#telefono").val();
                    var correo = $("#correo").val();
                    var mensaje = $("#seleccion").val();
                    if (rut != "") {
                        if (nombre != "") {
                            if (direccion != "") {
                                if (telefono != "") {
                                    if (correo != "") {
                                        if (correo.includes("@")) {
                                            $.ajax({
                                                url: 'addSolicitudHorarioEspecial',
                                                type: 'POST',
                                                dataType: 'json',
                                                data: {
                                                    "idDetalle": idDetalle,
                                                    "nombre": nombre,
                                                    "correo": correo,
                                                    "direccion": direccion,
                                                    "telefono": telefono,
                                                    "rut": rut,
                                                    "mensaje": mensaje
                                                }
                                            }).then(function(msg) {
                                                if (msg.msg == "doble") {
                                                    toastr.error("", "Ya tiene una solicitud asociada a esta hora.");
                                                } else if (msg.msg == "duplicado") {
                                                    toastr.error("", "Rut ya esta registado");
                                                } else if (msg.msg == "ok") {
                                                    getDetalle();
                                                    toastr.success("", "Solicitud de hora realizada de forma correcta");
                                                } else {
                                                    toastr.error("", "Error al tomar hora");
                                                }
                                            });
                                        } else {
                                            toastr.error("", "El correo no tiene el formato adecuado");
                                        }
                                    } else {
                                        toastr.error("", "Complete el correo");
                                    }
                                } else {
                                    toastr.error("", "Complete el telefono");
                                }
                            } else {
                                toastr.error("", "Complete la dirección");
                            }
                        } else {
                            toastr.error("", "Complete el nombre");
                        }
                    } else {
                        toastr.error("", "Ingrese el rut");
                    }
                });

                $("body").on("click", "#btnAddSolicitudExistente", function(e) {
                    e.preventDefault();
                    var correo = $("#correoE").val();
                    var idPaciente = $("#idPacienteE").val();
                    var nombre = $("#nombreE").val();
                    var mensaje = $("#seleccion").val();
                    if (correo != "") {
                        if (idPaciente != "") {
                            if (correo.includes("@")) {
                                $.ajax({
                                    url: 'addSolicitudHorario',
                                    type: 'POST',
                                    dataType: 'json',
                                    data: {
                                        "idPaciente": idPaciente,
                                        "idDetalle": idDetalle,
                                        "correo": correo,
                                        "nombre": nombre,
                                        "mensaje": mensaje
                                    }
                                }).then(function(msg) {
                                    if (msg.msg == "doble") {
                                        toastr.error("", "Ya tiene una solicitud asociada a esta hora.");
                                    } else if (msg.msg == "ok") {
                                        getDetalle();
                                        toastr.success("", "Solicitud de hora realizada de forma correcta");
                                    } else {
                                        toastr.error("", "Error al tomar hora");
                                    }
                                });
                            } else {
                                toastr.error("", "El correo no tiene el formato adecuado");
                            }
                        } else {
                            toastr.error("", "Error al agendar hora");
                        }
                    } else {
                        toastr.error("", "Complete el correo");
                    }
                    console.log(idPaciente)
                    console.log(correo)
                });

                function getDetalle() {
                    $.ajax({
                        url: 'getDetalleAgenda',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            "id": idSeleccionado
                        }
                    }).then(function(msg) {
                        var fila = "";
                        var total = 0;
                        $.each(msg, function(i, o) {
                            $("#tbodyDetalle").empty();
                            if (o.idEstado_Agenda == 1) {
                                fila += "<tr style='background-color: #B2EBF2 ;black'>";
                            } else if (o.idEstado_Agenda == 2) {
                                fila += "<tr  style='background-color:#80DEEA; color:black'>";
                            } else if (o.idEstado_Agenda == 3) {
                                fila += "<tr  style='background-color:  cyan; color:black'>";
                            } else {
                                fila += "<tr>";
                            }

                            if (o.idPaciente == null) {
                                fila += "   <td>Sin Paciente</td>";
                            } else {
                                fila += "   <td>" + o.idPaciente + "</td>";
                            }
                            fila += "   <td>" + o.orden + "</td>";
                            fila += "   <td>" + o.hora_inicio + "</td>";
                            fila += "   <td>" + o.hora_fin + "</td>";
                            var estado = "";
                            if (o.estado == "1") {
                                estado = '<button type="button" id="editarEstadoDetalle" value="' + o.idAgenda_Detalle +
                                    ',2" class="btn btn-danger btn-xs m-l-sm">Desactivar</button>';
                            } else {
                                estado = '<button type="button" id="editarEstadoDetalle" value="' + o.idAgenda_Detalle +
                                    ',1" class="btn btn-info btn-xs m-l-sm">Activar</button>';
                            }
                            if (o.idEstado_Agenda == 2) {
                                fila += "   <td><select style='color:black;' class='selectEstado' class='form-control' id='estadoAgenda-" + o.idAgenda_Detalle + "'><option disabled selected>Elija el tipo de Hora</option></select></td>";
                            } else if (o.idEstado_Agenda == 3) {
                                fila += "   <td><select style='color:black;' class='selectEstado' class='form-control' id='estadoAgenda-" + o.idAgenda_Detalle + "'><option disabled selected>Elija el tipo de Hora</option></select></td>";
                            } else {
                                fila += "   <td><select class='selectEstado' class='form-control' id='estadoAgenda-" + o.idAgenda_Detalle + "'><option disabled selected>Elija el tipo de Hora</option></select></td>";
                            }
                            $.ajax({
                                url: 'getEstadoAgenda',
                                type: 'POST',
                                dataType: 'json'
                            }).then(function(obj) {
                                fila2 = "";
                                fila2 += "<option disabled selected>Seleccione un Estado</option>";
                                var idSelect = "#estadoAgenda-" + o.idAgenda_Detalle;
                                $.each(obj, function(i, a) {
                                    $(idSelect).empty();
                                    fila2 += "<option value='" + a.idEstado_Agenda + "'>" + a.nombre + "</option>";
                                    $(idSelect).append(fila2);
                                });
                                $(idSelect + " option[value=" + o.idEstado_Agenda + "]").attr("selected", true);
                            });
                            fila += "   <td>" + estado + "</td>";

                            if (o.idEstado_Agenda == 2) {
                                fila += "   <td><button style='color:black;' value='" + o.idAgenda_Detalle + "' id='btnVerSolicitud' class='btn-xs m-l-sm'>Ver Solicitudes (" + o.cantidad + ")</button></td>";
                            } else if (o.idEstado_Agenda == 3) {
                                fila += "   <td><button style='color:black;' value='" + o.idAgenda_Detalle + "' id='btnVerSolicitud' class='btn-xs m-l-sm'>Ver Solicitudes (" + o.cantidad + ")</button></td>";
                            } else {
                                fila += "   <td><button value='" + o.idAgenda_Detalle + "' id='btnVerSolicitud' class='btn-xs m-l-sm'>Ver Solicitudes (" + o.cantidad + ")</button></td>";
                            }

                            if (o.idPaciente == null) {
                                if (o.idEstado_Agenda == 2) {
                                    fila += "   <td><button style='color:black;' class='btn-xs m-l-sm' value='" + o.idAgenda_Detalle + "," + o.hora_inicio + "," + o.hora_fin + "' id='btnAgregarSolicitud'>Agregar Paciente</button></td>";
                                } else if (o.idEstado_Agenda == 3) {
                                    fila += "   <td><button style='color:black;' class='btn-xs m-l-sm' value='" + o.idAgenda_Detalle + "," + o.hora_inicio + "," + o.hora_fin + "' id='btnAgregarSolicitud'>Agregar Paciente</button></td>";
                                } else {
                                    fila += "   <td><button class='btn-xs m-l-sm' value='" + o.idAgenda_Detalle + "," + o.hora_inicio + "," + o.hora_fin + "' id='btnAgregarSolicitud'>Agregar Paciente</button></td>";
                                }
                            } else {
                                fila += "   <td></td>";
                            }

                            fila += "</tr>";
                            $("#tbodyDetalle").append(fila);
                            total = parseInt(total) + parseInt(o.cantidad);

                        });
                        var labelSolicitudes = document.getElementById("totalSolicitudes");
                        labelSolicitudes.innerText = total;
                        labelSolicitudes.style.color = 'red';
                    });
                }

                $("#btn").click(function(e) {
                    e.preventDefault();

                    $.ajax({
                        url: 'eliminarSesion',
                        type: 'POST',
                        dataType: 'json'
                    }).then(function(msg) {

                    });
                    window.location = "https://www.vitades.cl/Agenda/Login";
                });

                $("body").on("click", "#btnAgregarSolicitud", function(e) {
                    e.preventDefault();
                    var variable = $(this).val();
                    variable = variable.split(",");
                    idDetalle = variable[0];
                    var hora_inicio = variable[1];
                    var hora_fin = variable[2];
                    var resultado = "Selecciono hora para el " + dia + " desde las " + hora_inicio + " hasta las " + hora_fin + " hrs.";
                    var seleccion = document.getElementById("seleccion");
                    seleccion.innerText = resultado;
                    $("#seleccion").val(resultado)
                    setTimeout(() => {
                        var flecha = document.getElementById("divFormulario");
                        flecha.style.display = "block";
                        $("#divFormulario").addClass("animated fadeInUpBig");
                    }, 200);

                });

                $("body").on("click", "#rechazarSolicitud", function(e) {
                    e.preventDefault();
                    var variable = $(this).val();
                    variable = variable.split(",");
                    var id = variable[0];
                    var idPaciente = variable[1];
                    $.ajax({
                        url: 'editarSolicitud',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            "id": id,
                            "resultado": "rechazar",
                            "paciente": idPaciente

                        }
                    }).then(function(msg) {
                        if (msg.msg == "ok") {
                            toastr.success("", "Rechazado de forma correcta");
                            getDatatableDetalle();
                            getDetalle();
                        } else if (msg.msg == "errorcorreo") {
                            toastr.warning("", "Rechazado pero no se pudo enviar el correo");
                        } else if (msg.msg == "error") {
                            toastr.error("", "No se pudo rechazar");
                        }
                    });
                });

                $("body").on("click", "#esperaSolicitud", function(e) {
                    e.preventDefault();
                    var variable = $(this).val();
                    variable = variable.split(",");
                    var id = variable[0];
                    var idPaciente = variable[1];
                    $.ajax({
                        url: 'editarSolicitud',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            "id": id,
                            "resultado": "espera",
                            "paciente": idPaciente
                        }
                    }).then(function(msg) {
                        if (msg.msg == "ok") {
                            toastr.success("", "Informado de forma correcta");
                            getDatatableDetalle();
                            getDetalle();
                        } else if (msg.msg == "errorcorreo") {
                            toastr.warning("", "En espera, pero no se pudo enviar el correo");
                        } else if (msg.msg == "error") {
                            toastr.error("", "No se pudo poner en espera");
                        }
                    });
                });

                $("body").on("click", "#aceptarSolicitud", function(e) {
                    e.preventDefault();
                    var variable = $(this).val();
                    variable = variable.split(",");
                    var id = variable[0];
                    var idPaciente = variable[1];
                    $.ajax({
                        url: 'editarSolicitud',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            "id": id,
                            "resultado": "aceptar",
                            "paciente": idPaciente
                        }
                    }).then(function(msg) {
                        if (msg.msg == "ok") {
                            toastr.success("", "Aprobado de forma correcta");
                            getDatatableDetalle();
                            getDetalle();
                        } else if (msg.msg == "errorcorreo") {
                            toastr.warning("", "Aprobado pero no se pudo enviar el correo");
                        } else if (msg.msg == "error") {
                            toastr.error("", "No se pudo aprobar");
                        }
                    });
                });

                $("body").on("change", ".selectEstado", function(e) {
                    e.preventDefault();
                    var variable = $(this).attr("id");
                    variable = variable.split("-");
                    var id = variable[1];
                    var estado = $(this).val();
                    $.ajax({
                        url: 'editarEstadoAgenda',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            "id": id,
                            "estado": estado
                        }
                    }).then(function(msg) {
                        if (msg.msg == "ok") {
                            toastr.success("", "Se actualizo el horario con exito");
                            getDetalle();
                        } else {
                            toastr.error("", "Error al actualizar el horario");
                        }
                    });
                });

                $("body").on("click", "#btnVerSolicitud", function(e) {
                    e.preventDefault();
                    var valor = $(this).val();
                    //idSeleccionado = valor;
                    idDetalle = valor;
                    console.log(idDetalle)
                    var solicitudes = document.getElementById("solicitudes");
                    solicitudes.style.display = "block";
                    getDatatableDetalle();
                });

                $("body").on("click", "#btnModalAgenda", function(e) {
                    e.preventDefault();
                    var variable = $(this).val();
                    variable = variable.split(",");
                    //value="' . $r->id . ','.$dia_inicio.','.$hora_fin.','.$hora_fin.'"
                    dia = variable[1];
                    idSeleccionado = variable[0];
                    getDetalle();
                    var modal = document.getElementById("solicitudes");
                    modal.style.display = "none";
                });

                $("body").on("click", "#editarEstadoDetalle", function(e) {
                    e.preventDefault();
                    var valor = this.value;
                    var variables = valor.split(",");
                    var id = variables[0];
                    var estado = variables[1];
                    var mensaje = "";
                    if (estado == 2) {
                        mensaje = "Hora desactivada de forma exitosa";
                    } else {
                        mensaje = "Hora activada de forma exitosa";
                    }
                    $.ajax({
                        url: 'editarAgendaDetalle',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            "id": id,
                            "estado": estado
                        }
                    }).then(function(msg) {
                        if (msg.msg == "ok") {
                            toastr.success("", mensaje);
                            getDetalle();
                        } else {
                            toastr.error("", "Error");
                        }
                    });
                });

                $("body").on("click", "#editarEstado", function(e) {
                    e.preventDefault();
                    var valor = this.value;
                    var variables = valor.split(",");
                    var id = variables[0];
                    var estado = variables[1];
                    var mensaje = "";
                    if (estado == 2) {
                        mensaje = "Horario desactivado de forma exitosa";
                    } else {
                        mensaje = "Horario activado de forma exitosa";
                    }
                    $.ajax({
                        url: 'editarAgenda',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            "id": id,
                            "estado": estado
                        }
                    }).then(function(msg) {
                        if (msg.msg == "ok") {
                            toastr.success("", mensaje);
                            setTimeout(() => {
                                var table = $('.dataTables-agenda').DataTable();
                                table.ajax.reload(function(json) {
                                    $('#editarEstado').val(json.lastInput);
                                });
                            }, 500);
                        } else {
                            toastr.error("", "Error");
                        }
                    });
                });


                function getEstados(id) {
                    $.ajax({
                        url: 'getEstadoAgenda',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            "id": id
                        }
                    }).then(function(msg) {
                        fila = "";
                        fila += "<option disabled selected>Seleccione un Estado</option>";
                        $.each(msg, function(i, o) {
                            $("#estadoAgenda").empty();
                            fila += "<option value='" + o.idEstado_Agenda + "'>" + o.nombre + "</option>";
                            $("#estadoAgenda").append(fila);
                        });
                    });
                }

                $("#medicos").change(function(e) {
                    e.preventDefault();
                    var id = $(this).val();
                    getEspecialidades(id);
                });

                function getEspecialidades(id) {
                    $.ajax({
                        url: 'getEspecialidadesSelectMedico',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            "id": id
                        }
                    }).then(function(msg) {
                        fila = "";
                        fila += "<option disabled selected>Seleccione una especialidad</option>";
                        $.each(msg, function(i, o) {
                            $("#especialidades").empty();
                            fila += "<option value='" + o.idEspecialidadMedicos + "'>" + o.NombreEspecialidad + " (" + o.TiempoAtencion + " Min.)</option>";
                            $("#especialidades").append(fila);
                        });
                    });
                }

                $("#btnAgregar").click(function(e) {
                    e.preventDefault();
                    var especialidad = $("#especialidades").val();
                    var inicio = $("#hora_inicio").val();
                    var fin = $("#hora_fin").val();
                    if (especialidad != null) {
                        console.log("paso2")
                        if (inicio != "" || fin != "") {
                            console.log("paso3")
                            console.log(especialidad)
                            console.log(inicio)
                            console.log(fin)
                            $.ajax({
                                url: 'addAgenda',
                                type: 'POST',
                                dataType: 'json',
                                data: {
                                    "especialidad": especialidad,
                                    "inicio": inicio,
                                    "fin": fin
                                }
                            }).then(function(msg) {
                                console.log(msg);
                                if (msg.msg == "ok") {
                                    toastr.success("", "Horario asignado")
                                }
                                setTimeout(() => {
                                    var table = $('.dataTables-agenda').DataTable();
                                    table.ajax.reload(function(json) {
                                        $('#btnAgregar').val(json.lastInput);
                                    });
                                }, 500);
                            });
                        } else {
                            toastr.error("", "Fije hora inicio y hora fin")
                        }
                    } else {
                        toastr.error("", "Seleccione la especialidad")
                    }
                });

                function getDatatableDetalle() {
                    var table = $('.tableDetalle').DataTable();


                    table.destroy();
                    $('.tableDetalle').DataTable({
                        language: {
                            "sProcessing": "Procesando...",
                            "sLengthMenu": "Registros _MENU_ ",
                            "sZeroRecords": "No se encontraron resultados",
                            "sEmptyTable": "Ningún dato disponible en esta tabla =(",
                            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                            "sInfoPostFix": "",
                            "sSearch": "Buscar:",
                            "sUrl": "",
                            "sInfoThousands": ",",
                            "sLoadingRecords": "Cargando...",
                            "oPaginate": {
                                "sFirst": "Primero",
                                "sLast": "Último",
                                "sNext": "Siguiente",
                                "sPrevious": "Anterior"
                            },
                            "oAria": {
                                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                            },
                            "buttons": {
                                "copy": "Copiar",
                                "colvis": "Visibilidad"
                            }
                        },
                        "ajax": {
                            url: "<?php echo site_url() ?>getSolicitudes",
                            type: 'GET',
                            data: {
                                "id": idDetalle
                            }
                        },
                        dom: '<"html5buttons"B>lTfgitp',
                        buttons: [{
                                extend: 'copy'
                            },
                            {
                                extend: 'csv'
                            },
                            {
                                extend: 'excel',
                                title: 'Lista de Pacientes'
                            },
                            {
                                extend: 'pdf',
                                title: 'Lista de Pacientes'
                            },
                            {
                                extend: 'print',
                                customize: function(win) {
                                    $(win.document.body).addClass('white-bg');
                                    $(win.document.body).css('font-size', '10px');
                                    $(win.document.body).find('table')
                                        .addClass('compact')
                                        .css('font-size', 'inherit');
                                }
                            }
                        ]

                    });
                }

                $('.dataTables-agenda').DataTable({
                    language: {
                        "sProcessing": "Procesando...",
                        "sLengthMenu": "Registros _MENU_ ",
                        "sZeroRecords": "No se encontraron resultados",
                        "sEmptyTable": "Ningún dato disponible en esta tabla =(",
                        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                        "sInfoPostFix": "",
                        "sSearch": "Buscar:",
                        "sUrl": "",
                        "sInfoThousands": ",",
                        "sLoadingRecords": "Cargando...",
                        "oPaginate": {
                            "sFirst": "Primero",
                            "sLast": "Último",
                            "sNext": "Siguiente",
                            "sPrevious": "Anterior"
                        },
                        "oAria": {
                            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                        },
                        "buttons": {
                            "copy": "Copiar",
                            "colvis": "Visibilidad"
                        }
                    },
                    "ajax": {
                        url: "<?php echo site_url() ?>getAgenda",
                        type: 'GET'
                    },
                    dom: '<"html5buttons"B>lTfgitp',
                    buttons: [{
                            extend: 'copy'
                        },
                        {
                            extend: 'csv'
                        },
                        {
                            extend: 'excel',
                            title: 'Lista de Pacientes'
                        },
                        {
                            extend: 'pdf',
                            title: 'Lista de Pacientes'
                        },
                        {
                            extend: 'print',
                            customize: function(win) {
                                $(win.document.body).addClass('white-bg');
                                $(win.document.body).css('font-size', '10px');
                                $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                            }
                        }
                    ]

                });


            });
        });
    </script>
</body>

</html>