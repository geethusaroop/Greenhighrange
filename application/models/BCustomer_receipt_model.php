<?php
Class BCustomer_receipt_model extends CI_Model{

	public function getSupplierTable($param,$branch_id_fk){
		$arOrder = array('','class');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
         if($searchValue){
            $this->db->like('member_name', $searchValue); 
        }
        if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		if(!empty($branch_id_fk) && $branch_id_fk != 0)
        {
            $this->db->where("receipt_branch_id_fk",$branch_id_fk);
        }
        else
        {
            $this->db->where("receipt_branch_id_fk",0);
        }
		$this->db->select('*');
		$this->db->from('tbl_customer_receipt');
        $this->db->join('tbl_member','tbl_member.member_id=tbl_customer_receipt.receipt_member_id_fk');
		$this->db->order_by('receipt_date', 'ASC');
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
            $this->db->like('member_name', $searchValue); 
        }
		if(!empty($branch_id_fk) && $branch_id_fk != 0)
        {
            $this->db->where("receipt_branch_id_fk",$branch_id_fk);
        }
        else
        {
            $this->db->where("receipt_branch_id_fk",0);
        }
		$this->db->select('*');
		$this->db->from('tbl_customer_receipt');
		$this->db->join('tbl_member','tbl_member.member_id=tbl_customer_receipt.receipt_member_id_fk');
		$this->db->order_by('receipt_date', 'ASC');
		$this->db->where("receipt_status",1);
        $query = $this->db->get();
    	return $query->num_rows();
    }


	public function get_admno($prid)

	{
		$this->db->select('*');

		$this->db->from('tbl_customer_receipt');

		$this->db->where('receipt_status', 1);

		$this->db->where('receipt_branch_id_fk',$prid);

		$this->db->order_by('receipt_id',"DESC");

		$this->db->limit(1);

		$query = $this->db->get();

		return $query->row();

	}

}

?>