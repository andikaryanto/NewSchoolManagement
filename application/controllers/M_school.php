<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_school extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('M_schools','M_groupusers')); 
        $this->paging->is_session_set();
    }

    public function index()
    {
        $form = $this->paging->get_form_name_id();
        if($this->M_groupusers->is_permitted($_SESSION['userdata']['M_Groupuser_Id'],$form['m_school'],'Read'))
        {

            $params = array(
                'order' => array('Created' => 'ASC')
            );

            $datapages = $this->M_schools->get_list(null, null, $params);
            $data['model'] = $datapages;
            load_view('m_school/index', $data);
        }
        else
        {   
            $this->load->view('forbidden/forbidden');
        }
    }
    
    function add()
    {
        $form = $this->paging->get_form_name_id();
        if($this->M_groupusers->is_permitted($_SESSION['userdata']['M_Groupuser_Id'],$form['m_school'],'Write'))
        {
            $model = $this->M_schools->new_object();
            $data =  $this->paging->set_data_page_add($model);
            load_view('m_school/add', $data);  
        }
        else
        {
            $this->load->view('forbidden/forbidden');
        }
    }

    public function addsave()
    {
        //$date = new DateTime();
        $warning = array();
        $name = $this->input->post('named');
        $address = $this->input->post('address');
        $postcode = $this->input->post('postcode');
        $telp = $this->input->post('telp');
        $fax = $this->input->post('fax');
        $email = $this->input->post('email');
        
        $model = $this->M_schools->new_object();
        $model->Name = $name;
        $model->Address = $address;
        $model->PostCode = $postcode;
        $model->Telp = $telp;
        $model->Fax = $fax;
        $model->Email = $email;
        $model->CreatedBy = $_SESSION['userdata']['Username'];

        $validate = $this->M_schools->validate($model);
 
        if($validate)
        {
            $this->session->set_flashdata('add_warning_msg',$validate);
            $data =  $this->paging->set_data_page_add($model);
            load_view('m_school/add', $data);   
        }
        else{
    
            $model->save();
            $successmsg = $this->paging->get_success_message();
            $this->session->set_flashdata('success_msg', $successmsg);
            redirect('mschool/add');
        }
    }

    public function edit($id)
    {
        $form = $this->paging->get_form_name_id();
        if($this->M_groupusers->is_permitted($_SESSION['userdata']['M_Groupuser_Id'],$form['m_school'],'Write'))
        {
            $model = $this->M_schools->get($id);
            $data =  $this->paging->set_data_page_edit($model);
            load_view('m_school/edit', $data);  
        }
        else
        {
            $this->load->view('forbidden/forbidden');
        } 
    }

    public function editsave()
    {
        
        $id = $this->input->post('idschool');
        $name = $this->input->post('named');
        $address = $this->input->post('address');
        $postcode = $this->input->post('postcode');
        $telp = $this->input->post('telp');
        $fax = $this->input->post('fax');
        $email = $this->input->post('email');

        $model = $this->M_schools->get($id);
        $oldmodel = clone $model;
        
        $model->Name = $name;
        $model->Address = $address;
        $model->PostCode = $postcode;
        $model->Telp = $telp;
        $model->Fax = $fax;
        $model->Email = $email;
        $model->ModifiedBy = $_SESSION['userdata']['Username'];
        


        $validate = $this->M_schools->validate($model, $oldmodel);
        if($validate)
        {
            $this->session->set_flashdata('edit_warning_msg',$validate);
            $data =  $this->paging->set_data_page_edit($model);
            load_view('m_school/edit', $data);   
        }
        else
        {
            $model->save();
            $successmsg = $this->paging->get_success_message();
            $this->session->set_flashdata('success_msg', $successmsg);
            redirect('mschool');
        }
    }

    public function delete(){
        $id = $this->input->post("id");
        $form = $this->paging->get_form_name_id();
        if($this->M_groupusers->is_permitted($_SESSION['userdata']['M_Groupuser_Id'],$form['m_school'],'Delete'))
        {   
            $deleteData = $this->M_schools->get($id);
            $delete = $deleteData->delete();
            if(isset($delete)){
                $deletemsg = $this->helpers->get_query_error_message($delete['code']);
                //$this->session->set_flashdata('warning_msg', $deletemsg);
                echo json_encode(delete_status($deletemsg, FALSE));
            } else {
                $deletemsg = $this->paging->get_delete_message();
                //$this->session->set_flashdata('delete_msg', $deletemsg);
                echo json_encode(delete_status($deletemsg));
            }
        } else {
            echo json_encode(delete_status(FALSE, TRUE));
        }
    }
    
}