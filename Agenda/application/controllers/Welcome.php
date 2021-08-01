<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("indexModel");
    }

    public function eliminarSesion()
    {
        $user = $this->session->userdata("administrador");
        if ($this->session->userdata("administrador")) {
            $this->session->sess_destroy();
            $this->login();
        } else {
            echo "No tiene Privilegios Necesarios";
        }
    }

    public function index()
    {
        $this->load->view('welcome_message');
    }

    public function login()
    {
        $this->load->view('login');
    }

    public function menu()
    {

        if ($this->session->userdata("administrador")) {

            $this->load->view('menu');
        } else {
            echo "No tiene Privilegios Necesarios";
        }
    }

    public function AgendaPacientes()
    {
        $this->load->view('agendaPacientes');
    }

    public function ModuloAsignacion()
    {
        if (count($this->session->userdata("administrador")) > 0) {
            $this->load->view('moduloAsignacion');
        } else {
            echo "No tiene Privilegios Necesarios";
        }
    }

    public function ModuloEspecialidad()
    {
        $user = $this->session->userdata("administrador");
        if ($this->session->userdata("administrador")) {
            $this->load->view('moduloEspecialidad');
        } else {
            echo "No tiene Privilegios Necesarios";
        }
    }

    public function ModuloSolicitudes()
    {
        $user = $this->session->userdata("administrador");
        if ($this->session->userdata("administrador")) {
            $this->load->view('moduloSolicitudes');
        } else {
            echo "No tiene Privilegios Necesarios";
        }
    }

    public function ModuloMedico()
    {

        $user = $this->session->userdata("administrador");
        if ($this->session->userdata("administrador")) {
            $this->load->view('moduloMedicos');
        } else {
            echo "No tiene Privilegios Necesarios";
        }
    }

    public function getRegiones()
    {
        $user = $this->session->userdata("administrador");
        if ($this->session->userdata("administrador")) {
            echo json_encode($this->indexModel->getRegiones());
        } else {
            echo "No tiene Privilegios Necesarios";
        }
    }

    public function getProvincias()
    {
        $user = $this->session->userdata("administrador");
        if ($this->session->userdata("administrador")) {
            $region = $this->input->post("region");
            echo json_encode($this->indexModel->getProvincias($region));
        } else {
            echo "No tiene Privilegios Necesarios";
        }
    }

    public function getComunas()
    {
        $user = $this->session->userdata("administrador");
        if ($this->session->userdata("administrador")) {
            $provincia = $this->input->post("provincia");
            echo json_encode($this->indexModel->getComunas($provincia));
        } else {
            echo "No tiene Privilegios Necesarios";
        }
    }

    public function ModuloPacientes()
    {
        $user = $this->session->userdata("administrador");
        if ($this->session->userdata("administrador")) {
            $this->load->view('moduloPacientes');
        } else {
            echo "No tiene Privilegios Necesarios";
        }
    }

    public function Correo()
    {
        $user = $this->session->userdata("administrador");
        if ($this->session->userdata("administrador")) {
            $this->load->view('correo');
        } else {
            echo "No tiene Privilegios Necesarios";
        }
    }

    public function ModuloAgenda()
    {
        $user = $this->session->userdata("administrador");
        if ($this->session->userdata("administrador")) {
            $this->load->view('moduloAgenda');
        } else {
            echo "No tiene Privilegios Necesarios";
        }
    }

    public function getPacientes()
    {
        $user = $this->session->userdata("administrador");
        if ($this->session->userdata("administrador")) {
            $draw = intval($this->input->get("draw"));
            $start = intval($this->input->get("start"));
            $length = intval($this->input->get("length"));
            $books = $this->indexModel->getPacientes();
            $data = array();
            foreach ($books->result() as $r) {
                $estado = "";
                if ($r->estado == "1") {
                    $estado = '<button type="button" id="editarEstado" value="' . $r->id . ',2" class="btn btn-danger  btn-xs m-l-sm">Desactivar</button>';
                } else {
                    $estado = '<button type="button" id="editarEstado" value="' . $r->id . ',1" class="btn btn-info  btn-xs m-l-sm">Activar</button>';
                }
                $variable = explode("-", $r->rut);
                $rut = $variable[0];
                $rut = number_format($rut, 0, ".", ".");
                $dv = $variable[1];
                $rut = $rut . '-' . $dv;
                $sexo = "";
                if ($r->sexo == "M") {
                    $sexo = "Masculino";
                } else if ($r->sexo == "F") {
                    $sexo = "Femenino";
                } else if ($r->sexo == "O") {
                    $sexo = "Otro";
                }
                $data[] = array(
                    $r->id,
                    $rut,
                    $r->nombre,
                    $r->direccion,
                    $r->telefono,
                    $r->correo,
                    $sexo,
                    $r->region,
                    $r->comuna,
                    $estado,
                    '<button type="button" id="btnEditarPaciente" value="' . $r->id . ',' . $rut . ',' . $r->nombre . ',' . $r->direccion . ',' . $r->telefono . ',' . $r->correo . ',' . $r->region . ',' . $r->comuna . ',' . $r->RegionPaciente . ',' . $r->CiudadPaciente . ',' . $r->sexo . '" class="btn btn-info" data-toggle="modal" data-target="#modal-paciente"><i class="glyphicon glyphicon-pencil"></i></button>',
                    '<button type="button" id="btnVerSolicitud" value="' . $r->id . '" class="btn btn-info" data-toggle="modal" data-target="#solicitud-paciente"><i class="fa fa-bell"></i></button>'
                );
            }
            $output = array(
                "draw" => $draw,
                "recordsTotal" => $books->num_rows(),
                "recordsFiltered" => $books->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            echo "No tiene Privilegios Necesarios";
        }
    }

    public function editarPaciente()
    {
        $user = $this->session->userdata("administrador");
        if ($this->session->userdata("administrador")) {
            $id = $this->input->post("id");
            $estado = $this->input->post("estado");
            $resultado = $this->indexModel->editarPaciente($id, $estado);
            if ($resultado == "1") {
                echo json_encode(array("msg" => "ok"));
            } else {
                echo json_encode(array("msg" => "error"));
            }
        } else {
            echo "No tiene Privilegios Necesarios";
        }
    }

    public function IniciarSesion()
    {

        $usuario = $this->input->post("usuario");
        $clave = $this->input->post("clave");
        $user = $this->indexModel->inicio($usuario, $clave);
        if (count($user) > 0) {
            if ($user[0]->estado == 1) {
                $this->session->set_userdata("administrador", $user);
                echo json_encode(array("msg" => "administrador"));
            } else if ($user[0]->estado == 2) {
                echo json_encode(array("msg" => "inactivo"));
            } else {
                echo json_encode(array("msg" => "error"));
            }
        } else {
            echo json_encode(array("msg" => "nada"));
        }
    }

    public function addPaciente()
    {
        $user = $this->session->userdata("administrador");
        if ($this->session->userdata("administrador")) {
            $user = $this->session->userdata("administrador");
            $idAdministrador = $user[0]->idUsuario;
            $rut = $this->input->post("rut");
            $nombre = $this->input->post("nombre");
            $direccion = $this->input->post("direccion");
            $telefono = $this->input->post("telefono");
            $correo = $this->input->post("correo");
            $region = $this->input->post("region");
            $comuna = $this->input->post("comuna");
            $sexo = $this->input->post("sexo");
            $rut = str_replace(".", "", $rut);
            $resultado = $this->indexModel->addPaciente($rut, $nombre, $direccion, $telefono, $correo, $region, $comuna, $idAdministrador, $sexo);
            //echo $resultado;
            if ($resultado == "1") {
                echo json_encode(array("msg" => "ok"));
            } else  if ($resultado == "0") {
                echo json_encode(array("msg" => "error"));
            } else if ($resultado == "2") {
                echo json_encode(array("msg" => "duplicado"));
            }
        } else {
            echo "No tiene Privilegios Necesarios";
        }

        //;
    }

    public function editarDatosPaciente()
    {
        $user = $this->session->userdata("administrador");
        if ($this->session->userdata("administrador")) {
            $user = $this->session->userdata("administrador");
            $idAdministrador = $user[0]->idUsuario;
            $id = $this->input->post("id");
            $nombre = $this->input->post("nombre");
            $direccion = $this->input->post("direccion");
            $telefono = $this->input->post("telefono");
            $correo = $this->input->post("correo");
            $region = $this->input->post("region");
            $comuna = $this->input->post("comuna");
            $sexo = $this->input->post("sexo");

            //$region = $region == null ? "nada" : $region;
            //$comuna = $comuna == "Seleccione la Comuna" ? "nada" : $comuna;
            $resultado = $this->indexModel->editarDatosPaciente($id, $nombre, $direccion, $telefono, $correo, $region, $comuna, $idAdministrador, $sexo);
            if ($resultado == "1") {
                echo json_encode(array("msg" => "ok"));
            } else {
                echo json_encode(array("msg" => "error"));
            }
        } else {
            echo "No tiene Privilegios Necesarios";
        }
    }

    public function addEspecialidad()
    {
        $user = $this->session->userdata("administrador");
        if ($this->session->userdata("administrador")) {
            $user = $this->session->userdata("administrador");
            $idAdministrador = $user[0]->idUsuario;
            $nombre = $this->input->post("nombre");
            //echo $idAdministrador .'<br>';
            //echo $nombre .'<br>';
            $resultado = $this->indexModel->addEspecialidad($nombre, $idAdministrador);
            //echo $resultado;
            if ($resultado == "1") {
                echo json_encode(array("msg" => "ok"));
            } else {
                echo json_encode(array("msg" => "error"));
            }
        } else {
            echo "No tiene Privilegios Necesarios";
        }
    }

    public function editarDatosEspecialidad()
    {
        $user = $this->session->userdata("administrador");
        if ($this->session->userdata("administrador")) {
            $user = $this->session->userdata("administrador");
            $idAdministrador = $user[0]->idUsuario;
            $id = $this->input->post("id");
            $nombre = $this->input->post("nombre");
            $resultado = $this->indexModel->editarDatosEspecialidad($id, $nombre, $idAdministrador);
            if ($resultado == "1") {
                echo json_encode(array("msg" => "ok"));
            } else {
                echo json_encode(array("msg" => "error"));
            }
        } else {
            echo "No tiene Privilegios Necesarios";
        }
    }

    public function editarEspecialidad()
    {
        $user = $this->session->userdata("administrador");
        if ($this->session->userdata("administrador")) {
            $user = $this->session->userdata("administrador");
            $idAdministrador = $user[0]->idUsuario;
            $id = $this->input->post("id");
            $estado = $this->input->post("estado");
            $resultado = $this->indexModel->editarEspecialidad($id, $estado, $idAdministrador);
            if ($resultado == "1") {
                echo json_encode(array("msg" => "ok"));
            } else {
                echo json_encode(array("msg" => "error"));
            }
        } else {
            echo "No tiene Privilegios Necesarios";
        }
    }

    public function getEspecialidades()
    {
        $user = $this->session->userdata("administrador");
        if ($this->session->userdata("administrador")) {
            $draw = intval($this->input->get("draw"));
            $start = intval($this->input->get("start"));
            $length = intval($this->input->get("length"));
            $books = $this->indexModel->getEspecialidades();
            $data = array();
            foreach ($books->result() as $r) {
                $estado = "";
                if ($r->estado == "1") {
                    $estado = '<button type="button" id="editarEstado" value="' . $r->idEspecialidad . ',2" class="btn btn-danger btn-xs m-l-sm">Desactivar</button>';
                } else {
                    $estado = '<button type="button" id="editarEstado" value="' . $r->idEspecialidad . ',1" class="btn btn-info btn-xs m-l-sm">Activar</button>';
                }
                $data[] = array(
                    $r->idEspecialidad,
                    $r->NombreEspecialidad,
                    $estado,
                    '<button type="button" id="btnEditarEspecialidad" value="' . $r->idEspecialidad . ',' . $r->NombreEspecialidad . '" class="btn btn-info" data-toggle="modal" data-target="#modal-especialidad"><i class="glyphicon glyphicon-pencil"></i></button>'
                );
            }
            $output = array(
                "draw" => $draw,
                "recordsTotal" => $books->num_rows(),
                "recordsFiltered" => $books->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            echo "No tiene Privilegios Necesarios";
        }
    }

    public function editarDatosMedico()
    {
        $user = $this->session->userdata("administrador");
        if ($this->session->userdata("administrador")) {
            $user = $this->session->userdata("administrador");
            $idAdministrador = $user[0]->idUsuario;
            $id = $this->input->post("id");
            $nombre = $this->input->post("nombre");
            $direccion = $this->input->post("direccion");
            $telefono = $this->input->post("telefono");
            $correo = $this->input->post("correo");
            $region = $this->input->post("region");
            $comuna = $this->input->post("comuna");
            //$region = $region == null ? "nada" : $region;
            //$comuna = $comuna == "Seleccione la Comuna" ? "nada" : $comuna;
            $resultado = $this->indexModel->editarDatosMedico($id, $nombre, $direccion, $telefono, $correo, $region, $comuna, $idAdministrador);
            if ($resultado == "1") {
                echo json_encode(array("msg" => "ok"));
            } else {
                echo json_encode(array("msg" => "error"));
            }
        } else {
            echo "No tiene Privilegios Necesarios";
        }
    }

    public function editarMedico()
    {
        $user = $this->session->userdata("administrador");
        if ($this->session->userdata("administrador")) {
            $user = $this->session->userdata("administrador");
            $idAdministrador = $user[0]->idUsuario;
            $id = $this->input->post("id");
            $estado = $this->input->post("estado");
            $resultado = $this->indexModel->editarMedico($id, $estado, $idAdministrador);
            if ($resultado == "1") {
                echo json_encode(array("msg" => "ok"));
            } else {
                echo json_encode(array("msg" => "error"));
            }
        } else {
            echo "No tiene Privilegios Necesarios";
        }
    }

    public function getMedicos()
    {
        $user = $this->session->userdata("administrador");
        if ($this->session->userdata("administrador")) {
            $draw = intval($this->input->get("draw"));
            $start = intval($this->input->get("start"));
            $length = intval($this->input->get("length"));
            $books = $this->indexModel->getMedicos();
            $data = array();
            foreach ($books->result() as $r) {
                $estado = "";
                if ($r->estado == "1") {
                    $estado = '<button type="button" id="editarEstado" value="' . $r->id . ',2" class="btn btn-danger btn-xs m-l-sm">Desactivar</button>';
                } else {
                    $estado = '<button type="button" id="editarEstado" value="' . $r->id . ',1" class="btn btn-info btn-xs m-l-sm">Activar</button>';
                }
                $variable = explode("-", $r->rut);
                $rut = $variable[0];
                $rut = number_format($rut, 0, ".", ".");
                $dv = $variable[1];
                $rut = $rut . '-' . $dv;
                $data[] = array(
                    $r->id,
                    $rut,
                    $r->nombre,
                    $r->direccion,
                    $r->telefono,
                    $r->correo,
                    $r->region,
                    $r->comuna,
                    $estado,
                    '<button type="button" id="btnEditarPaciente" value="' . $r->id . ',' . $rut . ',' . $r->nombre . ',' . $r->direccion . ',' . $r->telefono . ',' . $r->correo . ',' . $r->region . ',' . $r->comuna . ',' . $r->RegionMedico . ',' . $r->CiudadMedico . '" class="btn btn-info" data-toggle="modal" data-target="#modal-paciente"><i class="glyphicon glyphicon-pencil"></i></button>'
                );
            }
            $output = array(
                "draw" => $draw,
                "recordsTotal" => $books->num_rows(),
                "recordsFiltered" => $books->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            echo "No tiene Privilegios Necesarios";
        }
    }

    public function getAgenda()
    {
        $user = $this->session->userdata("administrador");
        if ($this->session->userdata("administrador")) {
            $draw = intval($this->input->get("draw"));
            $start = intval($this->input->get("start"));
            $length = intval($this->input->get("length"));
            $books = $this->indexModel->getAgenda();
            $data = array();
            foreach ($books->result() as $r) {
                $estado = "";
                if ($r->estado == "1") {
                    $estado = '<button type="button" id="editarEstado" value="' . $r->id . ',2" class="btn btn-danger btn-xs m-l-sm">Desactivar</button>';
                } else {
                    $estado = '<button type="button" id="editarEstado" value="' . $r->id . ',1" class="btn btn-info btn-xs m-l-sm">Activar</button>';
                }
                $variable = explode(" ", $r->fin);
                $hora_fin = " " . $variable[1];
                $variable = explode(" ", $r->inicio);
                $hora_inicio = " " . $variable[1];
                $variable = explode('-', $variable[0]);
                $dia_inicio = $variable[2] . '-' . $variable[1] . '-' . $variable[0];
                $data[] = array(
                    $r->id,
                    $r->medico,
                    $r->especialidad,
                    $dia_inicio . $hora_inicio,
                    $dia_inicio . $hora_fin,
                    $r->tiempo . " Min.",
                    $estado,
                    '<button type="button" id="btnModalAgenda" value="' . $r->id . ',' . $dia_inicio . ',' . $hora_fin . ',' . $hora_fin . '" class="btn btn-info" data-toggle="modal" data-target="#modal-detalle-agenda"><i class="glyphicon glyphicon-pencil"></i></button>'
                );
            }
            $output = array(
                "draw" => $draw,
                "recordsTotal" => $books->num_rows(),
                "recordsFiltered" => $books->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            echo "No tiene Privilegios Necesarios";
        }
    }

    public function editarAgenda()
    {
        $user = $this->session->userdata("administrador");
        if ($this->session->userdata("administrador")) {
            $user = $this->session->userdata("administrador");
            $idAdministrador = $user[0]->idUsuario;
            $id = $this->input->post("id");
            $estado = $this->input->post("estado");
            $resultado = $this->indexModel->editarAgenda($id, $estado, $idAdministrador);
            if ($resultado == "1") {
                echo json_encode(array("msg" => "ok"));
            } else {
                echo json_encode(array("msg" => "error"));
            }
        } else {
            echo "No tiene Privilegios Necesarios";
        }
    }

    public function editarAgendaDetalle()
    {
        $user = $this->session->userdata("administrador");
        if ($this->session->userdata("administrador")) {
            $user = $this->session->userdata("administrador");
            $idAdministrador = $user[0]->idUsuario;
            $id = $this->input->post("id");
            $estado = $this->input->post("estado");
            $resultado = $this->indexModel->editarAgendaDetalle($id, $estado, $idAdministrador);
            if ($resultado == "1") {
                echo json_encode(array("msg" => "ok"));
            } else {
                echo json_encode(array("msg" => "error"));
            }
        } else {
            echo "No tiene Privilegios Necesarios";
        }
    }

    public function getDetalleAgenda()
    {
        $user = $this->session->userdata("administrador");
        if ($this->session->userdata("administrador")) {
            $id = $this->input->post("id");
            echo json_encode($this->indexModel->getDetalleAgenda($id));
        } else {
            echo "No tiene Privilegios Necesarios";
        }
    }

    public function getMedicosAsignacion()
    {
        $user = $this->session->userdata("administrador");
        if ($this->session->userdata("administrador")) {
            echo json_encode($this->indexModel->getMedicosAsignacion());
        } else {
            echo "No tiene Privilegios Necesarios";
        }
    }

    public function getEspecialidadesMedico()
    {
        $user = $this->session->userdata("administrador");
        if ($this->session->userdata("administrador")) {
            echo json_encode($this->indexModel->getEspecialidadesMedico());
        } else {
            echo "No tiene Privilegios Necesarios";
        }
    }

    public function getMedicosSelect()
    {
        $user = $this->session->userdata("administrador");
        if ($this->session->userdata("administrador")) {
            echo json_encode($this->indexModel->getMedicosSelect());
        } else {
            echo "No tiene Privilegios Necesarios";
        }
    }

    public function asignacionXmedico()
    {
        $user = $this->session->userdata("administrador");
        if ($this->session->userdata("administrador")) {
            $id = $this->input->post("id");
            echo json_encode($this->indexModel->asignacionXmedico($id));
        } else {
            echo "No tiene Privilegios Necesarios";
        }
    }

    public function getEspecialidadesSelectMedico()
    {
        $user = $this->session->userdata("administrador");
        if ($this->session->userdata("administrador")) {
            $id = $this->input->post("id");
            echo json_encode($this->indexModel->getEspecialidadesSelectMedico($id));
        } else {
            echo "No tiene Privilegios Necesarios";
        }
    }

    public function addAgenda()
    {
        $user = $this->session->userdata("administrador");
        if ($this->session->userdata("administrador")) {
            $user = $this->session->userdata("administrador");
            $idAdministrador = $user[0]->idUsuario;
            $especialidad = $this->input->post("especialidad");
            $inicio = $this->input->post("inicio");
            $fin = $this->input->post("fin");
            $estado = $this->input->post("estado");
            $resultado = $this->indexModel->addAgenda($idAdministrador, $especialidad, $inicio, $fin, $estado);
            if ($resultado == "1") {
                echo json_encode(array("msg" => "ok"));
            } else {
                echo json_encode(array("msg" => "error"));
            }
        } else {
            echo "No tiene Privilegios Necesarios";
        }
    }

    public function getEstadoAgenda()
    {
        $user = $this->session->userdata("administrador");
        if ($this->session->userdata("administrador")) {
            echo json_encode($this->indexModel->getEstadoAgenda());
        } else {
            echo "No tiene Privilegios Necesarios";
        }
    }

    public function editarEstadoAgenda()
    {
        $user = $this->session->userdata("administrador");
        if ($this->session->userdata("administrador")) {
            $user = $this->session->userdata("administrador");
            $idAdministrador = $user[0]->idUsuario;
            $id = $this->input->post("id");
            $estado = $this->input->post("estado");
            $resultado = $this->indexModel->editarEstadoAgenda($idAdministrador, $id, $estado);
            if ($resultado == "1") {
                echo json_encode(array("msg" => "ok"));
            } else {
                echo json_encode(array("msg" => "error"));
            }
        } else {
            echo "No tiene Privilegios Necesarios";
        }
    }

    public function addEspecialidadMedico()
    {
        $user = $this->session->userdata("administrador");
        if ($this->session->userdata("administrador")) {
            $user = $this->session->userdata("administrador");
            $idAdministrador = $user[0]->idUsuario;
            $idMedico = $this->input->post("idMedico");
            $idEspecialidad = $this->input->post("idEspecialidad");
            $tiempo = $this->input->post("tiempo");
            $resultado = $this->indexModel->addEspecialidadMedico($idMedico, $idEspecialidad, $tiempo, $idAdministrador);
            if ($resultado == "1") {
                echo json_encode(array("msg" => "ok"));
            } else if ($resultado == "existe") {
                echo json_encode(array("msg" => "existe"));
            } else {
                echo json_encode(array("msg" => "error"));
            }
        } else {
            echo "No tiene Privilegios Necesarios";
        }
    }

    public function editarEspecialidadMedico()
    {
        $user = $this->session->userdata("administrador");
        if ($this->session->userdata("administrador")) {
            $user = $this->session->userdata("administrador");
            $idAdministrador = $user[0]->idUsuario;
            $id = $this->input->post("id");
            $estado = $this->input->post("estado");
            $resultado = $this->indexModel->editarEspecialidadMedico($id, $estado, $idAdministrador);
            if ($resultado == "1") {
                echo json_encode(array("msg" => "ok"));
            } else {
                echo json_encode(array("msg" => "error"));
            }
        } else {
            echo "No tiene Privilegios Necesarios";
        }
    }

    public function addMedico()
    {
        $user = $this->session->userdata("administrador");
        if ($this->session->userdata("administrador")) {
            $user = $this->session->userdata("administrador");
            $idAdministrador = $user[0]->idUsuario;
            $rut = $this->input->post("rut");
            $nombre = $this->input->post("nombre");
            $direccion = $this->input->post("direccion");
            $telefono = $this->input->post("telefono");
            $correo = $this->input->post("correo");
            $region = $this->input->post("region");
            $comuna = $this->input->post("comuna");
            $rut = str_replace(".", "", $rut);
            $resultado = $this->indexModel->addMedico($rut, $nombre, $direccion, $telefono, $correo, $region, $comuna, $idAdministrador);
            //echo $resultado;
            if ($resultado == "2") {
                echo json_encode(array("msg" => "duplicado"));
            } else  if ($resultado == "1") {
                echo json_encode(array("msg" => "ok"));
            } else {
                echo json_encode(array("msg" => "error"));
            }
        } else {
            echo "No tiene Privilegios Necesarios";
        }
    }





    public function getHistorialSolicitud()
    {
        $user = $this->session->userdata("administrador");
        if ($this->session->userdata("administrador")) {
            $id = $this->input->post("id");
            echo json_encode($this->indexModel->getHistorialSolicitud($id));
        } else {
            echo "No tiene Privilegios Necesarios";
        }
    }

    public function getHistorialSolicitudPublico()
    {

        $id = $this->input->post("id");
        echo json_encode($this->indexModel->getHistorialSolicitudPublico($id));
    }



    public function getSolicitudes()
    {
        $user = $this->session->userdata("administrador");
        if ($this->session->userdata("administrador")) {
            $draw = intval($this->input->get("draw"));
            $start = intval($this->input->get("start"));
            $length = intval($this->input->get("length"));
            $id = $this->input->get("id");
            $books = $this->indexModel->getSolicitudes($id);
            $data = array();
            foreach ($books->result() as $r) {

                $data[] = array(
                    $r->RutPaciente,
                    $r->NombrePaciente,
                    $r->CorreoPaciente,
                    $r->notificado == "N" ? "No" : "Si",
                    $r->estado,
                    $r->fecha,
                    "<button id='aceptarSolicitud' value='" . $r->idAgenda_Solicitud . "," . $r->idPaciente . "' class='btn btn-info  btn-xs m-l-sm'>Aceptar</button><button id='rechazarSolicitud' value='" . $r->idAgenda_Solicitud . "," . $r->idPaciente . "' class='btn btn-danger  btn-xs m-l-sm'>Rechazar</button><button id='esperaSolicitud' value='" . $r->idAgenda_Solicitud . "," . $r->idPaciente . "' class='btn btn-green  btn-xs m-l-sm'>En Espera</button>"
                );
            }
            $output = array(
                "draw" => $draw,
                "recordsTotal" => $books->num_rows(),
                "recordsFiltered" => $books->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            echo "No tiene Privilegios Necesarios";
        }
    }

    public function getSolicitudPacienteRut()
    {

        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $rut = $this->input->get("rut");
        $rut = str_replace(".", "", $rut);
        $books = $this->indexModel->getSolicitudPacienteRut($rut);
        $data = array();
        foreach ($books->result() as $r) {
            $variable = explode(" ", $r->dia);
            $variable = explode("-", $variable[0]);
            $dia = $variable[2] . '-' . $variable[1] . '-' . $variable[0];

            $variable = explode(" ", $r->fecha);
            $hora = " " . $variable[1];
            $variable = explode(" ", $r->fecha);
            $variable = explode('-', $variable[0]);
            $dia_fecha = $variable[2] . '-' . $variable[1] . '-' . $variable[0];
            $btnFinal = "";
            if ($r->idEstado_Solicitud != 4) {
                $btnFinal = "<button id='cancelarSolicitud' value='" . $r->idAgenda_Solicitud . "," . $r->idPaciente . "' class='btn btn-danger btn-xs m-l-sm'>Anular</button>";
            }
            $data[] = array(
                $r->NombreMedico,
                $r->NombreEspecialidad,
                $dia,
                $r->hora,
                $dia_fecha . $hora,
                $r->nombre,
                $r->notificado == "N" ? "No" : "Si",
                "<button id='historialSolicitud' value='" . $r->idAgenda_Solicitud . "' class='btn btn-info  btn-xs m-l-sm'>Historial</button>",
                $btnFinal

            );
        }
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $books->num_rows(),
            "recordsFiltered" => $books->num_rows(),
            "data" => $data
        );
        echo json_encode($output);
        exit();
    }

    public function getSolicitudPaciente()
    {
        $user = $this->session->userdata("administrador");
        if ($this->session->userdata("administrador")) {
            $draw = intval($this->input->get("draw"));
            $start = intval($this->input->get("start"));
            $length = intval($this->input->get("length"));
            $id = $this->input->get("id");
            $books = $this->indexModel->getSolicitudPaciente($id);
            $data = array();
            foreach ($books->result() as $r) {
                $variable = explode(" ", $r->dia);
                $variable = explode("-", $variable[0]);
                $dia = $variable[2] . '-' . $variable[1] . '-' . $variable[0];

                $variable = explode(" ", $r->fecha);
                $hora = " " . $variable[1];
                $variable = explode(" ", $r->fecha);
                $variable = explode('-', $variable[0]);
                $dia_fecha = $variable[2] . '-' . $variable[1] . '-' . $variable[0];
                $data[] = array(
                    $r->NombreMedico,
                    $r->NombreEspecialidad,
                    $dia,
                    $r->hora,
                    $dia_fecha . $hora,
                    $r->nombre,
                    $r->notificado == "N" ? "No" : "Si",
                    "<button id='historialSolicitud' value='" . $r->idAgenda_Solicitud . "' class='btn btn-info  btn-xs m-l-sm'>Historial</button>"
                );
            }
            $output = array(
                "draw" => $draw,
                "recordsTotal" => $books->num_rows(),
                "recordsFiltered" => $books->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            echo "No tiene Privilegios Necesarios";
        }
    }

    public function Anulacion()
    {

        $id = $this->input->get("id");
        $estado = $this->input->get("estado");
        $detalle = $this->input->get("idDetalle");
        $idPaciente = $this->input->get("idPaciente");
        $this->indexModel->Anulacion($id, $estado, $detalle, $idPaciente);
        $this->load->view('anulacion');
    }


    public function editarSolicitud()
    {
        $user = $this->session->userdata("administrador");
        if ($this->session->userdata("administrador")) {
            $resultados = $this->input->post("resultado");
            if ($resultados == "anular") {
                // echo "paso";
                $id = $this->input->post("id");
                $idPaciente = $this->input->post("paciente");
                $resultado = $this->indexModel->editarSolicitud($id, $resultados, "", $idPaciente);
                $resultado = explode(",", $resultado);
                // $resultado = "1";
                if ($resultado[0] == "1") {


                    $datos = $this->indexModel->getCorreoPaciente($idPaciente, $id);
                    $datos = explode(",", $datos);
                    $correo = $datos[0];
                    $nombre = $datos[1];
                    $hora_inicio = $datos[2];
                    $hora_fin = $datos[3];
                    $dia = $datos[4];
                    /*
                    echo $correo.'<br>';
                    echo $nombre.'<br>';
                    echo $hora_fin.'<br>';
                    echo $hora_fin.'<br>';
                    */
                    $mensaje = "Para el día " . $dia . " desde las " . $hora_inicio . " hasta las " . $hora_fin . ". <br> Esta seguro que desea continuar? ";
                    $to = $correo . ' , contacto@vitades.cl';
                    $subject = "Solicitud Anulacion de hora medica: " . $nombre;
                    $message = '<!DOCTYPE html>
                <html lang="en">
                
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                </head>
                <body>
                    <div style="height: 450px; width: 400px; ">
                        <img src="https://www.vitades.cl/Agenda/lib/img/Logo.png" style="width: 400px; padding-top:20px" alt="">
                        <p style="padding: 10px; font-family: Verdana;">Buenos días, ' . $nombre . ' este correo es para confirmar la anulación su solicitud: <br><br>
                        ' . $mensaje . '. <br><br>
                            <br><a href="https://www.vitades.cl/Agenda/Anulacion?id=' . $resultado[1] . '&estado=2&idDetalle=' . $id . '&idPaciente=' . $idPaciente . '" style="background-color: red; padding:7px; color: white;">Anular Hora</a> <a href="https://www.vitades.cl/Agenda/Anulacion?id=' . $resultado[1] . '&estado=3&idDetalle=' . $id . '&idPaciente=' . $idPaciente . '" style="background-color: blue; padding:7px; color: white;">No Anular</a><br><br>
                            Recuerde que si no realiza la confirmación, la solicitud puede ser rechazada por Vitades.
                            <br>  Telefonos: (73)2215 177 - (73)2218 887<br>
                            Favor no responder a este mensaje.
                        </p>
                    </div>
                </body>
                </html>';
                    $header = 'MIME-Version: 1.0' . "\r\n";
                    $header .= "Content-type: text/html; charset=utf-8";
                    // $header .= ' Content-type: text/html; charset=utf-8' . "\r\n";
                    $resultado = mail($to, $subject, $message, $header);
                    if ($resultado) {
                        $resultado = $this->indexModel->editarSolicitudNotificado($id);
                        if ($resultado == 1) {
                            echo json_encode(array("msg" => "ok"));
                        } else {
                            echo json_encode(array("msg" => "error"));
                        }
                    } else {
                        echo json_encode(array("msg" => "errorcorreo"));
                    }
                } else {
                    echo json_encode(array("msg" => "error"));
                }
            } else {
                $user = $this->session->userdata("administrador");
                $idAdministrador = $user[0]->idUsuario;
                $id = $this->input->post("id");
                $idPaciente = $this->input->post("paciente");
                $resultado = $this->indexModel->editarSolicitud($id, $resultados, $idAdministrador, $idPaciente);
                //echo $resultado;
                if ($resultado == "1") {
                    $datos = $this->indexModel->getCorreoPaciente($idPaciente, $id);
                    $datos = explode(",", $datos);
                    $correo = $datos[0];
                    $nombre = $datos[1];
                    $hora_inicio = $datos[2];
                    $hora_fin = $datos[3];
                    $dia = $datos[4];

                    //editarSolicitudNotificado

                    if ($resultados == "aceptar") {
                        $mensaje = "Su hora para el día " . $dia . " desde las " . $hora_inicio . " hasta las " . $hora_fin . " fue Aceptada. <br> Favor llegar 10 minutos antes de la hora indicada.";
                        $to = $correo . ' , contacto@vitades.cl';
                        $subject = "Solicitud hora medica APROBADA: " . $nombre;
                        $message = '<!DOCTYPE html>
                <html lang="en">
                
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                </head>
                <body>
                    <div style="height: 450px; width: 400px; ">
                        <img src="https://www.vitades.cl/Agenda/lib/img/Logo.png" style="width: 400px; padding-top:20px" alt="">
                        <p style="padding: 10px; font-family: Verdana;">Buenos días, ' . $nombre . ' este correo es para confirmar su solicitud: <br><br>
                        ' . $mensaje . ' <br><br>
                            <br>  Telefonos: (73)2215 177 - (73)2218 887<br>
                            Favor no responder a este mensaje.
                        </p>
                    </div>
                </body>
                </html>';
                        $header = 'MIME-Version: 1.0' . "\r\n";
                        $header .= "Content-type: text/html; charset=utf-8";
                        // $header .= ' Content-type: text/html; charset=utf-8' . "\r\n";
                        $resultado = mail($to, $subject, $message, $header);
                        if ($resultado) {
                            $resultado = $this->indexModel->editarSolicitudNotificado($id);
                            if ($resultado == 1) {
                                echo json_encode(array("msg" => "ok"));
                            } else {
                                echo json_encode(array("msg" => "error"));
                            }
                        } else {
                            echo json_encode(array("msg" => "errorcorreo"));
                        }
                    } else if ($resultados == "rechazar") {
                        $mensaje = "Su hora para el día " . $dia . " desde las " . $hora_inicio . " hasta las " . $hora_fin . " fue Rechazada. <br>";
                        $to = $correo . ' , contacto@vitades.cl';
                        $subject = "Solicitud hora medica RECHAZADA: " . $nombre;
                        $message = '<!DOCTYPE html>
                    <html lang="en">
                    
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    </head>
                    <body>
                        <div style="height: 450px; width: 400px; ">
                            <img src="https://www.vitades.cl/Agenda/lib/img/Logo.png" style="width: 400px; padding-top:20px" alt="">
                            <p style="padding: 10px; font-family: Verdana;">Buenos días, ' . $nombre . ' este correo es para confirmar su solicitud: <br><br>
                            ' . $mensaje . '. <br><br>
                                                            <br>  Telefonos: (73)2215 177 - (73)2218 887<br>
                                Favor no responder a este mensaje.
                            </p>
                        </div>
                    </body>
                    </html>';
                        $header = 'MIME-Version: 1.0' . "\r\n";
                        $header .= "Content-type: text/html; charset=utf-8";
                        // $header .= ' Content-type: text/html; charset=utf-8' . "\r\n";
                        $resultado = mail($to, $subject, $message, $header);
                        if ($resultado) {
                            $resultado = $this->indexModel->editarSolicitudNotificado($id);
                            if ($resultado == 1) {
                                echo json_encode(array("msg" => "ok"));
                            } else {
                                echo json_encode(array("msg" => "errors"));
                            }
                        } else {
                            echo json_encode(array("msg" => "errorcorreo"));
                        }
                    } else if ($resultados == "espera") {
                        $mensaje = "Su hora para el día " . $dia . " desde las " . $hora_inicio . " hasta las " . $hora_fin . " se encuentra EN ESPERA. <br>";
                        $to = $correo . ' , contacto@vitades.cl';
                        $subject = "Solicitud hora medica EN ESPERA: " . $nombre;
                        $message = '<!DOCTYPE html>
                    <html lang="en">
                    
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    </head>
                    <body>
                        <div style="height: 450px; width: 400px; ">
                            <img src="https://www.vitades.cl/Agenda/lib/img/Logo.png" style="width: 400px; padding-top:20px" alt="">
                            <p style="padding: 10px; font-family: Verdana;">Buenos días, ' . $nombre . ' este correo es para informar que: <br><br>
                            ' . $mensaje . ' <br><br>
                                                            <br>
                                                            Telefonos: (73)2215 177 - (73)2218 887<br>
                                Favor no responder a este mensaje.
                            </p>
                        </div>
                    </body>
                    </html>';
                        $header = 'MIME-Version: 1.0' . "\r\n";
                        $header .= "Content-type: text/html; charset=utf-8";
                        // $header .= ' Content-type: text/html; charset=utf-8' . "\r\n";
                        $resultado = mail($to, $subject, $message, $header);
                        if ($resultado) {
                            $resultado = $this->indexModel->editarSolicitudNotificado($id);
                            if ($resultado == 1) {
                                echo json_encode(array("msg" => "ok"));
                            } else {
                                echo json_encode(array("msg" => "errors"));
                            }
                        } else {
                            echo json_encode(array("msg" => "errorcorreo"));
                        }
                    }
                } else {
                    echo json_encode(array("msg" => "error"));
                }
            }
        } else {
            echo "No tiene Privilegios Necesarios";
        }
    }

    public function editarSolicitudPublico()
    {

        $resultados = $this->input->post("resultado");
        if ($resultados == "anular") {
            // echo "paso";
            $id = $this->input->post("id");
            $idPaciente = $this->input->post("paciente");
            $resultado = $this->indexModel->editarSolicitudPublico($id, $resultados, "", $idPaciente);
            $resultado = explode(",", $resultado);
            // $resultado = "1";
            if ($resultado[0] == "1") {


                $datos = $this->indexModel->getCorreoPaciente($idPaciente, $id);
                $datos = explode(",", $datos);
                $correo = $datos[0];
                $nombre = $datos[1];
                $hora_inicio = $datos[2];
                $hora_fin = $datos[3];
                $dia = $datos[4];
                /*
                    echo $correo.'<br>';
                    echo $nombre.'<br>';
                    echo $hora_fin.'<br>';
                    echo $hora_fin.'<br>';
                    */
                $mensaje = "Para el día " . $dia . " desde las " . $hora_inicio . " hasta las " . $hora_fin . ". <br> Esta seguro que desea continuar? ";
                $to = $correo . ' , contacto@vitades.cl';
                $subject = "Solicitud Anulacion de hora medica: " . $nombre;
                $message = '<!DOCTYPE html>
                <html lang="en">
                
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                </head>
                <body>
                    <div style="height: 450px; width: 400px; ">
                        <img src="https://www.vitades.cl/Agenda/lib/img/Logo.png" style="width: 400px; padding-top:20px" alt="">
                        <p style="padding: 10px; font-family: Verdana;">Buenos días, ' . $nombre . ' este correo es para confirmar la anulación su solicitud: <br><br>
                        ' . $mensaje . '. <br><br>
                            <br><a href="https://www.vitades.cl/Agenda/Anulacion?id=' . $resultado[1] . '&estado=2&idDetalle=' . $id . '&idPaciente=' . $idPaciente . '" style="background-color: red; padding:7px; color: white;">Anular Hora</a> <a href="https://www.vitades.cl/Agenda/Anulacion?id=' . $resultado[1] . '&estado=3&idDetalle=' . $id . '&idPaciente=' . $idPaciente . '" style="background-color: blue; padding:7px; color: white;">No Anular</a><br><br>
                            Recuerde que si no realiza la confirmación, la solicitud puede ser rechazada por Vitades.
                            <br>  Telefonos: (73)2215 177 - (73)2218 887<br>
                            Favor no responder a este mensaje.
                        </p>
                    </div>
                </body>
                </html>';
                $header = 'MIME-Version: 1.0' . "\r\n";
                $header .= "Content-type: text/html; charset=utf-8";
                // $header .= ' Content-type: text/html; charset=utf-8' . "\r\n";
                $resultado = mail($to, $subject, $message, $header);
                if ($resultado) {
                    $resultado = $this->indexModel->editarSolicitudNotificado($id);
                    if ($resultado == 1) {
                        echo json_encode(array("msg" => "ok"));
                    } else {
                        echo json_encode(array("msg" => "error"));
                    }
                } else {
                    echo json_encode(array("msg" => "errorcorreo"));
                }
            } else {
                echo json_encode(array("msg" => "error"));
            }
        } else {
            $user = $this->session->userdata("administrador");
            $idAdministrador = $user[0]->idUsuario;
            $id = $this->input->post("id");
            $idPaciente = $this->input->post("paciente");
            $resultado = $this->indexModel->editarSolicitudPublico($id, $resultados, $idAdministrador, $idPaciente);
            //echo $resultado;
            if ($resultado == "1") {
                $datos = $this->indexModel->getCorreoPaciente($idPaciente, $id);
                $datos = explode(",", $datos);
                $correo = $datos[0];
                $nombre = $datos[1];
                $hora_inicio = $datos[2];
                $hora_fin = $datos[3];
                $dia = $datos[4];

                //editarSolicitudNotificado

                if ($resultados == "aceptar") {
                    $mensaje = "Su hora para el día " . $dia . " desde las " . $hora_inicio . " hasta las " . $hora_fin . " fue Aceptada. <br> Favor llegar 10 minutos antes de la hora indicada.";
                    $to = $correo . ' , contacto@vitades.cl';
                    $subject = "Solicitud hora medica APROBADA: " . $nombre;
                    $message = '<!DOCTYPE html>
                <html lang="en">
                
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                </head>
                <body>
                    <div style="height: 450px; width: 400px; ">
                        <img src="https://www.vitades.cl/Agenda/lib/img/Logo.png" style="width: 400px; padding-top:20px" alt="">
                        <p style="padding: 10px; font-family: Verdana;">Buenos días, ' . $nombre . ' este correo es para confirmar su solicitud: <br><br>
                        ' . $mensaje . ' <br><br>
                            <br>  Telefonos: (73)2215 177 - (73)2218 887<br>
                            Favor no responder a este mensaje.
                        </p>
                    </div>
                </body>
                </html>';
                    $header = 'MIME-Version: 1.0' . "\r\n";
                    $header .= "Content-type: text/html; charset=utf-8";
                    // $header .= ' Content-type: text/html; charset=utf-8' . "\r\n";
                    $resultado = mail($to, $subject, $message, $header);
                    if ($resultado) {
                        $resultado = $this->indexModel->editarSolicitudNotificado($id);
                        if ($resultado == 1) {
                            echo json_encode(array("msg" => "ok"));
                        } else {
                            echo json_encode(array("msg" => "error"));
                        }
                    } else {
                        echo json_encode(array("msg" => "errorcorreo"));
                    }
                } else if ($resultados == "rechazar") {
                    $mensaje = "Su hora para el día " . $dia . " desde las " . $hora_inicio . " hasta las " . $hora_fin . " fue Rechazada. <br>";
                    $to = $correo . ' , contacto@vitades.cl';
                    $subject = "Solicitud hora medica RECHAZADA: " . $nombre;
                    $message = '<!DOCTYPE html>
                    <html lang="en">
                    
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    </head>
                    <body>
                        <div style="height: 450px; width: 400px; ">
                            <img src="https://www.vitades.cl/Agenda/lib/img/Logo.png" style="width: 400px; padding-top:20px" alt="">
                            <p style="padding: 10px; font-family: Verdana;">Buenos días, ' . $nombre . ' este correo es para confirmar su solicitud: <br><br>
                            ' . $mensaje . '. <br><br>
                                                            <br>  Telefonos: (73)2215 177 - (73)2218 887<br>
                                Favor no responder a este mensaje.
                            </p>
                        </div>
                    </body>
                    </html>';
                    $header = 'MIME-Version: 1.0' . "\r\n";
                    $header .= "Content-type: text/html; charset=utf-8";
                    // $header .= ' Content-type: text/html; charset=utf-8' . "\r\n";
                    $resultado = mail($to, $subject, $message, $header);
                    if ($resultado) {
                        $resultado = $this->indexModel->editarSolicitudNotificado($id);
                        if ($resultado == 1) {
                            echo json_encode(array("msg" => "ok"));
                        } else {
                            echo json_encode(array("msg" => "errors"));
                        }
                    } else {
                        echo json_encode(array("msg" => "errorcorreo"));
                    }
                } else if ($resultados == "espera") {
                    $mensaje = "Su hora para el día " . $dia . " desde las " . $hora_inicio . " hasta las " . $hora_fin . " se encuentra EN ESPERA. <br>";
                    $to = $correo . ' , contacto@vitades.cl';
                    $subject = "Solicitud hora medica EN ESPERA: " . $nombre;
                    $message = '<!DOCTYPE html>
                    <html lang="en">
                    
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    </head>
                    <body>
                        <div style="height: 450px; width: 400px; ">
                            <img src="https://www.vitades.cl/Agenda/lib/img/Logo.png" style="width: 400px; padding-top:20px" alt="">
                            <p style="padding: 10px; font-family: Verdana;">Buenos días, ' . $nombre . ' este correo es para informar que: <br><br>
                            ' . $mensaje . ' <br><br>
                                                            <br>
                                                            Telefonos: (73)2215 177 - (73)2218 887<br>
                                Favor no responder a este mensaje.
                            </p>
                        </div>
                    </body>
                    </html>';
                    $header = 'MIME-Version: 1.0' . "\r\n";
                    $header .= "Content-type: text/html; charset=utf-8";
                    // $header .= ' Content-type: text/html; charset=utf-8' . "\r\n";
                    $resultado = mail($to, $subject, $message, $header);
                    if ($resultado) {
                        $resultado = $this->indexModel->editarSolicitudNotificado($id);
                        if ($resultado == 1) {
                            echo json_encode(array("msg" => "ok"));
                        } else {
                            echo json_encode(array("msg" => "errors"));
                        }
                    } else {
                        echo json_encode(array("msg" => "errorcorreo"));
                    }
                }
            } else {
                echo json_encode(array("msg" => "error"));
            }
        }
    }

    public function addSolicitudHorario()
    {
        $user = $this->session->userdata("administrador");
        if ($this->session->userdata("administrador")) {
            $idPaciente = $this->input->post("idPaciente");
            $idDetalle = $this->input->post("idDetalle");
            $correo = $this->input->post("correo");
            $nombre = $this->input->post("nombre");
            $mensaje = $this->input->post("mensaje");
            $resultado = $this->indexModel->addSolicitudHorario($idPaciente, $idDetalle);
            if ($resultado == "3") {
                echo json_encode(array("msg" => "doble"));
            } else if ($resultado == "1") {
                $to = $correo . ' , contacto@vitades.cl';
                $subject = "Solicitud hora medica: " . $nombre;
                $message = '<!DOCTYPE html>
            <html lang="en">
            
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
            </head>
            <body>
                <div style="height: 450px; width: 400px; ">
                    <img src="https://www.vitades.cl/Agenda/lib/img/Logo.png" style="width: 400px; padding-top:20px" alt="">
                    <p style="padding: 10px; font-family: Verdana;">Buenos días, ' . $nombre . ' este correo es para confirmar su solicitud: <br><br>
                    ' . $mensaje . '. <br><br>
                    Nos comunicaremos con usted por este mismo medio, para confirmar la hora.
                    <br>
                        Telefonos: (73)2215 177 - (73)2218 887
                    <br>
                    Favor no responder a este mensaje.
                    </p>
                </div>
            </body>
            </html>';
                $header = 'MIME-Version: 1.0' . "\r\n";
                $header .= "Content-type: text/html; charset=utf-8";
                // $header .= ' Content-type: text/html; charset=utf-8' . "\r\n";
                $resultado = mail($to, $subject, $message, $header);
                if ($resultado) {
                    echo json_encode(array("msg" => "ok"));
                } else {
                    echo json_encode(array("msg" => "error"));
                }
            } else {
                echo json_encode(array("msg" => "error"));
            }
        } else {
            echo "No tiene Privilegios Necesarios";
        }
    }

    public function addSolicitudHorarioEspecial()
    {
        $user = $this->session->userdata("administrador");
        if ($this->session->userdata("administrador")) {
            $idDetalle = $this->input->post("idDetalle");
            $nombre = $this->input->post("nombre");
            $correo = $this->input->post("correo");
            $direccion = $this->input->post("direccion");
            $telefono = $this->input->post("telefono");
            $rut = $this->input->post("rut");
            $rut = str_replace(".", "", $rut);
            $mensaje = $this->input->post("mensaje");
            $resultado = $this->indexModel->addSolicitudHorarioEspecial($idDetalle, $nombre, $correo, $direccion, $telefono, $rut);
            if ($resultado == "3") {
                echo json_encode(array("msg" => "doble"));
            } else if ($resultado == "2") {
                echo json_encode(array("msg" => "duplicado"));
            } else        if ($resultado == "1") {
                $to = $correo . ' , contacto@vitades.cl';
                $subject = "Solicitud hora medica: " . $nombre;
                $message = '<!DOCTYPE html>
            <html lang="en">
            
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
            </head>
            <body>
                <div style="height: 450px; width: 400px; ">
                    <img src="https://www.vitades.cl/Agenda/lib/img/Logo.png" style="width: 400px; padding-top:20px" alt="">
                    <p style="padding: 10px; font-family: Verdana;">Buenos días, ' . $nombre . ' este correo es para confirmar su solicitud: <br><br>
                    ' . $mensaje . '. <br><br>
                        Nos comunicaremos con usted por este mismo medio, para confirmar la hora.
                        <br>
                            Telefonos: (73)2215 177 - (73)2218 887
                        <br>
                        Favor no responder a este mensaje.
                    </p>
                </div>
            </body>
            </html>';
                $header = 'MIME-Version: 1.0' . "\r\n";
                $header .= "Content-type: text/html; charset=utf-8";
                // $header .= ' Content-type: text/html; charset=utf-8' . "\r\n";
                $resultado = mail($to, $subject, $message, $header);
                if ($resultado) {
                    echo json_encode(array("msg" => "ok"));
                } else {
                    echo json_encode(array("msg" => "error"));
                }
            } else {
                echo json_encode(array("msg" => "error"));
            }
        } else {
            echo "No tiene Privilegios Necesarios";
        }
    }


    public function getMedicosPublico()
    {
        $id = $this->input->post("id");
        echo json_encode($this->indexModel->getMedicosPublico($id));
    }

    public function consultarAgenda()
    {
        $id = $this->input->post("id");
        $resultado = $this->indexModel->consultarAgenda($id);
        if ($resultado == 0) {
            echo json_encode(array("msg" => "error"));
        } else {
            echo json_encode($this->indexModel->consultarAgenda($id));
        }
    }

    public function getDatosPaciente()
    {
        $rut = $this->input->post("rut");
        $rut = str_replace(".", "", $rut);
        $resultado = $this->indexModel->getDatosPaciente($rut);
        if ($resultado == "Paciente no registrado.") {
            echo json_encode(array("msg" => "error"));
        } else {
            echo json_encode($this->indexModel->getDatosPaciente($rut));
        }
    }

    public function addSolicitudHorarioPublico()
    {
        $idPaciente = $this->input->post("idPaciente");
        $idDetalle = $this->input->post("idDetalle");
        $correo = $this->input->post("correo");
        $nombre = $this->input->post("nombre");
        $mensaje = $this->input->post("mensaje");
        $resultado = $this->indexModel->addSolicitudHorarioPublico($idPaciente, $idDetalle);

        if ($resultado == "3") {
            echo json_encode(array("msg" => "doble"));
        } else if ($resultado == "1") {
            $to = $correo . ' , contacto@vitades.cl';
            $subject = "Solicitud hora medica: " . $nombre;
            $message = '<!DOCTYPE html>
            <html lang="en">
            
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
            </head>
            <body>
                <div style="height: 450px; width: 400px; ">
                    <img src="https://www.vitades.cl/Agenda/lib/img/Logo.png" style="width: 400px; padding-top:20px" alt="">
                    <p style="padding: 10px; font-family: Verdana;">Buenos días, ' . $nombre . ' este correo es para confirmar su solicitud: <br><br>
                    ' . $mensaje . '. <br><br>
                    Nos comunicaremos con usted por este mismo medio, para confirmar la hora.
                    <br>
                        Telefonos: (73)2215 177 - (73)2218 887
                    <br>
                    Favor no responder a este mensaje.
                    </p>
                </div>
            </body>
            </html>';
            $header = 'MIME-Version: 1.0' . "\r\n";
            $header .= "Content-type: text/html; charset=utf-8";
            // $header .= ' Content-type: text/html; charset=utf-8' . "\r\n";
            $resultado = mail($to, $subject, $message, $header);
            if ($resultado) {
                echo json_encode(array("msg" => "ok"));
            } else {
                echo json_encode(array("msg" => "error"));
            }
        } else {
            echo json_encode(array("msg" => "error"));
        }
    }

    public function addSolicitudHorarioEspecialPublico()
    {
        $idDetalle = $this->input->post("idDetalle");
        $nombre = $this->input->post("nombre");
        $correo = $this->input->post("correo");
        $direccion = $this->input->post("direccion");
        $telefono = $this->input->post("telefono");
        $rut = $this->input->post("rut");
        $rut = str_replace(".", "", $rut);
        $mensaje = $this->input->post("mensaje");
        $resultado = $this->indexModel->addSolicitudHorarioEspecialPublico($idDetalle, $nombre, $correo, $direccion, $telefono, $rut);
        if ($resultado == "3") {
            echo json_encode(array("msg" => "doble"));
        } else if ($resultado == "2") {
            echo json_encode(array("msg" => "duplicado"));
        } else        if ($resultado == "1") {
            $to = $correo . ' , contacto@vitades.cl';
            $subject = "Solicitud hora medica: " . $nombre;
            $message = '<!DOCTYPE html>
            <html lang="en">
            
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
            </head>
            <body>
                <div style="height: 450px; width: 400px; ">
                    <img src="https://www.vitades.cl/Agenda/lib/img/Logo.png" style="width: 400px; padding-top:20px" alt="">
                    <p style="padding: 10px; font-family: Verdana;">Buenos días, ' . $nombre . ' este correo es para confirmar su solicitud: <br><br>
                    ' . $mensaje . '. <br><br>
                        Nos comunicaremos con usted por este mismo medio, para confirmar la hora.
                        <br>
                            Telefonos: (73)2215 177 - (73)2218 887
                        <br>
                        Favor no responder a este mensaje.
                    </p>
                </div>
            </body>
            </html>';
            $header = 'MIME-Version: 1.0' . "\r\n";
            $header .= "Content-type: text/html; charset=utf-8";
            // $header .= ' Content-type: text/html; charset=utf-8' . "\r\n";
            $resultado = mail($to, $subject, $message, $header);
            if ($resultado) {
                echo json_encode(array("msg" => "ok"));
            } else {
                echo json_encode(array("msg" => "error"));
            }
        } else {
            echo json_encode(array("msg" => "error"));
        }
    }

    public function getEspecialidadesPublico()
    {
        echo json_encode($this->indexModel->getEspecialidadesPublico());
    }
}
