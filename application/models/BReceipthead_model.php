<?php
Class BReceipthead_model extends CI_Model{

	public function getSupplierTable($param,$branch_id_fk){
		$arOrder = array('','class');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('receipt_head', $searchValue); 
        }
        
        if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*');
		$this->db->from('tbl_branch_receipthead');
		$this->db->order_by('receipt_id', 'ASC');
		$this->db->where("receipt_status",1);
        $query = $this->db->get();
		
        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getSupplierTotalCount($param,$branch_id_fk);
        $data['recordsFiltered'] = $this->getSupplierTotalCount($param,$branch_id_fk);
        return $data;

	}
	public function getSupplierTotalCount($param = NULL,$branch_id_fk){

		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('receipt_head', $searchValue); 
        }
		$this->db->select('*');
		$this->db->from('tbl_branch_receipthead');
		$this->db->order_by('receipt_id', 'ASC');
		$this->db->where("receipt_status",1);
        $query = $this->db->get();
    	return $query->num_rows();
    }
		public function view_by()
	{
		$status=1;
		$this->db->select('*');
		$this->db->from('tbl_branch_receipthead');
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

		public function view_by1($branch_id_fk)
	{
		$status=1;
		$this->db->select('*');
		$this->db->from('tbl_branch_receipthead');
		$this->db->where("tbl_branch_receipthead.receipt_branch_id_fk",$branch_id_fk);
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

	public function getreceiptheadTable($param,$branch_id_fk){
		$arOrder = array('','class');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('receipt_head', $searchValue); 
        }
        
        if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*');
		$this->db->from('tbl_branch_receipthead');
		$this->db->where("tbl_branch_receipthead.receipt_branch_id_fk",$branch_id_fk);
		$this->db->order_by('receipt_id', 'ASC');
		$this->db->where("receipt_status",1);
        $query = $this->db->get();
		
        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getreceiptheadTableTotalCount($param,$branch_id_fk);
        $data['recordsFiltered'] = $this->getreceiptheadTableTotalCount($param,$branch_id_fk);
        return $data;

	}
	public function getreceiptheadTableTotalCount($param = NULL,$branch_id_fk){

		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('receipt_head', $searchValue); 
        }
		$this->db->select('*');
		$this->db->from('tbl_branch_receipthead');
		$this->db->where("tbl_branch_receipthead.receipt_branch_id_fk",$branch_id_fk);
		$this->db->order_by('receipt_id', 'ASC');
		$this->db->where("receipt_status",1);
        $query = $this->db->get();
    	return $query->num_rows();
    }
}

?>