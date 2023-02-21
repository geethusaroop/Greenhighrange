<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class ProductTransfer_model extends CI_Model{
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
       
        if ($param['start'] != 'false' and $param['length'] != 'false') {
            $this->db->limit($param['length'],$param['start']);
        }
        $this->db->select('*,date_format(punit_date,\'%d/%m/%Y\') as punit_date');
        $this->db->from('tbl_production_unit');
        $this->db->join('tbl_product','product_id=punit_product_id_fk');
        $this->db->join('tbl_unit','tbl_unit.unit_id=punit_unit','left');
        $this->db->where('punit_status',1);
        $this->db->where("product_status",1);
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
        $this->db->from('tbl_production_unit');
        $this->db->join('tbl_product','product_id=punit_product_id_fk');
        $this->db->join('tbl_unit','tbl_unit.unit_id=punit_unit','left');
        $this->db->where('punit_status',1);
        $this->db->where("product_status",1);
        $this->db->order_by('product_id','ASC');
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

    public function getpstock($id)
    {
        $this->db->select('*')->from('tbl_product');
        $this->db->join('tbl_unit','tbl_unit.unit_id=product_unit','left');
        $this->db->where('product_id',$id);
        $this->db->where('product_status',1);
        $query = $this->db->get();
        return $query->row();
    }
   
}
?>