<?php
Class Voucherhead_model extends CI_Model{

	public function getSupplierTable($param){
		$arOrder = array('','class');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
         if($searchValue){
            $this->db->like('vouch_head', $searchValue); 
        }
        if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*');
		$this->db->from('tbl_vouchhead');
		$this->db->order_by('vouch_id', 'ASC');
		$this->db->where("vouch_status",1);
        $query = $this->db->get();
		
        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getSupplierTotalCount($param);
        $data['recordsFiltered'] = $this->getSupplierTotalCount($param);
        return $data;

	}
	public function getSupplierTotalCount($param = NULL){

		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('vouch_head', $searchValue); 
        }
		$this->db->select('*');
		$this->db->from('tbl_vouchhead');
		$this->db->order_by('vouch_id', 'ASC');
		$this->db->where("vouch_status",1);
        $query = $this->db->get();
    	return $query->num_rows();
    }
		public function view_by()
	{
		$status=1;
		$this->db->select('*');
		$this->db->from('tbl_vouchhead');
		$this->db->where('vouch_status', $status);
		$query = $this->db->get();
		
		$vouchnames = array();
		if ($query -> result()) {
		foreach ($query->result() as $vouch_name) {
		$vouchnames[$vouch_name-> vouch_id] = $vouch_name -> vouch_head;
			}
		return $vouchnames;
		}		else {
		return FALSE;
		}
	}

		public function view_by1()
	{
		$status=1;
		$this->db->select('*');
		$this->db->from('tbl_project_vouchhead');
		$this->db->where('vouch_status', $status);
		$query = $this->db->get();
		
		$vouchnames = array();
		if ($query -> result()) {
		foreach ($query->result() as $vouch_name) {
		$vouchnames[$vouch_name-> vouch_id] = $vouch_name -> vouch_head;
			}
		return $vouchnames;
		}		else {
		return FALSE;
		}
	}

	public function getvouchTable($param){
		$arOrder = array('','class');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
         if($searchValue){
            $this->db->like('vouch_head', $searchValue); 
        }
        if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*');
		$this->db->from('tbl_project_vouchhead');
		$this->db->order_by('vouch_id', 'ASC');
		$this->db->where("vouch_status",1);
        $query = $this->db->get();
		
        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getvouchTableTotalCount($param);
        $data['recordsFiltered'] = $this->getvouchTableTotalCount($param);
        return $data;

	}
	public function getvouchTableTotalCount($param = NULL){

		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('vouch_head', $searchValue); 
        }
		$this->db->select('*');
		$this->db->from('tbl_project_vouchhead');
		$this->db->order_by('vouch_id', 'ASC');
		$this->db->where("vouch_status",1);
        $query = $this->db->get();
    	return $query->num_rows();
    }
}

?>