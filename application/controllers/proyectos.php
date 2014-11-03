<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Proyectos extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('m_proyectos');
		$this->load->library('form_validation');
		$this->load->library('pagination');
	}

	public function index() {
		if($this->session->userdata('logger') == TRUE){
			$data['organizaciones'] = $this->m_proyectos->obtenerOrganizaciones();
			$this->load->view('proyectos', $data);
		}else{
			redirect(base_url());
		}
	}

	public function selected($rfc) {
		if($this->session->userdata('logger') == TRUE){
			$datos['proyectosActivos'] = $this->m_proyectos->loadProyectos($rfc);
			$datos['proyectosInactivos'] = $this->m_proyectos->loadProyectosInactive($rfc);
			$datos['categorias'] = $this->m_proyectos->obtenerCategorias();
			$datos['orgpro'] = $this->m_proyectos->obtenerOrganizacion($rfc);
			$this->load->view('proyecto_selected', $datos);
		}else{
			redirect(base_url());
		}
	}
	
	/**********************************
	* Agregar nuevo proyecto a una Organización
	**********************************/
	public function agregarProyecto($rfc){
		if($this->session->userdata('logger') == TRUE){
			$this->form_validation->set_rules('pname', 'Nombre de Proyecto','trim|xss_clean|required');
			$this->form_validation->set_rules('category', 'Categoria', 'trim|xss_clean|required');
			$this->form_validation->set_rules('responsable', 'Responsable', 'trim|xss_clean|required');
			$this->form_validation->set_rules('descripcion', 'Descripcion', 'trim|xss_clean|required');
			$this->form_validation->set_message('required', 'Este campo es requerido');
			$this->form_validation->set_error_delimiters('','');
			if($this->form_validation->run() == FALSE){
				$errors = array(
						array(
							'campo' => 'nombre-cmp',
							'error' => form_error('pname')
							),
						array(
							'campo' => 'category-cmp',
							'error' => form_error('category')
							),
						array(
							'campo' => 'responsable-cmp',
							'error' => form_error('responsable')
							),
						array(
							'campo' => 'descripcion-cmp',
							'error' => form_error('descripcion')
							)					
					);

				$result = json_encode($errors);
				echo $result;
			}else{
				$nombrep 	= $this->input->post('pname');
				$category = $this->input->post('category');
				$respo 		= $this->input->post('responsable');
				$descri 	= $this->input->post('descripcion');
				$email 		= $this->session->userdata('u_email');
				$proyecto = $this->m_proyectos->agregarProyecto($rfc, $nombrep, $descri, $category);
				if($proyecto != 0){
					$asignar = $this->m_proyectos->asignarProyecto($respo, $proyecto);
					$query = $this->m_proyectos->viewProyectoDemo($proyecto);
					$errors = array(
					array(
						'campo' => 'group-rfc',
						'error' => '',
						'datos' => array(
								'nombre' => $query->proy_name,
								'fecha' => $query->fecha_creado,
							)
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

	/**********************************************
	* Eliminar el proyecto de una organización por id.
	**********************************************/
	public function delete($id){
		if($this->session->userdata('logger') == TRUE){
			$tareas = $this->m_proyectos->tieneTareas($id);
			if(!$tareas){
				$delete = $this->m_proyectos->deleteProyecto($id);
				if($delete){
					echo 1;
				}else{
					echo 0;
				}
			}else{
				echo 0;
			}
		}else{
			redirect(base_url());
		}
	}

	// Obtener responsables para seleccionar ;
	public function obtenerResponsables($category, $rfc){
		if($this->session->userdata('logger') == TRUE){
			$datos = $this->m_proyectos->obtenerResponsableCat($category, $rfc);
			if($datos){
				$result = json_encode($datos);
				echo $result;
			}			
		}else{
			redirect(base_url());
		}
	}


	/*********** Categorias Index  ***************/
	
	public function categorias($start=0){
		if($this->session->userdata('logger') == TRUE){
			$datos['categorias'] = $this->m_proyectos->obtenerCategoriaslimit(11, $start);
			$config['base_url'] = base_url().'proyectos/categorias/';
			$config['total_rows'] = $this->m_proyectos->get_categories_count();
			$config['per_page'] = 11;

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
			$this->load->view('categorias', $datos);
		}else{
			redirect(base_url());
		}
	}

	public function view($id, $rfc){
		if($this->session->userdata('logger') == TRUE){
			$data['infoProyecto'] = $this->m_proyectos->viewProyecto($id);
			$data['tareas'] = $this->m_proyectos->obtenerTareas($id);
			$data['orgpro'] = $this->m_proyectos->obtenerOrganizacion($rfc);
			$this->load->view('proyecto', $data);
		}else{
			redirect(base_url());
		}
	}

	public function agregarCategoria(){
		if($this->session->userdata('logger') == TRUE){
			$this->form_validation->set_rules('categoria', 'Categoria', 'trim|required|xss_clean');
			$this->form_validation->set_message('required', 'Este campo es requerido');
			$this->form_validation->set_error_delimiters('','');
			if($this->form_validation->run() == FALSE){
				$datos = array(
						'error' => 1,
						'campo' => 'category-group',
						'msg' => form_error('categoria')
					);
				$result = json_encode($datos);
				echo $result;
			}else{
				$nombre = $this->input->post('categoria');
				$return = $this->m_proyectos->nuevaCategoria($nombre);
				$datos = array(
						'error' => 0, 
						'campo' => 'category-group',
						'msg' => 'No se pudo agregar la Categoria'
					);
				$result = json_encode($datos);
				echo $result;
			}
		}else{
			redirect(base_url());
		}
	}


	public function agregarTarea(){
		if($this->session->userdata('logger') == TRUE){
			$tarea = $this->input->post('tarea');
			$proid = $this->input->post('proyid');
			$idtarea = $this->m_proyectos->nuevaTarea($tarea);
			if($idtarea != 0){
				$return = $this->m_proyectos->proyTareas($proid, $idtarea);
				$update = $this->m_proyectos->actualizarPorTareas($proid);
				if($return && $update){
					$message = array(
						'status' => 'Complete',
						'message' => 'Agregado Correctamente',
						'datos' => array(
							'tarea' => $tarea,
							'avance' => 0
							)
						);

					$result = json_encode($message);
					echo $result;
				}
			}
		}else{
			redirect(base_url());
		}
	}

}