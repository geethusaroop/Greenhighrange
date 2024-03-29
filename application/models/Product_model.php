<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Product_model extends CI_Model{
    public function __construct()
    {
        parent::__construct();
    }
    public function getClassinfoTable($param,$branch_id_fk){
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
        if(!empty($branch_id_fk) && $branch_id_fk != 0)
        {
            $this->db->where("branch_id_fk",$branch_id_fk);
        }
        else
        {
            $this->db->where("branch_id_fk",0);
        }
        //$query=$this->db->select('*')->join('tbl_unit','tbl_unit.unit_id=tbl_product.product_unit','left')->order_by('tbl_product.product_id','DESC')->get('tbl_product');
        $this->db->select('*');
        $this->db->from('tbl_product');
        $this->db->join('tbl_unit','tbl_unit.unit_id=tbl_product.product_unit','left');
        //$this->db->join('tbl_product_category','tbl_product_category.prod_cat_id=tbl_product.product_type','left');
        //$this->db->join('tbl_subcategories','tbl_subcategories.subcat_id=tbl_product.product_sub_type','left');
        $this->db->where('product_status',1);
       // $this->db->where('product_category',1);
        $this->db->order_by('product_id','ASC');
        $query = $this->db->get();
        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getClassinfoTotalCount($param,$branch_id_fk);
        $data['recordsFiltered'] = $this->getClassinfoTotalCount($param,$branch_id_fk);
        return $data;
    }
    public function getClassinfoTotalCount($param = NULL,$branch_id_fk){
        $searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('product_name', $searchValue);
        }
        $this->db->select('*');
        $this->db->from('tbl_product');
        $this->db->join('tbl_unit','tbl_unit.unit_id=tbl_product.product_unit','left');
      //  $this->db->join('tbl_product_category','tbl_product_category.prod_cat_id=tbl_product.product_type','left');
        $this->db->where('product_status',1);
      //  $this->db->where('product_category',1);
        if(!empty($branch_id_fk) && $branch_id_fk != 0)
        {
            $this->db->where("branch_id_fk",$branch_id_fk);
        }
        else
        {
            $this->db->where("branch_id_fk",0);
        }
        $this->db->order_by('product_id','DESC');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getClassinfoTable1($param,$branch_id_fk){
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
        if(!empty($branch_id_fk) && $branch_id_fk != 0)
        {
            $this->db->where("branch_id_fk",$branch_id_fk);
        }
        else
        {
            $this->db->where("branch_id_fk",0);
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
        $data['recordsTotal'] = $this->getClassinfoTotalCount1($param,$branch_id_fk);
        $data['recordsFiltered'] = $this->getClassinfoTotalCount1($param,$branch_id_fk);
        return $data;
    }
    public function getClassinfoTotalCount1($param = NULL,$branch_id_fk){
        $searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('product_name', $searchValue);
        }
        $this->db->select('*');
        $this->db->from('tbl_product');
        $this->db->join('tbl_unit','tbl_unit.unit_id=tbl_product.product_unit','left');
      //  $this->db->join('tbl_product_category','tbl_product_category.prod_cat_id=tbl_product.product_type','left');
        if(!empty($branch_id_fk) && $branch_id_fk != 0)
        {
            $this->db->where("branch_id_fk",$branch_id_fk);
        }
        else
        {
            $this->db->where("branch_id_fk",0);
        }
        $this->db->where('product_status',1);
        $this->db->where('product_category',2);
        $this->db->order_by('product_id','DESC');
        $query = $this->db->get();
        return $query->num_rows();
    }

    ##################################################################################################
    public function getBranchreturninfoTable($param,$branch_id_fk){
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
       
        if ($param['start'] != 'false' and $param['length'] != 'false') {
            $this->db->limit($param['length'],$param['start']);
        }
        if(!empty($branch_id_fk) && $branch_id_fk != 0)
        {
            $this->db->where("return_branch_id_fk",$branch_id_fk);
        }
        else
        {
            $this->db->where("return_branch_id_fk",0);
        }
        $this->db->select('*');
        $this->db->from('tbl_branch_return');
        $this->db->join('tbl_product','tbl_product.product_id=tbl_branch_return.return_product_id_fk');
        $this->db->join('tbl_unit','tbl_unit.unit_id=tbl_product.product_unit','left');
        $this->db->where("product_status",1);
        $this->db->where("return_status",1);
        $this->db->order_by('return_date','ASC');
        $query = $this->db->get();
        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getBranchreturninfoTotalCount($param,$branch_id_fk);
        $data['recordsFiltered'] = $this->getBranchreturninfoTotalCount($param,$branch_id_fk);
        return $data;
    }
    public function getBranchreturninfoTotalCount($param = NULL,$branch_id_fk){
        $searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('product_name', $searchValue);
        }
        if(!empty($branch_id_fk) && $branch_id_fk != 0)
        {
            $this->db->where("return_branch_id_fk",$branch_id_fk);
        }
        else
        {
            $this->db->where("return_branch_id_fk",0);
        }
        $this->db->select('*');
        $this->db->from('tbl_branch_return');
        $this->db->join('tbl_product','tbl_product.product_id=tbl_branch_return.return_product_id_fk');
        $this->db->join('tbl_unit','tbl_unit.unit_id=tbl_product.product_unit','left');
        $this->db->where("product_status",1);
        $this->db->where("return_status",1);
        $this->db->order_by('return_date','ASC');
        $query = $this->db->get();
        return $query->num_rows();
    }




    #####################################################################################################

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
