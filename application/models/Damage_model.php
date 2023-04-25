<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Damage_model extends CI_Model{
    public function __construct()
    {
        parent::__construct();
    }
    public function getClassinfoTable($param,$branch_id_fk){
        $arOrder = array('','product_name');
        $searchValue =($param['searchValue'])?$param['searchValue']:'';
        $item_name = ($param['product_id_fk'])?$param['product_id_fk']:'';
        if($searchValue){
            $this->db->like('product_name', $searchValue);
        }
        if($item_name){
            $this->db->where('product_id', $item_name);
          //  $this->db->or_like('product_code', $item_name);
        }

        if(!empty($branch_id_fk) && $branch_id_fk != 0)
        {
            $this->db->where("branch_id_fk",$branch_id_fk);
        }
        else
        {
            $this->db->where("branch_id_fk",0);
        }
       
        if ($param['start'] != 'false' and $param['length'] != 'false') {
            $this->db->limit($param['length'],$param['start']);
        }
        $this->db->select('*,date_format(damage_date,\'%d/%m/%Y\') as damage_date');
        $this->db->from('tbl_damage');
        $this->db->join('tbl_product','product_id=damage_item_id_fk');
        $this->db->join('tbl_unit','tbl_unit.unit_id=damage_unit','left');
        $this->db->where('damage_status',1);
        $this->db->where("product_status",1);
        $this->db->order_by('product_id','ASC');
        $query = $this->db->get();
        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getClassinfoTotalCount($param,$branch_id_fk);
        $data['recordsFiltered'] = $this->getClassinfoTotalCount($param,$branch_id_fk);
        return $data;
    }
    public function getClassinfoTotalCount($param = NULL,$branch_id_fk){
        $searchValue =($param['searchValue'])?$param['searchValue']:'';
        $item_name = ($param['product_id_fk'])?$param['product_id_fk']:'';
        if($searchValue){
            $this->db->like('product_name', $searchValue);
        }
        if($item_name){
            $this->db->where('product_id', $item_name);
          //  $this->db->or_like('product_code', $item_name);
        }
        $this->db->from('tbl_damage');
        $this->db->join('tbl_product','product_id=damage_item_id_fk');
        $this->db->join('tbl_unit','tbl_unit.unit_id=damage_unit','left');
        $this->db->where('damage_status',1);
        $this->db->where("product_status",1);
        $this->db->order_by('product_id','ASC');
        
        if(!empty($branch_id_fk) && $branch_id_fk != 0)
        {
            $this->db->where("branch_id_fk",$branch_id_fk);
        }
        else
        {
            $this->db->where("branch_id_fk",0);
        }
       
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
        $this->db->select('*');
		$this->db->from('tbl_product');
        $this->db->join('tbl_unit','tbl_unit.unit_id=product_unit','left');
		$this->db->where('product_status', 1);
		$this->db->where('product_id', $id);
		$q = $this->db->get();

		if ($q->num_rows() > 0) {

			return $q->row();
		}

		return false;
    }

    function get_prodstk($prid)
	{
		$this->db->select('*');
		$this->db->from('tbl_product');
		$this->db->where('product_id',$prid);
        $q = $this->db->get();

		if ($q->num_rows() > 0) {

			return $q->row();
		}

		return false;

	}

    public function get_invc($damage_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_damage');
        $this->db->join('tbl_product','product_id=damage_product_id_fk');
		$this->db->where('damage_status', 1);
		$this->db->where('damage_id', $damage_id);
		$query = $this->db->get();
		return $query->result();
	}
   

  
}
?>
