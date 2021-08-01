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
                    <h2>Modulo Medicos</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo base_url() ?>Menu">Inicio</a>
                        </li>
                        <li class="active">
                            <strong>Modulo Medicos</strong>
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
                        <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12"><label>Rut</label><input id="username" required type="text" name="j_username" class="form-control" oninput="checkRut(this)" onblur="formateaRut(this)"></div>
                        <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12"><label>Nombre Medico</label> <input type="text" required name="descripcion" id="nombre" placeholder="Nombre paciente" class="form-control"></div>
                        <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12"><label>Dirección Medico</label> <input type="text" name="fecha" id="direccion" required placeholder="Dirección paciente" class="form-control"></div>
                        <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12"><label>Telefono Medico</label> <input type="text" name="fecha" id="telefono" required placeholder="Telefono paciente" class="form-control"></div>
                        <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12"><label>Correo Medico</label> <input type="email" name="fecha" id="correo" required placeholder="Correo paciente" class="form-control"></div>
                        <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12"><label>Region</label> <select name="" id="region" class="form-control"></select> </div>
                        <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12"><label>Provincia</label> <select name="" id="provincia" class="form-control">
                                <option>Seleccione la Provincia</option>
                            </select> </div>
                        <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12"><label>Comuna</label> <select name="" id="comuna" class="form-control">
                                <option>Seleccione la Comuna</option>
                            </select></div>
                        <div class="form-group form-group col-lg-3 col-md-3 col-sm-4 col-xs-12"><button type="submit" id="btnAgregarPaciente" class="btn btn-primary" style="background-color: black; color: white; ">Agregar Medicos</button></div>
                    </div>
                </div>
                <div class="row">

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
                                    <th>Region</th>
                                    <th>Comuna</th>
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
                <strong>Copyright</strong> <a href="https://solucionesvillar.cl" style="color: graytext">Soluciones Villar</a> &copy; 2017-<?php echo date('Y')?>
                </div>
            </div>

        </div>
    </div>

    <div class="modal inmodal fade" id="modal-paciente" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Editar Medicos</h4>
                    <small class="font-bold">En este modulo podras editar todos los datos de cualquier Medico.</small>
                </div>
                <div class="modal-body" id="info-paciente">


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
                getRegiones();

                var idSeleccionado = 0;
                $("#btn").click(function(e) {
                    e.preventDefault();
                    
                    $.ajax({
                        url: 'eliminarSesion',
                        type: 'POST',
                        dataType: 'json'
                    }).then(function(msg) {
                        
                    });
                    window.location="https://www.vitades.cl/Agenda/Login";
                });
                $("body").on("click", "#btnEditarPaciente", function(e) {
                    e.preventDefault();
                    var valor = this.value;
                    var variables = valor.split(",");
                    var id = variables[0];
                    var rut = variables[1];
                    var nombre = variables[2];
                    var direccion = variables[3];
                    var telefono = variables[4];
                    var correo = variables[5];
                    var region = variables[6];
                    var comuna = variables[7];
                    var id_region = variables[8];
                    var id_comuna = variables[9];
                    idSeleccionado = id;
                    $("#info-paciente").empty();
                    var div = "";
                    div += '<div class="row">';
                    div += '<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12"><label>Rut</label><input readonly id="rut" value="' + rut + '" class="form-control"></div>';
                    div += '  <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12"><label>Nombre Medico</label> <input type="text" value="' + nombre + '" id="nombre2" class="form-control"></div>';
                    div += '  <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12"><label>Dirección Medico</label> <input  type="text" value="' + direccion + '" id="direccion2" class="form-control"></div>';
                    div += '  <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12"><label>Telefono Medico</label> <input  type="text" value="' + telefono + '" id="telefono2" class="form-control"></div>';
                    div += ' <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12"><label>Correo Medico</label> <input  type="email" value="' + correo + '" id="correo2" class="form-control"></div>';
                    div += ' <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12"><label>Region</label> <select name="" id="region2" value="' + id_region + '" class="form-control"></select> </div>';
                    div += ' <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12"><label>Provincia</label> <select name="" id="provincia2" class="form-control selectRegion">';
                    div += '        <option>Seleccione la Provincia</option>';
                    div += '   </select> </div>';
                    div += ' <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12"><label>Comuna</label> <select name="" id="comuna2" class="form-control">';
                    div += '          <option>Seleccione la Comuna</option>';
                    div += '       </select></div>';
                    div += '<div class="form-group form-group col-lg-3 col-md-3 col-sm-4 col-xs-12"><button type="submit" id="btnEditarDatosPaciente" class="btn btn-primary" style="background-color: black; color: white; ">Editar Paciente</button></div>'
                    div += '</div>';
                    $("#info-paciente").append(div);
                    getRegiones2();

                    $("#region2").change(function(e) {
                        e.preventDefault();
                        var region = this.value;
                        getProvincias2(region)
                        console.log(this.value);
                    });

                    $("#provincia2").change(function(e) {
                        e.preventDefault();
                        var provincia = this.value;
                        //console.log(this.value);
                        getComunas2(provincia);

                    });
                });

                $("body").on("click", "#btnEditarDatosPaciente", function(e) {
                    e.preventDefault();

                    var nombre = $("#nombre2").val();
                    var direccion = $("#direccion2").val();
                    var telefono = $("#telefono2").val();
                    var correo = $("#correo2").val();
                    var region = $("#region2").val();
                    var comuna = $("#comuna2").val();
                    console.log();
                    if (nombre != "") {
                        if (direccion != "") {
                            if (telefono != "") {
                                if (correo != "") {
                                    $.ajax({
                                        url: 'editarDatosMedico',
                                        type: 'POST',
                                        dataType: 'json',
                                        data: {
                                            "id": idSeleccionado,
                                            "nombre": nombre,
                                            "direccion": direccion,
                                            "telefono": telefono,
                                            "correo": correo,
                                            "region": region,
                                            "comuna": comuna
                                        }
                                    }).then(function(msg) {
                                        console.log(msg);
                                        if (msg.msg == "ok") {
                                            toastr.success("", "Medico agregado de forma exitosa");
                                            setTimeout(() => {
                                                var table = $('.dataTables-pacientes').DataTable();
                                                table.ajax.reload(function(json) {
                                                    $('#btnEditarDatosPaciente').val(json.lastInput);
                                                });
                                            }, 500);
                                        } else {
                                            toastr.error("", "Error");
                                        }
                                    });
                                } else {
                                    toastr.error("", "Ingrese el correo.")
                                }
                            } else {
                                toastr.error("", "Ingrese el telefono.")
                            }
                        } else {
                            toastr.error("", "Ingrese la dirección.")
                        }
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
                        mensaje = "Medico desactivado de forma exitosa";
                    } else {
                        mensaje = "Medico activado de forma exitosa";
                    }
                    $.ajax({
                        url: 'editarMedico',
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
                                var table = $('.dataTables-pacientes').DataTable();
                                table.ajax.reload(function(json) {
                                    $('#editarEstado').val(json.lastInput);
                                });
                            }, 500);
                        } else {
                            toastr.error("", "Error");
                        }
                    });
                });

                $('.dataTables-pacientes').DataTable({
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
                        url: "<?php echo site_url() ?>getMedicos",
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

                $("#btnAgregarPaciente").click(function(e) {
                    e.preventDefault();
                    var rut = $("#username").val();
                    var nombre = $("#nombre").val();
                    var direccion = $("#direccion").val();
                    var telefono = $("#telefono").val();
                    var correo = $("#correo").val();
                    var region = $("#region").val();
                    var comuna = $("#comuna").val();
                    if (rut != "") {
                        if (nombre != "") {
                            if (direccion != "") {
                                if (telefono != "") {
                                    if (correo != "") {
                                        if (correo.includes("@")) {
                                            if (region != null) {
                                                if (comuna != null) {
                                                    $.ajax({
                                                        url: 'addMedico',
                                                        type: 'POST',
                                                        dataType: 'json',
                                                        data: {
                                                            "rut": rut,
                                                            "nombre": nombre,
                                                            "direccion": direccion,
                                                            "telefono": telefono,
                                                            "correo": correo,
                                                            "region": region,
                                                            "comuna": comuna
                                                        }
                                                    }).then(function(msg) {
                                                        console.log(msg);
                                                        if (msg.msg == "duplicado") {
                                                            toastr.error("", "Rut ya se encuentra registrado");
                                                        } else if (msg.msg == "ok") {
                                                            toastr.success("", "Medico editado de forma exitosa");
                                                            setTimeout(() => {
                                                                var table = $('.dataTables-pacientes').DataTable();
                                                                table.ajax.reload(function(json) {
                                                                    $('#btnAgregarPaciente').val(json.lastInput);
                                                                });
                                                            }, 500);
                                                        } else {
                                                            toastr.error("", "Error");
                                                        }
                                                    });
                                                } else {
                                                    toastr.error("", "Seleccione la comuna")
                                                }
                                            } else {
                                                toastr.error("", "Seleccione la región.")
                                            }
                                        } else {
                                            toastr.error("", "El correo debe llevar @.")
                                        }
                                    } else {
                                        toastr.error("", "Ingrese el correo.")
                                    }
                                } else {
                                    toastr.error("", "Ingrese el telefono.")
                                }
                            } else {
                                toastr.error("", "Ingrese la dirección.")
                            }
                        } else {
                            toastr.error("", "Ingrese el nombre.")
                        }
                    } else {
                        toastr.error("", "Ingrese el rut.")
                    }
                });
                $("#region").change(function(e) {
                    e.preventDefault();
                    var region = this.value;
                    getProvincias(region)
                    //console.log(this.value);
                });

                $("#provincia").change(function(e) {
                    e.preventDefault();
                    var provincia = this.value;
                    console.log(this.value);
                    getComunas(provincia);

                });

                function getProvincias(region) {
                    $.ajax({
                        url: 'getProvincias',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            "region": region
                        }
                    }).then(function(msg) {
                        $("#provincia").empty();
                        var resultado = "<option disabled selected>Seleccione la Provincia</option>";
                        $.each(msg, function(i, o) {
                            resultado += "<option value='" + o.provincia_id + "'>" + o.provincia_nombre + "</option>";
                        });
                        $("#provincia").append(resultado);
                        //console.log(msg);
                    });
                }

                function getComunas(provincias) {
                    $.ajax({
                        url: 'getComunas',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            "provincia": provincias
                        }
                    }).then(function(msg) {
                        $("#comuna").empty();
                        var resultado = "<option disabled selected>Seleccione la Comuna</option>";
                        $.each(msg, function(i, o) {
                            resultado += "<option value='" + o.comuna_id + "'>" + o.comuna_nombre + "</option>";
                        });

                        $("#comuna").append(resultado);
                        console.log(msg);
                    });
                }

                function getRegiones() {
                    $.ajax({
                        url: 'getRegiones',
                        type: 'POST',
                        dataType: 'json'
                    }).then(function(msg) {


                        $("#region").empty();
                        var resultado = "<option disabled selected>Seleccione la Región</option>";
                        $.each(msg, function(i, o) {
                            resultado += "<option value='" + o.region_id + "'>" + o.region_nombre + " " + o.region_ordinal + "</option>";
                        });

                        $("#region").append(resultado);
                        //console.log(msg);
                    });
                }

                function getRegiones2() {
                    $.ajax({
                        url: 'getRegiones',
                        type: 'POST',
                        dataType: 'json'
                    }).then(function(msg) {
                        $("#region2").empty();
                        var resultado = "<option disabled selected>Seleccione la Región</option>";
                        $.each(msg, function(i, o) {
                            resultado += "<option value='" + o.region_id + "'>" + o.region_nombre + " " + o.region_ordinal + "</option>";
                        });

                        $("#region2").append(resultado);
                        //console.log(msg);
                    });
                }

                function getProvincias2(region) {
                    $.ajax({
                        url: 'getProvincias',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            "region": region
                        }
                    }).then(function(msg) {
                        $("#provincia2").empty();
                        var resultado = "<option disabled selected>Seleccione la Provincia</option>";
                        $.each(msg, function(i, o) {
                            resultado += "<option value='" + o.provincia_id + "'>" + o.provincia_nombre + "</option>";
                        });
                        $("#provincia2").append(resultado);
                        //console.log(msg);
                    });
                }

                function getComunas2(provincias) {
                    $.ajax({
                        url: 'getComunas',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            "provincia": provincias
                        }
                    }).then(function(msg) {
                        $("#comuna2").empty();
                        var resultado = "";
                        $.each(msg, function(i, o) {
                            resultado += "<option value='" + o.comuna_id + "'>" + o.comuna_nombre + "</option>";
                        });

                        $("#comuna2").append(resultado);
                        //console.log(msg);
                    });
                }



            });
        });
    </script>
</body>

</html>