<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['Login'] = "welcome/login";

$route['IniciarSesion'] = "welcome/IniciarSesion";
$route['Menu'] = "welcome/menu";
$route['ModuloPacientes'] = "welcome/ModuloPacientes";
$route['addPaciente'] = "welcome/addPaciente";
$route['getPacientes'] = "welcome/getPacientes";
$route['editarPaciente'] = "welcome/editarPaciente";
$route['editarDatosPaciente'] = "welcome/editarDatosPaciente";

$route['getRegiones'] = "welcome/getRegiones";
$route['getProvincias'] = "welcome/getProvincias";
$route['getComunas'] = "welcome/getComunas";

$route['ModuloEspecialidad'] = "welcome/ModuloEspecialidad";
$route['addEspecialidad'] = "welcome/addEspecialidad";
$route['editarDatosEspecialidad'] = "welcome/editarDatosEspecialidad";
$route['editarEspecialidad'] = "welcome/editarEspecialidad";
$route['getEspecialidades'] = "welcome/getEspecialidades";

$route['ModuloMedico'] = "welcome/ModuloMedico";
$route['editarDatosMedico'] = "welcome/editarDatosMedico";
$route['editarMedico'] = "welcome/editarMedico";
$route['getMedicos'] = "welcome/getMedicos";
$route['addMedico'] = "welcome/addMedico";

$route['ModuloAsignacion'] = "welcome/ModuloAsignacion";
$route['getMedicosAsignacion'] = "welcome/getMedicosAsignacion";
$route['asignacionXmedico'] = "welcome/asignacionXmedico";
$route['getEspecialidadesMedico'] = "welcome/getEspecialidadesMedico";
$route['addEspecialidadMedico'] = "welcome/addEspecialidadMedico";
$route['editarEspecialidadMedico'] = "welcome/editarEspecialidadMedico";

$route['ModuloAgenda'] = "welcome/ModuloAgenda";
$route['getEspecialidadesSelectMedico'] = "welcome/getEspecialidadesSelectMedico";
$route['getMedicosSelect'] = "welcome/getMedicosSelect";
$route['getEstadoAgenda'] = "welcome/getEstadoAgenda";
$route['addAgenda'] = "welcome/addAgenda";

$route['getAgenda'] = "welcome/getAgenda";
$route['editarAgenda'] = "welcome/editarAgenda";
$route['getDetalleAgenda'] = "welcome/getDetalleAgenda";
$route['editarAgendaDetalle'] = "welcome/editarAgendaDetalle";
$route['getEstadoAgenda'] = 'welcome/getEstadoAgenda';
$route['editarEstadoAgenda'] = 'welcome/editarEstadoAgenda';


$route['AgendaPacientes'] = 'welcome/AgendaPacientes';
$route['getEspecialidadesPublico'] = 'welcome/getEspecialidadesPublico';
$route['getMedicosPublico'] = 'welcome/getMedicosPublico';
$route['consultarAgenda'] = 'welcome/consultarAgenda';
$route['getDatosPaciente'] = 'welcome/getDatosPaciente';
$route['addSolicitudHorario'] = 'welcome/addSolicitudHorario';
$route['addSolicitudHorarioEspecial'] = 'welcome/addSolicitudHorarioEspecial';
$route['addSolicitudHorarioPublico'] = 'welcome/addSolicitudHorarioPublico';
$route['addSolicitudHorarioEspecialPublico'] = 'welcome/addSolicitudHorarioEspecialPublico';
$route['getSolicitudes'] = 'welcome/getSolicitudes';
$route['editarSolicitud'] = 'welcome/editarSolicitud';
$route['editarSolicitudPublico'] = 'welcome/editarSolicitudPublico';

$route['getSolicitudPaciente'] = 'welcome/getSolicitudPaciente';
$route['getHistorialSolicitud'] = 'welcome/getHistorialSolicitud';
$route['getHistorialSolicitudPublico'] = 'welcome/getHistorialSolicitudPublico';
$route['getSolicitudPacienteRut'] = 'welcome/getSolicitudPacienteRut';

$route['ModuloSolicitudes'] = 'welcome/ModuloSolicitudes';

$route['Correo'] = 'welcome/Correo';
$route['Anulacion'] = 'welcome/Anulacion';
$route['eliminarSesion'] = 'welcome/eliminarSesion';



