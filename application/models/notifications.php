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
	public function getAllNotifications($creator){
		$this->db->where('ci_receptor', $creator);
		$query = $this->db->get('CI_NOTIFICACIONES');
		if($query->num_rows() > 0){
			return $query->num_rows();
		}else{
			return null;
		}
	}

}
