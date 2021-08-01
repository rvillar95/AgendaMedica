var base_url = "https://www.pymesoft.cl/pos/";



function agregarComuna() {

    var nombreComuna = $("#nombreComuna").val();

    var idProvincia = $("#getProvincias").val();



    if (nombreComuna == "" || idProvincia == null) {

        toastr.error("Verifique todos los campos", "Ingrese todos los datos!!!")

    } else {

        $.ajax({

            url: 'addComuna',

            type: 'POST',

            dataType: 'json',

            data: { "nombreComuna": nombreComuna, "idProvincia": idProvincia }

        }).then(function (msg) {

            if (msg.msg == "1") {

                toastr.success("Comuna Agregada", "Exito en la Acción!!!")

                toastr.options = { "closeButton": true, "debug": false, "progressBar": true, "preventDuplicates": false, "positionClass": "toast-top-right", "onclick": null, "showDuration": "400", "hideDuration": "1000", "timeOut": "4000", "extendedTimeOut": "1000", "showEasing": "swing", "hideEasing": "swing", "showMethod": "show", "hideMethod": "fadeOut" }

            } else if (msg.msg != "1") {

                toastr.error("Error", "Error al agregar la Comuna")

                toastr.options = { "closeButton": true, "debug": false, "progressBar": true, "preventDuplicates": false, "positionClass": "toast-top-right", "onclick": null, "showDuration": "400", "hideDuration": "1000", "timeOut": "4000", "extendedTimeOut": "1000", "showEasing": "swing", "hideEasing": "swing", "showMethod": "show", "hideMethod": "fadeOut" }

            }

        });

    }

}



function agregarProvincia() {

    var nombreProvincia = $("#nombreProvincia").val();

    var idRegion = $("#getRegiones").val();

    if (nombreProvincia == "" || idRegion == null) {

        toastr.error("Verifique todos los campos", "Ingrese todos los datos!!!")

    } else {



        $.ajax({

            url: 'addProvincia',

            type: 'POST',

            dataType: 'json',

            data: { "nombreProvincia": nombreProvincia, "idRegion": idRegion }

        }).then(function (msg) {

            if (msg.msg == "1") {

                toastr.success("Provincia Agregada", "Exito en la Acción!!!")

                toastr.options = { "closeButton": true, "debug": false, "progressBar": true, "preventDuplicates": false, "positionClass": "toast-top-right", "onclick": null, "showDuration": "400", "hideDuration": "1000", "timeOut": "4000", "extendedTimeOut": "1000", "showEasing": "swing", "hideEasing": "swing", "showMethod": "show", "hideMethod": "fadeOut" }

            } else if (msg.msg != "1") {

                toastr.error("Error", "Error al agregar la Provincia")

                toastr.options = { "closeButton": true, "debug": false, "progressBar": true, "preventDuplicates": false, "positionClass": "toast-top-right", "onclick": null, "showDuration": "400", "hideDuration": "1000", "timeOut": "4000", "extendedTimeOut": "1000", "showEasing": "swing", "hideEasing": "swing", "showMethod": "show", "hideMethod": "fadeOut" }

            }

        });

    }

}



function getProvincias(texto) {

    var text = texto;

    var hola = base_url + 'verProvincias';

    $("#getProvincias").empty();

    var fila = "<option disabled selected>" + text + "</option>";

    $.getJSON(hola, function (result) {

        $.each(result, function (i, o) {

            fila += "<option value='" + o.provincia_id + "'>" + o.provincia_nombre + "</option>";

        });

        $("#getProvincias").append(fila);

    });



}



function getRegiones(texto) {

    var text = texto;

    var hola = base_url + 'verRegiones';

    $("#getRegiones").empty();

    var fila = "<option disabled selected>" + text + "</option>";

    $.getJSON(hola, function (result) {

        $.each(result, function (i, o) {

            fila += "<option value='" + o.region_id + "'>" + o.nombre + "</option>";

        });

        $("#getRegiones").append(fila);

    });

}



