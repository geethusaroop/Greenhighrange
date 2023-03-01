<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class BBalancesheet extends MY_Controller {
	public function __construct() {
		parent::__construct();
        if(! $this->is_logged_in()){
          redirect('/login');
        }
        $this->load->model('Balancesheet_model');
         // $this->load->model('Greport_model');
        $this->load->model('Member_model');
        $this->load->model('BLedger_model');
		$this->load->model('General_model');
 			// $this->load->model('Project_model');
	}
	public function index()
	{$gid =$this->session->userdata('gid');
	
	    $template['gid']=$gid;
		$template['body'] = 'BBalancesheet/list';
		$template['script'] = 'BBalancesheet/script';
		$this->load->view('template', $template);
	}
	public function get(){
		$gid =$this->session->userdata('prid');
		$at_date = str_replace('/', '-', $this->input->post('cdate'));
		$sdate=date('Y-m-d',strtotime($at_date));
		$eat_date = str_replace('/', '-', $this->input->post('edate'));
		$edate=date('Y-m-d',strtotime($eat_date));
		$at_date=$this->input->post('cdate');
		$cdate=date('Y-m',strtotime($sdate));
		$esdate=date('Y-m',strtotime($edate));
		$branch_id_fk=$this->session->userdata('branch_id_fk');
		$template['body'] = 'BBalancesheet/list';
		$template['script'] = 'BBalancesheet/script';
	   	$template['cbalance'] = $this->Balancesheet_model->getbranchcashbalancep1($cdate,$esdate,$branch_id_fk);
	        $template['voucher']=$this->BLedger_model->getpvoucher($sdate,$edate,$branch_id_fk);
	         $template['receipt']=$this->BLedger_model->getpreceipt($sdate,$edate,$branch_id_fk);
	           $template['purc']=$this->BLedger_model->getpurchase($cdate,$edate,$branch_id_fk);
	         $template['sale']=$this->BLedger_model->getsaleincome($cdate,$edate,$branch_id_fk);
	          //  $template['payroll']=$this->BLedger_model->getpayroll($cdate,$edate,$branch_id_fk);
	         //    $template['advance']=$this->BLedger_model->getadvance($cdate,$edate,$branch_id_fk);
		$template['gid']=$gid;
		$template['sdate']=$sdate;
	    $template['edate']=$edate;
		$this->load->view('template', $template);
    }
}
