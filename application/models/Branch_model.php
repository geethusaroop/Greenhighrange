<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Branch_model extends CI_Model{

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
        $this->db->where("branch_status",1);
        if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*');
		$this->db->from('tbl_branch');

		$this->db->order_by('branch_id', 'DESC');
        $query = $this->db->get();
//print_r($this->db->get());
	//	exit();
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
		$this->db->from('tbl_branch');
        $this->db->where("branch_status",1);
		$this->db->order_by('branch_id', 'DESC');
        $query = $this->db->get();
    	return $query->num_rows();
    }
	public function view_by()
	{
		$status=1;
		$this->db->select('*');
		$this->db->from('tbl_branch');
		$this->db->where('branch_status', $status);
		$this->db->order_by('branch_name');
		$query = $this->db->get();

		$zone_names = array();
		if ($query -> result()) {
		foreach ($query->result() as $branch_name) {
		$zone_names[$branch_name-> branch_id] = $branch_name -> branch_name;
		}
		return $zone_names;
		} else {
			return FALSE;
			}
	}
}
?>