function getRegionesEmpresa() {

    var hola = base_url + 'verRegiones';

    $("#getRegiones").empty();

    var fila = "<option disabled selected>Seleccione la Región</option>";

    $.getJSON(hola, function (result) {

        $.each(result, function (i, o) {

            fila += "<option value='" + o.region_id + "'>" + o.nombre + "</option>";

        });

        $("#getRegiones").append(fila);

    });

}



function getProvinciasEmpresa() {

    var region = $("#getRegiones").val();

    $.ajax({

        url: 'getProvinciasEmpresa',

        type: 'POST',

        dataType: 'json',

        data: { "region": region },

        success: function (url) {

            var fila = "<option disabled selected>Seleccione la Provincia</option>";

            $("#getProvincias").empty();

            $.each(url, function (i, o) {

                fila += "<option value='" + o.provincia_id + "'>" + o.provincia_nombre + "</option>";

            });

            $("#getProvincias").append(fila);

        }, error: function () {



        }

    });

}



function getComunasEmpresa() {

    var provincia = $("#getProvincias").val();

    $.ajax({

        url: 'getComunasEmpresa',

        type: 'POST',

        dataType: 'json',

        data: { "provincia": provincia },

        success: function (url) {

            var fila = "<option disabled selected>Seleccione la Comuna</option>";

            $("#getComunas").empty();

            $.each(url, function (i, o) {

                fila += "<option value='" + o.comuna_id + "'>" + o.comuna_nombre + "</option>";

            });

            $("#getComunas").append(fila);

        }, error: function () {



        }

    });

}



function getRegionesSucursal() {

    var hola = base_url + 'verRegiones';

    $("#getRegiones2").empty();

    var fila = "<option disabled selected>Seleccione la Región</option>";

    $.getJSON(hola, function (result) {

        $.each(result, function (i, o) {

            fila += "<option value='" + o.region_id + "'>" + o.nombre + "</option>";

        });

        $("#getRegiones2").append(fila);

    });

}



function getProvinciasSucursal() {

    var region = $("#getRegiones2").val();

    $.ajax({

        url: 'getProvinciasEmpresa',

        type: 'POST',

        dataType: 'json',

        data: { "region": region },

        success: function (url) {

            var fila = "<option disabled selected>Seleccione la Provincia</option>";

            $("#getProvincias2").empty();

            $.each(url, function (i, o) {

                fila += "<option value='" + o.provincia_id + "'>" + o.provincia_nombre + "</option>";

            });

            $("#getProvincias2").append(fila);

        }, error: function () {



        }

    });

}



function getComunasSucursal() {

    var provincia = $("#getProvincias2").val();

    $.ajax({

        url: 'getComunasEmpresa',

        type: 'POST',

        dataType: 'json',

        data: { "provincia": provincia },

        success: function (url) {

            var fila = "<option disabled selected>Seleccione la Comuna</option>";

            $("#getComunas2").empty();

            $.each(url, function (i, o) {

                fila += "<option value='" + o.comuna_id + "'>" + o.comuna_nombre + "</option>";

            });

            $("#getComunas2").append(fila);

        }, error: function () {



        }

    });

}



function getEmpresas() {

    var hola = base_url + 'verEmpresas';

    $("#getEmpresas").empty();

    var fila = "<option disabled selected>Seleccione la Empresa</option>";

    $.getJSON(hola, function (result) {

        $.each(result, function (i, o) {

            fila += "<option value='" + o.idEmpresa + "'>" + o.nombreEmpresa + "</option>";

        });

        $("#getEmpresas").append(fila);

    });

}



