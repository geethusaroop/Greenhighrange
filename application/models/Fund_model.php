<?php
Class Fund_model extends CI_Model{

	public function getSupplierTable($param,$branch_id_fk){
		$arOrder = array('','class');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
		$cat_type =($param['cat_type'])?$param['cat_type']:'';
		if($cat_type){
            $this->db->where('ftype_id_fk', $cat_type); 
        }
         if($searchValue){
            $this->db->like('ftype_name', $searchValue); 
        }
        if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		if(!empty($branch_id_fk) && $branch_id_fk != 0)
        {
            $this->db->where("fund_branch_id_fk",$branch_id_fk);
        }
        else
        {
            $this->db->where("fund_branch_id_fk",0);
        }
		$this->db->select('*,date_format(fund_date,\'%d/%m/%Y\') as fund_date');
		$this->db->from('tbl_fund');
		$this->db->join('tbl_fund_type','tbl_fund_type.ftype_id=tbl_fund.ftype_id_fk');
		$this->db->order_by('fund_date', 'ASC');
		$this->db->where("fund_status",1);
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
		$cat_type =($param['cat_type'])?$param['cat_type']:'';
		if($cat_type){
            $this->db->where('ftype_id_fk', $cat_type); 
        }
		if(!empty($branch_id_fk) && $branch_id_fk != 0)
        {
            $this->db->where("fund_branch_id_fk",$branch_id_fk);
        }
        else
        {
            $this->db->where("fund_branch_id_fk",0);
        }
		$this->db->select('*');
		$this->db->from('tbl_fund');
		$this->db->join('tbl_fund_type','tbl_fund_type.ftype_id=tbl_fund.ftype_id_fk');
		$this->db->where("fund_status",1);
		$this->db->order_by('fund_date', 'ASC');
        $query = $this->db->get();
    	return $query->num_rows();
    }

	public function view_by()
	{
		$status=1;
		$this->db->select('*');
		$this->db->from('tbl_fund_type');
		$this->db->where('ftype_status', $status);
		//$this->db->where("ftype_id!=",1);
		$query = $this->db->get();
		return $query->result();
	}

	public function view_by1()
	{
		$status=1;
		$this->db->select('*');
		$this->db->from('tbl_fund_type');
		$this->db->where('ftype_status', $status);
		$query = $this->db->get();
		return $query->result();
	}


}

?>