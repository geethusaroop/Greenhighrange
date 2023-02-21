<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Advancepayments_model extends CI_Model{

	public function __construct()
    {
        parent::__construct();
    }
    public function getCategoryTable($param){
		$arOrder = array('','emp_name');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('emp_name', $searchValue);
        }
        $this->db->where("adv_status",1);

        if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*,DATE_FORMAT(adv_date,\'%d/%m/%Y\') as adv_date');
		$this->db->from('tbl_advancepayment');
		$this->db->join('tbl_employee','emp_id = emp_id_fk');
		$this->db->order_by('adv_id', 'ASC');
        $query = $this->db->get();

        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getCategoryTotalCount($param);
        $data['recordsFiltered'] = $this->getCategoryTotalCount($param);
        return $data;

	}

	public function getCategoryTotalCount($param = NULL){

		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('emp_name', $searchValue);
        }
		$this->db->select('*');
		$this->db->from('tbl_advancepayment');
		$this->db->join('tbl_employee','emp_id = emp_id_fk');
        $this->db->where("adv_status",1);
		$this->db->order_by('adv_id', 'ASC');
        $query = $this->db->get();
    	return $query->num_rows();
    }

}
?>