function getInfoSucursal(id) {

    var id = id;

    $.ajax({

        url: 'getInfoSucursal',

        type: 'POST',

        dataType: 'json',

        data: { "id": id }

    }).then(function (msg) {

        $("#info-sucursal").empty();

        var fila = "";



        $.each(msg, function (i, o) {

            fila += '<div class="row">    <input type="text" id="s_idSucur" hidden value="' + o.idSucursal + '">        <div class="col-lg-12">                <div class="ibox float-e-margins">                    <div class="ibox-title" style="background-color: black;">                        <h5 style="color: white">Información Sucursal</h5>                    </div>                    <div id="form-sucursal" class="ibox-content" style="padding: 0px;">                        <div class="row" style="padding: 20px;">                            <div class="col-md-12"> <br />                                <form id="form_Sucursal" name="login" method="post" enctype="multipart/form-data">                                    <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-6"> <label>Nombre Sucursal</label>                                        <input class="form-control" id="s_nombre" required type="text" disabled value="' + o.nmSucursal + '">                                    </div>                                    <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-6"> <label>Dirección Sucursal</label>                                        <input class="form-control" id="s_direccion" required  type="text" disabled value="' + o.direccionSucursal + '">                                    </div>                                    <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-6"> <label>Número 1</label>                                        <input class="form-control" id="s_tel1" required  type="text" disabled value="' + o.numeroTelefono1 + '">                                    </div>                                    <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-6"> <label>Número 2</label>                                        <input class="form-control" id="s_tel2" required  type="text" disabled value="' + o.numeroTelefono2 + '">                                    </div>                                    <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-6"> <label>Número 3</label>                                        <input class="form-control" id="s_tel3" required  type="text" disabled value="' + o.numeroTelefono3 + '">                                    </div>                                    <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-6"> <label for="getRegiones">Región: ' + o.region_nombre + '</label>                                        <input class="form-control" id="s_region" required  type="text" disabled value="' + o.region_nombre + '">                                        <select class="form-control" style="display: none;" required name="region3" id="getRegiones3">                                        </select>                                    </div>                                    <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-6"> <label for="getProvincias">Provincia: ' + o.provincia_nombre + '</label>                                        <input class="form-control" id="s_provincia" required  type="text" disabled value="' + o.provincia_nombre + '">                                        <select class="form-control" style="display: none;" required name="provincia3" id="getProvincias3">                                            <option disabled selected>Seleccione la Provincia</option>                                        </select>                                    </div>                                    <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-6"> <label for="getComunas">Comuna: ' + o.comuna_nombre + '</label>                                        <input class="form-control" id="s_comuna" required  type="text" disabled value="' + o.comuna_nombre + '">                                        <select class="form-control" style="display: none;" required name="comuna3" id="getComunas3">                                            <option disabled selected>Seleccione la Comuna</option>                                        </select>                                    </div>                                    <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-6"> <label for="getComunas">Empresa Asociada</label>                                        <input class="form-control" id="s_empresa" required  type="text" disabled value="' + o.nombreEmpresa + '">                                    </div>                                    <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-6"> <label>Correo Sucursal</label>                                        <input class="form-control" id="s_correo" required  type="text" disabled value="' + o.correoSucursal + '">                                    </div>                                    <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-6"> <label>Comentario Sucursal</label>                                        <input class="form-control" id="s_comentario" required  type="text" disabled value="' + o.comentarioSucursal + '">                                    </div>                                    <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-6">                                                                                <button class="btn btn-default  dim " id="editarSucursal" type="button">Editar Sucursal</button>                                        <button class="btn btn-outline btn-primary dim" id="editOk" style="display: none;" type="button"><i class="fa fa-check"></i></button>                                    </div>                                </form>                            </div>                        </div>                    </div>                </div>            </div>        </div>';

            $("#info-sucursal").append(fila);



        });

        getRegionesSucursalEdit();

    }

    );





}





function getRegionesSucursalEdit() {

    var hola = base_url + 'verRegiones';

    $("#getRegiones3").empty();

    var fila = "<option disabled selected>Seleccione la Región</option>";

    $.getJSON(hola, function (result) {

        $.each(result, function (i, o) {

            fila += "<option value='" + o.region_id + "'>" + o.nombre + "</option>";

        });

        $("#getRegiones3").append(fila);

    });

}



