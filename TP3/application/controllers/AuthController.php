<?php
defined('BASEPATH') OR exit('No direct script access allowed');

abstract class AuthController extends CI_Controller {

    protected $sinLogin = [];

    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        if (!$this->session->userdata('login')) {
            if (!in_array($this->router->fetch_method(), $this->sinLogin)) {
                redirect('/usuarios/login');
            }
        }
    }

}