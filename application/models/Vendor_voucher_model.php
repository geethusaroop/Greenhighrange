<?php
Class Vendor_voucher_model extends CI_Model{

	public function getSupplierTable($param,$branch_id_fk){
		$arOrder = array('','class');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
         if($searchValue){
            $this->db->like('vendorname', $searchValue); 
        }
        if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		if(!empty($branch_id_fk) && $branch_id_fk != 0)
        {
            $this->db->where("vendor_branch_id_fk",$branch_id_fk);
        }
        else
        {
            $this->db->where("vendor_branch_id_fk",0);
        }
		$this->db->select('*');
		$this->db->from('tbl_vendor_voucher');
        $this->db->join('tbl_vendor','tbl_vendor.vendor_id=tbl_vendor_voucher.vendor_id_fk');
		$this->db->order_by('voucher_id', 'ASC');
		$this->db->where("voucher_status",1);
        $query = $this->db->get();
		
        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getSupplierTotalCount($param,$branch_id_fk);
        $data['recordsFiltered'] = $this->getSupplierTotalCount($param,$branch_id_fk);
        return $data;

	}
	public function getSupplierTotalCount($param = NULL,$branch_id_fk){

		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('vendorname', $searchValue); 
        }
		if(!empty($branch_id_fk) && $branch_id_fk != 0)
        {
            $this->db->where("vendor_branch_id_fk",$branch_id_fk);
        }
        else
        {
            $this->db->where("vendor_branch_id_fk",0);
        }
		$this->db->select('*');
		$this->db->from('tbl_vendor_voucher');
		$this->db->join('tbl_vendor','tbl_vendor.vendor_id=tbl_vendor_voucher.vendor_id_fk');
		$this->db->where("voucher_status",1);
        $query = $this->db->get();
    	return $query->num_rows();
    }

    public function view_by1($prid)
	{
		$status=1;
		$this->db->select('*');
		$this->db->from('tbl_vendor');
		$this->db->where('vendorstatus', $status);
		$this->db->where("project_id_fk",$prid);
		$query = $this->db->get();
		
		$vendornames = array();
		if ($query -> result()) {
		foreach ($query->result() as $vend_name) {
		$vendornames[$vend_name-> vendor_id] = $vend_name -> vendorname;
			}
		return $vendornames;
		}		else {
		return FALSE;
		}
	}

	public function view_by($branch_id_fk)
	{
		$status=1;
		$this->db->select('*');
		$this->db->from('tbl_vendor');
		$this->db->where('vendorstatus', $status);
		if(!empty($branch_id_fk) && $branch_id_fk != 0)
        {
            $this->db->where("vendor_branch_id_fk",$branch_id_fk);
        }
        else
        {
            $this->db->where("vendor_branch_id_fk",0);
        }
		$query = $this->db->get();
		return $query->result();
	}

	
	public function get_admno($prid)

	{

		$this->db->select('*');

		$this->db->from('tbl_vendor_voucher');

		$this->db->where('voucher_status', 1);

		$this->db->where('project_id_fk',$prid);

		$this->db->order_by('voucher_id',"DESC");

		$this->db->limit(1);

		$query = $this->db->get();

		return $query->row();

	}
		
}

?>