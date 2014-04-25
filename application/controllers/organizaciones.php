<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Organizaciones extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('m_organizaciones');
		$this->load->library('form_validation');
	}

	public function index() {
		$data['datos'] = $this->m_organizaciones->addOrg();
		if($this->session->userdata('logger') == TRUE){
			$this->load->view('organizaciones', $data);
		}else {
			redirect(base_url());
		}
	}

	public function addO(){
		$this->form_validation->set_rules('rfc', 'RFC de Compañía', 'trim|required|xss_clean|min_length[5]|max_length[6]');
		$this->form_validation->set_rules('name', 'Nombre', 'trim|required|xss_clean');
		$this->form_validation->set_rules('phone', 'Telefono', 'trim|required|xss_clean');
		$this->form_validation->set_rules('descripcion', 'Descripcion', 'trim|xss_clean');

		$this->form_validation->set_error_delimiters('<p><i class="fi-x-circle icon-error"></i>', '</p>');
		if($this->form_validation->run() == FALSE) {
			echo validation_errors();
		}else {
			$rfc = $this->input->post('rfc');
			$name = $this->input->post('name');
			$phone = $this->input->post('phone');
			$des = $this->input->post('descripcion');

			$query = $this->m_organizaciones->insertOrg($rfc, $name, $phone, $des);
			if($query){
				echo 1;
			}else{
				echo 0;
			}
		}
	}

	public function deleteOrga($rfc) {
		$query = $this->m_organizaciones->deleteOrg($rfc);
		if($query){
			redirect(base_url('organizaciones'));
		}
	}

}