function getProvinciasSucursalEdit() {

    var region = $("#getRegiones3").val();

    $.ajax({

        url: 'getProvinciasEmpresa',

        type: 'POST',

        dataType: 'json',

        data: { "region": region },

        success: function (url) {

            var fila = "<option disabled selected>Seleccione la Provincia</option>";

            $("#getProvincias3").empty();

            $.each(url, function (i, o) {

                fila += "<option value='" + o.provincia_id + "'>" + o.provincia_nombre + "</option>";

            });

            $("#getProvincias3").append(fila);

        }, error: function () {



        }

    });

}



function getComunasSucursalEdit() {

    var provincia = $("#getProvincias3").val();

    $.ajax({

        url: 'getComunasEmpresa',

        type: 'POST',

        dataType: 'json',

        data: { "provincia": provincia },

        success: function (url) {

            var fila = "<option disabled selected>Seleccione la Comuna</option>";

            $("#getComunas3").empty();

            $.each(url, function (i, o) {

                fila += "<option value='" + o.comuna_id + "'>" + o.comuna_nombre + "</option>";

            });

            $("#getComunas3").append(fila);

        }, error: function () {



        }

    });

}



function editarSucursal() {

    var id = $("#s_idSucur").val();

    var nombre = $("#s_nombre").val();

    var direccion = $("#s_direccion").val();

    var tel1 = $("#s_tel1").val();

    var tel2 = $("#s_tel2").val();

    var tel3 = $("#s_tel3").val();

    var correo = $("#s_correo").val();

    var comentario = $("#s_comentario").val();

    var region = $("#getRegiones3").val();

    var comuna = $("#getComunas3").val();

    var provincia = $("#getProvincias3").val();

    var editRegion = 0;



    if (nombre == "" || direccion == "" || tel1 == "" || tel2 == "" || tel3 == "" || correo == "" || comentario == "") {

        toastr.error("Verifique todos los campos", "Ingrese todos los datos!!!")

    } else {

        if (region == null || provincia == null || comuna == null) { // si no se completan los datos de region, provincia y comuna se envia un 0

            $.ajax({

                url: 'editarSucursal',

                type: 'POST',

                dataType: 'json',

                data: { "id": id, "nombre": nombre, "direccion": direccion, "tel1": tel1, "tel2": tel2, "tel3": tel3, "correo": correo, "comentario": comentario, "region": region, "provincia": provincia, "comuna": comuna, "editRegion": editRegion }

            }).then(function (msg) {

                if (msg.msg == "ok") {

                    toastr.success("Sucursal Editada", "Exito en la Acción!!!")

                    toastr.options = { "closeButton": true, "debug": false, "progressBar": true, "preventDuplicates": false, "positionClass": "toast-top-right", "onclick": null, "showDuration": "400", "hideDuration": "1000", "timeOut": "4000", "extendedTimeOut": "1000", "showEasing": "swing", "hideEasing": "swing", "showMethod": "show", "hideMethod": "fadeOut" }

                } else if (msg.msg != "1") {

                    toastr.error("Error", "Error al agregar la Comuna")

                    toastr.options = { "closeButton": true, "debug": false, "progressBar": true, "preventDuplicates": false, "positionClass": "toast-top-right", "onclick": null, "showDuration": "400", "hideDuration": "1000", "timeOut": "4000", "extendedTimeOut": "1000", "showEasing": "swing", "hideEasing": "swing", "showMethod": "show", "hideMethod": "fadeOut" }

                }

            });

        } else { //si se completan, se envia un 1

            editRegion = 1;

            $.ajax({

                url: 'editarSucursal',

                type: 'POST',

                dataType: 'json',

                data: { "id": id, "nombre": nombre, "direccion": direccion, "tel1": tel1, "tel2": tel2, "tel3": tel3, "correo": correo, "comentario": comentario, "region": region, "provincia": provincia, "comuna": comuna, "editRegion": editRegion }

            }).then(function (msg) {

                if (msg.msg == "ok") {

                    toastr.success("Sucursal Editada", "Exito en la Acción!!!")

                    toastr.options = { "closeButton": true, "debug": false, "progressBar": true, "preventDuplicates": false, "positionClass": "toast-top-right", "onclick": null, "showDuration": "400", "hideDuration": "1000", "timeOut": "4000", "extendedTimeOut": "1000", "showEasing": "swing", "hideEasing": "swing", "showMethod": "show", "hideMethod": "fadeOut" }

                } else if (msg.msg != "1") {

                    toastr.error("Error", "Error al agregar la Comuna")

                    toastr.options = { "closeButton": true, "debug": false, "progressBar": true, "preventDuplicates": false, "positionClass": "toast-top-right", "onclick": null, "showDuration": "400", "hideDuration": "1000", "timeOut": "4000", "extendedTimeOut": "1000", "showEasing": "swing", "hideEasing": "swing", "showMethod": "show", "hideMethod": "fadeOut" }

                }

            });

        }//



    }

}



