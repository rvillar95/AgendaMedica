<!DOCTYPE html>
<?php $user = $this->session->userdata("administrador"); ?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vitades | Agenda</title>
    <link rel="shortcut icon" href="<?php echo base_url() ?>lib/img/icono.png">
    <link href="<?php echo base_url() ?>lib/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>lib/fonts/font-awesome.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>lib/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>lib/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>lib/css/toastr.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url() ?>lib/css/jquery-ui.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url() ?>lib/css/mystyle.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div id="wrapper">
        <div id="page-wrapper" class="gray-bg" style="padding: 0px; margin: 0px;  ">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0; background-color: cyan;">
                    <center>
                        <ul class="nav navbar-top-links navbar-left">
                            <img src="<?php echo base_url() ?>lib/img/Logo.png" class="img-responsive" style="width: 240px; height: 65px; padding-left: 20px ; padding-top: 10px;" alt="" />
                        </ul>
                    </center>
                    <ul class="nav navbar-top-links navbar-right" style="padding-left: 10px;">
                        <li style="left: 10px">
                            <span class="" style="color: white;"><?php echo $user[0]->NombreUsuario  ?></span>
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
                    <h2>Modulo Administrador</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo base_url() ?>Menu">Inicio</a>
                        </li>
                        <li class="active">
                            <strong>Administrador</strong>
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
                    <div class="col-lg-4">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title" style="background-color: black">
                                <h5 style="color: white">Gestionar Pacientes</h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content" style="padding: 0px;">
                                <a href=" <?php echo base_url(); ?>ModuloPacientes">
                                    <center>
                                        <div class="div-img sty contenedor">
                                            <img src="<?php echo base_url() ?>lib/img/medicos.jpg" class="img-responsive img" alt="" />
                                        </div>
                                    </center>
                                </a>
                            </div>
                            <div class="ibox-footer" style="padding: 0px; margin: 0px;">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title" style="background-color: black">
                                <h5 style="color: white">Gestionar Medicos</h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content" style="padding: 0px;">
                                <a href="<?php echo base_url(); ?>ModuloMedico">
                                    <center>
                                        <div class="div-img sty">
                                            <img src="<?php echo base_url() ?>lib/img/medicos.jpg" class="img-responsive img" alt="" />
                                        </div>
                                    </center>
                                </a>
                            </div>
                            <div class="ibox-footer" style="padding: 0px; margin: 0px;">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title" style="background-color: black">
                                <h5 style="color: white">Gestionar Especialidades</h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content" style="padding: 0px;">
                                <a href="<?php echo base_url(); ?>ModuloEspecialidad">
                                    <center>
                                        <div class="div-img sty">
                                            <img src="<?php echo base_url() ?>lib/img/medicos.jpg" class="img-responsive img" alt="" />
                                        </div>
                                    </center>
                                </a>
                            </div>
                            <div class="ibox-footer" style="padding: 0px; margin: 0px;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title" style="background-color: black">
                                <h5 style="color: white">Gestionar Asignacion Medicos</h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content" style="padding: 0px;">
                                <a href=" <?php echo base_url(); ?>ModuloAsignacion">
                                    <center>
                                        <div class="div-img sty">
                                            <img src="<?php echo base_url() ?>lib/img/medicos.jpg" class="img-responsive img" alt="" />
                                        </div>
                                    </center>
                                </a>
                            </div>
                            <div class="ibox-footer" style="padding: 0px; margin: 0px;">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title" style="background-color: black">
                                <h5 style="color: white">Agenda Medica</h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content" style="padding: 0px;">
                                <a href=" <?php echo base_url(); ?>ModuloAgenda">
                                    <center>
                                        <div class="div-img sty">
                                            <img src="<?php echo base_url() ?>lib/img/medicos.jpg" class="img-responsive img" alt="" />
                                        </div>
                                    </center>
                                </a>
                            </div>
                            <div class="ibox-footer" style="padding: 0px; margin: 0px;">
                            </div>
                        </div>
                    </div>
                    <!--
                    <div class="col-lg-4">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title" style="background-color: black">
                                <h5 style="color: white">Ver Solicitudes</h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content" style="padding: 0px;">
                                <a href=" <?php echo base_url(); ?>ModuloSolicitudes">
                                    <center>
                                        <div class="div-img sty">
                                            <img src="<?php echo base_url() ?>lib/img/medicos.jpg" class="img-responsive img" alt="" />
                                        </div>
                                    </center>
                                </a>
                            </div>
                            <div class="ibox-footer" style="padding: 0px; margin: 0px;">
                            </div>
                        </div>
                    </div>-->
                </div>
            </div>
            <div class="footer">
                <div class="pull-right">
                </div>
                <div>
                    <strong>Copyright</strong> <a href="https://solucionesvillar.cl" style="color: graytext">Soluciones Villar</a> &copy; 2018-2019
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url() ?>lib/js/jquery-2.1.1.js"></script>
    <script src="<?php echo base_url() ?>lib/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>lib/js/inspinia.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>lib/js/myjs.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>lib/js/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>lib/js/pace.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>lib/js/jquery.metisMenu.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>lib/js/toastr.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>lib/js/jquery-ui.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>lib/js/jquery.peity.min.js" type="text/javascript"></script>
    <script>
        $(function() {
            $(document).ready(function() {
                // Add slimscroll to element
                $('.scroll_content').slimscroll({
                    height: '200px'
                })
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
            });
        });
    </script>
</body>

</html>