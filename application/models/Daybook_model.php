<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Daybook_model extends CI_Model{
	public function __construct()
	{
		parent::__construct();
	}
	public function getDaybookTable($param,$gid){
		$arOrder = array('','enq_custname_fk');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
		$date =(isset($param['date']))?$param['date']:'';
		if($searchValue){
			$this->db->like('ledger_name', $searchValue);
		}
		if($date){
			$this->db->where('date', $date);
		}
		else{
			$this->db->where('date', date('Y-m-d'));
		}
		$this->db->where("status",1);
		$this->db->select('*,DATE_FORMAT(date,\'%d/%m/%Y\') as date ');
		$this->db->from('tbl_daybuk');
		$this->db->where('daybuk_group', $gid);
		// $this->db->join('tbl_receipthead','tbl_receipthead.receipt_id = ledger_name');
		// $this->db->join('tbl_voucherhead','tbl_voucherhead.voucher_id = ledger_name');
		//$this->db->where("date",date('Y-m-d'));
		$query = $this->db->get();
		$data['data'] = $query->result();
		$data['recordsTotal'] = $this->getDaybookTotalCount($param,$gid);
		$data['recordsFiltered'] = $this->getDaybookTotalCount($param,$gid);
		return $data;
	}
	public function getDaybookTotalCount($param = NULL,$gid){
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
		$date =(isset($param['date']))?$param['date']:'';
		if($searchValue){
			$this->db->like('ledger_name', $searchValue);
		}
		// if($date){
		//           $this->db->where('date', $date);
		//       }
		// else{
		// 	 $this->db->where('date',date('Y-m-d'));
		// }
		$this->db->select('*,DATE_FORMAT(date,\'%d/%m/%Y\') as date');
		$this->db->from('tbl_daybuk');
		$this->db->where('daybuk_group', $gid);
		$this->db->where("status",1);
		//$this->db->where("date",date('Y-m-d'));
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function getdaybook($date,$gid)
	{
		$this->db->select('*,DATE_FORMAT(date,\'%d/%m/%Y\') as date ');
		$this->db->from('tbl_daybuk');
		$this->db->where("date",$date);
		$this->db->where('daybuk_group', $gid);
		$query = $this->db->get();
		return $query->result();
	}
	public function get_sum($gid)
	{
		$this->db->select('SUM(credit) as credit_sum,SUM(debit) as debit_sum');
		$this->db->from('tbl_daybuk');
		$this->db->where("status",1);
		$this->db->where("date",date('Y-m-d'));
		$this->db->where('daybuk_group', $gid);
		$query = $this->db->get();
		return $query->result();
	}
	public function get_sum_($date,$gid)
	{
		$this->db->select('SUM(credit) as credit_sum,SUM(debit) as debit_sum');
		$this->db->from('tbl_daybuk');
		$this->db->where("status",1);
		$this->db->where("date",$date);
		$this->db->where('daybuk_group', $gid);
		$query = $this->db->get();
		return $query->result();
	}
	/*public function opening($gid)
	{
	$date = date('Y-m-d');
	$this->db->select('*');
	$this->db->from('tbl_daybuk');
	$this->db->order_by('daybuk_id',"desc");
	$this->db->limit(1);
	$date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');
	$d = date('Y-m-d', strtotime($date .' -1 day'));
	$this->db->where('date', $d);
	//$this->db->where("status",2);
	$this->db->where('daybuk_group', $gid);
	$query = $this->db->get();
	//print_r($query->row());
	//exit();
	return $query->row();
}*/
public function opening($gid)
{
	$date = date('Y-m');
	$this->db->select('*');
	$this->db->from('tbl_daybuk');
	$this->db->order_by('daybuk_id',"desc");
	$this->db->limit(1);
	$date = isset($_GET['date']) ? $_GET['date'] : date('Y-m');
	// $d = date('Y-m', strtotime($date .' last day of last month'));
	$d=date("Y-m", strtotime ( '-1 month' , strtotime ( $date ) )) ;
	$this->db->where('date', $d);
	//$this->db->where("status",2);
	$this->db->where('daybuk_group', $gid);
	$query = $this->db->get();
	//print_r($query->row());
	//exit();
	return $query->row();
}
public function get_opening($date,$gid)
{
	$this->db->select('*');
	$this->db->from('tbl_daybuk');
	$this->db->order_by('daybuk_id',"desc");
	$this->db->limit(1);
	//$d = date('Y-m-d', strtotime($date .' -1 day'));
	$d=date("Y-m", strtotime ( '-1 month' , strtotime ( $date ) )) ;
	$this->db->where('date', $d);
	$this->db->where('daybuk_group', $gid);
	$query = $this->db->get();
	//print_r($query->row());
	//exit();
	return $query->row();
}
public function opening1()
{
	$date = date('Y-m-d');
	$this->db->select('*');
	$this->db->from('tbl_daybuk');
	$this->db->order_by('daybuk_id',"desc");
	$this->db->limit(1);
	$date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');
	$d = date('Y-m-d', strtotime($date .' -1 day'));
	$this->db->where('date', $d);
	//$this->db->where('daybuk_group', $gid);
	$query = $this->db->get();
	//print_r($query->row());
	//exit();
	return $query->row();
}
/*public function get_closing1($date)
{
$this->db->select('*');
$this->db->from('tbl_daybuk');
$this->db->order_by('daybuk_id',"desc");
$this->db->limit(1);
$d = date('Y-m-d', strtotime($date));
$this->db->where('date', $d);
$query = $this->db->get();
//print_r($query->row());
//exit();
return $query->row();
}*/
public function opening_d($daybuk_date)
{
	$this->db->select('*');
	$this->db->from('tbl_daybuk');
	$this->db->order_by('daybuk_id',"desc");
	$this->db->limit(1);
	$date = isset($_GET['date']) ? $_GET['date'] : $daybuk_date;
	$d = date('Y-m-d', strtotime($date .' -1 day'));
	$this->db->where('date', $d);
	$query = $this->db->get();
	return $query->result();
}
public function getchitty($gid,$cdate)
{
	$this->db->select('*,sum(tbl_chitty.chitty_amount) AS chitty_total,DATE_FORMAT(MAX(chitty_date),\'%d/%m/%Y\') AS chitty_dat');
	$this->db->from('tbl_chitty');
	$this->db->where("chitty_status",1);
	$this->db->where("chitty_group",$gid);
	$this->db->where('chitty_date >=', date('Y-m-01',strtotime($cdate)));
	$this->db->where('chitty_date <=', date('Y-m-t',strtotime($cdate)));
	$this->db->group_by('chitty_date');
	$query = $this->db->get();
	$result=$query->result();
	return $result;
}
public function getbusiness($gid,$cdate)
{
	$this->db->select('*,sum(tbl_business.bus_amount) AS bus_total,DATE_FORMAT(MAX(bus_date),\'%d/%m/%Y\') AS bus_dat');
	$this->db->from('tbl_business');
	$this->db->where("bus_status",1);
	$this->db->where("bus_group",$gid);
	$this->db->where('bus_date >=', date('Y-m-01',strtotime($cdate)));
	$this->db->where('bus_date <=', date('Y-m-t',strtotime($cdate)));
	$this->db->group_by('bus_date');
	$query = $this->db->get();
	$result=$query->result();
	return $result;
}
public function getchitty_withdraw($gid,$cdate)
{
	$this->db->select('*,sum(tbl_chitty.chitty_widrawal) AS chitty_withdraw,DATE_FORMAT(MAX(chitty_widrawal_date),\'%d/%m/%Y\') AS chitty_dat');
	$this->db->from('tbl_chitty');
	$this->db->where("chitty_status",2);
	$this->db->where("chitty_group",$gid);
	$this->db->where('chitty_widrawal_date >=', date('Y-m-01',strtotime($cdate)));
	$this->db->where('chitty_widrawal_date <=', date('Y-m-t',strtotime($cdate)));
	$this->db->group_by('chitty_widrawal_date');
	$query = $this->db->get();
	$result=$query->result();
	return $result;
}
public function getbusiness_withdraw($gid,$cdate)
{
	$this->db->select('*,sum(tbl_business.bus_returns) AS bus_returns,DATE_FORMAT(MAX(bus_returns_date),\'%d/%m/%Y\') AS bus_dat');
	$this->db->from('tbl_business');
	$this->db->where("bus_returns_status",1);
	$this->db->where("bus_group",$gid);
	$this->db->where('bus_returns_date >=', date('Y-m-01',strtotime($cdate)));
	$this->db->where('bus_returns_date <=', date('Y-m-t',strtotime($cdate)));
	$this->db->group_by('bus_returns_date');
	$query = $this->db->get();
	$result=$query->result();
	return $result;
}
public function getgroupdeposit($gid,$cdate)
{
	$this->db->select('*,sum(tbl_deposit.deposit_amount) AS deposit_total,DATE_FORMAT(MAX(deposit_date),\'%d/%m/%Y\') AS deposit_dat,sum(awc_deposit_amount) as awc_amount,sum(bank_deposit_amount) as bank_deposit,sum(collection_amt) as collection,sum(other_income) as income,sum(fine) as fine');
	$this->db->from('tbl_deposit');
	$this->db->where("deposit_status",1);
	$this->db->where("shg_name",$gid);
	$this->db->where("deposit_widrawal",0);
	$this->db->where("deposit_amount!=",0);
	$this->db->where('deposit_date >=', date('Y-m-01',strtotime($cdate)));
	$this->db->where('deposit_date <=', date('Y-m-t',strtotime($cdate)));
	$this->db->group_by('deposit_date');
	$query = $this->db->get();
	$result=$query->result();
	return $result;
}
public function getgdeposit($gid,$cdate)
{
	$this->db->select('*,sum(tbl_group_deposit.group_deposit) AS group_deposit,sum(fedaration_deposit) as fedaration_deposit,sum(fd_amount) as fd_amount,DATE_FORMAT(MAX(gdeposit_date),\'%d/%m/%Y\') AS gdeposit_dat');
	$this->db->from('tbl_group_deposit');
	$this->db->where("gdeposit_status",1);
	$this->db->where("gdeposit_group",$gid);
	$this->db->where('gdeposit_month', $cdate);
	$this->db->group_by('gdeposit_date');
	$query = $this->db->get();
	$result=$query->result();
	return $result;
}
public function getbank_withdraw($gid,$cdate)
{
	$this->db->select('*,sum(tbl_group_deposit.group_deposit_withdrawal) AS deposit_withdrawal,DATE_FORMAT(MAX(group_deposit_withdrawal_date),\'%d/%m/%Y\') AS bank_withdraw_dat');
	$this->db->from('tbl_group_deposit');
	$this->db->where("group_deposit_withdrawal_status",1);
	$this->db->where("gdeposit_group",$gid);
	$this->db->where('group_deposit_withdrawal_date >=', date('Y-m-01',strtotime($cdate)));
	$this->db->where('group_deposit_withdrawal_date <=', date('Y-m-t',strtotime($cdate)));
	$this->db->group_by('group_deposit_withdrawal_date');
	$query = $this->db->get();
	$result=$query->result();
	return $result;
}
public function getfed_withdraw($gid,$cdate)
{
	$this->db->select('*,sum(tbl_group_deposit.fed_deposit_withdrawal) AS fed_withdrawal,DATE_FORMAT(MAX(fed_deposit_withdrawal_date),\'%d/%m/%Y\') AS fed_withdraw_dat');
	$this->db->from('tbl_group_deposit');
	$this->db->where("fed_deposit_withdrawal_status",1);
	$this->db->where("gdeposit_group",$gid);
	$this->db->where('fed_deposit_withdrawal_date >=', date('Y-m-01',strtotime($cdate)));
	$this->db->where('fed_deposit_withdrawal_date <=', date('Y-m-t',strtotime($cdate)));
	$this->db->group_by('fed_deposit_withdrawal_date');
	$query = $this->db->get();
	$result=$query->result();
	return $result;
}
public function getfd_withdraw($gid,$cdate)
{
	$this->db->select('*,sum(tbl_group_deposit.fd_withdrawal) AS fd_withdraw,DATE_FORMAT(MAX(fd_withdrawal_date),\'%d/%m/%Y\') AS fd_withdraw_dat');
	$this->db->from('tbl_group_deposit');
	$this->db->where("fd_withdrawal_status",1);
	$this->db->where("gdeposit_group",$gid);
	$this->db->where('fd_withdrawal_date >=', date('Y-m-01',strtotime($cdate)));
	$this->db->where('fd_withdrawal_date <=', date('Y-m-t',strtotime($cdate)));
	$this->db->group_by('fd_withdrawal_date');
	$query = $this->db->get();
	$result=$query->result();
	return $result;
}
public function getgroupwithdrawal($gid,$cdate)
{
	$this->db->select('*,sum(tbl_deposit.deposit_widrawal) AS widrawal_total,DATE_FORMAT(MAX(deposit_widrawal_date),\'%d/%m/%Y\') AS deposit_widrawal_dat,(sum(tbl_deposit.deposit_amount)-sum(tbl_deposit.deposit_widrawal)) AS balance');
	$this->db->from('tbl_deposit');
	$this->db->where("deposit_status",1);
	$this->db->where("shg_name",$gid);
	$this->db->where('deposit_widrawal !=', 0);
	$this->db->where('deposit_widrawal_date >=', date('Y-m-01',strtotime($cdate)));
	$this->db->where('deposit_widrawal_date <=', date('Y-m-t',strtotime($cdate)));
	$this->db->join('tbl_member','member_id= deposit_member');
	$this->db->group_by('deposit_widrawal_date');
	$query = $this->db->get();
	$result=$query->result();
	return $result;
}
public function getupnrmloan($gid,$cdate)
{
	$this->db->select('*,tbl_member.member_name,tbl_member.member_mid,sum(tbl_upnrmloan_repayment.upnrmloan_repayment_amt) AS tpayment,sum(tbl_upnrmloan_repayment.upnrmloan_intrest_amt) AS tintrest,sum(tbl_upnrmloan.upnrmloan_amount) as tamount,DATE_FORMAT(MAX(upnrmloan_repayment_date),\'%d/%m/%Y\') AS upnrmloan_repayment_date');
	$this->db->from('tbl_upnrmloan_repayment');
	$this->db->join('tbl_member','upnrmloan_repay_member = member_id');
	$this->db->join('tbl_upnrmloan','upnrmloan_internalid = upnrmloan_id');
	$this->db->where('upnrmloan_repayment_date >=',  date('Y-m-01',strtotime($cdate)));
	$this->db->where('upnrmloan_repayment_date <=', date('Y-m-t',strtotime($cdate)));
	$this->db->where("upnrmloan_repayment_status",1);
	$this->db->where("member_group",$gid);
	// $this->db->group_by('tbl_member.member_id');
	$this->db->group_by('upnrmloan_repayment_date');
	$this->db->order_by('upnrmloan_repayment_id', 'DESC');
	$query = $this->db->get();
	$result=$query->result();
	return $result;
}
public function getgloan($gid,$cdate)
{
	$this->db->select('*,tbl_member.member_name,tbl_member.member_mid,sum(tbl_loan_repayment.loan_repayment_amt) AS tpayment,sum(tbl_loan_repayment.loan_intrest_amt) AS tintrest,sum(tbl_loan.loan_amount) as tamount,DATE_FORMAT(MAX(tbl_loan_repayment.loan_repayment_date),\'%d/%m/%Y\') AS loan_repayment_dat');
	$this->db->from('tbl_loan_repayment');
	$this->db->join('tbl_member','loan_repay_member = member_id');
	$this->db->join('tbl_loan','loan_loan_id = loan_id');
	$this->db->where('tbl_loan_repayment.loan_repayment_date >=',  date('Y-m-01',strtotime($cdate)));
	$this->db->where('tbl_loan_repayment.loan_repayment_date <=',  date('Y-m-t',strtotime($cdate)));
	$this->db->where("loan_repayment_status",1);
	$this->db->where("member_group",$gid);
	$this->db->group_by('tbl_loan_repayment.loan_repayment_date');
	$this->db->order_by('loan_repayment_id', 'DESC');
	$query = $this->db->get();
	$result=$query->result();
	return $result;
}
public function getksbcdcloan($gid,$cdate)
{
	$this->db->select('*,tbl_member.member_name,tbl_member.member_mid,sum(tbl_ksbcdcloan_repayment.ksbcdcloan_repayment_amt) AS tpayment,sum(tbl_ksbcdcloan_repayment.ksbcdcloan_intrest_amt) AS tintrest,sum(tbl_ksbcdcloan.ksbcdcloan_amount) as tamount,DATE_FORMAT(MAX(tbl_ksbcdcloan_repayment.ksbcdcloan_repayment_date),\'%d/%m/%Y\') AS ksbcdcloan_repayment_date');
	$this->db->from('tbl_ksbcdcloan_repayment');
	$this->db->join('tbl_member','ksbcdcloan_repay_member = member_id');
	$this->db->join('tbl_ksbcdcloan','ksbcdcloan_internalid = ksbcdcloan_id');
	$this->db->where('tbl_ksbcdcloan_repayment.ksbcdcloan_repayment_date >=',  date('Y-m-01',strtotime($cdate)));
	$this->db->where('tbl_ksbcdcloan_repayment.ksbcdcloan_repayment_date <=',  date('Y-m-t',strtotime($cdate)));
	$this->db->where("ksbcdcloan_repayment_status",1);
	$this->db->where("member_group",$gid);
	$this->db->group_by('tbl_ksbcdcloan_repayment.ksbcdcloan_repayment_date');
	$this->db->order_by('ksbcdcloan_repayment_id', 'DESC');
	$query = $this->db->get();
	$result=$query->result();
	return $result;
}
public function gethdsloan($gid,$cdate)
{
	$this->db->select('*,tbl_member.member_name,tbl_member.member_mid,sum(tbl_hdsloan_repayment.hdsloan_repayment_amt) AS tpayment,sum(tbl_hdsloan_repayment.hdsloan_intrest_amt) AS tintrest,sum(tbl_hdsloan.hdsloan_amount) as tamount,DATE_FORMAT(MAX(tbl_hdsloan_repayment.hdsloan_repayment_date),\'%d/%m/%Y\') AS hdsloan_repayment_date');
	$this->db->from('tbl_hdsloan_repayment');
	$this->db->join('tbl_member','hdsloan_repay_member = member_id');
	$this->db->join('tbl_hdsloan','hdsloan_internalid = hdsloan_id');
	$this->db->where('tbl_hdsloan_repayment.hdsloan_repayment_date >=',  date('Y-m-01',strtotime($cdate)));
	$this->db->where('tbl_hdsloan_repayment.hdsloan_repayment_date <=',  date('Y-m-t',strtotime($cdate)));
	$this->db->where("hdsloan_repayment_status",1);
	$this->db->where("member_group",$gid);
	$this->db->group_by('tbl_hdsloan_repayment.hdsloan_repayment_date');
	$this->db->order_by('hdsloan_repayment_id', 'DESC');
	$query = $this->db->get();
	$result=$query->result();
	return $result;
}
public function getupnrmloan_issue($gid,$cdate)
{
	$this->db->select('*,tbl_member.member_name,tbl_member.member_mid,sum(tbl_upnrmloan.upnrmloan_amount) as tamount,DATE_FORMAT(MAX(upnrmloan_sdate),\'%d/%m/%Y\') AS upnrmloan_sdate');
	$this->db->from('tbl_upnrmloan');
	$this->db->join('tbl_member','upnrmloan_member = member_id');
	$this->db->where('upnrmloan_sdate >=',date('Y-m-01',strtotime($cdate)));
	$this->db->where('upnrmloan_sdate <=',date('Y-m-t',strtotime($cdate)));
	//$this->db->where("upnrmloan_status",1);
	$where = '(upnrmloan_status="1" or upnrmloan_status = "2")';
	$this->db->where($where);
	$this->db->where("member_group",$gid);
	$this->db->group_by('upnrmloan_sdate');
	$this->db->order_by('upnrmloan_id', 'DESC');
	$query = $this->db->get();
	$result=$query->result();
	return $result;
}
public function getloan_issue($gid,$cdate)
{
	$this->db->select('*,tbl_member.member_name,tbl_member.member_mid,sum(tbl_loan.loan_amount) as tamount,DATE_FORMAT(MAX(loan_sdate),\'%d/%m/%Y\') AS loan_sdate');
	$this->db->from('tbl_loan');
	$this->db->join('tbl_member','loan_member = member_id');
	$this->db->where('loan_sdate >=',date('Y-m-01',strtotime($cdate)));
	$this->db->where('loan_sdate <=',date('Y-m-t',strtotime($cdate)));
	// $this->db->where("loan_status",1);
	$where = '(loan_status="1" or loan_status = "2")';
	$this->db->where($where);
	$this->db->where("member_group",$gid);
	// $this->db->group_by('tbl_member.member_id');
	$this->db->group_by('loan_sdate');
	$this->db->order_by('loan_id', 'DESC');
	$query = $this->db->get();
	$result=$query->result();
	return $result;
}
public function getksbcdcloan_issue($gid,$cdate)
{
	$this->db->select('*,tbl_member.member_name,tbl_member.member_mid,sum(tbl_ksbcdcloan.ksbcdcloan_amount) as tamount,DATE_FORMAT(MAX(ksbcdcloan_sdate),\'%d/%m/%Y\') AS ksbcdcloan_sdate');
	$this->db->from('tbl_ksbcdcloan');
	$this->db->join('tbl_member','ksbcdcloan_member = member_id');
	$this->db->where('ksbcdcloan_sdate >=',date('Y-m-01',strtotime($cdate)));
	$this->db->where('ksbcdcloan_sdate <=',date('Y-m-t',strtotime($cdate)));
	//$this->db->where("ksbcdcloan_status",1);
	$where = '(ksbcdcloan_status="1" or ksbcdcloan_status = "2")';
	$this->db->where($where);
	$this->db->where("member_group",$gid);
	$this->db->group_by('ksbcdcloan_sdate');
	$this->db->order_by('ksbcdcloan_id', 'DESC');
	$query = $this->db->get();
	$result=$query->result();
	return $result;
}
public function getpdsloan_issue($gid,$cdate)
{
	$this->db->select('*,tbl_member.member_name,tbl_member.member_mid,sum(tbl_hdsloan.hdsloan_amount) as tamount,DATE_FORMAT(MAX(hdsloan_sdate),\'%d/%m/%Y\') AS hdsloan_sdate');
	$this->db->from('tbl_hdsloan');
	$this->db->join('tbl_member','hdsloan_member = member_id');
	$this->db->where('hdsloan_sdate >=',date('Y-m-01',strtotime($cdate)));
	$this->db->where('hdsloan_sdate <=',date('Y-m-t',strtotime($cdate)));
	//$this->db->where("hdsloan_status",1);
	$where = '(hdsloan_status="1" or hdsloan_status = "2")';
	$this->db->where($where);
	$this->db->where("member_group",$gid);
	//$this->db->group_by('tbl_member.member_id');
	$this->db->group_by('hdsloan_sdate');
	$this->db->order_by('hdsloan_id', 'DESC');
	$query = $this->db->get();
	$result=$query->result();
	return $result;
}
/*public function getaddon_grouploan($gid,$cdate)
{
$this->db->select('*,tbl_member.member_name,tbl_member.member_mid,sum(tbl_loan.add_on_loan) as add_on_loan,DATE_FORMAT(MAX(add_on_loan_date),\'%d/%m/%Y\') AS add_on_loan_date');
$this->db->from('tbl_loan');
$this->db->join('tbl_member','loan_member = member_id');
$this->db->where('add_on_loan_date >=',date('Y-m-01',strtotime($cdate)));
$this->db->where('add_on_loan_date <=',date('Y-m-t',strtotime($cdate)));
// $this->db->where("loan_status",1);
$where = '(loan_status="1" or loan_status = "2")';
$this->db->where($where);
$this->db->where("member_group",$gid);
// $this->db->group_by('tbl_member.member_id');
$this->db->group_by('add_on_loan_date');
$this->db->order_by('loan_id', 'DESC');
$query = $this->db->get();
$result=$query->result();
return $result;
}*/
public function getaddon_grouploan($gid,$cdate)
{
	$this->db->select('*,tbl_member.member_name,tbl_member.member_mid,sum(tbl_add_on_loan.add_on_loan_amt) as add_on_loan,DATE_FORMAT(MAX(add_on_loan_date),\'%d/%m/%Y\') AS add_on_loan_date');
	$this->db->from('tbl_add_on_loan');
	$this->db->join('tbl_member','add_on_loan_member = member_id');
	$this->db->where('add_on_loan_date >=',date('Y-m-01',strtotime($cdate)));
	$this->db->where('add_on_loan_date <=',date('Y-m-t',strtotime($cdate)));
	$this->db->where("add_on_loan_status",1);
	//$where = '(loan_status="1" or loan_status = "2")';
	//$this->db->where($where);
	$this->db->where("member_group",$gid);
	// $this->db->group_by('tbl_member.member_id');
	$this->db->group_by('add_on_loan_date');
	$this->db->order_by('add_on_loan_id', 'DESC');
	$query = $this->db->get();
	$result=$query->result();
	return $result;
}
public function getaddon_fedloan($gid,$cdate)
{
	$this->db->select('*,tbl_member.member_name,tbl_member.member_mid,sum(tbl_upnrmloan.add_on_loan) as add_on_loan,DATE_FORMAT(MAX(add_on_loan_date),\'%d/%m/%Y\') AS add_on_loan_date');
	$this->db->from('tbl_upnrmloan');
	$this->db->join('tbl_member','upnrmloan_member = member_id');
	$this->db->where('add_on_loan_date >=',date('Y-m-01',strtotime($cdate)));
	$this->db->where('add_on_loan_date <=',date('Y-m-t',strtotime($cdate)));
	$this->db->where("upnrmloan_status",1);
	$this->db->where("member_group",$gid);
	// $this->db->group_by('tbl_member.member_id');
	$this->db->group_by('add_on_loan_date');
	$this->db->order_by('upnrmloan_id', 'DESC');
	$query = $this->db->get();
	$result=$query->result();
	return $result;
}
public function getaddon_bankloan($gid,$cdate)
{
	$this->db->select('*,tbl_member.member_name,tbl_member.member_mid,sum(tbl_ksbcdcloan.add_on_loan) as add_on_loan,DATE_FORMAT(MAX(add_on_loan_date),\'%d/%m/%Y\') AS add_on_loan_date');
	$this->db->from('tbl_ksbcdcloan');
	$this->db->join('tbl_member','ksbcdcloan_member = member_id');
	$this->db->where('add_on_loan_date >=',date('Y-m-01',strtotime($cdate)));
	$this->db->where('add_on_loan_date <=',date('Y-m-t',strtotime($cdate)));
	$this->db->where("ksbcdcloan_status",1);
	$this->db->where("member_group",$gid);
	// $this->db->group_by('tbl_member.member_id');
	$this->db->group_by('add_on_loan_date');
	$this->db->order_by('ksbcdcloan_id', 'DESC');
	$query = $this->db->get();
	$result=$query->result();
	return $result;
}
public function getaddon_pdsloan($gid,$cdate)
{
	$this->db->select('*,tbl_member.member_name,tbl_member.member_mid,sum(tbl_hdsloan.add_on_loan) as add_on_loan,DATE_FORMAT(MAX(add_on_loan_date),\'%d/%m/%Y\') AS add_on_loan_date');
	$this->db->from('tbl_hdsloan');
	$this->db->join('tbl_member','hdsloan_member = member_id');
	$this->db->where('add_on_loan_date >=',date('Y-m-01',strtotime($cdate)));
	$this->db->where('add_on_loan_date <=',date('Y-m-t',strtotime($cdate)));
	$this->db->where("hdsloan_status",1);
	$this->db->where("member_group",$gid);
	// $this->db->group_by('tbl_member.member_id');
	$this->db->group_by('add_on_loan_date');
	$this->db->order_by('hdsloan_id', 'DESC');
	$query = $this->db->get();
	$result=$query->result();
	return $result;
}
public function getvoucher($gid,$cdate)
{
	$this->db->select('*');
	$this->db->from('tbl_voucher');
	$this->db->join('tbl_vouchhead','vouch_id = vouch_id_fk');
	$this->db->where("voucher_status",1);
	$this->db->where("voucher_group",$gid);
	$this->db->where('voucher_date >=',date('Y-m-01',strtotime($cdate)));
	$this->db->where('voucher_date <=',date('Y-m-t',strtotime($cdate)));
	$query = $this->db->get();
	$result=$query->result();
	return $result;
}
public function getreceipt($gid,$cdate)
{
	$this->db->select('*');
	$this->db->from('tbl_receipt');
	$this->db->join('tbl_receipthead','tbl_receipthead.receipt_id = receipt_id_fk');
	$this->db->where("tbl_receipt.receipt_status",1);
	$this->db->where("group",$gid);
	$this->db->where('rept_date >=',date('Y-m-01',strtotime($cdate)));
	$this->db->where('rept_date <=',date('Y-m-t',strtotime($cdate)));
	$query = $this->db->get();
	$result=$query->result();
	return $result;
}
public function closebalance($date,$gid)
{
	$this->db->select('tbl_daybuk.closing_amount,tbl_daybuk.date,tbl_daybuk.daybuk_group');
	$this->db->from('tbl_daybuk');
	$this->db->where('tbl_daybuk.date',$date);
	$this->db->where('tbl_daybuk.daybuk_group',$gid);
	$this->db->where("status",2);
	$query = $this->db->get();
	return $query->result();
}
public function update_daybook($date,$gid,$profit,$stat){
	$this->db->set('credit', $stat);
	$this->db->set('status', 2);
	$this->db->set('closing_amount',$profit);
	$this->db->where('date', $date);
	$this->db->where('daybuk_group', $gid);
	$this->db->update('tbl_daybuk');
}
/*   public function update_daybook1($date,$gid,$Outs1){
$this->db->set('status', 2);
$this->db->set('closing_amount',$Outs1);
$this->db->where('date', $date);
$this->db->where('daybuk_group', $gid);
$this->db->update('tbl_daybuk');
}*/
public function getgrouppdsloan($gid,$cdate)
{
	$this->db->select('*,sum(tbl_group_pds_loan.gpdsloan_amount) as gpdsloan_amount,DATE_FORMAT(MAX(gpdsloan_issue_date),\'%d/%m/%Y\') AS gpdsloan_issue_date');
	$this->db->from('tbl_group_pds_loan');
	$this->db->where('gpdsloan_issue_date >=',date('Y-m-01',strtotime($cdate)));
	$this->db->where('gpdsloan_issue_date <=',date('Y-m-t',strtotime($cdate)));
	$this->db->where("gpdsloan_status",1);
	$this->db->where("gpdsloan_group",$gid);
	$this->db->group_by('gpdsloan_issue_date');
	$this->db->order_by('gpdsloan_id', 'DESC');
	$query = $this->db->get();
	$result=$query->result();
	return $result;
}
public function getgroupbankloan($gid,$cdate)
{
	$this->db->select('*,sum(tbl_group_bank_loan.gbankloan_amount) as gbankloan_amount,DATE_FORMAT(MAX(gbankloan_issue_date),\'%d/%m/%Y\') AS gbankloan_issue_date');
	$this->db->from('tbl_group_bank_loan');
	$this->db->where('gbankloan_issue_date >=',date('Y-m-01',strtotime($cdate)));
	$this->db->where('gbankloan_issue_date <=',date('Y-m-t',strtotime($cdate)));
	$this->db->where("gbankloan_status",1);
	$this->db->where("gbankloan_group",$gid);
	$this->db->group_by('gbankloan_issue_date');
	$this->db->order_by('gbankloan_id', 'DESC');
	$query = $this->db->get();
	$result=$query->result();
	return $result;
}
public function getgroupfedloan($gid,$cdate)
{
	$this->db->select('*,sum(tbl_group_fedaration_loan.gfedloan_amount) as gfedloan_amount,DATE_FORMAT(MAX(gfedloan_issue_date),\'%d/%m/%Y\') AS gfedloan_issue_date');
	$this->db->from('tbl_group_fedaration_loan');
	$this->db->where('gfedloan_issue_date >=',date('Y-m-01',strtotime($cdate)));
	$this->db->where('gfedloan_issue_date <=',date('Y-m-t',strtotime($cdate)));
	$this->db->where("gfedloan_status",1);
	$this->db->where("gfedloan_group",$gid);
	$this->db->group_by('gfedloan_issue_date');
	$this->db->order_by('gfedloan_id', 'DESC');
	$query = $this->db->get();
	$result=$query->result();
	return $result;
}
public function popening()
{
	$date = date('Y-m-d');
	$this->db->select('*');
	$this->db->from('tbl_daybook');
	$this->db->order_by('daybook_id',"desc");
	$this->db->limit(1);
	$date = isset($_GET['date']) ? $_GET['date'] : date('Y-m');
	//$d=date("Y-m", strtotime ( '-1 month' , strtotime ( $date ) )) ;
	$d = date('Y-m-d', strtotime($date .' -1 day'));
	$this->db->where('date', $d);
	//$this->db->where("status",2);
	// $this->db->where('project_id_fk', $prid);
	$query = $this->db->get();
	//print_r($query->row());
	//exit();
	return $query->row();
}
public function get_popening($date)
{
	$this->db->select('*');
	$this->db->from('tbl_daybook');
	$this->db->order_by('daybook_id',"desc");
	$this->db->limit(1);
	$d = date('Y-m-d', strtotime($date .' -1 day'));
	//$d=date("Y-m", strtotime ( '-1 month' , strtotime ( $date ) )) ;
	$this->db->where('date', $d);
	// $this->db->where('project_id_fk', $prid);
	$query = $this->db->get();
	//print_r($query->row());
	//exit();
	return $query->row();
}
public function getpvoucher($cdate)
{
	$this->db->select('*');
	$this->db->from('tbl_project_voucher');
	$this->db->join('tbl_project_vouchhead','vouch_id = vouch_id_fk');
	$this->db->where("voucher_status",1);
	// $this->db->where("project_id_fk",$prid);
	$this->db->where('voucher_date',$cdate);
	//$this->db->where('voucher_date <=',date('Y-m-t',strtotime($cdate)));
	$query = $this->db->get();
	$result=$query->result();
	return $result;
}
public function getpreceipt($cdate)
{
	$this->db->select('*');
	$this->db->from('tbl_project_receipt');
	$this->db->join('tbl_project_receipthead','tbl_project_receipthead.receipt_id = receipt_id_fk');
	$this->db->where("tbl_project_receipt.receipt_status",1);
	// $this->db->where("project_id_fk",$prid);
	$this->db->where('rept_date',$cdate);
	//$this->db->where('rept_date <=',date('Y-m-t',strtotime($cdate)));
	$query = $this->db->get();
	$result=$query->result();
	return $result;
}
public function pclosebalance($date)
{
	$this->db->select('tbl_daybook.closing_amt,tbl_daybook.date');
	$this->db->from('tbl_daybook');
	$this->db->where('tbl_daybook.date',$date);
	// $this->db->where('tbl_daybook.project_id_fk',$prid);
	$this->db->where("daybook_status",2);
	$query = $this->db->get();
	return $query->result();
}
public function pupdate_daybook($date,$profit,$stat){
	$this->db->set('credit_status', $stat);
	$this->db->set('daybook_status', 2);
	$this->db->set('closing_amt',$profit);
	$this->db->where('date', $date);
	// $this->db->where('project_id_fk', $prid);
	$this->db->update('tbl_daybook');
}
         public function getpurchase($cdate)
        {
            $this->db->select('*,SUM(pur_paid_amt) as pur_paid_amt');
            $this->db->from('tbl_purchase');
            $this->db->join('tbl_vendor','vendor_id = vendor_id_fk','left');
            $this->db->where("tbl_purchase.purchase_status",1);
            $this->db->where('purchase_date',$cdate);
			$this->db->where("purchase_mop","Cash");
            //$this->db->where('purchase_date <=',date('Y-m-t',strtotime($cdate)));
            //$this->db->group_by('auto_invoice');
            $this->db->group_by('auto_invoice');
            $query = $this->db->get();
            $result=$query->result();
            return $result;
        }
        
        public function getsaleincome($cdate)
        {
            $this->db->select('*,DATE_FORMAT(sale_date,\'%d/%m/%Y\') AS sale_date,tbl_sale.total_price as total_amount');
            $this->db->from('tbl_sale');
            $this->db->where("tbl_sale.sale_status",1);
             $this->db->where('sale_date',$cdate);
			 $this->db->group_by('auto_invoice');
			 $this->db->order_by('invoice_number','ASCE');
           // $this->db->where('sale_date <=',date('Y-m-t',strtotime($cdate)));
            $query = $this->db->get();
            $result=$query->result();
            return $result;
        }
       /*      public function getfeedpurchase($cdate)
        {
        	$cdate1=date('Y-m-d H:i:s',strtotime($cdate));
            $this->db->select('*,SUM(purchase_total_cost) as purchase_total_cost');
            $this->db->from('tbl_feed_purchase');
            $this->db->where("tbl_feed_purchase.purchase_status",1);
            $this->db->where('created_at',$cdate1);
          //  $this->db->where('created_at <=',date('Y-m-t 12:59:59',strtotime($cdate)));
            //$this->db->group_by('auto_invoice');
           // $this->db->group_by('purchase_vendor_name');
            $query = $this->db->get();
            $result=$query->result();
            return $result;
        } */
            public function getpayroll($cdate)
        {
            $this->db->select('*,sum(payroll_salary) as salary');
            $this->db->from('tbl_payroll');
          
             $this->db->where('payroll_salarydate',$cdate);
           // $this->db->where('payroll_salarydate <=',date('Y-m-t',strtotime($cdate)));
            $query = $this->db->get();
            $result=$query->result();
            return $result;
        }
           public function getadvance($cdate)
        {
            $this->db->select('*,sum(adv_amount) as adv_amount');
            $this->db->from('tbl_advancepayment');
          
             $this->db->where('adv_date',$cdate);
           // $this->db->where('adv_date <=',date('Y-m-t',strtotime($cdate)));
            $query = $this->db->get();
            $result=$query->result();
            return $result;
        }

		public function getVendorVoucher($cdate)
		{
			$this->db->select('*,DATE_FORMAT(voucher_date,\'%d/%m/%Y\') AS vendor_voucher_date');
			$this->db->from('tbl_vendor_voucher');
			$this->db->join('tbl_vendor','vendor_id = vendor_id_fk');
			$this->db->where("tbl_vendor_voucher.voucher_status",1);
			$this->db->where("voucher_date",$cdate);
			$query = $this->db->get();
			$result=$query->result();
			return $result;
		}

		public function getbdeposit($cdate)
		{
			$this->db->select('*,DATE_FORMAT(bd_date,\'%d/%m/%Y\') AS bd_date');
			$this->db->from('tbl_bank_deposit');
			$this->db->join('tbl_bank','bank_id=bd_bank_id_fk');
			$this->db->join('tbl_member','member_id=bd_member_id_fk','left');
			$this->db->where("bd_date",$cdate);
			$this->db->where("bd_status",1);
			$this->db->where("bank_status",1);
			$query = $this->db->get();
			$result=$query->result();
			return $result;
		}

		
		public function getsharedeposit($cdate)
		{
			$this->db->select('*,DATE_FORMAT(m_created_at,\'%d/%m/%Y\') AS m_created_at,sum(member_share_no_shares) as member_share_no_shares');
			$this->db->from('tbl_member');
			$this->db->where("m_created_at",$cdate);
			$this->db->where("member_status",1);
			$query = $this->db->get();
			$result=$query->result();
			return $result;
		}

		public function getfund($cdate)
		{
			$this->db->select('*,DATE_FORMAT(fund_date,\'%d/%m/%Y\') AS fund_date');
			$this->db->from('tbl_fund');
			$this->db->where("fund_date",$cdate);
			$this->db->join('tbl_fund_type','tbl_fund_type.ftype_id=tbl_fund.ftype_id_fk');
			$this->db->where("fund_status",1);
			$query = $this->db->get();
			$result=$query->result();
			return $result;
		}
}
?>
