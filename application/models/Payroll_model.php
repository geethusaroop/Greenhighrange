<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Payroll_model extends CI_Model{
	public function __construct()
    {
        parent::__construct();
    }
	public function getPayrollReport($param){
        $arOrder = array('','payroll_empname');
        $searchValue =($param['searchValue'])?$param['searchValue']:'';
        $month =(isset($param['month']))?$param['month']:'';
        
		if($month){
			$this->db->where('sal_month', $month); 
        }
        if($searchValue){
            $this->db->like('emp_name', $searchValue); 
        }
		$this->db->where("payroll_status",1);
		
        if ($param['start'] != 'false' and $param['length'] != 'false') {
            $this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*,DATE_FORMAT(payroll_salarydate,\'%d/%m/%Y\')as payroll_salarydate');
		$this->db->from('tbl_payroll');
		$this->db->join('tbl_employee','emp_id = emp_id_fk');
		$this->db->order_by('payroll_id', 'DESC');
        $query = $this->db->get();
        
		$data['data'] = $query->result();
        $data['recordsTotal'] = $this->getPayrollReportTotalCount($param);
        $data['recordsFiltered'] = $this->getPayrollReportTotalCount($param);
        return $data;
	}
	public function getPayrollReportTotalCount($param){
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        $payroll_empname =(isset($param['payroll_empname']))?$param['payroll_empname']:'';
		if($payroll_empname){
            $this->db->like('payroll_empname', $payroll_empname); 
        }
         if($searchValue){
            $this->db->like('emp_name', $searchValue); 
        }
		$this->db->where("payroll_status",1);
		$this->db->select('*');
		$this->db->from('tbl_payroll');
		$this->db->join('tbl_employee','emp_id = emp_id_fk');
		$this->db->order_by('payroll_id', 'DESC');
        $query = $this->db->get();
		return $query->num_rows();
	}
	function get_values($emp_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_employee');
		$this->db->where("emp_id", $emp_id);
        $query = $this->db->get();
    	return $query->row();
	}
	function get_leaves($emp_id,$month,$year)
	{
		$this->db->select('COUNT(absent_date) AS total_days');
		$this->db->from('tbl_employee');
		$this->db->join('tbl_empabsent','emp_id_fk = emp_id');
		$this->db->where("emp_id", $emp_id);
		$this->db->where("MONTH(absent_date)", $month);
		$this->db->where("YEAR(absent_date)", $year);
        $query = $this->db->get();
    	return $query->result();
	}
	function get_Sickleaves($emp_id,$month,$year)
	{
		$this->db->select('*,COUNT(sick_date) AS total_days');
		$this->db->from('tbl_employee');
		$this->db->join('tbl_sickleave','emp_id_fk = emp_id');
		$this->db->where("emp_id", $emp_id);
		$this->db->where("MONTH(sick_date)", $month);
		$this->db->where("YEAR(sick_date)", $year);
        $query = $this->db->get();
    	return $query->result();
	}
	function get_Halfleaves($emp_id,$month,$year)
	{
		$this->db->select('*,COUNT(half_date) AS total_days');
		$this->db->from('tbl_employee');
		$this->db->join('tbl_halfleave','emp_id_fk = emp_id');
		$this->db->where("emp_id", $emp_id);
		$this->db->where("MONTH(half_date)", $month);
		$this->db->where("YEAR(half_date)", $year);
        $query = $this->db->get();
    	return $query->result();
	}
	public function get_data($payroll_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_payroll');
		$this->db->join('tbl_employee','emp_id = emp_id_fk');
		//$this->db->join('tbl_overtime','emp_id_fk = emp_id_fk');
		//$this->db->join('tbl_designation','d_id = tbl_staff.desig_id_fk');
		$this->db->where("payroll_id",$payroll_id);
        $query = $this->db->get();
    	return $query->row();
	}
	public function leav_details($staff_id,$month,$year)
	{
		$this->db->select('*');
		$this->db->from('tbl_leave');
		$this->db->where("staff_id_fk",$staff_id);
		$this->db->where('leavtype_id_fk',0);
		$this->db->where('YEAR(leave_from)', $year);
		$this->db->where('MONTH(leave_from)', $month);
		$this->db->where('YEAR(leave_to)', $year);
		$this->db->where('MONTH(leave_to)', $month);
        $query = $this->db->get();
    	return $query->row();
	}
	public function get_overtime($staff_id,$month,$year)
	{
		$this->db->select('*,SUM(total_amount) AS total_amount');
		$this->db->from('tbl_overtime');
		$this->db->where("emp_id_fk",$staff_id);
		$this->db->where('YEAR(overtym_date)', $year);
		$this->db->where('MONTH(overtym_date)', $month);
		$this->db->where('overtym_status',1);
        $query = $this->db->get();
		// print_r($this->db->last_query());
		// exit();
    	return $query->result();
	}
	public function get_advance($staff_id,$month,$year)
	{
		$this->db->select('*,SUM(adv_amount) AS adv_amount');
		$this->db->from('tbl_advancepayment');
		$this->db->where("emp_id_fk",$staff_id);
		$this->db->where('YEAR(adv_date)', $year);
		$this->db->where('MONTH(adv_date)', $month);
        $query = $this->db->get();
    	return $query->result();
	}
}
?>