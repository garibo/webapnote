<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reporte extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('pdf');
		$this->load->model('m_reporte');
	}

	public function index(){
	}

	public function generar($id){
		if($this->session->userdata('logger') == TRUE){

			$Proyecto = $this->m_reporte->viewProyecto($id);
			$Organizacion = $this->m_reporte->viewOrganization($id);
			$Actividades = $this->m_reporte->viewTareas($id);

			$this->pdf = new Pdf('P', 'mm', 'Letter');
			$this->pdf->AliasNbPages();

			/********************************************
				The First Page / Create a Introduction
			********************************************/
			$this->pdf->AddPage();
			
			$this->pdf->SetFont('Arial', '', 12);
			$this->pdf->Cell(20,20, utf8_decode($Organizacion['Company']), 0, 0, 'C');

			$this->pdf->Ln(140);
			$this->pdf->SetX(25);
			$this->pdf->SetFont('Arial', 'B', 30);
			$this->pdf->Cell(0, 30, utf8_decode("Reporte Fotográfico"), 0, 0, 'L');
			
			$this->pdf->Ln(25);
			$this->pdf->SetX(25);
			$this->pdf->SetFont('Arial', 'B', 14);
			$this->pdf->Cell(10, 30, "Proyecto: ", 0, 0, 'L');
			$this->pdf->Ln(7);
			$this->pdf->SetX(25);
			$this->pdf->SetFont('Arial', 'I', 11);
			$this->pdf->Cell(10, 30, utf8_decode($Proyecto['proy_name']), 0, 0, 'L');

			$this->pdf->Ln(10);
			$this->pdf->SetX(25);
			$this->pdf->SetFont('Arial', 'B', 14);
			$this->pdf->Cell(10, 30, "Responsable: ", 0, 0, 'L');
			$this->pdf->Ln(7);
			$this->pdf->SetX(25);
			$this->pdf->SetFont('Arial', 'I', 11);
			$this->pdf->Cell(10, 30, utf8_decode($Proyecto['res_name'].' '.$Proyecto['res_apep'].' '.$Proyecto['res_apem']), 0, 0, 'L');

			$this->pdf->Ln(10);
			$this->pdf->SetX(25);
			$this->pdf->SetFont('Arial', 'B', 14);
			$this->pdf->Cell(10, 30, utf8_decode("Categoría: "), 0, 0, 'L');
			$this->pdf->Ln(7);
			$this->pdf->SetX(25);
			$this->pdf->SetFont('Arial', 'I', 11);
			$this->pdf->Cell(10, 30, utf8_decode($Proyecto['proy_categoria']), 0, 0, 'L');

			$this->pdf->Ln(30);
			$this->pdf->SetX(25);
			$this->pdf->SetFont('Arial', 'I', 11);
			$this->pdf->Cell(10, 30, utf8_decode($this->dia(date('D')).' '.date('d').' de '.$this->mes(date('M')).' de '.date('Y').', Lázaro Cárdenas, Michoacán, México'), 0, 0, 'L');
			/********************************************
				End First Page
			********************************************/

			/********************************************
				The Content Page
			********************************************/
			$this->pdf->AddPage();

			$iwidth  = 85;
			$iheight = 60;
			foreach($Actividades as $row){
				$this->pdf->SetFont('Arial', 'B', 15);
				$this->pdf->Text(20, 25, utf8_decode('Actividad: '.$row['Titulo']));
				$resarray = $this->getData($row['Ide']); //Arreglar
				//echo json_encode($resarray);
				$j = 0;
				foreach($resarray as $data){
					if($j == 3 || $j == 6 || $j == 9){
						$this->pdf->AddPage();
					}
					$this->pdf->Image(base_url('uploads/'.$data['URL']), 20, $this->pdf->GetY() + 25, $iwidth, $iheight);
					$this->pdf->SetLeftMargin(120);
					$this->pdf->SetFillColor(255,255,255);
					$this->pdf->Ln(30);
					$this->pdf->SetFont('Arial', 'B', 11);
					$this->pdf->MultiCell(75, 5, $data['Titulo'], 0, 'J', false);
					$this->pdf->SetFont('Arial', '', 11);
					$this->pdf->MultiCell(75, 7, $data['Descripcion'], 0, 'J', false);
					if(strlen($data['Descripcion']) < 70){
						$this->pdf->Ln(30);
					}
					$j++;
				}
				$this->pdf->AddPage();
			}

			/********************************************
				End The Content Page
			********************************************/


			$this->pdf->Output('Reporte.pdf', 'I');
		}else{
			redirect(base_url());
		}
	}

	public function getData($id){
		$imagenes = $this->m_reporte->getWorksImages($id);
		return $imagenes;
	}

	public function dia($day){
		
		switch($day){
			case "Mon":
				$day = "Lunes";
				break;
			case "Tue":
				$day = "Martes";
				break;
			case "Wed":
				$day = "Miercoles";
				break;
			case "Thu":
				$day = "Jueves";
				break;
			case "Fri":
				$day = "Viernes";
				break;
			case "Sat":
				$day = "Sabado";
				break;
			case "Sun":
				$day = "Domingo";
				break;
		}

		return $day;
	}

	public function mes($month){

		switch($month){
			case 'Jan':
				$month = "Enero";
				break;
			case 'Feb':
				$month = "Febrero";
				break;
			case 'Mar':
				$month = "Marzo";
				break;
			case 'Apr':
				$month = "Abril";
				break;
			case 'May':
				$month = "Mayo";
				break;
			case 'Jun':
				$month = "Junio";
				break;
			case 'Jul':
				$month = "Julio";
				break;
			case 'Aug':
				$month = "Agosto";
				break;
			case 'Sep':
				$month = "Septiembre";
				break;
			case 'Oct':
				$month = "Octubre";
				break;
			case 'Nov':
				$month = "Noviembre";
				break;
			case 'Dec':
				$month = "Diciembre";
				break;
		}

		return $month;

	}

}
