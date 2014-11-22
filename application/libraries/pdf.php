<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH."/third_party/fpdf.php";

class Pdf extends FPDF {

	public function __construct(){
		parent::__construct();
	}

	public function header() {
		$this->SetFont('Arial', 'B', 13);
		$this->Cell(30);
	}

	public function footer() {
		$this->SetY(-15);
		$this->SetFont('Arial','B',9);
		if($this->PageNo() != 1){
			$this->Cell(0, 10, 'Page '.$this->PageNo().'/{nb} . Apnote Web Platform',0,0,'R');
		}
	}

}