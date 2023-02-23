<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class RSSale_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}
	#################################################allsale report##########################################################
	public function getSaleReport($param)
	{
		$arOrder = array('', 'product_num');
		$product_num = (isset($param['product_num'])) ? $param['product_num'] : '';
		$sdate = (isset($param['sdate'])) ? $param['sdate'] : '';

		if ($product_num) {
			$this->db->like('tbl_sale.invoice_number', $product_num);
		}

		if ($sdate) {
			$this->db->where('sale_date ', $sdate);
		}
		
		$this->db->where("routsale_status",1);
		$this->db->where("sale_status", 1);

		if ($param['start'] != 'false' and $param['length'] != 'false') {
			$this->db->limit($param['length'], $param['start']);
		}
		$this->db->select('*,COUNT(invoice_number) as slcount,SUM(sale_netamt) as total,sum(sale_quantity) as qty,(total_price-(sale_discount+sale_shareholder_discount)) as tprice,DATE_FORMAT(sale_date,\'%d/%m/%Y\') as sale_dates,tbl_sale.sale_discount as discount');
		$this->db->from('tbl_sale');
		$this->db->join('tbl_member', 'tbl_member.member_id = tbl_sale.member_id_fk', 'left');
		$this->db->group_by('invoice_number', 'DESC');
		$query = $this->db->get();

		$data['data'] = $query->result();
		$data['recordsTotal'] = $this->getSaleReportTotalCount($param);
		$data['recordsFiltered'] = $this->getSaleReportTotalCount($param);
		//return $this->db->last_query();
		return $data;
	}
	public function getSaleReportTotalCount($param)
	{
		$product_num = (isset($param['product_num'])) ? $param['product_num'] : '';
		//$shop =(isset($param['shop']))?$param['shop']:'';
		$sdate = (isset($param['sdate'])) ? $param['sdate'] : '';
		if ($product_num) {
			$this->db->like('tbl_sale.invoice_number', $product_num);
		}
		if ($sdate) {
			$this->db->where('sale_date ', $sdate);
		}
		$this->db->where("routsale_status",1);
		$this->db->select('*,COUNT(invoice_number) as slcount,SUM(sale_netamt) as total,sum(sale_quantity) as qty,DATE_FORMAT(sale_date,\'%d/%m/%Y\') as sale_dates,tbl_sale.discount_price as discount');
		$this->db->from('tbl_sale');
		$this->db->join('tbl_member', 'tbl_member.member_id = tbl_sale.member_id_fk', 'left');
		$this->db->where("sale_status", 1);
		$this->db->group_by('invoice_number', 'DESC');

		$query = $this->db->get();
		return $query->num_rows();
	}
	###########################################################################################################################

	public function getSaleReport1($param,$date)
	{
		$arOrder = array('', 'product_num');
		$product_num = (isset($param['product_num'])) ? $param['product_num'] : '';

		if ($product_num) {
			$this->db->like('tbl_sale.invoice_number', $product_num);
		}
		
			$this->db->where('sale_date ', $date);
		
		$this->db->where("routsale_status",1);
		$this->db->where("sale_status", 1);

		if ($param['start'] != 'false' and $param['length'] != 'false') {
			$this->db->limit($param['length'], $param['start']);
		}
		$this->db->select('*,COUNT(invoice_number) as slcount,SUM(sale_netamt) as total,sum(sale_quantity) as qty,(total_price-(sale_discount+sale_shareholder_discount)) as tprice,DATE_FORMAT(sale_date,\'%d/%m/%Y\') as sale_dates,tbl_sale.sale_discount as discount');
		$this->db->from('tbl_sale');
		$this->db->join('tbl_member', 'tbl_member.member_id = tbl_sale.member_id_fk', 'left');
		$this->db->group_by('invoice_number', 'DESC');
		$query = $this->db->get();

		$data['data'] = $query->result();
		$data['recordsTotal'] = $this->getSaleReportTotalCount1($param,$date);
		$data['recordsFiltered'] = $this->getSaleReportTotalCount1($param,$date);
		//return $this->db->last_query();
		return $data;
	}
	public function getSaleReportTotalCount1($param,$date)
	{
		$product_num = (isset($param['product_num'])) ? $param['product_num'] : '';
		if ($product_num) {
			$this->db->like('tbl_sale.invoice_number', $product_num);
		}
		$this->db->where('sale_date ', $date);
		$this->db->where("routsale_status",1);
		$this->db->select('*,COUNT(invoice_number) as slcount,SUM(sale_netamt) as total,sum(sale_quantity) as qty,DATE_FORMAT(sale_date,\'%d/%m/%Y\') as sale_dates,tbl_sale.discount_price as discount');
		$this->db->from('tbl_sale');
		$this->db->join('tbl_member', 'tbl_member.member_id = tbl_sale.member_id_fk', 'left');
		$this->db->where("sale_status", 1);
		$this->db->group_by('invoice_number', 'DESC');

		$query = $this->db->get();
		return $query->num_rows();
	}

	###################################################################################################

	function getproductname()
	{
		$this->db->select('item_id,item_name');
		$this->db->where("item_status", 1);
		$query = $this->db->get('tbl_production_itemlist');
		$item_name = array();
		if ($query->result()) {
			foreach ($query->result() as $item_names) {
				$item_name[$item_names->item_id] = $item_names->item_name;
			}
			return $item_name;
		} else {
			return FALSE;
		}
	}


	function gettax()
	{

		$this->db->select('tax_id,taxamount');
		$this->db->where("tax_status", 1);
		$query = $this->db->get('tbl_taxdetails');
		$tax_name = array();
		if ($query->result()) {
			foreach ($query->result() as $tax_names) {
				$tax_name[$tax_names->tax_id] = $tax_names->taxamount;
			}
			return $tax_name;
		} else {
			return FALSE;
		}
	}
	function getproductnum()
	{
		$this->db->select('*');
		$this->db->from('tbl_purchase');
		$this->db->where('purchase_status', 1);
		$this->db->join('tbl_product', 'tbl_product.product_id = tbl_purchase.product_id_fk');
		$query = $this->db->get();

		$product_num = array();
		if ($query->result()) {
			foreach ($query->result() as $productnum) {
				$product_num[$productnum->product_id] = $productnum->product_num;
			}
			return $product_num;
		} else {
			return FALSE;
		}
	}
	function getproduct($product_cmpny, $product_size)
	{
		$this->db->select('product_id,product_name');
		$this->db->where("product_status", 1);
		$this->db->where("product_cmpny", $product_cmpny);
		$this->db->where("product_size", $product_size);
		$query = $this->db->get('tbl_product');
		$product_name = array();
		if ($query->result()) {
			foreach ($query->result() as $product_names) {
				$product_name[$product_names->product_id] = $product_names->product_name;
			}
			return $product_name;
		} else {
			return FALSE;
		}
	}
	function getproductcompany($product_size)
	{
		$this->db->select('product_id,product_cmpny');
		$this->db->where("product_status", 1);
		$this->db->where("product_size", $product_size);
		$this->db->group_by('product_cmpny', 'DESC');
		$query = $this->db->get('tbl_product');
		$product_name = array();
		if ($query->result()) {
			foreach ($query->result() as $product_names) {
				$product_name[$product_names->product_id] = $product_names->product_cmpny;
			}
			return $product_name;
		} else {
			return FALSE;
		}
	}
	public function getAmount($tax_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_taxdetails');
		$this->db->where('tax_id', $tax_id);
		$this->db->where('tax_status', 1);
		$query = $this->db->get();
		return $query->row();
	}
	
	public function get_price($product_id)
	{
		$this->db->select('item_price');
		$this->db->from('tbl_production_itemlist');
		$this->db->where('item_id', $product_id);
		$this->db->where("item_status", 1);
		$query = $this->db->get();
		//print_r($query->result());
		//exit();
		return $query->result();
	}

	public function getprice($product_id_fk)
	{
		$this->db->select('production_price');
		$this->db->from('tbl_production_details');
		$this->db->where('production_item_id_fk', $product_id_fk);
		$query = $this->db->get();
		return $query->row();
	}
	public function get_invc($invc_no)
	{
		$this->db->select('*,((sale_price-((sale_price*100)/(100+tbl_sale.taxamount)))/2)*sale_quantity as sgst, (tbl_sale.taxamount/2) as taxper,((sale_price*100)/(100+tbl_sale.taxamount)) as rate');
		$this->db->from('tbl_sale');
		$this->db->where('sale_status', 1);
		$this->db->join('tbl_product', 'tbl_product.product_id = tbl_sale.product_id_fk', 'left');
		$this->db->join('tbl_member', 'tbl_member.member_id = tbl_sale.member_id_fk', 'left');
		//	$this->db->join('tbl_taxdetails','tbl_taxdetails.tax_id = tbl_sale.tax_id_fk','left');
		$this->db->where('tbl_sale.auto_invoice', $invc_no);
		$query = $this->db->get();
		return $query->result();
	}
	public function get_invoice($invoice_no)
	{
		$this->db->select('*,((sale_price-((sale_price*100)/(100+tbl_sale.taxamount)))/2)*sale_quantity as sgst, (tbl_sale.taxamount/2) as taxper,((sale_price*100)/(100+tbl_sale.taxamount)) as rate');
		$this->db->from('tbl_sale');
		$this->db->where('sale_status', 1);
		$this->db->join('tbl_product', 'tbl_product.product_id = tbl_sale.product_id_fk', 'left');
		$this->db->join('tbl_member', 'tbl_member.member_id = tbl_sale.member_id_fk', 'left');
		//$this->db->join('tbl_taxdetails','tbl_taxdetails.tax_id = tbl_sale.tax_id_fk');
		$this->db->where('tbl_sale.invoice_number', $invoice_no);
		$query = $this->db->get();
		return $query->result();
	}
	
	function get_product($item_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_production_itemlist');
		$this->db->where('item_id', $item_id);
		$this->db->where('item_status', 1);
		$query = $this->db->get();
		if ($query) {
			return $query->result();
		} else {
			return 0;
		}
	}
	function get_fyear()
	{
		$this->db->select('*');
		$this->db->from('tbl_finyear');
		$this->db->where('fin_status', 1);
		$this->db->where('status', 1);
		$query = $this->db->get();
		return $query->result();
	}
	function get_stk($prid)
	{
		$this->db->select('*');
		$this->db->from('tbl_production_details');
		$this->db->where('production_item_id_fk', $prid);
		$this->db->where("production_status", 1);
		//$this->db->where('shop_id_fk',$shop_id);
		$query = $this->db->get();
		return $query->result();
	}
	public function get_purchasedetails($product_num, $product_size)
	{
		$this->db->select('purchase_price,landing_cost');
		$this->db->from('tbl_purchase');
		$this->db->where('product_id_fk', $product_num);
		$this->db->join('tbl_product', 'tbl_product.product_id = tbl_purchase.product_id_fk');
		$this->db->where('product_size', $product_size);
		//$this->db->where('purchase_status', 1);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_purchasedetails2($product_num)
	{
		$this->db->select('*,SUM()');
		$this->db->from('tbl_product');
		$this->db->where('product_id', $product_num);
		//$this->db->join('(SELECT SUM(COALESCE(purchase_price,0))) AS purchase_price  FROM tbl_purchase GROUP BY product_id_fk) AS tbl_purchase','tbl_purchase.product_id_fk = tbl_product.product_id');
		$this->db->join('tbl_purchase', 'tbl_purchase.product_id_fk=tbl_product.product_id');
		//$this->db->where('purchase_status', 1);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_stok($prid, $shop_id)
	{
		$this->db->select('item_quantity');
		$this->db->from('tbl_production_itemlist');
		$this->db->where('item_id', $prid);
		$this->db->where("item_status", 1);
		//$this->db->where('shop_id_fk',$shop_id);
		$query = $this->db->get();
		return $query->result();
	}
	

	public function get_invoiceno($user)
	{
		$this->db->select('*');
		$this->db->from('tbl_sale');
		$this->db->where('sale_status', 1);
		$this->db->where('shop_id_fk', $user);
		$this->db->order_by('invoice_number', "DESC");
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->row();
	}

	public function view_by()
	{
		$status = 1;
		$this->db->select('*');
		$this->db->from('tbl_taxdetails');
		$this->db->where('tax_status', $status);
		$query = $this->db->get();

		$tax_amounts = array();
		if ($query->result()) {
			foreach ($query->result() as $tax_amount) {
				$tax_names[$tax_amount->tax_id] = $tax_amount->taxamount;
			}
			return $tax_names;
		} else {
			return FALSE;
		}
	}

	function getproductnames()
	{
		$this->db->select('item_id,item_name');
		$this->db->where("item_status", 1);
		//$this->db->where("production_status",1);
		//$this->db->join("tbl_production_details",'item_id=production_item_id_fk','left');
		$query = $this->db->get('tbl_production_itemlist');
		$product_name = array();
		if ($query->result()) {
			foreach ($query->result() as $product_names) {
				$product_name[$product_names->item_id] = $product_names->item_name;
			}
			return $product_name;
		} else {
			return FALSE;
		}
	}


	public function get_members()
	{

		$query = $this->db->select('member_name')->from('tbl_member')->get();

		return $query->result();
	}



	public function getproductname1($p_id)
	{
		$this->db->select('*');
		//$this->db->join("tbl_production_details",'item_id=production_item_id_fk','left');
		$this->db->where("item_status", 1);
		//$this->db->where("production_status",1);
		$this->db->where("item_id", $p_id);
		$this->db->where("item_status", 1);
		$query = $this->db->get('tbl_production_itemlist');
		return $query->result();
	}

	public function get_memberaddress($id)
	{

		$this->db->select('member_address');
		$this->db->from('tbl_member');
		$this->db->where('member_id', $id);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_phone($id)
	{
		$this->db->select('member_pnumber');
		$this->db->from('tbl_member');
		$this->db->where('member_id', $id);
		$query = $this->db->get();
		return $query->result();
	}

	public function getOldBalanceDetails($id)
	{
		$this->db->select('tbl_mem_account.mem_acc_old_bal AS old_balance');
		$this->db->from('tbl_member');
		$this->db->join('tbl_mem_account', 'tbl_mem_account.mem_acc_id_fk=tbl_member.member_id');
		$this->db->where('member_id', $id);
		$query = $this->db->get();
		return $query->result();
	}

	public function getMemberlists($mem_id)
	{
		$this->db->select('member_id,member_name');
		$this->db->from('tbl_member');
		$this->db->where('member_type', $mem_id);
		$query = $this->db->get();
		return $query->result();
	}
	################JISHNU#########################
	public function get_table($table)
	{
		$query = $this->db->select('*')->get($table);
		return $query->num_rows() > 0 ? $query->result() : false;
	}

	##############################################

	public function get_admno()
	{
		$this->db->select('*');
		$this->db->from('tbl_sale');
		$this->db->where('sale_status', 1);
		$this->db->order_by('sale_id', "DESC");
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->row();
	}

	public function getproduct_names($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_product');
		$this->db->join('tbl_routsale', 'routsale_product_id_fk=product_id');
		$this->db->where("product_status", 1);
		$this->db->where("routsale_status", 1);
		$this->db->like("product_name", $id);
		$this->db->group_by("product_name");
		$records = $this->db->get()->result();
		foreach ($records as $row) {
			$response[] = array("name" => $row->product_name);
		}
		return $response;
	}

	public function get_row_barcode($p_name)

	{

		$this->db->select('*,(routsale_stock-routsale_sale_count) as product_stock');
		$this->db->from('tbl_product');
		$this->db->join('tbl_hsncode', 'hsncode=product_hsncode', 'left');
		$this->db->join('tbl_routsale', 'routsale_product_id_fk=product_id');
		$this->db->where('product_status', 1);
		$this->db->where('product_name', $p_name);
		$q = $this->db->get();

		if ($q->num_rows() > 0) {

			return $q->row();
		}

		return false;
	}
	public function get_row_barcode1($pid)

	{

		$this->db->select('*');
		$this->db->from('tbl_product');
		$this->db->join('tbl_hsncode', 'hsncode=product_hsncode', 'left');
		$this->db->where('product_status', 1);
		$this->db->where('product_id', $pid);
		$q = $this->db->get();

		if ($q->num_rows() > 0) {

			return $q->row();
		}

		return false;
	}

	public function get_row_rate($pid)

	{

		$this->db->select('*');
		$this->db->from('tbl_product');
		$this->db->where('product_status', 1);
		$this->db->where('product_id', $pid);
		$q = $this->db->get();

		if ($q->num_rows() > 0) {

			return $q->row();
		}

		return false;
	}

	public function get_sale_pdf($auto_invoice)
	{
		$array = [];
		$this->db->select('*');
		$this->db->from('tbl_sale');
		$this->db->where('sale_status', 1);
		$this->db->join('tbl_product', 'tbl_product.product_id = tbl_sale.product_id_fk');
		$this->db->join('tbl_member', 'tbl_member.member_id = tbl_sale.member_id_fk', 'left');
		$this->db->where('tbl_sale.auto_invoice', $auto_invoice);
		$query = $this->db->get();
		$array = $query->result();


		$date = date("d/m/Y", strtotime($array[0]->sale_date));
		$output = '<style>
		' . file_get_contents(base_url() . "assets/bootstrap/css/bootstrap.min.css") . '
		</style>';
		$output .= '<div class="panel panel-default">
        <div class="panel-body">
      <!-- title row -->
    <div class="inner" id="invcontent">
      <div class="row">
        <div class="col-xs-12">
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <small class="pull-right"><b>CIN:U01100KL2021PTC071331</b></small><br>
          <center style="color:#cb262d;">
            <h4><b>GREENHIGHRANGE FARMERS PRODUCER COMPANY LIMITED</b></h4>
            <p>[FPO Established under Govt of India scheme by NABARD and Peermade Development Society]</p>
            <p>Green Highrange Farmer Producer Company Ltd,Building No, 106/14,Vakachuvadu, Prabhacity,Kanjikuzhy,Idukki, Kerala - 685606</p>
            <p>Ph:+91 7907753352, Email:greenhighrangeidk@gmail.com</p>
          </center>
          <b>GSTIN:32BWUPG1355F1ZM</b><br>
          <p class="pull-right">Date: ' . $date . '</p>
          Invoice No. <b>' . $array[0]->invoice_number . '</b>
          <br><br>
          Buyer Details: <strong>' . $array[0]->member_name . '</strong>,
		  ' . $array[0]->member_address . ',
          , Phone: ' . $array[0]->member_pnumber . '
          , Email: ' . $array[0]->member_email . '
      </div>
    </div>
    <br>
      <!-- /.row -->
      <!-- Table row -->
      <div class="row">
          <table width="100%" style="border-right:1px solid #ddd;border-left: 1px solid #ddd;">
            <thead>
           <tr style="border-top: 1px solid #ddd;border-bottom:  1px solid #ddd;">
              <th style="border-right: 1px solid #ddd;padding: 10px;">S.No.</th>
              <th style="border-right: 1px solid #ddd;padding: 10px;">Particular or Discription of Goods</th>
              <th style="border-right: 1px solid #ddd;padding: 10px;text-align: right;">HSN/SAC</th>
              <th style="border-right: 1px solid #ddd;padding: 10px;">Unit Price</th>
              <th style="border-right: 1px solid #ddd;padding: 10px;">Rate After Discount</th>
              <th style="border-right: 1px solid #ddd;padding: 10px;text-align:center;">QTY</th>
              <th style="border-right: 1px solid #ddd;padding: 10px;">Amount</th>
              <th style="border-right: 1px solid #ddd;padding: 10px;">GST%</th>
              <th style="border-right: 1px solid #ddd;padding: 10px;text-align:center;">TAX Amount</th>
              <th style="border-right: 1px solid #ddd;padding: 10px;">Total Amount</th>
          </tr>
            </thead>
            <tbody>
              <tr style="border-bottom:  1px solid #ddd;"></tr>';
		$sum = 0;
		$j = 1;
		for ($i = 0; $i < count($array); $i++) {
			$output .= '	
            <tr>
              <td style="border-right: 1px solid #ddd;padding: 10px;">' . $j . '</td>
              <td style="border-right: 1px solid #ddd;padding: 10px;font-weight: bold;">' . strtoupper($array[$i]->product_name) . '</td>
              <td style="border-right: 1px solid #ddd;padding: 10px;font-weight: bold;">' . strtoupper($array[$i]->sale_hsn) . '</td>
              <td style="border-right: 1px solid #ddd;padding: 10px;">Rs.' . $array[$i]->sale_price . '</td>
              <td style="border-right: 1px solid #ddd;padding: 10px;">Rs.' . $array[$i]->discount_price . '</td>
              <td style="border-right: 1px solid #ddd;padding: 10px;">' . $array[$i]->sale_quantity . '</td>
              <td style="border-right: 1px solid #ddd;padding: 10px;">' . $array[$i]->total_price . '</td>
              <td style="border-right: 1px solid #ddd;padding: 10px;">' . $array[$i]->sale_igst . '%</td>
              <td style="border-right: 1px solid #ddd;padding: 10px;">Rs.' . $array[$i]->taxamount . '</td>
              <td style="border-right: 1px solid #ddd;padding: 10px;font-weight: bold;">Rs.' . $array[$i]->total_price . '</td>
            </tr>';
			$j++;
			$sum += $array[$i]->total_price;
		}
		$output .= '
          <tr> <td style="border-right: 1px solid #ddd;"></td>
            <td style="border-right: 1px solid #ddd;"></td>
            <td style="border-right: 1px solid #ddd;"></td>
            <td style="border-right: 1px solid #ddd;"></td>
            <td style="border-right: 1px solid #ddd;"></td>
            <td style="border-right: 1px solid #ddd;"></td>
            <td style="border-right: 1px solid #ddd;"></td>
            <td style="border-right: 1px solid #ddd;"></td>
            <td style="border-right: 1px solid #ddd;padding :100px;"></td>
          </tr>
            </tbody>
            <tfoot style="font-weight: bold;border-top:  1px solid #ddd;border-bottom: 1px solid #ddd;">
              <tr>
                <td style="border-right: 1px solid #ddd;" colspan="8"></td>  <td style="border-right: 1px solid #ddd;text-align: center;">Total</td><td style="padding: 10px;border-right: 1px solid #ddd;text-align: right;"><i class="fa fa-inr"></i>' . $sum . '</td>
              </tr>
            </tfoot>
          </table>
           <table width="100%" style="border-right:1px solid #ddd;border-left: 1px solid #ddd;border-bottom: 1px solid #ddd;">
            <tr>
              <td style="padding: 10px;">Amount Chargable (In Words)<br>
                <span style="font-weight: bold;">' . $this->convert2word($sum) . '</span>
              </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
           </table>
           <div class="row">
             <div class="col-md-6"></div>
             <div class="col-md-6">
               <table width="100%">
                 <tr>
                   <br><br><br><br><br><br>
                   <td><center>Authorised Signatory & Seal<center></td>
                 </tr>
               </table>
             </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
     </div>
      <!-- /.row -->
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

	public function get_old_bal($mem_id)
	{
		$this->db->select('');
		$this->db->from('tbl_member');
		$this->db->where('member_id',$mem_id);
		$query = $this->db->get();
		return $query->result();
	}

	function get_prodstk($prid)

	{

		$this->db->select('*');

		$this->db->from('tbl_product');

		$this->db->where('product_id',$prid);

		$query = $this->db->get();

		return $query->result();

	}

	public function get_current_productstock($item_id){
		$query=$this->db->select('routsale_sale_count')->where('routsale_product_id_fk',$item_id)->get('tbl_routsale');
		return $query->num_rows()>0 ? $query->row()->routsale_sale_count : 0;
	}


}
