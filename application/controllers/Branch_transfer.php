<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Branch_transfer extends MY_Controller {
	public $table = 'tbl_branch_transfer';
	public $page  = 'Branch';
	public function __construct() {
		parent::__construct();
        if(! $this->is_logged_in()){
          redirect('/login');
        }
        $this->load->model('General_model');
        $this->load->model('Branch_transfer_model');
	}
	public function index()
	{
		$template['body'] = 'Branch_transfer/list';
		$template['script'] = 'Branch_transfer/script';
		$this->load->view('template', $template);
	}
	public function add(){
		$this->form_validation->set_rules('prod_name', 'Select Product', 'required');
		if ($this->form_validation->run() == FALSE) {
            $prod = ['product_category'=> 1];
            $branch = ['branch_status'=> 1];
            $template['product'] = $this->General_model->getall('tbl_product',$prod);
            $template['branch'] = $this->General_model->getall('tbl_branch',$branch);
			$template['body'] = 'Branch_transfer/add';
			$template['script'] = 'Branch_transfer/script';
			$this->load->view('template', $template);
		}
		        else {
			
			            $data = array(
						'bt_branch_id_fk' => $this->input->post('branch_name'),
						'bt_product_id_fk' => $this->input->post('prod_name'),
						'bt_stock' => $this->input->post('stck_amt'),
						'bt_date' => date("Y-m-d"),
						'bt_status' => 1,
						);

                      /*       $datas = array(
                                'branch_id_fk' => $this->input->post('branch_name'),
                                'product_code' => strtoupper($this->input->post('prod_code')),
                                'product_name' => $this->input->post('product_name'),
                                'product_unit' => $this->input->post('product_unit'),
                                'product_hsn' => strtoupper($this->input->post('product_hsn')),
                                'product_hsncode' => strtoupper($this->input->post('product_hsncode')),
                                'product_stock' => $this->input->post('stck_amt'),
                                'product_des' => $this->input->post('product_des'),
                                'product_created_date' => date('Y-m-d'),
                                'product_status' => 1,
                                'product_category' => $this->input->post('product_category'),
                                'product_unit_type' => $this->input->post('product_unit_type'),
                            ); */

			$bt_id = $this->input->post('branch_id');
            $bt_stk = $this->input->post('stck_amt');
            $pr_id = $this->input->post('prod_name');
				if($bt_id){
                     $data['bt_id'] = $bt_id;
                     $result = $this->General_model->update($this->table,$data,'bt_id',$bt_id);
                  //   $result1 = $this->General_model->update('tbl_branch_transfer_history',$data2,'bt_id',$bt_id);

                  //   $result = $this->General_model->update($this->table,$data,'bt_id',$bt_id);
                     $response_text = 'Branch_transfer updated successfully';
                }
				else{
                     $result = $this->General_model->add($this->table,$data);
                     $lastid=$this->db->insert_id();
                    
                    //add product-branch stock
                        $datas = array(
                            'branch_id_fk' => $this->input->post('branch_name'),
                            'product_code' => strtoupper($this->input->post('prod_code')),
                            'product_name' => $this->input->post('product_name'),
                            'product_unit' => $this->input->post('product_unit'),
                            'product_hsn' => strtoupper($this->input->post('product_hsn')),
                            'product_hsncode' => strtoupper($this->input->post('product_hsncode')),
                            'product_stock' => $this->input->post('stck_amt'),
                            'product_des' => $this->input->post('product_des'),
                            'product_created_date' => date('Y-m-d'),
                            'product_status' => 1,
                            'product_category' => $this->input->post('product_category'),
                            'product_unit_type' => $this->input->post('product_unit_type'),
                            'product_price_r1' => $this->input->post('product_price_r1'),
                            'product_price_r2' => $this->input->post('product_price_r2'),
                            'product_price_r3' => $this->input->post('product_price_r3'),

                        );
                    $result2 = $this->General_model->add('tbl_product',$datas);
                     $response_text = 'Branch_transfer added  successfully';
                }
                if($bt_stk){
                    if($bt_stk > 0){
                        $datas = $this->General_model->get_row('tbl_product','product_id',$pr_id);
                        $updated_stk = intval($datas->product_stock) - intval($bt_stk);
                        $stk_array = ['product_stock' => $updated_stk];
                        $result = $this->General_model->update('tbl_product',$stk_array,'product_id',$pr_id);
                    }
                }
				if($result){
	            $this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
				}
				else{
	            $this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
				}
	        redirect('/Branch_transfer/', 'refresh');
		}
	}
	public function get(){
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10';
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        $param['sdate'] = (isset($_REQUEST['sdate'])) ? $_REQUEST['sdate'] : '';
    	$data = $this->Branch_transfer_model->getClassinfoTable($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }
	public function delete(){
        $bt_id = $this->input->post('bt_id');
        $updateData = array('bt_status' => 0);
        $data = $this->General_model->update($this->table,$updateData,'bt_id',$bt_id);
        if($data) {
            $response['text'] = 'Deleted successfully';
            $response['type'] = 'success';
        }
        else{
            $response['text'] = 'Something went wrong';
            $response['type'] = 'error';
        }
        $response['layout'] = 'topRight';
        $data_json = json_encode($response);
        echo $data_json;
    }
	public function edit($bt_id){
        $prod = ['product_category'=> 1];
        $branch = ['branch_status'=> 1];
        $template['product'] = $this->General_model->getall('tbl_product',$prod);
        $template['branch'] = $this->General_model->getall('tbl_branch',$branch);
		$template['body'] = 'Branch_transfer/add';
		$template['script'] = 'Branch_transfer/script';
		$template['records'] = $this->General_model->get_row($this->table,'bt_id',$bt_id);
    	$this->load->view('template', $template);
	}

    public function getAvailStock()
    {
        $prod_id = $this->input->post('prod_id');
        $data = $this->General_model->get_row('tbl_product','product_id',$prod_id);
        echo json_encode($data);
    }
}
