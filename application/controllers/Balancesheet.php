<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Balancesheet extends MY_Controller {
	public function __construct() {
		parent::__construct();
        if(! $this->is_logged_in()){
          redirect('/login');
        }
        $this->load->model('Balancesheet_model');
         // $this->load->model('Greport_model');
        $this->load->model('Member_model');
        $this->load->model('Ledger_model');
		$this->load->model('General_model');
 			// $this->load->model('Project_model');
	}
	public function index()
	{$gid =$this->session->userdata('gid');
		//$template['edate']=date('Y-m-t',strtotime($at_date));
		/*$at_date=date('Y-m-d');
		$sdate=date('Y-m-01',strtotime($at_date));
		$edate=date('Y-m-t',strtotime($at_date));
		//$template['cdate']=date('Y-m-01',strtotime($at_date));
		$template['sdate']=$sdate;
	    $template['edate']=$edate;
		$at_date1=date('Y-m',strtotime($at_date));
		$template['records'] = $this->Member_model->getMember1($gid);
		$template['data1']=$this->Ledger_model->getgroupdeposit($gid,$sdate,$edate);
	    $template['data2']=$this->Ledger_model->getgroupwithdrawal($gid,$sdate,$edate);
	    $template['iloan']=$this->Ledger_model->getupnrmloan($gid,$sdate,$edate);
	    $template['gloan']=$this->Ledger_model->getgloan($gid,$sdate,$edate);
	    $template['awcloan']=$this->Ledger_model->getksbcdcloan($gid,$sdate,$edate);
	    $template['linkloan']=$this->Ledger_model->gethdsloan($gid,$sdate,$edate);
	    $template['gdeposit']=$this->Ledger_model->getgdeposit($gid,$sdate,$edate);
	   $template['cbalance'] = $this->Balancesheet_model->getcashbalance($at_date1,$gid);
	     $template['iloan_issue']=$this->Ledger_model->getupnrmloan_issue($gid,$sdate,$edate);
	      $template['gloan_issue']=$this->Ledger_model->getloan_issue($gid,$sdate,$edate);
	       $template['awcloan_issue']=$this->Ledger_model->getksbcdcloan_issue($gid,$sdate,$edate);
	        $template['linkloan_issue']=$this->Ledger_model->getpdsloan_issue($gid,$sdate,$edate);
	        $template['voucher']=$this->Ledger_model->getvoucher($gid,$sdate,$edate);
	         $template['receipt']=$this->Ledger_model->getreceipt($gid,$sdate,$edate);
	           $template['addon_grouploan']=$this->Ledger_model->getaddon_grouploan($gid,$sdate,$edate);
	          $template['addon_fedloan']=$this->Ledger_model->getaddon_fedloan($gid,$sdate,$edate);
	           $template['addon_bankloan']=$this->Ledger_model->getaddon_bankloan($gid,$sdate,$edate);
	            $template['addon_pdsloan']=$this->Ledger_model->getaddon_pdsloan($gid,$sdate,$edate);
	             $template['grouppds']=$this->Ledger_model->getgrouppdsloan($gid,$sdate,$edate);
	               $template['groupbank']=$this->Ledger_model->getgroupbankloan($gid,$sdate,$edate);
	                $template['groupfed']=$this->Ledger_model->getgroupfedloan($gid,$sdate,$edate);
	                 $template['chitty']=$this->Ledger_model->getchitty($gid,$sdate,$edate);
	            $template['bus']=$this->Ledger_model->getbusiness($gid,$sdate,$edate);*/
		
	    $template['gid']=$gid;
		$template['body'] = 'Balancesheet/list';
		$template['script'] = 'Balancesheet/script';
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
		// $prid =$this->session->userdata('prid');
			// $template['prid'] = $prid;
			//$template['project']=$this->Project_model->getproject($prid);
		//$template['cdate']=date('Y-m',strtotime($at_date));
		
		$template['body'] = 'Balancesheet/list';
		$template['script'] = 'Balancesheet/script';
	//	$template['records'] = $this->Member_model->getMember1($gid);
		//$template['opening'] = $this->Daybook_model->opening($gid);
	   	$template['cbalance'] = $this->Balancesheet_model->getcashbalancep1($cdate,$esdate);
	        $template['voucher']=$this->Ledger_model->getpvoucher($sdate,$edate);
	         $template['receipt']=$this->Ledger_model->getpreceipt($sdate,$edate);
	           $template['purc']=$this->Ledger_model->getpurchase($cdate,$edate);
	         $template['sale']=$this->Ledger_model->getsaleincome($cdate,$edate);
	            $template['payroll']=$this->Ledger_model->getpayroll($cdate,$edate);
	             $template['advance']=$this->Ledger_model->getadvance($cdate,$edate);
		$template['gid']=$gid;
		$template['sdate']=$sdate;
	    $template['edate']=$edate;
		$this->load->view('template', $template);
    }
}
