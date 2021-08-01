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
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0; background-color: cyan">
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
                            <a href="https://vitades.cl/index.php" style="color: black;">
                                <i class="fa fa-sign-out" style="color: black"></i> Volver
                            </a>
                        </li>
                    </ul>

                </nav>
            </div>

            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-4">
                    <h2>Modulo Agenda de Hora</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="https://vitades.cl/index.php">Inicio</a>
                        </li>
                        <li class="active">
                            <strong>Modulo Agenda de Hora</strong>
                        </li>
                    </ol>
                </div>

                <div class="col-sm-4 form-group">
                    <label>Rut</label><input id="username2" required type="text" name="j_username" class="form-control" oninput="checkRut2(this)" onblur="formateaRut2(this)">

                </div>
                <div class="col-sm-4 form-group">
                    <button class="btn btn-primary" id="btnhistorialSolicitud" style="margin-top: 23px;">Ver Solicitudes Realizadas</button>
                </div>
            </div>
            <!--especialidad-->
            <div class="wrapper wrapper-content  animated fadeInLeftBig" style="padding-bottom: 0px; margin-bottom: 0px;">
                <div class="row" style="padding: 20px;">
                    <h2><strong>Registros Hora Medica</strong></h2>
                    <br>
                    <div class="col-md-12">
                        <div class="col-md-3">
                            <label for="">Especialidad</label>
                            <select name="" id="especialidad" class="form-control"></select>
                        </div>
                        <div class="col-md-3" style="display: none;" id="divMedicos">
                            <label for="">Medico</label>
                            <select name="" id="medicos" class="form-control"></select>
                        </div>
                    </div>
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
            <div class="wrapper wrapper-content  animated fadeInRight" style="padding-bottom: 0px;">
                <div class="row" style="padding: 20px;">
                    <h2><strong>Registros Hora Medica</strong></h2>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Día</th>
                                    <th>Hora Inicio</th>
                                    <th>Hora Fin</th>
                                    <th>Agendar</th>
                                </tr>
                            </thead>
                            <tbody id="tbodyHora">

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

    <div class="modal inmodal fade" id="solicitud-paciente" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Ver Solicitudes Paciente</h4>
                    <small class="font-bold">En este modulo podras ver todas las solicitudes del Paciente.</small>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12" id="historial">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Usuario</th>
                                            <th>Estado Antiguo</th>
                                            <th>Estado Nuevo</th>
                                            <th>Estado Hora</th>
                                            <th>Fecha</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbodyHistorial">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <h2><strong>Registros de Solicitudes</strong></h2>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-solicitudes">
                                <thead>
                                    <tr>
                                        <th>Medico</th>
                                        <th>Especialidad</th>
                                        <th>Dia</th>
                                        <th>Hora</th>
                                        <th>Fecha Solicitud</th>
                                        <th>Estado</th>
                                        <th>Notificado</th>
                                        <th>Historial</th>
                                        <th>Cancelar</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
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

                getEspecialidad();

                function getEspecialidad() {
                    $.ajax({
                        url: 'getEspecialidadesPublico',
                        type: 'POST',
                        dataType: 'json',
                    }).then(function(msg) {
                        fila = "";
                        fila += "<option disabled selected>Seleccione una Especialidad</option>";
                        $.each(msg, function(i, o) {
                            $("#especialidad").empty();
                            fila += "<option value='" + o.idEspecialidad + "'>" + o.NombreEspecialidad + "</option>";
                            $("#especialidad").append(fila);
                        });
                    });
                }

                $("#btnhistorialSolicitud").click(function(e) {
                    e.preventDefault();
                    var rut = $("#username2").val();
                    if (rut != "") {
                        getSolicitudes(rut);
                        $("#solicitud-paciente").modal('show');
                    } else {
                        toastr.error("", "Ingrese el rut");
                    }
                });

                $("body").on("click", "#cancelarSolicitud", function(e) {
                    e.preventDefault();
                    var variable = $(this).val();
                    variable = variable.split(",");
                    var idAgenda = variable[0];
                    var idPaciente = variable[1];
                    $.ajax({
                        url: 'editarSolicitudPublico',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            "id": idAgenda,
                            "paciente": idPaciente,
                            "resultado": "anular"
                        }
                    }).then(function(msg) {
                        if (msg.msg == "ok") {
                            var rut = $("#username2").val();
                            if (rut != "") {
                                getSolicitudes(rut);
                                $("#solicitud-paciente").modal('show');
                            } else {
                                toastr.error("", "Ingrese el rut");
                            }
                            toastr.success("", "Proceso de anulacion iniciado");
                        } else {
                            toastr.error("", "Error al anular");
                        }
                    });
                });


                $("body").on("click", "#historialSolicitud", function(e) {
                    e.preventDefault();
                    var id = $(this).val();
                    $.ajax({
                        url: 'getHistorialSolicitudPublico',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            "id": id
                        }
                    }).then(function(msg) {
                        $("#tbodyHistorial").empty();
                        var fila = "";
                        $.each(msg, function(i, o) {
                            fila += "<tr>";
                            if (o.NombreUsuario == null || o.NombreUsuario == "") {
                                fila += "   <td>Paciente</td>";
                            } else {
                                fila += "   <td>" + o.NombreUsuario + "</td>";
                            }
                            fila += "   <td>" + o.antiguo + "</td>";
                            if (o.nuevo == null || o.nuevo == "") {
                                fila += "   <td>Recien Creada</td>";
                            } else {
                                fila += "   <td>" + o.nuevo + "</td>";
                            }

                            fila += "   <td>" + o.nombre + "</td>";
                            fila += "   <td>" + o.fecha + "</td>";
                            fila += "</tr>";
                        });
                        $("#tbodyHistorial").append(fila);
                        //console.log(msg);
                    });
                });

                function getSolicitudes(rut) {
                    var table = $('.dataTables-solicitudes').DataTable();
                    table.destroy();
                    $('.dataTables-solicitudes').DataTable({
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
                            url: "<?php echo site_url() ?>getSolicitudPacienteRut",
                            type: 'GET',
                            data: {
                                "rut": rut
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
                                                url: 'addSolicitudHorarioEspecialPublico',
                                                type: 'POST',
                                                dataType: 'json',
                                                data: {
                                                    "idDetalle": idSeleccionado,
                                                    "nombre": nombre,
                                                    "correo": correo,
                                                    "direccion": direccion,
                                                    "telefono": telefono,
                                                    "rut": rut,
                                                    "mensaje": mensaje
                                                }
                                            }).then(function(msg) {
                                                if (msg.msg == "doble") {
                                                    toastr.error("", "Ya tiene una solicitud para esta Hora.");
                                                } else if (msg.msg == "duplicado") {
                                                    toastr.error("", "Rut ya esta registado");
                                                } else if (msg.msg == "ok") {
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
                                    url: 'addSolicitudHorarioPublico',
                                    type: 'POST',
                                    dataType: 'json',
                                    data: {
                                        "idPaciente": idPaciente,
                                        "idDetalle": idSeleccionado,
                                        "correo": correo,
                                        "nombre": nombre,
                                        "mensaje": mensaje
                                    }
                                }).then(function(msg) {
                                    if (msg.msg == "ok") {
                                        toastr.success("", "Solicitud de hora realizada de forma correcta");
                                    } else if (msg.msg == "doble") {
                                        toastr.error("", "Ya tiene una hora asociada.");
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

                function getMedicos(id) {
                    $.ajax({
                        url: 'getMedicosPublico',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            "id": id
                        }
                    }).then(function(msg) {
                        fila = "";
                        fila += "<option disabled selected>Seleccione una Especialidad</option>";
                        $.each(msg, function(i, o) {
                            $("#medicos").empty();
                            fila += "<option value='" + o.idEspecialidadMedicos + "'>" + o.NombreMedico + " (Atención de " + o.TiempoAtencion + " Min.)</option>";
                            $("#medicos").append(fila);
                        });
                    });
                }

                $("#medicos").change(function(e) {
                    e.preventDefault();
                    var id = $(this).val();
                    $.ajax({
                        url: 'consultarAgenda',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            "id": id
                        }
                    }).then(function(msg) {
                        //console.log(msg);
                        var fila = "";
                        if (msg.msg == "error") {
                            toastr.error("", "No existen horas");
                            $("#tbodyHora").empty();
                        } else {
                            $.each(msg, function(i, o) {
                                $("#tbodyHora").empty();
                                var variable_inicio = o.hora_inicio.split(" ");
                                variable_inicio = variable_inicio[0].split("-");
                                var dia = variable_inicio[2] + "-" + variable_inicio[1] + "-" + variable_inicio[0];
                                fila += "<tr>";
                                fila += "   <td>" + dia + "</td>";
                                fila += "   <td>" + o.inicio + "</td>";
                                fila += "   <td>" + o.fin + "</td>";
                                fila += "   <td><button id='btnPedirHora' value='" + o.id + "," + dia + "," + o.inicio + "," + o.fin + "'>Pedir Hora</button></td>";
                                fila += "</tr>";
                                $("#tbodyHora").append(fila);
                            });
                        }
                    });

                });

                $("#especialidad").change(function(e) {
                    e.preventDefault();
                    var id = $(this).val();
                    getMedicos(id);
                    setTimeout(() => {
                        var flecha = document.getElementById("divMedicos");
                        flecha.style.display = "block";
                        $("#divMedicos").addClass("animated fadeInLeftBig form-inline");
                    }, 200);

                });


                $("body").on("click", "#btnPedirHora", function(e) {
                    e.preventDefault();
                    $("#username").val("");
                    var variable = $(this).val();
                    variable = variable.split(",");
                    idSeleccionado = variable[0];
                    var dia = variable[1];
                    var inicio = variable[2];
                    var fin = variable[3];
                    console.log(idSeleccionado);
                    var resultado = "Selecciono hora para el " + dia + " desde las " + inicio + " hasta las " + fin + " hrs.";
                    var seleccion = document.getElementById("seleccion");
                    seleccion.innerText = resultado;
                    $("#seleccion").val(resultado)
                    setTimeout(() => {
                        var flecha = document.getElementById("divFormulario");
                        flecha.style.display = "block";
                        $("#divFormulario").addClass("animated fadeInUpBig");
                    }, 200);
                });
            });
        });
    </script>
</body>

</html>