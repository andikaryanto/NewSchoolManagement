<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_province extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //$this->load->database('naturedisaster', TRUE);
        $this->load->model(array('M_provinces','M_groupusers')); 
        $this->load->library(array('paging', 'session','helpers'));
        $this->load->helper('form');
        $this->paging->is_session_set();
    }

    public function index()
    {
        $form = $this->paging->get_form_name_id();
        if($this->M_groupusers->is_permitted($_SESSION['userdata']['M_Groupuser_Id'],$form['m_province'],'Read'))
        {

            $params = array(
                'order' => array('Created' => 'ASC')
            );

            $datapages = $this->M_provinces->get_list(null, null, $params);
            $data['model'] = $datapages;
            load_view('m_province/index', $data);
        }
        else
        {   
            $this->load->view('forbidden/forbidden');
        }
    }
    
    function add()
    {
        $form = $this->paging->get_form_name_id();
        if($this->M_groupusers->is_permitted($_SESSION['userdata']['M_Groupuser_Id'],$form['m_province'],'Write'))
        {
            $model = $this->M_provinces->new_object();
            $data =  $this->paging->set_data_page_add($model);
            load_view('m_province/add', $data);  
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
        $err_exist = false;
        $name = $this->input->post('named');
        $description = $this->input->post('description');
        
        $model = $this->M_provinces->new_object();
        $model->Name = $name;
        $model->Description = $description;
        $model->CreatedBy = $_SESSION['userdata']['Username'];

        $validate = $this->M_provinces->validate($model);
 
        if($validate)
        {
            $this->session->set_flashdata('add_warning_msg',$validate);
            $data =  $this->paging->set_data_page_add($model);
            load_view('m_province/add', $data);   
        }
        else{
    
            $model->save();
            $successmsg = $this->paging->get_success_message();
            $this->session->set_flashdata('success_msg', $successmsg);
            redirect('mprovince/add');
        }
    }

    public function edit($id)
    {
        $form = $this->paging->get_form_name_id();
        if($this->M_groupusers->is_permitted($_SESSION['userdata']['M_Groupuser_Id'],$form['m_province'],'Write'))
        {
            $model = $this->M_provinces->get($id);
            $data =  $this->paging->set_data_page_edit($model);
            load_view('m_province/edit', $data);  
        }
        else
        {
            $this->load->view('forbidden/forbidden');
        } 
    }

    public function editsave()
    {
        
        $id = $this->input->post('idprovince');
        $name = $this->input->post('named');
        $description = $this->input->post('description');

        $model = $this->M_provinces->get($id);
        $oldmodel = clone $model;
        //print_r($oldmodel);
        
        $model->Name = $name;
        $model->Description = $description;
        $model->ModifiedBy = $_SESSION['userdata']['Username'];
        


        $validate = $this->M_provinces->validate($model, $oldmodel);
        if($validate)
        {
            $this->session->set_flashdata('edit_warning_msg',$validate);
            $data =  $this->paging->set_data_page_edit($model);
            load_view('m_province/edit', $data);   
        }
        else
        {
            $model->save();
            $successmsg = $this->paging->get_success_message();
            $this->session->set_flashdata('success_msg', $successmsg);
            redirect('mprovince');
        }
    }

    public function delete(){
        $id = $this->input->post("id");
        $form = $this->paging->get_form_name_id();
        if($this->M_groupusers->is_permitted($_SESSION['userdata']['M_Groupuser_Id'],$form['m_province'],'Delete'))
        {   
            $deleteData = $this->M_provinces->get($id);
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