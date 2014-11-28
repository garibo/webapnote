<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH."/third_party/Pusher.php";

class API extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('m_mobile');
		$pusher = PusherInstance::get_pusher();
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
			$data = array(
				'success' => 1,
				'usuario' => $usr
				);
			$this->load->view('activation', $data);
		}else{
			$data = array(
				'success' => 0,
				);
			$this->load->view('activation', $data);
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

	public function verTareas($id) {
		$query = array();
		$query = $this->m_mobile->viewTareas($id);
		$result = json_encode($query);
		echo $_GET['jsoncallback'].'('.$result.')';
	}

	public function updateTarea($id){
		$datestring = '%Y-%m-%d %h:%i:%s';
		$time = time();
		$timestamp = mdate($datestring, $time); 

		$result = $this->m_mobile->updateTareaTime($id, $timestamp);
		if($result){
			$arreglo = array(
				'type' => 1,
				'message' => 'Actualización Correcta');
			$data = json_encode($arreglo);
			echo $_GET['jsoncallback'].'('.$data.')';
		}
	}

	/* Funcion para completar proyecto */
	public function updateProyecto($id){
		$usuario = $this->input->get('email');
		$datestring = '%Y-%m-%d %h:%i:%s';
		$time = time();
		$timestamp = mdate($datestring, $time); 
		$result = $this->m_mobile->updateProyecto($id, $timestamp);
		$receptor = $this->m_mobile->propietarioOrganization($id);
		$not = $this->m_mobile->registrarNotificacion($usuario, $receptor->Email, 4, $id);
		/*$pusher->trigger(
			'canal_prueba',
			'notify',
			array(
				'proyecto' => $id, 
				'usuario' => $usuario
				));*/
		if($result){
			$arreglo = array(
				'type' => 1,
				'message' => 'Enviado a Revisión'
				);
			$data = json_encode($arreglo);
			echo $_GET['jsoncallback'].'('.$data.')';
		}
	}

	public function uploadFiles(){
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'jpg|png';
		$config['max_size'] = '1024 * 8';

		$this->load->library('upload', $config);
		if(!$this->upload->do_upload('file')){
			echo "Error";
		}else{
			$data = array();
			$data = $this->upload->data();
			log_message('error', $data['file_name']);
			echo "OK";
		}
		
	}

	public function registerImage(){
		$titulo = $this->input->get('titulo');
		$descri = $this->input->get('descripcion');
		$image = $this->input->get('image');
		$tarea = $this->input->get('idtarea');
		$id = $this->m_mobile->insertImageURL($image, $tarea);
		if($id != 0){
			$query = $this->m_mobile->detalleImageURL($id, $titulo, $descri);
			if($query){
				$msg = array(
					'mensaje' => 'Imagen Guardada Correctamente'
					);
				$result = json_encode($msg);
				echo $_GET['jsoncallback'].'('.$result.')';
			}
		}
	}

	/* Obtener imagenes por tarea especificada */
	public function getWorks($id){
		
		$query = $this->m_mobile->getWorksImages($id);
		if($query != null){
			$result = json_encode($query);
		}else{
			$result = json_encode($query);
		}
		echo $_GET['jsoncallback'].'('.$result.')';
	}

	/* Obtener información de una imagen */
	public function getImageInformation($id){
		$query = $this->m_mobile->getInformationImage($id);
		if($query != null){
			$result = json_encode($query);
		}else{
			$result = json_encode($query);
		}
		echo $_GET['jsoncallback'].'('.$result.')';
	}

	/* Obtener las imagenes correspondientes a una Tarea */
	public function getImagesByWork($proyecto){
		$query = $this->m_mobile->getImagesByWork($proyecto);
		$total = $this->m_mobile->getTotalWorks($proyecto);
		if($query != null){
			$data = array(
				'total' => intval($total->Total),
				'objetos' => $query
				);
			$result = json_encode($data);
		}else{
			$result = json_encode($query);
		}
		echo $_GET['jsoncallback'].'('.$result.')';
	}

	/* Obtener informacion personal de un usuario en especifico */
	public function getProfileInformation(){
		$email = $this->input->get('user');
		$query = $this->m_mobile->getProfileInfo($email);
		if($query != null){
			$data = array(
				'usuario' => $query->u_username, 
				'email' => $query->u_email, 
				'thumb' => $query->u_photo, 
				'nombre' => $query->u_nombre, 
				'date' => $query->u_date
				);
			$result = json_encode($data);
		}else{
			$result = json_encode($query);
		}

		echo $_GET['jsoncallback'].'('.$result.')';
	}

}