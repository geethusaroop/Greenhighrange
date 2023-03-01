<?php
Class BReceipt_model extends CI_Model{

	public function getSupplierTable($param,$branch_id_fk){
		$arOrder = array('','class');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
         if($searchValue){
            $this->db->like('receipt_head', $searchValue); 
        }
        if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*,DATE_FORMAT(rept_date,\'%d/%m/%Y\')as rept_date,tbl_branch_receipt.receipt_id as receipt_ids');
		$this->db->from('tbl_branch_receipt');
		$this->db->join('tbl_branch_receipthead','tbl_branch_receipthead.receipt_id = receipt_id_fk');
		$this->db->order_by('tbl_branch_receipt.receipt_id', 'ASC');
		$this->db->where("tbl_branch_receipt.receipt_status",1);
		$this->db->where("tbl_branch_receipt.branch_id_fk",$branch_id_fk);
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
		$this->db->select('*,DATE_FORMAT(rept_date,\'%d/%m/%Y\')as rept_date');
		$this->db->from('tbl_branch_receipt');
		$this->db->join('tbl_branch_receipthead','tbl_branch_receipthead.receipt_id = receipt_id_fk');
		$this->db->order_by('tbl_branch_receipt.receipt_id', 'ASC');
		$this->db->where("tbl_branch_receipt.receipt_status",1);
		$this->db->where("tbl_branch_receipt.branch_id_fk",$branch_id_fk);
        $query = $this->db->get();
    	return $query->num_rows();
    }
	public function get_receipthead($receipt_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_branch_receipthead');
		$this->db->where("receipt_id",$receipt_id);
        $query = $this->db->get();
    	return $query->result();
	}
	public function head($h_id)
	{
		$this->db->select('receipt_head');
		$this->db->from('tbl_branch_receipthead');
		$this->db->where("receipt_id",$h_id);
        $query = $this->db->get();
    	return $query->result();
	}

		public function getSupplierTables($param){
		$arOrder = array('','class');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
         if($searchValue){
            $this->db->like('receipt_head', $searchValue); 
        }
        if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*,DATE_FORMAT(rept_date,\'%d/%m/%Y\')as rept_date');
		$this->db->from('tbl_branch_receipt');
		$this->db->join('tbl_branch_receipthead','tbl_branch_receipthead.receipt_id = receipt_id_fk');
		$this->db->join('tbl_cag','cag_id = group');
		$this->db->order_by('tbl_branch_receipt.receipt_id', 'ASC');
		$this->db->where("tbl_branch_receipt.receipt_status",1);
		//$this->db->where("tbl_branch_receipt.group",$gid);
        $query = $this->db->get();
		
        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getSuppliersTotalCount($param);
        $data['recordsFiltered'] = $this->getSuppliersTotalCount($param);
        return $data;

	}
	public function getSuppliersTotalCount($param = NULL){

		$searchValue =($param['searchValue'])?$param['searchValue']:'';
       if($searchValue){
            $this->db->like('receipt_head', $searchValue); 
        }
		$this->db->select('*,DATE_FORMAT(rept_date,\'%d/%m/%Y\')as rept_date');
		$this->db->from('tbl_branch_receipt');
		$this->db->join('tbl_branch_receipthead','tbl_branch_receipthead.receipt_id = receipt_id_fk');
		$this->db->join('tbl_cag','cag_id =group');
		$this->db->order_by('tbl_branch_receipt.receipt_id', 'ASC');
		$this->db->where("tbl_branch_receipt.receipt_status",1);
        $query = $this->db->get();
    	return $query->num_rows();
    }

    public function getreceiptTable($param,$branch_id_fk){
		$arOrder = array('','class');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
         if($searchValue){
            $this->db->like('receipt_head', $searchValue); 
        }
        if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*,DATE_FORMAT(rept_date,\'%d/%m/%Y\')as rept_date,tbl_branch_receipt.receipt_id as receipt_ids');
		$this->db->from('tbl_branch_receipt');
		$this->db->join('tbl_branch_receipthead','tbl_branch_receipthead.receipt_id = receipt_id_fk');
		$this->db->order_by('tbl_branch_receipt.receipt_id', 'ASC');
		$this->db->where("tbl_branch_receipt.receipt_status",1);
		$this->db->where("tbl_branch_receipt.branch_id_fk",$branch_id_fk);
        $query = $this->db->get();
		
        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getgetreceiptTableTotalCount($param,$branch_id_fk);
        $data['recordsFiltered'] = $this->getgetreceiptTableTotalCount($param,$branch_id_fk);
        return $data;

	}
	public function getgetreceiptTableTotalCount($param = NULL,$branch_id_fk){

		$searchValue =($param['searchValue'])?$param['searchValue']:'';
       if($searchValue){
            $this->db->like('receipt_head', $searchValue); 
        }
		$this->db->select('*,DATE_FORMAT(rept_date,\'%d/%m/%Y\')as rept_date');
		$this->db->from('tbl_branch_receipt');
		$this->db->join('tbl_branch_receipthead','tbl_branch_receipthead.receipt_id = receipt_id_fk');
		$this->db->order_by('tbl_branch_receipt.receipt_id', 'ASC');
		$this->db->where("tbl_branch_receipt.receipt_status",1);
		$this->db->where("tbl_branch_receipt.branch_id_fk",$branch_id_fk);
        $query = $this->db->get();
    	return $query->num_rows();
    }

     	public function getreceipt($receipt_id)
	{
		$this->db->select('*,DATE_FORMAT(rept_date,\'%d/%m/%Y\')as rept_date');
		$this->db->from('tbl_branch_receipt');
		$this->db->join('tbl_branch_receipthead','tbl_branch_receipthead.receipt_id = receipt_id_fk');
		$this->db->where("tbl_branch_receipt.receipt_status",1);
		$this->db->where("tbl_branch_receipt.receipt_id",$receipt_id);
		$this->db->order_by('tbl_branch_receipt.receipt_id', 'ASCE');
		$q = $this->db->get();
        if($q->num_rows() > 0)
        {
            return $q->row();
        }
        return false;
	}
}

?>