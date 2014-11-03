<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class API extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('m_mobile');
	}

	public function index(){
		$this->load->view('v_mobile');
	}

	// API para inicio de sesión ;
	public function APILogin(){
		$user = $this->input->get('email');
		$password = sha1($this->input->get('passwd'));
		$result = $this->m_mobile->autenticacion($user, $password);
		if($result){
			$user = $this->m_mobile->getUsuario($user);
			$data = array(
				'success' 	=> 1, 
				'message' 	=> "Inicio de Sesión Correcto",
				'email' 		=> $user->u_email,
				'username' 	=> $user->u_username,
				'nombre' 		=> $user->u_nombre,
				'apem'		=> $user->u_apem,
				'apep'		=> $user->u_apep,
				'date'		=> $user->u_date
				);

			$result = json_encode($data);
			echo $_GET['jsoncallback'] .'('.$result.')';
		}else{
			$data = array(
				'success' => 0,
				'message' => "El Correo Electrónico o Contraseña están incorrectos."
				);

			$result = json_encode($data);
			echo $_GET['jsoncallback'] .'('.$result.')';
		}
	}

	//API para activar una cuenta;
	public function activation($usr){
		$query = $this->m_mobile->actives($usr);
		if($query){
			echo "Este usuario ".$usr." se ha activado correctamente.";
		}else{
			echo "Error";
		}
	}

	// API Obtencion de Proyectos sin iniciar ;
	public function proyectosCurso(){
		$email = $this->input->get('email');
		$query = array();
		$query= $this->m_mobile->proyectosCursos($email);
		$result = json_encode($query);
		echo $_GET['jsoncallback'] .'('.$result.')';
	}

	// API Obtencion de proyectos iniciados ;
	public function proyectosIniciados(){
		$email = $this->input->get('email');
		$query = array();
		$query = $this->m_mobile->proyectosIniciados($email);
		$result = json_encode($query);
		echo $_GET['jsoncallback'] .'('.$result.')';
	}

	// API Proyecto Definido ;
	public function verProyecto($id){
		$query = $this->m_mobile->viewProyecto($id);
		if($query['estado'] == '0000-00-00 00:00:00'){
			$estado = "En Espera";
		}else{
			$estado = "En Curso";
		}
		$data = array(
			'proyname' 	 		=> $query['proy_name'],
			'proydescri'  		=> $query['proy_descri'],
			'fechacreado' 		=> $query['fecha_creado'], 
			'fechaini' 	 		=> $estado,
			'resnombre' 	 		=> $query['res_name'].' '.$query['res_apep'].' '.$query['res_apem'],
			'proycategoria'	=> $query['proy_categoria']);
		$result = json_encode($data);
		echo $_GET['jsoncallback'].'('.$result.')';
	}

}