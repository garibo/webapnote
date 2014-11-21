<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Profile extends CI_Model {

	public function __construct(){ 
		parent::__construct();
		$this->load->database('default');
	}

	public function obtenerInformacion($email){
		$this->db->select('u_email,u_username, u_nombre, u_apep, u_apem, u_photo');
		$this->db->from('CI_USUARIOS');
		$this->db->where('CI_USUARIOS.u_email', $email);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->first_row();
		}else{
			return null;
		}
	}

	public function update($email, $nombre, $apep, $apem){
		$data = array(
			'u_nombre' => $nombre, 
			'u_apep' => $apep,
			'u_apem' => $apem
			);
		$this->db->where('u_email', $email);
		return $this->db->update('CI_USUARIOS', $data);
	}


	public function obtenerCategorias(){
		$query = $this->db->get('CI_CATEGORIAS');
		if($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return NULL;
		}
	}

	public function agregarCategoriaPerfil($email, $idcat){
		$data = array(
			'id_category' => $idcat,
			'u_email' => $email
			);
		return $this->db->insert('CI_DETALLE_USUARIO', $data);
	}

	public function obtenerCategoria($id){
		$this->db->where('id_category', $id);
		$query = $this->db->get('CI_CATEGORIAS');
		if($query->num_rows == 1){
			return $query->row();
		}else {
			return false;
		}
	}

	public function obtenerCatsxuser(){
		$email = $this->session->userdata('u_email');

		$this->db->select('CI_CATEGORIAS.cat_name AS cat_name');
		$this->db->from('CI_DETALLE_USUARIO, CI_CATEGORIAS');
		$this->db->where('CI_DETALLE_USUARIO.id_category = CI_CATEGORIAS.id_category');
		$this->db->where('CI_DETALLE_USUARIO.u_email', $email);
		$this->db->limit(3);
		$query = $this->db->get();
		if($query->num_rows > 0){
			return $query->result_array();
		}else{
			return false;
		}
	}

}