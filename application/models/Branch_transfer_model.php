<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Branch_transfer_model extends CI_Model{
	public function __construct()
    {
        parent::__construct();
    }
    public function getClassinfoTable($param){
		$arOrder = array('','branch_name');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('branch_name', $searchValue);
        }
        $this->db->where("bt_status",1);
        if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*,date_format(bt_date,\'%d/%m/%Y\') as bt_date');
		$this->db->from('tbl_branch_transfer');
        $this->db->join('tbl_branch','branch_id=bt_branch_id_fk','left');
        $this->db->join('tbl_product','product_id=bt_product_id_fk','left');
		$this->db->order_by('bt_id', 'DESC');
        $query = $this->db->get();
        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getClassinfoTotalCount($param);
        $data['recordsFiltered'] = $this->getClassinfoTotalCount($param);
        return $data;
	}
	public function getClassinfoTotalCount($param = NULL){
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('branch_name', $searchValue);
        }
		$this->db->select('*');
		$this->db->from('tbl_branch_transfer');
        $this->db->join('tbl_branch','branch_id=bt_branch_id_fk','left');
        $this->db->join('tbl_product','product_id=bt_product_id_fk','left');
        $this->db->where("bt_status",1);
		$this->db->order_by('bt_id', 'DESC');
        $query = $this->db->get();
    	return $query->num_rows();
    }
	// public function view_by()
	// {
	// 	$status=1;
	// 	$this->db->select('*');
	// 	$this->db->from('tbl_branch');
	// 	$this->db->where('branch_status', $status);
	// 	$this->db->order_by('branch_name');
	// 	$query = $this->db->get();
	// 	$zone_names = array();
	// 	if ($query -> result()) {
	// 	foreach ($query->result() as $branch_name) {
	// 	$zone_names[$branch_name-> branch_id] = $branch_name -> branch_name;
	// 	}
	// 	return $zone_names;
	// 	} else {
	// 		return FALSE;
	// 		}
	// }
}
?>