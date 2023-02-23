<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class BStock_report_model extends CI_Model{

	public function __construct()
    {
        parent::__construct();
    }
	//Supplier Wise Report


########################################################################################################################################################
	//Physical Stock Wise

    public function getphysicalStock($product_name,$product_id,$cdate,$edate,$bid)
    {
        $this->db->select('*,DATE_FORMAT(tbl_branch_transfer.bt_date,"%d/%m/%Y") as bt_date');
    	$this->db->from('tbl_branch_transfer');
        $this->db->join('tbl_product','product_id = bt_product_id_fk');
		$this->db->where("product_status",1);
        $this->db->where("bt_status",1);
        $this->db->order_by('tbl_product.product_id','DESC');

        if(!empty($product_name)){
            $this->db->where('tbl_product.product_name', $product_name); 
        }
       
		if(!empty($cdate)){
            $this->db->where('bt_date >=', $cdate);
        }
        if(!empty($edate)){
            $this->db->where('bt_date <=', $edate); 
        }
            $this->db->where("bt_branch_id_fk",$bid);
       

        $query = $this->db->get();
        return $query->result();
    }

    public function getphysicalStock1($bid)
    {
        $this->db->select('*,DATE_FORMAT(tbl_branch_transfer.bt_date,"%d/%m/%Y") as bt_date');
    	$this->db->from('tbl_branch_transfer');
        $this->db->join('tbl_product','product_id = bt_product_id_fk','left');
		$this->db->where("product_status",1);
        $this->db->where("bt_status",1);
        $this->db->where("bt_branch_id_fk",$bid);
        $this->db->order_by('tbl_product.product_name','ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function getitems_marmathews($bid)

    {
		$this->db->select('*');
		$this->db->from('tbl_product');
        $this->db->where("branch_id_fk",$bid);
        $this->db->where('product_status',1);
        $this->db->group_by('product_name');
        $query = $this->db->get();
		return $query->result();

    }

}
