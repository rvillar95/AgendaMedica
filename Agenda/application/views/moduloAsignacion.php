<!DOCTYPE html>
<?php $user = $this->session->userdata("administrador"); ?>
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
                    <h2>Modulo Asignación Medicos</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo base_url() ?>Menu">Inicio</a>
                        </li>
                        <li class="active">
                            <strong>Modulo Asignación Medicos</strong>
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
                    <h2><strong>Registros de Medicos</strong></h2>
                    <div class="table-responsive">
                        <table id="juego" class="table table-striped table-bordered table-hover dataTables-pacientes">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Rut</th>
                                    <th>Nombre</th>
                                    <th>Direccion</th>
                                    <th>Telefono</th>
                                    <th>Correo</th>
                                    <th>Asignaciones</th>
                                    <th>Asignar</th>
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

    <div class="modal inmodal fade" id="modal-paciente" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Agregar Especialidades</h4>
                    <small class="font-bold">En este modulo podras editar todos los datos de cualquier Medico.</small>
                </div>
                <div class="modal-body" id="info-paciente">
                    <label for="" id="medico"></label>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <select name="especialidades" id="especialidades" class="form-control"></select>
                        </div>
                        <div class="form-group col-md-6">
                            <input type="number" id="tiempo" placeholder="Ingrese el tiempo" class="form-control" min="1">
                        </div>
                        <div class="form-group col-md-6"></div>
                        <div class="form-group col-md-6">
                            <button type="submit" id="btnAgregar" class="btn btn-primary block full-width m-b">Agregar Especialidad</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                // getRegiones();
                var idSeleccionado = 0;
                getInformacion();
                getEspecialidades();

                $("body").on("click", "#btnAddEspecialidad", function(e) {
                    e.preventDefault();
                    var datos = $(this).val();
                    var datos = datos.split(",");
                    idSeleccionado = datos[0];
                    var nombre = datos[1];
                    var label = document.getElementById("medico");
                    label.innerText = "Medico seleccionado: " + nombre;
                });

                $("body").on("click", "#btnEditarEspecialidad", function(e) {
                    e.preventDefault();
                    var datos = $(this).val();
                    var datos = datos.split(",");
                    var id = datos[0];
                    var estado = datos[1];
                    $.ajax({
                        url: 'editarEspecialidadMedico',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            "id": id,
                            "estado": estado,
                        }
                    }).then(function(msg) {
                        getInformacion();
                    });
                });

                $("#btnAgregar").click(function(e) {
                    e.preventDefault();
                    var idEspecialidad = $("#especialidades").val();
                    var tiempo = $("#tiempo").val();

                    if (idEspecialidad != null) {
                        if (tiempo != "") {
                            $.ajax({
                                url: 'addEspecialidadMedico',
                                type: 'POST',
                                dataType: 'json',
                                data: {
                                    "idMedico": idSeleccionado,
                                    "idEspecialidad": idEspecialidad,
                                    "tiempo": tiempo
                                }
                            }).then(function(msg) {
                                if (msg.msg == "ok") {
                                    toastr.success("", "Asignación Correcta")
                                    getInformacion();
                                } else if (msg.msg == "existe") {
                                    toastr.error("", "Asignacion ya existe")
                                } else if (msg.msg == "error") {
                                    toastr.error("", "Error al agregar asignación")
                                }

                            });
                        } else {
                            toastr.error("", "Seleccione el tiempo")
                        }
                    } else {
                        toastr.error("", "Seleccione la especialidad")

                    }
                });

                function getEspecialidades() {
                    $.ajax({
                        url: 'getEspecialidadesMedico',
                        type: 'POST',
                        dataType: 'json',
                    }).then(function(msg) {
                        fila = "";
                        fila += "<option disabled selected>Seleccione una especialidad</option>";
                        $.each(msg, function(i, o) {

                            $("#especialidades").empty();
                            fila += "<option value='" + o.idEspecialidad + "'>" + o.NombreEspecialidad + "</option>";
                            $("#especialidades").append(fila);
                        });
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

                function getInformacion() {
                    $.ajax({
                        url: 'getMedicosAsignacion',
                        type: 'POST',
                        dataType: 'json',
                    }).then(function(msg) {
                        var fila = "";
                        $.each(msg, function(i, o) {
                            console.log(o.id);
                            $.ajax({
                                url: 'asignacionXmedico',
                                type: 'POST',
                                dataType: 'json',
                                data: {
                                    "id": o.id
                                }
                            }).then(function(esp) {
                                $("#tbodyMedicos").empty();

                                fila += "<tr>";
                                fila += "   <td>" + o.id + "</td>";
                                fila += "   <td>" + o.rut + "</td>";
                                fila += "   <td>" + o.nombre + "</td>";
                                fila += "   <td>" + o.direccion + "</td>";
                                fila += "   <td>" + o.telefono + "</td>";
                                fila += "   <td>" + o.correo + "</td>";
                                fila += "    <td>";
                                if (esp.length != 0) {
                                    $.each(esp, function(i, k) {
                                        if (k.estado == "1") {
                                            fila += '<p style="color:green;">Especialidad: ' + k.nombreEspecialidad + ' Tiempo: ' + k.TiempoAtencion + ' min.<button type="button" id="btnEditarEspecialidad" value="' + k.idEspecialidadMedicos + ',2" class="btn btn-info btn-xs m-l-sm" ><i class="glyphicon glyphicon-pencil"></i></button></p>';
                                        } else {
                                            fila += '<p style="color:red;">Especialidad: ' + k.nombreEspecialidad + ' Tiempo: ' + k.TiempoAtencion + ' min.<button type="button" id="btnEditarEspecialidad" value="' + k.idEspecialidadMedicos + ',1" class="btn btn-info btn-xs m-l-sm" ><i class="glyphicon glyphicon-pencil"></i></button></p>';
                                        }

                                    });
                                } else {
                                    fila += "Sin Especialidad (Sin Tiempo)<br>";
                                }
                                fila += "    </td>";
                                fila += '   <td><button type="button" id="btnAddEspecialidad" value="' + o.id + ',' + o.nombre + '" class="btn btn-info" data-toggle="modal" data-target="#modal-paciente"><i class="glyphicon glyphicon-pencil"></i></button></td>';
                                fila += "</tr>";
                                $("#tbodyMedicos").append(fila);
                            });

                        });

                        // $("#tbodyMedicos").append(fila);
                    });
                }

            });
        });
    </script>
</body>

</html>