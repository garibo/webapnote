<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Proyectos extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->database('default');
		//$this->load->database('production');
	}

	public function obtenerOrganizaciones(){
		$email = $this->session->userdata('u_email');
		$this->db->where('u_email', $email);
		$query = $this->db->get('CI_COMPANY');
		if($query->num_rows() > 0){
			return $query->result_array();
		}else{ 
			return NULL;
		}
	}

	public function obtenerOrganizacion($rfc){
		$this->db->where('c_rfc', $rfc);
		$query = $this->db->get('CI_COMPANY');
		if($query->num_rows() > 0){
			return $query->first_row('array');
		}else{
			return null;
		}
	}

	public function loadProyectos($rfc){
		$this->db->where('c_rfc', $rfc);
		$query = $this->db->get('CI_PROYECTOS');
		if($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return NULL;
		}
	}

	public function agregarProyecto($rfc, $name, $des, $cat) {
		$data = array(
			'c_proy_name' => $name, 
			'c_proy_descri' => $des,
			'c_rfc' => $rfc, 
			'id_category' => $cat
			);
		$this->db->trans_start();
		$this->db->insert('CI_PROYECTOS', $data);
		$insert_id = $this->db->insert_id();
		$this->db->trans_complete();
		return $insert_id;
	}

	public function asignarProyecto($email, $id){
		$data = array(
			'c_proy_id' => $id, 
			'u_email' => $email
			);

		return $this->db->insert('CI_DETALLE_PROYASIGN', $data);
	}

	public function obtenerCategorias(){
		$query = $this->db->get('CI_CATEGORIAS');
		if($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return NULL;
		}
	}

	public function obtenerCategoriaslimit($number, $start=0){
		$this->db->limit($number,$start);
		$query = $this->db->get('CI_CATEGORIAS');
		if($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return NULL;
		}
	}

	public function nuevaCategoria($nombre) {
		$data = array(
			'cat_name' => $nombre
			);
		return $this->db->insert('CI_CATEGORIAS', $data);
	}

	public function get_categories_count(){
		$query = $this->db->get('CI_CATEGORIAS');
		return $query->num_rows();
	}

	public function obtenerResponsableCat($category, $rfc){
		$this->db->select('CI_USUARIOS.u_email AS u_email, CI_USUARIOS.u_nombre AS u_nombre, CI_USUARIOS.u_apep AS u_apep, CI_USUARIOS.u_apem AS u_apem');
		$this->db->from('CI_DETALLE_USUARIO, CI_USUARIOS, CI_DETALLE_COMPANY');
		$this->db->where('CI_DETALLE_USUARIO.u_email = CI_USUARIOS.u_email');
		$this->db->where('CI_DETALLE_COMPANY.u_email = CI_USUARIOS.u_email');
		$this->db->where('CI_DETALLE_USUARIO.id_category', $category);
		$this->db->where('CI_DETALLE_COMPANY.c_rfc', $rfc);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return null;
		}
	}

	public function viewProyecto($id){
		$this->db->select('CI_PROYECTOS.c_proy_id AS proy_id, CI_PROYECTOS.c_proy_name AS proy_name, CI_PROYECTOS.c_proy_descri AS proy_descri, CI_PROYECTOS.c_fecha_creado AS fecha_creado, CI_PROYECTOS.c_fecha_ini AS estado, CI_USUARIOS.u_nombre AS res_name, CI_USUARIOS.u_apep AS res_apep, CI_USUARIOS.u_apem AS res_apem, CI_CATEGORIAS.cat_name AS proy_categoria');
		$this->db->from('CI_PROYECTOS, CI_CATEGORIAS, CI_DETALLE_PROYASIGN, CI_USUARIOS');
		$this->db->where('CI_PROYECTOS.c_proy_id = CI_DETALLE_PROYASIGN.c_proy_id');
		$this->db->where('CI_CATEGORIAS.id_category = CI_PROYECTOS.id_category');
		$this->db->where('CI_USUARIOS.u_email = CI_DETALLE_PROYASIGN.u_email');
		$this->db->where('CI_PROYECTOS.c_proy_id', $id);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->first_row('array');
		}else{
			return null;
		}
	}

	public function nuevaTarea($tarea){
		$data = array(
			'ci_tarea_name' => $tarea
			);

		$this->db->trans_start();
		$this->db->insert('CI_TAREAS', $data);
		$idtarea = $this->db->insert_id();
		$this->db->trans_complete();

		return $idtarea;
	}

	public function proyTareas($idpro, $idtarea){
		$data = array(
			'c_proy_id' => $idpro, 
			'ci_tarea_id' => $idtarea
			);

		return $this->db->insert('CI_DETALLE_PROYTAREAS', $data);
	}

}
