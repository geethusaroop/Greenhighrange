<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sundrycreditor extends MY_Controller {
	public $table = 'tbl_purchase';
	public $page  = 'Sundrycreditor';
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
		$template['body'] = 'Sundrycreditor/list';
		$template['script'] = 'Sundrycreditor/script';
		$template['records']=$this->Purchasereport_model->getsundrycreditors($branch_id_fk);
		$this->load->view('template', $template);
	}

	public function debtors()
	{
		$branch_id_fk=$this->session->userdata('branch_id_fk');
		$template['body'] = 'Sundrycreditor/list-debtor';
		$template['script'] = 'Sundrycreditor/script-debtor';
		$template['records']=$this->Purchasereport_model->getsundrydebtors($branch_id_fk);
		$this->load->view('template', $template);
	}

}