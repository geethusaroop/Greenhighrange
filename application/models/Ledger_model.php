<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ledger_model extends CI_Model{

	public function __construct()
    {
        parent::__construct();
    }
	public function getDaybookTable($param,$gid){
		$arOrder = array('','enq_custname_fk');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
		// $ledgerbuk_head =(isset($param['ledgerbuk_head']))?$param['ledgerbuk_head']:'';
		// $start_date =(isset($param['start_date']))?$param['start_date']:'';
  //       $end_date =(isset($param['end_date']))?$param['end_date']:'';
		
		
        if($searchValue){
            $this->db->like('head', $searchValue); 
        }
		// if($ledgerbuk_head){
  //             $this->db->like('ledgerbuk_head', $ledgerbuk_head); 
  //        }
		// if($start_date){
  //           $this->db->where('date', $start_date);
  //       }
        // if($end_date){
        //     $this->db->where('date <=', $end_date); 
        // }
		// else{
		// 	 $this->db->where('date', date('Y-m-d'));
		// }
		
        $this->db->where("ledgerbuk_status",1);
		
		$this->db->select('*,DATE_FORMAT(date,\'%d/%m/%Y\') as date,sum(credit) as credit,sum(debit) as debit');
		$this->db->from('tbl_ledgerbuk');
		// $this->db->where('date', date('Y-m-d'));
		 $this->db->where("ledgerbuk_group",$gid);
		$this->db->group_by('ledgerbuk_head');
		$query = $this->db->get();
		$data['data'] = $query->result();
        $data['recordsTotal'] = $this->getDaybookTotalCount($param,$gid);
        $data['recordsFiltered'] = $this->getDaybookTotalCount($param,$gid);
        return $data;

	}
	public function getDaybookTotalCount($param = NULL,$gid){

		$searchValue =($param['searchValue'])?$param['searchValue']:'';
		// $date =(isset($param['date']))?$param['date']:'';
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
		$this->db->from('tbl_ledgerbuk');
		$this->db->where("ledgerbuk_status",1);
		 $this->db->where("ledgerbuk_group",$gid);
		//$this->db->where("date",date('Y-m-d'));
        $query = $this->db->get();
    	return $query->num_rows();
    }
	public function get_sum($gid)
	{
		$this->db->select('SUM(credit) as credit_sum,SUM(debit) as debit_sum');
		$this->db->from('tbl_ledgerbuk');
		$this->db->where("ledgerbuk_status",1);
		 $this->db->where("ledgerbuk_group",$gid);
		$this->db->where("date",date('Y-m-d'));
		$query = $this->db->get();
    	return $query->result();
		
	}
	public function get_sum_($date,$gid)
	{
		$this->db->select('SUM(credit) as credit_sum,SUM(debit) as debit_sum');
		$this->db->from('tbl_ledgerbuk');
		$this->db->where("ledgerbuk_status",1);
		 $this->db->where("ledgerbuk_group",$gid);
		$this->db->where("date",$date);
		$query = $this->db->get();
    	return $query->result();
		
	}
	
	public function opening($gid)
	{
		$date = date('Y-m-d');
		$this->db->select('*');
		$this->db->from('tbl_ledgerbuk');
		$this->db->order_by('daybuk_id',"desc");
		$this->db->limit(1);
		$date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');
		$d = date('Y-m-d', strtotime($date .' -1 day'));
		$this->db->where('date', $d);
		 $this->db->where("ledgerbuk_group",$gid);
		$query = $this->db->get();
		// print_r($query->row());
		// exit();
		return $query->row();
		
	}
	public function get_opening($date,$gid)
	{
		$this->db->select('*');
		$this->db->from('tbl_ledgerbuk');
		$this->db->order_by('daybuk_id',"desc");
		$this->db->limit(1);
		$d = date('Y-m-d', strtotime($date .' -1 day'));
		$this->db->where('date', $d);
		 $this->db->where("ledgerbuk_group",$gid);
		$query = $this->db->get();
		//print_r($query->row());
		//exit();
		return $query->row();
		
	}
	/*public function get_closing1($date)
	{
		$this->db->select('*');
		$this->db->from('tbl_ledgerbuk');
		$this->db->order_by('daybuk_id',"desc");
		$this->db->limit(1);
		$d = date('Y-m-d', strtotime($date));
		$this->db->where('date', $d);
		$query = $this->db->get();
		//print_r($query->row());
		//exit();
		return $query->row();
		
	}*/

	
	public function getTrialbalance($sdate,$edate,$gid)
	{
		
		$this->db->select('*');
		$this->db->from('tbl_ledgerbuk');
		 $this->db->where("ledgerbuk_status",1);
		  $this->db->where("ledgerbuk_group",$gid);
		$this->db->where('date >=', $sdate);
		$this->db->where('date <=', $edate);
		$this->db->group_by('ledgerbuk_head');
		$query = $this->db->get();
        	$result=$query->result();
      		return $result;
	}

	public function getTrialbalances($sdate,$edate)
	{
		
		$this->db->select('*');
		$this->db->from('tbl_ledgerbuk');
		 $this->db->where("ledgerbuk_status",1);
		//  $this->db->where("ledgerbuk_group",$gid);
		$this->db->where('date >=', $sdate);
		$this->db->where('date <=', $edate);
		$this->db->group_by('ledgerbuk_head');
		$query = $this->db->get();
        	$result=$query->result();
      		return $result;
	}


	public function getDaybookTables($param){
		$arOrder = array('','enq_custname_fk');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
		// $ledgerbuk_head =(isset($param['ledgerbuk_head']))?$param['ledgerbuk_head']:'';
		// $start_date =(isset($param['start_date']))?$param['start_date']:'';
  //       $end_date =(isset($param['end_date']))?$param['end_date']:'';
		
		
        if($searchValue){
            $this->db->like('ledgerbuk_head', $searchValue); 
        }
		// if($ledgerbuk_head){
  //             $this->db->like('ledgerbuk_head', $ledgerbuk_head); 
  //        }
		// if($start_date){
  //           $this->db->where('date', $start_date);
  //       }
        // if($end_date){
        //     $this->db->where('date <=', $end_date); 
        // }
		// else{
		// 	 $this->db->where('date', date('Y-m-d'));
		// }
		
        $this->db->where("ledgerbuk_status",1);
		
		$this->db->select('*,DATE_FORMAT(date,\'%d/%m/%Y\') as date,sum(credit) as credit,sum(debit) as debit');
		$this->db->from('tbl_ledgerbuk');
		// $this->db->where('date', date('Y-m-d'));
		// $this->db->where("ledgerbuk_group",$gid);
		$this->db->group_by('ledgerbuk_head');
		$query = $this->db->get();
		$data['data'] = $query->result();
        $data['recordsTotal'] = $this->getDaybooksTotalCount($param);
        $data['recordsFiltered'] = $this->getDaybooksTotalCount($param);
        return $data;

	}
	public function getDaybooksTotalCount($param = NULL){

		$searchValue =($param['searchValue'])?$param['searchValue']:'';
		// $date =(isset($param['date']))?$param['date']:'';
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
		$this->db->from('tbl_ledgerbuk');
		$this->db->where("ledgerbuk_status",1);
		// $this->db->where("ledgerbuk_group",$gid);
		//$this->db->where("date",date('Y-m-d'));
        $query = $this->db->get();
    	return $query->num_rows();
    }

    public function gethead($gid){
		      
		$this->db->select('*');
		$this->db->from('tbl_ledgerbuk');
		$this->db->where("ledgerbuk_status",1);
        $this->db->where("ledgerbuk_group",$gid);		
		$this->db->order_by('ledgerbuk_id', 'DESC');
		$this->db->group_by('head');
        $query = $this->db->get();
         return $query->result();
       	
	}

   public function getmembers($gid){
          
    $this->db->select('*');
    $this->db->from('tbl_member');
    $this->db->where("member_status",1);
    $this->db->where("member_group",$gid);   
    $this->db->order_by('member_id', 'ASCE');
        $query = $this->db->get();
         return $query->result();
        
  }

	public function getledger($gid,$cdate,$edate,$head)
	{
		$this->db->select('*');
		$this->db->from('tbl_ledgerbuk');
		$this->db->where("ledgerbuk_status",1);
        $this->db->where("ledgerbuk_group",$gid);	
        $this->db->where('date >=', $cdate);
		$this->db->where('date <=', $edate);	
		$this->db->where("head",$head);	
		$this->db->order_by('ledgerbuk_id', 'DESC');
        $query = $this->db->get();
         return $query->result();	
	}


   public function getchitty($gid,$cdate,$edate)
    {
        $this->db->select('*,sum(tbl_chitty.chitty_amount) AS chitty_total,DATE_FORMAT(MAX(chitty_date),\'%d/%m/%Y\') AS chitty_dat');
            $this->db->from('tbl_chitty');
            $this->db->where("chitty_status",1);
            $this->db->where("chitty_group",$gid);
            $this->db->where('chitty_date >=', $cdate);
              $this->db->where('chitty_date <=',$edate);
            $this->db->group_by('chitty_date');
            $query = $this->db->get();
            $result=$query->result();
            return $result;
    }

     public function getbusiness($gid,$cdate,$edate)
    {
        $this->db->select('*,sum(tbl_business.bus_amount) AS bus_total,DATE_FORMAT(MAX(bus_date),\'%d/%m/%Y\') AS bus_dat');
            $this->db->from('tbl_business');
            $this->db->where("bus_status",1);
            $this->db->where("bus_group",$gid);
            $this->db->where('bus_date >=', $cdate);
              $this->db->where('bus_date <=',$edate);
            $this->db->group_by('bus_date');
            $query = $this->db->get();
            $result=$query->result();
            return $result;
    }

     public function getchitty1($gid,$cdate,$edate)
    {
        $this->db->select('*,sum(tbl_chitty.chitty_amount) AS chitty_total,DATE_FORMAT(MAX(chitty_date),\'%d/%m/%Y\') AS chitty_dat');
            $this->db->from('tbl_chitty');
            $this->db->where("chitty_status",1);
            $this->db->where("chitty_group",$gid);
            $this->db->where('chitty_date >=', $cdate);
              $this->db->where('chitty_date <=',$edate);
               $this->db->join('tbl_cag','cag_id= chitty_group');
            $this->db->group_by('chitty_date');
            $query = $this->db->get();
            $result=$query->result();
            return $result;
    }

     public function getbusiness1($gid,$cdate,$edate)
    {
        $this->db->select('*,sum(tbl_business.bus_amount) AS bus_total,DATE_FORMAT(MAX(bus_date),\'%d/%m/%Y\') AS bus_dat');
            $this->db->from('tbl_business');
            $this->db->where("bus_status",1);
            $this->db->where("bus_group",$gid);
            $this->db->where('bus_date >=', $cdate);
              $this->db->where('bus_date <=',$edate);
            $this->db->group_by('bus_date');
             $this->db->join('tbl_cag','cag_id= bus_group');
            $query = $this->db->get();
            $result=$query->result();
            return $result;
    }


	public function getgroupdeposit($gid,$cdate,$edate)
        {
            $this->db->select('*,sum(tbl_deposit.deposit_amount) AS deposit_total,sum(awc_deposit_amount) as awc_amount,sum(bank_deposit_amount) as bank_deposit,sum(collection_amt) as collection,sum(other_income) as income,sum(fine) as fines');
            $this->db->from('tbl_deposit');
            $this->db->where("deposit_status",1);
            $this->db->where("shg_name",$gid);
            $this->db->where("deposit_widrawal",0);
            $this->db->where('deposit_date >=', $cdate);
            $this->db->where('deposit_date <=', $edate);
            $this->db->group_by('deposit_member');
            $query = $this->db->get();
            $result=$query->result();
            return $result;
           /* $res = $query->num_rows();
            if($res>0)
            {
            return $result;
          }
          else
          {
            return false;
          }*/
        }

         public function getgdeposit($gid,$cdate,$edate)
        {
            $this->db->select('*,sum(tbl_group_deposit.group_deposit) AS group_deposit,sum(fedaration_deposit) as fedaration_deposit,sum(fd_amount) as fd_amount');
            $this->db->from('tbl_group_deposit');
            $this->db->where("gdeposit_status",1);
            $this->db->where("gdeposit_group",$gid);
            $this->db->where('gdeposit_date >=', $cdate);
             $this->db->where('gdeposit_date <=', $edate);
           // $this->db->group_by('gdeposit_group');
            $query = $this->db->get();
            $result=$query->result();
            return $result;
        }

         public function getgroupwithdrawal($gid,$cdate,$edate)
        {
            $this->db->select('*,sum(tbl_deposit.deposit_widrawal) AS widrawal_total,MAX(DATE_FORMAT(deposit_widrawal_date,,\'%d/%m/%Y\')) AS deposit_widrawal_dat,(sum(tbl_deposit.deposit_amount)-sum(tbl_deposit.deposit_widrawal)) AS balance');
            $this->db->from('tbl_deposit');
            $this->db->where("deposit_status",1);
            $this->db->where("shg_name",$gid);
            $this->db->where('deposit_widrawal !=', 0);
            $this->db->where('deposit_widrawal_date >=', $cdate);
             $this->db->where('deposit_widrawal_date <=', $edate);
            $this->db->join('tbl_member','member_id= deposit_member');
            $this->db->group_by('deposit_member');
            $query = $this->db->get();
            $result=$query->result();
            return $result;
        }

          public function getgroupdeposit1($gid,$cdate,$edate)
        {
            $this->db->select('*');
            $this->db->from('tbl_deposit');
            $this->db->where("deposit_status",1);
            $this->db->where("shg_name",$gid);
            $this->db->where("deposit_widrawal",0);
            $this->db->where('deposit_date >=', $cdate);
            $this->db->where('deposit_date <=', $edate);
            //$this->db->group_by('deposit_member');
            //$this->db->join('tbl_member','member_id= deposit_member');
              $this->db->order_by('deposit_date', 'ASCE');
            $query = $this->db->get();
            $result=$query->result();
            return $result;
        }

           public function getgdeposit1($gid,$cdate,$edate)
        {
            $this->db->select('*');
            $this->db->from('tbl_group_deposit');
            $this->db->where("gdeposit_status",1);
            $this->db->where("gdeposit_group",$gid);
            $this->db->where('gdeposit_date >=', $cdate);
             $this->db->where('gdeposit_date <=', $edate);
           // $this->db->group_by('gdeposit_group');
              $this->db->join('tbl_cag','cag_id= gdeposit_group');
               $this->db->order_by('gdeposit_date', 'ASCE');
            $query = $this->db->get();
            $result=$query->result();
            return $result;
        }

         public function getgroupwithdrawal1($gid,$cdate,$edate)
        {
            $this->db->select('*');
            $this->db->from('tbl_deposit');
            $this->db->where("deposit_status",1);
          //  $this->db->where("shg_name",$gid);
            $this->db->where('deposit_widrawal !=', 0);
            $this->db->where('deposit_widrawal_date >=', $cdate);
            $this->db->where('deposit_widrawal_date <=', $edate);
           // $this->db->join('tbl_member','member_id= deposit_member');
           // $this->db->group_by('deposit_member');
             $this->db->order_by('deposit_widrawal_date', 'ASCE');
            $query = $this->db->get();
            $result=$query->result();
            return $result;
        }

        public function getupnrmloan1($gid,$cdate,$edate)
        {
           $this->db->select('*');
            $this->db->from('tbl_upnrmloan_repayment');
           // $this->db->join('tbl_member','upnrmloan_repay_member = member_id');
             $this->db->join('tbl_upnrmloan','upnrmloan_internalid = upnrmloan_id','left');
            $this->db->where('upnrmloan_repayment_date >=', $cdate);
             $this->db->where('upnrmloan_repayment_date <=', $edate);
            $this->db->where("upnrmloan_repayment_status",1);
           // $this->db->where("member_group",$gid);
           // $this->db->group_by('tbl_member.member_id');
              $this->db->group_by('upnrmloan_repay_member');
            $this->db->order_by('upnrmloan_repayment_id', 'ASCE');
            $query = $this->db->get();
            $result=$query->result();
            return $result;
        }


         public function getupnrmloans($gid,$cdate,$edate)
        {
           $this->db->select('*');
            $this->db->from('tbl_upnrmloan');
           // $this->db->join('tbl_member','upnrmloan_repay_member = member_id');
             //$this->db->join('tbl_upnrmloan','upnrmloan_internalid = upnrmloan_id');
            $this->db->where('upnrmloan_sdate >=', $cdate);
             $this->db->where('upnrmloan_sdate <=', $edate);
            //$this->db->where("upnrmloan_status",1);
              $where = '(upnrmloan_status="1" or upnrmloan_status = "2")';
            $this->db->where($where);
           // $this->db->where("member_group",$gid);
           // $this->db->group_by('tbl_member.member_id');
              $this->db->group_by('upnrmloan_member');
            $this->db->order_by('upnrmloan_id', 'ASCE');
            $query = $this->db->get();
            $result=$query->result();
            return $result;
        }

         public function getgloan1($gid,$cdate,$edate)
        {
            $this->db->select('*,tbl_loan_repayment.loan_intrest_amt as loan_intrest');
            $this->db->from('tbl_loan_repayment');
           // $this->db->join('tbl_member','loan_repay_member = member_id');
            $this->db->join('tbl_loan','loan_loan_id = loan_id','left');
            $this->db->where('tbl_loan_repayment.loan_repayment_date >=', $cdate);
              $this->db->where('tbl_loan_repayment.loan_repayment_date <=', $edate);
            $this->db->where("loan_repayment_status",1);
           // $this->db->where("member_group",$gid);
            $this->db->group_by('loan_repay_member');
            $this->db->order_by('loan_repayment_id', 'ASCE');
            $query = $this->db->get();
            $result=$query->result();
            return $result;
        }

         public function getgloans($gid,$cdate,$edate)
        {
            $this->db->select('*');
            $this->db->from('tbl_loan');
          
            $this->db->where('tbl_loan.loan_sdate >=', $cdate);
              $this->db->where('tbl_loan.loan_sdate <=', $edate);
            //$this->db->where("loan_status",1);
            $where = '(loan_status="1" or loan_status = "2")';
            $this->db->where($where);
           // $this->db->where("member_group",$gid);
            $this->db->group_by('loan_member');
            $this->db->order_by('loan_id', 'ASCE');
            $query = $this->db->get();
            $result=$query->result();
            return $result;
        }



         public function getksbcdcloan1($gid,$cdate,$edate)
        {
            $this->db->select('*,tbl_ksbcdcloan_repayment.ksbcdcloan_intrest_amt as ksbcdcloan_intrest');
            $this->db->from('tbl_ksbcdcloan_repayment');
           // $this->db->join('tbl_member','ksbcdcloan_repay_member = member_id');
           $this->db->join('tbl_ksbcdcloan','ksbcdcloan_internalid = ksbcdcloan_id');
            $this->db->where('tbl_ksbcdcloan_repayment.ksbcdcloan_repayment_date >=', $cdate);
            $this->db->where('tbl_ksbcdcloan_repayment.ksbcdcloan_repayment_date <=', $edate);
            $this->db->where("ksbcdcloan_repayment_status",1);
           // $this->db->where("member_group",$gid);
           // $this->db->group_by('tbl_member.member_id');
              $this->db->group_by('ksbcdcloan_repay_member');
            $this->db->order_by('ksbcdcloan_repayment_id', 'ASCE');
            $query = $this->db->get();
            $result=$query->result();
            return $result;
        }


         public function getksbcdcloans($gid,$cdate,$edate)
        {
            $this->db->select('*');
            $this->db->from('tbl_ksbcdcloan');
           // $this->db->join('tbl_member','ksbcdcloan_repay_member = member_id');
           //$this->db->join('tbl_ksbcdcloan','ksbcdcloan_internalid = ksbcdcloan_id');
            $this->db->where('tbl_ksbcdcloan.ksbcdcloan_sdate >=', $cdate);
            $this->db->where('tbl_ksbcdcloan.ksbcdcloan_sdate <=', $edate);
            //$this->db->where("ksbcdcloan_status",1);
             $where = '(ksbcdcloan_status="1" or ksbcdcloan_status = "2")';
            $this->db->where($where);
           // $this->db->where("member_group",$gid);
           // $this->db->group_by('tbl_member.member_id');
              $this->db->group_by('ksbcdcloan_member');
            $this->db->order_by('ksbcdcloan_id', 'ASCE');
            $query = $this->db->get();
            $result=$query->result();
            return $result;
        }

        public function gethdsloan1($gid,$cdate,$edate)
        {
            $this->db->select('*,tbl_hdsloan_repayment.hdsloan_intrest_amt as hdsloan_intrest');
            $this->db->from('tbl_hdsloan_repayment');
           // $this->db->join('tbl_member','hdsloan_repay_member = member_id');
            $this->db->join('tbl_hdsloan','hdsloan_internalid = hdsloan_id');
            $this->db->where('tbl_hdsloan_repayment.hdsloan_repayment_date >=', $cdate);
            $this->db->where('tbl_hdsloan_repayment.hdsloan_repayment_date <=', $edate);
            $this->db->where("hdsloan_repayment_status",1);
           // $this->db->where("member_group",$gid);
            //$this->db->group_by('tbl_member.member_id');
             $this->db->group_by('hdsloan_repay_member');
            $this->db->order_by('hdsloan_repayment_id', 'ASCE');
            $query = $this->db->get();
            $result=$query->result();
            return $result;
        }

         public function gethdsloans($gid,$cdate,$edate)
        {
            $this->db->select('*');
            $this->db->from('tbl_hdsloan');
          
            $this->db->where('tbl_hdsloan.hdsloan_sdate >=', $cdate);
            $this->db->where('tbl_hdsloan.hdsloan_sdate <=', $edate);
            //$this->db->where("hdsloan_status",1);
             $where = '(hdsloan_status="1" or hdsloan_status = "2")';
            $this->db->where($where);
           // $this->db->where("member_group",$gid);
            //$this->db->group_by('tbl_member.member_id');
             $this->db->group_by('hdsloan_member');
            $this->db->order_by('hdsloan_id', 'ASCE');
            $query = $this->db->get();
            $result=$query->result();
            return $result;
        }




    public function getupnrmloan($gid,$cdate,$edate)
        {
           $this->db->select('*,tbl_member.member_name,tbl_member.member_mid,sum(tbl_upnrmloan_repayment.upnrmloan_repayment_amt) AS tpayment,sum(tbl_upnrmloan_repayment.upnrmloan_intrest_amt) AS tintrest,sum(tbl_upnrmloan.upnrmloan_amount) as tamount,tbl_upnrmloan_repayment.upnrmloan_intrest_amt,sum(tbl_upnrmloan_repayment.upnrmloan_balance) as upnrmloan_balance');
            $this->db->from('tbl_upnrmloan_repayment');
            $this->db->join('tbl_member','upnrmloan_repay_member = member_id');
             $this->db->join('tbl_upnrmloan','upnrmloan_internalid = upnrmloan_id');
            $this->db->where('upnrmloan_repayment_date >=', $cdate);
             $this->db->where('upnrmloan_repayment_date <=', $edate);
            $this->db->where("upnrmloan_repayment_status",1);
            $this->db->where("member_group",$gid);
           // $this->db->group_by('tbl_member.member_id');
            $this->db->order_by('upnrmloan_repayment_id', 'ASCE');
            $query = $this->db->get();
            $result=$query->result();
            return $result;
        }



       public function getgloan($gid,$cdate,$edate)
        {
          
            $this->db->select('*,tbl_member.member_name,tbl_member.member_mid,sum(tbl_loan_repayment.loan_repayment_amt) AS tpayment,sum(tbl_loan_repayment.loan_intrest_amt) AS tintrest,sum(tbl_loan.loan_amount) as tamount,tbl_loan_repayment.loan_repayment_date,tbl_loan_repayment.loan_intrest_amt,sum(tbl_loan_repayment.loan_balance) as loan_balance');
            $this->db->from('tbl_loan_repayment');
            $this->db->join('tbl_member','loan_repay_member = member_id');
            $this->db->join('tbl_loan','loan_loan_id = loan_id');
            $this->db->where('tbl_loan_repayment.loan_repayment_date >=', $cdate);
              $this->db->where('tbl_loan_repayment.loan_repayment_date <=', $edate);
            $this->db->where("loan_repayment_status",1);
            $this->db->where("member_group",$gid);
          //  $this->db->group_by('tbl_member.member_id');
            $this->db->order_by('loan_repayment_id', 'ASCE');
            $query = $this->db->get();
            $result=$query->result();
            return $result;
        }

        public function getksbcdcloan($gid,$cdate,$edate)
        {
            $this->db->select('*,tbl_member.member_name,tbl_member.member_mid,sum(tbl_ksbcdcloan_repayment.ksbcdcloan_repayment_amt) AS tpayment,sum(tbl_ksbcdcloan_repayment.ksbcdcloan_intrest_amt) AS tintrest,sum(tbl_ksbcdcloan.ksbcdcloan_amount) as tamount,tbl_ksbcdcloan_repayment.ksbcdcloan_repayment_date,sum(tbl_ksbcdcloan_repayment.ksbcdcloan_balance) as ksbcdcloan_balance');
            $this->db->from('tbl_ksbcdcloan_repayment');
            $this->db->join('tbl_member','ksbcdcloan_repay_member = member_id');
              $this->db->join('tbl_ksbcdcloan','ksbcdcloan_internalid = ksbcdcloan_id');
            $this->db->where('tbl_ksbcdcloan_repayment.ksbcdcloan_repayment_date >=', $cdate);
               $this->db->where('tbl_ksbcdcloan_repayment.ksbcdcloan_repayment_date <=', $edate);
            $this->db->where("ksbcdcloan_repayment_status",1);
            $this->db->where("member_group",$gid);
            $this->db->group_by('tbl_member.member_id');
            $this->db->order_by('ksbcdcloan_repayment_id', 'ASCE');
            $query = $this->db->get();
            $result=$query->result();
            return $result;
        }

        public function gethdsloan($gid,$cdate,$edate)
        {
            $this->db->select('*,tbl_member.member_name,tbl_member.member_mid,sum(tbl_hdsloan_repayment.hdsloan_repayment_amt) AS tpayment,sum(tbl_hdsloan_repayment.hdsloan_intrest_amt) AS tintrest,sum(tbl_hdsloan.hdsloan_amount) as tamount,tbl_hdsloan_repayment.hdsloan_repayment_date,sum(tbl_hdsloan_repayment.hdsloan_balance) as hdsloan_balance');
            $this->db->from('tbl_hdsloan_repayment');
            $this->db->join('tbl_member','hdsloan_repay_member = member_id');
                $this->db->join('tbl_hdsloan','hdsloan_internalid = hdsloan_id');
            $this->db->where('tbl_hdsloan_repayment.hdsloan_repayment_date >=', $cdate);
            $this->db->where('tbl_hdsloan_repayment.hdsloan_repayment_date <=', $edate);
            $this->db->where("hdsloan_repayment_status",1);
            $this->db->where("member_group",$gid);
            $this->db->group_by('tbl_member.member_id');
            $this->db->order_by('hdsloan_repayment_id', 'ASCE');
            $query = $this->db->get();
            $result=$query->result();
            return $result;
        }


          public function getupnrmloan_issue($gid,$cdate,$edate)
        {
           $this->db->select('*,tbl_member.member_name,tbl_member.member_mid,sum(tbl_upnrmloan.upnrmloan_amount) as tamount,tbl_upnrmloan.upnrmloan_sdate');
            $this->db->from('tbl_upnrmloan');
            $this->db->join('tbl_member','upnrmloan_member = member_id');
            $this->db->where('upnrmloan_sdate >=', $cdate);
             $this->db->where('upnrmloan_sdate <=', $edate);
            //$this->db->where("upnrmloan_status",1);
              $where = '(upnrmloan_status="1" or upnrmloan_status = "2")';
            $this->db->where($where);
            $this->db->where("member_group",$gid);
            $this->db->group_by('tbl_member.member_id');
            $this->db->order_by('upnrmloan_id', 'ASCE');
            $query = $this->db->get();
            $result=$query->result();
            return $result;
        }


          public function getloan_issue($gid,$cdate,$edate)
        {
           $this->db->select('*,tbl_member.member_name,tbl_member.member_mid,sum(tbl_loan.loan_amount) as tamount,,sum(tbl_loan.add_on_loan) as add_on_loan');
            $this->db->from('tbl_loan');
            $this->db->join('tbl_member','loan_member = member_id','left');
            $this->db->where('loan_sdate >=', $cdate);
               $this->db->where('loan_sdate <=', $edate);
            //$this->db->where("loan_status",1);
            $where = '(loan_status="1" or loan_status = "2")';
            $this->db->where($where);
            $this->db->where("member_group",$gid);
            $this->db->group_by('tbl_member.member_id');
            $this->db->order_by('loan_id', 'ASCE');
            $query = $this->db->get();
            $result=$query->result();
            return $result;
        }


   		public function getksbcdcloan_issue($gid,$cdate,$edate)
        {
           $this->db->select('*,tbl_member.member_name,tbl_member.member_mid,sum(tbl_ksbcdcloan.ksbcdcloan_amount) as tamount');
            $this->db->from('tbl_ksbcdcloan');
            $this->db->join('tbl_member','ksbcdcloan_member = member_id');
            $this->db->where('ksbcdcloan_sdate >=', $cdate);
            $this->db->where('ksbcdcloan_sdate <=', $edate);
            //$this->db->where("ksbcdcloan_status",1);
             $where = '(ksbcdcloan_status="1" or ksbcdcloan_status = "2")';
            $this->db->where($where);
            $this->db->where("member_group",$gid);
            $this->db->group_by('tbl_member.member_id');
            $this->db->order_by('ksbcdcloan_id', 'ASCE');
            $query = $this->db->get();
            $result=$query->result();
            return $result;
        }

        	public function getpdsloan_issue($gid,$cdate,$edate)
        {
           $this->db->select('*,tbl_member.member_name,tbl_member.member_mid,sum(tbl_hdsloan.hdsloan_amount) as tamount');
            $this->db->from('tbl_hdsloan');
            $this->db->join('tbl_member','hdsloan_member = member_id');
            $this->db->where('hdsloan_sdate >=', $cdate);
              $this->db->where('hdsloan_sdate <=', $edate);
            //$this->db->where("hdsloan_status",1);
               $where = '(hdsloan_status="1" or hdsloan_status = "2")';
            $this->db->where($where);
            $this->db->where("member_group",$gid);
            $this->db->group_by('tbl_member.member_id');
            $this->db->order_by('hdsloan_id', 'ASCE');
            $query = $this->db->get();
            $result=$query->result();
            return $result;
        }

        public function getvoucher($gid,$cdate,$edate)
        {
            $this->db->select('*');
            $this->db->from('tbl_voucher');
             $this->db->join('tbl_vouchhead','vouch_id = vouch_id_fk');
            $this->db->where("voucher_status",1);
            $this->db->where("voucher_group",$gid);
            $this->db->where('voucher_date >=', $cdate);
             $this->db->where('voucher_date <=', $edate);
              $this->db->order_by('voucher_date', 'ASCE');
            $query = $this->db->get();
            $result=$query->result();
            return $result;
        }

         public function getreceipt($gid,$cdate,$edate)
        {
            $this->db->select('*');
            $this->db->from('tbl_receipt');
              $this->db->join('tbl_receipthead','tbl_receipthead.receipt_id = receipt_id_fk');
            $this->db->where("tbl_receipt.receipt_status",1);
            $this->db->where("group",$gid);
            $this->db->where('rept_date >=', $cdate);
             $this->db->where('rept_date <=', $edate);
              $this->db->order_by('rept_date', 'ASCE');
              // $this->db->group_by('receipt_id_fk');
                $query = $this->db->get();
                $result=$query->result();
                return $result;
        }


        
        /*public function getaddon_grouploan($gid,$cdate,$edate)
        {
            $this->db->select('*,tbl_member.member_name,tbl_member.member_mid,sum(tbl_loan.add_on_loan) as add_on_loan,DATE_FORMAT(MAX(add_on_loan_date),\'%d/%m/%Y\') AS add_on_loan_date');
            $this->db->from('tbl_loan');
            $this->db->join('tbl_member','loan_member = member_id');
            $this->db->where('add_on_loan_date >=',$cdate);
            $this->db->where('add_on_loan_date <=',$edate);
            $this->db->where("loan_status",1);
            $this->db->where("member_group",$gid);
           // $this->db->group_by('tbl_member.member_id');
             $this->db->group_by('add_on_loan_date');
            $this->db->order_by('loan_id', 'DESC');
            $query = $this->db->get();
            $result=$query->result();
            return $result;
        }*/

         public function getaddon_grouploan($gid,$cdate,$edate)
        {
            $this->db->select('*,tbl_member.member_name,tbl_member.member_mid,sum(tbl_add_on_loan.add_on_loan_amt) as add_on_loan,DATE_FORMAT(MAX(add_on_loan_date),\'%d/%m/%Y\') AS add_on_loan_date');
            $this->db->from('tbl_add_on_loan');
            $this->db->join('tbl_member','add_on_loan_member = member_id');
            $this->db->where('add_on_loan_date >=',$cdate);
            $this->db->where('add_on_loan_date <=',$edate);
            $this->db->where("add_on_loan_status",1);
            $this->db->where("member_group",$gid);
            $this->db->group_by('add_on_loan_date');
            $this->db->order_by('add_on_loan_id', 'DESC');
            $query = $this->db->get();
            $result=$query->result();
            return $result;
        }

        public function getaddon_fedloan($gid,$cdate,$edate)
        {
            $this->db->select('*,tbl_member.member_name,tbl_member.member_mid,sum(tbl_upnrmloan.add_on_loan) as add_on_loan,DATE_FORMAT(MAX(add_on_loan_date),\'%d/%m/%Y\') AS add_on_loan_date');
            $this->db->from('tbl_upnrmloan');
            $this->db->join('tbl_member','upnrmloan_member = member_id');
            $this->db->where('add_on_loan_date >=',$cdate);
            $this->db->where('add_on_loan_date <=',$edate);
            $this->db->where("upnrmloan_status",1);
            $this->db->where("member_group",$gid);
           // $this->db->group_by('tbl_member.member_id');
             $this->db->group_by('add_on_loan_date');
            $this->db->order_by('upnrmloan_id', 'DESC');
            $query = $this->db->get();
            $result=$query->result();
            return $result;
        }

          public function getaddon_bankloan($gid,$cdate,$edate)
        {
            $this->db->select('*,tbl_member.member_name,tbl_member.member_mid,sum(tbl_ksbcdcloan.add_on_loan) as add_on_loan,DATE_FORMAT(MAX(add_on_loan_date),\'%d/%m/%Y\') AS add_on_loan_date');
            $this->db->from('tbl_ksbcdcloan');
            $this->db->join('tbl_member','ksbcdcloan_member = member_id');
            $this->db->where('add_on_loan_date >=',$cdate);
            $this->db->where('add_on_loan_date <=',$edate);
            $this->db->where("ksbcdcloan_status",1);
            $this->db->where("member_group",$gid);
           // $this->db->group_by('tbl_member.member_id');
             $this->db->group_by('add_on_loan_date');
            $this->db->order_by('ksbcdcloan_id', 'DESC');
            $query = $this->db->get();
            $result=$query->result();
            return $result;
        }

            public function getaddon_pdsloan($gid,$cdate,$edate)
        {
            $this->db->select('*,tbl_member.member_name,tbl_member.member_mid,sum(tbl_hdsloan.add_on_loan) as add_on_loan,DATE_FORMAT(MAX(add_on_loan_date),\'%d/%m/%Y\') AS add_on_loan_date');
            $this->db->from('tbl_hdsloan');
            $this->db->join('tbl_member','hdsloan_member = member_id');
            $this->db->where('add_on_loan_date >=',$cdate);
            $this->db->where('add_on_loan_date <=',$edate);
            $this->db->where("hdsloan_status",1);
            $this->db->where("member_group",$gid);
           // $this->db->group_by('tbl_member.member_id');
             $this->db->group_by('add_on_loan_date');
            $this->db->order_by('hdsloan_id', 'DESC');
            $query = $this->db->get();
            $result=$query->result();
            return $result;
        }



      

           public function getgrouppdsloan($gid,$cdate,$edate)
        {
            $this->db->select('*,sum(tbl_group_pds_loan.gpdsloan_amount) as gpdsloan_amount,DATE_FORMAT(MAX(gpdsloan_issue_date),\'%d/%m/%Y\') AS gpdsloan_issue_date');
            $this->db->from('tbl_group_pds_loan');
            $this->db->where('gpdsloan_issue_date >=',$cdate);
            $this->db->where('gpdsloan_issue_date <=',$edate);
            $this->db->where("gpdsloan_status",1);
            $this->db->where("gpdsloan_group",$gid);
             $this->db->group_by('gpdsloan_issue_date');
            $this->db->order_by('gpdsloan_id', 'DESC');
            $query = $this->db->get();
            $result=$query->result();
            return $result;
        }


          public function getgroupbankloan($gid,$cdate,$edate)
        {
            $this->db->select('*,sum(tbl_group_bank_loan.gbankloan_amount) as gbankloan_amount,DATE_FORMAT(MAX(gbankloan_issue_date),\'%d/%m/%Y\') AS gbankloan_issue_date');
            $this->db->from('tbl_group_bank_loan');
            $this->db->where('gbankloan_issue_date >=',$cdate);
            $this->db->where('gbankloan_issue_date <=',$edate);
            $this->db->where("gbankloan_status",1);
            $this->db->where("gbankloan_group",$gid);
             $this->db->group_by('gbankloan_issue_date');
            $this->db->order_by('gbankloan_id', 'DESC');
            $query = $this->db->get();
            $result=$query->result();
            return $result;
        }


          public function getgroupfedloan($gid,$cdate,$edate)
        {
            $this->db->select('*,sum(tbl_group_fedaration_loan.gfedloan_amount) as gfedloan_amount,DATE_FORMAT(MAX(gfedloan_issue_date),\'%d/%m/%Y\') AS gfedloan_issue_date');
            $this->db->from('tbl_group_fedaration_loan');
            $this->db->where('gfedloan_issue_date >=',$cdate);
            $this->db->where('gfedloan_issue_date <=',$edate);
            $this->db->where("gfedloan_status",1);
            $this->db->where("gfedloan_group",$gid);
             $this->db->group_by('gfedloan_issue_date');
            $this->db->order_by('gfedloan_id', 'DESC');
            $query = $this->db->get();
            $result=$query->result();
            return $result;
        }


         public function getchitty_withdraw($gid,$cdate,$edate)
    {
        $this->db->select('*,sum(tbl_chitty.chitty_widrawal) AS chitty_withdraw,DATE_FORMAT(MAX(chitty_widrawal_date),\'%d/%m/%Y\') AS chitty_dat');
            $this->db->from('tbl_chitty');
            $this->db->where("chitty_status",2);
            $this->db->where("chitty_group",$gid);
            $this->db->where('chitty_widrawal_date >=', $cdate);
              $this->db->where('chitty_widrawal_date <=',$edate);
            $this->db->group_by('chitty_widrawal_date');
            $query = $this->db->get();
            $result=$query->result();
            return $result;
    }


      public function getbusiness_withdraw($gid,$cdate,$edate)
    {
        $this->db->select('*,sum(tbl_business.bus_returns) AS bus_returns,DATE_FORMAT(MAX(bus_returns_date),\'%d/%m/%Y\') AS bus_dat');
            $this->db->from('tbl_business');
            $this->db->where("bus_returns_status",1);
            $this->db->where("bus_group",$gid);
            $this->db->where('bus_returns_date >=', $cdate);
              $this->db->where('bus_returns_date <=',$edate);
            $this->db->group_by('bus_returns_date');
            $query = $this->db->get();
            $result=$query->result();
            return $result;
    }

    public function getbank_withdraw($gid,$cdate,$edate)
            {
                $this->db->select('*,sum(tbl_group_deposit.group_deposit_withdrawal) AS deposit_withdrawal,DATE_FORMAT(MAX(group_deposit_withdrawal_date),\'%d/%m/%Y\') AS bank_withdraw_dat');
                    $this->db->from('tbl_group_deposit');
                    $this->db->where("group_deposit_withdrawal_status",1);
                    $this->db->where("gdeposit_group",$gid);
                    $this->db->where('group_deposit_withdrawal_date >=',$cdate);
                      $this->db->where('group_deposit_withdrawal_date <=',$edate);
                    $this->db->group_by('group_deposit_withdrawal_date');
                    $query = $this->db->get();
                    $result=$query->result();
                    return $result;
            }

             public function getfed_withdraw($gid,$cdate,$edate)
            {
                $this->db->select('*,sum(tbl_group_deposit.fed_deposit_withdrawal) AS fed_withdrawal,DATE_FORMAT(MAX(fed_deposit_withdrawal_date),\'%d/%m/%Y\') AS fed_withdraw_dat');
                    $this->db->from('tbl_group_deposit');
                    $this->db->where("fed_deposit_withdrawal_status",1);
                    $this->db->where("gdeposit_group",$gid);
                    $this->db->where('fed_deposit_withdrawal_date >=', $cdate);
                      $this->db->where('fed_deposit_withdrawal_date <=',$edate);
                    $this->db->group_by('fed_deposit_withdrawal_date');
                    $query = $this->db->get();
                    $result=$query->result();
                    return $result;
            }

             public function getfd_withdraw($gid,$cdate,$edate)
            {
                $this->db->select('*,sum(tbl_group_deposit.fd_withdrawal) AS fd_withdraw,DATE_FORMAT(MAX(fd_withdrawal_date),\'%d/%m/%Y\') AS fd_withdraw_dat');
                    $this->db->from('tbl_group_deposit');
                    $this->db->where("fd_withdrawal_status",1);
                    $this->db->where("gdeposit_group",$gid);
                    $this->db->where('fd_withdrawal_date >=',$cdate);
                      $this->db->where('fd_withdrawal_date <=',$edate);
                    $this->db->group_by('fd_withdrawal_date');
                    $query = $this->db->get();
                    $result=$query->result();
                    return $result;
            }


      public function getpvoucher($cdate,$edate)
        {
            $this->db->select('*');
            $this->db->from('tbl_project_voucher');
             $this->db->join('tbl_project_vouchhead','vouch_id = vouch_id_fk');
            $this->db->where("voucher_status",1);
           // $this->db->where("project_id_fk",$prid);
            $this->db->where('voucher_date >=',$cdate);
            $this->db->where('voucher_date <=',$edate);
            $query = $this->db->get();
            $result=$query->result();
            return $result;
        }

         public function getpreceipt($cdate,$edate)
        {
            $this->db->select('*');
            $this->db->from('tbl_project_receipt');
              $this->db->join('tbl_project_receipthead','tbl_project_receipthead.receipt_id = receipt_id_fk');
            $this->db->where("tbl_project_receipt.receipt_status",1);
          //  $this->db->where("project_id_fk",$prid);
             $this->db->where('rept_date >=',$cdate);
            $this->db->where('rept_date <=',$edate);
            $query = $this->db->get();
            $result=$query->result();
            return $result;
        }

          public function getpurchase($cdate,$edate)
        {
            $this->db->select('*');
            $this->db->from('tbl_purchase');
               $this->db->join('tbl_vendor','vendor_id = vendor_id_fk','left');
                 $this->db->join('tbl_supp_acc','sup_id_fk = vendor_id','left');
            $this->db->where("tbl_purchase.purchase_status",1);
             $this->db->where('purchase_date >=',$cdate);
            $this->db->where('purchase_date <=',$edate);
            $this->db->group_by('auto_invoice');
            $query = $this->db->get();
            $result=$query->result();
            return $result;
        }

        


        public function getsaleincome($cdate,$edate)
        {
            $this->db->select('*,sum(tbl_sale.total_price) as total_amount,DATE_FORMAT(MAX(sale_date),\'%d/%m/%Y\') AS sale_date');
            $this->db->from('tbl_sale');
               $this->db->join('tbl_member','member_id = member_id_fk','left');
               $this->db->where("tbl_sale.sale_mop","Cash");
            $this->db->where("tbl_sale.sale_status",1);
             $this->db->where('sale_date >=',$cdate);
            $this->db->where('sale_date <=',$edate);
            $query = $this->db->get();
            $result=$query->result();
            return $result;
        }

        
          public function getpayroll($cdate,$edate)
        {
            $this->db->select('*,sum(payroll_salary) as salary');
            $this->db->from('tbl_payroll');
             $this->db->join('tbl_employee','emp_id = emp_id_fk');
             $this->db->where('payroll_salarydate >=',$cdate);
            $this->db->where('payroll_salarydate <=',$edate);
            $query = $this->db->get();
            $result=$query->result();
            return $result;
        }

           public function getadvance($cdate,$edate)
        {
            $this->db->select('*,sum(adv_amount) as adv_amount');
            $this->db->from('tbl_advancepayment');
            $this->db->join('tbl_employee','emp_id = emp_id_fk');
             $this->db->where('adv_date >=',$cdate);
            $this->db->where('adv_date <=',$edate);
            $query = $this->db->get();
            $result=$query->result();
            return $result;
        }

        public function opening_ledger($prid,$cdate,$vendor_id)
        {
          $this->db->select('*,COALESCE(pur_new_bal,0) as total_bal');
          $this->db->from('tbl_purchase');
          $this->db->join('tbl_vendor','vendor_id = vendor_id_fk');
          $this->db->where("tbl_purchase.purchase_status",1);
        //  $this->db->where("tbl_purchase.project_id_fk",$prid);
          $this->db->where("tbl_purchase.vendor_id_fk",$vendor_id);
          $this->db->group_by('auto_invoice');
          //$this->db->limit(1);
          $date = isset($_GET['date']) ? $_GET['date'] : $cdate;
          $d = date('Y-m-d', strtotime($date .' -1 day'));
          $where = '(purchase_date between  "2022-04-01" and "'.$d.'")';
          $this->db->where($where);
          //$this->db->where('purchase_date<=', $d);
          $query = $this->db->get();
          $result=$query->result();
          return $result;
        //  return $query->row();
          
        }

        public function opening_ledger1($prid,$cdate,$vendor_id)
        {
          $this->db->select('*,COALESCE(sum(voucher_amount),0) as voucher_amount');
          $this->db->from('tbl_vendor_voucher');
          $this->db->join('tbl_vendor','vendor_id = vendor_id_fk','left');
          $this->db->where("tbl_vendor_voucher.voucher_status",1);
         // $this->db->where("tbl_vendor_voucher.project_id_fk",$prid);
          $this->db->where("tbl_vendor_voucher.vendor_id_fk",$vendor_id);
          $this->db->limit(1);
         $date = isset($_GET['date']) ? $_GET['date'] : $cdate;
         $d = date('Y-m-d', strtotime($date .' -1 day'));
         $where = '(voucher_date between  "2022-04-01" and "'.$d.'")';
         $this->db->where($where);
        //  $this->db->where('voucher_date<=', $d);
          $query = $this->db->get();
          return $query->row();
          
        }

        public function opening_ledger2($prid,$cdate,$vendor_id)
        {
          $this->db->select('*,COALESCE(opening_balance,0) as opening_balance');
          $this->db->from('tbl_vendor');
          $this->db->where("tbl_vendor.vendorstatus",1);
         // $this->db->where("tbl_vendor.project_id_fk",$prid);
          $this->db->where("tbl_vendor.vendor_id",$vendor_id);
          $query = $this->db->get();
          return $query->row();
        }

        public function getpurchase_ledger($prid,$cdate,$edate,$vendor_id)
        {
            $this->db->select('*,sum(purchase_netamt) as total');
            $this->db->from('tbl_purchase');
            $this->db->join('tbl_vendor','vendor_id = vendor_id_fk','left');
           // $this->db->join('tbl_supp_acc','sup_id_fk = vendor_id');
            $this->db->where("tbl_purchase.purchase_status",1);
          //  $this->db->where("tbl_purchase.project_id_fk",$prid);
            $this->db->where("tbl_purchase.vendor_id_fk",$vendor_id);
             $this->db->where('purchase_date >=',$cdate);
            $this->db->where('purchase_date <=',$edate);
         //   $this->db->where('purchase_mop',"Cash");
            $this->db->group_by('auto_invoice');
            $this->db->order_by('purchase_date','ASCE');
            $query = $this->db->get();
            $result=$query->result();
            return $result;
        }

        public function getpurchase_ledger_pay($prid,$cdate,$edate,$vendor_id)
        {
            $this->db->select('*');
            $this->db->from('tbl_vendor_voucher');
            $this->db->join('tbl_vendor','vendor_id = vendor_id_fk','left');
           //$this->db->join('tbl_supp_acc','sup_id_fk = vendor_id');
            $this->db->where("tbl_vendor_voucher.voucher_status",1);
            $this->db->where("tbl_vendor_voucher.project_id_fk",$prid);
            $this->db->where("tbl_vendor_voucher.vendor_id_fk",$vendor_id);
             $this->db->where('voucher_date >=',$cdate);
            $this->db->where('voucher_date <=',$edate);
          // $this->db->where('purchase_mop',"Cash");
           // $this->db->group_by('auto_invoice');
            $this->db->order_by('voucher_date','ASCE');
            $query = $this->db->get();
            $result=$query->result();
            return $result;
        }

        public function getpurchasereturn_pay($prid,$cdate,$edate,$vendor_id)
        {
          $this->db->select('*,sum(purchase_return_amt) as total');
          $this->db->from('tbl_purchase');
          $this->db->join('tbl_vendor','vendor_id = vendor_id_fk','left');
          $this->db->where("tbl_purchase.purchase_status",1);
          $this->db->where("tbl_purchase.purchase_return_amt!=",0);
          $this->db->where("tbl_purchase.vendor_id_fk",$vendor_id);
           $this->db->where('purchase_return_date >=',$cdate);
          $this->db->where('purchase_return_date <=',$edate);
          $this->db->group_by('auto_invoice');
          $this->db->order_by('purchase_date','ASCE');
            $query = $this->db->get();
            $result=$query->result();
            return $result;
        }

        public function getbank_ledger_pay($gid,$cdate,$edate,$vendor_id)
        {
          $status=1;
          $this->db->select('*,sum(bd_amount) as bamount');
          $this->db->from('tbl_bank_deposit');
          $this->db->join('tbl_vendor','vendor_id=bd_member_id_fk','left');
          $this->db->where("bd_status",1);
          $this->db->where("bd_type",3);
          $this->db->order_by("bd_date",'ASC');
          $this->db->where('vendor_id',$vendor_id);
          $this->db->where('bd_date >=',$cdate);
          $this->db->where('bd_date <=',$edate);
          $query = $this->db->get();
          return $query->result();
        }

}
?>