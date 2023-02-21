<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Product_model extends CI_Model{
    public function __construct()
    {
        parent::__construct();
    }
    public function getClassinfoTable($param){
        $arOrder = array('','product_name');
        $searchValue =($param['searchValue'])?$param['searchValue']:'';
        $item_name = ($param['item_name'])?$param['item_name']:'';
        if($searchValue){
            $this->db->like('product_name', $searchValue);
        }
        if($item_name){
            $this->db->like('product_name', $item_name);
            $this->db->or_like('product_code', $item_name);
        }
        $this->db->where("product_status",1);
        if ($param['start'] != 'false' and $param['length'] != 'false') {
            $this->db->limit($param['length'],$param['start']);
        }
        //$query=$this->db->select('*')->join('tbl_unit','tbl_unit.unit_id=tbl_product.product_unit','left')->order_by('tbl_product.product_id','DESC')->get('tbl_product');
        $this->db->select('*');
        $this->db->from('tbl_product');
        $this->db->join('tbl_unit','tbl_unit.unit_id=tbl_product.product_unit','left');
        //$this->db->join('tbl_product_category','tbl_product_category.prod_cat_id=tbl_product.product_type','left');
        //$this->db->join('tbl_subcategories','tbl_subcategories.subcat_id=tbl_product.product_sub_type','left');
        $this->db->where('product_status',1);
        $this->db->where('product_category',1);
        $this->db->order_by('product_id','ASC');
        $query = $this->db->get();
        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getClassinfoTotalCount($param);
        $data['recordsFiltered'] = $this->getClassinfoTotalCount($param);
        return $data;
    }
    public function getClassinfoTotalCount($param = NULL){
        $searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('product_name', $searchValue);
        }
        $this->db->select('*');
        $this->db->from('tbl_product');
        $this->db->join('tbl_unit','tbl_unit.unit_id=tbl_product.product_unit','left');
      //  $this->db->join('tbl_product_category','tbl_product_category.prod_cat_id=tbl_product.product_type','left');
        $this->db->where('product_status',1);
        $this->db->where('product_category',1);
        $this->db->order_by('product_id','DESC');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getClassinfoTable1($param){
        $arOrder = array('','product_name');
        $searchValue =($param['searchValue'])?$param['searchValue']:'';
        $item_name = ($param['item_name'])?$param['item_name']:'';
        if($searchValue){
            $this->db->like('product_name', $searchValue);
        }
        if($item_name){
            $this->db->like('product_name', $item_name);
            $this->db->or_like('product_code', $item_name);
        }
        $this->db->where("product_status",1);
        if ($param['start'] != 'false' and $param['length'] != 'false') {
            $this->db->limit($param['length'],$param['start']);
        }
        //$query=$this->db->select('*')->join('tbl_unit','tbl_unit.unit_id=tbl_product.product_unit','left')->order_by('tbl_product.product_id','DESC')->get('tbl_product');
        $this->db->select('*');
        $this->db->from('tbl_product');
        $this->db->join('tbl_unit','tbl_unit.unit_id=tbl_product.product_unit','left');
        //$this->db->join('tbl_product_category','tbl_product_category.prod_cat_id=tbl_product.product_type','left');
        //$this->db->join('tbl_subcategories','tbl_subcategories.subcat_id=tbl_product.product_sub_type','left');
        $this->db->where('product_status',1);
        $this->db->where('product_category',2);
        $this->db->order_by('product_id','ASC');
        $query = $this->db->get();
        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getClassinfoTotalCount1($param);
        $data['recordsFiltered'] = $this->getClassinfoTotalCount1($param);
        return $data;
    }
    public function getClassinfoTotalCount1($param = NULL){
        $searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('product_name', $searchValue);
        }
        $this->db->select('*');
        $this->db->from('tbl_product');
        $this->db->join('tbl_unit','tbl_unit.unit_id=tbl_product.product_unit','left');
      //  $this->db->join('tbl_product_category','tbl_product_category.prod_cat_id=tbl_product.product_type','left');
        $this->db->where('product_status',1);
        $this->db->where('product_category',2);
        $this->db->order_by('product_id','DESC');
        $query = $this->db->get();
        return $query->num_rows();
    }

    function get_unit(){
        $status=1;
        $this->db->select('*');
        $this->db->from('tbl_unit');
        $this->db->where('unit_status', $status);
        $this->db->order_by('unit_id');
        $query = $this->db->get();
        return $query->result();
    }
    public function getCategoryInfoTable($param)
    {
        $searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('prod_cat_name', $searchValue);
        }
        if ($param['start'] != 'false' and $param['length'] != 'false') {
            $this->db->limit($param['length'],$param['start']);
        }
        $this->db->select('*');
        $this->db->from('tbl_product_category');
        $this->db->where('prod_cat_status',1);
        $query = $this->db->get();
        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getCategoryInfoTableCount($param);
        $data['recordsFiltered'] = $this->getCategoryInfoTableCount($param);
        return $data;
    }
    public function getCategoryInfoTableCount($param = NULL){
        $searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('product_name', $searchValue);
        }
        $this->db->select('*');
        $this->db->from('tbl_product_category');
        $this->db->where("prod_cat_status",1);
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function get__category()
    {
        $this->db->select('prod_cat_id,prod_cat_name');
        $this->db->from('tbl_product_category');
        $this->db->where("prod_cat_status",1);
        $query = $this->db->get();
        return $query->result();
    }
    public function gethsncode($id)
    {
        $this->db->select('*')->from('tbl_hsncode');
        $this->db->like('hsn_id',$id);
        $this->db->where('hsn_status',1);
        $query = $this->db->get();
        return $query->row();
    }
    #######################JISHNU#########################################
    public function get_products(){
        $query=$this->db->select('*')->get('tbl_product');
        return $query->num_rows()>0 ? $query->result() : false;
    }

    public function get_subcategories(){
      $query=$this->db->select('*')->get('tbl_subcategories');
      return $query->num_rows()>0 ? $query->result(): false;
    }
    #######################################################################
}
?>
