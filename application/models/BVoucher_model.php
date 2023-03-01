<?php
Class BVoucher_model extends CI_Model{
	
	
    public function getvoucherTable($param,$branch_id_fk){
		$arOrder = array('','class');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
		if($searchValue){
            $this->db->like('tbl_branch_vouchhead.vouch_head', $searchValue); 
        }
        
        if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*,DATE_FORMAT(voucher_date,\'%d/%m/%Y\')as voucher_date');
		$this->db->from('tbl_branch_voucher');
		$this->db->join('tbl_branch_vouchhead','vouch_id = vouch_id_fk');
		$this->db->order_by('voucher_id', 'ASC');
		$this->db->where("voucher_status",1);
		$this->db->where("branch_id_fk",$branch_id_fk);
        $query = $this->db->get();
		
        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getvoucherTableTotalCount($param,$branch_id_fk);
        $data['recordsFiltered'] = $this->getvoucherTableTotalCount($param,$branch_id_fk);
        return $data;
	}
	public function getvoucherTableTotalCount($param = NULL,$branch_id_fk){
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('tbl_branch_vouchhead.vouch_head', $searchValue); 
        }
		$this->db->select('*,DATE_FORMAT(voucher_date,\'%d/%m/%Y\')as voucher_date');
		$this->db->from('tbl_branch_voucher');
		$this->db->join('tbl_branch_vouchhead','vouch_id = vouch_id_fk');
		$this->db->order_by('voucher_id', 'ASC');
		$this->db->where("voucher_status",1);
		$this->db->where("branch_id_fk",$branch_id_fk);
        $query = $this->db->get();
    	return $query->num_rows();
    }
    	public function getvoucher($voucher_id)
	{
		$this->db->select('*,DATE_FORMAT(voucher_date,\'%d/%m/%Y\')as voucher_date');
		$this->db->from('tbl_branch_voucher');
		$this->db->join('tbl_branch_vouchhead','vouch_id = vouch_id_fk');
		$this->db->where("voucher_status",1);
		$this->db->where("voucher_id",$voucher_id);
		$this->db->order_by('voucher_id', 'ASCE');
		$q = $this->db->get();
        if($q->num_rows() > 0)
        {
            return $q->row();
        }
        return false;
	}
}
?>