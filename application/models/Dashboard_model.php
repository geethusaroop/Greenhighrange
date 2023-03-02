<?php

class Dashboard_model extends CI_Model

{

	public function getoldstock($param)

	{

		$arOrder = array('', 'product_name');

		$searchValue = ($param['searchValue']) ? $param['searchValue'] : '';

		if ($searchValue) {

			$this->db->like('product_name', $searchValue);

		}

		$this->db->where("stock_status", 1);

		if ($param['start'] != 'false' and $param['length'] != 'false') {

			$this->db->limit($param['length'], $param['start']);

		}

		$this->db->select('stock_id,product_name,category_name,subcategory_name,color_name,size_name,purchase_quantity,sale_quantity,stock_status,DATE_FORMAT(purchase_date,\'%d-%m-%Y\') as purchase_date');

		$this->db->from('stock_details');

		$this->db->join('product_details', 'stock_details.product_id_fk = product_details.product_id');

		$this->db->join('purchase_details', 'product_details.product_id = purchase_details.product_id_fk');

		$this->db->join('category', 'product_details.category_id_fk = category.category_id');

		$this->db->join('subcategory', 'product_details.subcategory_id_fk = subcategory.subcategory_id');

		$this->db->join('size', 'product_details.size_id_fk = size.size_id');

		$this->db->join('color_details', 'product_details.color_id_fk = color_details.color_id');

		$where_date = "purchase_date < DATE_SUB(now(), INTERVAL 300 DAY)";

		$this->db->where($where_date);

		$where_quantity = "(purchase_quantity - sale_quantity) >= 300";

		$this->db->where($where_quantity);

		$this->db->group_by('product_id');

		$this->db->order_by('purchase_date', 'AESC');

		$this->db->where('stock_status', 1);

		$this->db->limit('5');

		$query = $this->db->get();

		$data['data'] = $query->result();

		$data['recordsTotal'] = $this->getoldstockTotalCount($param);

		$data['recordsFiltered'] = $this->getoldstockTotalCount($param);

		return $data;

	}

	public function getoldstockTotalCount($param)

	{

		$searchValue = ($param['searchValue']) ? $param['searchValue'] : '';

		if ($searchValue) {

			$this->db->like('product_name', $searchValue);

		}

		$this->db->select('stock_id,product_name,category_name,subcategory_name,color_name,size_name,purchase_quantity,sale_quantity,stock_status,DATE_FORMAT(purchase_date,\'%d-%m-%Y\') as purchase_date');

		$this->db->from('stock_details');

		$this->db->join('product_details', 'stock_details.product_id_fk = product_details.product_id');

		$this->db->join('purchase_details', 'product_details.product_id = purchase_details.product_id_fk');

		$this->db->join('category', 'product_details.category_id_fk = category.category_id');

		$this->db->join('subcategory', 'product_details.subcategory_id_fk = subcategory.subcategory_id');

		$this->db->join('size', 'product_details.size_id_fk = size.size_id');

		$this->db->join('color_details', 'product_details.color_id_fk = color_details.color_id');

		$where_date = "purchase_date < DATE_SUB(now(), INTERVAL 14 DAY)";

		$this->db->where($where_date);

		$where_quantity = "(purchase_quantity - sale_quantity) >= 300";

		$this->db->where($where_quantity);

		$this->db->group_by('product_id');

		$this->db->order_by('purchase_date', 'AESC');

		$this->db->where('stock_status', 1);

		$this->db->limit('5');

		$query = $this->db->get();

		return $query->num_rows();

	}

	public function getCurrentSale()

	{

		$today = date('Y-m-d');

		$this->db->select('sum(sale_total_price)as SaleTotal');

		$this->db->from('sale_details');

		$this->db->where("sale_date", $today);

		$this->db->where("sale_status", 1);

		$query = $this->db->get();

		return $query->result();

	}



	

	public function getLicensesDetails($param)

	{

		$searchValue =($param['searchValue'])?$param['searchValue']:'';

		if($searchValue){

			$this->db->like('branch_name', $searchValue);

			$this->db->or_like('branch_address', $searchValue);

		}

		if ($param['start'] != 'false' and $param['length'] != 'false') {

			$this->db->limit($param['length'],$param['start']);

		}

		$this->db->select('*,date_format(license_reminder,"%d/%m/%Y") as license_reminder,date_format(license_expirery_date,"%d/%m/%Y") as license_expirery_date');

		$this->db->from('tbl_licenses');

		$this->db->where('license_status',1);

		//$this->db->where_in('member_type',['0','2']);

		$query = $this->db->get();

		$data['data'] = $query->result();

		$data['recordsTotal'] = $this->getLicensesDetailsCount($param);

		$data['recordsFiltered'] = $this->getLicensesDetailsCount($param);

		return $data;

	}

	public function getLicensesDetailsCount($param)

	{

		$searchValue =($param['searchValue'])?$param['searchValue']:'';

		if($searchValue){

			$this->db->like('branch_name', $searchValue);

			$this->db->or_like('branch_address', $searchValue);

		}

		$this->db->select('*');

		$this->db->from('tbl_licenses');

		$this->db->where('license_status',1);

		//$this->db->where_in('member_type',['0','2']);

		$query = $this->db->get();

		return $query->num_rows();

	}

	public function getmember()
	{
		$this->db->where('member_status',1);
		$this->db->where('member_type',1);
		$query=$this->db->get('tbl_member');
		return $query->num_rows();
	}

	public function getmembers()
	{
		$this->db->where('member_status',1);
		$query=$this->db->get('tbl_member');
		return $query->num_rows();
	}

	public function getbranchtotal()
	{
		$this->db->where('branch_status',1);
		$query=$this->db->get('tbl_branch');
		return $query->num_rows();
	}

	public function getboardtotal()
	{
		$this->db->where('d_details_status',1);
		$query=$this->db->get('tbl_direct_details');
		return $query->num_rows();
	}

	public function get_total_purchase_cost($branch_id_fk){
        $query=$this->db->select_sum('purchase_netamt')->where('purchase_branch_id_fk',$branch_id_fk)->get('tbl_purchase');
        return $query->num_rows()>0?$query->row()->purchase_netamt:0;
    }
    public function get_total_sales_revenue($branch_id_fk){
        $query=$this->db->select_sum('sale_netamt')->where('sale_branch_id_fk',$branch_id_fk)->get('tbl_sale');
        return $query->num_rows()>0?$query->row()->sale_netamt:0;
    }
    public function get_stock_transfer_request_count(){
        $query=$this->db->select('*')->get('tbl_branch_transfer');
        return $query->num_rows()>0?$query->num_rows():0;
    }
    public function get_products_count($branch_id_fk){
        $query=$this->db->select('*')->where('branch_id_fk',$branch_id_fk)->get('tbl_product');
        return $query->num_rows()>0?$query->num_rows():0;
    }

	function fetch_chart_data($year)
	{
	$this->db->order_by('sale_date', 'ASC');
	$this->db->where('sale_date', $year);
	return $this->db->get('tbl_sale');
	}

}

