<?php
Class Receipthead_model extends CI_Model{

	public function getSupplierTable($param){
		$arOrder = array('','class');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('receipt_head', $searchValue); 
        }
        
        if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*');
		$this->db->from('tbl_receipthead');
		$this->db->order_by('receipt_id', 'ASC');
		$this->db->where("receipt_status",1);
        $query = $this->db->get();
		
        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getSupplierTotalCount($param);
        $data['recordsFiltered'] = $this->getSupplierTotalCount($param);
        return $data;

	}
	public function getSupplierTotalCount($param = NULL){

		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('receipt_head', $searchValue); 
        }
		$this->db->select('*');
		$this->db->from('tbl_receipthead');
		$this->db->order_by('receipt_id', 'ASC');
		$this->db->where("receipt_status",1);
        $query = $this->db->get();
    	return $query->num_rows();
    }
		public function view_by()
	{
		$status=1;
		$this->db->select('*');
		$this->db->from('tbl_receipthead');
		$this->db->where('receipt_status', $status);
		$query = $this->db->get();
		
		$receiptnames = array();
		if ($query -> result()) {
		foreach ($query->result() as $receipt_name) {
		$receiptnames[$receipt_name-> receipt_id] = $receipt_name -> receipt_head;
			}
		return $receiptnames;
		}		else {
		return FALSE;
		}
	}

		public function view_by1()
	{
		$status=1;
		$this->db->select('*');
		$this->db->from('tbl_project_receipthead');
		$this->db->where('receipt_status', $status);
		$query = $this->db->get();
		
		$receiptnames = array();
		if ($query -> result()) {
		foreach ($query->result() as $receipt_name) {
		$receiptnames[$receipt_name-> receipt_id] = $receipt_name -> receipt_head;
			}
		return $receiptnames;
		}		else {
		return FALSE;
		}
	}

	public function getreceiptheadTable($param){
		$arOrder = array('','class');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('receipt_head', $searchValue); 
        }
        
        if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*');
		$this->db->from('tbl_project_receipthead');
		$this->db->order_by('receipt_id', 'ASC');
		$this->db->where("receipt_status",1);
        $query = $this->db->get();
		
        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getreceiptheadTableTotalCount($param);
        $data['recordsFiltered'] = $this->getreceiptheadTableTotalCount($param);
        return $data;

	}
	public function getreceiptheadTableTotalCount($param = NULL){

		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('receipt_head', $searchValue); 
        }
		$this->db->select('*');
		$this->db->from('tbl_project_receipthead');
		$this->db->order_by('receipt_id', 'ASC');
		$this->db->where("receipt_status",1);
        $query = $this->db->get();
    	return $query->num_rows();
    }
}

?>