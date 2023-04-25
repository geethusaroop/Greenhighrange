<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Sale_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}
	public function getSaleReport($param,$branch_id_fk)
	{
		$arOrder = array('', 'product_num');
		$product_num = (isset($param['product_num'])) ? $param['product_num'] : '';
		//$shop =(isset($param['shop']))?$param['shop']:'';
		$start_date = (isset($param['start_date'])) ? $param['start_date'] : '';
		$end_date = (isset($param['end_date'])) ? $param['end_date'] : '';

		if ($product_num) {
			//$this->db->like('tbl_sale.invoice_number', $product_num);

			//$where1= '(tbl_sale.invoice_number="'.$product_num.'" or member_name = "'.$product_num.'")';
			//	$this->db->where($where1);
			$this->db->like('tbl_sale.invoice_number', $product_num);
			$this->db->or_like('member_name', $product_num);
		}

		if ($start_date && $end_date) {
			$this->db->where('sale_date >=', $start_date);
			$this->db->where('sale_date <=', $end_date);
		}
		if ($end_date) {
			$this->db->where('sale_date <=', $end_date);
		}
		if(!empty($branch_id_fk) && $branch_id_fk != 0)
        {
            $this->db->where("sale_branch_id_fk",$branch_id_fk);
        }
        else
        {
            $this->db->where("sale_branch_id_fk",0);
        }
		$this->db->where("sale_status", 1);
		$this->db->where("routsale_status", 0);

		if ($param['start'] != 'false' and $param['length'] != 'false') {
			$this->db->limit($param['length'], $param['start']);
		}
		$this->db->select('*,COUNT(invoice_number) as slcount,ROUND(SUM(sale_netamt),2) as total,sum(sale_quantity) as qty,ROUND((total_price-(sale_discount+sale_shareholder_discount)),2) as tprice,DATE_FORMAT(sale_date,\'%d/%m/%Y\') as sale_dates,tbl_sale.sale_discount as discount');

		//$this->db->select('*,tbl_member.*,COUNT(invoice_number) as slcount,SUM(total_price) as total,DATE_FORMAT(sale_date,\'%d/%m/%Y\') as sale_date');
		$this->db->from('tbl_sale');

		$this->db->join('tbl_member', 'tbl_member.member_id = tbl_sale.member_id_fk', 'left');
		//	$this->db->join('tbl_member_type','tbl_member_type.member_type_id = tbl_member.member_type','left');

		$this->db->group_by('invoice_number');
		$this->db->order_by('sale_date', 'ASC');
		$query = $this->db->get();

		$data['data'] = $query->result();
		$data['recordsTotal'] = $this->getSaleReportTotalCount($param,$branch_id_fk);
		$data['recordsFiltered'] = $this->getSaleReportTotalCount($param,$branch_id_fk);
		//return $this->db->last_query();
		return $data;
	}
	public function getSaleReportTotalCount($param,$branch_id_fk)
	{
		$product_num = (isset($param['product_num'])) ? $param['product_num'] : '';
		//$shop =(isset($param['shop']))?$param['shop']:'';
		$start_date = (isset($param['start_date'])) ? $param['start_date'] : '';
		$end_date = (isset($param['end_date'])) ? $param['end_date'] : '';
		if ($product_num) {
			//$this->db->like('tbl_sale.invoice_number', $product_num);

			//$where1= '(tbl_sale.invoice_number="'.$product_num.'" or member_name = "'.$product_num.'")';
			//	$this->db->where($where1);
			$this->db->like('tbl_sale.invoice_number', $product_num);
			$this->db->or_like('member_name', $product_num);
		}

		if ($start_date) {
			$this->db->where('sale_date >=', $start_date);
		}
		if ($end_date) {
			$this->db->where('sale_date <=', $end_date);
		}
		if(!empty($branch_id_fk) && $branch_id_fk != 0)
        {
            $this->db->where("sale_branch_id_fk",$branch_id_fk);
        }
        else
        {
            $this->db->where("sale_branch_id_fk",0);
        }
		$this->db->select('*,COUNT(invoice_number) as slcount,SUM(sale_netamt) as total,sum(sale_quantity) as qty,DATE_FORMAT(sale_date,\'%d/%m/%Y\') as sale_dates,tbl_sale.discount_price as discount');

		//	$this->db->select('*,tbl_member.*,COUNT(invoice_number) as slcount,SUM(total_price) as total,DATE_FORMAT(sale_date,\'%d/%m/%Y\') as sale_dates');
		$this->db->from('tbl_sale');

		$this->db->join('tbl_member', 'tbl_member.member_id = tbl_sale.member_id_fk', 'left');
		//$this->db->join('tbl_member_type','tbl_member_type.member_type_id = tbl_member.member_type','left');
		$this->db->where("sale_status", 1);
		$this->db->where("routsale_status",0);
		$this->db->order_by('sale_date', 'ASC');
		$this->db->group_by('invoice_number');

		$query = $this->db->get();
		return $query->num_rows();
	}


	/* public function getmessage($param,$branch_id_fk)
	{
		$arOrder = array('', 'product_num');
	
		if ($param['start'] != 'false' and $param['length'] != 'false') {
			$this->db->limit($param['length'], $param['start']);
		}
		$this->db->select('*,DATE_FORMAT(msg_date,\'%d/%m/%Y\') as msg_date');

		$this->db->from('tbl_message');
		$this->db->where("msg_status", 1);
		$this->db->order_by('msg_date', 'ASC');
		$query = $this->db->get();

		$data['data'] = $query->result();
		$data['recordsTotal'] = $this->getgetmessageTotalCount($param,$branch_id_fk);
		$data['recordsFiltered'] = $this->getgetmessageTotalCount($param,$branch_id_fk);
		//return $this->db->last_query();
		return $data;
	}
	public function getgetmessageTotalCount($param,$branch_id_fk)
	{
		$this->db->from('tbl_message');
		$this->db->where("msg_status", 1);
		$this->db->order_by('msg_date', 'ASC');

		$query = $this->db->get();
		return $query->num_rows();
	} */

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
	// public function get_price($product_id)
	// {
	// 	$this->db->select('price');
	// 	$this->db->from('tbl_production');
	// 	$this->db->where('product_id_fk',$product_id);
	// 	$query = $this->db->get();
	// 	print_r($query->result());
	// 	exit();
	// 	return $query->result();
	// }


	// public function get_price($product_id)
	// {
	// 	$this->db->select('production_price');
	// 	$this->db->from('tbl_production_details');
	// 	$this->db->where('production_item_id_fk',$product_id);
	// 	$this->db->where("production_status",1);
	// 	$query = $this->db->get();
	// 	//print_r($query->result());
	// 	//exit();
	// 	return $query->result();
	// }

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
		//$this->db->join('tbl_shop','tbl_shop.shpid = tbl_sale.shop_id_fk');
		//$this->db->join('tbl_customer','cust_id = tbl_sale.customer_name','left');
		$this->db->join('tbl_member', 'tbl_member.member_id = tbl_sale.member_id_fk', 'left');
		//$this->db->join('tbl_taxdetails','tbl_taxdetails.tax_id = tbl_sale.tax_id_fk');
		$this->db->where('tbl_sale.invoice_number', $invoice_no);
		$query = $this->db->get();
		return $query->result();
	}
	// function get_shop($sessid)
	// {
	// 	$this->db->select('*');
	// 	$this->db->from('tbl_user');
	// 	$this->db->where('log_id_fk',$sessid);
	// 	$this->db->where('status',1);
	// 	$query = $this->db->get();
	// 	return $query->result();
	// }

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
	// public function get_stok($prid,$shop_id)
	// {
	// 	$this->db->select('current_stock');
	// 	$this->db->from('tbl_stock');
	// 	$this->db->where('product_id_fk',$prid);
	// 	$this->db->where('shop_id_fk',$shop_id);
	// 	$query = $this->db->get();
	// 	return $query->result();
	// }

	// public function get_stok($prid,$shop_id)
	// {
	// 	$this->db->select('production_quantity');
	// 	$this->db->from('tbl_production_details');
	// 	$this->db->where('production_item_id_fk',$prid);
	// 	$this->db->where("production_status",1);
	// 	//$this->db->where('shop_id_fk',$shop_id);
	// 	$query = $this->db->get();
	// 	return $query->result();
	// }

	// function get_pstk($prid)
	// {
	// 	$this->db->select('*');
	// 	$this->db->from('tbl_production_details');
	// 	$this->db->where('product_item_id_fk',$prid);
	// 	$query = $this->db->get();
	// 	return $query->result();
	// }

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


	// public function get_memberaddress($id){

	//   $query = $this->db->select('custaddress,custphone')->from('tbl_customer')->where('cust_id',$id)->get();
	//    return $query->result();

	// }

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

		//  $query = $this->db->select('custphone,custaddress')->from('tbl_customer')->where('cust_id',$id)->get();
		// return $query->result();

		$this->db->select('member_address');
		$this->db->from('tbl_member');
		$this->db->where('member_id', $id);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_phone($id)
	{

		//  $query = $this->db->select('custphone,custaddress')->from('tbl_customer')->where('cust_id',$id)->get();
		// return $query->result();

		$this->db->select('member_pnumber');
		$this->db->from('tbl_member');
		$this->db->where('member_id', $id);
		$query = $this->db->get();
		return $query->result();
	}

	public function getOldBalanceDetails($id)
	{
		// $this->db->select('tbl_cust_acc.cust_acc_old_bal AS old_balance');
		// $this->db->from('tbl_customer');
		// $this->db->join('tbl_cust_acc','tbl_cust_acc.cust_acc_fk_id=tbl_customer.cust_id');
		// $this->db->where('cust_id',$id);
		// $query = $this->db->get();
		// return $query->result();

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

	public function getproduct_names($id,$branch_id_fk)
	{
		$response=[];
		$this->db->select('*');
		$this->db->from('tbl_product');
		$this->db->where("product_status", 1);
		$this->db->like("product_name", $id);
		$this->db->where("branch_id_fk",0);
		/* if(!empty($branch_id_fk) && $branch_id_fk != 0)
        {
            $this->db->where("branch_id_fk",$branch_id_fk);
        }
        else
        {
            $this->db->where("branch_id_fk",0);
        } */
		$this->db->group_by("product_name");
		$records = $this->db->get()->result();
		foreach ($records as $row) {
			$response[] = array("name" => $row->product_name);
		}
		return $response;
	}


	public function get_row_code($p_name)
	{

		$this->db->select('*');
		$this->db->from('tbl_product');
		$this->db->join('tbl_hsncode','hsncode=product_hsncode','left');
		$this->db->where('product_status', 1);
		$this->db->where('product_code', $p_name);
		$this->db->where('branch_id_fk', 0);
		$q = $this->db->get();

		if ($q->num_rows() > 0) {

			return $q->row();
		}

		return false;
	}

	public function get_row_barcode($p_name)
	{

		$this->db->select('*');
		$this->db->from('tbl_product');
		$this->db->join('tbl_hsncode','hsncode=product_hsncode','left');
		$this->db->where('product_status', 1);
		$this->db->where('product_name', $p_name);
		$this->db->where('branch_id_fk', 0);
		$q = $this->db->get();

		if ($q->num_rows() > 0) {

			return $q->row();
		}

		return false;
	}

	public function get_row_barcode_branch($p_name,$branches_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_product');
		$this->db->join('tbl_hsncode', 'hsncode=product_hsncode','left');
		$this->db->where('product_status', 1);
		$this->db->where('product_name', $p_name);
		$this->db->where('branch_id_fk', $branches_id);
		$q = $this->db->get();

		if ($q->num_rows() > 0) {

			return $q->row();
		}

		return 0;
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
          <center>
            <h4><b>GREENHIGHRANGE FARMERS PRODUCER COMPANY LIMITED</b></h4>
			<br><span style="font-weight: bold;font-size: 16px;">[FPO Established under Govt of India scheme by NABARD and Peermade Development Society]</span>
			<br><span style="font-weight: bold;font-size: 16px;">Green Highrange Farmer Producer Company Ltd,Building No, 106/14,Vakachuvadu, Prabhacity,Kanjikuzhy,Idukki, Kerala - 685606</span>
			<br><span style="font-weight:bold;font-size: 16px;"> Ph:+91 7907753352, Email:greenhighrangeidk@gmail.com
				<br></span>
			<span style="font-weight: bold;font-size: 16px;">GSTIN:32BWUPG1355F1ZM</span><br>
			<span style="font-weight: bold;font-size: 16px;">CIN:U01100KL2021PTC071331</span>
         
      </div>
    </div>
<hr>
	<div class="row invoice-info">
                    <div class="col-lg-12">
					<table class="" width="100%" cellpadding="2" cellspacing="0">
					<tr>
					<td style="padding :2px;font-size: 14px;"><strong>Name</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>:</b>&nbsp;&nbsp;<span style="color:black;font-style: "Times New Roman", Times, serif;">
					' . $array[0]->member_name . '
					</td>
					<td style="padding :2px;"><b style="color:black"></b></td>

					<td style="padding :2px;"><b style="color:black"></b></td>
					<td style="padding :2px;"><b style="color:black"></b></td>

					<td style="padding :2px;"><b style="color:black"></b></td>
					<td style="padding :2px;"><b style="color:black"></b></td>

					<td style="padding :2px;"><b style="color:black"></b></td>
					<td style="padding :2px;"><b style="color:black"></b></td>

					<td style="padding :2px;font-size: 14px;"><strong>Date</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>:</b>&nbsp;&nbsp;<span style="color:black;font-style: "Times New Roman", Times, serif;">
					' . $date . '
					</td>
					</tr>

					<tr>
					<td style="padding :2px;font-size: 14px;"><strong>Address</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>:</b>&nbsp;&nbsp;<span style="color:black;font-style: "Times New Roman", Times, serif;">
					' . $array[0]->member_address . '
					</td>
					<td style="padding :2px;"><b style="color:black"></b></td>

					<td style="padding :2px;"><b style="color:black"></b></td>
					<td style="padding :2px;"><b style="color:black"></b></td>

					<td style="padding :2px;"><b style="color:black"></b></td>
					<td style="padding :2px;"><b style="color:black"></b></td>

					<td style="padding :2px;"><b style="color:black"></b></td>
					<td style="padding :2px;"><b style="color:black"></b></td>

					<td style="padding :2px;font-size: 14px;"><strong>Bill No</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>:</b>&nbsp;&nbsp;<span style="color:black;font-style: "Times New Roman", Times, serif;">
					' . $array[0]->invoice_number  . '
					</td>
					</tr>

					</div>

	<br>
	<div class="col-lg-12">
          <table width="100%" style="border-right:1px solid #ddd;border-left: 1px solid #ddd;">
            <thead>
           <tr style="border:ridge;">
              <th style="text-align: left;padding :2px;border:ridge;text-transform:uppercase;font-size: 14px;">S.No.</th>
              <th style="text-align: left;padding :2px;border:ridge;text-transform:uppercase;font-size: 14px;">Description of Goods</th>
			  <th style="text-align: right;padding :2px;border:ridge;text-transform:uppercase;font-size: 14px;">QTY</th>
			  <th style="text-align: right;padding :2px;border:ridge;text-transform:uppercase;font-size: 14px;">RATE</th>
			  <th style="text-align: right;padding :2px;border:ridge;text-transform:uppercase;font-size: 14px;">Discount(%)</th>
			  <th style="text-align: right;padding :2px;border:ridge;text-transform:uppercase;font-size: 14px;">Taxable_Amount</th>
			  <th style="text-align: right;padding :2px;border:ridge;text-transform:uppercase;font-size: 14px;">GST%</th>
			  <th style="text-align: right;padding :2px;border:ridge;text-transform:uppercase;font-size: 14px;">TaxAmt</th>
			  <th style="text-align: right;padding :2px;border:ridge;text-transform:uppercase;font-size: 14px;">TOTAL</th>
          </tr>
            </thead>
            <tbody>
              <tr style="border:ridge;"></tr>';
		$sum = 0;
		$quantity_sum = 0;
		$dis = 0;
		$j = 1;
		for ($i = 0; $i < count($array); $i++) {
			$output .= '	
            <tr>
              <td style="border:ridge;padding: 10px;">' . $j . '</td>
              <td style="border:ridge;padding:2px;font-weight: bold;">' . strtoupper($array[$i]->product_name) . '</td>
              <td style="border:ridge;padding:2px;font-weight: bold;text-align: right;">' . strtoupper($array[$i]->sale_quantity) . '</td>
              <td style="border:ridge;padding:2px;text-align: right;">' . $array[$i]->sale_price . '</td>
              <td style="border:ridge;padding:2px;text-align: right;">' . $array[$i]->discount_price . '</td>
              <td style="border:ridge;padding:2px;text-align: right;">' . $array[$i]->taxamount . '</td>
              <td style="border:ridge;padding:2px;text-align: right;">' . $array[$i]->sale_igst . '</td>
              <td style="border:ridge;padding:2px;text-align: right;">' . $array[$i]->sale_igstamt . '%</td>
              <td style="padding: 10px;border:ridge;text-align: right;">' . $array[$i]->sale_netamt . '</td>
            </tr>';
			$j++;
		//	$sum += $array[$i]->total_price;

			$sum = $sum + ($array[$i]->sale_price * $array[$i]->sale_quantity);
                                $dis = $dis + $array[$i]->discount_price;
                                $v = $sum - $dis;
                                $quantity_sum = $quantity_sum + $array[$i]->sale_quantity;
		}
		$output .= '
         
            </tbody>
			<tr style="font-weight: bold;">
			<td style="padding :2px;text-align: left;border:ridge;font-size: 14px;"></td>
			<td style="padding :2px;text-align: left;border:ridge;font-size: 14px;">Total</td>
			<td style="text-align: right;padding :2px;border:ridge;font-size: 14px;">'. $quantity_sum.'</td>
			<td style="text-align: right;padding :2px;border:ridge;font-size: 14px;"></td>
			<td style="text-align: right;padding :2px;border:ridge;font-size: 14px;"></td>
			<td style="text-align: right;padding :2px;border:ridge;font-size: 14px;"></td>
			<td style="text-align: right;padding :2px;border:ridge;font-size: 14px;"></td>
			<td style="text-align: right;padding :2px;border:ridge;font-size: 14px;"></td>
			<td style="text-align: right;padding :2px;border:ridge;font-size: 14px;">'.$array[0]->total_price.'</td>
		</tr>
          </table>
           <table width="100%" style="border-right:1px solid #ddd;border-left: 1px solid #ddd;border-bottom: 1px solid #ddd;">
            <tr>
              <td style="padding: 10px;">Amount Chargable (In Words)<br>
                <span style="font-weight: bold;">' . $this->convert2word($array[0]->sale_net_total) . '</span>
              </td>
			  <td style="padding :2px;"></td>
			  <td style="padding :2px;"></td>
			  <td style="padding :2px;"></td>
			  <td style="padding :2px;"></td>
			  <td style="text-align: right;padding :2px;font-weight:bold;font-size: 14px;">Total Amount</td>
			  <td style="text-align: right;padding :2px;font-weight:bold;font-size: 14px;"><i class="fa fa-inr"></i> '.$array[0]->total_price.'</td>

          </tr>';
		  $net=($array[0]->total_price) - ($array[0]->sale_discount + $array[0]->sale_shareholder_discount);
		  if ($array[0]->member_type == 1) {
			$output .= '<tr>
			<td style="padding :2px;"></td>
			<td style="padding :2px;"></td>
			<td style="padding :2px;"></td>
			<td style="padding :2px;"></td>
			<td style="padding :2px;"></td>
			<td style="text-align: right;padding :2px;font-weight:bold;font-size: 14px;">Share Holder Discount Amount</td>
			<td style="text-align: right;padding :2px;font-weight:bold;font-size: 14px;"><i class="fa fa-inr"></i>'.$array[0]->sale_shareholder_discount_amount.'</td>
		</tr>';
		  }
		  
			$output .= ' 
			   <tr>
			<td style="padding :2px;"></td>
			<td style="padding :2px;"></td>
			<td style="padding :2px;"></td>
			<td style="padding :2px;"></td>
			<td style="padding :2px;"></td>
			<td style="text-align: right;padding :2px;font-weight:bold;font-size: 14px;">Discount Amount</td>
			<td style="text-align: right;padding :2px;font-weight:bold;font-size: 14px;"><i class="fa fa-inr"></i>'.$array[0]->sale_discount.'</td>
		</tr>

		<tr>
			<td style="padding :2px;"></td>
			<td style="padding :2px;"></td>
			<td style="padding :2px;"></td>
			<td style="padding :2px;"></td>
			<td style="padding :2px;"></td>
			<td style="text-align: right;padding :2px;font-weight:bold;font-size: 14px;">Net Amount</td>
			<td style="text-align: right;padding :2px;font-weight:bold;font-size: 14px;"><i class="fa fa-inr"></i>'.$array[0]->sale_net_total.'</td>
		</tr>
		<tr>
		<td style="padding :2px;border-bottom: ridge;"></td>
		<td style="padding :2px;border-bottom: ridge;"></td>
		<td style="padding :2px;border-bottom: ridge;"></td>
		<td style="padding :2px;border-bottom: ridge;"></td>
		<td style="padding :2px;border-bottom: ridge;"></td>
		<td style="text-align: right;padding :2px;border-bottom: ridge;font-weight:bold;font-size: 14px;">Received Amount</td>
		<td style="text-align: right;padding :2px;border-bottom: ridge;font-weight:bold;font-size: 14px;"><i class="fa fa-inr"></i>'. $array[0]->sale_paid_amount.'</td>
	</tr>

	<tr>
		<td style="padding :2px;"></td>
		<td style="padding :2px;"></td>
		<td style="padding :2px;"></td>
		<td style="padding :2px;"></td>
		<td style="padding :2px;"></td>
		<td style="padding :2px;"></td>
		<td style="padding :2px;"></td>
	</tr>

	<tr>
		<td style="padding: 2px;border:none;font-weight:bold;font-size: 14px;">Declaration<br>
			<p style="font-weight: bold;font-size: 14px;">We declare that this invoice shows the actual price of the goods<br> described and that all particulars are true and correct.</p>

		</td>
		<td style="padding: 2px;border:none;font-weight: bold;"></td>
		<td style="padding: 2px;border:none;"></td>
		<td style="padding: 2px;border:none;font-weight: bold;"></td>
		<td style="padding: 2px;border:none;"></td>
		<td style="padding :2px;"></td>
		<td style="padding: 2px;border:none;"><span style="float:right;font-weight: bold;font-size: 14px;">Authorised Signatory & Seal</span></td>

	</tr>
               </table>
             </div>
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

	public function getSaleReturnReport($param,$branch_id_fk){
        $arOrder = array('','invoice_number','shop');
        $invoice_number =(isset($param['invoice_number']))?$param['invoice_number']:'';
        $startDate =(isset($param['startDate']))?$param['startDate']:'';
        $endDate =(isset($param['endDate']))?$param['endDate']:'';
		if ($invoice_number) {
			//$this->db->like('tbl_sale.invoice_number', $product_num);

			//$where1= '(tbl_sale.invoice_number="'.$invoice_number.'" or member_name = "'.$invoice_number.'")';
			//	$this->db->where($where1);
			$this->db->like('tbl_sale.invoice_number', $invoice_number);
			$this->db->or_like('member_name', $invoice_number);
		}
        if($startDate){
            $this->db->where('return_date >=', $startDate); 
        }
        if($endDate){
            $this->db->where('return_date <=', $endDate); 
        }

		if(!empty($branch_id_fk) && $branch_id_fk != 0)
        {
            $this->db->where("sale_branch_id_fk",$branch_id_fk);
        }
        else
        {
            $this->db->where("sale_branch_id_fk",0);
        }
		$this->db->where("sale_status",1);
		
        if ($param['start'] != 'false' and $param['length'] != 'false') {
            $this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*,DATE_FORMAT(return_date,\'%d/%m/%Y\') as return_date,DATE_FORMAT(sale_date,\'%d/%m/%Y\') as sale_dates,sum(return_qty) as return_qty,sum(return_price) as return_price,ROUND(SUM(sale_netamt),2) as total,sum(sale_quantity) as qty,tbl_sale.sale_discount as discount');
		$this->db->from('tbl_sale');
		$this->db->join('tbl_product','product_id = product_id_fk','left');
		$this->db->join('tbl_member','member_id = member_id_fk');
        $this->db->group_by('invoice_number');
		$this->db->order_by('sale_date','ASC');
        $query = $this->db->get();
        
		$data['data'] = $query->result();
        $data['recordsTotal'] = $this->getSaleReportReturnTotalCount($param,$branch_id_fk);
        $data['recordsFiltered'] = $this->getSaleReportReturnTotalCount($param,$branch_id_fk);
        return $data;
	}
	public function getSaleReportReturnTotalCount($param,$branch_id_fk){
        $invoice_number =(isset($param['invoice_number']))?$param['invoice_number']:'';
        $startDate =(isset($param['startDate']))?$param['startDate']:'';
        $endDate =(isset($param['endDate']))?$param['endDate']:'';
		if ($invoice_number) {
			//$this->db->like('tbl_sale.invoice_number', $product_num);

		//	$where1= '(tbl_sale.invoice_number="'.$invoice_number.'" or member_name = "'.$invoice_number.'")';
			//	$this->db->where($where1);
			$this->db->like('tbl_sale.invoice_number', $invoice_number);
			$this->db->or_like('member_name', $invoice_number);
		}
        if($startDate){
            $this->db->where('return_date >=', $startDate); 
        }
        if($endDate){
            $this->db->where('return_date <=', $endDate); 
        }
		if(!empty($branch_id_fk) && $branch_id_fk != 0)
        {
            $this->db->where("sale_branch_id_fk",$branch_id_fk);
        }
        else
        {
            $this->db->where("sale_branch_id_fk",0);
        }
		$this->db->where("sale_status",1);
		$this->db->select('*,DATE_FORMAT(return_date,\'%d/%m/%Y\') as return_date,DATE_FORMAT(sale_date,\'%d/%m/%Y\') as sale_dates');
		$this->db->from('tbl_sale');
		$this->db->join('tbl_product','product_id = product_id_fk','left');
		$this->db->join('tbl_member','member_id = member_id_fk');
		$this->db->order_by('sale_date', 'ASC');
        $this->db->group_by('invoice_number');
        $query = $this->db->get();
		return $query->num_rows();
	}

	public function getEditData($auto_invoice)
	{
		$this->db->select('*');
		$this->db->from('tbl_sale');
		$this->db->join('tbl_product','product_id = product_id_fk','left');
		$this->db->join('tbl_member','member_id = member_id_fk');
		$this->db->where('sale_status', 1);
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

	public function getSaleReturnDetails($param,$branch_id_fk)
	{
		$arOrder = array('', 'product_num');
		$product_num = (isset($param['product_num'])) ? $param['product_num'] : '';
		$start_date = (isset($param['start_date'])) ? $param['start_date'] : '';
		$end_date = (isset($param['end_date'])) ? $param['end_date'] : '';

		if ($product_num) {
			
			$this->db->like('tbl_sale_return.sreturn_invoice_number', $product_num);
			$this->db->or_like('member_name', $product_num);
		}

		if ($start_date && $end_date) {
			$this->db->where('sreturn_date >=', $start_date);
			$this->db->where('sreturn_date <=', $end_date);
		}
		if ($end_date) {
			$this->db->where('sreturn_date <=', $end_date);
		}
		
		$this->db->where("sreturn_status", 1);

		if ($param['start'] != 'false' and $param['length'] != 'false') {
			$this->db->limit($param['length'], $param['start']);
		}
		$this->db->select('*,COUNT(sreturn_invoice_number) as slcount,ROUND(SUM(sreturn_netamt),2) as total,,ROUND(SUM(sreturn_taxamount),2) as taxamount,ROUND(SUM(sreturn_igstamt),2) as igstamt,sum(sreturn_qty) as qty,DATE_FORMAT(sreturn_date,\'%d/%m/%Y\') as sreturn_dates');

		$this->db->from('tbl_sale_return');
		$this->db->join('tbl_member', 'tbl_member.member_id = tbl_sale_return.sreturn_member_id_fk', 'left');
		$this->db->group_by('sreturn_invoice_number');
		$this->db->order_by('sreturn_date', 'ASC');
		$query = $this->db->get();

		$data['data'] = $query->result();
		$data['recordsTotal'] = $this->getSaleReturnDetailsTotalCount($param,$branch_id_fk);
		$data['recordsFiltered'] = $this->getSaleReturnDetailsTotalCount($param,$branch_id_fk);
		//return $this->db->last_query();
		return $data;
	}
	public function getSaleReturnDetailsTotalCount($param,$branch_id_fk)
	{
		$product_num = (isset($param['product_num'])) ? $param['product_num'] : '';
		//$shop =(isset($param['shop']))?$param['shop']:'';
		$start_date = (isset($param['start_date'])) ? $param['start_date'] : '';
		$end_date = (isset($param['end_date'])) ? $param['end_date'] : '';
		if ($product_num) {
			
			$this->db->like('tbl_sale_return.sreturn_invoice_number', $product_num);
			$this->db->or_like('member_name', $product_num);
		}

		if ($start_date) {
			$this->db->where('sreturn_date >=', $start_date);
		}
		if ($end_date) {
			$this->db->where('sreturn_date <=', $end_date);
		}
		
		$this->db->select('*');

		//	$this->db->select('*,tbl_member.*,COUNT(sreturn_invoice_number) as slcount,SUM(total_price) as total,DATE_FORMAT(sreturn_date,\'%d/%m/%Y\') as sreturn_dates');
		$this->db->from('tbl_sale_return');

		$this->db->join('tbl_member', 'tbl_member.member_id = tbl_sale_return.sreturn_member_id_fk', 'left');
		//$this->db->join('tbl_member_type','tbl_member_type.member_type_id = tbl_member.member_type','left');
		$this->db->where("sreturn_status", 1);
		$this->db->order_by('sreturn_date', 'ASC');
		$this->db->group_by('sreturn_invoice_number');

		$query = $this->db->get();
		return $query->num_rows();
	}

	public function get_return_invc($invc_no)
	{
		$this->db->select('*');
		$this->db->from('tbl_sale_return');
		$this->db->where('sreturn_status', 1);
		$this->db->join('tbl_product', 'tbl_product.product_id = tbl_sale_return.sreturn_product_id_fk', 'left');
		$this->db->join('tbl_member', 'tbl_member.member_id = tbl_sale_return.sreturn_member_id_fk', 'left');
		$this->db->join('tbl_sale', 'sale_id = tbl_sale_return.sreturn_sale_id_fk', 'left');
		$this->db->group_by('product_id');
		$this->db->where('tbl_sale_return.sreturn_invoice_number', $invc_no);
		$query = $this->db->get();
		return $query->result();
	}

}