function eliminarSucursal(id) {

    var id = id;



    $.ajax({

        url: 'eliminarSucursal',

        type: 'POST',

        dataType: 'json',

        data: { "id": id }

    }).then(function (msg) {



    });



}



function getInfoEmpresa(id) {

    var id = id;

    $.ajax({

        url: 'getInfoEmpresa',

        type: 'POST',

        dataType: 'json',

        data: { "id": id }

    }).then(function (msg) {

        $("#info-empresa").empty();

        var fila = "";



        $.each(msg, function (i, o) {

            fila += '<div class="row">              <div class="ibox float-e-margins">                    <div class="ibox-title" style="background-color: black;">                        <h5 style="color: white">Información Empresa</h5>                    </div>                    <div id="form-sucursal" class="ibox-content" style="padding: 0px;">                        <div class="row" style="padding: 20px;">                            <div class="col-md-12"> <br />                                <form id="form_editar_empresa" name="login" method="post" enctype="multipart/form-data">      <input type="text" name="e_logo" hidden value="' + o.urlLogo + '">       <input type="text" id="e_idEmpr" name="e_idEmpr" hidden value="' + o.idEmpresa + '">            <div class="col-lg-12">                         <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-6"> <label>Rut Empresa</label> <input class="form-control" id="e_rut" name="e_rut" required type="text" disabled value="' + o.rutEmpresa + '"> </div>                                    <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-6"> <label>Nombre Empresa</label> <input class="form-control" id="e_nombre" name="e_nombre" required type="text" disabled value="' + o.nmEmpresa + '"> </div>                                    <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-6"> <label>Nombre Fantasia Empresa</label> <input class="form-control" id="e_fantasia" name="e_fantasia"  required type="text" disabled value="' + o.nmFantasiaEmpresa + '"> </div>                                    <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-6"> <label>Giro Empresa</label> <input class="form-control" id="e_giro" name="e_giro" required type="text" disabled value="' + o.giroEmpresa + '"> </div>                                    <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-6"> <label>Dirección Empresa</label> <input class="form-control" id="e_direccion" name="e_direccion" required type="text" disabled value="' + o.direccionEmpresa + '"> </div>                                    <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-6"> <label>Número 1</label> <input class="form-control" id="e_tel1" name="e_tel1" required type="text" disabled value="' + o.numeroTelefono1 + '"> </div>                                    <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-6"> <label>Número 2</label> <input class="form-control" id="e_tel2" name="e_tel2"  type="text" disabled value="' + o.numeroTelefono2 + '"> </div>                                    <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-6"> <label>Número 3</label> <input class="form-control" id="e_tel3" name="e_tel3"  type="text" disabled value="' + o.numeroTelefono3 + '"> </div>                                    <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-6"> <label for="getRegiones">Región: ' + o.region_nombre + '</label> <input class="form-control" id="e_region" required type="text" disabled value="' + o.region_nombre + '"> <select class="form-control" style="display: none;" required name="region4" id="getRegiones4"> </select> </div>                                    <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-6"> <label for="getProvincias">Provincia: ' + o.provincia_nombre + '</label> <input class="form-control" id="e_provincia" required type="text" disabled value="' + o.provincia_nombre + '"> <select class="form-control" style="display: none;" required name="provincia4" id="getProvincias4">                                            <option disabled selected>Seleccione la Provincia</option>                                        </select> </div>                                    <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-6"> <label for="getComunas">Comuna: ' + o.comuna_nombre + '</label> <input class="form-control" id="e_comuna" required type="text" disabled value="' + o.comuna_nombre + '"> <select class="form-control" style="display: none;" required name="comuna4" id="getComunas4">                                            <option disabled selected>Seleccione la Comuna</option>                                        </select> </div>                                    <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-6"> <label for="getComunas">Sitio Web Empresa</label> <input class="form-control"  id="e_web" name="e_web"  type="text" disabled value="' + o.sitioWebEmpresa + '"> </div>                                    <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-6"> <label for="getComunas">Correo Empresa</label> <input class="form-control" id="e_correo" name="e_correo" required type="text" disabled value="' + o.correoEmpresa + '"> </div>                                    <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-6"> <label>Logo Empresa</label> <img class="img-responsive" id="e_logo"  disabled src="' + o.urlLogo + '"> <input style="display:none;" type="file" name="foto2" id="foto2"> </div>                                    <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-6"> <label>Comentario Empresa</label> <input class="form-control" id="e_comentario" name="e_comentario" type="text" disabled value="' + o.comentarioEmpresa + '"> </div>                                    <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-6"> <label>Resolución SII</label> <input class="form-control" id="e_resolucion" name="e_resolucion" type="text" disabled value="' + o.resolucionSII + '"> </div>                                    <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-6"> <label>Fecha Resolucion</label> <input class="form-control" id="e_fecha" name="e_fecha" type="date" disabled value="' + o.fechaResolucion + '"> </div>                                    <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-6"> <button class="btn btn-default  dim " id="editarEmpresa" type="button">Editar Empresa</button> <button class="btn btn-outline btn-primary dim" type="submit" id="editEmpresaOk" style="display: none;" type="button"><i class="fa fa-check"></i></button> </div>                                </form>                            </div>                        </div>                    </div>                </div>            </div>        </div>';

            $("#info-empresa").append(fila);



        });

        getRegionesEmpresaEdit();

    }

    );





}



