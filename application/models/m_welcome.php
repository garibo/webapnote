<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Welcome extends CI_Model {

	public function __construct(){
		parent::__construct();
		//$this->load->database('default');
		$this->load->database('production');
	}

	public function addUsuario($nombre, $username, $email, $passw){
		$data = array (
			'u_email' => $email,
			'u_username' => $username, 
			'u_nombre' => $nombre, 
			'u_password' => $passw,
			'r_id' => 1
		);

		return $this->db->insert('CI_USUARIOS', $data);
	}

	public function addCurrentLogs($email){
		$this->db->select('u_loggins');
		$this->db->from('CI_USUARIOS');
		$this->db->where('CI_USUARIOS.u_email', $email);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->first_row();
		}else{
			return null;
		}
	}

	public function updateCurrentLogs($email, $logs){
		$data = array(
			'u_loggins' => $logs);
		$this->db->where('u_email', $email);
		return $this->db->update('CI_USUARIOS', $data);
	}

	public function signIn($email, $pass){
		$this->db->where('u_email', $email);
		$this->db->where('u_password', $pass);
		$this->db->where('u_status', 1);
		$sign = $this->db->get('CI_USUARIOS');
		if($sign->num_rows() == 1){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function signAuth($email, $pass){
		$this->db->where('u_email', $email);
		$this->db->where('u_password', $pass);
		$auth = $this->db->get('CI_USUARIOS');
		if($auth->num_rows() == 1){
			return $auth->row();
		}else {
			return FALSE;
		}
	}

}