<?php

class Usuarios_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function getUsuarioByMail($mail) {
        $sql = "SELECT * FROM usuarios WHERE mail = ?";

        $data = [$mail];
        if($this->session->userdata('id')) {
            $sql .= " AND id <> ?";
            $data[] = $this->session->userdata('id');
        }

        $query = $this->db->query($sql, $data);

        return $query->result_array();
    }

    public function getUsuarioById($id) {
        $sql = "SELECT *, DATE_FORMAT(fecha_nacimiento, '%d/%m/%Y') fecha_nacimiento FROM usuarios WHERE id = ?";

        $query = $this->db->query($sql, array($id));

        return $query->row_array();
    }

    public function editarUsuario($data) {
        if($data['fecha_nacimiento']) {
            $fechaNacimiento = implode('-', array_reverse(explode('/', $data['fecha_nacimiento'])));
        }

        $userData = [
            $data['mail'],
            hash('sha256', $data['password']),
            $data['nombre'],
            $data['apellido'],
            $data['genero'],
            $data['telefono'],
            $fechaNacimiento ?? null,
            $data['pagina_web'],
            $data['id_ciudad'],
            $data['direccion'],
            $data['altura'],
            $data['latitud'],
            $data['longitud'],
            $this->session->userdata('id'),
        ];

        if($data['password']) {
            $pass = 'password = ?,';
        } else {
            $pass = 'password=password, /*?*/';
        }

        $sql = "UPDATE usuarios SET 
            mail = ?,
            $pass
            nombre = ?,
            apellido = ?,
            genero = ?,
            telefono = ?,
            fecha_nacimiento = ?,
            pagina_web = ?,
            id_ciudad = ?,
            direccion = ?,
            altura = ?,
            latitud = ?,
            longitud = ?
            WHERE id = ?";

        return $this->db->query($sql, $userData);
    }

    public function nuevoUsuario($data) {
        if($data['fecha_nacimiento']) {
            $fechaNacimiento = implode('-', array_reverse(explode('/', $data['fecha_nacimiento'])));
        }
        $userData = [
            $data['mail'],
            hash('sha256', $data['password']),
            $data['nombre'],
            $data['apellido'],
            $data['genero'],
            $data['telefono'],
            $fechaNacimiento ?? null,
            $data['pagina_web'],
            $data['id_ciudad'],
            $data['direccion'],
            $data['altura'],
            $data['latitud'],
            $data['longitud'],
        ];

        $sql = "INSERT INTO usuarios SET 
            mail = ?,
            password = ?,
            nombre = ?,
            apellido = ?,
            genero = ?,
            telefono = ?,
            fecha_nacimiento = ?,
            pagina_web = ?,
            id_ciudad = ?,
            direccion = ?,
            altura = ?,
            latitud = ?,
            longitud = ?";

        return $this->db->query($sql, $userData);
    }

    public function getUserLogin($mail, $password) {
        $sql = "SELECT id, mail, nombre, apellido
            FROM usuarios WHERE mail = ? AND password = ?";

        $arr = [$mail, hash('sha256', $password)];

        $query = $this->db->query($sql, $arr);
        if($query) {
            $return = $query->result_array();
            return $return[0];
        }
        else return false;
    }


}
