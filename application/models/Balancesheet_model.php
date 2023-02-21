<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Balancesheet_model extends CI_Model{

	public function __construct()
    {
        parent::__construct();
    }

   /* public function getBalancesheetDebit()
    {
    	$this->db->select('ledgerbuk_head,debit');
		$this->db->from('tbl_ledgerbuk');
        $this->db->where("debit!=0");
        $this->db->where("ledgerbuk_status",1);
		$this->db->order_by('ledgerbuk_id', 'asc');
        $query = $this->db->get();
        // print_r($query->result());
        // exit();
    	return $query->result();
    }

    public function getBalancesheetCredit()
    {
    	$this->db->select('ledgerbuk_head,credit');
		$this->db->from('tbl_ledgerbuk');
        $this->db->where("credit!=0");
        $this->db->where("ledgerbuk_status",1);
		$this->db->order_by('ledgerbuk_id', 'asc');
        $query = $this->db->get();
    	return $query->result();
    }*/

     public function getBalancesheetDebit($sdate,$edate,$gid)
    {
        $this->db->select('ledgerbuk_head,debit');
        $this->db->from('tbl_ledgerbuk');
        $this->db->where("debit!=0");
        $this->db->where("ledgerbuk_status",1);
          $this->db->where("ledgerbuk_group",$gid);
        $this->db->where('date >=', $sdate);
        $this->db->where('date <=', $edate);
        $this->db->order_by('ledgerbuk_id', 'asc');
        $query = $this->db->get();
        // print_r($query->result());
        // exit();
        return $query->result();
    }

    public function getBalancesheetCredit($sdate,$edate,$gid)
    {
        $this->db->select('ledgerbuk_head,credit');
        $this->db->from('tbl_ledgerbuk');
        $this->db->where("credit!=0");
        $this->db->where("ledgerbuk_status",1);
         $this->db->where("ledgerbuk_group",$gid);
        $this->db->where('date >=', $sdate);
        $this->db->where('date <=', $edate);
        $this->db->order_by('ledgerbuk_id', 'asc');
        $query = $this->db->get();
        return $query->result();
    }
    public function getBranch()
    {
        $this->db->select('shpname,shpid');
        $this->db->from('tbl_shop');
        $this->db->where("shpid >=",1);
        $query = $this->db->get();
        return $query->result();

    }

    public function get_sum(){

     $this->db->select('SUM(debit) AS debit_sum,SUM(credit) AS credit_sum');
     $this->db->from('tbl_ledgerbuk');
     $this->db->where("ledgerbuk_status",1);

     $query  =$this->db->get();

     return $query->result();

    }


     public function getBalancesheetDebits($sdate,$edate)
    {
        $this->db->select('ledgerbuk_head,debit');
        $this->db->from('tbl_ledgerbuk');
        $this->db->where("debit!=0");
        $this->db->where("ledgerbuk_status",1);
       //   $this->db->where("ledgerbuk_group",$gid);
        $this->db->where('date >=', $sdate);
        $this->db->where('date <=', $edate);
        $this->db->order_by('ledgerbuk_id', 'asc');
        $query = $this->db->get();
        // print_r($query->result());
        // exit();
        return $query->result();
    }

    public function getBalancesheetCredits($sdate,$edate)
    {
        $this->db->select('ledgerbuk_head,credit');
        $this->db->from('tbl_ledgerbuk');
        $this->db->where("credit!=0");
        $this->db->where("ledgerbuk_status",1);
       //  $this->db->where("ledgerbuk_group",$gid);
        $this->db->where('date >=', $sdate);
        $this->db->where('date <=', $edate);
        $this->db->order_by('ledgerbuk_id', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

      public function getcashbalance($at_date,$gid)
    {
        $this->db->select('*,sum(closing_amount) as cbalance');
        $this->db->from('tbl_daybuk');
        $this->db->where("status",2);
       $this->db->where("daybuk_group",$gid);
         $d=date("Y-m", strtotime ( '-1 month' , strtotime ( $at_date ) )) ;
        $this->db->where('date', $d);
        $this->db->order_by('daybuk_id', 'asc');
        $query = $this->db->get();
        // print_r($query->result());
        // exit();
        return $query->result();
    }

     /*  public function getcashbalance1($cdate,$gid)
    {
        $this->db->select('*,sum(closing_amount) as cbalance');
        $this->db->from('tbl_daybuk');
        $this->db->where("status",2);
        $this->db->where("daybuk_group",$gid);
         $d=date("Y-m", strtotime ( '-1 month' , strtotime ( $cdate ) ));
        $this->db->where('date', $d);
        $this->db->order_by('daybuk_id', 'asc');
        $query = $this->db->get();
        // print_r($query->result());
        // exit();
        return $query->result();
    }*/

        public function getcashbalance1($cdate,$edate,$gid)
    {
        $this->db->select('*,sum(closing_amount) as cbalance');
        $this->db->from('tbl_daybuk');
        $this->db->where("status",2);
        $this->db->where("daybuk_group",$gid);
        $d=date("Y-m", strtotime ( '-1 month' , strtotime ( $cdate ) ));
         $d1=date("Y-m", strtotime ( '-1 month' , strtotime ( $edate ) ));
       // $this->db->where('date', $cdate);
       // $this->db->where('date', $d);
       //$this->db->where('date <=', $edate);
        if($cdate ==$edate)
        {
          $this->db->where('date', $d);
        }
        else
        {
            $this->db->where('date', $d);
        // $where = '(date between "'.$d.'" and "'.$d1.'")';
        // $this->db->where($where);
        }
        $this->db->order_by('daybuk_id', 'asc');
        $query = $this->db->get();
        // print_r($query->result());
        // exit();
        return $query->result();
    }


        public function getcashbalancep1($cdate,$edate)
    {
        $this->db->select('*,sum(closing_amt) as cbalance');
        $this->db->from('tbl_daybook');
        $this->db->where("daybook_status",2);
       // $this->db->where("project_id_fk",$gid);
        $d=date("Y-m", strtotime ( '-1 month' , strtotime ( $cdate ) ));
         $d1=date("Y-m", strtotime ( '-1 month' , strtotime ( $edate ) ));
       // $this->db->where('date', $cdate);
       // $this->db->where('date', $d);
       //$this->db->where('date <=', $edate);
        if($cdate ==$edate)
        {
          $this->db->where('date', $d);
        }
        else
        {
            $this->db->where('date', $d);
        // $where = '(date between "'.$d.'" and "'.$d1.'")';
        // $this->db->where($where);
        }
        $this->db->order_by('daybook_id', 'asc');
        $query = $this->db->get();
        // print_r($query->result());
        // exit();
        return $query->result();
    }


     public function getupnrmloan1($gid,$cdate,$edate)
        {
           $this->db->select('*,tbl_member.member_name,tbl_member.member_mid,sum(tbl_upnrmloan_repayment.upnrmloan_repayment_amt) AS tpayment,sum(tbl_upnrmloan_repayment.upnrmloan_intrest_amt) AS tintrest,sum(tbl_upnrmloan.upnrmloan_amount) as tamount,tbl_upnrmloan_repayment.upnrmloan_intrest_amt,sum(tbl_upnrmloan_repayment.upnrmloan_balance) as upnrmloan_balance');
            $this->db->from('tbl_upnrmloan_repayment');
            $this->db->join('tbl_member','upnrmloan_repay_member = member_id');
             $this->db->join('tbl_upnrmloan','upnrmloan_internalid = upnrmloan_id');
           // $this->db->where('upnrmloan_repayment_date >=', $cdate);
             $this->db->where('upnrmloan_repayment_date', $edate);
            $this->db->where("upnrmloan_repayment_status",1);
            $this->db->where("member_group",$gid);
           // $this->db->group_by('tbl_member.member_id');
            $this->db->order_by('upnrmloan_repayment_id', 'ASCE');
            $query=$this->db->get();
            // if($query->num_rows() > 0)
            //{
               // return $query->row();
           // }
            //return false;
              $result=$query->result();
            return $result;
        }




        public function getgloan1($gid,$cdate,$edate)
        {
            $this->db->select('*,tbl_member.member_name,tbl_member.member_mid,sum(tbl_loan_repayment.loan_repayment_amt) AS tpayment,sum(tbl_loan_repayment.loan_intrest_amt) AS tintrest,sum(tbl_loan.loan_amount) as tamount,tbl_loan_repayment.loan_repayment_date,tbl_loan_repayment.loan_intrest_amt,sum(tbl_loan_repayment.loan_balance) as loan_balance');
            $this->db->from('tbl_loan_repayment');
            $this->db->join('tbl_member','loan_repay_member = member_id');
            $this->db->join('tbl_loan','loan_loan_id = loan_id');
            //$this->db->where('tbl_loan_repayment.loan_repayment_date >=', $cdate);
            $this->db->where('tbl_loan_repayment.loan_repayment_date', $edate);
            $this->db->where("loan_repayment_status",1);
            $this->db->where("member_group",$gid);
          //  $this->db->group_by('tbl_member.member_id');
            $this->db->order_by('loan_repayment_id', 'ASCE');
            //$query = $this->db->get();
           // $result=$query->result();
           /// return $result;
                $query=$this->db->get();
             if($query->num_rows() > 0)
            {
                return $query->row();
            }
            return false;
        }



         public function getksbcdcloan1($gid,$cdate,$edate)
        {
             $this->db->select('*,tbl_member.member_name,tbl_member.member_mid,sum(tbl_ksbcdcloan_repayment.ksbcdcloan_repayment_amt) AS tpayment,sum(tbl_ksbcdcloan_repayment.ksbcdcloan_intrest_amt) AS tintrest,sum(tbl_ksbcdcloan.ksbcdcloan_amount) as tamount,tbl_ksbcdcloan_repayment.ksbcdcloan_repayment_date,sum(tbl_ksbcdcloan_repayment.ksbcdcloan_balance) as ksbcdcloan_balance');
            $this->db->from('tbl_ksbcdcloan_repayment');
            $this->db->join('tbl_member','ksbcdcloan_repay_member = member_id');
              $this->db->join('tbl_ksbcdcloan','ksbcdcloan_internalid = ksbcdcloan_id');
            //$this->db->where('tbl_ksbcdcloan_repayment.ksbcdcloan_repayment_date >=', $cdate);
               $this->db->where('tbl_ksbcdcloan_repayment.ksbcdcloan_repayment_date', $edate);
            $this->db->where("ksbcdcloan_repayment_status",1);
            $this->db->where("member_group",$gid);
            $this->db->group_by('tbl_member.member_id');
            $this->db->order_by('ksbcdcloan_repayment_id', 'ASCE');
                  $query=$this->db->get();
                   $result=$query->result();
            return $result;
            // if($query->num_rows() > 0)
           // {
             //   return $query->row();
            //}
           // return false;
        }


        public function gethdsloan1($gid,$cdate,$edate)
        {
            $this->db->select('*,tbl_member.member_name,tbl_member.member_mid,sum(tbl_hdsloan_repayment.hdsloan_repayment_amt) AS tpayment,sum(tbl_hdsloan_repayment.hdsloan_intrest_amt) AS tintrest,sum(tbl_hdsloan.hdsloan_amount) as tamount,tbl_hdsloan_repayment.hdsloan_repayment_date,sum(tbl_hdsloan_repayment.hdsloan_balance) as hdsloan_balance');
            $this->db->from('tbl_hdsloan_repayment');
            $this->db->join('tbl_member','hdsloan_repay_member = member_id');
                $this->db->join('tbl_hdsloan','hdsloan_internalid = hdsloan_id');
           // $this->db->where('tbl_hdsloan_repayment.hdsloan_repayment_date >=', $cdate);
            $this->db->where('tbl_hdsloan_repayment.hdsloan_repayment_date', $edate);
            $this->db->where("hdsloan_repayment_status",1);
            $this->db->where("member_group",$gid);
            $this->db->group_by('tbl_member.member_id');
            $this->db->order_by('hdsloan_repayment_id', 'ASCE');
            $query=$this->db->get();
             //if($query->num_rows() > 0)
           // {
              //  return $query->row();
            //}
           // return false;
            $result=$query->result();
            return $result;
        }





     public function getgroupdeposit($gid,$cdate,$edate)
        {
            $this->db->select('*,sum(tbl_deposit.deposit_amount) AS deposit_total,MAX(DATE_FORMAT(deposit_date,,\'%d/%m/%Y\')) AS deposit_dat,sum(awc_deposit_amount) as awc_amount,sum(bank_deposit_amount) as bank_deposit,sum(collection_amt) as collection,sum(other_income) as income,sum(fine) as fine');
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


    public function getupnrmloan($gid,$cdate,$edate)
        {
           $this->db->select('*,tbl_member.member_name,tbl_member.member_mid,sum(tbl_upnrmloan_repayment.upnrmloan_repayment_amt) AS tpayment');
            $this->db->from('tbl_upnrmloan_repayment');
            $this->db->join('tbl_member','upnrmloan_repay_member = member_id');
             $this->db->join('tbl_upnrmloan','upnrmloan_internalid = upnrmloan_id');
            $this->db->where('upnrmloan_repayment_date >=', $cdate);
            $this->db->where('upnrmloan_repayment_date <=', $edate);
            $this->db->where("upnrmloan_repayment_status",1);
            $this->db->where("member_group",$gid);
            $this->db->group_by('tbl_member.member_id');
            $this->db->order_by('member_id', 'ASCE');
            $query = $this->db->get();
            $result=$query->result();
            return $result;
        }


       public function getgloan($gid,$cdate,$edate)
        {
            $this->db->select('*,tbl_member.member_name,tbl_member.member_mid,sum(tbl_loan_repayment.loan_repayment_amt) AS tpayment');
            $this->db->from('tbl_loan_repayment');
            $this->db->join('tbl_member','loan_repay_member = member_id');
            $this->db->join('tbl_loan','loan_loan_id = loan_id');
            $this->db->where('tbl_loan_repayment.loan_repayment_date >=', $cdate);
            $this->db->where('tbl_loan_repayment.loan_repayment_date <=', $edate);
            $this->db->where("loan_repayment_status",1);
            $this->db->where("member_group",$gid);
            $this->db->group_by('tbl_member.member_id');
            $this->db->order_by('member_id', 'ASCE');
            $query = $this->db->get();
            $result=$query->result();
            return $result;
        }

        public function getksbcdcloan($gid,$cdate,$edate)
        {
            $this->db->select('*,tbl_member.member_name,tbl_member.member_mid,sum(tbl_ksbcdcloan_repayment.ksbcdcloan_repayment_amt) AS tpayment');
            $this->db->from('tbl_ksbcdcloan_repayment');
            $this->db->join('tbl_member','ksbcdcloan_repay_member = member_id');
              $this->db->join('tbl_ksbcdcloan','ksbcdcloan_internalid = ksbcdcloan_id');
            $this->db->where('tbl_ksbcdcloan_repayment.ksbcdcloan_repayment_date >=', $cdate);
            $this->db->where('tbl_ksbcdcloan_repayment.ksbcdcloan_repayment_date <=', $edate);
            $this->db->where("ksbcdcloan_repayment_status",1);
            $this->db->where("member_group",$gid);
            $this->db->group_by('tbl_member.member_id');
            $this->db->order_by('member_id', 'ASCE');
            $query = $this->db->get();
            $result=$query->result();
            return $result;
        }

        public function gethdsloan($gid,$cdate,$edate)
        {
            $this->db->select('*,tbl_member.member_name,tbl_member.member_mid,sum(tbl_hdsloan_repayment.hdsloan_repayment_amt) AS tpayment');
            $this->db->from('tbl_hdsloan_repayment');
            $this->db->join('tbl_member','hdsloan_repay_member = member_id');
                $this->db->join('tbl_hdsloan','hdsloan_internalid = hdsloan_id');
            $this->db->where('tbl_hdsloan_repayment.hdsloan_repayment_date >=', $cdate);
            $this->db->where('tbl_hdsloan_repayment.hdsloan_repayment_date <=', $edate);
            $this->db->where("hdsloan_repayment_status",1);
            $this->db->where("member_group",$gid);
            $this->db->group_by('tbl_member.member_id');
            $this->db->order_by('member_id', 'ASCE');
            $query = $this->db->get();
            $result=$query->result();
            return $result;
        }


}
?>
