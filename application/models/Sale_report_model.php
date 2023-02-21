<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sale_report_model extends CI_Model{

	public function __construct()
    {
        parent::__construct();
    }
    public function getCusSaleReports($prid)
    {
        $this->db->select('*,tbl_sale.total_price as total,tbl_sale.invoice_number as invoice_number,((sale_price-((sale_price*100)/(100+taxamount)))/2)*sale_quantity as sgst, (taxamount/2) as taxper,((sale_price*100)/(100+taxamount)) as rate,DATE_FORMAT(sale_date,\'%d/%m/%Y\') as sale_date,tbl_sale.discount_price as discount');
    	$this->db->from('tbl_sale');
    	$this->db->join('tbl_product','product_id = product_id_fk','left');
    	$this->db->join('tbl_member','member_id = tbl_sale.member_id_fk','left');
		$this->db->order_by('tbl_sale.invoice_number','ASCE');
        $this->db->group_by('auto_invoice');
        $this->db->where("sale_status",1);
		//$this->db->where("tbl_sale.project_id_fk",$prid);
        $query = $this->db->get();
        return $query->result();
    }

    public function getCusSaleReports1($cdate,$edate,$prid)
    {
        $this->db->select('*,tbl_sale.total_price as total,tbl_sale.invoice_number as invoice_number,((sale_price-((sale_price*100)/(100+taxamount)))/2)*sale_quantity as sgst, (taxamount/2) as taxper,((sale_price*100)/(100+taxamount)) as rate,DATE_FORMAT(sale_date,\'%d/%m/%Y\') as sale_date,tbl_sale.discount_price as discount');
    	$this->db->from('tbl_sale');
    	$this->db->join('tbl_product','product_id = product_id_fk','left');
    	$this->db->join('tbl_member','member_id = tbl_sale.member_id_fk','left');
		$this->db->order_by('tbl_sale.invoice_number','ASCE');
        $this->db->group_by('auto_invoice');
        $this->db->where("sale_status",1);
	//	$this->db->where("tbl_sale.project_id_fk",$prid);
        if(!empty($cdate)){
            $this->db->where('sale_date >=', $cdate);
        }
        if(!empty($edate)){
            $this->db->where('sale_date <=', $edate); 
        }
        $query = $this->db->get();
        return $query->result();
    }


    ######################################################################################################################################
    public function supplierSaleRportLists($prid)
    {
        $this->db->select('*,tbl_sale.total_price as total,tbl_sale.invoice_number as invoice_number,((sale_price-((sale_price*100)/(100+tbl_sale.taxamount)))/2)*sale_quantity as sgst, (tbl_sale.taxamount/2) as taxper,((sale_price*100)/(100+tbl_sale.taxamount)) as rate,DATE_FORMAT(sale_date,\'%d/%m/%Y\') as sale_date,(tbl_purchase.purchase_price * tbl_sale.sale_quantity) as ptotal');
    	$this->db->from('tbl_sale');
    	$this->db->join('tbl_product','product_id = product_id_fk','left');
    	$this->db->join('tbl_member','member_id = tbl_sale.member_id_fk','left');
        $this->db->join('tbl_purchase','tbl_purchase.product_id_fk = tbl_product.product_id','left');
		//$this->db->order_by('tbl_sale.invoice_number','DESC');
        $this->db->order_by('tbl_sale.invoice_number','ASCE');
        $this->db->group_by('tbl_sale.auto_invoice');
        $this->db->where("sale_status",1);
        $query = $this->db->get();
        return $query->result();
    }

    public function supplierSaleRportLists1($cdate,$edate,$vendor_id,$prid)
    {
        $this->db->select('*,tbl_sale.total_price as total,tbl_sale.invoice_number as invoice_number,((sale_price-((sale_price*100)/(100+tbl_sale.taxamount)))/2)*sale_quantity as sgst, (tbl_sale.taxamount/2) as taxper,((sale_price*100)/(100+tbl_sale.taxamount)) as rate,DATE_FORMAT(sale_date,\'%d/%m/%Y\') as sale_date,(tbl_purchase.purchase_price * tbl_sale.sale_quantity) as ptotal');
    	$this->db->from('tbl_sale');
    	$this->db->join('tbl_product','product_id = product_id_fk','left');
    	$this->db->join('tbl_member','member_id = tbl_sale.member_id_fk','left');
        $this->db->join('tbl_purchase','tbl_purchase.product_id_fk = tbl_product.product_id','left');
		$this->db->order_by('tbl_sale.invoice_number','ASCE');
      //  $this->db->group_by('tbl_sale.auto_invoice');
        $this->db->where("sale_status",1);
        if(!empty($vendor_id)){
            $this->db->where('tbl_purchase.vendor_id_fk', $vendor_id); 
        }
		if(!empty($cdate)){
            $this->db->where('sale_date >=', $cdate);
        }
        if(!empty($edate)){
            $this->db->where('sale_date <=', $edate); 
        }
        $query = $this->db->get();
        return $query->result();
    }
    
    ####################################################################################################################################
    public function itemSaleRportLists($prid)
    {
        $this->db->select('*,tbl_sale.total_price as total,tbl_sale.invoice_number as invoice_number,((sale_price-((sale_price*100)/(100+taxamount)))/2)*sale_quantity as sgst, (taxamount/2) as taxper,((sale_price*100)/(100+taxamount)) as rate,DATE_FORMAT(sale_date,\'%d/%m/%Y\') as sale_date');
    	$this->db->from('tbl_sale');
    	$this->db->join('tbl_product','product_id = product_id_fk','left');
        $this->db->join('tbl_member','member_id = tbl_sale.member_id_fk','left');
		$this->db->order_by('tbl_sale.invoice_number','ASCE');
       // $this->db->group_by('auto_invoice');
        $this->db->where("sale_status",1);
        $query = $this->db->get();
        return $query->result();
    }

    public function itemSaleRportLists1($cdate,$edate,$item_id,$prid)
    {
        $this->db->select('*,tbl_sale.total_price as total,tbl_sale.invoice_number as invoice_number,((sale_price-((sale_price*100)/(100+taxamount)))/2)*sale_quantity as sgst, (taxamount/2) as taxper,((sale_price*100)/(100+taxamount)) as rate,DATE_FORMAT(sale_date,\'%d/%m/%Y\') as sale_date');
    	$this->db->from('tbl_sale');
    	$this->db->join('tbl_product','product_id = product_id_fk','left');
        $this->db->join('tbl_member','member_id = tbl_sale.member_id_fk','left');
		$this->db->order_by('tbl_sale.invoice_number','ASCE');
      //  $this->db->group_by('auto_invoice');
        $this->db->where("sale_status",1);
        if($item_id){
            $this->db->where('tbl_product.product_name', $item_id); 
         }
         if($cdate){
             $this->db->where('sale_date >=', $cdate);
         }
         if($edate){
             $this->db->where('sale_date <=', $edate); 
         }
        $query = $this->db->get();
        return $query->result();
    }

   
    public function get_customer()
    {
		$this->db->select('*');
    	$this->db->from('tbl_sale');
		$this->db->where('sale_status',1);
        $this->db->where('customer_name!=',"");
        $this->db->group_by('customer_name');
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
}
?>