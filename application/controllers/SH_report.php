<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SH_report extends MY_Controller {
	public $table = 'tbl_ledgerbuk';
	public $table1 = 'tbl_daybook';
	public $page  = 'Ledger';
	public function __construct() {
		parent::__construct();
        if(! $this->is_logged_in()){
          redirect('/login');
        }
		$this->load->model('Ledger_model');
		$this->load->model('General_model');
		$this->load->model('Member_model');
		$this->load->model('Vendor_voucher_model');
    }

	public function index()
	{
		$template['body'] = 'SH_report/list-report';
		$template['script'] = 'SH_report/script';
		$branch_id_fk=$this->session->userdata('branch_id_fk');
		$template['member_names'] = $this->Vendor_voucher_model->view_by_shareholder($branch_id_fk);
		$this->load->view('template', $template);
	}

	public function getledger_report()
	{
		$shareholder_id_fk=$this->input->post('shareholder_id_fk');
		$cdate=$this->input->post('cdate');
		$edate=$this->input->post('edate');
		$branch_id_fk=$this->session->userdata('branch_id_fk');
		$template['member_names'] = $this->Vendor_voucher_model->view_by_shareholder($branch_id_fk);
		$template['body'] = 'SH_report/list-report';
		$template['script'] = 'SH_report/script';
		// $template['gid']=$gid;
	    $template['cdate']=$cdate;
	    $template['edate']=$edate;
	    $template['vendor']=$shareholder_id_fk;
		$template['sale']=$this->Vendor_voucher_model->get_shareholder_sale_report($cdate,$edate,$shareholder_id_fk);
	    $this->load->view('template', $template);

	}

}