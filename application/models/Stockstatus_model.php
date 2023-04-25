<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Stockstatus_model extends CI_Model{
	public function __construct()
    {
        parent::__construct();
    }
	public function getStock($param,$branch_id_fk){
        $searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('product_name', $searchValue);
        }
		$this->db->select('*');
    	$this->db->from('tbl_product');
        $this->db->where("product_status",1);
        if(!empty($branch_id_fk) && $branch_id_fk != 0)
        {
            $this->db->where("branch_id_fk",$branch_id_fk);
        }
        else
        {
            $this->db->where("branch_id_fk",0);
        }
        $query = $this->db->get();
		$data['data'] = $query->result();
        $data['recordsTotal'] = $this->getStockTotalCount($param,$branch_id_fk);
        $data['recordsFiltered'] = $this->getStockTotalCount($param,$branch_id_fk);
        return $data;
	}
	public function getStockTotalCount($param,$branch_id_fk){
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('product_name', $searchValue);
        }
        if(!empty($branch_id_fk) && $branch_id_fk != 0)
        {
            $this->db->where("branch_id_fk",$branch_id_fk);
        }
        else
        {
            $this->db->where("branch_id_fk",0);
        }
		$this->db->select('*');
    	$this->db->from('tbl_product');
        $this->db->where("product_status",1);

        $query = $this->db->get();
		return $query->num_rows();
	}

    public function getPurchaseReports($product_id) 
    {
        $this->db->select('*,DATE_FORMAT(purchase_date,\'%d/%m/%Y\') as purchase_dates');
		$this->db->from('tbl_purchase');
		$this->db->join('tbl_product','product_id = product_id_fk','left');
		$this->db->join('tbl_vendor','vendor_id = vendor_id_fk','left');
		$this->db->where('tbl_purchase.product_id_fk', $product_id); 
        $this->db->where("purchase_status",1);
		$this->db->order_by('purchase_date','DESC');
        $query = $this->db->get();
		return $query->result();
    }

    public function itemSaleRportLists($product_id)
    {
        $this->db->select('*,tbl_sale.total_price as total,tbl_sale.invoice_number as invoice_number,((sale_price-((sale_price*100)/(100+taxamount)))/2)*sale_quantity as sgst, (taxamount/2) as taxper,((sale_price*100)/(100+taxamount)) as rate,DATE_FORMAT(sale_date,\'%d/%m/%Y\') as sale_date');
    	$this->db->from('tbl_sale');
    	$this->db->join('tbl_product','product_id = product_id_fk','left');
    	$this->db->join('tbl_member','member_id = tbl_sale.member_id_fk','left');
		$this->db->order_by('tbl_sale.invoice_number','ASCE');
        $this->db->where("sale_status",1);
		$this->db->where("tbl_sale.product_id_fk",$product_id);
        $query = $this->db->get();
        return $query->result();
    }


    public function getstocktransfer($product_id) 
    {
        $this->db->select('*,DATE_FORMAT(punit_date,\'%d/%m/%Y\') as punit_date');
		$this->db->from('tbl_production_unit');
		$this->db->join('tbl_product','product_id = punit_product_id_fk','left');
		$this->db->where('tbl_production_unit.punit_product_id_fk', $product_id); 
        $this->db->where("punit_status",1);
		$this->db->order_by('punit_date','DESC');
        $query = $this->db->get();
		return $query->result();
    }

    public function getbranchtransfer($product_id) 
    {
        $this->db->select('*,DATE_FORMAT(bt_date,\'%d/%m/%Y\') as bt_date');
		$this->db->from('tbl_branch_transfer');
		$this->db->join('tbl_product','product_id = bt_product_id_fk','left');
        $this->db->join('tbl_branch','bt_branch_id_fk = branch_id','left');
		$this->db->where('tbl_branch_transfer.bt_product_id_fk', $product_id); 
        $this->db->where("bt_status",1);
		$this->db->order_by('bt_date','DESC');
        $query = $this->db->get();
		return $query->result();
    }

    public function getdamage($product_id) 
    {
        $this->db->select('*,DATE_FORMAT(damage_date,\'%d/%m/%Y\') as damage_date');
		$this->db->from('tbl_damage');
		$this->db->join('tbl_product','product_id = damage_item_id_fk','left');
        $this->db->join('tbl_branch','branch_id_fk = branch_id','left');
		$this->db->where('damage_item_id_fk', $product_id); 
        $this->db->where("damage_status",1);
		$this->db->order_by('damage_date','DESC');
        $query = $this->db->get();
		return $query->result();
    }
}
?>
