<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class BSale_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}
	public function getSaleReport($param)
	{
		$arOrder = array('', 'product_num');
		$product_num = (isset($param['product_num'])) ? $param['product_num'] : '';
        $branch=(isset($param['branch'])) ? $param['branch'] : '';
		$start_date = (isset($param['start_date'])) ? $param['start_date'] : '';
		$end_date = (isset($param['end_date'])) ? $param['end_date'] : '';

		if ($product_num) {
			$this->db->like('tbl_sale.invoice_number', $product_num);
		}

		if ($start_date) {
			$this->db->where('sale_date >=', $start_date);
		}
		if ($end_date) {
			$this->db->where('sale_date <=', $end_date);
		}
		if($branch)
        {
            $this->db->where("sale_branch_id_fk",$branch);
        }
        $this->db->where("sale_branch_id_fk!=",0);
		$this->db->where("sale_status", 1);
		$this->db->where("routsale_status", 0);

		if ($param['start'] != 'false' and $param['length'] != 'false') {
			$this->db->limit($param['length'], $param['start']);
		}
		$this->db->select('*,COUNT(invoice_number) as slcount,ROUND(SUM(sale_netamt),2) as total,sum(sale_quantity) as qty,ROUND((total_price-(sale_discount+sale_shareholder_discount)),2) as tprice,DATE_FORMAT(sale_date,\'%d/%m/%Y\') as sale_dates,tbl_sale.sale_discount as discount');
		$this->db->from('tbl_sale');
		$this->db->join('tbl_member', 'tbl_member.member_id = tbl_sale.member_id_fk', 'left');
        $this->db->join('tbl_branch','tbl_branch.branch_id=tbl_sale.sale_branch_id_fk');
		$this->db->group_by('invoice_number', 'DESC');
		$query = $this->db->get();
		$data['data'] = $query->result();
		$data['recordsTotal'] = $this->getSaleReportTotalCount($param);
		$data['recordsFiltered'] = $this->getSaleReportTotalCount($param);
		//return $this->db->last_query();
		return $data;
	}
	public function getSaleReportTotalCount($param)
	{
		$product_num = (isset($param['product_num'])) ? $param['product_num'] : '';
		//$shop =(isset($param['shop']))?$param['shop']:'';
		$start_date = (isset($param['start_date'])) ? $param['start_date'] : '';
		$end_date = (isset($param['end_date'])) ? $param['end_date'] : '';
        $branch=(isset($param['branch'])) ? $param['branch'] : '';
		if ($product_num) {
			$this->db->like('tbl_sale.invoice_number', $product_num);
		}

		if ($start_date) {
			$this->db->where('sale_date >=', $start_date);
		}
		if ($end_date) {
			$this->db->where('sale_date <=', $end_date);
		}
		if($branch)
        {
            $this->db->where("sale_branch_id_fk",$branch);
        }
        
        $this->db->where("sale_branch_id_fk!=",0);
       
		$this->db->select('*,COUNT(invoice_number) as slcount,SUM(sale_netamt) as total,sum(sale_quantity) as qty,DATE_FORMAT(sale_date,\'%d/%m/%Y\') as sale_dates,tbl_sale.discount_price as discount');

		$this->db->from('tbl_sale');

		$this->db->join('tbl_member', 'tbl_member.member_id = tbl_sale.member_id_fk', 'left');
        $this->db->join('tbl_branch','tbl_branch.branch_id=tbl_sale.sale_branch_id_fk');
		$this->db->where("sale_status", 1);
		$this->db->where("routsale_status",0);
		$this->db->group_by('invoice_number', 'DESC');

		$query = $this->db->get();
		return $query->num_rows();
	}

}
