<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Firm extends Controller {
	
	public function index() {
		$this->load->model('Firm_model','cmod');	
		$data = $this->cmod->getAllfirm();
		$this->view->load("firm_view/firm_view.php",array('data' => $data));	
	}
	
	public function afficherCreerfirm(){
			$this->load->model('firm_model','cmod');	
			$this->load->library('vform');
			$data = $this->cmod->getAllfirm();
			$this->view->load("firm_view/firmCreation_view.php",array('data' => $data));
	}
	
	public function creerfirm(){
		$this->load->model('firm_model','cmod');
		$this->load->library('vform');
		
		$this->vform->addrules('firm_name','Nom de la firm','notEmpty|required|maxLength[64]');
		$this->vform->addrules('firm_desc','Descritpion','notEmpty|required|minLength[3]|maxLength[400]');
		$this->vform->addrules('firm_adress','adresse de la firm','notEmpty|required|maxLength[64]');
		$this->vform->addrules('firm_city','ville de la firm','notEmpty|required|maxLength[64]');
		$this->vform->addrules('firm_postcode','code postal de la firm','notEmpty|required|btwLength[5,5]');
		$this->vform->addrules('firm_phone','telephone de la firm','notEmpty|required|btwLength[10,10]');
		$this->vform->addrules('firm_fax','fax de la firm','notEmpty|required|maxLength[64]');
		$this->vform->addrules('firm_mail','mail de la firm','notEmpty|required|email|maxLength[128]');
		
		if($this->vform->run()){
			$this->cmod->creerfirm();
			redirectTo(getURL('firm'));
		}
		else{
			$this->view->load("firm_view/firmCreation_view.php");
		}
	}
	
	public function supprimerfirm(){
		$this->load->model('firm_model','cmod');
		$this->cmod->supprimerfirm($_GET['id_firm']);
		redirectTo(getURL('firm'));
	}
	
	public function modifierfirm(){
		$this->load->model('firm_model','cmod');
		$this->load->library('vform');
		$this->vform->addrules('firm_name','Nom de la firm','notEmpty|required|maxLength[64]');
		$this->vform->addrules('firm_desc','Descritpion','notEmpty|required|minLength[3]|maxLength[400]');
		$this->vform->addrules('firm_adress','adresse de la firm','notEmpty|required|maxLength[64]');
		$this->vform->addrules('firm_city','ville de la firm','notEmpty|required|maxLength[64]');
		$this->vform->addrules('firm_postcode','code postal de la firm','notEmpty|required|btwLength[5,5]');
		$this->vform->addrules('firm_phone','telephone de la firm','notEmpty|required|btwLength[10,10]');
		$this->vform->addrules('firm_fax','fax de la firm','notEmpty|required|maxLength[64]');
		$this->vform->addrules('firm_mail','mail de la firm','notEmpty|required|email|maxLength[128]');
		$id = $_GET['id_firm'] ;
		if($this->vform->run()){
			$this->cmod->modifierfirm($id);
			redirectTo(getURL('firm'));
		}
		else{
			$data = $this->cmod->getfirm($id);;
			$this->view->load("firm_view/firmModfication_view.php",array('data' => $data ));
		}
	}

}
