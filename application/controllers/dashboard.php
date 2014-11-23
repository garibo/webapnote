<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('m_dashboard');
	}

	public function index() {
		if($this->session->userdata('logger') == TRUE){
			$email = "";
			$email = $this->session->userdata('u_email');
			$datos['allusers'] = $this->m_dashboard->getAllUsers($email);
			$datos['allcompany'] = $this->m_dashboard->getAllOrganizations($email);
			$datos['allprojects'] = $this->m_dashboard->getAllProjects($email);
			$datos['allimages'] = $this->m_dashboard->getAllImages($email);
			$this->load->view('dashboard', $datos);
		}else{
			redirect(base_url());
		}
	}

	public function logout(){
		$this->session->unset_userdata();
      $this->session->sess_destroy();
        redirect(base_url());
	}

}