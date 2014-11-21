<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('m_profile');
		$this->load->library('form_validation');
	}

	public function index() {
		if($this->session->userdata('logger') == TRUE){
			$email = $this->session->userdata('u_email');
			$data['categorias'] = $this->m_profile->obtenerCategorias();
			$data['profileData'] = $this->m_profile->obtenerInformacion($email);
			$data['micats'] = $this->m_profile->obtenerCatsxuser();
			$this->load->view('profile', $data);
		}else{
			redirect(base_url());
		}
	}

	public function actualizar(){
		if($this->session->userdata('logger') == TRUE){
			$this->form_validation->set_rules('uname', 'Nombre', 'trim|xss_clean|required|alpha');
			$this->form_validation->set_rules('uapep', 'Apellido Paterno', 'trim|xss_clean|required|alpha');
			$this->form_validation->set_rules('uapem', 'Apellido Materno', 'trim|xss_clean|required|alpha');
			$this->form_validation->set_message('required', 'Este campo es requerido');
			$this->form_validation->set_message('alpha', 'Solo valores alfabeticos');
			$this->form_validation->set_error_delimiters('','');
			if($this->form_validation->run() == FALSE){
				$errors = array(
						array(
							'campo' => 'gp-nombre',
							'error' => form_error('uname')
							),
						array(
							'campo' => 'gp-apep',
							'error' => form_error('uapep')
							),
						array(
							'campo' => 'gp-apem',
							'error' => form_error('uapem')
							)
					);

				$result = json_encode($errors);
				echo $result;
			}else{
				$nombre = $this->input->post('uname');
				$apep = $this->input->post('uapep');
				$apem = $this->input->post('uapem');
				$email = $this->session->userdata('u_email');
				$query = $this->m_profile->update($email, $nombre, $apep, $apem);
				if($query){
					$errors = array(
					array(
						'campo' => 'group-rfc',
						'error' => ''
						)
					);
					$result = json_encode($errors);
					echo $result;
				}
			}
		}else{
			redirect(base_url());
		}
	}

	// add category to profile;
	public function category(){
		$email = $this->session->userdata('u_email');
		$cat = $this->input->post('categories');
		$query = $this->m_profile->agregarCategoriaPerfil($email, $cat);
		if($query){
			$cat = $this->m_profile->obtenerCategoria($cat);
			$data = array(
				'nombre' => $cat->cat_name
				);
			$result = json_encode($data);
			echo $result;
		}
	}

}