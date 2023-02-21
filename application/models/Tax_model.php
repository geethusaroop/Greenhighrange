<?php
Class Tax_model extends CI_Model{

	public function getTaxTable($param){
		$arOrder = array('','taxname');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('taxname', $searchValue); 
        }
        $this->db->where("tax_status",1);
		
        if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*');
		$this->db->from('tbl_taxdetails');
		$this->db->order_by('tax_id', 'DESC');
        $query = $this->db->get();
		
        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getTaxTotalCount($param);
        $data['recordsFiltered'] = $this->getTaxTotalCount($param);
        return $data;

	}
	public function getTaxTotalCount($param = NULL){

		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('taxname', $searchValue); 
        }
		$this->db->select('*');
		$this->db->from('tbl_taxdetails');
		$this->db->order_by('tax_id', 'DESC');
        $this->db->where("tax_status",1);
        $query = $this->db->get();
    	return $query->num_rows();
    }
	public function view_by()
	{
		$status=1;
		$this->db->select('*');
		$this->db->from('tbl_taxdetails');
		$this->db->where('tax_status', $status);
		$query = $this->db->get();
		
		$tax_names = array();
		if ($query -> result()) {
		foreach ($query->result() as $tax_name) {
		$tax_names[$tax_name-> tax_id] = $tax_name -> taxname;
			}
		return $tax_names;
		} else {
		return FALSE;
		}
	}
}

?>