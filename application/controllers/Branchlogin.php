<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Branchlogin extends MY_Controller
{
    public $table = 'admin_login';
    public $page  = 'Branchlogin';
    public function __construct()
    {
        parent::__construct();
        if (!$this->is_logged_in()) {
            redirect('/login');
        }
        $this->load->model('General_model');
        $this->load->model('Branchlogin_model');
    }
    public function getdes()
    {
    $id = $this->input->post('id');
    $data = $this->Branchlogin_model->getdes($id);
    $json_data = json_encode($data);
    echo $json_data;
    }
    public function index()
    {
        $template['body'] = 'Branchlogin/list';
        $template['script'] = 'Branchlogin/script';
        $this->load->view('template', $template);
    }
    public function add()
    {
        $this->form_validation->set_rules('branch_id_fk', 'NAME', 'required');
        if ($this->form_validation->run() == FALSE) {
            $branch = ['branch_status'=> 1];
            $template['branch'] = $this->General_model->getall('tbl_branch',$branch);
            $template['body'] = 'Branchlogin/add';
            $template['script'] = 'Branchlogin/script';
            $this->load->view('template', $template);
        } else {
            $id = $this->input->post('id');
            $data = array(
                'branch_id_fk' => $this->input->post('branch_id_fk'),
                'user_name' => $this->input->post('user_name'),
                'admin_password' => $this->input->post('admin_password'),
                'user_type' => 'B',
                'created_date' => date("Y-m-d"),
                'updated_date' => date("Y-m-d"),
                'user_status' => 1
            );
            if ($id) {
                $data['id'] = $id;
                $result = $this->General_model->update($this->table, $data, 'id', $id);
                $response_text = 'Branch Login Information  updated successfully';
            } else {
                $result = $this->General_model->add($this->table, $data);
                $response_text = 'Branch Login Information added  successfully';
            }
            if ($result) {
                $this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
            } else {
                $this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
            }
            redirect('/Branchlogin/');
        }
    }
    public function get()
    {
        $this->load->model('Branchlogin_model');
        $param['draw'] = (isset($_REQUEST['draw'])) ? $_REQUEST['draw'] : '';
        $param['length'] = (isset($_REQUEST['length'])) ? $_REQUEST['length'] : '10';
        $param['start'] = (isset($_REQUEST['start'])) ? $_REQUEST['start'] : '0';
        $param['order'] = (isset($_REQUEST['order'][0]['column'])) ? $_REQUEST['order'][0]['column'] : '';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir'])) ? $_REQUEST['order'][0]['dir'] : '';
        $param['searchValue'] = (isset($_REQUEST['search']['value'])) ? $_REQUEST['search']['value'] : '';
        $data = $this->Branchlogin_model->getCompanyTable($param);
        $json_data = json_encode($data);
        echo $json_data;
    }
    public function delete()
    {
        $id = $this->input->post('id');
        $updateData = array('user_status' => 0);
        $data = $this->General_model->update($this->table, $updateData, 'id', $id);
        if ($data) {
            $response['text'] = 'Deleted successfully';
            $response['type'] = 'success';
        } else {
            $response['text'] = 'Something went wrong';
            $response['type'] = 'error';
        }
        $response['layout'] = 'topRight';
        $data_json = json_encode($response);
        echo $data_json;
        redirect('/Branchlogin/', 'refresh');
    }
    public function edit($id)
    {
        $branch = ['branch_status'=> 1];
        $template['branch'] = $this->General_model->getall('tbl_branch',$branch);
        $template['body'] = 'Branchlogin/add';
        $template['script'] = 'Branchlogin/script';
        $template['records'] = $this->General_model->get_row($this->table, 'id', $id);
        $this->load->view('template', $template);
    }
}
