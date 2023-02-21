<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Purchase_report_model extends CI_Model{

	public function __construct()
    {
        parent::__construct();
    }

    public function getPurchaseReports() 
    {
        $this->db->select('*,COUNT(invoice_number) as prcount,ROUND(SUM(total_price),2) as total,DATE_FORMAT(purchase_date,\'%d/%m/%Y\') as purchase_dates');
		$this->db->from('tbl_purchase');
		//$this->db->join('tbl_product','product_id = product_id_fk','left');
		$this->db->join('tbl_vendor','vendor_id = vendor_id_fk','left');
		$this->db->group_by('auto_invoice');
        $this->db->where("purchase_status",1);
		$this->db->order_by('purchase_date','DESC');
        $query = $this->db->get();
		return $query->result();
    }

	public function getPurchaseReports1($vendor_id,$cdate,$edate) 
    {
        $this->db->select('*,COUNT(invoice_number) as prcount,ROUND(SUM(total_price),2) as total,DATE_FORMAT(purchase_date,\'%d/%m/%Y\') as purchase_dates');
		$this->db->from('tbl_purchase');
		//$this->db->join('tbl_product','product_id = product_id_fk','left');
		$this->db->join('tbl_vendor','vendor_id = tbl_purchase.vendor_id_fk','left');
		$this->db->group_by('auto_invoice');
        $this->db->where("purchase_status",1);
		$this->db->order_by('purchase_date','DESC');
	
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

	
    public function getitems()

    {

		$this->db->select('*');

		$this->db->from('tbl_product');

        $this->db->where('product_status',1);
        $this->db->where('product_category',1);
        $this->db->group_by('product_name');

        $query = $this->db->get();
		return $query->result();

    }

#################################################################################################################################################################################
public function getitemPurchaseReports(){
    $this->db->select('*,DATE_FORMAT(purchase_date,\'%d/%m/%Y\') as purchase_date');
    $this->db->from('tbl_purchase');
    $this->db->join('tbl_product','product_id = product_id_fk');
    $this->db->join('tbl_vendor','vendor_id = vendor_id_fk');
    $this->db->where("purchase_status",1); 
    $this->db->order_by('purchase_date','DESC');
    $query = $this->db->get();
    return $query->result();
}

public function getitemPurchaseReports1($product_id,$cdate,$edate){
    $this->db->select('*,DATE_FORMAT(purchase_date,\'%d/%m/%Y\') as purchase_date');
    $this->db->from('tbl_purchase');
    $this->db->join('tbl_product','product_id = product_id_fk');
    $this->db->join('tbl_vendor','vendor_id = vendor_id_fk');
    $this->db->where("purchase_status",1); 
    $this->db->order_by('purchase_date','DESC');
    if(!empty($product_id)){
        $this->db->where('product_name', $product_id); 
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



}
?>