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

	public function getvoucher($voucher_id)
	{
		$this->db->select('*,DATE_FORMAT(voucher_date,\'%d/%m/%Y\')as voucher_date');
		$this->db->from('tbl_vendor_voucher');
		$this->db->join('tbl_vendor','tbl_vendor.vendor_id=tbl_vendor_voucher.vendor_id_fk');
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

			
	public function view_by_shareholder($branch_id_fk)
	{
		$status=1;
		$this->db->select('*');
		$this->db->from('tbl_member');
		$this->db->where('member_status', $status);
		$this->db->where('member_type', 1);
		if(!empty($branch_id_fk) && $branch_id_fk != 0)
        {
            $this->db->where("member_branch_id_fk",$branch_id_fk);
        }
        else
        {
            $this->db->where("member_branch_id_fk",0);
        }
		$query = $this->db->get();
		return $query->result();
	}

	public function view_by_shareholder_vendor($branch_id_fk)
	{
		$status=1;
		$this->db->select('*');
		$this->db->from('tbl_vendor');
		$this->db->where('vendorstatus', $status);
		$this->db->where('vendortype', 2);
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

	public function get_shareholder_sale_report($cdate,$edate,$shareholder_id_fk)
	{
		$this->db->select('*,COUNT(invoice_number) as slcount,SUM(sale_netamt) as total,sum(sale_quantity) as qty,(total_price-(sale_discount+sale_shareholder_discount)) as tprice,tbl_sale.sale_discount as discount');
		$this->db->from('tbl_sale');
		$this->db->join('tbl_product','product_id_fk=product_id');
		$this->db->join('tbl_branch','branch_id_fk=branch_id','left');
		$this->db->where('sale_date >=', $cdate);
		$this->db->where('sale_date <=', $edate);
		$this->db->where('member_id_fk', $shareholder_id_fk);
		$this->db->where('sale_status', 1);
		//$this->db->where('sale_branch_id_fk', 0);
		$this->db->order_by('sale_date',"ASC");
		$this->db->group_by('invoice_number');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_shareholder_purchase_report($cdate,$edate,$shareholder_id_fk)
	{
		$this->db->select('*,COUNT(invoice_number) as slcount,SUM(total_price) as total,SUM(discount_price) as discount,SUM(purchase_netamt) as tprice,sum(purchase_quantity) as qty');
		$this->db->from('tbl_purchase');
		$this->db->join('tbl_product','product_id_fk=product_id');
		$this->db->join('tbl_branch','purchase_branch_id_fk=branch_id','left');
		$this->db->where('purchase_date >=', $cdate);
		$this->db->where('purchase_date <=', $edate);
		$this->db->where('vendor_id_fk', $shareholder_id_fk);
		$this->db->where('purchase_status', 1);
		//$this->db->where('sale_branch_id_fk', 0);
		$this->db->order_by('purchase_date',"ASC");
		$this->db->group_by('invoice_number');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_shareholder_incent_report($cdate,$edate,$shareholder_id_fk)
	{
		$this->db->select('*');
		$this->db->from('tbl_incentive');
		$this->db->where('incent_date >=', $cdate);
		$this->db->where('incent_date <=', $edate);
		$this->db->where('incent_member_id_fk', $shareholder_id_fk);
		$this->db->where('incent_status', 1);
	//	$this->db->where('incent_branch_id_fk', 0);
		$q = $this->db->get();
		return $q->result();
	/* 	if($q->num_rows() > 0)
        {
            return $q->row();
        }
        return false; */
	}


	public function getIncentiveTable($param,$branch_id_fk){
		$arOrder = array('','class');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
         if($searchValue){
            $this->db->like('member_name', $searchValue); 
        }
        if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		
		$this->db->select('*,date_format(incent_date,\'%d/%m/%Y\') as incent_date');
		$this->db->from('tbl_incentive');
		$this->db->join('tbl_member','member_id=incent_member_id_fk');
		if(!empty($branch_id_fk) && $branch_id_fk != 0)
        {
            $this->db->where("incent_branch_id_fk",$branch_id_fk);
        }
        else
        {
            $this->db->where("incent_branch_id_fk",0);
        }
		$this->db->where("incent_status",1);
		$this->db->where("member_type",1);
        $query = $this->db->get();
		
        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getIncentiveTableTotalCount($param,$branch_id_fk);
        $data['recordsFiltered'] = $this->getIncentiveTableTotalCount($param,$branch_id_fk);
        return $data;

	}
	public function getIncentiveTableTotalCount($param = NULL,$branch_id_fk){

		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('member_name', $searchValue); 
        }
		
		$this->db->select('*');
		$this->db->from('tbl_incentive');
		$this->db->join('tbl_member','member_id=incent_member_id_fk');
		if(!empty($branch_id_fk) && $branch_id_fk != 0)
        {
            $this->db->where("incent_branch_id_fk",$branch_id_fk);
        }
        else
        {
            $this->db->where("incent_branch_id_fk",0);
        }
		$this->db->where("incent_status",1);
		$this->db->where("member_type",1);
        $query = $this->db->get();
    	return $query->num_rows();
    }
		
}

?>