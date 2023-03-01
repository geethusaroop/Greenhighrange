<?php
Class Bankdeposit_model extends CI_Model{

	public function getSupplierTable($param,$branch_id_fk){
		$arOrder = array('','class');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
         if($searchValue){
            $this->db->like('bank_name', $searchValue); 
        }
        if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		
		$this->db->select('*,date_format(bd_date,\'%d/%m/%Y\') as bd_date');
		$this->db->from('tbl_bank_deposit');
		$this->db->join('tbl_bank','bank_id=bd_bank_id_fk');
		$this->db->join('tbl_member','member_id=bd_member_id_fk','left');
		if(!empty($branch_id_fk) && $branch_id_fk != 0)
        {
            $this->db->where("tbl_bank_deposit.branch_id_fk",$branch_id_fk);
        }
        else
        {
            $this->db->where("tbl_bank_deposit.branch_id_fk",0);
        }
		$this->db->where("bank_status",1);
		$this->db->where("bd_status",1);
		$this->db->order_by("bd_date",'ASC');
        $query = $this->db->get();
		
        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getSupplierTotalCount($param,$branch_id_fk);
        $data['recordsFiltered'] = $this->getSupplierTotalCount($param,$branch_id_fk);
        return $data;

	}
	public function getSupplierTotalCount($param = NULL,$branch_id_fk){

		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('bank_name', $searchValue); 
        }
		
		$this->db->select('*');
		$this->db->from('tbl_bank_deposit');
		$this->db->join('tbl_bank','bank_id=bd_bank_id_fk');
		$this->db->join('tbl_member','member_id=bd_member_id_fk','left');
		if(!empty($branch_id_fk) && $branch_id_fk != 0)
        {
            $this->db->where("tbl_bank_deposit.branch_id_fk",$branch_id_fk);
        }
        else
        {
            $this->db->where("tbl_bank_deposit.branch_id_fk",0);
        }
		$this->db->where("bank_status",1);
		$this->db->where("bd_status",1);
		$this->db->order_by("bd_date",'ASC');
        $query = $this->db->get();
    	return $query->num_rows();
    }
	public function view_by()
	{
		$status=1;
		$this->db->select('*');
		$this->db->from('tbl_member');
		$this->db->where('member_status', $status);
		$query = $this->db->get();
		return $query->result();
	}

}

?>