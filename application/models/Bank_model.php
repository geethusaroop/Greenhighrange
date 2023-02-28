<?php
Class Bank_model extends CI_Model{

	public function getSupplierTable($param){
		$arOrder = array('','class');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
         if($searchValue){
            $this->db->like('ftype_name', $searchValue); 
        }
        if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		
		$this->db->select('*');
		$this->db->from('tbl_bank');
		$this->db->where("bank_status",1);
        $query = $this->db->get();
		
        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getSupplierTotalCount($param);
        $data['recordsFiltered'] = $this->getSupplierTotalCount($param);
        return $data;

	}
	public function getSupplierTotalCount($param = NULL){

		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('ftype_name', $searchValue); 
        }
		
		$this->db->select('*');
		$this->db->from('tbl_bank');
		$this->db->where("bank_status",1);
        $query = $this->db->get();
    	return $query->num_rows();
    }

	public function view_by()
	{
		$status=1;
		$this->db->select('*');
		$this->db->from('tbl_bank');
		$this->db->where('bank_status', $status);
		$query = $this->db->get();
		return $query->result();
	}

	

}

?>