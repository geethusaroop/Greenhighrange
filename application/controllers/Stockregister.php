<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Stockregister extends MY_Controller {
	public $table = 'tbl_purchase';
	public $page  = 'Stockregister';
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
		$branch_id_fk=$this->session->userdata('branch_id_fk');
		$template['body'] = 'Stockregister/list';
		$template['script'] = 'Stockregister/script';
		$template['records']=$this->Purchasereport_model->getStockRegister1($branch_id_fk);
		$template['record']=$this->Purchasereport_model->getStockRegister2($branch_id_fk);
		$this->load->view('template', $template);
	}
	
}