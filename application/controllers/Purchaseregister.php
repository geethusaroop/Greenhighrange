<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Purchaseregister extends MY_Controller {
	public $table = 'tbl_purchase';
	public $page  = 'Purchaseregister';
	public function __construct() {
		parent::__construct();
         if(! $this->is_logged_in()){
            redirect('/login');
        }
        $this->load->model('General_model');
		$this->load->model('Purchasereport_model');
	}
	public function index()
	{
		$prid= $this->session->userdata('prid');
		$template['body'] = 'Purchaseregister/list';
		$template['script'] = 'Purchaseregister/script';
		$this->load->view('template', $template);
	}
	public function getPurchaseReports()
	{
		$branch_id_fk=$this->session->userdata('branch_id_fk');
		$cdate=$this->input->post('start_date');
		$edate=$this->input->post('end_date');
		$template['body'] = 'Purchaseregister/list';
		$template['script'] = 'Purchaseregister/script';
		$template['records']=$this->Purchasereport_model->getPurchaseRegister($branch_id_fk,$cdate,$edate);
	    $template['cdate']=$cdate;
		$template['edate']=$edate;
	    $this->load->view('template', $template);
	}
	
}