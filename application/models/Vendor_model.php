<?php
Class Vendor_model extends CI_Model{
	public function getVendorTable($param,$branch_id_fk){
		$arOrder = array('','vendorname');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
		if($searchValue){
			$this->db->like('vendorname', $searchValue);
		}
		$this->db->where("vendorstatus",1);
		if(!empty($branch_id_fk) && $branch_id_fk != 0)
        {
            $this->db->where("vendor_branch_id_fk",$branch_id_fk);
        }
        else
        {
            $this->db->where("vendor_branch_id_fk",0);
        }
		if ($param['start'] != 'false' and $param['length'] != 'false') {
			$this->db->limit($param['length'],$param['start']);
		}
		$this->db->select('*');
		$this->db->from('tbl_vendor');
		$this->db->order_by('vendor_id', 'DESC');
		$query = $this->db->get();
		$data['data'] = $query->result();
		$data['recordsTotal'] = $this->getVendorTotalCount($param,$branch_id_fk);
		$data['recordsFiltered'] = $this->getVendorTotalCount($param,$branch_id_fk);
		return $data;
	}
	public function getVendorTotalCount($param = NULL,$branch_id_fk){
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
		if($searchValue){
			$this->db->like('vendorname', $searchValue);
		}
		$this->db->select('*');
		$this->db->from('tbl_vendor');
		$this->db->order_by('vendor_id', 'DESC');
		$this->db->where("vendorstatus",1);
		if(!empty($branch_id_fk) && $branch_id_fk != 0)
        {
            $this->db->where("vendor_branch_id_fk",$branch_id_fk);
        }
        else
        {
            $this->db->where("vendor_branch_id_fk",0);
        }
		$query = $this->db->get();
		return $query->num_rows();
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
		$this->db->order_by('vendorname','ASC');
		$query = $this->db->get();
		$vendor_names = array();
		if ($query -> result()) {
			foreach ($query->result() as $vendor_name) {
				$vendor_names[$vendor_name-> vendor_id] = $vendor_name -> vendorname;
			}
			return $vendor_names;
		} else {
			return FALSE;
		}
	}
	public function view_by1()
	{
		$status=1;
		$this->db->select('*');
		$this->db->from('tbl_vendor');
		$this->db->where('vendorstatus', $status);
		$this->db->order_by('vendorname');
		$query = $this->db->get();
		return $query->result();
	}
	public function getstate()
	{
		//$status=1;
		$this->db->select('*');
		$this->db->from('tbl_state');
		$this->db->order_by('state_name');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_vendor_related_items($vendor_id){
		$query=$this->db
		->select('tbl_product.product_name')
		->join('tbl_purchase','tbl_purchase.product_id_fk=tbl_product.product_id','left')
		->where('tbl_purchase.vendor_id_fk',$vendor_id)
		->group_by('tbl_product.product_name')
		->get('tbl_product');
		return $query->num_rows()>0 ? $query->result() : false;
	}

	public function get_products(){
		$query=$this->db->select('*')->get('tbl_product');
		return $query->num_rows()>0 ? $query->result() : false;
	}

	public function get_item_based_vendors($item_id){
		$query=$this->db->select('*')
		->join('tbl_vendor','tbl_vendor.vendor_id=tbl_purchase.vendor_id_fk','left')
		->group_by('tbl_purchase.vendor_id_fk')
		->where('product_id_fk',$item_id)
		->get('tbl_purchase');
		return $query->num_rows()>0 ? $query->result() : 0;
	}
}
?>
