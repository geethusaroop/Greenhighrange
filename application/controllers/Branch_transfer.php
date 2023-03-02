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
        $this->load->model('Item_model');
	}
	public function index()
	{
		$template['body'] = 'Branch_transfer/list';
		$template['script'] = 'Branch_transfer/script';
		$this->load->view('template', $template);
	}
	public function add(){
		$this->form_validation->set_rules('bt_date', 'Date', 'required');
		if ($this->form_validation->run() == FALSE) {
           // $prod = ['product_category'=> 1];
            $branch = ['branch_status'=> 1];
           // $template['product'] = $this->General_model->getall('tbl_product',$prod);
            $template['branch'] = $this->General_model->getall('tbl_branch',$branch);
            $branch_id_fk=$this->session->userdata('branch_id_fk');
            $template['product'] = $this->Item_model->view_by($branch_id_fk);
			$template['body'] = 'Branch_transfer/add';
			$template['script'] = 'Branch_transfer/script2';
			$this->load->view('template', $template);
		}
		else 
        {
            $pr_id=$this->input->post('prod_name');
            $bt_id = $this->input->post('branch_name');
            $bt_stk = $this->input->post('stck_amt');
            $bt_date = $this->input->post('bt_date');
            $prod_code=$this->input->post('prod_code');

            $product_name=$this->input->post('product_name');
            $product_unit= $this->input->post('product_unit');
            $product_hsn= $this->input->post('product_hsn');
            $product_hsncode=$this->input->post('product_hsncode');
            $product_des= $this->input->post('product_des');

            $product_category= $this->input->post('product_category');
            $product_unit_type= $this->input->post('product_unit_type');
            $product_price_r1= $this->input->post('product_price_r1');
            $product_price_r2= $this->input->post('product_price_r2');
            $product_price_r3= $this->input->post('product_price_r3');

            $temp=count($this->input->post('prod_name'));
            for($i=0;$i<$temp;$i++)
            {
                    $data = array(
                    'bt_branch_id_fk' => $bt_id,
                    'bt_product_id_fk' => $pr_id[$i],
                    'bt_stock' => $bt_stk[$i],
                    'bt_date' => $bt_date,
                    'bt_status' => 1,
                    );
                    $result = $this->General_model->add($this->table,$data);//tbl_branch_transfer

                    $branch_id_fk=$this->input->post('branch_name');
                    $bresult = $this->Branch_transfer_model->getbstock($pr_id[$i],$branch_id_fk);

                    if($bresult)
                    {
                        $bstok = $this->General_model->get_row_bstock($pr_id[$i],$branch_id_fk);
                        $updated_bstk = intval($bstok->product_stock) + intval($bt_stk[$i]);
                        $bstok_array = ['product_stock' => $updated_bstk];
                        $result = $this->General_model->updat('tbl_product',$bstok_array,'bproduct_id_fk',$pr_id[$i],'branch_id_fk',$branch_id_fk);
                       // var_dump($result);die;
                        $response_text = 'Branch_transfer added  successfully';
                    }

                    else
                    {
                    //add product-branch stock
                        $datas = array(
                            'bproduct_id_fk' => $pr_id[$i],
                            'branch_id_fk' => $this->input->post('branch_name'),
                            'product_code' => $prod_code[$i],
                            'product_name' => $product_name[$i],
                            'product_unit' => $product_unit[$i],
                            'product_hsn' => $product_hsn[$i],
                            'product_hsncode' =>$product_hsncode[$i],
                            'product_stock' => $bt_stk[$i],
                            'product_des' => $product_des[$i],
                            'product_created_date' => $bt_date,
                            'product_status' => 1,
                            'product_category' => $product_category[$i],
                            'product_unit_type' => $product_unit_type[$i],
                            'product_price_r1' => $product_price_r1[$i],
                            'product_price_r2' => $product_price_r2[$i],
                            'product_price_r3' => $product_price_r3[$i],

                        );
                     $result2 = $this->General_model->add('tbl_product',$datas);
                     $response_text = 'Branch_transfer added  successfully';
                    }

                    $datass = $this->General_model->get_row('tbl_product','product_id',$pr_id[$i]);
                        $updated_stk = intval($datass->product_stock) - intval($bt_stk[$i]);
                        $stk_array = ['product_stock' => $updated_stk];
                        $result = $this->General_model->update('tbl_product',$stk_array,'product_id',$pr_id[$i]);
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

   /*  public function getAvailStock()
    {
        $prod_id = $this->input->post('prod_id');
        $data = $this->General_model->get_row('tbl_product','product_id',$prod_id);
        echo json_encode($data);
    } */

    public function getAvailStock()
	{
		$prod1 = [];
		$pid = $this->input->post('pid');
        $data = $this->Branch_transfer_model->getpstock($pid);
		$prod1['product_code'] = $data->product_code;
		$prod1['product_stock'] = $data->product_stock;
        $prod1['product_name'] = $data->product_name;
        $prod1['product_unit'] = $data->product_unit;
        $prod1['product_hsn'] = $data->product_hsn;
        $prod1['product_hsncode'] = $data->product_hsncode;
        $prod1['product_price_r1'] = $data->product_price_r1;
        $prod1['product_price_r2'] = $data->product_price_r2;
        $prod1['product_price_r3'] = $data->product_price_r3;
        $prod1['product_des'] = $data->product_des;
        $prod1['product_category'] = $data->product_category;
        $prod1['product_unit_type'] = $data->product_unit_type;
		echo json_encode($prod1);
	}

}
