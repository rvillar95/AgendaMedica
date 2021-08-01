<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vitades | Agenda</title>
    <link rel="icon" href="<?php echo base_url() ?>lib/img/favicon.jpg" type="image/jpg" />
    <link href="<?php echo base_url() ?>lib/css/toastr.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url() ?>lib/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>lib/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>lib/css/style.css" rel="stylesheet">
</head>
<body class="gray-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <h1 style="text-align: center;">VITADES</h1>
                <div>
                    <h3>Inicio Sesión</h3>
                    <div class="form-group">
                        <input type="text" class="form-control" id="usuario" placeholder="Usuario" required="">
                    </div>
                    <div class="form-group">
                        <input type="password" id="clave" class="form-control" placeholder="Password" required="">
                    </div>
                    <button type="submit" id="btnIngresar" class="btn btn-primary block full-width m-b">Ingresar</button>
                </div>
            </div>
            <div class="col-md-4"></div>

        </div>
    </div>
    <!-- Mainly scripts -->
    <script src="<?php echo base_url() ?>lib/js/jquery-2.1.1.js"></script>
    <script src="<?php echo base_url() ?>lib/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>lib/js/toastr.min.js" type="text/javascript"></script>
    <script>
        $("#btnIngresar").click(function(e) {
            e.preventDefault();
            var usuario = $("#usuario").val();
            var clave = $("#clave").val();
            console.log("El usuario es " + usuario);
            console.log("La clave es " + clave);
            $.ajax({
                url: 'IniciarSesion',
                type: 'POST',
                dataType: 'json',
                data: {
                    "usuario": usuario,
                    "clave": clave
                }
            }).then(function(msg) {
                if (msg.msg == "error") {
                    toastr.error("", "Rut o clave incorrectos")
                } else if (msg.msg == "administrador") {
                    toastr.success("", "Acceso correcto. Redireccionando...");
                    setTimeout(() => {
                        window.location = "Menu";
                    }, 3000);
                }else if(msg.msg == "inactivo"){
                    toastr.warning("", "Usuario bloqueado, comunicarse con el administrador.")
                }
                //console.log(msg);
            });
        });
    </script>
</body>

</html>