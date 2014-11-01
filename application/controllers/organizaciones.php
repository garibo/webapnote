<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Organizaciones extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('m_organizaciones');
		$this->load->library('form_validation');
	}

	public function index() {
		$data['datos'] = $this->m_organizaciones->addOrg();
		$data['clases'] = $this->m_organizaciones->mdl_clases();
		if($this->session->userdata('logger') == TRUE){
			$this->load->view('organizaciones', $data);
		}else {
			redirect(base_url());
		}
	}

	/***************************************
	* @function 	Agregar nuevas organizaciones
	* @author 		Javier Diaz
	***************************************/
	public function addO(){
		$this->form_validation->set_rules('rfc', 'RFC de Compañía', 'trim|required|xss_clean|min_length[12]|max_length[13]|is_unique[CI_COMPANY.c_rfc]');
		$this->form_validation->set_rules('name', 'Nombre', 'trim|required|xss_clean');
		$this->form_validation->set_rules('phone', 'Telefono', 'trim|required|numeric|exact_length[10]|xss_clean');
		$this->form_validation->set_rules('descripcion', 'Descripcion', 'trim|xss_clean');
		$this->form_validation->set_rules('clases', 'clases', 'xss_clean|required');

		$this->form_validation->set_message('required', 'Este campo es requerido');
		$this->form_validation->set_message('numeric', 'Este campo solo acepta números');
		$this->form_validation->set_message('max_length','No puede exceder de <span class="hide">%d</span>%d caracteres');
		$this->form_validation->set_message('min_length', 'Este campo debe tener mínimo <span class="hide">%d</span>%d caracteres');
		$this->form_validation->set_message('exact_length', 'Este campo debe tener <span class="hide">%d</span>%d caracteres');

		$this->form_validation->set_error_delimiters('','');
		if($this->form_validation->run() == FALSE) {
			$errors = array(
					array(
						'campo' => 'group-rfc',
						'error' => form_error('rfc')
						),
					array(
						'campo' => 'group-phone',
						'error' => form_error('phone')
						),
					array(
						'campo' => 'group-name',
						'error' => form_error('name')
						),
					array(
						'campo' => 'group-descripcion',
						'error' => form_error('descripcion')
						), 
					array(
						'campo' => 'group-clases', 
						'error' => form_error('clases')
						)
				);

			$result = json_encode($errors);
			echo $result;

		}else {
			$rfc = $this->input->post('rfc');
			$name = $this->input->post('name');
			$phone = $this->input->post('phone');
			$des = $this->input->post('descripcion');
			$clas = $this->input->post('clases');

			$query = $this->m_organizaciones->insertOrg($rfc, $name, $phone, $des, $clas);
			
			switch($clas) {
				case 1: 
					$clase = "A";
					break;
				case 2:
				 	$clase = "B";
					break;
				case 3:
					$clase = "C";
					break;
				case 4: 
					$clase = "D";
					break;
			};

			if($query){
				$errors = array(
					array(
						'campo' => 'group-rfc',
						'error' => '',
						'datos' => array(
							'arfc' => $rfc, 
							'bnombre' => $name,
							'cdescripcion' => $des,
							'dtelefono' => $phone,
							'eclase' => $clase
							)
						)
					);
				$result = json_encode($errors);
				echo $result;
			}
		}
	}

	// Eliminar una Organización;
	public function delete($rfc) {
		$query = $this->m_organizaciones->checkOrg($rfc);
		$result = $this->m_organizaciones->checkProjOrg($rfc);
		if($query && $result){
			$query = $this->m_organizaciones->deleteOrg($rfc);
			echo '1';
		}else{
			echo '0';
		}
	}

	//Editar una organización;
	public function edit($rfc) {
		if($this->session->userdata('logger') == TRUE){
			$data['datos'] = $this->m_organizaciones->addOrg();
			$data['porg'] = $this->m_organizaciones->getOrg($rfc);
			$this->load->view('organizacion_edit', $data);
		}else{
			redirect(base_url());
		}	
	}

	// Actualizacion de las Organizaciones ;
	public function update($rfc){
		if($this->session->userdata('logger') == TRUE){
			$this->form_validation->set_rules('ephone','Telefono', 'trim|xss_clean|numeric|max_length[10]');
			$this->form_validation->set_message('numeric', 'El Campo %s solo puede contener datos numericos.');
			$this->form_validation->set_message('max_length','El Campo %s debe contener máximo %d caracteres.');
			$this->form_validation->set_error_delimiters('','');
			if($this->form_validation->run() == 	FALSE){
				$data['datos'] = $this->m_organizaciones->addOrg();
				$data['porg'] = $this->m_organizaciones->getOrg($rfc);
				$data['validation'] = array( 'validacion' => validation_errors() );
				$this->load->view('organizacion_edit', $data);
			}else{
				$name = $this->input->post('ename');
				$phone = $this->input->post('ephone');
				$des = $this->input->post('edes');
				$query = $this->m_organizaciones->updateInfo($rfc, $name, $phone, $des);
				if($query){
					$data['datos'] = $this->m_organizaciones->addOrg();
					$data['porg'] = $this->m_organizaciones->getOrg($rfc);
					$data['query'] = array( 'result' => 1);
					$this->load->view('organizacion_edit', $data);
				}
			}
		}else{
			redirect(base_url());
		}
	}

	// Ver equipo de trabajo de una Organizacion ;
	public function team($rfc) {
		if($this->session->userdata('logger') == TRUE){
			$data['datos'] = $this->m_organizaciones->addOrg();
			$data['team'] = $this->m_organizaciones->addTeam($rfc);
			$data['porg'] = $this->m_organizaciones->getOrg($rfc);
			$data['clases'] = $this->m_organizaciones->mdl_clases();
			$this->load->view('organizacion_team', $data);
		}else{
			redirect(base_url());
		}
	}

	// Perfiles de Usuarios
	public function profileTeam($user){
		if($this->session->userdata('logger') == TRUE){
			$data['prteam'] = $this->m_organizaciones->viewTeamU($user);
			$this->load->view('organizaciones_profile_team', $data);
		}else{
			redirect(base_url());
		}
	}

	public function deleteTUser($user, $segment){
		if($this->session->userdata('logger') == TRUE){
			$query = $this->m_organizaciones->deleteTU($user);
			if($query){
				redirect(base_url('organizaciones/team/'.$segment));
			}
		}else{
			redirect(base_url());
		}
	}

	// Agregar nuevo usuario al equipo de trabajo ;
	public function updateUsers($rfc){
		if($this->session->userdata('logger') == TRUE){
			$this->form_validation->set_rules('t_email', 'Email', 'trim|required|valid_email|xss_clean|is_unique[CI_USUARIOS.u_email]');
			$this->form_validation->set_rules('t_username', 'Nombre de Usuario', 'trim|min_length[6]|max_length[10]|required|xss_clean|is_unique[CI_USUARIOS.u_username]');
			$this->form_validation->set_rules('t_name', 'Nombre', 'trim|required|xss_clean');
			$this->form_validation->set_rules('t_apep', 'Apellido Paterno', 'trim|required|xss_clean');
			$this->form_validation->set_rules('t_apem', 'Apellido Materno', 'trim|xss_clean');
			//$this->form_validation->set_rules('t_pass', 'Contraseña', 'trim|xss_clean|required');

			$this->form_validation->set_message('required', 'Este campo es requerido');
			$this->form_validation->set_message('is_unique', 'Este valor ya existe');
			$this->form_validation->set_message('max_length','No puede exceder de <span class="hide">%d</span>%d caracteres');
			$this->form_validation->set_message('min_length', 'Este campo debe tener mínimo <span class="hide">%d</span>%d caracteres');
			$this->form_validation->set_message('valid_email', 'Introduce un email válido');
			$this->form_validation->set_error_delimiters('', '');
			if($this->form_validation->run() == FALSE){
				$errors = array(
					array(
						'campo' => 'group-email',
						'error' => form_error('t_email')
						), 
					array(
						'campo' => 'group-username', 
						'error' => form_error('t_username')
						), 
					array(
						'campo' => 'group-name', 
						'error' => form_error('t_name')
						), 
					array(
						'campo' => 'group-apep', 
						'error' => form_error('t_apep')
						), 
					array(
						'campo' => 'group-apem', 
						'error' => form_error('t_apem')
						)
					);

				$result = json_encode($errors);
				echo $result;

			}else{
				$email = $this->input->post('t_email');
				$username = $this->input->post('t_username');
				$nombre = $this->input->post('t_name');
				$apep = $this->input->post('t_apep');
				$apem = $this->input->post('t_apem');
				$pass = sha1($this->randomKey());
				$rol = 2;

				$query = $this->m_organizaciones->iAddTeam($email, $username, $nombre, $apep, $apem, $pass, $rol, $rfc);
				if($query){
					$errors = array(
						array(
							'campo' => 'group-rfc',
							'error' => '',
							'datos' => array(
								'ausername' => $username,
								'bnombre' => $nombre, 
								'capep' => $apep, 
								'dapem' => $apem,
								'eemail' => $email,
								),
							'rfc' => $rfc
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

	public function randomKey() {

			$string = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvxyz1234567890#@$%&/()=*+-";
			$longstring = strlen($string);
			
			$pass = "";
			$longitudPass = 10;

			for($i=1;$i<=$longitudPass;$i++) {
				$pos = rand(0,$longstring-1);
				$pass .= substr($string, $pos, 1);
			}

			$data = json_encode($pass);
			return $data;
	}
	
}