<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Item_model extends CI_Model{
	public function __construct()
    {
        parent::__construct();
    }
	public function view_by($branch_id_fk)
	{
		$status=1;
		$this->db->select('*');
		$this->db->from('tbl_product');
		$this->db->where('product_status', $status);
		$this->db->where('product_category', 1);
		$this->db->order_by('product_name', 'ASC');
		if(!empty($branch_id_fk) && $branch_id_fk != 0)
        {
            $this->db->where("branch_id_fk",$branch_id_fk);
        }
        else
        {
            $this->db->where("branch_id_fk",0);
        }
		$query = $this->db->get();
		return $query->result();
	}

	public function view_by1($branch_id_fk)
	{
		$status=1;
		$this->db->select('*');
		$this->db->from('tbl_product');
		$this->db->where('product_status', $status);
		$this->db->where('product_category', 2);
		$this->db->order_by('product_name', 'ASC');
		if(!empty($branch_id_fk) && $branch_id_fk != 0)
        {
            $this->db->where("branch_id_fk",$branch_id_fk);
        }
        else
        {
            $this->db->where("branch_id_fk",0);
        }
		$query = $this->db->get();
		return $query->result();
	}

	public function view($branch_id_fk)
	{
		$status=1;
		$this->db->select('*');
		$this->db->from('tbl_product');
		$this->db->where('product_status', $status);
		$this->db->order_by('product_name', 'ASC');
		if(!empty($branch_id_fk) && $branch_id_fk != 0)
        {
            $this->db->where("branch_id_fk",$branch_id_fk);
        }
        else
        {
            $this->db->where("branch_id_fk",0);
        }
		$query = $this->db->get();
		return $query->result();
	}

	public function view_unit()
	{
		$status=1;
		$this->db->select('*');
		$this->db->from('tbl_unit');
		$this->db->where('unit_status', $status);
		$query = $this->db->get();
		return $query->result();
	}
}
?>
