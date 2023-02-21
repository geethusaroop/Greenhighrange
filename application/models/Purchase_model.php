<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Purchase_model extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}
	public function getPurchaseReport($param){
		$arOrder = array('','invoice_number','shop');
		$invoice_number =(isset($param['invoice_number']))?$param['invoice_number']:'';
		$shop =(isset($param['shop']))?$param['shop']:'';
		if($invoice_number){
			$this->db->like('invoice_number', $invoice_number);
		}
		if($shop!=0){
			$this->db->where('shop_id_fk', $shop);
		}
		$this->db->where("purchase_status",1);
		if ($param['start'] != 'false' and $param['length'] != 'false') {
			$this->db->limit($param['length'],$param['start']);
		}
		$this->db->select('*,COUNT(invoice_number) as prcount,ROUND(SUM(total_price),2) as total,DATE_FORMAT(purchase_date,\'%d/%m/%Y\') as purchase_dat');
		$this->db->from('tbl_purchase');
		$this->db->join('tbl_product','product_id = product_id_fk');
		$this->db->join('tbl_vendor','vendor_id = vendor_id_fk');
		$this->db->group_by('invoice_number');
		$this->db->group_by('vendor_id_fk');
		$this->db->order_by('purchase_id','DESC');
		$query = $this->db->get();
		$data['data'] = $query->result();
		$data['recordsTotal'] = $this->getPurchaseReportTotalCount($param);
		$data['recordsFiltered'] = $this->getPurchaseReportTotalCount($param);
		return $data;
	}
	public function getPurchaseReportTotalCount($param){
		$invoice_number =(isset($param['invoice_number']))?$param['invoice_number']:'';
		$shop =(isset($param['shop']))?$param['shop']:'';
		if($invoice_number){
			$this->db->like('invoice_number', $invoice_number);
		}
		if($shop!=0){
			$this->db->where('shop_id_fk', $shop);
		}
		$this->db->where("purchase_status",1);
		$this->db->select('*,COUNT(invoice_number) as prcount,SUM(total_price) as total,DATE_FORMAT(purchase_date,\'%d/%m/%Y\') as purchase_date');
		$this->db->from('tbl_purchase');
		$this->db->join('tbl_product','product_id = product_id_fk');
		$this->db->join('tbl_vendor','vendor_id = vendor_id_fk');
		$this->db->group_by('invoice_number');
		$this->db->group_by('vendor_id_fk');
		$this->db->order_by('purchase_id', 'DESC');
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function get_pdata($table,$primaryfield,$id)
	{
		$this->db->select('*');
		$this->db->from('tbl_purchase');
		$this->db->join('tbl_vendor','vendor_id = vendor_id_fk');
		$this->db->where($primaryfield,$id);
		$q = $this->db->get();
		if($q->num_rows() > 0)
		{
			return $q->row();
		}
		return false;
	}

	public function get_product_data($auto_invoice)
	{
		$this->db->select('*');
		$this->db->from('tbl_purchase');
		$this->db->join('tbl_product','tbl_product.product_id = tbl_purchase.product_id_fk');
		$this->db->where('auto_invoice',$auto_invoice);
		$query = $this->db->get();
		return $query->result();
	}

	function gettax()
	{

		$this->db->select('tax_id,taxamount');
		$this->db->where("tax_status",1);
		$query = $this->db->get('tbl_taxdetails');
		$tax_name = array();
		if($query->result()){
			foreach ($query->result() as $tax_names) {
				$tax_name[$tax_names->tax_id] = $tax_names->taxamount;

			}
			return $tax_name;

		}
		else{
			return FALSE;
		}
	}

	function getproductname()
	{
		$this->db->select('raw_id,raw_item');
		$this->db->where("raw_status",1);
		$query = $this->db->get('tbl_raw_material');
		$product_name = array();
		if($query->result()){
			foreach ($query->result() as $product_names) {
				$product_name[$product_names->raw_id] = $product_names->raw_item;

			}
			return $product_name;

		}
		else{
			return FALSE;
		}
	}


	function getproductname_purchase($prid)
	{
		$this->db->select('product_id,product_name');
		$this->db->where("product_status",1);
		$this->db->where("project_id_fk",$prid);
		$query = $this->db->get('tbl_product');
		$product_name = array();
		if($query->result()){
			foreach ($query->result() as $product_names) {
				$product_name[$product_names->product_id] = $product_names->product_name;

			}
			return $product_name;

		}
		else{
			return FALSE;
		}
	}

	function getproductnames()
	{
		$this->db->select('product_id,product_name');
		$this->db->where("product_status",1);
		$query = $this->db->get('tbl_product');
		$product_name = array();
		if($query->result()){
			foreach ($query->result() as $product_names) {
				$product_name[$product_names->product_id] = $product_names->product_name;

			}
			return $product_name;

		}
		else{
			return FALSE;
		}
	}

	function getproductname1($p_id)
	{
		$this->db->select('product_name');
		$this->db->where("product_id",$p_id);
		$this->db->where("product_status",1);
		$query = $this->db->get('tbl_product');
		return $query->result();

	}

	public function fetchPrice($fk)
	{
		$this->db->select('product_price');
		$this->db->from('tbl_product');
		$this->db->where('product_id',$fk);
		$query = $this->db->get();
		return $query->row();
	}

	public function fetchPrices($fk)
	{
		$this->db->select('price');
		$this->db->from('tbl_production');
		$this->db->where('product_id_fk',$fk);
		$query = $this->db->get();
		return $query->row();
	}

	public function getAmount($tax_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_taxdetails');
		$this->db->where('tax_id',$tax_id);
		$this->db->where('tax_status',1);
		$query = $this->db->get();
		return $query->row();
	}

	public function getprice($product_num)
	{
		$this->db->select('product_price');
		$this->db->from('tbl_product');
		$this->db->where('product_id',$product_num);
		$this->db->where('product_status',1);
		$query = $this->db->get();
		return $query->result;
	}
	public function get_invc($auto_invoice)
	{
		$this->db->select('*');
		$this->db->from('tbl_purchase');
		$this->db->where('purchase_status',1);
		$this->db->join('tbl_product','tbl_product.product_id = tbl_purchase.product_id_fk');
		$this->db->join('tbl_vendor','tbl_vendor.vendor_id = tbl_purchase.vendor_id_fk');
		//$this->db->join('tbl_size','tbl_size.size_id = tbl_product.product_size');
		//	$this->db->join('tbl_taxdetails','tbl_taxdetails.tax_id = tbl_purchase.tax_id_fk');
		$this->db->where('auto_invoice',$auto_invoice);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_invc1($auto_invoice)
	{
		$this->db->select('*');
		$this->db->from('tbl_purchase');
		$this->db->where('purchase_status',1);
		$this->db->join('tbl_product','product_id = tbl_purchase.product_id_fk','left');
		$this->db->join('tbl_vendor','tbl_vendor.vendor_id = tbl_purchase.vendor_id_fk','left');
		//$this->db->join('tbl_size','tbl_size.size_id = tbl_product.product_size');
		//$this->db->join('tbl_taxdetails','tbl_taxdetails.tax_id = tbl_purchase.tax_id_fk','left');
		$this->db->where('auto_invoice',$auto_invoice);
		$query = $this->db->get();
		return $query->result();
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
	function get_fyear()
	{
		$this->db->select('*');
		$this->db->from('tbl_finyear');
		$this->db->where('finyear_status',1);
		//$this->db->where('status',1);
		$query = $this->db->get();
		return $query->result();
	}
	function get_stk($prid,$stock_item_type)
	{
		$this->db->select('*');
		$this->db->from('tbl_stock');
		$this->db->where('stock_item_fk_id',$prid);
		$this->db->where('stock_item_type',$stock_item_type);
		$query = $this->db->get();
		return $query->result();
	}

	function get_stok($prid)
	{
		$this->db->select('*');
		$this->db->from('tbl_product');
		$this->db->where('product_id',$prid);
		$query = $this->db->get();
		return $query->result();
	}

	function get_pstk($prid)
	{
		$this->db->select('*');
		$this->db->from('tbl_production');
		$this->db->where('product_id_fk',$prid);
		$query = $this->db->get();
		return $query->result();
	}
	public function get_gst($vendor_id)
	{
		$this->db->select('vendorgst,vendorstate,vendor_gsttype,vendor_statetype');
		$this->db->from('tbl_vendor');
		$this->db->where('vendor_id',$vendor_id);
		$query = $this->db->get();
		return $query->result();
	}
	public function get_old_bal($sup_id)
	{
		$this->db->select('tbl_supp_acc.old_balance AS old_balance');
		$this->db->from('tbl_vendor');
		$this->db->join('tbl_supp_acc','sup_id_fk = vendor_id');
		$this->db->where('vendor_id',$sup_id);
		$this->db->order_by('sacc_id', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->result();
	}
	public function get_row($auto_invoice)
	{
		$this->db->select('*');
		$this->db->from('tbl_purchase');
		$this->db->join('tbl_product','tbl_product.product_id = tbl_purchase.product_id_fk');
		$this->db->join('tbl_vendor','tbl_vendor.vendor_id = tbl_purchase.vendor_id_fk');
		//$this->db->join('tbl_taxdetails','tbl_taxdetails.tax_id = tbl_purchase.tax_id_fk');
		$this->db->where('auto_invoice',$auto_invoice);
		$this->db->where('purchase_status',1);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_row1($auto_invoice)
	{
		$this->db->select('*');
		$this->db->from('tbl_purchase');
		$this->db->join('tbl_product','product_id = tbl_purchase.product_id_fk','left');
		$this->db->join('tbl_vendor','tbl_vendor.vendor_id = tbl_purchase.vendor_id_fk','left');
		$this->db->join('tbl_taxdetails','tbl_taxdetails.tax_id = tbl_purchase.tax_id_fk','left');
		$this->db->where('auto_invoice',$auto_invoice);
		$this->db->where('purchase_status',1);
		$query = $this->db->get();
		return $query->result();
	}
	public function get_data($purchase_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_purchase');
		$this->db->join('tbl_product','tbl_product.product_id = tbl_purchase.product_id_fk');
		$this->db->join('tbl_vendor','tbl_vendor.vendor_id = tbl_purchase.vendor_id_fk');
		$this->db->join('tbl_taxdetails','tbl_taxdetails.tax_id = tbl_purchase.tax_id_fk');
		$this->db->where('purchase_id',$purchase_id);
		$query = $this->db->get();
		return $query->result();
	}
	public function get_tax($tax_id_fk)
	{
		$this->db->select('taxamount');
		$this->db->from('tbl_taxdetails');
		$this->db->where('tax_id',$tax_id_fk);
		$query = $this->db->get();
		return $query->result();
	}
	public function getrow($purchase_id)
	{
		$this->db->select('invoice_number');
		$this->db->from('tbl_purchase');
		$this->db->where('purchase_id',$purchase_id);
		$this->db->where('purchase_status',1);
		$query = $this->db->get();
		return $query->result();
	}
	public function get_invc_no()
	{
		$this->db->select('invoice_number');
		$this->db->from('tbl_purchase');
		$this->db->where('purchase_status',1);
		$query = $this->db->get();
		return $query->result();
	}
	public function invoice_check($inv_no,$vendor_id)
	{
		$this->db->select('invoice_number');
		$this->db->from('tbl_purchase');
		$this->db->where('purchase_status',1);
		$this->db->where('vendor_id_fk',$vendor_id);
		$this->db->where('invoice_number',$inv_no);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function get_purchase_return_list($auto_invoice)
	{
		$this->db->select('*');
		$this->db->from('tbl_purchase');
		$this->db->join('tbl_vendor','tbl_vendor.vendor_id=tbl_purchase.vendor_id_fk','left');
		$this->db->join('tbl_product','tbl_product.product_id=tbl_purchase.product_id_fk','left');
		$this->db->join('tbl_taxdetails','tbl_taxdetails.tax_id=tbl_purchase.tax_id_fk','left','left');
		$this->db->where('purchase_status',1);
		$this->db->where('auto_invoice',$auto_invoice);
		$query = $this->db->get();
		return $query->result();
	}

	public function listhsn($pid)
	{
		$this->db->select('*');
		$this->db->from('tbl_product');
		$this->db->join('tbl_hsncode','hsn_id=product_hsn');
		$this->db->where('product_id',$pid);
		$query = $query = $this->db->get();
		return $query->result_array();


	}

	public function getStock_of_item($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_stock');
		$this->db->where('stock_item_fk_id',$id);
		$this->db->where('stock_item_type',1);
		$query = $query = $this->db->get();
		return $query->row();
	}

	public function get_stock_existance($item_id){
		$query=$this->db->select('*')->where('product_id',$item_id)->get('tbl_product');
		return $query->num_rows()>0 ? true : false;
	}

	public function get_current_productstock($item_id){
		$query=$this->db->select('product_stock')->where('product_id',$item_id)->get('tbl_product');
		return $query->num_rows()>0 ? $query->row()->product_stock : 0;
	}

	public function getPurchaseReturnList($param){
		$this->db->where("purchase_status",1);
		if ($param['start'] != 'false' and $param['length'] != 'false') {
			$this->db->limit($param['length'],$param['start']);
		}
		$this->db->select('*,DATE_FORMAT(purchase_date,\'%d/%m/%Y\') as purchase_dat,DATE_FORMAT(purchase_return_date,\'%d/%m/%Y\') as purchase_return_dates');
		$this->db->from('tbl_purchase');
		$this->db->join('tbl_product','product_id = product_id_fk');
		$this->db->join('tbl_vendor','vendor_id = vendor_id_fk');
		$this->db->order_by('purchase_id','DESC');
		$query = $this->db->get();
		$data['data'] = $query->result();
		$data['recordsTotal'] = $this->getPurchaseReturnListTotalCount($param);
		$data['recordsFiltered'] = $this->getPurchaseReturnListTotalCount($param);
		return $data;
	}

	public function getPurchaseReturnListTotalCount($param){
	
		$this->db->where("purchase_status",1);
		$this->db->select('*,DATE_FORMAT(purchase_date,\'%d/%m/%Y\') as purchase_dat');
		$this->db->from('tbl_purchase');
		$this->db->join('tbl_product','product_id = product_id_fk');
		$this->db->join('tbl_vendor','vendor_id = vendor_id_fk');
		$this->db->order_by('purchase_id','DESC');
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function getQtyOfprroducteachPurchase($auto_invoice,$prod_id)
	{
		$this->db->select('purchase_quantity');
		$this->db->from('tbl_purchase');
		$this->db->where("auto_invoice",$auto_invoice);
		$this->db->where("product_id_fk",$prod_id);
		$query = $this->db->get();
		return $query->row()->purchase_quantity;
	}
}
?>
