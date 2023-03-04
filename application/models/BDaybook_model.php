<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class BDaybook_model extends CI_Model{
	public function __construct()
	{
		parent::__construct();
	}
public function popening($branch_id_fk)
{
	$date = date('Y-m-d');
	$this->db->select('*');
	$this->db->from('tbl_branch_daybook');
	$this->db->where('branch_id_fk', $branch_id_fk);
	$this->db->order_by('daybook_id',"desc");
	$this->db->limit(1);
	$date = isset($_GET['date']) ? $_GET['date'] : date('Y-m');
	$d = date('Y-m-d', strtotime($date .' -1 day'));
	$this->db->where('date', $d);
	$query = $this->db->get();
	return $query->row();
}
public function get_popening($date,$branch_id_fk)
{
	$this->db->select('*');
	$this->db->from('tbl_branch_daybook');
	$this->db->order_by('daybook_id',"desc");
	$this->db->limit(1);
	$d = date('Y-m-d', strtotime($date .' -1 day'));
	$this->db->where('date', $d);
	$this->db->where('branch_id_fk', $branch_id_fk);
	$query = $this->db->get();
	return $query->row();
}
public function getpvoucher($cdate,$branch_id_fk)
{
	$this->db->select('*');
	$this->db->from('tbl_branch_voucher');
	$this->db->join('tbl_branch_vouchhead','vouch_id = vouch_id_fk');
	$this->db->where("voucher_status",1);
	$this->db->where('branch_id_fk', $branch_id_fk);
	$this->db->where('voucher_date',$cdate);
	$query = $this->db->get();
	$result=$query->result();
	return $result;
}
public function getpreceipt($cdate,$branch_id_fk)
{
	$this->db->select('*');
	$this->db->from('tbl_branch_receipt');
	$this->db->join('tbl_branch_receipthead','tbl_branch_receipthead.receipt_id = receipt_id_fk');
	$this->db->where("tbl_branch_receipt.receipt_status",1);
	$this->db->where('branch_id_fk', $branch_id_fk);
	$this->db->where('rept_date',$cdate);
	$query = $this->db->get();
	$result=$query->result();
	return $result;
}
public function pclosebalance($date,$branch_id_fk)
{
	$this->db->select('tbl_branch_daybook.closing_amt,tbl_branch_daybook.date');
	$this->db->from('tbl_branch_daybook');
	$this->db->where('tbl_branch_daybook.date',$date);
	$this->db->where('tbl_branch_daybook.branch_id_fk',$branch_id_fk);
	$this->db->where("daybook_status",2);
	$query = $this->db->get();
	return $query->result();
}
public function pupdate_daybook($date,$profit,$stat,$branch_id_fk){
	$this->db->set('credit_status', $stat);
	$this->db->set('daybook_status', 2);
	$this->db->set('closing_amt',$profit);
	$this->db->where('date', $date);
	$this->db->where('tbl_branch_daybook.branch_id_fk',$branch_id_fk);
	$this->db->update('tbl_branch_daybook');
}
         public function getpurchase($cdate,$branch_id_fk)
        {
            $this->db->select('*,SUM(pur_paid_amt) as pur_paid_amt');
            $this->db->from('tbl_purchase');
            $this->db->join('tbl_vendor','vendor_id = vendor_id_fk','left');
            $this->db->where("tbl_purchase.purchase_status",1);
            $this->db->where('purchase_date',$cdate);
			$this->db->where("purchase_mop","Cash");
			$this->db->where('tbl_purchase.purchase_branch_id_fk',$branch_id_fk);
            $this->db->group_by('auto_invoice');
            $query = $this->db->get();
            $result=$query->result();
            return $result;
        }
        
        public function getsaleincome($cdate,$branch_id_fk)
        {
            $this->db->select('*,DATE_FORMAT(sale_date,\'%d/%m/%Y\') AS sale_date,tbl_sale.total_price as total_amount');
            $this->db->from('tbl_sale');
            $this->db->where("tbl_sale.sale_status",1);
			$this->db->where("tbl_sale.sale_mop","Cash");
             $this->db->where('sale_date',$cdate);
			 $this->db->where('tbl_sale.sale_branch_id_fk',$branch_id_fk);
			 $this->db->group_by('auto_invoice');
			 $this->db->order_by('invoice_number','ASCE');
            $query = $this->db->get();
            $result=$query->result();
            return $result;
        }
      

		public function getVendorVoucher($cdate,$branch_id_fk)
		{
			$this->db->select('*,DATE_FORMAT(voucher_date,\'%d/%m/%Y\') AS vendor_voucher_date');
			$this->db->from('tbl_vendor_voucher');
			$this->db->join('tbl_vendor','vendor_id = vendor_id_fk');
			$this->db->where("tbl_vendor_voucher.voucher_status",1);
			$this->db->where('vendor_branch_id_fk',$branch_id_fk);
			$this->db->where("voucher_date",$cdate);
			$query = $this->db->get();
			$result=$query->result();
			return $result;
		}

		public function getbdeposit($cdate,$branch_id_fk)
		{
			$this->db->select('*,DATE_FORMAT(bd_date,\'%d/%m/%Y\') AS bd_date');
			$this->db->from('tbl_bank_deposit');
			$this->db->join('tbl_bank','bank_id=bd_bank_id_fk');
			$this->db->join('tbl_member','member_id=bd_member_id_fk','left');
			$this->db->where('tbl_bank_deposit.branch_id_fk',$branch_id_fk);
			$this->db->where("bd_date",$cdate);
			$this->db->where("bd_status",1);
			$this->db->where("bank_status",1);
			$query = $this->db->get();
			$result=$query->result();
			return $result;
		}


		public function getfund($cdate,$branch_id_fk)
		{
			$this->db->select('*,DATE_FORMAT(fund_date,\'%d/%m/%Y\') AS fund_date');
			$this->db->from('tbl_fund');
			$this->db->where("fund_date",$cdate);
			$this->db->where('tbl_fund.fund_branch_id_fk',$branch_id_fk);
			$this->db->join('tbl_fund_type','tbl_fund_type.ftype_id=tbl_fund.ftype_id_fk');
			$this->db->where("fund_status",1);
			$query = $this->db->get();
			$result=$query->result();
			return $result;
		}

		public function getmbtsaleincome($cdate,$branch_id_fk)
        {
            $this->db->select('*,DATE_FORMAT(sale_date,\'%d/%m/%Y\') AS sale_date,tbl_master_branch_sale.total_price as total_amount');
            $this->db->from('tbl_master_branch_sale');
			$this->db->join('tbl_branch','tbl_branch.branch_id=tbl_master_branch_sale.sale_branch_id_fk');
            $this->db->where("tbl_master_branch_sale.sale_status",1);
			$this->db->where('tbl_master_branch_sale.sale_branch_id_fk',$branch_id_fk);
             $this->db->where('sale_date',$cdate);
			 $this->db->group_by('auto_invoice');
			 $this->db->order_by('invoice_number','ASCE');
            $query = $this->db->get();
            $result=$query->result();
            return $result;
        }
}
?>
