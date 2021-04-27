<?php

class Listas_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function crearLista($nombre, $idUsuario) {
        $this->db->insert('lista_cabeceras', [
            'nombre' => $nombre,
            'id_usuario' => $idUsuario]);

        return $this->db->insert_id();
    }

    public function agregarVideoLista($idLista, $idVideo) {
        $this->db->insert('lista_detalles', [
            'id_cabecera' => $idLista,
            'id_video' => $idVideo]);

        return $this->db->insert_id();
    }
    public function eliminarVideoLista($idLista, $idVideo) {
        $this->db->delete('lista_detalles', [
            'id_cabecera' => $idLista,
            'id_video' => $idVideo]);

        return true;
    }

    public function getListasUsuario($idUsuario) {
        $sql = "SELECT lc.id, lc.nombre, ld.id_video
            FROM lista_cabeceras lc
            LEFT JOIN lista_detalles ld on lc.id = ld.id_cabecera
            WHERE lc.id_usuario = ?
            ORDER BY lc.id";

        $listas = [];
        $lista = null;
        $query = $this->db->query($sql, [$idUsuario]);
        if($query) {
            foreach($query->result_array() as $l) {
                if($lista == null || $lista['id'] != $l['id']) {
                    if($lista != null) {
                        $listas[] = $lista;
                    }
                    $lista = [
                        'id' => $l['id'],
                        'nombre' => $l['nombre'],
                        'videos' => []
                    ];
                }
                if($l['id_video']) {
                    $lista['videos'][] = $l['id_video'];
                }
            }
            if($lista != null) $listas[] = $lista;
        }

        return $listas;
    }
}
