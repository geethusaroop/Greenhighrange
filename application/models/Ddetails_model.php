<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ddetails_model extends CI_Model{
	public function __construct()
    {
        parent::__construct();
    }
    public function getDirectDetailsInfo($param){
		$arOrder = array('','d_details_name');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('d_details_name', $searchValue);
        }
        $this->db->where("d_details_status",1);
        if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*,date_format(d_details_dob,"%d/%m/%Y") as date_of_birth');
		$this->db->from('tbl_direct_details');
		$this->db->order_by('d_details_id', 'ASCE');
        $query = $this->db->get();
        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getDirectDetailsCount($param);
        $data['recordsFiltered'] = $this->getDirectDetailsCount($param);
        return $data;
	}
	public function getDirectDetailsCount($param = NULL){
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('d_details_name', $searchValue);
        }
        $this->db->where("d_details_status",1);
		$this->db->select('*');
		$this->db->from('tbl_direct_details');
		$this->db->order_by('d_details_id', 'ASCE');
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
