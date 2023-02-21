<?php
Class Customer_model extends CI_Model{

	public function getCustomerTable($param){
		$arOrder = array('','custname');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('custname', $searchValue);
						$this->db->or_like('custaddress', $searchValue);
        }
        $this->db->where("custstatus",1);
		// $this->db->where("cust_project_id_fk",$prid);
        if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*,date_format(custdate, "%d/%m/%Y") AS cust_date');
		$this->db->from('tbl_customer');
		$this->db->order_by('cust_id', 'DESC');
        $query = $this->db->get();

        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getCustomerTotalCount($param);
        $data['recordsFiltered'] = $this->getCustomerTotalCount($param);
        return $data;

	}
	public function getCustomerTotalCount($param = NULL){

		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('custname', $searchValue);
        }
		$this->db->select('*');
		$this->db->from('tbl_customer');
		$this->db->order_by('cust_id', 'DESC');
        $this->db->where("custstatus",1);
       //  $this->db->where("cust_project_id_fk",$prid);
        $query = $this->db->get();
    	return $query->num_rows();
    }
	public function view_by()
	{
		$status=1;
		$this->db->select('*');
		$this->db->from('tbl_customer');
		$this->db->where('custstatus', $status);
		// $this->db->where("cust_project_id_fk",$prid);
		$this->db->order_by('custname');
		$query = $this->db->get();
		return $query->result();
		// $customer_names = array();
		// if ($query -> result()) {
		// foreach ($query->result() as $customer_name) {
		// $customer_names[$customer_name-> cust_id] = $customer_name -> custname;
		// 	}
		// return $customer_names;
		// } else {
		// return FALSE;
		// }
	}
}

?>
