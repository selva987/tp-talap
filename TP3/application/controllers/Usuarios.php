<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

    public function index() {
        echo 'holis';
    }

    public function registrar(){
        $this->load->view('registro');
    }

    public function nuevo_usuario(){

        //obtiene las variables que se enviar por el formulario de registro via metodo POST
        $email = $this->input->post('email');
        $nombre = $this->input->post('nombre');
        $apellido = $this->input->post('apellido');

        //carga el modelo de usuarios y ejecuta el metodo para insertar un usuario en la DB
        $this->load->model('usuarios_model','usuario');

        //valida el email que no exista antes de insertar
        $arr_usuario=$this->usuario->get_usuario_by_email($email);
        if(count($arr_usuario)>0){

            $data = array(
                'warning' => true,
                'message' => 'Ya existe un usuario registrado con el correo ingresado'
            );

            $this->load->view('formulario_registro',$data);
        }else{
            $resul=$this->usuario->nuevo_usuario($email,$nombre,$apellido);
            //si el resultado del insert retorno true, quiere decir que se agrego correctamente el usuario
            if($resul==true){

                $data = array(
                    'success' => true,
                    'message' => 'Usuario registrado correctamente'
                );

                $this->load->view('formulario_login',$data);

            }else{

                $data = array(
                    'error' => true,
                    'message' => 'Error al intentar registrar el usuario'
                );

                $this->load->view('formulario_registro',$data);
            }

        }


    }

    public function validar_email(){

        //obtiene las variables que se enviar por el formulario de registro via metodo POST
        $email = $this->input->post('email');

        //carga el modelo de usuarios y ejecuta el metodo para insertar un usuario en la DB
        $this->load->model('usuarios_model','usuario');

        $arr_usuario=$this->usuario->get_usuario_by_email($email);
        if(count($arr_usuario)>0){

            $data = array(
                'warning' => true,
                'message' => 'Ya existe un usuario registrado con el correo ingresado'
            );

        }else{

            $data = array(
                'success' => true,
                'message' => 'Correo v&aacute;lido'
            );
        }

        echo json_encode($data);

    }

    public function iniciar_sesion(){

        //TODO:
        //Habria que validar con una consulta en la base de datos de que el usuario exista.
        //Es decir que el email y el passord coincidan.
        //Si los datos coinciden guardar los datos del usuario en sesion

        $arr_datos_usr = array(
            'nombre_usuario'  => 'SusanitaGimenez',
            'email'     => 'su@ssusana.com',
            'logeado' => TRUE
        );

        //guarda en sesion los datos del usuario
        $this->session->set_userdata($arr_datos_usr);

        //si se quiere agregar un nuevo dato en sesion se podría hacer de esta forma:
        $this->session->set_userdata('apellido', 'Gimenez');

    }

    public function cerrar_sesion(){

        //elimina todos los datos de la sesion actual
        session_destroy();

        //tambien se puede usar el siguiente metodo que cumple la misma funcion
        //$this->session->sess_destroy();

    }

    public function test_imprimir_sesion(){
        print_r($this->session->all_userdata());
    }

    public function test_get_datos_sesion(){

        if($this->session->has_userdata('logeado')){
            //obtiene una variable llamada 'item' guardada en la sesión
            $nombre_usuario=$this->session->userdata('nombre_usuario');
            print_r($nombre_usuario);
        }


    }



}