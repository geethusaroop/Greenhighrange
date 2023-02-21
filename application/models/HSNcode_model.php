<?php

Class HSNcode_model extends CI_Model{
	public function getHSNcodeTable($param){
		$arOrder = array('','hsncode');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->where('hsncode', $searchValue); 
        }
        $this->db->where("hsn_status",1);
		
        if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*');
		$this->db->from('tbl_hsncode');
		$this->db->order_by('hsn_id', 'DESC');
        $query = $this->db->get();
		
        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getHSNcodeTotalCount($param);
        $data['recordsFiltered'] = $this->getHSNcodeTotalCount($param);
        return $data;
	}
	public function getHSNcodeTotalCount($param = NULL){
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->where('hsncode', $searchValue); 
        }
		$this->db->select('*');
		$this->db->from('tbl_hsncode');
		$this->db->order_by('hsn_id', 'DESC');
        $this->db->where("hsn_status",1);
        
        $query = $this->db->get();
    	return $query->num_rows();
    }
	
	public function gethsncode()
	{
		$status=1;
		$this->db->select('*');
		$this->db->from('tbl_hsncode');
		$this->db->where('hsn_status', 1);
		$this->db->order_by('hsn_id', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}
	
}
?>