function getRegionesEmpresaEdit() {

    var hola = base_url + 'verRegiones';

    $("#getRegiones4").empty();

    var fila = "<option disabled selected>Seleccione la Región</option>";

    $.getJSON(hola, function (result) {

        $.each(result, function (i, o) {

            fila += "<option value='" + o.region_id + "'>" + o.nombre + "</option>";

        });

        $("#getRegiones4").append(fila);

    });

}



function getProvinciasEmpresaEdit() {

    var region = $("#getRegiones4").val();

    $.ajax({

        url: 'getProvinciasEmpresa',

        type: 'POST',

        dataType: 'json',

        data: { "region": region },

        success: function (url) {

            var fila = "<option disabled selected>Seleccione la Provincia</option>";

            $("#getProvincias4").empty();

            $.each(url, function (i, o) {

                fila += "<option value='" + o.provincia_id + "'>" + o.provincia_nombre + "</option>";

            });

            $("#getProvincias4").append(fila);

        }, error: function () {



        }

    });

}



function getComunasEmpresaEdit() {

    var provincia = $("#getProvincias4").val();

    $.ajax({

        url: 'getComunasEmpresa',

        type: 'POST',

        dataType: 'json',

        data: { "provincia": provincia },

        success: function (url) {

            var fila = "<option disabled selected>Seleccione la Comuna</option>";

            $("#getComunas4").empty();

            $.each(url, function (i, o) {

                fila += "<option value='" + o.comuna_id + "'>" + o.comuna_nombre + "</option>";

            });

            $("#getComunas4").append(fila);

        }, error: function () {



        }

    });

}



