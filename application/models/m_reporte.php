<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Reporte extends CI_Model {

	public function __construct(){ 
		parent::__construct();
		//$this->load->database('default');
		$this->load->database('production');
	}

	/***********************************
		Obtener Información acerca de un Proyecto.
	***********************************/
	public function viewProyecto($id){
		$this->db->select('CI_PROYECTOS.c_proy_name AS proy_name, CI_PROYECTOS.c_proy_descri AS proy_descri, CI_PROYECTOS.c_fecha_creado AS fecha_creado, CI_PROYECTOS.c_fecha_ini AS estado, CI_USUARIOS.u_nombre AS res_name, CI_USUARIOS.u_apep AS res_apep, CI_USUARIOS.u_apem AS res_apem, CI_CATEGORIAS.cat_name AS proy_categoria');
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

	/***********************************
		Obtener información sobre la compañia a la que pertenece
	***********************************/
	public function viewOrganization($id){
		$this->db->select('CI_COMPANY.c_name AS Company');
		$this->db->from('CI_COMPANY, CI_PROYECTOS');
		$this->db->where('CI_PROYECTOS.c_rfc = CI_COMPANY.c_rfc');
		$this->db->where('CI_PROYECTOS.c_proy_id', $id);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->first_row('array');
		}else{
			return null;
		}
	}

	/***********************************
		Obtener Información de la Tarea
	***********************************/
	public function viewTareas($id){
		$this->db->select('CI_DETALLE_PROYTAREAS.ci_tarea_id AS Ide, CI_TAREAS.ci_tarea_name AS Titulo, CI_DETALLE_PROYTAREAS.ci_deta_avance AS Avance');
		$this->db->from('CI_DETALLE_PROYTAREAS, CI_TAREAS');
		$this->db->where('CI_DETALLE_PROYTAREAS.ci_tarea_id = CI_TAREAS.ci_tarea_id');
		$this->db->where('CI_DETALLE_PROYTAREAS.c_proy_id', $id);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return null;
		}
	}

	/***********************************
		Obtener el Total de Imagenes de una Tarea
	***********************************/
	public function getRowsImages($id) {
		$this->db->select('CI_IMAGES.c_image_name AS URL, CI_DETALLE_IMAGE.c_title_image AS Titulo, CI_DETALLE_IMAGE.c_detalle_descripcion AS Descripcion, CI_IMAGES.c_image_id AS ImageID');
		$this->db->from('CI_IMAGES, CI_DETALLE_IMAGE');
		$this->db->where('CI_IMAGES.c_image_id = CI_DETALLE_IMAGE.c_image_id');
		$this->db->where('CI_IMAGES.c_tarea_id', $id);
		$query = $this->db->get();
		return $query->num_rows();
	}

	/***********************************
		Obtener información de las imagenes de una Tarea
	***********************************/
	public function getWorksImages($id) {
		$this->db->select('CI_IMAGES.c_image_name AS URL, CI_DETALLE_IMAGE.c_title_image AS Titulo, CI_DETALLE_IMAGE.c_detalle_descripcion AS Descripcion, CI_IMAGES.c_image_id AS ImageID');
		$this->db->from('CI_IMAGES, CI_DETALLE_IMAGE');
		$this->db->where('CI_IMAGES.c_image_id = CI_DETALLE_IMAGE.c_image_id');
		$this->db->where('CI_IMAGES.c_tarea_id', $id);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result_array();
		}
	}

}