<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Mobile extends CI_Model {

	public function __construct(){ 
		parent::__construct();
		//$this->load->database('default');
		$this->load->database('production');
	}

	public function autenticacion($user, $pass) {
		$this->db->where('u_email', $user);
		$this->db->where('u_password', $pass);
		$this->db->where('r_id', 2);
		$this->db->where('u_status', 1);
		$query = $this->db->get('CI_USUARIOS');
		if($query->num_rows() == 1){
			return true;
		}else{
			return false;
		}
	}

	public function actives($email) {
		$data = array('u_status' => 1);
		$this->db->where('u_username', $email);
		return $this->db->update('CI_USUARIOS', $data);
	}

	public function getUsuario($email){
		$this->db->where('u_email', $email);
		$query = $this->db->get('CI_USUARIOS');
		if($query->num_rows() == 1){
			return $query->row();
		}else{
			return NULL;
		}
	}

	public function proyectosCursos($email){
		$this->db->select('CI_PROYECTOS.c_proy_name AS p_nombre, CI_PROYECTOS.c_proy_descri AS p_descri, CI_PROYECTOS.c_fecha_creado AS p_fecha, CI_CATEGORIAS.cat_name AS p_cat, CI_PROYECTOS.c_proy_id AS id_proyecto');
		$this->db->from('CI_DETALLE_PROYASIGN, CI_PROYECTOS, CI_CATEGORIAS');		
		$this->db->where('CI_DETALLE_PROYASIGN.u_email', $email);
		$this->db->where('CI_CATEGORIAS.id_category = CI_PROYECTOS.id_category');
		$this->db->where('CI_DETALLE_PROYASIGN.c_proy_id = CI_PROYECTOS.c_proy_id');
		$this->db->where('CI_PROYECTOS.c_fecha_ini =  "0000-00-00 00:00:00"');
		$this->db->where('CI_PROYECTOS.c_proy_success <> 1');
		$this->db->where('CI_PROYECTOS.c_proy_bandera', 1);
		$query = $this->db->get();
		if($query->num_rows() > 0) {
			return $query->result_array();
		}else{
			return NULL;
		}
	}

	public function proyectosIniciados($email){
		$this->db->select('CI_PROYECTOS.c_proy_name AS p_nombre, CI_PROYECTOS.c_proy_descri AS p_descri, CI_PROYECTOS.c_fecha_creado AS p_fecha, CI_CATEGORIAS.cat_name AS p_cat, CI_PROYECTOS.c_proy_id AS id_proyectos');
		$this->db->from('CI_DETALLE_PROYASIGN, CI_PROYECTOS, CI_CATEGORIAS');		
		$this->db->where('CI_DETALLE_PROYASIGN.u_email', $email);
		$this->db->where('CI_CATEGORIAS.id_category = CI_PROYECTOS.id_category');
		$this->db->where('CI_DETALLE_PROYASIGN.c_proy_id = CI_PROYECTOS.c_proy_id');
		$this->db->where('CI_PROYECTOS.c_fecha_ini <>  "0000-00-00 00:00:00"');
		$this->db->where('CI_PROYECTOS.c_proy_success <> 1');
		$this->db->where('CI_PROYECTOS.c_proy_bandera', 1);
		$query = $this->db->get();
		if($query->num_rows() > 0) {
			return $query->result_array();
		}else{
			return NULL;
		}
	}

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

	public function viewTareas($id){
		$this->db->select('CI_DETALLE_PROYTAREAS.ci_tarea_id AS Id, CI_TAREAS.ci_tarea_name AS Titulo, CI_DETALLE_PROYTAREAS.ci_deta_avance AS Avance');
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

	public function updateTareaTime($id, $date){
		$data = array(
			'c_fecha_ini' => $date
			);
		$this->db->where('c_proy_id', $id);
		return $this->db->update('CI_PROYECTOS', $data);
	}

	public function updateProyecto($id, $date){
		$data = array(
			'c_fecha_end' => $date,
			'c_proy_success' => 1
			);
		$this->db->where('c_proy_id', $id);
		return $this->db->update('CI_PROYECTOS', $data);
	}

	public function insertImageURL($nombre, $idtarea){
		$data = array(
			'c_image_name' => $nombre, 
			'c_tarea_id' => $idtarea
			);
		$this->db->trans_start();
		$this->db->insert('CI_IMAGES', $data);
		$tarea = $this->db->insert_id();
		$this->db->trans_complete();

		return $tarea;
	}

	public function detalleImageURL($id, $title, $descripcion){
		$data = array(
			'c_image_id' => $id,
			'c_title_image' => $title,
			'c_detalle_descripcion' => $descripcion
			);
		return $this->db->insert('CI_DETALLE_IMAGE', $data);
	}

	public function getWorksImages($id) {
		$this->db->select('CI_IMAGES.c_image_name AS URL, CI_DETALLE_IMAGE.c_title_image AS Titulo, CI_DETALLE_IMAGE.c_detalle_descripcion AS Descripcion, CI_IMAGES.c_image_id AS ImageID');
		$this->db->from('CI_IMAGES, CI_DETALLE_IMAGE');
		$this->db->where('CI_IMAGES.c_image_id = CI_DETALLE_IMAGE.c_image_id');
		$this->db->where('CI_IMAGES.c_tarea_id', $id);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return null;
		}
	}

	public function getInformationImage($id){
		$this->db->select('CI_DETALLE_IMAGE.c_title_image AS Titulo, CI_DETALLE_IMAGE.c_detalle_descripcion AS Descripcion, CI_IMAGES.c_image_name AS NameURL');
		$this->db->from('CI_IMAGES, CI_DETALLE_IMAGE');
		$this->db->where('CI_IMAGES.c_image_id = CI_DETALLE_IMAGE.c_image_id');
		$this->db->where('CI_IMAGES.c_image_id', $id);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return null;
		}
	}

	public function getImagesByWork($id) {
		$this->db->select('CI_DETALLE_PROYTAREAS.ci_tarea_id AS Id, CI_TAREAS.ci_tarea_name AS Titulo, CI_DETALLE_PROYTAREAS.ci_deta_avance AS Avance, COUNT(*) AS Imagenes');
		$this->db->from('CI_DETALLE_PROYTAREAS, CI_TAREAS, CI_IMAGES');
		$this->db->where('CI_DETALLE_PROYTAREAS.ci_tarea_id = CI_TAREAS.ci_tarea_id');
		$this->db->where('CI_TAREAS.ci_tarea_id = CI_IMAGES.c_tarea_id');
		$this->db->where('CI_DETALLE_PROYTAREAS.c_proy_id', $id);
		$this->db->group_by('Titulo');
		$query = $this->db->get();
		if($query->num_rows() > 0 ){
			return $query->result_array();
		}else{
			return null;
		}
	}

	public function getTotalWorks($id){
		$this->db->select('COUNT(*) AS Total');
		$this->db->from('CI_DETALLE_PROYTAREAS, CI_TAREAS');
		$this->db->where('CI_DETALLE_PROYTAREAS.ci_tarea_id = CI_TAREAS.ci_tarea_id');
		$this->db->where('CI_DETALLE_PROYTAREAS.c_proy_id', $id);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->first_row();
		}else{
			return null;
		}
	}

	/* Obtener informacion sobre un usuario */
	public function getProfileInfo($email){
		
	}

}