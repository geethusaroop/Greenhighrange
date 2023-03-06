<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Purchasereport_model extends CI_Model{

	public function __construct()
    {
        parent::__construct();
    }

	public function getPurchaseReports() 
    {
        $this->db->select('*,COUNT(invoice_number) as prcount,ROUND(SUM(total_price),2) as total,DATE_FORMAT(purchase_date,\'%d/%m/%Y\') as purchase_date');
		$this->db->from('tbl_purchase');
		$this->db->join('tbl_vendor','vendor_id = vendor_id_fk','left');
        $this->db->where("purchase_status",1);
		$this->db->group_by('auto_invoice');
		$this->db->order_by('tbl_purchase.purchase_date','DESC');
        $query = $this->db->get();
		return $query->result();
    }

	public function getPurchaseReports1($vendor_id,$cdate,$edate,$invno) 
    {
        $this->db->select('*,COUNT(invoice_number) as prcount,ROUND(SUM(total_price),2) as total,DATE_FORMAT(purchase_date,\'%d/%m/%Y\') as purchase_date');
		$this->db->from('tbl_purchase');
		$this->db->join('tbl_vendor','vendor_id = vendor_id_fk','left');
        $this->db->where("purchase_status",1);
		$this->db->group_by('auto_invoice');
		$this->db->order_by('tbl_purchase.purchase_date','DESC');
		if(!empty($invno)){
            $this->db->where('tbl_purchase.invoice_number', $invno); 
        }
		if(!empty($vendor_id)){
            $this->db->where('tbl_purchase.vendor_id_fk', $vendor_id); 
        }
		if(!empty($cdate)){
            $this->db->where('purchase_date >=', $cdate);
        }
        if(!empty($edate)){
            $this->db->where('purchase_date <=', $edate); 
        }
        $query = $this->db->get();
		return $query->result();
    }


	public function getPurchaseRegister($branch_id_fk,$cdate,$edate) 
    {
        $this->db->select('*,COUNT(invoice_number) as prcount,ROUND(SUM(taxamount),2) as total,ROUND(SUM(purchase_igstamt),2) as tax,DATE_FORMAT(purchase_date,\'%d/%m/%Y\') as purchase_date');
		$this->db->from('tbl_purchase');
		$this->db->join('tbl_vendor','vendor_id = vendor_id_fk','left');
        $this->db->where("purchase_status",1);
		$this->db->group_by('auto_invoice');
		$this->db->order_by('purchase_date','ASC');
        $this->db->where('purchase_date >=', $cdate);
        $this->db->where('purchase_date <=', $edate); 
		if(!empty($branch_id_fk) && $branch_id_fk != 0)
        {
            $this->db->where("purchase_branch_id_fk",$branch_id_fk);
        }
        else
        {
            $this->db->where("purchase_branch_id_fk",0);
        }
        $query = $this->db->get();
		return $query->result();
    }

	public function getSaleRegister($branch_id_fk,$cdate,$edate) 
    {
        $this->db->select('*,ROUND(SUM(taxamount),2) as total,ROUND(SUM(sale_cgstamt),2) as cgst,ROUND(SUM(sale_sgstamt),2) as sgst');
		$this->db->from('tbl_sale');
		$this->db->join('tbl_member','member_id = tbl_sale.member_id_fk','left');
        $this->db->where("sale_status",1);
		$this->db->group_by('auto_invoice');
		$this->db->order_by('sale_date','ASC');
        $this->db->where('sale_date >=', $cdate);
        $this->db->where('sale_date <=', $edate); 
		if(!empty($branch_id_fk) && $branch_id_fk != 0)
        {
            $this->db->where("sale_branch_id_fk",$branch_id_fk);
        }
        else
        {
            $this->db->where("sale_branch_id_fk",0);
        }
        $query = $this->db->get();
		return $query->result();
    }

	public function getsundrycreditors($branch_id_fk)
	{
		$this->db->select('*,sum(bd_amount) as bamount');
		$this->db->from('tbl_vendor');
		$this->db->join('tbl_vendor_voucher','vendor_id = vendor_id_fk','left');
		$this->db->join('tbl_bank_deposit','bd_member_id_fk=vendor_id','left');
		$this->db->where("bd_status",1);
        $this->db->where("vendorstatus",1);
		$this->db->where("voucher_status",1);
		$this->db->order_by('vendorname','ASC');
		if(!empty($branch_id_fk) && $branch_id_fk != 0)
        {
            $this->db->where("vendor_branch_id_fk",$branch_id_fk);
        }
        else
        {
            $this->db->where("vendor_branch_id_fk",0);
        }
        $query = $this->db->get();
		return $query->result();
	}


	public function getsundrydebtors($branch_id_fk)
	{
		$this->db->select('*,sum(bd_amount) as bamount');
		$this->db->from('tbl_member');
	//	$this->db->join('tbl_sale','member_id_fk=member_id','left');
		$this->db->join('tbl_bank_deposit','bd_member_id_fk=member_id','left');
        $this->db->where("member_status",1);
		$this->db->where("bd_status",1);
		$this->db->order_by('member_name','ASC');
		$this->db->group_by('bd_member_id_fk');
		if(!empty($branch_id_fk) && $branch_id_fk != 0)
        {
            $this->db->where("branch_id_fk",$branch_id_fk);
        }
        else
        {
            $this->db->where("branch_id_fk",0);
        }
        $query = $this->db->get();
		return $query->result();
	}


	public function getStockRegister1($branch_id_fk) 
    {
        $this->db->select('*');
		$this->db->from('tbl_product');
        $this->db->where("product_status",1);
		$this->db->where("product_category",1);
		$this->db->order_by('product_name','ASC');
		if(!empty($branch_id_fk) && $branch_id_fk != 0)
        {
            $this->db->where("branch_id_fk",$branch_id_fk);
        }
        else
        {
            $this->db->where("branch_id_fk",0);
        }
        $query = $this->db->get();
		return $query->result();
    }

	public function getStockRegister2($branch_id_fk) 
    {
        $this->db->select('*');
		$this->db->from('tbl_product');
        $this->db->where("product_status",1);
		$this->db->where("product_category",2);
		$this->db->order_by('product_name','ASC');
		if(!empty($branch_id_fk) && $branch_id_fk != 0)
        {
            $this->db->where("branch_id_fk",$branch_id_fk);
        }
        else
        {
            $this->db->where("branch_id_fk",0);
        }
        $query = $this->db->get();
		return $query->result();
    }


	

	public function getPurchaseReport($param,$prid){
        $arOrder = array('','invoice_no','shop','product_num1');
        $invoice_no =(isset($param['invoice_no']))?$param['invoice_no']:'';
		$product_num1 =(isset($param['product_num1']))?$param['product_num1']:'';
		//$shop =(isset($param['shop']))?$param['shop']:'';
		$start_date =(isset($param['start_date']))?$param['start_date']:'';
        $end_date =(isset($param['end_date']))?$param['end_date']:'';
		
        if($invoice_no){
            $this->db->where('invoice_number', $invoice_no); 
        }
		if($product_num1){
            $this->db->like('tbl_vendor.vendorname', $product_num1); 
        }
		//if($shop!=0){
           // $this->db->where('shop_id_fk', $shop); 
       // }
		if($start_date){
            $this->db->where('purchase_date >=', $start_date);
        }
        if($end_date){
            $this->db->where('purchase_date <=', $end_date); 
        }
		//$this->db->where("purchase_status",1);
		$this->db->where("tbl_purchase.project_id_fk",$prid);
		
        if ($param['start'] != 'false' and $param['length'] != 'false') {
            $this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*,COUNT(invoice_number) as prcount,ROUND(SUM(total_price),2) as total,DATE_FORMAT(purchase_date,\'%d/%m/%Y\') as purchase_date');
		$this->db->from('tbl_purchase');
		//$this->db->join('tbl_raw_material','raw_id = product_id_fk');
		$this->db->join('tbl_vendor','vendor_id = vendor_id_fk','left');
		$this->db->where('tbl_purchase.project_id_fk', $prid); 
		$this->db->group_by('auto_invoice');
		//$this->db->group_by('vendor_id_fk');
		$this->db->order_by('tbl_purchase.purchase_date','DESC');
		$this->db->where("purchase_status",1);
		//$this->db->group_by('auto_invoice', 'DESC');
        $query = $this->db->get();
        
		$data['data'] = $query->result();
        $data['recordsTotal'] = $this->getPurchaseTotalCount($param,$prid);
        $data['recordsFiltered'] = $this->getPurchaseTotalCount($param,$prid);
		$data['records_total'] = $this->getPurchaseTotalsum($param,$prid);
        return $data;

	}
	public function getPurchaseTotalCount($param,$prid){
        $invoice_no =(isset($param['invoice_no']))?$param['invoice_no']:'';
		$product_num =(isset($param['product_num']))?$param['product_num']:'';
		$shop =(isset($param['shop']))?$param['shop']:'';
		$start_date =(isset($param['start_date']))?$param['start_date']:'';
        $end_date =(isset($param['end_date']))?$param['end_date']:'';
		
		if($invoice_no){
            $this->db->where('invoice_number', $invoice_no); 
        }
		if($product_num){
            $this->db->like('tbl_product.product_num', $product_num); 
        }
		if($shop!=0){
            $this->db->where('shop_id_fk', $shop); 
        }
		if($start_date){
            $this->db->where('purchase_date >=', $start_date);
        }
        if($end_date){
            $this->db->where('purchase_date <=', $end_date); 
        }
			//$this->db->where("tbl_purchase.project_id_fk",$prid);
			$this->db->select('*,COUNT(invoice_number) as prcount,ROUND(SUM(total_price),2) as total,DATE_FORMAT(purchase_date,\'%d/%m/%Y\') as purchase_date');
			$this->db->from('tbl_purchase');
			//$this->db->join('tbl_raw_material','raw_id = product_id_fk','left');
			$this->db->join('tbl_vendor','vendor_id = vendor_id_fk','left');
			$this->db->where('tbl_purchase.project_id_fk', $prid); 
			$this->db->group_by('auto_invoice');
			//$this->db->group_by('vendor_id_fk');
			$this->db->order_by('purchase_date','DESC');
			$this->db->where("tbl_purchase.purchase_status",1);
			//$this->db->group_by('auto_invoice', 'DESC');
			$query = $this->db->get();
			return $query->num_rows();
	}


	public function getPurchaseTotalsum($param,$prid){
        $invoice_no =(isset($param['invoice_no']))?$param['invoice_no']:'';
		$product_num =(isset($param['product_num']))?$param['product_num']:'';
		$shop =(isset($param['shop']))?$param['shop']:'';
		$start_date =(isset($param['start_date']))?$param['start_date']:'';
        $end_date =(isset($param['end_date']))?$param['end_date']:'';
		
		if($invoice_no){
            $this->db->where('invoice_number', $invoice_no); 
        }
		if($product_num){
            $this->db->like('tbl_product.product_num', $product_num); 
        }
		if($shop!=0){
            $this->db->where('shop_id_fk', $shop); 
        }
		if($start_date){
            $this->db->where('purchase_date >=', $start_date);
        }
        if($end_date){
            $this->db->where('purchase_date <=', $end_date); 
        }
			$this->db->select('SUM(tbl_purchase.purchase_quantity) as tqty,SUM(tbl_purchase.total_price) as tprice');
			$this->db->from('tbl_purchase');
			$this->db->where('tbl_purchase.project_id_fk', $prid); 
			$this->db->where("tbl_purchase.purchase_status",1);
			$query = $this->db->get();
			return $query->result();
	}





	public function getPurchaseReport1($param,$prid){
        $arOrder = array('','invoice_no','shop','product_num1');
        $invoice_no =(isset($param['invoice_no']))?$param['invoice_no']:'';
		$product_num1 =(isset($param['product_num1']))?$param['product_num1']:'';
		//$shop =(isset($param['shop']))?$param['shop']:'';
		$start_date =(isset($param['start_date']))?$param['start_date']:'';
        $end_date =(isset($param['end_date']))?$param['end_date']:'';
		
        if($invoice_no){
            $this->db->where('invoice_number', $invoice_no); 
        }
		if($product_num1){
            $this->db->like('tbl_vendor.vendorname', $product_num1); 
        }
		//if($shop!=0){
           // $this->db->where('shop_id_fk', $shop); 
       // }
		if($start_date){
            $this->db->where('purchase_date >=', $start_date);
        }
        if($end_date){
            $this->db->where('purchase_date <=', $end_date); 
        }
		$this->db->where("purchase_status",1);
		$this->db->where("tbl_purchase.project_id_fk",$prid);
		
        if ($param['start'] != 'false' and $param['length'] != 'false') {
           // $this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*,COUNT(invoice_number) as prcount,ROUND(SUM(total_price),2) as total,DATE_FORMAT(purchase_date,\'%d/%m/%Y\') as purchase_date');
		$this->db->from('tbl_purchase');
		$this->db->join('tbl_product','product_id = product_id_fk');
		$this->db->join('tbl_vendor','vendor_id = vendor_id_fk');
		$this->db->where('tbl_purchase.project_id_fk', $prid); 
		$this->db->group_by('invoice_number');
		$this->db->group_by('vendor_id_fk');
		$this->db->order_by('purchase_date','DESC');
		//$this->db->group_by('auto_invoice', 'DESC');
        $query = $this->db->get();
        
		$data['data'] = $query->result();
        $data['recordsTotal'] = $this->getPurchaseTotalCount1($param,$prid);
        $data['recordsFiltered'] = $this->getPurchaseTotalCount1($param,$prid);
        return $data;

	}
	public function getPurchaseTotalCount1($param,$prid){
        $invoice_no =(isset($param['invoice_no']))?$param['invoice_no']:'';
		$product_num =(isset($param['product_num']))?$param['product_num']:'';
		$shop =(isset($param['shop']))?$param['shop']:'';
		$start_date =(isset($param['start_date']))?$param['start_date']:'';
        $end_date =(isset($param['end_date']))?$param['end_date']:'';
		
		if($invoice_no){
            $this->db->where('invoice_number', $invoice_no); 
        }
		if($product_num){
            $this->db->like('tbl_product.product_num', $product_num); 
        }
		if($shop!=0){
            $this->db->where('shop_id_fk', $shop); 
        }
		if($start_date){
            $this->db->where('purchase_date >=', $start_date);
        }
        if($end_date){
            $this->db->where('purchase_date <=', $end_date); 
        }
		$this->db->where("purchase_status",1);
	$this->db->where("tbl_purchase.project_id_fk",$prid);
		$this->db->select('*,COUNT(invoice_number) as prcount,ROUND(SUM(total_price),2) as total,DATE_FORMAT(purchase_date,\'%d/%m/%Y\') as purchase_date');
		$this->db->from('tbl_purchase');
		$this->db->join('tbl_product','product_id = product_id_fk');
		$this->db->join('tbl_vendor','vendor_id = vendor_id_fk');
		$this->db->where('tbl_purchase.project_id_fk', $prid); 
		$this->db->group_by('invoice_number');
		$this->db->group_by('vendor_id_fk');
		$this->db->order_by('purchase_date','DESC');
		//$this->db->group_by('auto_invoice', 'DESC');
        $query = $this->db->get();
		return $query->num_rows();
	}
	function get_shop($sessid)
	{
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where('log_id_fk',$sessid);
		$this->db->where('status',1);
		$query = $this->db->get();
		return $query->result();
	}
	public function get_productnum()
	{
		$this->db->select('*');
		$this->db->from('tbl_product');
		$this->db->where('product_status', 1);
		$this->db->order_by('product_name');
		$query = $this->db->get();
		
		$product_num = array();
		if ($query -> result()) {
		foreach ($query->result() as $productnum) {
		$product_num[$productnum-> product_id] = $productnum -> product_name;
			}
		return $product_num;
		} else {
		return FALSE;
		}
	}
}
?>