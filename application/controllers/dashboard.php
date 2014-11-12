<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('m_dashboard');
	}

	public function index() {
		if($this->session->userdata('logger') == TRUE){
			$data['allUsers'] = $this->m_dashboard->getAllUsers();
			$data['allCompany'] = $this->m_dashboard->getAllOrganizations();
			$data['allProjects'] = $this->m_dashboard->getAllProjects();
			$data['allImages'] = $this->m_dashboard->getAllImages();
			$this->load->view('dashboard', $data);
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