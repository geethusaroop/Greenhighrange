<?php
ob_Start();
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Stock_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}

	public function getstock($param){
		$arOrder = array('','product_name');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
		if($searchValue){
			$this->db->like('product_name', $searchValue);
		}
		$this->db->select('*,date_format(product_updated_date,\'%d/%m/%Y\') as product_updated_date');
		$this->db->from('tbl_product');
		$this->db->where("product_status",1);
		$this->db->order_by('product_id', 'ASCE');
		$query = $this->db->get();
		$data['data'] = $query->result();
        $data['recordsTotal'] = $this->getClassinfostockTotalCount($param);
        $data['recordsFiltered'] = $this->getClassinfostockTotalCount($param);
		return $data;
	}
	public function getClassinfostockTotalCount($param = NULL){
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
		if($searchValue){
			$this->db->like('product_name', $searchValue);
		}
		$this->db->select('*');
		$this->db->from('tbl_product');
		$this->db->where("product_status",1);
		$this->db->order_by('product_id', 'ASCE');
		$query = $this->db->get();
		return $query->num_rows();
	}
	
}
