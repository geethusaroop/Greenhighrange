<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Purchase_model extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}
	public function getPurchaseReport($param,$branch_id_fk){
		$arOrder = array('','invoice_number','shop');
		$invoice_number =(isset($param['invoice_number']))?$param['invoice_number']:'';
		//$shop =(isset($param['shop']))?$param['shop']:'';
		
		$start_date = (isset($param['start_date'])) ? $param['start_date'] : '';
		$end_date = (isset($param['end_date'])) ? $param['end_date'] : '';

		if ($invoice_number){
			
			//$where1= '(tbl_purchase.invoice_number="'.$invoice_number.'" or vendorname = "'.$invoice_number.'")';
			//	$this->db->where($where1);
			$this->db->like('tbl_purchase.invoice_number', $invoice_number);
			$this->db->or_like('vendorname', $invoice_number);
		}

		if ($start_date && $end_date) {
			$this->db->where('purchase_date >=', $start_date);
			$this->db->where('purchase_date <=', $end_date);
		}
		if ($end_date) {
			$this->db->where('purchase_date <=', $end_date);
		}
		
		$this->db->where("purchase_status",1);
		if ($param['start'] != 'false' and $param['length'] != 'false') {
			$this->db->limit($param['length'],$param['start']);
		}
		if(!empty($branch_id_fk) && $branch_id_fk != 0)
        {
            $this->db->where("purchase_branch_id_fk",$branch_id_fk);
        }
        else
        {
            $this->db->where("purchase_branch_id_fk",0);
        }
		$this->db->select('*,COUNT(invoice_number) as prcount,ROUND(SUM(total_price),2) as total,DATE_FORMAT(purchase_date,\'%d/%m/%Y\') as purchase_dat');
		$this->db->from('tbl_purchase');
		$this->db->join('tbl_product','product_id = product_id_fk');
		$this->db->join('tbl_vendor','vendor_id = vendor_id_fk');
		$this->db->group_by('invoice_number');
		$this->db->order_by('purchase_date','ASC');
		$query = $this->db->get();
		$data['data'] = $query->result();
		$data['recordsTotal'] = $this->getPurchaseReportTotalCount($param,$branch_id_fk);
		$data['recordsFiltered'] = $this->getPurchaseReportTotalCount($param,$branch_id_fk);
		return $data;
	}
	public function getPurchaseReportTotalCount($param,$branch_id_fk){
		$invoice_number =(isset($param['invoice_number']))?$param['invoice_number']:'';
		//$shop =(isset($param['shop']))?$param['shop']:'';
		$start_date = (isset($param['start_date'])) ? $param['start_date'] : '';
		$end_date = (isset($param['end_date'])) ? $param['end_date'] : '';

		if ($invoice_number){
			
			//$where1= '(tbl_purchase.invoice_number="'.$invoice_number.'" or vendorname = "'.$invoice_number.'")';
			//	$this->db->where($where1);
			$this->db->like('tbl_purchase.invoice_number', $invoice_number);
			$this->db->or_like('vendorname', $invoice_number);
		}

		if ($start_date && $end_date) {
			$this->db->where('purchase_date >=', $start_date);
			$this->db->where('purchase_date <=', $end_date);
		}
		if ($end_date) {
			$this->db->where('purchase_date <=', $end_date);
		}
		
		if(!empty($branch_id_fk) && $branch_id_fk != 0)
        {
            $this->db->where("purchase_branch_id_fk",$branch_id_fk);
        }
        else
        {
            $this->db->where("purchase_branch_id_fk",0);
        }
		$this->db->where("purchase_status",1);
		$this->db->select('*,COUNT(invoice_number) as prcount,SUM(total_price) as total,DATE_FORMAT(purchase_date,\'%d/%m/%Y\') as purchase_date');
		$this->db->from('tbl_purchase');
		$this->db->join('tbl_product','product_id = product_id_fk');
		$this->db->join('tbl_vendor','vendor_id = vendor_id_fk');
		$this->db->group_by('invoice_number');
	//	$this->db->group_by('vendor_id_fk');
		$this->db->order_by('purchase_date','ASC');
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

	public function get_current_productstock($item_id,$branches_id){
		$query=$this->db->select('product_stock')->where('product_id',$item_id)->where('branch_id_fk',$branches_id)->get('tbl_product');
		return $query->num_rows()>0 ? $query->row()->product_stock : 0;
	}

	public function getPurchaseReturnList($param,$branch_id_fk){
		$invoice_number =(isset($param['invoice_number']))?$param['invoice_number']:'';
		$start_date = (isset($param['start_date'])) ? $param['start_date'] : '';
		$end_date = (isset($param['end_date'])) ? $param['end_date'] : '';

		if ($invoice_number){
			
			$where1= '(tbl_purchase.invoice_number="'.$invoice_number.'" or vendorname = "'.$invoice_number.'")';
				$this->db->where($where1);
		}

		if ($start_date && $end_date) {
			$this->db->where('purchase_return_date >=', $start_date);
			$this->db->where('purchase_return_date <=', $end_date);
		}
		if ($end_date) {
			$this->db->where('purchase_return_date <=', $end_date);
		}
		if(!empty($branch_id_fk) && $branch_id_fk != 0)
        {
            $this->db->where("purchase_branch_id_fk",$branch_id_fk);
        }
        else
        {
            $this->db->where("purchase_branch_id_fk",0);
        }
		$this->db->where("purchase_status",1);
		if ($param['start'] != 'false' and $param['length'] != 'false') {
			$this->db->limit($param['length'],$param['start']);
		}
		$this->db->select('*,DATE_FORMAT(purchase_date,\'%d/%m/%Y\') as purchase_date,DATE_FORMAT(purchase_return_date,\'%d/%m/%Y\') as purchase_return_dates');
		$this->db->from('tbl_purchase');
		$this->db->join('tbl_product','product_id = product_id_fk');
		$this->db->join('tbl_vendor','vendor_id = vendor_id_fk');
		$this->db->order_by('purchase_id','DESC');
		$query = $this->db->get();
		$data['data'] = $query->result();
		$data['recordsTotal'] = $this->getPurchaseReturnListTotalCount($param,$branch_id_fk);
		$data['recordsFiltered'] = $this->getPurchaseReturnListTotalCount($param,$branch_id_fk);
		return $data;
	}

	public function getPurchaseReturnListTotalCount($param,$branch_id_fk){
		$invoice_number =(isset($param['invoice_number']))?$param['invoice_number']:'';
		$start_date = (isset($param['start_date'])) ? $param['start_date'] : '';
		$end_date = (isset($param['end_date'])) ? $param['end_date'] : '';

		if ($invoice_number){
			
			$where1= '(tbl_purchase.invoice_number="'.$invoice_number.'" or vendorname = "'.$invoice_number.'")';
				$this->db->where($where1);
		}

		if ($start_date && $end_date) {
			$this->db->where('purchase_return_date >=', $start_date);
			$this->db->where('purchase_return_date <=', $end_date);
		}
		if ($end_date) {
			$this->db->where('purchase_return_date <=', $end_date);
		}
		if(!empty($branch_id_fk) && $branch_id_fk != 0)
        {
            $this->db->where("purchase_branch_id_fk",$branch_id_fk);
        }
        else
        {
            $this->db->where("purchase_branch_id_fk",0);
        }
		$this->db->where("purchase_status",1);
		$this->db->select('*,DATE_FORMAT(purchase_date,\'%d/%m/%Y\') as purchase_date');
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


	public function get_purchase_pdf($auto_invoice)
	{
		$array = [];
		$this->db->select('*');
		$this->db->from('tbl_purchase');
		$this->db->where('purchase_status',1);
		$this->db->join('tbl_product','tbl_product.product_id = tbl_purchase.product_id_fk','left');
		$this->db->join('tbl_vendor','tbl_vendor.vendor_id = tbl_purchase.vendor_id_fk','left');
		$this->db->where('auto_invoice',$auto_invoice);
		$query = $this->db->get();
		$array = $query->result();


		$date = date("d/m/Y", strtotime($array[0]->purchase_date));
		$output = '<style>
		' . file_get_contents(base_url() . "assets/bootstrap/css/bootstrap.min.css") . '
		</style>';
		$output .= '<div id="divName">
		<div class="panel panel-default">
		 <div class="panel-body">
	 <div class="inner" id="invcontent">
	   <div class="row">
		 <div class="col-xs-12">
		   <h2 class="page-header">
			 <i class="fa fa-file"></i> <b>Invoice #'.$array[0]->invoice_number.'</b>
			 <small class="pull-right">Date: '.$date.'</small>
		   </h2>
		 </div>
	   </div>
	   <div class="row invoice-info">
		 <div class="col-md-4 invoice-col">
		   From
		   <address>
			 <strong>'.strtoupper($array[0]->vendorname).'</strong><br>
			 '.$array[0]->vendoraddress.'<br>
			 Phone: '.$array[0]->vendorphone.'<br>
			 Email: '.$array[0]->vendoremail.'
		   </address>
		 </div>
		 <div class="col-md-4 invoice-col">
		   <address>
		   <strong>GREENHIGHRANGE FARMERS PRODUCER COMPANY LIMITED</strong><br>
			 Green Highrange Farmer Producer Company Ltd,Building No, 106/14,Vakachuvadu, Prabhacity,Kanjikuzhy,Idukki, Kerala - 685606<br>State : Kerala Code : 32
		  <br>Phone:+91 7907753352<br>Email : greenhighrangeidk@gmail.com<br>LIC NO : 71331
		   </address>
		 </div>
		 <div class="col-md-4 invoice-col">Invoice
		   <address>
		   <b>Invoice #'.$array[0]->invoice_number.'</b><br>
		  <b>Date: '.$date.'</b><br>
		</address>
		 </div>
	   </div>
	   <div class="row">
		 
		   <table width="100%" style="border-right:1px solid #ddd;border-left: 1px solid #ddd;">
			 <thead>
			<tr style="border-top: 1px solid #ddd;border-bottom:  1px solid #ddd;">
			   <th style="border-right: 1px solid #ddd;padding: 4px;width:50px;">S.No.</th>
		 	   <th style="border-right: 1px solid #ddd;padding: 4px;">Product Name</th>
			   <th style="border-right: 1px solid #ddd;padding: 4px;text-align: right;">Quantity</th>
			   <th style="border-right: 1px solid #ddd;padding: 4px;">Purchase Rate</th>
			   <th style="border-right: 1px solid #ddd;padding: 4px;">MRP</th>
		       <th style="border-right: 1px solid #ddd;padding: 4px;">Discount</th>
			   <th style="border-right: 1px solid #ddd;padding: 4px;">Tax</th>
			   <th style="border-right: 1px solid #ddd;padding: 4px;text-align:right;">Unit Price</th>
		 	   <th style="border-right: 1px solid #ddd;padding: 4px;text-align: right;">Amount</th>
			 </tr>
			 </thead>
			 <tbody>
			   <tr style="border-bottom:  1px solid #ddd;"></tr>';
	   $sum = 0; $quantity_sum = 0; $unit=""; $price=0;$cgst=0; $cgst_amt=0; $totcgst =0; for($i=0;$i<count($array);$i++){
		$output.='
			<tr>
			   	<td style="border-right: 1px solid #ddd;padding: 4px;">'. $j = $i + 1 .'</td>
		 		<td style="border-right: 1px solid #ddd;padding: 4px;font-weight: bold;">'.strtoupper($array[$i]->product_name).'</td>
			   	<td style="border-right: 1px solid #ddd;padding: 4px;font-weight: bold;text-align: right;">'.$array[$i]->purchase_quantity ." ". "NOs".'</td>
			   	<td style="border-right: 1px solid #ddd;padding: 4px;">Rs.'.$array[$i]->purchase_price.'</td>
				<td style="border-right: 1px solid #ddd;padding: 4px;">Rs'.$array[$i]->purchase_mrp.'</td>
		 		<td style="border-right: 1px solid #ddd;padding: 4px;">'.$array[$i]->discount_price.' %</td>
		 		<td style="border-right: 1px solid #ddd;padding: 4px;">'.$array[$i]->purchase_igst.' %</td>
		 		<td style="border-right: 1px solid #ddd;padding: 4px;font-weight: bold;text-align: right;">'.$array[$i]->total_price.'</td>
				<td style="border-right: 1px solid #ddd;padding: 4px;font-weight: bold;text-align: right;">'.$array[$i]->purchase_netamt.'</td>
			 </tr>';

		   $sum = $sum + ($array[$i]->purchase_netamt);
		   $quantity_sum = $quantity_sum + $array[$i]->purchase_quantity;
		   $unit="Nos";
		   $price=$price+$array[$i]->total_price;
		   $cgst=($array[$i]->purchase_igst)/2; $cgst_amt=$sum * ($cgst/100);$totcgst=$totcgst + $array[$i]->purchase_igst;

		   } 

		   $output.='
		  	<tr>
			  <td style="border-right: 1px solid #ddd;padding: 4px;"></td> 
			  <td style="border-right: 1px solid #ddd;padding: 4px;"></td>
			  <td style="border-right: 1px solid #ddd;padding: 4px;"></td>
			  <td style="border-right: 1px solid #ddd;padding: 4px;"></td> 
			  <td style="border-right: 1px solid #ddd;padding: 4px;"></td> 
			  <td style="border-right: 1px solid #ddd;padding: 4px;"></td> 
			  <td style="border-right: 1px solid #ddd;padding: 4px;"></td> <td style="border-right: 1px solid #ddd;padding: 4px;"></td>
			  <td style="border-right: 1px solid #ddd;padding: 4px;font-weight: bold;text-align: right;border-top:1px solid #ddd; ">'.$sum.'</td>
			 </tr>
		   <tr> <td style="border-right: 1px solid #ddd;"></td> 
			 <td style="border-right: 1px solid #ddd;"></td> 
			 <td style="border-right: 1px solid #ddd;"></td> 
			 <td style="border-right: 1px solid #ddd;"></td> 
			 <td style="border-right: 1px solid #ddd;padding: 4px;"></td> 
			 <td style="border-right: 1px solid #ddd;"></td>
			 <td style="border-right: 1px solid #ddd;padding: 4px;"></td> 
			 <td style="border-right: 1px solid #ddd;padding :60px;"></td>
		   </tr>
			 </tbody>
			 <tfoot style="font-weight: bold;border-top:  1px solid #ddd;border-bottom: 1px solid #ddd;">
			   <tr style="">
				<td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;"></td> 
				<td style="border-right: 1px solid #ddd;text-align: center;border-bottom: 1px solid #ddd;">Total</td> 
				<td style="border-right: 1px solid #ddd;text-align: right;border-bottom: 1px solid #ddd;">'.$quantity_sum." ".$unit.'</td>
				<td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;"></td>
				<td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;"></td>
				<td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;"></td>
				<td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;"></td>
				<td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;text-align: right;"><i class="fa fa-inr"></i> '.$price.'</td>
				<td style="padding: 4px;border-right: 1px solid #ddd;text-align: right;border-bottom: 1px solid #ddd;"><i class="fa fa-inr"></i>'.($sum).'</td>
			   </tr>
				<tr>
			   	<td style="padding: 4px;border-bottom: 1px solid #ddd;" colspan="12"><span style="font-weight: normal;">Amount Chargable (In Words)</span><br>
				<span style="font-weight: bold;">INR'.$this->convert2word($sum).'Only</span>
 
			   </td> 
			 	<td style="border-bottom: 1px solid #ddd;"></td> 
			 	<td style="border-bottom: 1px solid #ddd;"></td> 
			 	<td style="border-bottom: 1px solid #ddd;"></td> 
			 	<td style="border-bottom: 1px solid #ddd;"></td>
			 	<td style="border-bottom: 1px solid #ddd;"></td>
			  	<td style="border-bottom: 1px solid #ddd;"></td>
			  	<td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;"></td>
				<td style="border-bottom: 1px solid #ddd;"></td>
		   </tr>
 
			<tr style="">
				 <td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;"></td> 
				 <td style="border-right: 1px solid #ddd;text-align: center;border-bottom: 1px solid #ddd;">Old Balance</td> 
				 <td style="border-right: 1px solid #ddd;text-align: right;border-bottom: 1px solid #ddd;"></td> 
				 <td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;"></td>
				 <td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;"></td>
				 <td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;"></td>
				 <td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;"></td>
				 <td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;"></td>
				 <td style="padding: 4px;border-right: 1px solid #ddd;text-align: right;border-bottom: 1px solid #ddd;"><i class="fa fa-inr"></i> '.$array[0]->pur_old_bal.'</td>
			   </tr>';
		   		$old_balances = 0;
				$old_balances= $sum + $array[0]->pur_old_bal;
			   $output.='
			   <tr style="">
				 <td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;"></td>  <td style="border-right: 1px solid #ddd;text-align: center;border-bottom: 1px solid #ddd;">Discount</td>  <td style="border-right: 1px solid #ddd;text-align: right;border-bottom: 1px solid #ddd;"></td>  <td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;"></td>  <td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;"></td><td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;"></td>
				 <td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;"></td>  <td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;"></td><td style="padding: 4px;border-right: 1px solid #ddd;text-align: right;border-bottom: 1px solid #ddd;"><i class="fa fa-inr"></i> 0 </td>
			   </tr>
				<tr style="">
				 <td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;"></td>  <td style="border-right: 1px solid #ddd;text-align: center;border-bottom: 1px solid #ddd;">Net Total</td>  <td style="border-right: 1px solid #ddd;text-align: right;border-bottom: 1px solid #ddd;"></td>  <td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;"></td>  <td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;"></td><td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;"></td>
				 <td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;"></td>  <td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;"></td><td style="padding: 4px;border-right: 1px solid #ddd;text-align: right;border-bottom: 1px solid #ddd;"><i class="fa fa-inr"></i> '.$old_balances.'</td>
			   </tr>
			   <tr style="">
				 <td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;"></td>  <td style="border-right: 1px solid #ddd;text-align: center;border-bottom: 1px solid #ddd;">Cash Paid</td>  <td style="border-right: 1px solid #ddd;text-align: right;border-bottom: 1px solid #ddd;"></td>  <td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;"></td>  <td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;"></td><td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;"></td>
				 <td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;"></td>  <td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;"></td><td style="padding: 4px;border-right: 1px solid #ddd;text-align: right;border-bottom: 1px solid #ddd;"><i class="fa fa-inr"></i> '.$array[0]->pur_paid_amt.'</td>
			   </tr>
			   <tr style="">
				 <td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;"></td>  <td style="border-right: 1px solid #ddd;text-align: center;border-bottom: 1px solid #ddd;">Balance</td>  <td style="border-right: 1px solid #ddd;text-align: right;border-bottom: 1px solid #ddd;"></td>  <td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;"></td>  <td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;"></td><td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;"></td>
				 <td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;"></td>  <td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;"></td><td style="padding: 4px;border-right: 1px solid #ddd;text-align: right;border-bottom: 1px solid #ddd;"><i class="fa fa-inr"></i> '.$array[0]->pur_new_bal.'</td>
			   </tr>
			   <tr>
			   <td style="padding: 4px;border-bottom: 1px solid #ddd;" colspan="8"><span style="font-weight: normal;">Cash Paid (In Words)</span><br>
			   <span style="font-weight: bold;"> NR&nbsp;'.$this->convert2word($array[0]->pur_paid_amt).'&nbsp;Only</span>
 
			   </td> 
			  <td style="border-bottom: 1px solid #ddd;text-align: right;"><i class="fa fa-inr"></i>'.$array[0]->pur_paid_amt.' </td>  
		   </tr>
			 </tfoot>
		   </table>
		   
	   </div>
	  </div>
	 </div>
   </div>
 </div>';
		return $output;
	}

	public function convert2word($number)
	{
		$no = floor($number);
		$point = round($number - $no, 2) * 100;
		$hundred = null;
		$digits_1 = strlen($no);
		$i = 0;
		$str = array();
		$words = array(
			'0' => '', '1' => 'one', '2' => 'two',
			'3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
			'7' => 'seven', '8' => 'eight', '9' => 'nine',
			'10' => 'ten', '11' => 'eleven', '12' => 'twelve',
			'13' => 'thirteen', '14' => 'fourteen',
			'15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
			'18' => 'eighteen', '19' => 'nineteen', '20' => 'twenty',
			'30' => 'thirty', '40' => 'forty', '50' => 'fifty',
			'60' => 'sixty', '70' => 'seventy',
			'80' => 'eighty', '90' => 'ninety'
		);
		$digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
		while ($i < $digits_1) {
			$divider = ($i == 2) ? 10 : 100;
			$number = floor($no % $divider);
			$no = floor($no / $divider);
			$i += ($divider == 10) ? 1 : 2;
			if ($number) {
				$plural = (($counter = count($str)) && $number > 9) ? 's' : null;
				$hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
				$str[] = ($number < 21) ? $words[$number] .
					" " . $digits[$counter] . $plural . " " . $hundred
					:
					$words[floor($number / 10) * 10]
					. " " . $words[$number % 10] . " "
					. $digits[$counter] . $plural . " " . $hundred;
			} else $str[] = null;
		}
		$str = array_reverse($str);
		$result = implode('', $str);
		$points = ($point) ?
			"." . $words[$point / 10] . " " .
			$words[$point = $point % 10] : '';
		return $result;
	}

	public function view_by($branch_id_fk)
	{
		$status=1;
		$this->db->select('*');
		$this->db->from('tbl_vendor');
		$this->db->where('vendorstatus', $status);
		if(!empty($branch_id_fk) && $branch_id_fk != 0)
        {
            $this->db->where("vendor_branch_id_fk",$branch_id_fk);
        }
        else
        {
            $this->db->where("vendor_branch_id_fk",0);
        }
		$this->db->order_by('vendorname','ASC');
		$query = $this->db->get();
		return $query->result();
	}

	public function getPurchaseReturnReport($param,$branch_id_fk){
        $arOrder = array('','invoice_number','shop');
      //  $invoice_number =(isset($param['invoice_number']))?$param['invoice_number']:'';
      //  $startDate =(isset($param['startDate']))?$param['startDate']:'';
    //    $endDate =(isset($param['endDate']))?$param['endDate']:'';
		$invoice_number =(isset($param['invoice_number']))?$param['invoice_number']:'';
		$start_date = (isset($param['start_date'])) ? $param['start_date'] : '';
		$end_date = (isset($param['end_date'])) ? $param['end_date'] : '';

		if ($invoice_number){
			
			//$where1= '(tbl_purchase.invoice_number="'.$invoice_number.'" or vendorname = "'.$invoice_number.'")';
			//	$this->db->where($where1);
			$this->db->like('tbl_purchase.invoice_number', $invoice_number);
			$this->db->or_like('vendorname', $invoice_number);
		}

		if ($start_date && $end_date) {
			$this->db->where('purchase_return_date >=', $start_date);
			$this->db->where('purchase_return_date <=', $end_date);
		}
		if ($end_date) {
			$this->db->where('purchase_return_date <=', $end_date);
		}
		$this->db->where("purchase_status",1);
		if(!empty($branch_id_fk) && $branch_id_fk != 0)
        {
            $this->db->where("purchase_branch_id_fk",$branch_id_fk);
        }
        else
        {
            $this->db->where("purchase_branch_id_fk",0);
        }
        if ($param['start'] != 'false' and $param['length'] != 'false') {
            $this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*,DATE_FORMAT(purchase_return_date,\'%d/%m/%Y\') as purchase_return_date,DATE_FORMAT(purchase_date,\'%d/%m/%Y\') as purchase_dat');
		$this->db->from('tbl_purchase');
		$this->db->join('tbl_product','product_id = product_id_fk');
		$this->db->join('tbl_vendor','vendor_id = vendor_id_fk');
		$this->db->group_by('invoice_number');
		$this->db->order_by('purchase_date','ASC');
        $query = $this->db->get();
        
		$data['data'] = $query->result();
        $data['recordsTotal'] = $this->getPurchaseReportReturnTotalCount($param,$branch_id_fk);
        $data['recordsFiltered'] = $this->getPurchaseReportReturnTotalCount($param,$branch_id_fk);
        return $data;
	}
	public function getPurchaseReportReturnTotalCount($param,$branch_id_fk){
        $invoice_number =(isset($param['invoice_number']))?$param['invoice_number']:'';
		$start_date = (isset($param['start_date'])) ? $param['start_date'] : '';
		$end_date = (isset($param['end_date'])) ? $param['end_date'] : '';

		if ($invoice_number){
			
			//$where1= '(tbl_purchase.invoice_number="'.$invoice_number.'" or vendorname = "'.$invoice_number.'")';
			//	$this->db->where($where1);
			$this->db->like('tbl_purchase.invoice_number', $invoice_number);
			$this->db->or_like('vendorname', $invoice_number);
		}

		if ($start_date && $end_date) {
			$this->db->where('purchase_return_date >=', $start_date);
			$this->db->where('purchase_return_date <=', $end_date);
		}
		if ($end_date) {
			$this->db->where('purchase_return_date <=', $end_date);
		}
		if(!empty($branch_id_fk) && $branch_id_fk != 0)
        {
            $this->db->where("purchase_branch_id_fk",$branch_id_fk);
        }
        else
        {
            $this->db->where("purchase_branch_id_fk",0);
        }
		$this->db->where("purchase_status",1);
		$this->db->select('*,DATE_FORMAT(purchase_return_date,\'%d/%m/%Y\') as purchase_return_date');
		$this->db->from('tbl_purchase');
		$this->db->join('tbl_product','product_id = product_id_fk');
		$this->db->join('tbl_vendor','vendor_id = vendor_id_fk');
		$this->db->group_by('invoice_number');
		$this->db->order_by('purchase_date','ASC');
        $query = $this->db->get();
		return $query->num_rows();
	}

	public function getEditData($auto_invoice)
	{
		$this->db->select('*');
		$this->db->from('tbl_purchase');
        $this->db->join('tbl_product','tbl_product.product_id = tbl_purchase.product_id_fk','left');
        $this->db->join('tbl_vendor','tbl_vendor.vendor_id = tbl_purchase.vendor_id_fk','left');
		$this->db->where('purchase_status', 1);
        $this->db->where('auto_invoice', $auto_invoice);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_stoks($prid)
	{
		$this->db->select('product_stock');
		$this->db->from('tbl_product');
		$this->db->where('product_id',$prid);
		$query = $this->db->get();
		return $query->result();
	}
}
?>
