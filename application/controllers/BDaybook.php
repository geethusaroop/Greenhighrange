<?php
defined('BASEPATH') or exit('No direct script access allowed');
class BDaybook extends MY_Controller
{
	public $table = 'tbl_branch_daybook';
	public $page  = 'BDaybook';
	public function __construct()
	{
		parent::__construct();
		if (!$this->is_logged_in()) {
			redirect('/login');
		}
		$this->load->model('BDaybook_model');
		$this->load->model('General_model');
		$this->load->model('Member_model');
	}
	public function index()
	{
		$template['body'] = 'BDaybook/list';
		$template['script'] = 'BDaybook/script';
		$sdate = date('Y-m-d');
		$branch_id_fk =$this->session->userdata('branch_id_fk');
		$template['opening'] = $this->BDaybook_model->popening($branch_id_fk);
		$template['voucher'] = $this->BDaybook_model->getpvoucher($sdate,$branch_id_fk);
		$template['receipt'] = $this->BDaybook_model->getpreceipt($sdate,$branch_id_fk);
		$template['purc'] = $this->BDaybook_model->getpurchase($sdate,$branch_id_fk);
		$template['saleincome'] = $this->BDaybook_model->getsaleincome($sdate,$branch_id_fk);
		$template['venodr_voucher'] = $this->BDaybook_model->getVendorVoucher($sdate,$branch_id_fk);
		$template['bdeposit'] = $this->BDaybook_model->getbdeposit($sdate,$branch_id_fk);
		$template['fund'] = $this->BDaybook_model->getfund($sdate,$branch_id_fk);
		$template['mbtsaleincome'] = $this->BDaybook_model->getmbtsaleincome($sdate,$branch_id_fk);
		$template['sdate'] = $sdate;
		$this->load->view('template', $template);
	}
	public function getdaybook()
	{
		$branch_id_fk =$this->session->userdata('branch_id_fk');
		$template['body'] = 'BDaybook/list';
		$template['script'] = 'BDaybook/script';
		$sdate =  date("Y-m-d", strtotime($this->input->post('daybuk_date')));
		$template['opening'] = $this->BDaybook_model->get_popening($sdate,$branch_id_fk);
		$template['voucher'] = $this->BDaybook_model->getpvoucher($sdate,$branch_id_fk);
		$template['receipt'] = $this->BDaybook_model->getpreceipt($sdate,$branch_id_fk);
		$template['purc'] = $this->BDaybook_model->getpurchase($sdate,$branch_id_fk);
		$template['venodr_voucher'] = $this->BDaybook_model->getVendorVoucher($sdate,$branch_id_fk);
		$template['saleincome'] = $this->BDaybook_model->getsaleincome($sdate,$branch_id_fk);
		$template['bdeposit'] = $this->BDaybook_model->getbdeposit($sdate,$branch_id_fk);
		$template['fund'] = $this->BDaybook_model->getfund($sdate,$branch_id_fk);
		$template['mbtsaleincome'] = $this->BDaybook_model->getmbtsaleincome($sdate,$branch_id_fk);
		$template['sdate'] = $sdate;
		$this->load->view('template', $template);
	}
	
	public function updates()
	{
		$profit = $this->input->post('profit_amt');
		$stat = $this->input->post('stat');
		$date = str_replace('/', '-', $this->input->post('cdate'));
		$date =  date("Y-m-d", strtotime($this->input->post('cdate')));
		$branch_id_fk = $this->session->userdata('branch_id_fk');
		$result = $this->BDaybook_model->pclosebalance($date,$branch_id_fk);
		if ($result) {
			$datas = $this->BDaybook_model->pupdate_daybook($date, $profit, $stat,$branch_id_fk);
		} else {
			//if($Outs!=0){
			$updateData = array(
				'date' => $date,
				'closing_amt' => $profit,
				'credit_status' => $stat,
				'daybook_status' => 2,
				'branch_id_fk'=>$branch_id_fk,
			);
			$data = $this->General_model->add($this->table, $updateData);
		
		}
		
	}

}
