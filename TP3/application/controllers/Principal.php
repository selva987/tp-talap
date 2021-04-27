<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once __DIR__.'/AuthController.php';

class Principal extends AuthController {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('usuarios_model', 'usuario');
        $this->load->model('listas_model', 'lista');
    }

    public function index(){
        $listas = $this->lista->getListasUsuario($this->session->userdata('id'));
        $this->load->view('principal', [
            'listas' => $listas,
            'userdata' => $this->session->all_userdata(),
        ]);
    }

    public function crearLista() {
        if($this->input->get('titulo')) {
            $idLista = $this->lista->crearLista($this->input->get('titulo'), $this->session->userdata('id'));
            if($idLista) {
                echo json_encode(['ok' => true, 'id' => $idLista]);
            }
        }
    }

    public function agregarVideoLista() {
        if($this->input->get('idVideo') && $this->input->get('idLista')) {
            if($this->lista->agregarVideoLista($this->input->get('idLista'), $this->input->get('idVideo'))) {
                echo json_encode(['ok' => true]);
            } else {
                echo json_encode(['ok' => false]);
            }
            return;
        }
    }

    public function eliminarVideoLista() {
        if($this->input->get('idVideo') && $this->input->get('idLista')) {
            if($this->lista->eliminarVideoLista($this->input->get('idLista'), $this->input->get('idVideo'))) {
                echo json_encode(['ok' => true]);
            } else {
                echo json_encode(['ok' => false]);
            }
            return;
        }
    }

    public function getVideos() {

        if($this->input->get('terminos')) {
            $params = [
                'q' => $this->input->get('terminos'),
                'key' => YOUTUBE_API_KEY,
                'part' => 'id'
            ];
            if($this->input->get('token')) {
                $params['pageToken'] = $this->input->get('token');
            }

            $ch = curl_init(YOUTUBE_SEARCH_BASE_URL . http_build_query($params));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);

            if($result) {
                $json = json_decode($result);
                if($json) {
                    echo json_encode($this->parseBusqueda($json));
                    return;
                }
            }
            echo json_encode(['ok' => false, 'error' => 'Error desconocido']);
            return;

        } else {
            echo json_encode(['ok' => false, 'error' => 'Sin parametros']);
            return;
        }
    }

    private function parseBusqueda($json) {
        $search = [
            'ok' => true,
            'next' => $json->nextPageToken,
            'results' => []
        ];
        foreach($json->items as $v) {
            $search['results'][] = $v->id->videoId;
        }

        return $search;
    }


}