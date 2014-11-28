<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notifications extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->database('default');
	}

	/* Notificacion: Nueva Organización */
	public function getNotifyOrganizacion($org, $creator){
		$data = array(
			'ci_origin' => $creator,
			'ci_receptor' => $creator,
			'ci_type' => 1,
			'ci_date' => 0,
			'ci_reference' => $org
			);
		return $this->db->insert('CI_NOTIFICACIONES', $data);
	}


	/* Función para obtener todas las notificaciones pendientes de leer */
	public function getAllNotifications($creator, $number, $start=0){
		$this->db->select("CI_USUARIOS.u_nombre AS Nombre, CI_USUARIOS.u_apep AS Apep, CI_USUARIOS.u_apem AS Apem, DATE(CI_NOTIFICACIONES.ci_date) AS Fecha, CI_NOTIFICACIONES.ci_reference AS IdProyecto, CI_USUARIOS.u_photo AS Photo");
		$this->db->from('CI_NOTIFICACIONES, CI_USUARIOS');
		$this->db->where('CI_NOTIFICACIONES.ci_origin = CI_USUARIOS.u_email');
		$this->db->where('CI_NOTIFICACIONES.ci_receptor', $creator);
		$this->db->where('CI_NOTIFICACIONES.ci_type = 4');
		$this->db->where('CI_NOTIFICACIONES.ci_status <> 1');
		$this->db->limit($number,$start);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return null;
		}
	}

	public function get_notifications_count($creator){
		$this->db->select('*');
		$this->db->from('CI_NOTIFICACIONES');
		$this->db->where('CI_NOTIFICACIONES.ci_receptor', $creator);
		$this->db->where('CI_NOTIFICACIONES.ci_type = 4');
		$query = $this->db->get();
		return $query->num_rows();
	}

	/* Pendientes de leer */
	public function get_notifications_count_pendientes($creator){
		$this->db->select('*');
		$this->db->from('CI_NOTIFICACIONES');
		$this->db->where('CI_NOTIFICACIONES.ci_receptor', $creator);
		$this->db->where('CI_NOTIFICACIONES.ci_type = 4');
		$this->db->where('CI_NOTIFICACIONES.ci_status <> 1');
		$query = $this->db->get();
		return $query->num_rows();
	}

	/* Marcar proyecto como aceptado */
	public function cambiarStatusNotifyProyecto($id) {
		$data = array(
			'ci_status' => 1
			);
		$this->db->where('ci_reference', $id);
		return $this->db->update('CI_NOTIFICACIONES', $data);
	}

	public function cambiarCompletoProyecto($id){
		$data = array(
			'c_aceptado' => 1
			);
		$this->db->where('c_proy_id', $id);
		return $this->db->update('CI_PROYECTOS', $data);
	}

	public function cambiarRechazoProyecto($id){
		$data = array(
			'c_proy_success' => 0
			);
		$this->db->where('c_proy_id', $id);
		return $this->db->update('CI_PROYECTOS', $data);
	}

}
