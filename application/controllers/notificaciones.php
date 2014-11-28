<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notificaciones extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('notifications');
		$this->load->library('pagination');
	}

	public function index(){
		if($this->session->userdata('logger') == TRUE){
			redirect(base_url('notificaciones/all'));
		}else{
			redirect(base_url());
		}
	}

	public function obtenerNotificacionesPendientes(){
		$email = $this->session->userdata('u_email');
		$result = $this->notifications->get_notifications_count_pendientes($email);
		$send = array(
			'total' => $result
			);
		echo json_encode($send);
	}

	public function all($start = 0){
		if($this->session->userdata('logger') == TRUE){
			$email = $this->session->userdata('u_email');
			$datos['notificaciones'] = $this->notifications->getAllNotifications($email, 9, $start);
			$config['base_url'] = base_url().'notificaciones/all';
			$config['total_rows'] = $this->notifications->get_notifications_count($email);
			$config['per_page'] = 9;

			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';

			$config['next_link'] = '&raquo;';
			$config['prev_link'] = '&laquo;';

			$config['next_tag_open'] = '<li class="arrow">';
			$config['next_tag_close'] = '</li>';

			$config['prev_tag_open'] = '<li class="arrow">';
			$config['prev_tag_close'] = '</li>';

			$config['cur_tag_open'] = '<li class="current"><a href="#">';
			$config['cur_tag_close'] = '</a></li>';
			$this->pagination->initialize($config);
			$datos['pages'] = $this->pagination->create_links();

			$this->load->view('notificaciones', $datos);
		}else{
			redirect(base_url());
		}
	}

	// Aceptar Proyecto ;
	public function aceptado($id) {
		$result = $this->notifications->cambiarStatusNotifyProyecto($id);
		$other = $this->notifications->cambiarCompletoProyecto($id);
		if($result && $other){
			$data = array(
				'success' => 1
				);
		}else{
			$data = array(
				'success' => 0
				);
		}
		echo json_encode($data);
	}

	// Rechazar Proyecto ;
	public function rechazado($id) {
		$result = $this->notifications->cambiarStatusNotifyProyecto($id);
		$other = $this->notifications->cambiarRechazoProyecto($id);
		if($result && $other){
			$data = array(
				'success' => 1
				);
		}else{
			$data = array(
				'success' => 0
				);
		}
		echo json_encode($data);
	}

}