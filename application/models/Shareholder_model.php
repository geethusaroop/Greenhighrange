<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Shareholder_model extends CI_Model{
	public function __construct()
	{
		parent::__construct();
	}

	//shareholders list
	public function getshareholdersClassinfoTable($param,$branch_id_fk){
		$arOrder = array('','member_name');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
		$memberid	 =(isset($param['memberid']))?$param['memberid']:'';
		if($searchValue){
			$this->db->like('member_name', $searchValue);
		}
		if($memberid){
			$this->db->like('tbl_member.member_mid ', $memberid);
		}
		if(!empty($branch_id_fk) && $branch_id_fk != 0)
        {
            $this->db->where("member_branch_id_fk",$branch_id_fk);
        }
        else
        {
            $this->db->where("member_branch_id_fk",0);
        }
		$this->db->where("member_status",1);
		if ($param['start'] != 'false' and $param['length'] != 'false') {
			$this->db->limit($param['length'],$param['start']);
		}
		//$this->db->select('*,tbl_cag.cag_name,tbl_region.region_name,tbl_panchayath.panchayath_name,sum(tbl_deposit.deposit_amount) as depositsum');
		$this->db->select('*,DATE_FORMAT(m_created_at,\'%d/%m/%Y\') AS m_created_at,date_format(member_dob,"%d/%m/%Y") as member_dob');
		$this->db->from('tbl_member');
		$this->db->join('tbl_state','member_state= state_id','left');
		$this->db->join('tbl_district','member_district= district_id','left');
		$this->db->join('tbl_panchayath','member_panchayath= panchayath_id','left');
		$this->db->where("member_type",1);
		$this->db->group_by('member_id');
		$this->db->order_by('member_id', 'DESC');
		//$this->db->where("member_status",1);
		$query = $this->db->get();
		$data['data'] = $query->result();
		$data['recordsTotal'] = $this->getshareholdersClassinfoTotalCount($param,$branch_id_fk);
		$data['recordsFiltered'] = $this->getshareholdersClassinfoTotalCount($param,$branch_id_fk);
		return $data;
	}
	public function getshareholdersClassinfoTotalCount($param = NULL,$branch_id_fk){
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
		$memberid	 =(isset($param['memberid']))?$param['memberid']:'';
		if($searchValue){
			$this->db->like('member_name', $searchValue);
		}
		if($memberid){
			$this->db->or_like('tbl_member.member_mid ', $memberid);
			$this->db->or_like('tbl_member.member_name ', $memberid);
		}
		$this->db->select('*');
		$this->db->from('tbl_member');
		$this->db->where("member_status",1);
		$this->db->where("member_type",1);
		if(!empty($branch_id_fk) && $branch_id_fk != 0)
        {
            $this->db->where("member_branch_id_fk",$branch_id_fk);
        }
        else
        {
            $this->db->where("member_branch_id_fk",0);
        }
		$this->db->order_by('member_id', 'DESC');
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	function get_member(){
		$status=1;
		$this->db->select('*');
		$this->db->from('tbl_member');
		$this->db->where('member_status', $status);
		$this->db->order_by('member_id');
		$query = $this->db->get();
		return $query->result();
	}
	function get_state(){
		$status=1;
		$this->db->select('*');
		$this->db->from('tbl_state');
		$this->db->where('state_status', $status);
		$this->db->order_by('state_id');
		$query = $this->db->get();
		return $query->result();
	}
	function fetch_district($state){
		$this->db->select('*');
		$this->db->from('tbl_district');
		$this->db->where('district_status',1);
		$this->db->where('district_state_id_fk',$state);
		$query = $this->db->get();
		return $query;
	}
	function get_district(){
		$status=1;
		$this->db->select('*');
		$this->db->from('tbl_district');
		$this->db->where('district_status', $status);
		$this->db->order_by('district_name');
		$query = $this->db->get();
		return $query->result();
	}
	function fetch_panchayath($district){
		$this->db->select('*');
		$this->db->from('tbl_panchayath');
		$this->db->where('panchayath_status',1);
		$this->db->where('panchayath_district',$district);
		$query = $this->db->get();
		return $query;
	}
	function get_panchayath(){
		$status=1;
		$this->db->select('*');
		$this->db->from('tbl_panchayath');
		$this->db->where('panchayath_status', $status);
		$this->db->order_by('panchayath_name');
		$query = $this->db->get();
		return $query->result();
	}
	public function get_member_types(){
		$query=$this->db->select('*')->get('tbl_member_type');
		return $query->result();
	}
	public function get_member_details(){
		$query=$this->db->select('*')->get('tbl_member');
		return $query->result();
	}
	public function get_member_credentials(){
		$status=1;
		$this->db->select('*');
		$this->db->from('tbl_login');
		$this->db->where('user_name!=','admin');
		$this->db->join('tbl_member','tbl_member.member_id=tbl_login.mem_id');
		$this->db->join('tbl_member_type','tbl_member_type.member_type_id=tbl_login.user_type');
		$this->db->order_by('user_name');
		$query = $this->db->get();
		$data['data']=$query->result();
		return $data;
	}
	public function get_member_types_where($member_type_id){
		$query=$this->db->select('*')->where('member_type',$member_type_id)->get('tbl_member');
		return $query->result();
	}
	public function get_member_login_exist($m_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_login');
		$this->db->where('mem_id',$m_id);
		$query = $this->db->get();
		$data = $query->result();
		return $data;
	}
	public function get_state_lists()
	{
		$this->db->select('state_id,state_name');
		$this->db->from('tbl_state');
		$this->db->where('state_status',1);
		$query = $this->db->get();
		return $query->result();
	}
	public function get_district_lists()
	{
		$this->db->select('district_id,district_name');
		$this->db->from('tbl_district');
		$this->db->where('district_status',1);
		$query = $this->db->get();
		return $query->result();
	}
	

	public function get_excel_import_state($state_name)
	{
		$this->db->select('state_id');
		$this->db->like('state_name', $state_name);
		$this->db->where('state_status',1);
		return $query = $this->db->get('tbl_state')->row()->state_id;

	}

	public function get_excel_import_district($district_name)
	{
		$this->db->select('district_id');
		$this->db->like('district_name', $district_name);
		$this->db->where('district_status',1);
		return $query = $this->db->get('tbl_district')->row()->district_id;

	}

	public function get_excel_import_panchayat($panchayat_name)
	{
		$this->db->select('panchayath_id');
		$this->db->like('panchayath_name', $panchayat_name);
		$this->db->where('panchayath_status',1);
		return $query = $this->db->get('tbl_panchayath')->row()->panchayath_id;

	}

	public function get_admno2($branch_id_fk)
	{
		$this->db->select('*');
		$this->db->from('tbl_member');
		$this->db->where('member_status', 1);
		//$this->db->where('member_type', 1);
		if(!empty($branch_id_fk) && $branch_id_fk != 0)
        {
            $this->db->where("member_branch_id_fk",$branch_id_fk);
        }
        else
        {
            $this->db->where("member_branch_id_fk",0);
        }
		$this->db->order_by('member_mid',"DESC");
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->row();

	}


	
}
