<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Salereport_model extends CI_Model{

	public function __construct()
    {
        parent::__construct();
    }

	public function getSaleReports($prid)
	{
		$this->db->select('*,COUNT(invoice_number) as slcount,SUM(sale_netamt) as total,sum(sale_quantity) as qty,DATE_FORMAT(sale_date,\'%d/%m/%Y\') as sale_date,tbl_sale.discount_price as discount');
		$this->db->from('tbl_sale');
		$this->db->join('tbl_product','product_id = product_id_fk');
		$this->db->join('tbl_member','member_id = tbl_sale.member_id_fk','left');
		$this->db->where("sale_status",1);
		$this->db->group_by('auto_invoice');
		$this->db->order_by('tbl_sale.invoice_number','ASCE');
		$query = $this->db->get();
		return $query->result();
	}

	public function getSaleReports1($cdate,$edate,$prid,$invno)
	{
		$this->db->select('*,COUNT(invoice_number) as slcount,SUM(sale_netamt) as total,sum(sale_quantity) as qty,DATE_FORMAT(sale_date,\'%d/%m/%Y\') as sale_date,tbl_sale.discount_price as discount');
		$this->db->from('tbl_sale');
		$this->db->join('tbl_product','product_id = product_id_fk');
		$this->db->join('tbl_member','member_id = tbl_sale.member_id_fk','left');
		$this->db->where("sale_status",1);
		$this->db->group_by('auto_invoice');
		$this->db->order_by('tbl_sale.invoice_number','ASCE');
		//$this->db->order_by('tbl_sale.sale_date','DESC');
		if($invno){
            $this->db->where('tbl_sale.invoice_number', $invno); 
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

	public function getSaleReport($param,$prid){
        $arOrder = array('','invoice_no','shop','product_num1');
        $invoice_no =(isset($param['invoice_no']))?$param['invoice_no']:'';
		$product_num1 =(isset($param['product_num1']))?$param['product_num1']:'';
		$shop =(isset($param['shop']))?$param['shop']:'';
		$start_date =(isset($param['start_date']))?$param['start_date']:'';
        $end_date =(isset($param['end_date']))?$param['end_date']:'';
		$length =(isset($param['length']))?$param['length']:'';
    $start =(isset($param['start']))?$param['start']:'';
		
        if($invoice_no){
            $this->db->where('tbl_sale.invoice_number', $invoice_no); 
        }
		if($product_num1){
            $this->db->like('tbl_product.product_name', $product_num1); 
        }
		
		if($start_date){
            $this->db->where('sale_date >=', $start_date);
        }
        if($end_date){
            $this->db->where('sale_date <=', $end_date); 
        }
		$this->db->where("sale_status",1);
			$this->db->where("tbl_sale.project_id_fk",$prid);
			$this->db->limit($length,$start);
      /*   if ($param['start'] != 'false' and $param['length'] != 'false') {
            //$this->db->limit($param['length'],$param['start']);
        } */
		$this->db->select('*,COUNT(invoice_number) as slcount,SUM(sale_netamt) as total,sum(sale_quantity) as qty,DATE_FORMAT(sale_date,\'%d/%m/%Y\') as sale_date,tbl_sale.discount_price as discount');

		$this->db->from('tbl_sale');

		$this->db->join('tbl_product','product_id = product_id_fk');

		$this->db->join('tbl_member','member_id = tbl_sale.member_id_fk','left');

		$this->db->group_by('auto_invoice');
		$this->db->order_by('tbl_sale.sale_date','DESC');
        $query = $this->db->get();
        
		$data['data'] = $query->result();
        $data['recordsTotal'] = $this->getSaleReportTotalCount($param,$prid);
        $data['recordsFiltered'] = $this->getSaleReportTotalCount($param,$prid);
		$data['records_total'] = $this->getSaleReportTotalsum($param,$prid);
        return $data;

	}
	public function getSaleReportTotalCount($param,$prid){
        $invoice_no =(isset($param['invoice_no']))?$param['invoice_no']:'';
		$product_num =(isset($param['product_num']))?$param['product_num']:'';
		$shop =(isset($param['shop']))?$param['shop']:'';
		$start_date =(isset($param['start_date']))?$param['start_date']:'';
        $end_date =(isset($param['end_date']))?$param['end_date']:'';
		
		if($invoice_no){
            $this->db->where('tbl_sale.invoice_number', $invoice_no); 
        }
		if($product_num){
            $this->db->like('tbl_product.product_num', $product_num); 
        }
		
		if($start_date){
            $this->db->where('sale_date >=', $start_date);
        }
        if($end_date){
            $this->db->where('sale_date <=', $end_date); 
        }
		$this->db->where("sale_status",1);
			$this->db->where("tbl_sale.project_id_fk",$prid);
			$this->db->select('*,COUNT(invoice_number) as slcount,SUM(total_price) as total,DATE_FORMAT(sale_date,\'%d/%m/%Y\') as sale_date');
    	$this->db->from('tbl_sale');
		$this->db->join('tbl_product','product_id = product_id_fk');
		$this->db->join('tbl_member','member_id = tbl_sale.member_id_fk','left');
		//$this->db->group_by('invoice_number', 'DESC');
		$this->db->group_by('auto_invoice');
		$this->db->order_by('tbl_sale.sale_date','DESC');
        $query = $this->db->get();
		return $query->num_rows();
	}

	public function getSaleReportTotalsum($param,$prid){
        $invoice_no =(isset($param['invoice_no']))?$param['invoice_no']:'';
		$product_num =(isset($param['product_num']))?$param['product_num']:'';
		$shop =(isset($param['shop']))?$param['shop']:'';
		$start_date =(isset($param['start_date']))?$param['start_date']:'';
        $end_date =(isset($param['end_date']))?$param['end_date']:'';
		
		if($invoice_no){
            $this->db->where('tbl_sale.invoice_number', $invoice_no); 
        }
		if($product_num){
            $this->db->like('tbl_product.product_num', $product_num); 
        }
		
		if($start_date){
            $this->db->where('sale_date >=', $start_date);
        }
        if($end_date){
            $this->db->where('sale_date <=', $end_date); 
        }
		$this->db->where("sale_status",1);
		$this->db->where("tbl_sale.project_id_fk",$prid);
		$this->db->select('*,SUM(sale_netamt) as stotal,SUM(total_price) as total,SUM(sale_quantity) as qty,SUM(tbl_sale.discount_price) as discount');
    	$this->db->from('tbl_sale');
		//$this->db->join('tbl_product','product_id = product_id_fk');
		//$this->db->join('tbl_customer','cust_id = tbl_sale.customer_name','left');
		//$this->db->group_by('auto_invoice');
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
	public function get_productnum()
	{
		$this->db->select('*');
		$this->db->from('tbl_product');
		$this->db->where('product_status', 1);
		$this->db->order_by('product_name');
		$query = $this->db->get();
		
		$product_num = array();
		if ($query -> result()) {
		foreach ($query->result() as $productnum) {
		$product_num[$productnum-> product_id] = $productnum -> product_name;
			}
		return $product_num;
		} else {
		return FALSE;
		}
	}
}
?>