<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sale_Report extends MY_Controller {
	public $table = 'tbl_sale';
	public $tbl_stock = 'tbl_stock';
	public $page  = 'Salereport';
	public function __construct() {
		parent::__construct();
         if(! $this->is_logged_in()){
            redirect('/login');
        }
        $this->load->model('General_model');
		$this->load->model('Salereport_model');
        $this->load->model('Sale_report_model');
	}
	public function cutomerSaleRport()
	{
        $prid =$this->session->userdata('prid');
		$template['body'] = 'Sale_report/cus_list';
		$template['script'] = 'Sale_report/cus_script';
        $template['customer'] = $this->Sale_report_model->get_customer();
        $branch_id_fk=$this->session->userdata('branch_id_fk');
        $template['records']=$this->Sale_report_model->getCusSaleReports($branch_id_fk);
		$this->load->view('template', $template);
	}

    public function cutomerSaleRport1()
	{
        $prid =$this->session->userdata('prid');
        $cdate=$this->input->post('start_date');
		$edate=$this->input->post('end_date');
		$template['body'] = 'Sale_report/cus_list';
		$template['script'] = 'Sale_report/cus_script';
        $template['customer'] = $this->Sale_report_model->get_customer();
        $branch_id_fk=$this->session->userdata('branch_id_fk');
        $template['records']=$this->Sale_report_model->getCusSaleReports1($cdate,$edate,$branch_id_fk);
        $template['cdate']=$cdate;
		$template['edate']=$edate;
		$this->load->view('template', $template);
	}

################################################################################################################################################################
//supplier wise sale
    public function supplierSaleRport()
	{
		$template['body'] = 'Sale_report/supp_list';
		$template['script'] = 'Sale_report/supp_script';
		//$template['product_num'] = $this->Salereport_model->get_productnum();
        $id = [
            'vendorstatus' => 1,
        ];
        $template['supplier'] = $this->General_model->getall('tbl_vendor',$id);
        $prid =$this->session->userdata('prid');
        $template['records']=$this->Sale_report_model->supplierSaleRportLists($prid);
		$this->load->view('template', $template);
	}


    public function supplierSaleRport1()
	{
		$template['body'] = 'Sale_report/supp_list';
		$template['script'] = 'Sale_report/supp_script';
        $id = [
            'vendorstatus' => 1,
        ];
        $template['supplier'] = $this->General_model->getall('tbl_vendor',$id);
        $prid =$this->session->userdata('prid');
        $cdate=$this->input->post('start_date');
		$edate=$this->input->post('end_date');
        $vendor_id=$this->input->post('vendor_id');
        $template['records']=$this->Sale_report_model->supplierSaleRportLists1($cdate,$edate,$vendor_id,$prid);
        $template['cdate']=$cdate;
		$template['edate']=$edate;
        $template['vendor_id']=$vendor_id;
		$this->load->view('template', $template);
	}

	
    ###########################################################################################################################################
    //item wise sale
    public function itemSaleRport()
	{
		$template['body'] = 'Sale_report/item_list';
		$template['script'] = 'Sale_report/item_script';
        $id = [
            'product_status' => 1,
        ];
        $prid =$this->session->userdata('prid');
        $branch_id_fk=$this->session->userdata('branch_id_fk');
        $template['item'] = $this->Sale_report_model->getitems($branch_id_fk);
        $template['records']=$this->Sale_report_model->itemSaleRportLists($branch_id_fk);
		$this->load->view('template', $template);
	}


    public function itemSaleRport1()
	{
        $template['body'] = 'Sale_report/item_list';
		$template['script'] = 'Sale_report/item_script';
        $id = [
            'product_status' => 1,
        ];
        $prid =$this->session->userdata('prid');
       // $template['item'] = $this->Sale_report_model->getitems();
        $prid =$this->session->userdata('prid');
        $cdate=$this->input->post('start_date');
		$edate=$this->input->post('end_date');
        $item_id=$this->input->post('item_id');
        $branch_id_fk=$this->session->userdata('branch_id_fk');
        $template['item'] = $this->Sale_report_model->getitems($branch_id_fk);
        $template['records']=$this->Sale_report_model->itemSaleRportLists1($cdate,$edate,$item_id,$prid);
        $template['cdate']=$cdate;
		$template['edate']=$edate;
        $template['item_id']=$item_id;
		$this->load->view('template', $template);
	}

	
}