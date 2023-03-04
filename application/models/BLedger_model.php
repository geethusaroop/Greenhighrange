<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class BLedger_model extends CI_Model{

	public function __construct()
    {
        parent::__construct();
    }
	
      public function getpvoucher($cdate,$edate,$branch_id_fk)
        {
            $this->db->select('*');
            $this->db->from('tbl_branch_voucher');
             $this->db->join('tbl_branch_vouchhead','vouch_id = vouch_id_fk');
            $this->db->where("voucher_status",1);
           $this->db->where("branch_id_fk",$branch_id_fk);
            $this->db->where('voucher_date >=',$cdate);
            $this->db->where('voucher_date <=',$edate);
            $query = $this->db->get();
            $result=$query->result();
            return $result;
        }

         public function getpreceipt($cdate,$edate,$branch_id_fk)
        {
            $this->db->select('*');
            $this->db->from('tbl_branch_receipt');
              $this->db->join('tbl_branch_receipthead','tbl_branch_receipthead.receipt_id = receipt_id_fk');
            $this->db->where("tbl_branch_receipt.receipt_status",1);
            $this->db->where("receipt_branch_id_fk",$branch_id_fk);
             $this->db->where('rept_date >=',$cdate);
            $this->db->where('rept_date <=',$edate);
            $query = $this->db->get();
            $result=$query->result();
            return $result;
        }

          public function getpurchase($cdate,$edate,$branch_id_fk)
        {
            $this->db->select('*');
            $this->db->from('tbl_purchase');
               $this->db->join('tbl_vendor','vendor_id = vendor_id_fk','left');
                 $this->db->join('tbl_supp_acc','sup_id_fk = vendor_id','left');
                 $this->db->where("tbl_purchase.purchase_branch_id_fk",$branch_id_fk);
            $this->db->where("tbl_purchase.purchase_status",1);
             $this->db->where('purchase_date >=',$cdate);
            $this->db->where('purchase_date <=',$edate);
            $this->db->group_by('auto_invoice');
            $query = $this->db->get();
            $result=$query->result();
            return $result;
        }

        


        public function getsaleincome($cdate,$edate,$branch_id_fk)
        {
            $this->db->select('*,sum(tbl_sale.total_price) as total_amount,DATE_FORMAT(MAX(sale_date),\'%d/%m/%Y\') AS sale_date');
            $this->db->from('tbl_sale');
               $this->db->join('tbl_member','member_id = member_id_fk','left');
            $this->db->where("tbl_sale.sale_status",1);
            $this->db->where("tbl_sale.sale_mop","Cash");
            $this->db->where("sale_branch_id_fk",$branch_id_fk);
             $this->db->where('sale_date >=',$cdate);
            $this->db->where('sale_date <=',$edate);
            $query = $this->db->get();
            $result=$query->result();
            return $result;
        }

      
        public function opening_ledger($prid,$cdate,$vendor_id,$branch_id_fk)
        {
          $this->db->select('*,COALESCE(pur_new_bal,0) as total_bal');
          $this->db->from('tbl_purchase');
          $this->db->join('tbl_vendor','vendor_id = vendor_id_fk');
          $this->db->where("tbl_purchase.purchase_status",1);
          $this->db->where("tbl_purchase.purchase_branch_id_fk",$branch_id_fk);
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

        public function opening_ledger1($prid,$cdate,$vendor_id,$branch_id_fk)
        {
          $this->db->select('*,COALESCE(sum(voucher_amount),0) as voucher_amount');
          $this->db->from('tbl_vendor_voucher');
          $this->db->join('tbl_vendor','vendor_id = vendor_id_fk','left');
          $this->db->where("tbl_vendor_voucher.voucher_status",1);
          $this->db->where("tbl_vendor.vendorstatus",1);
          $this->db->where("tbl_vendor.vendor_branch_id_fk",$branch_id_fk);
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

        public function opening_ledger2($prid,$cdate,$vendor_id,$branch_id_fk)
        {
          $this->db->select('*,COALESCE(opening_balance,0) as opening_balance');
          $this->db->from('tbl_vendor');
          $this->db->where("tbl_vendor.vendorstatus",1);
          $this->db->where("tbl_vendor.vendor_branch_id_fk",$branch_id_fk);
          $this->db->where("tbl_vendor.vendor_id",$vendor_id);
          $query = $this->db->get();
          return $query->row();
        }

        public function getpurchase_ledger($prid,$cdate,$edate,$vendor_id,$branch_id_fk)
        {
            $this->db->select('*,sum(total_price) as total');
            $this->db->from('tbl_purchase');
            $this->db->join('tbl_vendor','vendor_id = vendor_id_fk','left');
           // $this->db->join('tbl_supp_acc','sup_id_fk = vendor_id');
            $this->db->where("tbl_purchase.purchase_status",1);
             $this->db->where("tbl_purchase.purchase_branch_id_fk",$branch_id_fk);
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

        public function getpurchase_ledger_pay($prid,$cdate,$edate,$vendor_id,$branch_id_fk)
        {
            $this->db->select('*');
            $this->db->from('tbl_vendor_voucher');
            $this->db->join('tbl_vendor','vendor_id = vendor_id_fk','left');
            $this->db->where("tbl_purchase.purchase_branch_id_fk",$branch_id_fk);
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

        public function getpurchasereturn_pay($prid,$cdate,$edate,$vendor_id,$branch_id_fk)
        {
          $this->db->select('*,sum(purchase_return_amt) as total');
          $this->db->from('tbl_purchase');
          $this->db->join('tbl_vendor','vendor_id = vendor_id_fk','left');
          $this->db->where("tbl_purchase.purchase_status",1);
          $this->db->where("tbl_purchase.purchase_return_amt!=",0);
          $this->db->where("tbl_purchase.vendor_id_fk",$vendor_id);
          $this->db->where("tbl_purchase.purchase_branch_id_fk",$branch_id_fk);
           $this->db->where('purchase_return_date >=',$cdate);
          $this->db->where('purchase_return_date <=',$edate);
          $this->db->group_by('auto_invoice');
          $this->db->order_by('purchase_date','ASCE');
            $query = $this->db->get();
            $result=$query->result();
            return $result;
        }

}
?>