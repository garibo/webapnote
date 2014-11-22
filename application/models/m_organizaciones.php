<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class M_Organizaciones extends CI_Model {

	public function __construct() {
		parent::__construct();
		//$this->load->database('default');
		$this->load->database('production');
	}

	// Obtener Organizaciones ;
	public function addOrg(){
		$email = $this->session->userdata('u_email');
		$this->db->where('u_email', $email);
		$query = $this->db->get('CI_COMPANY');
		if($query->num_rows() > 0){
			return $query->result_array();
		}else{ 
			return NULL;
		}
	}

	// Clases de las Organizaciones - Get
	public function mdl_clases(){
		$query = $this->db->get('CI_CLASE');
		if($query->num_rows() > 0) {
			return $query->result_array();
		}else{
			return NULL;
		}
	}

	public function addTeam($rfc){
		$this->db->select('CI_USUARIOS.u_username AS user, CI_USUARIOS.u_nombre AS nombre, CI_USUARIOS.u_apep AS apep, CI_USUARIOS.u_apem AS apem, CI_USUARIOS.u_email AS email');
		$this->db->from('CI_USUARIOS, CI_DETALLE_COMPANY');
		$this->db->where('CI_USUARIOS.u_email = CI_DETALLE_COMPANY.u_email');
		$this->db->where('CI_DETALLE_COMPANY.c_rfc', $rfc);
		$query = $this->db->get();
		if($query->num_rows() > 0) {
			return $query->result_array();
		}else{
			return NULL;
		}
	}

	public function viewTeamU($user) {
		$this->db->where('u_username', $user);
		$query = $this->db->get('CI_USUARIOS');
		if($query->num_rows() > 0) {
			return $query->first_row('array');
		}else{
			return NULL;
		}
	}

	public function deleteTU($user){
		$this->db->where('u_email', $user);
		$this->db->delete('CI_DETALLE_COMPANY');
		$this->db->where('u_email', $user);
		$this->db->delete('CI_DETALLE_USUARIO');
		$this->db->where('u_email', $user);
		return $this->db->delete('CI_USUARIOS');
	}

	public function userdelVerification($user){
		$this->db->select('CI_DETALLE_PROYASIGN.c_detalle_proy_id AS Proyectos');
		$this->db->from('CI_USUARIOS, CI_DETALLE_PROYASIGN');
		$this->db->where('CI_USUARIOS.u_email = CI_DETALLE_PROYASIGN.u_email');
		$this->db->where('CI_USUARIOS.u_username', $user);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

	public function iAddTeam($email, $user, $nombre, $apep, $apem, $pass, $rol, $org){
		$data = array(
			'u_email' => $email,
			'u_username' => $user, 
			'u_nombre' => $nombre, 
			'u_apep' => $apep, 
			'u_apem' => $apem,
			'u_password' => $pass,
			'r_id' => $rol
		);

		$this->db->insert('CI_USUARIOS', $data);
		$data = array(
			'u_email' => $email, 
			'u_user' => $user,
			'c_rfc' => $org
		);

		return $this->db->insert('CI_DETALLE_COMPANY', $data);
	}

	public function getOrg($rfc) {
		$this->db->where('c_rfc', $rfc);
		$query = $this->db->get('CI_COMPANY');
		if($query->num_rows() > 0){
			return $query->first_row('array');
		}else{
			return NULL;
		}
	}

	// Agregar nueva Organización ;
	public function insertOrg($rfc, $name, $phone, $des, $clas){
		$email = $this->session->userdata('u_email');
		$data = array(
			'c_rfc' => $rfc,
			'c_name' => $name, 
			'c_descri' => $des, 
			'c_phone' => $phone, 
			'u_email' => $email,
			'id_clase' => $clas
		);

		return $this->db->insert('CI_COMPANY', $data);
	}

	public function deleteOrg($rfc){
		$this->db->where('c_rfc', $rfc);
		return $this->db->delete('CI_COMPANY');
	}

	public function checkOrg($rfc){
		$this->db->where('c_rfc', $rfc);
		$query = $this->db->get('CI_DETALLE_COMPANY');
		if($query->num_rows() == 0){
			return true;
		}else {
			return false;
		}
	}

	public function checkProjOrg($rfc){
		$this->db->where('c_rfc', $rfc);
		$query = $this->db->get('CI_PROYECTOS');
		if($query->num_rows() == 0){
			return true;
		}else{
			return false;
		}
	}

	public function updateInfo($rfc, $name, $phone, $des){
		$data = array (
			'c_name' => $name, 
			'c_phone' => $phone, 
			'c_descri' => $des
		);
		$this->db->where('c_rfc', $rfc);
		return $this->db->update('CI_COMPANY',$data);
	}

}