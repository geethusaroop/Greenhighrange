<?php
ob_Start();
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Stock_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}

	public function getstock($param,$branch_id_fk){
		$arOrder = array('','product_name');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
		if($searchValue){
			$this->db->like('product_name', $searchValue);
		}
		$this->db->select('*,date_format(product_updated_date,\'%d/%m/%Y\') as product_updated_date');
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
		$this->db->order_by('product_id', 'ASCE');
		$query = $this->db->get();
		$data['data'] = $query->result();
        $data['recordsTotal'] = $this->getClassinfostockTotalCount($param,$branch_id_fk);
        $data['recordsFiltered'] = $this->getClassinfostockTotalCount($param,$branch_id_fk);
		return $data;
	}
	public function getClassinfostockTotalCount($param = NULL,$branch_id_fk){
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
		$this->db->order_by('product_id', 'ASCE');
		$query = $this->db->get();
		return $query->num_rows();
	}
	
}
