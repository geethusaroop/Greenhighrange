<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class BStock_model extends CI_Model{
    public function __construct()
    {
        parent::__construct();
    }
    public function getClassinfoTable($param){
        $arOrder = array('','product_name');
        $searchValue =($param['searchValue'])?$param['searchValue']:'';
        
        if($searchValue){
            $this->db->like('product_name', $searchValue);
        }
      
        $this->db->where("product_status",1);
        if ($param['start'] != 'false' and $param['length'] != 'false') {
            $this->db->limit($param['length'],$param['start']);
        }
        $branch = ($param['branch'])?$param['branch']:'';
        if($branch)
        {
            $this->db->where("branch_id_fk",$branch);
        }
       
        $this->db->select('*');
        $this->db->from('tbl_product');
        $this->db->join('tbl_branch','tbl_branch.branch_id=tbl_product.branch_id_fk');
        $this->db->join('tbl_unit','tbl_unit.unit_id=tbl_product.product_unit','left');
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
        $branch = ($param['branch'])?$param['branch']:'';
        if($branch)
        {
            $this->db->where("branch_id_fk",$branch);
        }
        $this->db->select('*');
        $this->db->from('tbl_product');
        $this->db->join('tbl_unit','tbl_unit.unit_id=tbl_product.product_unit','left');
        $this->db->join('tbl_branch','tbl_branch.branch_id=tbl_product.branch_id_fk');
        $this->db->where('product_status',1);
        $this->db->where('product_category',1);
        $this->db->order_by('product_id','DESC');
        $query = $this->db->get();
        return $query->num_rows();
    }

}
?>
