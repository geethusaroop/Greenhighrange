<?php
Class Receipt_model extends CI_Model{

	public function getSupplierTable($param,$gid){
		$arOrder = array('','class');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
         if($searchValue){
            $this->db->like('receipt_head', $searchValue); 
        }
        if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*,DATE_FORMAT(rept_date,\'%d/%m/%Y\')as rept_date,tbl_receipt.receipt_id as receipt_ids');
		$this->db->from('tbl_receipt');
		$this->db->join('tbl_receipthead','tbl_receipthead.receipt_id = receipt_id_fk');
		$this->db->order_by('tbl_receipt.receipt_id', 'ASC');
		$this->db->where("tbl_receipt.receipt_status",1);
		$this->db->where("tbl_receipt.group",$gid);
        $query = $this->db->get();
		
        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getSupplierTotalCount($param,$gid);
        $data['recordsFiltered'] = $this->getSupplierTotalCount($param,$gid);
        return $data;

	}
	public function getSupplierTotalCount($param = NULL,$gid){

		$searchValue =($param['searchValue'])?$param['searchValue']:'';
       if($searchValue){
            $this->db->like('receipt_head', $searchValue); 
        }
		$this->db->select('*,DATE_FORMAT(rept_date,\'%d/%m/%Y\')as rept_date');
		$this->db->from('tbl_receipt');
		$this->db->join('tbl_receipthead','tbl_receipthead.receipt_id = receipt_id_fk');
		$this->db->order_by('tbl_receipt.receipt_id', 'ASC');
		$this->db->where("tbl_receipt.receipt_status",1);
		$this->db->where("tbl_receipt.group",$gid);
        $query = $this->db->get();
    	return $query->num_rows();
    }
	public function get_receipthead($receipt_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_receipthead');
		$this->db->where("receipt_id",$receipt_id);
        $query = $this->db->get();
    	return $query->result();
	}
	public function head($h_id)
	{
		$this->db->select('receipt_head');
		$this->db->from('tbl_receipthead');
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
		$this->db->from('tbl_receipt');
		$this->db->join('tbl_receipthead','tbl_receipthead.receipt_id = receipt_id_fk');
		$this->db->join('tbl_cag','cag_id = group');
		$this->db->order_by('tbl_receipt.receipt_id', 'ASC');
		$this->db->where("tbl_receipt.receipt_status",1);
		//$this->db->where("tbl_receipt.group",$gid);
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
		$this->db->from('tbl_receipt');
		$this->db->join('tbl_receipthead','tbl_receipthead.receipt_id = receipt_id_fk');
		$this->db->join('tbl_cag','cag_id =group');
		$this->db->order_by('tbl_receipt.receipt_id', 'ASC');
		$this->db->where("tbl_receipt.receipt_status",1);
        $query = $this->db->get();
    	return $query->num_rows();
    }

    public function getreceiptTable($param){
		$arOrder = array('','class');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
         if($searchValue){
            $this->db->like('receipt_head', $searchValue); 
        }
        if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*,DATE_FORMAT(rept_date,\'%d/%m/%Y\')as rept_date,tbl_project_receipt.receipt_id as receipt_ids');
		$this->db->from('tbl_project_receipt');
		$this->db->join('tbl_project_receipthead','tbl_project_receipthead.receipt_id = receipt_id_fk');
		$this->db->order_by('tbl_project_receipt.receipt_id', 'ASC');
		$this->db->where("tbl_project_receipt.receipt_status",1);
		//$this->db->where("project_id_fk",$prid);
        $query = $this->db->get();
		
        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getgetreceiptTableTotalCount($param);
        $data['recordsFiltered'] = $this->getgetreceiptTableTotalCount($param);
        return $data;

	}
	public function getgetreceiptTableTotalCount($param = NULL){

		$searchValue =($param['searchValue'])?$param['searchValue']:'';
       if($searchValue){
            $this->db->like('receipt_head', $searchValue); 
        }
		$this->db->select('*,DATE_FORMAT(rept_date,\'%d/%m/%Y\')as rept_date');
		$this->db->from('tbl_project_receipt');
		$this->db->join('tbl_project_receipthead','tbl_project_receipthead.receipt_id = receipt_id_fk');
		$this->db->order_by('tbl_project_receipt.receipt_id', 'ASC');
		$this->db->where("tbl_project_receipt.receipt_status",1);
		//$this->db->where("project_id_fk",$prid);
        $query = $this->db->get();
    	return $query->num_rows();
    }

     	public function getreceipt($receipt_id)
	{
		$this->db->select('*,DATE_FORMAT(rept_date,\'%d/%m/%Y\')as rept_date');
		$this->db->from('tbl_project_receipt');
		$this->db->join('tbl_project_receipthead','tbl_project_receipthead.receipt_id = receipt_id_fk');
		$this->db->where("tbl_project_receipt.receipt_status",1);
		$this->db->where("tbl_project_receipt.receipt_id",$receipt_id);
		$this->db->order_by('tbl_project_receipt.receipt_id', 'ASCE');
		$q = $this->db->get();
        if($q->num_rows() > 0)
        {
            return $q->row();
        }
        return false;
	}
}

?>