function editarEmpresa() {

    var id = $("#e_idEmpr").val();

    var nombre = $("#e_nombre").val();

    var fantasia = $("#e_nombre").val();

    var giro = $("#e_giro").val();

    var direccion = $("#e_direccion").val();

    var region = $("#getRegiones4").val();

    var comuna = $("#getComunas4").val();

    var provincia = $("#getProvincias4").val();

    var tel1 = $("#e_tel1").val();

    var tel2 = $("#e_tel2").val();

    var tel3 = $("#e_tel3").val();

    var web = $("#e_web").val();

    var correo = $("#e_correo").val();

    var logo = $("#e_logo").val();

    var comentario = $("#e_comentario").val();

    var resolucion = $("#e_resolucion").val();

    var fechares = $("#e_fecha").val();

    var editCompleto = 0;



    if (rutEmpresa == "" || nombre == "" || fantasia == "" || giro == "" || direccion == "" || tel1 == "") {

        toastr.error("Verifique todos los campos", "Ingrese todos los datos!!!")

    } else {

        if (region == null || provincia == null || comuna == null || logo == null) { // si no se completan los datos de region, provincia y comuna se envia un 0

            $.ajax({

                url: 'editarSucursal',

                type: 'POST',

                dataType: 'json',

                data: { "id": id, "nombre": nombre, "direccion": direccion, "tel1": tel1, "tel2": tel2, "tel3": tel3, "correo": correo, "comentario": comentario, "region": region, "provincia": provincia, "comuna": comuna, "editRegion": editRegion }

            }).then(function (msg) {

                if (msg.msg == "ok") {

                    toastr.success("Sucursal Editada", "Exito en la Acción!!!")

                    toastr.options = { "closeButton": true, "debug": false, "progressBar": true, "preventDuplicates": false, "positionClass": "toast-top-right", "onclick": null, "showDuration": "400", "hideDuration": "1000", "timeOut": "4000", "extendedTimeOut": "1000", "showEasing": "swing", "hideEasing": "swing", "showMethod": "show", "hideMethod": "fadeOut" }

                } else if (msg.msg != "1") {

                    toastr.error("Error", "Error al agregar la Comuna")

                    toastr.options = { "closeButton": true, "debug": false, "progressBar": true, "preventDuplicates": false, "positionClass": "toast-top-right", "onclick": null, "showDuration": "400", "hideDuration": "1000", "timeOut": "4000", "extendedTimeOut": "1000", "showEasing": "swing", "hideEasing": "swing", "showMethod": "show", "hideMethod": "fadeOut" }

                }

            });

        } else { //si se completan, se envia un 1

            editRegion = 1;

            $.ajax({

                url: 'editarSucursal',

                type: 'POST',

                dataType: 'json',

                data: { "id": id, "nombre": nombre, "direccion": direccion, "tel1": tel1, "tel2": tel2, "tel3": tel3, "correo": correo, "comentario": comentario, "region": region, "provincia": provincia, "comuna": comuna, "editRegion": editRegion }

            }).then(function (msg) {

                if (msg.msg == "ok") {

                    toastr.success("Sucursal Editada", "Exito en la Acción!!!")

                    toastr.options = { "closeButton": true, "debug": false, "progressBar": true, "preventDuplicates": false, "positionClass": "toast-top-right", "onclick": null, "showDuration": "400", "hideDuration": "1000", "timeOut": "4000", "extendedTimeOut": "1000", "showEasing": "swing", "hideEasing": "swing", "showMethod": "show", "hideMethod": "fadeOut" }

                } else if (msg.msg != "1") {

                    toastr.error("Error", "Error al agregar la Comuna")

                    toastr.options = { "closeButton": true, "debug": false, "progressBar": true, "preventDuplicates": false, "positionClass": "toast-top-right", "onclick": null, "showDuration": "400", "hideDuration": "1000", "timeOut": "4000", "extendedTimeOut": "1000", "showEasing": "swing", "hideEasing": "swing", "showMethod": "show", "hideMethod": "fadeOut" }

                }

            });

        }//



    }

}


