<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Dashboard extends CI_Model {
	
	public function __construct(){
		parent::__construct();
		$this->load->database('default');
		//$this->load->database('production');
	}

	/******************************
	Función para obtener usuarios de las diferentes organizaciones
	******************************/
	public function getAllUsers(){
		$creator = $this->session->userdata('email');
		$this->db->select('CI_USUARIOS.u_username AS Username');
		$this->db->from('CI_USUARIOS, CI_COMPANY, CI_DETALLE_COMPANY');
		$this->db->where('CI_DETALLE_COMPANY.c_rfc = CI_COMPANY.c_rfc');
		$this->db->where('CI_COMPANY.u_email', $creator);
		$this->db->group_by('Username');
		$query = $this->db->get();
		return $query->num_rows();
	}

	/******************************
	Función para obtener total de organizaciones
	******************************/
	public function getAllOrganizations(){
		$creator = $this->session->userdata('email');
		$this->db->select('COUNT(*) AS Organizaciones');
		$this->db->from('CI_COMPANY');
		$this->db->where('CI_COMPANY.u_email', $creator);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->first_row();
		}else{
			return 0;
		}
	}

	/******************************
	Función para obtener total de organizaciones
	******************************/
	public function getAllProjects(){
		$creator = $this->session->userdata('email');
		$this->db->select('COUNT(*) AS Proyectos');
		$this->db->from('CI_COMPANY, CI_PROYECTOS');
		$this->db->where('CI_PROYECTOS.c_rfc = CI_COMPANY.c_rfc');
		$this->db->where('CI_COMPANY.u_email', $creator);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->first_row();
		}else{
			return 0;
		}
	}

	/******************************
	Función para obtener total de imagenes alojadas.
	******************************/
	public function getAllImages(){
		$creator = $this->session->userdata('email');
		$this->db->select('COUNT(*) AS Imagenes');
		$this->db->from('CI_PROYECTOS, CI_DETALLE_PROYTAREAS, CI_IMAGES, CI_COMPANY');
		$this->db->where('CI_PROYECTOS.c_proy_id = CI_DETALLE_PROYTAREAS.c_proy_id');
		$this->db->where('CI_DETALLE_PROYTAREAS.ci_tarea_id = CI_IMAGES.c_tarea_id');
		$this->db->where('CI_COMPANY.c_rfc = CI_PROYECTOS.c_rfc');
		$this->db->where('CI_COMPANY.u_email', $creator);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->first_row();
		}else{
			return 0;
		}
	}

}