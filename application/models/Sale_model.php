<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sale_model extends CI_Model{

	public function __construct()
    {
        parent::__construct();
    }
	public function getSaleReport($param){
        $arOrder = array('','product_num');
        $product_num =(isset($param['product_num']))?$param['product_num']:'';
		//$shop =(isset($param['shop']))?$param['shop']:'';
		$start_date =(isset($param['start_date']))?$param['start_date']:'';
        $end_date =(isset($param['end_date']))?$param['end_date']:'';

        if($product_num){
            $this->db->like('tbl_sale.invoice_number', $product_num);
        }

		if($start_date){
            $this->db->where('sale_date >=', $start_date);
        }
        if($end_date){
            $this->db->where('sale_date <=', $end_date);
        }
		$this->db->where("sale_status",1);

        if ($param['start'] != 'false' and $param['length'] != 'false') {
            $this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*,COUNT(invoice_number) as slcount,SUM(sale_netamt) as total,sum(sale_quantity) as qty,DATE_FORMAT(sale_date,\'%d/%m/%Y\') as sale_dates,tbl_sale.discount_price as discount');

		//$this->db->select('*,tbl_member.*,COUNT(invoice_number) as slcount,SUM(total_price) as total,DATE_FORMAT(sale_date,\'%d/%m/%Y\') as sale_date');
		$this->db->from('tbl_sale');

		$this->db->join('tbl_member','tbl_member.member_id = tbl_sale.member_id_fk','left');
	//	$this->db->join('tbl_member_type','tbl_member_type.member_type_id = tbl_member.member_type','left');

		$this->db->group_by('invoice_number', 'DESC');
    $query = $this->db->get();

		$data['data'] = $query->result();
    $data['recordsTotal'] = $this->getSaleReportTotalCount($param);
    $data['recordsFiltered'] = $this->getSaleReportTotalCount($param);
    //return $this->db->last_query();
		return $data;

	}
	public function getSaleReportTotalCount($param){
        $product_num =(isset($param['product_num']))?$param['product_num']:'';
		//$shop =(isset($param['shop']))?$param['shop']:'';
		$start_date =(isset($param['start_date']))?$param['start_date']:'';
        $end_date =(isset($param['end_date']))?$param['end_date']:'';
		if($product_num){
           $this->db->like('tbl_sale.invoice_number', $product_num);
        }

		if($start_date){
            $this->db->where('sale_date >=', $start_date);
        }
        if($end_date){
            $this->db->where('sale_date <=', $end_date);
        }		$this->db->select('*,COUNT(invoice_number) as slcount,SUM(sale_netamt) as total,sum(sale_quantity) as qty,DATE_FORMAT(sale_date,\'%d/%m/%Y\') as sale_dates,tbl_sale.discount_price as discount');

			//	$this->db->select('*,tbl_member.*,COUNT(invoice_number) as slcount,SUM(total_price) as total,DATE_FORMAT(sale_date,\'%d/%m/%Y\') as sale_dates');
				$this->db->from('tbl_sale');

				$this->db->join('tbl_member','tbl_member.member_id = tbl_sale.member_id_fk','left');
				//$this->db->join('tbl_member_type','tbl_member_type.member_type_id = tbl_member.member_type','left');

				$this->db->group_by('invoice_number', 'DESC');

        $query = $this->db->get();
		return $query->num_rows();
	}

		function getproductname()
    {
		$this->db->select('item_id,item_name');
		$this->db->where("item_status",1);
		$query = $this->db->get('tbl_production_itemlist');
		$item_name = array();
		if($query->result()){
		foreach ($query->result() as $item_names) {
		$item_name[$item_names->item_id] = $item_names->item_name;

		}
		return $item_name;

		}
		else{
            return FALSE;
		}
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
	function getproductnum()
    {
        $this->db->select('*');
		$this->db->from('tbl_purchase');
		$this->db->where('purchase_status', 1);
		$this->db->join('tbl_product','tbl_product.product_id = tbl_purchase.product_id_fk');
		$query = $this->db->get();

		$product_num = array();
		if ($query -> result()) {
		foreach ($query->result() as $productnum) {
		$product_num[$productnum-> product_id] = $productnum -> product_num;
			}
		return $product_num;
		} else {
		return FALSE;
		}

    }
		function getproduct($product_cmpny,$product_size)
    {
		$this->db->select('product_id,product_name');
		$this->db->where("product_status",1);
		$this->db->where("product_cmpny",$product_cmpny);
		$this->db->where("product_size",$product_size);
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
	function getproductcompany($product_size)
    {
		$this->db->select('product_id,product_cmpny');
		$this->db->where("product_status",1);
		$this->db->where("product_size",$product_size);
		$this->db->group_by('product_cmpny', 'DESC');
		$query = $this->db->get('tbl_product');
		$product_name = array();
		if($query->result()){
		foreach ($query->result() as $product_names) {
		$product_name[$product_names->product_id] = $product_names->product_cmpny;

		}
		return $product_name;

		}
		else{
            return FALSE;
		}

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
			$this->db->where('item_id',$product_id);
			$this->db->where("item_status",1);
			$query = $this->db->get();
			//print_r($query->result());
			//exit();
			return $query->result();
		}

		public function getprice($product_id_fk)
	{
		$this->db->select('production_price');
		$this->db->from('tbl_production_details');
		$this->db->where('production_item_id_fk',$product_id_fk);
		$query = $this->db->get();
		return $query->row();
	}
	public function get_invc($invc_no)
	{
		$this->db->select('*,((sale_price-((sale_price*100)/(100+tbl_sale.taxamount)))/2)*sale_quantity as sgst, (tbl_sale.taxamount/2) as taxper,((sale_price*100)/(100+tbl_sale.taxamount)) as rate');
		$this->db->from('tbl_sale');
		$this->db->where('sale_status',1);
		$this->db->join('tbl_product','tbl_product.product_id = tbl_sale.product_id_fk','left');
		$this->db->join('tbl_member','tbl_member.member_id = tbl_sale.member_id_fk','left');
	//	$this->db->join('tbl_taxdetails','tbl_taxdetails.tax_id = tbl_sale.tax_id_fk','left');
		$this->db->where('tbl_sale.auto_invoice',$invc_no);
		$query = $this->db->get();
		return $query->result();
	}
	public function get_invoice($invoice_no)
	{
		$this->db->select('*,((sale_price-((sale_price*100)/(100+tbl_sale.taxamount)))/2)*sale_quantity as sgst, (tbl_sale.taxamount/2) as taxper,((sale_price*100)/(100+tbl_sale.taxamount)) as rate');
		$this->db->from('tbl_sale');
		$this->db->where('sale_status',1);
		$this->db->join('tbl_product','tbl_product.product_id = tbl_sale.product_id_fk','left');
		//$this->db->join('tbl_shop','tbl_shop.shpid = tbl_sale.shop_id_fk');
		//$this->db->join('tbl_customer','cust_id = tbl_sale.customer_name','left');
		$this->db->join('tbl_member','tbl_member.member_id = tbl_sale.member_id_fk','left');
		//$this->db->join('tbl_taxdetails','tbl_taxdetails.tax_id = tbl_sale.tax_id_fk');
		$this->db->where('tbl_sale.invoice_number',$invoice_no);
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
		$this->db->where('item_id',$item_id);
		$this->db->where('item_status',1);
		$query = $this->db->get();
		if($query){
			return $query->result();
		}
		else{
			return 0;
		}
	}
	function get_fyear()
	{
		$this->db->select('*');
		$this->db->from('tbl_finyear');
		$this->db->where('fin_status',1);
		$this->db->where('status',1);
		$query = $this->db->get();
		return $query->result();
	}
	function get_stk($prid)
	{
		$this->db->select('*');
		$this->db->from('tbl_production_details');
		$this->db->where('production_item_id_fk',$prid);
		$this->db->where("production_status",1);
		//$this->db->where('shop_id_fk',$shop_id);
		$query = $this->db->get();
		return $query->result();
	}
	public function get_purchasedetails($product_num,$product_size)
	{
		$this->db->select('purchase_price,landing_cost');
		$this->db->from('tbl_purchase');
		$this->db->where('product_id_fk',$product_num);
		$this->db->join('tbl_product','tbl_product.product_id = tbl_purchase.product_id_fk');
		$this->db->where('product_size',$product_size);
		//$this->db->where('purchase_status', 1);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_purchasedetails2($product_num)
	{
		$this->db->select('*,SUM()');
		$this->db->from('tbl_product');
		$this->db->where('product_id',$product_num);
		//$this->db->join('(SELECT SUM(COALESCE(purchase_price,0))) AS purchase_price  FROM tbl_purchase GROUP BY product_id_fk) AS tbl_purchase','tbl_purchase.product_id_fk = tbl_product.product_id');
		$this->db->join('tbl_purchase','tbl_purchase.product_id_fk=tbl_product.product_id');
		//$this->db->where('purchase_status', 1);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_stok($prid,$shop_id)
	{
		$this->db->select('item_quantity');
		$this->db->from('tbl_production_itemlist');
		$this->db->where('item_id',$prid);
		$this->db->where("item_status",1);
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
		$this->db->where('shop_id_fk',$user);
    	$this->db->order_by('invoice_number',"DESC");
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->row();
	}

	public function view_by()
	{
		$status=1;
		$this->db->select('*');
		$this->db->from('tbl_taxdetails');
		$this->db->where('tax_status', $status);
		$query = $this->db->get();

		$tax_amounts = array();
		if ($query -> result()) {
		foreach ($query->result() as $tax_amount) {
		$tax_names[$tax_amount-> tax_id] = $tax_amount -> taxamount;
		}
		return $tax_names;
		} else {
			return FALSE;
			}
	}

	function getproductnames()
    {
		$this->db->select('item_id,item_name');
		$this->db->where("item_status",1);
		//$this->db->where("production_status",1);
		//$this->db->join("tbl_production_details",'item_id=production_item_id_fk','left');
		$query = $this->db->get('tbl_production_itemlist');
		$product_name = array();
		if($query->result()){
		foreach ($query->result() as $product_names) {
		$product_name[$product_names->item_id] = $product_names->item_name;

		}
		return $product_name;

		}
		else{
            return FALSE;
		}
    }


	public function get_members(){

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
		$this->db->where("item_status",1);
		//$this->db->where("production_status",1);
		$this->db->where("item_id",$p_id);
		$this->db->where("item_status",1);
		$query = $this->db->get('tbl_production_itemlist');
		return $query->result();

    }

    	public function get_memberaddress($id){

 //  $query = $this->db->select('custphone,custaddress')->from('tbl_customer')->where('cust_id',$id)->get();
   // return $query->result();

    	$this->db->select('member_address');
		$this->db->from('tbl_member');
		$this->db->where('member_id',$id);
		$query = $this->db->get();
		return $query->result();


	}

	public function get_phone($id){

 //  $query = $this->db->select('custphone,custaddress')->from('tbl_customer')->where('cust_id',$id)->get();
   // return $query->result();

    $this->db->select('member_pnumber');
		$this->db->from('tbl_member');
		$this->db->where('member_id',$id);
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
		$this->db->join('tbl_mem_account','tbl_mem_account.mem_acc_id_fk=tbl_member.member_id');
		$this->db->where('member_id',$id);
		$query = $this->db->get();
		return $query->result();
	}

	public function getMemberlists($mem_id)
	{
		$this->db->select('member_id,member_name');
		$this->db->from('tbl_member');
		$this->db->where('member_type',$mem_id);
		$query = $this->db->get();
		return $query->result();
	}
################JISHNU#########################
	public function get_table($table){
		$query=$this->db->select('*')->get($table);
		return $query->num_rows()>0 ? $query->result() : false;
	}

	##############################################

	public function get_admno()
	{
		$this->db->select('*');
		$this->db->from('tbl_sale');
		$this->db->where('sale_status', 1);
		$this->db->order_by('sale_id',"DESC");
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->row();
	}

	public function getproduct_names($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_product');
		$this->db->where("product_status", 1);
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

        $this->db->select('*');
        $this->db->from('tbl_product');
		$this->db->join('tbl_hsncode','hsncode=product_hsncode','left');
        $this->db->where('product_status',1);
        $this->db->where('product_name',$p_name);
        $q = $this->db->get();

        if($q->num_rows() > 0)

        {

            return $q->row();

        }

        return false;

    }
	public function get_row_barcode1($pid)

    {

        $this->db->select('*');
        $this->db->from('tbl_product');
		$this->db->join('tbl_hsncode','hsncode=product_hsncode','left');
        $this->db->where('product_status',1);
        $this->db->where('product_id',$pid);
        $q = $this->db->get();

        if($q->num_rows() > 0)

        {

            return $q->row();

        }

        return false;

    }

	public function get_row_rate($pid)

    {

        $this->db->select('*');
        $this->db->from('tbl_product');
        $this->db->where('product_status',1);
        $this->db->where('product_id',$pid);
        $q = $this->db->get();

        if($q->num_rows() > 0)

        {

            return $q->row();

        }

        return false;

    }
}
?>
