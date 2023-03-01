<?php
Class BVoucherhead_model extends CI_Model{


	public function view_by1($branch_id_fk)
	{
		$status=1;
		$this->db->select('*');
		$this->db->from('tbl_branch_vouchhead');
		$this->db->where("vouch_branch_id_fk",$branch_id_fk);
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

	public function getvouchTable($param,$branch_id_fk){
		$arOrder = array('','class');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
         if($searchValue){
            $this->db->like('vouch_head', $searchValue); 
        }
        if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*');
		$this->db->from('tbl_branch_vouchhead');
		$this->db->where("vouch_branch_id_fk",$branch_id_fk);
		$this->db->order_by('vouch_id', 'ASC');
		$this->db->where("vouch_status",1);
        $query = $this->db->get();
		
        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getvouchTableTotalCount($param,$branch_id_fk);
        $data['recordsFiltered'] = $this->getvouchTableTotalCount($param,$branch_id_fk);
        return $data;

	}
	public function getvouchTableTotalCount($param = NULL,$branch_id_fk){

		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('vouch_head', $searchValue); 
        }
		$this->db->select('*');
		$this->db->from('tbl_branch_vouchhead');
		$this->db->where("vouch_branch_id_fk",$branch_id_fk);
		$this->db->order_by('vouch_id', 'ASC');
		$this->db->where("vouch_status",1);
        $query = $this->db->get();
    	return $query->num_rows();
    }
}

?>