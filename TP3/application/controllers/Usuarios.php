<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once __DIR__.'/AuthController.php';

class Usuarios extends AuthController {

    protected $sinLogin = [
        'registrar',
        'nuevo_usuario',
        'validar_email',
        'login',
        'iniciar_sesion'
    ];

    public function __construct()
    {
        parent::__construct();
        $this->load->model('usuarios_model','usuario');
    }

    public function index() {
        echo 'holis';
    }

    public function registrar(){
        $this->load->view('registro');
    }

    public function modificar() {
        $user = $this->usuario->getUsuarioById($this->session->userdata('id'));
        $this->load->view('registro',['user' => $user]);
    }

    public function modificar_datos() {
        $this->usuario->editarUsuario($this->input->post());
        redirect('principal');
    }

    public function nuevo_usuario(){

        //obtiene las variables que se enviar por el formulario de registro via metodo POST
        $email = $this->input->post('email');

        //valida el email que no exista antes de insertar
        $arr_usuario=$this->usuario->getUsuarioByMail($email);
        if(count($arr_usuario)>0){

            $data = array(
                'warning' => true,
                'message' => 'Ya existe un usuario registrado con el correo ingresado'
            );

            $this->load->view('registro',['user' => $data, 'error' => 'Ya existe ese mail']);
        }else{
            $resul=$this->usuario->nuevoUsuario($this->input->post());
            //si el resultado del insert retorno true, quiere decir que se agrego correctamente el usuario
            if($resul==true){

                $data = array(
                    'success' => true,
                    'message' => 'Usuario registrado correctamente'
                );

                $this->load->view('login',$data);

            }else{

                $data = array(
                    'error' => true,
                    'message' => 'Error al intentar registrar el usuario'
                );

                $this->load->view('registro',$data);
            }

        }


    }

    public function validar_email(){

        //obtiene las variables que se enviar por el formulario de registro via metodo POST
        $email = $this->input->get('mail');

        //carga el modelo de usuarios y ejecuta el metodo para insertar un usuario en la DB


        $arr_usuario=$this->usuario->getUsuarioByMail($email);
        if(count($arr_usuario)>0){

            $data = array(
                'success' => false,
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

    public function login() {
        $this->load->view('login');
    }

    public function iniciar_sesion(){

        $user = $this->usuario->getUserLogin($this->input->post('mail'), $this->input->post('password'));

        if(!$user) {
            $data = ['error' => 'Mail o contraseña incorrectos!'];
            $this->load->view('login', $data);
            return null;
        }

        $arr_datos_usr = array(
            'id'  => $user['id'],
            'mail'  => $user['mail'],
            'nombre'     => $user['nombre'] . ' ' . $user['apellido'],
            'login' => true
        );

        //guarda en sesion los datos del usuario
        $this->session->set_userdata($arr_datos_usr);

        redirect('principal');



//        //si se quiere agregar un nuevo dato en sesion se podría hacer de esta forma:
//        $this->session->set_userdata('apellido', 'Gimenez');

    }

    public function cerrar_sesion(){

        //elimina todos los datos de la sesion actual
        session_destroy();
        $this->load->view('login');

        //tambien se puede usar el siguiente metodo que cumple la misma funcion
        //$this->session->sess_destroy();

    }

//    public function test_imprimir_sesion(){
//        print_r($this->session->all_userdata());
//    }
//
//    public function test_get_datos_sesion(){
//
//        if($this->session->has_userdata('logeado')){
//            //obtiene una variable llamada 'item' guardada en la sesión
//            $nombre_usuario=$this->session->userdata('nombre_usuario');
//            print_r($nombre_usuario);
//        }
//
//
//    }



}