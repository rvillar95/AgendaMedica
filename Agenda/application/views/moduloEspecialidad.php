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
                    <h2>Modulo Especialidad</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo base_url() ?>Menu">Inicio</a>
                        </li>
                        <li class="active">
                            <strong>Modulo Especialidad</strong>
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
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12"><label>Nombre Especialidad</label><input id="nombre" required type="text" class="form-control"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group form-group col-lg-3 col-md-3 col-sm-4 col-xs-12"><button type="submit" id="btnAgregarEspecialidades" class="btn btn-primary" style="background-color: black; color: white; ">Agregar Especialidad</button></div>
                    </div>
                </div>
            </div>
            <div class="wrapper wrapper-content  animated fadeInRight">
                <div class="row" style="padding: 20px;">
                    <h2><strong>Registros de Pacientes</strong></h2>
                    <div class="table-responsive">
                        <table id="juego" class="table table-striped table-bordered table-hover dataTables-especialidad">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Estado</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody>

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

    <div class="modal inmodal fade" id="modal-especialidad" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Editar Especialidad</h4>
                    <small class="font-bold">En este modulo podras editar el nombre de todas las Especialidades.</small>
                </div>
                <div class="modal-body" id="info-especialidad">


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
                $("#btnAgregarEspecialidades").click(function(e) {
                    e.preventDefault();
                    var nombre = $("#nombre").val();
                    if (nombre != "") {
                        $.ajax({
                            url: 'addEspecialidad',
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                "nombre": nombre
                            }
                        }).then(function(msg) {
                            console.log(msg);
                            if (msg.msg == "ok") {
                                toastr.success("", "Especialidad agregada de manera correcta.");
                                setTimeout(() => {
                                    var table = $('.dataTables-especialidad').DataTable();
                                    table.ajax.reload(function(json) {
                                        $('#btnAgregarEspecialidades').val(json.lastInput);
                                    });
                                }, 500);
                            } else {
                                toastr.error("", "Error");
                            }
                        });
                    } else {
                        toastr.warning("", "Ingrese el nombre de la especialidad");
                    }
                });


                var idSeleccionado = 0;
                $("body").on("click", "#btnEditarEspecialidad", function(e) {
                    e.preventDefault();
                    var valor = this.value;
                    var variables = valor.split(",");
                    var id = variables[0];
                    var nombre = variables[1];
                    idSeleccionado = id;
                    $("#info-especialidad").empty();
                    var div = "";
                    div += '<div class="row">';
                    div += '  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12"><label>Nombre Paciente</label> <input type="text" value="' + nombre + '" id="nombre2" class="form-control"></div>';
                    div += '<div class="form-group form-group col-lg-3 col-md-3 col-sm-4 col-xs-12"><button type="submit" id="btnEditarDatosEspecialidad" class="btn btn-primary" style="background-color: black; color: white; ">Editar Paciente</button></div>'
                    div += '</div>';
                    $("#info-especialidad").append(div);
                });

                $("body").on("click", "#btnEditarDatosEspecialidad", function(e) {
                    e.preventDefault();
                    var nombre = $("#nombre2").val();
                    console.log();
                    if (nombre != "") {
                        $.ajax({
                            url: 'editarDatosEspecialidad',
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                "id": idSeleccionado,
                                "nombre": nombre
                            }
                        }).then(function(msg) {
                            console.log(msg);
                            if (msg.msg == "ok") {
                                toastr.success("", "Especialidad editada de forma exitosa");
                                setTimeout(() => {
                                    var table = $('.dataTables-especialidad').DataTable();
                                    table.ajax.reload(function(json) {
                                        $('#btnEditarDatosEspecialidad').val(json.lastInput);
                                    });
                                }, 500);
                            } else {
                                toastr.error("", "Error");
                            }
                        });
                    } else {
                        toastr.error("", "Ingrese el nombre.")
                    }
                });

                $("body").on("click", "#editarEstado", function(e) {
                    e.preventDefault();
                    var valor = this.value;
                    var variables = valor.split(",");
                    var id = variables[0];
                    var estado = variables[1];
                    var mensaje = "";
                    if (estado == 2) {
                        mensaje = "Especialidad desactivado de forma exitosa";
                    } else {
                        mensaje = "Especialidad activado de forma exitosa";
                    }
                    $.ajax({
                        url: 'editarEspecialidad',
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
                                var table = $('.dataTables-especialidad').DataTable();
                                table.ajax.reload(function(json) {
                                    $('#editarEstado').val(json.lastInput);
                                });
                            }, 500);
                        } else {
                            toastr.error("", "Error");
                        }
                    });
                });

                $('.dataTables-especialidad').DataTable({
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
                        url: "<?php echo site_url() ?>getEspecialidades",
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