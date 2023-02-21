<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Stock_report_model extends CI_Model{

	public function __construct()
    {
        parent::__construct();
    }
	//Supplier Wise Report


    public function getsaleWisestock1() 
    {
        $this->db->select('*,DATE_FORMAT(tbl_purchase.purchase_date,"%d/%m/%Y") as purchase_date,tbl_purchase.total_price as totals');
    	$this->db->from('tbl_purchase');
    	$this->db->join('tbl_product','product_id = product_id_fk');
        $this->db->join('tbl_vendor','vendor_id = vendor_id_fk');
        $this->db->where("product_status",1);
        $this->db->where("purchase_status",1);
		$this->db->order_by('tbl_purchase.purchase_date','DESC');
        $query = $this->db->get();
		return $query->result();
    }

    public function getsaleWisestock($vendor_id,$cdate) 
    {
        $this->db->select('*,DATE_FORMAT(tbl_purchase.purchase_date,"%d/%m/%Y") as purchase_date,tbl_purchase.total_price as totals');
    	$this->db->from('tbl_purchase');
    	$this->db->join('tbl_product','product_id = product_id_fk');
        $this->db->join('tbl_vendor','vendor_id = vendor_id_fk');
        $this->db->where("product_status",1);
        $this->db->where("purchase_status",1);
		$this->db->order_by('tbl_purchase.purchase_date','DESC');
        if(!empty($vendor_id)){
            $this->db->where('tbl_purchase.vendor_id_fk', $vendor_id); 
        }
		if(!empty($cdate)){
            $this->db->where('purchase_date <=', $cdate);
        }
        $query = $this->db->get();
		return $query->result();
    }
########################################################################################################################################################
	//Physical Stock Wise

    public function getphysicalStock($product_name,$product_id,$cdate,$edate)
    {
        $this->db->select('*,DATE_FORMAT(tbl_stock_history.stock_date,"%d/%m/%Y") as stock_date');
    	$this->db->from('tbl_stock_history');
		$this->db->join('tbl_product','product_id = stock_product_id_fk');
        $this->db->join('tbl_purchase','product_id = product_id_fk');
		$this->db->where("product_status",1);
        $this->db->where("stock_status",1);
        $this->db->order_by('tbl_product.product_id','DESC');
        if(!empty($product_name)){
            $this->db->where('tbl_product.product_name', $product_name); 
        }
       
		if(!empty($cdate)){
            $this->db->where('stock_date >=', $cdate);
        }
        if(!empty($edate)){
            $this->db->where('stock_date <=', $edate); 
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function getphysicalStock1()
    {
        $this->db->select('*,DATE_FORMAT(tbl_stock_history.stock_date,"%d/%m/%Y") as stock_date');
    	$this->db->from('tbl_stock_history');
		$this->db->join('tbl_product','product_id = stock_product_id_fk');
        $this->db->join('tbl_purchase','product_id = product_id_fk');
		$this->db->where("product_status",1);
        $this->db->where("stock_status",1);
        $this->db->order_by('tbl_product.product_name','ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function getitems_marmathews()

    {

		$this->db->select('*');

		$this->db->from('tbl_stock_history');
        $this->db->join('tbl_product','tbl_stock_history.stock_product_id_fk = tbl_product.product_id');
        $this->db->where('product_status',1);
        $this->db->where('stock_status',1);
        $this->db->group_by('product_name');
        $query = $this->db->get();
		return $query->result();

    }

}
