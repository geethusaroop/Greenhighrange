<?php
Class Bank_model extends CI_Model{

	public function getSupplierTable($param,$branch_id_fk){
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
		if(!empty($branch_id_fk) && $branch_id_fk != 0)
        {
            $this->db->where("bank_branch_id_fk",$branch_id_fk);
        }
        else
        {
            $this->db->where("bank_branch_id_fk",0);
        }
		$this->db->where("bank_status",1);
        $query = $this->db->get();
		
        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getSupplierTotalCount($param,$branch_id_fk);
        $data['recordsFiltered'] = $this->getSupplierTotalCount($param,$branch_id_fk);
        return $data;

	}
	public function getSupplierTotalCount($param = NULL,$branch_id_fk){

		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('ftype_name', $searchValue); 
        }
		
		$this->db->select('*');
		$this->db->from('tbl_bank');
		if(!empty($branch_id_fk) && $branch_id_fk != 0)
        {
            $this->db->where("bank_branch_id_fk",$branch_id_fk);
        }
        else
        {
            $this->db->where("bank_branch_id_fk",0);
        }
		$this->db->where("bank_status",1);
        $query = $this->db->get();
    	return $query->num_rows();
    }

	public function view_by($branch_id_fk)
	{
		$status=1;
		$this->db->select('*');
		$this->db->from('tbl_bank');
		if(!empty($branch_id_fk) && $branch_id_fk != 0)
        {
            $this->db->where("bank_branch_id_fk",$branch_id_fk);
        }
        else
        {
            $this->db->where("bank_branch_id_fk",0);
        }
		$this->db->where('bank_status', $status);
		$query = $this->db->get();
		return $query->result();
	}

	

}

?>