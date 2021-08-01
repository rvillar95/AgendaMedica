<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
defined('BASEPATH') or exit('No direct script access allowed');

class IndexModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    function inicio($usuario, $clave)
    {
        $this->db->select("idUsuario,NombreUsuario, PasswordUsuario,FechaInsert, FechaUpdate,estado");
        $this->db->from("usuarios");
        $this->db->where("NombreUsuario", $usuario);
        $this->db->where("PasswordUsuario", $clave);
        return $this->db->get()->result();
    }

    function addPaciente($rut, $nombre, $direccion, $telefono, $correo, $region, $comuna, $idAdministrador, $sexo)
    {
        $select = "select count(*) cantidad from paciente where RutPaciente = '" . $rut . "'";
        $resultado = $this->db->query($select);
        $cantidad = $resultado->result()[0]->cantidad;
        if ($cantidad == 0) {
            $insert = "insert into paciente (RutPaciente,
            NombrePaciente,
            DireccionPaciente,
            RegionPaciente,
            CiudadPaciente,
            TelefonoPaciente,
            CorreoPaciente,
            idUsuarioInsert,
            FechaInsert,
            sexo) values ('" . $rut . "','" . $nombre . "','" . $direccion . "'," . $region . "," . $comuna . ",'" . $telefono . "','" . $correo . "'," . $idAdministrador . ",now(),'" . $sexo . "')";
            //echo $insert;
            $query = $this->db->query($insert);
            return $query;
        } else {
            return 2;
        }
    }

    function editarDatosPaciente($id, $nombre, $direccion, $telefono, $correo, $region, $comuna, $idAdministrador, $sexo)
    {
        $updateRegion = $region == null ? "" : " , RegionPaciente = " . $region;
        $updateComuna = $comuna == "Seleccione la Comuna" ? "" : " , CiudadPaciente = " . $comuna;

        $update = "update paciente set NombrePaciente = '" . $nombre . "',
        DireccionPaciente = '" . $direccion . "',
        TelefonoPaciente = '" . $telefono . "',
        CorreoPaciente = '" . $correo . "',
        idUsuarioUpdate = '" . $idAdministrador . "',
        sexo = '" . $sexo . "',
        FechaUpdate = now() " . $updateRegion . $updateComuna . " where idPaciente = " . $id;
        //echo $update;
        $query = $this->db->query($update);
        return $query;
    }

    function editarAgendaDetalle($id, $estado, $idAdministrador)
    {
        $update = "update agendadetalle set estado = '" . $estado . "',
        idUsuarioUpdate = '" . $idAdministrador . "',
        FechaUpdate = now() 
        where idAgenda_Detalle = " . $id;
        $query = $this->db->query($update);
        return $query;
    }

    function getRegiones()
    {
        $query = $this->db->query('select * from regiones');
        return $query->result();
    }

    function editarPaciente($id, $estado)
    {
        $update = "update paciente set estado = " . $estado . " where idPaciente = " . $id;
        // echo $update;
        $query = $this->db->query($update);
        return $query;
    }

    function getPacientes()
    {
        $query = $this->db->query('select idPaciente id,p.RutPaciente rut,
        p.NombrePaciente nombre,
        p.DireccionPaciente direccion,
        concat(r.region_nombre," ",r.region_ordinal) region,
        c.comuna_nombre comuna,
        p.TelefonoPaciente telefono,
        p.CorreoPaciente correo ,
        p.estado ,
        p.RegionPaciente,
        p.CiudadPaciente,
        p.sexo
        from paciente p , regiones r, comunas c 
        where p.RegionPaciente = r.region_id 
        and p.CiudadPaciente = c.comuna_id');
        return $query;
    }

    function getProvincias($region)
    {
        $query = $this->db->query('select * from provincias where region_id = ' . $region);
        return $query->result();
    }
    function getComunas($provincia)
    {
        $query = $this->db->query('select * from comunas where provincia_id = ' . $provincia);
        return $query->result();
    }

    function addMedico($rut, $nombre, $direccion, $telefono, $correo, $region, $comuna, $idAdministrador)
    {
        $select = "select count(*) cantidad from medicos where RutMedico = '" . $rut . "'";
        $resultado = $this->db->query($select);
        $cantidad = $resultado->result()[0]->cantidad;
        if ($cantidad == 0) {
            $insert = "insert into medicos (RutMedico,
        NombreMedico,
        DireccionMedico,
        RegionMedico,
        CiudadMedico,
        TelefonoMedico,
        CorreoMedico,
        idUsuarioInsert,
        FechaInsert) values ('" . $rut . "','" . $nombre . "','" . $direccion . "'," . $region . "," . $comuna . ",'" . $telefono . "','" . $correo . "'," . $idAdministrador . ",now())";
            //echo $insert;
            $query = $this->db->query($insert);
            return $query;
        } else {
            return 2;
        }
    }

    function getMedicos()
    {
        $query = $this->db->query('select idMedico id,p.RutMedico rut,
        p.NombreMedico nombre,
        p.DireccionMedico direccion,
        concat(r.region_nombre," ",r.region_ordinal) region,
        c.comuna_nombre comuna,
        p.TelefonoMedico telefono,
        p.CorreoMedico correo ,
        p.estado ,
        p.RegionMedico,
        p.CiudadMedico
        from medicos p , regiones r, comunas c 
        where p.RegionMedico = r.region_id 
        and p.CiudadMedico = c.comuna_id');
        return $query;
    }

    function getMedicosAsignacion()
    {
        $query = $this->db->query('select idMedico id,p.RutMedico rut,
        p.NombreMedico nombre,
        p.DireccionMedico direccion,
        p.TelefonoMedico telefono,
        p.CorreoMedico correo 
        from medicos p  
        where p.estado = 1');
        return $query->result();
    }

    function asignacionXmedico($id)
    {
        $query = $this->db->query('select esme.idEspecialidadMedicos,es.nombreEspecialidad, esme.TiempoAtencion,esme.estado from especialidadmedicos esme, especialidad es, medicos me where esme.idEspecialidad = es.idEspecialidad and esme.idMedico = me.idMedico and esme.idMedico =' . $id);
        return $query->result();
    }

    function editarMedico($id, $estado, $idAdministrador)
    {
        $update = "update medicos set estado = " . $estado . " , idUsuarioUpdate = " . $idAdministrador . " , FechaUpdate = now() where idMedico = " . $id;
        // echo $update;
        $query = $this->db->query($update);
        return $query;
    }

    function editarAgenda($id, $estado, $idAdministrador)
    {
        $update = "update agenda set estado = " . $estado . " , idUsuarioUpdate = " . $idAdministrador . " , FechaUpdate = now() where idAgenda = " . $id;
        // echo $update;
        $query = $this->db->query($update);
        return $query;
    }

    function editarDatosMedico($id, $nombre, $direccion, $telefono, $correo, $region, $comuna, $idAdministrador)
    {
        $updateRegion = $region == null ? "" : " , RegionMedico = " . $region;
        $updateComuna = $comuna == "Seleccione la Comuna" ? "" : " , CiudadMedico = " . $comuna;

        $update = "update medicos set NombreMedico = '" . $nombre . "',
        DireccionMedico = '" . $direccion . "',
        TelefonoMedico = '" . $telefono . "',
        CorreoMedico = '" . $correo . "',
        idUsuarioUpdate = '" . $idAdministrador . "',
        FechaUpdate = now() " . $updateRegion . $updateComuna . " where idMedico = " . $id;
        //echo $update;
        $query = $this->db->query($update);
        return $query;
    }

    function addEspecialidad($nombre, $idAdministrador)
    {
        $insert = "insert into especialidad (NombreEspecialidad, FechaInsert, idUsuarioInsert) values 
        ('" . $nombre . "',now()," . $idAdministrador . ")";
        //echo $insert;
        $query = $this->db->query($insert);
        return $query;
    }

    function editarEspecialidad($id, $estado, $idAdministrador)
    {
        $update = "update especialidad set estado = " . $estado . " , idUsuarioUpdate = " . $idAdministrador . " , FechaUpdate = now() where idEspecialidad = " . $id;
        // echo $update;
        $query = $this->db->query($update);
        return $query;
    }

    function editarDatosEspecialidad($id, $nombre, $idAdministrador)
    {
        $update = "update especialidad set NombreEspecialidad = '" . $nombre . "' , idUsuarioUpdate = " . $idAdministrador . " , FechaUpdate = now() where idEspecialidad = " . $id;
        // echo $update;
        $query = $this->db->query($update);
        return $query;
    }

    function getEspecialidades()
    {
        $query = $this->db->query('select * from especialidad where estado = 1');
        return $query;
    }

    function getEspecialidadesMedico()
    {
        $query = $this->db->query('select * from especialidad where estado = 1');
        return $query->result();
    }

    function addEspecialidadMedico($idMedico, $idEspecialidad, $tiempo, $idAdministrador)
    {
        $select = "select count(*) as cantidad from especialidadmedicos where idEspecialidad = " . $idEspecialidad . " 
        and idMedico = " . $idMedico . " and TiempoAtencion = " . $tiempo;
        //echo $select;
        $resultado = $this->db->query($select);
        $cantidad = $resultado->result()[0]->cantidad;
        if ($cantidad == 0) {
            $insert = "insert into especialidadmedicos (idEspecialidad, idMedico, TiempoAtencion,
            idUsuarioInsert,FechaInsert) values 
            (" . $idEspecialidad . "," . $idMedico . "," . $tiempo . "," . $idAdministrador . ",now())";
            //echo $insert;
            $query = $this->db->query($insert);
            return $query;
        } else {
            return "existe";
        }
    }

    function editarEspecialidadMedico($id, $estado, $idAdministrador)
    {
        $update = "update especialidadmedicos set estado = " . $estado . " , idUsuarioUpdate = " . $idAdministrador . " , FechaUpdate = now() where idEspecialidadMedicos = " . $id;
        $query = $this->db->query($update);
        return $query;
    }

    function editarEstadoAgenda($idAdministrador, $id, $estado)
    {
        $update = "update agendadetalle set estadoSolicitud = " . $estado . " , idUsuarioUpdate = " . $idAdministrador . " , FechaUpdate = now() where idAgenda_Detalle = " . $id;
        $query = $this->db->query($update);
        return $query;
    }

    function getAgenda()
    {
        $query = $this->db->query('select ag.estado, ag.idAgenda id,ag.hora_inicio inicio,ag.hora_fin fin,esp.TiempoAtencion tiempo, med.NombreMedico medico , es.NombreEspecialidad especialidad from agenda ag, especialidadmedicos esp, medicos med , especialidad es where ag.idEspecialidad_Medico = esp.idEspecialidadMedicos and esp.idMedico = med.idMedico and esp.idEspecialidad = es.idEspecialidad');
        return $query;
    }

    function getSolicitudes($id)
    {
        $query = $this->db->query('select sol.idAgenda_Solicitud,pac.idPaciente, pac.RutPaciente ,pac.NombrePaciente,pac.CorreoPaciente, sol.notificado, sol.fecha, est.nombre estado from agendasolicitud sol, paciente pac , estadosolicitud est where sol.idPaciente = pac.idPaciente  and est.idEstado_Solicitud = sol.estado and sol.idAgenda_Detalle = ' . $id . ' ORDER BY sol.fecha ASC'); //and sol.estado in ( 1,5)
        return $query;
    }

    function getCorreoPaciente($idPaciente, $idSolicitud)
    {
        $select = "select pac.CorreoPaciente, pac.NombrePaciente , det.hora_inicio,det.hora_fin, ag.hora_inicio dia from paciente pac , agendadetalle det, agendasolicitud sol, agenda ag where pac.idPaciente = sol.idPaciente and sol.idAgenda_Detalle = det.idAgenda_Detalle and ag.idAgenda = det.idAgenda and sol.idAgenda_Solicitud = " . $idSolicitud . " and pac.idPaciente = " . $idPaciente;
        //echo $select;
        $resultado = $this->db->query($select);
        $total = "";
        $total .= $resultado->result()[0]->CorreoPaciente;
        $total .= "," . $resultado->result()[0]->NombrePaciente;
        $total .= "," . $resultado->result()[0]->hora_inicio;
        $total .= "," . $resultado->result()[0]->hora_fin;
        $var = $resultado->result()[0]->dia;
        $var = explode(" ", $var);
        $var = $var[0];
        $var = explode("-", $var);
        $dia = $var[2] . '-' . $var[1] . '-' . $var[0];
        $total .= "," . $dia;
        return $total;
    }

    function Anulacion($id, $estado, $detalle, $idPaciente)
    {
        $this->db->trans_begin();
        $select2 = "select sol.estado , det.estadoSolicitud from agendasolicitud sol, agendadetalle det where det.idAgenda_Detalle = sol.idAgenda_Detalle and sol.idAgenda_Solicitud = " . $detalle;
        //echo $select;
        $resultado2 = $this->db->query($select2);
        $estadoAnterior = $resultado2->result()[0]->estado;
        $estadoSolicitud = $resultado2->result()[0]->estadoSolicitud;

        $update = "update token_anulacion set estado = " . $estado . "  where idToken_Anulacion = " . $id;
        $this->db->query($update);

        $insert = "insert into historialSolicitud (idAgendaSolicitud,usuario,estado_anterior, estado_nuevo,estado_detalle,fecha) values(" . $detalle . ",99," . $estadoAnterior . ",4," . $estadoSolicitud . ",now())";
        $this->db->query($insert);
        if ($estado != 3) {
            $update = "update agendasolicitud set estado = 4  where idAgenda_Solicitud = " . $detalle;
            $this->db->query($update);

            $select = "select idAgenda_Detalle id from agendasolicitud where idPaciente = " . $idPaciente . " and idAgenda_Solicitud = " . $detalle;
            $query = $this->db->query($select);
            $idDetalle = $query->result()[0]->id;
            if ($idDetalle != "" || $idDetalle != null) {
                $update = "update agendadetalle set idPaciente = NULL where idAgenda_Detalle = " . $idDetalle;
                $query = $this->db->query($update);
            }
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return 0;
        } else {
            $this->db->trans_commit();
            return 1;
        }
    }

    function editarSolicitud($id, $resultado, $idAdministrador, $idPaciente)
    {
        $select2 = "select sol.estado , det.estadoSolicitud from agendasolicitud sol, agendadetalle det where det.idAgenda_Detalle = sol.idAgenda_Detalle and sol.idAgenda_Solicitud = " . $id;
        //echo $select;
        $resultado2 = $this->db->query($select2);
        $estadoAnterior = $resultado2->result()[0]->estado;
        $estadoSolicitud = $resultado2->result()[0]->estadoSolicitud;
        //  $estadoAnterior;
        //echo "hola";
        if ($resultado == "anular") {
            $this->db->trans_begin();

            $update = "update agendasolicitud set estado = 7  where idAgenda_Solicitud = " . $id;
            $query = $this->db->query($update);

            $insert = "insert into historialSolicitud (idAgendaSolicitud,usuario,estado_anterior, estado_nuevo,estado_detalle,fecha) values(" . $id . ",99," . $estadoAnterior . ",7," . $estadoSolicitud . ",now())";
            $this->db->query($insert);

            $insert = "insert into token_anulacion (idPaciente,idHora,fecha,estado) values(" . $idPaciente . "," . $id . ",now(),1)";
            $this->db->query($insert);

            $select3 = "select MAX(idToken_Anulacion) id from token_anulacion";

            $resultado3 = $this->db->query($select3);
            $idToken = $resultado3->result()[0]->id;




            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return 0;
            } else {
                $this->db->trans_commit();
                return "1," . $idToken;
            }
        } else if ($resultado == "aceptar") {
            $this->db->trans_begin();
            $update = "update agendasolicitud set estado = 2 , usuarioUpdate = " . $idAdministrador . " , FechaUpdate = now() where idAgenda_Solicitud = " . $id;
            // echo $update;
            $query = $this->db->query($update);

            $select = "select idAgenda_Detalle id from agendasolicitud where idPaciente = " . $idPaciente . " and idAgenda_Solicitud = " . $id;
            $query = $this->db->query($select);
            $idDetalle = $query->result()[0]->id;
            if ($idDetalle != "" || $idDetalle != null) {
                $update = "update agendadetalle set idPaciente = " . $idPaciente . " where idAgenda_Detalle = " . $idDetalle;
                $query = $this->db->query($update);
            }


            $insert = "insert into historialSolicitud (idAgendaSolicitud,usuario,estado_anterior, estado_nuevo,estado_detalle,fecha) values(" . $id . "," . $idAdministrador . "," . $estadoAnterior . ",2," . $estadoSolicitud . ",now())";
            $insertquery = $this->db->query($insert);

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return 0;
            } else {
                $this->db->trans_commit();
                return 1;
            }
        } else if ($resultado == "rechazar") {
            $this->db->trans_begin();
            $update = "update agendasolicitud set estado = 3 , usuarioUpdate = " . $idAdministrador . " , FechaUpdate = now() where idAgenda_Solicitud = " . $id;
            $query = $this->db->query($update);

            $select = "select idAgenda_Detalle id from agendasolicitud where idPaciente = " . $idPaciente . " and idAgenda_Solicitud = " . $id;
            $query = $this->db->query($select);
            $idDetalle = $query->result()[0]->id;
            if ($idDetalle != "" || $idDetalle != null) {
                $update = "update agendadetalle set idPaciente = NULL where idAgenda_Detalle = " . $idDetalle;
                $query = $this->db->query($update);
            }

            $insert = "insert into historialSolicitud (idAgendaSolicitud,usuario,estado_anterior, estado_nuevo,estado_detalle,fecha) values(" . $id . "," . $idAdministrador . "," . $estadoAnterior . ",3," . $estadoSolicitud . ",now())";
            $insertquery = $this->db->query($insert);
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return 0;
            } else {
                $this->db->trans_commit();
                return 1;
            }
        } else if ($resultado == "espera") {
            $this->db->trans_begin();
            $update = "update agendasolicitud set estado = 5 , usuarioUpdate = " . $idAdministrador . " , FechaUpdate = now() where idAgenda_Solicitud = " . $id;
            $query = $this->db->query($update);

            $select = "select idAgenda_Detalle id from agendasolicitud where idPaciente = " . $idPaciente . " and idAgenda_Solicitud = " . $id;
            $query = $this->db->query($select);
            $idDetalle = $query->result()[0]->id;
            if ($idDetalle != "" || $idDetalle != null) {
                $update = "update agendadetalle set idPaciente = NULL where idAgenda_Detalle = " . $idDetalle;
                $query = $this->db->query($update);
            }

            $insert = "insert into historialSolicitud (idAgendaSolicitud,usuario,estado_anterior, estado_nuevo,estado_detalle,fecha) values(" . $id . "," . $idAdministrador . "," . $estadoAnterior . ",5," . $estadoSolicitud . ",now())";
            $insertquery = $this->db->query($insert);
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return 0;
            } else {
                $this->db->trans_commit();
                return 1;
            }
        }
    }

    function editarSolicitudPublico($id, $resultado, $idAdministrador, $idPaciente)
    {
        $select2 = "select sol.estado , det.estadoSolicitud from agendasolicitud sol, agendadetalle det where det.idAgenda_Detalle = sol.idAgenda_Detalle and sol.idAgenda_Solicitud = " . $id;
        //echo $select;
        $resultado2 = $this->db->query($select2);
        $estadoAnterior = $resultado2->result()[0]->estado;
        $estadoSolicitud = $resultado2->result()[0]->estadoSolicitud;
        //  $estadoAnterior;
        //echo "hola";
        if ($resultado == "anular") {
            $this->db->trans_begin();

            $update = "update agendasolicitud set estado = 7  where idAgenda_Solicitud = " . $id;
            $query = $this->db->query($update);

            $insert = "insert into historialSolicitud (idAgendaSolicitud,usuario,estado_anterior, estado_nuevo,estado_detalle,fecha) values(" . $id . ",99," . $estadoAnterior . ",7," . $estadoSolicitud . ",now())";
            $this->db->query($insert);

            $insert = "insert into token_anulacion (idPaciente,idHora,fecha,estado) values(" . $idPaciente . "," . $id . ",now(),1)";
            $this->db->query($insert);

            $select3 = "select MAX(idToken_Anulacion) id from token_anulacion";

            $resultado3 = $this->db->query($select3);
            $idToken = $resultado3->result()[0]->id;




            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return 0;
            } else {
                $this->db->trans_commit();
                return "1," . $idToken;
            }
        } else if ($resultado == "aceptar") {
            $this->db->trans_begin();
            $update = "update agendasolicitud set estado = 2 , usuarioUpdate = " . $idAdministrador . " , FechaUpdate = now() where idAgenda_Solicitud = " . $id;
            // echo $update;
            $query = $this->db->query($update);

            $select = "select idAgenda_Detalle id from agendasolicitud where idPaciente = " . $idPaciente . " and idAgenda_Solicitud = " . $id;
            $query = $this->db->query($select);
            $idDetalle = $query->result()[0]->id;
            if ($idDetalle != "" || $idDetalle != null) {
                $update = "update agendadetalle set idPaciente = " . $idPaciente . " where idAgenda_Detalle = " . $idDetalle;
                $query = $this->db->query($update);
            }


            $insert = "insert into historialSolicitud (idAgendaSolicitud,usuario,estado_anterior, estado_nuevo,estado_detalle,fecha) values(" . $id . "," . $idAdministrador . "," . $estadoAnterior . ",2," . $estadoSolicitud . ",now())";
            $insertquery = $this->db->query($insert);

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return 0;
            } else {
                $this->db->trans_commit();
                return 1;
            }
        } else if ($resultado == "rechazar") {
            $this->db->trans_begin();
            $update = "update agendasolicitud set estado = 3 , usuarioUpdate = " . $idAdministrador . " , FechaUpdate = now() where idAgenda_Solicitud = " . $id;
            $query = $this->db->query($update);

            $select = "select idAgenda_Detalle id from agendasolicitud where idPaciente = " . $idPaciente . " and idAgenda_Solicitud = " . $id;
            $query = $this->db->query($select);
            $idDetalle = $query->result()[0]->id;
            if ($idDetalle != "" || $idDetalle != null) {
                $update = "update agendadetalle set idPaciente = NULL where idAgenda_Detalle = " . $idDetalle;
                $query = $this->db->query($update);
            }

            $insert = "insert into historialSolicitud (idAgendaSolicitud,usuario,estado_anterior, estado_nuevo,estado_detalle,fecha) values(" . $id . "," . $idAdministrador . "," . $estadoAnterior . ",3," . $estadoSolicitud . ",now())";
            $insertquery = $this->db->query($insert);
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return 0;
            } else {
                $this->db->trans_commit();
                return 1;
            }
        } else if ($resultado == "espera") {
            $this->db->trans_begin();
            $update = "update agendasolicitud set estado = 5 , usuarioUpdate = " . $idAdministrador . " , FechaUpdate = now() where idAgenda_Solicitud = " . $id;
            $query = $this->db->query($update);

            $select = "select idAgenda_Detalle id from agendasolicitud where idPaciente = " . $idPaciente . " and idAgenda_Solicitud = " . $id;
            $query = $this->db->query($select);
            $idDetalle = $query->result()[0]->id;
            if ($idDetalle != "" || $idDetalle != null) {
                $update = "update agendadetalle set idPaciente = NULL where idAgenda_Detalle = " . $idDetalle;
                $query = $this->db->query($update);
            }

            $insert = "insert into historialSolicitud (idAgendaSolicitud,usuario,estado_anterior, estado_nuevo,estado_detalle,fecha) values(" . $id . "," . $idAdministrador . "," . $estadoAnterior . ",5," . $estadoSolicitud . ",now())";
            $insertquery = $this->db->query($insert);
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return 0;
            } else {
                $this->db->trans_commit();
                return 1;
            }
        }
    }


    function editarSolicitudNotificado($id)
    {
        $update = "update agendasolicitud set notificado = 'S' where idAgenda_Solicitud = " . $id;
        $query = $this->db->query($update);
        return $query;
    }

    function getEspecialidadesSelectMedico($id)
    {
        $query = $this->db->query('select esm.idEspecialidadMedicos , es.NombreEspecialidad, esm.TiempoAtencion  from
        especialidad es,
        especialidadmedicos esm
        where es.idEspecialidad = esm.idEspecialidad
        and es.estado = 1
        and esm.estado = 1
        and esm.idMedico = ' . $id);
        return $query->result();
    }

    function getMedicosSelect()
    {
        $query = $this->db->query('select * from medicos where estado = 1');
        return $query->result();
    }

    function getEstadoAgenda()
    {
        $query = $this->db->query('select * from estadoagenda');
        return $query->result();
    }

    function getDetalleAgenda($id)
    {
        $query = "select det.idAgenda_Detalle,det.idPaciente,CASE WHEN det.idPaciente is null THEN det.idPaciente ELSE (select NombrePaciente from paciente where idPaciente = det.idPaciente) END idPaciente,det.hora_inicio, det.orden,det.hora_fin,det.estado, est.nombre, est.idEstado_Agenda, (select count(*) cantidad from agendasolicitud where idAgenda_Detalle = det.idAgenda_Detalle ) cantidad from agendadetalle det, estadoagenda est,agenda ag where det.estadoSolicitud = est.idEstado_Agenda and det.idAgenda = ag.idAgenda and det.idAgenda = " . $id . " ORDER BY det.orden ASC"; //SELECT COUNT ->and estado in (1,5)
        $resultado = $this->db->query($query);
        return $resultado->result();
    }

    function addAgenda($idAdministrador, $especialidad, $inicio, $fin)
    {

        $this->db->trans_begin();


        //   echo "inicio: ".strtotime($inicio)."<br>";
        //  echo "fin: ".strtotime($fin)."<br>";
        $hora_inicio = explode("T", $inicio);
        $hora_fin = explode("T", $fin);
        //  echo '|'.$hora_inicio[1].'|'.$hora_fin[1].'|';
        $diferencia = date("H:i", strtotime("00:00") + strtotime($hora_fin[1]) - strtotime($hora_inicio[1]));
        // echo "diferencia: ".$diferencia;

        $select = "select TiempoAtencion tiempo from especialidadmedicos where idEspecialidadMedicos =" . $especialidad;
        $query = $this->db->query($select);
        $tiempo = $query->result()[0]->tiempo;
        // echo "El tiempo es: ".$tiempo;

        $v_HorasPartes = explode(":", $diferencia);

        //la parte de la hora la multiplicamos por 60 para pasarla a minutos y así realizar la suma de los minutos totales
        $minutosTotales = ($v_HorasPartes[0] * 60) + $v_HorasPartes[1];
        $diferenciaTotal_paso = $minutosTotales / $tiempo;
        $diferenciaTotal = $minutosTotales / $tiempo;
        $variable = explode(".", $diferenciaTotal_paso);
        // echo "AAA" . $diferenciaTotal . "AAA";
        //  echo "AAA" . $variable[1][0] . "AAA";
        if (strpos($diferenciaTotal, ".")) {
            if ($variable[1][0] > 5) {
                $diferenciaTotal = $variable[0];
                //  echo "IF 1" . $diferenciaTotal;
            } else {
                $diferenciaTotal = floor($diferenciaTotal);
                //   echo "ELSE 2" . $diferenciaTotal;
            }
        }


        //echo "LA DIFERENCIA ES: " . $diferenciaTotal;

        $inicio = str_replace("T", " ", $inicio);
        $fin = str_replace("T", " ", $fin);
        $insert = "insert into agenda (idEspecialidad_Medico,
        hora_inicio,
        hora_fin,
        idUsuarioInsert,
        FechaInsert) values (" . $especialidad . ",
        '" . $inicio . "',
        '" . $fin . "',
        " . $idAdministrador . ",
        now())";
        $this->db->query($insert);

        $select = "select MAX(idAgenda) id from agenda";
        $query = $this->db->query($select);
        $idAgenda = $query->result()[0]->id;
        $contador = 1;
        $arregloHorarios = array();
        //   echo "TIEMPO ORIGINAL: " . $hora_inicio[1];
        //   echo "TIEMPO A SUMAR: " . $tiempo;
        $hola = strtotime($hora_inicio[1]);
        $chao = date("H:i", $hola + $tiempo);
        //   echo $chao;


        //$minutoAnadir=;


        //echo "TIEMPO ADELANTADO: ".$date->modify('+40 minute');
        $variable_paso = $hora_inicio[1];
        $nuevaHora = "";
        $array = [];
        array_push($array, $hora_inicio[1]);
        //  echo "***** " . $diferenciaTotal;
        for ($i = 0; $i < $diferenciaTotal; $i++) {
            // echo "<br>|| " . $hora_inicio[1] . " != " . $variable_paso . " ||";
            if ($hora_inicio[1] == $variable_paso) {
                //  echo "<br>|| primer if " . $hora_inicio[1] . " ||";

                $segundos_horaInicial = strtotime($hora_inicio[1]);
                $segundos_minutoAnadir = $tiempo * 60;
                $nuevaHora = date("H:i", $segundos_horaInicial + $segundos_minutoAnadir);
                //  echo "<br>|| resultado " . $nuevaHora . " ||";
                array_push($array, $nuevaHora);
                $variable_paso = $nuevaHora;
                //   echo "<br>|| resultado guardado" . $variable_paso . " ||";
            } else {
                //  echo "<br>|| else if || " . $variable_paso . " ||";
                $segundos_horaInicial = strtotime($variable_paso);
                $segundos_minutoAnadir = $tiempo * 60;
                $nuevaHora = date("H:i", $segundos_horaInicial + $segundos_minutoAnadir);
                //  echo "<br>|| resultado " . $nuevaHora . " ||";
                array_push($array, $nuevaHora);
                $variable_paso = $nuevaHora;
                //     echo "<br>|| resultado guardado" . $variable_paso . " ||";
            }
        }
        //  echo "<br>";
        // echo "<pre>";
        //  print_r($array);
        //  echo "</pre>";
        $arregloFinal = [];
        // echo "<br>**************** ";
        //$arregloFinal
        for ($i = 0; $i < count($array) - 1; $i++) {

            $insert = "insert into agendadetalle (idAgenda,
            orden,
            hora_inicio,
            hora_fin,
            idUsuarioInsert,
            FechaInsert) values (" . $idAgenda . ",
        " . ($i + 1) . ",
        '" . $array[$i] . "',
        '" . $array[$i + 1] . "',
        " . $idAdministrador . ",
        now())";
            $this->db->query($insert);
            //echo "<br>" . $array[$i] . " hasta " . $array[$i + 1];
        }


        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return 0;
        } else {
            $this->db->trans_commit();
            return 1;
        }
    }

    function getEspecialidadesPublico()
    {
        $query = $this->db->query('select * from especialidad where estado = 1');
        return $query->result();
    }

    function getMedicosPublico($id)
    {
        $query = $this->db->query('select med.idMedico, med.NombreMedico , esp.TiempoAtencion, esp.idEspecialidadMedicos from medicos med , especialidadmedicos esp where med.idMedico = esp.idMedico and med.idMedico = ' . $id);
        return $query->result();
    }

    function consultarAgenda($id)
    {
        $query = $this->db->query('select count(*) cantidad, idAgenda id, hora_inicio , hora_fin from agenda where estado = 1 and idEspecialidad_Medico = ' . $id . ' and hora_inicio > now() GROUP BY idAgenda');
        $resultado = $query->result();
        //echo count($resultado);


        if (count($resultado) == 1) {
            $idAgenda = $resultado[0]->id;
            $querySelect = "select ag.idAgenda_Detalle id,ag.hora_inicio inicio,ag.hora_fin fin,prin.hora_inicio, prin.hora_fin from agendadetalle ag ,agenda prin where prin.idAgenda = ag.idAgenda and ag.idAgenda = " . $idAgenda . " and ag.estado = 1 and ag.estadoSolicitud in (2,3)  and prin.hora_inicio > now() and idPaciente is null ORDER BY orden ASC";
            // echo $querySelect;
            //echo "<br>select idAgenda from agendadetalle where idAgenda = " . $idAgenda . " and estado = 1 and estadoSolicitud in (2,3) ORDER BY orden ASC";
            $queryDetalle = $this->db->query($querySelect);
            return $queryDetalle->result();
        } else if (count($resultado) > 1) {
            $idAgenda = "";
            foreach ($resultado as $key => $value) {
                $idAgenda .= $value->id . ",";
            }
            $idAgenda = substr($idAgenda, 0, -1);
            //echo $idAgenda;
            $querySelect = "select ag.idAgenda_Detalle id,ag.hora_inicio inicio,ag.hora_fin fin,prin.hora_inicio, prin.hora_fin from agendadetalle ag ,agenda prin where prin.idAgenda = ag.idAgenda and ag.idAgenda in ( " . $idAgenda . ") and ag.estado = 1 and ag.estadoSolicitud in (2,3)  and prin.hora_inicio > now() and idPaciente is null ORDER BY ag.idAgenda ASC";
            // echo $querySelect;
            //echo "<br>select idAgenda from agendadetalle where idAgenda = " . $idAgenda . " and estado = 1 and estadoSolicitud in (2,3) ORDER BY orden ASC";
            $queryDetalle = $this->db->query($querySelect);
            return $queryDetalle->result();
        } else if (count($resultado) == 0) {
            return 0;
        }
    }

    function getDatosPaciente($rut)
    {
        $sql = "select * from paciente where RutPaciente = '$rut' ";
        $resultado = $this->db->query($sql);
        if (count($resultado->result()) == 0) {
            return "Paciente no registrado.";
        } else {
            return $resultado->result();
        }
    }

    function addSolicitudHorario($idPaciente, $idDetalle)
    {
        $this->db->trans_begin();
        $select = "select count(*) cantidad from agendasolicitud  where
        idPaciente = " . $idPaciente . " and idAgenda_Detalle = " . $idDetalle . " and estado not in (3)";
        $resultado = $this->db->query($select);
        $cantidadTotal = $resultado->result()[0]->cantidad;
        if ($cantidadTotal == 0) {
            $select2 = "select estadoSolicitud from agendadetalle where idAgenda_Detalle = " . $idDetalle;
            //echo $select;
            $resultado2 = $this->db->query($select2);

            $estadoSolicitud = $resultado2->result()[0]->estadoSolicitud;

            $insert = "insert into agendasolicitud (idAgenda_Detalle,idPaciente,estado,notificado,fecha)
        values (" . $idDetalle . "," . $idPaciente . ",1,'N',now())";
            $this->db->query($insert);

            $select3 = "select MAX(idAgenda_Solicitud) id from agendasolicitud";
            //echo $select;
            $resultado3 = $this->db->query($select3);

            $idSolicitud = $resultado3->result()[0]->id;
            //return $query;

            $insertHistorial = "insert into historialSolicitud (idAgendaSolicitud,usuario ,estado_anterior, estado_nuevo,estado_detalle,fecha) values(" . $idSolicitud . ",99,6,1," . $estadoSolicitud . ",now())";
            $this->db->query($insertHistorial);
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return 0;
            } else {
                $this->db->trans_commit();
                return 1;
            }
        } else {
            return 3;
        }
    }

    function addSolicitudHorarioEspecial($idDetalle, $nombre, $correo, $direccion, $telefono, $rut)
    {
        $this->db->trans_begin();

        $select = "select count(*) cantidad from agendasolicitud ag, paciente pac where
        ag.idPaciente = pac.idPaciente and pac.RutPaciente = '" . $rut . "' and ag.idAgenda_Detalle = " . $idDetalle . " and ag.estado not in (3)";
        $resultado = $this->db->query($select);
        $cantidadTotal = $resultado->result()[0]->cantidad;
        if ($cantidadTotal == 0) {
            $select = "select count(*) cantidad from paciente where RutPaciente = '" . $rut . "'";
            $resultado = $this->db->query($select);
            $cantidad = $resultado->result()[0]->cantidad;
            if ($cantidad == 0) {
                $insert = "insert into paciente (RutPaciente,
        NombrePaciente,
        DireccionPaciente,
        TelefonoPaciente,
        CorreoPaciente,
        RegionPaciente,
        CiudadPaciente
        ) values ('" . $rut . "','" . $nombre . "','" . $direccion . "','" . $telefono . "','" . $correo . "',1,1)";
                $query = $this->db->query($insert);


                $select2 = "select estadoSolicitud from agendadetalle where idAgenda_Detalle = " . $idDetalle;
                //echo $select;
                $resultado2 = $this->db->query($select2);

                $estadoSolicitud = $resultado2->result()[0]->estadoSolicitud;

                if ($query == 1) {
                    $select = "select MAX(idPaciente) id from paciente where RutPaciente = '" . $rut . "' ";
                    $query = $this->db->query($select);
                    $idPaciente = $query->result()[0]->id;

                    $insert2 = "insert into agendasolicitud (idAgenda_Detalle,idPaciente,estado,notificado,fecha)
        values (" . $idDetalle . "," . $idPaciente . ",1,'N',now())";
                    $this->db->query($insert2);

                    $select3 = "select MAX(idAgenda_Solicitud) id from agendasolicitud";
                    //echo $select;
                    $resultado3 = $this->db->query($select3);

                    $idSolicitud = $resultado3->result()[0]->id;
                    //return $query;

                    $insertHistorial = "insert into historialSolicitud (idAgendaSolicitud,usuario ,estado_anterior, estado_nuevo,estado_detalle,fecha) values(" . $idSolicitud . ",99,6,1," . $estadoSolicitud . ",now())";
                    $this->db->query($insertHistorial);
                } else {
                    return 0;
                }

                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    return 0;
                } else {
                    $this->db->trans_commit();
                    return 1;
                }
            } else {
                return 2;
            }
        } else {
            return 3;
        }
    }

    function getNumeroSolicitudes($id)
    {
        $query = $this->db->query('select count(*) cantidad from agendasolicitud where idAgenda_Detalle = ' . $id . ' and estado = 1');
        return $query->result();
    }

    function getSolicitudPaciente($id)
    {
        $select = "select  sol.fecha,sol.idAgenda_Solicitud,med.NombreMedico, es.NombreEspecialidad, ag.hora_inicio dia , concat(det.hora_inicio,' a ',det.hora_fin) hora, est.nombre, sol.notificado from agendasolicitud sol , agendadetalle det , agenda ag, especialidadmedicos esp, especialidad es, medicos med, paciente pac ,estadosolicitud est where sol.idAgenda_Detalle = det.idAgenda_Detalle and det.idAgenda = ag.idAgenda and ag.idEspecialidad_Medico = esp.idEspecialidadMedicos and esp.idEspecialidad = es.idEspecialidad and esp.idMedico = med.idMedico and sol.idPaciente = pac.idPaciente and sol.estado = est.idEstado_Solicitud and pac.idPaciente = " . $id;
        $query = $this->db->query($select);
        return $query;
    }

    function getSolicitudPacienteRut($rut)
    {
        $select = "select est.idEstado_Solicitud, pac.idPaciente,sol.fecha,sol.idAgenda_Solicitud,med.NombreMedico, es.NombreEspecialidad, ag.hora_inicio dia , concat(det.hora_inicio,' a ',det.hora_fin) hora, est.nombre, sol.notificado from agendasolicitud sol , agendadetalle det , agenda ag, especialidadmedicos esp, especialidad es, medicos med, paciente pac ,estadosolicitud est where sol.idAgenda_Detalle = det.idAgenda_Detalle and det.idAgenda = ag.idAgenda and ag.idEspecialidad_Medico = esp.idEspecialidadMedicos and esp.idEspecialidad = es.idEspecialidad and esp.idMedico = med.idMedico and sol.idPaciente = pac.idPaciente and sol.estado = est.idEstado_Solicitud and pac.RutPaciente = '" . $rut . "'";
        $query = $this->db->query($select);
        return $query;
    }

    function getHistorialSolicitud($id)
    {
        $select = "select  us.NombreUsuario , sol2.nombre nuevo, sol.nombre antiguo ,es.nombre , his.fecha from historialSolicitud his , estadoagenda es, estadosolicitud sol , estadosolicitud sol2, usuarios us where his.estado_detalle = es.idEstado_Agenda and his.estado_anterior = sol.idEstado_Solicitud and his.estado_nuevo = sol2.idEstado_Solicitud and his.usuario = us.idUsuario and his.idAgendaSolicitud = " . $id . " ORDER BY his.fecha DESC";
        $query = $this->db->query($select);
        return $query->result();
    }

    function getHistorialSolicitudPublico($id)
    {
        $select = "select  us.NombreUsuario , sol2.nombre nuevo, sol.nombre antiguo ,es.nombre , his.fecha from historialSolicitud his , estadoagenda es, estadosolicitud sol , estadosolicitud sol2, usuarios us where his.estado_detalle = es.idEstado_Agenda and his.estado_anterior = sol.idEstado_Solicitud and his.estado_nuevo = sol2.idEstado_Solicitud and his.usuario = us.idUsuario and his.idAgendaSolicitud = " . $id . " ORDER BY his.fecha DESC";
        $query = $this->db->query($select);
        return $query->result();
    }

    function addSolicitudHorarioPublico($idPaciente, $idDetalle)
    {
        $this->db->trans_begin();
        $select = "select count(*) cantidad from agendasolicitud  where
        idPaciente = " . $idPaciente . " and idAgenda_Detalle = " . $idDetalle . " and estado not in (3)";
        $resultado = $this->db->query($select);
        $cantidadTotal = $resultado->result()[0]->cantidad;
        if ($cantidadTotal == 0) {
            $select2 = "select estadoSolicitud from agendadetalle where idAgenda_Detalle = " . $idDetalle;
            //echo $select;
            $resultado2 = $this->db->query($select2);

            $estadoSolicitud = $resultado2->result()[0]->estadoSolicitud;

            $insert = "insert into agendasolicitud (idAgenda_Detalle,idPaciente,estado,notificado,fecha)
        values (" . $idDetalle . "," . $idPaciente . ",1,'N',now())";
            $this->db->query($insert);

            $select3 = "select MAX(idAgenda_Solicitud) id from agendasolicitud";
            //echo $select;
            $resultado3 = $this->db->query($select3);

            $idSolicitud = $resultado3->result()[0]->id;
            //return $query;

            $insertHistorial = "insert into historialSolicitud (idAgendaSolicitud,usuario ,estado_anterior, estado_nuevo,estado_detalle,fecha) values(" . $idSolicitud . ",99,6,1," . $estadoSolicitud . ",now())";
            $this->db->query($insertHistorial);
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return 0;
            } else {
                $this->db->trans_commit();
                return 1;
            }
        } else {
            return 3;
        }
    }

    function addSolicitudHorarioEspecialPublico($idDetalle, $nombre, $correo, $direccion, $telefono, $rut)
    {
        $this->db->trans_begin();
        $select = "select count(*) cantidad from agendasolicitud ag, paciente pac where
        ag.idPaciente = pac.idPaciente and pac.RutPaciente = '" . $rut . "' and ag.idAgenda_Detalle = " . $idDetalle . " and ag.estado not in (3)";
        $resultado = $this->db->query($select);
        $cantidadTotal = $resultado->result()[0]->cantidad;
        if ($cantidadTotal == 0) {
            $select = "select count(*) cantidad from paciente where RutPaciente = '" . $rut . "'";
            $resultado = $this->db->query($select);
            $cantidad = $resultado->result()[0]->cantidad;
            if ($cantidad == 0) {
                $insert = "insert into paciente (RutPaciente,
        NombrePaciente,
        DireccionPaciente,
        TelefonoPaciente,
        CorreoPaciente,
        RegionPaciente,
        CiudadPaciente
        ) values ('" . $rut . "','" . $nombre . "','" . $direccion . "','" . $telefono . "','" . $correo . "',1,1)";
                $query = $this->db->query($insert);


                $select2 = "select estadoSolicitud from agendadetalle where idAgenda_Detalle = " . $idDetalle;
                //echo $select;
                $resultado2 = $this->db->query($select2);

                $estadoSolicitud = $resultado2->result()[0]->estadoSolicitud;

                if ($query == 1) {
                    $select = "select MAX(idPaciente) id from paciente where RutPaciente = '" . $rut . "' ";
                    $query = $this->db->query($select);
                    $idPaciente = $query->result()[0]->id;

                    $insert2 = "insert into agendasolicitud (idAgenda_Detalle,idPaciente,estado,notificado,fecha)
        values (" . $idDetalle . "," . $idPaciente . ",1,'N',now())";
                    $this->db->query($insert2);

                    $select3 = "select MAX(idAgenda_Solicitud) id from agendasolicitud";
                    //echo $select;
                    $resultado3 = $this->db->query($select3);

                    $idSolicitud = $resultado3->result()[0]->id;
                    //return $query;

                    $insertHistorial = "insert into historialSolicitud (idAgendaSolicitud,usuario ,estado_anterior, estado_nuevo,estado_detalle,fecha) values(" . $idSolicitud . ",99,6,1," . $estadoSolicitud . ",now())";
                    $this->db->query($insertHistorial);
                } else {
                    return 0;
                }

                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    return 0;
                } else {
                    $this->db->trans_commit();
                    return 1;
                }
            } else {
                return 2;
            }
        } else {
            return 3;
        }
    }
}
