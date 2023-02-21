<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Item_model extends CI_Model{
	public function __construct()
    {
        parent::__construct();
    }
	public function view_by()
	{
		$status=1;
		$this->db->select('*');
		$this->db->from('tbl_product');
		$this->db->where('product_status', $status);
		$this->db->where('product_category', 1);
		$this->db->order_by('product_name', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}

	public function view_by1()
	{
		$status=1;
		$this->db->select('*');
		$this->db->from('tbl_product');
		$this->db->where('product_status', $status);
		$this->db->where('product_category', 2);
		$this->db->order_by('product_name', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}

	public function view()
	{
		$status=1;
		$this->db->select('*');
		$this->db->from('tbl_product');
		$this->db->where('product_status', $status);
		$this->db->order_by('product_name', 'ASC');
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
