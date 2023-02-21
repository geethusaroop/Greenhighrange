<?php
Class Voucher_model extends CI_Model{
	public function getSupplierTable($param,$gid){
		$arOrder = array('','class');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
		if($searchValue){
            $this->db->like('tbl_vouchhead.vouch_head', $searchValue); 
        }
        
        if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*,DATE_FORMAT(voucher_date,\'%d/%m/%Y\')as voucher_date');
		$this->db->from('tbl_voucher');
		$this->db->join('tbl_vouchhead','vouch_id = vouch_id_fk');
		$this->db->order_by('voucher_id', 'ASC');
		$this->db->where("voucher_status",1);
		$this->db->where("voucher_group",$gid);
        $query = $this->db->get();
		
        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getSupplierTotalCount($param,$gid);
        $data['recordsFiltered'] = $this->getSupplierTotalCount($param,$gid);
        return $data;
	}
	public function getSupplierTotalCount($param = NULL,$gid){
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('tbl_vouchhead.vouch_head', $searchValue); 
        }
		$this->db->select('*,DATE_FORMAT(voucher_date,\'%d/%m/%Y\')as voucher_date');
		$this->db->from('tbl_voucher');
		$this->db->join('tbl_vouchhead','vouch_id = vouch_id_fk');
		$this->db->order_by('voucher_id', 'ASC');
		$this->db->where("voucher_status",1);
		$this->db->where("voucher_group",$gid);
        $query = $this->db->get();
    	return $query->num_rows();
    }
	public function get_vouchhead($vouch_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_vouchhead');
		$this->db->where("vouch_id",$vouch_id);
        $query = $this->db->get();
    	return $query->result();
	}
	public function head($h_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_vouchhead');
		$this->db->where("vouch_id",$h_id);
        $query = $this->db->get();
    	return $query->result();
	}
		public function getSupplierTables($param){
		$arOrder = array('','class');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
		if($searchValue){
            $this->db->like('tbl_vouchhead.vouch_head', $searchValue); 
        }
        
        if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*,DATE_FORMAT(voucher_date,\'%d/%m/%Y\')as voucher_date');
		$this->db->from('tbl_voucher');
		$this->db->join('tbl_vouchhead','vouch_id = vouch_id_fk');
		$this->db->join('tbl_cag','cag_id = voucher_group');
		$this->db->order_by('voucher_id', 'ASC');
		$this->db->where("voucher_status",1);
		//$this->db->where("voucher_group",$gid);
        $query = $this->db->get();
		
        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getSuppliersTotalCount($param);
        $data['recordsFiltered'] = $this->getSuppliersTotalCount($param);
        return $data;
	}
	public function getSuppliersTotalCount($param = NULL){
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('tbl_vouchhead.vouch_head', $searchValue); 
        }
		$this->db->select('*,DATE_FORMAT(voucher_date,\'%d/%m/%Y\')as voucher_date');
		$this->db->from('tbl_voucher');
		$this->db->join('tbl_vouchhead','vouch_id = vouch_id_fk');
		$this->db->join('tbl_cag','cag_id = voucher_group');
		$this->db->order_by('voucher_id', 'ASC');
		$this->db->where("voucher_status",1);
		//$this->db->where("voucher_group",$gid);
        $query = $this->db->get();
    	return $query->num_rows();
    }
    public function getvoucherTable($param){
		$arOrder = array('','class');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
		if($searchValue){
            $this->db->like('tbl_project_vouchhead.vouch_head', $searchValue); 
        }
        
        if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*,DATE_FORMAT(voucher_date,\'%d/%m/%Y\')as voucher_date');
		$this->db->from('tbl_project_voucher');
		$this->db->join('tbl_project_vouchhead','vouch_id = vouch_id_fk');
		$this->db->order_by('voucher_id', 'ASC');
		$this->db->where("voucher_status",1);
		//$this->db->where("project_id_fk",$prid);
        $query = $this->db->get();
		
        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getvoucherTableTotalCount($param);
        $data['recordsFiltered'] = $this->getvoucherTableTotalCount($param);
        return $data;
	}
	public function getvoucherTableTotalCount($param = NULL){
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('tbl_project_vouchhead.vouch_head', $searchValue); 
        }
		$this->db->select('*,DATE_FORMAT(voucher_date,\'%d/%m/%Y\')as voucher_date');
		$this->db->from('tbl_project_voucher');
		$this->db->join('tbl_project_vouchhead','vouch_id = vouch_id_fk');
		$this->db->order_by('voucher_id', 'ASC');
		$this->db->where("voucher_status",1);
		//$this->db->where("project_id_fk",$prid);
        $query = $this->db->get();
    	return $query->num_rows();
    }
    	public function getvoucher($voucher_id)
	{
		$this->db->select('*,DATE_FORMAT(voucher_date,\'%d/%m/%Y\')as voucher_date');
		$this->db->from('tbl_project_voucher');
		$this->db->join('tbl_project_vouchhead','vouch_id = vouch_id_fk');
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