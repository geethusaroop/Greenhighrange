<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Member_model extends CI_Model{
	public function __construct()
	{
		parent::__construct();
	}
	public function getClassinfoTable($param,$branch_id_fk){
		$arOrder = array('','member_name');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
		$memberid	 =(isset($param['memberid']))?$param['memberid']:'';
		if($searchValue){
			$this->db->like('member_name', $searchValue);
		}
		if($memberid){
			$this->db->or_like('tbl_member.member_mid ', $memberid);
			$this->db->or_like('tbl_member.member_name ', $memberid);
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
		$this->db->select('*,DATE_FORMAT(tbl_member.m_created_at,\'%d/%m/%Y\') AS m_created_at,date_format(tbl_member.member_dob,"%d/%m/%Y") as date_of_birth');
		$this->db->from('tbl_member');
		$this->db->join('tbl_state','member_state= state_id','left');
		$this->db->join('tbl_district','member_district= district_id','left');
		$this->db->join('tbl_panchayath','member_panchayath= panchayath_id','left');
		$this->db->group_by('member_id');
		$this->db->order_by('member_id', 'DESC');
		$this->db->where("member_type!=",1);
		$query = $this->db->get();
		$data['data'] = $query->result();
		$data['recordsTotal'] = $this->getClassinfoTotalCount($param,$branch_id_fk);
		$data['recordsFiltered'] = $this->getClassinfoTotalCount($param,$branch_id_fk);
		return $data;
	}
	public function getClassinfoTotalCount($param = NULL,$branch_id_fk){
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
		if($searchValue){
			$this->db->like('member_name', $searchValue);
		}
		$this->db->select('*');
		$this->db->from('tbl_member');
		$this->db->where("member_status",1);
		$this->db->order_by('member_id', 'DESC');
		$this->db->where("member_type!=",1);
		if(!empty($branch_id_fk) && $branch_id_fk != 0)
        {
            $this->db->where("member_branch_id_fk",$branch_id_fk);
        }
        else
        {
            $this->db->where("member_branch_id_fk",0);
        }
		$query = $this->db->get();
		return $query->num_rows();
	}
//shareholders list
public function getshareholdersClassinfoTable($param){
	$arOrder = array('','member_name');
	$searchValue =($param['searchValue'])?$param['searchValue']:'';
	$memberid	 =(isset($param['memberid']))?$param['memberid']:'';
	$start_date	 =(isset($param['start_date']))?$param['start_date']:'';
	$end_date	 =(isset($param['end_date']))?$param['end_date']:'';
	if($searchValue){
		$this->db->like('member_name', $searchValue);
	}
	if($memberid){
		$this->db->or_like('tbl_member.member_mid ', $memberid);
		$this->db->or_like('tbl_member.member_name ', $memberid);
	}
	if($start_date && $end_date){
		$this->db->where('tbl_member.created_at >=', $start_date);
		$this->db->where('tbl_member.created_at <=', $end_date);
	}
	$this->db->where("member_status",1);
	if ($param['start'] != 'false' and $param['length'] != 'false') {
		$this->db->limit($param['length'],$param['start']);
	}
	//$this->db->select('*,tbl_cag.cag_name,tbl_region.region_name,tbl_panchayath.panchayath_name,sum(tbl_deposit.deposit_amount) as depositsum');
	$this->db->select('*,COALESCE(total_from_share_transfer,0) AS total_from_share_transfer,DATE_FORMAT(MAX(tbl_member.created_at),\'%d/%m/%Y\') AS m_created_at,DATE_FORMAT(MAX(tbl_member.member_dob),\'%d/%m/%Y\') AS member_dob');
	$this->db->from('tbl_member');
	$this->db->join('tbl_state','member_state= state_id','left');
	$this->db->join('tbl_district','member_district= district_id','left');
	$this->db->join('tbl_panchayath','member_panchayath= panchayath_id','left');
	$this->db->join('(SELECT *,SUM(tbl_share_transfer_history.transfer_no_of_shares) AS total_from_share_transfer FROM tbl_share_transfer_history GROUP BY transfer_from_id) AS tbl_share_transfer_history2','tbl_share_transfer_history2.transfer_from_id= tbl_member.member_id','left');
	$this->db->where("member_type",1);
	$this->db->group_by('member_id');
	$this->db->order_by('member_id', 'DESC');
	//$this->db->where("member_status",1);
	$query = $this->db->get();
	//$data = $this->db->last_query();
	$data['data'] = $query->result();
	$data['recordsTotal'] = $this->getshareholdersClassinfoTotalCount($param);
	$data['recordsFiltered'] = $this->getshareholdersClassinfoTotalCount($param);
	return $data;
}
public function getshareholdersClassinfoTotalCount($param = NULL){
	$searchValue =($param['searchValue'])?$param['searchValue']:'';
	$memberid	 =(isset($param['memberid']))?$param['memberid']:'';
	$start_date	 =(isset($param['start_date']))?$param['start_date']:'';
	$end_date	 =(isset($param['end_date']))?$param['end_date']:'';
	if($searchValue){
		$this->db->like('member_name', $searchValue);
	}
	if($memberid){
		$this->db->or_like('tbl_member.member_mid ', $memberid);
		$this->db->or_like('tbl_member.member_name ', $memberid);
	}
	if($start_date && $end_date){
		$this->db->like('tbl_member.created_at ', $start_date);
		$this->db->or_like('tbl_member.created_at ', $end_date);
	}
	$this->db->select('*');
	$this->db->from('tbl_member');
	$this->db->where("member_status",1);
	$this->db->where("member_type",1);
	$this->db->order_by('member_id', 'DESC');
	$query = $this->db->get();
	return $query->num_rows();
}
	//outlet list
	public function getoutletClassinfoTable($param){
		$arOrder = array('','member_name');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
		$memberid	 =(isset($param['memberid']))?$param['memberid']:'';
		if($searchValue){
			$this->db->like('member_name', $searchValue);
		}
		if($memberid){
			$this->db->or_like('tbl_member.member_mid ', $memberid);
			$this->db->or_like('tbl_member.member_name ', $memberid);
		}
		$this->db->where("member_status",1);
		if ($param['start'] != 'false' and $param['length'] != 'false') {
			$this->db->limit($param['length'],$param['start']);
		}
		$this->db->select('*,DATE_FORMAT(MAX(created_at),\'%d/%m/%Y\') AS created_at');
		$this->db->from('tbl_member');
		$this->db->join('tbl_state','member_state= state_id','left');
		$this->db->join('tbl_district','member_district= district_id','left');
		$this->db->join('tbl_panchayath','member_panchayath= panchayath_id','left');
		$this->db->where("member_type",2);
		$this->db->group_by('member_id');
		$this->db->order_by('member_id', 'DESC');
		$query = $this->db->get();
		$data['data'] = $query->result();
		$data['recordsTotal'] = $this->getoutletClassinfoTotalCount($param);
		$data['recordsFiltered'] = $this->getoutletClassinfoTotalCount($param);
		return $data;
	}
	public function getoutletClassinfoTotalCount($param = NULL){
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
		$this->db->where("member_type",2);
		$this->db->order_by('member_id', 'DESC');
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function getClassinfoTable1($param,$pid){
		$arOrder = array('','member_name');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
		$memberid	 =(isset($param['memberid']))?$param['memberid']:'';
		if($searchValue){
			$this->db->like('member_name', $searchValue);
		}
		if($memberid){
			$this->db->or_like('tbl_member.member_mid ', $memberid);
			$this->db->or_like('tbl_member.member_name ', $memberid);
		}
		$this->db->where("member_status",1);
			$this->db->where('member_panchayath',$pid);
		if ($param['start'] != 'false' and $param['length'] != 'false') {
			$this->db->limit($param['length'],$param['start']);
		}
		//$this->db->select('*,tbl_cag.cag_name,tbl_region.region_name,tbl_panchayath.panchayath_name,sum(tbl_deposit.deposit_amount) as depositsum');
		$this->db->select('*,DATE_FORMAT(MAX(created_at),\'%d/%m/%Y\') AS created_at');
		$this->db->from('tbl_member');
		$this->db->join('tbl_state','member_state= state_id','left');
		$this->db->join('tbl_district','member_district= district_id','left');
		$this->db->join('tbl_panchayath','member_panchayath= panchayath_id','left');
		// $this->db->join('tbl_member_type','member_type_id= member_type','left');
		$this->db->group_by('member_id');
		$this->db->order_by('member_id', 'DESC');
		//$this->db->where("member_status",1);
		$query = $this->db->get();
		$data['data'] = $query->result();
		$data['recordsTotal'] = $this->getClassinfoTotalCount1($param,$pid);
		$data['recordsFiltered'] = $this->getClassinfoTotalCount1($param,$pid);
		return $data;
	}
	public function getClassinfoTotalCount1($param = NULL,$pid){
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
		if($searchValue){
			$this->db->like('member_name', $searchValue);
		}
		$this->db->select('*');
		$this->db->from('tbl_member');
		$this->db->where("member_status",1);
			$this->db->where('member_panchayath',$pid);
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
		$ids =[ 2, 7 ];
		$query=$this->db->select('*')->where_in('member_type_id',$ids)->get('tbl_member_type');
		return $query->result();
	}
	public function get_member_details(){
		$query=$this->db->select('*')->get('tbl_member');
		return $query->result();
	}
	public function get_member_credentials(){
		$this->db->select('*');
		$this->db->from('tbl_login');
		$this->db->where('user_name!=','admin');
		$this->db->join('tbl_member','tbl_member.member_id=tbl_login.mem_id');
		$this->db->join('tbl_member_type','tbl_member_type.member_type_id=tbl_login.user_type');
		$this->db->order_by('tbl_login.id','DESC');
		$this->db->where('status',1);
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
	public function getIntegratorClassinfoTable($param){
		$arOrder = array('','member_name');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
		$memberid	 =(isset($param['memberid']))?$param['memberid']:'';
		if($searchValue){
			$this->db->like('member_name', $searchValue);
		}
		if($memberid){
			$this->db->or_like('tbl_member.member_mid ', $memberid);
			$this->db->or_like('tbl_member.member_name ', $memberid);
		}
		$this->db->where("member_status",1);
		if ($param['start'] != 'false' and $param['length'] != 'false') {
			$this->db->limit($param['length'],$param['start']);
		}
		$this->db->select('*,DATE_FORMAT(MAX(created_at),\'%d/%m/%Y\') AS created_at');
		$this->db->from('tbl_member');
		$this->db->join('tbl_state','member_state= state_id','left');
		$this->db->join('tbl_district','member_district= district_id','left');
		$this->db->join('tbl_panchayath','member_panchayath= panchayath_id','left');
		$this->db->where("member_type",7);
		$this->db->group_by('member_id');
		$this->db->order_by('member_id', 'DESC');
		$query = $this->db->get();
		$data['data'] = $query->result();
		$data['recordsTotal'] = $this->getIntegratorClassinfoTotalCount($param);
		$data['recordsFiltered'] = $this->getIntegratorClassinfoTotalCount($param);
		return $data;
	}
	public function getIntegratorClassinfoTotalCount($param = NULL){
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
		$this->db->where("member_type",7);
		$this->db->order_by('member_id', 'DESC');
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function getShopsClassinfoTable($param){
		$arOrder = array('','member_name');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
		$memberid	 =(isset($param['memberid']))?$param['memberid']:'';
		if($searchValue){
			$this->db->like('member_name', $searchValue);
		}
		if($memberid){
			$this->db->or_like('tbl_member.member_mid ', $memberid);
			$this->db->or_like('tbl_member.member_name ', $memberid);
		}
		$this->db->where("member_status",1);
		if ($param['start'] != 'false' and $param['length'] != 'false') {
			$this->db->limit($param['length'],$param['start']);
		}
		$this->db->select('*,DATE_FORMAT(MAX(created_at),\'%d/%m/%Y\') AS created_at');
		$this->db->from('tbl_member');
		$this->db->join('tbl_state','member_state= state_id','left');
		$this->db->join('tbl_district','member_district= district_id','left');
		$this->db->join('tbl_panchayath','member_panchayath= panchayath_id','left');
		$this->db->where("member_type",5);
		$this->db->group_by('member_id');
		$this->db->order_by('member_id', 'DESC');
		$query = $this->db->get();
		$data['data'] = $query->result();
		$data['recordsTotal'] = $this->getShopsClassinfoTotalCount($param);
		$data['recordsFiltered'] = $this->getShopsClassinfoTotalCount($param);
		return $data;
	}
	public function getShopsClassinfoTotalCount($param = NULL){
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
		$this->db->where("member_type",5);
		$this->db->order_by('member_id', 'DESC');
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function getOutletReports($member_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_distributions');
		$this->db->join('tbl_member','tbl_member.member_id=tbl_distributions.dist_member_id_fk','left');
		$this->db->where("dist_status",1);
		$this->db->order_by('dist_id','DESC');
		$this->db->limit(1);
		$this->db->where("dist_member_id_fk",$member_id);
		$query = $this->db->get();
		if($query !== FALSE && $query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}
	public function getShopReports($mem_type,$member_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_sale');
		$this->db->join('tbl_member','tbl_member.member_id=tbl_sale.customer_name','left');
		$this->db->join('tbl_member_type','tbl_member_type.member_type_id=tbl_sale.member_type');
		$this->db->where("sale_status",1);
		$this->db->where("tbl_sale.member_type",$mem_type);
		$this->db->where("customer_name",$member_id);
		$query = $this->db->get();
		//var_dump($query->num_rows());die;
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}
	public function getMemberDetails($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_login');
		$this->db->join('tbl_member','tbl_member.member_id=tbl_login.mem_id','left');
		$this->db->join('tbl_member_type','tbl_member_type.member_type_id=tbl_member.member_type');
		$this->db->where("tbl_login.id",$id);
		$this->db->where("status",1);
		$query = $this->db->get();
		return $data = $query->row();
	}
}