function eliminarEmpresa(id) {

    var id = id;

    var si = "si";

    var no = "no";

    $.ajax({

        url: 'eliminarEmpresa',

        type: 'POST',

        dataType: 'json',

        data: { "id": id }

    }).then(function (msg) {

        if (msg.msg == "ok") {

            alert("si");

        } else {

            alert("no");

        }

    });



}



function getImpuesto() {

    var hola = base_url + 'getImpuesto';

    $("#getImpuesto").empty();

    var fila = "<option disabled selected>Seleccione el Impuesto</option>";

    $.getJSON(hola, function (result) {

        $.each(result, function (i, o) {

            fila += "<option value='" + o.idImpuesto + "'>" + o.nmImpuesto + "</option>";

        });

        $("#getImpuesto").append(fila);

    });

}



function getColor() {

    var hola = base_url + 'getColor';

    $("#getColores").empty();

    var fila = "<option disabled selected>Seleccione el Color</option>";

    $.getJSON(hola, function (result) {

        $.each(result, function (i, o) {

            fila += "<option value='" + o.idColor + "'>" + o.nmColor + "</option>";

        });

        $("#getColores").append(fila);

    });

}



function getTalla() {

    var hola = base_url + 'getTalla';

    $("#getTallas").empty();

    var fila = "<option disabled selected>Seleccione la Talla</option>";

    $.getJSON(hola, function (result) {

        $.each(result, function (i, o) {

            fila += "<option value='" + o.idTalla + "'>" + o.nmTalla + "</option>";

        });

        $("#getTallas").append(fila);

    });

}



function getUnidad() {

    var hola = base_url + 'getUnidad';

    $("#getUnidades").empty();

    var fila = "<option disabled selected>Seleccione la Unidad</option>";

    $.getJSON(hola, function (result) {

        $.each(result, function (i, o) {

            fila += "<option value='" + o.idUnidad + "'>" + o.nmUnidad + "</option>";

        });

        $("#getUnidades").append(fila);

    });

}



function getGrupo() {

    var hola = base_url + 'getGrupo';

    $("#getGrupos").empty();

    var fila = "<option disabled selected>Seleccione el Grupo</option>";

    $.getJSON(hola, function (result) {

        $.each(result, function (i, o) {

            fila += "<option value='" + o.idGrupo + "'>" + o.nmGrupo + "</option>";

        });

        $("#getGrupos").append(fila);

    });

}



function getFamilia() {

    var grupo = $("#getGrupos").val();

    $.ajax({

        url: 'getFamilia',

        type: 'POST',

        dataType: 'json',

        data: { "grupo": grupo },

        success: function (url) {

            var fila = "<option disabled selected>Seleccione la Familia</option>";

            $("#getFamilias").empty();

            $.each(url, function (i, o) {

                fila += "<option value='" + o.idFamilia + "'>" + o.nmFamilia + "</option>";

            });

            $("#getFamilias").append(fila);

        }, error: function () {



        }

    });

}



function getEmpresasSesion() {

    var hola = base_url + 'verEmpresas';

    $("#getEmpresasSesion").empty();

    var fila = "<option disabled selected>Seleccione la Empresa</option>";

    $.getJSON(hola, function (result) {

        $.each(result, function (i, o) {

            fila += "<option value='" + o.idEmpresa + "'>" + o.nombreEmpresa + "</option>";

        });

        $("#getEmpresasSesion").append(fila);

    });

}



function postEmpresa() {

    var id = $("#getEmpresasSesion").val();

    alert(id);

    $.ajax({

        url: 'setEmpresa',

        type: 'POST',

        dataType: 'json',

        data: { "id": id },

        success: function (url) {



        }, error: function () {



        }

    });

}



function getIdEmpresa() {

    $.ajax({

        url: 'getIdEmpresa',

        type: 'POST',

        dataType: 'json',

        success: function (url) {



        }, error: function () {



        }

    });

}