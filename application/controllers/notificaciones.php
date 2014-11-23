<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notificaciones extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('notifications');
	}

	public function index(){
		if($this->session->userdata('logger') == TRUE){
			$this->load->view('notificaciones');
		}else{
			redirect(base_url());
		}
	}

	public function get(){
		$email = $this->session->userdata('u_email');
		$result = $this->notifications->getAllNotifications($email);
		return json_encode($result);
	}

}