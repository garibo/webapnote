<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('parser');
		$this->load->model('m_welcome');
	}

	public function index()
	{
		if($this->session->userdata('logger') == TRUE){
			redirect(base_url('dashboard'));
		}else {
			$this->load->view('welcome');
		}
	}

	public function registrarUsuario() {
		$this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|xss_clean');
		$this->form_validation->set_rules('username', 'Nombre de Usuario', 'trim|required|is_unique[CI_USUARIOS.u_username]|xss_clean|min_length[8]|max_length[10]');
		$this->form_validation->set_rules('email', 'Correo Electrónico', 'trim|required|is_unique[CI_USUARIOS.u_email]|xss_clean|valid_email');
		$this->form_validation->set_rules('passwr', 'Contraseña', 'trim|required|xss_clean');

		$this->form_validation->set_message('required', '%s requerido.');
		$this->form_validation->set_message('is_unique', 'Este %s ya existe.');
		$this->form_validation->set_message('valid_email', 'Introduce un Correo Electrónico válido.');
		$this->form_validation->set_message('min_length', 'El %s debe contener mínimo 8 Caracteres');
		$this->form_validation->set_message('max_length', 'El %s debe contener máximo 10 Caracteres');

		$this->form_validation->set_error_delimiters('<p><i class="fi-x-circle icon-error"></i>', '</p>');
		if($this->form_validation->run() == FALSE){
			echo validation_errors();
		}else{
			$nom = $this->input->post('nombre');
			$use = $this->input->post('username');
			$ema = $this->input->post('email');
			$pas = sha1($this->input->post('passwr'));

			$length = strlen($this->input->post('passwr'));
			$sub1 = substr($this->input->post('passwr'), 0, 2);
			$sub2 = substr($this->input->post('passwr'), 2, $length-4);
			$sub3 = substr($this->input->post('passwr'), $length-2, $length);

			$pp = $sub1.str_replace($sub2, '**********', $sub2).$sub3;

			$addus = $this->m_welcome->addUsuario($nom, $use, $ema, $pas);
			//$this->sendmail($ema,$use, $pp, $nom);
			if($addus) {
				echo 1;
			}else{
				echo 0;
			}
		}
	}

	public function addLogin(){
		$this->form_validation->set_rules('emailsign', 'Correo Electrónico', 'trim|required|xss_clean|valid_email');
		$this->form_validation->set_rules('passign', 'Contraseña', 'trim|required|xss_clean');

		$this->form_validation->set_message('required', '%s requerido/a.');
		$this->form_validation->set_message('valid_email', 'El %s es inválido.');

		$this->form_validation->set_error_delimiters('<p><i class="fi-x-circle icon-error"></i>', '</p>');
		if($this->form_validation->run() == FALSE){
			echo validation_errors();
		}else{
			$email = $this->input->post('emailsign');
			$pass = sha1($this->input->post('passign'));

			$getsign = $this->m_welcome->signIn($email, $pass);
			if($getsign) {
				$auth = $this->m_welcome->signAuth($email, $pass);
				
				$logs = $this->m_welcome->addCurrentLogs($email);
				if($logs->u_loggins != null){ 
					$number = intval($logs->u_loggins)+1;
					$query = $this->m_welcome->updateCurrentLogs($email, $number);
				}else{
					$number = 1;
					$query = $this->m_welcome->updateCurrentLogs($email, $number);
				}
				
				if($auth->r_id == 2){echo 0;}else{
				$dato = array(
					'logger' => TRUE, 
					'u_email'=> $auth->u_email, 
					'u_username' => $auth->u_username, 
					'u_photo' => $auth->u_photo, 
					'u_nombre' => $auth->u_nombre, 
					'u_apep' => $auth->u_apep, 
					'u_apem' => $auth->u_apem,
					'u_date' => $auth->u_date, 
					'r_id' => $auth->r_id
				);
				$this->session->set_userdata($dato);
				echo 1;}
			}else {
				echo 0;
			}
		}
	}

	public function sendmail($email, $usr, $pass, $nombre){
		$config = array(
			'mailtype' => 'html',
			'charset' => 'UTF-8',
			'wordwrap' => TRUE
			);
		$data = array(
			'usuario' => $usr, 
			'email' => $email,
			'pass' => $pass,
			'nombre' => $nombre
			);
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$this->email->from('no-reply@recyclerscoders.com', 'Apnote Platform');
		$this->email->to($email);
		$this->email->subject('Bienvenido a Apnote');
		$this->email->message($this->parser->parse('emailtemplate', $data, TRUE));
		if(!$this->email->send()){
			show_error($this->email->print_debugger());
		}
	}

	public function emailtemplate(){
		if(true){
			$this->load->view('emailtemplate');
		}else{
			redirect(base_url());
		}
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */