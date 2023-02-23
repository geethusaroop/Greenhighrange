<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Routsale_model extends CI_Model{
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
        $this->db->select('*,date_format(routsale_date,\'%d/%m/%Y\') as routsale_date');
        $this->db->from('tbl_routsale');
        $this->db->join('tbl_product','product_id=routsale_product_id_fk');
      //  $this->db->join('tbl_unit','tbl_unit.unit_id=routsale_unit','left');
        $this->db->where('routsale_status',1);
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
        $this->db->from('tbl_routsale');
        $this->db->join('tbl_product','product_id=routsale_product_id_fk');
       // $this->db->join('tbl_unit','tbl_unit.unit_id=routsale_unit','left');
        $this->db->where('routsale_status',1);
        $this->db->where("product_status",1);
        $this->db->order_by('product_id','ASC');
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
        $sdate = ($param['sdate'])?$param['sdate']:'';
        if($sdate){
            $this->db->where('routsale_date', $sdate);
        }
       
        if ($param['start'] != 'false' and $param['length'] != 'false') {
            $this->db->limit($param['length'],$param['start']);
        }
        $this->db->select('*,(routsale_stock-routsale_sale_count)as product_stock');
        $this->db->from('tbl_routsale');
        $this->db->join('tbl_product','product_id=routsale_product_id_fk');
      //  $this->db->join('tbl_unit','tbl_unit.unit_id=routsale_unit','left');
        $this->db->where('routsale_status',1);
        $this->db->where("product_status",1);
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
        $sdate = ($param['sdate'])?$param['sdate']:'';
        if($sdate){
            $this->db->where('routsale_date', $sdate);
        }
       
        $this->db->from('tbl_routsale');
        $this->db->join('tbl_product','product_id=routsale_product_id_fk');
       // $this->db->join('tbl_unit','tbl_unit.unit_id=routsale_unit','left');
        $this->db->where('routsale_status',1);
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

    public function return_stock()
    {
        $date=date('Y-m-d');
        $this->db->select('*,date_format(routsale_date,\'%d/%m/%Y\') as routsale_dates');
        $this->db->from('tbl_routsale');
        $this->db->join('tbl_product','product_id=routsale_product_id_fk');
        $this->db->where('routsale_status',1);
        $this->db->where('routsale_return_status',0);
        $this->db->where('routsale_date',$date);
        $this->db->where("product_status",1);
        $this->db->order_by('product_id','ASC');
        $query = $this->db->get();
        return $query->result();
    }

    ####################################return stock##################################################
    public function getClassinfoTablereturn($param,$date){
        $arOrder = array('','product_name');
        $searchValue =($param['searchValue'])?$param['searchValue']:'';
        $item_name = ($param['item_name'])?$param['item_name']:'';
        $sdate = ($param['sdate'])?$param['sdate']:'';
        if($searchValue){
            $this->db->like('product_name', $searchValue);
        }
        if($item_name){
            $this->db->like('product_name', $item_name);
            $this->db->or_like('product_code', $item_name);
        }

        if($sdate){
            $this->db->where('routsale_return_date', $sdate);
        }
       
        if ($param['start'] != 'false' and $param['length'] != 'false') {
            $this->db->limit($param['length'],$param['start']);
        }
        $this->db->select('*,(routsale_stock-routsale_sale_count)as product_stock');
        $this->db->from('tbl_routsale');
        $this->db->join('tbl_product','product_id=routsale_product_id_fk');
        $this->db->where('routsale_status',1);
        $this->db->where('routsale_return_status',1);
        $this->db->where("product_status",1);
        $this->db->where("routsale_date",$date);
        $this->db->order_by('product_id','ASC');
        $query = $this->db->get();
        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getClassinfoTotalCountR1($param,$date);
        $data['recordsFiltered'] = $this->getClassinfoTotalCountR1($param,$date);
        return $data;
    }
    public function getClassinfoTotalCountR1($param = NULL,$date){
        $searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('product_name', $searchValue);
        }
        $sdate = ($param['sdate'])?$param['sdate']:'';
        if($sdate){
            $this->db->where('routsale_return_date', $sdate);
        }
       
        $this->db->from('tbl_routsale');
        $this->db->join('tbl_product','product_id=routsale_product_id_fk');
       // $this->db->join('tbl_unit','tbl_unit.unit_id=routsale_unit','left');
       $this->db->where("routsale_date",$date);
        $this->db->where('routsale_status',1);
        $this->db->where("product_status",1);
        $this->db->where('routsale_return_status',1);
        $this->db->order_by('product_id','ASC');
        $query = $this->db->get();
        return $query->num_rows();
    }
   
}
?>
